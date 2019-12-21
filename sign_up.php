<?php
session_start();
require_once "php/sign_up/SignUpSystem.php";
require_once "php/connect.php";
$sign_up_class = new SignUpSystem(true);
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
    <link href="css/jquery-ui.css" rel="stylesheet" />
    <script src="script/jquery-1.11.1.js"></script>
    <script src="script/jquery-ui.js"></script>
    
</head>
<body>
<div class="nav-bar">
    <a href="index.php"><div class="logo-nav">myCompany</div></a>
</div>

<div class="sign-up-container">
<div class="page-title cyan-color">Find your job by joining us!</div>
    <div id="sign-up-1" class="sign-up-wrapper">

        <form id="sform-1" action="/php/sign_up/sign_up_system.php" method="post">
        <div class="form-row">
            <label for="login">Login</label>
            <input type="text" name="login" value="<?php $sign_up_class->rememberValue('rem_username'); ?>" placeholder="Username" required>
            <div class="underline"></div>
            <?php
            $sign_up_class->setError('err_username');
            ?>
        </div>
        <div class="form-row">
            <label for="e-mail">E-mail</label>
            <input type="email" name="e-mail" value="<?php $sign_up_class->rememberValue('rem_email'); ?>" placeholder="john.smith@example.com" required>
            <div class="underline"></div>
            <?php
            $sign_up_class->setError('err_email');
            ?>
        </div>
        <div class="form-row">
            <label for="password-one">Password</label>
            <input type="password" name="password-one" value="<?php $sign_up_class->rememberValue('rem_password_one'); ?>" placeholder="●●●●●●●●●●" required>
            <div class="underline"></div>
            <?php
            $sign_up_class->setError('err_password');
            ?>
        </div>
        <div class="form-row">
            <label for="password-two">Password</label>
            <input type="password" name="password-two" value="<?php $sign_up_class->rememberValue('rem_password_two'); ?>" placeholder="●●●●●●●●●●" required>
            <div class="underline"></div>
            <?php
            $sign_up_class->setError('err_password');
            ?>
        </div>
        <div class="form-row">
            <label for="position">Position</label>
            <select name="position">
                <?php
                // Pick data from DB
                $query = "SELECT position FROM positions";
                $sign_up_class->pickDataFromDB($query, $host, $db_user, $db_pass, $db_name);
                ?>
            </select>
        </div>
        
        <div class="form-row">
            <label for="terms-of-use">Terms and Privacy Policy</label>
            <div class="checkbox"><input type="checkbox" required <?php
                if (isset($_SESSION['rem_terms']))
                {echo "checked";
                unset($_SESSION['rem_terms']);}
                ?>>I agree to&nbsp;<a href="documents/terms-of-use-contents.html">Terms&nbsp;</a> and&nbsp;<a href="documents/privacy-policy-contents.html">Privacy Policy</a>.</div>
            <?php
            //$sign_up_class->setError('err_terms');
            ?>
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
        <form id="sform-2" action="php/sign_up/sign_up_system.php" method="post">
       
        <div class="form-row">
            <label for="first-name">First name</label>
            <input type="text" name="first-name" placeholder="John" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="last-name">Last name</label>
            <input type="text" name="last-name" placeholder="Smith" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="phone-num">Phone number</label>
            <input type="tel" name="phone-num" placeholder="600 700 800" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="residence-country">Your country</label>
            <select name="residence-country">
                <?php
                // Pick data from DB
                $query = "SELECT country FROM countries";
                $sign_up_class->pickDataFromDB($query, $host, $db_user, $db_pass, $db_name);
                ?>
            </select>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="residence-city">Your city</label>
            <input type="text" name="residence-city" placeholder="London" required>
            <div class="underline"></div>
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
        <form id="sform-3" action="php/sign_up/sign_up_system.php" method="post">
        <div class="form-row">
            <div class="checkbox">
            <input type="checkbox" name="no-experience" id="no-experience">I don't have any experience
            </div>
        </div>
        <div class="form-row">
            <label for="job-title">Job title</label>
            <input type="text" name="job-title-0" placeholder="Waiter" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="employer">Employer</label>
            <input type="text" name="employer-0" placeholder="Italian Restaurant London" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="start-end-date">Start & End date</label>
            <div class="date">
                <input type="text" id="start-exp-0" class="start-date" name="start-date-0" placeholder="Oct, 2019" required>
                <input type="text" id="end-exp-0" class="end-date" name="end-date-0" placeholder="Nov, 2019" required>
            </div>
        </div>
        <div class="form-row">
            <label for="job-city">City</label>
            <input type="text" name="job-city-0" placeholder="London" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="job-description">Description</label>
            <textarea name="job-description-0" cols="35" rows="4" placeholder="e.g. waitressing,preparing venue for events, taking care of restaurant clarity, making basic drinks, brewing coffee" required></textarea>
            <div class="underlineTA"></div>
        </div>
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <div class="btn-add" id="btn-experiance">
            <div class="btn-text">
                Add employment <!--TODO var exp-count -->
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
        <form id="sform-4" action="php/sign_up/sign_up_system.php" method="post">
        <div class="form-row">
            <label for="languages">Languages</label>
            <input type="text" name="languages-0" placeholder="German" required>
            <div class="underline"></div>
        <div class="degree">
            <input type="number" name="language-level-0" min=1 max=5 placeholder=1>
            <div class="limit">/5</div>
        </div>
        </div>
        <div class="btn-add" id="btn-language">
            <div class="btn-text">
                Add language
            </div>
            <div class="btn-border">
                <div class="btn-icon">
                +
                </div>
            </div>
        </div>
        <div class="form-row">
            <label for="skills">Skills</label>
            <input type="text" name="skills-0" placeholder="Marketing" required>
            <div class="underline"></div>
        <div class="degree">
            <input type="number" name="skill-level-0" min=1 max=5 placeholder=1>
            <div class="limit">/5</div>
        </div>
        </div>
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <div class="btn-add" id="btn-skill">
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
            <input type="text" name="school-0" placeholder="Silesian University of Technology" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="specialization">Specialization</label>
            <input type="text" name="specialization-0" placeholder="Teleinformatics" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="start-end-date">Start & End date</label>
            <div class="date">
                <input type="text" id="start-school-0" class="start-date" name="school-start-date-0" placeholder="Oct, 2019" required>
                <input type="text" id="end-school-0" class="end-date" name="school-end-date-0" placeholder="Nov, 2019" required>
            </div>
        </div>
        <div class="form-row">
            <label for="school-city">City</label>
            <input type="text" name="school-city-0" placeholder="Gliwice" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="school-description">Description</label>
            <textarea name="school-description-0" cols="35" rows="4" placeholder="e.g. programming, data analysing, network designing, microprocessors coding"></textarea>
            <div class="underlineTA"></div>
        </div>
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <div class="btn-add" id="btn-school">
            <div class="btn-text">
                Add school <!-- TODO var school-count -->
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
        <form id="sform-5" action="php/sign_up/sign_up_system.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
        <label for="cv-file">Curriculum vitae</label>
        <div class="upload">
            <input type="file" name="cv" class="inputfile" accept="application/pdf">
            <label for="cv-file">Choose a file</label>
        </div>
        </div>
        <div class="form-row ">
        <label for="certificate-file">Certificates</label>
        <div class="upload"> <!-- TODO var cert-count -->
            <input type="file" name="certificate-0" class="inputfile" accept="application/pdf" data-multiple-caption="{count} files selected" multiple>
            <label>Choose a file</label>
        </div>
        </div>
        <div class="form-row">
        <label for="lm-file">Cover Letter</label>
        <div class="upload">
            <input type="file" name="cover-letter" class="inputfile" accept="application/pdf" data-multiple-caption="{count} files selected" multiple>
            <label>Choose a file</label>
        </div>
        </div>
        <div class="form-row">
            <label for="course">Courses</label>
            <input type="text" name="course-0" placeholder="e.g. Google Internet Revolutions">
            <div class="underline"></div>
        </div>
        <?php
        if(isset($_SESSION['error']))
        {
            echo $_SESSION['error'];
        }
        ?>
        <div class="btn-add" id="btn-course">
            <div class="btn-text">
                Add Course <!-- TODO var course-count -->
            </div>
            <div class="btn-border">
                <div class="btn-icon">
                +
                </div>
            </div>
        </div>
        <div class="form-btn-wrapper">
            <input type="submit" value="Finish" class="btn btn-cyan" id="btn-sign-up-5">
        </div>
        </form>
    </div>
</div>
</body>

<script src="script/main.js"></script>
<script src="script/calendar.js"></script>
<script src="script/sign-up.js"></script>
</html>