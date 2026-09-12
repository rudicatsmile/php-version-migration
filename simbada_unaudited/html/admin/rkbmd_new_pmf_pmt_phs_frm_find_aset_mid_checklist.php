<?
require('Connection.php');
require('FileFunction.php');
require('file_insertupdate.php');
extract($_GET);

if ($rUpb=='All'){$rUpb="";}
if ($rUpb!=''){$gUNT=$rUpb;}

$gREF  = fGlobal("Referensi","ta_rkbmd_new_pmf_pmt_phs","IDT",$IdT,"=","","");
$AmBiL = $AmBiL;

if ($AmBiL=="ALL")
{
	$CrT = "";
	$FnD = str_replace('**',' ',$gFnD);
	if ($FnD)
	{
		$CrT ="AND (No_Register LIKE '%$FnD%' OR Referensi LIKE '%$FnD%' OR Kd_Aset_108 LIKE '%$FnD%' OR Nm_Aset LIKE '%$FnD%'";
		if ($gAsT=='1.3.1') {$CrT.=" OR Alamat LIKE '%$FnD%' OR Luas_M2 LIKE '%$FnD%' OR Ref_Usulan LIKE '%$FnD%'";}
		if ($gAsT=='1.3.2') {$CrT.=" OR Merk LIKE '%$FnD%' OR Type LIKE '%$FnD%' OR Ref_Usulan LIKE '%$FnD%'";}
		if ($gAsT=='1.3.3') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Luas_Lantai LIKE '%$FnD%' OR Ref_Usulan LIKE '%$FnD%'";}
		if ($gAsT=='1.3.4') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Konstruksi LIKE '%$FnD%' OR Ref_Usulan LIKE '%$FnD%'";}
		if ($gAsT=='1.3.5') {$CrT.=" OR Bahan LIKE '%$FnD%' OR Judul LIKE '%$FnD%' OR Ref_Usulan LIKE '%$FnD%'";}
		if ($gAsT=='1.3.6') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Dokumen_Nomor LIKE '%$FnD%'";}
		if ($gAsT=='1.5.3' || $gAsT=='1.5.4') {$CrT.=" OR Lokasi LIKE '%$FnD%' OR Dokumen_Nomor LIKE '%$FnD%' OR Ref_Usulan LIKE '%$FnD%'";}
		$CrT.=")";
	}
	
	if ($gTHN==""){$gTHN="____";}
	
	$nSQ = "SELECT Referensi as A0,
	Kd_UPB as A1,
	Kd_Aset_108 as A2,
	No_Register as A3,
	Nm_Aset as A4,
	Tgl_Perolehan as A5,
	Keterangan as A6,
	Harga as A7,
	IDT as A8,
	Ref_Mutasi as A9,
	Ref_Usulan as A10,
	extracom as A11, 
	Ref_Group as A12,
	concat(Lokasi, ' ',alamat) as A13 
	FROM ta_kib_108  
	WHERE extracom LIKE '".$gExT."' AND Kd_Aset_108 LIKE '".$gAsT."%' AND Kd_UPB LIKE '".$gUNT."%' 
	AND Tgl_Perolehan LIKE '".$gTHN."-%-%' AND KdpToAset='N' $CrT 
	ORDER BY Kd_Aset_108, No_Register, Tgl_Perolehan LIMIT $PgE, $gLST";
}
else
{
	$JmL  = (substr_count($gCrID, "-")-1);
	$gDT  = explode("-",$gCrID);
	
	$SyT = "";
	for ($i=0; $i<=$JmL; $i++)
	{
		if ($i>0){
			$SyT.= " OR IDT='".$gDT[$i]."'";
		}
		else{
			$SyT = "IDT='".$gDT[$i]."'";
		}
	}
	$nSQ = "SELECT Referensi as A0,
	Kd_UPB as A1,
	Kd_Aset_108 as A2,
	No_Register as A3,
	Nm_Aset as A4,
	Tgl_Perolehan as A5,
	Keterangan as A6,
	Harga as A7,
	IDT as A8,
	Ref_Mutasi as A9,
	Ref_Usulan as A10,
	extracom as A11, 
	Ref_Group as A12,
	concat(Lokasi, ' ',alamat) as A13 
	FROM ta_kib_108 WHERE (".$SyT.") ORDER BY IDT";
}
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$eUpB = substr($mRo[1],0,11);
	
	$CeK = fGlobal("IDT","ta_rkbmd_new_pmf_pmt_phs_rinci","referensi:ref_aset:ref_group:no_register",$gREF.":".$mRo[0].":".$mRo[12].":".$mRo[3],"=:=:=:=","","");
	if (!$CeK)
	{
		$mRo8 = fGlobal("ifNull(sum(debet),0)","ta_kib_post_108","referensi:kd_upb:ref_group:no_register",$mRo[0].":".$eUpB."%:".$mRo[12].":".$mRo[3],"=:LIKE:=:=","","");
		
		$gTBL = "ta_rkbmd_new_pmf_pmt_phs_rinci";
		$gFLD = "";
		$gVAL = "";
		
		$gFLD = "referensi";
		$gVAL = "'".$gREF."'";
		
		$gFLD.= ", ref_aset";
		$gVAL.= ", '".$mRo[0]."'";
		
		$gFLD.= ", ref_group";
		$gVAL.= ", '".$mRo[12]."'";
		
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
		$gVAL.= ", '".$mRo[11]."'";
		
		$gFLD.= ", jml_barang";
		$gVAL.= ", '1'";
		
		$gFLD.= ", lokasi";
		$gVAL.= ", '".$mRo[13]."'";
		
		InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
		
	}
}
?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>','0');
</script>
