<?php
session_start();
if ((!isset($_SESSION['logged_in'])) || ($_SESSION['logged_in'] == false))
{
    header('Location: index.php');
    exit();
}
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


<!-- TODO show website stats, restrict website , generate report -->
    <div class="small-title"> Admin panel </div> <!-- TODO wyśrodkować -->
    <div class="element-wrapper">Server time</div> <!-- TODO add server time -->
    <div class="element-wrapper">Last week stats</div> <!-- TODO add stats -->
    <div> New users: </div>
    <div> New applications: </div>
    <div> Visits: </div>
    <div> Most popular position: </div>
    <div> Rejected applications: </div>
    <div> Accepted applications: </div> <!-- TODO maybe to report / manager's main page -->

    <div> Users: </div>
    <div> Applicants: </div>
    <div> : </div>
    <div class="element-wrapper"><a href="php/admin/restrict_access.php">Shut down service</a></div>
    <div class="element-wrapper"><a href="php/generateReport.php">Generate report</a></div>


</div>
</body>
<script src="script/main.js"></script>
<script src="script/burger.js"></script>
<script src="script/user-data-handler.js"></script>
<script src="script/input-file.js"></script>
<script src="script/sign-up.js"></script>
</html>



