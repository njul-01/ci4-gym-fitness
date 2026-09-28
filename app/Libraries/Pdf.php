<?php
namespace App\Libraries;

use Dompdf\Dompdf;

class Pdf
{
    public function generate($html, $filename = 'document', $paper = 'A4',$orientation =  'potrait'){
        $dompdf = new Dompdf();

        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();

        $dompdf->stream($filename . '.pdf', ['Attachment'=>false]);
        // attachment = false berfungsi untuk membuka file di browser
        // attachment = true berfungsi untuk otomatis
    }
}


?>