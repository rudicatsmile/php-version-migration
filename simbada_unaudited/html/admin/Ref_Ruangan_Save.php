<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$gUpB = $gUpB;
$gNmR = str_replace('**',' ',$gNmR);
$gNoR = str_replace('**',' ',$gNoR);
$gNmP = str_replace('**',' ',$gNmP);
$gNiP = str_replace('**',' ',$gNiP);
$gJaB = str_replace('**',' ',$gJaB);

if ($gNoR==''){$gNoR=0;}
if ($gID)
{
	$nSQ="UPDATE ref_ruangan SET Nm_Ruang='$gNmR',No_Ruang='$gNoR',Nm_Pejabat='$gNmP',Nip_Pejabat='$gNiP',Nm_Jabatan='$gJaB' WHERE IDT='$gID'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
}
else
{
	$gNO = fGlobal("IfNull(max(kd_ruang),0)","ref_ruangan","kd_upb",$gUpB,"=","","");
	$gNO = ((int)substr($gNO,-3,3))+1;
	$gKoD = substr('00'.$gNO,-3,3);
	
	$nSQ="INSERT INTO ref_ruangan SET Kd_Upb='$gUpB',Kd_Ruang='$gKoD',Nm_Ruang='$gNmR',No_Ruang='$gNoR',Nm_Pejabat='$gNmP',Nip_Pejabat='$gNiP',Nm_Jabatan='$gJaB'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$gID = fGlobal("max(IDT)","ref_ruangan","kd_upb",$gUpB,"=","","");
}
?>

<script languange="javascript">
	refresEDIT('<?=$gID?>','<?=$IdL?>');
</script>