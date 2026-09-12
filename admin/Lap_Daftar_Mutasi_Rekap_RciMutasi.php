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
$rPil = (int)$rPil;
$gUnt= $gUnt;
$gSub= $gSub;
$gUpb= $gUpb;

require ("Lap_Include.php");
$CrJumping="NO";

$gThn= $gThn;
$gMLK  = $gMLK;

if ($gThn=="All" || $gThn=="") {$rThn="____";} else {$rThn=$gThn;}
if ($gMLK=="All" || $gMLK=="") {$rMLK="__";}   else {$rMLK=$gMLK;}
$Thn_A= $rThn-1;
$Thn_B= $rThn;

if ($rPil==4){
	$nBD="BIDANG /<br>JENIS /<br>OBJEK /<br>RINCIAN OBJEK";
}
if ($rPil==3){
	$nBD="BIDANG /<br>JENIS /<br>OBJEK";
}
if ($rPil==2){
	$nBD="BIDANG /<br>JENIS";
}
if ($rPil==1){
	$nBD="BIDANG";
}

$SQ="DELETE FROM ref_rek_aset7_temp WHERE Kd_Unit='$gUnt'";
$nR= mysql_query($SQ);

$nSQL= "SELECT Kd_Aset FROM ta_kib_post_108 WHERE Kd_UPB LIKE '$gUnt%' GROUP BY Kd_Aset";
$nRs = mysql_query($nSQL);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$tID = fGlobal("IDT","ref_rek_aset7_temp","Kd_Aset:Kd_Unit",$mRo[0].":".$gUnt,"=:=","","");
	if ($tID==""){
		$SQ="INSERT INTO ref_rek_aset7_temp SET Kd_Unit='$gUnt', Kd_Aset='".$mRo[0]."'";
		$nR= mysql_query($SQ);
	}
}
$nSQL= "SELECT Kd_Aset FROM ta_kib_post_108_mutasi WHERE Kd_UPB LIKE '$gUnt%' GROUP BY Kd_Aset";
$nRs = mysql_query($nSQL);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$tID = fGlobal("IDT","ref_rek_aset7_temp","Kd_Aset:Kd_Unit",$mRo[0].":".$gUnt,"=:=","","");
	if ($tID==""){
		$SQ="INSERT INTO ref_rek_aset7_temp SET Kd_Unit='$gUnt', Kd_Aset='".$mRo[0]."'";
		$nR= mysql_query($SQ);
	}
}
?>
<body>
<table border="0" align="center" width="4300" cellspacing="1" style="font-family: Calibri; font-size: 8pt; border-collapse: collapse" id="table1">
	<tr>
		<td width="1285" align="center" style="font-size: 12pt; font-weight: bold">REKAPITULASI DAFTAR MUTASI </td>
	</tr>
	<tr>
		<td width="1285" align="center" style="font-size: 12pt; font-weight: bold">TAHUN ANGGARAN <?=$Thn_B?></td>
	</tr>
	<tr>
		<td width="1285" align="center" style="font-size: 12pt"><span style="font-size: 11pt">Per Tanggal 31 Desember <?=$Thn_B?> </span></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
  </tr>
	<tr>
		<td>
		<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table8">
		<tr>
			<td width="75">SKPD</td>
			<td width="23">:</td>
			<td width="3188"><?php if ($xUnt=="") {echo "<i>SEMUA</i>";} else {echo strtoupper(fGlobal("Nm_Unit","Ref_Unit","Kd_Unit",$xUnt,"=","",""));}?></td>
			<td width="1197" align="right">&nbsp;</td>
		</tr>
		<tr>
			<td width="75">SUB UNIT </td>
			<td width="23">:</td>
			<td><?php if ($xSub=="") {echo "<i>SEMUA</i>";} else {echo strtoupper(fGlobal("Nm_Sub","Ref_Sub_Unit","Kd_Sub",$xSub,"=","",""));}?></td>
			<td width="1197">&nbsp;</td>
		</tr>
		<tr>
			<td width="75">UPB</td>
			<td width="23">:</td>
			<td><?php if ($xUpb=="") {echo "<i>SEMUA</i>";} else {echo strtoupper(fGlobal("Nm_Upb","Ref_Upb","Kd_Upb",$xUpb,"=","",""));}?></td>
			<td width="1197">&nbsp;</td>
		</tr>
		<tr>
			<td width="75"><?=$TiDaer?></td>
			<td width="23">:</td>
			<td><?=$NmDaer?></td>
			<td width="1197" align="right" style="font-weight: bold">&nbsp;</td>
		</tr>
		</table>		</td>
	</tr>
	<tr>
	  <td><table border="1" width="4300" cellspacing="1" style="font-family: arial; font-size: 8pt; border-collapse: collapse" bordercolor="#000000">
        <tr>
          <td rowspan="4" align="center" style="font-weight: bold">NO.</td>
          <td rowspan="4" align="center" style="font-weight: bold">GOL</td>
          <td rowspan="4" align="center" style="font-weight: bold"><?=$nBD?></td>
          <td rowspan="4" align="center" style="font-weight: bold">NAMA REKENING</td>
          <td colspan="2" align="center" style="font-weight: bold">KEADAAN<br>
            Per 1 Jan<?=$Thn_B?></td>
          <td colspan="48" align="center" style="font-weight: bold">MUTASI / PERUBAHAN<br>
            Selama 1 Jan
            <?=$Thn_B?>
            s.d 31 Des
            <?=$Thn_B?></td>
          <td colspan="2" align="center" style="font-weight: bold">KEADAAN<br>
            Per 31 Des
            <?=$Thn_B?></td>
          <td rowspan="4" align="center" style="font-weight: bold">KETERANGAN</td>
        </tr>
        <tr>
          <td rowspan="3" align="center" style="font-weight: bold">Jumlah<br>
            Barang </td>
          <td rowspan="3" align="center" style="font-weight: bold">Jumlah<br>
            Harga </td>
          <td colspan="4" align="center" style="font-weight: bold">RUSAK BERAT </td>
          <td colspan="4" align="center" style="font-weight: bold">MUTASI SKPD </td>
          <td colspan="4" align="center" style="font-weight: bold">MUTASI KIB </td>
          <td colspan="4" align="center" style="font-weight: bold">LELANG</td>
          <td colspan="4" align="center" style="font-weight: bold">HIBAH</td>
          <td colspan="4" align="center" style="font-weight: bold">RENOVASI</td>
          <td colspan="4" align="center" style="font-weight: bold">KOREKSI (DOBEL CATAT) </td>
          <td colspan="4" align="center" style="font-weight: bold">DALAM PENELUSURAN </td>
          <td colspan="4" align="center" style="font-weight: bold">HILANG</td>
          <td colspan="4" align="center" style="font-weight: bold">PENGHAPUSAN</td>
          <td colspan="4" align="center" style="font-weight: bold">PENGADAAN TAHUN <?=$Thn_B?></td>
          <td colspan="2" rowspan="2" align="center" style="font-weight: bold">TOTAL BERKURANG </td>
          <td colspan="2" rowspan="2" align="center" style="font-weight: bold">TOTAL BERTAMBAH</td>
          <td rowspan="3" align="center" style="font-weight: bold">Jumlah Barang</td>
          <td rowspan="3" align="center" style="font-weight: bold">Jumlah Harga</td>
        </tr>
        <tr>
          <td colspan="2" align="center" style="font-weight: bold">Berkurang</td>
          <td colspan="2" align="center" style="font-weight: bold">Bertambah</td>
          <td colspan="2" align="center" style="font-weight: bold">Berkurang</td>
          <td colspan="2" align="center" style="font-weight: bold">Bertambah</td>
          <td colspan="2" align="center" style="font-weight: bold">Berkurang</td>
          <td colspan="2" align="center" style="font-weight: bold">Bertambah</td>
          <td colspan="2" align="center" style="font-weight: bold">Berkurang</td>
          <td colspan="2" align="center" style="font-weight: bold">Bertambah</td>
          <td colspan="2" align="center" style="font-weight: bold">Berkurang</td>
          <td colspan="2" align="center" style="font-weight: bold">Bertambah</td>
          <td colspan="2" align="center" style="font-weight: bold">Berkurang</td>
          <td colspan="2" align="center" style="font-weight: bold">Bertambah</td>
          <td colspan="2" align="center" style="font-weight: bold">Berkurang</td>
          <td colspan="2" align="center" style="font-weight: bold">Bertambah</td>
          <td colspan="2" align="center" style="font-weight: bold">Berkurang</td>
          <td colspan="2" align="center" style="font-weight: bold">Bertambah</td>
          <td colspan="2" align="center" style="font-weight: bold">Berkurang</td>
          <td colspan="2" align="center" style="font-weight: bold">Bertambah</td>
          <td colspan="2" align="center" style="font-weight: bold">Berkurang</td>
          <td colspan="2" align="center" style="font-weight: bold">Bertambah</td>
          <td colspan="2" align="center" style="font-weight: bold">Berkurang</td>
          <td colspan="2" align="center" style="font-weight: bold">Bertambah</td>
        </tr>
        <tr>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
          <td align="center" style="font-weight: normal">Jumlah Barang</td>
          <td align="center" style="font-weight: normal">Jumlah Harga</td>
        </tr>
        <tr>
          <td width="23" style="font-weight: bold; border-bottom: 3px double #000000" align="center">1</td>
          <td width="29" style="font-weight: bold; border-bottom: 3px double #000000" align="center">2</td>
          <td width="70" style="font-weight: bold; border-bottom: 3px double #000000" align="center">3</td>
          <td align="center" style="font-weight: bold; border-bottom: 3px double #000000">4</td>
          <td width="50" style="font-weight: bold; border-bottom: 3px double #000000" align="center">5</td>
          <td width="110" align="center" style="font-weight: bold; border-bottom: 3px double #000000">6</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">7</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">8</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">9</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">10</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">11</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">12</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">13</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">14</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">15</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">16</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">17</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">18</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">19</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">20</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">21</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">22</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">23</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">24</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">25</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">26</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">27</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">28</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">29</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">30</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">31</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">32</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">33</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">34</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">35</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">36</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">37</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">38</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">39</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">40</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">41</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">42</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">43</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">44</td>
          <td width="52" align="center" style="font-weight: bold; border-bottom: 3px double #000000">45</td>
          <td width="85" align="center" style="font-weight: bold; border-bottom: 3px double #000000">46</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">47</td>
          <td width="100" align="center" style="font-weight: bold; border-bottom: 3px double #000000">48</td>
          <td width="51" align="center" style="font-weight: bold; border-bottom: 3px double #000000">49</td>
          <td width="100" align="center" style="font-weight: bold; border-bottom: 3px double #000000">50</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">51</td>
          <td width="100" align="center" style="font-weight: bold; border-bottom: 3px double #000000">52</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">53</td>
          <td width="100" align="center" style="font-weight: bold; border-bottom: 3px double #000000">54</td>
          <td width="50" align="center" style="font-weight: bold; border-bottom: 3px double #000000">55</td>
          <td width="110" align="center" style="font-weight: bold; border-bottom: 3px double #000000">56</td>
          <td width="120" align="center" style="font-weight: bold; border-bottom: 3px double #000000">57</td>
        </tr>
        <?php
			$Col = array();
			$tCol= array();
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
				for($nG=1; $nG<=57; $nG++)
				{
					if ($nG>=5 && $nG<=56) {
						$Col[$nG]=0;
					}
					else {
						$Col[$nG]="";
					}
				}
			}
			
			for ($iR=7; $iR<=50; $iR++)
			{
				$tCol[$iR] = 0;
			}
				
			$LoadMutasi="Y";
			$nSQL= "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE Kd_Aset<>'1.3.7' AND Kd_Aset<>'1.5.2' AND Kd_Aset<>'1.5.5' AND Kd_Aset<>'1.5.6' ORDER BY Kd_Aset";	#*#
			$nRs = mysql_query($nSQL) or die(mysql_error());
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				if ($iG > 1) {echo ViewBlank();}
				$xB = "<b>";
				$xR = " style='background:#DFEBD9'";
				ClrVr();
				$KdAsT  = $mRo['Kd_Aset'];
				$Col[1] = $iG.".";
				$Col[2] = $mRo['Kd_Aset'];
				$Col[3] = "";
				$Col[4] = strtoupper($mRo['Nm_Aset']);
				$WAsT = substr($KdAsT,0,2);
				
				if (substr($KdAsT,0,5)=="1.3.2" || substr($KdAsT,0,5)=="1.3.3")
				{
					$sYt = ":extracom";
					#$nIL = ":N";
					#$oPr = ":=";
					$nIL = ":%";
					$oPr = ":LIKE";
				}
				else{
					$sYt = "";
					$nIL = "";
					$oPr = "";
				}
					
				//KEADAAN AWAL (record)
				$qAWL = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Kd_UPB".$sYt,$KdAsT."%:".$Thn_A."-12-31:".$gUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
				if ($LoadMutasi=="Y"){
					if (fNmHuruf($iG)!="f") {
						$qAWL = $qAWL + fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$Thn_B."-%-%:".$gUpb,"LIKE:LIKE:LIKE","","");
						$qAWL = $qAWL - fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$Thn_B."-%-%:".$gUpb,"LIKE:LIKE:LIKE","","");
					}
				}
				
				//KEADAAN AWAL (nilai)
				$gNIa = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$Thn_A."-12-31:".$gUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
				$gNIb = fGlobal("IfNull(sum(Kredit),0)","ta_kib_post_108","Kd_Aset:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$Thn_A."-12-31:".$gUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
				$gAWL = $gNIa - $gNIb;
				
				if ($LoadMutasi=="Y"){
					$gAWL = $gAWL + fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$Thn_B."-%-%:".$gUpb,"LIKE:LIKE:LIKE","","");
					$gAWL = $gAWL - fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$Thn_B."-%-%:".$gUpb,"LIKE:LIKE:LIKE","","");
				}
					
				$Col[5] = $qAWL;
				$Col[6] = $gAWL;
				
				################
				if (fNmHuruf($iG)=="f"){
					#TAHUN BERSANGKUTAN
					# - 
					$Col[47] = ItemKurangKibF($iG,$sYt,$KdAsT,$Thn_B,$gUpb,$nIL,$oPr,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb:KdpToAset".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL.":Y","LIKE:>=:<=:LIKE:=".$oPr,"","");
					$Col[48] = HargKurangKibF($sYt,$KdAsT,$Thn_B,$gUpb,$nIL,$oPr,"");      #fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_Upb:KdpToAset".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL.":Y","LIKE:>=:<=:LIKE:=".$oPr,"","");
					# +
					$Col[49] = ItemTambahKibF($iG,$sYt,$KdAsT,$Thn_B,$gUpb,$nIL,$oPr,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
					$Col[50] = HargTambahKibF($sYt,$KdAsT,$Thn_B,$gUpb,$nIL,$oPr,"");      #fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_Upb".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
				}
				else{
					if ($LoadMutasi=="Y"){
						#RUSAK BERAT
						$mMS="RB";
						# -
						$Col[7]  = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%".":".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[8]  = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						# +
						$Col[9]  = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[10] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
					
						#MUTASI SKPD
						$mMS="MS";
						# -
						$Col[11] = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%".":".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[12] = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						# +
						$Col[13] = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[14] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
					
						#MUJTASI KIB
						$mMS="MK";
						# - 
						$Col[15] = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%".":".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[16] = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						# +	
						$Col[17] = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[18] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						
						#LELANG
						$mMS="LE";
						# - 
						$Col[19] = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%".":".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[20] = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						# +
						$Col[21] = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[22] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						
						#HIBAH
						$mMS="HB";
						# - 
						$Col[23] = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%".":".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[24] = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						# +
						$Col[25] = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[26] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						
						#RENOVASI
						$mMS="AR";
						# - 
						$Col[27] = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%".":".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[28] = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						# +
						$Col[29] = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[30] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						
						#DOBEL CATAT / KOREKSI
						$mMS="KR";
						# - 
						$Col[31] = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%".":".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[32] = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						# +
						$Col[33] = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[34] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						
						#DALAM PENELUSURAN
						$mMS="PL";
						# - 
						$Col[35] = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%".":".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[36] = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						# +
						$Col[37] = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[38] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						
						#HILANG
						$mMS="HL";
						# - 
						$Col[39] = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%".":".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[40] = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						# +
						$Col[41] = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[42] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						
						#PENGHAPUSAN
						$mMS="PH";
						# - 
						$Col[43] = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%".":".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[44] = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						# +
						$Col[45] = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,"");  #fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						$Col[46] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,"");      #fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsT."%:".$Thn_B."-%-%:".$gUpb.":".$mMS,"LIKE:LIKE:LIKE:=","","");
						
						#TAHUN BERSANGKUTAN
						# - 
						$Col[47] = 0;
						$Col[48] = 0;
						# +
						$Col[49] = ItemTambahThnN($iG,$sYt,$KdAsT,$Thn_B,$gUpb,$nIL,$oPr,""); #fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						$Col[50] = HargTambahThnN($sYt,$KdAsT,$Thn_B,$gUpb,$nIL,$oPr,"");     #fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_Upb".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
					}
				}
				################
				
				//BERKURANG
				if (fNmHuruf($iG)=="f"){
					#item
					$qKRG   = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb:KdpToAset".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL.":Y","LIKE:>=:<=:LIKE:=".$oPr,"","");
					#nilai
					$gKRG   = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_Upb:KdpToAset".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL.":Y","LIKE:>=:<=:LIKE:=".$oPr,"","");
				}
				else{
					#item
					$qKRG = 0;
					if ($LoadMutasi=="Y"){$qKRG = $qKRG + fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb",$KdAsT."%:".$Thn_B."-%-%".":".$gUpb,"LIKE:LIKE:LIKE","","");}
					#nilai
					$gKRG = 0;
					if ($LoadMutasi=="Y"){$gKRG = $gKRG + fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$Thn_B."-%-%:".$gUpb,"LIKE:LIKE:LIKE","","");}
				}
				
				$Col[51] = $qKRG;
				$Col[52] = $gKRG;
				
				//BERTAMBAH
				if (fNmHuruf($iG)=="f"){
					#item
					$qTMB = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
					#nilai
					$gTMB = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_Upb".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
				}
				else{
					#item
					$qTMB = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
					if ($LoadMutasi=="Y"){$qTMB = $qTMB + fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$Thn_B."-%-%:".$gUpb,"LIKE:LIKE:LIKE","","");}
					#nilai
					$gTMB = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_Upb".$sYt,$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
					if ($LoadMutasi=="Y"){$gTMB = $gTMB + fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$Thn_B."-%-%:".$gUpb,"LIKE:LIKE:LIKE","","");}
				}
				$Col[53] = $qTMB;
				$Col[54]= $gTMB;
				
				//KEADAAN AKHIR
				$qAKH    = $qAWL - $qKRG + $qTMB;
				$gAKH    = $gAWL - $gKRG + $gTMB;
				$Col[55] = $qAKH;
				$Col[56] = $gAKH;
				$Col[57] = "";
				#ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],$Col[19],$Col[20],$Col[21],$Col[22],$Col[23],$Col[24],$Col[25],$Col[26],$Col[27],$Col[28],$Col[29],$Col[30],$Col[31],$Col[32],$Col[33],$Col[34],$Col[35],$Col[36],$Col[37],$Col[38],$Col[39],$Col[40],$Col[41],$Col[42],$Col[43],$Col[44],$Col[45],$Col[46],$Col[47],$Col[48],$Col[49],$Col[50],$Col[51],$Col[52],$Col[53],$Col[54],$Col[55],$Col[56],$Col[57],$xR,$xB);
				#if ($CrJumping=="YA"){
				if ((int)$rPil==4){
					ViewRciObjek($mRo['Kd_Aset'],$gUpb,$Thn_A,$Thn_B,$iG,$LoadMutasi);
				}
				else{
					ViewBidang($mRo['Kd_Aset'],$gUpb,$Thn_A,$Thn_B,$iG,$LoadMutasi,$rPil);
				}
				
				$fAKH= $fAKH + $qAKH;
				$fAWL= $fAWL + $qAWL;
				$fKRG= $fKRG + $qKRG;
				$fTMB= $fTMB + $qTMB;
				
				for ($iR=7; $iR<=50; $iR++)
				{
					$tCol[$iR] = $tCol[$iR] + $Col[$iR];
				}
					
				$tAKH= $tAKH + $gAKH;
				$tAWL= $tAWL + $gAWL;
				$tKRG= $tKRG + $gKRG;
				$tTMB= $tTMB + $gTMB;
				
				$iG++;
			}
			
			function ViewBidang($KdBDG,$mUpb,$mThn,$nThn,$mG,$LoadMutasi,$rPil)
			{
				$iGG  = 1;
				$nSQB = "SELECT * FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '".$KdBDG.".%' ORDER BY Kd_Aset";
				echo $nSQB."<br>";
				$nRsB = mysql_query($nSQB) or die(mysql_error());
				while ($mRoB = mysql_fetch_array($nRsB, MYSQL_BOTH))
				{
					if ($rPil==1){
						$xB = "";
					}
					else{
						$xB = "<b>";
					}
					
					ClrVr();
					$KdAsT  = $mRoB['Kd_Aset'];
					$Col[1] = "";
					$Col[2] = "";
					$Col[3] = substr($mRoB['Kd_Aset'],3,2);
					$Col[4] = $mRoB['Nm_Aset'];
					
					if (substr($KdAsT,0,5)=="1.3.2" || substr($KdAsT,0,5)=="1.3.3")
					{
						$sYt = ":extracom";
						#$nIL = ":N";
						#$oPr = ":=";
						$nIL = ":%";
						$oPr = ":LIKE";
					}
					else{
						$sYt = "";
						$nIL = "";
						$oPr = "";
					}
					
					//KEADAAN AWAL (record)
					$rAWL = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Kd_UPB".$sYt,$KdAsT."%:".$mThn."-12-31:".$mUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
					if ($LoadMutasi=="Y"){
						if (fNmHuruf($mG)!="f") {
							#Mutasi keluar
							$rAWL = $rAWL + fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
							#Mutasi masuk
							$rAWL = $rAWL - fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
						}
					}
					
					//KEADAAN AWAL (nilai)
					$vNIa = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$mThn."-12-31:".$mUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
					$vNIb = fGlobal("IfNull(sum(Kredit),0)","ta_kib_post_108","Kd_Aset:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$mThn."-12-31:".$mUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
					$vAWL = $vNIa - $vNIb;
					if ($LoadMutasi=="Y"){
						#Mutasi keluar
						$vAWL = $vAWL + fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
						#Mutasi masuk
						$vAWL = $vAWL - fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
					}
					
					$Col[5] = $rAWL;
					$Col[6] = $vAWL;
					
					################
					if (fNmHuruf($mG)=="f"){
						#TAHUN BERSANGKUTAN
						# - 
						$Col[47] = ItemKurangKibF($mG,$sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
						$Col[48] = HargKurangKibF($sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
						# +
						$Col[49] = ItemTambahKibF($mG,$sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
						$Col[50] = HargTambahKibF($sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
					}
					else{
						if ($LoadMutasi=="Y"){
							#RUSAK BERAT
							$mMS="RB";
							# -
							$Col[7]  = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[8]  = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[9]  = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[10] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
						
							#MUTASI SKPD
							$mMS="MS";
							# -
							$Col[11] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[12] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[13] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[14] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
						
							#MUJTASI KIB
							$mMS="MK";
							# - 
							$Col[15] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[16] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[17] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[18] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#LELANG
							$mMS="LE";
							# - 
							$Col[19] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[20] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[21] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[22] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#HIBAH
							$mMS="HB";
							# - 
							$Col[23] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[24] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[25] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[26] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#RENOVASI
							$mMS="AR";
							# - 
							$Col[27] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[28] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[29] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[30] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#DOBEL CATAT / KOREKSI
							$mMS="KR";
							# - 
							$Col[31] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[32] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[33] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[34] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#DALAM PENELUSURAN
							$mMS="PL";
							# - 
							$Col[35] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[36] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[37] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[38] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#HILANG
							$mMS="HL";
							# - 
							$Col[39] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[40] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[41] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[42] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#PENGHAPUSAN
							$mMS="PH";
							# - 
							$Col[43] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[44] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[45] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[46] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#TAHUN BERSANGKUTAN
							# - 
							$Col[47] = 0;
							$Col[48] = 0;
							# +
							$Col[49] = ItemTambahThnN($mG,$sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
							$Col[50] = HargTambahThnN($sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
						}
					}
					################
				
					//BERKURANG
					if (fNmHuruf($mG)=="f"){
						$rKRG   = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb:KdpToAset".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL.":Y","LIKE:>=:<=:LIKE:=".$oPr,"","");
						$vKRG   = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_UPB:KdpToAset".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL.":Y","LIKE:>=:<=:LIKE:=".$oPr,"","");
					}
					else{
						#item
						$rKRG   = 0;
						if ($LoadMutasi=="Y"){$rKRG   = $rKRG + fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb",$KdAsT."%:".$nThn."-%-%".":".$mUpb,"LIKE:LIKE:LIKE","","");}
						#nilai
						$vKRG   = fGlobal("IfNull(sum(Kredit),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_Upb".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						if ($LoadMutasi=="Y"){$vKRG   = $vKRG + fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");}
					}
					$Col[51] = $rKRG;
					$Col[52] = $vKRG;
					
					//BERTAMBAH
					if (fNmHuruf($mG)=="f"){
						$rTMB   = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						$vTMB   = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
					}
					else{
						#item
						$rTMB = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						if ($LoadMutasi=="Y"){$rTMB = $rTMB + fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");}
						#nilai
						$vTMB = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_Upb".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						if ($LoadMutasi=="Y"){$vTMB = $vTMB + fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");}
					}
					$Col[53] = $rTMB;
					$Col[54]= $vTMB;
					
					$rAKH    = $rAWL - $rKRG + $rTMB;
					$vAKH    = $vAWL - $vKRG + $vTMB;
					
					$Col[55] = $rAKH;
					$Col[56] = $vAKH;
					$Col[57] = "";
					
					if ($Col[5]!=0 || $Col[6]!=0 || $Col[51]!=0 || $Col[52]!=0 || $Col[53]!=0 || $Col[54]!=0 || $Col[55]!=0 || $Col[56]!=0) {
						ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],$Col[19],$Col[20],$Col[21],$Col[22],$Col[23],$Col[24],$Col[25],$Col[26],$Col[27],$Col[28],$Col[29],$Col[30],$Col[31],$Col[32],$Col[33],$Col[34],$Col[35],$Col[36],$Col[37],$Col[38],$Col[39],$Col[40],$Col[41],$Col[42],$Col[43],$Col[44],$Col[45],$Col[46],$Col[47],$Col[48],$Col[49],$Col[50],$Col[51],$Col[52],$Col[53],$Col[54],$Col[55],$Col[56],$Col[57],"",$xB);
						if ($rPil==2 || $rPil==3 || $rPil==4) {ViewJenis($KdAsT,$mUpb,$mThn,$nThn,$mG,$LoadMutasi,$rPil);}
						$iGG++;
					}
				}
			}
			
			function ViewJenis($KdJNS,$mUpb,$mThn,$nThn,$mG,$LoadMutasi,$rPil)
			{
				$iGC  = 1;
				$nSQC = "SELECT * FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '".$KdJNS.".%' ORDER BY Kd_Aset";
				$nRsC = mysql_query($nSQC) or die(mysql_error());
				while ($mRoC = mysql_fetch_array($nRsC, MYSQL_BOTH))
				{
					if ($rPil==2){
						$xB = "";
					}
					else{
						$xB = "<b>";
					}
					ClrVr();
					$KdAsT  = $mRoC['Kd_Aset'];
					$Col[1] = "";
					$Col[2] = "";
					$Col[3] = substr($mRoC['Kd_Aset'],3,5);
					$Col[4] = $mRoC['Nm_Aset'];
					
					if (substr($KdAsT,0,5)=="1.3.2" || substr($KdAsT,0,5)=="1.3.3")
					{
						$sYt = ":extracom";
						#$nIL = ":N";
						#$oPr = ":=";
						$nIL = ":%";
						$oPr = ":LIKE";
					}
					else{
						$sYt = "";
						$nIL = "";
						$oPr = "";
					}
					
					//KEADAAN AWAL (record)
					$rAWL = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Kd_UPB".$sYt,$KdAsT."%:".$mThn."-12-31:".$mUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
					if ($LoadMutasi=="Y"){
						if (fNmHuruf($mG)!="f") {
							#Mutasi keluar
							$rAWL = $rAWL + fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
							#Mutasi masuk
							$rAWL = $rAWL - fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
						}
					}
					
					//KEADAAN AWAL (nilai)
					$vNIa = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$mThn."-12-31:".$mUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
					$vNIb = fGlobal("IfNull(sum(Kredit),0)","ta_kib_post_108","Kd_Aset:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$mThn."-12-31:".$mUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
					$vAWL = $vNIa - $vNIb;
					if ($LoadMutasi=="Y"){
						#Mutasi keluar
						$vAWL = $vAWL + fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
						#Mutasi masuk
						$vAWL = $vAWL - fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
					}
					
					$Col[5] = $rAWL;
					$Col[6] = $vAWL;
					
					################
					if (fNmHuruf($mG)=="f"){
						#TAHUN BERSANGKUTAN
						# - 
						$Col[47] = ItemKurangKibF($mG,$sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
						$Col[48] = HargKurangKibF($sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
						# +
						$Col[49] = ItemTambahKibF($mG,$sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
						$Col[50] = HargTambahKibF($sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
					}
					else{
						if ($LoadMutasi=="Y"){
							#RUSAK BERAT
							$mMS="RB";
							# -
							$Col[7]  = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[8]  = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[9]  = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[10] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
						
							#MUTASI SKPD
							$mMS="MS";
							# -
							$Col[11] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[12] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[13] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[14] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
						
							#MUJTASI KIB
							$mMS="MK";
							# - 
							$Col[15] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[16] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[17] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[18] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#LELANG
							$mMS="LE";
							# - 
							$Col[19] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[20] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[21] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[22] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#HIBAH
							$mMS="HB";
							# - 
							$Col[23] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[24] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[25] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[26] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#RENOVASI
							$mMS="AR";
							# - 
							$Col[27] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[28] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[29] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[30] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#DOBEL CATAT / KOREKSI
							$mMS="KR";
							# - 
							$Col[31] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[32] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[33] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[34] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#DALAM PENELUSURAN
							$mMS="PL";
							# - 
							$Col[35] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[36] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[37] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[38] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#HILANG
							$mMS="HL";
							# - 
							$Col[39] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[40] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[41] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[42] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#PENGHAPUSAN
							$mMS="PH";
							# - 
							$Col[43] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[44] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[45] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[46] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#TAHUN BERSANGKUTAN
							# - 
							$Col[47] = 0;
							$Col[48] = 0;
							# +
							$Col[49] = ItemTambahThnN($mG,$sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
							$Col[50] = HargTambahThnN($sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
						}
					}
					################
				
					//BERKURANG
					if (fNmHuruf($mG)=="f"){
						$rKRG   = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb:KdpToAset".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL.":Y","LIKE:>=:<=:LIKE:=".$oPr,"","");
						$vKRG   = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_UPB:KdpToAset".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL.":Y","LIKE:>=:<=:LIKE:=".$oPr,"","");
					}
					else{
						#item
						$rKRG   = 0;
						if ($LoadMutasi=="Y"){$rKRG   = $rKRG + fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb",$KdAsT."%:".$nThn."-%-%".":".$mUpb,"LIKE:LIKE:LIKE","","");}
						#nilai
						$vKRG   = fGlobal("IfNull(sum(Kredit),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_Upb".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						if ($LoadMutasi=="Y"){$vKRG   = $vKRG + fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");}
					}
					$Col[51] = $rKRG;
					$Col[52] = $vKRG;
					
					//BERTAMBAH
					if (fNmHuruf($mG)=="f"){
						$rTMB   = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						$vTMB   = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
					}
					else{
						#item
						$rTMB = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						if ($LoadMutasi=="Y"){$rTMB = $rTMB + fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");}
						#nilai
						$vTMB = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_Upb".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						if ($LoadMutasi=="Y"){$vTMB = $vTMB + fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");}
					}
					$Col[53] = $rTMB;
					$Col[54]= $vTMB;
					
					$rAKH    = $rAWL - $rKRG + $rTMB;
					$vAKH    = $vAWL - $vKRG + $vTMB;
					$Col[55] = $rAKH;
					$Col[56] = $vAKH;
					
					$Col[57] = "";
					
					if ($Col[5]!=0 || $Col[6]!=0 || $Col[51]!=0 || $Col[52]!=0 || $Col[53]!=0 || $Col[54]!=0 || $Col[55]!=0 || $Col[56]!=0) {
						ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],$Col[19],$Col[20],$Col[21],$Col[22],$Col[23],$Col[24],$Col[25],$Col[26],$Col[27],$Col[28],$Col[29],$Col[30],$Col[31],$Col[32],$Col[33],$Col[34],$Col[35],$Col[36],$Col[37],$Col[38],$Col[39],$Col[40],$Col[41],$Col[42],$Col[43],$Col[44],$Col[45],$Col[46],$Col[47],$Col[48],$Col[49],$Col[50],$Col[51],$Col[52],$Col[53],$Col[54],$Col[55],$Col[56],$Col[57],"",$xB);
						if ($rPil==3 || $rPil==4) {ViewObjek($KdAsT,$mUpb,$mThn,$nThn,$mG,$LoadMutasi,$rPil);}
					}
					$iGC++;
				}
			}
			
			function ViewObjek($KdOBJ,$mUpb,$mThn,$nThn,$mG,$LoadMutasi,$rPil)
			{
				$iGD  = 1;
				$nSQD = "SELECT * FROM ref_rek_aset108_6 WHERE Kd_Aset LIKE '".$KdOBJ.".%' ORDER BY Kd_Aset";
				$nRsD = mysql_query($nSQD) or die(mysql_error());
				while ($mRoD = mysql_fetch_array($nRsD, MYSQL_BOTH))
				{
					if ($rPil==3){
						$xB = "";
					}
					else{
						$xB = "<b>";
					}
					ClrVr();
					$KdAsT  = $mRoD['Kd_Aset'];
					$Col[1] = "";
					$Col[2] = "";
					$Col[3] = substr($mRoD['Kd_Aset'],3,8);
					$Col[4] = $mRoD['Nm_Aset'];
					
					if (substr($KdAsT,0,2)=="02" || substr($KdAsT,0,2)=="03")
					{
						$sYt = ":extracom";
						#$nIL = ":N";
						#$oPr = ":=";
						$nIL = ":%";
						$oPr = ":LIKE";
					}
					else{
						$sYt = "";
						$nIL = "";
						$oPr = "";
					}
					
					//KEADAAN AWAL (record)
					$rAWL = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Kd_UPB".$sYt,$KdAsT."%:".$mThn."-12-31:".$mUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
					if ($LoadMutasi=="Y"){
						if (fNmHuruf($mG)!="f") {
							#Mutasi keluar
							$rAWL = $rAWL + fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
							#Mutasi masuk
							$rAWL = $rAWL - fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
						}
					}
					
					//KEADAAN AWAL (nilai)
					$vNIa = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$mThn."-12-31:".$mUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
					$vNIb = fGlobal("IfNull(sum(Kredit),0)","ta_kib_post_108","Kd_Aset:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$mThn."-12-31:".$mUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
					$vAWL = $vNIa - $vNIb;
					if ($LoadMutasi=="Y"){
						#Mutasi keluar
						$vAWL = $vAWL + fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
						#Mutasi masuk
						$vAWL = $vAWL - fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
					}
					
					$Col[5] = $rAWL;
					$Col[6] = $vAWL;
					
					################
					if (fNmHuruf($mG)=="f"){
						#TAHUN BERSANGKUTAN
						# - 
						$Col[47] = ItemKurangKibF($mG,$sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
						$Col[48] = HargKurangKibF($sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
						# +
						$Col[49] = ItemTambahKibF($mG,$sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
						$Col[50] = HargTambahKibF($sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
					}
					else{
						if ($LoadMutasi=="Y"){
							#RUSAK BERAT
							$mMS="RB";
							# -
							$Col[7]  = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[8]  = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[9]  = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[10] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
						
							#MUTASI SKPD
							$mMS="MS";
							# -
							$Col[11] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[12] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[13] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[14] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
						
							#MUJTASI KIB
							$mMS="MK";
							# - 
							$Col[15] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[16] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[17] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[18] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#LELANG
							$mMS="LE";
							# - 
							$Col[19] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[20] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[21] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[22] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#HIBAH
							$mMS="HB";
							# - 
							$Col[23] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[24] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[25] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[26] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#RENOVASI
							$mMS="AR";
							# - 
							$Col[27] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[28] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[29] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[30] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#DOBEL CATAT / KOREKSI
							$mMS="KR";
							# - 
							$Col[31] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[32] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[33] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[34] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#DALAM PENELUSURAN
							$mMS="PL";
							# - 
							$Col[35] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[36] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[37] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[38] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#HILANG
							$mMS="HL";
							# - 
							$Col[39] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[40] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[41] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[42] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#PENGHAPUSAN
							$mMS="PH";
							# - 
							$Col[43] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[44] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[45] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[46] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#TAHUN BERSANGKUTAN
							# - 
							$Col[47] = 0;
							$Col[48] = 0;
							# +
							$Col[49] = ItemTambahThnN($mG,$sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
							$Col[50] = HargTambahThnN($sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
						}
					}
					################
				
					//BERKURANG
					if (fNmHuruf($mG)=="f"){
						$rKRG   = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb:KdpToAset".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL.":Y","LIKE:>=:<=:LIKE:=".$oPr,"","");
						$vKRG   = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_UPB:KdpToAset".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL.":Y","LIKE:>=:<=:LIKE:=".$oPr,"","");
					}
					else{
						#item
						$rKRG   = 0;
						if ($LoadMutasi=="Y"){$rKRG   = $rKRG + fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb",$KdAsT."%:".$nThn."-%-%".":".$mUpb,"LIKE:LIKE:LIKE","","");}
						#nilai
						$vKRG   = fGlobal("IfNull(sum(Kredit),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_Upb".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						if ($LoadMutasi=="Y"){$vKRG   = $vKRG + fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");}
					}
					$Col[51] = $rKRG;
					$Col[52] = $vKRG;
					
					//BERTAMBAH
					if (fNmHuruf($mG)=="f"){
						$rTMB   = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						$vTMB   = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
					}
					else{
						#item
						$rTMB = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						if ($LoadMutasi=="Y"){$rTMB = $rTMB + fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");}
						#nilai
						$vTMB = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_Upb".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						if ($LoadMutasi=="Y"){$vTMB = $vTMB + fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");}
					}
					$Col[53] = $rTMB;
					$Col[54] = $vTMB;
					
					$rAKH    = $rAWL - $rKRG + $rTMB;
					$vAKH    = $vAWL - $vKRG + $vTMB;
					$Col[55] = $rAKH;
					$Col[56] = $vAKH;
					
					$Col[57] = "";
					
					if (($Col[5]!=0 || $Col[6]!=0 || $Col[51]!=0 || $Col[52]!=0 || $Col[53]!=0 || $Col[54]!=0 || $Col[55]!=0 || $Col[56]!=0) && substr($KdAsT,0,2)!="07") {
						ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],$Col[19],$Col[20],$Col[21],$Col[22],$Col[23],$Col[24],$Col[25],$Col[26],$Col[27],$Col[28],$Col[29],$Col[30],$Col[31],$Col[32],$Col[33],$Col[34],$Col[35],$Col[36],$Col[37],$Col[38],$Col[39],$Col[40],$Col[41],$Col[42],$Col[43],$Col[44],$Col[45],$Col[46],$Col[47],$Col[48],$Col[49],$Col[50],$Col[51],$Col[52],$Col[53],$Col[54],$Col[55],$Col[56],$Col[57],"",$xB);
						if ($rPil==4) {ViewRciObjek($KdAsT,$mUpb,$mThn,$nThn,$mG,$LoadMutasi);}
					}
					$iGD++;
				}
			}
			
			function ViewRciObjek($KdRCI,$mUpb,$mThn,$nThn,$mG,$LoadMutasi)
			{
				$nSQE = "SELECT P1.Kd_Aset, P2.Nm_Aset 
				FROM ref_rek_aset108_7_temp P1 
				JOIN ref_rek_aset108_7 P2 ON P2.Kd_Aset=P1.Kd_Aset 
				WHERE P1.Kd_Aset LIKE '".$KdRCI.".%' AND Kd_Unit = '".substr($mUpb,0,11)."' GROUP BY P1.Kd_Aset";
				#echo $nSQE."<br>";
				$nRsE = mysql_query($nSQE) or die(mysql_error());
				while ($mRoE = mysql_fetch_array($nRsE, MYSQL_BOTH))
				{
					$xB = "";
					ClrVr();
					$KdAsT  = $mRoE['Kd_Aset'];
					$Col[1] = "";
					$Col[2] = "";
					$Col[3] = substr($mRoE['Kd_Aset'],3,12);
					$Col[4] = $mRoE['Nm_Aset'];
					
					if (substr($KdAsT,0,2)=="02" || substr($KdAsT,0,2)=="03")
					{
						$sYt = ":extracom";
						#$nIL = ":N";
						#$oPr = ":=";
						$nIL = ":%";
						$oPr = ":LIKE";
					}
					else{
						$sYt = "";
						$nIL = "";
						$oPr = "";
					}
					
					//KEADAAN AWAL (record)
					$rAWL = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Kd_UPB".$sYt,$KdAsT."%:".$mThn."-12-31:".$mUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
					if ($LoadMutasi=="Y"){
						if (fNmHuruf($mG)!="f") {
							#Mutasi keluar
							$rAWL = $rAWL + fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
							#Mutasi masuk
							$rAWL = $rAWL - fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
						}
					}
					
					//KEADAAN AWAL (nilai)
					$vNIa = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$mThn."-12-31:".$mUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
					$vNIb = fGlobal("IfNull(sum(Kredit),0)","ta_kib_post_108","Kd_Aset:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$mThn."-12-31:".$mUpb.$nIL,"LIKE:<=:LIKE".$oPr,"","");
					$vAWL = $vNIa - $vNIb;
					if ($LoadMutasi=="Y"){
						#Mutasi keluar
						$vAWL = $vAWL + fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
						#Mutasi masuk
						$vAWL = $vAWL - fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");
					}
					
					$Col[5] = $rAWL;
					$Col[6] = $vAWL;
					
					################
					if (fNmHuruf($mG)=="f"){
						#TAHUN BERSANGKUTAN
						# - 
						$Col[47] = ItemKurangKibF($mG,$sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
						$Col[48] = HargKurangKibF($sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
						# +
						$Col[49] = ItemTambahKibF($mG,$sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
						$Col[50] = HargTambahKibF($sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
					}
					else{
						if ($LoadMutasi=="Y"){
							#RUSAK BERAT
							$mMS="RB";
							# -
							$Col[7]  = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[8]  = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[9]  = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[10] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
						
							#MUTASI SKPD
							$mMS="MS";
							# -
							$Col[11] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[12] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[13] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[14] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
						
							#MUJTASI KIB
							$mMS="MK";
							# - 
							$Col[15] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[16] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[17] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[18] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#LELANG
							$mMS="LE";
							# - 
							$Col[19] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[20] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[21] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[22] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#HIBAH
							$mMS="HB";
							# - 
							$Col[23] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[24] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[25] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[26] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#RENOVASI
							$mMS="AR";
							# - 
							$Col[27] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[28] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[29] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[30] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#DOBEL CATAT / KOREKSI
							$mMS="KR";
							# - 
							$Col[31] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[32] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[33] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[34] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#DALAM PENELUSURAN
							$mMS="PL";
							# - 
							$Col[35] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[36] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[37] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[38] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#HILANG
							$mMS="HL";
							# - 
							$Col[39] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[40] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[41] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[42] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#PENGHAPUSAN
							$mMS="PH";
							# - 
							$Col[43] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[44] = HargKurang($KdAsT,$nThn,$mUpb,$mMS,"");
							# +
							$Col[45] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,"");
							$Col[46] = HargTambah($KdAsT,$nThn,$mUpb,$mMS,"");
							
							#TAHUN BERSANGKUTAN
							# - 
							$Col[47] = 0;
							$Col[48] = 0;
							# +
							$Col[49] = ItemTambahThnN($mG,$sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
							$Col[50] = HargTambahThnN($sYt,$KdAsT,$nThn,$mUpb,$nIL,$oPr,"");
						}
					}
					################
				
					//BERKURANG
					if (fNmHuruf($mG)=="f"){
						$rKRG   = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb:KdpToAset".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL.":Y","LIKE:>=:<=:LIKE:=".$oPr,"","");
						$vKRG   = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_UPB:KdpToAset".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL.":Y","LIKE:>=:<=:LIKE:=".$oPr,"","");
					}
					else{
						#item
						$rKRG   = 0;
						if ($LoadMutasi=="Y"){$rKRG   = $rKRG + fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb",$KdAsT."%:".$nThn."-%-%".":".$mUpb,"LIKE:LIKE:LIKE","","");}
						#nilai
						$vKRG   = fGlobal("IfNull(sum(Kredit),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_Upb".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						if ($LoadMutasi=="Y"){$vKRG   = $vKRG + fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");}
					}
					$Col[51] = $rKRG;
					$Col[52] = $vKRG;
					
					//BERTAMBAH
					if (fNmHuruf($mG)=="f"){
						$rTMB   = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						$vTMB   = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_UPB".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
					}
					else{
						#item
						$rTMB = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						if ($LoadMutasi=="Y"){$rTMB = $rTMB + fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");}
						#nilai
						$vTMB = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_Upb".$sYt,$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb.$nIL,"LIKE:>=:<=:LIKE".$oPr,"","");
						if ($LoadMutasi=="Y"){$vTMB = $vTMB + fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To",$KdAsT."%:".$nThn."-%-%:".$mUpb,"LIKE:LIKE:LIKE","","");}
					}
					$Col[53] = $rTMB;
					$Col[54] = $vTMB;
					
					$rAKH    = $rAWL - $rKRG + $rTMB;
					$vAKH    = $vAWL - $vKRG + $vTMB;
					$Col[55] = $rAKH;
					$Col[56] = $vAKH;
					
					$Col[57] = "";
					
					#if ($Col[5]!=0 || $Col[6]!=0 || $Col[51]!=0 || $Col[52]!=0 || $Col[53]!=0 || $Col[54]!=0 || $Col[55]!=0 || $Col[56]!=0) {
					#$tiZ=0;
					#for ($iZ=5; $iZ<=56; $iZ++){
					#	$tiZ = $tiZ+$Col[$iZ];
					#}
					
					#if ($tiZ!=0){
						ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],$Col[19],$Col[20],$Col[21],$Col[22],$Col[23],$Col[24],$Col[25],$Col[26],$Col[27],$Col[28],$Col[29],$Col[30],$Col[31],$Col[32],$Col[33],$Col[34],$Col[35],$Col[36],$Col[37],$Col[38],$Col[39],$Col[40],$Col[41],$Col[42],$Col[43],$Col[44],$Col[45],$Col[46],$Col[47],$Col[48],$Col[49],$Col[50],$Col[51],$Col[52],$Col[53],$Col[54],$Col[55],$Col[56],$Col[57],"",$xB);
					#}
					$iGE++;
				}
			}
			?>
        <?php function ViewRincian($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18,$x19,$x20,$x21,$x22,$x23,$x24,$x25,$x26,$x27,$x28,$x29,$x30,$x31,$x32,$x33,$x34,$x35,$x36,$x37,$x38,$x39,$x40,$x41,$x42,$x43,$x44,$x45,$x46,$x47,$x48,$x49,$x50,$x51,$x52,$x53,$x54,$x55,$x56,$x57,$xR,$xB) {?>
        <tr <?=$xR?>>
          <td height="22" align="center"><?=$xB.$x1?></td>
          <td align="center"><?=$xB.$x2?></td>
          <td align="left"><?=$xB.$x3?></td>
          <td><?=$xB.$x4?></td>
          <td align="center"><?=$xB.echoVal($x5,"N")?></td>
          <td align="right"><?=$xB.echoVal($x6,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x7,"N")?></td>
          <td align="right"><?=$xB.echoVal($x8,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x9,"N")?></td>
          <td align="right"><?=$xB.echoVal($x10,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x11,"N")?></td>
          <td align="right"><?=$xB.echoVal($x12,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x13,"N")?></td>
          <td align="right"><?=$xB.echoVal($x14,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x15,"N")?></td>
          <td align="right"><?=$xB.echoVal($x16,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x17,"N")?></td>
          <td align="right"><?=$xB.echoVal($x18,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x19,"N")?></td>
          <td align="right"><?=$xB.echoVal($x20,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x21,"N")?></td>
          <td align="right"><?=$xB.echoVal($x22,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x23,"N")?></td>
          <td align="right"><?=$xB.echoVal($x24,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x25,"N")?></td>
          <td align="right"><?=$xB.echoVal($x26,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x27,"N")?></td>
          <td align="right"><?=$xB.echoVal($x28,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x29,"N")?></td>
          <td align="right"><?=$xB.echoVal($x30,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x31,"N")?></td>
          <td align="right"><?=$xB.echoVal($x32,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x33,"N")?></td>
          <td align="right"><?=$xB.echoVal($x34,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x35,"N")?></td>
          <td align="right"><?=$xB.echoVal($x36,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x37,"N")?></td>
          <td align="right"><?=$xB.echoVal($x38,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x39,"N")?></td>
          <td align="right"><?=$xB.echoVal($x40,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x41,"N")?></td>
          <td align="right"><?=$xB.echoVal($x42,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x43,"N")?></td>
          <td align="right"><?=$xB.echoVal($x44,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x45,"N")?></td>
          <td align="right"><?=$xB.echoVal($x46,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x47,"N")?></td>
          <td align="right"><?=$xB.echoVal($x48,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x49,"N")?></td>
          <td align="right"><?=$xB.echoVal($x50,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x51,"N")?></td>
          <td align="right"><?=$xB.echoVal($x52,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x53,"N")?></td>
          <td align="right"><?=$xB.echoVal($x54,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x55,"N")?></td>
          <td align="right"><?=$xB.echoVal($x56,"Y")?></td>
          <td><?=$x57?></td>
        </tr>
        <?php } ?>
        <?php function ViewBlank() {?>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <?php } ?>
        <tr height="30">
          <td colspan="4" align="center" style="font-weight:bold; border-top: 3px double #000000">Jumlah</td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?php if ($fAWL!=0) {echo fConvertToRupiahBulat($fAWL);}?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?php if ($tAWL!=0) {echo fConvertToRupiah($tAWL);}?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[7],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[8],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[9],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[10],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[11],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[12],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[13],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[14],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[15],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[16],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[17],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[18],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[19],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[20],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[21],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[22],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[23],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[24],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[25],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[26],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[27],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[28],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[29],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[30],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[31],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[32],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[33],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[34],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[35],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[36],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[37],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[38],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[39],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[40],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[41],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[42],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[43],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[44],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[45],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[46],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[47],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[48],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[49],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[50],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($fKRG,"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tKRG,"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($fTMB,"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tTMB,"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($fAKH,"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tAKH,"Y")?></td>
          <td style="font-weight:bold; border-top: 3px double #000000">&nbsp;</td>
        </tr>
      </table></td>
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
<?php
function echoVal($xVR,$xCR)
{
	if ($xVR!=0) {
		if ($xCR=="Y"){
			return fConvertToRupiah($xVR);
		}
		else{
			return fConvertToRupiahBulat($xVR);
		}
	}
	else {
		return "-";
	}
}

function ItemKurang($iGR,$KdAsTR,$ThnR,$gUpbR,$mMSR,$LoD)
{
	return fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iGR)."_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb:Jns_Mutasi",$KdAsTR."%:".$ThnR."-%-%".":".$gUpbR.":".$mMSR,"LIKE:LIKE:LIKE:=","",$LoD);
}

function ItemTambah($iGR,$KdAsTR,$ThnR,$gUpbR,$mMSR,$LoD)
{
	if ($mMSR=="MK"){
		return fGlobal("IfNull(count(*),0)", "ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi:Crit",$KdAsTR."%:".$ThnR."-%-%:".$gUpbR.":".$mMSR.":SLD","LIKE:LIKE:LIKE:=:=","",$LoD);
	}
	else{
		return fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iGR)."_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsTR."%:".$ThnR."-%-%:".$gUpbR.":".$mMSR,"LIKE:LIKE:LIKE:=","",$LoD);
	}
}


function HargKurang($KdAsTR,$ThnR,$gUpbR,$mMSR,$LoD)
{
	return fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB:Jns_Mutasi",$KdAsTR."%:".$ThnR."-%-%:".$gUpbR.":".$mMSR,"LIKE:LIKE:LIKE:=","",$LoD);
}

function HargTambah($KdAsTR,$ThnR,$gUpbR,$mMSR,$LoD)
{
	return fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi",$KdAsTR."%:".$ThnR."-%-%:".$gUpbR.":".$mMSR,"LIKE:LIKE:LIKE:=","",$LoD);
}


function ItemKurangKibF($iGR,$sYtR,$KdAsTR,$ThnR,$gUpbR,$nILR,$oPrR,$LoD)
{
	return fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iGR),"Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb:KdpToAset".$sYtR,$KdAsTR."%:".$ThnR."-01-01".":".$ThnR."-12-31:".$gUpbR.$nILR.":Y","LIKE:>=:<=:LIKE:=".$oPrR,"",$LoD);
}

function HargKurangKibF($sYtR,$KdAsTR,$ThnR,$gUpbR,$nILR,$oPrR,$LoD)
{
	return fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_Upb:KdpToAset".$sYtR,$KdAsTR."%:".$ThnR."-01-01".":".$ThnR."-12-31:".$gUpbR.$nILR.":Y","LIKE:>=:<=:LIKE:=".$oPrR,"",$LoD);
}


function ItemTambahKibF($iGR,$sYtR,$KdAsTR,$ThnR,$gUpbR,$nILR,$oPrR,$LoD)
{
	return fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iGR),"Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb".$sYtR,$KdAsTR."%:".$ThnR."-01-01".":".$ThnR."-12-31:".$gUpbR.$nILR,"LIKE:>=:<=:LIKE".$oPrR,"",$LoD);
}

function HargTambahKibF($sYtR,$KdAsTR,$ThnR,$gUpbR,$nILR,$oPrR,$LoD)
{
	return fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_Upb".$sYtR,$KdAsTR."%:".$ThnR."-01-01".":".$ThnR."-12-31:".$gUpbR.$nILR,"LIKE:>=:<=:LIKE".$oPrR,"",$LoD);
}


function ItemTambahThnN($iGR,$sYtR,$KdAsTR,$ThnR,$gUpbR,$nILR,$oPrR,$LoD)
{
	return fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iGR),"Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb".$sYtR,$KdAsTR."%:".$ThnR."-01-01".":".$ThnR."-12-31:".$gUpbR.$nILR,"LIKE:>=:<=:LIKE".$oPrR,"",$LoD);
}

function HargTambahThnN($sYtR,$KdAsTR,$ThnR,$gUpbR,$nILR,$oPrR,$LoD)
{
	return fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset:Tanggal:Tanggal:Kd_Upb".$sYRt,$KdAsTR."%:".$ThnR."-01-01".":".$ThnR."-12-31:".$gUpbR.$nILR,"LIKE:>=:<=:LIKE".$oPrR,"",$LoD);
}
?>
