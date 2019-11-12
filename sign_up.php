<?php

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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
<div class="nav-bar">
    <a href="index.php"><div class="logo-nav">myCompany</div></a>
</div>

<div class="sign-up-container">
<div class="page-title cyan-color">Find your job by joining us!</div>
    <div id="sign-up-1" class="sign-up-wrapper">
        
        <form id="sform-1" action="#" method="post">    
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
            <input type="password" name="password-one" placeholder="●●●●●●●●●●" required>
        </div>
        <div class="form-row">
            <label for="password-two">Password</label>
            <input type="password" name="password-two" placeholder="●●●●●●●●●●" required>
        </div>
    <!-- TODO Position-->
        <div class="form-row">
            <label for="terms-of-use">Terms and Privacy Policy</label>
            <div class="checkbox"><input type="checkbox" required>I agree to&nbsp;<a href="terms-of-use-contents.php">Terms&nbsp;</a> and&nbsp;<a href="privacy-policy-contents.php">Privacy Policy</a>.</div>
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
    <div class="page-title dark-color">A few more things about you, employers need to know</div>
    <div id="sign-up-2" class="sign-up-wrapper">
        <div class="step">Step 1/3</div>
        <form id="sform-2" action="#" method="post">
       
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

    <div class="page-title dark-color">What's your experience?</div>
    <div id="sign-up-3" class="sign-up-wrapper">
        <div class="step">Step 2/3</div>
        <form id="sform-3" action="#" method="post">
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
        <div class="date">
            <input type="text" id="datej1" class="start-date" name="start-date" placeholder="Oct, 2019" required>
            <input type="text" id="datej2" class="end-date" name="end-date" placeholder="Nov, 2019" required>
        </div>
        </div>
        <div class="form-row">
        <label for="job-city">City</label>
        <input type="text" name="job-city" placeholder="London" required>
        </div>
        <div class="form-row">
        <label for="description">Description</label>
        <textarea name="description" cols="35" rows="4" placeholder="e.g. waitressing,preparing venue for events, taking care of restaurant clarity, making basic drinks, brewing coffee"></textarea>
        </div>
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <div class="btn-add">
            <div class="btn-text">
                Add employment
            </div>
            <div class="btn-border">
                <div class="btn-icon">
                +
                </div>
            </div>
        </div>
        <div class="form-btn-wrapper">
            <input type="submit" value="Next" class="btn btn-dark" id="btn-sign-up-3">
        </div>
        </form>
    </div>

    <div class="page-title dark-color">Skills & Education</div>
    <div id="sign-up-4" class="sign-up-wrapper">
        <div class="step">Step 3/3</div>
        <form id="sform-4" action="#" method="post">        
        <div class="form-row relative">
        <label for="languages">Languages</label>
        <input type="text" name="languages" placeholder="German" required>
        <div class="degree">
            <input type="number" min=1 max=5 placeholder=1>
            <div class="limit">/5</div>
        </div>
        </div>
        <div class="form-row relative">
        <label for="skills">Skills</label>
        <input type="text" name="skills" placeholder="Marketing" required>
        <div class="degree">
            <input type="number" min=1 max=5 placeholder=1>
            <div class="limit">/5</div>
        </div>
        </div>
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <div class="btn-add">
            <div class="btn-text">
                Add skill
            </div>
            <div class="btn-border">
                <div class="btn-icon">
                +
                </div>
            </div>
        </div>
        <div class="form-row">
        <label for="school">School</label>
        <input type="text" name="school" placeholder="Silesian University of Technology" required>
        </div>
        <div class="form-row">
        <label for="specialization">Specialization</label>
        <input type="text" name="specialization" placeholder="Teleinformatics" required>
        </div>
        <div class="form-row">
        <label for="start-end-date">Start & End date</label>
        <div class="date">
            <input type="text" class="start-date" name="start-date" placeholder="Oct, 2019" required>
            <input type="text" class="end-date" name="end-date" placeholder="Nov, 2019" required>
        </div>
        </div>
        <div class="form-row">
        <label for="school-city">City</label>
        <input type="text" name="school-city" placeholder="Gliwice" required>
        </div>
        <div class="form-row">
        <label for="description">Description</label>
        <textarea name="description" cols="35" rows="4" placeholder="e.g. programming, data analysing, network designing, microprocessors coding"></textarea>
        </div>
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <div class="btn-add">
            <div class="btn-text">
                Add school
            </div>
            <div class="btn-border">
                <div class="btn-icon">
                +
                </div>
            </div>
        </div>
        <div class="form-btn-wrapper">
            <input type="submit" value="Next" class="btn btn-dark" id="btn-sign-up-4">
        </div>
        </form>
    </div>

    <div class="page-title cyan-color">CV & Additional references</div>
    <div id="sign-up-5" class="sign-up-wrapper">
        <form id="sform-5" action="#" method="post">
        <div class="form-row">
        <label for="cv-file">Curriculum vitae</label>
        <div class="upload">
            <label>Wybierz plik</label>
            <input type="file" name="cv-file">
        </div>
        </div>
        <div class="form-row ">
        <label for="certificate-file">Certificate</label>
        <div class="upload">
            <label>Wybierz plik</label>
            <input type="file" name="certificate-file">
        </div>
        </div>
        <div class="form-row">
        <label for="course-file">Course</label>
        <div class="upload">
            <label>Wybierz plik</label>
            <input type="file" name="course-file">
        </div>
        </div>
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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="script/main.js"></script>
<script src="script/calendar.js"></script>
<script src="script/sign-up.js"></script>
</html>