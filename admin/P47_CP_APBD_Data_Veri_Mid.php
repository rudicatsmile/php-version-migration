<?php
require('Connection.php');
require('FileFunction.php');
require('CheckLogin.php');
extract($_GET);

function fNmDesk($nX)
{
	$Nm= array ('','Kode sub kegiatan','Uraian sub kegiatan',' 	Kode belanja','Uraian belanja','Kode barang','Nama barang','Spesifikasi nama barang','Tgl, Bulan, Tahun Perolehan','Jumlah Barang','Harga Satuan Barang','Biaya Atribusi');
	return $Nm[$nX];
}

###########
$NoM = fGlobal("Nomor","ta_pengadaan","IDT",$IdT,"=","","");
for ($i=1; $i<=11; $i++)
{
	$Cek = fGlobal("IDT","ta_pengadaan_verifikasi","Nomor:NoID",$NoM.":".$i,"=:=","","");	
	if ($Cek=='')
	{
		$SQ="INSERT INTO ta_pengadaan_verifikasi SET 
		Nomor='".$NoM."',
		NoID='".$i."',
		Deskripsi='".fNmDesk($i)."',
		Sesuai='Y',
		Jumlah='0',
		Keterangan='-',
		Recorded=now(),
		Pencatat='".$UID."'";
		mysql_query($SQ);
	}
}

$i = "12a";
$Cek = fGlobal("IDT","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":".$i,"=:=","","");	
if ($Cek=='')
{
	$SQ="INSERT INTO ta_pengadaan_verifikasi SET 
	Nomor='".$NoM."',
	NoID='".$i."',
	Sesuai='Y',
	Jumlah='0',
	Keterangan='-',
	Recorded=now(),
	Pencatat='".$UID."'";
	mysql_query($SQ);
}

$i = "12b";
$Cek = fGlobal("IDT","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":".$i,"=:=","","");	
if ($Cek=='')
{
	$SQ="INSERT INTO ta_pengadaan_verifikasi SET 
	Nomor='".$NoM."',
	NoID='".$i."',
	Sesuai='Y',
	Jumlah='0',
	Keterangan='-',
	Recorded=now(),
	Pencatat='".$UID."'";
	mysql_query($SQ);
}

$i = "12c";
$Cek = fGlobal("IDT","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":".$i,"=:=","","");	
if ($Cek=='')
{
	$SQ="INSERT INTO ta_pengadaan_verifikasi SET 
	Nomor='".$NoM."',
	NoID='".$i."',
	Sesuai='Y',
	Jumlah='0',
	Keterangan='-',
	Recorded=now(),
	Pencatat='".$UID."'";
	mysql_query($SQ);
}

$i = "Ct1";
$Cek = fGlobal("IDT","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":".$i,"=:=","","");	
if ($Cek=='')
{
	$SQ="INSERT INTO ta_pengadaan_verifikasi SET 
	Nomor='".$NoM."',
	NoID='".$i."',
	Sesuai='Y',
	Jumlah='0',
	Keterangan='-',
	Recorded=now(),
	Pencatat='".$UID."'";
	mysql_query($SQ);
}

$i = "Ct2";
$Cek = fGlobal("IDT","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":".$i,"=:=","","");	
if ($Cek=='')
{
	$SQ="INSERT INTO ta_pengadaan_verifikasi SET 
	Nomor='".$NoM."',
	NoID='".$i."',
	Sesuai='Y',
	Jumlah='0',
	Keterangan='-',
	Recorded=now(),
	Pencatat='".$UID."'";
	mysql_query($SQ);
}

$i = "Ct3";
$Cek = fGlobal("IDT","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":".$i,"=:=","","");	
if ($Cek=='')
{
	$SQ="INSERT INTO ta_pengadaan_verifikasi SET 
	Nomor='".$NoM."',
	NoID='".$i."',
	Sesuai='Y',
	Jumlah='0',
	Keterangan='-',
	Recorded=now(),
	Pencatat='".$UID."'";
	mysql_query($SQ);
}

$Cek = fGlobal("IDT","ta_pengadaan_verifikator","nomor",$NoM,"=","","");	
if ($Cek=='')
{
	$SQ="INSERT INTO ta_pengadaan_verifikator SET 
	Nomor='".$NoM."',
	TglVerifikasi=now(),
	JbtVerifikator='',
	NmaVerifikator='',
	NipVerifikator='',
	Recorded=now(),
	Pencatat='".$UID."'";
	mysql_query($SQ);
}
########################

$DtA = fGlobal("TglVerifikasi:JbtVerifikator:NmaVerifikator:NipVerifikator","ta_pengadaan_verifikator","nomor",$NoM,"=","","");	
$DtA = explode(":",$DtA);

$fVrTg = explode("-",$DtA [0]);
$fVrTg = $fVrTg[2]."/".$fVrTg[1]."/".$fVrTg[0];

$fVrJb = $DtA [1];
$fVrNm = $DtA [2];
$fVrNi = $DtA [3];

$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":1","=:=","","");	
$DtA = explode(":",$DtA);
$fB  = $DtA[0];
$fJm1= $DtA[1];
$fKt1= $DtA[2];
$fB1a = "";
$fB1b = "";
if ($fB=='Y') {$fB1a = "checked";}
else {$fB1b = "checked";}

?>
<table align="center" border="0" width="1000" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-family:calibri; font-size:10pt">
  <tr height="5" style="text-align:center; font-weight:bold">
    <td width="50"></td>
    <td width="35"></td>
    <td width="186"></td>
    <td width="63"></td>
    <td width="72"></td>
    <td width="69"></td>
    <td width="28"></td>
    <td width="39"></td>
    <td width="44"></td>
    <td width="18"></td>
    <td width="248"></td>
    <td></td>
  </tr>
	<?php
	$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":1","=:=","","");	
	$DtA = explode(":",$DtA);
	$fB  = $DtA[0];
	$fJm1= $DtA[1];
	$fKt1= $DtA[2];
	$fB1a = "";
	$fB1b = "";
	if ($fB=='Y') {$fB1a = "checked";}
	else {$fB1b = "checked";}
	?>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="text-align:center">1.</td>
    <td><?=fNmDesk(1)?></td>
    <td style="text-align:center"><label><input name="fB1" id="fB1" <?=$fB1a?> type="radio" value="Y" onclick="saveRecordVeri('Sesuai','1','Y','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Sesuai</label></td>
    <td style="text-align:center"><label><input name="fB1" id="fB1" <?=$fB1b?> type="radio" value="N" onclick="saveRecordVeri('Sesuai','1','N','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Tidak</label>	</td>
    <td style="text-align:right">Jumlah</td>
    <td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fJm1" id="fJm1" value="<?php if ($fJm1!=0) {echo $fJm1;}?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Jumlah','1',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:30px; text-align:center" /></td>
    <td style="text-align:right">Ket.</td>
    <td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fKt1" id="fKt1" value="<?=$fKt1?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Keterangan','1',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px" /></td>
    <td>&nbsp;</td>
  </tr>
	<?php
	$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":2","=:=","","");	
	$DtA = explode(":",$DtA);
	$fB  = $DtA[0];
	$fJm2= $DtA[1];
	$fKt2= $DtA[2];
	$fB2a = "";
	$fB2b = "";
	if ($fB=='Y') {$fB2a = "checked";}
	else {$fB2b = "checked";}
	?>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="text-align:center">2.</td>
    <td><?=fNmDesk(2)?></td>
    <td style="text-align:center"><label><input name="fB2" id="fB2" <?=$fB2a?> type="radio" value="Y" onclick="saveRecordVeri('Sesuai','2','Y','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Sesuai</label></td>
    <td style="text-align:center"><label><input name="fB2" id="fB2" <?=$fB2b?> type="radio" value="N" onclick="saveRecordVeri('Sesuai','2','N','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Tidak</label>	</td>
	<td style="text-align:right">Jumlah</td>
	<td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fJm2" id="fJm2" value="<?php if ($fJm2!=0) {echo $fJm2;}?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Jumlah','2',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:30px; text-align:center" /></td>
    <td style="text-align:right">Ket.</td>
    <td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fKt2" id="fKt2" value="<?=$fKt2?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Keterangan','2',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px" /></td>
    <td>&nbsp;</td>
  </tr>
	<?php
	$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":3","=:=","","");	
	$DtA = explode(":",$DtA);
	$fB  = $DtA[0];
	$fJm3= $DtA[1];
	$fKt3= $DtA[2];
	$fB3a = "";
	$fB3b = "";
	if ($fB=='Y') {$fB3a = "checked";}
	else {$fB3b = "checked";}
	?>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="text-align:center">3.</td>
    <td><?=fNmDesk(3)?></td>
    <td style="text-align:center"><label><input name="fB3" id="fB3" <?=$fB3a?> type="radio" value="Y" onclick="saveRecordVeri('Sesuai','3','Y','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Sesuai</label></td>
    <td style="text-align:center"><label><input name="fB3" id="fB3" <?=$fB3b?> type="radio" value="N" onclick="saveRecordVeri('Sesuai','3','N','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Tidak</label>	</td>
	<td style="text-align:right">Jumlah</td>
	<td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fJm3" id="fJm3" value="<?php if ($fJm3!=0) {echo $fJm3;}?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Jumlah','3',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:30px; text-align:center" /></td>
    <td style="text-align:right">Ket.</td>
    <td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fKt3" id="fKt3" value="<?=$fKt3?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Keterangan','3',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px" /></td>
    <td>&nbsp;</td>
  </tr>
	<?php
	$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":4","=:=","","");	
	$DtA = explode(":",$DtA);
	$fB  = $DtA[0];
	$fJm4= $DtA[1];
	$fKt4= $DtA[2];
	$fB4a = "";
	$fB4b = "";
	if ($fB=='Y') {$fB4a = "checked";}
	else {$fB4b = "checked";}
	?>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="text-align:center">4.</td>
    <td><?=fNmDesk(4)?></td>
    <td style="text-align:center"><label><input name="fB4" id="fB4" <?=$fB4a?> type="radio" value="Y" onclick="saveRecordVeri('Sesuai','4','Y','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Sesuai</label></td>
    <td style="text-align:center"><label><input name="fB4" id="fB4" <?=$fB4b?> type="radio" value="N" onclick="saveRecordVeri('Sesuai','4','N','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Tidak</label>	</td>
	<td style="text-align:right">Jumlah</td>
	<td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fJm4" id="fJm4" value="<?php if ($fJm4!=0) {echo $fJm4;}?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Jumlah','4',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:30px; text-align:center" /></td>
    <td style="text-align:right">Ket.</td>
    <td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fKt4" id="fKt4" value="<?=$fKt4?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Keterangan','4',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px" /></td>
    <td>&nbsp;</td>
  </tr>
	<?php
	$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":5","=:=","","");	
	$DtA = explode(":",$DtA);
	$fB  = $DtA[0];
	$fJm5= $DtA[1];
	$fKt5= $DtA[2];
	$fB5a = "";
	$fB5b = "";
	if ($fB=='Y') {$fB5a = "checked";}
	else {$fB5b = "checked";}
	?>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="text-align:center">5.</td>
    <td><?=fNmDesk(5)?></td>
    <td style="text-align:center"><label><input name="fB5" id="fB5" <?=$fB5a?> type="radio" value="Y" onclick="saveRecordVeri('Sesuai','5','Y','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Sesuai</label></td>
    <td style="text-align:center"><label><input name="fB5" id="fB5" <?=$fB5b?> type="radio" value="N" onclick="saveRecordVeri('Sesuai','5','N','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Tidak</label>	</td>
	<td style="text-align:right">Jumlah</td>
	<td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fJm5" id="fJm5" value="<?php if ($fJm5!=0) {echo $fJm5;}?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Jumlah','5',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:30px; text-align:center" /></td>
    <td style="text-align:right">Ket.</td>
    <td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fKt5" id="fKt5" value="<?=$fKt5?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Keterangan','5',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px" /></td>
    <td>&nbsp;</td>
  </tr>
	<?php
	$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":6","=:=","","");	
	$DtA = explode(":",$DtA);
	$fB  = $DtA[0];
	$fJm6= $DtA[1];
	$fKt6= $DtA[2];
	$fB6a = "";
	$fB6b = "";
	if ($fB=='Y') {$fB6a = "checked";}
	else {$fB6b = "checked";}
	?>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="text-align:center">6.</td>
    <td><?=fNmDesk(6)?></td>
    <td style="text-align:center"><label><input name="fB6" id="fB6" <?=$fB6a?> type="radio" value="Y" onclick="saveRecordVeri('Sesuai','6','Y','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Sesuai</label></td>
    <td style="text-align:center"><label><input name="fB6" id="fB6" <?=$fB6b?> type="radio" value="N" onclick="saveRecordVeri('Sesuai','6','N','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Tidak</label>	</td>
	<td style="text-align:right">Jumlah</td>
	<td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fJm6" id="fJm6" value="<?php if ($fJm6!=0) {echo $fJm6;}?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Jumlah','6',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:30px; text-align:center" /></td>
    <td style="text-align:right">Ket.</td>
    <td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fKt6" id="fKt6" value="<?=$fKt6?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Keterangan','6',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px" /></td>
    <td>&nbsp;</td>
  </tr>
	<?php
	$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":7","=:=","","");	
	$DtA = explode(":",$DtA);
	$fB  = $DtA[0];
	$fJm7= $DtA[1];
	$fKt7= $DtA[2];
	$fB7a = "";
	$fB7b = "";
	if ($fB=='Y') {$fB7a = "checked";}
	else {$fB7b = "checked";}
	?>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="text-align:center">7.</td>
    <td><?=fNmDesk(7)?></td>
    <td style="text-align:center"><label><input name="fB7" id="fB7" <?=$fB7a?> type="radio" value="Y" onclick="saveRecordVeri('Sesuai','7','Y','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Sesuai</label></td>
    <td style="text-align:center"><label><input name="fB7" id="fB7" <?=$fB7b?> type="radio" value="N" onclick="saveRecordVeri('Sesuai','7','N','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Tidak</label>	</td>
	<td style="text-align:right">Jumlah</td>
	<td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fJm7" id="fJm7" value="<?php if ($fJm7!=0) {echo $fJm7;}?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Jumlah','7',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:30px; text-align:center" /></td>
    <td style="text-align:right">Ket.</td>
    <td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fKt7" id="fKt7" value="<?=$fKt7?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Keterangan','7',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px" /></td>
    <td>&nbsp;</td>
  </tr>
	<?php
	$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":8","=:=","","");	
	$DtA = explode(":",$DtA);
	$fB  = $DtA[0];
	$fJm8= $DtA[1];
	$fKt8= $DtA[2];
	$fB8a = "";
	$fB8b = "";
	if ($fB=='Y') {$fB8a = "checked";}
	else {$fB8b = "checked";}
	?>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="text-align:center">8.</td>
    <td><?=fNmDesk(8)?></td>
    <td style="text-align:center"><label><input name="fB8" id="fB8" <?=$fB8a?> type="radio" value="Y" onclick="saveRecordVeri('Sesuai','8','Y','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Sesuai</label></td>
    <td style="text-align:center"><label><input name="fB8" id="fB8" <?=$fB8b?> type="radio" value="N" onclick="saveRecordVeri('Sesuai','8','N','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Tidak</label>	</td>
	<td style="text-align:right">Jumlah</td>
	<td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fJm8" id="fJm8" value="<?php if ($fJm8!=0) {echo $fJm8;}?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Jumlah','8',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:30px; text-align:center" /></td>
    <td style="text-align:right">Ket.</td>
    <td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fKt8" id="fKt8" value="<?=$fKt8?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Keterangan','8',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px" /></td>
    <td>&nbsp;</td>
  </tr>
	<?php
	$DtA = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":9","=:=","","");	
	$DtA = explode(":",$DtA);
	$fB  = $DtA[0];
	$fJm9= $DtA[1];
	$fKt9= $DtA[2];
	$fB9a = "";
	$fB9b = "";
	if ($fB=='Y') {$fB9a = "checked";}
	else {$fB9b = "checked";}
	?>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="text-align:center">9.</td>
    <td><?=fNmDesk(9)?></td>
    <td style="text-align:center"><label><input name="fB9" id="fB9" <?=$fB9a?> type="radio" value="Y" onclick="saveRecordVeri('Sesuai','9','Y','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Sesuai</label></td>
    <td style="text-align:center"><label><input name="fB9" id="fB9" <?=$fB9b?> type="radio" value="N" onclick="saveRecordVeri('Sesuai','9','N','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Tidak</label>	</td>
	<td style="text-align:right">Jumlah</td>
	<td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fJm9" id="fJm9" value="<?php if ($fJm9!=0) {echo $fJm9;}?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Jumlah','9',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:30px; text-align:center" /></td>
    <td style="text-align:right">Ket.</td>
    <td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fKt9" id="fKt9" value="<?=$fKt9?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Keterangan','9',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px" /></td>
    <td>&nbsp;</td>
  </tr>
	<?php
	$DtA   = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":10","=:=","","");	
	$DtA   = explode(":",$DtA);
	$fB    = $DtA[0];
	$fJm10 = $DtA[1];
	$fKt10 = $DtA[2];
	$fB10a = "";
	$fB10b = "";
	if ($fB=='Y') {$fB10a = "checked";}
	else {$fB10b = "checked";}
	?>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="text-align:center">10.</td>
    <td><?=fNmDesk(10)?></td>
    <td style="text-align:center"><label><input name="fB10" id="fB10" <?=$fB10a?> type="radio" value="Y" onclick="saveRecordVeri('Sesuai','10','Y','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Sesuai</label></td>
    <td style="text-align:center"><label><input name="fB10" id="fB10" <?=$fB10b?> type="radio" value="N" onclick="saveRecordVeri('Sesuai','10','N','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Tidak</label>	</td>
	<td style="text-align:right">Jumlah</td>
	<td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fJm10" id="fJm10" value="<?php if ($fJm10!=0) {echo $fJm10;}?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Jumlah','10',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:30px; text-align:center" /></td>
    <td style="text-align:right">Ket.</td>
    <td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fKt10" id="fKt10" value="<?=$fKt10?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Keterangan','10',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px" /></td>
    <td>&nbsp;</td>
  </tr>
	<?php
	$DtA   = fGlobal("Sesuai:Jumlah:Keterangan","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":11","=:=","","");	
	$DtA   = explode(":",$DtA);
	$fB    = $DtA[0];
	$fJm11 = $DtA[1];
	$fKt11 = $DtA[2];
	$fB11a = "";
	$fB11b = "";
	if ($fB=='Y') {$fB11a = "checked";}
	else {$fB11b = "checked";}
	?>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="text-align:center">11.</td>
    <td><?=fNmDesk(11)?></td>
    <td style="text-align:center"><label><input name="fB11" id="fB11" <?=$fB11a?> type="radio" value="Y" onclick="saveRecordVeri('Sesuai','11','Y','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Sesuai</label></td>
    <td style="text-align:center"><label><input name="fB11" id="fB11" <?=$fB11b?> type="radio" value="N" onclick="saveRecordVeri('Sesuai','11','N','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Tidak</label>	</td>
	<td style="text-align:right">Jumlah</td>
	<td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fJm11" id="fJm11" value="<?php if ($fJm11!=0) {echo $fJm11;}?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Jumlah','11',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:30px; text-align:center" /></td>
    <td style="text-align:right">Ket.</td>
    <td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fKt11" id="fKt11" value="<?=$fKt11?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Keterangan','11',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px" /></td>
    <td>&nbsp;</td>
  </tr>
	<?php
	$DtA   = fGlobal("Sesuai:Jumlah:Keterangan:Deskripsi","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":12a","=:=","","");	
	$DtA   = explode(":",$DtA);
	$fB    = $DtA[0];
	$fJm12a = $DtA[1];
	$fKt12a = $DtA[2];
	$fDs12a = $DtA[3];
	$fB12aa = "";
	$fB12ab = "";
	if ($fB=='Y') {$fB12aa = "checked";}
	else {$fB12ab = "checked";}
	?>
  <tr height="24">
    <td>&nbsp;</td>
    <td align="center">12.</td>
    <td>a. <input type="text" name="fDs12a" id="fDs12a" value="<?=$fDs12a?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Deskripsi','12a',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:160px" /></td>
    <td style="text-align:center"><label><input name="fB12a" id="fB12a" <?=$fB12aa?> type="radio" value="Y" onclick="saveRecordVeri('Sesuai','12a','Y','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Sesuai</label></td>
    <td style="text-align:center"><label><input name="fB12a" id="fB12a" <?=$fB12ab?> type="radio" value="N" onclick="saveRecordVeri('Sesuai','12a','N','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Tidak</label>	</td>
	<td style="text-align:right">Jumlah</td>
	<td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fJm12a" id="fJm12a" value="<?php if ($fJm12a!=0) {echo $fJm12a;}?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Jumlah','12a',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:30px; text-align:center" /></td>
    <td style="text-align:right">Ket.</td>
    <td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fKt12a" id="fKt12a" value="<?=$fKt12a?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Keterangan','12a',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px" /></td>
    <td>&nbsp;</td>
  </tr>
	<?php
	$DtA   = fGlobal("Sesuai:Jumlah:Keterangan:Deskripsi","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":12b","=:=","","");	
	$DtA   = explode(":",$DtA);
	$fB    = $DtA[0];
	$fJm12b = $DtA[1];
	$fKt12b = $DtA[2];
	$fDs12b = $DtA[3];
	$fB12ba = "";
	$fB12bb = "";
	if ($fB=='Y') {$fB12ba = "checked";}
	else {$fB12bb = "checked";}
	?>
  <tr height="24">
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>b. <input type="text" name="fDs12b" id="fDs12b" value="<?=$fDs12b?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Deskripsi','12b',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:160px" /></td>
    <td style="text-align:center"><label><input name="fB12b" id="fB12b" <?=$fB12ba?> type="radio" value="Y" onclick="saveRecordVeri('Sesuai','12b','Y','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Sesuai</label></td>
    <td style="text-align:center"><label><input name="fB12b" id="fB12b" <?=$fB12bb?> type="radio" value="N" onclick="saveRecordVeri('Sesuai','12b','N','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Tidak</label>	</td>
	<td style="text-align:right">Jumlah</td>
	<td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fJm12b" id="fJm12b" value="<?php if ($fJm12b!=0) {echo $fJm12b;}?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Jumlah','12b',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:30px; text-align:center" /></td>
    <td style="text-align:right">Ket.</td>
    <td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fKt12b" id="fKt12b" value="<?=$fKt12b?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Keterangan','12b',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px" /></td>
    <td>&nbsp;</td>
  </tr>
	<?php
	$DtA   = fGlobal("Sesuai:Jumlah:Keterangan:Deskripsi","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":12c","=:=","","");	
	$DtA   = explode(":",$DtA);
	$fB    = $DtA[0];
	$fJm12c = $DtA[1];
	$fKt12c = $DtA[2];
	$fDs12c = $DtA[3];
	$fB12ca = "";
	$fB12cb = "";
	if ($fB=='Y') {$fB12ca = "checked";}
	else {$fB12cb = "checked";}
	?>
  <tr height="24">
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>c. <input type="text" name="fDs12b" id="fDs12c" value="<?=$fDs12c?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Deskripsi','12c',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:160px" /></td>
    <td style="text-align:center"><label><input name="fB12c" id="fB12c" <?=$fB12ca?> type="radio" value="Y" onclick="saveRecordVeri('Sesuai','12c','Y','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Sesuai</label></td>
    <td style="text-align:center"><label><input name="fB12c" id="fB12c" <?=$fB12cb?> type="radio" value="N" onclick="saveRecordVeri('Sesuai','12c','N','<?=$NoM?>','<?=$IdT?>','<?=$IdL?>')" />Tidak</label>	</td>
	<td style="text-align:right">Jumlah</td>
	<td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fJm12c" id="fJm12c" value="<?php if ($fJm12c!=0) {echo $fJm12c;}?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Jumlah','12c',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:30px; text-align:center" /></td>
    <td style="text-align:right">Ket.</td>
    <td style="text-align:center">:</td>
    <td style="text-align:center"><input type="text" name="fKt12c" id="fKt12c" value="<?=$fKt12c?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Keterangan','12c',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px" /></td>
    <td>&nbsp;</td>
  </tr>
</table>
<table align="center" border="0" width="1000" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-family:calibri; font-size:10pt">
  <tr>
    <td width="50">&nbsp;</td>
    <td width="53">&nbsp;</td>
    <td width="323">&nbsp;</td>
    <td width="70">&nbsp;</td>
    <td width="20">&nbsp;</td>
    <td width="215">&nbsp;</td>
    <td width="140">&nbsp;</td>
    <td width="129">&nbsp;</td>
  </tr>
	<?php
	$DtA   = fGlobal("Deskripsi","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":Ct1","=:=","","");	
	$DtA   = explode(":",$DtA);
	$fCt1  = $DtA[0];
	?>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Catatan</td>
    <td><input type="text" name="fCt1" id="fCt1" value="<?=$fCt1?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Deskripsi','Ct1',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:300px" /></td>
    <td>Verifikator</td>
    <td>:</td>
    <td><input type="text" name="fVrNm" id="fVrNm" value="<?=$fVrNm?>" onkeypress="if (event.keyCode==13){saveRecordVeri('NmaVerifikator','xx',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:200px" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
	<?php
	$DtA   = fGlobal("Deskripsi","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":Ct2","=:=","","");	
	$DtA   = explode(":",$DtA);
	$fCt2  = $DtA[0];
	?>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="text" name="fCt2" id="fCt2" value="<?=$fCt2?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Deskripsi','Ct2',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:300px" /></td>
    <td>N I P</td>
    <td>:</td>
    <td><input type="text" name="fVrNi" id="fVrNi" value="<?=$fVrNi?>" onkeypress="if (event.keyCode==13){saveRecordVeri('NipVerifikator','xx',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:200px" /></td>
    <td>Tanggal Verifikasi : </td>
    <td>&nbsp;</td>
  </tr>
	<?php
	$DtA   = fGlobal("Deskripsi","ta_pengadaan_verifikasi","nomor:NoID",$NoM.":Ct3","=:=","","");	
	$DtA   = explode(":",$DtA);
	$fCt3  = $DtA[0];
	?>
  <tr height="24">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="text" name="fCt3" id="fCt3" value="<?=$fCt3?>" onkeypress="if (event.keyCode==13){saveRecordVeri('Deskripsi','Ct3',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:300px" /></td>
    <td>Jabatan</td>
    <td>:</td>
    <td><input type="text" name="fVrJb" id="fVrJb" value="<?=$fVrJb?>" onkeypress="if (event.keyCode==13){saveRecordVeri('JbtVerifikator','xx',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:200px" /></td>
    <td><input type="text" name="fVrTg" id="fVrTg" value="<?=$fVrTg?>" onkeypress="if (event.keyCode==13){saveRecordVeri('TglVerifikasi','xx',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:100px; text-align:center" /></td>
    <td><a href="#" onClick="formCetakDok('Format_II_A_11.1','<?=$IdT?>','800','400','<?=$IdL?>'); return false" class="ico docu">&nbsp;&nbsp;Format II.A.11.1</a></td>
  </tr>
  <tr height="5">
    <td></td>
    <td></td>
    <td colspan="6"></td>
  </tr>
</table>
