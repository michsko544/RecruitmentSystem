<?php
session_start();
require_once "SignUpSystem.php";
// DB connection
require_once "../connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);
$sign_up_class = new SignUpSystem(true);


//Form 1
if (isset($_POST['e-mail']))
{
    // Validate username
    $username = $_POST['login'];
    if ((strlen($username) < 3) || (strlen($username) > 20))
    {
        $sign_up_class->notGood('err_username', 'Username must have more than 3 and less than 20 characters');
    }
    if (ctype_alnum($username) == false)
    {
        $sign_up_class->notGood('err_username', 'Username must contain only letters and numbers');
    }

    // Validate e-mail
    $email = $_POST['e-mail'];
    $sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);
    if ((filter_var($sanitized_email, FILTER_VALIDATE_EMAIL) == false) || ($sanitized_email != $email))
    {
        $sign_up_class->notGood('err_email', 'Incorrect e-mail address');
    }

    // Validate password
    $password_one = $_POST['password-one'];
    $password_two = $_POST['password-two'];
    if ((strlen($password_one) < 8) || (strlen($password_one) > 30))
    {
        $sign_up_class->notGood('err_password', 'Password must have more than 8 and less than 30 characters');
    }
    if ($password_one != $password_two)
    {
        $sign_up_class->notGood('err_password', 'Passwords are not identical');
    }
    $hashed_password = password_hash($password_one, PASSWORD_DEFAULT);

    // Validate position
    $position = $_POST['position'];

    // Validate terms of use
    if (!isset($_POST['terms-of-use']))
    {
       $correct_data = false;
       $sign_up_class->notGood('err_terms', 'You must accept our Terms of Use and Privacy Policy');
    }

    // Validate CAPTCHA TODO add reCAPTCHA

    // Remember value
    $_SESSION['rem_username'] = $username;
    $_SESSION['rem_email'] = $email;
    $_SESSION['rem_password_one'] = $password_one;
    $_SESSION['rem_password_two'] = $password_two;
    $_SESSION['rem_position'] = $position;
    if (isset($_POST['terms-of-use'])) {
        $_SESSION['rem_terms'] = true;
    }

    try
    {
        $connection = new mysqli($host, $db_user, $db_pass, $db_name);
        if ($connection->connect_errno != 0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            // Validate email uniqueness
            $result_email = $connection->query("SELECT id_user FROM applicants WHERE email='$email'");
            if (!$result_email)
            {
                throw new Exception($connection->error);
            }
            $count_input = $result_email->num_rows;
            if ($count_input > 0)
            {
                $sign_up_class->notGood('err_email', 'Unavailable e-mail address');
            }
            // Validate username uniqueness
            $result_username = $connection->query("SELECT id_user FROM users WHERE login='$username'");
            if (!$result_username)
            {
                throw new Exception($connection->error);
            }
            $count_input = $result_username->num_rows;
            if ($count_input > 0)
            {
                $sign_up_class->notGood('err_username', 'Unavailable username');
            }
            // Validate position with db
            $result_position = $connection->query("SELECT id_position FROM positions WHERE position = '{$position}'");
            if (!$result_position)
            {
                throw new Exception($connection->error);
            }
            else
            {
                $count_input = $result_position->num_rows;
                if ($count_input == 0)
                {
                    $sign_up_class->notGood('err_position', 'Position currently unavailable');
                }
            }

            if ($sign_up_class->checkFlag() == true)
            {
                // Add to array and wait
                $sign_up_class->setInsertValue('username', $username);
                $sign_up_class->setInsertValue('email', $email);
                $sign_up_class->setInsertValue('password', $hashed_password);
                $sign_up_class->setInsertValue('position', $position);

                $sign_up_class->itWorks("form1");
            }
            $connection->close();
            //exit();

        }
    }
    catch(Exception $e)
    {
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
    }
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
}

//Form 2
if (isset($_POST['first-name']))
{
    // Validate first name
    $first_name = $_POST['first-name'];
    if (ctype_alpha($first_name) == false)
    {
        $sign_up_class->notGood('err_first_name', 'First name may contain only letters');
    }

    //Validate last name
    $last_name = $_POST['last-name'];
    if (ctype_alpha($last_name) == false)
    {
        $sign_up_class->notGood('err_last_name', 'Last name may contain only letters');
    }

    //Validate phone number
    $phone = $_POST['phone-num'];
    if (ctype_digit($phone) == false)
    {
        $sign_up_class->notGood('err_phone', 'Phone number may contain only numbers');
    }
    if (strlen($phone) != 9)
    {
        $sign_up_class->notGood('err_phone', 'Phone number must be 9 digits long');
    }

    //Validate country
    $residence_country = $_POST['residence-country'];
    try
    {
        $connection = new mysqli($host, $db_user, $db_pass, $db_name);
        if ($connection->connect_errno != 0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            $result_country = $connection->query("SELECT id_country FROM countries WHERE country = '{$residence_country}'");
            if (!$result_country)
            {
                throw new Exception($connection->error);
            }
            else
            {
                $count_input = $result_country->num_rows;
                if ($count_input == 0)
                {
                    $sign_up_class->notGood('err_residence_country', 'U crazy? Dis ain&apos;t no country');
                }
            }
            $connection->close();
        }
    }
    catch (Exception $e)
    {
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
    }

    //Validate city
    $residence_city = $_POST['residence-city'];
    
    // Remember value
    $_SESSION['rem_first_name'] = $first_name;
    $_SESSION['rem_last_name'] = $last_name;
    $_SESSION['rem_phone'] = $phone;
    $_SESSION['rem_residence_country'] = $residence_country;
    $_SESSION['rem_residence_city'] = $residence_city;

    if ($sign_up_class->checkFlag() == true)
    {
        //Add to array and wait
        $sign_up_class->setInsertValue('first_name', $first_name);
        $sign_up_class->setInsertValue('last_name', $last_name);
        $sign_up_class->setInsertValue('phone', $phone);
        $sign_up_class->setInsertValue('residence_country', $residence_country);
        $sign_up_class->setInsertValue('residence_city', $residence_city);
        $sign_up_class->itWorks('form2');
    }

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
}

//Form 3
if (isset($_POST['job-title-0']))
{
    // $experience_count = $_GET['countE'];
    //for($i=0; $i<$experience_count; $i++)
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
    // $lang_count = $_GET['countL'];
    // $skill_count = $_GET['countSk'];
    // $school_count = $_GET['countS'];
    // for($i=0; $i<$lang_count; $i++)
    $i = 0;
    while (isset($_POST['languages-'.$i]))
    {
        $language = $_POST['languages-' . $i];
        $language_level = $_POST['language-level-' . $i];
        $sign_up_class->validateForm4L($language, $language_level);
        $i++;
    }
    // for($i=0; $i<$skill_count; $i++)
    $j = 0;
    while (isset($_POST['skills-'.$j]))
    {
        $skill = $_POST['skills-' . $j];
        $skill_level = $_POST['skill-level-' . $j];
        $sign_up_class->validateForm4Sk($skill, $skill_level);
        $j++;
    }
    // for($i=0; $i<$school_count; $i++)
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

// TODO unset insert values
$sign_up_class->dispInJson();

unset($sign_up_class);