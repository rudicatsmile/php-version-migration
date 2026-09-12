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
<?
extract($_GET);

$gUnt= $gUnt;
$gSub= $gSub;
$gUpb= $gUpb;

require ("Lap_Include.php");

$gThn  = $gThn;
$gThn2 = $gThn2;

$gMLK  = $gMLK;

if ($gThn  =="All" || $gThn  =="") {$rThn ="____";} else {$rThn=$gThn;}
if ($gThn2 =="All" || $gThn2 =="") {$qThn ="____";} else {$qThn=$gThn2;}
if ($gMLK=="All" || $gMLK=="") {$rMLK="__";}   else {$rMLK=$gMLK;}
$Thn_B = $rThn;
?>
<body>
<table border="0" align="center" width="900" cellspacing="1" style="font-family: Calibri; font-size: 8pt; border-collapse: collapse" id="table1">
	<tr>
		<td width="1285" align="center" style="font-size: 12pt; font-weight: bold">REKAPITULASI ASET PER REKENING </td>
	</tr>
	<tr>
		<td width="1285" align="center" style="font-size: 12pt"><span style="font-size: 11pt">Per Tanggal 1 Jan <? echo $rThn?> s.d 31 Des <? echo $qThn?></span></td>
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
			<td width="551"><? if ($xUnt=="") {echo "<i>Semua Unit Kerja</i>";} else {echo strtoupper(fGlobal("Nm_Unit","Ref_Unit","Kd_Unit",$xUnt,"=","",""));}?></td>
			<td width="237" align="right">&nbsp;</td>
		</tr>
		<tr>
			<td width="74">SUB UNIT </td>
			<td width="25">:</td>
			<td><? if ($xSub=="") {echo "<i>Semua Sub Unit Kerja</i>";} else {echo strtoupper(fGlobal("Nm_Sub","Ref_Sub_Unit","Kd_Sub",$xSub,"=","",""));}?></td>
			<td width="237">&nbsp;</td>
		</tr>
		<tr>
			<td width="74">UPB</td>
			<td width="25">:</td>
			<td><? if ($xUpb=="") {echo "<i>Semua UPB</i>";} else {echo strtoupper(fGlobal("Nm_Upb","Ref_Upb","Kd_Upb",$xUpb,"=","",""));}?></td>
			<td width="237">&nbsp;</td>
		</tr>
		<tr>
			<td width="74"><?=$TiDaer?></td>
			<td width="25">:</td>
			<td><?=$NmDaer?></td>
			<td width="237" align="right" style="font-weight: bold">Kode Kepemilikan: <? if ($gMLK=="All" || $gMLK=="") {echo "XX";} else {echo $gMLK;}?></td>
		</tr>
		</table>		</td>
	</tr>
	<tr height="10">
	  <td></td>
	</tr>
	<tr>
		<td>
		<table border="1" width="100%" cellspacing="1" style="font-family: Arial; font-size: 8pt; border-collapse: collapse; border: 2px solid #000000" bordercolor="#000000" id="table1">
		<tr>
			<td width="50" rowspan="2" style="font-weight: bold" align="center">
			KODE </td>
			<td width="133" rowspan="2" style="font-weight: bold" align="center">
			URAIAN</td>
			<td colspan="2" style="font-weight: bold" align="center">
			JUMLAH</td>
			<td colspan="4" align="center" style="font-weight: bold">
			KONDISI BARANG </td>
			<td colspan="9" align="center" style="font-weight: bold">CARA PEROLEHAN </td>
          </tr>
		<tr>
			<td width="50" align="center" style="font-weight: bold">
			SATUAN</td>
			<td width="90" align="center" style="font-weight: bold">
			HARGA (Rp)</td>
			<td width="40" align="center" style="font-weight: bold">
			BAIK</td>
			<td width="42" align="center" style="font-weight: bold">
			RUSAK RINGAN </td>
			<td width="40" align="center" style="font-weight: bold">
			RUSAK BERAT </td>
			<td width="40" align="center" style="font-weight: bold">LAIN NYA</td>
			<td width="19" align="center" style="font-weight: bold">APBD</td>
			<td width="20" align="center" style="font-weight: bold">HIBAH</td>
			<td width="40" align="center" style="font-weight: bold">
			MUTASI</td>
			<td width="41" align="center" style="font-weight: bold">
			PEMBE LIAN</td>
			<td width="40" align="center" style="font-weight: bold">
			PINJAM</td>
			<td width="40" align="center" style="font-weight: bold">
			SEWA</td>
			<td width="41" align="center" style="font-weight: bold">
			RUSLAH</td>
			<td width="42" align="center" style="font-weight: bold">
			GUNA USAHA </td>
		    <td width="42" align="center" style="font-weight: bold">LAIN NYA </td>
		</tr>
		<tr align="center" style="font-weight:bold">
			<td width="50" valign="top" style="font-weight: bold; border-bottom: 3px double #000000">1</td>
			<td width="133" valign="top" style="font-weight: bold; border-bottom: 3px double #000000">2</td>
			<td valign="top" style="font-weight: bold; border-bottom: 3px double #000000">3</td>
			<td valign="top" style="font-weight: bold; border-bottom: 3px double #000000">4</td>
			<td valign="top" style="font-weight: bold; border-bottom: 3px double #000000">5</td>
			<td valign="top" style="font-weight: bold; border-bottom: 3px double #000000">6</td>
			<td valign="top" style="font-weight: bold; border-bottom: 3px double #000000">7</td>
			<td valign="top" style="font-weight: bold; border-bottom: 3px double #000000">8</td>
			<td valign="top" style="font-weight: bold; border-bottom: 3px double #000000">9</td>
			<td valign="top" style="font-weight: bold; border-bottom: 3px double #000000">10</td>
			<td valign="top" style="font-weight: bold; border-bottom: 3px double #000000">11</td>
			<td valign="top" style="font-weight: bold; border-bottom: 3px double #000000">12</td>
			<td valign="top" style="font-weight: bold; border-bottom: 3px double #000000">13</td>
			<td valign="top" style="font-weight: bold; border-bottom: 3px double #000000">14</td>
			<td valign="top" style="font-weight: bold; border-bottom: 3px double #000000">15</td>
			<td valign="top" style="font-weight: bold; border-bottom: 3px double #000000">16</td>
		    <td valign="top" style="font-weight: bold; border-bottom: 3px double #000000">17</td>
		</tr>
		<?
		$Col[17];
		function ClrVr()
		{
			for($nG=1; $nG<=17; $nG++)
			{
				if ($nG >= 3)
					{$Col[$nG]=0;}
				else
					{$Col[$nG]="";}
			}
		}
		
		$tJmlRc = 0;
		$tJmlHr = 0;
		$tJmlBB = 0;
		$tJmlRR = 0;
		$tJmlRB = 0;
		$tJmlLL = 0;
		
		$tJml09 = 0;
		$tJml10 = 0;
		$tJml11 = 0;
		$tJml12 = 0;
		$tJml13 = 0;
		$tJml14 = 0;
		$tJml15 = 0;
		$tJml16 = 0;
		$tJml17 = 0;
		
		$nSQL= "SELECT * FROM ref_rek_aset108_3 ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			$iG = 1;
			do
			{
				if ($iG > 1) {echo EmptyRow();}
				$xB = "<b>";
				ClrVr();
				$Col[1] = $mRo['Kd_Aset'];
				$Col[2] = strtoupper($mRo['Nm_Aset']);
				$NmTB = fNmHuruf(intval(substr($mRo['Kd_Aset'],0,2)));
				$JmlRc  = fGlobal("COUNT(*)","ta_kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:KdpToAset",$mRo['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":N","LIKE:LIKE:>=:<=:LIKE:=","","");
				//if ($JmlRc > 0)
				//{
					$Col[3] = $JmlRc;
					$JmlDB  = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset_108:Kd_Upb:Tanggal:Tanggal:KdpToAset",$mRo['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:N","LIKE:LIKE:>=:<=:=","","");
					$JmlKR  = fGlobal("IfNull(sum(Kredit),0)","ta_kib_post_108","Kd_Aset_108:Kd_Upb:Tanggal:Tanggal:KdpToAset",$mRo['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:N","LIKE:LIKE:>=:<=:=","","");
					$Col[4] = $JmlDB - $JmlKR;
					if ($NmTB=="a" || $NmTB=="f")
					{
						$Col[5] = $JmlRc;
						$Col[6] = 0;
						$Col[7] = 0;
						$Col[8] = $JmlRc - ($Col[5]+$Col[6]+$Col[7]);
					}
					else
					{
						$Col[5] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Kondisi:KdpToAset",$mRo['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":B:N", "LIKE:LIKE:>=:<=:LIKE:=:=","","");
						$Col[6] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Kondisi:KdpToAset",$mRo['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":RR:N","LIKE:LIKE:>=:<=:LIKE:=:=","","");
						$Col[7] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Kondisi:KdpToAset",$mRo['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":RB:N","LIKE:LIKE:>=:<=:LIKE:=:=","","");
						$Col[8] = $JmlRc - ($Col[5]+$Col[6]+$Col[7]);
					}
					$Col[9] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset",$mRo['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":APBD:N","LIKE:LIKE:>=:<=:LIKE:=:=","","");
					$Col[10]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset",$mRo['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Hibah:N","LIKE:LIKE:>=:<=:LIKE:=:=","","");
					$Col[11]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset",$mRo['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Mutasi:N","LIKE:LIKE:>=:<=:LIKE:=:=","","");
					$Col[12]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset",$mRo['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Pembelian:N","LIKE:LIKE:>=:<=:LIKE:=:=","","");
					$Col[13]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset",$mRo['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Pinjam:N","LIKE:LIKE:>=:<=:LIKE:=:=","","");
					$Col[14]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset",$mRo['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Sewa:N","LIKE:LIKE:>=:<=:LIKE:=:=","","");
					$Col[15]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset",$mRo['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Ruslah:N","LIKE:LIKE:>=:<=:LIKE:=:=","","");
					$Col[16]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset",$mRo['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Guna_Usaha:N","LIKE:LIKE:>=:<=:LIKE:=:=","","");
					$Col[17]= $JmlRc - ($Col[9]+$Col[10]+$Col[11]+$Col[12]+$Col[13]+$Col[14]+$Col[15]+$Col[16]);
					
					$tJmlRc = $tJmlRc + $JmlRc;
					$tJmlHr = $tJmlHr + ($JmlDB - $JmlKR);
					$tJmlBB = $tJmlBB + $Col[5];
					$tJmlRR = $tJmlRR + $Col[6];
					$tJmlRB = $tJmlRB + $Col[7];
					$tJmlLL = $tJmlLL + $Col[8];
					
					$tJml09 = $tJml09 + $Col[9];
					$tJml10 = $tJml10 + $Col[10];
					$tJml11 = $tJml11 + $Col[11];
					$tJml12 = $tJml12 + $Col[12];
					$tJml13 = $tJml13 + $Col[13];
					$tJml14 = $tJml14 + $Col[14];
					$tJml15 = $tJml15 + $Col[15];
					$tJml16 = $tJml16 + $Col[16];
					$tJml17 = $tJml17 + $Col[17];
					
					ViewData($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$xB);
					func_RCI1($mRo['Kd_Aset'],$gUpb,$rThn,$qThn,$rMLK,"");
					$iG++;
					
				//}
			}
			while ($mRo = mysql_fetch_assoc($nRs));
		}
	
		function func_RCI1($Kd1,$gUpb,$rThn,$qThn,$rMLK,$qSh)
		{
			$NmTB = fNmHuruf(intval(substr($Kd1,0,2)));
			$nSQL1= "SELECT * FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '".$Kd1.".__' ORDER BY Kd_Aset";
			if ($qSh!="") {echo $nSQL1."<br>";}
			$nRs1 = mysql_query($nSQL1) or die(mysql_error());
			$mRo1 = mysql_fetch_assoc($nRs1);
			$tRo1 = mysql_num_rows($nRs1);
			if ($tRo1 > 0)
			{
				$iG1 = 1;
				do
				{
					$xB = "<b>";
					ClrVr();
					$Col[1] = $mRo1['Kd_Aset'];
					$Col[2] = $mRo1['Nm_Aset'];
					$KdAsT  = $Col[1];
					if (substr($KdAsT,0,5)=="1.3.2" || substr($KdAsT,0,5)=="1.3.3")
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
					
					$JmlRc  = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:KdpToAset".$sYt,$mRo1['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=".$oPr,"","");
					if ($JmlRc > 0)
					{
						$Col[3] = $JmlRc;
						$JmlDB  = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset_108:Kd_Upb:Tanggal:Tanggal:KdpToAset".$sYt,$mRo1['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31".$nIL.":N","LIKE:LIKE:>=:<=:=".$oPr,"","");
						$JmlKR  = fGlobal("IfNull(sum(Kredit),0)","ta_kib_post_108","Kd_Aset_108:Kd_Upb:Tanggal:Tanggal:KdpToAset".$sYt,$mRo1['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31".$nIL.":N","LIKE:LIKE:>=:<=:=".$oPr,"","");
						$Col[4] = $JmlDB - $JmlKR;
						if ($NmTB=="a" || $NmTB=="f")
						{
							$Col[5] = $JmlRc;
							$Col[6] = 0;
							$Col[7] = 0;
							$Col[8] = $JmlRc - ($Col[5]+$Col[6]+$Col[7]);
						}
						else
						{
							$Col[5] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Kondisi:KdpToAset".$sYt,$mRo1['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":B".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
							$Col[6] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Kondisi:KdpToAset".$sYt,$mRo1['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":RR".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
							$Col[7] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Kondisi:KdpToAset".$sYt,$mRo1['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":RB".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
							$Col[8] = $JmlRc - ($Col[5]+$Col[6]+$Col[7]);
						}
						$Col[9] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo1['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":APBD".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[10]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo1['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Hiba".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[11]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo1['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Mutasi".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[12]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo1['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Pembelian".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[13]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo1['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Pinjam".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[14]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo1['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Sewa".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[15]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo1['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Ruslah".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[16]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo1['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Guna_Usaha".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[17]= $JmlRc - ($Col[9]+$Col[10]+$Col[11]+$Col[12]+$Col[13]+$Col[14]+$Col[15]+$Col[16]);
						
						if ($iG1 > 1) {echo EmptyRow();}
						ViewData($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$xB);
						func_RCI2($Col[1],$gUpb,$rThn,$qThn,$rMLK,"");
						$iG1++;
					}
				}
				while ($mRo1 = mysql_fetch_assoc($nRs1));
			}
		}		
				
		function func_RCI2($Kd2,$gUpb,$rThn,$qThn,$rMLK,$qSh)
		{
			$NmTB = fNmHuruf(intval(substr($Kd2,0,2)));
			$nSQL2= "SELECT * FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '".$Kd2.".__' ORDER BY Kd_Aset";
			if ($qSh!="") {echo $nSQL2."<br>";}
			$nRs2 = mysql_query($nSQL2) or die(mysql_error());
			$mRo2 = mysql_fetch_assoc($nRs2);
			$tRo2 = mysql_num_rows($nRs2);
			if ($tRo2 > 0)
			{
				$iG2 = 1;
				do
				{
					$xB = "<b>";
					ClrVr();
					$Col[1] = $mRo2['Kd_Aset'];
					$Col[2] = $mRo2['Nm_Aset'];
					$KdAsT  = $Col[1];
					if (substr($KdAsT,0,5)=="1.3.2" || substr($KdAsT,0,5)=="1.3.3")
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
					
					$JmlRc  = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:KdpToAset".$sYt,$mRo2['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=".$oPr,"","");
					if ($JmlRc > 0)
					{
						$Col[3] = $JmlRc;
						$JmlDB  = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset_108:Kd_Upb:Tanggal:Tanggal:KdpToAset".$sYt,$mRo2['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31".$nIL.":N","LIKE:LIKE:>=:<=:=".$oPr,"","");
						$JmlKR  = fGlobal("IfNull(sum(Kredit),0)","ta_kib_post_108","Kd_Aset_108:Kd_Upb:Tanggal:Tanggal:KdpToAset".$sYt,$mRo2['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31".$nIL.":N","LIKE:LIKE:>=:<=:=".$oPr,"","");
						$Col[4] = $JmlDB - $JmlKR;
						if ($NmTB=="a" || $NmTB=="f")
						{
							$Col[5] = $JmlRc;
							$Col[6] = 0;
							$Col[7] = 0;
							$Col[8] = $JmlRc - ($Col[5]+$Col[6]+$Col[7]);
						}
						else
						{
							$Col[5] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Kondisi:KdpToAset".$sYt,$mRo2['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":B".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
							$Col[6] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Kondisi:KdpToAset".$sYt,$mRo2['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":RR".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
							$Col[7] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Kondisi:KdpToAset".$sYt,$mRo2['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":RB".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
							$Col[8] = $JmlRc - ($Col[5]+$Col[6]+$Col[7]);
						}
						$Col[9] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo2['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":APBD".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[10]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo2['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Hibah".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[11]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo2['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Mutasi".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[12]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo2['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Pembelian".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[13]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo2['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Pinjam".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[14]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo2['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Sewa".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[15]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo2['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Ruslah".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[16]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo2['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Guna_Usaha".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[17]= $JmlRc - ($Col[9]+$Col[10]+$Col[11]+$Col[12]+$Col[13]+$Col[14]+$Col[15]+$Col[16]);
						
						if ($iG2 > 1) {echo EmptyRow();}
						ViewData($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$xB);
						func_RCI3($Col[1],$gUpb,$rThn,$qThn,$rMLK,"");
						$iG2++;
					}
				}
				while ($mRo2 = mysql_fetch_assoc($nRs2));
			}
		}		
				
		function func_RCI3($Kd3,$gUpb,$rThn,$qThn,$rMLK,$qSh)
		{
			$nSQL3= "SELECT * FROM ref_rek_aset108_6 WHERE Kd_Aset LIKE '".$Kd3.".__' ORDER BY Kd_Aset";
			$NmTB = fNmHuruf(intval(substr($Kd3,0,2)));
			if ($qSh!="") {echo $nSQL3."<br>";}
			$nRs3 = mysql_query($nSQL3) or die(mysql_error());
			$mRo3 = mysql_fetch_assoc($nRs3);
			$tRo3 = mysql_num_rows($nRs3);
			if ($tRo3 > 0)
			{
				$iG3 = 1;
				do
				{
					$xB = "<b>";
					ClrVr();
					$Col[1] = $mRo3['Kd_Aset'];
					$Col[2] = $mRo3['Nm_Aset'];
					$KdAsT  = $Col[1];
					if (substr($KdAsT,0,5)=="1.3.2" || substr($KdAsT,0,5)=="1.3.3")
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
					
					$JmlRc  = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:KdpToAset".$sYt,$mRo3['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=".$oPr,"","");
					if ($JmlRc > 0)
					{
						$Col[3] = $JmlRc;
						$JmlDB  = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset_108:Kd_Upb:Tanggal:Tanggal:KdpToAset".$sYt,$mRo3['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31".$nIL.":N","LIKE:LIKE:>=:<=:=".$oPr,"","");
						$JmlKR  = fGlobal("IfNull(sum(Kredit),0)","ta_kib_post_108","Kd_Aset_108:Kd_Upb:Tanggal:Tanggal:KdpToAset".$sYt,$mRo3['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31".$nIL.":N","LIKE:LIKE:>=:<=:=".$oPr,"","");
						$Col[4] = $JmlDB - $JmlKR;
						if ($NmTB=="a" || $NmTB=="f")
						{
							$Col[5] = $JmlRc;
							$Col[6] = 0;
							$Col[7] = 0;
							$Col[8] = $JmlRc - ($Col[5]+$Col[6]+$Col[7]);
						}
						else
						{
							$Col[5] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Kondisi:KdpToAset".$sYt,$mRo3['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":B".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
							$Col[6] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Kondisi:KdpToAset".$sYt,$mRo3['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":RR".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
							$Col[7] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Kondisi:KdpToAset".$sYt,$mRo3['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":RB".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
							$Col[8] = $JmlRc - ($Col[5]+$Col[6]+$Col[7]);
						}
						$Col[9] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo3['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":APBD".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[10]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo3['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Hibah".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[11]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo3['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Mutasi".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[12]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo3['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Pembelian".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[13]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo3['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Pinjam".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[14]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo3['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Sewa".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[15]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo3['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Ruslah".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[16]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo3['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Guna_Usaha".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[17]= $JmlRc - ($Col[9]+$Col[10]+$Col[11]+$Col[12]+$Col[13]+$Col[14]+$Col[15]+$Col[16]);
						
						if ($iG3 > 1) {echo EmptyRow();}
						ViewData($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$xB);
						func_RCI4($Col[1],$gUpb,$rThn,$qThn,$rMLK,"");
						$iG3++;
					}
				}
				while ($mRo3 = mysql_fetch_assoc($nRs3));
			}
		}		
				
		function func_RCI4($Kd4,$gUpb,$rThn,$qThn,$rMLK,$qSh)
		{
			$nSQL4= "SELECT * FROM ref_rek_aset108_7 WHERE Kd_Aset LIKE '".$Kd4.".___' ORDER BY Kd_Aset";
			$NmTB = fNmHuruf(intval(substr($Kd4,0,2)));
			if ($qSh!="") {echo $nSQL4."<br>";}
			$nRs4 = mysql_query($nSQL4) or die(mysql_error());
			$mRo4 = mysql_fetch_assoc($nRs4);
			$tRo4 = mysql_num_rows($nRs4);
			if ($tRo4 > 0)
			{
				do
				{
					$xB = "";
					ClrVr();
					$Col[1] = $mRo4['Kd_Aset'];
					$Col[2] = $mRo4['Nm_Aset'];
					$KdAsT  = $Col[1];
					if (substr($KdAsT,0,5)=="1.3.2" || substr($KdAsT,0,5)=="1.3.3")
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
					$JmlRc  = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:KdpToAset".$sYt,$mRo4['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=".$oPr,"","");
					if ($JmlRc > 0)
					{
						$Col[3] = $JmlRc;
						$JmlDB  = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset_108:Kd_Upb:Tanggal:Tanggal:KdpToAset".$sYt,$mRo4['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31".$nIL.":N","LIKE:LIKE:>=:<=:=".$oPr,"","");
						$JmlKR  = fGlobal("IfNull(sum(Kredit),0)","ta_kib_post_108","Kd_Aset_108:Kd_Upb:Tanggal:Tanggal:KdpToAset".$sYt,$mRo4['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31".$nIL.":N","LIKE:LIKE:>=:<=:=".$oPr,"","");
						$Col[4] = $JmlDB - $JmlKR;
						if ($NmTB=="a" || $NmTB=="f")
						{
							$Col[5] = $JmlRc;
							$Col[6] = 0;
							$Col[7] = 0;
							$Col[8] = $JmlRc - ($Col[5]+$Col[6]+$Col[7]);
						}
						else
						{
							$Col[5] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Kondisi:KdpToAset".$sYt,$mRo4['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":B".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
							$Col[6] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Kondisi:KdpToAset".$sYt,$mRo4['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":RR".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
							$Col[7] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Kondisi:KdpToAset".$sYt,$mRo4['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":RB".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
							$Col[8] = $JmlRc - ($Col[5]+$Col[6]+$Col[7]);
						}
						$Col[9] = fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo4['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":APBD".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[10]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo4['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Hibah".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[11]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo4['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Mutasi".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[12]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo4['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Pembelian".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[13]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo4['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Pinjam".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[14]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo4['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Sewa".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[15]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo4['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Ruslah".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[16]= fGlobal("COUNT(*)","Ta_Kib_108","Kd_Aset_108:Kd_Upb:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:Asal_Usul:KdpToAset".$sYt,$mRo4['Kd_Aset']."%:".$gUpb.":".$rThn."-01-01:".$qThn."-12-31:".$rMLK.":Guna_Usaha".$nIL.":N","LIKE:LIKE:>=:<=:LIKE:=:=".$oPr,"","");
						$Col[17]= $JmlRc - ($Col[9]+$Col[10]+$Col[11]+$Col[12]+$Col[13]+$Col[14]+$Col[15]+$Col[16]);
						
						ViewData($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$xB);
					}
				}
				while ($mRo4 = mysql_fetch_assoc($nRs4));
			}
		}		
		?>
		<? function ViewData($x01,$x02,$x03,$x04,$x05,$x06,$x07,$x08,$x09,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$xB) {?>
		<tr>
			<td width="50" valign="top"><? echo $xB.$x01?></td>
			<td width="133" valign="top"><? echo $xB.$x02?>&nbsp;</td>
			<td valign="top" align="center"><? echo $xB.fConvertToRupiahBulat($x03)?></td>
			<td valign="top" align="right"><? echo $xB.fConvertToRupiah($x04)?></td>
			<td valign="top" align="center"><? if ($x05 >0 ) {echo $xB.fConvertToRupiahBulat($x05);}?></td>
			<td valign="top" align="center"><? if ($x06 >0 ) {echo $xB.fConvertToRupiahBulat($x06);}?></td>
			<td valign="top" align="center"><? if ($x07 >0 ) {echo $xB.fConvertToRupiahBulat($x07);}?></td>
			<td valign="top" align="center"><? if ($x08 >0 ) {echo $xB.fConvertToRupiahBulat($x08);}?></td>
			<td align="center" valign="top"><? if ($x09 >0 ) {echo $xB.fConvertToRupiahBulat($x09);}?></td>
			<td valign="top" align="center"><? if ($x10 >0 ) {echo $xB.fConvertToRupiahBulat($x10);}?></td>
			<td valign="top" align="center"><? if ($x11 >0 ) {echo $xB.fConvertToRupiahBulat($x11);}?></td>
			<td valign="top" align="center"><? if ($x12 >0 ) {echo $xB.fConvertToRupiahBulat($x12);}?></td>
			<td valign="top" align="center"><? if ($x13 >0 ) {echo $xB.fConvertToRupiahBulat($x13);}?></td>
			<td valign="top" align="center"><? if ($x14 >0 ) {echo $xB.fConvertToRupiahBulat($x14);}?></td>
			<td valign="top" align="center"><? if ($x15 >0 ) {echo $xB.fConvertToRupiahBulat($x15);}?></td>
			<td valign="top" align="center"><? if ($x16 >0 ) {echo $xB.fConvertToRupiahBulat($x16);}?></td>
			<td align="center" valign="top"><? if ($x17 >0 ) {echo $xB.fConvertToRupiahBulat($x17);}?></td>
		</tr>
		<? } ?>
		<? function EmptyRow() {?>
		<tr>
			<td width="50" valign="top">&nbsp;</td>
			<td width="133" valign="top">&nbsp;</td>
			<td valign="top" align="right">&nbsp;</td>
			<td valign="top" align="right">&nbsp;</td>
			<td valign="top" align="right">&nbsp;</td>
			<td valign="top" align="right">&nbsp;</td>
			<td align="right" valign="top">&nbsp;</td>
			<td align="right" valign="top">&nbsp;</td>
			<td align="right" valign="top">&nbsp;</td>
			<td align="right" valign="top">&nbsp;</td>
			<td valign="top" align="right">&nbsp;</td>
			<td valign="top" align="right">&nbsp;</td>
			<td valign="top" align="right">&nbsp;</td>
			<td valign="top" align="right">&nbsp;</td>
			<td valign="top" align="right">&nbsp;</td>
			<td align="right" valign="top">&nbsp;</td>
		    <td align="right" valign="top">&nbsp;</td>
		</tr>
		<? } ?>
		<tr>
			<td width="50">&nbsp;</td>
			<td width="133"><hr color="#FFFFFF" size="0" noshade width="200"></td>
			<td><hr color="#FFFFFF" size="0" noshade width="50"></td>
			<td><hr color="#FFFFFF" size="0" noshade width="90"></td>
			<td><hr color="#FFFFFF" size="0" noshade width="40"></td>
			<td><hr color="#FFFFFF" size="0" noshade width="40"></td>
			<td><hr color="#FFFFFF" size="0" noshade width="40"></td>
			<td><hr color="#FFFFFF" size="0" noshade width="40"></td>
			<td><hr color="#FFFFFF" size="0" noshade width="40"></td>
			<td><hr color="#FFFFFF" size="0" noshade width="40"></td>
			<td><hr color="#FFFFFF" size="0" noshade width="40"></td>
			<td><hr color="#FFFFFF" size="0" noshade width="40"></td>
			<td><hr color="#FFFFFF" size="0" noshade width="40"></td>
			<td><hr color="#FFFFFF" size="0" noshade width="40"></td>
			<td><hr color="#FFFFFF" size="0" noshade width="40"></td>
			<td><hr color="#FFFFFF" size="0" noshade width="40"></td>
		    <td><hr color="#FFFFFF" size="0" noshade width="40"></td>
		</tr>
		<tr>
			<td style="border-top: 3px double #000000; font-weight:bold" colspan="2" align="center">JUMLAH</td>
			<td style="border-top: 3px double #000000; font-weight:bold" align="center"><? echo fConvertToRupiahBulat($tJmlRc)?></td>
			<td style="border-top: 3px double #000000; font-weight:bold" align="right"><? echo fConvertToRupiah($tJmlHr)?></td>
			<td style="border-top: 3px double #000000; font-weight:bold" align="center"><? if ($tJmlBB!=0) {echo fConvertToRupiahBulat($tJmlBB);}?></td>
			<td style="border-top: 3px double #000000; font-weight:bold" align="center"><? if ($tJmlRR!=0) {echo fConvertToRupiahBulat($tJmlRR);}?></td>
			<td style="border-top: 3px double #000000; font-weight:bold" align="center"><? if ($tJmlRB!=0) {echo fConvertToRupiahBulat($tJmlRB);}?></td>
			<td style="border-top: 3px double #000000; font-weight:bold" align="center"><? if ($tJmlLL!=0) {echo fConvertToRupiahBulat($tJmlLL);}?></td>
			<td style="border-top: 3px double #000000; font-weight:bold" align="center"><? if ($tJml09!=0) {echo fConvertToRupiahBulat($tJml09);}?></td>
			<td style="border-top: 3px double #000000; font-weight:bold" align="center"><? if ($tJml10!=0) {echo fConvertToRupiahBulat($tJml10);}?></td>
			<td style="border-top: 3px double #000000; font-weight:bold" align="center"><? if ($tJml11!=0) {echo fConvertToRupiahBulat($tJml11);}?></td>
			<td style="border-top: 3px double #000000; font-weight:bold" align="center"><? if ($tJml12!=0) {echo fConvertToRupiahBulat($tJml12);}?></td>
			<td style="border-top: 3px double #000000; font-weight:bold" align="center"><? if ($tJml13!=0) {echo fConvertToRupiahBulat($tJml13);}?></td>
			<td style="border-top: 3px double #000000; font-weight:bold" align="center"><? if ($tJml14!=0) {echo fConvertToRupiahBulat($tJml14);}?></td>
			<td style="border-top: 3px double #000000; font-weight:bold" align="center"><? if ($tJml15!=0) {echo fConvertToRupiahBulat($tJml15);}?></td>
			<td style="border-top: 3px double #000000; font-weight:bold" align="center"><? if ($tJml16!=0) {echo fConvertToRupiahBulat($tJml16);}?></td>
			<td style="border-top: 3px double #000000; font-weight:bold" align="center"><? if ($tJml17!=0) {echo fConvertToRupiahBulat($tJml17);}?></td>
		</tr>
	</table>	</td>
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
