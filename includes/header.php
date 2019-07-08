<?php
if ($user->isLoggedIn()) { ?>

    <div class="ui large top fixed hidden menu">
        <div class="ui container">
            <a href="./index.php" class="header item">
                <img class="logo" src="./assets/icons/logo.png">
                Password Manager
            </a>
            <a class="active item" href="./index.php">Home</a>
            <div class="right menu">
                <div class="ui simple dropdown item">
                    Profile <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item" href="./update.php">Update your details</a>
                        <a class="item" href="./changepassword.php">Change your Password</a>
                        <a class="item" href="./addpassword.php">Add Entry</a>
                        <a class="item" href="./logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <div class="ui vertical inverted sidebar menu">
        <a class="active item">Home</a>
        <a class="item">Work</a>
        <a class="item">Company</a>
        <a class="item">Careers</a>
        <a class="item">Login</a>
        <a class="item">Signup</a>
    </div>
<?php } else { ?>
    <div class="ui large top fixed hidden menu">
        <div class="ui container">
            <a href="./index.php" class="header item">
                <img class="logo" src="./assets/icons/logo.png">
                Password Manager
            </a>
            <a class="active item" href="./index.php">Home</a>
        </div>
    </div>
<?php } ?>