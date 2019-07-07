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

        $salt = Hash::salt(32);

        $icon = Password::favicon(Input::get('url'));

        try {
            $password->create(array(
                'title' => Input::get('title'),
                'username' => Input::get('username'),
                'user_id' => $user->data()->id,
                'password' => Hash::make(Input::get('password'), $salt),
                'url' => Input::get('url'),
                'icon' => $icon,
                'salt' => $salt,
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

<form action="" method="post">
    <div class="field">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="">
    </div>
    <div class="field">
        <label for="username">Username / Email:</label>
        <input type="text" name="username" id="username" value="">
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
        <input type="url" name="url" id="url" value="">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="Add Password">
</form>