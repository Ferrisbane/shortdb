<?php

namespace Ferrisbane\ShortDB;

use Ferrisbane\ShortDB\Contracts\ClassHelper;
use Ferrisbane\ShortDB\Contracts\ShortDB as ShortDBC;
use Illuminate\Contracts\Filesystem\Filesystem;

class ShortDB implements ShortDBC
{
    protected $providers = [];
    protected $codes = [];
    protected $arguments = [];
    protected $requirements = [];

    /**
     *
     * @var Filesystem
     */
    protected $files;

    /**
     * @var ClassHelper
     */
    protected $classHelper;

    public function __construct(Filesystem $files, ClassHelper $classHelper)
    {
        $this->files = $files;
        $this->classHelper = $classHelper;
        $this->getClasses();
    }

    /**
     * Process the string
     *
     * @param $string
     *
     * @return string|string[]|null
     */
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
            /** @var Shortcode $shortCode */
            $shortCode = new $provider;

            $this->codes[$shortCode->getCode()] = $shortCode;

            $this->arguments[$shortCode->getCode()] = $shortCode->getDefaultArguments();
            $this->requirements[$shortCode->getCode()] = $shortCode->getRequiredArguments();
        }
    }

    protected function getClasses()
    {
        $paths = config('shortdb.path', base_path().'/app/Shortcodes');

        if (!is_array($paths)) {
            $paths = [$paths];
        }

        foreach($paths as $path) {
            foreach($this->files->files($path) as $file) {
                $this->providers[] = $this->classHelper->getFullyQualifiedClassName($file);
            }
        }
    }
}