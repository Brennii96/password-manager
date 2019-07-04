<?php

class Config
{
    public static function get($path = null)
    {
        if ($path) {
            $config = $GLOBALS['config'];
            $path = explode('/', $path);

            foreach ($path as $bits) {
                if (isset($config[$bits])) {
                    $config = $config[$bits];
                }
            }

            return $config;
        }
        return false;
    }
}