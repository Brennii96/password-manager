<?php

require_once 'core/init.php';
$user = new User();

if (!$user->isLoggedIn()) {
    Redirect::to('index.php');
}

if (Input::exists()) {
//    if (Token::check(Input::get('token'))) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
        'current-password' => array(
            'required' => true,
            'min' => 6,
            'name' => 'Current Password',
        ),
        'new-password' => array(
            'required' => true,
            'min' => 6,
            'name' => 'New Password',
        ),
        'password-repeat' => array(
            'required' => true,
            'min' => 6,
            'matches' => 'new-password',
            'name' => 'Repeat Password',
        )
    ));

    if ($validation->passed()) {
        if (Hash::make(Input::get('current-password'), $user->data()->salt) !== $user->data()->password) {
            echo 'Your Current password is wrong.';
        } else {
            $salt = Hash::salt(32);
            $user->update(array(
                'password' => Hash::make(Input::get('new-password'), $salt),
                'salt' => $salt,
            ));

            Session::flash('home', 'Your Password has been changed');
            Redirect::to('index.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.semanticui.min.css">
    <?php include_once 'includes/icons.php'; ?>
</head>
<body>
<?php include_once 'includes/header.php'; ?>
<div class="pusher">
    <div class="main ui container">
        <form action="" method="post" class="ui form">
            <div class="field">
                <label for="current-password">Current Password:</label>
                <input type="password" name="current-password" id="current-password" autocomplete="on">
            </div>
            <div class="field">
                <label for="new-password">New Password:</label>
                <input type="password" name="new-password" id="new-password" autocomplete="off">
            </div>
            <div class="field">
                <label for="password-repeat">Repeat Password:</label>
                <input type="password" name="password-repeat" id="password-repeat" autocomplete="off">
            </div>
            <div class="field">
                <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <input class="ui button right floated" type="submit" value="Change">
            </div>
        </form>
    </div>
</div>

</body>
</html>