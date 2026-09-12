<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

$rekd = fGlobal("Kd_Rekening_17:Kd_Rekening_108:Referensi","ta_permohonan_repla_rek_aset_rinci","IDT",$eIdT,"=","","");
$rekd = explode(':',$rekd);
$rek17 = $rekd[0];
$rek108= $rekd[1];
$refr  = $rekd[2];

$IdUnt = fGlobal("Kd_Unit","ta_permohonan_repla_rek_aset","Referensi",$refr,"=","","");

$nX = (int)substr($rek17,0,2);
if ($nX=="1"){
	
}

$gCnT = fGlobal("IfNull(count(*),0)","ta_kib_".fNmHuruf($nX),"Kd_Aset:Kd_UPB",$mRo1.":".$UnT."%","=:LIKE","","");


#kib
$nSQ = "UPDATE ta_kib_".fNmHuruf($nX)." SET Kd_Aset_108='$rek108' 
WHERE Kd_Aset='$rek17' AND Kd_UPB LIKE '".$IdUnt."%'";
$nRs = mysql_query($nSQ);

#kib post
$nSQ = "UPDATE ta_kib_post SET Kd_Aset_108='$rek108' 
WHERE Kd_Aset='$rek17' AND Kd_UPB LIKE '".$IdUnt."%'";
$nRs = mysql_query($nSQ);

#rek rinci
$nSQ = "UPDATE ta_permohonan_repla_rek_aset_rinci SET Executed='Y' WHERE IDT='$eIdT'";
$nRs = mysql_query($nSQ);

?>
<script languange="javascript">
	showEXEC_RefR('<?=$gFnD?>','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>')
</script>
	
