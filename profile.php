<?php
session_start();
/* if ((!isset($_SESSION['logged_in'])) || ($_SESSION['logged_in'] == false))
{
    header('Location: index.php');
    exit();
}*/
require_once "php/connect.php";
require_once "php/HandleJson.php";


// array from DB
$json_array = array();

// tmp array
$data_push_tpdn = array(); $data_push_tpds = array(); $data_push_tpdp = array(); $data_push_tpdc = array(); $data_push_tpdl = array();
$data_push_txj = array(); $data_push_txe = array(); $data_push_txsj = array(); $data_push_txej = array(); $data_push_txc = array(); $data_push_txd = array();
$data_push_ten = array(); $data_push_tes = array(); $data_push_tesl = array(); $data_push_teel = array(); $data_push_tec = array(); $data_push_ted = array();
$data_push_tl = array(); $data_push_tll = array();
$data_push_ts = array(); $data_push_tsl = array();
$data_push_tcv = array();
$data_push_tcl = array();
$data_push_tce = array();
$data_push_tco = array();

// queries
$query_tpdn = "SELECT u.name from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join countries co on a.id_country=co.id_country where u.id_user = '{$_SESSION['id_user']}'";
$query_tpds = "SELECT u.surname from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join countries co on a.id_country=co.id_country where u.id_user = '{$_SESSION['id_user']}'";
$query_tpdp = "SELECT a.phone from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join countries co on a.id_country=co.id_country where u.id_user = '{$_SESSION['id_user']}'";
$query_tpdc = "SELECT co.country from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join countries co on a.id_country=co.id_country where u.id_user = '{$_SESSION['id_user']}'";
$query_tpdl = "SELECT c.locality As residence_city from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join countries co on a.id_country=co.id_country where u.id_user = '{$_SESSION['id_user']}'";
$query_txj = "SELECT e.job from users u join applicants a on u.id_user=a.id_user join experiences e on a.id_applicants = e.id_applicants join cities c on e.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_txe = "SELECT e.employer from users u join applicants a on u.id_user=a.id_user join experiences e on a.id_applicants = e.id_applicants join cities c on e.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_txsj = "SELECT e.start_job from users u join applicants a on u.id_user=a.id_user join experiences e on a.id_applicants = e.id_applicants join cities c on e.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_txej = "SELECT e.end_job from users u join applicants a on u.id_user=a.id_user join experiences e on a.id_applicants = e.id_applicants join cities c on e.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_txc = "SELECT c.locality As job_city from users u join applicants a on u.id_user=a.id_user join experiences e on a.id_applicants = e.id_applicants join cities c on e.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_txd = "SELECT e.description As job_description from users u join applicants a on u.id_user=a.id_user join experiences e on a.id_applicants = e.id_applicants join cities c on e.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_ten = "SELECT s.name_school from users u join applicants a on u.id_user=a.id_user join schools s on a.id_applicants=s.id_applicants join cities c on s.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_tes = "SELECT s.specialization from users u join applicants a on u.id_user=a.id_user join schools s on a.id_applicants=s.id_applicants join cities c on s.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_tesl = "SELECT s.start_learning from users u join applicants a on u.id_user=a.id_user join schools s on a.id_applicants=s.id_applicants join cities c on s.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_teel = "SELECT s.end_learning from users u join applicants a on u.id_user=a.id_user join schools s on a.id_applicants=s.id_applicants join cities c on s.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_tec = "SELECT c.locality As school_city from users u join applicants a on u.id_user=a.id_user join schools s on a.id_applicants=s.id_applicants join cities c on s.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_ted = "SELECT s.description As school_description from users u join applicants a on u.id_user=a.id_user join schools s on a.id_applicants=s.id_applicants join cities c on s.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_tl = "SELECT la.language from users u join applicants a on u.id_user=a.id_user join knowledge k on a.id_applicants=k.id_applicants join languages la on k.id_language=la.id_language where u.id_user = '{$_SESSION['id_user']}'";
$query_tll = "SELECT le.id_level from users u join applicants a on u.id_user=a.id_user join knowledge k on a.id_applicants=k.id_applicants join levels le on k.id_level=le.id_level join languages la on k.id_language=la.id_language where u.id_user = '{$_SESSION['id_user']}'";
$query_ts = "SELECT s.sience from users u join applicants a on u.id_user=a.id_user join holders k on a.id_applicants=k.id_applicants join skills s on s.id_skill=k.id_skill where u.id_user = '{$_SESSION['id_user']}'";
$query_tsl = "SELECT le.id_level from users u join applicants a on u.id_user=a.id_user join holders k on a.id_applicants=k.id_applicants join levels le on k.id_level=le.id_level join skills s on s.id_skill=k.id_skill where u.id_user = '{$_SESSION['id_user']}'";
$query_tcv = "SELECT cv.description As cv_description from users u join applicants a on u.id_user=a.id_user join cv on a.id_applicants=cv.id_applicants join certifications on a.id_applicants=certifications.id_applicants join training t on a.id_applicants=t.id_applicants join applications ap on a.id_applicants=ap.id_applicants join cl on ap.id_application=cl.id_application where u.id_user='{$_SESSION['id_user']}'";
$query_tcl = "SELECT cl.description As cl_description from users u join applicants a on u.id_user=a.id_user join cv on a.id_applicants=cv.id_applicants join certifications on a.id_applicants=certifications.id_applicants join training t on a.id_applicants=t.id_applicants join applications ap on a.id_applicants=ap.id_applicants join cl on ap.id_application=cl.id_application where u.id_user='{$_SESSION['id_user']}'";
$query_tce = "SELECT certifications.descriptions As cert_descriptions from users u join applicants a on u.id_user=a.id_user join cv on a.id_applicants=cv.id_applicants join certifications on a.id_applicants=certifications.id_applicants join training t on a.id_applicants=t.id_applicants join applications ap on a.id_applicants=ap.id_applicants join cl on ap.id_application=cl.id_application where u.id_user='{$_SESSION['id_user']}'";
$query_tco = "SELECT t.description As course_description from users u join applicants a on u.id_user=a.id_user join cv on a.id_applicants=cv.id_applicants join certifications on a.id_applicants=certifications.id_applicants join training t on a.id_applicants=t.id_applicants join applications ap on a.id_applicants=ap.id_applicants join cl on ap.id_application=cl.id_application where u.id_user='{$_SESSION['id_user']}'";

$new_json = new HandleJson();

// connect with db
mysqli_report(MYSQLI_REPORT_STRICT);
try
{
    // add db results to array
    $count_tpd = $new_json->fetchData($query_tpdn, $data_push_tpdn, $json_array['personal-data']['first-name'], $host, $db_user, $db_pass, $db_name);
    $count_tpd = $new_json->fetchData($query_tpds, $data_push_tpds, $json_array['personal-data']['last-name'], $host, $db_user, $db_pass, $db_name);
    $count_tpd = $new_json->fetchData($query_tpdp, $data_push_tpdp, $json_array['personal-data']['phone'], $host, $db_user, $db_pass, $db_name);
    $count_tpd = $new_json->fetchData($query_tpdc, $data_push_tpdc, $json_array['personal-data']['country'], $host, $db_user, $db_pass, $db_name);
    $count_tpd = $new_json->fetchData($query_tpdl, $data_push_tpdl, $json_array['personal-data']['city'], $host, $db_user, $db_pass, $db_name);
    $count_tx = $new_json->fetchData($query_txj, $data_push_txj, $json_array['experience']['job-title'], $host, $db_user, $db_pass, $db_name);
    $count_tx = $new_json->fetchData($query_txe, $data_push_txe, $json_array['experience']['employer'], $host, $db_user, $db_pass, $db_name);
    $count_tx = $new_json->fetchData($query_txsj, $data_push_txsj, $json_array['experience']['start-date'], $host, $db_user, $db_pass, $db_name);
    $count_tx = $new_json->fetchData($query_txej, $data_push_txej, $json_array['experience']['end-date'], $host, $db_user, $db_pass, $db_name);
    $count_tx = $new_json->fetchData($query_txc, $data_push_txc, $json_array['experience']['city'], $host, $db_user, $db_pass, $db_name);
    $count_tx = $new_json->fetchData($query_txd, $data_push_txd, $json_array['experience']['description'], $host, $db_user, $db_pass, $db_name);
    $count_te = $new_json->fetchData($query_ten, $data_push_ten, $json_array['education']['school-name'], $host, $db_user, $db_pass, $db_name);
    $count_te = $new_json->fetchData($query_tes, $data_push_tes, $json_array['education']['specialization'], $host, $db_user, $db_pass, $db_name);
    $count_te = $new_json->fetchData($query_tesl, $data_push_tesl, $json_array['education']['start-date'], $host, $db_user, $db_pass, $db_name);
    $count_te = $new_json->fetchData($query_teel, $data_push_teel, $json_array['education']['end-date'], $host, $db_user, $db_pass, $db_name);
    $count_te = $new_json->fetchData($query_tec, $data_push_tec, $json_array['education']['city'], $host, $db_user, $db_pass, $db_name);
    $count_te = $new_json->fetchData($query_ted, $data_push_ted, $json_array['education']['description'], $host, $db_user, $db_pass, $db_name);
    $count_tl = $new_json->fetchData($query_tl, $data_push_tl, $json_array['skills']['languages']['lang'], $host, $db_user, $db_pass, $db_name);
    $count_tll = $new_json->fetchData($query_tll, $data_push_tll, $json_array['skills']['languages']['level'], $host, $db_user, $db_pass, $db_name);
    $count_ts = $new_json->fetchData($query_ts, $data_push_ts, $json_array['skills']['skills']['skill'], $host, $db_user, $db_pass, $db_name);
    $count_tsl = $new_json->fetchData($query_tsl, $data_push_tsl, $json_array['skills']['skills']['level'], $host, $db_user, $db_pass, $db_name);
    $count_tcv = $new_json->fetchData($query_tcv, $data_push_tcv, $json_array['additional']['cv'], $host, $db_user, $db_pass, $db_name);
    $count_tcl = $new_json->fetchData($query_tcl, $data_push_tcl, $json_array['additional']['cover-letter'], $host, $db_user, $db_pass, $db_name);
    $count_tce = $new_json->fetchData($query_tce, $data_push_tce, $json_array['additional']['certificates'], $host, $db_user, $db_pass, $db_name);
    $count_tco = $new_json->fetchData($query_tco, $data_push_tco, $json_array['additional']['courses'], $host, $db_user, $db_pass, $db_name);

    $new_json->addCounters($json_array['counters']['personal-data'], $count_tpd);
    $new_json->addCounters($json_array['counters']['experience'], $count_tx);
    $new_json->addCounters($json_array['counters']['education'], $count_te);
    $new_json->addCounters($json_array['counters']['language'], $count_tl);
    $new_json->addCounters($json_array['counters']['skill'], $count_ts);
    $new_json->addCounters($json_array['counters']['cv'], $count_tcv);
    $new_json->addCounters($json_array['counters']['cover-letter'], $count_tcl);
    $new_json->addCounters($json_array['counters']['certificate'], $count_tce);
    $new_json->addCounters($json_array['counters']['course'], $count_tco);

    //fill .json file with data from db
    $new_json->createJsonFile('json/profile.json', $json_array);
}
catch (Exception $e)
{
    echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
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
                <li><a href="profile.php">My profile</a></li>
                <li><a href="applications.php">Applications</a></li>
                <li><a href="#">Replies</a></li>
                <li><a href="php/log_in/log_out.php">Sign out</a></li>
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
                <div class="form-row">
                    <label for="first-name">First name</label>
                    <input type="text" name="first-name" value="">
                    <div class="underline"></div>
                </div>
                <div class="form-row">
                    <label for="last-name">Last name</label>
                    <input type="text" name="last-name" value="">
                    <div class="underline"></div>
                </div>
                <div class="form-row">
                    <label for="phone-num">Phone number</label>
                    <input type="tel" name="phone-num" value="">
                    <div class="underline"></div>
                </div>
                <div class="form-row">
                    <label for="residence-country">Your country</label>
                    <input type="text" name="residence-country" value="">
                    <div class="underline"></div>
                </div>
                <div class="form-row">
                    <label for="residence-city">Your city</label>
                    <input type="text" name="residence-city" value="">
                    <div class="underline"></div>
                </div>
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
            <div class="form-row">
                <div class="checkbox">
                    <input type="checkbox" name="no-experience"  value="" id="no-experience">I don't  have any experience
                </div>
            </div>
            <div class="form-row">
                <label for="job-title">Job title</label>
                <input type="text" name="job-title-0" value="">
                <div class="underline"></div>
            </div>
            <div class="form-row">
                <label for="employer">Employer</label>
                <input type="text" name="employer-0" value="">
                <div class="underline"></div>
            </div>
            <div class="form-row">
                <label for="start-end-date">Start & End date</label>
                <div class="date">
                    <input type="text" id="start-exp-0" class="start-date" name="start-date-0">

                    <input type="text" id="end-exp-0" class="end-date" name="end-date-0">

                </div>
            </div>
            <div class="form-row">
                <label for="job-city">City</label>
                <input type="text" name="job-city-0" value="">
                <div class="underline"></div>
            </div>
            <div class="form-row">
                <label for="job-description">Description</label>
                <textarea name="job-description-0" cols="35" rows="4">  </textarea>
                <div class="underlineTA"></div>
            </div>
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
        <div class="form-row">
            <label for="school">School</label>
            <input type="text" name="school-0" value="" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="specialization">Specialization</label>
            <input type="text" name="specialization-0" value="" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="start-end-date">Start & End date</label>
            <div class="date">
                <input type="text" id="start-school-0" class="start-date" name="school-start-date-0" value="" required>
                <input type="text" id="end-school-0" class="end-date" name="school-end-date-0" value="" required>
            </div>
        </div>
        <div class="form-row">
            <label for="school-city">City</label>
            <input type="text" name="school-city-0" value="" required>
            <div class="underline"></div>
        </div>
        <div class="form-row">
            <label for="school-description">Description</label>
            <textarea name="school-description-0" cols="35" rows="4">  </textarea>
            <div class="underlineTA"></div>
        </div>
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
        <div class="form-row">
            <label for="languages">Languages</label>
            <input type="text" name="languages-0" placeholder="German" value="" required>
            <div class="underline"></div>
            <div class="degree">
                <input type="number" name="language-level-0" min=1 max=5 placeholder=1 value="">
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
        <input type="text" name="skills-0" placeholder="Marketing" value="" required>
        <div class="underline"></div>
        <div class="degree">
            <input type="number" name="skill-level-0" min=1 max=5 placeholder=1 value="">
            <div class="limit">/5</div>
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
    <div class="form-row">
        <label for="lm-file">Cover Letter</label>
        <div class="upload">
            <input type="file" name="lm-file" class="inputfile" accept="application/pdf" data-multiple-caption="{count} files selected" multiple>
            <label>Choose a file</label>
        </div>
    </div>
    <div class="form-row">
        <label for="course">Courses</label>
        <input type="text" name="course-0" placeholder="e.g. Google Internet Revolutions" value="">
        <div class="underline"></div>
    </div>
    <div class="btn-add" id="btn-course">
        <div class="btn-text">
            Add Course <!-- TODO var docs-count -->
        </div>
        <div class="btn-border">
            <div class="btn-icon">
                +
            </div>
        </div>
    </div>
    </form>
    </div>
    </div>
</body>

<script src="script/main.js"></script>
<script src="script/burger.js"></script>
<script src="script/calendar.js"></script>
<script src="script/sign-up.js"></script>
<script src="script/profile.js"></script>
</html>