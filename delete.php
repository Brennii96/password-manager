<?php

require_once 'core/init.php';

$password = new Password();

$password->delete($_GET['id']);

Redirect::to('/index.php');
Session::flash('home', 'Your Password has been deleted successfully');