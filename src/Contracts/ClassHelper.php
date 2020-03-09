<?php

namespace Ferrisbane\ShortDB\Contracts;

interface ClassHelper
{
    /**
     * @param string $filename
     *
     * @return string
     */
    public function getFullyQualifiedClassName($filename);
}