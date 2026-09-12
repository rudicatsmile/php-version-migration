<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

#echo $fld."<br>";
#echo $val."<br>";
#echo $frm."<br>";
#echo $IdT."<br>";
#echo $SnsIDT."<br>";
#echo $IdL."<br>";

if ($frm=='Y') {$val=str_replace('**',' ',$val);}
if ($frm=='Y' && ($fld=='JmlBarang' || $fld=='NilaiPerolehan')) {$val = fConvertToNumeric($val);}

if ($TbL=='TbL2')
{
	$SyT= "";
	if ($fld=='PP_dasarpenggunaan' || $fld=='PDL_dasarpenggunaan' || $fld=='PL_dasarpenggunaan')
	{
		#$SyT=", PD_NmKuasaPenggunaLainnya=''";
	}
	
	$SQ = "UPDATE tb_lembar_kerja_penggunaan SET $fld='".$val."' $SyT WHERE IDT='".$SnsIDT."'";
	$rs = mysql_query($SQ);
	
}
elseif ($TbL=='TbL3')
{
	$SyT= "";
	if ($fld=='' || $fld=='' || $fld=='')
	{
		#$SyT=", PD_NmKuasaPenggunaLainnya=''";
	}
	
	$SQ = "UPDATE tb_lembar_kerja_tercatat_ganda SET $fld='".$val."' $SyT WHERE IDT='".$SnsIDT."'";
	$rs = mysql_query($SQ);
	
}
elseif ($TbL=='TbL4')
{
	$SyT= "";
	if ($fld=='' || $fld=='' || $fld=='')
	{
		#$SyT=", PD_NmKuasaPenggunaLainnya=''";
	}
	
	$SQ = "UPDATE tb_lembar_kerja_merupakan_biaya_atribusi SET $fld='".$val."' $SyT WHERE IDT='".$SnsIDT."'";
	$rs = mysql_query($SQ);
	
}
else if ($TbL=='TbL1')
{
	$SyT = "";
	if ($val=='sesuai') 
	{
		$TmB = $fld."Memo"; 
		//$SyT = ", $TmB=''";
	}
	
	if ($fld=='TanggalSensusHR' || $fld=='TanggalSensusBL' || $fld=='TanggalSensusTH')
	{
		$DT = fGlobal("TanggalSensus","tb_lembar_kerja","IDT",$SnsIDT,"=","","");
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
		$fld = "TanggalSensus";
	}
	
	$SQ = "UPDATE tb_lembar_kerja SET $fld='".$val."' $SyT WHERE IDT='".$SnsIDT."'";
	#echo $SQ;
	$rs = mysql_query($SQ);
}
?>

<script languange="javascript">
showLKI('refr','<?=$AsT?>','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>');
</script>