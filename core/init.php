<?php
session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host'     => '127.0.0.1',
        'username' => 'brendan',
        'password' => '',
        'db'       => 'password_manager'
    ),
    'remember' => array(
        'cookie_name'   => 'hash',
        'cookie_expiry' => 14440,
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name'   => 'token'
    ),
    'keys' => array(
        'first_key'  => 'WXXJyC0svWPdkGaF2/o506bNSiG4rt7AYkCVnqarYlM=',
        'second_key' => 'xYm30k9sDX4ssNCWy7W8OIpQ2/Cfg/ocf2AZWqg5CfUAtjO6gYr47Jjy+3XA6+BBGwqLQB4AB/0ajZ4RGuW2hQ==',
    )
);

spl_autoload_register(function ($class) {
    require_once 'classes/' . $class . '.php';
});

require_once 'functions/sanitize.php';

// TODO Remember me functionality not working correctly stores hash and expiry correctly. Possible syntax error
//if (Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
//    echo $hash = Cookie::get(Config::get('remember/cookie_name'));
//    $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));
//
//    if ($hashCheck->count()) {
//        $user = new User($hashCheck->first()->user_id);
//        $user->login();
//    }
//}