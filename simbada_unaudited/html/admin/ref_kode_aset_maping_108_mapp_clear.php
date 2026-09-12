<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$CeK  = fGlobal("IDT","ref_rek_aset5_maping","Kd_Aset17",$kde,"=","","");
if ($CeK){
	$SQa = "UPDATE ref_rek_aset5_maping SET Kd_Aset108='' WHERE IDT='".$CeK."'";
	$nRa = mysql_query($SQa);
}
?>
<script languange='javascript'>
	alert('Clear mapping berhasil..!!');
	LoadPage('ViewDATA','ref_kode_aset_maping_108_data','IdL=<?=$IdL?>');	
</script>