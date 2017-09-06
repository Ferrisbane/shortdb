<?php

namespace Ferrisbane\ShortDB\Facades;

class ShortDB
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'shortdb';
    }
}