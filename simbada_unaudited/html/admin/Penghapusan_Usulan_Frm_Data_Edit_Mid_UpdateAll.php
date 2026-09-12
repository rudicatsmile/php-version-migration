<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$mReF = fGlobal("Referensi","ta_usulan_rinci_108","IDT",$IdT,"=","","");
if ($mReF!='')
{
	$mKD  = fGlobal("To_UPB","ta_usulan_rinci_108","IDT",$IdT,"=","","");
	if ($mKD!='')
	{
		$nSQ = "UPDATE ta_usulan_rinci_108 SET To_UPB='$mKD' WHERE Referensi='$mReF'";
		$nRs = mysql_query($nSQ);
	}
}
?>
<script languange="javascript">
	alert('done..!!');
</script>