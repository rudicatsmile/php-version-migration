<?
require('Connection.php');
extract($_GET);
$fld = str_replace('**',' ',$fld);

if ($rIdT){
	if ($crt=='jumlah_yg_disetujui' || $crt=='disetujui_satuan' || $crt=='cara_pemenuhan')
	{
		if ($crt=='jumlah_yg_disetujui')
		{
			$fld = fConvertToNumeric($fld);
			
			$gUsuL = fGlobalNEW("usulan_jumlah","ta_rkbmd_new_rekening","IDT",$rIdT,"=","",$DatabaseSB,$ConSB,"");
			if ($fld<=$gUsuL)
			{
				$fld = $fld;
			}
			else
			{
				$fld = $gUsuL;
			}
		}
		
		$nSQ = "UPDATE ta_rkbmd_new_rekening SET $crt='".$fld."' $Scp WHERE IDT = '$rIdT'";
		$nRs = mysql_query($nSQ);
	}
	else if ($crt=='LockRecord')
	{
		$nSQ = "UPDATE ta_rkbmd_new_rekening SET $crt='".$fld."' $Scp WHERE IDT = '$rIdT'";
		$nRs = mysql_query($nSQ);
	}
}
?>

<script languange="javascript">
	RefreshDATA('<?=$stLOCK?>','<?=$IdL?>');
</script>