<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

$gDT = fGlobal("referensi:ref_usulan:ref_aset:kd_upb","ta_usulan_verifikasi_rinci","IDT",$tID,"=","","");
if ($gDT){
	$gDT = explode(":",$gDT);
	$RfE = $gDT[0];
	$RfU = $gDT[1];
	$RfA = $gDT[2];
	$KdU = substr($gDT[3],0,11);
	$SQ = "DELETE FROM ta_usulan_verifikasi_rinci WHERE Referensi='$RfE' AND Ref_Usulan='$RfU' AND Ref_Aset='$RfA' AND Kd_UPB LIKE '$KdU%'";
	$Rs = mysql_query($SQ);
	
	if ($Rs){
		$SQ="DELETE FROM ta_usulan_verifikasi_rinci_syarat WHERE Referensi='$RfE' AND Ref_Usulan='$RfU' AND Ref_Aset='$RfA' AND Kd_UPB LIKE '$KdU%'";
		$Rw = mysql_query($SQ);
	}
	if ($Rw){
		$SQ="DELETE FROM ta_usulan_rinci WHERE Referensi='$RfU' AND Ref_Aset='$RfA' AND Kd_UPB LIKE '$KdU%'";
		$Rw = mysql_query($SQ);
	}
}

?>
<script languange="javascript">
	showEXEC_RefR('','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>');
</script>