<?php

if ( ! function_exists('shortdb')) {

    /**
     * Get an instance of the shortdb class.
     *
     * @return ShortDB
     */
    function shortdb($string)
    {
        return app('shortdb')->process($string);
    }
}

