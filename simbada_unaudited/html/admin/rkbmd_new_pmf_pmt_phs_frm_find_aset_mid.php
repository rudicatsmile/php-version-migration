<?
require('Connection.php');
require('FileFunction.php');
require('CheckLogin.php');
extract($_GET);
$FnD = str_replace('**',' ',$gFnD);
$CrT = "";

if ($gTHN==''){$gTHN="%";}
if ($gEXT==''){$gEXT="%";}
if ($rUpb=='All'){$rUpb="";}
if ($rUpb!=''){$gUPB=$rUpb;}

$gREF = fGlobal("Referensi","ta_rkbmd_new_pmf_pmt_phs","IDT",$IdT,"=","","");
if ($FnD)
{
	$CrT ="AND (P1.No_Register LIKE '%$FnD%' OR P1.Referensi LIKE '%$FnD%' OR P1.Kd_Aset_108 LIKE '%$FnD%' OR P1.Nm_Aset LIKE '%$FnD%'";
	if ($gAsT=='1.3.1') {$CrT.=" OR P1.Alamat LIKE '%$FnD%' OR P1.Luas_M2 LIKE '%$FnD%' OR P1.Ref_Usulan LIKE '%$FnD%'";}
	if ($gAsT=='1.3.2') {$CrT.=" OR P1.Merk LIKE '%$FnD%' OR P1.Type LIKE '%$FnD%' OR P1.Ref_Usulan LIKE '%$FnD%'";}
	if ($gAsT=='1.3.3') {$CrT.=" OR P1.Lokasi LIKE '%$FnD%' OR P1.Luas_Lantai LIKE '%$FnD%' OR P1.Ref_Usulan LIKE '%$FnD%'";}
	if ($gAsT=='1.3.4') {$CrT.=" OR P1.Lokasi LIKE '%$FnD%' OR P1.Konstruksi LIKE '%$FnD%' OR P1.Ref_Usulan LIKE '%$FnD%'";}
	if ($gAsT=='1.3.5') {$CrT.=" OR P1.Bahan LIKE '%$FnD%' OR P1.Judul LIKE '%$FnD%' OR P1.Ref_Usulan LIKE '%$FnD%'";}
	if ($gAsT=='1.3.6') {$CrT.=" OR P1.Lokasi LIKE '%$FnD%' OR P1.Dokumen_Nomor LIKE '%$FnD%'";}
	if ($gAsT=='1.5.3' || $gAsT=='1.5.4') {$CrT.=" OR P1.Lokasi LIKE '%$FnD%' OR P1.Dokumen_Nomor LIKE '%$FnD%' OR P1.Ref_Usulan LIKE '%$FnD%'";}
	$CrT.=")";
}
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" height="100%" border="0" style="font-family:arial; font-size:8pt">
	<?
	
	$iG=1;
	$iG=$PgE+1;
	
	$nMB="";
	if ($gAsT=='1.3.1') {$Fld=",P1.Alamat,P1.Luas_M2,P1.Referensi,P1.Ref_Mutasi,P1.Ref_Usulan,P1.Kd_UPB,P1.Ref_Group";}
	if ($gAsT=='1.3.2') {$Fld=",P1.Merk,P1.Type,P1.Referensi,P1.Ref_Mutasi,P1.Ref_Usulan,P1.Kd_UPB,P1.Ref_Group";}
	if ($gAsT=='1.3.3') {$Fld=",P1.Lokasi,P1.Luas_Lantai,P1.Referensi,P1.Ref_Mutasi,P1.Ref_Usulan,P1.Kd_UPB,P1.Ref_Group";}
	if ($gAsT=='1.3.4') {$Fld=",P1.Lokasi,P1.Konstruksi,P1.Referensi,P1.Ref_Mutasi,P1.Ref_Usulan,P1.Kd_UPB,P1.Ref_Group";}
	if ($gAsT=='1.3.5') {$Fld=",P1.Bahan,P1.Judul,P1.Referensi,P1.Ref_Mutasi,P1.Ref_Usulan,P1.Kd_UPB,P1.Ref_Group";}
	if ($gAsT=='1.3.6') {
		$Fld=",P1.Lokasi,P1.Luas,P1.Referensi,P1.Ref_Mutasi,P1.Ref_Usulan,P1.Kd_UPB,P1.Ref_Group";
		$nMB=" AND P1.KdpToAset='N' ";
	}
	if ($gAsT=='1.5.3' || $gAsT=='1.5.4') {$Fld=",P1.Asal_Usul,P1.Kondisi,P1.Referensi,P1.Ref_Mutasi,P1.Ref_Usulan,P1.Kd_UPB,P1.Ref_Group";}
	if ($gLhI!='')
	{
		$gLh = explode(':',$gLhI);
		$pos1 = $gLh[0];
		$pos2 = $gLh[1];
		
		if ($pos1=='ada') {$Field = "KondisiBarang";}
		else{$Field = "KeberadaanBarang_tidakada";}
		
		$nSQ = "SELECT P1.IDT, P1.Kd_Aset_108, P1.No_Register, P1.Nm_Aset, P1.Tgl_Perolehan, P1.Keterangan, P1.Harga $Fld 
		FROM ta_kib_108 P1 
		JOIN tb_lembar_kerja P2 ON P2.Referensi=P1.Referensi AND P2.KdUPB=P1.Kd_UPB AND P2.RefGroup=P1.Ref_Group 
		WHERE P2.KeberadaanBarang='".$pos1."' AND P2.$Field='".$pos2."' AND P2.DataSensusFix='Y' 
		AND P1.extracom LIKE '".$gEXT."' AND P1.Kd_Aset_108 LIKE '".$gAsT."%' AND P1.Kd_UPB LIKE '".$gUPB."%' 
		AND P1.Tgl_Perolehan LIKE '".$gTHN."-%-%' AND P1.MasukKeUsulan LIKE '%' AND P1.KdpToAset='N' $CrT $nMB 
		ORDER BY P1.Kd_Aset_108, P1.No_Register, P1.Tgl_Perolehan LIMIT $PgE,$gLST";
	}
	else
	{
		$nSQ = "SELECT P1.IDT, P1.Kd_Aset_108, P1.No_Register, P1.Nm_Aset, P1.Tgl_Perolehan, P1.Keterangan, P1.Harga $Fld 
		FROM ta_kib_108 P1 
		WHERE P1.extracom LIKE '".$gEXT."' AND P1.Kd_Aset_108 LIKE '".$gAsT."%' AND P1.Kd_UPB LIKE '".$gUPB."%' 
		AND P1.Tgl_Perolehan LIKE '".$gTHN."-%-%' AND P1.MasukKeUsulan LIKE '%' AND P1.KdpToAset='N' $CrT $nMB 
		ORDER BY P1.Kd_Aset_108, P1.No_Register, P1.Tgl_Perolehan LIMIT $PgE,$gLST";
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
		$gGR = $mRo['Ref_Group'];
		
		$aset = "aset";
		$NiA = fGlobal("ifNull(sum(debet),0)","ta_kib_post_108","Referensi:Kd_UPB:Ref_Group",$gRF.":".$gUP."%:".$gGR,"=:LIKE:=","","");
		
		$ico = "add";
		$aset= "add";
		$mesg= "";
		$refs= "";
		$disB= "";
		
		$CeK = fGlobal("IDT","ta_rkbmd_new_pmf_pmt_phs_rinci","Referensi:Ref_Aset:Ref_Group",$gREF.":".$gRF.":".$gGR,"=:=:=","","");
		if ($CeK!=""){
			$ico = "none";
			$aset= "edit";
			$mesg= "mesga";
			$refs= "";
			$disB= "disabled";
		}
		
		?>
		<tr height="20">
			<td width="30" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$iG?>.</td>
			<td width="100" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$gRF?></td>
			<td width="55" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=$gRG?></td>
			<td <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$gKD." => ".$gNM?></td>
			<td width="40" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center"><?=substr($gTG,0,4)?></td>
			<td width="200" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$gKT?></td>
			<td width="90" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$g06?></td>
			<td width="70" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; padding-left:3px; padding-right:3px"><?=$g07?></td>
			<td width="80" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($gHR)?></td>
			<td width="80" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:right; padding-right:3px <?=$WeN?>"><?=fConvertToRupiahBulat($NiA)?></td>
			<td width="60" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC; border-right:1px dotted #CCCCCC; text-align:center">
			<a href="#" class="ico <?=$ico?>" onclick="showCLICK('aset','<?=$mesg?>','<?=$refs?>','<?=$IdT?>','<?=$rIdT.":".$gTBL?>','<?=$IdL?>'); return false;"><?=$aset?></a>			</td>
		    <td align="center" width="20" <?=fBackCLR($iG)?> style="border-bottom:1px dotted #CCCCCC">
			<input <?=$disB?> type="checkbox" name="sDana" value="<?=$rIdT?>" /></td>
		</tr>
		<?
		$iG++;
	}
	?>
	<?
	$colSP=8;
	$tamSP="NO";
	if ($UID=='creator'){
		$colSP=6;
		$tamSP="YA";
	}
	if ($iG>1) {
	?>
	<tr height="20" valign="top">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="<?=$colSP?>">&nbsp;</td>
		<? if ($tamSP=="YA") {?>
		<td align="center" colspan="2" title="Tanpa harus checklist" style="border:1px solid #FF0000; border-right:0px solid #FF0000; vertical-align:middle; cursor: pointer" onclick="proslNIL('aset','<?=$PgE?>','<?=$IdT?>','<?=$gAsT?>','<?=$gLhI?>','<?=$gEXT?>','<?=$IdL?>','ALL'); return false;">
		<a href="#" class="ico add">PROSES ALL</a></td>
		<? } ?>
		<td colspan="2" align="center" title="Harus checklist" style=" border:1px solid #FF0000; vertical-align:middle; cursor: pointer" onclick="proslNIL('aset','<?=$PgE?>','<?=$IdT?>','<?=$gAsT?>','<?=$gLhI?>','<?=$gEXT?>','<?=$IdL?>','NON'); return false;">
		<a href="#" class="ico add">PROSES</a></td>
	</tr>
	<? } ?>
	<? if ($iG==1) {?>
	<tr height="20">
		<td colspan="12" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<? } ?>
	<tr height="100%">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td colspan="8">&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
