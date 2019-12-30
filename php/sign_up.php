<?php
session_start();
require_once "FormsValidation.php";
// DB connection
require_once "connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);
$sign_up_class = new FormsValidation(true);

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
    while (isset($_POST['job-title-' . $i])) // TODO kurwa ja jestem deklem
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

// Form 5
if (isset($_FILES['cv[]']) || isset($_FILES['certificate[]']))
{
    // TODO upload files
    // Validate cv
    $cv = 'cv[]';
    if (isset($_FILES['cv[]'])) {
        // $sign_up_class->validateFile($cv, false, 'cv');
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
$_SESSION['form5cv'] = true; // |
$_SESSION['form5ce'] = true; // |
$_SESSION['form5co'] = true; // |
//------------------------------+
if ( isset($_SESSION['form1']) && isset($_SESSION['form2']) && isset($_SESSION['form3']) && isset($_SESSION['form4l']) && isset($_SESSION['form4sk']) && isset($_SESSION['form4s']) && isset($_SESSION['form5cv']) && isset($_SESSION['form5ce']) && isset($_SESSION['form5co']) )
    if (($_SESSION['form1'] == true) && ($_SESSION['form2'] == true) && ($_SESSION['form3'] == true) && ($_SESSION['form4l'] == true) &&($_SESSION['form4sk'] == true) && ($_SESSION['form4s'] == true) && ($_SESSION['form5cv'] == true) && ($_SESSION['form5ce'] == true) &&($_SESSION['form5co'] == true))
    {
        echo "ales gut";
        $sign_up_class->dispInJson();
        try {
            $conn = new mysqli($host, $db_user, $db_pass, $db_name);
            if ($conn->connect_errno!=0) {
                throw new Exception(mysqli_connect_errno());
            } else {
                if ($conn->query("insert into users (id_user, login, name, surname, pass, id_role) VALUES (null, '{$_SESSION['array']['val']['username']}', '{$_SESSION['array']['pd']['first_name']}', '{$_SESSION['array']['pd']['last_name']}', '{$_SESSION['array']['val']['password']}', 2)" ) ){

                    $cv_Q = $conn->query("select id_cv from cv order by id_cv desc limit 1");
                    $city_Q = $conn->query("select id_city from cv order by id_cv desc limit 1");
                    $user_Q = $conn->query("select id_user from cv order by id_cv desc limit 1");
                    $certificate_Q = $conn->query("select id_certificate from cv order by id_cv desc limit 1");
                    $country_Q = $conn->query("select id_country from countries where country = '{$$_SESSION['array']['pd']['residence-country']}'");
                    if ($conn->query("insert into applicants (id_applicants, phone, email, id_cv, id_city, id_user, id_certificate, id_country) VALUES (null, '{$_SESSION['array']['pd']['phone']}', '{$_SESSION['array']['val']['email']}', {$cv_Q['id_cv']++}, 1, 2, 1, 1)")){
                        $_SESSION['successful-sign-up'] = true;
                        header ('Location: sing_in.php');
                    } else {
                        throw new Exception($conn->error);
                    }
                } else {
                    throw new Exception($conn->error);
                }
            }

        }catch (Exception $e){
            echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
        }
    }


// TODO unset insert values
// $sign_up_class->dispInJson();

unset($sign_up_class);