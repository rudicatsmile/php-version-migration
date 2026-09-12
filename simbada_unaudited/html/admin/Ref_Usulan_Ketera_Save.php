<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$gDS = str_replace('**',' ',$gDS);

if ($gUS=='true') {$gUS='Y';}
if ($gUS=='false') {$gUS='N';}

if ($gID)
{
	$nSQ="UPDATE ref_usulan_jenis_rinci SET Deskripsi='$gDS' WHERE IDT='$gID'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
}
else
{
	$gNO = fGlobal("IfNull(max(Kode),0)","ref_usulan_jenis_rinci","Kode:Kode",$gJN."%:%999","LIKE:NOT LIKE","","");
	if ($gNO)
	{
		$gNO = ((int)substr($gNO,-3,3))+1;
	}
	$gKD = $gJN.substr('000'.$gNO,-3,3);
	
	$nSQ="INSERT INTO ref_usulan_jenis_rinci SET Kode='$gKD', Deskripsi='$gDS'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$gID = fGlobal("max(IDT)","ref_usulan_jenis_rinci","IDT","%","LIKE","","");
}
?>

<script languange="javascript">
	refresEDIT('<?=$gID?>','<?=$IdL?>');
</script>