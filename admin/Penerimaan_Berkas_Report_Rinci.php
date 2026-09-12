<?php
require "Connection.php";
require "FileFunction.php";
ini_set('max_execution_time', 300);
extract($_GET);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Simbada</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
$gUnt   = $gUnt;
$gNmUNT = fGlobalNEW("nm_unit","ref_unit","kd_unit",$gUnt,"=","",DatabaseSB,$ConSB,"");
?>
<body>
<div align="center">
<table border="0" width="900" cellspacing="1" style="font-size: 8pt; font-family: calibri; border-collapse: collapse">
<tr>
  <td style="font-size: 12pt; font-weight: bold; text-align:center">PEMERINTAH <?=$TiDaer." ".$NmDaer?></td>
</tr>
<tr>
  <td style="font-size: 11pt; font-weight: bold; text-align:center">RINCIAN PENERIMAAN BERKAS</td>
</tr>
<tr>
  <td style="font-size: 11pt; font-weight: bold; text-align:center">PENGADAAN ASET</td>
</tr>
<tr>
	<td>
	<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
	  <tr> 
		<td width="103">UNIT KERJA</td>
		<td width="16">:</td>
		<td width="389"><?=$gNmUNT ?></td>
		<td width="106">&nbsp;</td>
		<td width="19">&nbsp;</td>
		<td width="544">&nbsp;</td>
	  </tr>
	  
	  <tr>
		<td>TAHUN</td>
		<td>:</td>
		<td><?=$gThA?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	</table>			</td>
</tr>
<tr>
	<td height="5"></td>
</tr>
<tr>
  <td>
  <table border="0" width="900" style="border:0 solid #000000; font-size: 9pt; font-family: Calibri; border-collapse: collapse" id="table2" bordercolor="#000000">
  <tr height="23">
	<td width="121" style="border:1px solid #000000; font-weight:bold; text-align:center">KODE</td>
	<td colspan="3" style="border:1px solid #000000; font-weight:bold; text-align:center">URAIAN</td>
	<td width="130" style="border:1px solid #000000; font-weight:bold; text-align:center">NILAI BERKAS</td>
	</tr>
  <tr> 
	<td style="border:1px solid #000000; font-weight: bold" align="center">1</td>
	<td colspan="3" align="center" style="border:1px solid #000000; font-weight: bold">2</td>
	<td align="center" style="border:1px solid #000000; font-weight: bold">4</td>
	</tr>
  <?php
		$Col[16];
		$iG = 1;
		$gHrg = 0;
		function ClrVr()
		{
			for($nG=0; $nG<=15; $nG++)
			{
				$Col[$nG]="";
			}
		}
		
		$tCol3 = 0;
		$tCol4 = 0;
		$tCol5 = 0;
		$nSQ = "SELECT idProgram, nmProgram FROM ta_apbd_program_skpd WHERE kdUnit = '".$gUnt."' AND Periode='".$gThA."' GROUP BY idProgram";
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
				ClrVr();
				$xB = "<b>";
				$KdP = $mRo[0];
				$Col[1] = $mRo[0];
				$Col[2] = strtoupper($mRo[1]);
				
				$Col[3] = fGlobalNEW("IfNull(sum(fnJumlah),0)","ta_apbd_rekening_skpd","kdUnit:idKegiatan:Periode",$gUnt.":".$KdP."%:".$gThA,"=:LIKE:=","",DatabaseSB,$ConSB,"");
				$Col[4] = fGlobalNEW("IfNull(sum(Nilai),0)","ta_penerimaan_berkas","Kd_Unit:Kd_Kegiatan:Periode",$gUnt.":".$KdP."%:".$gThA,"=:LIKE:=","",$DatabaseSB,$ConSB,"");
				$Col[5] = $Col[3]-$Col[4];
				
				$tCol3 = $tCol3 + $Col[3];
				$tCol4 = $tCol4 + $Col[4];
				$tCol5 = $tCol5 + $Col[5];
				if ($Col[4]>0){
					if ($iG>1){ViewBlank();}
					ViewRekap($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$xB);
					vwKEGI($gUnt,$KdP,$gThA,DatabaseSB,$ConSB);
					$iG++;
				}
		}
		
		function vwKEGI($gUnt,$KdP,$gThA,$DatabaseSB,$ConSB)
		{
			$iGG=1;
			$nSQA = "SELECT idKegiatan, nmKegiatan FROM ta_apbd_kegiatan_skpd WHERE kdUnit = '".$gUnt."' AND idKegiatan LIKE '".$KdP."%' AND Periode='".$gThA."' GROUP BY idKegiatan";
			$nRsA = mysql_query($nSQA);
			while ($mRoA = mysql_fetch_array($nRsA, MYSQL_BOTH))
			{
				ClrVr();
				$xB = "<b>";
				$KdK = $mRoA[0];
				$Col[1] = $mRoA[0];
				$Col[2] = $mRoA[1];
				$Col[3] = fGlobalNEW("IfNull(sum(fnJumlah),0)","ta_apbd_rekening_skpd","kdUnit:idKegiatan:Periode",$gUnt.":".$KdK."%:".$gThA,"=:LIKE:=","",$DatabaseSB,$ConSB,"");
				$Col[4] = fGlobalNEW("IfNull(sum(Nilai),0)","ta_penerimaan_berkas","Kd_Unit:Kd_Kegiatan:Periode",$gUnt.":".$KdK.":".$gThA,"=:=:=","",$DatabaseSB,$ConSB,"");
				$Col[5] = $Col[3]-$Col[4];
				if ($Col[4]>0){
					if ($iGG>1){ViewBlank();}
					ViewRekap($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$xB);
					vwSUBK($gUnt,$KdK,$gThA,$DatabaseSB,$ConSB);
					$iGG++;
				}
			}
		}
		
		function vwSUBK($gUnt,$KdP,$gThA,$DatabaseSB,$ConSB)
		{
			$iGB=1;
			$nSQE = "SELECT idSubKegiatan, nmSubKegiatan FROM ta_apbd_kegiatan_sub_skpd WHERE kdUnit='".$gUnt."' AND idKegiatan = '".$KdP."' AND Periode='".$gThA."' GROUP BY idSubKegiatan";
			$nRsE = mysql_query($nSQE);
			while ($mRoE = mysql_fetch_array($nRsE, MYSQL_BOTH))
			{
				ClrVr();
				$xB  = "<b>";
				$KdS = $mRoE[0];
				$Col[1] = $mRoE[0];
				$Col[2] = $mRoE[1];
				$Col[3] = fGlobalNEW("IfNull(sum(fnJumlah),0)","ta_apbd_rekening_skpd","kdUnit:idSubKegiatan:Periode",$gUnt.":".$KdS."%:".$gThA,"=:LIKE:=","",$DatabaseSB,$ConSB,"");
				$Col[4] = fGlobalNEW("IfNull(sum(Nilai),0)","ta_penerimaan_berkas","Kd_Unit:Kd_SubKegiatan:Periode",$gUnt.":".$KdS.":".$gThA,"=:=:=","",$DatabaseSB,$ConSB,"");
				$Col[5] = $Col[3]-$Col[4];
				if ($Col[3]>0 || $Col[4]>0){
					if ($iGB>1 && $Col[3]>0){ViewBlank();}
					ViewRekap($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$xB);
					vwBELA($gUnt,$KdS,$gThA,$DatabaseSB,$ConSB);
					$iGB++;
				}
			}
		}
		
		function vwBELA($gUnt,$KdS,$gThA,$DatabaseSB,$ConSB)
		{
			$iGA=1;
			$nSQB = "SELECT kdRekening, nmRekening, IfNull(sum(fnJumlah),0) as fnJml FROM ta_apbd_rekening_skpd WHERE kdUnit='".$gUnt."' AND idSubKegiatan = '".$KdS."' AND Periode='".$gThA."' GROUP BY kdRekening";
			#echo $nSQB."<br>";
			$nRsB = mysql_query($nSQB);
			while ($mRoB = mysql_fetch_array($nRsB, MYSQL_BOTH))
			{
				ClrVr();
				$xB = "<b>";
				$KdR = $mRoB[0];
				$Col[1] = $mRoB[0];
				$Col[2] = $mRoB[1];
				$Col[3] = $mRoB[2];
				$Col[4] = fGlobalNEW("IfNull(sum(Nilai),0)","ta_penerimaan_berkas","Kd_Unit:Kd_SubKegiatan:Kd_Rek13:Periode",$gUnt.":".$KdS.":".$KdR.":".$gThA,"=:=:=:=","",$DatabaseSB,$ConSB,"");
				$Col[5] = $Col[3]-$Col[4];
				if ($Col[4]>0){
					if ($iGA>1 && $Col[3]>0){ViewBlank();}
					ViewRekap($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$xB);
					vwBERKAS($gUnt,$KdS,$KdR,$gThA,$DatabaseSB,$ConSB);
					$iGA++;
				}
			}
		}
		
		function vwBERKAS($gUnt,$KdS,$KdR,$gThA,$DatabaseSB,$ConSB)
		{
			$iGB=1;
			$nSQC = "SELECT Tanggal, Nomor, Uraian, Nilai FROM ta_penerimaan_berkas WHERE Kd_Unit = '".$gUnt."' AND Kd_SubKegiatan = '".$KdS."' AND Kd_Rek13='".$KdR."' AND Periode='".$gThA."' ORDER BY Tanggal";
			$nRsC = mysql_query($nSQC);
			while ($mRoC = mysql_fetch_array($nRsC, MYSQL_BOTH))
			{
					ClrVr();
					$xB = "";
					$Col[1] = fConvertDateShort($mRoC[0]);
					$Col[2] = $mRoC[1];
					$Col[3] = $mRoC[2];
					$Col[4] = $mRoC[3];
					$Col[5] = 0;
					ViewRinci($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$xB);
					$iGB++;
			}
		}
		
		if ($iG==1){ViewBlank();}
		?>
  <?php function ViewRekap($x1,$x2,$x3,$x4,$x5,$xB) {?>
  <?php
  $eCL="";
  if ($x5<0){
	$eCL="; color:#FF0000";
  }
  ?>
  <tr> 
	<td valign="top" style="border: 1px solid #000000; text-align:left; padding-left:5px"><?=$xB.$x1?></td>
	<td colspan="3" valign="top" style="border: 1px solid #000000; text-align:left; padding-left:5px"><?=$xB.$x2?></td>
	<td valign="top" style="border: 1px solid #000000; text-align:right; padding-right:5px"><?=$xB.fConvertToRupiah($x4)?></td>
	</tr>
  <?php } ?>
  <?php function ViewRinci($x1,$x2,$x3,$x4,$x5,$xB) {?>
  <?php
  $eCL="";
  if ($x5<0){
	$eCL="; color:#FF0000";
  }
  ?>
  <tr style="font-family: Arial, Helvetica, sans-serif; font-size:8pt"> 
	<td valign="top" style="border: 1px solid #000000; text-align:left; padding-left:5px">&nbsp;</td>
	<td width="59" valign="top" style="border: 1px solid #000000; text-align:left; padding-left:5px"><?=$xB.$x1?></td>
	<td width="124" valign="top" style="border: 1px solid #000000; text-align:left; padding-left:5px"><?=$xB.$x2?></td>
	<td width="444" valign="top" style="border: 1px solid #000000; text-align:left; padding-left:5px"><?=$xB.$x3?></td>
	<td valign="top" style="border: 1px solid #000000; text-align:right; padding-right:5px"><?=$xB.fConvertToRupiah($x4)?></td>
	</tr>
  <?php } ?>
  <?php function ViewBlank() {?>
  <tr> 
	<td style="border: 1px solid #000000">&nbsp;</td>
	<td colspan="3" style="border: 1px solid #000000">&nbsp;</td>
	<td style="border: 1px solid #000000">&nbsp;</td>
	</tr>
  <?php } ?>
  <tr height="23">
	<td style="border:1px solid #000000; font-weight: bold" colspan="4" align="center">T O T A L</td>
	<td align="center" style="border:1px solid #000000; font-weight: bold; text-align:right; padding-right:5px"><?=fConvertToRupiah($tCol4)?></td>
	</tr>
</table>		  </td>
</tr>
<tr>
  <td style="font-family: Calibri Narrow; font-style: italic">&nbsp;</td>
</tr>
<tr>
	<td style="font-family: Calibri Narrow; font-style: italic">
	<?php if ($gUnt!="All") { ?>
	<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table6">
		<?php require "Dokumen_Footer_Pengadaan.php";?>
		<tr>
			<td width="50" align="center">&nbsp;</td>
			<td width="230" align="center">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="center" width="230"><?=$NmIbKt.", ".$gHr." ".fNmBulan($gBl)." ".$gTh?></td>
			<td align="center" width="50">&nbsp;</td>
		</tr>
		<tr>
			<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
			<td width="230" align="center" style="font-weight: bold">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="center" style="font-weight: bold" width="230"><?=$FotC[1]?></td>
			<td align="center" style="font-weight: bold" width="50">&nbsp;</td>
		</tr>
		<tr>
			<td width="50" align="center">&nbsp;</td>
			<td width="230" align="center">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="center" width="230">&nbsp;</td>
			<td align="center" width="50">&nbsp;</td>
		</tr>
		<tr>
			<td width="50" align="center">&nbsp;</td>
			<td width="230" align="center">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="center" width="230">&nbsp;</td>
			<td align="center" width="50">&nbsp;</td>
		</tr>
		<tr>
			<td width="50" align="center">&nbsp;</td>
			<td width="230" align="center">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="center" width="230">&nbsp;</td>
			<td align="center" width="50">&nbsp;</td>
		</tr>
		<tr>
			<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
			<td width="230" align="center" style="font-weight: bold">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="center" style="font-weight: bold; text-decoration:underline" width="230"><?=$FotC[2]?></td>
			<td align="center" style="font-weight: bold" width="50">&nbsp;</td>
		</tr>
		<tr>
			<td width="50" align="center">&nbsp;</td>
			<td width="230" align="center">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="center" width="230">NIP. <?=$FotC[3]?></td>
			<td align="center" width="50">&nbsp;</td>
		</tr>
	</table>
	<?php } ?>	
   </td>
</tr>
</table>
</div>
</body>
</html>