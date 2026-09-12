<?
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
extract($_GET);

$rIdT = $rIdT;

$gRef = fGlobal("Referensi","ta_sp3d_rinci","IDT",$fIdT,"=","","");
$rUpB = fGlobal("Kd_UPB","ta_sp3d_rinci","IDT",$fIdT,"=","","");
$rTH  = fGlobal("Tahun","ta_sp3d","Referensi",$gRef,"=","","");
$r90  = fGlobal("Kd_ReknP90","ta_sp3d_rinci","IDT",$fIdT,"=","","");
$m90  = fGlobal("Nm_ReknP90","ta_sp3d_rinci","IDT",$fIdT,"=","","");
$NmA  = fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$rKD,"=","","");

$CeK  = fGlobal("IDT","ta_sp3d_spj","Referensi_SP3B:Kd_ReknP90:Kd_ReknP108",$gRef.":".$r90.":".$rKD,"=:=:=","","");
if ($CeK=='')
{
	$gNeW = 1;
	$rMax = fGlobal("max(Referensi)","ta_sp3d_spj","Referensi","TMP.".fGetDate('year')."%","LIKE","","");
	if ($rMax)
	{
		$gNeW = (int)substr($rMax,-8,8)+1;
	}
	$gNEW = "TMP.".fGetDate('year').".".substr(str_repeat('0',8).$gNeW,-8,8);
	
	$gTBL = "ta_sp3d_spj";
	$gFLD = "";
	$gVAL = "";
	
	$gFLD = "Referensi";
	$gVAL = "'$gNEW'";
	
	$gFLD.= ", Referensi_SP3B";
	$gVAL.= ", '$gRef'";
	
	$gFLD.= ", Kd_UPB";
	$gVAL.= ", '$rUpB'";
	
	$gFLD.= ", Tahun";
	$gVAL.= ", '$rTH'";
	
	$gFLD.= ", Kd_ReknP90";
	$gVAL.= ", '".$r90."'";
	
	$gFLD.= ", Nm_ReknP90";
	$gVAL.= ", '".$m90."'";
	
	
	
	$gFLD.= ", Kd_ReknP108";
	$gVAL.= ", '".$rKD."'";
	
	$gFLD.= ", Nm_ReknP108";
	$gVAL.= ", '".$NmA."'";
	
	$gFLD.= ", Pencatat";
	$gVAL.= ", '".$UID."'";
	
	$gFLD.= ", Recorded";
	$gVAL.= ", now()";
	
	InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
	

	#$gTBL = "ta_sp3d_spj_rinci";
	#$gFLD = "";
	#$gVAL = "";
	
	#$gFLD = "Referensi";
	#$gVAL = "'$gNEW'";
	
	#$gFLD.= ", Referensi_SP3B";
	#$gVAL.= ", '$gRef'";
	
	#$gFLD.= ", Kd_UPB";
	#$gVAL.= ", '".$rUpB."'";
	
	#$gFLD.= ", Kd_ReknP108";
	#$gVAL.= ", '".$rIdT."'";
	
	#$gFLD.= ", Nm_ReknP108";
	#$gVAL.= ", '".$NmA."'";
	
	#$gFLD.= ", Nilai";
	#$gVAL.= ", '0'";
	
	#$gFLD.= ", Uraian";
	#$gVAL.= ", ''";
	
	#InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
}
?>
<script type="text/javascript">
	//RefreshDATA('<?=$IdL?>','0');
	PilihDATA('<?=$fIdT?>','0','<?=$IdL?>');
	showReknP108('find','<?=$fIdT?>','<?=$IdL?>');
</script>
