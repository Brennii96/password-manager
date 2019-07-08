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
        'first_name' => array(
            'name' => 'First Name',
            'required' => true,
            'min' => 2,
            'max' => 20
        ),
        'last_name' => array(
            'name' => 'Last Name',
            'required' => true,
            'min' => 2,
            'max' => 20
        ),
    ));
    if ($validation->passed()) {
        try {
            $user->update(array(
                'first_name' => Input::get('first_name'),
                'last_name' => Input::get('last_name'),
            ));
            Session::flash('home', 'Your details have been successfully updated.');
            Redirect::to('index.php');
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
<?php include_once 'header.php'; ?>
<div class="pusher">
    <div class="main ui container">
        <h1>Password manager</h1>
        <?php
        if ($user->isLoggedIn()) { ?>
        <form action="" method="post" class="ui form">
            <div class="field">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" value="<?php echo escape($user->data()->first_name); ?>">
            </div>
            <div class="field">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="<?php echo escape($user->data()->last_name); ?>">
            </div>

            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input class="ui button right floated" type="submit" value="Update">
        </form>
    </div>
</div>
<?php } else
    Redirect::to('index.php');
?>
</body>
</html>
