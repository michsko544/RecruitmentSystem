<?php
session_start();
require_once "SignUpSystem.php";
// DB connection
require_once "../connect.php";
mysqli_report(MYSQLI_REPORT_STRICT);


//Form 1
if (isset($_POST['e-mail']))
{

    $sign_up_class = new SignUpSystem(true);
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

    // Validate position TODO get position
    $position = $_POST['position'];


    // Validate terms of use
    if (!isset($_POST['terms-of-use']))
    {
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
            $count_input = $result_position->num_rows;
            if ($count_input == 0)
            {
                $sign_up_class->notGood('err_position', 'Position currently unavailable');
            }

            if ($sign_up_class->checkFlag() == true)
            {
                // Add to array and wait
                echo 'dzialato';
                $sign_up_class->setInsertValue('username', $username);
                $sign_up_class->setInsertValue('email', $email);
                $sign_up_class->setInsertValue('password', $hashed_password);
                $sign_up_class->setInsertValue('position', $position);
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
    if (ctype_alpha($residence_country) == false)
    {
        $sign_up_class->notGood('err_residence_country', 'Country name may contain only letters');
    }
    //TODO add country list (from db)

    //Validate city
    $residence_city = $_POST['residence-city'];
    if (ctype_alpha($residence_city) == false)
    {
        $sign_up_class->notGood('err_residence_city', 'City name may contain only letters');
    }
    
    // Remember value
    $_SESSION['rem_first_name'] = $first_name;
    $_SESSION['rem_last_name'] = $last_name;
    $_SESSION['rem_phone'] = $phone;
    $_SESSION['rem_residence_country'] = $residence_country;
    $_SESSION['rem_residence_city'] = $residence_city;

    try
    {
        $connection = new mysqli($host, $db_user, $db_pass, $db_name);
        if ($connection->connect_errno != 0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            if ($sign_up_class->checkFlag() == true)
            {
                // Add to session variables and wait for other steps
               // $_SESSION['insert_first_name'] = $first_name;
               // $_SESSION['insert_last_name'] = $last_name;
               // $_SESSION['insert_phone'] = $phone;
               // $_SESSION['insert_residence_country'] = $residence_country;
               // $_SESSION['insert_residence_city'] = $residence_city;

                //Add to array and wait
                $sign_up_class->setInsertValue('first_name', $first_name);
                $sign_up_class->setInsertValue('last_name', $last_name);
                $sign_up_class->setInsertValue('phone', $phone);
                $sign_up_class->setInsertValue('residence_country', $residence_country);
                $sign_up_class->setInsertValue('residence_city', $residence_city);
            }
            $connection->close();
        }
    }
    catch(Exception $e)
    {
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
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
 $experience_count = $_GET['exp-count'];
if (isset($_POST['job-title-0']))
{
    for($i=0; $i<$experience_count; $i++)
    {
        $job_title = $_POST['job-title-' . $i];
        $no_experience = $_POST['no-experience'];
        $employer = $_POST['employer-' . $i];
        $job_city = $_POST['job-city-' . $i];
        $job_description = $_POST['job-description-' . $i];
        $sign_up_class->validateForm3($job_title, $no_experience, $employer, $job_city, $job_description, $host, $db_user, $db_pass, $db_name);
    }
}

/*
if (isset($_POST['job-title']))
{
    if ($_POST['no-experience'] == false)
    {
        // Validate job title
        $job_title = $_POST['job- title'];
        if (ctype_alnum($job_title) == false)
        {
            $sign_up_class->notGood('err_job_title', 'Job title may only contain letters and numbers');
        }
        if (strlen($job_title) > 40)
        {
            $sign_up_class->notGood('err_job_title', 'Job title must have less than 40 characters');
        }

        // Validate employer
        $employer = $_POST['employer'];
        if (ctype_alnum($employer) == false)
        {
            $sign_up_class->notGood('err_employer', 'Employer name may only contain letters and numbers');
        }
        if (strlen($employer) > 40)
        {
            $sign_up_class->notGood('err_employer', 'Employer name must have less than 40 characters');
        }

        // Validate date
        // TODO czy end jest po start

        //Validate city
        $job_city = $_POST['job-city'];
        if (ctype_alpha($job_city) == false)
        {
            $sign_up_class->notGood('err_job_city', 'City name may contain only letters');
        }

        // Validate description
        $job_description = $_POST['job-description'];
        if (ctype_alnum($job_description) == false)
        {
            $sign_up_class->notGood('err_job_description', 'Description may only contain letters and numbers');
        }
        if (strlen($job_description) > 500)
        {
            $sign_up_class->notGood('err_job_description', 'Description must have less than 500 characters');
        }
        // Remember value
        $_SESSION['rem_job_title'] = $job_title;
        $_SESSION['rem_employer'] = $employer;
       // TODO $_SESSION['rem_start_date'] = ;
       // TODO $_SESSION['rem_end_date'] = ;
        $_SESSION['rem_job_city'] = $job_city;
        $_SESSION['rem_description'] = $job_description;

        try
        {
            $connection = new mysqli($host, $db_user, $db_pass, $db_name);
            if ($connection->connect_errno != 0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                if ($sign_up_class->checkFlag() == true)
                {
                    //Add to array and wait
                    $sign_up_class->setInsertEmploymentValues('job_title', $job_title);
                    $sign_up_class->setInsertEmploymentValues('employer', $employer);
                    // TODO $sign_up_class->setInsertEmploymentValues('star_date', $);
                    // TODO $sign_up_class->setInsertEmploymentValues('end_date', $);
                    $sign_up_class->setInsertEmploymentValues('job_city', $job_city);
                    $sign_up_class->setInsertEmploymentValues('description', $job_description);
                }
                $connection->close();
            }
        }
        catch(Exception $e)
        {
            echo 'Server error! Try signing up later';
        }

        // Unset remembered values
        if (isset($_SESSION['rem_job_title'])) unset($_SESSION['rem_job_title']);
        if (isset($_SESSION['rem_employer'])) unset($_SESSION['rem_employer']);
        // TODO if (isset($_SESSION['rem_start_date'])) unset($_SESSION['rem_start_date']);
        // TODO if (isset($_SESSION['rem_end_date'])) unset($_SESSION['rem_end_date']);
        if (isset($_SESSION['rem_job_city'])) unset($_SESSION['rem_job_city']);
        if (isset($_SESSION['rem_description'])) unset($_SESSION['rem_description']);
        // Unset error values
        if (isset($_SESSION['err_job_title'])) unset($_SESSION['err_job_title']);
        if (isset($_SESSION['err_employer'])) unset($_SESSION['err_employer']);
        // TODO if (isset($_SESSION['err_start_date'])) unset($_SESSION['err_start_date']);
        // TODO if (isset($_SESSION['err_end_date'])) unset($_SESSION['err_end_date']);
        if (isset($_SESSION['err_job_city'])) unset($_SESSION['err_job_city']);
        if (isset($_SESSION['err_description'])) unset($_SESSION['err_description']);
    }
    else
    {
        // TODO co robic gdy nie ma doswiadczenia -- chyba nic
    }
}
*/

// Form 4
$school_count = $_GET['school-count'];
if (isset($_POST['languages-0']))
{
    for($i=0; $i<$school_count; $i++)
    {
        $language = $_POST['languages-' . $i];
        $language_level = $_POST['language-level-' . $i];
        $skill = $_POST['skill-' . $i];
        $skill_level = $_POST['skill-level-' . $i];
        $school = $_POST['school-' . $i];
        $specialization = $_POST['specialization-' . $i];
        $school_start_date = $_POST['school-start-date-' . $i];
        $school_end_date = $_POST['school-end-date-' . $i];
        $school_city = $_POST['school-city-' . $i];
        $school_description = $_POST['school-description-' . $i];
        $sign_up_class->validateForm4($language, $language_level, $skill, $skill_level, $school, $specialization, $school_start_date, $school_end_date, $school_city, $school_description, $host, $db_user, $db_pass, $db_name);
    }
}
/*
if (isset($_POST['languages']))
{
    // Validate language
    $language = $_POST['languages'];
    // TODO validate
    $language_level = $_POST['language_level'];
    if (($language_level < 1) && ($language_level > 5))
    {
        $sign_up_class->notGood('err_language_level', 'Language level must be between 1 and 5');
    }
    // Validate skills
    $skill = $_POST['skills'];
    // TODO validate
    $skill_level = $_POST['skill_level'];
    if (($skill_level < 1) && ($skill_level > 5))
    {
        $sign_up_class->notGood('err_skill_level', 'Skill level must be between 1 and 5');
    }
    // TODO add insert etc.

    $school = $_POST['school'];
    if (ctype_alnum($school) == false)
    {
        $sign_up_class->notGood('err_school', 'School name may only contain letters and numbers');
    }
    $specialization = $_POST['specialization'];
    if (ctype_alnum($specialization) == false)
    {
        $sign_up_class->notGood('err_specialization', 'Specialization name may only contain letters and numbers');
    }
    $school_start_date = $_POST['start-date'];
    // TODO add validation
    $school_end_date = $_POST['end-date'];
    // TODO add validation
    $school_city = $_POST['school-city'];
    if (ctype_alpha($school_city) == false)
    {
        $sign_up_class->notGood('err_school_city', 'City name may contain only letters');
    }
    $school_description = $_POST['school-description'];
    if (ctype_alnum($school_description) == false)
    {
        $sign_up_class->notGood('err_school_description', 'Description may only contain letters and numbers');
    }
    if (strlen($school_description) > 500)
    {
        $sign_up_class->notGood('err_school_description', 'Description must have less than 500 characters');
    }
    // Remember value TODO change to skills and school
    $_SESSION['rem_language'] = $language;
    $_SESSION['rem_language_level'] = $language_level;
    $_SESSION['rem_skill'] = $skill;
    $_SESSION['rem_skill_level'] = $skill_level;
    $_SESSION['rem_school'] = $school;
    $_SESSION['rem_specialization'] = $specialization;
    $_SESSION['rem_school_start_date'] = $school_start_date;
    $_SESSION['rem_school_end_date'] = $school_end_date;
    $_SESSION['rem_school_city'] = $school_city;
    $_SESSION['rem_school_description'] = $school_description;
    try
    {
        $connection = new mysqli($host, $db_user, $db_pass, $db_name);
        if ($connection->connect_errno != 0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            if ($sign_up_class->checkFlag() == true)
            {
                //Add to array and wait
                $sign_up_class->setInsertSkillLanguageValues('language', $language);
                $sign_up_class->setInsertSkillLanguageValues('language_level', $language_level);
                $sign_up_class->setInsertSkillLanguageValues('skill', $skill);
                $sign_up_class->setInsertSkillLanguageValues('skill_level', $skill_level);
                $sign_up_class->setInsertSchoolValues('school', $school);
                $sign_up_class->setInsertSchoolValues('specialization', $specialization);
                $sign_up_class->setInsertSchoolValues('start_date', $school_start_date);
                $sign_up_class->setInsertSchoolValues('end_date', $school_end_date);
                $sign_up_class->setInsertSchoolValues('city', $school_city);
                $sign_up_class->setInsertSchoolValues('description', $school_description);
            }
            $connection->close();
        }
    }
    catch(Exception $e)
    {
        echo 'Server error! Try signing up later';
    }

    // Unset remembered values
    if (isset($_SESSION['rem_language'])) unset($_SESSION['rem_language']);
    if (isset($_SESSION['rem_language_level'])) unset($_SESSION['rem_language_level']);
    if (isset($_SESSION['rem_skill'])) unset($_SESSION['rem_skill']);
    if (isset($_SESSION['rem_skill_level'])) unset($_SESSION['rem_skill_level']);
    if (isset($_SESSION['rem_school'])) unset($_SESSION['rem_school']);
    if (isset($_SESSION['rem_specialization'])) unset($_SESSION['rem_specialization']);
    // TODO if (isset($_SESSION['rem_school_start_date'])) unset($_SESSION['rem_school_start_date']);
    // TODO if (isset($_SESSION['rem_school_end_date'])) unset($_SESSION['rem_school_end_date']);
    if (isset($_SESSION['rem_school_city'])) unset($_SESSION['rem_school_city']);
    if (isset($_SESSION['rem_school_description'])) unset($_SESSION['rem_school_description']);
    // Unset error values
    if (isset($_SESSION['err_language'])) unset($_SESSION['err_language']);
    if (isset($_SESSION['err_language_level'])) unset($_SESSION['err_language_level']);
    if (isset($_SESSION['err_skill'])) unset($_SESSION['err_skill']);
    if (isset($_SESSION['err_skill_level'])) unset($_SESSION['err_skill_level']);
    if (isset($_SESSION['err_school'])) unset($_SESSION['err_school']);
    if (isset($_SESSION['err_specialization'])) unset($_SESSION['err_specialization']);
    // TODO if (isset($_SESSION['err_school_start_date'])) unset($_SESSION['err_school_start_date']);
    // TODO if (isset($_SESSION['err_school_end_date'])) unset($_SESSION['err_school_end_date']);
    if (isset($_SESSION['err_school_city'])) unset($_SESSION['err_school_city']);
    if (isset($_SESSION['err_school_description'])) unset($_SESSION['err_school_description']);
}*/

// Form 5

$cert_count = $_GET['cert-count'];
$course_count = $_GET['course-count'];
if (isset($_POST['cv-file']))
{
    $cv = $_POST['cv'];
    $cover_letter = $_POST['cover-letter'];
    // Validate cv
    $file_format = pathinfo($cv);
    if ($file_format['extension'] != "pdf")
    {
        $this->notGood('err_cover_letter_file', 'File must have .pdf extension');
    }
    // Validate cover letter
    $file_format = pathinfo($cover_letter);
    if ($file_format['extension'] != "pdf")
    {
        $this->notGood('err_cover_letter_file', 'File must have .pdf extension');
    }

    for($i=0; $i<$cert_count; $i++)
    {
        $cert = $_POST['cert-' . strval($i)];
        $sign_up_class->validateFile($cert, $host, $db_user, $db_pass, $db_name);
    }
    for($i=0; $i<$course_count; $i++)
    {
        $course = $_POST['course-' . strval($i)];
        $sign_up_class->validateForm5Co($course, $host, $db_user, $db_pass, $db_name);
    }
}

/*
if (isset($_POST['cv-file']))
{
    // Validate cv
    $cv = $_POST['cv-file'];
    $file_format = pathinfo($cv);
    if ($file_format['extension'] != "pdf")
    {
        $sign_up_class->notGood('err_cv_file', 'File must have .pdf extension');
    }
    // Validate certificate
    $cert = $_POST['certificate-file'];
    $file_format = pathinfo($cert);
    if ($file_format['extension'] != "pdf")
    {
        $sign_up_class->notGood('err_certificate_file', 'File must have .pdf extension');
    }

    // Validate cover letter
    $cover_letter = $_POST['lm-file'];
    $file_format = pathinfo($cover_letter);
    if ($file_format['extension'] != "pdf")
    {
        $sign_up_class->notGood('err_cover_letter_file', 'File must have .pdf extension');
    }

    // Validate course
    $course = $_POST['course'];
    if (ctype_alnum($course) == false)
    {
        $sign_up_class->notGood('err_course', 'Course name may contain only letters and numbers');
    }
    if (strlen($course) > 30)
    {
        $sign_up_class->notGood('err_course', 'Course name must have less than 30 characters');
    }

    // Remember values
    $_SESSION['rem_cv'] = $cv;
    $_SESSION['rem_certificate'] = $cert;
    $_SESSION['rem_cover_letter'] = $cover_letter;
    $_SESSION['rem_course'] = $course;

    try
    {
        $connection = new mysqli($host, $db_user, $db_pass, $db_name);
        if ($connection->connect_errno != 0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            if ($sign_up_class->checkFlag() == true)
            {
                //Add to array and wait
                $sign_up_class->setInsertValue('cv_file', $cv);
                $sign_up_class->setInsertCertSkillValues('certificate', $cert);
                $sign_up_class->setInsertValue('cover_letter', $cover_letter);
                $sign_up_class->setInsertCertSkillValues('course', $course);
            }
            $connection->close();
        }
    }
    catch(Exception $e)
    {
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
    }
}
*/

// TODO unset insert values

unset($sign_up_class);