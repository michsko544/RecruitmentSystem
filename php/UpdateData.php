<?php
session_start();
require_once "InsertToDB.php";
class UpdateData extends InsertToDB
{
    public function __construct($host, $db_user, $db_pass, $db_name)
    {
        parent::__construct($host, $db_user, $db_pass, $db_name);
    }

    function updateProfile(){
        if ($this->conn->connect_errno!=0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            $success = false;
            // TODO add multiple filed insert
            $this->itWorks('pre-insert');
            $timestamp = date("Y-m-d");
            if ($this->conn->query("UPDATE users SET name='{$_SESSION['array']['pd']['name']}', surname='{$_SESSION['array']['pd']['surname']}' WHERE id_user = {$_SESSION['id_user']}" ) ) {

                $id_city_Q = $this->checkCity($_SESSION['array']['pd']['residence_city']);
                // TODO sth is no yes
                $country_Q = $this->conn->query("select id_country from countries where country = '{$_SESSION['array']['pd']['residence_country']}'");
                $country_V = $country_Q->fetch_assoc();
                $id_country_Q = $country_V['id_country'];

                if ($this->conn->query("UPDATE applicants SET phone='{$_SESSION['array']['pd']['phone']}', id_city={$this->id_city_FQ}, id_country={$id_country_Q} WHERE id_user = {$_SESSION['id_user']}")){
                    // TODO --- add multi insert ---

                    // !!!!!!!!!!!!!!!!!!!!!!!!! CUIDADO !!!!!!!!!!!!!!!!!!!!!!!!!
                    // !!!!!!!!!!!!!!!!! CRAZY SHIT IS GOING DOWN !!!!!!!!!!!!!!!!
                    // !!!!!!!!!!!!!!!!!!!!!!!! ATTENTION !!!!!!!!!!!!!!!!!!!!!!!!
                    // !!!!!!!!!!!!!!!!!!!!!!!! help plox !!!!!!!!!!!!!!!!!!!!!!!!
                    // !!!!!!!!!!!!!!!!!!!!!!!!! kill me !!!!!!!!!!!!!!!!!!!!!!!!!

                    $applicant_Q = $this->conn->query("select id_applicants from applicants where id_user = {$_SESSION['id_user']}");
                    $applicant_V = $applicant_Q->fetch_assoc();
                    $id_applicant_Q = $applicant_V['id_applicants'];


                    $w0 = 0;
                    while (isset($_SESSION['array']['emp']['job-title'][$w0])) {

                        $id_city_Q = $this->checkCity($_SESSION['array']['emp']['city'][$w0]);
                        if ($this->conn->query("UPDATE experiences SET job='{$_SESSION['array']['emp']['job_title'][$w0]}', employer='{{$_SESSION['array']['emp']['employer'][$w0]}', start_job='{{$_SESSION['array']['emp']['start_date'][$w0]}', end_job='{{$_SESSION['array']['emp']['end_date'][$w0]}', description='{{$_SESSION['array']['emp']['description'][$w0]}', id_city={$this->id_city_FQ} WHERE id_applicants = {$id_applicant_Q}")) {
                            $w1 = 0;
                            while (isset($_SESSION['array']['sk_lang']['language'][$w1])){

                                $this->checkLanguage($_SESSION['array']['sk_lang']['language'][$w1]);
                                $id_lang_level_Q = intval($_SESSION['array']['sk_lang']['language_level'][$w1]);
                                if ($this->conn->query("UPDATE knowledge SET id_level={$id_lang_level_Q}, id_language={$this->id_language_FQ} WHERE id_applicants = {$id_applicant_Q}")){
                                    $w2=0;
                                    while (isset($_SESSION['array']['sk_lang']['skill'][$w2])){

                                        $this->checkSkill($_SESSION['array']['sk_lang']['skill'][$w2]);
                                        $id_skill_level_Q = intval($_SESSION['array']['sk_lang']['skill_level'][$w2]);
                                        if ($this->conn->query("UPDATE holders SET id_level={$id_skill_level_Q}, id_skill={$this->id_skill_FQ} WHERE id_applicants = {$id_applicant_Q}")){
                                            $w3=0;
                                            while (isset($_SESSION['array']['edu']['city'][$w3])){
                                                $id_city_Q = $this->checkCity($_SESSION['array']['edu']['city'][$w3]);
                                                if ($this->conn->query("UPDATE schools SET name_school='{$_SESSION['array']['edu']['school'][$w3]}', specialization='{$_SESSION['array']['edu']['specialization'][$w3]}', start_learning='{$_SESSION['array']['edu']['start_date'][$w3]}', end_learning='{$_SESSION['array']['edu']['end_date'][$w3]}', description='{$_SESSION['array']['edu']['description'][$w3]}', id_city={$this->id_city_FQ} WHERE id_applicants = {$id_applicant_Q}")){
                                                    $success = true;
                                                }
                                                $w3++;
                                            }
                                        }
                                        $w2++;
                                    }
                                }
                                $w1++;
                            }
                        }
                        $w0++;
                    }
                    if ($success == true){
                        header ('Location: ../profile.php?uD=success');
                    }
                } else {
                    throw new Exception($this->conn->error);
                }
            } else {
                throw new Exception($this->conn->error);
            }
        }
    }

}