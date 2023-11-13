<?php
require ("third-party/FPDF/fpdf.php");
class ListadoDePreguntas extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 19);
        $this->Cell(45);
        $this->SetTextColor(0, 0, 0);
        $this->Ln(15);

        $this->SetTextColor(139, 92, 246);
        $this->Cell(50);
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(100, 10, utf8_decode("Listado de preguntas "), 0, 1, 'C', 0);
        $this->Ln(4);

        $this->SetFillColor(139,92,246);
        $this->SetTextColor(255,255,255);
        $this->SetDrawColor(209, 209, 209);
        $this->SetFont('Arial', 'B', 11);

        $this->Cell(10,10, utf8_decode('Id'), 1, 0, 'C', 1);
        $this->Cell(240, 10, utf8_decode('Pregunta'), 1, 0, 'C', 1);
        $this->Cell(20, 10, utf8_decode('Dificultad'), 1, 0, 'C', 1);


    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');

        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $hoy = date('d/m/Y');
        $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C');
    }

}