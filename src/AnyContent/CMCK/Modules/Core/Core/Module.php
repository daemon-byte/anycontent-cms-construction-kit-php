<?php

namespace AnyContent\CMCK\Modules\Core\Core;

use AnyContent\CMCK\Modules\Core\Application\Application;

abstract class Module
{

    protected $defaultOptions = array();

    protected $options = array();


    public function init(Application $app, $options = array())
    {

        $this->options = array_merge($this->defaultOptions, $options);

    }


    public function run(Application $app)
    {

    }


    public function preRender(Application $app)
    {

    }


    public function getOption($key, $default = null)
    {
        if (array_key_exists($key, $this->options))
        {
            return $this->options[$key];
        }

        return $default;
    }
}