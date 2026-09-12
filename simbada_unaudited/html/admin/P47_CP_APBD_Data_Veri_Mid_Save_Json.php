<?
require "Connection.php";
require "FileFunction.php";
require('CheckLogin.php');

$data = array();
extract($_POST);

#$data['nmUnt'] = fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($kde,0,11),"=","","");
#$data['Mess'] = $fld.":".$NoID.":".$val.":".$NoM.":".$IdT.":".$IdL;

if ($fld=='NmaVerifikator' || $fld=='NipVerifikator' || $fld=='JbtVerifikator' || $fld=='TglVerifikasi')
{
	if ($fld=='TglVerifikasi')
	{
		$val = explode("/",$val);
		$val = $val[2]."-".$val[1]."-".$val[0];
	}
	$SQ = "UPDATE ta_pengadaan_verifikator SET 
	$fld='".$val."', 
	Recorded=now(),
	Pencatat='".$UID."' 
	WHERE Nomor='".$NoM."'";
	$rs = mysql_query($SQ);
}
else
{
	$SQ = "UPDATE ta_pengadaan_verifikasi SET 
	$fld='".$val."', 
	Recorded=now(),
	Pencatat='".$UID."' 
	WHERE Nomor='".$NoM."' AND NoID='".$NoID."'";
	$rs = mysql_query($SQ);
}

if ($rs)
{
	$data['Mess'] = "";//"Proses berhasil..!!";
}

echo json_encode($data);
?>
