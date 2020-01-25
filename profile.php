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
$role = $_SESSION['id_role'];
switch ($role){
    case 2:
        getProfileData($_SESSION['id_user']);
        updateData($_SESSION['id_user']);
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
            Your profile
        </div>
        <form action="" method="post" id="profile-form">
            <div class="list-row">
                <h4 class="title-element">Personal data</h4>
                <div class="btn-element">
                    <div class="btn-unwrap">
                        <div class="line1"></div>
                        <div class="line2"></div>
                    </div>
                </div>
            </div>
            <div class="list-row hide" id="personal-data">
                <div id="sform-1" class="element-wrapper">
                    <div class="break" id="break-1"></div>
            </div>
            </div>
            <div class="list-row">
                <h4 class="title-element">Experience</h4>
                <div class="btn-element">
                    <div class="btn-unwrap">
                        <div class="line1"></div>
                        <div class="line2"></div>
                    </div>
                </div>
            </div>
            <div class="list-row hide" id="experience">
                <div id="sform-2" class="element-wrapper">
                    <div class="form-row">
                        <div class="checkbox">
                            <input type="checkbox" name="no-experience"  value="" id="no-experience">I don't  have any experience
                        </div>
                    </div>
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
                </div>
            </div>
            <div class="list-row">
                <h4 class="title-element">Education</h4>
                <div class="btn-element">
                    <div class="btn-unwrap">
                        <div class="line1"></div>
                        <div class="line2"></div>
                    </div>
                </div>
            </div>
            <div class="list-row hide" id="education">
                <div id="sform-3" class="element-wrapper">
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
                </div>
            </div>
            <div class="list-row">
                <h4 class="title-element">Skills</h4>
                <div class="btn-element">
                    <div class="btn-unwrap">
                        <div class="line1"></div>
                        <div class="line2"></div>
                    </div>
                </div>
            </div>
            <div class="list-row hide" id="skills">
                <div id="sform-4" class="element-wrapper">
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
                </div>
            </div>
            <div class="list-row">
                <h4 class="title-element">Additional</h4>
                <div class="btn-element">
                    <div class="btn-unwrap">
                        <div class="line1"></div>
                        <div class="line2"></div>
                    </div>
                </div>
            </div>
            <div class="list-row hide" id="addition">
                <div id="sform-5" class="element-wrapper">
                    <div class="form-row">
                        <label for="cv-file">Curriculum vitae</label>
                        <div class="upload">
                            <input type="file" name="cv-file" class="inputfile"  value="" accept="application/pdf">
                            <label for="cv-file">Choose a file</label>
                        </div>
                    </div>
                    <div class="form-row ">
                    <label for="certificate-file">Certificates</label>
                        <div class="upload">
                            <input type="file" name="certificate-file-0" class="inputfile" value="" accept="application/pdf" data-multiple-caption="{count} files selected"     multiple>
                            <label>Choose a file</label>
                        </div>
                    </div>
                    <!--<div class="form-row">
                        <label for="lm-file">Cover Letter</label>
                        <div class="upload">
                            <input type="file" name="lm-file" class="inputfile" accept="application/pdf" data-multiple-caption="{count} files selected" multiple>
                            <label>Choose a file</label>
                        </div>
                    </div>-->
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
                </div>
            </div>
        </form>
    </div>  <!-- #container -->
</body>

<script src="script/burger.js"></script>
<script src="script/main.js"></script>
<script src="script/calendar.js"></script>
<script src="script/user-data-handler.js"></script>
<script src="script/input-file.js"></script>
<script src="script/profile.js"></script>
<script src="script/loadProfile.js"></script>
<script src="script/userRecognizer.js"></script>

</html>