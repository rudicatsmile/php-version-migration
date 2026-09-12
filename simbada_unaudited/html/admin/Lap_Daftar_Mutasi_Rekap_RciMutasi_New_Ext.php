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
#echo $UID;
#return false;
$rPil = (int)$rPil;
$gUnt= $gUnt;
$gSub= $gSub;
$gUpb= $gUpb;

require ("Lap_Include.php");
$gUpb= $gUnt;	//ambil defaul upb ke unit, karena kd upb di ta_kib tidak merata. di Lap_Include.php kd upb like 'XX.XX.XX.XX.__.____'

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

############
$SQ="DELETE FROM ref_rek_aset5_temp WHERE Kd_Unit='$gUnt'";
$nR= mysql_query($SQ);

$wSQL="DELETE FROM ta_kib_post_saldo_mutasi WHERE Kd_Unit='".$gUnt."' AND Tahun='".$Thn_B."'";
$nRW = mysql_query($wSQL);
############

$nSQL= "SELECT Kd_Aset FROM ta_kib_post WHERE Kd_UPB LIKE '$gUnt%' GROUP BY Kd_Aset";
$nRs = mysql_query($nSQL);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$tID = fGlobal("IDT","ref_rek_aset5_temp","Kd_Aset:Kd_Unit",$mRo[0].":".$gUnt,"=:=","","");
	if ($tID==""){
		$SQ="INSERT INTO ref_rek_aset5_temp SET Kd_Unit='$gUnt', Kd_Aset='".$mRo[0]."'";
		$nR= mysql_query($SQ);
	}
	
	$rCeK = fGlobal("IDT","ta_kib_post_saldo_mutasi","Kd_Unit:Kd_Aset:Tahun",$gUnt.":".$mRo[0].":".$Thn_B,"=:=:=","","");	
	if ($rCeK=="")
	{
		$wSQL="INSERT INTO ta_kib_post_saldo_mutasi SET Kd_Unit='".$gUnt."', Kd_Aset='".$mRo[0]."', Tahun='".$Thn_B."', unitAkhir='0', saldoAkhir='0'";
		$nRW = mysql_query($wSQL);
	}
}

$nSQL= "SELECT Kd_Aset FROM ta_kib_post_mutasi WHERE Kd_UPB LIKE '$gUnt%' GROUP BY Kd_Aset ORDER BY Kd_Aset";
$nRs = mysql_query($nSQL);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$tID = fGlobal("IDT","ref_rek_aset5_temp","Kd_Aset:Kd_Unit",$mRo[0].":".$gUnt,"=:=","","");
	if ($tID==""){
		$SQ="INSERT INTO ref_rek_aset5_temp SET Kd_Unit='$gUnt', Kd_Aset='".$mRo[0]."'";
		$nR= mysql_query($SQ);
	}
	
	$rCeK = fGlobal("IDT","ta_kib_post_saldo_mutasi","Kd_Unit:Kd_Aset:Tahun",$gUnt.":".$mRo[0].":".$Thn_B,"=:=:=","","");	
	if ($rCeK=="")
	{
		$wSQL="INSERT INTO ta_kib_post_saldo_mutasi SET Kd_Unit='".$gUnt."', Kd_Aset='".$mRo[0]."', Tahun='".$Thn_B."', unitAkhir='0', saldoAkhir='0'";
		$nRW = mysql_query($wSQL);
	}
}

/*
$nSQL= "SELECT Kd_Aset_To FROM ta_kib_post_mutasi WHERE Kd_UPB_To LIKE '$gUnt%' GROUP BY Kd_Aset_To ORDER BY Kd_Aset_To";
$nRs = mysql_query($nSQL);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$tID = fGlobal("IDT","ref_rek_aset5_temp","Kd_Aset:Kd_Unit",$mRo[0].":".$gUnt,"=:=","","");
	if ($tID==""){
		$SQ="INSERT INTO ref_rek_aset5_temp SET Kd_Unit='$gUnt', Kd_Aset='".$mRo[0]."'";
		$nR= mysql_query($SQ);
	}
	
	$rCeK = fGlobal("IDT","ta_kib_post_saldo_mutasi","Kd_Unit:Kd_Aset:Tahun",$gUnt.":".$mRo[0].":".$Thn_B,"=:=:=","","");	
	if ($rCeK=="")
	{
		$wSQL="INSERT INTO ta_kib_post_saldo_mutasi SET Kd_Unit='".$gUnt."', Kd_Aset='".$mRo[0]."', Tahun='".$Thn_B."', unitAkhir='0', saldoAkhir='0'";
		$nRW = mysql_query($wSQL);
	}
}
*/
$nSQL= "SELECT Kd_Aset FROM ta_kib_post_saldo_mutasi GROUP BY Kd_Aset";
$nRs = mysql_query($nSQL);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$rCeK = fGlobal("IDT","ref_rek_aset5","Kd_Aset",$mRo[0],"=","","");	
	if (!$rCeK){
		$wSQL="INSERT INTO ref_rek_aset5 SET Kd_Aset='".$mRo[0]."', Nm_Aset='..........????????'";
		$nRW = mysql_query($wSQL);
	}
}

#Jalankan Repair
$RepairMelaluiDokRekapMutasi="YA";
?>
<body>
<table border="0" align="center" width="4000" cellspacing="1" style="font-family: Calibri; font-size: 8pt; border-collapse: collapse" id="table1">
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
			<td width="85">SKPD</td>
			<td width="31">:</td>
			<td width="74"><? if ($xUnt!="") {echo $xUnt;}?></td>
			<td width="3797"><? if ($xUnt=="") {echo "<i>SEMUA</i>";} else {echo strtoupper(fGlobal("Nm_Unit","Ref_Unit","Kd_Unit",$xUnt,"=","",""));}?></td>
		  </tr>
		<!--tr>
			<td width="75">SUB UNIT </td>
			<td width="23">:</td>
			<td><? if ($xSub=="") {echo "<i>SEMUA</i>";} else {echo strtoupper(fGlobal("Nm_Sub","Ref_Sub_Unit","Kd_Sub",$xSub,"=","",""));}?></td>
			<td width="1197">&nbsp;</td>
		</tr>
		<tr>
			<td width="75">UPB</td>
			<td width="23">:</td>
			<td><? if ($xUpb=="") {echo "<i>SEMUA</i>";} else {echo strtoupper(fGlobal("Nm_Upb","Ref_Upb","Kd_Upb",$xUpb,"=","",""));}?></td>
			<td width="1197">&nbsp;</td>
		</tr-->
		<tr>
			<td width="85"><?=$TiDaer?></td>
			<td width="31">:</td>
			<td colspan="2"><?=$NmDaer?></td>
		  </tr>
		<tr>
			<td width="85">TAHUN</td>
			<td width="31">:</td>
			<td colspan="2"><?=$Thn_B?></td>
		  </tr>
		</table>		</td>
	</tr>
	<tr>
	  <td>
	  <table border="1" width="4000" cellspacing="1" style="font-family: arial; font-size: 8pt; border-collapse: collapse" bordercolor="#000000">
        <tr>
          <td rowspan="4" align="center" style="font-weight: bold">NO.</td>
          <td rowspan="4" align="center" style="font-weight: bold">GOL</td>
          <td rowspan="4" align="center" style="font-weight: bold">KODE</td>
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
          <td rowspan="3" align="center" style="font-weight: bold">UNIT</td>
          <td rowspan="3" align="center" style="font-weight: bold">NILAI</td>
          <td colspan="4" align="center" style="font-weight: bold; background:#F2FBA8">RUSAK BERAT </td>
          <td colspan="4" align="center" style="font-weight: bold">MUTASI SKPD </td>
          <td colspan="4" align="center" style="font-weight: bold; background:#F2FBA8">MUTASI KIB </td>
          <td colspan="4" align="center" style="font-weight: bold">LELANG</td>
          <td colspan="4" align="center" style="font-weight: bold; background:#F2FBA8">HIBAH</td>
          <td colspan="4" align="center" style="font-weight: bold">RENOVASI</td>
          <td colspan="4" align="center" style="font-weight: bold; background:#F1DCC3">KOREKSI (DOBEL CATAT) </td>
          <td colspan="4" align="center" style="font-weight: bold">DALAM PENELUSURAN </td>
          <td colspan="4" align="center" style="font-weight: bold; background:#F1DCC3">HILANG</td>
          <td colspan="4" align="center" style="font-weight: bold">PENGHAPUSAN</td>
          <td colspan="4" align="center" style="font-weight: bold; background:#F1DCC3">PENGADAAN TAHUN <?=$Thn_B?></td>
          <td colspan="2" rowspan="2" align="center" style="font-weight: bold">TOTAL BERKURANG </td>
          <td colspan="2" rowspan="2" align="center" style="font-weight: bold">TOTAL BERTAMBAH</td>
          <td rowspan="3" align="center" style="font-weight: bold">UNIT</td>
          <td rowspan="3" align="center" style="font-weight: bold">NILAI</td>
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
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
          <td align="center" style="font-weight: normal">Unit</td>
          <td align="center" style="font-weight: normal">Nilai</td>
        </tr>
        <tr>
          <td width="23" style="font-weight: bold; border-bottom: 3px double #000000" align="center">1</td>
          <td width="29" style="font-weight: bold; border-bottom: 3px double #000000" align="center">2</td>
          <td width="85" style="font-weight: bold; border-bottom: 3px double #000000" align="center">3</td>
          <td align="center" style="font-weight: bold; border-bottom: 3px double #000000">4</td>
          <td width="40" style="font-weight: bold; border-bottom: 3px double #000000" align="center">5</td>
          <td width="100" align="center" style="font-weight: bold; border-bottom: 3px double #000000">6</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">7</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">8</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">9</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">10</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">11</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">12</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">13</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">14</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">15</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">16</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">17</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">18</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">19</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">20</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">21</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">22</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">23</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">24</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">25</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">26</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">27</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">28</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">29</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">30</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">31</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">32</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">33</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">34</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">35</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">36</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">37</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">38</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">39</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">40</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">41</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">42</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">43</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">44</td>
          <td width="52" align="center" style="font-weight: bold; border-bottom: 3px double #000000">45</td>
          <td width="80" align="center" style="font-weight: bold; border-bottom: 3px double #000000">46</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">47</td>
          <td width="100" align="center" style="font-weight: bold; border-bottom: 3px double #000000">48</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">49</td>
          <td width="100" align="center" style="font-weight: bold; border-bottom: 3px double #000000">50</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">51</td>
          <td width="100" align="center" style="font-weight: bold; border-bottom: 3px double #000000">52</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">53</td>
          <td width="100" align="center" style="font-weight: bold; border-bottom: 3px double #000000">54</td>
          <td width="40" align="center" style="font-weight: bold; border-bottom: 3px double #000000">55</td>
          <td width="100" align="center" style="font-weight: bold; border-bottom: 3px double #000000">56</td>
          <td width="150" align="center" style="font-weight: bold; border-bottom: 3px double #000000">57</td>
        </tr>
        <?
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
			
			for ($iR=5; $iR<=56; $iR++)
			{
				$tCol[$iR] = 0;
			}
				
			$LoadMutasi="Y";
			$LoadExtrac="N";
			include "Lap_Daftar_Mutasi_Rekap_RciMutasi_New_Bidang_Ext.php";
			include "Lap_Daftar_Mutasi_Rekap_RciMutasi_New_Jenis_Ext.php";
			include "Lap_Daftar_Mutasi_Rekap_RciMutasi_New_Objek_Ext.php";
			include "Lap_Daftar_Mutasi_Rekap_RciMutasi_New_Rinci_Ext.php";
			
			$nSQL= "SELECT * FROM ref_rek_aset1 ORDER BY Kd_Aset";	#*#
			$nRs = mysql_query($nSQL) or die(mysql_error());
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				if ($iG > 1) {echo ViewBlank();}
				$xB = "<b>";
				$xR = " style='background:#DFEBD9'";
				
				for($rG=1; $rG<=57; $rG++)
				{
					if ($rG>=5 && $rG<=56) {
						$Col[$rG]=0;
					}
					else {
						$Col[$rG]="";
					}
				}
				
				$KdAsT  = $mRo['Kd_Aset'];
				$Col[1] = $iG.".";
				$Col[2] = substr($mRo['Kd_Aset'],0,2);
				$Col[3] = $mRo['Kd_Aset'];
				$Col[4] = strtoupper($mRo['Nm_Aset']);
				$WAsT = substr($KdAsT,0,2);
				
				//AWAL
				if (fNmHuruf($iG)=="f"){
					if ($nThn<=2016) {
						$Col[5] = fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iG),"Kd_Aset:Kd_Upb:KdpToAset:Tgl_Perolehan",$KdAsT."%:".$gUpb."%:N:".$Thn_A."-12-31","LIKE:LIKE:=:<=","","");
						$Col[6] = round(fGlobal("IfNull(sum(Debet),0)", "ta_kib_post","Kd_Aset:Kd_UPB:KdpToAset:Tanggal",$KdAsT."%:".$gUpb."%:N:".$Thn_A."-12-31","LIKE:LIKE:=:<=","",""),2);
					}
					else{
						$Col[5] = fGlobal("IfNull(sum(unitAkhir),0)", "ta_kib_post_saldo_mutasi","Kd_Unit:Kd_Aset:Tahun",$gUpb.":".$KdAsT.":".$Thn_A,"=:=:=","","");
						$Col[6]  = fGlobal("IfNull(sum(saldoAkhir),0)", "ta_kib_post_saldo_mutasi","Kd_Unit:Kd_Aset:Tahun",$gUpb.":".$KdAsT.":".$Thn_A,"=:=:=","","");
					}
				}
				else{
					if ($Thn_B<=2016) {
						$Col[5] = fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iG),"Kd_Aset:Tgl_Perolehan:Tgl_Mutasi:Kd_UPB:extracom",$KdAsT."%:".$Thn_A."-12-31:".$Thn_A."-12-31:".$gUpb."%:".$LoadExtrac,"LIKE:<=:<=:LIKE:LIKE","","");
						$Col[5] = $Col[5] + fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iG)."_mutasi","Kd_Aset:Tgl_Perolehan:Tgl_Mutasi:Tgl_Mutasi:Kd_UPB:extracom",$KdAsT."%:".$Thn_A."-12-31:".$Thn_B."-01-01:".($Thn_B+1)."-12-31:".$gUpb."%:".$LoadExtrac,"LIKE:<=:>=:<=:LIKE:LIKE","","");
						
						$Col[6]  = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post","Kd_Aset:Tanggal:Tgl_Mutasi:Kd_UPB:extracom",$KdAsT."%:".$Thn_A."-12-31:".$Thn_A."-12-31:".$gUpb."%:".$LoadExtrac,"LIKE:<=:<=:LIKE:LIKE","","");
						$Col[6]  = $Col[6] + fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_mutasi","Kd_Aset:Tanggal:Tgl_Mutasi:Tgl_Mutasi:Kd_UPB:extracom",$KdAsT."%:".$Thn_A."-12-31:".$Thn_B."-01-01:".($Thn_B+1)."-12-31:".$gUpb."%:".$LoadExtrac,"LIKE:<=:>=:<=:LIKE:LIKE","","");
					}
					else{
						$Col[5] = fGlobal("IfNull(sum(unitAkhir),0)","ta_kib_post_saldo_mutasi","Kd_Unit:Kd_Aset:Tahun",$gUpb.":".$KdAsT."%:".$Thn_A,"=:LIKE:=","","");
						$Col[6]  = fGlobal("IfNull(sum(saldoAkhir),0)","ta_kib_post_saldo_mutasi","Kd_Unit:Kd_Aset:Tahun",$gUpb.":".$KdAsT."%:".$Thn_A,"=:LIKE:=","","");
					}
				}
				
				#TAHUN BERSANGKUTAN
				if (fNmHuruf($iG)=="f"){
					# - 
					$Col[47] = ItemKurangKibF($iG,$KdAsT,$Thn_B,$gUpb,$LoadExtrac,"");
					$Col[48] = HargKurangKibF($KdAsT,$Thn_B,$gUpb,$LoadExtrac,"");
					# +
					$Col[49] = ItemTambahKibF($iG,$KdAsT,$Thn_B,$gUpb,$LoadExtrac,"");
					$Col[50] = HargTambahKibF($KdAsT,$Thn_B,$gUpb,$LoadExtrac,"");
				}
				else{
					if ($LoadMutasi=="Y"){
						#RUSAK BERAT
						$mMS="RB";
						# -
						$Col[7]  = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[8]  = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						# +
						$Col[9]  = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[10] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
					
						#MUTASI SKPD
						$mMS="MS";
						# -
						$Col[11] = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[12] = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						# +
						$Col[13] = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[14] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
					
						#MUJTASI KIB
						$mMS="MK";
						# - 
						$Col[15] = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[16] = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						# +	
						$Col[17] = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[18] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						
						#LELANG
						$mMS="LE";
						# - 
						$Col[19] = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[20] = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						# +
						$Col[21] = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[22] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						
						#HIBAH
						$mMS="HB";
						# - 
						$Col[23] = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[24] = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						# +
						$Col[25] = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[26] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						
						#RENOVASI
						$mMS="AR";
						# - 
						$Col[27] = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[28] = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						# +
						$Col[29] = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[30] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						
						#DOBEL CATAT / KOREKSI
						$mMS="KR";
						# - 
						$Col[31] = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[32] = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						# +
						$Col[33] = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[34] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						
						#DALAM PENELUSURAN
						$mMS="PL";
						# - 
						$Col[35] = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[36] = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						# +
						$Col[37] = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[38] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						
						#HILANG
						$mMS="HL";
						# - 
						$Col[39] = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[40] = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						# +
						$Col[41] = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[42] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						
						#PENGHAPUSAN
						$mMS="PH";
						# - 
						$Col[43] = ItemKurang($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[44] = HargKurang($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						# +
						$Col[45] = ItemTambah($iG,$KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						$Col[46] = HargTambah($KdAsT,$Thn_B,$gUpb,$mMS,$LoadExtrac,"");
						
						#TAHUN BERSANGKUTAN
						# - 
						$Col[47] = 0;
						$Col[48] = 0;
						# +
						$Col[49] = ItemTambahThnN($iG,$KdAsT,$Thn_B,$gUpb,$LoadExtrac,"");
						$Col[50] = HargTambahThnN($KdAsT,$Thn_B,$gUpb,$LoadExtrac,"");
					}
				}
				################
				
				//BERKURANG
				if (fNmHuruf($iG)=="f"){
					$Col[51] = fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iG),"Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb:KdpToAset",$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb."%:Y","LIKE:>=:<=:LIKE:=","","");
					$Col[52]  = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post","Kd_Aset:Tanggal:Tanggal:Kd_Upb:KdpToAset",$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb."%:Y","LIKE:>=:<=:LIKE:=","","");
				}
				else{
					$Col[51] = $Col[7] + $Col[11] + $Col[15] + $Col[19] + $Col[23] + $Col[27] + $Col[31] + $Col[35] + $Col[39] + $Col[43] + $Col[47];
					$Col[52] = $Col[8] + $Col[12] + $Col[16] + $Col[20] + $Col[24] + $Col[28] + $Col[32] + $Col[36] + $Col[40] + $Col[44] + $Col[48];
				}
				
				//BERTAMBAH
				if (fNmHuruf($iG)=="f"){
					$Col[53] = fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iG),"Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb",$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb."%","LIKE:>=:<=:LIKE","","");
					$Col[54] = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post","Kd_Aset:Tanggal:Tanggal:Kd_Upb",$KdAsT."%:".$Thn_B."-01-01".":".$Thn_B."-12-31:".$gUpb."%","LIKE:>=:<=:LIKE","","");
				}
				else{
					$Col[53] = $Col[9] + $Col[13] + $Col[17] + $Col[21] + $Col[25] + $Col[29] + $Col[33] + $Col[37] + $Col[41] + $Col[45] + $Col[49];
					$Col[54] = $Col[10] + $Col[14] + $Col[18] + $Col[22] + $Col[26] + $Col[30] + $Col[34] + $Col[38] + $Col[42] + $Col[46] + $Col[50];
				}
				
				//KEADAAN AKHIR
				$Col[55] = $Col[5] - $Col[51] + $Col[53];
				$Col[56] = $Col[6] - $Col[52] + $Col[54];
				$Col[57] = "";
				
				ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],$Col[19],$Col[20],$Col[21],$Col[22],$Col[23],$Col[24],$Col[25],$Col[26],$Col[27],$Col[28],$Col[29],$Col[30],$Col[31],$Col[32],$Col[33],$Col[34],$Col[35],$Col[36],$Col[37],$Col[38],$Col[39],$Col[40],$Col[41],$Col[42],$Col[43],$Col[44],$Col[45],$Col[46],$Col[47],$Col[48],$Col[49],$Col[50],$Col[51],$Col[52],$Col[53],$Col[54],$Col[55],$Col[56],$Col[57],$xR,$gUpb,$Thn_B,"","",$UID,$xB);
				
				if ((int)$rPil==5){
					ViewRciObjek($mRo['Kd_Aset'],$gUpb,$Thn_A,$Thn_B,$iG,$LoadMutasi,$UID,$LoadExtrac);
				}
				else{
					ViewBidang($mRo['Kd_Aset'],$gUpb,$Thn_A,$Thn_B,$iG,$LoadMutasi,$UID,$LoadExtrac,$rPil);
				}
				
				for ($iR=5; $iR<=56; $iR++)
				{
					$tCol[$iR] = $tCol[$iR] + $Col[$iR];
				}
					
				$iG++;
			}
			
			?>
        <? function ViewRincian($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18,$x19,$x20,$x21,$x22,$x23,$x24,$x25,$x26,$x27,$x28,$x29,$x30,$x31,$x32,$x33,$x34,$x35,$x36,$x37,$x38,$x39,$x40,$x41,$x42,$x43,$x44,$x45,$x46,$x47,$x48,$x49,$x50,$x51,$x52,$x53,$x54,$x55,$x56,$x57,$xR,$mUnt,$Thn,$Slh,$Wrn,$UID,$xB) {?>
        <tr <?=$xR?>>
          <td height="22" align="center"><?=$xB.$x1?></td>
          <td align="center"><?=$xB.$x2?></td>
          <td align="left" style="padding-left:3px"><?=$xB.$x3?></td>
          <td><a href="#" onClick="showDATA('<?=$mUnt?>','<?=$Thn?>','<?=$x3?>','<?=$IdL?>'); return false;" style="color:#000; text-decoration:none"><?=$xB.$x4?></a></td>
          <td align="center"><?=$xB.echoVal($x5,"N")?></td>
          <td align="right"><?=$xB.echoVal($x6,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x7,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x8,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x9,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x10,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x11,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x12,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x13,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x14,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x15,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x16,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x17,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x18,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x19,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x20,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x21,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x22,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x23,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x24,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x25,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x26,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x27,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x28,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x29,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x30,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x31,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x32,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x33,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x34,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x35,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x36,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x37,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x38,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x39,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x40,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x41,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x42,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x43,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x44,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x45,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x46,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x47,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x48,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x49,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x50,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x51,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x52,"Y")?></td>
          <td align="center" style="color:#000000"><?=$xB.echoVal($x53,"N")?></td>
          <td align="right" style="color:#000000"><?=$xB.echoVal($x54,"Y")?></td>
          <td align="center"><?=$xB.echoVal($x55,"N")?></td>
          <td align="right" style="font-weight:normal <?=$Wrn?>" title="<?=$Slh?>"><?=$xB.echoVal($x56,"Y")?></td>
          <td><? if ($Slh!=0 && $UID=="creator"){echo "selisih ".$Slh;}?><?=$x57?></td>
        </tr>
        <? } ?>
        <? function ViewBlank() {?>
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
        <? } ?>
		<?
		function PilihWarna($rA,$rB)
		{
			$rA = round($rA,2);
			$rB = round($rB,2);
			$WrN = "";
			if ($rA > $rB){
				$WrN = "; color:#ff0000";
			}
			else if ($rA < $rB){
				$WrN = "; color:#0000ff";
			}
			return $WrN;
		}
		$Wr07 = PilihWarna($tCol[7],$tCol[9]);
		$Wr08 = PilihWarna($tCol[8],$tCol[10]);
		$Wr09 = PilihWarna($tCol[9],$tCol[7]);
		$Wr10 = PilihWarna($tCol[10],$tCol[8]);
		
		$Wr15 = PilihWarna($tCol[15],$tCol[17]);
		$Wr16 = PilihWarna($tCol[16],$tCol[18]);
		$Wr17 = PilihWarna($tCol[17],$tCol[15]);
		$Wr18 = PilihWarna($tCol[18],$tCol[16]);
		
		$Wr19 = PilihWarna($tCol[19],$tCol[21]);
		$Wr20 = PilihWarna($tCol[20],$tCol[22]);
		$Wr21 = PilihWarna($tCol[21],$tCol[19]);
		$Wr22 = PilihWarna($tCol[22],$tCol[20]);
		
		$Wr23 = PilihWarna($tCol[23],$tCol[25]);
		$Wr24 = PilihWarna($tCol[24],$tCol[26]);
		$Wr25 = PilihWarna($tCol[25],$tCol[23]);
		$Wr26 = PilihWarna($tCol[26],$tCol[24]);
		
		$Wr27 = PilihWarna($tCol[27],$tCol[29]);
		$Wr28 = PilihWarna($tCol[28],$tCol[30]);
		$Wr29 = PilihWarna($tCol[29],$tCol[27]);
		$Wr30 = PilihWarna($tCol[30],$tCol[28]);
		
		$Wr31 = PilihWarna($tCol[31],$tCol[33]);
		$Wr32 = PilihWarna($tCol[32],$tCol[34]);
		$Wr33 = PilihWarna($tCol[33],$tCol[31]);
		$Wr34 = PilihWarna($tCol[34],$tCol[32]);
		
		$Wr35 = PilihWarna($tCol[35],$tCol[37]);
		$Wr36 = PilihWarna($tCol[36],$tCol[38]);
		$Wr37 = PilihWarna($tCol[37],$tCol[35]);
		$Wr38 = PilihWarna($tCol[38],$tCol[36]);
		?>
        <tr height="30">
          <td colspan="4" align="center" style="font-weight:bold; border-top: 3px double #000000">T O T A L</td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[5],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[6],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8 <?=$Wr07?>"><?=echoVal($tCol[7],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8 <?=$Wr08?>"><?=echoVal($tCol[8],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8 <?=$Wr09?>"><?=echoVal($tCol[9],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8 <?=$Wr10?>"><?=echoVal($tCol[10],"Y")?></td>
		  
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[11],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[12],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[13],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[14],"Y")?></td>
		  
          <td align="center" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8 <?=$Wr15?>"><?=echoVal($tCol[15],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8 <?=$Wr16?>"><?=echoVal($tCol[16],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8 <?=$Wr17?>"><?=echoVal($tCol[17],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8 <?=$Wr18?>"><?=echoVal($tCol[18],"Y")?></td>
		  
          <td align="center" style="font-weight:bold; border-top: 3px double #000000 <?=$Wr19?>"><?=echoVal($tCol[19],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000 <?=$Wr20?>"><?=echoVal($tCol[20],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000 <?=$Wr21?>"><?=echoVal($tCol[21],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000 <?=$Wr22?>"><?=echoVal($tCol[22],"Y")?></td>
		  
          <td align="center" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8 <?=$Wr23?>"><?=echoVal($tCol[23],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8 <?=$Wr24?>"><?=echoVal($tCol[24],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8 <?=$Wr25?>"><?=echoVal($tCol[25],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8 <?=$Wr26?>"><?=echoVal($tCol[26],"Y")?></td>
		  
          <td align="center" style="font-weight:bold; border-top: 3px double #000000 <?=$Wr27?>"><?=echoVal($tCol[27],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000 <?=$Wr28?>"><?=echoVal($tCol[28],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000 <?=$Wr29?>"><?=echoVal($tCol[29],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000 <?=$Wr30?>"><?=echoVal($tCol[30],"Y")?></td>
		  
          <td align="center" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8 <?=$Wr31?>"><?=echoVal($tCol[31],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8 <?=$Wr32?>"><?=echoVal($tCol[32],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8 <?=$Wr33?>"><?=echoVal($tCol[33],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8 <?=$Wr34?>"><?=echoVal($tCol[34],"Y")?></td>
		  
          <td align="center" style="font-weight:bold; border-top: 3px double #000000 <?=$Wr35?>"><?=echoVal($tCol[35],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000 <?=$Wr36?>"><?=echoVal($tCol[36],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000 <?=$Wr37?>"><?=echoVal($tCol[37],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000 <?=$Wr38?>"><?=echoVal($tCol[38],"Y")?></td>
		  
          <td align="center" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8"><?=echoVal($tCol[39],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8"><?=echoVal($tCol[40],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8"><?=echoVal($tCol[41],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8"><?=echoVal($tCol[42],"Y")?></td>
		  
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[43],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[44],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[45],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[46],"Y")?></td>
		  
          <td align="center" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8"><?=echoVal($tCol[47],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8"><?=echoVal($tCol[48],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8"><?=echoVal($tCol[49],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000; background:#F2FBA8"><?=echoVal($tCol[50],"Y")?></td>
		  
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[51],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[52],"Y")?></td>
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[53],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[54],"Y")?></td>
		  
          <td align="center" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[55],"N")?></td>
          <td align="right" style="font-weight:bold; border-top: 3px double #000000"><?=echoVal($tCol[56],"Y")?></td>
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
<?
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

function InsertSaldoAkhirMutasi($yKd,$yUpb,$yThn,$uAKH,$nAKH)
{
	$rCeK = fGlobal("IDT","ta_kib_post_saldo_mutasi","Kd_Unit:Kd_Aset:Tahun",$yUpb.":".$yKd.":".$yThn,"=:=:=","","");	
	if ($rCeK){
		$wSQL="UPDATE ta_kib_post_saldo_mutasi SET unitAkhir='".$uAKH."', saldoAkhir='".$nAKH."' WHERE IDT='".$rCeK."'";
		$nRW = mysql_query($wSQL);
	}
	else{
		$wSQL="INSERT INTO ta_kib_post_saldo_mutasi SET Kd_Unit='".$yUpb."', Kd_Aset='".$yKd."', Tahun='".$yThn."', unitAkhir='".$uAKH."', saldoAkhir='".$nAKH."'";
		$nRW = mysql_query($wSQL);
	}
}


function ItemKurang($iGR,$KdAsTR,$ThnR,$gUpbR,$mMSR,$LoadExtrac,$LoD)
{
	return fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iGR)."_mutasi","Kd_Aset:Tgl_Mutasi:Kd_Upb:Jns_Mutasi:extracom",$KdAsTR."%:".$ThnR."-%-%".":".$gUpbR."%:".$mMSR.":".$LoadExtrac,"LIKE:LIKE:LIKE:=:LIKE","",$LoD);
}

function HargKurang($KdAsTR,$ThnR,$gUpbR,$mMSR,$LoadExtrac,$LoD)
{
	return fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_mutasi","Kd_Aset:Tgl_Mutasi:Kd_UPB:Jns_Mutasi:extracom",$KdAsTR."%:".$ThnR."-%-%:".$gUpbR."%:".$mMSR.":".$LoadExtrac,"LIKE:LIKE:LIKE:=:LIKE","",$LoD);
}

function ItemTambah($iGR,$KdAsTR,$ThnR,$gUpbR,$mMSR,$LoadExtrac,$LoD)
{
	if ($mMSR=="MK" || $mMSR=="RB" || $mMSR=="LE" || $mMSR=="HB" || $mMSR=="AR" || $mMSR=="KR" || $mMSR=="PL"){
		return fGlobal("IfNull(count(*),0)", "ta_kib_post_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi:Crit:extracom",$KdAsTR."%:".$ThnR."-%-%:".$gUpbR."%:".$mMSR.":SLD:".$LoadExtrac,"LIKE:LIKE:LIKE:=:=:LIKE","",$LoD);
	}
	else{
		return fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iGR)."_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi:extracom",$KdAsTR."%:".$ThnR."-%-%:".$gUpbR."%:".$mMSR.":".$LoadExtrac,"LIKE:LIKE:LIKE:=:LIKE","",$LoD);
	}
}

function HargTambah($KdAsTR,$ThnR,$gUpbR,$mMSR,$LoadExtrac,$LoD)
{
	return fGlobal("IfNull(sum(Debet),0)","ta_kib_post_mutasi","Kd_Aset_To:Tgl_Mutasi:Kd_UPB_To:Jns_Mutasi:extracom",$KdAsTR."%:".$ThnR."-%-%:".$gUpbR."%:".$mMSR.":".$LoadExtrac,"LIKE:LIKE:LIKE:=:LIKE","",$LoD);
}


function ItemKurangKibF($iGR,$KdAsTR,$ThnR,$gUpbR,$LoadExtrac,$LoD) ###
{
	return fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iGR),"Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb:KdpToAset",$KdAsTR."%:".$ThnR."-01-01".":".$ThnR."-12-31:".$gUpbR."%:Y","LIKE:>=:<=:LIKE:=","",$LoD);
}

function HargKurangKibF($KdAsTR,$ThnR,$gUpbR,$LoadExtrac,$LoD) ###
{
	return fGlobal("IfNull(sum(Debet),0)", "ta_kib_post","Kd_Aset:Tanggal:Tanggal:Kd_Upb:KdpToAset",$KdAsTR."%:".$ThnR."-01-01".":".$ThnR."-12-31:".$gUpbR."%:Y","LIKE:>=:<=:LIKE:=","",$LoD);
}


function ItemTambahKibF($iGR,$KdAsTR,$ThnR,$gUpbR,$LoadExtrac,$LoD) ###
{
	return fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iGR),"Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb",$KdAsTR."%:".$ThnR."-01-01".":".$ThnR."-12-31:".$gUpbR."%","LIKE:>=:<=:LIKE","",$LoD);
}

function HargTambahKibF($KdAsTR,$ThnR,$gUpbR,$LoadExtrac,$LoD) ###
{
	return fGlobal("IfNull(sum(Debet),0)", "ta_kib_post","Kd_Aset:Tanggal:Tanggal:Kd_Upb",$KdAsTR."%:".$ThnR."-01-01".":".$ThnR."-12-31:".$gUpbR."%","LIKE:>=:<=:LIKE","",$LoD);
}

function ItemTambahThnN($iGR,$KdAsTR,$ThnR,$gUpbR,$LoadExtrac,$LoD)
{
	$MashAda = fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iGR),"Kd_Aset:Tgl_Perolehan:Ref_Mutasi:Kd_Upb:extracom",$KdAsTR."%:".$ThnR."-%-%"."::".$gUpbR."%:".$LoadExtrac,"LIKE:LIKE:=:LIKE:LIKE","",$LoD);
	#$SdhMtsi = fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iGR)."_mutasi","Kd_Aset:Tgl_Perolehan:Tgl_Mutasi:Kd_UPB:extracom",$KdAsTR."%:".$ThnR."-%-%:".$ThnR."-%-%:".$gUpbR."%:".$LoadExtrac,"LIKE:LIKE:LIKE:LIKE:LIKE","",$LoD);
	$SdhMtsi = fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iGR)."_mutasi","Kd_Aset:Tgl_Perolehan:Tgl_Mutasi_Masuk:Kd_UPB:extracom",$KdAsTR."%:".$ThnR."-%-%:0000-00-00:".$gUpbR."%:".$LoadExtrac,"LIKE:LIKE:=:LIKE:LIKE","",$LoD);
	return $MashAda+$SdhMtsi;
}

function HargTambahThnN($KdAsTR,$ThnR,$gUpbR,$LoadExtrac,$LoD)
{
	$MashAda = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post","Kd_Aset:Tanggal:Ref_Mutasi:Kd_Upb:extracom",$KdAsTR."%:".$ThnR."-%-%::".$gUpbR."%:".$LoadExtrac,"LIKE:LIKE:=:LIKE:LIKE","",$LoD);
	#$SdhMtsi = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_mutasi","Kd_Aset:Tanggal:Tgl_Mutasi:Kd_Upb:extracom",$KdAsTR."%:".$ThnR."-%-%:".$ThnR."-%-%:".$gUpbR."%:".$LoadExtrac,"LIKE:LIKE:LIKE:LIKE:LIKE","",$LoD);
	$SdhMtsi = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_mutasi","Kd_Aset:Tanggal:Tgl_Mutasi_Masuk:Kd_Upb:extracom",$KdAsTR."%:".$ThnR."-%-%:0000-00-00:".$gUpbR."%:".$LoadExtrac,"LIKE:LIKE:=:LIKE:LIKE","",$LoD);
	return $MashAda+$SdhMtsi;
}

function ItemKurangThnN($iGR,$KdAsTR,$ThnR,$gUpbR,$LoadExtrac,$LoD)
{
	$MashAda = 0;//fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iGR),"Kd_Aset:Tgl_Perolehan:Ref_Mutasi:Kd_Upb:extracom",$KdAsTR."%:".$ThnR."-%-%"."::".$gUpbR."%:".$LoadExtrac,"LIKE:LIKE:=:LIKE:LIKE","",$LoD);
	#$SdhMtsi = fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iGR)."_mutasi","Kd_Aset:Tgl_Perolehan:Tgl_Mutasi:Kd_UPB:extracom",$KdAsTR."%:".$ThnR."-%-%:".$ThnR."-%-%:".$gUpbR."%:".$LoadExtrac,"LIKE:LIKE:LIKE:LIKE:LIKE","",$LoD);
	$SdhMtsi = fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($iGR)."_mutasi","Kd_Aset:Tgl_Perolehan:Tgl_Mutasi_Masuk:Kd_UPB:extracom",$KdAsTR."%:".$ThnR."-%-%:0000-00-00:".$gUpbR."%:".$LoadExtrac,"LIKE:LIKE:=:LIKE:LIKE","",$LoD);
	return $MashAda+$SdhMtsi;
}
function HargKurangThnN($KdAsTR,$ThnR,$gUpbR,$LoadExtrac,$LoD)
{
	$MashAda = 0;//fGlobal("IfNull(sum(Debet),0)", "ta_kib_post","Kd_Aset:Tanggal:Ref_Mutasi:Kd_Upb:extracom",$KdAsTR."%:".$ThnR."-%-%::".$gUpbR."%:".$LoadExtrac,"LIKE:LIKE:=:LIKE:LIKE","",$LoD);
	#$SdhMtsi = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_mutasi","Kd_Aset:Tanggal:Tgl_Mutasi:Kd_Upb:extracom",$KdAsTR."%:".$ThnR."-%-%:".$ThnR."-%-%:".$gUpbR."%:".$LoadExtrac,"LIKE:LIKE:LIKE:LIKE:LIKE","",$LoD);
	$SdhMtsi = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_mutasi","Kd_Aset:Tanggal:Tgl_Mutasi_Masuk:Kd_Upb:extracom",$KdAsTR."%:".$ThnR."-%-%:0000-00-00:".$gUpbR."%:".$LoadExtrac,"LIKE:LIKE:=:LIKE:LIKE","",$LoD);
	return $MashAda+$SdhMtsi;
}

?>

<script languange="javascript">
	function showDATA(Unt,Thn,ReK,IdL)
	{
		//alert(Unt+':'+Thn+':'+ReK);
		var win=null;
		var w=800; h=400;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL= 'Lap_Daftar_Mutasi_Rekap_RciMutasi_New_Rinci_Ext_Doc.php?CriT=AkH&Unt='+Unt+'&Thn='+Thn+'&ReK='+ReK+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
</script>

