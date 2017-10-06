<?php

namespace Ferrisbane\ShortDB;

use Ferrisbane\ShortDB\Contracts\ShortDB as ShortDBC;
use Illuminate\Support\Fluent;
use Illuminate\Filesystem\Filesystem;

class ShortDB implements ShortDBC
{
    protected $providers = [];
    protected $codes = [];
    protected $arguments = [];
    protected $requirements = [];

    public function __construct(Filesystem $files)
    {
        $this->files = $files;
        $this->getClasses();
        // $this->providers = config('shortdb.providers');
    }

    public function process($string)
    {
        $this->getCodes($this->providers);

        $pattern = '/\{(.*?)\|(.*?)\}/';
        return preg_replace_callback($pattern, function($matches) {
            return $this->replaceMatch($matches);
        }, $string);
    }

    protected function replaceMatch($matches)
    {
        $code = $matches[1];

        if ( ! in_array($code, array_keys($this->codes))) {
            return $matches[0];
        }

        // Get the shortcode processor
        $processor = $this->codes[$code];

        // Get the arguments for this shortcode
        $arguments = $this->arguments[$code];
        // Get the requirements for this shortcode
        $requirements = $this->requirements[$code];

        $codeArguments = [];
        if ( ! empty($matches[2])) {
            $codeArguments = explode('|', $matches[2]);
        }

        foreach ($codeArguments as $attribute) {
            $options = explode(':', $attribute);

            $key = array_pull($options, 0);
            array_pull($requirements, $key);

            $optionValue = array_get($arguments, $key, true);
            if (isset($options[1])) {
                $optionValue = $options[1];
            } else {
                $optionValue = true;
            }

            $arguments[$key] = $optionValue;
        }

        // All requirements not met
        if (count($requirements) >= 1) {
            return false;
        }

        // Process the shortcode
        return $processor->process($arguments);
    }


    protected function getCodes($providers)
    {
        foreach ($providers as $provider) {
            $shortCode = new $provider;

            $this->codes[$shortCode->getCode()] = $shortCode;

            $this->arguments[$shortCode->getCode()] = $shortCode->getDefaultArguments();
            $this->requirements[$shortCode->getCode()] = $shortCode->getRequiredArguments();
        }
    }

    protected function getClasses()
    {
        $path = config('shortdb.path', base_path().'/app/Shortcodes');
        $files = $this->files->files($path);

        foreach ($files as $file) {
            if (gettype($file) == 'string') {
                $filePath = $file;
            } else {
                $filePath = $file->getRealPath();
            }

            $this->providers[] = $this->convertToClassName($filePath);
        }

    }

    protected function convertToClassName($path)
    {
        $namespace = config('shortdb.namespace', 'App');
        $path = str_replace(base_path(), '', $path);
        $path = str_replace('/', '\\', $path);
        $path = str_replace('app\\', $namespace.'\\', $path);
        $path = str_replace('.php', '', $path);

        return $path;
    }

}