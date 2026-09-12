<?
function ExecuteMS_All($frUPB,$RfA,$RfU,$TbK,$tID,$UID)
{
	$CekR = fGlobal("IDT","ta_kib_108_mutasi","Ref_Usulan:Referensi",$RfU.":".$RfA,"=:=","","");
	if ($CekR=='') 
	{
		$TglMts = fGlobal("Mutasi_Tanggal","ta_usulan_verifikasi_rinci_108","Ref_Aset:Ref_Usulan",$RfA.":".$RfU,"=:=","","");
		$NewUPB = fGlobal("To_UPB","ta_usulan_verifikasi_rinci_108","Ref_Aset:Ref_Usulan",$RfA.":".$RfU,"=:=","","");
		
		$eRuH   = fGlobal("ref_usulan","ta_kib_108","referensi:kd_upb",$RfA.":".$frUPB."%","=:LIKE","","");
		$gRin   = fGlobal("kd_aset_108","ta_kib_108","referensi:kd_upb",$RfA.":".$frUPB."%","=:LIKE","","");
		
		InsertKib_Mutasi_108($frUPB,$RfA,$RfU,$NewRefKIB,$TglMts,$NewUPB,$UID);
		InsertPos_Mutasi_108($frUPB,$RfA,$RfU,$NewRefKIB,$TglMts,$NewUPB,$UID);
		
		UpdateKib_108($frUPB,$RfA,$RfU,$TglMts,$NewUPB,$eRuH,$UID);
		UpdatePos_108($frUPB,$RfA,$RfU,$TglMts,$NewUPB,$eRuH,$UID);
		
		UpdateUsulanVerRci($tID,'Sudah',$UID);
	}
}

function InsertPos_Mutasi_108($frUPB,$RfA,$RfU,$NewRefKIB,$TglMts,$NewUPB,$UID)
{
	$SQG = "SELECT * FROM ta_kib_post_108 WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%' ORDER BY Tanggal";
	$RsG = mysql_query($SQG);
	while ($mRG = mysql_fetch_array($RsG, MYSQL_BOTH))
	{
		$SW="INSERT INTO ta_kib_post_108_mutasi SET 
		Referensi='".$RfA."',
		Referensi_To='".$RfA."',
		Ref_Group='".$mRG['Ref_Group']."',
		Ref_Usulan='".$RfU."',
		Ref_History='".$RfA."',
		Ref_Usulan_His='".$mRG['Ref_Usulan']."',
		Kd_UPB='".$mRG['Kd_UPB']."',
		Kd_UPB_To='".$NewUPB."',
		Kd_Aset='".mysql_real_escape_string($mRG['Kd_Aset'])."',
		Kd_Aset_To='-',
		Kd_Aset_108='".$mRG['Kd_Aset_108']."',
		Kd_Aset_108_To='".$mRG['Kd_Aset_108']."',
		No_Register='".$mRG['No_Register']."',
		Crit='".$mRG['Crit']."',
		Tanggal='".$mRG['Tanggal']."',
		Tgl_Mutasi='".$TglMts."',
		Tgl_Mutasi_Masuk='".$mRG['Tgl_Mutasi']."',
		Jns_Mutasi='MS',
		Uraian='".mysql_real_escape_string($mRG['Uraian'])."',
		DK='".$mRG['DK']."',
		Debet='".$mRG['Debet']."',
		Kredit='".$mRG['Kredit']."',
		No_Pengadaan='".mysql_real_escape_string($mRG['No_Pengadaan'])."',
		Ref_Temp='".$mRG['Ref_Temp']."',
		Keterangan='".mysql_real_escape_string($mRG['Keterangan'])."',
		Recorded=now(),
		Pencatat='".$UID.":exe',
		Tmbh_Ms_Manfaat='".$mRG['Tmbh_Ms_Manfaat']."',
		HasilMerger='".$mRG['HasilMerger']."',
		Mrg_Ref_History='".$mRG['Mrg_Ref_History']."',
		Mrg_Crit_History='".$mRG['Mrg_Crit_History']."',
		Mrg_Tmbh_Ms_Manfaat_History='".$mRG['Mrg_Tmbh_Ms_Manfaat_History']."',
		IndexData='".$mRG['IndexData']."'";
		$rW = mysql_query($SW);
		#echo $SW."<br>";
	}
}

function InsertKib_Mutasi_108($frUPB,$RfA,$RfU,$NewRefKIB,$TglMts,$NewUPB,$UID)
{
	$SQ = "SELECT * FROM ta_kib_108 WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%'";
	$Rs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($Rs, MYSQL_BOTH))
	{
		$gUpb = $mRo['Kd_UPB'];
	
		$SQG = "INSERT INTO ta_kib_108_mutasi SET 
		Referensi='".$RfA."',
		Ref_Usulan='".$RfU."',
		Referensi_To='".$RfA."',
		Ref_Group='".$mRo['Ref_Group']."',
		Kd_UPB='".$mRo['Kd_UPB']."',
		Kd_UPB_To='".$NewUPB."',
		Kd_Aset='".$mRo['Kd_Aset']."',
		Kd_Aset_To='',
		
		Kd_Aset_108='".$mRo['Kd_Aset_108']."',
		Kd_Aset_108_To='".$mRo['Kd_Aset_108']."',
		
		No_Register='".$mRo['No_Register']."',
		
		KdpToAset='".$mRo['KdpToAset']."',
		Ref_Usulan_His='".$mRo['Ref_Usulan_His']."',
		Ref_History='".$mRo['Ref_History']."',
		
		No_Pengadaan='".$mRo['No_Pengadaan']."',
		Ref_Temp='".$mRo['Ref_Temp']."',
		Nm_Aset='".mysql_real_escape_string($mRo['Nm_Aset'])."',
		Kd_Pemilik='".$mRo['Kd_Pemilik']."',
		Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
		Tgl_Mutasi='".$TglMts."',
		Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
		Jns_Mutasi='".$mRo['Jns_Mutasi']."',
		Luas_M2='".$mRo['Luas_M2']."',
		Alamat='".mysql_real_escape_string($mRo['Alamat'])."',
		Hak_Tanah='".$mRo['Hak_Tanah']."',
		Sertifikat='".$mRo['Sertifikat']."',
		Sertifikat_Tanggal='".mysql_real_escape_string($mRo['Sertifikat_Tanggal'])."',
		Sertifikat_Nomor='".mysql_real_escape_string($mRo['Sertifikat_Nomor'])."',
		Penggunaan='".mysql_real_escape_string($mRo['Penggunaan'])."',
		Asal_Usul='".mysql_real_escape_string($mRo['Asal_Usul'])."',
		Kondisi='".$mRo['Kondisi']."',
		Harga='".$mRo['Harga']."',
		Keterangan='".mysql_real_escape_string($mRo['Keterangan'])."',
		No_SP2D='".mysql_real_escape_string($mRo['No_SP2D'])."',
		Post='".$mRo['Post']."',
		Status='".$mRo['Status']."',
		Kd_Ruang='".$mRo['Kd_Ruang']."',
		Merk='".mysql_real_escape_string($mRo['Merk'])."',
		Type='".mysql_real_escape_string($mRo['Type'])."',
		Ukuran_CC='".mysql_real_escape_string($mRo['Ukuran_CC'])."',
		Bahan='".mysql_real_escape_string($mRo['Bahan'])."',
		Nomor_Pabrik='".mysql_real_escape_string($mRo['Nomor_Pabrik'])."',
		Nomor_Rangka='".mysql_real_escape_string($mRo['Nomor_Rangka'])."',
		Nomor_Mesin='".mysql_real_escape_string($mRo['Nomor_Mesin'])."',
		Nomor_Polisi='".mysql_real_escape_string($mRo['Nomor_Polisi'])."',
		Nomor_BPKB='".mysql_real_escape_string($mRo['Nomor_BPKB'])."',
		Masa_Manfaat='".$mRo['Masa_Manfaat']."',
		Nilai_Akhir='".$mRo['Nilai_Akhir']."',
		Bertingkat='".$mRo['Bertingkat']."',
		Beton='".$mRo['Beton']."',
		Luas_Lantai='".$mRo['Luas_Lantai']."',
		Lokasi='".mysql_real_escape_string($mRo['Lokasi'])."',
		Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',
		Dokumen_Nomor='".mysql_real_escape_string($mRo['Dokumen_Nomor'])."',
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
		Panjang='".mysql_real_escape_string($mRo['Panjang'])."',
		Lebar='".mysql_real_escape_string($mRo['Lebar'])."',
		Luas='".mysql_real_escape_string($mRo['Luas'])."',
		Judul='".mysql_real_escape_string($mRo['Judul'])."',
		Spesifikasi='".mysql_real_escape_string($mRo['Spesifikasi'])."',
		Pencipta='".mysql_real_escape_string($mRo['Pencipta'])."',
		Daerah_Asal='".mysql_real_escape_string($mRo['Daerah_Asal'])."',
		Jenis='".$mRo['Jenis']."',
		Ukuran='".mysql_real_escape_string($mRo['Ukuran'])."',
		Tahun='".$mRo['Tahun']."',
		Tgl_Mulai='".$mRo['Tgl_Mulai']."',
		Tipe_Bangunan='".$mRo['Tipe_Bangunan']."',
		extracom='".$mRo['extracom']."',
		file_content='".mysql_real_escape_string($mRo['file_content'])."',
		file_name='".mysql_real_escape_string($mRo['file_name'])."',
		file_type='".mysql_real_escape_string($mRo['file_type'])."',
		file_size='".mysql_real_escape_string($mRo['file_size'])."',
		Recorded=now(),
		Pencatat='".$UID.":exe'";
		$RsG = mysql_query($SQG);
	}
}

function UpdateKib_108($frUPB,$RfA,$RfU,$TglMts,$NewUPB,$eRuH,$UID)
{
	$SQU = "UPDATE ta_kib_108 SET 
	Kd_UPB='".$NewUPB."', 
	Ref_Usulan='".$RfU."',
	Ref_Usulan_His='".$eRuH."',
	Ref_History='".$RfA."',
	Tgl_Mutasi='".$TglMts."',
	Recorded=now(),
	Pencatat='".$UID.":exe' 
	WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%'";
	$RsU = mysql_query($SQU);
	#echo $SQU."<br>";
}

function UpdatePos_108($frUPB,$RfA,$RfU,$TglMts,$NewUPB,$eRuH,$UID)
{
	$SQU = "UPDATE ta_kib_post_108 SET 
	Kd_UPB='".$NewUPB."', 
	Ref_Usulan='".$RfU."',
	Ref_Usulan_His='".$RuH."',
	Ref_History='".$RfA."',
	Tgl_Mutasi='".$TglMts."',
	Recorded=now(),
	Pencatat='".$UID.":exe' 
	WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%'";
	$RsU = mysql_query($SQU);
  	
	$SQU = "UPDATE ta_kib_post_penyusutan_108 SET 
	Kd_UPB='".$NewUPB."', 
	Ref_History='".$RfA."' 
	WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%'";
	$RsU = mysql_query($SQU);
}

function UpdateUsulanVerRci($tID,$Sudah,$UID)
{
	$SQU = "UPDATE ta_usulan_verifikasi_rinci_108 SET Eksekusi='".$Sudah."', Pencatat='".$UID.":exe', Recorded=now() WHERE IDT='".$tID."'";
	$RsU = mysql_query($SQU);
}

?>