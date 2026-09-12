<?php
	$SQG = "INSERT INTO ta_kib_g_mutasi SET 
	Referensi='".$RfA."',
	Referensi_To='".$NewReF."',
	Ref_Group='".$mRo['Ref_Group']."',
	Ref_Usulan='".$RfU."',
	Ref_History='".$RfA."',
	Kd_UPB='".$mRo['Kd_UPB']."',
	Kd_UPB_To='".$mRo['Kd_UPB']."',
	Kd_Aset='".$mRo['Kd_Aset']."',
	Kd_Aset_To='".$ToAsT."',
	No_Register='".$mRo['No_Register']."',
	No_Pengadaan='".$mRo['No_Pengadaan']."',
	Ref_Temp='".$mRo['Ref_Temp']."',
	Nm_Aset='".$mRo['Nm_Aset']."',
	Kd_Pemilik='".$mRo['Kd_Pemilik']."',
	Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
	Tgl_Mutasi='".$TglMts."',
	Jns_Mutasi='MK',
	
	Lokasi='".$mRo['Lokasi']."',
	Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',
	Dokumen_Nomor='".mysql_real_escape_string($mRo['Dokumen_Nomor'])."',
	Luas_M2='".$mRo['Luas_M2']."',
	
	Konstruksi='".$mRo['Konstruksi']."',
	Panjang='".$mRo['Panjang']."',
	Lebar='".$mRo['Lebar']."',
	Luas='".$mRo['Luas']."',
	
	Asal_Usul='".$mRo['Asal_Usul']."',
	Kondisi='".$mRo['Kondisi']."',
	Masa_Manfaat='".$mRo['Masa_Manfaat']."',
	Harga='".$mRo['Harga']."',
	Nilai_Akhir='".$mRo['Nilai_Akhir']."',
	Keterangan='".mysql_real_escape_string($mRo['Keterangan'])."',
	No_SP2D='".$mRo['No_SP2D']."',
	Post='".$mRo['Post']."',
	Status='".$mRo['Status']."',
	Recorded=now(),
	Pencatat='".$UID.":exe'";
	$RsG = mysql_query($SQG);
	
	if ($RsG){
		$LanjuT="YA";
	}
?>