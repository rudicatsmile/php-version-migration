<?php
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
extract($_GET);

$rIdT = $rIdT;

$Ref = fGlobal("Referensi","ta_sp3d_rinci","IDT",$rIdT,"=","","");

$nSQ = "DELETE FROM ta_sp3d_rinci WHERE IDT='".$rIdT."'";
$nRs = mysql_query($nSQ);

$JmL = fGlobal("IfNull(sum(Nilai),0)","ta_sp3d_rinci","Referensi",$Ref,"=","","");

$nSQ = "UPDATE ta_sp3d SET Nilai='$JmL' WHERE Referensi='".$Ref."'"; 
$nRs = mysql_query($nSQ);

?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>','0');
</script>
