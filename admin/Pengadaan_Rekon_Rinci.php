<?php
require "Connection.php";
require "FileFunction.php";
ini_set('max_execution_time', 300);
extract($_GET);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
$gUnt   = $gUnt;
$gNmUNT = fGlobalNEW("nm_unit","ref_unit","kd_unit",$gUnt,"=","",DatabaseSB,$ConSB,"");
?>
<body>
<div align="center">
	<table border="0" width="1330" cellspacing="1" style="font-size: 8pt; font-family: calibri; border-collapse: collapse">
	<tr>
	  <td style="font-size: 12pt; font-weight: bold; text-align:center">PEMERINTAH <?=$TiDaer." ".$NmDaer?></td>
	</tr>
	<tr>
	  <td style="font-size: 11pt; font-weight: bold; text-align:center">REKONSILISASI PENGADAAN ASET (RINCI)</td>
	</tr>
		<tr>
			<td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
			  <tr> 
				<td width="74">UNIT KERJA</td>
				<td width="14">:</td>
				<td width="702"><?=$gNmUNT ?></td>
			  </tr>
			  
			  <tr>
				<td>TAHUN</td>
				<td>:</td>
				<td><?=$gThA?></td>
			  </tr>
			</table>			</td>
		</tr>
		<tr>
			<td height="5"></td>
		</tr>
		<tr>
		  <td>
		  <table border="0" width="1330" style="border:0 solid #000000; font-size: 9pt; font-family: Calibri; border-collapse: collapse" id="table2" bordercolor="#000000">
          <tr height="23">
            <td width="88" style="border:1px solid #000000; font-weight:bold; text-align:center">KODE</td>
            <td width="284" style="border:1px solid #000000; font-weight:bold; text-align:center">URAIAN</td>
            <td width="120" style="border:1px solid #000000; font-weight:bold; text-align:center"> PENGADAAN </td> 
            <td colspan="6" style="border:1px solid #000000; font-weight:bold; text-align:center">A S E T</td>
            </tr>
          <tr> 
            <td style="border:1px solid #000000; font-weight: bold" align="center">1</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">2</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">3</td>
            <td colspan="6" align="center" style="border:1px solid #000000; font-weight: bold">4</td>
            </tr>
          <?php
				###################
				function sumPengadaanPROG($gUnt,$KdP,$gThA,$DatabaseSB,$ConSB)
				{
					$LoadNIL = 0;
					$nSQP = "SELECT Nomor FROM ta_pengadaan WHERE Kd_Unit='".$gUnt."' AND Kd_Program = '".$KdP."' AND Periode='".$gThA."' ORDER BY Nomor";
					$nRsP = mysql_query($nSQP);
					while ($mRoP = mysql_fetch_array($nRsP, MYSQL_BOTH))
					{
						$zNoM = $mRoP[0];
						$LoadNIL = $LoadNIL + fGlobal("IfNull(sum(debet),0)","ta_kib_post_108","No_Pengadaan",$zNoM,"=","","");
					}
					return $LoadNIL;
				}
				
				function sumPengadaanKEGI($gUnt,$KdK,$gThA,$DatabaseSB,$ConSB,$Lod)
				{
					$LoadNIL = 0;
					$nSQP = "SELECT Nomor FROM ta_pengadaan WHERE Kd_Unit='".$gUnt."' AND Kd_Kegiatan = '".$KdK."' AND Periode='".$gThA."' ORDER BY Nomor";
					if ($Lod){echo $nSQP."<br>";}
					$nRsP = mysql_query($nSQP);
					while ($mRoP = mysql_fetch_array($nRsP, MYSQL_BOTH))
					{
						$zNoM = $mRoP[0];
						$LoadNIL = $LoadNIL + fGlobal("IfNull(sum(debet),0)","ta_kib_post_108","No_Pengadaan",$zNoM,"=","","");
					}
					return $LoadNIL;
				}
				
				function sumPengadaanREKN($gUnt,$KdK,$KdR,$gThA,$DatabaseSB,$ConSB,$Lod)
				{
					$LoadNIL = 0;
					$nSQP = "SELECT Nomor FROM ta_pengadaan WHERE Kd_Unit='".$gUnt."' AND Kd_Kegiatan = '".$KdK."' AND Kd_Rek13='".$KdR."' AND Periode='".$gThA."' ORDER BY Nomor";
					if ($Lod){echo $nSQP."<br>";}
					$nRsP = mysql_query($nSQP);
					while ($mRoP = mysql_fetch_array($nRsP, MYSQL_BOTH))
					{
						$zNoM = $mRoP[0];
						$LoadNIL = $LoadNIL + fGlobal("IfNull(sum(debet),0)","ta_kib_post_108","No_Pengadaan",$zNoM,"=","","");
					}
					return $LoadNIL;
				}
				###################
		  		
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
				WHERE Kd_Unit = '".$gUnt."' AND Periode='".$gThA."' GROUP BY Kd_Program";
				$nRs = mysql_query($nSQ);
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
						ClrVr();
						$xB = "<b>";
						$KdP = $mRo[0];
						$Col[1] = $mRo[0];
						$Col[2] = strtoupper($mRo[1]);
						if ($Col[2]=="-"){$Col[2]="???????? <i>data penerimaan berkas tidak ditemukan..!!<i>";}
						
						$Col[3] = $mRo[2];
						$Col[4] = sumPengadaanPROG($gUnt,$KdP,$gThA,$DatabaseSB,$ConSB);
						$Col[5] = round($Col[3],2)-round($Col[4],2);
						
						$tCol3 = $tCol3 + $Col[3];
						$tCol4 = $tCol4 + $Col[4];
						$tCol5 = $tCol5 + $Col[5];
						if ($iG>1){ViewBlank();}
						ViewRekap($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$xB);
						vwKEGI($gUnt,$KdP,$gThA,DatabaseSB,$ConSB);
						$iG++;
				}
				
				function vwKEGI($gUnt,$KdP,$gThA,$DatabaseSB,$ConSB)
				{
					$iGG=1;
					$nSQA = "SELECT Kd_Kegiatan, Nm_Kegiatan, IfNull(sum(Nilai),0) as Nilai FROM ta_pengadaan WHERE Kd_Unit='".$gUnt."' AND Kd_Kegiatan LIKE '".$KdP."%' AND Periode='".$gThA."' GROUP BY Kd_Kegiatan";
					$nRsA = mysql_query($nSQA);
					while ($mRoA = mysql_fetch_array($nRsA, MYSQL_BOTH))
					{
						ClrVr();
						$xB = "<b>";
						$KdK = $mRoA[0];
						$Col[1] = $mRoA[0];
						$Col[2] = $mRoA[1];
						if ($Col[2]=="-"){$Col[2]="???????? <i>data penerimaan berkas tidak ditemukan..!!<i>";}
						
						$Col[3] = $mRoA[2];
						$Col[4] = sumPengadaanKEGI($gUnt,$KdK,$gThA,$DatabaseSB,$ConSB,"");
						$Col[5] = round($Col[3],2)-round($Col[4],2);
						if ($Col[3]>0 || $Col[4]>0){
							if ($iGG>1 && $Col[3]>0){ViewBlank();}
							ViewRekap($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$xB);
							vwBELA($gUnt,$KdK,$gThA,$DatabaseSB,$ConSB);
							$iGG++;
						}
					}
				}
				
				function vwBELA($gUnt,$KdK,$gThA,$DatabaseSB,$ConSB)
				{
					$iGA=1;
					$nSQB = "SELECT Kd_Rek13, Nm_Rek13, IfNull(sum(Nilai),0) as Nilai FROM ta_pengadaan WHERE Kd_Unit='".$gUnt."' AND Kd_Kegiatan = '".$KdK."' AND Periode='".$gThA."' GROUP BY Kd_Rek13";
					$nRsB = mysql_query($nSQB);
					while ($mRoB = mysql_fetch_array($nRsB, MYSQL_BOTH))
					{
							ClrVr();
							$xB = "<b>";
							$KdR = $mRoB[0];
							$Col[1] = $mRoB[0];
							$Col[2] = "<i>".$mRoB[1];
							$Col[3] = $mRoB[2];
							if ($Col[2]=="-"){$Col[2]="???????? <i>data penerimaan berkas tidak ditemukan..!!<i>";}
							$Col[4] = sumPengadaanREKN($gUnt,$KdK,$KdR,$gThA,$DatabaseSB,$ConSB,"");
							$Col[5] = round($Col[3],2)-round($Col[4],2);
							ViewRekap($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$xB);
							vwPENG($gUnt,$KdK,$KdR,$gThA,$DatabaseSB,$ConSB);
							$iGA++;
					}
				}
				
				function vwPENG($gUnt,$KdK,$KdR,$gThA,$DatabaseSB,$ConSB)
				{
					$iGC=1;
					$nSQC = "SELECT P2.Referensi, P1.Kd_Aset_108, P3.Nm_Aset, P1.Faktur_Nomor, P2.Keterangan, P2.Debet 
					FROM ta_pengadaan P1 
					JOIN ta_kib_post_108 P2 ON P2.No_Pengadaan=P1.Nomor 
					JOIN ref_rek_aset108_7 P3 ON P3.Kd_Aset=P2.Kd_Aset_108 
					WHERE P1.Kd_Unit='".$gUnt."' AND P1.Kd_Kegiatan = '".$KdK."' AND P1.Kd_Rek13 = '".$KdR."' AND P1.Periode='".$gThA."' ORDER BY P2.Kd_Aset";
					$nRsC = mysql_query($nSQC);
					while ($mRoC = mysql_fetch_array($nRsC, MYSQL_BOTH))
					{
							ClrVr();
							$xB = "";
							$Ref = $mRoC[0];
							$Col[1] = $mRoC[0];
							$Col[2] = $mRoC[1];
							$Col[3] = $mRoC[2];
							$Col[4] = $mRoC[3];
							$Col[5] = $mRoC[4];
							$Col[6] = $mRoC[5];
							ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$iGC,$xB);
							$iGC++;
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
		  else if ($x5>0){
		  	$eCL="; color:#0000FF";
		  }
		  ?>
          <tr> 
            <td valign="top" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:left; padding-left:5px"><?php if (strlen($x1)!=11){echo $xB;}?><?=$x1?></td>
            <td valign="top" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:left; padding-left:5px"><?php if (strlen($x1)!=11){echo $xB;}?><?=$x2?></td>
            <td valign="top" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($x3)?></td>
            <td colspan="6" valign="top" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right; padding-right:3px <?=$eCL?>"><?=$xB.fConvertToRupiah($x4)?></td>
            </tr>
          <?php } ?>
          <?php function ViewRincian($x1,$x2,$x3,$x4,$x5,$x6,$iR,$xB) {?>
          <tr style="font-family:arial; font-size:8pt"> 
            <td valign="top" style="border-top: <?php if ($iR==1) {echo "1";} else {echo "0";}?>px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:left; padding-left:5px">&nbsp;</td>
            <td valign="top" style="border-top: <?php if ($iR==1) {echo "1";} else {echo "0";}?>px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:left; padding-left:5px">&nbsp;</td>
            <td valign="top" style="border-top: <?php if ($iR==1) {echo "1";} else {echo "0";}?>px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right; padding-right:3px"></td>
            <td width="95" valign="top" style="border-top: 1px <?php if ($iR==1) {echo "solid";} else {echo "dotted";}?> #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding-left:3px"><?=$xB.$x1?></td>
            <td width="87" valign="top" style="border-top: 1px <?php if ($iR==1) {echo "solid";} else {echo "dotted";}?> #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding-left:3px"><?=$xB.$x2?></td>
            <td width="178" valign="top" style="border-top: 1px <?php if ($iR==1) {echo "solid";} else {echo "dotted";}?> #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding-left:3px"><?=$xB.$x3?></td>
            <td width="71" valign="top" style="border-top: 1px <?php if ($iR==1) {echo "solid";} else {echo "dotted";}?> #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding-left:3px"><?=$xB.$x4?></td>
            <td width="285" valign="top" style="border-top: 1px <?php if ($iR==1) {echo "solid";} else {echo "dotted";}?> #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; padding-left:3px"><?=$xB.$x5?></td>
            <td width="84" valign="top" style="border-top: 1px <?php if ($iR==1) {echo "solid";} else {echo "dotted";}?> #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($x6)?></td>
            </tr>
          <?php } ?>
          <?php function ViewBlank() {?>
          <tr> 
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td colspan="6" style="border: 1px solid #000000">&nbsp;</td>
            </tr>
          <?php } ?>
          <tr height="23">
            <td style="border:1px solid #000000; font-weight: bold" colspan="2" align="center">T O T A L</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol3)?></td>
            <td colspan="6" align="center" style="border:1px solid #000000; font-weight: bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol4)?></td>
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
					<td align="center" width="230">NIP. <?=$FotC[3]?></td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
			</table>
			<?php } ?>			</td>
		</tr>
	</table>
</div>

</body>

</html>