<?php
require_once 'core/init.php';

if (Session::exists('home')) {
    echo '<p>' . Session::flash('home') . '</p>';
}

$user = new User();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php include 'includes/icons.php'; ?>
</head>
<body>
<h1>Password manager</h1>
<?php
if ($user->isLoggedIn()) { ?>
    <p>Hello <?php echo escape($user->data()->username); ?></p>
    <ul>
        <li><a href="update.php">Update your details</a></li>
        <li><a href="changepassword.php">Change your password</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
<?php } else { ?>
    <p>You need to <a href="login.php">Login</a> or <a href="register.php">Register</a>.</p>
<?php } ?>
</body>
</html>
