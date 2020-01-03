<?php
session_start();
if ((!isset($_SESSION['logged_in'])) || ($_SESSION['logged_in'] == false))
{
    header('Location: index.php');
    exit();
}

require_once "php/replies.php";
$user_rep = $_SESSION['id_user'];
getRepliesData($user_rep);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recruitment System - Replies</title>
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" href="/font/stylesheet.css" type="text/css" charset="utf-8" />
</head>
<body>
    <nav>
        <div class="nav-bar">
            <div class="logo-nav">myCompany</div>
            <ul class="nav-links">
                <li id="menu">Menu</li>
                <li><a href="profile.php">My profile</a></li>
                <li><a href="applications.php">Applications</a></li>
                <li><a href="replies.php">Replies</a></li>
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
        <div class="small-title">
            Replies
        </div>
        <a href="#">
            <div class="list-row">
                <div class="first-text">Welcome in myCompany recruitment system!</div>
                <div class="msg-topic last-text">System Greeter</div>
                <div class="msg-date right-info">07-11-2019</div>
            </div>
        </a>
    </div>
</body>

<script src="script/main.js"></script>
<script src="script/burger.js"></script>
<script src="script/replies.js"></script>
<script src="script/loadReplies.js"></script>

</html>