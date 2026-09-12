<?php
require('Connection.php');
extract($_GET);
$fld = str_replace('**',' ',$fld);
#echo "xxxxxx";
#return false;

if ($rIdT){
	if ($crt=='LockRecord')
	{
		$nSQ = "UPDATE ta_rkbmd_new_pmf_pmt_phs_rinci SET $crt='".$fld."' $Scp WHERE IDT = '$rIdT'";
		$nRs = mysql_query($nSQ);
	}
}
?>

<script languange="javascript">
	RefreshDATA('<?=$IdL?>','0');
</script>