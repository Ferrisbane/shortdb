<?php

namespace Ferrisbane\ShortDB;

abstract class Shortcode
{
    /**
     * @var array
     */
    protected $arguments;

    /**
     * @var string $code
     */
    protected $code;

    /**
     * Processes the shortcode
     *
     * @param array $arguments
     * @return mixed
     */
    abstract public function process(array $arguments);

    /**
     * Returns the shortcode.
     * Put this in extend class...
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Returns the arguments for this shortcode.
     * Put this in extend class...
     *
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Returns the arguments for this shortcode.
     *
     * @return array
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
     *
     * @return array
     */
    public function getRequiredArguments()
    {
        $requirements = [];

        foreach ($this->arguments as $key => $argument) {
            if (isset($argument['required']) && $argument['required'] === true) {
                $requirements[$key] = $argument['required'];
            }
        }

        return $requirements;
    }
}