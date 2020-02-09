<?php
session_start();

if ($_SESSION['id_role'] != 1) {
    header("Location: /index.php");
    exit();
}
require_once "php/connect.php";
require_once "php/getRole.php";
getRole($host, $db_user, $db_pass, $db_name);

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
            <li><a href="#">My profile</a></li>
            <li><a href="#">Applications</a></li>
            <li><a href="#">Replies</a></li>
            <li><a href="#">Sign out</a></li>
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
    <div class="small-title"> User added successfully! </div>
    <div class="list-row">
        <a href="admin_create_user.php">
        <div class="btn-add" id="btn-skill">
            <div class="btn-text">
                Add next user
            </div>
            <div class="btn-border">
                <div class="btn-icon">
                    +
                </div>
            </div>
        </div>
        </a>
    </div>
</div>
</body>
</html>
