<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
#echo $IdT
if ($IdT)
{
	$Ref = fGlobal("Referensi","ta_rkbmd_new_pmf_pmt_phs","IDT",$IdT,"=","","");
	
	$nSQ = "DELETE FROM ta_rkbmd_new_pmf_pmt_phs_rinci WHERE Referensi='$Ref'";
	mysql_query($nSQ);
		
	$nSQ = "DELETE FROM ta_rkbmd_new_pmf_pmt_phs WHERE IDT='$IdT'";
	mysql_query($nSQ);
}
?>
<script languange="javascript">
	//RefreshDATA('<?=$Frm?>','<?=$Crit?>','<?=$IdL?>');
	B39.click();
</script>