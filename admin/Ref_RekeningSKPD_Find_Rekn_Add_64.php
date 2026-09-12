<?php
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
extract($_GET);
#echo $gUNT;
$gSKP = fGlobal("Kd_Unit_Link","ref_unit","Kd_Unit",$gUNT,"=","","");

#<=2019
#$rDTA = fGlobal("kd_rek:nm_rek","ref_rek_5","idt",$IdT,"=","","");

#<=2020
$rDTA = fGlobal("kd_rekening:nm_rekening","ref_rek_64_5","idt",$IdT,"=","","");


$rDTA = explode(':',$rDTA);
$rID = $rDTA[0];
$rNM = $rDTA[1];

$gCEK = fGlobal("IDT","ta_apbd_rekening_skpd","kdUnit:idKegiatan:kdRekening:periode",$gUNT.":".$gKEG.":".$rID.":".$gTHN,"=:=:=:=","","");
if (!$gCEK){
		$gTBL = "ta_apbd_rekening_skpd";
		$gFLD = "";
		$gVAL = "";
		$gFLD = "kdUnit";
		$gVAL = "'$gUNT'";
		
		$gFLD.= ", idKegiatan";
		$gVAL.= ", '$gKEG'";
		
		$gFLD.= ", kdRekening";
		$gVAL.= ", '$rID'";
		
		$gFLD.= ", nmRekening";
		$gVAL.= ", '$rNM'";
		
		$gFLD.= ", periode";
		$gVAL.= ", '$gTHN'";

		$gFLD.= ", apbd";
		$gVAL.= ", '0'";

		$gFLD.= ", fnJumlah";
		$gVAL.= ", '0'";
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);

}
?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>');
</script>
