<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
$FnD = str_replace('**',' ',$gFnD);
$SyT = "";
if ($FnD){
	$SyT = " AND (Ref_Aset LIKE '%".$FnD."%' OR Kd_Aset LIKE '%".$FnD."%' OR No_Register LIKE '%".$FnD."%' OR Nm_Aset LIKE '%".$FnD."%' OR Uraian LIKE '%".$FnD."%' OR Harga LIKE '%".$FnD."%' OR Nilai_Akhir LIKE '%".$FnD."%')";
}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="300px">
<?php
$JeN = fGlobal("Jenis","ta_usulan_108","Referensi",$gREF,"=","","");

$iG=$PgE+1;
$tJmL=0;

$nSQ = "SELECT IDT, Ref_Aset, Kd_Aset, No_Register, Nm_Aset, Tgl_Perolehan, Uraian, Harga, To_UPB, KIB_From, KIB_To, Kd_Rinci, Nilai_Akhir, To_Kd_Aset, Kd_UPB, extracom 
FROM ta_usulan_rinci_108 WHERE Referensi='$gREF' $SyT ORDER BY IDT LIMIT $PgE,200";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$gIDT = $mRo[0];
	$mRo1 = $mRo[1];
	$mRo2 = $mRo[2];
	$mRo3 = $mRo[3];
	$mRo4 = $mRo[4];
	$mRo5 = $mRo[5];
	$mRo6 = $mRo[6];
	$mRo7 = $mRo[7];
	
	$mRo8  = $mRo[8];
	$mRo9  = $mRo[9];
	$mRo10 = $mRo[10];
	$mRo11 = $mRo[11];
	$mRo12 = $mRo[12];
	$mRo13 = $mRo[13];
	$mRo14 = $mRo[14];
	
	$TmBA="<i><font style='color:#996600'>Upb Asal : ".fGlobal("Nm_UPB","ref_upb","Kd_UPB",$mRo['Kd_UPB'],"=","","")."</font></i><br>";
	$TmBT="";
	if ($JeN=="MS" && $mRo8 ==""){
		$TmBT="<font style='font-style:italic; color:#FF0000'>Kode unit / Upb tujuan mutasi belum ditentukan..!!</font><br>";
	}
	else
	{
		$TmBT="<i><font style='color:#0000ff'>Upb Tujuan : ".fGlobal("Nm_UPB","ref_upb","Kd_UPB",$mRo['To_UPB'],"=","","")."</font></i><br>";
	}
	if ($JeN=="RB" && $mRo13==""){$TmBT="<br><font style='font-style:italic; color:#FF0000'>Link rekening aset ".$mRo2." ke aset lainnya tidak ditemukan..!!</font>";}
	if ($JeN=="MK"){
		if ($mRo10 ==""){$TmBT="<br><font style='font-style:italic; color:#FF0000'>KIB tujuan mutasi belum ditentukan..!!</font>";}
		if ($mRo13 ==""){$TmBT.="<br><font style='font-style:italic; color:#FF0000'>Kode rekening aset tujuan mutasi belum ditentukan..!!</font>";}
	}
	if ($JeN=="HB" && $mRo11==""){$TmBT="<br><font style='font-style:italic; color:#FF0000'>Tujuan hibah belum ditentukan..!!</font>";}
	
	
	$gALS = $mRo11;
	$dALS = fGlobal("Deskripsi","ref_usulan_jenis_rinci","Kode",$gALS,"=","","");
	$gJmL = $mRo7;
	$gJmA = $mRo12;
	$tJmL = $tJmL+$gJmL;
	$tJmA = $tJmA+$gJmA;
	
	$CeKD = fGlobal("IDT","ta_usulan_verifikasi_rinci_108","Ref_Usulan:Ref_Aset",$gREF.":".$mRo1,"=:=","","");
	if ($CeKD) {
		$ico = "exec";
		$txt = fGlobal("Eksekusi","ta_usulan_verifikasi_rinci_108","Ref_Usulan:Ref_Aset",$gREF.":".$mRo1,"=:=","","");
		if ($txt=="Sudah"){
			$txt = "<i>Executed</i>";
		}
		else
		{
			$txt = fGlobal("Verifikasi","ta_usulan_verifikasi_rinci_108","Ref_Usulan:Ref_Aset",$gREF.":".$mRo1,"=:=","","");
			if (strtolower($txt)=="belum"){
				$ico = "dele";
				$txt = "Remove";
				$CeKD = "DelVer";
				//$CeKD= "";
			}
		}
	} else {
		$ico = "dele";
		$txt = "Remove";
	}
	
	$BeK = fGlobal("IDT","ta_kib_108","Referensi:Kd_UPB",$mRo1.":".$mRo14,"=:=","","");
	if ($BeK==""){
		$eBox="<font style='color:#ff0000'> **</font>";
	}
	else{
		$eBox="";
		
		$NiL = fGlobal("IfNull(sum(debet),0)","ta_kib_post_108","Referensi:Kd_UPB",$mRo1.":".substr($mRo14,0,11)."%","=:LIKE","","");
		
		#$tSQ = "UPDATE ta_usulan_rinci_108 SET IdtTaKib='".$BeK."', nilai_akhir='".$NiL."' WHERE IDT='$gIDT'";
		#$eRs = mysql_query($tSQ);
		
		$tSQ = "UPDATE ta_kib_108 SET MasukKeUsulan='sudah' WHERE IDT='$BeK'";
		$eRs = mysql_query($tSQ);
	
		if ($CeKD!=''){
			#$tSQ = "UPDATE ta_usulan_verifikasi_rinci_108 SET nilai_akhir='".$NiL."' WHERE IDT='$CeKD'";
			#$eRs = mysql_query($tSQ);
		}
		$eExtr = $mRo['extracom'];
		if ($eExtr=='Y'){$eExtr=" (<font style='color:#996600; font-style:italic'>Extracomptable</font>)";}
		else {$eExtr="";}
	}
	?>
	<tr height="28"> 
	  <td width="28" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo1?></td>
	  <td width="90" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo2?></td>
	  <td width="55" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo3?></td>
	  <td width="200" style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; padding-left:3px" <?=$gBG?>><?=$mRo4.$eBox.$eExtr?></td>
	  <td width="50" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=substr($mRo5,0,4)?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid"><?=$TmBA.$TmBT.$mRo6?></td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right"><?=fConvertToRupiah($gJmL)?></td>
	  <td width="100" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right"><?=fConvertToRupiah($gJmA)?></td>
	  <td width="50" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:center"><a href="#" onClick="showEDIT('Edit','<?=$ReO?>','<?=$gIDT?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;&nbsp;Edit</a></td>
	  <td width="5" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
	  <td width="50" <?=$gBG?> style="border-bottom:1px #999999 dotted">
	  <a href="#" onClick="showEDIT('Img','<?=$ReO?>','<?=$gIDT?>','<?=$IdL?>'); return false" class="ico img">&nbsp;&nbsp;&nbsp;IMG</a></td>
	  <td width="50" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-right:1px #ccc solid">
	  <a href="#" onClick="showEDIT('Pdf','<?=$ReO?>','<?=$gIDT?>','<?=$IdL?>'); return false" class="ico pdf">&nbsp;&nbsp;&nbsp;PDF</a></td>
	  <td width="70" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center">
	  <a href="#" onClick="P_Remove('<?=$ReO?>','<?=$PgE?>','<?=$gIDT?>','<?=$CeKD?>','<?=$IdL?>'); return false" class="ico <?=$ico?>">&nbsp;<?=$txt?></a>	  </td>
	</tr>
	<?php
	$iG++;
}
?>
<?php if ($iG>1) {?>
<tr height="100%">
 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double; border-right:1px #ccc solid">&nbsp;</td>
 <td style="border-left:0px #ccc solid; border-bottom:3px #ccc double">&nbsp;</td>
</tr>
<!--tr height="20">
  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="7"><div style="float:left; font-weight:normal; font-style:italic"><font style="color:#FF0000">&nbsp;**</font> &lt;-- Aset sudah tidak ada pada skpd bersangkuatn.</div>
    T O T A L</td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($tJmL)?></td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($tJmA)?></td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid">&nbsp;</td>
  <td style="border-left:1px #ccc solid"></td>
  <td colspan="3"></td>
</tr-->
<?php }else{ ?>
<tr height="100%">
 <td colspan="15" align="center">Data tidak ditemukan..!!</td>
</tr>
<?php } ?>
</table>
