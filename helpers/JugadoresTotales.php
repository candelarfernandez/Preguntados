

<?php

require('third-party/fpdf/fpdf.php');

class JugadoresTotales extends fpdf
{

    // Cabecera de página
    function Header()
    {
        $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(45); // Movernos a la derecha
        $this->SetTextColor(0, 0, 0); //color
        $this->Ln(15); // Salto de línea

        /*TITULO*/
        //color
        $this->SetTextColor(139, 92, 246);
        $this->Cell(50); // mover a la derecha
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(180, 10, utf8_decode("REPORTE DE JUGADORES "), 0, 1, 'C', 0);
        $this->Ln(4);

        /*CAMPOS*/

        //colorFondo
        $this->SetFillColor(139, 92, 246);
        //colorTexto
        $this->SetTextColor(255, 255, 255);
        //colorBorde
        $this->SetDrawColor(209, 209, 209);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(25, 10, utf8_decode('Id'), 1, 0, 'C', 1);
        $this->Cell(45,10, utf8_decode('Nombre de Usuario'), 1, 0, 'C', 1);
        $this->Cell(60, 10, utf8_decode('Email'), 1, 0, 'C', 1);
        $this->Cell(30, 10, utf8_decode('Género'), 1, 0, 'C', 1);
        $this->Cell(30, 10, utf8_decode('Fecha de Nac.'), 1, 0, 'C', 1);
        $this->Cell(50, 10, utf8_decode('Fecha Registro'), 1, 0, 'C', 1);
        $this->Cell(35, 10, utf8_decode('Respuestas Correctas'), 1, 0, 'C', 1);
        $this->Ln();
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15); // Posición: a 1,5 cm del final
        $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

        $this->SetY(-15); // Posición: a 1,5 cm del final
        $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
        $hoy = date('d/m/Y');
        $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
    }
}