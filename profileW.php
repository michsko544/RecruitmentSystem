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
    case 1:
        break; // TODO admin - what should be shown (maybe nothing)
    case 2:
        getProfileData($_SESSION['id_user']);
        break;
    case 3:
        $user_profile = $_GET['id_user']; // TODO if recruiter / manager / assistant -> GET user's id
        getProfileData($user_profile);
        break;
    case 4:
        $user_profile = $_GET['id_user']; // TODO if recruiter / manager / assistant -> GET user's id
        getProfileData($user_profile);
        break;
    case 5:
        $user_profile = $_GET['id_user']; // TODO if recruiter / manager / assistant -> GET user's id
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
            Worker look
        </div>
        <div class="list-row">
            <div class="title-element">Personal data</div>
            <div class="btn-element">
                <div class="btn-unwrap">
                    <div class="line1"></div>
                    <div class="line2"></div>
                </div>
            </div>
        </div>
        <div class="list-row hide" id="personal-data">
            <form id="sform-1" action="" method="post" class="element-wrapper">
                <div class="break" id="break-1"></div>
            </form>
        </div>
        <div class="list-row">
            <div class="title-element">Experience</div>
            <div class="btn-element">
                <div class="btn-unwrap">
                    <div class="line1"></div>
                    <div class="line2"></div>
                </div>
            </div>
        </div>
        <div class="list-row hide" id="experience">
            <form id="sform-2" action="" method="post" class="element-wrapper">
                
                
            </form>
        </div>
        <div class="list-row">
            <div class="title-element">Education</div>
            <div class="btn-element">
                <div class="btn-unwrap">
                    <div class="line1"></div>
                    <div class="line2"></div>
                </div>
            </div>
        </div>
        <div class="list-row hide" id="education">
            <form id="sform-3" action="" method="post" class="element-wrapper">
                
            </form>
        </div>
        <div class="list-row">
            <div class="title-element">Skills</div>
            <div class="btn-element">
                <div class="btn-unwrap">
                    <div class="line1"></div>
                    <div class="line2"></div>
                </div>
            </div>
        </div>
        <div class="list-row hide" id="skills">
            <form id="sform-4" action="" method="post" class="element-wrapper">
                
                <div class="break"></div>
                
            </form>
        </div>
        <div class="list-row">
            <div class="title-element">Additional</div>
            <div class="btn-element">
                <div class="btn-unwrap">
                    <div class="line1"></div>
                    <div class="line2"></div>
                </div>
            </div>
        </div>
        <div class="list-row hide" id="addition">
            <form id="sform-5" action="" method="post" class="element-wrapper">
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
                
            </form>
        </div>
    </div>  <!-- #container -->
</body>

<script src="script/burger.js"></script>
<script src="script/main.js"></script>
<script src="script/input-file.js"></script>
<script src="script/user-data-handler-workers.js"></script>
<script src="script/profile.js"></script>
<script src="script/loadProfile.js"></script>
<script src="script/userRecognizer.js"></script>

</html>