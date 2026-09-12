<?
require('Connection.php');
require('FileFunction.php');

$data = array();
extract($_POST);
if ($UpB=='00.00.00.00.00.000')
{
	if ($SuB=='00.00.00.00.00')
	{
		$UnT = $UnT;
	}
	else
	{
		$UnT = $SuB;
	}
}
else
{
	$UnT = $UpB;
}

$AsT = $AsT;
$Ref = AwalRef108($AsT);

$RecA = fGlobal("count(*)","ta_kib_108","Referensi:Kd_UPB",$Ref.".%:".$UnT."%","LIKE:LIKE","","");
$RecB = fGlobal("count(*)","tb_lembar_kerja","Referensi:KdUPB",$Ref.".%:".$UnT."%","LIKE:LIKE","","");

$data['RecA']  = $RecA;
$data['RecB']  = $RecB;

$data['ReC'] = "NotOK";
if ($RecA==$RecB)
{
	$data['ReC'] = "OK";
}

echo json_encode($data);

?>