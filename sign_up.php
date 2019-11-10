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
</head>
<body>


<form action="log_in.php" method="post">
    <div class="form-1st-page-wrapper">
        <!-- TODO Find your job by joining us!-->
       <br/> <label for="login">Login</label>
       <br/> <input type="text" name="login" placeholder="Username" required>
       <br/> <label for="e-mail">E-mail</label>
       <br/> <input type="email" name="e-mail" placeholder="john.smith@example.com" required>
       <br/> <label for="password-one">Password</label>
       <br/> <input type="password" name="password-one" placeholder="********" required>
       <br/> <label for="password-two">Password</label>
       <br/> <input type="password" name="password-two" placeholder="********" required>
       <br/> <label for="terms-of-use">Terms and Privacy Policy</label>
       <br/> <input type="checkbox" required> I agree to <a href="terms-of-use-contents.php">Terms</a> and <a href="privacy-policy-contents.php">Privacy Policy</a>.
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <div class="form-btn-wrapper">
            <input type="submit" value="Sign in">
        </div>
    </div>
    <div class="form-2nd-page-wrapper">
        <!-- TODO A few more things about you, employers need to know-->
        <!-- TODO Step 1/4-->
       <br/> <label for="first-name">First name</label>
       <br/> <input type="text" name="first-name" placeholder="John" required>
       <br/> <label for="last-name">Last name</label>
       <br/> <input type="text" name="last-name" placeholder="Smith" required>
       <br/> <label for="phone-num">Phone number</label>
       <br/> <input type="tel" name="phone-num" placeholder="600 700 800"
        pattern="[0-9]{3} [0-9]{3} [0-9]{3}" required>
       <br/> <label for="city">Your city</label>
       <br/> <input type="text" name="city" placeholder="London" required>
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <div class="form-btn-wrapper">
            <input type="submit" value="Next">
        </div>
    </div>
    <div class="form-3rd-page-wrapper">
        <!-- TODO What's your experience?-->
        <!-- TODO Step 2/4-->
       <br/> <label for="job-title">Job title</label>
       <br/> <input type="text" name="job-title" placeholder="Waiter" required>
       <br/> <label for="employer">Employer</label>
       <br/> <input type="text" name="employer" placeholder="Italian Restaurant London" required>
       <br/> <label for="start-end-date">Start & End date</label>
       <br/> <input type="date" name=start-date" placeholder="Oct, 2019" required>
        <input type="date" name="end-date" placeholder="Nov, 2019" required>
       <br/> <label for="job-city">City</label>
       <br/> <input type="text" name="job-city" placeholder="London" required>
       <br/> <label for="description">Description</label>
       <br/> <textarea name="description" cols="35" rows="5" placeholder="Waitressing, preparing venue for events, taking care of restaurant clarity ..."></textarea>
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <!-- TODO Add employment btn -->
        <div class="form-btn-wrapper">
            <input type="submit" value="Next">
        </div>
    </div>
    <div class="form-4th-page-wrapper">
        <!-- TODO Skills & Education-->
        <!-- TODO Step 3/4-->
       <br/> <label for="languages">Languages</label>
       <br/> <input type="text" name="languages" placeholder="German" required>
       <br/> <label for="skills">Skills</label>
       <br/> <input type="text" name="skills" placeholder="Marketing" required>
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <!-- TODO Add skill btn -->

       <br/> <label for="school">School</label>
       <br/> <input type="text" name="school" placeholder="Silesian University of Science" required>
       <br/> <label for="specialization">Specialization</label>
       <br/> <input type="text" name="specialization" placeholder="Teleinformatics" required>
       <br/> <label for="start-end-date">Start & End date</label>
       <br/> <input type="date" name=start-date" placeholder="Oct, 2019" required>
        <input type="date" name="end-date" placeholder="Nov, 2019" required>
       <br/> <label for="school-city">City</label>
       <br/> <input type="text" name="school-city" placeholder="Gliwice" required>
       <br/> <label for="description">Description</label>
       <br/> <textarea name="description" cols="35" rows="5" placeholder="Programming, data analysing, network designing ..."></textarea>
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <!-- TODO Add school btn -->
        <div class="form-btn-wrapper">
            <input type="submit" value="Next">
        </div>
    </div>
    <div class="form-5th-page-wrapper">
        <!-- TODO CV & Additional references-->
        <!-- TODO Step 4/4-->
       <br/> <label for="cv-file">Curriculum vitae</label>
       <br/> <input type="file" name="cv-file" placeholder="My CV" required>
        <!-- TODO Add CV btn -->
       <br/> <label for="certificate-file">Certificate</label>
       <br/> <input type="file" name="certificate-file" placeholder="Cisco">
        <!-- TODO Add certificate btn -->
       <br/> <label for="course-file">Course</label>
       <br/> <input type="file" name="course-file" placeholder="Google Internet Revolutions">
        <!-- TODO Add course btn -->
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <div class="form-btn-wrapper">
            <input type="submit" value="Finish">
        </div>
    </div>
</form>

</body>
</html>