<?
require('Connection.php');
extract($_GET);
#echo $crt."<br>";
#echo $fld."<br>";
#echo $rIdT."<br>";
#echo $IdL;
$fld = str_replace('**',' ',$fld);
#echo $fld."<br>";
#return false;
if ($rIdT){
	if ($crt=='usulan_jumlah' || $crt=='usulan_satuan' || $crt=='usulankebthan_jumlah' || $crt=='usulankebthan_satuan' || $crt=='status_barang' || $crt=='keterangan' || $crt=='kondisi_barang'|| $crt=='nama_pemeliharaan' || $crt=='usulan_harga')
	{
		if ($crt=='usulankebthan_jumlah' || $crt=='usulan_jumlah' || $crt=='usulan_harga')
		{
			$fld = fConvertToNumeric($fld);
		}
		$nSQ = "UPDATE ta_rkpbmd_new_rekening SET $crt='".$fld."' WHERE IDT = '$rIdT'";
		$nRs = mysql_query($nSQ);
	}
	else if ($crt=='output'){
		$nSQ = "UPDATE ta_rkpbmd_new_kegiatan_sub SET Output='".$fld."' WHERE IDT = '$rIdT'";
		$nRs = mysql_query($nSQ);
	}
}

?>

<script languange="javascript">
RefreshDATA('<?=$stLOCK?>','<?=$IdL?>');
</script>