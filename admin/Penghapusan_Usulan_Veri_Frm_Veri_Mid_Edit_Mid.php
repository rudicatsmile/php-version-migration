<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$nSQ = "SELECT Referensi,Ref_Usulan,Ref_Aset,Kd_UPB,Verifikasi,Mutasi_Tanggal,Eksekusi FROM ta_usulan_verifikasi_rinci_108 WHERE IDT='$tID'";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$rRef = $mRo[0];
	$rReU = $mRo[1];
	$rReA = $mRo[2];
	$rUPB = $mRo[3];
	$rVer = $mRo[4];
	$rTgL = explode('-',$mRo[5]);
	$rEXE = $mRo[6];
}

$gUnT = fGlobal("to_upb","ta_usulan_rinci_108","referensi:ref_aset",$rReU.":".$rReA,"=:=","","");
$rUnT = fGlobal("nm_unit","ref_unit","kd_unit",substr($gUnT,0,11),"=","","");

$rDisB = "";
$rRedB = "";
if ($rEXE=='Sudah'){
	$rDisB="disabled";
	$rRedB="readonly";
}

if ($rVer=='Verifikasi'){
	$Ver1 = "";
	$Ver2 = "checked";
	$Ver3 = "";
	$Ver4 = "";
	$Ver5 = "";
}
else if ($rVer=='CekFisik'){
	$Ver1 = "";
	$Ver2 = "";
	$Ver3 = "checked";
	$Ver4 = "";
	$Ver5 = "";
}
elseif ($rVer=='Ditolak'){
	$Ver1 = "";
	$Ver2 = "";
	$Ver3 = "";
	$Ver4 = "checked";
	$Ver5 = "";
}
elseif ($rVer=='Disetujui'){
	$Ver1 = "";
	$Ver2 = "";
	$Ver3 = "";
	$Ver4 = "";
	$Ver5 = "checked";
}
else{
	$Ver1 = "checked";
	$Ver2 = "";
	$Ver3 = "";
	$Ver4 = "";
	$Ver5 = "";
}
$JnS = fGlobal("Jenis","ta_usulan_verifikasi_108","Referensi",$rRef,"=","","");
if ($JnS=='PH'){
	$rM="PNGHPUSAN";
	$LB=120;
}
else{
	$rM="MUTASI";
	$LB=95;
}
$CeK = fGlobal("IDT","ta_usulan_verifikasi_rinci_syarat_108","Referensi:Ref_Usulan:Ref_Aset",$rRef.":".$rReU.":".$rReA,"=:=:=","","");
if (!$CeK)
{
	require('Invent_Usulan_Veri_Frm_Veri_Mid_Edit_Imp.php');
}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="405px" style="border:1px">
<tr height="25">
	<td width="30" style="font-weight:bold; border-bottom: 3px double #999999; border-top: 1px solid #999999; border-right: 1px solid #ccc; text-align:center; background-color:#C9DCD8">NO</td>
	<td style="font-weight:bold; border-bottom: 3px double #999999; border-top: 1px solid #999999; border-right: 1px solid #ccc; background-color:#C9DCD8">&nbsp;&nbsp;PERSYARATAN</td>
	<td colspan="2" style="font-weight:bold; border-bottom: 3px double #999999; border-top: 1px solid #999999; border-right: 1px solid #ccc; background-color:#C9DCD8">&nbsp;&nbsp;DOKUMEN/FISIK/PDF</td>
	<td colspan="2" style="font-weight:bold; border-bottom: 3px double #999999; border-top: 1px solid #999999; border-right: 1px solid #ccc; background-color:#C9DCD8">&nbsp;&nbsp;KRITERIA</td>
	<td width="280" style="font-weight:bold; border-bottom: 3px double #999999; border-top: 1px solid #999999; background-color:#C9DCD8">&nbsp;&nbsp;CATATAN</td>
  </tr>
<?php
$iG=1;
$nSQ = "SELECT P1.IDT, P1.Kd_Syarat,P2.Deskripsi,P1.Fisik,P1.Status,P1.Memo 
FROM ta_usulan_verifikasi_rinci_syarat_108 P1 
LEFT JOIN ref_usulan_syarat P2 ON P2.Kode=P1.Kd_Syarat 
WHERE P1.Referensi='$rRef' AND P1.Ref_Usulan='$rReU' AND P1.Ref_Aset='$rReA' ORDER BY P1.IDT";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG = fBackCLR($iG);
	$mID = $mRo[0];
	$mAD = $mRo[3];
	$mST = $mRo[4];
	$mME = $mRo[5];
	if ($mAD=='Ada')
	{
		$Ada1="checked";
		$Ada2="";
	} else {
		$Ada1="";
		$Ada2="checked";
	}
		
	if ($mST=='Memenuhi')
	{
		$Pnh1="checked";
		$Pnh2="";
	} else {
		$Pnh1="";
		$Pnh2="checked";
	}
	?>
	<tr height="25">
		<td <?=$gBG?> style="border-bottom: 1px dotted #999999; border-right: 1px solid #ccc; text-align:center"><?=$iG?>. </td>
		<td <?=$gBG?> style="border-bottom: 1px dotted #999999; border-right: 1px solid #ccc; padding-left:3px; padding-right:3px"><?=$mRo[2]?></td>
		<td <?=$gBG?> width="60" style="border-bottom: 1px dotted #999999; border-right: 0px solid #ccc"><label style="color:<?php if ($Ada1=="checked") {echo "#0000ff";} else {echo "#000";}?>"><input <?=$rDisB?> name="fAda<?=$mID?>" id="fAda<?=$mID?>" type="radio" value="Y" <?=$Ada1?> onclick="saveRECO('Fisik','0','<?=$mID?>','<?=$tID?>','<?=$IdL?>'); return false;" />Ada</label></td>
		<td <?=$gBG?> width="70" style="border-bottom: 1px dotted #999999; border-right: 1px solid #ccc"><label style="color:<?php if ($Ada2=="checked") {echo "#ff0000";} else {echo "#000";}?>"><input <?=$rDisB?> name="fAda<?=$mID?>" id="fAda<?=$mID?>" type="radio" value="N" <?=$Ada2?> onclick="saveRECO('Fisik','1','<?=$mID?>','<?=$tID?>','<?=$IdL?>'); return false;" />Tidak</label></td>
		<td <?=$gBG?> width="90" style="border-bottom: 1px dotted #999999; border-right: 0px solid #ccc"><label style="color:<?php if ($Pnh1=="checked") {echo "#0000ff";} else {echo "#000";}?>"><input <?=$rDisB?> name="fMnh<?=$mID?>" id="fMnh<?=$mID?>" type="radio" value="Y" <?=$Pnh1?> onclick="saveRECO('Status','0','<?=$mID?>','<?=$tID?>','<?=$IdL?>'); return false;" />Memenuhi</label></td>
		<td <?=$gBG?> width="60" style="border-bottom: 1px dotted #999999; border-right: 1px solid #ccc"><label style="color:<?php if ($Pnh2=="checked") {echo "#ff0000";} else {echo "#000";}?>"><input <?=$rDisB?> name="fMnh<?=$mID?>" id="fMnh<?=$mID?>" type="radio" value="N" <?=$Pnh2?> onclick="saveRECO('Status','1','<?=$mID?>','<?=$tID?>','<?=$IdL?>'); return false;" />Tidak</label></td>
		<td <?=$gBG?> style="border-bottom: 1px dotted #999999; padding-left:3px"><input <?=$rRedB?> name="fMeM<?=$mID?>" id="fMeM<?=$mID?>" type="text" value="<?=$mME?>" title="Tekan ENTER untuk menyimpan catatan.." onkeypress="if (event.keyCode==13) {saveRECO('Memo','','<?=$mID?>','<?=$tID?>','<?=$IdL?>'); return false;}" style="padding-left:5px; width:260px; border: 1px solid #C0C0C0; <?=TxBckCLR($iG)?>"/></td>
	</tr>
	<?php
	$iG++;
}
?>
  <tr height="100%">
	<td style="border-right: 1px solid #ccc">&nbsp;</td>
	<td style="border-right: 1px solid #ccc">&nbsp;</td>
	<td colspan="2" valign="top" style="border-right: 1px solid #ccc; font-style:italic; text-align:center; font-family:arial narrow; color:#999999">Click otomatis menyimpan..!!</td>
	<td colspan="2" valign="top" style="border-right: 1px solid #ccc; font-style:italic; text-align:center; font-family:arial narrow; color:#999999">Click otomatis menyimpan..!!</td>
	<td valign="top" style="font-style:italic; text-align:center; font-family:arial narrow; color:#999999">Tekan ENTER untuk menyimpan catatan..!!</td>
  </tr>
  <?php if ($rEXE=='Sudah'){?>
  <tr height="60">
	<td style="border-right: 1px solid #ccc">&nbsp;</td>
	<td style="border-right: 1px solid #ccc">&nbsp;</td>
	<td colspan="4" style="border-right: 1px solid #ccc; border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; font-style:italic; text-align:center; font-family:arial narrow; color:#ff0000; background-color:#000; font-weight:bold">E X E C U T E D</td>
	<td valign="top" style="font-style:italic; text-align:center; font-family:arial narrow; color:#999999">&nbsp;</td>
  </tr>
  <tr height="100">
	<td style="border-right: 1px solid #ccc">&nbsp;</td>
	<td style="border-right: 1px solid #ccc">&nbsp;</td>
	<td colspan="2" valign="top" style="border-right: 1px solid #ccc; font-style:italic; text-align:center; font-family:arial narrow; color:#999999">&nbsp;</td>
	<td colspan="2" valign="top" style="border-right: 1px solid #ccc; font-style:italic; text-align:center; font-family:arial narrow; color:#999999">&nbsp;</td>
	<td valign="top" style="font-style:italic; text-align:center; font-family:arial narrow; color:#999999">&nbsp;</td>
  </tr>
  <?php } ?>
  <tr height="68">
	<td colspan="7" style="border-top:3px double #ccc; border-right:0px solid #ccc">
	<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" style="border:1px; font-size:8pt; font-weight:bold">
	<tr height="2">
	  <td></td>
	  <td></td>
	  <td></td>
	  <td width="314"></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  </tr>
	<tr height="25">
	  <td width="9">&nbsp;</td>
	  <td width="167">TANGGAL <?=$rM?></td>
	  <td width="27">:</td>
	  <td>
	  <?php if ($rEXE=='Belum'){?>
	  <select name="mHri" id="mHri" tabindex="0" style="width:50px; text-align:center" onchange="saveVERItgl('Mutasi_HRI',this,'<?=$tID?>','<?=$IdL?>'); return false;">
        <?php
		echo '<option value="00"></option>';
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==(int)$rTgL[2]) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
      </select>
	  <select name="mBln" id="mBln" tabindex="0" style="width:55px; text-align:center" onchange="saveVERItgl('Mutasi_BLN',this,'<?=$tID?>','<?=$IdL?>'); return false;">
		<?php
		echo '<option value="00"></option>';
		for($i=1; $i<=12; $i++)
		{
			$sel ="";
			if ($i==(int)$rTgL[1]) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.fNmBulanShort($i).'</option>';
		}
		?>
		</select>
		<select name="mThn" id="mThn" style="width: 55px; text-align:center" onchange="saveVERItgl('Mutasi_THN',this,'<?=$tID?>','<?=$IdL?>'); return false;">
		<?php
		echo '<option value="0000"></option>';
		for($i=2016; $i<=2030; $i++)
		{
			$sel ="";
			if ($i==(int)$rTgL[0]) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
		</select>
	  <?php } else {?>
	  <input <?=$rRedB?> name="mHri" id="mHri" type="hidden" value="<?=$rTgL[2]?>" style="text-align:center; width:20px; border: 1px solid #C0C0C0"/>
	  <input <?=$rRedB?> name="mBln" id="mBln" type="hidden" value="<?=$rTgL[1]?>" style="text-align:center; width:20px; border: 1px solid #C0C0C0"/>
	  <input <?=$rRedB?> name="mThn" id="mThn" type="hidden" value="<?=$rTgL[0]?>" style="text-align:center; width:32px; border: 1px solid #C0C0C0"/>
	  <input <?=$rRedB?> name="mTglD" id="mTglD" type="text" value="<?=$rTgL[2]." ".fNmBulan((int)$rTgL[1])." ".$rTgL[0]?>" style="padding-left:3px; width:110px; border: 1px solid #C0C0C0"/>
	  <?php } ?>	  </td>
	  <td width="83"> VERIFIKASI</td>
	  <td width="99"><label style="color:<?php if ($Ver1=="checked") {echo "#ff0000";} else {echo "#000";}?>"><input <?=$rDisB?> name="fVer" id="fVer" type="radio" value="N" <?=$Ver1?>  onclick="saveVERI('Verifikasi','<?=$JnS?>','Belum','<?=$tID?>','<?=$IdL?>'); return false;" />BELUM</label></td>
	  <td width="188"><label style="color:<?php if ($Ver2=="checked") {echo "#ff0000";} else {echo "#000";}?>"><input <?=$rDisB?> name="fVer" id="fVer" type="radio" value="N" <?=$Ver2?> onclick="saveVERI('Verifikasi','<?=$JnS?>','Verifikasi','<?=$tID?>','<?=$IdL?>'); return false;" />DALAM PROSES</label></td>
	  <td width="131"><label style="color:<?php if ($Ver3=="checked") {echo "#ff0000";} else {echo "#000";}?>"><input <?=$rDisB?> name="fVer" id="fVer" type="radio" value="N" <?=$Ver3?>  onclick="saveVERI('Verifikasi','<?=$JnS?>','CekFisik','<?=$tID?>','<?=$IdL?>'); return false;" />CEK FISIK</label></td>
	  <td width="99"><label style="color:<?php if ($Ver4=="checked") {echo "#ff0000";} else {echo "#000";}?>"><input <?=$rDisB?> name="fVer" id="fVer" type="radio" value="N" <?=$Ver4?>  onclick="saveVERI('Verifikasi','<?=$JnS?>','Ditolak','<?=$tID?>','<?=$IdL?>'); return false;" />DITOLAK</label></td>
	  <td width="196"><label style="color:<?php if ($Ver5=="checked") {echo "#ff0000";} else {echo "#000";}?>"><input <?=$rDisB?> name="fVer" id="fVer" type="radio" value="N" <?=$Ver5?>  onclick="saveVERI('Verifikasi','<?=$JnS?>','Disetujui','<?=$tID?>','<?=$IdL?>'); return false;" />DISETUJUI</label></td>
	</tr>
	<?php if ($JnS=='MS'){?>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td>UNIT KERJA TUJUAN</td>
	  <td>:</td>
	  <td>
	  <input <?=$rRedB?> name="fUniT" id="fUniT" type="hidden" readonly value="<?=$gUnT?>" style="padding-left:5px; width:40px; border: 1px solid #C0C0C0"/>
	  <input <?=$rRedB?> name="rUniT" id="rUniT" type="text" readonly value="<?=$rUnT?>" style="padding-left:5px; width:250px; border: 1px solid #C0C0C0"/>	  </td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	<tr height="100%">
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	  <td></td>
	</tr>
	<?php } else {?>
	<input name="fUniT" id="fUniT" type="hidden" readonly value="" style="padding-left:5px; width:40px; border: 1px solid #C0C0C0"/>
	<?php } ?>
	</table>
	</td>
</tr>
</table>
