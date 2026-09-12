<?php
function ExecuteRC($frUPB,$RfA,$RfU,$TbK,$tID,$UID)
{
	//KOREKSI/DOBEL CATAT
	$DelMST = 'NO';
	$UdTRCI = 'NO';
	$TglMts = fGlobal("Mutasi_Tanggal","ta_usulan_verifikasi_rinci","Ref_Aset:Ref_Usulan",$RfA.":".$RfU,"=:=","","");
	
	$SQ = "SELECT * FROM ta_kib_".$TbK." WHERE Referensi='$RfA' AND Kd_UPB LIKE '$frUPB%'";
	$Rs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($Rs, MYSQL_BOTH))
	{
		$gUpb = $mRo['Kd_UPB'];
		$gRin = $mRo['Kd_Aset'];
		
		if ($TbK=="a")
		{
			//Insert Kib-A mutasi
			$SQG = "INSERT INTO ta_kib_a_mutasi SET 
			Referensi='".$RfA."',
			Ref_Usulan='".$RfU."',
			Referensi_To='',
			Ref_Group='".$mRo['Ref_Group']."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_UPB_To='',
			Kd_Aset='".$mRo['Kd_Aset']."',
			Kd_Aset_To='',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$TglMts."',
			Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
			Jns_Mutasi='HL',
			
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
				PostingKib_Mutasi($frUPB,$RfA,$RfU,$TglMts,$UID);
				$DelMST = 'YA';
				$UdTRCI = 'YA';
			}
		}
		else if ($TbK=="b")
		{
			//Insert Kib-B mutasi
			$SQG = "INSERT INTO ta_kib_b_mutasi SET 
			Referensi='".$RfA."',
			Ref_Usulan='".$RfU."',
			Referensi_To='',
			Ref_Group='".$mRo['Ref_Group']."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_UPB_To='',
			Kd_Aset='".$mRo['Kd_Aset']."',
			Kd_Aset_To='',
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
			Jns_Mutasi='HL',
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
				PostingKib_Mutasi($frUPB,$RfA,$RfU,$TglMts,$UID);
				$DelMST = 'YA';
				$UdTRCI = 'YA';
			}
		}
		else if ($TbK=="c")
		{
			//Insert Kib-C mutasi
			$SQG = "INSERT INTO ta_kib_c_mutasi SET 
			Referensi='".$RfA."',
			Ref_Usulan='".$RfU."',
			Referensi_To='',
			Ref_Group='".$mRo['Ref_Group']."',
			
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_UPB_To='',
			Kd_Aset='".$mRo['Kd_Aset']."',
			Kd_Aset_To='',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$TglMts."',
			Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
			Jns_Mutasi='HL',
			
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
				PostingKib_Mutasi($frUPB,$RfA,$RfU,$TglMts,$UID);
				$DelMST = 'YA';
				$UdTRCI = 'YA';
			}
		}
		else if ($TbK=="d")
		{
			//Insert Kib-D mutasi
			$SQG = "INSERT INTO ta_kib_d_mutasi SET 
			Referensi='".$RfA."',
			Ref_Usulan='".$RfU."',
			Referensi_To='',
			Ref_Group='".$mRo['Ref_Group']."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_UPB_To='',
			Kd_Aset='".$mRo['Kd_Aset']."',
			Kd_Aset_To='',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$TglMts."',
			Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
			Jns_Mutasi='HL',
			
			Konstruksi='".$mRo['Konstruksi']."',
			Panjang='".$mRo['Panjang']."',
			Lebar='".$mRo['Lebar']."',
			Luas='".$mRo['Luas']."',
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
				PostingKib_Mutasi($frUPB,$RfA,$RfU,$TglMts,$UID);
				$DelMST = 'YA';
				$UdTRCI = 'YA';
			}
		}
		else if ($TbK=="e")
		{
			//Insert Kib-E mutasi
			$SQG = "INSERT INTO ta_kib_e_mutasi SET 
			Referensi='".$RfA."',
			Ref_Usulan='".$RfU."',
			Referensi_To='',
			Ref_Group='".$mRo['Ref_Group']."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_UPB_To='',
			Kd_Aset='".$mRo['Kd_Aset']."',
			Kd_Aset_To='',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$TglMts."',
			Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
			Jns_Mutasi='HL',
			
			Judul='".$mRo['Judul']."',
			Spesifikasi='".$mRo['Spesifikasi']."',
			Pencipta='".$mRo['Pencipta']."',
			Daerah_Asal='".$mRo['Daerah_Asal']."',
			Bahan='".$mRo['Bahan']."',
			Jenis='".$mRo['Jenis']."',
			Ukuran='".$mRo['Ukuran']."',
			
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
				PostingKib_Mutasi($frUPB,$RfA,$RfU,$TglMts,$UID);
				$DelMST = 'YA';
				$UdTRCI = 'YA';
			}
		}
	}
	
	if ($DelMST=='YA') {
		DeleteKibMST($frUPB,$TbK,$RfA,$UID);
	}
	
	if ($UdTRCI=='YA') {
		$SQ="UPDATE ta_usulan_verifikasi_rinci SET Eksekusi='Sudah', To_Kd_Aset='$gRin', Pencatat='".$UID.":exe', Recorded=now() WHERE IDT='$tID'";
		$Rs = mysql_query($SQ);
	}
}

function PostingKib_Mutasi($frUPB,$RfA,$RfU,$TglMts,$UID)
{
	//Insert Kib Mutasi Posting
	$SQG = "SELECT * FROM ta_kib_post_108 WHERE Referensi='$RfA' AND Kd_UPB LIKE '$frUPB%' ORDER BY Tanggal";
	$RsG = mysql_query($SQG);
	while ($mRG = mysql_fetch_array($RsG, MYSQL_BOTH))
	{
		$SW="INSERT INTO ta_kib_post_108_mutasi SET 
		Referensi='".$RfA."',
		Ref_Usulan='".$RfU."',
		Ref_Usulan_His='".$mRG['Ref_Usulan']."',
		Referensi_To='',
		Ref_Group='".$mRG['Ref_Group']."',
		Kd_UPB='".$mRG['Kd_UPB']."',
		Kd_UPB_To='',
		Kd_Aset='".$mRG['Kd_Aset']."',
		Kd_Aset_To='',
		No_Register='".$mRG['No_Register']."',
		Crit='".$mRG['Crit']."',
		Tanggal='".$mRG['Tanggal']."',
		Tgl_Mutasi='".$TglMts."',
		Tgl_Mutasi_Masuk='".$mRG['Tgl_Mutasi']."',
		Jns_Mutasi='HL',
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

function DeleteKibMST($frUPB,$TbK,$RfA,$UID)
{
	#delete kib
	$SQG = "DELETE FROM ta_kib_".$TbK." WHERE Referensi='$RfA' AND Kd_UPB LIKE '$frUPB%'";
	$RsG = mysql_query($SQG);
	
	#delete posting
	$SQG = "DELETE FROM ta_kib_post_108 WHERE Referensi='$RfA' AND Kd_UPB LIKE '$frUPB%'";
	$RsG = mysql_query($SQG);
	
	#update penyusutan
	#$SQG = "DELETE FROM ta_kib_post_penyusutan_bulanan WHERE Referensi='$RfA'";
	#$RsG = mysql_query($SQG);
}

function DeleteKibMUT($frUPB,$TbK,$RfA,$RfU,$UID)
{
	#delete kib mutasi
	$SQG = "DELETE FROM ta_kib_".$TbK."_mutasi WHERE Referensi='$RfA' AND Ref_Usulan='$RfU'";
	$RsG = mysql_query($SQG);
	
	#delete posting mutasi
	$SQG = "DELETE FROM ta_kib_post_108_mutasi WHERE Referensi='$RfA' AND Ref_Usulan='$RfU'";
	$RsG = mysql_query($SQG);
}

function UnExecuteRC($frUPB,$RfA,$RfU,$TbK,$tID,$UID)
{
	$DelMUT = 'NO';
	$UdTRCI = 'NO';
	
	#Ambil record pada mutasi sebelumnya jika ada
	$RefU = "";
	$RefH = "";
	$RefM = "";
	$TglM = "0000-00-00";
	$DtE = fGlobal("Ref_Usulan:Ref_History:Referensi:Tgl_Mutasi_Masuk","ta_kib_post_108_mutasi","Referensi_To:Kd_UPB_To",$RfA.":".$frUPB."%","=:LIKE","IDT limit 0,1","");
	if ($DtE!="")
	{
		$DtEB = explode(":",$DtE);
		$RefU = $DtEB[0];
		$RefH = $DtEB[1];
		$RefM = $DtEB[2];
		$TglM = $DtEB[3];
	}
	
	$SQ = "SELECT * FROM ta_kib_".$TbK."_mutasi WHERE Referensi='$RfA' AND Ref_Usulan='$RfU'";
	$Rs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($Rs, MYSQL_BOTH))
	{
		$gUpb = $mRo['Kd_UPB'];
		$gRin = $mRo['Kd_Aset'];
		
		if ($TbK=="a")
		{
			//Insert Kib-A
			$SQG = "INSERT INTO ta_kib_a SET 
			Referensi='".$RfA."',
			Ref_Usulan='".$RefU."',
			Ref_Mutasi='".$RefM."',
			Ref_Group='".$mRo['Ref_Group']."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_Aset='".$mRo['Kd_Aset']."',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$TglM."',
			
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
			Pencatat='".$UID.":unexe'";
			$RsG = mysql_query($SQG);
			if ($RsG){
				unExePostingKib_POST($frUPB,$RfA,$RfU,$RefU,$RefM,$RefH,$TglM,$UID);
				$DelMUT = 'YA';
				$UdTRCI = 'YA';
			}
		}
		else if ($TbK=="b")
		{
			//Insert Kib-B
			$SQG = "INSERT INTO ta_kib_b SET 
			Referensi='".$RfA."',
			Ref_Usulan='".$RefU."',
			Ref_Mutasi='".$RefM."',
			Ref_Group='".$mRo['Ref_Group']."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_Aset='".$mRo['Kd_Aset']."',
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
			Tgl_Mutasi='".$TglM."',
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
			Pencatat='".$UID.":unexe'";
			$RsG = mysql_query($SQG);
			if ($RsG){
				unExePostingKib_POST($frUPB,$RfA,$RfU,$RefU,$RefM,$RefH,$TglM,$UID);
				$DelMUT = 'YA';
				$UdTRCI = 'YA';
			}
		}
		else if ($TbK=="c")
		{
			//Insert Kib-C
			$SQG = "INSERT INTO ta_kib_c SET 
			Referensi='".$RfA."',
			Ref_Usulan='".$RefU."',
			Ref_Mutasi='".$RefM."',
			Ref_Group='".$mRo['Ref_Group']."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_Aset='".$mRo['Kd_Aset']."',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$TglM."',
			
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
			Pencatat='".$UID.":unexe'";
			$RsG = mysql_query($SQG);
			if ($RsG){
				unExePostingKib_POST($frUPB,$RfA,$RfU,$RefU,$RefM,$RefH,$TglM,$UID);
				$DelMUT = 'YA';
				$UdTRCI = 'YA';
			}
		}
		else if ($TbK=="d")
		{
			//Insert Kib-D
			$SQG = "INSERT INTO ta_kib_d SET 
			Referensi='".$RfA."',
			Ref_Usulan='".$RefU."',
			Ref_Mutasi='".$RefM."',
			Ref_Group='".$mRo['Ref_Group']."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_Aset='".$mRo['Kd_Aset']."',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$TglM."',
			
			Konstruksi='".$mRo['Konstruksi']."',
			Panjang='".$mRo['Panjang']."',
			Lebar='".$mRo['Lebar']."',
			Luas='".$mRo['Luas']."',
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
			Pencatat='".$UID.":unexe'";
			$RsG = mysql_query($SQG);
			if ($RsG){
				unExePostingKib_POST($frUPB,$RfA,$RfU,$RefU,$RefM,$RefH,$TglM,$UID);
				$DelMUT = 'YA';
				$UdTRCI = 'YA';
			}
		}
		else if ($TbK=="e")
		{
			//Insert Kib-E
			$SQG = "INSERT INTO ta_kib_e SET 
			Referensi='".$RfA."',
			Ref_Usulan='".$RefU."',
			Ref_Mutasi='".$RefM."',
			Ref_Group='".$mRo['Ref_Group']."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_Aset='".$mRo['Kd_Aset']."',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$TglM."',
			
			Judul='".$mRo['Judul']."',
			Spesifikasi='".$mRo['Spesifikasi']."',
			Pencipta='".$mRo['Pencipta']."',
			Daerah_Asal='".$mRo['Daerah_Asal']."',
			Bahan='".$mRo['Bahan']."',
			Jenis='".$mRo['Jenis']."',
			Ukuran='".$mRo['Ukuran']."',
			
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
			Pencatat='".$UID.":unexe'";
			$RsG = mysql_query($SQG);
			if ($RsG){
				unExePostingKib_POST($frUPB,$RfA,$RfU,$RefU,$RefM,$RefH,$TglM,$UID);
				$DelMUT = 'YA';
				$UdTRCI = 'YA';
			}
		}
	}
	
	if ($DelMUT=='YA') {
		DeleteKibMUT($frUPB,$TbK,$RfA,$RfU,$UID);
	}
	
	if ($UdTRCI=='YA') {
		$SQ="UPDATE ta_usulan_verifikasi_rinci SET Eksekusi='Belum', Pencatat='".$UID.":unExe', Recorded=now() WHERE IDT='$tID'";
		$Rs = mysql_query($SQ);
	}
}

function unExePostingKib_POST($frUPB,$RfA,$RfU,$RefU,$RefM,$RefH,$TglM,$UID)
{
	//Insert Kib Mutasi Posting
	$SQG = "SELECT * FROM ta_kib_post_108_mutasi WHERE Referensi='$RfA' AND Ref_Usulan='$RfU' ORDER BY Tanggal";
	$RsG = mysql_query($SQG);
	while ($mRG = mysql_fetch_array($RsG, MYSQL_BOTH))
	{
		$SW="INSERT INTO ta_kib_post_108 SET 
		Referensi='".$RfA."',
		Ref_Usulan='".$RefU."',
		Ref_Mutasi='".$RefM."',
		Ref_History='".$RefH."',
		Ref_Group='".$mRG['Ref_Group']."',
		Kd_UPB='".$mRG['Kd_UPB']."',
		Kd_Aset='".$mRG['Kd_Aset']."',
		No_Register='".$mRG['No_Register']."',
		Crit='".$mRG['Crit']."',
		Tanggal='".$mRG['Tanggal']."',
		Tgl_Mutasi='".$TglM."',
		Uraian='".mysql_real_escape_string($mRG['Uraian'])."',
		DK='".$mRG['DK']."',
		Debet='".$mRG['Debet']."',
		Kredit='".$mRG['Kredit']."',
		No_Pengadaan='".$mRG['No_Pengadaan']."',
		Ref_Temp='".$mRG['Ref_Temp']."',
		Keterangan='".mysql_real_escape_string($mRG['Keterangan'])."',
		Recorded=now(),
		Pencatat='".$UID.":unexe',
		Tmbh_Ms_Manfaat='".$mRG['Tmbh_Ms_Manfaat']."',
		HasilMerger='".$mRG['HasilMerger']."',
		Mrg_Ref_History='".$mRG['Mrg_Ref_History']."',
		Mrg_Crit_History='".$mRG['Mrg_Crit_History']."',
		Mrg_Tmbh_Ms_Manfaat_History='".$mRG['Mrg_Tmbh_Ms_Manfaat_History']."',
		IndexData='".$mRG['IndexData']."'";
		$rW = mysql_query($SW);
	}
}?>