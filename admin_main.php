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

<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
<!-- TODO generalnie to tylko taki zamysł jak by to mogło wyglądać, więc najlepiej pytaj o co mi tu chodziło -->
<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->


    <div class="small-title"> Admin panel </div>
    <div class="admin-info">
        <div class="element">Server time:</div>
        <div class="element">Visits:</div>
        <div class="element">Users:</div>
        <div class="element">Applicants:</div>
    </div>
    
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
    <div class="list-row hide" id="">
        <div id="logs" class="element-wrapper">
            
        </div>
    </div>

    <a href="pdf/rep.php" target="_blank">
        <div class="list-row bottom-row" id="btn-report">
            <div class="btn-add ">
                <div class="btn-border">
                    <div class="btn-icon">
                        +
                    </div>
                </div>
                <div class="btn-text">
                        Generate report
                </div>
            </div>
        </div>
    </a>

</div>
</body>
<!-- nie wiem czy te wszystkie są potrzebne -->
<script src="script/burger.js"></script>
<script src="script/main.js"></script>
<script src="script/profile.js"></script>
<script src="script/log.js"></script>
<script src="script/loadLogs.js"></script>
<script src="script/userRecognizer.js"></script>

</html>



