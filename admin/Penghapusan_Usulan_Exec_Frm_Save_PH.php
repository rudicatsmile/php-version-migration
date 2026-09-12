<?php
function ExecuteRC($NoRG,$frUPB,$RfA,$RfU,$tID,$UID)
{
	$TglMts = fGlobal("Mutasi_Tanggal","ta_usulan_verifikasi_rinci_108","Ref_Aset:Ref_Usulan:No_Register",$RfA.":".$RfU.":".$NoRG,"=:=:=","","");
	$NewUPB = fGlobal("To_UPB","ta_usulan_verifikasi_rinci_108","Ref_Aset:Ref_Usulan:no_register",$RfA.":".$RfU.":".$NoRG,"=:=:=","","");
	
	$eRuH   = fGlobal("ref_usulan","ta_kib_108","referensi:kd_upb:no_register",$RfA.":".$frUPB."%:".$NoRG,"=:LIKE:=","","");
	$gRin   = fGlobal("kd_aset_108","ta_kib_108","referensi:kd_upb:no_register",$RfA.":".$frUPB."%:".$NoRG,"=:LIKE:=","","");
	
	$CekR = fGlobal("IDT","ta_kib_108_mutasi","Ref_Usulan:Referensi:No_Register",$RfU.":".$RfA.":".$NoRG,"=:=:=","","");
	if ($CekR=='') 
	{
		InsertKib_Mutasi_108($NoRG,$frUPB,$RfA,$RfU,$TglMts,$NewUPB,$UID);
		InsertPos_Mutasi_108($NoRG,$frUPB,$RfA,$RfU,$TglMts,$NewUPB,$UID);
		DeleteKibPos_108($NoRG,$frUPB,$RfA);
		UpdateUsulanVerRci($tID,'Sudah',$UID);
	}
}

function UnExecuteRC($NoRG,$frUPB,$RfA,$RfU,$tID,$UID)
{
	$DtE = fGlobal("Ref_Usulan:Ref_Usulan_His:Ref_History:Referensi:Kd_UPB:Kd_UPB_To:No_Register:Tgl_Mutasi_Masuk","ta_kib_108_mutasi","Referensi:Ref_Usulan:Kd_UPB:No_Register",$RfA.":".$RfU.":".$frUPB."%:".$NoRG,"=:=:LIKE:=","IDT limit 0,1","");
	if ($DtE!="")
	{
		$DeB = explode(":",$DtE);
		$RfU = $DeB[0];	#Ref_Usulan
		$RuH = $DeB[1];	#Ref_Usulan_His
		$RfH = $DeB[2];	#Ref_History
		$ReF = $DeB[3];	#Referensi
		$KdU = $DeB[4];	#Kd_UPB_To
		$KdT = $DeB[5];	#Kd_UPB_To
		$ReG = $DeB[6];	#No_Register
		$TgM = $DeB[7];	#Tgl Mutasi_Masuk
	}
	
	RoollBackKib_Mutasi_108($NoRG,$frUPB,$RfU,$ReF,$UID);
	RoollBackPos_Mutasi_108($NoRG,$frUPB,$RfU,$ReF,$UID);
	DeleteKibPos_108_Mutasi($NoRG,$frUPB,$RfU,$ReF);
	UpdateUsulanVerRci($tID,'Belum',$UID);	
}

function DeleteKibPos_108_Mutasi($NoRG,$frUPB,$RfU,$ReF)
{
	$SQU = "DELETE FROM ta_kib_108_mutasi WHERE Referensi='".$ReF."' AND Ref_Usulan='".$RfU."' AND Kd_UPB LIKE '".$frUPB."%' AND No_Register='".$NoRG."'";
	$RsU = mysql_query($SQU);

	$SQU = "DELETE FROM ta_kib_post_108_mutasi WHERE Referensi='".$ReF."' AND Ref_Usulan='".$RfU."' AND Kd_UPB LIKE '".$frUPB."%' AND No_Register='".$NoRG."'";
	$RsU = mysql_query($SQU);

}

function InsertPos_Mutasi_108($NoRG,$frUPB,$RfA,$RfU,$TglMts,$NewUPB,$UID)
{
	$SQG = "SELECT * FROM ta_kib_post_108 WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%' AND No_Register='".$NoRG."' ORDER BY Tanggal";
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
		Kd_UPB_To='',
		Kd_Aset='".$mRG['Kd_Aset']."',
		Kd_Aset_To='-',
		Kd_Aset_108='".$mRG['Kd_Aset_108']."',
		Kd_Aset_108_To='',
		No_Register='".$mRG['No_Register']."',
		Crit='".$mRG['Crit']."',
		Tanggal='".$mRG['Tanggal']."',
		Tgl_Mutasi='".$TglMts."',
		Tgl_Mutasi_Masuk='".$mRG['Tgl_Mutasi']."',
		Jns_Mutasi='PH',
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
		IndexData='".$mRG['IndexData']."',
		extracom='".$mRG['extracom']."'";
		$rW = mysql_query($SW);
	}
}

function InsertKib_Mutasi_108($NoRG,$frUPB,$RfA,$RfU,$TglMts,$NewUPB,$UID)
{
	$SQ = "SELECT * FROM ta_kib_108 WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%' AND No_Register='".$NoRG."'";
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
		Kd_UPB_To='',
		Kd_Aset='".$mRo['Kd_Aset']."',
		Kd_Aset_To='',
		
		Kd_Aset_108='".$mRo['Kd_Aset_108']."',
		Kd_Aset_108_To='',
		No_Register='".$mRo['No_Register']."',
		KdpToAset='".$mRo['KdpToAset']."',
		Ref_Usulan_His='".$mRo['Ref_Usulan']."',
		Ref_History='".$mRo['Ref_History']."',
		
		No_Pengadaan='".$mRo['No_Pengadaan']."',
		Ref_Temp='".$mRo['Ref_Temp']."',
		Nm_Aset='".$mRo['Nm_Aset']."',
		Kd_Pemilik='".$mRo['Kd_Pemilik']."',
		Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
		Tgl_Mutasi='".$TglMts."',
		Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
		Jns_Mutasi='PH',
		Luas_M2='".$mRo['Luas_M2']."',
		Alamat='".mysql_real_escape_string($mRo['Alamat'])."',
		Hak_Tanah='".$mRo['Hak_Tanah']."',
		Sertifikat='".$mRo['Sertifikat']."',
		Sertifikat_Tanggal='".mysql_real_escape_string($mRo['Sertifikat_Tanggal'])."',
		Sertifikat_Nomor='".mysql_real_escape_string($mRo['Sertifikat_Nomor'])."',
		Penggunaan='".$mRo['Penggunaan']."',
		Asal_Usul='".$mRo['Asal_Usul']."',
		Kondisi='".$mRo['Kondisi']."',
		Harga='".$mRo['Harga']."',
		Keterangan='".mysql_real_escape_string($mRo['Keterangan'])."',
		No_SP2D='".$mRo['No_SP2D']."',
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
		
		Nomor_Polisi_Lama='".mysql_real_escape_string($mRo['Nomor_Polisi_Lama'])."',
		Pemegang='".mysql_real_escape_string($mRo['Pemegang'])."',
		Pemegang_Lama='".mysql_real_escape_string($mRo['Pemegang_Lama'])."',
		
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
		Panjang='".$mRo['Panjang']."',
		Lebar='".$mRo['Lebar']."',
		Luas='".$mRo['Luas']."',
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
		IdTabelMaster='".$mRo['IdTabelMaster']."',
		kode_bar='".mysql_real_escape_string($mRo['kode_bar'])."',
		lat='".mysql_real_escape_string($mRo['lat'])."',
		lng='".mysql_real_escape_string($mRo['lng'])."',
		lat_lng='".mysql_real_escape_string($mRo['lat_lng'])."',
		MasukKeUsulan='".$mRo['MasukKeUsulan']."',
		ImportFrom='".$mRo['ImportFrom']."',
		Recorded=now(),
		Pencatat='".$UID.":exe'";
		$RsG = mysql_query($SQG);
	}
}

function DeleteKibPos_108($NoRG,$frUPB,$RfA)
{
	$SQU = "DELETE FROM ta_kib_108 WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%' AND No_Register='".$NoRG."'";
	$RsU = mysql_query($SQU);
	
	$SQU = "DELETE FROM ta_kib_post_108 WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%' AND No_Register='".$NoRG."'";
	$RsU = mysql_query($SQU);
}

function UpdateUsulanVerRci($tID,$Sudah,$UID)
{
	$SQU = "UPDATE ta_usulan_verifikasi_rinci_108 SET Eksekusi='".$Sudah."', Pencatat='".$UID.":exe', Recorded=now() WHERE IDT='".$tID."'";
	$RsU = mysql_query($SQU);
}

function RoollBackKib_Mutasi_108($NoRG,$frUPB,$RfU,$ReF,$UID)
{
	$SQG = "SELECT * FROM ta_kib_108_mutasi WHERE Ref_Usulan='".$RfU."' AND Referensi='".$ReF."' AND Kd_UPB LIKE '".$frUPB."%' AND No_Register='".$NoRG."' ORDER BY Tgl_Perolehan";
	$RsG = mysql_query($SQG);
	while ($mRo = mysql_fetch_array($RsG, MYSQL_BOTH))
	{
		$SQ = "INSERT INTO ta_kib_108 SET 
		Referensi='".$mRo['Referensi']."',
		Ref_Group='".$mRo['Ref_Group']."',
		Kd_UPB='".$mRo['Kd_UPB']."',
		Kd_Aset='".$mRo['Kd_Aset']."',
		Kd_Aset_108='".$mRo['Kd_Aset_108']."',
		No_Register='".$mRo['No_Register']."',
		Ref_Usulan='".$mRo['Ref_Usulan_His']."',
		Ref_History='".$mRo['Ref_History']."',
		Ref_Mutasi='".$mRo['Ref_History']."',
		
		No_Pengadaan='".$mRo['No_Pengadaan']."',
		Ref_Temp='".$mRo['Ref_Temp']."',
		Nm_Aset='".$mRo['Nm_Aset']."',
		Kd_Pemilik='".$mRo['Kd_Pemilik']."',
		Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
		Tgl_Mutasi='".$mRo['Tgl_Mutasi_Masuk']."',
		Luas_M2='".$mRo['Luas_M2']."',
		Alamat='".mysql_real_escape_string($mRo['Alamat'])."',
		Hak_Tanah='".$mRo['Hak_Tanah']."',
		Sertifikat='".$mRo['Sertifikat']."',
		Sertifikat_Tanggal='".mysql_real_escape_string($mRo['Sertifikat_Tanggal'])."',
		Sertifikat_Nomor='".mysql_real_escape_string($mRo['Sertifikat_Nomor'])."',
		Penggunaan='".$mRo['Penggunaan']."',
		Asal_Usul='".$mRo['Asal_Usul']."',
		Kondisi='".$mRo['Kondisi']."',
		Harga='".$mRo['Harga']."',
		Keterangan='".mysql_real_escape_string($mRo['Keterangan'])."',
		No_SP2D='".$mRo['No_SP2D']."',
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
		Panjang='".$mRo['Panjang']."',
		Lebar='".$mRo['Lebar']."',
		Luas='".$mRo['Luas']."',
		Judul='".mysql_real_escape_string($mRo['Judul'])."',
		Spesifikasi='".mysql_real_escape_string($mRo['Spesifikasi'])."',
		Pencipta='".mysql_real_escape_string($mRo['Pencipta'])."',
		Daerah_Asal='".mysql_real_escape_string($mRo['Daerah_Asal'])."',
		Jenis='".$mRo['Jenis']."',
		Ukuran='".mysql_real_escape_string($mRo['Ukuran'])."',
		Tahun='".$mRo['Tahun']."',
		Tgl_Mulai='".$mRo['Tgl_Mulai']."',
		Tipe_Bangunan='".$mRo['Tipe_Bangunan']."',
		KdpToAset='".$mRo['KdpToAset']."',
		extracom='".$mRo['extracom']."',
		file_content='".mysql_real_escape_string($mRo['file_content'])."',
		file_name='".mysql_real_escape_string($mRo['file_name'])."',
		file_type='".mysql_real_escape_string($mRo['file_type'])."',
		file_size='".mysql_real_escape_string($mRo['file_size'])."',
		IdTabelMaster='".$mRo['IdTabelMaster']."',
		kode_bar='".mysql_real_escape_string($mRo['kode_bar'])."',
		lat='".mysql_real_escape_string($mRo['lat'])."',
		lng='".mysql_real_escape_string($mRo['lng'])."',
		lat_lng='".mysql_real_escape_string($mRo['lat_lng'])."',
		MasukKeUsulan='".$mRo['MasukKeUsulan']."',
		ImportFrom='".$mRo['ImportFrom']."',
		Recorded=now(),
		Pencatat='".$UID.":UnExe'";
		$rs = mysql_query($SQ);
	}
}

function RoollBackPos_Mutasi_108($NoRG,$frUPB,$RfU,$ReF,$UID)
{
	$SQG = "SELECT * FROM ta_kib_post_108_mutasi WHERE Ref_Usulan='".$RfU."' AND Referensi='".$ReF."' AND Kd_UPB LIKE '".$frUPB."%' AND No_Register='".$NoRG."' ORDER BY Tanggal";
	$RsG = mysql_query($SQG);
	while ($mRG = mysql_fetch_array($RsG, MYSQL_BOTH))
	{
		$SW="INSERT INTO ta_kib_post_108 SET 
		Referensi='".$mRG['Referensi']."',
		Ref_Group='".$mRG['Ref_Group']."',
		Ref_History='".$mRG['Ref_History']."',
		Ref_Mutasi='".$mRG['Ref_History']."',
		Ref_Usulan='".$mRG['Ref_Usulan_His']."',
		Kd_UPB='".$mRG['Kd_UPB']."',
		Kd_Aset='".$mRG['Kd_Aset']."',
		Kd_Aset_108='".$mRG['Kd_Aset_108']."',
		No_Register='".$mRG['No_Register']."',
		Crit='".$mRG['Crit']."',
		Tanggal='".$mRG['Tanggal']."',
		Tgl_Mutasi='".$mRG['Tgl_Mutasi']."',
		Uraian='".mysql_real_escape_string($mRG['Uraian'])."',
		DK='".$mRG['DK']."',
		Debet='".$mRG['Debet']."',
		Kredit='".$mRG['Kredit']."',
		No_Pengadaan='".$mRG['No_Pengadaan']."',
		Ref_Temp='".$mRG['Ref_Temp']."',
		Keterangan='".mysql_real_escape_string($mRG['Keterangan'])."',
		Recorded=now(),
		Pencatat='".$UID.":UnExe',
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

?>