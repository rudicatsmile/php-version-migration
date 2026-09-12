<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$DT = fGlobal("TanggalSensus","tb_lembar_kerja_belum_tercatat","IDT",$IdT,"=","","");
$DT = explode('-',$DT);
$oHr = $DT[2];
$oBl = $DT[1];
$oTh = $DT[0];
if ($fld=='TanggalSensusHR')
{
	$val = $oTh.'-'.$oBl.'-'.substr('00'.$val,-2,2);
}

if ($fld=='TanggalSensusBL')
{
	$val = $oTh.'-'.substr('00'.$val,-2,2).'-'.$oHr;
}

if ($fld=='TanggalSensusTH')
{
	$val = substr('00'.$val,-2,2).'-'.$oBl.'-'.$oHr;
}

$SQ = "UPDATE tb_lembar_kerja_belum_tercatat SET TanggalSensus='".$val."' WHERE IDT='".$IdT."'";
$rs = mysql_query($SQ);

?>

<script languange="javascript">
NewAset('refr','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>');
</script>