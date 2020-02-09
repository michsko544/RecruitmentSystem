<?php
session_start();
require_once "php/chat.php";
require_once "php/FormsValidation.php";
require_once "php/connect.php";
require_once "php/getRole.php";
getRole($host, $db_user, $db_pass, $db_name);
$err = new FormsValidation(true);
$usr = $_GET['uid'];
$aid = $_GET['aid'];
getUserName($aid, $usr);
if (isset($_POST['message-field']))
{
    if (isset($_POST['topic'])){
        $mess = $_POST['message-field'];
        $topic = $_POST['topic'];
        addNewConv($mess, $topic, $usr);
    } else {
        $mess = $_POST['message-field'];
        addMessage($mess, $usr);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recruitment System - Write message</title>
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
        <form action="" method="post">
        <div class="small-title"></div>
            <div class="message-wrapper">
                <div class="form-row">
                    <label for="msg-topic">Topic</label>
                    <div class="msg-topic">Reply: FrontEnd interview</div>
                </div>
                <div class="form-row">
                    <?php $err->setError("err_message") ?>
                    <label for="message-field">Message</label>
                    <textarea name="message-field" placeholder="Type your message here.."></textarea>
                </div>
            </div>
            
        </form>

    </div>
</body>

<script src="script/burger.js"></script>
<script src="script/main.js"></script>
<script src="script/userRecognizer.js"></script>
<script src="script/writeMsg.js"></script>
<script src="script/loadWriteMsg.js"></script>

</html>