```<?php

namespace App\Shortcodes;

use Ferrisbane\ShortDB\ShortDB;

class FontAwesome extends ShortDB
{

    /**
     * The shortcode.
     *
     * @var string
     */
    protected $code = 'fa';

    /**
     * A description of what the shortcode will output.
     *
     * @var string
     */
    protected $description = 'Output a font awesome icon';

    /**
     * Arguments required to use the shortcode.
     *
     * @var array
     */
    protected $arguments = [
        'icon' => [
            'required' => true
        ]
    ];

    /**
     * Process a shortcode instance.
     *
     * @param array $arguments
     */
    public function process(array $arguments)
    {
        return '<i class="fa-' . $arguments['icon'] . '"></i>';
    }

    public function getJavascriptDescriptor()
    {
        return [
            'icon' => 'fa-icons',
            'type' => 'dropdown',
            'options' => $this->getOptions(),
            'placeholder' => '<span style="display: inline-block;background: blue;">(Fontawesome Icon Goes Here)</span>'
        ];
    }

    public function getOptions()
    {
        return [
            'icon' => [
                'glass' => 'Description',
                'music' => 'Description',
                'search' => 'Description',
                'envelope-o' => 'Description',
                'heart' => 'Description',
                'star' => 'Description',
                'star-o' => 'Description',
                'user' => 'Description',
                'film' => 'Description',
            ]
        ];
    }

}```