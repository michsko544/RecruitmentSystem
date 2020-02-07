<?php
require_once "FormsValidation.php";
class ChangeProfile extends FormsValidation
{
    private $host;
    private $user;
    private $pass;
    private $name;
    private $conn = null;

    public function __construct($flag_status, $host, $db_user, $db_pass, $db_name)
    {
        parent::__construct($flag_status);
        $this->host = $host;
        $this->user = $db_user;
        $this->pass = $db_pass;
        $this->name = $db_name;
        $this->conn = new mysqli($host, $db_user, $db_pass, $db_name);

    }

    function notGood($err_name, $err_message)
    {
        $this->correct_data = false;
        $_SESSION["$err_name"] = $err_message;
        header("Location: /profile.php");
    }

    function validateFormPD($first_name, $last_name, $phone, $residence_country, $residence_city)
    {
        // Validate first name

        if (!preg_match('/^[a-z\040.\-]+$/i', $first_name))
        {
            $this->notGood('err_first_name', 'First name may contain only letters');
        }

        //Validate last name

        if (!preg_match('/^[a-z\040.\-]+$/i', $last_name))
        {
            $this->notGood('err_last_name', 'Last name may contain only letters');
        }

        //Validate phone number

        if (ctype_digit($phone) == false)
        {
            $this->notGood('err_phone', 'Phone number may contain only numbers');
        }
        if (strlen($phone) != 9)
        {
            $this->notGood('err_phone', 'Phone number must be 9 digits long');
        }

        //Validate country
        try
        {

            if ($this->conn->connect_errno != 0)
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {
                $result_country = $this->conn->query("SELECT id_country FROM countries WHERE country = '{$residence_country}'");
                if (!$result_country)
                {
                    throw new Exception($this->conn->error);
                }
                else
                {
                    $count_input = $result_country->num_rows;
                    if ($count_input == 0)
                    {
                        $this->notGood('err_residence_country', 'U crazy? Dis ain&apos;t no country');
                    }
                }
                $this->conn->close();
            }
        }
        catch (Exception $e)
        {
            require_once "addError.php";
            addError($e);
            echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
        }

        //Validate city
        if (!preg_match('/^[a-z\040.\-]+$/i', $residence_city))
        {
            $this->notGood('err_residence_city', 'City name may contain only letters');
        }

        // Remember value
        $_SESSION['rem_first_name'] = $first_name;
        $_SESSION['rem_last_name'] = $last_name;
        $_SESSION['rem_phone'] = $phone;
        $_SESSION['rem_residence_country'] = $residence_country;
        $_SESSION['rem_residence_city'] = $residence_city;

        if ($this->checkFlag() == true)
        {
            //Add to array and wait
            $this->setInsertPersonalData('first_name', $first_name);
            $this->setInsertPersonalData('last_name', $last_name);
            $this->setInsertPersonalData('phone', $phone);
            $this->setInsertPersonalData('residence_country', $residence_country);
            $this->setInsertPersonalData('residence_city', $residence_city);
            return true;
        } else {
            return false;
        }
    }
    function validateFormExp($job_title, $no_experience, $employer, $start_date, $end_date, $job_city, $job_description)
    {
        if ($no_experience == false)
        {
            // Validate job title
            if (!preg_match('/^[a-z0-9\040.\-]+$/i', $job_title))
            {
                $this->notGood('err_job_title', 'Job title may only contain letters and numbers');
            }
            if (strlen($job_title) > 40)
            {
                $this->notGood('err_job_title', 'Job title must have less than 40 characters');
            }

            // Validate employer
            if (!preg_match('/^[a-z0-9\040.\-]+$/i', $employer))
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
            if (!preg_match('/^[a-z\040.\-]+$/i', $job_city))
            {
                $this->notGood('err_job_city', 'City name may contain only letters');
            }

            // Validate description
            if (!preg_match('/^[a-z0-9\040.\-]+$/i', $job_description))
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
                $this->setInsertEmploymentValues('start_date', $start_date);
                $this->setInsertEmploymentValues('end_date', $end_date);
                $this->setInsertEmploymentValues('city', $job_city);
                $this->setInsertEmploymentValues('description', $job_description);
                return true;
            } else
                return false;
        }
        else
        {
            return true;
        }
    }
    function validateFormEdu($school, $specialization, $school_start_date, $school_end_date, $school_city, $school_description)
    {
        if (!preg_match('/^[a-z0-9\040.\-]+$/i', $school))
        {
            $this->notGood('err_school', 'School name may only contain letters and numbers');
        }

        if (!preg_match('/^[a-z0-9\040.\-]+$/i', $specialization))
        {
            $this->notGood('err_specialization', 'Specialization name may only contain letters and numbers');
        }

        $this->valiDate($school_start_date, $school_end_date);

        if (!preg_match('/^[a-z\040.\-]+$/i', $school_city))
        {
            $this->notGood('err_school_city', 'City name may contain only letters');
        }

        if (!preg_match('/^[a-z0-9\040.\-]+$/i', $school_description))
        {
            $this->notGood('err_school_description', 'Description may only contain letters and numbers');
        }
        if (strlen($school_description) > 500)
        {
            $this->notGood('err_school_description', 'Description must have less than 500 characters');
        }
        // Remember value
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
            return true;
        } else
            return false;
    }
    function validateFormS($skill, $skill_level)
    {
        // Validate skills
        if (($skill_level < 1) && ($skill_level > 5))
        {
            $this->notGood('err_skill_level', 'Skill level must be between 1 and 5');
        }

        if (!preg_match('/^[a-z0-9\040.\-]+$/i', $skill))
        {
            $this->notGood('err_skill', 'Skill name may only contain letters and numbers');
        }

        // Remember value
        $_SESSION['rem_skill'] = $skill;
        $_SESSION['rem_skill_level'] = $skill_level;

        if ($this->checkFlag() == true)
        {
            //Add to array and wait
            $this->setInsertSkillLanguageValues('skill', $skill);
            $this->setInsertSkillLanguageValues('skill_level', $skill_level);
            return true;
        } else return false;
    }
    function validateFormL($language, $language_level)
    {
        // Validate language
        if (($language_level < 1) && ($language_level > 5))
        {
            $this->notGood('err_language_level', 'Language level must be between 1 and 5');
        }

        if (!preg_match('/^[a-z0-9\040.\-]+$/i', $language))
        {
            $this->notGood('err_language', 'Language name may only contain letters and numbers');
        }

        // Remember value
        $_SESSION['rem_language'] = $language;
        $_SESSION['rem_language_level'] = $language_level;

        if ($this->checkFlag() == true)
        {
            //Add to array and wait
            $this->setInsertSkillLanguageValues('language', $language);
            $this->setInsertSkillLanguageValues('language_level', $language_level);
            return true;
        } else return false;
    }

    function validateFormDox(){}
}