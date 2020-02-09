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
    <div class="small-title"> Choose role </div> <!-- TODO wyśrodkować -->
    <div class="element-wrapper"><a href="php/admin/choose_role.php?role=applicant">Applicant</a></div>
    <div class="element-wrapper"><a href="php/admin/choose_role.php?role=recruiter">Recruiter</a></div>
    <div class="element-wrapper"><a href="php/admin/choose_role.php?role=manager">Manager</a></div>
    <div class="element-wrapper"><a href="php/admin/choose_role.php?role=assistant">Assistant</a></div>
</div>
</body>
<script src="script/burger.js"></script>
<script src="script/main.js"></script>
<script src="script/user-data-handler.js"></script>
<script src="script/input-file.js"></script>
<script src="script/sign-up.js"></script>
<script src="script/userRecognizer.js"></script>

</html>

