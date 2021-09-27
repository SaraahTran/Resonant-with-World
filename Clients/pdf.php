<?php
require_once __DIR__ . '/vendor/autoload.php';

use Mpdf\Mpdf;

// Modified from https://github.com/mpdf/mpdf-examples/blob/master/example34_invoice_example.php

try {
    // Setup mPDF parameters
    $mpdf = new Mpdf([
        'margin_left' => 20,
        'margin_right' => 15,
        'margin_top' => 48,
        'margin_bottom' => 25,
        'margin_header' => 10,
        'margin_footer' => 10
    ]);
    // SetProtection – Encrypts and sets the PDF document permissions https://mpdf.github.io/reference/mpdf-functions/setprotection.html
    $mpdf->SetProtection(['print']);

    // Set some basic document metadata https://mpdf.github.io/reference/mpdf-functions/settitle.html
    $mpdf->SetTitle("Acme Trading Co. - Invoice");
    $mpdf->SetAuthor("Acme Trading Co.");

    // Set a watermark https://mpdf.github.io/reference/mpdf-functions/setwatermarktext.html
    $mpdf->SetWatermarkText("Paid");
    $mpdf->showWatermarkText = true;
    $mpdf->watermarkTextAlpha = 0.1;

    // SetDisplayMode – Specify the initial Display Mode when the PDF file is opened in Adobe Reader https://mpdf.github.io/reference/mpdf-functions/setdisplaymode.html
    $mpdf->SetDisplayMode('fullpage');

    // Set up headers and footers - https://mpdf.github.io/headers-footers/method-4.html
    // Note: For this demo, the headers and footers are set up in the HTML file instead, from line 53

    // Get the actual contents from a file - in this case, it's an HTML file https://mpdf.github.io/reference/mpdf-functions/writehtml.html
    // In reality, you'll likely need to somehow modify the template so the data is properly inserted
    $mpdf->WriteHTML(file_get_contents('invoice_template.html'));

    // Output – Finalise the document and send it to specified destination https://mpdf.github.io/reference/mpdf-functions/output.html
    $mpdf->Output();
} catch (\Mpdf\MpdfException $e) {
    var_dump($e);
}

