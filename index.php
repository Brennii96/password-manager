<?php
require_once 'core/init.php';

if (Session::exists('home')) {
    echo '<p>' . Session::flash('home') . '</p>';
}

$user = new User();
$password = new Password();
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

    <table id="passwords">
        <thead>
        <tr>
            <th>Title</th>
            <th>Username</th>
            <th>Icon</th>
            <th>Password</th>
            <th>URL</th>
            <th>Created At</th>
        </tr>
        </thead>
    </table>


<?php } else { ?>
    <p>You need to <a href="login.php">Login</a> or <a href="register.php">Register</a>.</p>
<?php } ?>

<?php include_once 'includes/scripts.php'; ?>
<script>

    //TODO Fix this using https://datatables.net/examples/data_sources/js_array.html
    $(document).ready(function () {
        $('#passwords').DataTable({
            columns: [
                <?php
                foreach ($password->show($user->data()->id) as $value) {
                    echo "{ title: '" . $value->title . "'},";
                    echo "{ username: '" . $value->username . "'},";
                    echo "{ icon: '" . $value->icon . "'},";
                    echo "{ password: '" . $value->password . "' },";
                    echo "{ url: '" . $value->url . "'},";
                    echo "{ created_at: '" . $value->created_at . "'},";
                }
                ?>
            ]
        });
    });
</script>
</body>
</html>
