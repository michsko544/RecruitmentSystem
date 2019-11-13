<?php
session_start();
?>

<!--
##########################
dostosuj do swoich potrzeb
##########################
-->
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
<div class="nav-bar">
    <div class="logo-nav">myCompany</div>
</div>

<div class="sign-up-container">
    <div id="sign-up-1" class="sign-up-wrapper">
        <form id="sform-1" action="/php/sign_up/sign_up_system.php" method="post">
    <!-- TODO Find your job by joining us!-->
        <div class="form-row">
            <label for="login">Login</label>
            <input type="text" name="login" placeholder="Username" required>
        </div>
        <div class="form-row">
            <label for="e-mail">E-mail</label>
            <input type="email" name="e-mail" placeholder="john.smith@example.com" required>
        </div>
        <div class="form-row">
            <label for="password-one">Password</label>
            <input type="password" name="password-one" placeholder="********" required>
        </div>
        <div class="form-row">
            <label for="password-two">Password</label>
            <input type="password" name="password-two" placeholder="********" required>
        </div>    
        <div class="form-row">
            <label for="terms-of-use">Terms and Privacy Policy</label>
            <input type="checkbox" required> I agree to <a href="terms-of-use-contents.php">Terms</a> and <a href="privacy-policy-contents.php">Privacy Policy</a>.
        </div>
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <div class="form-btn-wrapper">
            <input type="submit" value="Sign in" class="btn btn-cyan" id="btn-sign-up-1">
        </div>
        </form>
    </div>

    <div id="sign-up-2--hidden" class="sign-up-wrapper">
        <form id="sform-2" action="#" method="post">
        <!-- TODO A few more things about you, employers need to know-->
        <!-- TODO Step 1/4-->
        <div class="form-row">
        <label for="first-name">First name</label>
        <input type="text" name="first-name" placeholder="John" required>
        </div>
        <div class="form-row">
        <label for="last-name">Last name</label>
        <input type="text" name="last-name" placeholder="Smith" required>
        </div>
        <div class="form-row">
        <label for="phone-num">Phone number</label>
        <input type="tel" name="phone-num" placeholder="600 700 800"
        pattern="[0-9]{3} [0-9]{3} [0-9]{3}" required>
        </div>
        <div class="form-row">
        <label for="city">Your city</label>
        <input type="text" name="city" placeholder="London" required>
        </div>
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <div class="form-btn-wrapper">
            <input type="submit" value="Next" class="btn btn-dark" id="btn-sign-up-2">
        </div>
        </form>
    </div>

    <div id="sign-up-3--hidden" class="sign-up-wrapper">
        <form id="sform-3" action="#" method="post">
        <!-- TODO What's your experience?-->
        <!-- TODO Step 2/4-->
        <div class="form-row">
        <label for="job-title">Job title</label>
        <input type="text" name="job-title" placeholder="Waiter" required>
        </div>
        <div class="form-row">
        <label for="employer">Employer</label>
        <input type="text" name="employer" placeholder="Italian Restaurant London" required>
        </div>
        <div class="form-row">
        <label for="start-end-date">Start & End date</label>
        <input type="date" name=start-date" placeholder="Oct, 2019" required>
        <input type="date" name="end-date" placeholder="Nov, 2019" required>
        </div>
        <div class="form-row">
        <label for="job-city">City</label>
        <input type="text" name="job-city" placeholder="London" required>
        </div>
        <div class="form-row">
        <label for="description">Description</label>
        <textarea name="description" cols="35" rows="5" placeholder="Waitressing, preparing venue for events, taking care of restaurant clarity ..."></textarea>
        </div>
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <!-- TODO Add employment btn -->
        <div class="form-btn-wrapper">
            <input type="submit" value="Next" class="btn btn-dark" id="btn-sign-up-3">
        </div>
        </form>
    </div>

    <div id="sign-up-4--hidden" class="sign-up-wrapper">
        <form id="sform-4" action="#" method="post">
        <!-- TODO Skills & Education-->
        <!-- TODO Step 3/4-->
        <div class="form-row">
        <label for="languages">Languages</label>
        <input type="text" name="languages" placeholder="German" required>
        </div>
        <div class="form-row">
        <label for="skills">Skills</label>
        <input type="text" name="skills" placeholder="Marketing" required>
        </div>
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <!-- TODO Add skill btn -->
        <div class="form-row">
        <label for="school">School</label>
        <input type="text" name="school" placeholder="Silesian University of Science" required>
        </div>
        <div class="form-row">
        <label for="specialization">Specialization</label>
        <input type="text" name="specialization" placeholder="Teleinformatics" required>
        </div>
        <div class="form-row">
        <label for="start-end-date">Start & End date</label>
        <input type="date" name=start-date" placeholder="Oct, 2019" required>
        <input type="date" name="end-date" placeholder="Nov, 2019" required>
        </div>
        <div class="form-row">
        <label for="school-city">City</label>
        <input type="text" name="school-city" placeholder="Gliwice" required>
        </div>
        <div class="form-row">
        <label for="description">Description</label>
        <textarea name="description" cols="35" rows="5" placeholder="Programming, data analysing, network designing ..."></textarea>
        </div>
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <!-- TODO Add school btn -->
        <div class="form-btn-wrapper">
            <input type="submit" value="Next" class="btn btn-dark" id="btn-sign-up-4">
        </div>
        </form>
    </div>

    <div id="sign-up-5--hidden" class="sign-up-wrapper">
        <form id="sform-5" action="#" method="post">
        <!-- TODO CV & Additional references-->
        <!-- TODO Step 4/4-->
        <div class="form-row">
        <label for="cv-file">Curriculum vitae</label>
        <input type="file" name="cv-file" placeholder="My CV" required>
        </div>
        <!-- TODO Add CV btn -->
        <div class="form-row">
        <label for="certificate-file">Certificate</label>
        <input type="file" name="certificate-file" placeholder="Cisco">
        </div>
        <!-- TODO Add certificate btn -->
        <div class="form-row">
        <label for="course-file">Course</label>
        <input type="file" name="course-file" placeholder="Google Internet Revolutions">
        </div>
        <!-- TODO Add course btn -->
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <div class="form-btn-wrapper">
            <input type="submit" value="Finish" class="btn btn-cyan" id="btn-sign-up-5">
        </div>
        </form>
    </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="script/main.js"></script>
<script src="script/sign-up.js"></script>
</html>