<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

#echo $IdR."<br>";
#echo $IdT."<br>";

$ReT = fGlobalNEW("Referensi","ta_kib_kdptoaset_data","IDT",$IdR,"=","",DatabaseSB,$ConSB,"");

$SQ = "UPDATE ta_kib_kdptoaset_data SET Induk='N' WHERE Referensi='".$ReT."'";
$rs = mysql_query($SQ); 

$SQ = "UPDATE ta_kib_kdptoaset_data SET Induk='Y' WHERE IDT='".$IdR."'";
$rs = mysql_query($SQ); 

?>

<script language="javascript">
	showKDPTA('refr','<?=$IdT?>','<?=$CrDiv?>','<?=$IdL?>');
</script>