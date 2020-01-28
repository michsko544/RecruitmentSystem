<?php
require('../pdf/fpdf.php');


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
$pdf->Cell(40,10,'Users: ', 0, 1);
$pdf->Cell(40,10,'Applications: ', 0, 1);
$pdf->Cell(40,10,'Most popular position: ', 0, 1);
$pdf->Cell(40,10,'Most popular country: ', 0, 1);
$pdf->SetFont('Times','B',13);
$pdf->Cell(40,10,'Last week statistics', 0, 1);
$pdf->SetFont('Times','',12);
$pdf->Cell(40,10,'Users: ', 0, 1);
$pdf->Cell(40,10,'Applications: ', 0, 1);
$pdf->Cell(40,10,'Decisions: ', 0, 1);

$pdf->Output();