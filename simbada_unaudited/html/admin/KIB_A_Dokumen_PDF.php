<?php require "CheckSession.php"?>
<?
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";
require "PDF_Source.php";

$gUnt  = $_GET['gUnt'];
$gSub  = $_GET['gSub'];
$gUpb  = $_GET['gUpb'];
$gThn  = $_GET['gThn'];

echo $gUnt."<br>";
echo $gSub."<br>";
echo $gUpb."<br>";
echo $gThn."<br>";

$gMLK  = $_GET['gMLK'];
if ($gThn=="") {$gThn="____";}
if ($gThn=="All") {$gThn="____";}
if ($gMLK=="") {$gMLK="__";}
if ($gMLK=="All") {$gMLK="__";}
$gLok = fStrukKdLokasi($gMLK,$KdProp,$KdKabK,$gUnt,$gSub,$gThn);

$_COOKIE['fUnt']=$gUnt;
$_COOKIE['fSub']=$gSub;
$_COOKIE['fUpb']=$gUpb;
$_COOKIE['fLok']=$gLok;

class PDF extends FPDF
{
	function Header()
	{
		$this->fHeader($_COOKIE['fUnt'],$_COOKIE['fSub'],$_COOKIE['fUpb'],$_COOKIE['fLok']);
	}
	
	function fHeader($gUnt,$gSub,$gUpb,$gLok)
	{	
		$this->SetFont('arial','B',9);
		$this->Cell(1);
		$this->Cell(0,12,'KARTU INVENTARIS BARANG (KIB-A)',0,0,'C');	
		$this->Ln(5);
		
		$this->Cell(1);
		$this->Cell(0,12,'TANAH',0,0,'C');	
		$this->Ln(8);

		$R1=array(20,10,150);
		$this->SetFont('arial','',8);
		$this->Cell(1);
		$this->Cell($R1[0],5,'Unit Kerja ',0,0,'L');	
		$this->Cell($R1[1],5,' : ',0,0,'C');	
		$this->Cell($R1[2],5,fGlobal("Nm_Unit","Ref_Unit","Kd_Unit",$gUnt,"=","",""),0,0,'L');	
		$this->Ln(4) ;

		$this->Cell(1);
		$this->Cell($R1[0],5,'Sub Unit ',0,0,'L');	
		$this->Cell($R1[1],5,' : ',0,0,'C');	
		$this->Cell($R1[2],5,fGlobal("Nm_Sub","Ref_Sub_Unit","Kd_Sub",$gSub,"=","",""),0,0,'L');	
		$this->Ln(4) ;

		$this->Cell(1);
		$this->Cell($R1[0],5,'UPB ',0,0,'L');	
		$this->Cell($R1[1],5,' : ',0,0,'C');	
		$this->Cell($R1[2],5,fGlobal("Nm_Upb","Ref_Upb","Kd_Upb",$gUpb,"=","",""),0,0,'L');	
		$this->Ln(4) ;

		$this->Cell(1);
		$this->Cell($R1[0],5,'Kode Lokasi',0,0,'L');	
		$this->Cell($R1[1],5,' : ',0,0,'C');	
		$this->Cell($R1[2],5,$gLok,0,0,'L');	
		$this->Ln(4) ;
		
		$this->Cell(1);
		$this->Cell($R1[0],5,'',0,0,'L');	
		$this->Cell($R1[1],5,'',0,0,'C');	
		$this->Cell($R1[2],5,'',0,0,'L');	
		$this->Ln(4);
		
		$R2=array(10,60,22,15,17,13,60,20,18,22,35,20,25,60);
		$this->SetFillColor(255,255,255);
		$this->Cell(1);
		$this->Cell($R2[0],10,'No.','TLRB',0,'C',true);
		$this->Cell($R2[1],10,'Jenis / Nama Barang','TLRB',0,'C',true);
		$this->Cell($R2[2],10,'Kode','TLRB',0,'C',true);
		$this->Cell($R2[3],10,'Register','TLRB',0,'C',true);
		$this->Cell($R2[4],10,'Luas (M2)','TLRB',0,'C',true);
		$this->Cell($R2[5],10,'Tahun','TLRB',0,'C',true);
		$this->Cell($R2[6],10,'Letak / Alamat','TLRB',0,'C',true);
		$this->Cell($R2[7],10,'Hak','TLRB',0,'C',true);
		$this->Cell($R2[8],10,'Tgl.Dok','TLRB',0,'C',true);
		$this->Cell($R2[9],10,'No.Dok','TLRB',0,'C',true);
		$this->Cell($R2[10],10,'Penggunaan','TLRB',0,'C',true);
		$this->Cell($R2[11],10,'Asal-Usul','TLRB',0,'C',true);
		$this->Cell($R2[12],10,'Harga (Rp)','TLRB',0,'C',true);
		$this->Cell($R2[13],10,'Keterangan','TLRB',0,'C',true);
		$this->Ln() ;
		
		$this->SetFillColor(250,250,250);
		$this->Cell(1);
		$this->Cell($R2[0],5,'1','TLRB',0,'C',true);
		$this->Cell($R2[1],5,'2','TLRB',0,'C',true);
		$this->Cell($R2[2],5,'3','TLRB',0,'C',true);
		$this->Cell($R2[3],5,'4','TLRB',0,'C',true);
		$this->Cell($R2[4],5,'5','TLRB',0,'C',true);
		$this->Cell($R2[5],5,'6','TLRB',0,'C',true);
		$this->Cell($R2[6],5,'7','TLRB',0,'C',true);
		$this->Cell($R2[7],5,'8','TLRB',0,'C',true);
		$this->Cell($R2[8],5,'9','TLRB',0,'C',true);
		$this->Cell($R2[9],5,'10','TLRB',0,'C',true);
		$this->Cell($R2[10],5,'11','TLRB',0,'C',true);
		$this->Cell($R2[11],5,'12','TLRB',0,'C',true);
		$this->Cell($R2[12],5,'13','TLRB',0,'C',true);
		$this->Cell($R2[13],5,'14','TLRB',0,'C',true);
		$this->Ln() ;
	}
	
	function ListTable($gUpb,$gThn,$gMLK)
	{
		$iG=1; $tJml=0;
		//       (1 ,2 ,3 ,4 ,5 ,6 ,7 ,8 ,9 ,10,11,12,13,14);
		$R3=array(10,60,22,15,17,13,60,20,18,22,35,20,25,60);
		$this->SetFillColor(255,255,255);
		$this->SetFont('arial','',7);
				
		$SQL = "SELECT * FROM ta_kib_a WHERE Kd_UPB='".$gUpb."' AND Tgl_Perolehan LIKE '".$gThn."-__-__' AND Kd_Pemilik LIKE '".$gMLK."' AND Status='' ORDER BY Tgl_Perolehan, Kd_Aset, No_Register";
		$nRs = mysql_query($SQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			do
			{
				$this->Cell(1);
				$NmAss = $mRo['Nm_Aset'];
				$gREF  = $mRo['Referensi'];
				if ($NmAss=="") {$NmAss=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$data['Kd_Aset'],"=","","");}
				$this->Cell($R3[0],5,$iG++,'TLRB',0,'C',true);
				$this->Cell($R3[1],5,$NmAss,'TLRB',0,'L',true);
				$this->Cell($R3[2],5,$mRo['Kd_Aset'],'TLRB',0,'C',true);
				$this->Cell($R3[3],5,$mRo['No_Register'],'TLRB',0,'C',true);
				if ((int)$mRo['Luas_M2']>0) {$Luas = fConvertToRupiahBulat($mRo['Luas_M2']);} else {$Luas="";}
				$this->Cell($R3[4],5,$Luas,'TLRB',0,'C',true);
				$this->Cell($R3[5],5,substr($mRo['Tgl_Perolehan'],0,-6),'TLRB',0,'C',true);
				$this->Cell($R3[6],5,substr($mRo['Alamat'],0,30),'TLRB',0,'L',true);
				$this->Cell($R3[7],5,$mRo['Hak_Tanah'],'TLRB',0,'C',true);
				if (substr($mRo['Sertifikat_Tanggal'],0,4)!='1899') {$TglD = fConvertDateShort($mRo['Sertifikat_Tanggal']);} else {$TglD="";}
				$this->Cell($R3[8],5,$TglD,'TLRB',0,'C',true);
				$this->Cell($R3[9],5,$mRo['Sertifikat_Nomor'],'TLRB',0,'L',true);
				$this->Cell($R3[10],5,substr($mRo['Penggunaan'],0,20),'TLRB',0,'L',true);
				$this->Cell($R3[11],5,$mRo['Asal_Usul'],'TLRB',0,'C',true);
				
				$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi",$gREF,"=","","");
				$gNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Referensi",$gREF,"=","","");
				if ($gNIb!=0) {$gAKH = $gNIa - $gNIb;} else {$gAKH=$gNIa;}
				$tJml = $tJml + $gAKH;
				$this->Cell($R3[12],5,fConvertToRupiah($gAKH),'TLRB',0,'R',true);
				$this->Cell($R3[13],5,substr($mRo['Keterangan'],0,30),'TLRB',0,'L',true);
				$this->Ln() ;
			}
			while ($mRo = mysql_fetch_assoc($nRs));
		}
		else
		{
			$this->Cell(1);
			$this->Cell($R3[0],5,'','TLRB',0,'C',true);
			$this->Cell($R3[1],5,'','TLRB',0,'C',true);
			$this->Cell($R3[2],5,'','TLRB',0,'C',true);
			$this->Cell($R3[3],5,'','TLRB',0,'C',true);
			$this->Cell($R3[4],5,'','TLRB',0,'C',true);
			$this->Cell($R3[5],5,'','TLRB',0,'C',true);
			$this->Cell($R3[6],5,'','TLRB',0,'C',true);
			$this->Cell($R3[7],5,'','TLRB',0,'C',true);
			$this->Cell($R3[8],5,'','TLRB',0,'C',true);
			$this->Cell($R3[9],5,'','TLRB',0,'C',true);
			$this->Cell($R3[10],5,'','TLRB',0,'C',true);
			$this->Cell($R3[11],5,'','TLRB',0,'C',true);
			$this->Cell($R3[12],5,'','TLRB',0,'C',true);
			$this->Cell($R3[13],5,'','TLRB',0,'C',true);
			$this->Ln() ;
		}
		$this->fSummary($tJml);
	}
	
	function fSummary($tJml)
	{
		$R4=array(312,25,60);
		$this->SetFillColor(250,250,250);
		$this->SetFont('arial','B',7);
		$this->Cell(1);
		$this->Cell($R4[0],5,'JUMLAH','TLRB',0,'C',true);
		$this->Cell($R4[1],5,number_format($tJml, 2, ",", "."),'TLRB',0,'R',true);
		$this->Cell($R4[2],5,'','TLRB',0,'C',true);
		$this->Ln();
	}
	
	function fFooter($NmIbKt,$rHri,$rBln,$rThn,$FotA1,$FotC1,$FotA2,$FotC2,$FotA3,$FotC3)
	{
		$R5=array(110,160,110);
		$this->Ln() ;
		$this->SetFillColor(255,255,255);
		$this->SetFont('arial','',8);
		$this->Cell(1);
		$this->Cell($R5[0],5,'Mengetahui,','',0,'C',true);
		$this->Cell($R5[1],5,'','',0,'C',true);
		$this->Cell($R5[2],5,$NmIbKt.", ".$rHri." ".fNmBulan($rBln)." ".$rThn,'',0,'C',true);
		$this->Ln() ;
		
		$this->SetFont('arial','',8);
		$this->Cell(1);
		$this->Cell($R5[0],5,$FotA1,'',0,'C',true);
		$this->Cell($R5[1],5,'','',0,'C',true);
		$this->Cell($R5[2],5,$FotC1,'',0,'C',true);
		$this->Ln();
		$this->Ln();
		$this->Ln();
		$this->Ln();

		$this->SetFont('arial','BU',8);
		$FotA2 = str_pad($FotA2,40, " ", STR_PAD_BOTH);
		$FotC2 = str_pad($FotC2,40, " ", STR_PAD_BOTH);
		$this->Cell($R5[0],3,$FotA2,'',0,'C',true);
		$this->Cell($R5[1],3,'','',0,'C',true);
		$this->Cell($R5[2],3,$FotC2,'',0,'C',true);
		$this->Ln() ;
		
		$this->SetFont('arial','',8);
		$this->Cell($R5[0],5,'NIP.'.$FotA3,'',0,'C',true);
		$this->Cell($R5[1],5,'','',0,'C',true);
		$this->Cell($R5[2],5,'NIP.'.$FotC3,'',0,'C',true);
		$this->Ln() ;
	}
	
	function Footer()
	{
		$this->SetY(-21);
		$this->SetTextColor(200,200,200);
		$this->Cell(100,6,str_repeat("_", 128),0,0,'L');
		
		$this->SetY(-17);
		$this->SetTextColor(200,200,200);
		$this->SetFont('arial','I',8);
		$this->Cell(135,6,'Sumber : Sistem Informasi Manajemen Barang Daerah (Simbada Kab. Hulu Sungai Tengah) http://simbada.palangkaraya.go.id',0,0,'L');
		$this->Cell(30,6,'Recorded '.date('d-m-Y h:m:s'),0,0,'L');
		$R6 = 237;
		$this->SetTextColor(0,0,0);
		$this->SetFont('arial','I',8);
		$this->Cell($R6,6,'{ Hal. '.$this->PageNo().' dari {nb} }',0,0,'R');
		$this->Ln() ;
	}
}

require "Dokumen_Footer.php";
$pdf=new PDF('L','mm',A3);
$pdf->SetMargins(10, 15, 5, 5) ; // kiri,atas,kanan,bawah
$pdf->SetFont('arial','',8);
$pdf->SetAutoPageBreak(true,20);
$pdf->SetDisplayMode(100);
$pdf->AddPage();
$pdf->ListTable($gUpb,$gThn,$gMLK);
$pdf->fFooter($NmIbKt,$rHri,$rBln,$rThn,$FotA[1],$FotC[1],$FotA[2],$FotC[2],$FotA[3],$FotC[3]);
$pdf->AliasNbPages() ;
$pdf->Output('KIB-A '.str_replace(".","",$gUpb).'.pdf',D);
?>