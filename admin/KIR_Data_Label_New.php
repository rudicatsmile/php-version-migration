<?php
extract($_GET);
require "Connection.php";
require "FileFunction.php";
require "code128.php";

$pdf=new PDF_Code128();
$pdf->AddPage();
$pdf->SetFont('courier','B',9);

$DT = fGlobal("kd_aset_108:no_register:kd_upb:tgl_perolehan:kd_pemilik:extracom:referensi:kd_ruang","ta_kib_108","IDT",$IDT,"=","","");
if ($DT)
{
	$DT = explode(':',$DT);
	$kdA = $DT[0];
	$noR = $DT[1];
	$upB = $DT[2];
	$tgL = $DT[3];
	$mlK = $DT[4];
	$exT = $DT[5];
	$reF = $DT[6];
	$KdR = $DT[7];
	if ($exT=='Y'){
		$exT = '00';
	}
	else{
		$exT = '01';
	}
	
	$tgL = explode('-',$tgL);
	$thA = substr($tgL[0],0,1);
	$thB = substr($tgL[0],1,1);
	$thC = substr($tgL[0],2,1);
	$thD = substr($tgL[0],3,1);
}

$pdf->Image('Images/Logo Litle.gif',4.5,6,27,33);

$pdf->Ln(0.9) ;
$pdf->Cell(0.9);

$pdf->Cell(33,44,'','BTLR',0,'C');	
$pdf->Cell(173.5,44,'','BTR',0,'C');	
//$pdf->Cell(0);

$H1=8;
$R1=array(5,5, 2 ,5,5, 2 ,5,5, 2 ,5,5, 2 ,5,5,5,5,5,5, 2 ,5,5,5,5,5, 2 ,5,5,5,5,5, 2 ,5,5,5,5);

$pdf->Ln(4) ;
$pdf->SetFont('arial','B',13);
$pdf->Cell(41);
$pdf->Cell($R1[0],$H1,substr($mlK,0,1),'BTLR',0,'C');	

$pdf->Cell($R1[0],$H1,substr($mlK,0,1),'BTLR',0,'C');	
$pdf->Cell($R1[1],$H1,substr($mlK,-1,1),'BTR',0,'C');	
$pdf->Cell($R1[2],$H1,'.',0,0,'C');	
$pdf->Cell($R1[3],$H1,substr($exT,0,1),'BTLR',0,'C');	
$pdf->Cell($R1[4],$H1,substr($exT,-1,1),'BTR',0,'C');	
$pdf->Cell($R1[5],$H1,'.',0,0,'C');	
$pdf->Cell($R1[6],$H1,substr($upB,0,1),'BTLR',0,'C');	
$pdf->Cell($R1[7],$H1,substr($upB,1,1),'BTR',0,'C');	
$pdf->Cell($R1[8],$H1,'.','',0,'C');	
$pdf->Cell($R1[9],$H1,substr($upB,3,1),'BTLR',0,'C');	
$pdf->Cell($R1[10],$H1,substr($upB,4,1),'BTR',0,'C');	

$pdf->Cell($R1[11],$H1,'.','',0,'C');


$pdf->Cell($R1[12],$H1,substr($upB,6,1),'BTLR',0,'C');	
$pdf->Cell($R1[13],$H1,substr($upB,7,1),'BTR',0,'C');	
$pdf->Cell($R1[14],$H1,substr($upB,9,1),'BTR',0,'C');	
$pdf->Cell($R1[15],$H1,substr($upB,10,1),'BTR',0,'C');	
$pdf->Cell($R1[16],$H1,substr($upB,12,1),'BTR',0,'C');	
$pdf->Cell($R1[17],$H1,substr($upB,13,1).'','BTR',0,'C');	

$pdf->Cell($R1[18],$H1,'.','',0,'C');

$pdf->Cell($R1[19],$H1,'0','BTLR',0,'C');	
$pdf->Cell($R1[20],$H1,'0','BTR',0,'C');	
$pdf->Cell($R1[21],$H1,substr($upB,-3,1),'BTR',0,'C');	
$pdf->Cell($R1[22],$H1,substr($upB,-2,1),'BTR',0,'C');	
$pdf->Cell($R1[23],$H1,substr($upB,-1,1),'BTR',0,'C');	

$pdf->Cell($R1[24],$H1,'.','',0,'C');

$pdf->Cell($R1[25],$H1,'0','BTLR',0,'C');	
$pdf->Cell($R1[26],$H1,'0','BTR',0,'C');	
#$KdR = "XYZ";
$pdf->Cell($R1[27],$H1,substr($KdR,-3,1),'BTR',0,'C');	
$pdf->Cell($R1[28],$H1,substr($KdR,-2,1),'BTR',0,'C');	
$pdf->Cell($R1[29],$H1,substr($KdR,-1,1).'','BTR',0,'C');	

$pdf->Cell($R1[30],$H1,'.','',0,'C');

$pdf->Cell($R1[31],$H1,$thA,'BTLR',0,'C');	
$pdf->Cell($R1[32],$H1,$thB,'BTR',0,'C');	
$pdf->Cell($R1[33],$H1,$thC,'BTR',0,'C');	
$pdf->Cell($R1[34],$H1,$thD,'BTR',0,'C');	
$pdf->Ln(11.5) ;

$pdf->Cell(34);
$pdf->Cell(173.2,0,'','B',0,'C');	
$pdf->Ln(3.5) ;

$R2=array(6, 3 ,6, 3 ,6, 3 ,6,6, 3 ,6,6, 3 ,6,6, 3 ,6,6,6, 3 ,6,6,6,6,6,6);
$pdf->Cell(55);
$pdf->Cell($R2[0],$H1,substr($kdA,0,1),'BTLR',0,'C');	
$pdf->Cell($R2[1],$H1,'.',0,0,'C');	
$pdf->Cell($R2[2],$H1,substr($kdA,2,1),'BTLR',0,'C');	
$pdf->Cell($R2[3],$H1,'.',0,0,'C');	
$pdf->Cell($R2[4],$H1,substr($kdA,4,1),'BTLR',0,'C');	
$pdf->Cell($R2[5],$H1,'.',0,0,'C');	
$pdf->Cell($R2[6],$H1,substr($kdA,6,1),'BTLR',0,'C');	
$pdf->Cell($R2[7],$H1,substr($kdA,7,1),'BTLR',0,'C');	
$pdf->Cell($R2[8],$H1,'.',0,0,'C');	
$pdf->Cell($R2[9],$H1,substr($kdA,9,1),'BTLR',0,'C');	
$pdf->Cell($R2[10],$H1,substr($kdA,10,1),'BTLR',0,'C');	
$pdf->Cell($R2[11],$H1,'.',0,0,'C');	
$pdf->Cell($R2[12],$H1,substr($kdA,12,1),'BTLR',0,'C');	
$pdf->Cell($R2[13],$H1,substr($kdA,13,1),'BTLR',0,'C');	
$pdf->Cell($R2[14],$H1,'.',0,0,'C');	
$pdf->Cell($R2[15],$H1,substr($kdA,15,1),'BTLR',0,'C');	
$pdf->Cell($R2[16],$H1,substr($kdA,16,1),'BTLR',0,'C');	
$pdf->Cell($R2[17],$H1,substr($kdA,17,1),'BTLR',0,'C');	
$pdf->Cell($R2[18],$H1,'.',0,0,'C');	
$pdf->Cell($R2[19],$H1,substr($noR,1,1),'BTLR',0,'C');	
$pdf->Cell($R2[20],$H1,substr($noR,2,1),'BTLR',0,'C');	
$pdf->Cell($R2[21],$H1,substr($noR,3,1),'BTLR',0,'C');	
$pdf->Cell($R2[22],$H1,substr($noR,4,1),'BTLR',0,'C');	
$pdf->Cell($R2[23],$H1,substr($noR,5,1),'BTLR',0,'C');	
$pdf->Cell($R2[24],$H1,substr($noR,6,1),'BTLR',0,'C');	

$pdf->Code128(93.6,32.5,$reF,50.2,8); #L,T,'',W,H
#$pdf->Ln(17.6) ;
#$pdf->Cell(101);

#$pdf->SetFont('courier','',6);
#$pdf->Cell($R2[24],$H1,$reF,'',0,'C');	

$pdf->Output();
?>