<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$CeK  = fGlobal("IDT","ref_rek_aset5_maping","Kd_Aset17",$kde,"=","","");
if ($CeK){
	$SQa = "UPDATE ref_rek_aset5_maping SET Kd_Aset108='".$MapSu2E."' WHERE IDT='".$CeK."'";
	$nRa = mysql_query($SQa);
}
else{
	$SQa = "INSERT INTO ref_rek_aset5_maping SET 
	Kd_Aset17='".$kde."',
	Kd_Aset108='".$MapSu2E."'";
	$nRa = mysql_query($SQa);
}
?>
<script languange='javascript'>
	alert('Mapping rekening berhasil..!!');
	closePopup('mappDivShow0');
	LoadPage('ViewDATA','ref_kode_aset_maping_108_data','IdL=<?=$IdL?>');
	
</script>