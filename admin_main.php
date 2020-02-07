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

<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
<!-- TODO generalnie to tylko taki zamysł jak by to mogło wyglądać, więc najlepiej pytaj o co mi tu chodziło -->
<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->


    <div class="small-title"> Admin panel </div>
    <!-- TODO wyśrodkować -->
    <div class="element-wrapper">Server time: </div> <!-- TODO add server time -->

    <div> Visits: </div>

    <div> Users: </div>
    <div> Applicants: </div>
    <div class="list-row">
        <h4 class="title-element">Error log</h4>
        <!-- wyświetlanie listy errorów z json/log.json" -->
        <div class="btn-element">
            <div class="btn-unwrap">
                <div class="line1"></div>
                <div class="line2"></div>
            </div>

        </div>
    </div>

    <div class="element-wrapper"><a href="pdf/rep.php" target="_blank">Generate report</a></div>
</div>
</body>
<!-- nie wiem czy te wszystkie są potrzebne -->
<script src="script/burger.js"></script>
<script src="script/main.js"></script>
<script src="script/user-data-handler.js"></script>
<script src="script/sign-up.js"></script>
<script src="script/profile.js"></script>
<script src="script/loadProfile.js"></script>
<script src="script/userRecognizer.js"></script>

</html>



