<?php
session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'brendan',
        'password' => '',
        'db' => 'password_manager'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 14440,
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);

spl_autoload_register(function ($class) {
    require_once 'classes/' . $class . '.php';
});

require_once 'functions/sanitize.php';