<?
$rJns = fGlobal("Jenis","ta_usulan_verifikasi_108","Referensi",$rRef,"=","","");
$nSQ = "SELECT Kode FROM ref_usulan_syarat WHERE Kode LIKE '$rJns%' AND fUse='Y' ORDER BY Kode";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$rKD = $mRo[0];
	$CeK = fGlobal("IDT","ta_usulan_verifikasi_rinci_syarat_108","Referensi:Ref_Usulan:Ref_Aset:Kd_Syarat",$rRef.":".$rReU.":".$rReA.":".$rKD,"=:=:=:=","","");
	if (!$CeK)
	{
		$SQ = "INSERT INTO ta_usulan_verifikasi_rinci_syarat_108 SET 
		Referensi='$rRef',
		Ref_Usulan='$rReU',
		Ref_Aset='$rReA',
		Kd_UPB='$rUPB',
		Kd_Syarat='$rKD',
		Fisik='Tidak Ada',
		Status='Tidak Memenuhi',
		Memo=''";
		$Rs = mysql_query($SQ);
	}
}
?>