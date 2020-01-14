<?php

session_start();
if ((!isset($_SESSION['successful-sign-up'])) || ($_SESSION['successful-sign-up'] == false))
{
    header('Location: index.php');
    exit();
} else {
  unset($_SESSION['successful-sign-up']);
}
require_once "php/connect.php";
getRole($host, $db_user, $db_pass, $db_name);
// Unset remembered values
if (isset($_SESSION['rem_username'])) unset($_SESSION['rem_username']);
if (isset($_SESSION['rem_email'])) unset($_SESSION['rem_email']);
if (isset($_SESSION['rem_password_one'])) unset($_SESSION['rem_password_one']);
if (isset($_SESSION['rem_password_two'])) unset($_SESSION['rem_password_two']);
if (isset($_SESSION['rem_terms'])) unset($_SESSION['rem_terms']);
// Unset error values
if (isset($_SESSION['err_username'])) unset($_SESSION['err_username']);
if (isset($_SESSION['err_email'])) unset($_SESSION['err_email']);
if (isset($_SESSION['err_password_one'])) unset($_SESSION['err_password_one']);
if (isset($_SESSION['err_password_two'])) unset($_SESSION['err_password_two']);
if (isset($_SESSION['err_terms'])) unset($_SESSION['err_terms']);

// Unset remembered values
if (isset($_SESSION['rem_first_name'])) unset($_SESSION['rem_first_name']);
if (isset($_SESSION['rem_last_name'])) unset($_SESSION['rem_last_name']);
if (isset($_SESSION['rem_phone'])) unset($_SESSION['rem_phone']);
if (isset($_SESSION['rem_residence_country'])) unset($_SESSION['rem_residence_country']);
if (isset($_SESSION['rem_residence_city'])) unset($_SESSION['rem_residence_city']);
// Unset error values
if (isset($_SESSION['err_first_name'])) unset($_SESSION['err_first_name']);
if (isset($_SESSION['err_last_name'])) unset($_SESSION['err_last_name']);
if (isset($_SESSION['err_phone'])) unset($_SESSION['err_phone']);
if (isset($_SESSION['err_residence_country'])) unset($_SESSION['err_residence_country']);
if (isset($_SESSION['err_residence_city'])) unset($_SESSION['err_residence_city']);

// Unset remembered values
if (isset($_SESSION['rem_job_title'])) unset($_SESSION['rem_job_title']);
if (isset($_SESSION['rem_employer'])) unset($_SESSION['rem_employer']);
if (isset($_SESSION['rem_start_date'])) unset($_SESSION['rem_start_date']);
if (isset($_SESSION['rem_end_date'])) unset($_SESSION['rem_end_date']);
if (isset($_SESSION['rem_job_city'])) unset($_SESSION['rem_job_city']);
if (isset($_SESSION['rem_description'])) unset($_SESSION['rem_description']);
// Unset error values
if (isset($_SESSION['err_job_title'])) unset($_SESSION['err_job_title']);
if (isset($_SESSION['err_employer'])) unset($_SESSION['err_employer']);
if (isset($_SESSION['err_start_date'])) unset($_SESSION['err_start_date']);
if (isset($_SESSION['err_end_date'])) unset($_SESSION['err_end_date']);
if (isset($_SESSION['err_job_city'])) unset($_SESSION['err_job_city']);
if (isset($_SESSION['err_description'])) unset($_SESSION['err_description']);

// Unset remembered values
if (isset($_SESSION['rem_skill'])) unset($_SESSION['rem_skill']);
if (isset($_SESSION['rem_skill_level'])) unset($_SESSION['rem_skill_level']);
// Unset error values
if (isset($_SESSION['err_skill'])) unset($_SESSION['err_skill']);
if (isset($_SESSION['err_skill_level'])) unset($_SESSION['err_skill_level']);

// Unset remembered values
if (isset($_SESSION['rem_school'])) unset($_SESSION['rem_school']);
if (isset($_SESSION['rem_specialization'])) unset($_SESSION['rem_specialization']);
if (isset($_SESSION['rem_school_start_date'])) unset($_SESSION['rem_school_start_date']);
if (isset($_SESSION['rem_school_end_date'])) unset($_SESSION['rem_school_end_date']);
if (isset($_SESSION['rem_school_city'])) unset($_SESSION['rem_school_city']);
if (isset($_SESSION['rem_school_description'])) unset($_SESSION['rem_school_description']);
// Unset error values
if (isset($_SESSION['err_school'])) unset($_SESSION['err_school']);
if (isset($_SESSION['err_specialization'])) unset($_SESSION['err_specialization']);
if (isset($_SESSION['err_school_start_date'])) unset($_SESSION['err_school_start_date']);
if (isset($_SESSION['err_school_end_date'])) unset($_SESSION['err_school_end_date']);
if (isset($_SESSION['err_school_city'])) unset($_SESSION['err_school_city']);
if (isset($_SESSION['err_school_description'])) unset($_SESSION['err_school_description']);

if (isset($_SESSION['err_course'])) unset($_SESSION['err_course']);
if (isset($_SESSION['rem_course'])) unset($_SESSION['rem_course']);

if (isset($_SESSION['form1'])) unset($_SESSION['form1']);
if (isset($_SESSION['form2'])) unset($_SESSION['form2']);
if (isset($_SESSION['form3'])) unset($_SESSION['form3']);
if (isset($_SESSION['form4l'])) unset($_SESSION['form4l']);
if (isset($_SESSION['form4sk'])) unset($_SESSION['form4sk']);
if (isset($_SESSION['form4s'])) unset($_SESSION['form4s']);
if (isset($_SESSION['form5cv'])) unset($_SESSION['form5cv']);
if (isset($_SESSION['form5ce'])) unset($_SESSION['form5ce']);
if (isset($_SESSION['form5co'])) unset($_SESSION['form5co']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recruitment System - Log in</title>
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" href="/font/stylesheet.css" type="text/css" charset="utf-8" />
</head>
<body>
    <div id="sign-in">
        <div class="nav-bar">
            <div class="logo-nav">myCompany</div>
        </div>
        <div class="input-wrapper">
            <div class="center-wrapper">
            Congratulations my friend U R in!!!
            <form action="php/log_in/log_in.php" method="post">
                <div class="sign-in-row">
                    <label for="login">Login</label>
                    <input type="text" name="login" placeholder="Username" autocomplete="off">
                    <div class="underline"></div>
                </div>
                <div class="sign-in-row">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="●●●●●●●●●●" autocomplete="off">
                    <div class="underline"></div>
                </div>
                <div class="form-btn-wrapper">
                    <input type="submit" value="Sign in">
                </div>
            </form>
            </div>
        </div>
    </div>
    <div id="btn-sign-in">Sign in</div>
    <!-- <div id="index-container">
        <div class="heroimage"></div>
        <div class="center-wrapper">
            <div class="logo-wrapper">
                <div class="logo-main">myCompany</div>
                <div class="logo-text"><span style="color:#36C3D9;">Apply</span> to us easily</div>
            </div>
        </div>
    </div> -->
</body>
<script src="script/main.js"></script>
<script src="script/index.js"></script>

</html>