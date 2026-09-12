<?php
require('Connection.php');
extract($_GET);
//gFrm
//gID
//gKD
//IdL

if ($gFrm=='alas'){
	$nSQ = "UPDATE ta_usulan_rinci_108 SET Kd_Rinci='$gKD' WHERE IDT='$gID'";
	$nRs = mysql_query($nSQ);
}
if ($gFrm=='kib'){
	$nSQ = "UPDATE ta_usulan_rinci_108 SET KIB_To='$gKD', To_Kd_Aset=''  WHERE IDT='$gID'";
	$nRs = mysql_query($nSQ);
}
if ($gFrm=='rekn'){
	$nSQ = "UPDATE ta_usulan_rinci_108 SET To_Kd_Aset='$gKD' WHERE IDT='$gID'";
	$nRs = mysql_query($nSQ);
}
if ($gFrm=='skpd'){
	$nSQ = "UPDATE ta_usulan_rinci_108 SET To_UPB='$gKD' WHERE IDT='$gID'";
	$nRs = mysql_query($nSQ);
}
?>

<script languange="javascript">
	showREF('Edit','<?=$gID?>','<?=$IdL?>');
</script>