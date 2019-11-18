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
    'country' => '',
    'city' => '',
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

// TODO add insert function
}

