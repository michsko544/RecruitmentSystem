<?php
if ((isset($_SESSION['logged_in'])) && ($_SESSION['logged_in'] == true))
{
    if ($_SESSION['role_name'] == 'recruit')
    {
        header('Location: accounts/recruit_account.php');
    }
    elseif ($_SESSION['role_name'] == 'manager')
    {
        header('Location: accounts/manager_account.php');
    }
    elseif ($_SESSION['role_name'] == 'assistant')
    {
        header('Location: accounts/assistant_account.php');
    }
    elseif ($_SESSION['role_name'] == 'recruiter')
    {
        header('Location: accounts/recruiter_account.php');
    }
    elseif ($_SESSION['role_name'] == 'admin')
    {
        header('Location: accounts/admin_panel.php');
    }
    else
    {
        $_SESSION['error'] = '<span> Internal error </span>';
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recruitment System - Register</title>
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" href="/font/stylesheet.css" type="text/css" charset="utf-8" />
</head>
<body>
    <div id="sign-in--hidden">
        <div class="nav-bar">
            <div class="logo-nav">myCompany</div>
            <?php
            if(isset($_SESSION['error']))
            {
                echo $_SESSION['error'];
            }
            ?>
            <div id="btn-exit" class="btn-nav">
                <div class="line1"></div>
                <div class="line2"></div>
            </div>
        </div>
        <div class="input-wrapper">
            <div class="center-wrapper">  
            <form action="php/log_in/log_in.php" method="post">
                <div class="sign-in-row">
                    <label for="login">Login</label>
                    <input type="text" name="login" placeholder="Username">
                    <div class="underline"></div>
                </div>
                <div class="sign-in-row">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="●●●●●●●●●●">
                    <div class="underline"></div>
                    <?php
                    if(isset($_SESSION['error']))
                    {
                        echo $_SESSION['error'];
                    }
                    ?>
                </div>

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
                    <a href="sign_up.php"><div class="btn btn-dark">Join us!</div></a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="script/main.js"></script>
<script src="script/index.js"></script>

</html>