<?php
session_start();
if ((!isset($_SESSION['logged_in'])) || ($_SESSION['logged_in'] == false))
{
    header('Location: index.php');
    exit();
}
require_once "php/connect.php";
require_once "php/getRole.php";
getRole($host, $db_user, $db_pass, $db_name);
require_once "php/FormsValidation.php";

$inst = new FormsValidation(true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recruitment System - Admin panel</title>
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" href="/font/stylesheet.css" type="text/css" charset="utf-8" />
    <link href="css/jquery-ui.css" rel="stylesheet" />
    <script src="script/jquery-1.11.1.js"></script>
    <script src="script/jquery-ui.js"></script>

</head>
<body>
<nav>
    <div class="nav-bar">
        <div class="logo-nav">myCompany</div>
        <ul class="nav-links">
            <li id="menu">Menu</li>
            <li><a href="admin_main.php">Main page</a></li>
            <li><a href="admin_create_user.php">Add user</a></li>
            <li><a href="admin_pick_role.php">Pick role</a></li>
            <li><a href="php/log_in/log_out.php">Sign out</a></li>
        </ul>
        <div id="btn-burger" class="btn-nav">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>
    </div>
    <div id="nav-help"></div>
</nav>

<div id="container">
    <div id="sign-up-1" class="sign-up-wrapper">
        <div class="page-title cyan-color">Add user</div>
<form id="sform" action="php/admin/create_user.php" method="post">
    <div class="form-row">
        <label for="login">Login</label>
        <input type="text" name="login" value="<?php $inst->rememberValue('rem_username'); ?>" placeholder="Username" required>
        <div class="underline"></div>
        <?php
        $inst->setError('err_username');
        ?>
    </div>
    <div class="form-row">
        <label for="first-name">First name</label>
        <input type="text" name="first-name" value="<?php $inst->rememberValue('rem_first_name'); ?>" placeholder="John" required>
        <div class="underline"></div>
        <?php
        $inst->setError('err_first_name');
        ?>
    </div>
    <div class="form-row">
        <label for="last-name">Last name</label>
        <input type="text" name="last-name" value="<?php $inst->rememberValue('rem_last_name'); ?>" placeholder="Smith" required>
        <div class="underline"></div>
        <?php
        $inst->setError('err_last_name');
        ?>
    </div>
    <div class="form-row">
        <label for="password-one">Password</label>
        <input type="password" name="password-one" value="<?php $inst->rememberValue('rem_password_one'); ?>" placeholder="●●●●●●●●●●" required>
        <div class="underline"></div>
    </div>
    <div class="form-row">
        <label for="password-two">Password</label>
        <input type="password" name="password-two" value="<?php $inst->rememberValue('rem_password_two'); ?>" placeholder="●●●●●●●●●●" required>
        <div class="underline"></div>
        <?php
        $inst->setError('err_password');
        ?>
    </div>
    <div class="form-row">
        <label for="role">Role</label>
        <select name="role">
            <?php
            // Pick data from DB
            $query = "SELECT name_role FROM roles";
            $inst->pickDataFromDB($query, $host, $db_user, $db_pass, $db_name);
            ?>
        </select>
    </div>
    <div class="form-btn-wrapper">
        <input type="submit" value="Create" class="btn btn-cyan" id="btn-sign-up-1">
    </div>
</form>
    </div>
</div>
</body>
<script src="script/main.js"></script>
<script src="script/burger.js"></script>
<script src="script/user-data-handler.js"></script>
<script src="script/input-file.js"></script>
<script src="script/sign-up.js"></script>
</html>
