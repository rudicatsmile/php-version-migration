<?
function ExecuteRC($frUPB,$RfA,$RfU,$TbK,$TglMts,$ToKiB,$ToAsT,$tID,$UID)
{
	//MUTASI ANTAR KIB
	$DelMST = 'NO';
	$UdTRCI = 'NO';
	
	#$TbK --> tabel asal mutasi
	$SQ = "SELECT * FROM ta_kib_".$TbK." WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%'";
	$Rs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($Rs, MYSQL_BOTH))
	{
		$gUpb = $mRo['Kd_UPB'];
		$NewReF  = mNewRefAset($ToKiB);
		$NewReG  = mNewRegAset($ToAsT,$gUpb,$ToKiB);
		
		$CekR = fGlobal("IDT","ta_kib_g_mutasi","Referensi:Ref_Usulan",$RfA.":".$RfU,"=:=","","");
		if ($CekR=="")
		{
			if ($TbK=="g"){require "Invent_Usulan_Exec_Frm_Save_MK_g.php";}
			$LanjuT="YA";
		}
		
		if ($LanjuT=="YA")
		{
			$TbT = fNmHuruf((int)$ToKiB);
			$CekB = fGlobal("IDT","ta_kib_".$TbT,"Referensi:Ref_Usulan",$NewReF.":".$RfU,"=:=","","");
			if ($CekB=="") 
			{
				if ($TbT=='a')
				{
					$SQG = "INSERT INTO ta_kib_a SET 
					Referensi='".$NewReF."',
					Ref_Group='',
					Ref_Mutasi='".$RfA."',
					Ref_Usulan='".$RfU."',
					Kd_Aset='".$ToAsT."',
					No_Register='".$NewReG."',
					
					Kd_UPB='".$mRo['Kd_UPB']."',
					No_Pengadaan='".$mRo['No_Pengadaan']."',
					Ref_Temp='".$mRo['Ref_Temp']."',
					Nm_Aset='".$mRo['Nm_Aset']."',
					Kd_Pemilik='".$mRo['Kd_Pemilik']."',
					
					Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
					Tgl_Mutasi='".$TglMts."',
					
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
				}
				if ($TbT=='b')
				{
					$SQG = "INSERT INTO ta_kib_b SET 
					Referensi='".$NewReF."',
					Ref_Group='',
					Ref_Mutasi='".$RfA."',
					Ref_Usulan='".$RfU."',
					Kd_Aset='".$ToAsT."',
					No_Register='".$NewReG."',
					
					Kd_UPB='".$mRo['Kd_UPB']."',
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
				}
				if ($TbT=='c')
				{
					$SQG = "INSERT INTO ta_kib_c SET 
					Referensi='".$NewReF."',
					Ref_Group='',
					Ref_Mutasi='".$RfA."',
					Ref_Usulan='".$RfU."',
					Kd_Aset='".$ToAsT."',
					No_Register='".$NewReG."',
					
					Kd_UPB='".$mRo['Kd_UPB']."',
					No_Pengadaan='".$mRo['No_Pengadaan']."',
					
					Ref_Temp='".$mRo['Ref_Temp']."',
					Nm_Aset='".$mRo['Nm_Aset']."',
					Kd_Pemilik='".$mRo['Kd_Pemilik']."',
					Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
					Tgl_Mutasi='".$TglMts."',
					
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
				}
				if ($TbT=='d')
				{
					$SQG = "INSERT INTO ta_kib_d SET 
					Referensi='".$NewReF."',
					Ref_Group='',
					Ref_Mutasi='".$RfA."',
					Ref_Usulan='".$RfU."',
					Kd_Aset='".$ToAsT."',
					No_Register='".$NewReG."',
					
					Kd_UPB='".$mRo['Kd_UPB']."',
					No_Pengadaan='".$mRo['No_Pengadaan']."',
					Ref_Temp='".$mRo['Ref_Temp']."',
					Nm_Aset='".$mRo['Nm_Aset']."',
					Kd_Pemilik='".$mRo['Kd_Pemilik']."',
					
					Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
					Tgl_Mutasi='".$TglMts."',
					
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
				}
				if ($TbT=='e')
				{
					$SQG = "INSERT INTO ta_kib_e SET 
					Referensi='".$NewReF."',
					Ref_Group='',
					Ref_Mutasi='".$RfA."',
					Ref_Usulan='".$RfU."',
					Kd_Aset='".$ToAsT."',
					No_Register='".$NewReG."',
					
					Kd_UPB='".$mRo['Kd_UPB']."',
					No_Pengadaan='".$mRo['No_Pengadaan']."',
					Ref_Temp='".$mRo['Ref_Temp']."',
					Nm_Aset='".$mRo['Nm_Aset']."',
					Kd_Pemilik='".$mRo['Kd_Pemilik']."',
					
					Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
					Tgl_Mutasi='".$TglMts."',
					
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
				}
				$RsG = mysql_query($SQG);
				
				if ($RsG){
					PostingKib_Mutasi($frUPB,$RfA,$RfU,$NewReF,$ToAsT,$TglMts,$UID);
					UpdatePostingKib_POST($frUPB,$RfA,$RfU,$NewReF,$NewReG,$ToAsT,$TglMts,$UID);
					$DelMST='YA';
					$UdTRCI='YA';
				}
			}
		}
	}
	
	if ($DelMST=='YA') {
		$SQ="DELETE FROM ta_kib_".$TbK." WHERE Referensi='$RfA' AND Kd_UPB LIKE '$frUPB%'";
		$Rs = mysql_query($SQ);
		#Posting tidak perlu didelete krna sdh di update
	}
	
	if ($UdTRCI=='YA') {
		$SQ="UPDATE ta_usulan_verifikasi_rinci SET Eksekusi='Sudah', To_Kd_Aset='$gRin', Pencatat='".$UID.":exe', Recorded=now() WHERE IDT='$tID'";
		$Rs = mysql_query($SQ);
	}
}

function UpdatePostingKib_POST($frUPB,$RfA,$RfU,$NewReF,$NewReG,$ToAsT,$TglMts,$UID)
{
	$SQG = "UPDATE ta_kib_post_108 SET 
	Referensi='".$NewReF."',
	Kd_Aset='".$ToAsT."',
	No_Register='".$NewReG."',
	Tgl_Mutasi='".$TglMts."',
	Ref_Usulan='".$RfU."',
	Ref_Mutasi='".$RfA."',
	Ref_History='".$RfA."',
	Recorded=now(),
	Pencatat='".$UID.":exe' 
	WHERE Referensi='$RfA' AND Kd_UPB LIKE '".$frUPB."%'";
	$RsG = mysql_query($SQG);
}

function PostingKib_Mutasi($frUPB,$RfA,$RfU,$NewReF,$ToAsT,$TglMts,$UID)
{
	//Insert Kib Mutasi Posting
	$SQG = "SELECT * FROM ta_kib_post_108 WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%' ORDER BY Tanggal";
	$RsG = mysql_query($SQG);
	while ($mRG = mysql_fetch_array($RsG, MYSQL_BOTH))
	{
		$SW="INSERT INTO ta_kib_post_108_mutasi SET 
		Referensi='".$RfA."',
		Ref_Usulan='".$RfU."',
		Ref_Usulan_His='".$mRG['Ref_Usulan']."',
		Ref_History='".$RfA."',
		Referensi_To='".$NewReF."',
		Ref_Group='".$mRG['Ref_Group']."',
		Kd_UPB='".$mRG['Kd_UPB']."',
		Kd_UPB_To='".$mRG['Kd_UPB']."',
		Kd_Aset='".$mRG['Kd_Aset']."',
		Kd_Aset_To='".$ToAsT."',
		No_Register='".$mRG['No_Register']."',
		Crit='".$mRG['Crit']."',
		Tanggal='".$mRG['Tanggal']."',
		Tgl_Mutasi='".$TglMts."',
		Tgl_Mutasi_Masuk='".$mRG['Tgl_Mutasi']."',
		Jns_Mutasi='MK',
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

function UnExecuteRC($frUPB,$RfA,$RfU,$TbK,$ToKiB,$tID,$UID)
{
	//MUTASI ANTAR KIB
	$DelMST = 'NO';
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
	
	$TbT = fNmHuruf((int)$ToKiB);
	
	$SQ = "SELECT * FROM ta_kib_g_mutasi WHERE Referensi='".$RfA."' AND Ref_Usulan='".$RfU."' AND Kd_UPB LIKE '".$frUPB."%'";
	$Rs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($Rs, MYSQL_BOTH))
	{
		$RfTo = $mRo['Referensi_To'];
		
		$SQG = "INSERT INTO ta_kib_g SET 
		Referensi='".$mRo['Referensi']."',
		Ref_Group='',
		Ref_Usulan='".$RefU."',
		Ref_History='".$RefH."',
		Ref_Mutasi='".$RefM."',
		Kd_UPB='".$mRo['Kd_UPB']."',
		Kd_Aset='".$mRo['Kd_Aset']."',
		No_Register='".$mRo['No_Register']."',
		No_Pengadaan='".$mRo['No_Pengadaan']."',
		Ref_Temp='".$mRo['Ref_Temp']."',
		Nm_Aset='".$mRo['Nm_Aset']."',
		Kd_Pemilik='".$mRo['Kd_Pemilik']."',
		Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
		Tgl_Mutasi='".$TglM."',
		Lokasi='".$mRo['Lokasi']."',
		Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',
		Dokumen_Nomor='".$mRo['Dokumen_Nomor']."',
		Asal_Usul='".$mRo['Asal_Usul']."',
		Kondisi='".$mRo['Kondisi']."',
		Masa_Manfaat='".$mRo['Masa_Manfaat']."',
		Harga='".$mRo['Harga']."',
		Nilai_Akhir='".$mRo['Nilai_Akhir']."',
		Keterangan='".$mRo['Keterangan']."',
		No_SP2D='".$mRo['No_SP2D']."',
		Post='".$mRo['Post']."',
		Status='".$mRo['Status']."',
		Luas_M2='".$mRo['Luas_M2']."',
		Alamat='".$mRo['Alamat']."',
		Hak_Tanah='".$mRo['Hak_Tanah']."',
		Sertifikat='".$mRo['Sertifikat']."',
		Sertifikat_Tanggal='".$mRo['Sertifikat_Tanggal']."',
		Sertifikat_Nomor='".$mRo['Sertifikat_Nomor']."',
		Penggunaan='".$mRo['Penggunaan']."',
		Kd_Ruang='".$mRo['Kd_Ruang']."',
		Merk='".$mRo['Merk']."',
		Type='".$mRo['Type']."',
		Ukuran_CC='".$mRo['Ukuran_CC']."',
		Bahan='".$mRo['Bahan']."',
		Nomor_Pabrik='".$mRo['Nomor_Pabrik']."',
		Nomor_Rangka='".$mRo['Nomor_Rangka']."',
		Nomor_Mesin='".$mRo['Nomor_Mesin']."',
		Nomor_Polisi='".$mRo['Nomor_Polisi']."',
		Nomor_BPKB='".$mRo['Nomor_BPKB']."',
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
		Judul='".$mRo['Judul']."',
		Spesifikasi='".$mRo['Spesifikasi']."',
		Pencipta='".$mRo['Pencipta']."',
		Daerah_Asal='".$mRo['Daerah_Asal']."',
		Jenis='".$mRo['Jenis']."',
		Ukuran='".$mRo['Ukuran']."',
		Tahun='".$mRo['Tahun']."',
		Recorded=now(),
		Pencatat='".$UID.":unexe'";
		$RsG = mysql_query($SQG);
		
		if ($RsG)
		{
			UnExeUpdateUnPostingKib_POST($frUPB,$RfA,$RfU,$RefU,$RefH,$RefM,$TglM,$UID);
			$DelMST = 'YA';
			$UdTRCI = 'YA';
		}
	}
	
	if ($DelMST=='YA') {
		$SQ="DELETE FROM ta_kib_g_mutasi WHERE Referensi='$RfA' AND Ref_Usulan='$RfU'";
		$Rs = mysql_query($SQ);
		
		if ($RfTo){
			$SQ="DELETE FROM ta_kib_".$TbT." WHERE Referensi='$RfTo' AND Ref_Usulan='$RfU'";
			$Rs = mysql_query($SQ);
		}
		
		#Posting tidak perlu didelete krna sdh di update
	}
	
	if ($UdTRCI=='YA') {
		$SQ="UPDATE ta_usulan_verifikasi_rinci SET Eksekusi='Belum', Pencatat='".$UID.":unExe', Recorded=now() WHERE IDT='$tID'";
		$Rs = mysql_query($SQ);
	}
}

function UnExeUpdateUnPostingKib_POST($frUPB,$RfA,$RfU,$RefU,$RefH,$RefM,$TglM,$UID)
{
	$rDT = fGlobal("Referensi_To:Kd_Aset:No_Register","ta_kib_post_108_mutasi","Referensi:Ref_Usulan:Kd_UPB",$RfA.":".$RfU.":".$frUPB."%","=:=:LIKE","","");
	if ($rDT){
		$rDT = explode(":",$rDT);
		$RefTo = $rDT[0];
		$AstLm = $rDT[1];
		$RegLm = $rDT[2];
		
		$SQW = "UPDATE ta_kib_post_108 SET 
		Referensi='".$RfA."',
		Kd_Aset='".$AstLm."',
		No_Register='".$RegLm."',
		Ref_Usulan='".$RefU."',
		Ref_Mutasi='".$RefM."',
		Ref_History='".$RefH."',
		Tgl_Mutasi='".$TglM."',
		Recorded=now(),
		Pencatat='".$UID.":unexe' 
		WHERE Referensi='".$RefTo."' AND Ref_Usulan='".$RfU."' AND Kd_UPB LIKE '".$frUPB."%'";
		$RsW = mysql_query($SQW);
		if ($RsW){
			$SQ="DELETE FROM ta_kib_post_108_mutasi WHERE Referensi='".$RfA."' AND Ref_Usulan='".$RfU."' AND Kd_UPB LIKE '".$frUPB."%'";
			$Rs = mysql_query($SQ);
		}
	}
}

function mNewRegAset($ToAsT,$gUpb,$ToKiB)
{
	$TbT = fNmHuruf((int)$ToKiB);
	$LastReG = fGlobal("IfNull(max(No_Register),0)","ta_kib_".$TbT,"Kd_Aset:Kd_Upb",$ToAsT.":".$gUpb,"=:=","","");
	$LastReG = ((int)$LastReG) + 1;
	$LastReG = fMakeRegister($LastReG,7);
	return $LastReG;
}

function mNewRefAset($ToKiB)
{
	$TbT = fNmHuruf((int)$ToKiB);
	$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_".$TbT,"IDT","%","LIKE","","");
	$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_".$TbT."_mutasi","IDT","%","LIKE","","");
	$LefR = substr($NewK,0,3);
	$NewK = (int)substr($NewK,-11,11);
	$NewB = (int)substr($NewB,-11,11);
	if ($NewB>$NewK){$NewK=$NewB;}
	$NewK = $NewK + 1;
	$NewK = $LefR.".".fMakeReferensi($NewK,11);
	return $NewK;
}

?>