<?php

namespace Ferrisbane\ShortDB;

use Ferrisbane\ShortDB\Contracts\ClassHelper as Contract;

class ClassHelper implements Contract
{
    /**
     * @param string $filename
     *
     * @return string
     */
    public function getFullyQualifiedClassName($filename)
    {
        return $this->getFullNamespace($filename) . '\\'
            . $this->getClassname($filename);
    }

    /**
     * @param string $filename
     *
     * @return mixed
     */
    private function getFullNamespace($filename)
    {
        $lines         = file($filename);
        $namespaceLineMatch = preg_grep('/^namespace /', $lines);
        $namespaceLine = array_shift($namespaceLineMatch);
        $match         = [];
        preg_match('/^namespace (.*);$/', $namespaceLine, $match);

        return array_pop($match);
    }

    /**
     * @param string $filename
     *
     * @return mixed
     */
    private function getClassname($filename)
    {
        $directoriesAndFilename = explode('/', $filename);
        $filename               = array_pop($directoriesAndFilename);
        $nameAndExtension       = explode('.', $filename);

        return array_shift($nameAndExtension);
    }
}