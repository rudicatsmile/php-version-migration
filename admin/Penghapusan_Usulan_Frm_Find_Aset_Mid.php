<?php
require('Connection.php');
require('FileFunction.php');
require('CheckLogin.php');
extract($_GET);

$FnD = str_replace('**',' ',$gFnD);
$CrT = "";

if ($rUPB!='All' && $rUPB!=''){$gUPB=$rUPB;}

if ($gTHN==''){$gTHN="%";}
if ($gEXT==''){$gEXT="%";}

$gREF = fGlobal("Referensi","ta_usulan_108","IDT",$IdT,"=","","");
if ($FnD)
{
	$CrT ="AND (Referensi LIKE '%$FnD%' OR No_Register LIKE '%$FnD%' OR Kd_Aset_108 LIKE '%$FnD%' OR Nm_Aset LIKE '%$FnD%' OR No_Pengadaan LIKE '%$FnD%' OR Nomor_Polisi LIKE '%$FnD%' OR Nomor_BPKB LIKE '%$FnD%' OR Keterangan LIKE '%$FnD%'";
	if ($gTBL=='a') {$CrT.=" OR Alamat LIKE '%$FnD%' OR Luas_M2 LIKE '%$FnD%' OR Ref_Usulan LIKE '%$FnD%'";}
	if ($gTBL=='b') {$CrT.=" OR Merk LIKE '%$FnD%' OR Type LIKE '%$FnD%' OR Ref_Usulan LIKE '%$FnD%'";}
	if ($gTBL=='c') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Luas_Lantai LIKE '%$FnD%' OR Ref_Usulan LIKE '%$FnD%'";}
	if ($gTBL=='d') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Konstruksi LIKE '%$FnD%' OR Ref_Usulan LIKE '%$FnD%'";}
	if ($gTBL=='e') {$CrT.=" OR Bahan LIKE '%$FnD%' OR Judul LIKE '%$FnD%' OR Ref_Usulan LIKE '%$FnD%'";}
	if ($gTBL=='f') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Dokumen_Nomor LIKE '%$FnD%'";}
	if ($gTBL=='g') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Dokumen_Nomor LIKE '%$FnD%' OR Ref_Usulan LIKE '%$FnD%'";}
	$CrT.=")";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="100%" border="0" style="font-family:arial; font-size:8pt">
	<?php
	
	$iG=1;
	$nMB="";
	if ($gTBL=='a') {$Fld=",P1.Alamat,P1.Luas_M2,P1.Referensi,P1.Ref_Mutasi,P1.Ref_Usulan,P1.Kd_UPB";}
	if ($gTBL=='b') {$Fld=",P1.Merk,P1.Type,P1.Referensi,P1.Ref_Mutasi,P1.Ref_Usulan,P1.Kd_UPB";}
	if ($gTBL=='c') {$Fld=",P1.Lokasi,P1.Luas_Lantai,P1.Referensi,P1.Ref_Mutasi,P1.Ref_Usulan,P1.Kd_UPB";}
	if ($gTBL=='d') {$Fld=",P1.Lokasi,P1.Konstruksi,P1.Referensi,P1.Ref_Mutasi,P1.Ref_Usulan,P1.Kd_UPB";}
	if ($gTBL=='e') {$Fld=",P1.Bahan,P1.Judul,P1.Referensi,P1.Ref_Mutasi,P1.Ref_Usulan,P1.Kd_UPB";}
	if ($gTBL=='f') {
		$Fld=",P1.Lokasi,P1.Luas,P1.Referensi,P1.Ref_Mutasi,P1.Ref_Usulan,P1.Kd_UPB";
		$nMB=" AND P1.KdpToAset='N' ";
	}
	if ($gTBL=='g') {$Fld=",P1.Asal_Usul,P1.Kondisi,P1.Referensi,P1.Ref_Mutasi,P1.Ref_Usulan,P1.Kd_UPB";}
	
	$eRf = "";
	if ($gTBL=='a') {$eRf ="TNH";}
	if ($gTBL=='b') {$eRf ="ALT";}
	if ($gTBL=='c') {$eRf ="BNG";}
	if ($gTBL=='d') {$eRf ="JLN";}
	if ($gTBL=='e') {$eRf ="ATL";}
	if ($gTBL=='f') {$eRf ="KDP";}
	if ($gTBL=='g') {$eRf ="KDL";}
	
	if ($gTBL=='g') 
	{
		$nSQ = "SELECT P1.IDT, P1.Kd_Aset_108, P1.No_Register, P1.Nm_Aset, P1.Tgl_Perolehan, P1.Keterangan, P1.Harga $Fld, P2.Nm_UPB 
		FROM ta_kib_108 P1 
		LEFT JOIN ref_upb P2 ON P2.Kd_UPB=P1.Kd_UPB 
		WHERE P1.extracom LIKE '$gEXT' 
		AND (P1.Referensi LIKE '$eRf%' OR P1.Referensi LIKE 'ATB%') 
		AND P1.Kd_UPB LIKE '$gUPB%' 
		AND P1.Tgl_Perolehan LIKE '$gTHN-%-%' AND P1.MasukKeUsulan LIKE '%' $CrT $nMB ORDER BY P1.Kd_Aset_108, P1.No_Register, P1.Tgl_Perolehan LIMIT 0,$gLST";
	
		$nSQC = "SELECT count(*) as JmlR 
		FROM ta_kib_108 P1 
		WHERE P1.extracom LIKE '$gEXT' 
		AND (P1.Referensi LIKE '$eRf%' OR P1.Referensi LIKE 'ATB%') 
		AND P1.Kd_UPB LIKE '$gUPB%' 
		AND P1.Tgl_Perolehan LIKE '$gTHN-%-%' AND P1.MasukKeUsulan LIKE '%' $CrT $nMB ORDER BY P1.Kd_Aset_108, P1.No_Register, P1.Tgl_Perolehan LIMIT 0,$gLST";
	}
	else
	{
		$nSQ = "SELECT P1.IDT, P1.Kd_Aset_108, P1.No_Register, P1.Nm_Aset, P1.Tgl_Perolehan, P1.Keterangan, P1.Harga $Fld, P2.Nm_UPB 
		FROM ta_kib_108 P1 
		LEFT JOIN ref_upb P2 ON P2.Kd_UPB=P1.Kd_UPB 
		WHERE P1.extracom LIKE '$gEXT' AND P1.referensi LIKE '$eRf%' AND P1.Kd_UPB LIKE '$gUPB%' 
		AND P1.Tgl_Perolehan LIKE '$gTHN-%-%' AND P1.MasukKeUsulan LIKE '%' $CrT $nMB ORDER BY P1.Kd_Aset_108, P1.No_Register, P1.Tgl_Perolehan LIMIT 0,$gLST";
		
		$nSQC = "SELECT count(*) as JmlR 
		FROM ta_kib_108 P1 
		WHERE P1.extracom LIKE '$gEXT' AND P1.referensi LIKE '$eRf%' AND P1.Kd_UPB LIKE '$gUPB%' 
		AND P1.Tgl_Perolehan LIKE '$gTHN-%-%' AND P1.MasukKeUsulan LIKE '%' $CrT $nMB ORDER BY P1.Kd_Aset_108, P1.No_Register, P1.Tgl_Perolehan";
	}
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rIdT= $mRo[0];
		$gKD = $mRo[1];
		$gRG = $mRo[2];
		$gNM = $mRo[3];
		$gTG = $mRo[4];
		$gKT = $mRo[5];
		$gHR = $mRo[6];
		$g06 = $mRo[7];
		$g07 = $mRo[8];
		$gRF = $mRo[9];
		$gRH = $mRo[10];
		$gRU = $mRo[11];
		$gUP = $mRo['Kd_UPB'];
		$mUP = $mRo['Nm_UPB'];
		
		$aset = "aset";
		if ($gTBL=='c') {$g07=$g07." <sup>m</sup>";}
		if ($gTBL=='g'){
			$NiA = fGlobal("ifNull(sum(debet),0)","ta_kib_post_108","Referensi:Kd_UPB:Ref_Mutasi:Ref_Usulan:No_Register",$gRF.":".$gUP."%:".$gRH.":".$gRU.":".$gRG,"=:LIKE:=:=:=","","");
			if ($NiA==0){
				$NiA = fGlobal("ifNull(sum(debet),0)","ta_kib_post_108","Referensi:Kd_UPB:No_Register",$gRF.":".$gUP."%:".$gRG,"=:LIKE:=","","");
			}
		}
		else{
			$NiA = fGlobal("ifNull(sum(debet),0)","ta_kib_post_108","Referensi:Kd_UPB:No_Register",$gRF.":".$gUP."%:".$gRG,"=:LIKE:=","","");
		}
		
		$CeK = fGlobal("IDT","ta_usulan_rinci_108","Referensi:Ref_Aset:No_Register",$gREF.":".$gRF.":".$gRG,"=:=:=","","");
		if ($CeK!=""){
			$ico = "none";
			$aset= "edit";
			$mesg= "mesga";
			$refs= "";
			$disB= "disabled";
		}
		else{
			$CeK = fGlobal("Referensi","ta_usulan_rinci_108","Ref_Aset:Kd_UPB:Referensi:No_Register",$gRF.":".$gUPB."%:".$gREF.":".$gRG,"=:LIKE:<>:=","","");
			if ($CeK!=""){
				$ico = "none";
				$aset= "none";
				$mesg= "mesgb";
				$refs= $CeK;
				$disB= "disabled";
			}
			else{
				$ico = "add";
				$aset= "add";
				$mesg= "";
				$refs= "";
				$disB= "";
			}
		}
		
		$WeN="";
		if ($gHR<$NiA){
			$WeN="; color:#0000FF";
		}
		else if ($gHR>$NiA){
			$WeN="; color:#FF0000";
		}
		?>
		<tr height="20">
			<td valign="top" width="30" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$iG?>.</td>
			<td valign="top" width="100" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$gRF?></td>
			<td valign="top" width="55" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$gRG?></td>
			<td valign="top" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$gNM?></td>
			<td valign="top" width="40" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=substr($gTG,0,4)?></td>
			<td valign="top" width="200" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; font-size:8pt; padding-left:3px; padding-right:3px; color:#0000FF">UPB : <?=$mUP?></td>
			<td valign="top" width="90" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$g06?></td>
			<td valign="top" width="70" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$g07?></td>
			<td valign="top" width="80" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($gHR)?></td>
			<td valign="top" width="80" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:right; padding-right:3px <?=$WeN?>"><?=fConvertToRupiahBulat($NiA)?></td>
			<td valign="top" width="60" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center">
			<a href="#" class="ico <?=$ico?>" onclick="showCLICK('aset','<?=$mesg?>','<?=$refs?>','<?=$IdT?>','<?=$rIdT.":".$gTBL?>','<?=$IdL?>'); return false;"><?=$aset?></a>			</td>
		    <td valign="top" align="center" width="20" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC">
			<input <?=$disB?> type="checkbox" name="sDana" value="<?=$rIdT?>" /></td>
		</tr>
		<?php
		$iG++;
	}
	
	?>
	<?php
	$colSP=8;
	$tamSP="NO";
	if ($UID=='creator'){
		$colSP=6;
		$tamSP="YA";
	}
	if ($iG>1) {
	?>
	<tr height="20" valign="top">
		<td colspan="2" style="color:#FF0000; font-style:italic">
		<?php
		$nRC = mysql_query($nSQC);
		$mRC = mysql_fetch_array($nRC);
		echo "&nbsp;&nbsp;".fConvertToRupiahBulat(($iG-1))." dari ".fConvertToRupiahBulat($mRC[0])." item";
		?></td>
		<td colspan="<?=$colSP?>">&nbsp;</td>
		<?php if ($tamSP=="YA") {?>
		<td align="center" colspan="2" title="Tanpa harus checklist" style="border:1px solid #FF0000; border-right:0px solid #FF0000; vertical-align:middle; cursor: pointer" onclick="proslNIL('aset','<?=$IdT?>','<?=$gTBL?>','<?=$IdL?>','ALL','<?=$rUPB?>'); return false;">
		<a href="#" class="ico add">PROSES ALL</a></td>
		<?php } ?>
		<td colspan="2" align="center" title="Harus checklist" style=" border:1px solid #FF0000; vertical-align:middle; cursor: pointer" onclick="proslNIL('aset','<?=$IdT?>','<?=$gTBL?>','<?=$IdL?>','NON'); return false;">
		<a href="#" class="ico add">PROSES</a></td>
	</tr>
	<?php } ?>
	<?php if ($iG==1) {?>
	<tr height="20">
		<td colspan="12" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<?php } ?>
	<tr height="100%" valign="top">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="8">&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
