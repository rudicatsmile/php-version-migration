<?
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
extract($_GET);
$rDTA = explode(':',$rDTA);
$rIdT = $rDTA[0];
$rTbL = $rDTA[1];

$gREF = fGlobal("Referensi","ta_rkbmd_new_pmf_pmt_phs","IDT",$IdT,"=","","");

$nSQ = "SELECT Referensi as A0,
Kd_UPB as A1,
Kd_Aset_108 as A2,
No_Register as A3,
Nm_Aset as A4,
Tgl_Perolehan as A5,
Keterangan as A6,
Harga as A7,
Ref_Mutasi as A8,
Ref_Usulan as A9,
extracom as A10,
Ref_Group as A11,
concat(Lokasi, ' ',alamat) as A12 
FROM ta_kib_108 WHERE IDT = '$rIdT'";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$CeK = fGlobal("IDT","ta_rkbmd_new_pmf_pmt_phs_rinci","referensi:ref_aset:ref_group:no_register",$gREF.":".$mRo[0].":".$mRo[11].":".$mRo[3],"=:=:=:=","","");
	if (!$CeK)
	{
		$mRo8 = fGlobal("ifNull(sum(debet),0)","ta_kib_post_108","referensi:ref_group:kd_upb:no_register",$mRo[0].":".$mRo[11].":".substr($mRo[1],0,18)."%:".$mRo[3],"=:=:LIKE:=","","dd");
		
		$gTBL = "ta_rkbmd_new_pmf_pmt_phs_rinci";
		$gFLD = "";
		$gVAL = "";
		
		$gFLD = "referensi";
		$gVAL = "'$gREF'";
		
		$gFLD.= ", ref_aset";
		$gVAL.= ", '".$mRo[0]."'";
		
		$gFLD.= ", ref_group";
		$gVAL.= ", '".$mRo[11]."'";
		
		$gFLD.= ", kd_upb";
		$gVAL.= ", '".$mRo[1]."'";
		
		$gFLD.= ", kd_aset";
		$gVAL.= ", '".$mRo[2]."'";
		
		$gFLD.= ", no_register";
		$gVAL.= ", '".$mRo[3]."'";
		
		$gFLD.= ", nm_aset";
		$gVAL.= ", '".mysql_real_escape_string($mRo[4])."'";
		
		$gFLD.= ", tgl_perolehan";
		$gVAL.= ", '".$mRo[5]."'";
		
		$gFLD.= ", keterangan";
		$gVAL.= ", '".mysql_real_escape_string($mRo[6])."'";
		
		$gFLD.= ", nilai_perolehan";
		$gVAL.= ", '".$mRo8."'";
		
		$gFLD.= ", extracom";
		$gVAL.= ", '".$mRo[10]."'";
		
		$gFLD.= ", jml_barang";
		$gVAL.= ", '1'";
		
		$gFLD.= ", lokasi";
		$gVAL.= ", '".$mRo[12]."'";
		
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
	}
}
?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>','0');
</script>
