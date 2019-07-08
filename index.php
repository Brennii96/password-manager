<?php
require_once 'core/init.php';
if (Session::exists('home')) {
    echo '<p>' . Session::flash('home') . '</p>';
}
$user = new User();
$password = new Password();
$encrypt = new Encryption();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Manager</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.semanticui.min.css">
    <?php include 'includes/icons.php'; ?>
</head>
<body>
<?php include_once 'header.php'; ?>
<div class="pusher">
    <div class="main ui container">
        <?php
        if ($user->isLoggedIn()) { ?>
            <h1>Password manager</h1>
            <p>Hello <?php echo escape($user->data()->username); ?></p>

            <table id="passwords" class="ui celled table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Username</th>
                    <th>Icon</th>
                    <th>Password</th>
                    <th>URL</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $x = 1;
                foreach ($password->show($user->data()->id) as $value) {
                    echo "<tr>
                <td>" . $value->title . "</td>
                <td>" . $value->username . "</td>
                <td><a target='_blank' href='" . $value->url . "'><img src='" . $value->icon . "' alt='" . $value->title . "'></a></td>
                <td>
                <div class='ui small fade reveal'>
                    <input class='visible content field' type='password' disabled value='" . $value->password . "'>
                    <input id='copypassword".$x++."' class='hidden content' type='text' disabled value='" . Encryption::secured_decrypt($value->password) . "'>
<!--                    <button class=\"ui button\" data-clipboard-action=\"copy\" data-clipboard-target='copypassword".$x++."'>Copy to Clipboard</button> -->
                </div>
                </td>
                <td><a target='_blank' href='" . $value->url . "'>" . $value->url . "</a></td>
                <td>" . $value->created_at . "</a></td>
                <td>
                <a class='ui left attached button positive' href='editentry.php/?id=" . $value->id . "'>Edit Entry</a>
                <a class='right attached ui button negative' href='delete.php/?id=" . $value->id . "'>Delete Entry</a>
                </td></tr>";
                }
                ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="ui text container">
                <h1>Password Manager</h1>
                <p>You need to <a href="login.php">Login</a> or <a href="register.php">Register</a>.</p>
            </div>
        <?php } ?>
    </div>
</div>
<?php include_once 'includes/scripts.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.4/clipboard.min.js"></script>
<script async>
    $(document).ready(function () {
        $('#passwords').DataTable();
    });
    new ClipboardJS('#copy-password2');
</script>
</body>
</html>
