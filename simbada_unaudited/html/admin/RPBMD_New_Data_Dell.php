<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
if ($IdT)
{
	$Ref = fGlobal("Referensi","ta_rpbmd_new","IDT",$IdT,"=","","");
	if ($Ref){

		$nSQ = "DELETE FROM ta_rpbmd_new_aset WHERE Referensi='$Ref'";
		$nRs = mysql_query($nSQ);
		if ($nRs){
			$nSQ = "DELETE FROM ta_rpbmd_new WHERE Referensi='$Ref'";
			$nRs = mysql_query($nSQ);
		}
	}
}
?>
<script languange="javascript">
	RefreshDATA('<?=$IdL?>');
</script>