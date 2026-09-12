<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

#echo $IdR."<br>";
#echo $IdT."<br>";

$ReT = fGlobalNEW("Referensi","ta_kib_kdptoaset","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");

$SQ = "DELETE FROM ta_kib_kdptoaset_data_post WHERE Referensi='".$ReT."'";
$rs = mysql_query($SQ); 

$SQ = "DELETE FROM ta_kib_kdptoaset_data WHERE Referensi='".$ReT."'";
$rs = mysql_query($SQ); 

$SQ = "DELETE FROM ta_kib_kdptoaset WHERE IDT='".$IdT."'";
$rs = mysql_query($SQ); 

?>

<script language="javascript">
	findDATA('refr','find','<?=$IdL?>');
</script>