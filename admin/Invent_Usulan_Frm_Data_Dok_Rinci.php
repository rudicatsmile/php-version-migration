<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
if ($IdT)
{
	$nSQL= "SELECT Referensi,Kd_UPB,Tanggal,Nomor,Jenis,Dokumen_Nom,Dokumen_Tgl,Uraian 
	FROM ta_usulan_108 WHERE IDT='$IdT'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_array($nRs);
	$gREF = $mRo[0];
	$gUNT = substr($mRo[1],0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	
	$dTgL = $mRo[2];
	$TH2  = substr($mRo[2],0,4);
	$dNoM = (int)substr($mRo[3],0,8)."/".substr($mRo[3],9,10);
	$dJnS = fGlobal("Deskripsi","ref_usulan_jenis","Kode",$mRo[4],"=","","");
	$mRo4 = $mRo[4];
	$dDokNom = $mRo[5];
	$dDokTgL = $mRo[6];
}
?>

<body style="padding:0px">
<table border="0" width="1505" cellspacing="1" style="font-size: 8pt; font-family: calibri; border-collapse: collapse">
	<tr>
		<td style="font-size: 12pt; font-weight: bold" align="center">PEMERINTAH <?=$TiDaer." ".$NmDaer?></td>
	</tr>
	<tr>
		<td style="font-size: 12pt; font-weight: bold" align="center">RINCIAN USULAN MUTASI ASET TETAP</td>
	</tr>
	<tr>
	  <td style="font-size: 12pt; font-weight: bold" align="center">&nbsp;</td>
  </tr>
</table>
<table border="0" width="1500" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse" id="table1">
	<tr>
		<td width="113">UNIT KERJA</td>
		<td width="20">:</td>
		<td width="437"><?=$dUNT?></td>
		<td width="115">JENIS USULAN </td>
	    <td width="25">:</td>
	    <td width="471"><?=$dJnS?></td>
	</tr>
	<tr>
	  <td>TANGGAL USULAN </td>
	  <td>:</td>
	  <td><?=fConvertDateLongsBln($dTgL)?></td>
	  <td>DOKUMEN TANGGAL </td>
      <td>:</td>
      <td><?=$dDokNom?></td>
  </tr>
	<tr>
	  <td>NOMOR URULAN </td>
	  <td>:</td>
	  <td><?=$dNoM?></td>
	  <td>DOKUMEN NOMOR </td>
      <td>:</td>
      <td><?php if ($dDokTgL!="0000-00-00"){echo fConvertDateLongsBln($dDokTgL);}?></td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
  </tr>
</table>
<table border="0" width="1500" cellspacing="0" style="font-size: 9pt; font-family: Calibri; border-collapse: collapse" id="table1">
  <tr height="20" style="text-align:center; font-weight:bold">
    <td width="32" rowspan="2" style="border:1px #000000 solid">NO</td>
    <td width="112" rowspan="2" style="border:1px #000000 solid">REFERENSI</td>
    <td width="92" rowspan="2" style="border:1px #000000 solid">KODE</td>
    <td width="62" rowspan="2" style="border:1px #000000 solid">REGISTER</td>
    <td width="176" rowspan="2" style="border:1px #000000 solid">NAMA ASET </td>
    <td width="349" rowspan="2" style="border:1px #000000 solid">DESKRIPSI</td>
    <td colspan="2" style="border:1px #000000 solid">PEROLEHAN</td>
    <td width="90" rowspan="2" style="border:1px #000000 solid">NILAI AKHIR</td>
    <td colspan="4" style="border:1px #000000 solid; background:#ffffcc">PENYUSUTAN</td>
  </tr>
  <tr height="20" style="text-align:center; font-weight:bold">
	<td width="55" style="border:1px #000000 solid">TAHUN</td>
	<td width="90" style="border:1px #000000 solid">NILAI</td>
    <td width="90" style="border:1px #000000 solid; background:#ffffcc">Akumulasi Penyusutan s.d Tahun <?=((int)$TH2-2)?></td>
    <td width="90" style="border:1px #000000 solid; background:#ffffcc">Beban Penyusutan Tahun <?=((int)$TH2-1)?></td>
    <td width="90" style="border:1px #000000 solid; background:#ffffcc">Akumulasi Penyusutan s.d Tahun <?=((int)$TH2-1)?></td>
    <td width="90" style="border:1px #000000 solid; background:#ffffcc">Nilai Buku</td>
  </tr>
	<?php
	$iG=1;
	$tRo7 = 0;
	$tRo8 = 0;
	$nSQ = "SELECT 
	IDT as A0,
	Ref_Aset as A1,
	Kd_Aset as A2,
	No_Register as A3,
	Nm_Aset as A4,
	Tgl_Perolehan as A5,
	Uraian as A6,
	Harga as A7,
	Nilai_Akhir as A8,
	To_UPB as A9,
	Kd_UPB as A10 
	FROM ta_usulan_rinci_108 WHERE Referensi='$gREF' ORDER BY IDT";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
	if ($mRo[6]!="-" && $mRo[6]!=""){
		$mRo6 = $mRo[6];
	}
	else{
		$mRo[6]="";
	}
	if ($mRo4=="MS"){
		if ($mRo6!=""){
			$br="<br>";
		}
		else{
			$br="";
		}
		$mRo6=$br."<i>Mutasi ke : ".fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo[9],0,11),"=","","")."</i>";
	}
	
	$rUPB = substr($mRo[10],0,11);
	$rEF  = $mRo[1];
	$TbL  = fNmHuruf((int)$rAS);
	$rTH  = $TH2;
	$sM   = "%";
	
	if ($mRo4=="RB" || $mRo4=="LE" || $mRo4=="HB")	#Cek apakah sudah masuk proses penghapusan
	{
		$DTm = fGlobal("Referensi_To:Kd_UPB_To","ta_kib_108_mutasi","Referensi:Kd_UPB:Jns_Mutasi",$rEF.":".$rUPB."%:".$mRo4,"=:LIKE:=","","");
		if ($DTm){
			$DTm = explode(':',$DTm);
			$rEF = $DTm[0];
			$rUPB= substr($DTm[1],0,11);
		}
	}
	
	if (substr($mRo[1],0,3)=="TNH")
	{
		$mRo9  = 0;
		$mRo10 = 0;
		$mRo11 = 0;
		$mRo12 = $mRo[8];
	}
	else
	{
		$mRo9  = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap",$rUPB."%:".$rEF.":".((int)$rTH-2),"LIKE:=:=:=","",DatabaseSB,$ConSB,"");
		$mRo10 = fGlobalNEW("IfNull(sum(Penyusutan),0)","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap",$rUPB."%:".$rEF.":".((int)$rTH-1),"LIKE:=:=:=","",DatabaseSB,$ConSB,"");
		$mRo11  = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0)","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap",$rUPB."%:".$rEF.":".((int)$rTH-1),"LIKE:=:=:=","",DatabaseSB,$ConSB,"");
		$mRo12  = fGlobalNEW("IfNull(sum(Nilai_Buku_Akhir),0)","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap",$rUPB."%:".$rEF.":".((int)$rTH-1),"LIKE:=:=:=","",DatabaseSB,$ConSB,"");
	}
	
	$tRo9 = $tRo9 +$mRo9;
	$tRo10= $tRo10+$mRo10;
	$tRo11= $tRo11+$mRo11;
	$tRo12= $tRo12+$mRo12;
	?>
	  <tr height="25">
		<td style="border:1px #000000 solid; text-align:center"><?=$iG?>.</td>
		<td style="border:1px #000000 solid; text-align:center"><?=$mRo[1]?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=$mRo[2]?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=$mRo[3]?></td>
		<td style="border:1px #000000 solid; padding-left:5px"><?=$mRo[4]?></td>
		<td style="border:1px #000000 solid; padding-left:5px"><?=$mRo6?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=substr($mRo[5],0,4)?></td>
		<td style="border:1px #000000 solid; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[7])?></td>
	    <td style="border:1px #000000 solid; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[8])?></td>
	    <td style="border:1px #000000 solid; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo9)?></td>
	    <td style="border:1px #000000 solid; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo10)?></td>
	    <td style="border:1px #000000 solid; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo11)?></td>
	    <td style="border:1px #000000 solid; text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo12)?></td>
	  </tr>
	<?php
		$tRo7 = $tRo7+$mRo[7];
		$tRo8 = $tRo8+$mRo[8];
		$iG++;
	}
	?>
	<?php if ($iG==1){?>
  <tr>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
    <td style="border:1px #000000 solid">&nbsp;</td>
  </tr>
  <?php } ?>
  <tr height="28">
    <td colspan="7" style="border:1px #000000 solid; text-align:center; font-weight:bold">T O T A L</td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tRo7)?></td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tRo8)?></td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tRo9)?></td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tRo10)?></td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tRo11)?></td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:3px"><?=fConvertToRupiah($tRo12)?></td>
  </tr>
</table>
<table border="0" width="1505" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse">
	<?php 
	$gUpb = $gUNT;
	require "Dokumen_Footer.php";
	?>
	<tr>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
    </tr>
	<tr>
		<td width="50" align="center">&nbsp;</td>
		<td width="230" align="center">Mengetahui,</td>
		<td align="center">&nbsp;</td>
		<td align="center" width="230"><?php echo $NmIbKt.", ".fConvertDateLongsBln($dTgL)?></td>
		<td align="center" width="50">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
		<td width="230" align="center" style="font-weight: bold"><?php echo $FotA[1]?></td>
		<td align="center">&nbsp;</td>
		<td align="center" style="font-weight: bold" width="230"><?php echo $FotC[1]?></td>
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
		<td width="230" align="center" style="font-weight: bold"><u><?php echo $FotA[2]?></u></td>
		<td align="center">&nbsp;</td>
		<td align="center" style="font-weight: bold" width="230"><u><?php echo $FotC[2]?></u></td>
		<td align="center" style="font-weight: bold" width="50">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center">&nbsp;</td>
		<td width="230" align="center">NIP. <?php echo $FotA[3]?></td>
		<td align="center">&nbsp;</td>
		<td align="center" width="230">NIP. <?php echo $FotC[3]?></td>
		<td align="center" width="50">&nbsp;</td>
	</tr>
</table>
</body>