<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

if ($IdT)
{
	$Ref = fGlobal("Referensi","ta_sp3d","IDT",$IdT,"=","","");
	if ($Ref)
	{
		$nSQ = "DELETE FROM ta_sp3d_rinci WHERE Referensi='$Ref'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_sp3d WHERE IDT='$IdT'";
		$nRs = mysql_query($nSQ);
	}
}
?>
<script languange="javascript">
	RefreshDATA('<?=$IdL?>');
</script>