<?php

require_once 'core/init.php';

$user = new User();
$password = new Password();

if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

$editPassword = $password->find($_GET['id']);


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

    $icon = Password::favicon(Input::get('url'));

    if ($validation->passed()) {
        try {
            $password->update(array(
                'title' => Input::get('title'),
                'user_id' => $user->data()->id,
                'username' => Input::get('username'),
                'url' => Input::get('url'),
                'icon' => $icon,
                'password' => Encryption::secured_encrypt(Input::get('password')),
                'created_at' => date('Y-m-d H:i:s'),
            ));

            Session::flash('home', 'Your entry has been updated.');
            Redirect::to('../index.php');
        } catch (Excetption $e) {
            die($e->getMessage());
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
    <link rel="stylesheet" href="../assets/css/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.semanticui.min.css">
    <?php include_once 'includes/icons.php'; ?>
</head>
<body>
<div class="ui large top fixed hidden menu">
    <div class="ui container">
        <a href="../index.php" class="header item">
            <img class="logo" src="./assets/icons/logo.png">
            Password Manager
        </a>
        <a class="active item" href="../index.php">Home</a>
        <div class="right menu">
            <div class="ui simple dropdown item">
                Profile <i class="dropdown icon"></i>
                <div class="menu">
                    <a class="item" href="../update.php">Update your details</a>
                    <a class="item" href="../changepassword.php">Change your Password</a>
                    <a class="item" href="../addpassword.php">Add Entry</a>
                    <a class="item" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pusher">
    <div class="main ui container">
        <h1>Editing Entry</h1>
        <p>Icon is downloaded automatically providing the url has one or is provided. If hotlinking is enabled the icon
            the icon won't show.</p>
        <form action="" method="post" class="ui form">
            <div class="field">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" value="<?php echo $editPassword->title; ?>">
            </div>
            <div class="field">
                <label for="username">Username / Email:</label>
                <input type="text" name="username" id="username" value="<?php echo $editPassword->username; ?>">
            </div>
            <div class="field">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" value="">
            </div>
            <div class="field">
                <label for="password-repeat">Repeat Password: </label>
                <input type="password" name="password-repeat" id="password-repeat" value="">
            </div>
            <div class="field">
                <label for="url">URL: </label>
                <input type="text" name="url" id="url" value="<?php echo $editPassword->url; ?>">
            </div>

            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input class="ui button right floated" type="submit" value="Update Entry">
        </form>
        <a class="button" href="../index.php">Go Back</a>
    </div>
</div>
</body>
</html>