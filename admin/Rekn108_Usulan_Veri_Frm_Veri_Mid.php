<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
//echo $IdT;
require('Rekn108_Usulan_Veri_Frm_Veri_Imp.php');

$gH = fGetDate('mday');
$gB = fGetDate('mon');
$gT = fGetDate('year');
if ($rID)
{
	$nSQ = "SELECT Referensi, Ref_Usulan, Kd_Unit, Nomor, Tanggal, Nma_Verifikator, Jab_Verifikator, Nip_Verifikator, Uraian 
	FROM ta_permohonan_repla_rek_aset_verifikasi WHERE IDT='$rID'";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$mRo0 = $mRo[0];
		$mRo1 = $mRo[1];
		$KdUP = $mRo[2];
		$mRo2 = strtoupper(fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo[2],0,11),"=","",""));
		$mRo3 = $mRo[3];
		$mRo4 = $mRo[4];
		$mRo4 = explode('-',$mRo4);
		$gH = $mRo4[2];
		$gB = $mRo4[1];
		$gT = $mRo4[0];
		$mRo5 = $mRo[5];
		$mRo6 = $mRo[6];
		$mRo7 = $mRo[7];
		$mRo8 = $mRo[8];
	}
}
?>
<body>
<br>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1080px; height:120px; background-color:#D2DAC4">
  <tr height="15">
    <td width="10"></td>
    <td width="74"></td>
    <td width="11"></td>
    <td colspan="4"></td>
    <td colspan="2"></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">TANGGAL</td>
    <td>&nbsp;</td>
    <td width="294">
	<select class="boxs" name="fH" tabindex="0" style="width:50px" onclick="RefreshDATA('<?=$IdL?>')">
      <?php
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gH) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="fB" tabindex="0" style="width:80px" onclick="RefreshDATA('<?=$IdL?>')">
	<?php
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gB) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fT" style="width: 60px" tabindex="0" onclick="RefreshDATA('<?=$IdL?>')">
 	<?php
	for($i=2014; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gT) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select>	</td>
    <td width="103" align="right">VERIFIKATOR</td>
    <td width="18">&nbsp;</td>
    <td width="217"><input name="fNmA" type="text" value="<?=$mRo5?>" maxlength="150" style="padding-left:5px; height:15px; width:187px; border: 1px solid #C0C0C0"/></td>
    <td width="49">MEMO</td>
    <td width="304" rowspan="3" valign="top"><textarea name="fMeM" style="border: 1px solid #C0C0C0; height:68px; width:260px"><?=$mRo8?></textarea></td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">NOMOR</td>
    <td>&nbsp;</td>
    <td><input name="fNoM" type="text" value="<?=$mRo3?>" style="padding-left:5px; height:15px; width:187px; border: 1px solid #C0C0C0"/></td>
    <td align="right">JABATAN</td>
    <td>&nbsp;</td>
    <td><input name="fJbT" type="text" value="<?=$mRo6?>" maxlength="100" style="padding-left:5px; height:15px; width:187px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">SKPD</td>
    <td>&nbsp;</td>
    <td><input name="fSkP" type="text" value="<?=$mRo2?>" readonly style="padding-left:5px; height:15px; width:280px; border: 1px solid #C0C0C0"/></td>
    <td align="right">NIP</td>
    <td>&nbsp;</td>
    <td><input name="fNiP" type="text" value="<?=$mRo7?>" maxlength="35" style="padding-left:5px; height:15px; width:187px; border: 1px solid #C0C0C0"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">
	<div id="loadingImg" style="width:40px; height:10px; display:none"><img src="Images/loading3.gif" alt="" width="30" height="30"></div>	</td>
    <td>&nbsp;</td>
    <td><input type="button" name="B3923" value="SAVE" onClick="SaveDATA('<?=$PgE?>','<?=$rID?>','<?=$IdT?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
    <input type="button" name="B39232" value="REFRESH" onClick="showFORM('refr','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>')" style="width: 80px; height: 21px" />	</td>
    <td align="right" colspan="2" style="padding-right:38px">
	<?php if ($UID=='creator'){?>
	<input type="button" name="B13" value="None (All)" onClick="editCLICK('0all','<?=$PgE?>','','<?=$IdT?>','<?=$IdL?>')" style="width: 88px; height: 21px; color:#FF0000" />
	<input type="button" name="B14" value="Ya (All)" onClick="editCLICK('1all','<?=$PgE?>','','<?=$IdT?>','<?=$IdL?>')" style="width: 85px; height: 21px; color:#FF0000" />
	<input type="button" name="B15" value="Tidak (All)" onClick="editCLICK('2all','<?=$PgE?>','','<?=$IdT?>','<?=$IdL?>')" style="width: 88px; height: 21px; color:#FF0000" />
	<?php } ?>	</td>
  </tr>
  <tr height="15">
    <td></td>
    <td></td>
    <td></td>
    <td colspan="4"></td>
    <td colspan="2"></td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1080px; height:23px; background-color:#C9DCD8">
  <tr>
  <td style="padding-left:10px; font-weight:bold; font-size:13px; text-shadow: #fff 1px 1px 1px">:: RINCIAN REKENING YANG DIUSULKAN
	<div id="exceMstVeri" class="creator0Veri" style="background-color: #C9DCD8">
		<div id="exceDiv1Veri" class="creator1Veri"></div>
		<div id="exceDiv2Veri" class="creator2Veri" style="background-color: #C9DCD8"></div>
		<div id="exceDiv3Veri" class="creator3Veri" style="background-color: #C9DCD8"></div>
	</div>	
	
  </td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1080px; height:23px; background-color:#C9DCD8">
  <tr>
  <td style="width:30px; border-right: 1px solid #ccc; text-align:center">NO</td>
  <td style="width:100px; border-right: 1px solid #ccc; text-align:center">KODE 17</td>
  <td style="width:254px; border-right: 1px solid #ccc; text-align:center">DESKRIPSI 17</td>
  <td style="width:110px; border-right: 1px solid #ccc; text-align:center">KODE 108</td>
  <td style="border-right: 1px solid #ccc; text-align:center">DESKRIPSI 108</td>
  <td style="width:80px; border-right: 1px solid #ccc; text-align:center">ASET</td>
  <td style="width:197px; text-align:center">STATUS DISETUJUI</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1080px; height:200px">
  <tr>
    <td>
	<div id="ViewDETA" style="height:200px; width:100%; overflow:auto; border:0px">
	<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="100%" style="border:0px">
	<?php
	$iG=$PgE+1;
	$SQ = "SELECT IDT, Kd_Rekening_17, Kd_Rekening_108, CheckList, Status, Executed 
	FROM ta_permohonan_repla_rek_aset_rinci WHERE Referensi='$mRo1' ORDER BY IDT LIMIT $PgE,50";
	//echo $SQ;
	$Rs = mysql_query($SQ);
	while ($nRo = mysql_fetch_array($Rs, MYSQL_BOTH))
	{
		$tID  = $nRo[0];
		$mRo1 = $nRo[1];
		$mRo2 = $nRo[2];
		$mRo3 = $nRo[3];
		$mRo4 = $nRo[4];
		$mRo5 = $nRo[5];
		
		$gBG  = fBackCLR($iG);
		
		$nX = (int)substr($mRo1,0,2);
		$gNmA = fGlobal("Nm_Aset","ref_rek_aset5","Kd_Aset",$mRo1,"=","","");
		$gCnT = fGlobal("IfNull(count(*),0)","ta_kib_".fNmHuruf($nX),"Kd_Aset:Kd_UPB",$mRo1.":".$UnT."%","=:LIKE","","");
		
		if ($mRo2){
			$gNmB = fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$mRo2,"=","","");
			$gExe = "Y";
		}else{
			$mRo2 = "<font style='color:#ff0000'>???</font>";
			$gNmB = "-";
			$gExe = "N";
		}
		
		$eCK0 = "";
		$eCK1 = "";
		$eCK2 = "";
		
		$eCL1 = "";
		$eCL2 = "";
			
		if ($mRo4=="Belum"){
			$eCK0 = "checked";
		}
		if ($mRo4=="Disetujui"){
			$eCK1 = "checked";
			$eCL1 = "style='color:#0000FF'";
		}
		if ($mRo4=="Ditolak"){
			$eCK2 = "checked";
			$eCL2 = "style='color:#FF0000'";
			
		}
		
		$mSG = "";
		?>
		<tr height="23">
		  <td valign="top" <?=$gBG?> width="30" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc"><?=$iG?>.</td>
		  <td valign="top" <?=$gBG?> width="100" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc"><?=$mRo1?></td>
		  <td valign="top" <?=$gBG?> width="250" style="border-bottom: 1px dotted #999; border-right: 1px solid #ccc; padding-left:4px"><?=$gNmA?></td>
		  <td valign="top" <?=$gBG?> width="110" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc"><?=$mRo2?></td>
		  <td valign="top" <?=$gBG?> style="border-bottom: 1px dotted #999; border-right: 1px solid #ccc; padding-left:4px"><?=$gNmB?></td>
		  <td valign="top" <?=$gBG?> width="80" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc"><?=fConvertToRupiahBulat($gCnT)?> item</td>
		  <td valign="top" <?=$gBG?> width="180" style="border-bottom: 1px dotted #999; text-align:center">
		  <?php if ($mRo5=='Y'){echo "<i><img src='css/images/okey.gif'> Executed</i>";} else {?>
		  <?php if ($mRo3=="Y" && $gExe=="Y"){?>
		  <label><input name="radio<?=$tID?>" type="radio" value="0" <?=$eCK0?> onClick="editCLICK('0','<?=$PgE?>','<?=$tID?>','<?=$IdT?>','<?=$IdL?>')">None</label>&nbsp;&nbsp;&nbsp;
		  <label <?=$eCL1?>><input name="radio<?=$tID?>" type="radio" value="1" <?=$eCK1?> onClick="editCLICK('1','<?=$PgE?>','<?=$tID?>','<?=$IdT?>','<?=$IdL?>')">Ya</label>&nbsp;&nbsp;&nbsp;
		  <label <?=$eCL2?>><input name="radio<?=$tID?>" type="radio" value="2" <?=$eCK2?> onClick="editCLICK('2','<?=$PgE?>','<?=$tID?>','<?=$IdT?>','<?=$IdL?>')">Tidak</label>
		  <?php }} ?>
		  </td>
		</tr>
		<?php
		$iG++;
	}
	?>
	<tr height="100%">
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td></td>
	</tr>
	</table>
	</div>
	</td>
  </tr>
</table>
</body>	

