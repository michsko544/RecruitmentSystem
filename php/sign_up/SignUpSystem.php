<?php
class SignUpSystem
{
private $correct_data = true;
private $insert_values = array(
    'username' => '',
    'email' => '',
    'password' => '',
    'first_name' => '',
    'last_name' => '',
    'phone' => '',
    'position' => '',
    'residence_country' => '',
    'residence_city' => '',
    'cv_file' => '',
    'cover_letter'=> '',
);
private $insert_employment = array(
    'job_title'=>array(),
    'employer'=>array(),
    'start_date'=>array(),
    'end_date'=>array(),
    'city'=>array(),
    'description'=>array(),
);
private $insert_skill_language = array(
    'language'=>array(),
    'language_level'=>array(),
    'skill'=>array(),
    'skill_level'=>array(),
);
private $insert_school = array(
    'school'=>array(),
    'specialization'=>array(),
    'start_date'=>array(),
    'end_date'=>array(),
    'city'=>array(),
    'description'=>array(),
);
private $insert_cert_course = array( // TODO what type is file / how to add it
    'certificate' => array(),
    'cover-letter' => array(),
);

function __construct($flag_status)
{
    $this->correct_data = $flag_status;
}

function setInsertValue($column, $value)
{
    $this->insert_values[$column] = $value;
}

function setInsertEmploymentValues($column, $value)
{
    array_push($this->insert_employment[$column], $value);
}

function setInsertSkillLanguageValues($column, $value)
{
    array_push($this->insert_skill_language[$column], $value);
}

function setInsertSchoolValues($column, $value)
{
    array_push($this->insert_school[$column], $value);
}

function setInsertCertSkillValues($column, $value)
{
    array_push($this->insert_cert_course[$column], $value);
}

function checkFlag()
{
    if ($this->correct_data == true) return true;
    else return false;
}

function notGood($err_name, $err_message)
{
    $this->correct_data = false;
    $_SESSION["$err_name"] = $err_message;
}

function rememberValue($value_name)
{
    if (isset($_SESSION["$value_name"]))
    {
        echo $_SESSION["$value_name"];
        unset($_SESSION["$value_name"]);
    }
}

function setError($error_name)
{
    if (isset($_SESSION["$error_name"]))
    {
        echo '<div class="error">'.$_SESSION["$error_name"].'</div>';
        unset($_SESSION["$error_name"]);
    }
}

function validateForm3($job_title, $no_experience, $employer, $job_city, $job_description, $host, $db_user, $db_pass, $db_name)
{
    if ($no_experience == false)
    {
        // Validate job title
        if (ctype_alnum($job_title) == false)
        {
            $this->notGood('err_job_title', 'Job title may only contain letters and numbers');
        }
        if (strlen($job_title) > 40)
        {
            $this->notGood('err_job_title', 'Job title must have less than 40 characters');
        }

        // Validate employer
        if (ctype_alnum($employer) == false)
        {
            $this->notGood('err_employer', 'Employer name may only contain letters and numbers');
        }
        if (strlen($employer) > 40)
        {
            $this->notGood('err_employer', 'Employer name must have less than 40 characters');
        }

        // Validate date
        // TODO czy end jest po start

        //Validate city
        if (ctype_alpha($job_city) == false)
        {
            $this->notGood('err_job_city', 'City name may contain only letters');
        }

        // Validate description
        if (ctype_alnum($job_description) == false)
        {
            $this->notGood('err_job_description', 'Description may only contain letters and numbers');
        }
        if (strlen($job_description) > 500)
        {
            $this->notGood('err_job_description', 'Description must have less than 500 characters');
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
                if ($this->checkFlag() == true)
                {
                    //Add to array and wait
                    $this->setInsertEmploymentValues('job_title', $job_title);
                    $this->setInsertEmploymentValues('employer', $employer);
                    // TODO $this->setInsertEmploymentValues('star_date', $);
                    // TODO $this->setInsertEmploymentValues('end_date', $);
                    $this->setInsertEmploymentValues('job_city', $job_city);
                    $this->setInsertEmploymentValues('description', $job_description);
                }
                $connection->close();
            }
        }
        catch(Exception $e)
        {
            echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
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

function validateForm4($language, $language_level, $skill, $skill_level, $school, $specialization, $school_start_date, $school_end_date, $school_city, $school_description, $host, $db_user, $db_pass, $db_name)
{
    // Validate language
    // TODO validate
    if (($language_level < 1) && ($language_level > 5))
    {
        $this->notGood('err_language_level', 'Language level must be between 1 and 5');
    }
    // Validate skills
    // TODO validate
    if (($skill_level < 1) && ($skill_level > 5))
    {
        $this->notGood('err_skill_level', 'Skill level must be between 1 and 5');
    }
    // TODO add insert etc.

    if (ctype_alnum($school) == false)
    {
        $this->notGood('err_school', 'School name may only contain letters and numbers');
    }

    if (ctype_alnum($specialization) == false)
    {
        $this->notGood('err_specialization', 'Specialization name may only contain letters and numbers');
    }
    $school_start_date = $_POST['start-date'];
    // TODO add validation
    $school_end_date = $_POST['end-date'];
    // TODO add validation

    if (ctype_alpha($school_city) == false)
    {
        $this->notGood('err_school_city', 'City name may contain only letters');
    }

    if (ctype_alnum($school_description) == false)
    {
        $this->notGood('err_school_description', 'Description may only contain letters and numbers');
    }
    if (strlen($school_description) > 500)
    {
        $this->notGood('err_school_description', 'Description must have less than 500 characters');
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
            if ($this->checkFlag() == true)
            {
                //Add to array and wait
                $this->setInsertSkillLanguageValues('language', $language);
                $this->setInsertSkillLanguageValues('language_level', $language_level);
                $this->setInsertSkillLanguageValues('skill', $skill);
                $this->setInsertSkillLanguageValues('skill_level', $skill_level);
                $this->setInsertSchoolValues('school', $school);
                $this->setInsertSchoolValues('specialization', $specialization);
                $this->setInsertSchoolValues('start_date', $school_start_date);
                $this->setInsertSchoolValues('end_date', $school_end_date);
                $this->setInsertSchoolValues('city', $school_city);
                $this->setInsertSchoolValues('description', $school_description);
            }
            $connection->close();
        }
    }
    catch(Exception $e)
    {
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
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
}

function validateForm5($cv, $cert, $cover_letter, $course, $host, $db_user, $db_pass, $db_name)
{
    // Validate cv
    $file_format = pathinfo($cv);
    if ($file_format['extension'] != "pdf")
    {
        $this->notGood('err_cv_file', 'File must have .pdf extension');
    }
    // Validate certificate
    $file_format = pathinfo($cert);
    if ($file_format['extension'] != "pdf")
    {
        $this->notGood('err_certificate_file', 'File must have .pdf extension');
    }

    // Validate cover letter
    $file_format = pathinfo($cover_letter);
    if ($file_format['extension'] != "pdf")
    {
        $this->notGood('err_cover_letter_file', 'File must have .pdf extension');
    }

    // Validate course
    if (ctype_alnum($course) == false)
    {
        $this->notGood('err_course', 'Course name may contain only letters and numbers');
    }
    if (strlen($course) > 30)
    {
        $this->notGood('err_course', 'Course name must have less than 30 characters');
    }

    // Remember values
    $_SESSION['rem_cv'] = $cv;
    $_SESSION['rem_certificate'] = $cert;
    $_SESSION['rem_cover_letter'] = $cover_letter;
    $_SESSION['rem_course'] = $course;

    // ło ja jebe jka tu duszo roboty
    // TODO safely upload files
    try
    {
        $connection = new mysqli($host, $db_user, $db_pass, $db_name);
        if ($connection->connect_errno != 0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            if ($this->checkFlag() == true)
            {
                //Add to array and wait
                $this->setInsertValue('cv_file', $cv);
                $this->setInsertCertSkillValues('certificate', $cert);
                $this->setInsertValue('cover_letter', $cover_letter);
                $this->setInsertCertSkillValues('course', $course);
            }
            $connection->close();
        }
    }
    catch(Exception $e)
    {
        echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
    }
}

function insertData()
{
    // Users table

    // Roles table

    // Recruits table

    //Schools table

    //Cities table

    // Certificates table

    // Cvs table

    // Courses table

    // Experience table

    // Languages table

    // Languages level table

    // Skills table

    // Skills level table

}

// TODO add insert function
}

