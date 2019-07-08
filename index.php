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
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Manager</title>
    <link rel="stylesheet" href="assets/css/semantic.min.css"
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.semanticui.min.css"
    <?php include 'includes/icons.php'; ?>
</head>
<body>
<?php include 'includes/header.php'; ?>
<h1>Password manager</h1>
<?php
if ($user->isLoggedIn()) { ?>
    <p>Hello <?php echo escape($user->data()->username); ?></p>
    <ul>
        <li><a href="update.php">Update your details</a></li>
        <li><a href="changepassword.php">Change Your Profile Password</a></li>
        <li><a href="addpassword.php">Add Password</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

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
        foreach ($password->show($user->data()->id) as $value) {
            echo "<tr>
                <td>" . $value->title . "</td>
                <td>" . $value->username . "</td>
                <td><a target='_blank' href='" . $value->url . "'><img src='" . $value->icon . "' alt='" . $value->title . "'></a></td>
                <td><div class='ui small fade reveal'>
                    <input class='visible content' type='password' disabled value='" . $value->password . "'>
                    <input class='hidden content' type='text' disabled value='" . Encryption::secured_decrypt($value->password) . "'>
                </div></td>
                <td><a target='_blank' href='" . $value->url . "'>" . $value->url . "</a></td>
                <td>" . $value->created_at . "</a></td>
                <td><a href='editentry.php/?id=" . $value->id . "'>Edit Entry</a></td></tr>";
        }
        ?>
        </tbody>
    </table>

<?php } else { ?>
    <p>You need to <a href="login.php">Login</a> or <a href="register.php">Register</a>.</p>
<?php } ?>


<?php include_once 'includes/scripts.php'; ?>
<script async>
    $(document).ready(function () {
        $('#passwords').DataTable();
    });
</script>
</body>
</html>
