<?php
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
extract($_GET);
 
if ($rIdT) 
{ 
    if ($CrT=='JML')
	{
		$gVL = fConvertToNumeric($gVL); 
		if ($gVL=="") {$gVL=0;} 
		$nSQ = "UPDATE ta_sp3d_rinci SET Nilai='$gVL' WHERE IDT='".$rIdT."'"; 
		$nRs = mysql_query($nSQ);
		
		$Ref = fGlobal("Referensi","ta_sp3d_rinci","IDT",$rIdT,"=","","");
		$JmL = fGlobal("IfNull(sum(Nilai),0)","ta_sp3d_rinci","Referensi",$Ref,"=","","");
		
		$nSQ = "UPDATE ta_sp3d SET Nilai='$JmL' WHERE Referensi='".$Ref."'"; 
		$nRs = mysql_query($nSQ);
	}
    if ($CrT=='URA')
	{
		$gVL = str_replace('**',' ',$gVL); 
		$nSQ = "UPDATE ta_sp3d_rinci SET Uraian='$gVL' WHERE IDT='".$rIdT."'"; 
		$nRs = mysql_query($nSQ);
	}
}
?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>','0');
</script>
