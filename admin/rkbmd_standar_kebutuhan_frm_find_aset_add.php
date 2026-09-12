<?php
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
extract($_GET);
$rDTA = explode(':',$rDTA);
$rIdT = $rDTA[0];
$rTbL = $rDTA[1];

$gREF = fGlobal("Referensi","ta_rkbmd_standar_kebutuhan","IDT",$IdT,"=","","");
$kdu  = fGlobal("kd_unit","ta_rkbmd_standar_kebutuhan","IDT",$IdT,"=","","");
$thn  = fGlobal("tahun","ta_rkbmd_standar_kebutuhan","IDT",$IdT,"=","","");

$CeK = fGlobal("IDT","ta_rkbmd_standar_kebutuhan_rinci","referensi:kd_aset",$gREF.":".$kde,"=:=","","");
if (!$CeK)
{
	$gNm = fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$kde,"=","","");
	
	$gTBL = "ta_rkbmd_standar_kebutuhan_rinci";
	$gFLD = "";
	$gVAL = "";
	
	$gFLD = "referensi";
	$gVAL = "'$gREF'";
	
	$gFLD.= ", kd_aset";
	$gVAL.= ", '".$kde."'";
	
	$gFLD.= ", kd_unit";
	$gVAL.= ", '".$kdu."'";
	
	$gFLD.= ", tahun";
	$gVAL.= ", '".$thn."'";
	
	$gFLD.= ", nm_aset";
	$gVAL.= ", '".$gNm."'";
	
	$gFLD.= ", keterangan";
	$gVAL.= ", '-'";
	
	InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
}
?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>','0');
</script>
