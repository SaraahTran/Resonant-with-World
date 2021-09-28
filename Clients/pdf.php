<?php

// Include mpdf library file
require_once __DIR__ . '/pdf_mpdf/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf();

// Database Connection
include ("../connection.php");
global $dbh;

// Select data from MySQL database
$select = "SELECT * FROM `Client`";
$result = $dbh->query($select);
$data = array();

function yesNo($n)
{
    return $n == 1 ? 'Yes' : 'No';
}

while($row = $result->fetchObject()){
    $data .= '<tr>'
        .'<td>'.$row->Client_ID.'</td>'
        .'<td>'.$row->Client_FirstName.'</td>'
        .'<td>'.$row->Client_Surname.'</td>'
        .'<td>'.$row->Client_Address.'</td>'
        .'<td>'.$row->Client_Phone.'</td>'
        .'<td>'.$row->Client_Email.'</td>'
        .'<td>'.yesNo($row->Client_Subscribed).'</td>'
        .'<td>'.$row->Client_Other_Information.'</td></tr>';
}
// Take PDF contents in a variable

$pdfcontent = '<h1>Resonant With World</h1>
		<h2>Client Details</h2>
		 <table class="table table-bordered responsive table-condensed">
		<tr>
		<td style="width: 33%"><strong>ID</strong></td>
		<td style="width: 36%"><strong>First Name</strong></td>
		<td style="width: 30%"><strong>Surname</strong></td>
		<td style="width: 30%"><strong>Address</strong></td>
		<td style="width: 30%"><strong>Phone</strong></td>
		<td style="width: 30%"><strong>Email</strong></td>
		<td style="width: 30%"><strong>Subscribe</strong></td>
		<td style="width: 30%"><strong>Other Information</strong></td>
		</tr>
		'.$data.'
		</table>';

$mpdf->WriteHTML($pdfcontent);

$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0;

//output in browser
$mpdf->Output();
?>
