<?
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
extract($_GET);

$rIdT = $rIdT;

$gRef = fGlobal("Referensi","ta_sp3d","IDT",$IdT,"=","","");
$rUpB = fGlobal("Kd_UPB","ta_sp3d","IDT",$IdT,"=","","");
$rThN = fGlobal("Tahun","ta_sp3d","IDT",$IdT,"=","","");
$NmA  = fGlobal("Nm_Rek","ref_rek_90_6","Kd_Rek",$rIdT,"=","","");

	$gTBL = "ta_sp3d_rinci";
	$gFLD = "";
	$gVAL = "";
	
	$gFLD = "Referensi";
	$gVAL = "'$gRef'";
	
	$gFLD.= ", Kd_UPB";
	$gVAL.= ", '".$rUpB."'";
	
	$gFLD.= ", Tahun";
	$gVAL.= ", '".$rThN."'";
	
	$gFLD.= ", Kd_ReknP90";
	$gVAL.= ", '".$rIdT."'";
	
	$gFLD.= ", Nm_ReknP90";
	$gVAL.= ", '".$NmA."'";
	
	$gFLD.= ", Nilai";
	$gVAL.= ", '0'";
	
	$gFLD.= ", Uraian";
	$gVAL.= ", ''";
	
	InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>','0');
	showReknP90('find','<?=$IdT?>','<?=$IdL?>');
</script>
