<?php
session_start();
require_once "php/FormsValidation.php";
require_once "php/connect.php";
getRole($host, $db_user, $db_pass, $db_name);
$inst = new FormsValidation(true);
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
    <div id="sign-up-1" class="sign-up-wrapper">
    <div class="page-title cyan-color">Find your job by joining us!</div>
        <form id="sform-1" action="php/sign_up.php" method="post">
            <div class="form-row">
                <label for="login">Login</label>
                <input type="text" name="login" value="<?php $inst->rememberValue('rem_username'); ?>" placeholder="Username" required>
                <div class="underline"></div>
                <?php
                $inst->setError('err_username');
                ?>
            </div>
            <div class="form-row">
                <label for="e-mail">E-mail</label>
                <input type="email" name="e-mail" value="<?php $inst->rememberValue('rem_email'); ?>" placeholder="john.smith@example.com" required>
                <div class="underline"></div>
                <?php
                $inst->setError('err_email');
                ?>
            </div>
            <div class="form-row">
                <label for="password-one">Password</label>
                <input type="password" name="password-one" value="<?php $inst->rememberValue('rem_password_one'); ?>" placeholder="●●●●●●●●●●" required>
                <div class="underline"></div>
            </div>
            <div class="form-row">
                <label for="password-two">Password</label>
                <input type="password" name="password-two" value="<?php $inst->rememberValue('rem_password_two'); ?>" placeholder="●●●●●●●●●●" required>
                <div class="underline"></div>
            </div>
            <?php
                $inst->setError('err_password');
                ?>
            <div class="form-row">
                <label for="position">Position</label>
                <select name="position">
                    <?php
                    // Pick data from DB
                    $query = "SELECT position FROM positions";
                    $inst->pickDataFromDB($query, $host, $db_user, $db_pass, $db_name);
                    ?>
                </select>
            </div>
            
            <div class="form-row">
                <label for="terms-of-use">Terms and Privacy Policy</label>
                <div class="checkbox"><input type="checkbox" name="terms-of-use" required <?php
                    if (isset($_SESSION['rem_terms']))
                    {echo "checked";
                    unset($_SESSION['rem_terms']);}
                    ?>>I agree to&nbsp;<a href="documents/terms-of-use-contents.html">Terms&nbsp;</a> and&nbsp;<a href="documents/privacy-policy-contents.html">Privacy Policy</a>.</div>
                <?php
                $inst->setError('err_terms');
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
    
    <div id="sign-up-2--hidden" class="sign-up-wrapper">
    <div class="page-title dark-color">A few more things about you, employers need to know</div>
        <div class="step">Step 1/3</div>
        <form id="sform-2" action="php/sign_up.php" method="post">
            <div class="form-row">
                <label for="first-name">First name</label>
                <input type="text" name="first-name" placeholder="John" required>
                <div class="underline"></div>
            </div>
            <?php
                $inst->setError('err_first_name');
                ?>
            <div class="form-row">
                <label for="last-name">Last name</label>
                <input type="text" name="last-name" placeholder="Smith" required>
                <div class="underline"></div>
            </div>
            <?php
                $inst->setError('err_last_name');
                ?>
            <div class="form-row">
                <label for="phone-num">Phone number</label>
                <input type="tel" name="phone-num" placeholder="600 700 800" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" required>
                <div class="underline"></div>
            </div>
            <?php
                $inst->setError('err_phone');
                ?>
            <div class="form-row">
                <label for="residence-country">Your country</label>
                <select name="residence-country" placeholder="Choose">
                    <?php
                    // Pick data from DB
                    $query = "SELECT country FROM countries";
                    $inst->pickDataFromDB($query, $host, $db_user, $db_pass, $db_name);
                    ?>
                </select>
                <div class="underline"></div>
            </div>
            <?php
                $inst->setError('err_residence_country');
                ?>
            <div class="form-row">
                <label for="residence-city">Your city</label>
                <input type="text" name="residence-city" placeholder="London" required>
                <div class="underline"></div>
            </div>
            <?php
                $inst->setError('err_residence_city');
                ?>
            <div class="form-btn-wrapper">
                <input type="submit" value="Next" class="btn btn-dark" id="btn-sign-up-2">
            </div>
        </form>
    </div>

    
    <div id="sign-up-3--hidden" class="sign-up-wrapper">
    <div class="page-title dark-color">What's your experience?</div>
        <div class="step">Step 2/3</div>
        <form id="sform-3" action="php/sign_up.php" method="post">
            <div id="form3-open-tag"></div>
            <div class="form-row">
                <div class="checkbox">
                <input type="checkbox" name="no-experience" id="no-experience">I don't have any experience
                </div>
            </div>
            <?php
            $inst->setError('err_job_title');
            $inst->setError('err_employer');
            $inst->setError('err_job_city');
            $inst->setError('err_job_description');
            ?>
            <div class="btn-add" id="btn-experience">
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

    
    <div id="sign-up-4--hidden" class="sign-up-wrapper">
    <div class="page-title dark-color">Skills & Education</div>
        <div class="step">Step 3/3</div>
        <form id="sform-4" action="php/sign_up.php" method="post">
            <?php
            $inst->setError('err_language');
            $inst->setError('err_language_level');
            ?>
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
            <?php
            $inst->setError('err_skill');
            $inst->setError('err_skill_level');
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
            <?php
            $inst->setError('err_school');
            $inst->setError('err_specialization');
            $inst->setError('err_school_city');
            $inst->setError('err_school_description');
            ?>
            <div class="btn-add" id="btn-school">
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

    
    <div id="sign-up-5--hidden" class="sign-up-wrapper">
    <div class="page-title cyan-color">CV & Additional references</div>
        <form id="sform-5" action="php/sign_up.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
        <label for="cv-file">Curriculum vitae</label>
        <div class="upload">
            <input type="file" name="cv" class="inputfile" accept="application/pdf">
            <label for="cv-file">Choose a file</label>
        </div>
        </div>
        <div class="form-row ">
        <label for="certificate-file">Certificates</label>
        <div class="upload">
            <input type="file" name="certificate[]" class="inputfile" accept="application/pdf" data-multiple-caption="{count} files selected" multiple>
            <label>Choose a file</label>
        </div>
        </div>
        <div class="form-row">
        <label for="lm-file">Cover Letter</label>
        <div class="upload">
            <input type="file" name="cover-letter" class="inputfile" accept="application/pdf">
            <label>Choose a file</label>
        </div>
        </div>
            <?php
            $inst->setError('err_course');
            $inst->setError('err_file');
            ?>
        <div class="btn-add" id="btn-course">
            <div class="btn-text">
                Add Course
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
<script src="script/user-data-handler.js"></script>
<script src="script/input-file.js"></script>
<script src="script/sign-up.js"></script>
</html>