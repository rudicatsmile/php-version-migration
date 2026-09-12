<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
#echo $IdT
if ($IdT)
{
	$Ref = fGlobal("Referensi","ta_rkbmd_standar_kebutuhan","IDT",$IdT,"=","","");
	
	$nSQ = "DELETE FROM ta_rkbmd_standar_kebutuhan_rinci WHERE Referensi='$Ref'";
	mysql_query($nSQ);
		
	$nSQ = "DELETE FROM ta_rkbmd_standar_kebutuhan WHERE IDT='$IdT'";
	mysql_query($nSQ);
}
?>
<script languange="javascript">
	B39.click();
</script>