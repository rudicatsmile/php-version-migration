<?
function ExecuteRC($frUPB,$RfA,$RfU,$TbK,$NewUpB,$tID,$UID)
{
	$frUPB = substr($frUPB,0,11);
	//MUTASI ANTAR SKPD
	$NewUPB = $NewUpB;
	$UpdMST = 'NO';
	$UdTRCI = 'NO';
	$TglMts = fGlobal("Mutasi_Tanggal","ta_usulan_verifikasi_rinci","Ref_Aset:Ref_Usulan",$RfA.":".$RfU,"=:=","","");
	
	$SQ = "SELECT * FROM ta_kib_".$TbK." WHERE Referensi='$RfA' AND Kd_UPB LIKE '".$frUPB."%' ORDER BY Referensi LIMIT 0,1";
	$Rs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($Rs, MYSQL_BOTH))
	{
		$gUpb = $mRo['Kd_UPB'];
		$gRin = $mRo['Kd_Aset'];
		
		$NewRG = mNewRegAset($TbK,$gRin,$NewUPB);
		$NewRF = mNewRefAset($TbK);
		if ($TbK=="a")
		{
			//Insert Kib-A mutasi
			$SQG = "INSERT INTO ta_kib_a_mutasi SET 
			Referensi='".$RfA."',
			Referensi_To='".$NewRF."',
			Ref_Usulan='".$RfU."',
			Ref_Group='".$mRo['Ref_Group']."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_UPB_To='".$NewUPB."',
			Kd_Aset='".$mRo['Kd_Aset']."',
			Kd_Aset_To='".$mRo['Kd_Aset']."',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$TglMts."',
			Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
			Jns_Mutasi='MS',
			
			Luas_M2='".$mRo['Luas_M2']."',
			Alamat='".mysql_real_escape_string($mRo['Alamat'])."',
			Hak_Tanah='".$mRo['Hak_Tanah']."',
			Sertifikat='".$mRo['Sertifikat']."',
			Sertifikat_Tanggal='".$mRo['Sertifikat_Tanggal']."',
			Sertifikat_Nomor='".$mRo['Sertifikat_Nomor']."',
			Penggunaan='".mysql_real_escape_string($mRo['Penggunaan'])."',
			
			Asal_Usul='".$mRo['Asal_Usul']."',
			Harga='".$mRo['Harga']."',
			Keterangan='".mysql_real_escape_string($mRo['Keterangan'])."',
			No_SP2D='".$mRo['No_SP2D']."',
			Post='".$mRo['Post']."',
			Status='".$mRo['Status']."',
			Recorded=now(),
			Pencatat='".$UID.":exe'";
			$RsG = mysql_query($SQG);
			if ($RsG){
				ExePostingKib_Mutasi($frUPB,$RfA,$RfU,$NewRF,$NewUPB,$TglMts,$UID);
				$UpdMST = 'YA';
				$UdTRCI = 'YA';
			}
		}
		else if ($TbK=="b")
		{
			//Insert Kib-B mutasi
			$SQG = "INSERT INTO ta_kib_b_mutasi SET 
			Referensi='".$RfA."',
			Referensi_To='".$NewRF."',
			Ref_Usulan='".$RfU."',
			Ref_Group='".$mRo['Ref_Group']."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_UPB_To='".$NewUPB."',
			Kd_Aset='".$mRo['Kd_Aset']."',
			Kd_Aset_To='".$mRo['Kd_Aset']."',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			Kd_Ruang='".$mRo['Kd_Ruang']."',
			Merk='".$mRo['Merk']."',
			Type='".$mRo['Type']."',
			Ukuran_CC='".$mRo['Ukuran_CC']."',
			Bahan='".$mRo['Bahan']."',
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$TglMts."',
			Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
			Jns_Mutasi='MS',
			Nomor_Pabrik='".mysql_real_escape_string($mRo['Nomor_Pabrik'])."',
			Nomor_Rangka='".mysql_real_escape_string($mRo['Nomor_Rangka'])."',
			Nomor_Mesin='".mysql_real_escape_string($mRo['Nomor_Mesin'])."',
			Nomor_Polisi='".mysql_real_escape_string($mRo['Nomor_Polisi'])."',
			Nomor_BPKB='".mysql_real_escape_string($mRo['Nomor_BPKB'])."',
			Asal_Usul='".$mRo['Asal_Usul']."',
			Kondisi='".$mRo['Kondisi']."',
			Harga='".$mRo['Harga']."',
			Masa_Manfaat='".$mRo['Masa_Manfaat']."',
			Nilai_Akhir='".$mRo['Nilai_Akhir']."',
			Keterangan='".mysql_real_escape_string($mRo['Keterangan'])."',
			No_SP2D='".$mRo['No_SP2D']."',
			Post='".$mRo['Post']."',
			Status='".$mRo['Status']."',
			Recorded=now(),
			Pencatat='".$UID.":exe'";
			
			$RsG = mysql_query($SQG);
			if ($RsG){
				ExePostingKib_Mutasi($frUPB,$RfA,$RfU,$NewRF,$NewUPB,$TglMts,$UID);
				$UpdMST = 'YA';
				$UdTRCI = 'YA';
			}
		}
		else if ($TbK=="c")
		{
			//Insert Kib-C mutasi
			$SQG = "INSERT INTO ta_kib_c_mutasi SET 
			Referensi='".$RfA."',
			Referensi_To='".$NewRF."',
			Ref_Usulan='".$RfU."',
			Ref_Group='".$mRo['Ref_Group']."',
			
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_UPB_To='".$NewUPB."',
			Kd_Aset='".$mRo['Kd_Aset']."',
			Kd_Aset_To='".$mRo['Kd_Aset']."',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$TglMts."',
			Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
			Jns_Mutasi='MS',
			
			Bertingkat='".$mRo['Bertingkat']."',
			Beton='".$mRo['Beton']."',
			Luas_Lantai='".$mRo['Luas_Lantai']."',
			Lokasi='".$mRo['Lokasi']."',
			Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',
			Dokumen_Nomor='".$mRo['Dokumen_Nomor']."',
			Status_Tanah='".$mRo['Status_Tanah']."',
			Kode_Tanah='".$mRo['Kode_Tanah']."',
			
			Asal_Usul='".$mRo['Asal_Usul']."',
			Kondisi='".$mRo['Kondisi']."',
			Harga='".$mRo['Harga']."',
			Masa_Manfaat='".$mRo['Masa_Manfaat']."',
			Nilai_Akhir='".$mRo['Nilai_Akhir']."',
			Keterangan='".mysql_real_escape_string($mRo['Keterangan'])."',
			No_SP2D='".$mRo['No_SP2D']."',
			Post='".$mRo['Post']."',
			Status='".$mRo['Status']."',
			Recorded=now(),
			Pencatat='".$UID.":exe'";
			$RsG = mysql_query($SQG);
			if ($RsG){
				ExePostingKib_Mutasi($frUPB,$RfA,$RfU,$NewRF,$NewUPB,$TglMts,$UID);
				$UpdMST = 'YA';
				$UdTRCI = 'YA';
			}
		}
		else if ($TbK=="d")
		{
			//Insert Kib-D mutasi
			$SQG = "INSERT INTO ta_kib_d_mutasi SET 
			Referensi='".$RfA."',
			Referensi_To='".$NewRF."',
			Ref_Usulan='".$RfU."',
			Ref_Group='".$mRo['Ref_Group']."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_UPB_To='".$NewUPB."',
			Kd_Aset='".$mRo['Kd_Aset']."',
			Kd_Aset_To='".$mRo['Kd_Aset']."',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$TglMts."',
			Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
			Jns_Mutasi='MS',
			
			Konstruksi='".$mRo['Konstruksi']."',
			Panjang='".$mRo['Panjang']."',
			Lebar='".$mRo['Lebar']."',
			Luas='".$mRo['Luas']."',
			Lokasi='".mysql_real_escape_string($mRo['Lokasi'])."',
			Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',
			Dokumen_Nomor='".$mRo['Dokumen_Nomor']."',
			Status_Tanah='".$mRo['Status_Tanah']."',
			Kode_Tanah='".$mRo['Kode_Tanah']."',
			
			Asal_Usul='".$mRo['Asal_Usul']."',
			Kondisi='".$mRo['Kondisi']."',
			Harga='".$mRo['Harga']."',
			Masa_Manfaat='".$mRo['Masa_Manfaat']."',
			Nilai_Akhir='".$mRo['Nilai_Akhir']."',
			Keterangan='".mysql_real_escape_string($mRo['Keterangan'])."',
			No_SP2D='".$mRo['No_SP2D']."',
			Post='".$mRo['Post']."',
			Status='".$mRo['Status']."',
			Recorded=now(),
			Pencatat='".$UID.":exe'";
			$RsG = mysql_query($SQG);
			if ($RsG){
				ExePostingKib_Mutasi($frUPB,$RfA,$RfU,$NewRF,$NewUPB,$TglMts,$UID);
				$UpdMST = 'YA';
				$UdTRCI = 'YA';
			}
		}
		else if ($TbK=="e")
		{
			//Insert Kib-E mutasi
			$SQG = "INSERT INTO ta_kib_e_mutasi SET 
			Referensi='".$RfA."',
			Referensi_To='".$NewRF."',
			Ref_Usulan='".$RfU."',
			Ref_Group='".$mRo['Ref_Group']."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_UPB_To='".$NewUPB."',
			Kd_Aset='".$mRo['Kd_Aset']."',
			Kd_Aset_To='".$mRo['Kd_Aset']."',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$TglMts."',
			Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
			Jns_Mutasi='MS',
			
			Judul='".mysql_real_escape_string($mRo['Judul'])."',
			Spesifikasi='".mysql_real_escape_string($mRo['Spesifikasi'])."',
			Pencipta='".mysql_real_escape_string($mRo['Pencipta'])."',
			Daerah_Asal='".mysql_real_escape_string($mRo['Daerah_Asal'])."',
			Bahan='".mysql_real_escape_string($mRo['Bahan'])."',
			Jenis='".mysql_real_escape_string($mRo['Jenis'])."',
			Ukuran='".mysql_real_escape_string($mRo['Ukuran'])."',
			
			Asal_Usul='".$mRo['Asal_Usul']."',
			Kondisi='".$mRo['Kondisi']."',
			Harga='".$mRo['Harga']."',
			Masa_Manfaat='".$mRo['Masa_Manfaat']."',
			Nilai_Akhir='".$mRo['Nilai_Akhir']."',
			Keterangan='".mysql_real_escape_string($mRo['Keterangan'])."',
			No_SP2D='".$mRo['No_SP2D']."',
			Post='".$mRo['Post']."',
			Status='".$mRo['Status']."',
			Recorded=now(),
			Pencatat='".$UID.":exe'";
			$RsG = mysql_query($SQG);
			if ($RsG){
				ExePostingKib_Mutasi($frUPB,$RfA,$RfU,$NewRF,$NewUPB,$TglMts,$UID);
				$UpdMST = 'YA';
				$UdTRCI = 'YA';
			}
		}
		#######
		else if ($TbK=="f")
		{
			//Insert Kib-E mutasi
			$SQG = "INSERT INTO ta_kib_f_mutasi SET 
			Referensi='".$RfA."',
			Referensi_To='".$NewRF."',
			Ref_Usulan='".$RfU."',
			Ref_Group='".$mRo['Ref_Group']."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_UPB_To='".$NewUPB."',
			Kd_Aset='".$mRo['Kd_Aset']."',
			Kd_Aset_To='".$mRo['Kd_Aset']."',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mulai='".$mRo['Tgl_Mulai']."',
			Tgl_Mutasi='".$TglMts."',
			Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
			Jns_Mutasi='MS',
			
			Bertingkat='".mysql_real_escape_string($mRo['Bertingkat'])."',
			Beton='".mysql_real_escape_string($mRo['Beton'])."',
			Panjang='".mysql_real_escape_string($mRo['Panjang'])."',
			Lebar='".mysql_real_escape_string($mRo['Lebar'])."',
			Luas='".mysql_real_escape_string($mRo['Luas'])."',
			Lokasi='".mysql_real_escape_string($mRo['Lokasi'])."',
			Dokumen_Tanggal='".mysql_real_escape_string($mRo['Dokumen_Tanggal'])."',
			Dokumen_Nomor='".mysql_real_escape_string($mRo['Dokumen_Nomor'])."',
			
			Status_Tanah='".mysql_real_escape_string($mRo['Status_Tanah'])."',
			Kode_Tanah='".mysql_real_escape_string($mRo['Kode_Tanah'])."',
			Tipe_Bangunan='".mysql_real_escape_string($mRo['Tipe_Bangunan'])."',
			
			Asal_Usul='".$mRo['Asal_Usul']."',
			Harga='".$mRo['Harga']."',
			Nilai_Akhir='".$mRo['Nilai_Akhir']."',
			Keterangan='".mysql_real_escape_string($mRo['Keterangan'])."',
			KdpToAset='".$mRo['KdpToAset']."',
			Post='".$mRo['Post']."',
			Status='".$mRo['Status']."',
			Recorded=now(),
			Pencatat='".$UID.":exe'";
			$RsG = mysql_query($SQG);
			
			if ($RsG){
				ExePostingKib_Mutasi($frUPB,$RfA,$RfU,$NewRF,$NewUPB,$TglMts,$UID);
				$UpdMST = 'YA';
				$UdTRCI = 'YA';
			}
		}
		#######
		else if ($TbK=="g")
		{
			//Insert Kib-G mutasi
			$SQG = "INSERT INTO ta_kib_g_mutasi SET 
			Referensi='".$RfA."',
			Referensi_To='".$NewRF."',
			Ref_Usulan='".$RfU."',
			Ref_History='".$RfA."',
			Ref_Usulan_His='".$mRo['Ref_Usulan']."',
			Ref_Group='".$mRo['Ref_Group']."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_UPB_To='".$NewUPB."',
			Kd_Aset='".$mRo['Kd_Aset']."',
			Kd_Aset_To='".$mRo['Kd_Aset']."',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$TglMts."',
			Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
			Jns_Mutasi='MS',
			
			Lokasi='".mysql_real_escape_string($mRo['Lokasi'])."',
			Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',
			Dokumen_Nomor='".mysql_real_escape_string($mRo['Dokumen_Nomor'])."',
			Luas_M2='".$mRo['Luas_M2']."',
			Alamat='".mysql_real_escape_string($mRo['Alamat'])."',
			Hak_Tanah='".$mRo['Hak_Tanah']."',
			Sertifikat='".$mRo['Sertifikat']."',
			Sertifikat_Tanggal='".$mRo['Sertifikat_Tanggal']."',
			Sertifikat_Nomor='".($mRo['Sertifikat_Nomor'])."',
			Penggunaan='".$mRo['Penggunaan']."',
			Kd_Ruang='".$mRo['Kd_Ruang']."',
			Merk='".mysql_real_escape_string($mRo['Merk'])."',
			Type='".mysql_real_escape_string($mRo['Type'])."',
			Ukuran_CC='".mysql_real_escape_string($mRo['Ukuran_CC'])."',
			Nomor_Pabrik='".mysql_real_escape_string($mRo['Nomor_Pabrik'])."',
			Nomor_Rangka='".mysql_real_escape_string($mRo['Nomor_Rangka'])."',
			Nomor_Mesin='".mysql_real_escape_string($mRo['Nomor_Mesin'])."',
			Nomor_Polisi='".mysql_real_escape_string($mRo['Nomor_Polisi'])."',
			Nomor_BPKB='".mysql_real_escape_string($mRo['Nomor_BPKB'])."',
			Bertingkat='".$mRo['Bertingkat']."',
			Beton='".$mRo['Beton']."',
			Luas_Lantai='".$mRo['Luas_Lantai']."',
			Status_Tanah='".$mRo['Status_Tanah']."',
			Luas_Tanah='".$mRo['Luas_Tanah']."',
			Kode_Tanah='".$mRo['Kode_Tanah']."',
			Konstruksi='".$mRo['Konstruksi']."',
			Panjang='".$mRo['Panjang']."',
			Lebar='".$mRo['Lebar']."',
			Luas='".$mRo['Luas']."',
			Tahun='".$mRo['Tahun']."',
			
			Judul='".mysql_real_escape_string($mRo['Judul'])."',
			Spesifikasi='".mysql_real_escape_string($mRo['Spesifikasi'])."',
			Pencipta='".mysql_real_escape_string($mRo['Pencipta'])."',
			Daerah_Asal='".mysql_real_escape_string($mRo['Daerah_Asal'])."',
			Bahan='".mysql_real_escape_string($mRo['Bahan'])."',
			Jenis='".$mRo['Jenis']."',
			Ukuran='".mysql_real_escape_string($mRo['Ukuran'])."',
			
			Asal_Usul='".$mRo['Asal_Usul']."',
			Kondisi='".$mRo['Kondisi']."',
			Harga='".$mRo['Harga']."',
			Masa_Manfaat='".$mRo['Masa_Manfaat']."',
			Nilai_Akhir='".$mRo['Nilai_Akhir']."',
			Keterangan='".mysql_real_escape_string($mRo['Keterangan'])."',
			No_SP2D='".$mRo['No_SP2D']."',
			Post='".$mRo['Post']."',
			Status='".$mRo['Status']."',
			Recorded=now(),
			Pencatat='".$UID.":exe'";
			$RsG = mysql_query($SQG);
			
			if ($RsG){
				ExePostingKib_Mutasi($frUPB,$RfA,$RfU,$NewRF,$NewUPB,$TglMts,$UID);
				$UpdMST = 'YA';
				$UdTRCI = 'YA';
			}
		}
	}
	
	if ($UpdMST=='YA') {
		ExeUpdateKibMST($frUPB,$TbK,$RfA,$RfU,$NewRF,$NewUPB,$NewRG,$TglMts,$UID);
	}
	
	if ($UdTRCI=='YA') {
		$SQ="UPDATE ta_usulan_verifikasi_rinci SET Eksekusi='Sudah', To_Kd_Aset='$gRin', Pencatat='".$UID.":exe', Recorded=now() WHERE IDT='$tID'";
		$Rs = mysql_query($SQ);
	}
}

function ExePostingKib_Mutasi($frUPB,$RfA,$RfU,$NewRF,$NewUPB,$TglMts,$UID)
{
	//Insert Kib Mutasi Posting
	$SQG = "SELECT * FROM ta_kib_post WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%' ORDER BY IndexData";
	$RsG = mysql_query($SQG);
	while ($mRG = mysql_fetch_array($RsG, MYSQL_BOTH))
	{
		$SW="INSERT INTO ta_kib_post_mutasi SET 
		Referensi='".$RfA."',
		Referensi_To='".$NewRF."',
		Ref_Group='".$mRG['Ref_Group']."',
		Ref_Usulan='".$RfU."',
		Ref_Usulan_His='".$mRG['Ref_Usulan']."',
		Ref_History='".$RfA."',
		Kd_UPB='".$mRG['Kd_UPB']."',
		Kd_UPB_To='".$NewUPB."',
		Kd_Aset='".$mRG['Kd_Aset']."',
		Kd_Aset_To='".$mRG['Kd_Aset']."',
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
		No_Pengadaan='".$mRG['No_Pengadaan']."',
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
	}
}

function ExeUpdateKibMST($frUPB,$TbK,$RfA,$RfU,$NewRF,$NewUPB,$NewRG,$TglMts,$UID)
{
	#update kib
	$SQG = "UPDATE ta_kib_".$TbK." SET 
	Referensi='".$NewRF."',
	Ref_Group='',
	Ref_Usulan='".$RfU."',
	Ref_Mutasi='".$RfA."',
	Tgl_Mutasi='".$TglMts."',
	Kd_UPB='".$NewUPB."',
	No_Register='".$NewRG."',
	Pencatat='".$UID.":exe',
	Recorded=now() 
	WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%'";
	$RsG = mysql_query($SQG);
	
	#update posting
	$SQG = "UPDATE ta_kib_post SET 
	Referensi='".$NewRF."',
	Ref_Group='',
	Ref_Mutasi='".$RfA."',
	Ref_History='".$RfA."',
	Ref_Usulan='".$RfU."',
	Tgl_Mutasi='".$TglMts."',
	Kd_UPB='".$NewUPB."',
	No_Register='".$NewRG."',
	Pencatat='".$UID.":exe',
	Recorded=now() 
	WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%'";
	$RsG = mysql_query($SQG);
	
	#update penyusutan
	$SQG = "UPDATE ta_kib_post_penyusutan_bulanan SET 
	Referensi='".$NewRG."',
	Kd_UPB='".$NewUPB."',
	No_Register='".$NewRG."' 
	WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%'";
	$RsG = mysql_query($SQG);
	
	if ($TbK=='a' || $TbK=='c' || $TbK=='d'){
		#antisipasi hasil merger
		ExecuteHistoryMerger($frUPB,$NewUPB,$RfA,$NewRF,$RfU,$TglMts,$TbK,$UID,"");
	}
}

function ExecuteHistoryMerger($frUPB,$NewUPB,$RfA,$NewRF,$RfU,$TglMts,$TbK,$UID,$fS)
{
	#kondisi sudah di skpd baru
	$SQE = "SELECT Mrg_Ref_History FROM ta_kib_post WHERE Referensi='".$NewRF."' AND Kd_UPB LIKE '".$NewUPB."%' AND Mrg_Ref_History<>'' ORDER BY IndexData";
	if ($fS!=''){echo $SQE."<br>";}
	$RsE = mysql_query($SQE);
	while ($mRE = mysql_fetch_array($RsE, MYSQL_BOTH))
	{
		$RefM = $mRE[0];
		$SQM = "UPDATE ta_kib_".$TbK."_merger_his SET 
		Kd_UPB='".$NewUPB."', 
		Ref_Usulan='".$RfU."',
		Ref_Mutasi='".$RfA."',
		Tgl_Mutasi='".$TglMts."' 
		WHERE Referensi='".$RefM."' AND Kd_UPB LIKE '".substr($frUPB,0,11)."%'";
		if ($fS!=''){echo $SQM."<br>";}
		$RsM = mysql_query($SQM);
	}
}

function UnExecuteRC($frUPB,$RfA,$RfU,$TbK,$tID,$UID)
{
	$DtA = fGlobal("Kd_UPB:No_Register:Ref_Group:Referensi_To:Kd_UPB_To:Tgl_Mutasi_Masuk","ta_kib_".$TbK."_mutasi","Referensi:Ref_Usulan:Kd_UPB",$RfA.":".$RfU.":".$frUPB."%","=:=:LIKE","","");
	if ($DtA)
	{
		$DtAB = explode(":",$DtA);
		$OldUpB = $DtAB[0];
		$OldReG = $DtAB[1];
		$OldGrP = $DtAB[2];
		$ReffTo = $DtAB[3];
		$OldTgM = $DtAB[5];
		$UpbTo  = substr($DtAB[4],0,11);
		$OldRef = $RfA;
		
		#Ambil record pada mutasi sebelumnya jika ada
		$RefU = "";
		$RefH = "";
		$RefM = "";
		$TglM = "0000-00-00";
		$DtE = fGlobal("Ref_Usulan:Ref_History:Referensi:Tgl_Mutasi_Masuk","ta_kib_post_mutasi","Referensi_To:Kd_UPB_To",$RfA.":".$frUPB."%","=:LIKE","IDT limit 0,1","");
		if ($DtE)
		{
			$DtEB = explode(":",$DtE);
			$RefU = $DtEB[0];
			$RefH = $DtEB[1];
			$RefM = $DtEB[2];
			$TglM = $DtEB[3];
		}
		
		#update kib
		$SQG = "UPDATE ta_kib_".$TbK." SET 
		Referensi='".$OldRef."',
		Ref_Group='".$OldGrP."',
		Ref_Mutasi='".$RefM."',
		Tgl_Mutasi='".$OldTgM."',
		Ref_Usulan='".$RefU."',
		Kd_UPB='".$OldUpB."',
		No_Register='".$OldReG."',
		Pencatat='".$UID.":unExe',
		Recorded=now() 
		WHERE Referensi='$ReffTo' AND Ref_Usulan='".$RfU."' AND Kd_UPB LIKE '".$UpbTo."%'";
		$RsG = mysql_query($SQG);
		if ($RsG){
			$SQG = "DELETE FROM ta_kib_".$TbK."_mutasi WHERE Referensi='$RfA' AND Ref_Usulan='$RfU' AND Kd_UPB LIKE '".$frUPB."%'";
			$RsG = mysql_query($SQG);
		}
		
		#update posting
		$SQG = "UPDATE ta_kib_post SET 
		Referensi='".$OldRef."',
		Ref_Group='".$OldGrP."',
		Kd_UPB='".$OldUpB."',
		Ref_Mutasi='".$RefM."',
		Ref_History='".$RefH."',
		Ref_Usulan='".$RefU."',
		Tgl_Mutasi='".$TglM."',
		No_Register='".$OldReG."',
		Pencatat='".$UID.":unExe',
		Recorded=now() 
		WHERE Referensi='".$ReffTo."' AND Ref_Usulan='".$RfU."' AND Kd_UPB LIKE '".$UpbTo."%'";
		$RsB = mysql_query($SQG);
		if ($RsB){
			$SQG = "DELETE FROM ta_kib_post_mutasi WHERE Referensi='".$RfA."' AND Ref_Usulan='".$RfU."' AND Kd_UPB LIKE '".$frUPB."%'";
			$RsG = mysql_query($SQG);
			
			$SQG="UPDATE ta_usulan_verifikasi_rinci SET Eksekusi='Belum', Pencatat='".$UID.":unExe', Recorded=now() WHERE IDT='".$tID."'";
			$RsG= mysql_query($SQG);
		}
		
		#update penyusutan
		$SQG = "UPDATE ta_kib_post_penyusutan_bulanan SET 
		Referensi='".$OldRef."', Kd_UPB='$OldUpB', No_Register='$OldReG' WHERE Referensi='".$ReffTo." AND Kd_UPB LIKE '".$UpbTo."%''";
		$RsG = mysql_query($SQG);
		
		if ($TbK=='a' || $TbK=='c' || $TbK=='d'){
			#antisipasi hasil merger
			UnExecuteHistoryMerger($OldRef,$OldUpB,$UpbTo,$TbK,$UID,"");
		}
	}
}

function UnExecuteHistoryMerger($OldRef,$OldUpB,$UpbTo,$TbK,$UID,$fS)
{
	#kondisi sudah di skpd semula
	$SQE = "SELECT Mrg_Ref_History FROM ta_kib_post WHERE Referensi='".$OldRef."' AND Kd_UPB LIKE '".substr($OldUpB,0,11)."%' AND Mrg_Ref_History<>'' ORDER BY IndexData";
	if ($fS!=''){echo $SQE."<br>";}
	$RsE = mysql_query($SQE);
	while ($mRE = mysql_fetch_array($RsE, MYSQL_BOTH))
	{
		$RefM = $mRE[0];
		$SQM = "UPDATE ta_kib_".$TbK."_merger_his SET 
		Kd_UPB='".$OldUpB."', 
		Ref_Usulan='',
		Ref_Mutasi='',
		Tgl_Mutasi='0000-00-00' 
		WHERE Referensi='".$RefM."' AND Kd_UPB LIKE '".substr($UpbTo,0,11)."%'";
		if ($fS!=''){echo $SQM."<br>";}
		$RsM = mysql_query($SQM);
	}
}


function mNewRefAset($TbK)
{
	$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_".$TbK,"IDT","%","LIKE","","");
	$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_".$TbK."_mutasi","IDT","%","LIKE","","");
	
	$NewC = 0;
	if ($TbK=='a' || $TbK=='c' || $TbK=='d'){
		$NewC = fGlobal("IfNull(max(Referensi),0)","ta_kib_".$TbK."_merger_his","IDT","%","LIKE","","");
	}
	
	$LefR = substr($NewK,0,3);
	$NewK = (int)substr($NewK,-11,11);
	$NewB = (int)substr($NewB,-11,11);
	$NewC = (int)substr($NewC,-11,11);
	
	if ($NewB>$NewK){$NewK=$NewB;}
	if ($NewC>$NewK){$NewK=$NewC;}
	
	$NewK = $NewK + 1;
	$NewK = $LefR.".".fMakeReferensi($NewK,11);
	return $NewK;
}

function mNewRegAset($TbK,$gRin,$NewUPB)
{
	$LastReG = fGlobal("IfNull(max(No_Register),0)","ta_kib_".$TbK,"Kd_Aset:Kd_Upb",$gRin.":".$NewUPB,"=:=","","");
	$LastReG = ((int)$LastReG) + 1;
	$LastReG = fMakeRegister($LastReG,7);
	return $LastReG;
}

?>