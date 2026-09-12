<?
require('Connection.php');
require('FileFunction.php');
$data = array();

extract($_POST);
if ($IdT!='')
{
	$nSQ = "UPDATE ta_penerimaan_berkas SET 
	Kd_Program='".$idPro."',
	Nm_Program='".$nmPro."',
	Kd_Kegiatan='".$idKeg."',
	Nm_Kegiatan='".$nmKeg."',
	Kd_SubKegiatan='".$idSub."',
	Nm_SubKegiatan='".$nmSub."',
	Kd_Rek13='".$idRek."',
	Nm_Rek13 ='".$nmRek."' 
	WHERE IDT='".$IdT."'";
	mysql_query($nSQ);
	
	$data['IdT']  = $IdT;
}
echo json_encode($data);
?>