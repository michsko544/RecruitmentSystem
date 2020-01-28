<?php
class UpdateData
{

    function notGood($err_name, $err_message){
        $this->correct_data = false;
        $_SESSION["$err_name"] = $err_message;
        header("Location: /profile.php");
    }

    function updateFirstName($first_name){
        if (!preg_match('/^[a-z\040.\-]+$/i', $first_name))
        {
            $this->notGood('err_first_name', 'First name may contain only letters');
        }
    }

    function updateLastName(){

    }

    function updatePhone(){

    }

    function updateResidenceCountry(){}

    function updateResidenceCity(){}

    function updateJobTitle(){}

    function updateEmployer

    function updateEmpStartDate

    function updateEmpEndDate

    function updateEmpCity

    function updateEmpDescription

    function updateSchool

    function updateSpecialization

    function updteEduStartDate

    function updateEduEndDate

    function updateEduCity

    function updateEduDescription

    function updateLanguage

    function updateLanguageLevel

    function updateSkill

    function updateSkillLevel

    function updateCV

    function updateCertificate

    function updateCourse
}