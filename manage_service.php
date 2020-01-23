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

require_once "php/AddPosition.php";
$position = new AddPosition(true, $host, $db_user, $db_pass, $db_name);
if (isset($_POST['position'])){
    $position->add();
}

if (isset($_GET['report'])){

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recruitment System - Manage service</title>
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
        <div class="page-title cyan-color">Add position</div>
        <form id="sform" action="" method="post">
            <div class="form-row">
                <label for="login">Position name</label>
                <input type="text" name="position" value="<?php $position->rememberValue('rem_position'); ?>" placeholder="Position" required>
                <div class="underline"></div>
                <?php
                $position->setError('err_position');
                ?>
            </div>
            <div class="form-row">
                <label for="description">Description</label>
                <textarea name="description" cols="35" rows="4" placeholder="e.g.  programming, data analysing, network designing, microprocessors coding"><?php $position->rememberValue('rem_description'); ?></textarea>
                <div class="underlineTA"></div>
                <?php
                $position->setError('err_description');
                ?>
            </div>

            <div class="form-btn-wrapper">
                <input type="submit" value="Create" class="btn btn-cyan" id="btn-sign-up-1">
            </div>
        </form>

        Generate report
    </div>
</div>
</body>
<script src="script/burger.js"></script>
<script src="script/main.js"></script>
<script src="script/user-data-handler.js"></script>
<script src="script/input-file.js"></script>
<script src="script/sign-up.js"></script>
<script src="script/userRecognizer.js"></script>
</html>
