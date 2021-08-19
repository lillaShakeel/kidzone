<?php
session_start();
if(!isset($_SESSION['customer'])){
	header('location:index.php');
}
include('function.php');
include('vendor/autoload.php');

$orderid=$_REQUEST['orderid'];
$html=invoice($orderid);

// Generate Pdf

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file=time().'.pdf';
$mpdf->Output($file,'D');

?>