<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

#echo $IdR."<br>";
#echo $IdT."<br>";

$ReT = fGlobalNEW("Referensi","ta_kib_kdptoaset_data","IDT",$IdR,"=","",DatabaseSB,$ConSB,"");
$ReA = fGlobalNEW("Ref_Aset","ta_kib_kdptoaset_data","IDT",$IdR,"=","",DatabaseSB,$ConSB,"");

$SQ = "DELETE FROM ta_kib_kdptoaset_data_post WHERE Referensi='".$ReT."' AND Ref_Aset='".$ReA."'";
$rs = mysql_query($SQ); 

$SQ = "DELETE FROM ta_kib_kdptoaset_data WHERE IDT='".$IdR."'";
$rs = mysql_query($SQ); 

?>

<script language="javascript">
	showKDPTA('refr','<?=$IdT?>','<?=$CrDiv?>','<?=$IdL?>');
</script>