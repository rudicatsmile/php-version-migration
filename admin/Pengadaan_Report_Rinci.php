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
if ($Jns=='All'){$Jns="%";}
$gUnt   = $gUnt;
$gNmUNT = fGlobalNEW("nm_unit","ref_unit","kd_unit",$gUnt,"=","",DatabaseSB,$ConSB,"");

$CekP = fGlobal("IDT","ta_pengadaan","Kd_Program","-","=","IDT DESC LIMIT 0,1","");
if ($CekP!='')
{
	$SQA = "SELECT IDT, No_Berkas FROM ta_pengadaan WHERE Kd_Program='-' ORDER BY IDT";
	#echo $SQA;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$IdT = $mRo[0];
		$NoM = $mRo[1];
		$DtA = fGlobal("Kd_Program:Nm_Program:Kd_Kegiatan:Nm_Kegiatan:Kd_SubKegiatan:Nm_SubKegiatan:Kd_Rek13:Nm_Rek13:Kd_Peruntukan:Nm_Peruntukan","ta_penerimaan_berkas","Nomor",$NoM,"=","IDT DESC LIMIT 0,1","");
		if ($DtA)
		{
			$DtA = explode(':',$DtA);
			$KdP = $DtA[0];
			$NmP = $DtA[1];
			$KdK = $DtA[2];
			$NmK = $DtA[3];
			$KdS = $DtA[4];
			$NmS = $DtA[5];
			$KdR = $DtA[6];
			$NmR = $DtA[7];
			$KdU = $DtA[8];
			$NmU = $DtA[9];
			
			$SQ = "UPDATE ta_pengadaan SET 
			Kd_Program='".$KdP."',
			Nm_Program='".$NmP."',
			Kd_Kegiatan='".$KdK."',
			Nm_Kegiatan='".$NmK."',
			Kd_SubKegiatan='".$KdS."',
			Nm_SubKegiatan='".$NmS."',
			Kd_Rek13='".$KdR."',
			Nm_Rek13='".$NmR."', 
			Kd_Peruntukan='".$KdU."',
			Nm_Peruntukan='".$NmU."' WHERE IDT='".$IdT."'";
			$rs = mysql_query($SQ);
			
		}
	}
}
?>
<body>
<div align="center">
	<table border="0" width="800" cellspacing="1" style="font-size: 8pt; font-family: calibri; border-collapse: collapse">
	<tr>
	  <td style="font-size: 12pt; font-weight: bold; text-align:center">PEMERINTAH <?=$TiDaer." ".$NmDaer?></td>
	</tr>
	<tr>
	  <td style="font-size: 11pt; font-weight: bold; text-align:center">RINCIAN PENGADAAN ASET</td>
	</tr>
	<tr>
		<tr>
			<td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
			  <tr> 
				<td width="90">UNIT KERJA</td>
				<td width="14">:</td>
				<td><?=$gNmUNT ?></td>
			  </tr>
			  <tr>
				<td>TAHUN</td>
				<td>:</td>
				<td><?=$gThA?></td>
			  </tr>
			  <tr>
				<td>JENIS BELANJA</td>
				<td>:</td>
				<td><?php if ($Jns!='%') {echo  fGlobal("Nm_Rek","ref_rek_90_2","Kd_Rek",$Jns,"=","","");} else {echo "SEMUA";}?></td>
			  </tr>
			</table>			</td>
		</tr>
		<tr>
			<td height="5"></td>
		</tr>
		<tr>
		  <td>
		  <table border="0" width="800" style="border:0 solid #000000; font-size: 9pt; font-family: Calibri; border-collapse: collapse" id="table2" bordercolor="#000000">
          <tr height="23">
            <td width="114" style="border:1px solid #000000; font-weight:bold; text-align:center">KODE</td>
            <td colspan="2" style="border:1px solid #000000; font-weight:bold; text-align:center">URAIAN</td>
            <td width="102" style="border:1px solid #000000; font-weight:bold; text-align:center"> PENGADAAN </td> 
            <td width="102" style="border:1px solid #000000; font-weight:bold; text-align:center">ASET </td>
            <td width="92" style="border:1px solid #000000; font-weight:bold; text-align:center">SELISIH</td>
          </tr>
          <tr> 
            <td style="border:1px solid #000000; font-weight: bold" align="center">1</td>
            <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold">2</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">3</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">4</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">5</td>
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
				$nSQ = "SELECT Kd_Program, Nm_Program, IfNull(sum(Nilai),0) as Nilai FROM ta_pengadaan 
				WHERE Kd_Unit = '".$gUnt."' AND Periode='".$gThA."' AND Kd_Rek13 LIKE '".$Jns.".%' GROUP BY Kd_Program";
				$nRs = mysql_query($nSQ);
				#echo $nSQ;
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
						ClrVr();
						$xB = "<b>";
						$KdP = $mRo[0];
						$Col[1] = $mRo[0];
						$Col[2] = strtoupper($mRo[1]);
						$Col[3] = round($mRo[2]);
						$Col[4] = round(sumPengadaanPROG($gUnt,$KdP,$gThA,$Jns,$DatabaseSB,$ConSB));
						$Col[5] = round($Col[3])-round($Col[4]);
						
						$tCol3 = $tCol3 + $Col[3];
						$tCol4 = $tCol4 + $Col[4];
						$tCol5 = $tCol5 + $Col[5];
						if ($iG>1){ViewBlank();}
						ViewRekap($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$xB);
						vwKEGI($gUnt,$KdP,$gThA,$Jns,DatabaseSB,$ConSB);
						$iG++;
				}
				
				function vwKEGI($gUnt,$KdP,$gThA,$Jns,$DatabaseSB,$ConSB)
				{
					$iGG=1;
					$nSQA = "SELECT Kd_Kegiatan, Nm_Kegiatan, IfNull(sum(Nilai),0) as Nilai FROM ta_pengadaan 
					WHERE Kd_Unit='".$gUnt."' AND Kd_Kegiatan LIKE '".$KdP."%' AND Periode='".$gThA."' AND Kd_Rek13 LIKE '".$Jns.".%' GROUP BY Kd_Kegiatan";
					$nRsA = mysql_query($nSQA);
					while ($mRoA = mysql_fetch_array($nRsA, MYSQL_BOTH))
					{
						ClrVr();
						$xB = "<b>";
						$KdK = $mRoA[0];
						$Col[1] = $mRoA[0];
						$Col[2] = "Kegiatan : ".$mRoA[1];
						$Col[3] = round($mRoA[2]);
						$Col[4] = round(sumPengadaanKEGI($gUnt,$KdK,$gThA,$Jns,$DatabaseSB,$ConSB,""));
						$Col[5] = round($Col[3],2)-round($Col[4],2);
						if ($Col[3]>0 || $Col[4]>0){
							if ($iGG>1 && $Col[3]>0){ViewBlank();}
							ViewRekap($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$xB);
							vwSUBK($gUnt,$KdK,$gThA,$Jns,$DatabaseSB,$ConSB);
							$iGG++;
						}
					}
				}
				
				function vwSUBK($gUnt,$KdK,$gThA,$Jns,$DatabaseSB,$ConSB)
				{
					$iGe=1;
					$nSQE = "SELECT Kd_SubKegiatan, Nm_SubKegiatan, IfNull(sum(Nilai),0) as Nilai 
					FROM ta_pengadaan 
					WHERE Kd_Unit='".$gUnt."' AND Kd_SubKegiatan LIKE '".$KdK."%' AND Periode='".$gThA."' AND Kd_Rek13 LIKE '".$Jns.".%' GROUP BY Kd_SubKegiatan";
					$nRsE = mysql_query($nSQE);
					while ($mRoE = mysql_fetch_array($nRsE, MYSQL_BOTH))
					{
						ClrVr();
						$xB = "<b>";
						$KdS = $mRoE[0];
						$Col[1] = $mRoE[0];
						$Col[2] = "Sub Kegiatan : ".$mRoE[1];
						$Col[3] = round($mRoE[2]);
						$Col[4] = round(sumPengadaanSUBK($gUnt,$KdS,$gThA,$Jns,$DatabaseSB,$ConSB,""));
						$Col[5] = round($Col[3],2)-round($Col[4],2);
						if ($Col[3]>0 || $Col[4]>0){
							if ($iGe>1 && $Col[3]>0){ViewBlank();}
							ViewRekap($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$xB);
							vwBELA($gUnt,$KdS,$gThA,$Jns,$DatabaseSB,$ConSB);
							$iGe++;
						}
					}
				}
				
				function vwBELA($gUnt,$KdS,$gThA,$Jns,$DatabaseSB,$ConSB)
				{
					$iGA=1;
					$nSQB = "SELECT Kd_Rek13, Nm_Rek13, IfNull(sum(Nilai),0) as Nilai FROM ta_pengadaan 
					WHERE Kd_Unit='".$gUnt."' AND Kd_SubKegiatan = '".$KdS."' AND Periode='".$gThA."' AND Kd_Rek13 LIKE '".$Jns.".%' GROUP BY Kd_Rek13";

					$nRsB = mysql_query($nSQB);
					while ($mRoB = mysql_fetch_array($nRsB, MYSQL_BOTH))
					{
							ClrVr();
							$xB = "<b>";
							$KdR = $mRoB[0];
							$Col[1] = $mRoB[0];
							$Col[2] = $mRoB[1];
							$Col[3] = round($mRoB[2]);
							$Col[4] = round(sumPengadaanREKN($gUnt,$KdS,$KdR,$gThA,$DatabaseSB,$ConSB,""));
							$Col[5] = round($Col[3],2)-round($Col[4],2);
							ViewRekap($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$xB);
							vwNOMOR($gUnt,$KdS,$KdR,$gThA,$DatabaseSB,$ConSB);
							$iGA++;
					}
				}
				
				function vwNOMOR($gUnt,$KdS,$KdR,$gThA,$DatabaseSB,$ConSB)
				{
					$iGB=1;
					$nSQC = "SELECT Nomor, Uraian, Nilai, Kd_Aset_108, Nm_Aset_108, Kd_Rek13 FROM ta_pengadaan WHERE Kd_Unit='".$gUnt."' AND Kd_SubKegiatan = '".$KdS."' AND Kd_Rek13='".$KdR."' AND Periode='".$gThA."' ORDER BY Nomor";
					$nRsC = mysql_query($nSQC);
					while ($mRoC = mysql_fetch_array($nRsC, MYSQL_BOTH))
					{
							ClrVr();
							$xB = "";
							$NoM = $mRoC[0];
							$Kd13 = substr($mRoC[5],0,6);
							#5.2.01	Tanah
							#5.2.02	Belanja Modal Peralatan dan Mesin
							#5.2.03	Belanja Modal Gedung dan Bangunan
							#5.2.04	Belanja Modal Jalan, Jaringan, dan Irigasi
							#5.2.05	Belanja Modal Aset Tetap Lainnya
							$Kd08 = substr($mRoC[3],0,5);
							$Kd0F = $mRoC[3];
							#1.3.1	TANAH							1.3.6.01.01.01.001	Tanah Dalam Pengerjaan
							#1.3.2	PERALATAN DAN MESIN				1.3.6.01.01.01.002	Peralatan dan Mesin Dalam Pengerjaan
							#1.3.3	GEDUNG DAN BANGUNAN				1.3.6.01.01.01.003	Gedung dan Bangunan Dalam Pengerjaan
							#1.3.4	JALAN, JARINGAN DAN IRIGASI		1.3.6.01.01.01.004	Jalan, Irigasi, dan jaringan Dalam Pengerjaan
							#1.3.5	ASET TETAP LAINNYA				1.3.6.01.01.01.005	Aset Tetap Lainnya Dalam Pengerjaan
							$CuR="";
							if ($Kd13=='5.2.01' && $Kd08!='1.3.1' && $Kd0F!='1.3.6.01.01.01.001') {$CuR="<font style='color:#ff0000'>";}
							if ($Kd13=='5.2.02' && $Kd08!='1.3.2' && $Kd0F!='1.3.6.01.01.01.002') {$CuR="<font style='color:#ff0000'>";}
							if ($Kd13=='5.2.03' && $Kd08!='1.3.3' && $Kd0F!='1.3.6.01.01.01.003') {$CuR="<font style='color:#ff0000'>";}
							if ($Kd13=='5.2.04' && $Kd08!='1.3.4' && $Kd0F!='1.3.6.01.01.01.004') {$CuR="<font style='color:#ff0000'>";}
							if ($Kd13=='5.2.05' && $Kd08!='1.3.5' && $Kd0F!='1.3.6.01.01.01.005') {$CuR="<font style='color:#ff0000'>";}
							
							$Col[1] = $mRoC[0];
							$Col[2] = $mRoC[1]."<br><i>".$CuR.$mRoC[3]." : ".$mRoC[4];
							$Col[3] = round($mRoC[2]);
							$Col[4] = round(fGlobal("IfNull(sum(debet),0)","ta_kib_post_108","No_Pengadaan",$NoM,"=","",""));
							$Col[5] = round($Col[3],2)-round($Col[4],2);
							ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$xB);
							$iGB++;
					}
				}
				
				if ($iG==1){ViewBlank();}
				
				function sumPengadaanPROG($gUnt,$KdP,$gThA,$Jns,$DatabaseSB,$ConSB)
				{
					$LoadNIL = 0;
					$nSQP = "SELECT Nomor FROM ta_pengadaan WHERE Kd_Unit='".$gUnt."' AND Kd_Program = '".$KdP."' AND Periode='".$gThA."' AND Kd_Rek13 LIKE '".$Jns.".%' ORDER BY Nomor";
					$nRsP = mysql_query($nSQP);
					while ($mRoP = mysql_fetch_array($nRsP, MYSQL_BOTH))
					{
						$zNoM = $mRoP[0];
						$LoadNIL = $LoadNIL + fGlobal("IfNull(sum(debet),0)","ta_kib_post_108","No_Pengadaan",$zNoM,"=","","");
					}
					return $LoadNIL;
				}
				
				function sumPengadaanKEGI($gUnt,$KdK,$gThA,$Jns,$DatabaseSB,$ConSB,$Lod)
				{
					$LoadNIL = 0;
					$nSQP = "SELECT Nomor FROM ta_pengadaan WHERE Kd_Unit='".$gUnt."' AND Kd_Kegiatan = '".$KdK."' AND Periode='".$gThA."' AND Kd_Rek13 LIKE '".$Jns.".%' ORDER BY Nomor";
					if ($Lod){echo $nSQP."<br>";}
					$nRsP = mysql_query($nSQP);
					while ($mRoP = mysql_fetch_array($nRsP, MYSQL_BOTH))
					{
						$zNoM = $mRoP[0];
						$LoadNIL = $LoadNIL + fGlobal("IfNull(sum(debet),0)","ta_kib_post_108","No_Pengadaan",$zNoM,"=","","");
					}
					return $LoadNIL;
				}
				
				function sumPengadaanSUBK($gUnt,$KdS,$gThA,$Jns,$DatabaseSB,$ConSB,$Lod)
				{
					$LoadNIL = 0;
					$nSQP = "SELECT Nomor FROM ta_pengadaan WHERE Kd_Unit='".$gUnt."' AND Kd_SubKegiatan = '".$KdS."' AND Periode='".$gThA."' AND Kd_Rek13 LIKE '".$Jns.".%' ORDER BY Nomor";
					if ($Lod){echo $nSQP."<br>";}
					$nRsP = mysql_query($nSQP);
					while ($mRoP = mysql_fetch_array($nRsP, MYSQL_BOTH))
					{
						$zNoM = $mRoP[0];
						$LoadNIL = $LoadNIL + fGlobal("IfNull(sum(debet),0)","ta_kib_post_108","No_Pengadaan",$zNoM,"=","","");
					}
					return $LoadNIL;
				}
				
				function sumPengadaanREKN($gUnt,$KdS,$KdR,$gThA,$DatabaseSB,$ConSB,$Lod)
				{
					$LoadNIL = 0;
					$nSQP = "SELECT Nomor FROM ta_pengadaan WHERE Kd_Unit='".$gUnt."' AND Kd_SubKegiatan = '".$KdS."' AND Kd_Rek13='".$KdR."' AND Periode='".$gThA."' ORDER BY Nomor";
					if ($Lod){echo $nSQP."<br>";}
					$nRsP = mysql_query($nSQP);
					while ($mRoP = mysql_fetch_array($nRsP, MYSQL_BOTH))
					{
						$zNoM = $mRoP[0];
						$LoadNIL = $LoadNIL + fGlobal("IfNull(sum(debet),0)","ta_kib_post_108","No_Pengadaan",$zNoM,"=","","");
					}
					return $LoadNIL;
				}
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
            <td colspan="2" valign="top" style="border: 1px solid #000000; text-align:left; padding-left:5px"><?=$xB.$x2?></td>
            <td valign="top" style="border: 1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah2dgt($x3)?></td>
            <td valign="top" style="border: 1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah2dgt($x4)?></td>
            <td valign="top" style="border: 1px solid #000000; text-align:right; padding-right:3px <?=$eCL?>"><?=$xB.fConvertToRupiah2dgt($x5)?></td>
          </tr>
          <?php } ?>
          <?php function ViewRincian($x1,$x2,$x3,$x4,$x5,$xB) {?>
		  <?php
		  $eCL="";
		  if ($x5<0){
		  	$eCL="; color:#FF0000";
		  }
		  else if ($x5>0){
		  	$eCL="; color:#0000FF";
		  }
		  ?>
          <tr style="font-family:arial; font-size:8pt"> 
            <td valign="top" style="border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:left; padding-left:5px">&nbsp;</td>
            <td width="129" valign="top" style="border-top:1px solid #000000; border-bottom:1px solid #000000; text-align:left; padding-left:5px"><?=$xB.$x1?></td>
            <td width="235" valign="top" style="border-top:1px solid #000000; border-bottom:1px solid #000000; border-right:1px dotted #000000; border-left:1px dotted #000000; text-align:left; padding-left:5px"><?=$xB.$x2?></td>
            <td valign="top" style="border: 1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah2dgt($x3)?></td>
            <td valign="top" style="border: 1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah2dgt($x4)?></td>
            <td valign="top" style="border: 1px solid #000000; text-align:right; padding-right:3px <?=$eCL?>"><?=$xB.fConvertToRupiah2dgt($x5)?></td>
          </tr>
          <?php } ?>
          <?php function ViewBlank() {?>
          <tr> 
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td colspan="2" style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
          </tr>
          <?php } ?>
          <tr height="23">
            <td style="border:1px solid #000000; font-weight: bold" colspan="3" align="center">T O T A L</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold; text-align:right; padding-right:3px"><?=fConvertToRupiah2dgt($tCol3)?></td>
            <td align="center" style="border:1px solid #000000; font-weight: bold; text-align:right; padding-right:3px"><?=fConvertToRupiah2dgt($tCol4)?></td>
            <td align="center" style="border:1px solid #000000; font-weight: bold; text-align:right; padding-right:3px"><?=fConvertToRupiah2dgt($tCol5)?></td>
          </tr>
        </table>		  </td>
		</tr>
		<tr>
		  <td style="font-family: Calibri; font-style: italic">&nbsp;</td>
	  </tr>
		<tr>
			<td style="font-family: Calibri; font-style: italic">
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
					<td align="center" width="230">NIP. <?=$FotC[3]?> </td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
			</table>
			<?php } ?>			</td>
		</tr>
	</table>
</div>

</body>

</html>