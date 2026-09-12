<?
require('Connection.php');
require "FileFunction.php";

$data = array();
extract($_POST);

if ($IdT!='')
{
	$SW = "UPDATE ta_rkbmd_new_pmf_pmt_phs_rinci SET 
	peruntukan='".$Peru."',
	bentuk_pemanfaatan='".$Bent."',
	jangka_waktu_pemanfaatan='".$fJml." ".$fWkt."', 
	bentuk_pemindahtanganan='".$BenP."',
	alasan_rencana_pemindahtanganan='".$AlaP."',
	alasan_rencana_penghapusan='".$AlaD."' 
	WHERE IDT='".$IdT."'";
	$rs = mysql_query($SW);
	if ($rs){$Mss="proses berhasil...!!";}
}
$data['mess'] = $Mss;
echo json_encode($data);
?>