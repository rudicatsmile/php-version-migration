<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$FnD = str_replace('**',' ',$gFnD);
#echo $FnD."<br>";
#echo $fDBA."<br>";
#echo $fDBB."<br>";
#echo $iD."<br>";

CallConnection($fDBA,$ConSB);
$nSQ = "SELECT * FROM ta_kib_108 WHERE IDT='".$iD."'";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{

	$mREF = $mRo['Referensi'];
	$mUPB = $mRo['Kd_UPB'];
	
	CallConnection($fDBB,$ConSB);
	
	$SQ="INSERT INTO ta_kib_108 SET 
	Referensi='".$mRo['Referensi']."',
	Ref_Group='".$mRo['Ref_Group']."',
	Ref_Mutasi='".$mRo['Ref_Mutasi']."',
	Ref_Usulan='".$mRo['Ref_Usulan']."',
	Ref_History='".$mRo['Ref_History']."',
	Ref_Usulan_His='".$mRo['Ref_Usulan_His']."',
	Kd_UPB='".$mRo['Kd_UPB']."',
	Kd_Aset='".$mRo['Kd_Aset']."',
	Kd_Aset_108='".$mRo['Kd_Aset_108']."',
	Kd_Ruang='".$mRo['Kd_Ruang']."',
	No_Register='".$mRo['No_Register']."',
	No_Pengadaan='".$mRo['No_Pengadaan']."',
	Ref_Temp='".$mRo['Ref_Temp']."',
	Nm_Aset='".$mRo['Nm_Aset']."',
	Kd_Pemilik='".$mRo['Kd_Pemilik']."',
	Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
	Tgl_Mutasi='".$mRo['Tgl_Mutasi']."',
	Tgl_Mulai='".$mRo['Tgl_Mulai']."',
	Tahun='".$mRo['Tahun']."',
	Luas_M2='".$mRo['Luas_M2']."',
	Alamat='".$mRo['Alamat']."',
	Hak_Tanah='".$mRo['Hak_Tanah']."',
	Sertifikat='".$mRo['Sertifikat']."',
	Sertifikat_Tanggal='".$mRo['Sertifikat_Tanggal']."',
	Sertifikat_Nomor='".$mRo['Sertifikat_Nomor']."',
	Penggunaan='".$mRo['Penggunaan']."',
	Asal_Usul='".$mRo['Asal_Usul']."',
	Harga='".$mRo['Harga']."',
	No_SP2D='".$mRo['No_SP2D']."',
	Merk='".$mRo['Merk']."',
	Type='".$mRo['Type']."',
	Ukuran_CC='".$mRo['Ukuran_CC']."',
	Bahan='".$mRo['Bahan']."',
	Nomor_Pabrik='".$mRo['Nomor_Pabrik']."',
	Nomor_Rangka='".$mRo['Nomor_Rangka']."',
	Nomor_Mesin='".$mRo['Nomor_Mesin']."',
	Nomor_Polisi='".$mRo['Nomor_Polisi']."',
	Nomor_BPKB='".$mRo['Nomor_BPKB']."',
	Pemegang='".$mRo['Pemegang']."',
	Pemegang_Lama='".$mRo['Pemegang_Lama']."',
	Kondisi='".$mRo['Kondisi']."',
	Masa_Manfaat='".$mRo['Masa_Manfaat']."',
	Nilai_Akhir='".$mRo['Nilai_Akhir']."',
	Bertingkat='".$mRo['Bertingkat']."',
	Beton='".$mRo['Beton']."',
	Luas_Lantai='".$mRo['Luas_Lantai']."',
	Lokasi='".$mRo['Lokasi']."',
	Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',
	Dokumen_Nomor='".$mRo['Dokumen_Nomor']."',
	Status_Tanah='".$mRo['Status_Tanah']."',
	Kd_Tanah1='".$mRo['Kd_Tanah1']."',
	Kd_Tanah2='".$mRo['Kd_Tanah2']."',
	Kd_Tanah3='".$mRo['Kd_Tanah3']."',
	Kd_Tanah4='".$mRo['Kd_Tanah4']."',
	Kd_Tanah5='".$mRo['Kd_Tanah5']."',
	Luas_Tanah='".$mRo['Luas_Tanah']."',
	Kode_Tanah_Old='".$mRo['Kode_Tanah_Old']."',
	Kode_Tanah='".$mRo['Kode_Tanah']."',
	Konstruksi='".$mRo['Konstruksi']."',
	Panjang='".$mRo['Panjang']."',
	Lebar='".$mRo['Lebar']."',
	Luas='".$mRo['Luas']."',
	Judul='".$mRo['Judul']."',
	Spesifikasi='".$mRo['Spesifikasi']."',
	Pencipta='".$mRo['Pencipta']."',
	Daerah_Asal='".$mRo['Daerah_Asal']."',
	Jenis='".$mRo['Jenis']."',
	Tipe_Bangunan='".$mRo['Tipe_Bangunan']."',
	KdpToAset='".$mRo['KdpToAset']."',
	Ukuran='".$mRo['Ukuran']."',
	Keterangan='".$mRo['Keterangan']."',
	Post='".$mRo['Post']."',
	file_content='".$mRo['file_content']."',
	file_name='".$mRo['file_name']."',
	file_type='".$mRo['file_type']."',
	file_size='".$mRo['file_size']."',
	extracom='".$mRo['extracom']."',
	MasukKeUsulan='".$mRo['MasukKeUsulan']."',
	Status='".$mRo['Status']."',
	ImportFrom='".$mRo['ImportFrom']."',
	Recorded='".$mRo['Recorded']."',
	Pencatat='".$mRo['Pencatat']."',
	IdTabelMaster='".$mRo['IdTabelMaster']."',
	kode_bar='".$mRo['kode_bar']."',
	lat='".$mRo['lat']."',
	lng='".$mRo['lng']."',
	lat_lng='".$mRo['lat_lng']."'";
	$rsA = mysql_query($SQ);
	
	CallConnection($fDBA,$ConSB);
	$eSQ = "SELECT * FROM ta_kib_post_108 WHERE Referensi='".$mREF."' AND Kd_UPB='".$mUPB."'";
	$eRs = mysql_query($eSQ);
	while ($eRo = mysql_fetch_array($eRs, MYSQL_BOTH))
	{
		CallConnection($fDBB,$ConSB);
		$rSQ="INSERT INTO ta_kib_post_108 SET 
		Referensi='".$eRo['Referensi']."',
		Ref_Group='".$eRo['Ref_Group']."',
		Ref_Usulan='".$eRo['Ref_Usulan']."',
		Ref_Usulan_His='".$eRo['Ref_Usulan_His']."',
		Ref_History='".$eRo['Ref_History']."',
		Ref_Mutasi='".$eRo['Ref_Mutasi']."',
		Kd_UPB='".$eRo['Kd_UPB']."',
		Kd_Aset='".$eRo['Kd_Aset']."',
		Kd_Aset_108='".$eRo['Kd_Aset_108']."',
		No_Register='".$eRo['No_Register']."',
		Crit='".$eRo['Crit']."',
		Tanggal='".$eRo['Tanggal']."',
		Tanggal_BAST='".$eRo['Tanggal_BAST']."',
		Tgl_Mutasi='".$eRo['Tgl_Mutasi']."',
		Uraian='".$eRo['Uraian']."',
		DK='".$eRo['DK']."',
		Debet='".$eRo['Debet']."',
		Kredit='".$eRo['Kredit']."',
		No_Pengadaan='".$eRo['No_Pengadaan']."',
		Ref_Temp='".$eRo['Ref_Temp']."',
		Keterangan='".$eRo['Keterangan']."',
		Pencatat='".$eRo['Pencatat']."',
		Recorded='".$eRo['Recorded']."',
		Tmbh_Ms_Manfaat='".$eRo['Tmbh_Ms_Manfaat']."',
		HasilMerger='".$eRo['HasilMerger']."',
		Mrg_Ref_History='".$eRo['Mrg_Ref_History']."',
		Mrg_Crit_History='".$eRo['Mrg_Crit_History']."',
		Mrg_Tmbh_Ms_Manfaat_History='".$eRo['Mrg_Tmbh_Ms_Manfaat_History']."',
		IndexData='".$eRo['IndexData']."',
		extracom='".$eRo['extracom']."',
		KdpToAset='".$eRo['KdpToAset']."',
		ReValue='".$eRo['ReValue']."',
		Referensi_17='".$eRo['Referensi_17']."',
		ImportFrom='".$eRo['ImportFrom']."',
		IdTabelHarga='".$eRo['IdTabelHarga']."',
		IdAsalUsul='".$eRo['IdAsalUsul']."',
		IdKontrak='".$eRo['IdKontrak']."',
		IdBaSertaTerima='".$eRo['IdBaSertaTerima']."',
		No_SP2D='".$eRo['No_SP2D']."'";
		$es = mysql_query($rSQ);
	}
}
?>
<script languange="javascript">
	RefreshDATA('<?=$IdL?>');
	
</script>