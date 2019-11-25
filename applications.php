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
                <li><a href="profile.php">My profile</a></li>
                <li><a href="applications.php">Applications</a></li>
                <li><a href="#">Replies</a></li>
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
            Application status
        </div>
        <div class="list-row">
            <div class="position first-text">Front-end Developer</div>
            <div class="app-status-sent last-text">Application sent</div>
        </div>
        <div class="list-row" id="personal-data">
            <div class="position first-text">.NET C# Developer</div>
            <div class="app-status-opened last-text">Application has been opened</div>
        </div>
        <div class="list-row">
            <div class="position first-text">C/C++ Controllers Programmer</div>
            <div class="app-status-replied last-text">Recruiter contacted you. <a href="#">Check your replies!</a></div>
        </div>
        
    </div>
</body>

<script src="script/main.js"></script>
<script src="script/burger.js"></script>

</html>