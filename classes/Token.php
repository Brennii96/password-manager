<?php

//TODO fix
class Token
{
    // Generate the token
    public static function generate()
    {
        return Session::put('session/token_name', md5(uniqid()));
    }

    // Check if token exists and if is already in use
    public static function check($token)
    {
        $tokenName = Config::get('session/token_name');

        if (Session::exists($tokenName) && $token === Session::get($tokenName)) {
            Session::delete($tokenName);
            return true;
        }
        return false;
    }
}