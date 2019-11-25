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
    'residence_country' => '',
    'residence_city' => '',
    'cv-file' => '',
);
private $insert_employment = array(
    'job_title'=>array(
        1=>'',
        2=>'',
        3=>'',
        4=>'',
        5=>'',
    ),
    'employer'=>array(
        1=>'',
        2=>'',
        3=>'',
        4=>'',
        5=>'',
    ),
    'start_date'=>array(
        1=>'',
        2=>'',
        3=>'',
        4=>'',
        5=>'',
    ),
    'end_date'=>array(
        1=>'',
        2=>'',
        3=>'',
        4=>'',
        5=>'',
    ),
    'city'=>array(
        1=>'',
        2=>'',
        3=>'',
        4=>'',
        5=>'',
    ),
    'description'=>array(
        1=>'',
        2=>'',
        3=>'',
        4=>'',
        5=>'',
    ),
);
private $insert_skill_language = array(
    'language'=>array(
        1=>'',
        2=>'',
        3=>'',
        4=>'',
        5=>'',
    ),
    'language_level'=>array(
        1=>'',
        2=>'',
        3=>'',
        4=>'',
        5=>'',
    ),
    'skill'=>array(
        1=>'',
        2=>'',
        3=>'',
        4=>'',
        5=>'',
    ),
    'skill_level'=>array(
        1=>'',
        2=>'',
        3=>'',
        4=>'',
        5=>'',
    ),
);
private $insert_school = array(
    'school'=>array(
        1=>'',
        2=>'',
        3=>'',
        4=>'',
        5=>'',
    ),
    'specialization'=>array(
        1=>'',
        2=>'',
        3=>'',
        4=>'',
        5=>'',
    ),
    'start_date'=>array(
        1=>'',
        2=>'',
        3=>'',
        4=>'',
        5=>'',
    ),
    'end_date'=>array(
        1=>'',
        2=>'',
        3=>'',
        4=>'',
        5=>'',
    ),
    'city'=>array(
        1=>'',
        2=>'',
        3=>'',
        4=>'',
        5=>'',
    ),
    'description'=>array(
        1=>'',
        2=>'',
        3=>'',
        4=>'',
        5=>'',
    ),
);
private $insert_cert_course = array(
    'certificate' => array(
        1 =>'', // TODO what type is file / how to add it
        2 =>'',
        3 =>'',
        4 =>'',
        5 =>'',
    ),
    'cover-letter' => array(
        1=>'',
        2=>'',
        3=>'',
        4=>'',
        5=>'',
    ),
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
    // $this->insert_employment[$column] = $value; // TODO wpisywać w kolejne pola dla danej kategorii
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
    if (isset($job_title))
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
}


// TODO add insert function
}

