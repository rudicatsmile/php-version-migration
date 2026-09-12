<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$PaG=1;
$DataPerPage = $gLST;	#200;
$JumNiLL = 0;
$JumData = 0;
$rPgE = $PgE/$DataPerPage;

if ($rUpb=='All'){$rUpb="";}
if ($rUpb!=''){$gUPB=$rUpb;}

$FnD = str_replace('**',' ',$gFnD);
$CrT = "";

if ($gTHN==''){$gTHN="%";}
if ($gEXT==''){$gEXT="%";}

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

$iG=1;
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
	
	$nSQ = "SELECT IfNull(count(*),0) 
	FROM ta_kib_108 P1 
	JOIN tb_lembar_kerja P2 ON P2.Referensi=P1.Referensi AND P2.KdUPB=P1.Kd_UPB AND P2.RefGroup=P1.Ref_Group 
	WHERE P2.KeberadaanBarang='".$pos1."' AND P2.$Field='".$pos2."' AND P2.DataSensusFix='Y' 
	AND P1.extracom LIKE '".$gEXT."' AND P1.Kd_Aset_108 LIKE '".$gAsT."%' AND P1.Kd_UPB LIKE '".$gUPB."%' 
	AND P1.Tgl_Perolehan LIKE '".$gTHN."-%-%' AND P1.MasukKeUsulan LIKE '%' AND P1.KdpToAset='N' $CrT ".$nMB;
}
else
{
	$nSQ = "SELECT IfNull(count(*),0) 
	FROM ta_kib_108 P1 
	WHERE P1.extracom LIKE '".$gEXT."' AND P1.Kd_Aset_108 LIKE '".$gAsT."%' AND P1.Kd_UPB LIKE '".$gUPB."%' 
	AND P1.Tgl_Perolehan LIKE '".$gTHN."-%-%' AND P1.MasukKeUsulan LIKE '%' AND P1.KdpToAset='N' $CrT ".$nMB;
}
#echo $nSQ;
$nRs = mysql_query($nSQ);
$mRo = mysql_fetch_array($nRs);
$JumData = $mRo[0];

if ($JumData>$DataPerPage)
{
	$PaG = ceil($JumData/$DataPerPage);
}
?>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:100%; height:40px">
  <tr height="28">
    <td valign="middle">
	<?php if ($JumData>1){?>
	<div class="pagging">
	<?php
	for ($iA = 0; $iA <= $PaG-1; $iA++)
	{
	if ($iA==$rPgE){
		$iK = "style='color:#ff0000; font-weight:bold'";
	}
	else{
		$iK = "";
	}
	?>
		<a href="#" onclick="showASET('find','<?=($iA*$DataPerPage)?>','<?=$Jns?>','<?=$IdT?>','<?=$IdL?>');return false;" <?=$iK?>><?=($iA+1)?></a>
	<?php }
	?>
	</div>
	<?php } ?>	</td>
  </tr>
</table>
