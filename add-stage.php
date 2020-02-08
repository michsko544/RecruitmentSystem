<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recruitment System - Add recruitment stage</title>
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
                    <label for="stage">Stage</label>
                    <input type="text" name="topic" class="msg-topic" value="" placeholder="e.g. Job interview">
                </div>
                <div class="form-row">
                    <label for="notes">Notes</label>
                    <textarea name="notes" placeholder="Type your notes here.."></textarea>
                </div>
            </div>
            
        </form>

    </div>
</body>

<script src="script/burger.js"></script>
<script src="script/main.js"></script>
<script src="script/userRecognizer.js"></script>
<script src="script/addStage.js"></script>
<script src="script/loadAddStage.js"></script>

</html>