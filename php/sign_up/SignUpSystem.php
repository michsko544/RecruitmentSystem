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
        'cv' => '',
        'cover_letter' => '',
    );
    private $insert_employment = array(
        'job_title' => array(),
        'employer' => array(),
        'start_date' => array(),
        'end_date' => array(),
        'city' => array(),
        'description' => array(),
    );
    private $insert_skill_language = array(
        'language' => array(),
        'language_level' => array(),
        'skill' => array(),
        'skill_level' => array(),
    );
    private $insert_school = array(
        'school' => array(),
        'specialization' => array(),
        'start_date' => array(),
        'end_date' => array(),
        'city' => array(),
        'description' => array(),
    );
    private $insert_cert_course = array(
        'certificate' => array(),
        'course' => array(),
    );

function __construct($flag_status)
{
    $this->correct_data = $flag_status;
}


    // Pick data from DB
function pickDataFromDB($query, $host, $db_user, $db_pass, $db_name)
{
    mysqli_report(MYSQLI_REPORT_STRICT);
    try
    {
    $connection = new mysqli($host, $db_user, $db_pass, $db_name);
    if ($connection->connect_errno != 0)
    {
    throw new Exception(mysqli_connect_errno());
    }

    else {
        if ($position_name = $connection->query($query)) {
            while ($pos_name = $position_name->fetch_assoc()) {
                foreach ($pos_name as $key=>$value) {
                    if(isset($_SESSION['rem_position'])){
                        echo '<option selected="'. $_SESSION['rem_position']  .'" value="'.$value.'"> '.$value.' </option>';
                    } else {
                        echo '<option value="'.$value.'" > '.$value.' </option>';
                    }
                }
            }
        } else {
            throw new Exception($connection->error);
        }
    }
    }
    catch
    (Exception $e) {
        echo "<div class='server-error'>Server error! Please try again later. Err: " . $e . "</div>";
    }
    $connection->close();
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
    return $this->correct_data;
}

function notGood($err_name, $err_message)
{
    $this->correct_data = false;
    $_SESSION["$err_name"] = $err_message;
    echo "<div style='height: 20vh'> $err_message </div>";
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

function checkDate($date)
{
    $day = date('d', $date);
    $month = date('m', $date);
    $year = date('Y', $date);
    if (!checkdate($month, $day, $year))
    {
        $this->notGood('err_date', 'This is not a valid date');
    }
}

function valiDate($start_date, $end_date)
{
    $curr_date = date("d-m-Y");
    if ($end_date == "Present")
    {
        $f_start_date = strtotime($start_date);
        if ($curr_date < $f_start_date)
        {
            $this->notGood('err_date', 'End date must be after start date');
        }
        $this->checkDate($f_start_date);
    }
    else
    {
        $f_start_date = strtotime($start_date);
        $ff_sd = date("d-m-Y", $f_start_date);
        $f_end_date = strtotime($end_date);
        $ff_ed = date("d-m-Y", $f_end_date);
        if ($ff_ed < $ff_sd || $curr_date < $ff_sd)
        {
            $this->notGood('err_date', 'End date must be after start date');
        }
        $this->checkDate($f_start_date);
        $this->checkDate($f_end_date);
    }
}


function validateForm3($job_title, $no_experience, $employer, $start_date, $end_date, $job_city, $job_description)
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
        $this->valiDate($start_date, $end_date);

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
        $_SESSION['rem_start_date'] = $start_date;
        $_SESSION['rem_end_date'] = $end_date;
        $_SESSION['rem_job_city'] = $job_city;
        $_SESSION['rem_description'] = $job_description;


        if ($this->checkFlag() == true)
        {
            //Add to array and wait
            $this->setInsertEmploymentValues('job_title', $job_title);
            $this->setInsertEmploymentValues('employer', $employer);
            $this->setInsertEmploymentValues('star_date', $start_date);
            $this->setInsertEmploymentValues('end_date', $end_date);
            $this->setInsertEmploymentValues('job_city', $job_city);
            $this->setInsertEmploymentValues('description', $job_description);
            $this->itWorks('form3');
        }


        // Unset remembered values
        if (isset($_SESSION['rem_job_title'])) unset($_SESSION['rem_job_title']);
        if (isset($_SESSION['rem_employer'])) unset($_SESSION['rem_employer']);
        if (isset($_SESSION['rem_start_date'])) unset($_SESSION['rem_start_date']);
        if (isset($_SESSION['rem_end_date'])) unset($_SESSION['rem_end_date']);
        if (isset($_SESSION['rem_job_city'])) unset($_SESSION['rem_job_city']);
        if (isset($_SESSION['rem_description'])) unset($_SESSION['rem_description']);
        // Unset error values
        if (isset($_SESSION['err_job_title'])) unset($_SESSION['err_job_title']);
        if (isset($_SESSION['err_employer'])) unset($_SESSION['err_employer']);
        if (isset($_SESSION['err_start_date'])) unset($_SESSION['err_start_date']);
        if (isset($_SESSION['err_end_date'])) unset($_SESSION['err_end_date']);
        if (isset($_SESSION['err_job_city'])) unset($_SESSION['err_job_city']);
        if (isset($_SESSION['err_description'])) unset($_SESSION['err_description']);
    }
    else
    {
        // TODO co robic gdy nie ma doswiadczenia -- chyba nic
    }
}

// **********************************************************
// ******************** FORM 4 ******************************
// **********************************************************


    function validateForm4L($language, $language_level)
    {
        // Validate language
        if (($language_level < 1) && ($language_level > 5))
        {
            $this->notGood('err_language_level', 'Language level must be between 1 and 5');
        }

        if (ctype_alnum($language) == false)
        {
            $this->notGood('err_language', 'Language name may only contain letters and numbers');
        }

        // Remember value TODO change to skills and school
        $_SESSION['rem_language'] = $language;
        $_SESSION['rem_language_level'] = $language_level;

        if ($this->checkFlag() == true)
        {
            //Add to array and wait
            $this->setInsertSkillLanguageValues('language', $language);
            $this->setInsertSkillLanguageValues('language_level', $language_level);
            $this->itWorks('holy shit');
        }


        // Unset remembered values
        if (isset($_SESSION['rem_language'])) unset($_SESSION['rem_language']);
        if (isset($_SESSION['rem_language_level'])) unset($_SESSION['rem_language_level']);

        // Unset error values
        if (isset($_SESSION['err_language'])) unset($_SESSION['err_language']);
        if (isset($_SESSION['err_language_level'])) unset($_SESSION['err_language_level']);
    }
    function validateForm4Sk($skill, $skill_level)
    {
        // Validate skills
        if (($skill_level < 1) && ($skill_level > 5))
        {
            $this->notGood('err_skill_level', 'Skill level must be between 1 and 5');
        }

        if (ctype_alnum($skill) == false)
        {
            $this->notGood('err_skill', 'Skill name may only contain letters and numbers');
        }


        // Remember value TODO change to skills and school
        $_SESSION['rem_skill'] = $skill;
        $_SESSION['rem_skill_level'] = $skill_level;

        if ($this->checkFlag() == true)
        {
            //Add to array and wait
            $this->setInsertSkillLanguageValues('skill', $skill);
            $this->setInsertSkillLanguageValues('skill_level', $skill_level);
            $this->itWorks('it is ( i think)');
        }


        // Unset remembered values
        if (isset($_SESSION['rem_skill'])) unset($_SESSION['rem_skill']);
        if (isset($_SESSION['rem_skill_level'])) unset($_SESSION['rem_skill_level']);
        // Unset error values
        if (isset($_SESSION['err_skill'])) unset($_SESSION['err_skill']);
        if (isset($_SESSION['err_skill_level'])) unset($_SESSION['err_skill_level']);
    }

function validateForm4S($school, $specialization, $school_start_date, $school_end_date, $school_city, $school_description)
{
    if (ctype_alnum($school) == false)
    {
        $this->notGood('err_school', 'School name may only contain letters and numbers');
    }

    if (ctype_alnum($specialization) == false)
    {
        $this->notGood('err_specialization', 'Specialization name may only contain letters and numbers');
    }

    $this->valiDate($school_start_date, $school_end_date);

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
    $_SESSION['rem_school'] = $school;
    $_SESSION['rem_specialization'] = $specialization;
    $_SESSION['rem_school_start_date'] = $school_start_date;
    $_SESSION['rem_school_end_date'] = $school_end_date;
    $_SESSION['rem_school_city'] = $school_city;
    $_SESSION['rem_school_description'] = $school_description;

    if ($this->checkFlag() == true)
    {
        //Add to array and wait
        $this->setInsertSchoolValues('school', $school);
        $this->setInsertSchoolValues('specialization', $specialization);
        $this->setInsertSchoolValues('start_date', $school_start_date);
        $this->setInsertSchoolValues('end_date', $school_end_date);
        $this->setInsertSchoolValues('city', $school_city);
        $this->setInsertSchoolValues('description', $school_description);
        $this->itWorks('working');
    }


    // Unset remembered values
    if (isset($_SESSION['rem_school'])) unset($_SESSION['rem_school']);
    if (isset($_SESSION['rem_specialization'])) unset($_SESSION['rem_specialization']);
    if (isset($_SESSION['rem_school_start_date'])) unset($_SESSION['rem_school_start_date']);
    if (isset($_SESSION['rem_school_end_date'])) unset($_SESSION['rem_school_end_date']);
    if (isset($_SESSION['rem_school_city'])) unset($_SESSION['rem_school_city']);
    if (isset($_SESSION['rem_school_description'])) unset($_SESSION['rem_school_description']);
    // Unset error values
    if (isset($_SESSION['err_school'])) unset($_SESSION['err_school']);
    if (isset($_SESSION['err_specialization'])) unset($_SESSION['err_specialization']);
    if (isset($_SESSION['err_school_start_date'])) unset($_SESSION['err_school_start_date']);
    if (isset($_SESSION['err_school_end_date'])) unset($_SESSION['err_school_end_date']);
    if (isset($_SESSION['err_school_city'])) unset($_SESSION['err_school_city']);
    if (isset($_SESSION['err_school_description'])) unset($_SESSION['err_school_description']);
}

function validateFile($filename, $multi_file, $col_name)
{
    // TODO check if works for multifiles
    $whitelist = array("pdf");
    // Get filename
    $file_info = pathinfo($_FILES["{$filename}"]['name']);
    $name = $file_info['filename'];
    $ext = $file_info['extension'];
    // Validate file's extension
    if (!in_array($ext, $whitelist))
    {
        $this->notGood('err_file', 'Files must have .pdf extension');
    }

    $upload_dir = '/uploades/' . $col_name;
    $file_to_upload = $upload_dir . basename($_FILES["{$filename}"]['name']);

    //Add to array and wait
    if ($this->checkFlag() == true) {
        if (move_uploaded_file($_FILES["{$filename}"]['name'], $upload_dir)) {
            if ($multi_file == true) {
                $this->setInsertCertSkillValues($col_name, $filename);
                $this->itWorks("file");
            } else{
                $this->setInsertValue($col_name, $filename);
                $this->itWorks("file");
            }
        } else {
            $this->notGood('err_file', 'Uploading files failed');
            $this->itWorks('except it doesnt');
        }
    }
}

function validateForm5Co($course)
{
    // Validate course
    if (ctype_alnum($course) == false)
    {
        $this->notGood('err_course', 'Course name may contain only letters and numbers');
    }
    if (strlen($course) > 50)
    {
        $this->notGood('err_course', 'Course name must have less than 50 characters');
    }

    // Remember values
    $_SESSION['rem_course'] = $course;

    if ($this->checkFlag() == true)
    {
        //Add to array and wait
        $this->setInsertCertSkillValues('course', $course);
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

function itWorks($p)
{
    echo "<div style='height: 100vh'> It works! ". $p . " </div>";
}


}

