<?php
session_start();
require_once "FormsValidation.php";
require_once "InsertToDB.php";
require "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);
$sign_up_class = new FormsValidation(true);
$db_insert = new InsertToDB($host, $db_user, $db_pass, $db_name);
//Form 1
if (isset($_POST['e-mail']))
{
    $username = $_POST['login'];
    $email = $_POST['e-mail'];
    $password_one = $_POST['password-one'];
    $password_two = $_POST['password-two'];
    $position = $_POST['position'];
    $sign_up_class->validateForm1($username, $email, $password_one, $password_two, $position, $host, $db_user, $db_pass, $db_name);
}

//Form 2
if (isset($_POST['first-name']))
{
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $phone = $_POST['phone-num'];
    $residence_country = $_POST['residence-country'];
    $residence_city = $_POST['residence-city'];
    $sign_up_class->validateForm2($first_name, $last_name, $phone, $residence_country, $residence_city, $host, $db_user, $db_pass, $db_name);
}

//Form 3
if (isset($_POST['job-title-0']))
{
    $i = 0;
    while (isset($_POST['job-title-' . $i]))
    {
        echo "while i=" . $i;
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
        $sign_up_class->validateForm3($job_title, $no_experience, $employer, $start_date, $end_date, $job_city, $job_description);
        $i++;
    }
}

// Form 4
if (isset($_POST['languages-0']))
{
    $i = 0;
    while (isset($_POST['languages-'.$i]))
    {
        $language = $_POST['languages-' . $i];
        $language_level = $_POST['language-level-' . $i];
        $sign_up_class->validateForm4L($language, $language_level);
        $i++;
    }
    $j = 0;
    while (isset($_POST['skills-'.$j]))
    {
        $skill = $_POST['skills-' . $j];
        $skill_level = $_POST['skill-level-' . $j];
        $sign_up_class->validateForm4Sk($skill, $skill_level);
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
        $sign_up_class->validateForm4S($school, $specialization, $school_start_date, $school_end_date, $school_city, $school_description);
        $k++;
    }
}

// Form 5  dodawanie plikow
if (isset($_FILES['cv[]']) || isset($_FILES['certificate[]']))
{
    // TODO upload files
    // Validate cv
    $cv = 'cv[]';
    if (isset($_FILES['cv[]'])) {
        // $sign_up_class->validateFile($cv, false, 'cv');
        // ***********************UPLOAD FILE**********************************
        $uploads_dir = '/uploads';
        echo $_FILES['cv[]']['error'];
        foreach ($_FILES["cv[]"]["error"] as $key => $error) {
            if ($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["cv[]"]["tmp_name"][$key];
                // basename() may prevent filesystem traversal attacks;
                // further validation/sanitation of the filename may be appropriate
                $name = basename($_FILES["cv[]"]["name"][$key]);
                move_uploaded_file($tmp_name, "$uploads_dir/$name");
                $sign_up_class->setInsertValue('cv[]', $name);
                $sign_up_class->itWorks("file is up");
            }
        }
    }
        // ********************************************************************

    // Validate cover letter
    $cover_letter = 'cover-letter';
    if (isset($_FILES['cover-letter']))
        $sign_up_class->validateFile($cover_letter, false, 'cover_letter');

    // Validate certificate
    $cert = 'certificate[]';
    if (isset($_FILES['certificate[]']))
        $sign_up_class->validateFile($cert, true, 'certificate');

    // Validate course
    $j = 0;
    while (isset($_POST['course-' . $j]))
    {
        $course = $_POST['course-' . $j];
        $sign_up_class->validateForm5Co($course);
        $j++;
    }
}
// For testing only
//------------------------------+
//$_SESSION['form5cv'] = true; // |
//$_SESSION['form5ce'] = true; // |
//$_SESSION['form5'] = true; // |
//------------------------------+
if ( isset($_SESSION['form1']) && isset($_SESSION['form2']) && isset($_SESSION['form3']) && isset($_SESSION['form4l']) && isset($_SESSION['form4sk']) && isset($_SESSION['form4']) && isset($_SESSION['form5cv']) && isset($_SESSION['form5ce']) && isset($_SESSION['form5']) )
    if (($_SESSION['form1'] == true) && ($_SESSION['form2'] == true) && ($_SESSION['form3'] == true) && ($_SESSION['form4l'] == true) &&($_SESSION['form4sk'] == true) && ($_SESSION['form4'] == true) && ($_SESSION['form5cv'] == true) && ($_SESSION['form5ce'] == true) &&($_SESSION['form5'] == true))
    {
        echo "ales gut";
        unset($_SESSION['form1']);
        unset($_SESSION['form2']);
        unset($_SESSION['form3']);
        unset($_SESSION['form4l']);
        unset($_SESSION['form4sk']);
        unset($_SESSION['form4s']);
        unset($_SESSION['form5cv']);
        unset($_SESSION['form5ce']);
        unset($_SESSION['form5co']);
        $sign_up_class->dispInJson();
        try {
            $db_insert->insertSignUp();
        }catch (Exception $e){
            require_once "addError.php";
            addError($e);
            echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
        }
    }


// TODO unset insert values
// $sign_up_class->dispInJson();

unset($sign_up_class);