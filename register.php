<?php
require_once 'core/init.php';
if (Input::exists()) {
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
        echo 'Passed';
    } else {
        foreach ($validation->errors() as $error) {
            echo $error . ", <br>";
        }
    }
}
?>
<form action="" method="post">
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

    <input type="submit" name="Register">
</form>