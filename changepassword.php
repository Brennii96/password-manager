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
<form action="" method="post">
    <div class="field">
        <label for="current-password">Current Password:</label>
        <input type="password" name="current-password" id="current-password" autocomplete="on">
    </div>
    <div class="field">
        <label for="new-password">New Password:</label>
        <input type="password" name="new-password" id="new-password" autocomplete="on">
    </div>
    <div class="field">
        <label for="password-repeat">Repeat Password:</label>
        <input type="password" name="password-repeat" id="password-repeat" autocomplete="on">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="Change">
</form>
