<?php

if ( ! function_exists('shortdb')) {

    /**
     * Get an instance of the shortdb class.
     *
     * @return ShortDB
     */
    function shortdb($string)
    {
        $content = preg_replace_callback("/\{(.*?)\|(.*?)\}/", function($matches) {
            return replaceMatch($matches);
        }, $string);
        
        return $content;
    }

    function replaceMatch($matches)
    {
        $new = '';
        switch ($matches[1]) {
            case 'fa':
                return '<i class="fa fa-'.$matches[2].'"></i>';
                break;
            default:
                return $matches[0];
                break;
        }
    }
}

