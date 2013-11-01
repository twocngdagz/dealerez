<?php
include_once("includes.php");
require_once('fpdf/fpdf.php');
require_once('fpdf/fpdi.php');

$id = $_GET['id'];

$pdf = new FPDI();

$pagecount = $pdf->setSourceFile('fpdf/Brochure_Template.pdf');
$import = $pdf->importPage(1);

$pdf->addPage();
$pdf->useTemplate($import);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial','B','24');
$pdf->SetXY(23, 30);
$pdf->Write(0, "Dixie Motors LLC.");

$pdf->SetFont('Arial','B','14');
$pdf->SetXY(23, 37);
$pdf->Write(0, '555 N. Bluff Street, St. George, Utah');

$pdf->SetFont('Arial','B','12');
$pdf->SetXY(146, 30.5);
$pdf->Write(0, 'Phone: 888-960-1114');

$pdf->SetXY(146, 36.8);
$pdf->Write(0, 'Contact: Glenn or Ryan');


//get listing detail
$listing_id = isset($_GET['id']) ? $_GET['id'] : false;
$sql2 = mysql_query("select * from listing where listing_id = $listing_id");
$listing = mysql_fetch_array($sql2);
extract($listing);

$pdf->SetTextColor(228, 11, 11);
$pdf->SetFont('Arial','B','24');
$pdf->SetXY(25, 55);
$pdf->Write(0, $year.' '.$make.' '.$model);
$pdf->SetXY(160, 55);
$pdf->Write(0, '$'.number_format($price));

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial','','12');

$sql3 = mysql_query("select * from listing_images where listing_id = $listing_id limit 1");
$image = mysql_fetch_array($sql3);
extract($image);
$img = SITE_URL.SITE_LISTING_IMAGES_PATH.$image_name;
//$img = "http://www.dealerez.com/sandbox/web/uploads/listing/".$image_name;

$pdf->Image($img, 31, 68, 89);

$pdf->SetXY(147, 75);
$pdf->Write(0, $body_style);

$pdf->SetXY(147, 81);
$pdf->Write(0, $miles);

$pdf->SetXY(150, 87.1);
$pdf->Write(0, $engine);

$pdf->SetXY(148, 93.1);
$pdf->Write(0, $trans);

$pdf->SetXY(147, 99.3);
$pdf->Write(0, $drive);

$pdf->SetXY(145, 105.4);
$pdf->Write(0, $fuel);

$pdf->SetXY(156, 111.5);
$pdf->Write(0, $exterior);

$pdf->SetXY(154, 117.5);
$pdf->Write(0, $interior);

$pdf->SetXY(151, 123.6);
$pdf->Write(0, $stock_no);

$pdf->SetXY(147, 129.9);
$pdf->Write(0, $vin);

$pdf->SetXY(25, 150);
$pdf->SetLeftMargin(25);
$pdf->SetRightMargin(18);
$pdf->Write(7, str_replace("Year, Make, Model",$year.", ".$make.", ".$model,$description));


$pdf->Output('Brochure.pdf', 'I');

redirect_page("http://www.dixiemotorsutah.com/listing_detail.php?lid=".$id);

?>