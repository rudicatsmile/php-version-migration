<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
#echo $NiL."<br>";
#echo $Crt."<br>";
#echo $IdT."<br>";
#echo $IdL."<br>";

$nSQ = "UPDATE ta_unit_lock SET $Crt='$NiL' WHERE IDT='$IdT'";
//echo $nSQ;
$nRs = mysql_query($nSQ);
?>
<script languange="javascript">
	RefreshDATA('<?=$IdL?>');
</script>