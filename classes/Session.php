<?php

class Session
{
    // Check if token exists in session
    public static function exists($name)
    {
        return (isset($_SESSION[$name])) ? true : false;
    }

    // Set token in session
    public static function put($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    // Get the token from session
    public static function get($name)
    {
        return $_SESSION[$name];
    }

    // Delete token from session if exists
    public static function delete($name)
    {
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }
}