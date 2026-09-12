<?php
require('../../Connection.php');
require('../../FileFunction.php');
require("../../CheckLogin.php");
extract($_GET);

$nSQ = " SELECT P1.Nomor as A0, P1.Kd_Unit as A1, P1.Tanggal as A2,
P1.Pencatat as A3,
P1.Recorded as A4 
FROM ta_pengadaan P1 
WHERE P1.IDT ='".$IdT."'";
#echo $nSQ."<br>";
$nRs = mysql_query($nSQ) or die(mysql_error());
$mRo = mysql_fetch_array($nRs, MYSQL_BOTH);
$NoM = $mRo[0];
$KdU = $mRo[1];
$ThN = $mRo[2];
$PcT = $mRo[3];
$PcM= fGlobal("Full_Name","ta_user","User_ID",$PcT,"=","","");
$ReC = fConvertDateShort(substr($mRo[4],0,10))." ".substr($mRo[4],-8,8);
$NmSkP= fGlobal("Nm_Unit","ref_unit","Kd_Unit",$KdU,"=","","");

$NoB = fGlobal("No_Berkas","ta_pengadaan","IDT",$IdT,"=","","");
$NiL = fGlobal("Nilai","ta_pengadaan","IDT",$IdT,"=","","");
$KdSB = fGlobal("Kd_SubKegiatan","ta_pengadaan","IDT",$IdT,"=","","");
$NmSB = fGlobal("Nm_SubKegiatan","ta_pengadaan","IDT",$IdT,"=","","");
$KdBL = fGlobal("Kd_Rek13","ta_pengadaan","IDT",$IdT,"=","","");
$NmBL = fGlobal("Nm_Rek13","ta_pengadaan","IDT",$IdT,"=","","");
$TgP  = fGlobal("Tg_Berita_Acara","ta_penerimaan_berkas","Nomor",$NoB,"=","","");

$DtA = fGlobal("TglPernyataan:NomPernyataan:NmaPenandatangan:NipPenandatangan:PktPenandatangan:JabPenandatangan:Selaku:Pada:NmaMengetahui:NipMengetahui:PktMengetahui:JabMengetahui:BntKontrak:PnyKontrak:NomKontrak:TglKontrak","ta_pengadaan_pernyataan","nomor",$NoM,"=","","");	
$DtA = explode(':',$DtA);
$TglL = $DtA[0];
$TglP = explode('-',$DtA[0]);
$TglH = $TglP[2];
$TglB = $TglP[1];
$TglT = $TglP[0];

$NomP = $DtA[1];
$NmaP = $DtA[2];
$NipP = $DtA[3];
$PktP = $DtA[4];
$JabP = $DtA[5];
$Sela = $DtA[6];
$Pada = $DtA[7];
$NmaM = $DtA[8];
$NipM = $DtA[9];
$PktM = $DtA[10];
$JabM = $DtA[11];

$BntK = $DtA[12];
$PnyK = $DtA[13];
$NomK = $DtA[14];
$TglK = $DtA[15];
?> 
<body>
<table border="0" width="600" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td></td>
    <td width="131" style="text-align:right; font-size:10pt">Format II.A.11.2</td>
  </tr>
</table>
<table border="0" width="600" cellspacing="0" cellpadding="0" align="center" style="border:1px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">PEMERINTAH <?=strtoupper($TiDaer." ".$NmDaer)?></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri"><?=strtoupper($NmSkP)?></td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri; text-decoration:underline">&nbsp;SURAT PERNYATAAN&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="text-align:center; font-size:10pt; font-family:calibri">Nomor : <?=$NomP?></td>
  </tr>
  
  <tr>
    <td colspan="3" >&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="padding-left:30">Pada hari ini <?=funcDayBI(date('l', strtotime($TglL)))?> tanggal <?=(int)$TglH." (".terbilang((int)$TglH).")"?> bulan <?=(int)$TglB." (".terbilang((int)$TglB).")"?> tahun <?=$TglT." (".terbilang((int)$TglT).")"?>, bertempat di <?=$NmIbuk." ".ucfirst(strtolower($TiDaer))." ".ucfirst(strtolower($NmDaer))?>.</td>
  </tr>
  <tr>
    <td colspan="3" style="padding-left:30">Yang bertanda tangan di bawah ini : </td>
  </tr>
  <tr>
    <td style="padding-left:60">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="175" style="padding-left:60">Nama</td>
    <td width="29">:</td>
    <td width="396"><?=$NmaP?></td>
  </tr>
  <tr>
    <td style="padding-left:60">NIP</td>
    <td>:</td>
    <td><?=$NipP?></td>
  </tr>
  <tr>
    <td style="padding-left:60">Pangkat/Gol.</td>
    <td>:</td>
    <td><?=$PktP?></td>
  </tr>
  <tr>
    <td style="padding-left:60">Jabatan</td>
    <td>:</td>
    <td><?=$JabP?></td>
  </tr>
  <tr>
    <td colspan="3" style="padding-left:30">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="padding-left:30px; padding-right:30px; text-align:justify">Selaku <?=$Sela?> pada <?=$Pada?> menyatakan bahwa, telah dilakukan pencatatan atau pembukuan sebagai Barang Milik Daerah yang diperoleh dari pengadaan APBD dengan rincian sebagai berikut :</td>
  </tr>
  <tr>
    <td colspan="3" style="padding-left:30">&nbsp;</td>
  </tr>
  <tr>
    <td width="175" style="padding-left:60">Kode sub Kegiatan</td>
    <td width="29">:</td>
    <td width="396"><?=$KdSB?></td>
  </tr>
  <tr>
    <td width="175" style="padding-left:60">Nama sub kegiatan</td>
    <td width="29">:</td>
    <td width="396"><?=$NmSB?></td>
  </tr>
  <tr>
    <td width="175" style="padding-left:60">Kode belanja</td>
    <td width="29">:</td>
    <td width="396"><?=$KdBL?></td>
  </tr>
  <tr>
    <td width="175" style="padding-left:60">Uraian belanja</td>
    <td width="29">:</td>
    <td width="396"><?=$NmBL?></td>
  </tr>
  <tr>
    <td width="175" style="padding-left:60">Bentuk Kontrak</td>
    <td width="29">:</td>
    <td width="396"><?=$BntK?></td>
  </tr>
  <tr>
    <td width="175" style="padding-left:60">a. Nama penyedia</td>
    <td width="29">:</td>
    <td width="396"><?=$PnyK?></td>
  </tr>
  <tr>
    <td width="175" style="padding-left:60">b. Nomor</td>
    <td width="29">:</td>
    <td width="396"><?=$NomK?></td>
  </tr>
  <tr>
    <td width="175" style="padding-left:60">c. Tanggal</td>
    <td width="29">:</td>
    <td width="396"><?=fConvertDateShort($TglK)?></td>
  </tr>
  <tr>
    <td width="175" style="padding-left:60">Tanggal Perolehan</td>
    <td width="29">:</td>
    <td width="396"><?=fConvertDateShort($TgP)?></td>
  </tr>
  <tr>
    <td width="175" style="padding-left:60">Nilai (Rp.)</td>
    <td width="29">:</td>
    <td width="396"><?=fConvertToRupiahBulat($NiL)?>,-</td>
  </tr>
  
  <tr>
    <td colspan="3" style="padding-left:30">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" style="padding-left:30px; padding-right:30px">Demikian surat pernyataan ini dibuat untuk dipergunakan seperlunya, apabila terdapat kekeliruan akan dilakukan perbaikan sesuai ketentuan.</td>
  </tr>
  <tr>
    <td colspan="3" style="padding-left:30">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
	<table width="600" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse; font-family:Calibri; font-size:10pt">
	<tr>
	  <td width="250" align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td width="250" align="center">&nbsp;</td>
	</tr>
	<tr>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center"><?=$NmIbuk.", ".fConvertDateLongsBln($TglL)?></td>
	</tr>
	<tr height="30" valign="bottom">
	  <td align="center">Mengetahui,<br><?=$JabM?></td>
	  <td align="center">&nbsp;</td>
	  <td align="center"><?=$JabP?></td>
	  </tr>
	<tr height="80">
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	</tr>
	<tr style="font-weight:bold; text-decoration:underline">
	  <td align="center"><?=$NmaM?></td>
	  <td align="center"></td>
	  <td align="center"><?=$NmaP?></td>
	</tr>
	<tr>
	  <td align="center"><?=$NipM?></td>
	  <td align="center">&nbsp;</td>
	  <td align="center"><?=$NipP?></td>
	</tr>
	</table>	</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
