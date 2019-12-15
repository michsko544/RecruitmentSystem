<?php
session_start();
/* if ((!isset($_SESSION['logged_in'])) || ($_SESSION['logged_in'] == false))
{
    header('Location: index.php');
    exit();
}*/
require_once "php/connect.php";

// array from DB
$json_array = array(/*
        "personal-data" => array(
            "first-name" => "",
            "last-name" => "",
            "phone-number" => "",
            "country" => "",
            "city" => "",
        ),
        "experience" => array(
            "no-experience" => false,
            "job-title" => array(),
            "employer" => array(),
            "start-date" => array(),
            "end-date" => array(),
            "city" => array(),
            "description" => array(),
        ),
        "education" => array(
            "school" => array(),
            "specialization" => array(),
            "start-date" => array(),
            "end-date" => array(),
            "city" => array(),
            "description" => array(),
        ),
        "skills" => array(
            "languages" => array(
                    "lang" => array(),
                    "level" => array(),
            ),
            "skills" => array(
                "skill" => array(),
                "level" => array(),
            ),
        ),
        "additional" => array(
            "cv" => "",
            "certificates" => array(),
            "cover-letter" => array(),
            "courses" => array(),
        ),*/
);

// tmp array
$data_push_tpd = array();
$data_push_tx = array();
$data_push_te = array();
$data_push_tl = array();
$data_push_tll = array();
$data_push_ts = array();
$data_push_tsl = array();
$data_push_tcv = array();
$data_push_tcl = array();
$data_push_tce = array();
$data_push_tco = array();

// queries TODO ja jebe jak tu duzo roboty
$query_tpdn = "SELECT u.name from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join countries co on a.id_country=co.id_country where u.id_user = '{$_SESSION['id_user']}'";
$query_tpds = "SELECT u.surname from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join countries co on a.id_country=co.id_country where u.id_user = '{$_SESSION['id_user']}'";
$query_tpdp = "SELECT a.phone from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join countries co on a.id_country=co.id_country where u.id_user = '{$_SESSION['id_user']}'";
$query_tpdc = "SELECT co.country from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join countries co on a.id_country=co.id_country where u.id_user = '{$_SESSION['id_user']}'";
$query_tpdl = "SELECT c.locality As residence_city from users u join applicants a on u.id_user=a.id_user join cities c on a.id_city=c.id_city join countries co on a.id_country=co.id_country where u.id_user = '{$_SESSION['id_user']}'";
$query_tx = "SELECT e.job, e.employer, e.start_job, e.end_job, c.locality As job_city, e.description As job_description from users u join applicants a on u.id_user=a.id_user join experiences e on a.id_applicants = e.id_applicants join cities c on e.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_tx = "SELECT e.job, e.employer, e.start_job, e.end_job, c.locality As job_city, e.description As job_description from users u join applicants a on u.id_user=a.id_user join experiences e on a.id_applicants = e.id_applicants join cities c on e.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_tx = "SELECT e.job, e.employer, e.start_job, e.end_job, c.locality As job_city, e.description As job_description from users u join applicants a on u.id_user=a.id_user join experiences e on a.id_applicants = e.id_applicants join cities c on e.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_tx = "SELECT e.job, e.employer, e.start_job, e.end_job, c.locality As job_city, e.description As job_description from users u join applicants a on u.id_user=a.id_user join experiences e on a.id_applicants = e.id_applicants join cities c on e.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_tx = "SELECT e.job, e.employer, e.start_job, e.end_job, c.locality As job_city, e.description As job_description from users u join applicants a on u.id_user=a.id_user join experiences e on a.id_applicants = e.id_applicants join cities c on e.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_tx = "SELECT e.job, e.employer, e.start_job, e.end_job, c.locality As job_city, e.description As job_description from users u join applicants a on u.id_user=a.id_user join experiences e on a.id_applicants = e.id_applicants join cities c on e.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_te = "SELECT s.name_school, s.specialization, s.start_learning, s.end_learning, c.locality As school_city, s.description As school_description from users u join applicants a on u.id_user=a.id_user join schools s on a.id_applicants=s.id_applicants join cities c on s.id_city=c.id_city where u.id_user='{$_SESSION['id_user']}'";
$query_tl = "SELECT la.language from users u join applicants a on u.id_user=a.id_user join knowledge k on a.id_applicants=k.id_applicants join languages la on k.id_language=la.id_language where u.id_user = '{$_SESSION['id_user']}'";
$query_tll = "SELECT le.id_level from users u join applicants a on u.id_user=a.id_user join knowledge k on a.id_applicants=k.id_applicants join levels le on k.id_level=le.id_level join languages la on k.id_language=la.id_language where u.id_user = '{$_SESSION['id_user']}'";
$query_ts = "SELECT s.sience from users u join applicants a on u.id_user=a.id_user join holders k on a.id_applicants=k.id_applicants join skills s on s.id_skill=k.id_skill where u.id_user = '{$_SESSION['id_user']}'";
$query_tsl = "SELECT le.id_level from users u join applicants a on u.id_user=a.id_user join holders k on a.id_applicants=k.id_applicants join levels le on k.id_level=le.id_level join skills s on s.id_skill=k.id_skill where u.id_user = '{$_SESSION['id_user']}'";
$query_tcv = "SELECT cv.description As cv_description from users u join applicants a on u.id_user=a.id_user join cv on a.id_applicants=cv.id_applicants join certifications on a.id_applicants=certifications.id_applicants join training t on a.id_applicants=t.id_applicants join applications ap on a.id_applicants=ap.id_applicants join cl on ap.id_application=cl.id_application where u.id_user='{$_SESSION['id_user']}'";
$query_tcl = "SELECT cl.description As cl_description from users u join applicants a on u.id_user=a.id_user join cv on a.id_applicants=cv.id_applicants join certifications on a.id_applicants=certifications.id_applicants join training t on a.id_applicants=t.id_applicants join applications ap on a.id_applicants=ap.id_applicants join cl on ap.id_application=cl.id_application where u.id_user='{$_SESSION['id_user']}'";
$query_tce = "SELECT certifications.descriptions As cert_descriptions from users u join applicants a on u.id_user=a.id_user join cv on a.id_applicants=cv.id_applicants join certifications on a.id_applicants=certifications.id_applicants join training t on a.id_applicants=t.id_applicants join applications ap on a.id_applicants=ap.id_applicants join cl on ap.id_application=cl.id_application where u.id_user='{$_SESSION['id_user']}'";
$query_tco = "SELECT t.description As course_description from users u join applicants a on u.id_user=a.id_user join cv on a.id_applicants=cv.id_applicants join certifications on a.id_applicants=certifications.id_applicants join training t on a.id_applicants=t.id_applicants join applications ap on a.id_applicants=ap.id_applicants join cl on ap.id_application=cl.id_application where u.id_user='{$_SESSION['id_user']}'";

// fetch data and add it to .json file
function fetchData($query, &$data_push, &$array, $host, $db_user, $db_pass, $db_name) {

    $connection = new mysqli($host, $db_user, $db_pass, $db_name);
    if ($connection->connect_errno != 0) {
        $connection->close();
        throw new Exception(mysqli_connect_errno());
    }
    else {
        $table = $connection->query($query);
        if (!$table) {
            throw new Exception($connection->error);
        }
        while ($assoc = $table->fetch_assoc()) {
            foreach ($assoc as $key => $value) {
                @array_push($data_push, $value);
                $array = $data_push;
            }
        }
        $connection->close();
        return $table->num_rows;
    }

}


// connect with db
mysqli_report(MYSQLI_REPORT_STRICT);
try
{
    $count_tpd = fetchData($query_tpdn, $data_push_tpd, $json_array['personal-data'], $host, $db_user, $db_pass, $db_name);
    $count_tx = fetchData($query_tx, $data_push_tx, $json_array['experience'], $host, $db_user, $db_pass, $db_name);
    $count_te = fetchData($query_te, $data_push_te, $json_array['education'], $host, $db_user, $db_pass, $db_name);
    $count_tl = fetchData($query_tl, $data_push_tl, $json_array['skills']['languages']['lang'], $host, $db_user, $db_pass, $db_name);
    $count_tll = fetchData($query_tll, $data_push_tll, $json_array['skills']['languages']['level'], $host, $db_user, $db_pass, $db_name);
    $count_ts = fetchData($query_ts, $data_push_ts, $json_array['skills']['skills']['skill'], $host, $db_user, $db_pass, $db_name);
    $count_tsl = fetchData($query_tsl, $data_push_tsl, $json_array['skills']['skills']['level'], $host, $db_user, $db_pass, $db_name);
    $count_tcv = fetchData($query_tcv, $data_push_tcv, $json_array['additional']['cv'], $host, $db_user, $db_pass, $db_name);
    $count_tcl = fetchData($query_tcl, $data_push_tcl, $json_array['additional']['cover-letter'], $host, $db_user, $db_pass, $db_name);
    $count_tce = fetchData($query_tce, $data_push_tce, $json_array['additional']['certificates'], $host, $db_user, $db_pass, $db_name);
    $count_tco = fetchData($query_tco, $data_push_tco, $json_array['additional']['courses'], $host, $db_user, $db_pass, $db_name);
    /*$connection = new mysqli($host, $db_user, $db_pass, $db_name);
    if ($connection->connect_errno != 0)
    {
        throw new Exception(mysqli_connect_errno());
    }
    else
    {
        //echo $count_tx;
        // table 1
        $table_personal_data = $connection->query($query_tpd);
        if (!$table_personal_data)
            {
                throw new Exception($connection->error);
            }
        while ($assoc_tpd = $table_personal_data->fetch_assoc())
        {
            foreach ($assoc_tpd as $key=>$value)
            {
                array_push($data_push_tpd, $value);
                $json_array['personal-data'] = $data_push_tpd;
            }
        }
        // table 2
        $table_experience = $connection->query($query_tx);
        if (!$table_experience)
        {
            throw new Exception($connection->error);
        }
        $count_tx = $table_experience->num_rows;
        while ($assoc_tx = $table_experience->fetch_assoc())
        {
            foreach ($assoc_tx as $key=>$value)
            {
                array_push($data_push_tx, $value);
                $json_array['experience'] = $data_push_tx;
            }
        }

        // table 3
        $table_education = $connection->query($query_te);
        if (!$table_education)
        {
            throw new Exception($connection->error);
        }
        $count_te = $table_education->num_rows;
        while ($assoc_te = $table_education->fetch_assoc())
        {
            foreach ($assoc_te as $key=>$value)
            {
                array_push($data_push_te, $value);
                $json_array['education'] = $data_push_te;
            }
        }

        // table 4.1
        $table_lang = $connection->query($query_tl);
        $table_lang_level = $connection->query($query_tll);
        if (!$table_lang || !$table_lang_level)
        {
            throw new Exception($connection->error);
        }
        $count_tl = $table_lang->num_rows;
        while ($assoc_tl = $table_lang->fetch_assoc())
        {
                foreach ($assoc_tl as $key=>$value)
                {
                    array_push($data_push_tl, $value);
                    $json_array['skills']['languages']['lang'] = $data_push_tl;
                }
        }
        while ((int)$assoc_tll = $table_lang_level->fetch_assoc())
        {
            foreach ($assoc_tll as $keyL=>$valueL)
            {
                foreach ($assoc_tll as $key=>$value)
                {
                    array_push($data_push_tll, $value);
                    $json_array['skills']['languages']['level'] = $data_push_tll;
                }
            }
        }

        // table 4.2
        $table_skills = $connection->query($query_ts);
        $table_skills_level = $connection->query($query_tsl);
        if (!$table_skills || !$table_skills_level)
        {
            throw new Exception($connection->error);
        }
        $count_ts = $table_skills->num_rows;

        while ($assoc_ts = $table_skills->fetch_assoc())
        {
               foreach ($assoc_ts as $key=>$value)
                {
                    array_push($data_push_ts, $value);
                    $json_array['skills']['skills']['skill'] = $data_push_ts;
                }
        }
        while ($assoc_tsl = $table_skills_level->fetch_assoc()) // TODO incorrect query
        {
            foreach ($assoc_tsl as $key=>$value)
            {
                array_push($data_push_tsl, $value);
                $json_array['skills']['skills']['level'] = $data_push_tsl;
            }
        }

        // table 5.1
        $table_cv = $connection->query($query_tcv);
        if (!$table_cv)
        {
            throw new Exception($connection->error);
        }
        $count_tcv = $table_cv->num_rows;
        while ($assoc_tcv = $table_cv->fetch_assoc())
        {
            foreach ($assoc_tcv as $key=>$value)
            {
                array_push($data_push_tcv, $value);
                $json_array['additional']['cv'] = $data_push_tcv;
            }
        }
        // table 5.2
        $table_cl = $connection->query($query_tcl);
        if (!$table_cl)
        {
            throw new Exception($connection->error);
        }
        $count_tcl = $table_cl->num_rows;
        while ($assoc_tcl = $table_cl->fetch_assoc())
        {
            foreach ($assoc_tcl as $key=>$value)
            {
                array_push($data_push_tcl, $value);
                $json_array['additional']['cover-letter'] = $data_push_tcl;
            }
        }
        // table 5.3
        $table_ce = $connection->query($query_tce);
        if (!$table_ce)
        {
            throw new Exception($connection->error);
        }
        $count_tce = $table_ce->num_rows;
        while ($assoc_tce = $table_ce->fetch_assoc())
        {
            foreach ($assoc_tce as $key=>$value)
            {
                array_push($data_push_tce, $value);
                $json_array['additional']['certificates'] = $data_push_tce;
            }
        }
        // table 5.4
        $table_co = $connection->query($query_tco);
        if (!$table_co)
        {
            throw new Exception($connection->error);
        }
        $count_tco = $table_co->num_rows;
        while ($assoc_tco = $table_co->fetch_assoc())
        {
            foreach ($assoc_tco as $key=>$value)
            {
                array_push($data_push_tco, $value);
                $json_array['additional']['courses'] = $data_push_tco;
            }
        }


    }*/
    //fill .json file with data from db
    $fp = fopen('profile_data.json', 'w');
    fwrite($fp, json_encode($json_array));
    fclose($fp);

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
    <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="//code.jquery.com/jquery.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
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
                    <div class="line2"></div> <!-- Operacja plastyczna zakonczona niepowodzeniem. Na szczescie chirurgowi udało sie przywrócic pierwotną forme pacjenta-->
                </div>
            </div>
        </div>
        <div class="list-row hide" id="personal-data">
            <div class="element-wrapper">
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
            </div>
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
        <div class="element-wrapper">
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
        </div>
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
    <div class="element-wrapper">
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
    </div>
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
    <div class="element-wrapper">
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
        <div class="form-row relative">
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
    </div>
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
    <div class="element-wrapper">
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
            <input type="file" name="lm-file" class="inputfile" value="" accept="application/pdf" data-multiple-caption="{count} files selected" multiple>
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
    </div>
    </div>
        <?php
        //$profileInstance->fetchData($host, $db_user, $db_pass, $db_name);
        //$profileInstance->displayExperience();
        //$profileInstance->displayEducation();
       // $profileInstance->displaySkills();
        //$profileInstance->displayAdditional();
        // Porwałem twoje divy
        // i nie oddam
        ?>
    </div>
</body>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<script src="script/main.js"></script>
<script src="script/burger.js"></script>
<script src="script/calendar.js"></script>
<script src="script/sign-up.js"></script>
<script src="script/profile.js"></script>
</html>