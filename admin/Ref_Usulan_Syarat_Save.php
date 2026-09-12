<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$gDS = str_replace('**',' ',$gDS);

if ($gUS=='true') {$gUS='Y';}
if ($gUS=='false') {$gUS='N';}

if ($gID)
{
	$nSQ="UPDATE ref_usulan_syarat SET Deskripsi='$gDS', fUse='$gUS' WHERE IDT='$gID'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
}
else
{
	$gNO = fGlobal("IfNull(max(Kode),0)","ref_usulan_syarat","Kode",$gJN."%","LIKE","","");
	if ($gNO)
	{
		$gNO = ((int)substr($gNO,-2,2))+1;
	}
	$gKD = $gJN.substr('0'.$gNO,-2,2);
	
	$nSQ="INSERT INTO ref_usulan_syarat SET Kode='$gKD', Deskripsi='$gDS', fUse='$gUS'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$gID = fGlobal("max(IDT)","ref_usulan_syarat","IDT","%","LIKE","","");
}
?>

<script languange="javascript">
	refresEDIT('<?=$gID?>','<?=$IdL?>');
</script>