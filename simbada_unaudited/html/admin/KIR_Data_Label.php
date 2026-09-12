<?
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";
require "KIR_Data_Label_pdf.php";

$IDT = $_GET['IDT'];
$_COOKIE['IDT']=$IDT;

class PDF extends FPDF
{
	function Header()
	{
		$this->fHeader($_COOKIE['IDT']);
		$this->Image('Images/LogoLabel.gif',13,5,19,22);
	}
	
	function fHeader($IDT)
	{	
		$DT = fGlobal("kd_aset_108:no_register:kd_upb:tgl_perolehan:kd_pemilik:extracom","ta_kib_108","IDT",$IDT,"=","","");
		if ($DT)
		{
			$DT = explode(':',$DT);
			$kdA = $DT[0];
			$noR = $DT[1];
			$upB = $DT[2];
			$tgL = $DT[3];
			$mlK = $DT[4];
			$exT = $DT[5];
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

		$H1=8;
		#$R1=array(6,6, 2 ,6,6, 2 ,6,6, 2 ,6,6, 2 ,6,6,6,6,6,6, 2 ,6,6,6,6,6, 2 ,6,6,6,6,6, 2 ,6,6,6,6);
		$R1=array(5,5, 2 ,5,5, 2 ,5,5, 2 ,5,5, 2 ,5,5,5,5,5,5, 2 ,5,5,5,5,5, 2 ,5,5,5,5,5, 2 ,5,5,5,5);
		
		$this->SetFont('arial','B',13);
		$this->Cell(35);
		$this->Cell($R1[0],$H1,substr($mlK,0,1),'BTLR',0,'C');	
		$this->Cell($R1[1],$H1,substr($mlK,-1,1),'BTR',0,'C');	
		$this->Cell($R1[2],$H1,'.',0,0,'C');	
		$this->Cell($R1[3],$H1,substr($exT,0,1),'BTLR',0,'C');	
		$this->Cell($R1[4],$H1,substr($exT,-1,1),'BTR',0,'C');	
		$this->Cell($R1[5],$H1,'.',0,0,'C');	
		$this->Cell($R1[6],$H1,substr($upB,0,1),'BTLR',0,'C');	
		$this->Cell($R1[7],$H1,substr($upB,1,1),'BTR',0,'C');	
		$this->Cell($R1[8],$H1,'.','',0,'C');	
		$this->Cell($R1[9],$H1,substr($upB,3,1),'BTLR',0,'C');	
		$this->Cell($R1[10],$H1,substr($upB,4,1),'BTR',0,'C');	
		
		$this->Cell($R1[11],$H1,'.','',0,'C');
		
		
		$this->Cell($R1[12],$H1,substr($upB,6,1),'BTLR',0,'C');	
		$this->Cell($R1[13],$H1,substr($upB,7,1),'BTR',0,'C');	
		$this->Cell($R1[14],$H1,substr($upB,9,1),'BTR',0,'C');	
		$this->Cell($R1[15],$H1,substr($upB,10,1),'BTR',0,'C');	
		$this->Cell($R1[16],$H1,substr($upB,12,1),'BTR',0,'C');	
		$this->Cell($R1[17],$H1,substr($upB,13,1),'BTR',0,'C');	
		
		$this->Cell($R1[18],$H1,'.','',0,'C');
		
		$this->Cell($R1[19],$H1,'0','BTLR',0,'C');	
		$this->Cell($R1[20],$H1,'0','BTR',0,'C');	
		$this->Cell($R1[21],$H1,'0','BTR',0,'C');	
		$this->Cell($R1[22],$H1,'0','BTR',0,'C');	
		$this->Cell($R1[23],$H1,'0','BTR',0,'C');	
		
		$this->Cell($R1[24],$H1,'.','',0,'C');
		
		$this->Cell($R1[25],$H1,'0','BTLR',0,'C');	
		$this->Cell($R1[26],$H1,'0','BTR',0,'C');	
		$this->Cell($R1[27],$H1,'0','BTR',0,'C');	
		$this->Cell($R1[28],$H1,'0','BTR',0,'C');	
		$this->Cell($R1[29],$H1,'0','BTR',0,'C');	
		
		$this->Cell($R1[30],$H1,'.','',0,'C');
		
		$this->Cell($R1[31],$H1,$thA,'BTLR',0,'C');	
		$this->Cell($R1[32],$H1,$thB,'BTR',0,'C');	
		$this->Cell($R1[33],$H1,$thC,'BTR',0,'C');	
		$this->Cell($R1[34],$H1,$thD,'BTR',0,'C');	
		$this->Ln(10) ;
		
		$this->Cell(35);
		$this->Cell(154,0,'','BTLR',0,'C');	
		$this->Ln(2) ;
		
		#$R2=array(6, 2 ,6, 2 ,6, 2 ,6,6, 2 ,6,6, 2 ,6,6, 2 ,6,6,6, 2 ,6,6,6,6,6,6);
		$R2=array(5, 2 ,5, 2 ,5, 2 ,5,5, 2 ,5,5, 2 ,5,5, 2 ,5,5,5, 2 ,5,5,5,5,5,5);
		$this->Cell(55);
		$this->Cell($R2[0],$H1,substr($kdA,0,1),'BTLR',0,'C');	
		$this->Cell($R2[1],$H1,'.',0,0,'C');	
		$this->Cell($R2[2],$H1,substr($kdA,2,1),'BTLR',0,'C');	
		$this->Cell($R2[3],$H1,'.',0,0,'C');	
		$this->Cell($R2[4],$H1,substr($kdA,4,1),'BTLR',0,'C');	
		$this->Cell($R2[5],$H1,'.',0,0,'C');	
		$this->Cell($R2[6],$H1,substr($kdA,6,1),'BTLR',0,'C');	
		$this->Cell($R2[7],$H1,substr($kdA,7,1),'BTLR',0,'C');	
		$this->Cell($R2[8],$H1,'.',0,0,'C');	
		$this->Cell($R2[9],$H1,substr($kdA,9,1),'BTLR',0,'C');	
		$this->Cell($R2[10],$H1,substr($kdA,10,1),'BTLR',0,'C');	
		$this->Cell($R2[11],$H1,'.',0,0,'C');	
		$this->Cell($R2[12],$H1,substr($kdA,12,1),'BTLR',0,'C');	
		$this->Cell($R2[13],$H1,substr($kdA,13,1),'BTLR',0,'C');	
		$this->Cell($R2[14],$H1,'.',0,0,'C');	
		$this->Cell($R2[15],$H1,substr($kdA,15,1),'BTLR',0,'C');	
		$this->Cell($R2[16],$H1,substr($kdA,16,1),'BTLR',0,'C');	
		$this->Cell($R2[17],$H1,substr($kdA,17,1),'BTLR',0,'C');	
		$this->Cell($R2[18],$H1,'.',0,0,'C');	
		$this->Cell($R2[19],$H1,substr($noR,1,1),'BTLR',0,'C');	
		$this->Cell($R2[20],$H1,substr($noR,2,1),'BTLR',0,'C');	
		$this->Cell($R2[21],$H1,substr($noR,3,1),'BTLR',0,'C');	
		$this->Cell($R2[22],$H1,substr($noR,4,1),'BTLR',0,'C');	
		$this->Cell($R2[23],$H1,substr($noR,5,1),'BTLR',0,'C');	
		$this->Cell($R2[24],$H1,substr($noR,6,1),'BTLR',0,'C');	
	}
	
	
	function Footer()
	{
	}
}


$pdf=new PDF('p','mm','label');
$pdf->SetMargins(10, 7, 5, 5) ; // kiri,atas,kanan,bawah
$pdf->SetFont('arial','',8);
$pdf->SetAutoPageBreak(true,20);
$pdf->SetDisplayMode(100);
$pdf->AddPage();
$pdf->AliasNbPages() ;
$pdf->Output('LABEL.pdf',D);
?>