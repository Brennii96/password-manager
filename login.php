<?php
require_once 'core/init.php';

if (Input::exists()) {
//    if (Token::check(Input::get('token'))) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'username' => array(
            'required' => true,
            'name' => 'Username'
        ),
        'password' => array(
            'required' => true,
            'name' => 'Password'
        ),
    ));
    if ($validation->passed()) {
        $user = new User();

        $remember = (Input::get('remember') === 'on') ? true : false;
        $login = $user->login(Input::get('username'), Input::get('password'), $remember);

        if ($login) {
            Redirect::to('index.php');
        } else {
            echo '<p>Login failed</p>';
        }
    } else {
        foreach ($validation->errors() as $error) {
            echo $error . "<br>";
        }
    }
//    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Manager</title>
    <link rel="stylesheet" href="assets/css/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.semanticui.min.css">
    <?php include_once 'includes/icons.php'; ?>
</head>
<body>
<div class="ui large top fixed hidden menu">
    <div class="ui container">
        <a href="./index.php" class="header item">
            <img class="logo" src="./assets/icons/logo.png">
            Password Manager
        </a>
        <a class="active item" href="./index.php">Home</a>

        <div class="right menu">
            <div class="ui simple dropdown item">
                Login/Register<i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="./login.php">Login</a>
                    <a class="item" href="./register.php">Register</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pusher">
    <div class="main ui container">
        <form class="ui form" action="" method="post">
            <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" autocomplete="off">
    </div>

            <div class="field">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" autocomplete="off">
    </div>

            <div class="field">
        <label for="remember">Remember Me
            <input type="checkbox" name="remember" id="remember">
        </label>
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="Log In">
</form>
    </div>
</div>
</body>
</html>