```php
<?php

namespace App\Shortcodes;

use Ferrisbane\ShortDB\Shortcode;

class FontAwesome extends Shortcode
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
        ],
        'spin' => [
            'required' => false
        ],
        'pulse' => [
            'required' => false
        ],
        'size' => [
            'required' => false
        ],
        'fixed-width' => [
            'required' => false
        ],
        'list' => [
            'required' => false
        ],
        'pull' => [
            'required' => false
        ],
        'border' => [
            'required' => false
        ],
        'rotate' => [
            'required' => false
        ],
        'flip' => [
            'required' => false
        ],
    ];

    /**
     * Processes the shortcode.
     *
     * @param string
     */
    public function process(array $arguments)
    {
        $class = 'fa fa-'.$arguments['icon'];

        if ($arguments['spin']) {
            $class .= ' fa-spin';
        }

        if ($arguments['size']) {
            $class .= ' fa-'.$arguments['size'];
        }

        if ($arguments['fixed-width']) {
            $class .= ' fa-fw';
        }

        if ($arguments['list']) {
            $class .= ' fa-li';
        }

        if ($arguments['border']) {
            $class .= ' fa-border';
        }

        if ($arguments['pulse']) {
            $class .= ' fa-pulse';
        }

        if ($arguments['pull']) {
            $class .= ' fa-pull-'.$arguments['pull'];
        }

        if ($arguments['rotate']) {
            $class .= ' fa-rotate-'.$arguments['rotate'];
        }

        if ($arguments['flip']) {
            $class .= ' fa-flip-'.$arguments['flip'];
        }

        return '<i class="'.$class.'" aria-hidden="true"></i>';
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

}
```