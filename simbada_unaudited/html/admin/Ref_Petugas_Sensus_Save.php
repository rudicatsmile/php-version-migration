<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$gDS = str_replace('**',' ',$gDS);
$gNP = str_replace('**',' ',$gNP);
$gHP = str_replace('**',' ',$gHP);

if ($gID)
{
	$nSQ="UPDATE tb_lembar_kerja_petugas SET 
	NmPetugas='$gDS',
	NiPetugas='$gNP',
	NoHP='$gHP' WHERE IDT='$gID'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
}
else
{
	$gNO = fGlobal("IfNull(max(IdPetugas),0)","tb_lembar_kerja_petugas","IdPetugas","%","LIKE","","");
	if ($gNO)
	{
		$gNO = ((int)substr($gNO,-3,3))+1;
	}
	else
	{
		$gNO = 1;
	}
	$gKD = "P".substr('000'.$gNO,-3,3);
	
	$nSQ="INSERT INTO tb_lembar_kerja_petugas SET 
	KdUPB='$KdN', 
	IdPetugas='$gKD', 
	NmPetugas='$gDS',
	NiPetugas='$gNP',
	NoHP='$gHP'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$gID = fGlobal("max(IDT)","tb_lembar_kerja_petugas","KdUPB",$KdN,"=","","");
}
?>

<script languange="javascript">
	refresEDIT('<?=$gID?>','<?=$IdL?>');
</script>