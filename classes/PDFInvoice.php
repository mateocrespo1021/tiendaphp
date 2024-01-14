<?php

namespace Classes;

use Reports\FPDF;


class PDFInvoice extends FPDF
{

    // Cabecera de página
    function Header()
    {
        // Logo
        //$this->Image($_ENV["HOST"] . "/img/blog/",10,8,33);
        // Arial bold 15
        // $this->SetFont('Arial','B',15);
        // // Movernos a la derecha
        // $this->Cell(80);
        // // Título
        // $this->Cell(30,10,'Title',1,0,'C');
        // // Salto de línea
        // $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // // Posición: a 1,5 cm del final
        // $this->SetY(-15);
        // // Arial italic 8
        // $this->SetFont('Arial','I',8);
        // // Número de página
        // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }



    public function generarInvoice($invoice, $pedidos)
    {
        $pdf = new PDFInvoice($orientation = 'P', $unit = 'mm');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 20);
        $textypos = 5;
        $pdf->setY(12);
        $pdf->setX(10);
        // Agregamos los datos de la empresa
        $pdf->Cell(5, $textypos, "VIDA ETC - Tienda de Ropa");
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->setY(30);
        $pdf->setX(10);
        $pdf->Cell(5, $textypos, "DE:");
        $pdf->SetFont('Arial', '', 10);
        $pdf->setY(35);
        $pdf->setX(10);
        $pdf->Cell(5, $textypos, "VIDA ETC");
        $pdf->setY(40);
        $pdf->setX(10);
        $pdf->Cell(5, $textypos, "AV BUEN DIA");
        $pdf->setY(45);
        $pdf->setX(10);
        $pdf->Cell(5, $textypos, "0983513154");
        $pdf->setY(50);
        $pdf->setX(10);
        $pdf->Cell(5, $textypos, "vidaropa@gmail.com");



        // Agregamos los datos del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->setY(30);
        $pdf->setX(75);
        $pdf->Cell(5, $textypos, "PARA:");
        $pdf->SetFont('Arial', '', 10);
        $pdf->setY(35);
        $pdf->setX(75);
        $pdf->Cell(5, $textypos, $invoice->nombres);
        $pdf->setY(40);
        $pdf->setX(75);
        $pdf->Cell(5, $textypos, $invoice->pais . ", " . $invoice->departamento . ", " . $invoice->codigo_postal);
        $pdf->setY(45);
        $pdf->setX(75);
        $pdf->Cell(5, $textypos, $invoice->telefono);
        $pdf->setY(50);
        $pdf->setX(75);
        $pdf->Cell(5, $textypos, $invoice->email);

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->setY(30);
        $pdf->setX(135);
        $pdf->Cell(5, $textypos, "INVOICE #" . $invoice->id);
        $pdf->SetFont('Arial', '', 10);
        $pdf->setY(35);
        $pdf->setX(135);
        $pdf->Cell(5, $textypos, "Fecha: " . date("Y-m-d"));
        $pdf->setY(40);
        $pdf->setX(135);
        $pdf->Cell(5, $textypos, "");
        $pdf->setY(45);
        $pdf->setX(135);
        $pdf->Cell(5, $textypos, "");
        $pdf->setY(50);
        $pdf->setX(135);
        $pdf->Cell(5, $textypos, "");

        /// Apartir de aqui empezamos con la tabla de productos
        $pdf->setY(60);
        $pdf->setX(135);
        $pdf->Ln();
        /////////////////////////////
//// Array de Cabecera
        // Array de Cabecera
        $header = array("Nombre", "Precio", "Cantidad", "Talla", "Total");

        // Column widths
        $w = array(95, 20, 20, 25, 25);

        // Header
        for ($i = 0; $i < count($header); $i++)
            $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        $pdf->Ln();

        // Data
        $total = 0;

        foreach ($pedidos as $pedido) {
            $pdf->Cell($w[0], 6, $pedido['nombre'], 1);  // Nombre
            $pdf->Cell($w[1], 6, "$ " . number_format($pedido['precio'], 2, ".", ","), 1);  // Precio
            $pdf->Cell($w[2], 6, $pedido['cantidad'], 1);  // Cantidad
            $pdf->Cell($w[3], 6, $pedido['talla'], 1);  // Talla
            $pdf->Cell($w[4], 6, "$ " . number_format($pedido['precio'] * $pedido['cantidad'], 2, ".", ","), 1);  // Total

            $pdf->Ln();
            $total += $pedido['precio'] * $pedido['cantidad'];
        }
        /////////////////////////////
//// Apartir de aqui esta la tabla con los subtotales y totales
        $yposdinamic = 60 + (count($pedidos) * 10);

        $pdf->setY($yposdinamic);
        $pdf->setX(235);
        $pdf->Ln();
        /////////////////////////////
        $header = array("", "");
        $data2 = array(
            array("Subtotal", $total),
            array("Descuento", 0),
            array("Impuesto", 0),
            array("Total", $total),
        );
        // Column widths
        $w2 = array(40, 40);
        // Header

        $pdf->Ln();
        // Data
        foreach ($data2 as $row) {
            $pdf->setX(115);
            $pdf->Cell($w2[0], 6, $row[0], 1);
            $pdf->Cell($w2[1], 6, "$ " . number_format($row[1], 2, ".", ","), '1', 0, 'R');

            $pdf->Ln();
        }
        /////////////////////////////

        $yposdinamic += (count($data2) * 10);
        $pdf->SetFont('Arial', 'B', 10);

        $pdf->setY($yposdinamic);
        $pdf->setX(10);
        $pdf->Cell(5, $textypos, "TERMINOS Y CONDICIONES");
        $pdf->SetFont('Arial', '', 10);

        $pdf->setY($yposdinamic + 10);
        $pdf->setX(10);
        $pdf->Cell(5, $textypos, "El cliente se compromete a pagar la factura.");
        $pdf->setY($yposdinamic + 20);
        $pdf->setX(10);
        $pdf->Cell(5, $textypos, "Powered by Evilnapsis");

        return $pdf->Output('mi_archivo.pdf', 'S'); // Usamos 'S' para retornar como string


    }





}