<?php

namespace Ferrisbane\ShortDB;

class Shortcode
{

    /**
     * Returns the shortcode.
     * Put this in extend class...
     *
     * @param array $arguments
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Returns the arguments for this shortcode.
     * Put this in extend class...
     *
     * @param array $arguments
     */
    public function getDefaultArguments()
    {
        $defaults = [];

        foreach ($this->arguments as $key => $argument) {
            if (isset($argument['default'])) {
                $defaults[$key] = $argument['default'];
            } else {
                $defaults[$key] = null;
            }
        }

        return $defaults;
    }

    /**
     * Returns the arguments for this shortcode.
     * Put this in extend class...
     *
     * @param array $arguments
     */
    public function getRequiredArguments()
    {
        $requirments = [];

        foreach ($this->arguments as $key => $argument) {
            if (isset($argument['required']) && $argument['required'] === true) {
                $requirments[$key] = $argument['required'];
            }
        }

        return $requirments;
    }

    /**
     * Returns the arguments for this shortcode.
     * Put this in extend class...
     *
     * @param array $arguments
     */
    public function getArguments()
    {
        return $this->arguments;
    }
}