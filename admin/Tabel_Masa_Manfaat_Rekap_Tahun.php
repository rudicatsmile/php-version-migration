
<?php
require "Connection.php";
require "FileFunction.php";
extract($_GET);
#echo "xxxxxxxxx".$ExtR;
#return false;

$rTH = $rTH;
$rAS = $rAS;
$uNT = $uNT;
$uSU = $uSU;
$uUP = $uUP;

//echo $rAS;

$TbL = fNmHuruf((int)$rAS);
#echo $rAS." ".$TbL;
$rPG = 5000;

$tRef="";
if ($TbL=="b"){
	$tRef="ALT";
}
if ($TbL=="c"){
	$tRef="BNG";
}
if ($TbL=="d"){
	$tRef="JLN";
}

require "Lap_Footer.php";

$gUnt  = $uNT;
$frHri = $gHriC;
$frBln = $gBlnC;
$frThn = $gThnC;
if (isset($_GET['iPG'])){
	$iPG=$_GET['iPG'];
}
else {
	$iPG=0;
}

if($uUP!="All") {
	$uNT=$uUP;
}
else {
	if($uSU!="All") {
		$uNT=$uSU;
	}
	else {
		$uNT=$uNT;
	}
}

$nMT="N";
$txt="";
if ($mts!=""){
	$txt="<br><font style='background:#000; color:#fff; font-size:9pt;font-style:italic'>&nbsp;( SUDAH MUTASI KE ASET LAINNYA )&nbsp;</font>";
	$nMT="Y";
}

$DisPL = "";
$div   = 0;
$CntItem = fGlobalNEW("IfNull(count(*),0)","ta_kib_108".$mts,"Kd_Aset_108:Kd_UPB:Tgl_Perolehan:extracom",$rAS."%:".$uNT."%:".$rTH."-12-31:".$ExtR,"LIKE:LIKE:<=:=","",DatabaseSB,$ConSB,"");
#echo $CntItem.":".$rPG;
if ($CntItem>=$rPG){
	$DisPL = "Page ".(($iPG/$rPG)+1)." of ".$div/$rPG;
}
?>

<link rel="stylesheet" type="text/css" href="css/page.css" >
<body>
<table border="0" align="center" width="1500" cellspacing="0" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
  <tr>
    <td>
	<table border="0" align="center" width="1500" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
	<tr>
	  <td colspan="3" align="center" style="font-size: 13pt; font-weight: bold">REKAPITULASI DATA PENYUSUTAN <?php if ($ExtR=="Y"){echo "( EXTRACOM )";} else {echo "( NON EXTRACOM )";} ?></td>
	</tr>
	<tr>
	  <td colspan="3" align="center" style="font-size: 11pt; font-weight: normal"><?="<b>".strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset1","Kd_Aset",$rAS,"=","",DatabaseSB,$ConSB,""))."</b>".$txt?></td>
	</tr>
	<tr>
	  <td colspan="3" align="center" style="font-size: 10pt; font-weight: normal">PER 31 DESEMBER <?=$rTH?></td>
	</tr>
	<tr>
	  <td width="70" style="font-size: 10pt; font-weight: normal">UNIT KERJA </td>
	  <td width="28" style="font-size: 10pt; font-weight: normal">:</td>
	  <td width="1292" style="font-size: 10pt; font-weight: normal"><?php if ($uNT=='All') {echo "Semua";} else {echo strtoupper(fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",$_GET['uNT'],"=","",DatabaseSB,$ConSB,""));}?></td>
	</tr>
	<tr>
	  <td width="70" style="font-size: 10pt; font-weight: normal">SUB UNIT</td>
	  <td width="28" style="font-size: 10pt; font-weight: normal">:</td>
	  <td width="1292" style="font-size: 10pt; font-weight: normal"><?php if ($_GET['uSU']=="All"){echo "Semua";}else{ echo strtoupper(fGlobalNEW("Nm_Sub","ref_sub_unit","Kd_Sub",$_GET['uSU'],"=","",DatabaseSB,$ConSB,""));}?></td>
	</tr>
	<tr>
	  <td width="70" style="font-size: 10pt; font-weight: normal">UPB</td>
	  <td width="28" style="font-size: 10pt; font-weight: normal">:</td>
	  <td width="1292" style="font-size: 10pt; font-weight: normal"><?php if ($_GET['uUP']=="All"){echo "Semua";}else{echo strtoupper(fGlobalNEW("Nm_UPB","ref_upb","Kd_UPB",$_GET['uUP'],"=","",DatabaseSB,$ConSB,""));}?></td>
	</tr>
	<tr>
	  <td colspan="3">&nbsp;</td>
	</tr>
	<tr>
	  <td colspan="3"><?=$DisPL?></td>
	</tr>
	</table>
	<table border="0" align="center" width="1500" cellspacing="0" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
	  <tr height="20">
		<td width="31" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">NO</td>
		<td width="43" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">KODE BARANG</td>
		<td width="43" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">REFERENSI</td>
		<td width="46" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">REGISTER</td>
		<td width="232" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">JENIS / OBJEK / NAMA BARANG</td>
		<td width="46" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">UMUR EKONOMIS (Tahun) </td>
		<td width="148" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">KETERANGAN</td>
		<td width="118" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">
		<?php
		if ($TbL=="b") {echo "MERK / TYPE";}
		else if ($TbL=="c") {echo "LOKASI/ALAMAT";}
		else if ($TbL=="e") {echo "SPESIFIKASI/<br>JUDUL/PENCIPTA";}
		else {echo "LOKASI";}
		?>		</td>
		<td width="101" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">
		<?php
		if ($TbL=="b") {echo "UKURAN/BAHAN/<br>LAIN-LAIN";}
		else if ($TbL=="c") {echo "LUAS";}
		else if ($TbL=="e") {echo "UKURAN/BAHAN/<br>LAIN-LAIN";}
		else {echo "UKURAN";}
		?>		</td>
		<td width="61" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">TAHUN PEROLEHAN</td>
		<td colspan="3" style="text-align:center; font-weight:bold; border:1px solid #000000">N I L A I</td>
		<td width="81" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">AKUMULASI PENYUSUTAN S.D <br>TAHUN <?=((int)$rTH-1)?></td>
		<td width="81" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">BEBAN PENYUSUTAN <br>TAHUN <?=$rTH?></td>
		<td width="81" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">AKUMULASI PENYUSUTAN S.D <br>TAHUN <?=$rTH?></td>
		<td width="40" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">NILAI BUKU</td>
	    <td width="54" rowspan="2" style="text-align:center; font-weight:bold; border:1px solid #000000">SISA UMUR (Tahun) </td>
	  </tr>
	  <tr height="20">
	    <td width="81" style="text-align:center; font-weight:bold; border:1px solid #000000">PEROLEHAN</td>
	    <td width="81" style="text-align:center; font-weight:bold; border:1px solid #000000">ATRBIBUSI</td>
	    <td width="81" style="text-align:center; font-weight:bold; border:1px solid #000000">TOTAL</td>
	  </tr>
	  <tr height="20">
		<td style="text-align:center; border:1px solid #000000">1</td>
		<td style="text-align:center; border:1px solid #000000">2</td>
		<td style="text-align:center; border:1px solid #000000">3</td>
		<td style="text-align:center; border:1px solid #000000">4</td>
		<td style="text-align:center; border:1px solid #000000">5</td>
		<td style="text-align:center; border:1px solid #000000">6</td>
		<td style="text-align:center; border:1px solid #000000">7</td>
		<td style="text-align:center; border:1px solid #000000">8</td>
		<td style="text-align:center; border:1px solid #000000">9</td>
		<td style="text-align:center; border:1px solid #000000">10</td>
		<td style="text-align:center; border:1px solid #000000">11</td>
		<td style="text-align:center; border:1px solid #000000">12</td>
		<td style="text-align:center; border:1px solid #000000">13</td>
		<td style="text-align:center; border:1px solid #000000">14</td>
		<td style="text-align:center; border:1px solid #000000">15</td>
		<td style="text-align:center; border:1px solid #000000">16</td>
	    <td style="text-align:center; border:1px solid #000000">17</td>
	    <td style="text-align:center; border:1px solid #000000">18</td>
	  </tr>
	  <?php
	  if ($uNT=='All') {$uNT='__.__.__.__';}
	  $Col02a="";
	  $Col02b="";
	  $iG=$iPG+1;
		
	  if ($mts!=""){
		$nSQ = "SELECT * FROM ta_kib_108".$mts." WHERE Kd_Aset_108 LIKE '".$rAS."%' AND extracom='".$ExtR."' AND Kd_UPB LIKE '".$uNT."%' AND Tgl_Perolehan <= '".$rTH."-12-31' AND Kd_Aset_To LIKE '07%' ORDER BY Tgl_Perolehan, Kd_Aset, No_Register LIMIT $iPG,$rPG";
	  }
	  else{
		if ($TbL=="g"){
			$nSQ = "SELECT * FROM ta_kib_108 WHERE Kd_Aset_108 LIKE '".$rAS."%' AND extracom='".$ExtR."' AND Kd_UPB LIKE '".$uNT."%' AND Tgl_Perolehan <='".$rTH."-12-31' AND Kd_Pemilik LIKE '__' AND Status='' 
			GROUP BY Referensi, LEFT(Kd_UPB,11), Ref_History 
			ORDER BY Tgl_Perolehan, Kd_Aset, No_Register LIMIT $iPG,$rPG";
		}
		else{
		  	$nSQ = "SELECT * FROM ta_kib_108".$mts." WHERE Kd_Aset_108 LIKE '".$rAS."%' AND extracom='".$ExtR."' AND Kd_UPB LIKE '".$uNT."%' AND Tgl_Perolehan <= '".$rTH."-12-31' ORDER BY Tgl_Perolehan, Kd_Aset, No_Register LIMIT $iPG,$rPG";
		  	$nSQ = "SELECT * FROM ta_kib_108".$mts." WHERE Kd_Aset_108 LIKE '".$rAS."%' AND extracom='".$ExtR."' AND Kd_UPB LIKE '".$uNT."%' AND Tgl_Perolehan <= '".$rTH."-12-31' ORDER BY Referensi LIMIT $iPG,$rPG";
		    #echo $nSQ;
		}	  
	  }
	  $nRs = mysql_query($nSQ) or die(mysql_error());
	  while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	  {
		$rEF  = $mRo['Referensi'];
		$RefH = $mRo['Ref_History'];
		$uNT  = substr($mRo['Kd_UPB'],0,11);
		$Col01 = $iG++;
		$Col02 = $mRo['Kd_Aset_108'];
		$Col02a= $Col02;
		$Col03 = $mRo['No_Register'];
		$Col04 = $mRo['Nm_Aset'];
		if ($mts!=""){
			$Col04.="<font style='background:#c0c0c0'><br><i>".fGlobalNEW("Deskripsi","ref_usulan_jenis","Kode",$mRo['Jns_Mutasi'],"=","",DatabaseSB,$ConSB,"")."&nbsp;";
			$Col04.="<br>Ref. Aset ".$mRo['Referensi_To']."&nbsp;";
			$Col04.="<br>Ref.Usulan ".$mRo['Ref_Usulan']."&nbsp;";
		}
		if ($TbL=="g"){
			$Col05 = "";//fGlobalNEW("nm_aset","ref_rek_aset2","kd_aset",substr($mRo['Kd_Aset'],0,5),"=","",DatabaseSB,$ConSB,"")."<br>";
			$Col05.= "<i>".$mRo['Keterangan']."</i>";
		}
		else{
			$Col05 = $mRo['Keterangan'];
		}
		
		$Col06 = "";
		$Col07 = "";
		
		if ($TbL=="b") 
		{
			$Col06 = $mRo['Merk'];
			if ($mRo['Type']!='' && $mRo['Type']!='-') {$Col06.= "/".$mRo['Type'];}
			
			if ($mRo['Ukuran_CC']!='') {$Col07 = $mRo['Ukuran_CC'];}
			if ($mRo['Bahan']!='') {if ($Col07!='') {$Col07.= ", ".$mRo['Bahan'];} else {$Col07 = $mRo['Bahan'];}}
		}
		if ($TbL=="c") 
		{
			$Col06 = $mRo['Lokasi'];
			if ($mRo['Luas_Lantai']>0) {
			$Col07 = fConvertToRupiahBulat($mRo['Luas_Lantai'])."&nbsp;&nbsp;M<sup>2</sup>";}
		}
		if ($TbL=="d") 
		{
			$Col06 = $mRo['Lokasi'];
			if ($mRo['Luas']>0) {
			$Col07 = fConvertToRupiahBulat($mRo['Luas']);}
		}
		if ($TbL=="e") 
		{
			$Col06 = $mRo['Spesifikasi'];
			if ($mRo['Judul']!='') 
			{
				if ($Col06!='') {$Col06.="/".$mRo['Judul'];} else {$Col06 = $mRo['Judul'];}
			}
			if ($mRo['Pencipta']!='') 
			{
				if ($Col06!='') {$Col06.="/".$mRo['Pencipta'];} else {$Col06 = $mRo['Pencipta'];}
			}
			if ($mRo['Ukuran']>0) {
				$Col07 = $mRo['Ukuran'];
			}
			if ($mRo['Bahan']!='') {
				if ($Col07!='') {$Col07.= "/".$mRo['Bahan'];} else {$Col07 = $mRo['Bahan'];}
			}
		}
		//$Col07 = $mRo['Referensi'];
		$eUPB  = $mRo['Kd_UPB'];
		$rUPB  = substr($mRo['Kd_UPB'],0,11);
		$Col08 = fConvertDateShort($mRo['Tgl_Perolehan']);
		#$Col09 = $mRo['Harga'];
		$Col09 = fGlobalNEW("IfNull(sum(debet),0)","ta_kib_post_108","Kd_UPB:Referensi:Crit",$eUPB.":".$rEF.":SLD","=:=:=:=","",DatabaseSB,$ConSB,"");
		$Col10 = fGlobalNEW("IfNull(sum(debet),0)","ta_kib_post_108","Kd_UPB:Referensi:Crit",$eUPB.":".$rEF.":INV","=:=:=:=","",DatabaseSB,$ConSB,"");
		$Col0T = $Col09 + $Col10;
		$Col11 = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap:extracom",$eUPB.":".$rEF.":".((int)$rTH-1).":".$ExtR,"=:=:=:=:=","",DatabaseSB,$ConSB,"");
		$Col12 = fGlobalNEW("IfNull(sum(Penyusutan),0)","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap:extracom",$eUPB.":".$rEF.":".$rTH.":".$ExtR,"=:=:=:=:=","",DatabaseSB,$ConSB,"");
		$Col13 = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap:extracom",$eUPB.":".$rEF.":".$rTH.":".$ExtR,"=:=:=:=:=","",DatabaseSB,$ConSB,"");
		$Col14 = fGlobalNEW("IfNull(sum(Nilai_Buku_Akhir),0)","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap:extracom",$eUPB.":".$rEF.":".$rTH.":".$ExtR,"=:=:=:=:=","",DatabaseSB,$ConSB,"");
		$Col15 = fGlobalNEW("IfNull(sum(Umur_Sisa),0)","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap:extracom",$eUPB.":".$rEF.":".$rTH.":".$ExtR,"=:=:=:=:=","",DatabaseSB,$ConSB,"");
		
		$tCol09 = $tCol09 + $Col09;
		$tCol10 = $tCol10 + $Col10;
		$tCol0T = $tCol0T + $Col0T;
		$tCol11 = $tCol11 + $Col11;
		$tCol12 = $tCol12 + $Col12;
		$tCol13 = $tCol13 + $Col13;
		$tCol14 = $tCol14 + $Col14;
		
		if ($Col02b!=$Col02a){
			$Umur = findMasaManfaat($Col02,DatabaseSB,$ConSB);
		}
	  ?>
	  <tr height="23">
		<td valign="top" style="border:1px solid #000000; text-align:center"><?=$Col01?>.</td>
		<td valign="top" style="border:1px solid #000000; text-align:center"><?=$Col02?></td>
		<td valign="top" style="border:1px solid #000000; text-align:center"><?=$rEF?></td>
		<td valign="top" style="border:1px solid #000000; text-align:center"><?=$Col03?></td>
		<td valign="top" style="border:1px solid #000000; padding-left:2px"><?=$Col04?></td>
		<td valign="top" style="border:1px solid #000000; padding-left:0px; text-align:center"><?php if ($Umur!=0) {echo $Umur;} else {echo "-";}?></td>
		<td valign="top" style="border:1px solid #000000; padding-left:2px"><?=$Col05?></td>
		<td valign="top" style="border:1px solid #000000; padding-left:2px"><?=$Col06?></td>
		<td valign="top" style="border:1px solid #000000"><?php if ($Col07!=0){echo $Col07;}else{echo "-";}?></td>
		<td valign="top" style="border:1px solid #000000; text-align:center"><?=$Col08?></td>
		<td valign="top" style="border:1px solid #000000; text-align:right; padding-right:3px"><?=fConvertToRupiah($Col09)?></td>
		<td valign="top" style="border:1px solid #000000; text-align:right; padding-right:3px"><?=fConvertToRupiah($Col10)?></td>
		<td valign="top" style="border:1px solid #000000; text-align:right; padding-right:3px"><?=fConvertToRupiah($Col0T)?></td>
		<td valign="top" style="border:1px solid #000000; text-align:right; padding-right:3px"><?=fConvertToRupiah($Col11)?></td>
		<td valign="top" style="border:1px solid #000000; text-align:right; padding-right:3px"><?=fConvertToRupiah($Col12)?></td>
		<td valign="top" style="border:1px solid #000000; text-align:right; padding-right:3px"><?=fConvertToRupiah($Col13)?></td>
		<td valign="top" style="border:1px solid #000000; text-align:right; padding-right:3px"><?=fConvertToRupiah($Col14)?></td>
	    <td valign="top" style="border:1px solid #000000; text-align:center"><?=fConvertToRupiahBulat($Col15)?></td>
	  </tr>
	  <?php
		$Col02b= $Col02a;
	  }
	  ?>
	  <tr height="20">
		<td colspan="10" style="border:1px solid #000000; font-weight:bold; text-align:center">SUB TOTAL</td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol09)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol10)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol0T)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol11)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol12)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol13)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol14)?></td>
	    <td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px">&nbsp;</td>
	  </tr>
	  <?php if ($CntItem==($iG-1)) {
		#if ($TbL=="a"){$rKD="01";}
		#if ($TbL=="b"){$rKD="02";}
		#if ($TbL=="c"){$rKD="03";}
		#if ($TbL=="d"){$rKD="04";}
		#if ($TbL=="e"){$rKD="05";}
		#if ($TbL=="f"){$rKD="06";}
		#$tCol09 = 0;//fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_108".$mts,"Kd_UPB:Tgl_Perolehan:extracom",$uNT."%:".$rTH."-12-31:".$ExtR,"LIKE:<=:=","",DatabaseSB,$ConSB,"");
		#$tCol10 = 0;//fGlobalNEW("IfNull(sum(Nilai_Tambah),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:SdhMutasi:extracom",$rUPB."%:".$rKD."%:".$rTH.":N:".$ExtR,"LIKE:LIKE:<=:=:=","",DatabaseSB,$ConSB,"");
		#$tCol11 = 0;//fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:Nilai_Akhir:Triwulan:SdhMutasi:extracom",$rUPB."%:".$rKD.":".((int)$rTH-1).":Y:IV:N:".$ExtR,"LIKE:=:=:=:=:=:=","",DatabaseSB,$ConSB,"");
		#$tCol12 = 0;//fGlobalNEW("IfNull(sum(Beban_Tahun_Berjalan),0)","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:SdhMutasi:extracom",$rUPB."%:".$rKD."%:".$rTH.":N:".$ExtR,"LIKE:LIKE:=:=:=","",DatabaseSB,$ConSB,"");
		#$tColDT = 0;//fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0):IfNull(sum(Nilai_Buku),0):Ms_Manfaat_Sisa","ta_kib_post_penyusutan_108","Kd_UPB:Kd_Aset_108:PerLap:Nilai_Akhir:Triwulan:SdhMutasi:extracom",$rUPB."%:".$rKD."%:".$rTH.":Y:IV:N:".$ExtR,"LIKE:LIKE:=:=:=:=:=","",DatabaseSB,$ConSB,"");
		
		#$tColDT = explode(":",$tColDT);
		
		#$tCol13 = $tColDT[0];
		#$tCol14 = $tColDT[1];
		#$tCol15 = $tColDT[2];
		
		#$tCol09 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_108".$mts,"Kd_Aset_108:Kd_UPB:Tgl_Perolehan:extracom",$rAS."%:".$uNT."%:".$rTH."-12-31:".$ExtR,"LIKE:LIKE:<=:=","",DatabaseSB,$ConSB,"");
		$tCol09 = fGlobalNEW("IfNull(sum(debet),0)","ta_kib_post_108","Kd_Aset_108:Kd_UPB:Crit:Tanggal:extracom",$rAS."%:".$uNT."%:SLD:".$rTH."-12-31:".$ExtR,"LIKE:LIKE:=:<=:=","",DatabaseSB,$ConSB,"");
		$tCol10 = fGlobalNEW("IfNull(sum(debet),0)","ta_kib_post_108","Kd_Aset_108:Kd_UPB:Crit:Tanggal:extracom",$rAS."%:".$uNT."%:INV:".$rTH."-12-31:".$ExtR,"LIKE:LIKE:=:<=:=","",DatabaseSB,$ConSB,"");
		$tCol0T = $tCol09 + $tCol10;
		#$Col11 = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap:extracom",$eUPB.":".$rEF.":".((int)$rTH-1).":".$ExtR,"=:=:=:=:=","",DatabaseSB,$ConSB,"");
		#$Col12 = fGlobalNEW("IfNull(sum(Penyusutan),0)","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap:extracom",$eUPB.":".$rEF.":".$rTH.":".$ExtR,"=:=:=:=:=","",DatabaseSB,$ConSB,"");
		#$Col13 = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap:extracom",$eUPB.":".$rEF.":".$rTH.":".$ExtR,"=:=:=:=:=","",DatabaseSB,$ConSB,"");
		#$Col14 = fGlobalNEW("IfNull(sum(Nilai_Buku_Akhir),0)","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap:extracom",$eUPB.":".$rEF.":".$rTH.":".$ExtR,"=:=:=:=:=","",DatabaseSB,$ConSB,"");
		#$Col15 = fGlobalNEW("IfNull(sum(Umur_Sisa),0)","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap:extracom",$eUPB.":".$rEF.":".$rTH.":".$ExtR,"=:=:=:=:=","",DatabaseSB,$ConSB,"");
		
		$tCol11 = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_Aset_108:Kd_UPB:PerLap:extracom",$rAS."%:".$uNT."%:".((int)$rTH-1).":".$ExtR,"LIKE:LIKE:=:=:=","",DatabaseSB,$ConSB,"");
		$tCol12 = fGlobalNEW("IfNull(sum(Penyusutan),0)","ta_kib_post_penyusutan_108","Kd_Aset_108:Kd_UPB:PerLap:extracom",$rAS."%:".$uNT."%:".$rTH.":".$ExtR,"LIKE:LIKE:=:=:=","",DatabaseSB,$ConSB,"");
		$tCol13 = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_Aset_108:Kd_UPB:PerLap:extracom",$rAS."%:".$uNT."%:".$rTH.":".$ExtR,"LIKE:LIKE:=:=:=","",DatabaseSB,$ConSB,"");
		$tCol14 = fGlobalNEW("IfNull(sum(Nilai_Buku_Akhir),0)","ta_kib_post_penyusutan_108","Kd_Aset_108:Kd_UPB:PerLap:extracom",$rAS."%:".$uNT."%:".$rTH.":".$ExtR,"LIKE:LIKE:=:=:=","",DatabaseSB,$ConSB,"");
		$tCol15 = fGlobalNEW("IfNull(sum(Umur_Sisa),0)","ta_kib_post_penyusutan_108","Kd_Aset_108:Kd_UPB:PerLap:extracom",$rAS."%:".$uNT."%:".$rTH.":".$ExtR,"LIKE:LIKE:=:=:=","",DatabaseSB,$ConSB,"");
	
	?>
	  <tr height="20">
		<td colspan="10" style="border:1px solid #000000; font-weight:bold; text-align:center">T O T A L</td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol09)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol10)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol0T)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol11)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol12)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol13)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol14)?></td>
	    <td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px">&nbsp;</td>
	  </tr>
	  <?php } ?>
	</table>
    </td>
  </tr>
</table>
<?php if ($CntItem==($iG-1)) {?>
<table border="0" align="center" width="1500" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td valign="top" width="450">
	<table border="0" align="left" width="450" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse">
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	<tr>
	  <td width="23">a.</td>
	  <td width="229"> Nilai Perolehan <i>( 11 + 12 ) </i></td>
	  <td width="25">=</td>
	  <td width="160" style="text-align:right"><?=fConvertToRupiah($tCol09+$tCol10)?></td>
	  </tr>
	<tr>
	  <td>b.</td>
	  <td>Beban Penyusutan Tahun <?=$rTH?>
		<i>(  14 ) </i></td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($tCol12)?></td>
	  </tr>
	<tr>
	  <td>c.</td>
	  <td>Koreksi di LPE <i>( 13 ) </i></td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($tCol11)?></td>
	  </tr>
	<tr>
	  <td>d.</td>
	  <td>Akumulasi Penyusutan <i>( b + c )</i></td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($tCol13)?></td>
	  </tr>
	<tr>
	  <td>e.</td>
	  <td>Nilai Akhir Buku <i>( a - d )</i></td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($tCol14)?></td>
	  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	</table>  </td>
  <td width="40">&nbsp;</td>
  <td></td>
</tr>
<tr>
  <td colspan="3" valign="top"><?php require "Lap_Bottom2.php"?></td>
  </tr>
</table>
<?php } ?>
<?php if ($DisPL){?>
<table border="0" align="center" width="1500" cellspacing="0" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td valign="top" style="border-bottom: 1px dashed #666666">&nbsp;</td>
</tr>
<tr>
  <td valign="top"><?=$DisPL?></td>
</tr>
</table>
<table border="0" align="center" width="1500" cellspacing="0" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td valign="top" width="40">PAGE : </td>
  <td valign="top">
  <div class="pagging"> 
	<?php
	$i=1;
	if ($CntItem>0)
	{
		for ($iR=0; $iR<=$CntItem; $iR=$iR+$rPG)
		{
			?>
			<a href="<?="Tabel_Masa_Manfaat_Rekap_Tahun.php?iPG=".$iR."&mts=".$mts."&ExtR=".$ExtR."&rTH=".$_GET['rTH']."&rAS=".$_GET['rAS']."&uNT=".$_GET['uNT']."&uUP=".$_GET['uUP']."&uSU=".$_GET['uSU']."&gHriC=".$_GET['gHriC']."&gBlnC=".$_GET['gBlnC']."&gThnC=".$_GET['gThnC']."&IdL=".$_GET['IdL']?>"><?="<b>".substr('00'.$i,-2,2)."</b>"?></a><?php if ($i==100) {echo "<br>";}?><?=str_repeat('&nbsp;',0)?>
			<?php 
			$i++;
		}
	}
	?>
  </div>  </td>
</tr>
</table>
<?php } ?>
</body>