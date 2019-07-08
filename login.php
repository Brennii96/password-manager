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
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Manager</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
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
        <h1>Login</h1>
        <div class="ui stacked segment">
        <form class="ui form" action="" method="post">
            <div class="field">
                <div class="ui left icon input">
                    <i class="user icon"></i>
                <input type="text" name="username" id="username" autocomplete="off" placeholder="Username">
                </div>
            </div>
            <div class="field">
                <div class="ui left icon input">
                    <i class="lock icon"></i>
                    <input type="password" name="password" id="password" autocomplete="off" placeholder="Password">
                </div>
            </div>

            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input class="ui fluid button submit" type="submit" value="Log In">
        </form>
        </div>
    </div>
</div>
</body>
</html>