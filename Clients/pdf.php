<?php

// Include mpdf library file
require_once __DIR__ . '/pdf_mpdf/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf([
    'margin_left' => 20,
    'margin_right' => 15,
    'margin_top' => 10,
    'margin_bottom' => 25,
    'margin_header' => 10,
    'margin_footer' => 10
]);

// Database Connection
include ("../connection.php");
global $dbh;

// Select data from MySQL database
$select = "SELECT * FROM `Client`";
$result = $dbh->query($select);
$data = array();

$mpdf->SetDisplayMode('fullpage');

//PDF Content

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
        .'<td>'.yesNo($row->Client_Subscribed).'</td>';

}
// Take PDF contents in a variable

$pdfcontent = '<div class="logo"><img style="display: inline;" src="../Images/Logo.png"><h1 style="display: inline;">Resonant With World</h1></div>
		<h2>Client Details</h2>
		 <table class="table table-bordered responsive table-condensed">
		<thead>
		<tr>
		<th ><strong>ID</strong></th>
		<th ><strong>First Name</strong></th>
		<th ><strong>Surname</strong></th>
		<th ><strong>Address</strong></th>
		<th ><strong>Phone</strong></th>
		<th ><strong>Email</strong></th>
		<th><strong>Subscribe?</strong></th>
		</tr></thead><tbody>
		'.$data.'
		</tbody>
		</table>
		
		<style>
		body{
		font-family: "Montserrat", sans-serif;
		}
		
		h1, h2{
		color: #2d475c;
		}
		
		table{
		width: 100%;
		}
		
		
		td, th{
		border: 1px solid lightgrey;
		padding: 15px!important;
		font-size: 15px;
	color: #535353;
		}
		
		th{
		 font-size: 18px !important;
  font-weight: 600;
  padding: 15px;
  letter-spacing: 1px;
  color: #385972;
  background: #e3e5ee;
  text-align: center;
		}
		
	img{
    float: left;
    display: inline-block;
	}
	
	h1{
font-size: 30px; 
    display: inline-block;
    position: relative;
    margin-left: 10px;
    padding: 20px 40px 0 0;
    display: inline-block;
	
	}

		
		
</style>
		
		
		';

$mpdf->SetTitle("Resonant with World - Clients");
$mpdf->SetProtection(['print']);


$mpdf->WriteHTML($pdfcontent);

$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0;

//output in browser
$mpdf->Output();
?>
