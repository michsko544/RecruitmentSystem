<?php
session_start();
if ((!isset($_SESSION['logged_in'])) || ($_SESSION['logged_in'] == false))
{
    header('Location: index.php');
    exit();
}
require_once "php/connect.php";
require_once "php/getRole.php";
getRole($host, $db_user, $db_pass, $db_name);
require_once "php/profile.php";
require_once "php/ChangeProfile.php";

$role = $_SESSION['id_role'];
switch ($role){
    case 2:
        getProfileData($_SESSION['id_user']);
        if (isset($_POST['first-name'])){
            $pro = new ChangeProfile(true, $host, $db_user, $db_pass, $db_name);
            $flag_pd = false;
            $flag_exp = false;
            $flag_edu = false;
            $flag_s = false;
            $flag_l = false;
            if (isset($_POST['first-name']))
            {
                $first_name = $_POST['first-name'];
                $last_name = $_POST['last-name'];
                $phone = $_POST['phone-num'];
                $residence_country = $_POST['residence-country'];
                $residence_city = $_POST['residence-city'];
                $flag_pd = $pro->validateFormPD($first_name, $last_name, $phone, $residence_country, $residence_city);
            }
            if (isset($_POST['job-title-0']))
            {
                $i = 0;
                while (isset($_POST['job-title-' . $i]))
                {
                    $job_title = $_POST['job-title-' . $i];
                    if (isset($_POST['no-experience']))
                        $no_experience = true;
                    else
                        $no_experience = false;
                    $employer = $_POST['employer-' . $i];
                    $job_city = $_POST['job-city-' . $i];
                    $start_date = $_POST['start-date-'. $i];
                    $end_date = $_POST['end-date-'. $i];
                    $job_description = $_POST['job-description-' . $i];
                    $flag_exp = $pro->validateFormExp($job_title, $no_experience, $employer, $start_date, $end_date, $job_city, $job_description);
                    $i++;
                }
            }
            if (isset($_POST['languages-0']))
            {
                $i = 0;
                while (isset($_POST['languages-'.$i]))
                {
                    $language = $_POST['languages-' . $i];
                    $language_level = $_POST['language-level-' . $i];
                    $flag_l = $pro->validateFormL($language, $language_level);
                    $i++;
                }
                $j = 0;
                while (isset($_POST['skills-'.$j]))
                {
                    $skill = $_POST['skills-' . $j];
                    $skill_level = $_POST['skill-level-' . $j];
                    $flag_s = $pro->validateFormS($skill, $skill_level);
                    $j++;
                }
                $k = 0;
                while (isset($_POST['school-'.$k]))
                {
                    $school = $_POST['school-' . $k];
                    $specialization = $_POST['specialization-' . $k];
                    $school_start_date = $_POST['school-start-date-' . $k];
                    $school_end_date = $_POST['school-end-date-' . $k];
                    $school_city = $_POST['school-city-' . $k];
                    $school_description = $_POST['school-description-' . $k];
                    $flag_edu = $pro->validateFormEdu($school, $specialization, $school_start_date, $school_end_date, $school_city, $school_description);
                    $k++;
                }
            }
            // TODO add files
            if (($flag_pd==true) && ($flag_exp==true) && ($flag_edu==true) && ($flag_s==true) && ($flag_l==true)){
                try {
                    require_once "php/UpdateData.php";
                    $up = new UpdateData($host, $db_user, $db_pass, $db_name);
                    $up->updateProfile();
                }catch (Exception $e){
                    require_once "php/addError.php";
                    addError($e);
                    echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
                }
            }
        }
        break;
    default:
        $user_profile = $_GET['uid'];
        getProfileData($user_profile);
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recruitment System - Profile</title>
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" href="/font/stylesheet.css" type="text/css" charset="utf-8" />
    <link href="css/jquery-ui.css" rel="stylesheet" />
    <script src="script/jquery-1.11.1.js"></script>
    <script src="script/jquery-ui.js"></script>
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
        <div class="small-title">
            Recruitment stages
        </div>
            <div class="list-row">
                <div class="position first-text">Job Interview</div>
                <div class="app-status-sent last-text">John Smith</div>
                <div class="btn-element">
                    <div class="btn-unwrap">
                        <div class="line1"></div>
                        <div class="line2"></div>
                    </div>
                </div>
            </div>
            <div class="list-row hide" id="">
                <div id="sform-1" class="element-wrapper">
                    <div class="break" id="break-1"></div>
                </div>
            </div>
            
    </div>  <!-- #container -->
</body>

<script src="script/burger.js"></script>
<script src="script/main.js"></script>
<script src="script/user-data-handler.js"></script>
<script src="script/profile.js"></script>
<script src="script/userRecognizer.js"></script>

</html>