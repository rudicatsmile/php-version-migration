<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
#echo $UID;
#echo $eIdT."<br>".$IdTR;

$KdReknP90 = fGlobal("Kd_ReknP90","ta_sp3d_spj","IDT",$eIdT,"=","","");
$NmReknP90 = fGlobal("Nm_ReknP90","ta_sp3d_spj","IDT",$eIdT,"=","","");
$NomBAST   = fGlobal("Nom_BAST","ta_sp3d_spj","IDT",$eIdT,"=","","");

$KdReknP108 = fGlobal("Kd_ReknP108","ta_sp3d_spj","IDT",$eIdT,"=","","");
$NmReknP108 = fGlobal("Nm_ReknP108","ta_sp3d_spj","IDT",$eIdT,"=","","");

$nSQ = "SELECT Nm_Aset as A0, Tgl_Perolehan as A1, JmlSatuan as A2, Harga as A3, Total as A4, Pencatat as A5, Aprove as A6,
AprovBY as A7 
FROM ta_sp3d_spj_rinci WHERE IDT='".$IdTR."'";
$nRs = mysql_query($nSQ);
$mRo = mysql_fetch_array($nRs);
$NmAst = $mRo[0];
$TglPR = $mRo[1];
$JmlST = $mRo[2];
$HrgST = $mRo[3];
$TotNL = $mRo[4];
$NmPCT = $mRo[5];
$NmLKP = fGlobal("Full_Name","ta_user","User_ID",$NmPCT,"=","","");
$Aprov = $mRo[6];
$AprBY = $mRo[7];

if ($AprBY!=''){
	$NmUSR = $AprBY;
}
else{
	$NmUSR = $UID;
}
$NmAPR = fGlobal("Full_Name","ta_user","User_ID",$NmUSR,"=","","");

	   
$sTa= "";
$sTb= "";
$sTc= "";
if ($Aprov=='aproved'){
	$sTb= "style='color:#FF0000'";
}
if ($Aprov=='ditolak'){
	$sTc= "style='color:#FF0000'";
}


?>
<table align="center" cellpadding="0" cellspacing="0" width="800" border="0" style="font-size:10pt; font-family:calibri">
	<tr height="20">
		<td width="150">&nbsp;</td>
		<td width="30">&nbsp;</td>
		<td width="182">&nbsp;</td>
		<td width="105"><div id="loadingImg2" style="width:40px; height:10px; display:none; text-align:center"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></td>
		<td width="30">&nbsp;</td>
		<td width="303">&nbsp;</td>
	</tr>
	
	<tr height="27">
	  <td style="text-align:right">BELANJA</td>
	  <td style="text-align:center">:</td>
	  <td colspan="4"><input name="dUNT4" id="dUNT4" type="text" value="<?=$KdReknP90." : ".$NmReknP90?>" readonly style="padding-left:5px; width:466px; border: 1px solid #C0C0C0"/></td>
  </tr>
	
	<tr height="27">
	  <td style="text-align:right">KAPITALISASI</td>
	  <td style="text-align:center">:</td>
	  <td colspan="4"><input name="dUNT" id="dUNT" type="text" value="<?=$KdReknP108." : ".$NmReknP108?>" readonly style="padding-left:5px; width:466px; border: 1px solid #C0C0C0"/>	    </td></td>
	</tr>
	<tr height="27">
		<td style="text-align:right">NAMA ASET</td>
		<td style="text-align:center">:</td>
		<td colspan="4"><input name="dUNT2" id="dUNT2" type="text" value="<?=$NmAst?>" readonly style="padding-left:5px; width:466px; border: 1px solid #C0C0C0"/></td>
	</tr>
	<tr height="27">
	  <td style="text-align:right">TGL. PEROLEHAN</td>
	  <td style="text-align:center">:</td>
	  <td><input name="dUNT3222" id="dUNT3222" type="text" value="<?=fConvertDateShort($TglPR)?>" readonly style="padding-right:5px; width:70px; border: 1px solid #C0C0C0"/></td>
	  <td style="text-align:right">DIINPUT OLEH </td>
	  <td style="text-align:center">:</td>
	  <td><input name="dUNT222" id="dUNT222" type="text" value="<?=$NmPCT?>" readonly="readonly" style="padding-left:5px; width:150px; border: 1px solid #C0C0C0"/></td>
  </tr>
	<tr height="27">
	  <td style="text-align:right">NOMOR BAST</td>
	  <td style="text-align:center">:</td>
	  <td><input name="dUNT22" id="dUNT22" type="text" value="<?=$NomBAST?>" readonly style="padding-left:5px; width:150px; border: 1px solid #C0C0C0"/></td>
	  <td style="text-align:right">NAMA</td>
	  <td style="text-align:center">:</td>
	  <td><input name="dUNT224" id="dUNT224" type="text" value="<?=$NmLKP?>" readonly="readonly" style="padding-left:5px; width:150px; border: 1px solid #C0C0C0"/></td>
  </tr>
	<tr height="27">
		<td style="text-align:right">JUMLAH SATUAN</td>
		<td style="text-align:center">:</td>
		<td style="color:#FF0000"><input name="dUNT3" id="dUNT3" type="text" value="<?=fConvertToRupiahBulat($JmlST)?>" readonly style="text-align:right; padding-right:5px; width:50px; border: 1px solid #C0C0C0"/> **</td>
		<td style="text-align:right">DIAPROVE OLEH</td>
		<td style="text-align:center">:</td>
		<td><input name="dUNT223" id="dUNT223" type="text" value="<?=$NmUSR?>" readonly="readonly" style="padding-left:5px; width:150px; border: 1px solid #C0C0C0"/></td>
	</tr>
	<tr height="27">
	  <td style="text-align:right">HARGA SATUAN</td>
	  <td style="text-align:center">:</td>
	  <td style="color:#FF0000"><input name="dUNT32" id="dUNT32" type="text" value="<?=fConvertToRupiah($HrgST)?>" readonly style="text-align:right; padding-right:5px; width:110px; border: 1px solid #C0C0C0"/> **</td>
	  <td style="text-align:right">NAMA</td>
	  <td style="text-align:center">:</td>
	  <td><input name="dUNT225" id="dUNT225" type="text" value="<?=$NmAPR?>" readonly="readonly" style="padding-left:5px; width:150px; border: 1px solid #C0C0C0"/></td>
	</tr>
	<tr height="27">
	  <td style="text-align:right">NILAI TOTAL</td>
	  <td style="text-align:center">:</td>
	  <td><input name="dUNT322" id="dUNT322" type="text" value="<?=fConvertToRupiah($TotNL)?>" readonly style="text-align:right; padding-right:5px; width:110px; border: 1px solid #C0C0C0"/></td>
	  <td style="text-align:right">STATUS</td>
	  <td style="text-align:center">:</td>
	  <td>
	  <label <?=$sTa?>><input name="radioApp" type="radio" value="none" <?php if ($Aprov=='none'){echo "checked";}?> />None</label>&nbsp;
	  <label <?=$sTb?>><input name="radioApp" type="radio" value="aproved" <?php if ($Aprov=='aproved'){echo "checked";}?> />
	  <?php if ($Aprov=='aproved') {echo "Aproved"; } else {echo "Aprove";}?>
	  </label>&nbsp;
	  <label <?=$sTc?>><input name="radioApp" type="radio" value="ditolak" <?php if ($Aprov=='ditolak'){echo "checked";}?> />Tolak</label>&nbsp;	  </td>
	</tr>
	<tr height="50">
	  <td>&nbsp;</td>
	  <td colspan="5" style="font-style:italic; color:#FF9900">
	  Mohon perhatikan field yang bertanda <font style="color:#FF0000">**</font> sebelum memilih Aprove dan menekan tombol PROSES<br>Nilai jangan sampai tertukar antara keduanya, terima kasih.	  </td>
	</tr>
	<tr height="1">
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	</tr>
	<tr height="27">
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="button" name="B392" value="PROSES" onclick="prosesAPROVE('','<?=$eIdT?>','<?=$IdTR?>','<?=$rCek?>','<?=$IdL?>')" style="width:80px; height:22px" /></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	<tr height="27">
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
</table>

