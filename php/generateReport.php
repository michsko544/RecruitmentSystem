<?php
require('../pdf/fpdf.php');
require_once "connect.php";
MYSQLI_REPORT_STRICT;
try
{
    $connection = new mysqli($host, $db_user, $db_pass, $db_name);
    if ($connection->connect_errno != 0) {
        throw new Exception(mysqli_connect_errno());
    } else {
        $q_users = $connection->query("SELECT count(id_user) from users");
        $q_applications = $connection->query("select count(id_application) from applications");
        $q_positionMP = $connection->query("SELECT count(a.id_position) as liczba_poz, position from positions p inner JOIN applications a ON p.id_position=a.id_position
            GROUP by a.id_position
            order by count(a.id_position) desc limit 1");
        $q_countryMP = $connection->query("SELECT count(c.id_country) as liczba_poz, country FROM
            applicants a INNER JOIN  countries c on a.id_country=c.id_country
            GROUP by a.id_country
            order by count(a.id_country) desc limit 1");
        $q_usersW = $connection->query("SELECT login, date from users u WHERE u.date>=date(CURRENT_DATE) - 7 ORDER by date desc");
        $q_applicationsW = $connection->query("SELECT u.login, p.position, a.date from applicants app inner join
            users u on app.id_user=u.id_user INNER JOIN
            applications a on app.id_applicants=a.id_applicants
            inner join positions as p on p.id_position=a.id_position  
            WHERE a.date>=date(CURRENT_DATE) -7 
            ORDER by a.date desc");
        $q_decisionsW = $connection->query("SELECT count(a.id_decision) as liczba_poz_tydz, name_decision from decisions d inner JOIN applications a ON d.id_decision=a.id_decision WHERE date>=date(CURRENT_DATE) -7 GROUP by a.id_decision order by count(a.id_decision)");

        $users = $q_users->fetch_assoc();
        $applications = $q_applications->fetch_assoc();
        $positionMP = $q_positionMP->fetch_assoc();
        $countryMP = $q_countryMP->fetch_assoc();
        $usersW = $q_usersW->fetch_assoc();
       // $applicationsW = $q_applicationsW->fetch_assoc();
        $decisionsW = $q_decisionsW->fetch_assoc();
        $f_usersW = $usersW['login'];
        //$f_applicationsW = $applicationsW['login'];
        $f_decisionsW = $decisionsW['liczba_poz_tydz'];

        // FPDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetDrawColor(54, 195, 217);
        $pdf->SetFillColor(70, 70, 80);
        $pdf->SetTextColor(54, 195, 217);
        $pdf->SetFont('Arial','',16);
        $pdf->Cell(40,10,'  myCompany', 1, 1);
        $pdf->Ln();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Times','B',20);
        $pdf->Cell(40,10,'Service statistics', 0, 1, 'C');
        $pdf->SetFont('Times','',12);
        $pdf->Cell(40,10,'Users: '.$users['count(id_user)'], 0, 1);
        $pdf->Cell(40,10,'Applications: '.$applications['count(id_application)'], 0, 1);
        $pdf->Cell(40,10,'Most popular position: '.$positionMP['position'], 0, 1);
        $pdf->Cell(40,10,'Most popular country: '.$countryMP['country'], 0, 1);
        $pdf->SetFont('Times','B',13);
        $pdf->Cell(40,10,'Last week statistics', 0, 1);
        $pdf->SetFont('Times','',12);
        $pdf->Cell(40,10,'Users: ', 0, 1);
        //foreach ($usersW as $key=>$value){
        //    $pdf->Cell(40,10,'  '.$key.'. '.$value, 0, 1);
        //}
        $pdf->Cell(40,10,'Applications: ', 0, 1);
        //while ($applicationsW = $q_applicationsW->fetch_assoc()){
        //    $pdf->Cell(40,10,'  '.$applicationsW, 0, 1);
        //    foreach ($applicationsW as $k=>$val){
        //        $pdf->Cell(40,10,'  '.$k.'. '.$val, 0, 1);
        //    }
        //}
        $pdf->Cell(40,10,'Decisions: '.$decisionsW['name_decision'], 0, 1);
        //foreach ($decisionsW as $key=>$value){
        //    $pdf->Cell(40,10,'  '.$key.'. '.$value, 0, 1);
        //}

        $pdf->Output();
    }
}
catch (Exception $e)
{
    echo "<div class='server-error'>Server error! Please try again later. Err: ".$e."</div>";
}