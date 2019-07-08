<?php

require_once 'core/init.php';

if (Input::exists()) {
//    if (Token::check(Input::get('token'))) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'title' => array(
            'required' => true,
            'max' => 45,
            'name' => 'Title'
        ),
        'password' => array(
            'required' => true,
            'name' => 'Password'
        ),
        'password-repeat' => array(
            'required' => true,
            'matches' => 'password',
            'name' => 'Repeat Password'
        )
    ));
    if ($validation->passed()) {
        $password = new Password();

        $user = new User();

        $icon = Password::favicon(Input::get('url'));

        try {
            $password->create(array(
                'title'      => Input::get('title'),
                'username'   => Input::get('username'),
                'user_id'    => $user->data()->id,
                'password'   => Encryption::secured_encrypt(Input::get('password')),
                'url'        => Input::get('url'),
                'icon'       => $icon,
                'created_at' => date('Y-m-d H:i:s'),
            ));

            Session::flash('home', 'Your password has been added.');

            Redirect::to('index.php');
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }
}
//}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <title>Password Manager - Add Password</title>
    <?php include_once 'includes/icons.php'; ?>
    <style>
        .field-icon {
            float: right;
            margin-right: 25px !important;
            margin-top: -26px !important;
            position: relative;
            z-index: 2;
        }
    </style>
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
                Profile <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="./update.php">Update your details</a>
                    <a class="item" href="./changepassword.php">Change your Password</a>
                    <a class="item" href="./addpassword.php">Add Entry</a>
                    <a class="item" href="./logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pusher">
    <div class="main ui container">
        <form action="" method="post" class="ui form">
            <div class=="field">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="">
            </div>
            <div class="field">
                <label for="username">Username / Email:</label>
                <input type="text" name="username" id="username" value="">
            </div>
            <div class="field">
                <label for="password">Password:</label>
<!--                <input type="password" name="password" id="password" value="--><?php //echo Password::generate(22); ?><!--">-->
                <input type="password" name="password" id="password">
                <i toggle="#password" class="eye icon field-icon toggle-password"></i>
            </div>
            <div class="field">
                <label for="password-repeat">Repeat Password: </label>
                <input type="password" name="password-repeat" id="password-repeat" value="">
            </div>
            <div class="field">
                <label for="url">URL: </label>
                <input type="url" name="url" id="url" value="">
            </div>
            <div class="field">
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <input class="ui button right floated" type="submit" value="Add Password">
            </div>
        </form>
    </div>
</div>

<?php include_once 'includes/scripts.php'; ?>

<script>
    $(".toggle-password").click(function() {

        $(this).toggleClass("eye slash outline icon");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>
</body>
</html>