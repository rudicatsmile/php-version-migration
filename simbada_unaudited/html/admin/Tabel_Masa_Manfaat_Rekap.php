<?
require "Connection.php";
require "FileFunction.php";
extract($_GET);

$rTH = $rTH;
$rAS = $rAS;
$uNT = $uNT;
$uSU = $uSU;
$uUP = $uUP;

$TbL = fNmHuruf((int)$rAS);
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

$DisPL = "";
$CntItem = fGlobalNEW("IfNull(count(*),0)","ta_kib_".$TbL,"Kd_UPB:Tgl_Perolehan",$uNT."%:".$rTH."-12-31","LIKE:<=","",DatabaseSB,$ConSB,"");
if ($CntItem>=$rPG){
	$DisPL = "Page ".(($iPG/$rPG)+1)." of ".round($CntItem/$rPG);
}
?>
<link rel="stylesheet" type="text/css" href="css/page.css" >
<body>
<table border="0" align="center" cellspacing="0" style="width:1400px; font-size: 8pt; font-family: Calibri; border-collapse: collapse">
  <tr>
    <td>
	<table border="0" align="center" width="1400" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
	<tr>
	  <td colspan="3" align="center" style="font-size: 13pt; font-weight: bold">REKAPITULASI DATA PENYUSUTAN</td>
	</tr>
	<tr>
	  <td colspan="3" align="center" style="font-size: 11pt; font-weight: bold"><?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset1","Kd_Aset",$rAS,"=","",DatabaseSB,$ConSB,""))?></td>
	</tr>
	<tr>
	  <td colspan="3" align="center" style="font-size: 10pt; font-weight: normal">PER 31 DESEMBER <?=$rTH?></td>
	</tr>
	<tr>
	  <td width="70" style="font-size: 10pt; font-weight: normal">UNIT KERJA </td>
	  <td width="28" style="font-size: 10pt; font-weight: normal">:</td>
	  <td width="1292" style="font-size: 10pt; font-weight: normal"><?=strtoupper(fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",$_GET['uNT'],"=","",DatabaseSB,$ConSB,""))?></td>
	</tr>
	<tr>
	  <td width="70" style="font-size: 10pt; font-weight: normal">SUB UNIT</td>
	  <td width="28" style="font-size: 10pt; font-weight: normal">:</td>
	  <td width="1292" style="font-size: 10pt; font-weight: normal"><? if ($_GET['uSU']=="All"){echo "Semua";}else{ echo strtoupper(fGlobalNEW("Nm_Sub","ref_sub_unit","Kd_Sub",$_GET['uSU'],"=","",DatabaseSB,$ConSB,""));}?></td>
	</tr>
	<tr>
	  <td width="70" style="font-size: 10pt; font-weight: normal">UPB</td>
	  <td width="28" style="font-size: 10pt; font-weight: normal">:</td>
	  <td width="1292" style="font-size: 10pt; font-weight: normal"><? if ($_GET['uUP']=="All"){echo "Semua";}else{echo strtoupper(fGlobalNEW("Nm_UPB","ref_upb","Kd_UPB",$_GET['uUP'],"=","",DatabaseSB,$ConSB,""));}?></td>
	</tr>
	<tr>
	  <td colspan="3">&nbsp;</td>
	</tr>
	<tr>
	  <td colspan="3"><?=$DisPL?></td>
	</tr>
	</table>
	<table border="0" align="center" width="1400" cellspacing="0" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
	  <tr height="20">
		<td width="30" style="text-align:center; font-weight:bold; border:1px solid #000000">NO</td>
		<td width="85" style="text-align:center; font-weight:bold; border:1px solid #000000">KODE BARANG</td>
		<td width="45" style="text-align:center; font-weight:bold; border:1px solid #000000">REGISTER</td>
		<td width="200" style="text-align:center; font-weight:bold; border:1px solid #000000">JENIS / OBJEK / NAMA BARANG</td>
		<td style="text-align:center; font-weight:bold; border:1px solid #000000">KETERANGAN</td>
		<td width="150" style="text-align:center; font-weight:bold; border:1px solid #000000">
		<?
		if ($TbL=="b") {echo "MERK / TYPE";}
		else if ($TbL=="c") {echo "LOKASI/ALAMAT";}
		else if ($TbL=="e") {echo "SPESIFIKASI/<br>JUDUL/PENCIPTA";}
		else {echo "LOKASI";}
		?>
		</td>
		<td width="100" style="text-align:center; font-weight:bold; border:1px solid #000000">
		<?
		if ($TbL=="b") {echo "UKURAN/BAHAN/<br>LAIN-LAIN";}
		else if ($TbL=="c") {echo "LUAS";}
		else if ($TbL=="e") {echo "UKURAN/BAHAN/<br>LAIN-LAIN";}
		else {echo "UKURAN";}
		?>
		
		</td>
		<td width="60" style="text-align:center; font-weight:bold; border:1px solid #000000">TAHUN PEROLEHAN</td>
		<td width="80" style="text-align:center; font-weight:bold; border:1px solid #000000">NILAI <br>PEROLEHAN</td>
		<td width="80" style="text-align:center; font-weight:bold; border:1px solid #000000">ATRIBUSI/<br>PENAMBAHAN</td>
		<td width="80" style="text-align:center; font-weight:bold; border:1px solid #000000">AKUMULASI PENYUSUTAN S.D <br>TAHUN <?=((int)$rTH-1)?></td>
		<td width="80" style="text-align:center; font-weight:bold; border:1px solid #000000">BEBAN PENYUSUTAN <br>TAHUN <?=$rTH?></td>
		<td width="80" style="text-align:center; font-weight:bold; border:1px solid #000000">AKUMULASI PENYUSUTAN S.D <br>TAHUN <?=$rTH?></td>
		<td width="80" style="text-align:center; font-weight:bold; border:1px solid #000000">NILAI BUKU</td>
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
	  </tr>
	  <?
	  $iG=$iPG+1;
	  $nSQ = "SELECT * FROM ta_kib_".$TbL." WHERE Kd_UPB LIKE '".$uNT."%' AND Tgl_Perolehan <= '".$rTH."-12-31' ORDER BY Tgl_Perolehan, Kd_Aset, No_Register LIMIT $iPG,$rPG";
	  $nRs = mysql_query($nSQ) or die(mysql_error());
	  while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	  {
		$rEF = $mRo['Referensi'];
		
		$Col01 = $iG++;
		$Col02 = $mRo['Kd_Aset'];
		$Col03 = $mRo['No_Register'];
		$Col04 = fGlobalNEW("Nm_Aset","ref_rek_aset3","Kd_Aset",substr($Col02,0,8),"=","",DatabaseSB,$ConSB,"");
		$Col04.= " / ".fGlobalNEW("Nm_Aset","ref_rek_aset4","Kd_Aset",substr($Col02,0,11),"=","",DatabaseSB,$ConSB,"");
		$Col04.= " / ".$mRo['Nm_Aset'];
		$Col05 = $mRo['Keterangan'];
		
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
		//$Col08 = substr($mRo['Tgl_Perolehan'],0,4);
		$Col08 = fConvertDateShort($mRo['Tgl_Perolehan']);
		$Col09 = $mRo['Harga'];
		
		$Col10 = fGlobalNEW("IfNull(sum(Nilai_Tambah),0)","        ta_kib_post_penyusutan","Referensi:PerLap",$rEF.":".$rTH,"=:<=","",DatabaseSB,$ConSB,"");
		$Col11 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","   ta_kib_post_penyusutan","Referensi:PerLap:Nilai_Akhir:Triwulan",$rEF.":".((int)$rTH-1).":Y:IV","=:=:=:=","",DatabaseSB,$ConSB,"");
		$Col12 = fGlobalNEW("IfNull(sum(Beban_Tahun_Berjalan),0)","ta_kib_post_penyusutan","Referensi:PerLap",$rEF.":".$rTH,"=:=","",DatabaseSB,$ConSB,"");
		
		$ColDT = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0):IfNull(sum(Nilai_Buku),0)","ta_kib_post_penyusutan","Referensi:PerLap:Nilai_Akhir:Triwulan",$rEF.":".$rTH.":Y:IV","=:=:=:=","",DatabaseSB,$ConSB,"");
		$ColDT = explode(":",$ColDT);
		$Col13 = $ColDT[0];
		$Col14 = $ColDT[1];
		
		$tCol09 = $tCol09 + $Col09;
		$tCol10 = $tCol10 + $Col10;
		$tCol11 = $tCol11 + $Col11;
		$tCol12 = $tCol12 + $Col12;
		$tCol13 = $tCol13 + $Col13;
		$tCol14 = $tCol14 + $Col14;
	  ?>
	  <tr height="23">
		<td valign="top" style="border:1px solid #000000; text-align:center"><?=$Col01?>.</td>
		<td valign="top" style="border:1px solid #000000; text-align:center"><?=$Col02?></td>
		<td valign="top" style="border:1px solid #000000; text-align:center"><?=$Col03?></td>
		<td valign="top" style="border:1px solid #000000; padding-left:2px"><?=$Col04?></td>
		<td valign="top" style="border:1px solid #000000; padding-left:2px"><?=$Col05?></td>
		<td valign="top" style="border:1px solid #000000; padding-left:2px"><?=$Col06?></td>
		<td valign="top" style="border:1px solid #000000; text-align:center"><?=$Col07?></td>
		<td valign="top" style="border:1px solid #000000; text-align:center"><?=$Col08?></td>
		<td valign="top" style="border:1px solid #000000; text-align:right; padding-right:3px"><?=fConvertToRupiah($Col09)?></td>
		<td valign="top" style="border:1px solid #000000; text-align:right; padding-right:3px"><?=fConvertToRupiah($Col10)?></td>
		<td valign="top" style="border:1px solid #000000; text-align:right; padding-right:3px"><?=fConvertToRupiah($Col11)?></td>
		<td valign="top" style="border:1px solid #000000; text-align:right; padding-right:3px"><?=fConvertToRupiah($Col12)?></td>
		<td valign="top" style="border:1px solid #000000; text-align:right; padding-right:3px"><?=fConvertToRupiah($Col13)?></td>
		<td valign="top" style="border:1px solid #000000; text-align:right; padding-right:3px"><?=fConvertToRupiah($Col14)?></td>
	  </tr>
	  <?
	  }
	  ?>
	  <tr height="20">
		<td colspan="8" style="border:1px solid #000000; font-weight:bold; text-align:center">TOTAL</td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol09)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol10)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol11)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol12)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol13)?></td>
		<td style="border:1px solid #000000; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tCol14)?></td>
	  </tr>
	</table>
    </td>
  </tr>
</table>
<? if ($DisPL){?>
<table border="0" align="center" width="1400" cellspacing="0" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td valign="top"><?=$DisPL?></td>
</tr>
</table>
<table border="0" align="center" width="1400" cellspacing="0" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td valign="top" width="40">PAGE : </td>
  <td valign="top">
  <div class="pagging"> 
	<?
	$i=1;
	if ($CntItem>0)
	{
		for ($iR=0; $iR<=$CntItem; $iR=$iR+$rPG)
		{
			?>
			<a href="<?="Tabel_Masa_Manfaat_Rekap.php?iPG=".$iR."&rTH=".$rTH."&rAS=".$rAS."&uNT=".$uNT."&gUnt=".$uNT."&gHriC=".$frHri."&gBlnC=".$frBln."&gThnC=".$frThn."&IdL=".$IdL?>"><?="<b>".substr('00'.$i,-3,3)."</b>"?></a><? if ($i==100) {echo "<br>";}?><?=str_repeat('&nbsp;',0)?>
			<? 
			$i++;
		}
	}
	?>
  </div>  </td>
</tr>
</table>
<? } ?>
<?
if ($CntItem==($iG-1)) {?>
<table border="0" align="center" width="1400" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td valign="top" width="450">
	<table border="0" align="left" width="450" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse">
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	<?
		$tCol09 = fGlobalNEW("IfNull(sum(Harga),0)","ta_kib_".$TbL,"Kd_UPB:Tgl_Perolehan",$uNT."%:".$rTH."-12-31","LIKE:<=","",DatabaseSB,$ConSB,"");
		
		$tCol10 = fGlobalNEW("IfNull(sum(Nilai_Tambah),0)","        ta_kib_post_penyusutan","Referensi:Kd_UPB:PerLap",$tRef."%:".$uNT."%:".$rTH,"LIKE:LIKE:<=","",DatabaseSB,$ConSB,"");
		$tCol11 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","   ta_kib_post_penyusutan","Referensi:Kd_UPB:PerLap:Nilai_Akhir:Triwulan",$tRef."%:".$uNT."%:".((int)$rTH-1).":Y:IV","LIKE:LIKE:=:=:=","",DatabaseSB,$ConSB,"");
		$tCol12 = fGlobalNEW("IfNull(sum(Beban_Tahun_Berjalan),0)","ta_kib_post_penyusutan","Referensi:Kd_UPB:PerLap",$tRef."%:".$uNT."%:".$rTH,"LIKE:LIKE:=","",DatabaseSB,$ConSB,"");
		
		$tCol13 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","   ta_kib_post_penyusutan","Referensi:Kd_UPB:PerLap:Nilai_Akhir:Triwulan",$tRef."%:".$uNT."%:".$rTH.":Y:IV","LIKE:LIKE:=:=:=","",DatabaseSB,$ConSB,"");
		$tCol14 = fGlobalNEW("IfNull(sum(Nilai_Buku),0)","          ta_kib_post_penyusutan","Referensi:Kd_UPB:PerLap:Nilai_Akhir:Triwulan",$tRef."%:".$uNT."%:".$rTH.":Y:IV","LIKE:LIKE:=:=:=","",DatabaseSB,$ConSB,"");
	?>
	<tr>
	  <td width="23">a.</td>
	  <td width="229"> Nilai Perolehan <i>( 9 + 10 ) </i></td>
	  <td width="25">=</td>
	  <td width="160" style="text-align:right"><?=fConvertToRupiah($tCol09+$tCol10)?></td>
	  </tr>
	<tr>
	  <td>b.</td>
	  <td>Beban Penyusutan Tahun <?=$rTH?>
		<i>(  12 ) </i></td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($tCol12)?></td>
	  </tr>
	<tr>
	  <td>c.</td>
	  <td>Koreksi di LPE <i>( 11 ) </i></td>
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
<? } ?>
</body>