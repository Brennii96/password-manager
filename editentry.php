<?php

require_once 'core/init.php';

$user = new User();
$password = new Password();

$editPassword = $password->find($_GET['id']);

if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

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
        $password->update(array(
            'title' => Input::get('title'),
            'user_id' => $editPassword,
            'username' => Input::get('username'),
            'url' => Input::get('url'),
            'icon' => $icon,
            'password' => Encryption::secured_encrypt(Input::get('password')),
            'created_at' => date('Y-m-d H:i:s'),
        ));

        Session::flash('home', 'Your entry has been updated.');
        Redirect::to('index.php');
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
    <link rel="stylesheet" href="assets/css/semantic.min.css"
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.semanticui.min.css"
    <?php include 'includes/icons.php'; ?>
</head>
<body>
<?php include_once 'includes/header.php'; ?>
<h1>Editing Entry</h1>
<p>Icon is downloaded automatically providing the url has one or is provided.</p>
<img src="<?php echo $editPassword->icon; ?>" class="img" alt="<?php echo $editPassword->title; ?>">
<form action="" method="post">
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
        <input type="url" name="url" id="url" value="<?php echo $editPassword->url; ?>">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="Update Entry">
</form>

<a class="button" href="../index.php">Go Back</a>

</body>
</html>