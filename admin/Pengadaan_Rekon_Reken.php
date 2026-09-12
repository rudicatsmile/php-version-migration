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
	<table border="0" width="1000" cellspacing="1" style="font-size: 8pt; font-family: calibri; border-collapse: collapse">
	<tr>
	  <td style="font-size: 12pt; font-weight: bold; text-align:center">PEMERINTAH <?=$TiDaer." ".$NmDaer?></td>
	</tr>
	<tr>
	  <td style="font-size: 11pt; font-weight: bold; text-align:center">REKAPITULASI PER REKENING BELANJA</td>
	</tr>
	<tr>
	  <td style="font-size: 11pt; font-weight: bold; text-align:center">DAN PENGAKUAN ASET</td>
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
		  <table border="0" width="1100" cellpadding="0" cellspacing="0" style="border:0 solid #000000; font-size: 9pt; font-family: Calibri; border-collapse: collapse" id="table2" bordercolor="#000000">
          <tr height="23">
            <td width="100" rowspan="2" style="border:1px solid #000000; font-weight:bold; text-align:center">KODE</td>
            <td rowspan="2" style="border:1px solid #000000; font-weight:bold; text-align:center">URAIAN</td>
            <td width="110" rowspan="2" style="border:1px solid #000000; font-weight:bold; text-align:center"> REKAP<br>
            PENGADAAN </td> 
            <td colspan="5" width="500" style="border:1px solid #000000; font-weight:bold; text-align:center">A S E T</td>
            </tr>
          <tr height="23">
            <td width="122" style="border:1px solid #000000; font-weight:bold; text-align:center">REKAP NILAI</td>
            <td colspan="4" style="border:1px solid #000000; font-weight:bold; text-align:center">RINCIAN ASET </td>
            </tr>
          <tr> 
            <td style="border:1px solid #000000; font-weight: bold" align="center">1</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center">2</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">3</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">4</td>
            <td width="90" align="center" style="border:1px solid #000000; font-weight: bold">Kode</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold">&nbsp;</td>
            <td width="60" align="center" style="border:1px solid #000000; font-weight: bold">&nbsp;</td>
            <td width="100" align="center" style="border:1px solid #000000; font-weight: bold">&nbsp;</td>
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
				
				function sumPengadaanREKN($gUnt,$KdR,$gThA,$DatabaseSB,$ConSB,$Lod)
				{
					$LoadNIL = 0;
					$nSQP = "SELECT Nomor FROM ta_pengadaan WHERE Kd_Unit='".$gUnt."' AND Kd_Rek13='".$KdR."' AND Periode='".$gThA."' ORDER BY Nomor";
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

				$iGA=1;
				$nSQB = "SELECT Kd_Rek13, Nm_Rek13, IfNull(sum(Nilai),0) as Nilai FROM ta_pengadaan WHERE Kd_Unit='".$gUnt."' AND Periode='".$gThA."' GROUP BY Kd_Rek13";
				$nRsB = mysql_query($nSQB);
				while ($mRoB = mysql_fetch_array($nRsB, MYSQL_BOTH))
				{
						ClrVr();
						$xB = "";
						$KdR = $mRoB[0];
						$Col[1] = $mRoB[0];
						$Col[2] = $mRoB[1];
						$Col[3] = $mRoB[2];
						if ($Col[2]=="-"){$Col[2]="???????? <i>data penerimaan berkas tidak ditemukan..!!<i>";}
						$Col[4] = sumPengadaanREKN($gUnt,$KdR,$gThA,$DatabaseSB,$ConSB,"");
						$Col[5] = round($Col[3],2)-round($Col[4],2);
						
						$tCol3 = $tCol3 + $Col[3];
						$tCol4 = $tCol4 + $Col[4];
						$tCol5 = $tCol5 + $Col[5];
					
						ViewRekap($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$gUnt,$KdK,$KdR,$gThA,$DatabaseSB,$ConSB,$xB);
						#vwPENG($gUnt,$KdK,$KdR,$gThA);
						$iGA++;
				}
				
				function vwPENG($gUnt,$KdR,$gThA)
				{
					$iGC=1;
					$nSQC = "SELECT P1.Kd_Aset_108, P3.Nm_Aset, count(*), IfNull(sum(P2.Debet),0) as Debet 
					FROM ta_pengadaan P1 
					JOIN ta_kib_post_108 P2 ON P2.No_Pengadaan=P1.Nomor 
					JOIN ref_rek_aset108_7 P3 ON P3.Kd_Aset=P1.Kd_Aset_108 
					WHERE P1.Kd_Unit='".$gUnt."' AND P1.Kd_Rek13 = '".$KdR."' AND P1.Periode='".$gThA."' GROUP BY P1.Kd_Aset_108";
					#echo $nSQC."<br>";
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
							ViewRinci($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$iGC,$xB);
							$iGC++;
					}
				}
				
				if ($iG==1){ViewBlank();}
				?>
          <?php function ViewRekap($x1,$x2,$x3,$x4,$x5,$gUnt,$KdK,$KdR,$gThA,$DatabaseSB,$ConSB,$xB) {?>
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
            <td valign="top" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:center"><?php if (strlen($x1)!=11){echo $xB;}?><?=$x1?></td>
            <td valign="top" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:left; padding-left:3px"><?php if (strlen($x1)!=11){echo $xB;}?><?=$x2?></td>
            <td valign="top" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right; padding-right:3px"><?=$xB.fConvertToRupiah($x3)?></td>
            <td valign="top" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right; padding-right:3px <?=$eCL?>"><?=$xB.fConvertToRupiah($x4)?></td>
            <td colspan="4" valign="top" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; text-align:right; padding-right:0px <?=$eCL?>">
			<table border="0" width="100%" height="45" cellspacing="0" cellpadding="0" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse">
			<?php 
			vwPENG($gUnt,$KdR,$gThA);
			?>
         	<tr> 
              <td height="100%" width="90" style="border-left:0px solid #000000; border-top:0px solid #000000; border-bottom:0px solid #000000; border-right:1px solid #000000">&nbsp;</td>
              <td style="border-left:1px solid #000000; border-top:0px solid #000000; border-bottom:0px solid #000000; border-right:1px solid #000000">&nbsp;</td>
              <td width="60" style="border-left:0px solid #000000; border-top:0px solid #000000; border-bottom:0px solid #000000; border-right:1px solid #000000">&nbsp;</td>
              <td width="100" style="border-left:0px solid #000000; border-top:0px solid #000000; border-bottom:0px solid #000000; border-right:0px solid #000000">&nbsp;</td>
            </tr>
			</table>			</td>
            </tr>
          <?php } ?>
		  <?php function ViewRinci($x1,$x2,$x3,$x4,$x5,$iR,$xB) {?>
			<tr>
			  <td valign="top" style="border-left:0px solid #000000; border-top: <?php if ($iR==1){echo "0";} else {echo "1";}?>px dotted #000000; border-bottom:0px solid #000000; border-right:1px solid #000000; text-align:center"><?=$x1?></td>
			  <td valign="top" style="border-left:0px solid #000000; border-top: <?php if ($iR==1){echo "0";} else {echo "1";}?>px dotted #000000; border-bottom:0px solid #000000; border-right:1px solid #000000; padding-left:3px"><?=$x2?></td>
			  <td valign="top" style="border-left:0px solid #000000; border-top: <?php if ($iR==1){echo "0";} else {echo "1";}?>px dotted #000000; border-bottom:0px solid #000000; border-right:1px solid #000000; text-align:center"><?=$x3?> unit</td>
			  <td valign="top" style="border-left:0px solid #000000; border-top: <?php if ($iR==1){echo "0";} else {echo "1";}?>px dotted #000000; border-bottom:0px solid #000000; border-right:0px solid #000000; padding-right:3px; text-align:right"><?=fConvertToRupiah($x4)?></td>
			</tr>
		  <?php } ?>
          <?php function ViewBlank() {?>
          <tr> 
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td colspan="4" style="border: 1px solid #000000">&nbsp;</td>
            </tr>
          <?php } ?>
          <tr height="23">
            <td style="border:1px solid #000000; font-weight: bold" colspan="2" align="center">T O T A L</td>
            <td align="center" style="border:1px solid #000000; font-weight: bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol3)?></td>
            <td align="center" style="border:1px solid #000000; font-weight: bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol4)?></td>
            <td colspan="4" align="center" style="border:1px solid #000000; font-weight: bold; text-align:right; padding-right:3px">&nbsp;</td>
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