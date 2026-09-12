<?php
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
extract($_GET);
#echo $gUNT;
$gSKP = fGlobal("Kd_Unit_Link","ref_unit","Kd_Unit",$gUNT,"=","","");
$rDTA = fGlobal("id_referensi:nm_referensi","ref_kegiatan","ido",$IdT,"=","","");

$rDTA = explode(':',$rDTA);
$rID = $rDTA[0];
$rNM = $rDTA[1];

$Sub4 = substr($rID,0,4);
if ($Sub4=="X.XX") {$Sub4 = substr($gSKP,0,4);}

$gNEW = $Sub4.".".$gSKP.".".substr($rID,-5,5);

$gCEK = fGlobal("IDT","ta_apbd_kegiatan_skpd","kdUnit:idKegiatan:periode:apbd",$gUNT.":".$gNEW.":".$gTHN,"=:=:=","","");
if (!$gCEK){
		$gTBL = "ta_apbd_kegiatan_skpd";
		$gFLD = "";
		$gVAL = "";
		$gFLD = "kdUnit";
		$gVAL = "'$gUNT'";
		
		$gFLD.= ", idKegiatan";
		$gVAL.= ", '$gNEW'";
		
		$gFLD.= ", idReferensi";
		$gVAL.= ", '$rID'";
		
		$gFLD.= ", nmKegiatan";
		$gVAL.= ", '$rNM'";
		
		$gFLD.= ", periode";
		$gVAL.= ", '$gTHN'";

		$gFLD.= ", apbd";
		$gVAL.= ", '0'";
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);

}
?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>');
</script>
