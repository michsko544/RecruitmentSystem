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
    <div id="sign-in">
        <div class="nav-bar">
            
        </div>
        <div class="input-wrapper">
            <div class="center-wrapper">  
            <form action="log_in.php" method="post">
                <label for="login">Login</label>
                <input type="text" name="login" placeholder="Username">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="**********">
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
    <a href="#"><div class="btn-sign-in">Sign in</div></a>
    <div id="index-container">
        <div class="heroimage"></div>
        <div class="center-wrapper">
            <div class="logo-wrapper">
                <div class="logo">myCompany</div>
                <div class="logo-text"><span style="color:#36C3D9;">Apply</span> to us easily</div>
                <div class="index-btn-container">
                    <a href="#"><div class="btn-dark">Join us!</div></a>
                </div>
            </div>
        </div>
    </div>
    
    
</body>
</html>