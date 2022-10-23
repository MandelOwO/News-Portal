<?php

class App
{
    public static function init()
    {
        spl_autoload_register([
            __CLASS__,
            'load'
        ]);
    }

    public static function load($className)
    {
        require_once 'model/'.$className.'.php';
    }
}

