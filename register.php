<?php
require_once 'core/init.php';

if (Input::exists()) {
//        TODO Fix CSRF validation
//    if (Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array(
                'name' => 'Username',
                'required' => true,
                'min' => 2,
                'max' => 45,
                'unique' => 'users',
            ),
            'password' => array(
                'name' => 'Password',
                'required' => true,
                'min' => 6,
            ),
            'password_again' => array(
                'name' => 'Password Again',
                'required' => true,
                'matches' => 'password',
            ),
            'first_name' => array(
                'name' => 'First Name',
                'required' => true,
                'min' => 2,
                'max' => 45
            ),
            'last_name' => array(
                'name' => 'Last Name',
                'required' => true,
                'min' => 2,
                'max' => 45
            ),
        ));

        if ($validation->passed()) {
            $user = new User();
            $salt = Hash::salt(32);

            try {
                $user->create(array(
                    'username' => Input::get('username'),
                    'password' => Hash::make(Input::get('password'), $salt),
                    'first_name' => Input::get('first_name'),
                    'last_name' => Input::get('last_name'),
                    'salt' => $salt,
                    'created_at' => date('Y-m-d H:i:s'),
                ));

                Session::flash('home', 'You have been registered and can now login.');

                Redirect::to('index.php');
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            foreach ($validation->errors() as $error) {
                echo $error . ", <br>";
            }
        }
//    }
}
?>
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
        <form action="" method="post" class="ui form">
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>"
               autocomplete="off">
    </div>
    <div class="field">
        <label for="password">Choose a Password</label>
        <input type="password" name="password" id="password" value="" autocomplete="off">
    </div>

    <div class="field">
        <label for="password_again">Repeat Password</label>
        <input type="password" name="password_again" id="password_again" value="" autocomplete="off">
    </div>

    <div class="field">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" id="first_name" value="<?php echo escape(Input::get('first_name')); ?>"
               autocomplete="off">
    </div>

    <div class="field">
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo escape(Input::get('last_name')); ?>"
               autocomplete="off">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input class="ui button right floated" type="submit" name="Register" value="Register">
</form>
    </div>
</div>
</body>
</html>