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

require_once "php/applications.php";
require_once "php/FormsValidation.php";
$pos = new FormsValidation(true);
$role = $_SESSION['id_role'];
switch ($role) {
    case 1:
        $applications= '1=1';
        getApplicationsData($applications);
        break;
    case 2:
        $user_app = "u.id_user = '{$_SESSION['id_user']}'";
        getApplicationsData($user_app);
        break;
    case 3:
        $applications= '1=1';
        getApplicationsData($applications);
        break;
    case 4:
        $applications= '1=1';
        getApplicationsData($applications);
        break;
    case 5:
        $applications= '1=1';
        getApplicationsData($applications);
        break;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recruitment System - Applications</title>
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" href="/font/stylesheet.css" type="text/css" charset="utf-8" />
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
        <div class="small-title">
            Received Applications
        </div>
</body>

<script src="script/burger.js"></script>
<script src="script/main.js"></script>
<script src="script/applicationsWorkers.js"></script>
<script src="script/loadApplicationsWorkers.js"></script>
<script src="script/userRecognizer.js"></script>

</html>