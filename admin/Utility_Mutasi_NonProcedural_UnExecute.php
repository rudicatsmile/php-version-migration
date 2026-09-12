<?php
extract($_GET);
require('Connection.php');
require('FileFunction.php');
#require('Connection_CopyData.php');
#CallConnection(DatabaseSB,$ConSB);
$gCrID = $gCrID;
$gTbL  = $gTbL;
$PgE  = $PgE;
$JmL = (substr_count($gCrID, "-")-1);
$gDT = explode("-",$gCrID);

$SyT = "";
for ($i=0; $i<=$JmL; $i++)
{
	if ($i>0){
		$SyT.= " OR IDT='".$gDT[$i]."'";
	}
	else{
		$SyT = "IDT='".$gDT[$i]."'";
	}
}

$nSQ="SELECT referensi, kd_upb FROM ta_kib_".$gTbL." WHERE (".$SyT.") ORDER BY IDT";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$rRef = $mRo[0];
	$rUpb = $mRo[1];
	
	#CallConnection(DatabaseSC,$ConSC);
	#$SQ = "DELETE FROM ta_kib_".$gTbL."_mutasi WHERE referensi_to='".$rRef."' AND kd_upb_to='".$rUpb."'";
	#$rs = mysql_query($SQ);
	
	#$SQ = "DELETE FROM ta_kib_post_mutasi WHERE referensi_to='".$rRef."' AND kd_upb_to='".$rUpb."'";
	#$rs = mysql_query($SQ);
	
	#CallConnection(DatabaseSB,$ConSB);
	$SQ = "DELETE FROM ta_kib_".$gTbL." WHERE referensi='".$rRef."' AND kd_upb='".$rUpb."'";
	$rs = mysql_query($SQ);
	
	$SQ = "DELETE FROM ta_kib_post WHERE referensi='".$rRef."' AND kd_upb='".$rUpb."'";
	$rs = mysql_query($SQ);
	
	#$SQ = "DELETE FROM ta_kib_post_penyusutan_bulanan WHERE referensi='".$rRef."' AND kd_upb='".$rUpb."'";
	#$rs = mysql_query($SQ);
}
?>
<script languange="javascript">
	RefreshDT('<?=$IdL?>','<?=$PgE?>');
	$(document).ready(function()
	{
		$("#loadingImg").hide();
	});
</script>