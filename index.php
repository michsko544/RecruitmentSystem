<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recruitment System</title>
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" href="/font/stylesheet.css" type="text/css" charset="utf-8" />
</head>
<body>
    <div id="sign-in--hidden">
        <div class="nav-bar">
            <div class="logo-nav">myCompany</div>
            <div id="btn-exit" class="btn-nav"></div>
        </div>
        <div class="input-wrapper">
            <div class="center-wrapper">  
            <form action="log_in.php" method="post">
                <div class="sign-in-row">
                    <label for="login">Login</label>
                    <input type="text" name="login" placeholder="Username">
                </div>
                <div class="sign-in-row">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="●●●●●●●●●●">
                </div>
                <?php
                if(isset($_SESSION['error']))
                {
                    echo $_SESSION['error'];
                }
                ?>
                <div class="form-btn-wrapper">
                    <input type="submit" value="Sign in">
                </div>
            </form>
            </div>
        </div>
    </div>
    <div id="btn-sign-in">Sign in</div>
    <div id="index-container">
        <div class="heroimage"></div>
        <div class="center-wrapper">
            <div class="logo-wrapper">
                <div class="logo-main">myCompany</div>
                <div class="logo-text"><span style="color:#36C3D9;">Apply</span> to us easily</div>
                <div class="index-btn-container">
                    <a href="#"><div class="btn btn-dark">Join us!</div></a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="script/index.js"></script>
</body>
</html>