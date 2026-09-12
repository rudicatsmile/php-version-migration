<?php require "CheckSession.php"?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php"?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Simbada Kab. Hulu Sungai Tengah</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
extract($_GET);

$gUnt= $gUnt;
$gSub= $gSub;
$gUpb= $gUpb;

require ("Lap_Include.php");

$gThn= $gThn;
$gMLK  = $gMLK;

if ($gThn=="All" || $gThn=="") {$rThn="____";} else {$rThn=$gThn;}
if ($gMLK=="All" || $gMLK=="") {$rMLK="__";}   else {$rMLK=$gMLK;}
$Thn_A= $rThn-1;
$Thn_B= $rThn;

?>
<body>
<table border="0" align="center" width="900" cellspacing="1" style="font-family: Calibri; font-size: 8pt; border-collapse: collapse" id="table1">
	<tr>
		<td width="1285" align="center" style="font-size: 12pt; font-weight: bold">REKAPITULASI DAFTAR MUTASI </td>
	</tr>
	<tr>
		<td width="1285" align="center" style="font-size: 12pt; font-weight: bold">TAHUN ANGGARAN <?php echo $Thn_B?></td>
	</tr>
	<tr>
		<td width="1285" align="center" style="font-size: 12pt"><span style="font-size: 11pt">Per Tanggal 31 Desember <?php echo $Thn_B?> </span></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
  </tr>
	<tr>
		<td>
		<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table8">
		<tr>
			<td width="74">SKPD</td>
			<td width="25">:</td>
			<td width="551"><?php if ($xUnt=="") {echo "<i>SEMUA</i>";} else {echo strtoupper(fGlobal("Nm_Unit","Ref_Unit","Kd_Unit",$xUnt,"=","",""));}?></td>
			<td width="237" align="right">&nbsp;</td>
		</tr>
		<tr>
			<td width="74">SUB UNIT </td>
			<td width="25">:</td>
			<td><?php if ($xSub=="") {echo "<i>SEMUA</i>";} else {echo strtoupper(fGlobal("Nm_Sub","Ref_Sub_Unit","Kd_Sub",$xSub,"=","",""));}?></td>
			<td width="237">&nbsp;</td>
		</tr>
		<tr>
			<td width="74">UPB</td>
			<td width="25">:</td>
			<td><?php if ($xUpb=="") {echo "<i>SEMUA</i>";} else {echo strtoupper(fGlobal("Nm_Upb","Ref_Upb","Kd_Upb",$xUpb,"=","",""));}?></td>
			<td width="237">&nbsp;</td>
		</tr>
		<tr>
			<td width="74"><?=$TiDaer?></td>
			<td width="25">:</td>
			<td><?=$NmDaer?></td>
			<td width="237" align="right" style="font-weight: bold">Kode Kepemilikan: <?php if ($gMLK=="All" || $gMLK=="") {echo "XX";} else {echo $gMLK;}?></td>
		</tr>
		</table>		</td>
	</tr>
	<tr>
	  <td>
		<table border="1" width="900" cellspacing="1" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" id="table1" bordercolor="#000000">
			<tr>
				<td width="24" rowspan="3" align="center" style="font-weight: bold">No</td>
				<td width="30" rowspan="3" align="center" style="font-weight: bold">Gol</td>
				<td width="35" rowspan="3" align="center" style="font-weight: bold">Bidang</td>
				<td width="285" rowspan="3" align="center" style="font-weight: bold">Nama Bidang 
				Barang</td>
				<td colspan="2" align="center" style="font-weight: bold">Keadaan<br>Per 1 Jan <?php echo $Thn_B?></td>
				<td colspan="4" align="center" style="font-weight: bold">Mutasi / Perubahan<br>Selama 1 Jan <?php echo $Thn_B?> s.d 31 Des <?php echo $Thn_B?></td>
				<td colspan="2" align="center" style="font-weight: bold">Keadaan<br>Per 31 Des <?php echo $Thn_B?></td>
				<td width="182" rowspan="3" align="center" style="font-weight: bold">Keterangan</td>
			</tr>
			<tr>
			  <td rowspan="2" align="center" style="font-weight: bold">Jumlah<br>Barang </td>
			  <td rowspan="2" align="center" style="font-weight: bold">Jumlah<br>Harga </td>
			  <td colspan="2" align="center" style="font-weight: bold">Berkurang</td>
			  <td colspan="2" align="center" style="font-weight: bold">Bertambah</td>
			  <td rowspan="2" align="center" style="font-weight: bold">Jumlah<br>Barang </td>
			  <td rowspan="2" align="center" style="font-weight: bold">Jumlah<br>Harga </td>
		  </tr>
			<tr>
			  <td align="center" style="font-weight: bold">Jumlah<br>Barang </td>
			  <td align="center" style="font-weight: bold">Jumlah<br>Harga </td>
			  <td align="center" style="font-weight: bold">Jumlah<br>Barang </td>
			  <td align="center" style="font-weight: bold">Jumlah<br>Harga </td>
		  </tr>
			<tr>
				<td width="24" style="font-weight: bold; border-bottom: 3px double #000000" align="center">
				1</td>
				<td width="30" style="font-weight: bold; border-bottom: 3px double #000000" align="center">
				2</td>
				<td width="35" style="font-weight: bold; border-bottom: 3px double #000000" align="center">
				3</td>
				<td width="285" style="font-weight: bold; border-bottom: 3px double #000000" align="center">
				4</td>
				<td width="52" style="font-weight: bold; border-bottom: 3px double #000000" align="center">
				5</td>
				<td width="56" align="center" style="font-weight: bold; border-bottom: 3px double #000000">
				6</td>
				<td width="57" align="center" style="font-weight: bold; border-bottom: 3px double #000000">7</td>
				<td width="114" align="center" style="font-weight: bold; border-bottom: 3px double #000000">8</td>
				<td width="114" align="center" style="font-weight: bold; border-bottom: 3px double #000000">9</td>
				<td width="114" align="center" style="font-weight: bold; border-bottom: 3px double #000000">10</td>
				<td width="56" align="center" style="font-weight: bold; border-bottom: 3px double #000000">11</td>
				<td width="57" align="center" style="font-weight: bold; border-bottom: 3px double #000000">12</td>
				<td style="font-weight: bold; border-bottom: 3px double #000000" align="center">
				13</td>
			</tr>
			<?php
			$Col[13];
			$iG  = 1;
			
			$fAWL= 0;
			$fAKH= 0;
			$fKRG= 0;
			$fTMB= 0;
			
			$tAWL= 0;
			$tAKH= 0;
			$tKRG= 0;
			$tTMB= 0;
			function ClrVr()
			{
				for($nG=1; $nG<=13; $nG++)
				{
					if ($nG>=5 && $nG<=12) {$Col[$nG]=0;}
					else {$Col[$nG]="";}
				}
			}
			$LoadMutasi="Y";
			$nSQL= "SELECT * FROM ref_rek_aset1 ORDER BY Kd_Aset";
			$nRs = mysql_query($nSQL) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
				do
				{
					if ($iG > 1) {echo ViewBlank();}
					$xB = "<b>";
					ClrVr();
					$KdAsT  = $mRo['Kd_Aset'];
					$Col[1] = $iG.".";
					$Col[2] = $mRo['Kd_Aset'];
					$Col[3] = "";
					$Col[4] = strtoupper($mRo['Nm_Aset']);
					
					if (substr($KdAsT,0,2)=="02" || substr($KdAsT,0,2)=="03")
					{
						$sYt = ":extracom";
						$nIL = ":N";
						$oPr = ":=";
					}
					else{
						$sYt = "";
						$nIL = "";
						$oPr = "";
					}
						
					//KEADAAN AWAL (record)
					$qAWL = fGlobal("IfNull(count(*),0)", "Ta_KIB_".fNmHuruf($iG),"Kd_Aset:Tgl_Perolehan:Kd_UPB".$sYt,$KdAsT."%:".$Thn_A."-12-31:".$gUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
					if ($LoadMutasi=="Y"){
						if (fNmHuruf($iG)!="f") {
							$qAWL = $qAWL+fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iG)."_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$Thn_B."-%-%:".$gUpb,"LIKE:LIKE:LIKE","","");
						}
					}
					$rDEL = 0;	#fGlobal("IfNull(count(*),0)", "ta_penghapusan_rinc_new","Kd_Aset:Tg_SK:Kd_UPB",$KdAsT."%:".$Thn_A."-12-31:".$gUpb,"LIKE:<=:LIKE","","");
					$qAWL = $qAWL-$rDEL;
					
					//KEADAAN AWAL (nilai)
					$gNIa = fGlobal("IfNull(sum(Debet),0)", "Ta_KIB_Post","Kd_Aset:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$Thn_A."-12-31:".$gUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
					$gNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Kd_Aset:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$Thn_A."-12-31:".$gUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
					$gAWL = $gNIa - $gNIb;
					if ($LoadMutasi=="Y"){
						$mAWL = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$Thn_B."-%-%:".$gUpb,"LIKE:LIKE:LIKE","","");
						$gAWL = $gAWL+$mAWL;
					}
						
					$Col[5] = $qAWL;
					$Col[6] = $gAWL;
					
					//BERKURANG
					if (fNmHuruf($iG)=="f"){
						$qKRG   = fGlobal("IfNull(count(*),0)", "Ta_KIB_".fNmHuruf($iG),"Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb:KdpToAset".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL.":Y","LIKE:>=:<=:LIKE:=".$oPr,"","");
						$gKRG   = fGlobal("IfNull(sum(Debet),0)", "Ta_KIB_Post","Kd_Aset:Tanggal:Tanggal:Kd_Upb:KdpToAset".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL.":Y","LIKE:>=:<=:LIKE:=".$oPr,"","");
					}
					else{
						$qKRG   = 0;	#fGlobal("IfNull(count(*),0)", "ta_penghapusan_rinc_new","Kd_Aset:Tg_SK:Tg_SK:Kd_UPB",$KdAsT."%:".$Thn_B."-01-01:".$Thn_B."-12-31:".$gUpb.":","LIKE:>=:<=:LIKE","","");
						if ($LoadMutasi=="Y"){$qKRG   = $qKRG + fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iG)."_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb",$KdAsT."%:".$Thn_B."-%-%".":".$gUpb,"LIKE:LIKE:LIKE","","");}
						$gKRG   = fGlobal("IfNull(sum(Kredit),0)", "Ta_KIB_Post","Kd_Aset:Tanggal:Tanggal:Kd_Upb".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						if ($LoadMutasi=="Y"){$gKRG   = $gKRG + fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$Thn_B."-%-%:".$gUpb,"LIKE:LIKE:LIKE","","");}
					}
					$Col[7] = $qKRG;
					$Col[8] = $gKRG;
					
					//BERTAMBAH
					if (fNmHuruf($iG)=="f"){
						$qTMB   = fGlobal("IfNull(count(*),0)", "Ta_KIB_".fNmHuruf($iG),"Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						$gTMB   = fGlobal("IfNull(sum(Debet),0)", "Ta_KIB_Post","Kd_Aset:Tanggal:Tanggal:Kd_Upb".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
					}
					else{
						$qTMB   = fGlobal("IfNull(count(*),0)", "Ta_KIB_".fNmHuruf($iG),"Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						$gTMB   = fGlobal("IfNull(sum(Debet),0)", "Ta_KIB_Post","Kd_Aset:Tanggal:Tanggal:Kd_Upb".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
					}
					$Col[9] = $qTMB;
					$Col[10]= $gTMB;
					
					//KEADAAN AKHIR
					$qAKH    = $qAWL - $qKRG + $qTMB;
					$gAKH    = $gAWL - $gKRG + $gTMB;
					$Col[11] = $qAKH;
					$Col[12] = $gAKH;
					$Col[13] = "";
					ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$xB);
					ViewBidang($mRo['Kd_Aset'],strtoupper(fNmHuruf($iG)),$gUpb,$Thn_A,$Thn_B,$iG,$LoadMutasi);
					
					$fAKH= $fAKH + $qAKH;
					$fAWL= $fAWL + $qAWL;
					$fKRG= $fKRG + $qKRG;
					$fTMB= $fTMB + $qTMB;
					
					$tAKH= $tAKH + $gAKH;
					$tAWL= $tAWL + $gAWL;
					$tKRG= $tKRG + $gKRG;
					$tTMB= $tTMB + $gTMB;
					
					$iG++;
				}
				while ($mRo = mysql_fetch_assoc($nRs));	
			}
			
			function ViewBidang($KdBDG,$mTBL,$mUpb,$mThn,$nThn,$mG,$LoadMutasi)
			{
				$iGG  = 1;
				$nSQB = "SELECT * FROM ref_rek_aset2 WHERE Kd_Aset LIKE '".$KdBDG.".%' ORDER BY Kd_Aset";
				$nRsB = mysql_query($nSQB) or die(mysql_error());
				$mRoB = mysql_fetch_assoc($nRsB);
				$tRoB = mysql_num_rows($nRsB);
				if ($tRoB > 0)
				{
					do
					{
						$xB = "";
						ClrVr();
						$KdAsT  = $mRoB['Kd_Aset'];
						$Col[1] = "";
						$Col[2] = "";
						$Col[3] = substr($mRoB['Kd_Aset'],3,2);
						$Col[4] = $mRoB['Nm_Aset'];
						
						if (substr($KdAsT,0,2)=="02" || substr($KdAsT,0,2)=="03")
						{
							$sYt = ":extracom";
							$nIL = ":N";
							$oPr = ":=";
						}
						else{
							$sYt = "";
							$nIL = "";
							$oPr = "";
						}
						
						//KEADAAN AWAL (record)
						$rAWL = fGlobal("IfNull(count(*),0)", "Ta_KIB_".fNmHuruf($mG),"Kd_Aset:Tgl_Perolehan:Kd_UPB".$sYt,$KdAsT."%:".$mThn."-12-31:".$mUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
						if ($LoadMutasi=="Y"){
							if (fNmHuruf($mG)!="f") {
								$rAWL = $rAWL+fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($mG)."_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
							}
						}
						$rDEL = 0;	#fGlobal("IfNull(count(*),0)", "ta_penghapusan_rinc_new","Kd_Aset:Tg_SK:Kd_UPB",$KdAsT."%:".$mThn."-12-31:".$mUpb.":","LIKE:<=:LIKE","","");
						$rAWL = $rAWL-$rDEL;
						
						//KEADAAN AWAL (nilai)
						$vNIa = fGlobal("IfNull(sum(Debet),0)", "Ta_KIB_Post","Kd_Aset:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$mThn."-12-31:".$mUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
						$vNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Kd_Aset:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$mThn."-12-31:".$mUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
						$vAWL = $vNIa - $vNIb;
						if ($LoadMutasi=="Y"){
							$mAWL = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
							$vAWL = $vAWL+$mAWL;
						}
						
						$Col[5] = $rAWL;
						$Col[6] = $vAWL;
						
						//BERKURANG
						if (fNmHuruf($mG)=="f"){
							$rKRG   = fGlobal("IfNull(count(*),0)", "Ta_KIB_".fNmHuruf($mG),"Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb:KdpToAset".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL.":Y","LIKE:>=:<=:LIKE:=".$oPr,"","");
							$vKRG   = fGlobal("IfNull(sum(Debet),0)", "Ta_KIB_Post","Kd_Aset:Tanggal:Tanggal:Kd_UPB:KdpToAset".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL.":Y","LIKE:>=:<=:LIKE:=".$oPr,"","");
						}
						else{
							$rKRG   = 0;	#fGlobal("IfNull(count(*),0)", "ta_penghapusan_rinc_new","Kd_Aset:Tg_SK:Tg_SK:Kd_UPB",$KdAsT."%:".$nThn."-01-01:".$nThn."-12-31:".$mUpb.":","LIKE:>=:<=:LIKE","","");
							if ($LoadMutasi=="Y"){
								$rKRG   = $rKRG + fGlobal("IfNull(count(*),0)", "Ta_KIB_".fNmHuruf($mG)."_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb",$KdAsT."%:".$nThn."-%-%".":".$mUpb,"LIKE:LIKE:LIKE","","");
							}
							
							$vKRG   = fGlobal("IfNull(sum(Kredit),0)", "Ta_KIB_Post","Kd_Aset:Tanggal:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
							if ($LoadMutasi=="Y"){
								$vKRG   = $vKRG + fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
							}
						}
						$Col[7] = $rKRG;
						$Col[8] = $vKRG;
						
						//BERTAMBAH
						if (fNmHuruf($mG)=="f"){
							$rTMB   = fGlobal("IfNull(count(*),0)", "Ta_KIB_".fNmHuruf($mG),"Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
							$vTMB   = fGlobal("IfNull(sum(Debet),0)", "Ta_KIB_Post","Kd_Aset:Tanggal:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						}
						else{
							$rTMB   = fGlobal("IfNull(count(*),0)", "Ta_KIB_".fNmHuruf($mG),"Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
							$vTMB   = fGlobal("IfNull(sum(Debet),0)", "Ta_KIB_Post","Kd_Aset:Tanggal:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						}
						$Col[9] = $rTMB;
						$Col[10]= $vTMB;
						
						$rAKH    = $rAWL - $rKRG + $rTMB;
						$vAKH    = $vAWL - $vKRG + $vTMB;
						$Col[11] = $rAKH;
						$Col[12] = $vAKH;
						
						$Col[13] = "";
				
						ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$xB);
						$iGG++;
					}
					while ($mRoB = mysql_fetch_assoc($nRsB));	
				}
			}
			?>
			<?php function ViewRincian($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$xB) {?>
			<tr>
				<td width="24" height="22" align="center"><?php echo $xB.$x1?></td>
				<td width="30" align="center"><?php echo $xB.$x2?></td>
				<td width="35" align="center"><?php echo $xB.$x3?></td>
				<td width="285"><?php echo $xB.$x4?></td>
				<td width="52" align="center"><?php if ($x5!=0) {echo $xB.fConvertToRupiahBulat($x5);} else {echo "-";}?></td>
				<td width="56" align="right"><?php if ($x6!=0) {echo $xB.fConvertToRupiah($x6);} else {echo "-";}?></td>
				<td width="57" align="center"><?php if ($x7!=0) {echo $xB.fConvertToRupiahBulat($x7);} else {echo "-";}?></td>
				<td width="114" align="right"><?php if ($x8!=0) {echo $xB.fConvertToRupiah($x8);} else {echo "-";}?></td>
				<td width="114" align="center"><?php if ($x9!=0) {echo $xB.fConvertToRupiahBulat($x9);} else {echo "-";}?></td>
				<td width="114" align="right"><?php if ($x10!=0) {echo $xB.fConvertToRupiah($x10);} else {echo "-";}?></td>
				<td width="56" align="center"><?php if ($x11!=0) {echo $xB.fConvertToRupiahBulat($x11);} else {echo "-";}?></td>
				<td width="57" align="right"><?php if ($x12!=0) {echo $xB.fConvertToRupiah($x12);} else {echo "-";}?></td>
				<td><?php echo $xB.$x13?></td>
			</tr>
		 	<?php } ?>
          	<?php function ViewBlank() {?>
			<tr>
				<td width="24">&nbsp;</td>
				<td width="30">&nbsp;</td>
				<td width="35">&nbsp;</td>
				<td width="285">&nbsp;</td>
				<td width="52">&nbsp;</td>
				<td width="56">&nbsp;</td>
				<td width="57">&nbsp;</td>
				<td width="114">&nbsp;</td>
				<td width="114">&nbsp;</td>
				<td width="114">&nbsp;</td>
				<td width="56">&nbsp;</td>
				<td width="57">&nbsp;</td>
				<td>&nbsp;</td>
			</tr>
		  	<?php } ?>
			<tr>
				<td colspan="4" align="center" style="font-weight:bold; border-top: 3px double #000000">Jumlah</td>
				<td width="52" align="center" style="font-weight:bold; border-top: 3px double #000000"><?php if ($fAWL!=0) {echo fConvertToRupiahBulat($fAWL);}?></td>
				<td width="56" align="right" style="font-weight:bold; border-top: 3px double #000000"><?php if ($tAWL!=0) {echo fConvertToRupiah($tAWL);}?></td>
				<td width="57" align="center" style="font-weight:bold; border-top: 3px double #000000"><?php if ($fKRG!=0) {echo fConvertToRupiahBulat($fKRG);}?></td>
				<td width="114" align="right" style="font-weight:bold; border-top: 3px double #000000"><?php if ($tKRG!=0) {echo fConvertToRupiah($tKRG);}?></td>
				<td width="114" align="center" style="font-weight:bold; border-top: 3px double #000000"><?php if ($fTMB!=0) {echo fConvertToRupiahBulat($fTMB);}?></td>
				<td width="114" align="right" style="font-weight:bold; border-top: 3px double #000000"><?php if ($tTMB!=0) {echo fConvertToRupiah($tTMB);}?></td>
				<td width="56" align="center" style="font-weight:bold; border-top: 3px double #000000"><?php if ($fAKH!=0) {echo fConvertToRupiahBulat($fAKH);}?></td>
				<td width="57" align="right" style="font-weight:bold; border-top: 3px double #000000"><?php if ($tAKH!=0) {echo fConvertToRupiah($tAKH);}?></td>
				<td style="font-weight:bold; border-top: 3px double #000000">&nbsp;</td>
			</tr>
		</table>	  </td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
	  <td><?php require "Lap_Bottom.php"?></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
