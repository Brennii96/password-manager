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

    // Flash message
    public static function flash($name, $string = '')
    {
        if (self::exists($name)) {
            $session = self::get($name);
            self::delete($name);
            return $session;
        } else {
            self::put($name, $string);
        }
        return '';
    }
}