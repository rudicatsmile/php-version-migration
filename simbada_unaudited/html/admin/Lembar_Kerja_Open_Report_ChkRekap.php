<?
require('Connection.php');
require('FileFunction.php');

$data = array();
extract($_GET);
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

$nSQ = "SELECT 
P1.IDT as A0,
P1.Referensi as A1,
P1.Ref_Group as A2,
P1.Ref_Mutasi as A3,
P1.Ref_Usulan as A4,
P1.Ref_History as A5,
P1.Ref_Usulan_His as A6,
P1.Ref_KdpToAset as A7,
P1.Kd_UPB as A8,
P1.Kd_Aset_108 as A9,
P1.Kd_Ruang as A10,
P1.No_Register as A11,
P1.No_Pengadaan as A12,
P1.Ref_Temp as A13,
P1.Nm_Aset as A14,
P1.Kd_Pemilik as A15,
P1.Tgl_Perolehan as A16,
P1.Tgl_Mutasi as A17,
P1.Tgl_Mulai as A18,
P1.Tahun as A19,
P1.Luas_M2 as A20,
P1.Alamat as A21,
P1.Hak_Tanah as A22,
P1.Sertifikat as A23,
P1.Sertifikat_Tanggal as A24,
P1.Sertifikat_Nomor as A25,
P1.Penggunaan as A26,
P1.Asal_Usul as A27,
P1.Harga as A28,
P1.Merk as A29,
P1.Type as A30,
P1.Ukuran_CC as A31,
P1.Bahan as A32,
P1.Nomor_Pabrik as A33,
P1.Nomor_Rangka as A34,
P1.Nomor_Mesin as A35,
P1.Nomor_Polisi as A36,
'' as A37,
P1.Nomor_BPKB as A38,
P1.Pemegang as A39,
P1.Pemegang_Lama as A40,
P1.Kondisi as A41,
P1.Masa_Manfaat as A42,
P1.Nilai_Akhir as A43,
P1.Bertingkat as A44,
P1.Beton as A45,
P1.Luas_Lantai as A46,
P1.Lokasi as A47,
P1.Dokumen_Tanggal as A48,
P1.Dokumen_Nomor as A49,
P1.Status_Tanah as A50,
P1.Luas_Tanah as A51,
P1.Kode_Tanah as A52,
P1.Konstruksi as A53,
P1.Panjang as A54,
P1.Lebar as A55,
P1.Luas as A56,
P1.Judul as A57,
P1.Spesifikasi as A58,
P1.Pencipta as A59,
P1.Daerah_Asal as A60,
P1.Jenis as A061,
P1.Tipe_Bangunan as A62,
P1.Ukuran as A63,
P1.Keterangan as A64,
ifnull(sum(P2.Debet),0) as A65,
P1.lat_lng as A66 
FROM ta_kib_108 P1
LEFT JOIN ta_kib_post_108 P2 ON P2.Referensi=P1.Referensi AND P2.Kd_UPB=P1.Kd_UPB 
WHERE P1.Referensi LIKE '".$Ref.".%' AND P1.Kd_UPB LIKE '".$UnT."%' 
GROUP BY P1.Referensi, P1.Ref_Group 
ORDER BY P1.Referensi";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$SnsIDT = fGlobal("IDT","tb_lembar_kerja","Referensi:KdUPB:RefGroup",$mRo[1].":".$mRo[8].":".$mRo[2],"=:=:=","","");
	if ($SnsIDT=='')
	{
		$SQ = "INSERT INTO tb_lembar_kerja SET 
		Referensi='".$mRo[1]."',
		RefGroup='".$mRo[2]."',
		KdUPB='".$mRo[8]."',
		
		KdRegister='sesuai',
		KdRegisterMemo='',
		KdBarang='sesuai',
		KdBarangMemo='',
		NmBarang='sesuai',
		NmBarangMemo='',
		SpecNamaBarang='sesuai',
		SpecNamaBarangMemo='',
		JmlBarang='1',
		SatuanBarang='-',
		KeberadaanBarang='ada',
		NilaiPerolehan='".$mRo[65]."',
		MerupakanAtribusi='tidak',
		Alamat='sesuai',
		
		KondisiBarangAsal='".$mRo[41]."',
		KondisiBarang='".$mRo[41]."',
		
		PenggunaanBarang='PD',
		DataTercatatGanda='tidak',
		TitikKoordinat='".$mRo[66]."',
		Lainnya='',
		Keterangan='',
		NoPolisi='sesuai',
		NoRangka='sesuai',
		NoBPKB='sesuai'";
		#echo $SQ."<br>";
		$rs = mysql_query($SQ);
		
		$SQ = "INSERT INTO tb_lembar_kerja_penggunaan SET 
		Referensi='".$mRo[1]."',
		RefGroup='".$mRo[2]."',
		KdUPB='".$mRo[8]."',
		
		PD_NmKuasaPenggunaLainnya='',
		PD_NmPemakai='',
		PD_StatusPemakai='',
		PD_BastPemakaian='tidakada',
		
		PP_dasarpenggunaan='tidakada',
		PP_dasarpenggunaan_ada_nama='',
		PP_dasarpenggunaan_ada_namadokumen='',
		PP_dasarpenggunaan_tidakada_nama='',
		
		PDL_dasarpenggunaan='tidakada',
		PDL_dasarpenggunaan_ada_nama='',
		PDL_dasarpenggunaan_ada_namadokumen='',
		PDL_dasarpenggunaan_tidakada_nama='',
		
		PL_dasarpenggunaan='tidakada',
		PL_dasarpenggunaan_ada_nama='',
		PL_dasarpenggunaan_ada_namadokumen='',
		PL_dasarpenggunaan_tidakada_nama=''";
		#echo $SQ."<br>";
		$rs = mysql_query($SQ);
		
		$SQ = "INSERT INTO tb_lembar_kerja_tercatat_ganda SET 
		Referensi='".$mRo[1]."',
		RefGroup='".$mRo[2]."',
		KdUPB='".$mRo[8]."'";
		#echo $SQ."<br>";
		$rs = mysql_query($SQ);
		
		$SQ = "INSERT INTO tb_lembar_kerja_merupakan_biaya_atribusi SET 
		Referensi='".$mRo[1]."',
		RefGroup='".$mRo[2]."',
		KdUPB='".$mRo[8]."'";
		#echo $SQ."<br>";
		$rs = mysql_query($SQ);
	}
}

?>
<script languange="javascript">
	alert('Transfer data selesai...!!'); 
	showCHOICE('','<?=$IdL?>');
</script>
