<?php

class pdfGenerator
{
    public function __construct()
    {
        require_once ($_SERVER['DOCUMENT_ROOT'].='/eventx_website/lib/tcpdf/tcpdf.php');
    }

    function generateTicketPdf($filename, $title, $content)
    {
        $filename .= '.pdf';
        $pdf = new TCPDF('P', 'mm', 'A4');
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->setTitle($title);
        $pdf->AddPage();
        $pdf->setAutoPageBreak(True , PDF_MARGIN_BOTTOM);
        $pdf->writeHTML($content);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->Output($filename, 'D');
    }
}