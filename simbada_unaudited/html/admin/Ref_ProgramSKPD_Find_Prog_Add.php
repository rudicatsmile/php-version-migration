<?
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
extract($_GET);
#echo $gUNT;

$gSKP = fGlobal("Kd_Unit_Link","ref_unit","Kd_Unit",$gUNT,"=","","");
if ($gSKP==""){
	$MsG="kode maping Unit belum terisi..!!";
	echo "<script type='text/javascript'>errorMSG('".$MsG."')</script>";
}
else{
	/*
	$rDTA = fGlobal("id_referensi:nm_referensi","ref_kegiatan","ido",$IdT,"=","","");
	$rDTA = explode(':',$rDTA);
	$rID = $rDTA[0];
	$rNM = $rDTA[1];
	
	$Sub4 = substr($rID,0,4);
	if ($Sub4=="X.XX") {$Sub4 = substr($gSKP,0,4);}
	$gNEW = $Sub4.".".$gSKP.".".substr($rID,-2,2);
	*/

	$rID  = $IdT;
	$Sub4 = substr($rID,0,4);
	if ($Sub4=="X.XX") {$Sub4 = substr($gSKP,0,4);}
	$gNEW = $Sub4.".".$gSKP.".".substr($rID,8,10);
	
	$gCEK = fGlobal("IDT","ta_apbd_program_skpd","kdUnit:idProgram:periode",$gUNT.":".$gNEW.":".$gTHN,"=:=:=","","");
	if (!$gCEK){
		$rNM  = fGlobal("nmProgram","ref_barsel_program","idReferensi",$rID,"=","","");
		$gTBL = "ta_apbd_program_skpd";
		$gFLD = "";
		$gVAL = "";
		$gFLD = "kdUnit";
		$gVAL = "'$gUNT'";
		
		$gFLD.= ", idProgram";
		$gVAL.= ", '$gNEW'";
		
		$gFLD.= ", idReferensi";
		$gVAL.= ", '$rID'";
		
		$gFLD.= ", nmProgram";
		$gVAL.= ", '$rNM'";
		
		$gFLD.= ", periode";
		$gVAL.= ", '$gTHN'";

		$gFLD.= ", apbd";
		$gVAL.= ", '0'";
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
	}
	else{
		$MsG="Program sudah ada (digunakan)..!!";
		echo "<script type='text/javascript'>errorMSG('".$MsG."')</script>";
	}
	echo "<script type='text/javascript'>RefreshDATA('".$IdL."')</script>";
}

?>
