<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$eBLM = 0;
$eSDH = 0;
$nSQL= "SELECT P1.Referensi as A0, P2.Nilai as A1, P1.Referensi_SP3B as A2, P3.Deskripsi as A3, P2.Tgl_SP3D as A4, P2.Nom_SP3D as A5, P4.Deskripsi as A6,
P1.Tgl_Kontrak as A7, P1.Tgl_BAST as A8, P1.Tgl_Faktur as A9,
P1.Nom_Kontrak as A10, P1.Nom_BAST as A11, P1.Nom_Faktur as A12, P1.Uraian as A13, Nm_ReknP90 as A14, Kd_ReknP90 as A15 
FROM ta_sp3d_spj P1 
LEFT JOIN ta_sp3d P2 ON P2.Referensi=P1.Referensi_SP3B 
LEFT JOIN ref_sp3d_jenis P3 ON P3.Kode=P2.KdJenis 
LEFT JOIN ref_session P4 ON P4.Kode=P2.KdSesi 
WHERE P1.IDT='$eIdT'";
$nRs = mysql_query($nSQL) or die(mysql_error());
$mRo = mysql_fetch_array($nRs);
$sRef = $mRo[0];
$eNiL = $mRo[1];
$eREF = $mRo[2];
$eJNS = $mRo[3];
$eTGL = $mRo[4];
$eNOM = $mRo[5];
$eTHP = $mRo[6];

$TglKon = explode('-',$mRo[7]);
$gTHKon = $TglKon[0];
$gBLKon = $TglKon[1];
$gHRKon = $TglKon[2];

$TglBas = explode('-',$mRo[8]);
$gTHBas = $TglBas[0];
$gBLBas = $TglBas[1];
$gHRBas = $TglBas[2];

$TglFak = explode('-',$mRo[9]);
$gTHFak = $TglFak[0];
$gBLFak = $TglFak[1];
$gHRFak = $TglFak[2];

$eNomKon = $mRo[10];
$eNomBas = $mRo[11];
$eNomFak = $mRo[12];
$eUraian = $mRo[13];
$eRKN    = $mRo[14];
$dRKN    = $mRo[15];

$nILR = fGlobal("IfNull(sum(Nilai),0)","ta_sp3d_rinci","Referensi:Kd_ReknP90",$eREF.":".$dRKN,"=:=","","");

/*$nSQL= "SELECT Kd_ReknP90, Nm_ReknP90, Nilai
FROM ta_sp3d_rinci 
WHERE Referensi='$eREF' ORDER BY IDT";
$nRs = mysql_query($nSQL) or die(mysql_error());
while ($mRo = mysql_fetch_array($nRs))
{
	if ($i==1){
		$eRKN = $mRo[0]." : ".$mRo[1];
	}
	else{
		$geKN.= "; ".$mRo[0]." : ".$mRo[1];
	}
	$i++;
}


$eSDH = fGlobal("IfNull(sum(Nilai),0)","ta_sp3d_spj","Referensi_SP3B",$eREF,"=","","");
$eBLM = $eNiL-$eSDH;
$WaR = "";
if ($eBLM > 0){
	$WaR = "; color:#0000FF";
}
else if ($eBLM < 0){
	$WaR = "; color:#FF0000";
}

$eSIS = 0;//$eNiL - fGlobal("IfNull(sum(Nilai),0)","ta_sp3d_spj","Referensi_SP3B:Referensi",$eREF.":".$sRef,"=:<>","","s");
$rCek = "N";
*/
?>
<table border="0" width="900" height="300" cellspacing="0" cellpadding="0" align="center" style=" font-size:10pt">
  <tr height="5">
    <td width="6"></td>
    <td width="99" class="ar"></td>
    <td width="23" class="ac"></td>
    <td width="268"></td>
    <td width="79"></td>
    <td width="41"></td>
    <td width="233"></td>
    <td colspan="2"></td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td style="font-size:11pt; font-weight:bold; text-shadow: #ff0000 0px 1px 0px; border-bottom:3px double #993300">DATA SP3B</td>
    <td style="font-size:11pt; font-weight:bold; text-shadow: #ff0000 0px 1px 0px; border-bottom:3px double #993300">&nbsp;</td>
    <td style="font-size:11pt; font-weight:bold; text-shadow: #ff0000 0px 1px 0px; border-bottom:3px double #993300">&nbsp;</td>
    <td style="font-size:11pt; font-weight:bold; text-shadow: #ff0000 0px 1px 0px; border-bottom:3px double #993300">&nbsp;</td>
    <td width="121" style="font-size:11pt; font-weight:bold; text-shadow: #ff0000 0px 1px 0px; border-bottom:3px double #993300">&nbsp;</td>
    <td width="30" style="font-size:11pt; font-weight:bold; text-shadow: #ff0000 0px 1px 0px">&nbsp;</td>
  </tr>
  <tr height="5">
    <td></td>
    <td class="ar"></td>
    <td class="ac"></td>
    <td>&nbsp;</td>
    <td class="ar"></td>
    <td class="ac"></td>
    <td></td>
    <td colspan="2"></td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">Referensi SP3B</td>
    <td class="ac">:</td>
    <td><input name="fREF3" type="text" value="<?=$eREF?>" readonly="readonly" style=" width:150px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Nomor SP3B</td>
    <td class="ac">:</td>
    <td><input name="fREF24" type="text" value="<?=$eNOM?>" style=" width:150px; border: 1px solid #C0C0C0"/></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">Tanggal SP3B </td>
    <td class="ac">:</td>
    <td><input name="fREF22222" type="text" value="<?=fConvertDateShort($eTGL)?>" readonly style="width:150px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Jenis SP3B </td>
    <td class="ac">:</td>
    <td><input name="fREF222222" type="text" value="<?=$eJNS?>" readonly style="width:150px; border: 1px solid #C0C0C0"/></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">Nilai SP3B </td>
    <td class="ac">:</td>
    <td><input name="fREF222" type="text" value="<?=fConvertToRupiah($eNiL)?>" readonly style="width:150px; border: 1px solid #C0C0C0; text-align:right; padding-right:3px"/></td>
    <td class="ar">Tahap</td>
    <td class="ac">:</td>
    <td><input name="fREF2222222" type="text" value="<?=$eTHP?>" readonly="readonly" style="width:150px; border: 1px solid #C0C0C0"/></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">Rekening SP3B</td>
    <td class="ac">:</td>
    <td><input name="fREF223" type="text" value="<?=$eRKN?>" readonly style=" width:270px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Nilai Rek. Ini </td>
    <td class="ac">:</td>
    <td><input name="fREF22222222" type="text" value="<?=fConvertToRupiah($nILR)?>" readonly="readonly" style="width:147px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/>
    </td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr height="10">
    <td>&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr height="20">
    <td>&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td style="font-size:11pt; font-weight:bold; text-shadow: #ff0000 0px 1px 0px; border-bottom:3px double #993300">INPUT DATA BERKAS</td>
    <td style="border-bottom:3px double #993300">&nbsp;</td>
    <td style="border-bottom:3px double #993300">&nbsp;</td>
    <td style="border-bottom:3px double #993300">&nbsp;</td>
    <td style="border-bottom:3px double #993300">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="5">
    <td></td>
    <td class="ar"></td>
    <td class="ac"></td>
    <td>&nbsp;</td>
    <td class="ar"></td>
    <td class="ac"></td>
    <td></td>
    <td colspan="2"></td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">Referensi</td>
    <td class="ac">:</td>
    <td>
    <input name="fRefSPJ" type="text" value="<?=$sRef?>" readonly="readonly" style=" width:120px; border: 1px solid #C0C0C0; background:#99FF00"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">Tanggal Kontrak </td>
    <td class="ac">:</td>
    <td>
	<select class="boxs" name="fHRKon" id="fHRKon" tabindex="0" style="width:50px">
	<option value="00"></option>
      <?php
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gHRKon) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="fBLKon" id="fBLKon" tabindex="0" style="width:95px">
	<option value="00"></option>
	<?php
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBLKon) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTHKon" id="fTHKon" style="width:60px" tabindex="0">
	<option value="0000"></option>
 	<?php
	for($i=2019; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTHKon) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select>	</td>
    <td class="ar">Tanggal Faktur</td>
    <td class="ac">:</td>
    <td>
	<select class="boxs" name="fHRFak" id="fHRFak" tabindex="0" style="width:50px">
	<option value="00"></option>
      <?php
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gHRFak) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="fBLFak" id="fBLFak" tabindex="0" style="width:95px">
	<option value="00"></option>
	<?php
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBLFak) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTHFak" id="fTHFak" style="width:60px" tabindex="0">
	<option value="0000"></option>
 	<?php
	for($i=2019; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTHFak) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select>    </td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">Nomor Kontrak </td>
    <td class="ac">:</td>
    <td><input name="fNomKon" id="fNomKon" type="text" value="<?=$eNomKon?>" style=" width:200px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Nomor Faktur</td>
    <td class="ac">:</td>
    <td><input name="fNomFak" id="fNomFak" type="text" value="<?=$eNomFak?>" style=" width:200px; border: 1px solid #C0C0C0"/></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">Tanggal BAST </td>
    <td class="ac">:</td>
    <td>
	<select class="boxs" name="fHRBas" id="fHRBas" tabindex="0" style="width:50px">
	<option value="00"></option>
      <?php
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gHRBas) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="fBLBas" id="fBLBas" tabindex="0" style="width:95px">
	<option value="00"></option>
	<?php
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBLBas) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTHBas" id="fTHBas" style="width:60px" tabindex="0">
	<option value="0000"></option>
 	<?php
	for($i=2019; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTHBas) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select>	</td>
    <td class="ar">Uraian</td>
    <td class="ac">:</td>
    <td colspan="3" rowspan="3">
	<textarea name="fUrai" id="fUrai" style="border: 1px solid #C0C0C0; height:70px; width:290px"><?=$eUraian?></textarea></td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">Nomor BAST </td>
    <td class="ac">:</td>
    <td><input name="fNomBas" id="fNomBas" type="text" value="<?=$eNomBas?>" style=" width:200px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>	</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
  </tr>
  <tr height="27">
    <td>&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td><input type="button" name="B39" <?=$DisA?> value="SAVE" onclick="SaveMidSPJ('<?=$eIdT?>','<?=$rCek?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
    <input type="button" name="B392" <?=$DisA?> value="CLOSE" onclick="closeCLICK('spj'); return false" style="width: 80px; height: 21px" /></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr height="100%">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
