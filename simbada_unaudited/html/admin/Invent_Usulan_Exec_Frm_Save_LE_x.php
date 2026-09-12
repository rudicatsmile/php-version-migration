<?
function ExecuteRC($frUPB,$RfA,$RfU,$TbK,$tID,$UID)
{
	//ASET YANG AKAN DILELANG
	$DelMST = 'NO';
	$UdTRCI = 'NO';
	$TglMts = fGlobal("Mutasi_Tanggal","ta_usulan_verifikasi_rinci","Ref_Aset:Ref_Usulan",$RfA.":".$RfU,"=:=","","");
	
	$SQ = "SELECT * FROM ta_kib_".$TbK." WHERE Referensi='$RfA' AND Kd_UPB LIKE '".$frUPB."%'";
	$Rs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($Rs, MYSQL_BOTH))
	{
		$gUpb = $mRo['Kd_UPB'];
		$NewRefKIB = mNewRefKIB_G();
		$NewRefGrp = "";
		
		$gRin = "";
		$gNmB = $mRo['Nm_Aset'];
		$rDT = fGlobal("Kd_Aset:Nm_Aset","ref_rek_aset5","Kd_Aset:Link_Kib_AE","07.23.%:".$mRo['Kd_Aset'],"LIKE:=","","");
		if ($rDT){
			$rDT = explode(":",$rDT);
			$gRin = $rDT[0];
			if ($gNmB=='') {$gNmB = $rDT[1];}
		}
		
		##################
		if ($gRin==""){
			$gRin = "07.23.".substr($mRo['Kd_Aset'],-9,9);
			$gNmB = fGlobal("Nm_Aset","ref_rek_aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");
			$SwE = "INSERT INTO ref_rek_aset5 SET Kd_Aset='$gRin', Nm_Aset='$gNmB', Link_Kib_AE='".$mRo['Kd_Aset']."'";
			$RsE = mysql_query($SwE);
		}
		##################
		
		$NewReGAset = mNewRegAset_G($gRin,$gUpb);
		
		$CekR = fGlobal("IDT","ta_kib_g","Ref_Usulan:Ref_History",$RfU.":".$RfA,"=:=","","");
		if ($CekR=="") 
		{
			if ($TbK=="a")
			{
				//Insert Kib A->G
				$SQG = "INSERT INTO ta_kib_g SET 
				Referensi='$NewRefKIB',
				Ref_Group='$NewRefGrp',
				Ref_Usulan='$RfU',
				Ref_History='$RfA',
				Ref_Mutasi='$RfA',
				Kd_UPB='$gUpb',
				Kd_Aset='$gRin',
				Nm_Aset='$gNmB',
				No_Register='$NewReGAset',
				
				Luas_M2='".$mRo['Luas_M2']."',
				Alamat='".mysql_real_escape_string($mRo['Alamat'])."',
				Hak_Tanah='".$mRo['Hak_Tanah']."',
				Sertifikat='".$mRo['Sertifikat']."',
				Sertifikat_Tanggal='".$mRo['Sertifikat_Tanggal']."',
				Sertifikat_Nomor='".$mRo['Sertifikat_Nomor']."',
				Penggunaan='".mysql_real_escape_string($mRo['Penggunaan'])."',
				
				Keterangan='".$mRo['Keterangan']."',
				Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
				Tgl_Mutasi='".$TglMts."',
				Kd_Pemilik='".$mRo['Kd_Pemilik']."',
				Kondisi='".$mRo['Kondisi']."',
				Asal_Usul='".$mRo['Asal_Usul']."',
				Masa_Manfaat='0',
				Harga='".$mRo['Harga']."',
				Post='Y',
				Recorded=now(),
				Pencatat='".$UID.":exe'";
				$RsG = mysql_query($SQG);				
				if ($RsG){
					PostingKib_G($frUPB,$RfA,$NewRefKIB,$NewRefGrp,$RfU,$gUpb,$gRin,$NewReGAset,$TglMts,$UID);
				}
								
				//Insert Kib-A mutasi
				$SQG = "INSERT INTO ta_kib_a_mutasi SET 
				Referensi='".$RfA."',
				Ref_Usulan='".$RfU."',
				Referensi_To='".$NewRefKIB."',
				Ref_Group='".$mRo['Ref_Group']."',
				Kd_UPB='".$mRo['Kd_UPB']."',
				Kd_UPB_To='".$mRo['Kd_UPB']."',
				Kd_Aset='".$mRo['Kd_Aset']."',
				Kd_Aset_To='".$gRin."',
				No_Register='".$mRo['No_Register']."',
				No_Pengadaan='".$mRo['No_Pengadaan']."',
				Ref_Temp='".$mRo['Ref_Temp']."',
				Nm_Aset='".$mRo['Nm_Aset']."',
				Kd_Pemilik='".$mRo['Kd_Pemilik']."',
				Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
				Tgl_Mutasi='".$TglMts."',
				Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
				Jns_Mutasi='LE',
				
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
					PostingKib_Mutasi($frUPB,$RfA,$RfU,$NewRefKIB,$TglMts,$gRin,$UID);
					$DelMST = 'YA';
					$UdTRCI = 'YA';				
				}
			}
			
			else if ($TbK=="b")
			{
				//Insert Kib B->G
				$SQG = "INSERT INTO ta_kib_g SET 
				Referensi='$NewRefKIB',
				Ref_Group='$NewRefGrp',
				Ref_Usulan='$RfU',
				Ref_History='$RfA',
				Ref_Mutasi='$RfA',
				Kd_UPB='$gUpb',
				Kd_Aset='$gRin',
				Nm_Aset='$gNmB',
				No_Register='$NewReGAset',
				
				Merk='".mysql_real_escape_string($mRo['Merk'])."',
				Type='".mysql_real_escape_string($mRo['Type'])."',
				Ukuran_CC='".mysql_real_escape_string($mRo['Ukuran_CC'])."',
				Bahan='".$mRo['Bahan']."',
				Nomor_Pabrik='".$mRo['Nomor_Pabrik']."',
				Nomor_Rangka='".$mRo['Nomor_Rangka']."',
				Nomor_Mesin='".$mRo['Nomor_Mesin']."',
				Nomor_Polisi='".$mRo['Nomor_Polisi']."',
				Nomor_BPKB='".$mRo['Nomor_BPKB']."',
				Keterangan='".$mRo['Keterangan']."',
				
				Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
				Tgl_Mutasi='".$TglMts."',
				Kd_Pemilik='".$mRo['Kd_Pemilik']."',
				Kondisi='".$mRo['Kondisi']."',
				Asal_Usul='".$mRo['Asal_Usul']."',
				Masa_Manfaat='".$mRo['Masa_Manfaat']."',
				Harga='".$mRo['Harga']."',
				Nilai_Akhir='".$mRo['Harga']."',
				Post='Y',
				Recorded=now(),
				Pencatat='".$UID.":exe'";
				$RsG = mysql_query($SQG);				
				if ($RsG){
					PostingKib_G($frUPB,$RfA,$NewRefKIB,$NewRefGrp,$RfU,$gUpb,$gRin,$NewReGAset,$TglMts,$UID);
				}
				
				//Insert Kib-B mutasi
				$SQG = "INSERT INTO ta_kib_b_mutasi SET 
				Referensi='".$RfA."',
				Ref_Usulan='".$RfU."',
				Referensi_To='".$NewRefKIB."',
				Ref_Group='".$mRo['Ref_Group']."',
				Kd_UPB='".$mRo['Kd_UPB']."',
				Kd_UPB_To='".$mRo['Kd_UPB']."',
				Kd_Aset='".$mRo['Kd_Aset']."',
				Kd_Aset_To='".$gRin."',
				No_Register='".$mRo['No_Register']."',
				No_Pengadaan='".$mRo['No_Pengadaan']."',
				Ref_Temp='".$mRo['Ref_Temp']."',
				Nm_Aset='".$mRo['Nm_Aset']."',
				Kd_Pemilik='".$mRo['Kd_Pemilik']."',
				Kd_Ruang='".$mRo['Kd_Ruang']."',
				Merk='".mysql_real_escape_string($mRo['Merk'])."',
				Type='".mysql_real_escape_string($mRo['Type'])."',
				Ukuran_CC='".mysql_real_escape_string($mRo['Ukuran_CC'])."',
				Bahan='".mysql_real_escape_string($mRo['Bahan'])."',
				Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
				Tgl_Mutasi='".$TglMts."',
				Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
				Jns_Mutasi='LE',
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
					PostingKib_Mutasi($frUPB,$RfA,$RfU,$NewRefKIB,$TglMts,$gRin,$UID);
					$DelMST = 'YA';
					$UdTRCI = 'YA';
				}
			}	
			
			if ($TbK=="c")
			{
				//Insert Kib C->G
				$SQG = "INSERT INTO ta_kib_g SET 
				Referensi='$NewRefKIB',
				Ref_Group='$NewRefGrp',
				Ref_Usulan='$RfU',
				Ref_History='$RfA',
				Ref_Mutasi='$RfA',
				Kd_UPB='$gUpb',
				Kd_Aset='$gRin',
				Nm_Aset='$gNmB',
				No_Register='$NewReGAset',
				
				Bertingkat='".$mRo['Bertingkat']."',
				Beton='".$mRo['Beton']."',
				Luas_Lantai='".$mRo['Luas_Lantai']."',
				Lokasi='".mysql_real_escape_string($mRo['Lokasi'])."',
				Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',
				Dokumen_Nomor='".mysql_real_escape_string($mRo['Dokumen_Nomor'])."',
				Status_Tanah='".$mRo['Status_Tanah']."',
				Kode_Tanah='".$mRo['Kode_Tanah']."',
				
				Keterangan='".mysql_real_escape_string($mRo['Keterangan'])."',
				Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
				Tgl_Mutasi='".$TglMts."',
				Kd_Pemilik='".$mRo['Kd_Pemilik']."',
				Kondisi='".$mRo['Kondisi']."',
				Asal_Usul='".$mRo['Asal_Usul']."',
				Masa_Manfaat='".$mRo['Masa_Manfaat']."',
				Harga='".$mRo['Harga']."',
				Nilai_Akhir='".$mRo['Nilai_Akhir']."',
				Post='Y',
				Recorded=now(),
				Pencatat='".$UID.":exe'";
				$RsG = mysql_query($SQG);
				
				if ($RsG){
					PostingKib_G($frUPB,$RfA,$NewRefKIB,$NewRefGrp,$RfU,$gUpb,$gRin,$NewReGAset,$TglMts,$UID);
				}
				
				//Insert Kib-C mutasi
				$SQG = "INSERT INTO ta_kib_c_mutasi SET 
				Referensi='".$RfA."',
				Ref_Usulan='".$RfU."',
				Referensi_To='".$NewRefKIB."',
				Ref_Group='".$mRo['Ref_Group']."',
				
				Kd_UPB='".$mRo['Kd_UPB']."',
				Kd_UPB_To='".$mRo['Kd_UPB']."',
				Kd_Aset='".$mRo['Kd_Aset']."',
				Kd_Aset_To='".$gRin."',
				No_Register='".$mRo['No_Register']."',
				No_Pengadaan='".$mRo['No_Pengadaan']."',
				
				Ref_Temp='".$mRo['Ref_Temp']."',
				Nm_Aset='".$mRo['Nm_Aset']."',
				Kd_Pemilik='".$mRo['Kd_Pemilik']."',
				Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
				Tgl_Mutasi='".$TglMts."',
				Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
				Jns_Mutasi='LE',
				
				Bertingkat='".$mRo['Bertingkat']."',
				Beton='".$mRo['Beton']."',
				Luas_Lantai='".$mRo['Luas_Lantai']."',
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
					PostingKib_Mutasi($frUPB,$RfA,$RfU,$NewRefKIB,$TglMts,$gRin,$UID);
					$DelMST = 'YA';
					$UdTRCI = 'YA';
				}
			}
			
			else if ($TbK=="d")
			{
				//Insert Kib D->G
				$SQG = "INSERT INTO ta_kib_g SET 
				Referensi='$NewRefKIB',
				Ref_Group='$NewRefGrp',
				Ref_Usulan='$RfU',
				Ref_History='$RfA',
				Ref_Mutasi='$RfA',
				Kd_UPB='$gUpb',
				Kd_Aset='$gRin',
				Nm_Aset='$gNmB',
				No_Register='$NewReGAset',
				
				Konstruksi='".$mRo['Konstruksi']."',
				Panjang='".$mRo['Panjang']."',
				Lebar='".$mRo['Lebar']."',
				Luas='".$mRo['Luas']."',
				Lokasi='".mysql_real_escape_string($mRo['Lokasi'])."',
				Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',
				Dokumen_Nomor='".$mRo['Dokumen_Nomor']."',
				Status_Tanah='".$mRo['Status_Tanah']."',
				Kode_Tanah='".$mRo['Kode_Tanah']."',
				
				Keterangan='".$mRo['Keterangan']."',
				Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
				Tgl_Mutasi='".$TglMts."',
				Kd_Pemilik='".$mRo['Kd_Pemilik']."',
				Kondisi='".$mRo['Kondisi']."',
				Asal_Usul='".$mRo['Asal_Usul']."',
				Masa_Manfaat='".$mRo['Masa_Manfaat']."',
				Harga='".$mRo['Harga']."',
				Nilai_Akhir='".$mRo['Nilai_Akhir']."',
				Post='Y',
				Recorded=now(),
				Pencatat='".$UID.":exe'";
				$RsG = mysql_query($SQG);				
				
				if ($RsG){
					PostingKib_G($frUPB,$RfA,$NewRefKIB,$NewRefGrp,$RfU,$gUpb,$gRin,$NewReGAset,$TglMts,$UID);
				}
				
				//Insert Kib-D mutasi
				$SQG = "INSERT INTO ta_kib_d_mutasi SET 
				Referensi='".$RfA."',
				Ref_Usulan='".$RfU."',
				Referensi_To='".$NewRefKIB."',
				Ref_Group='".$mRo['Ref_Group']."',
				Kd_UPB='".$mRo['Kd_UPB']."',
				Kd_UPB_To='".$mRo['Kd_UPB']."',
				Kd_Aset='".$mRo['Kd_Aset']."',
				Kd_Aset_To='".$gRin."',
				No_Register='".$mRo['No_Register']."',
				No_Pengadaan='".$mRo['No_Pengadaan']."',
				Ref_Temp='".$mRo['Ref_Temp']."',
				Nm_Aset='".$mRo['Nm_Aset']."',
				Kd_Pemilik='".$mRo['Kd_Pemilik']."',
				
				Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
				Tgl_Mutasi='".$TglMts."',
				Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
				Jns_Mutasi='LE',
				
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
					PostingKib_Mutasi($frUPB,$RfA,$RfU,$NewRefKIB,$TglMts,$gRin,$UID);
					$DelMST = 'YA';
					$UdTRCI = 'YA';
				}
			}
			else if ($TbK=="e")
			{
				//Insert Kib E->G
				$SQG = "INSERT INTO ta_kib_g SET 
				Referensi='$NewRefKIB',
				Ref_Group='$NewRefGrp',
				Ref_Usulan='$RfU',
				Ref_History='$RfA',
				Ref_Mutasi='$RfA',
				Kd_UPB='$gUpb',
				Kd_Aset='$gRin',
				Nm_Aset='$gNmB',
				No_Register='$NewReGAset',
				
				Judul='".$mRo['Judul']."',
				Spesifikasi='".$mRo['Spesifikasi']."',
				Pencipta='".$mRo['Pencipta']."',
				Daerah_Asal='".$mRo['Daerah_Asal']."',
				Bahan='".$mRo['Bahan']."',
				Jenis='".$mRo['Jenis']."',
				Ukuran='".$mRo['Ukuran']."',
				
				Keterangan='".$mRo['Keterangan']."',
				Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
				Tgl_Mutasi='".$TglMts."',
				Kd_Pemilik='".$mRo['Kd_Pemilik']."',
				Kondisi='".$mRo['Kondisi']."',
				Asal_Usul='".$mRo['Asal_Usul']."',
				Masa_Manfaat='".$mRo['Masa_Manfaat']."',
				Harga='".$mRo['Harga']."',
				Nilai_Akhir='".$mRo['Nilai_Akhir']."',
				Post='Y',
				Recorded=now(),
				Pencatat='".$UID.":exe'";
				$RsG = mysql_query($SQG);				
				
				if ($RsG){
					PostingKib_G($frUPB,$RfA,$NewRefKIB,$NewRefGrp,$RfU,$gUpb,$gRin,$NewReGAset,$TglMts,$UID);
				}
				
				//Insert Kib-E mutasi
				$SQG = "INSERT INTO ta_kib_e_mutasi SET 
				Referensi='".$RfA."',
				Ref_Usulan='".$RfU."',
				Referensi_To='".$NewRefKIB."',
				Ref_Group='".$mRo['Ref_Group']."',
				Kd_UPB='".$mRo['Kd_UPB']."',
				Kd_UPB_To='".$mRo['Kd_UPB']."',
				Kd_Aset='".$mRo['Kd_Aset']."',
				Kd_Aset_To='".$gRin."',
				No_Register='".$mRo['No_Register']."',
				No_Pengadaan='".$mRo['No_Pengadaan']."',
				Ref_Temp='".$mRo['Ref_Temp']."',
				Nm_Aset='".$mRo['Nm_Aset']."',
				Kd_Pemilik='".$mRo['Kd_Pemilik']."',
				
				Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
				Tgl_Mutasi='".$TglMts."',
				Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
				Jns_Mutasi='LE',
				
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
					PostingKib_Mutasi($frUPB,$RfA,$RfU,$NewRefKIB,$TglMts,$gRin,$UID);
					$DelMST = 'YA';
					$UdTRCI = 'YA';
				}
			}
		}
	}
	
	if ($DelMST=='YA') {
		$SQ="DELETE FROM ta_kib_".$TbK." WHERE Referensi='$RfA' AND Kd_UPB LIKE '$frUPB%'";
		$Rs = mysql_query($SQ);
		
		$SQ="DELETE FROM ta_kib_post WHERE Referensi='$RfA' AND Kd_UPB LIKE '$frUPB%'";
		$Rs = mysql_query($SQ);
	}
	
	if ($UdTRCI=='YA') {
		$SQ="UPDATE ta_usulan_verifikasi_rinci SET Eksekusi='Sudah', To_Kd_Aset='$gRin', Pencatat='".$UID.":exe', Recorded=now() WHERE IDT='$tID'";
		$Rs = mysql_query($SQ);
	}
}

function mNewRefKIB_G()
{
	$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_g","IDT","%","LIKE","","");
	$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_g_mutasi","IDT","%","LIKE","","");
	$NewK = (int)substr($NewK,-11,11);
	$NewB = (int)substr($NewB,-11,11);
	if ($NewB > $NewK){$NewK = $NewB;}
	$NewK = $NewK + 1;
	$NewR = "KDL.".fMakeReferensi($NewK,11);
	return $NewR;
}

function mNewRegAset_G($gRin,$gUpb)
{
	$LastReG = fGlobal("IfNull(max(No_Register),0)","ta_kib_g","Kd_Aset:Kd_Upb",$gRin.":".$gUpb,"=:=","","");
	$LastReG = ((int)$LastReG) + 1;
	$LastReG = fMakeRegister($LastReG,7);
	return $LastReG;
}

function PostingKib_Mutasi($frUPB,$RfA,$RfU,$NewRefKIB,$TglMts,$gRin,$UID)
{
	//Insert Kib Mutasi Posting
	$SQG = "SELECT * FROM ta_kib_post WHERE Referensi='$RfA' AND Kd_UPB LIKE '$frUPB%' ORDER BY Tanggal";
	$RsG = mysql_query($SQG);
	while ($mRG = mysql_fetch_array($RsG, MYSQL_BOTH))
	{
		$SW="INSERT INTO ta_kib_post_mutasi SET 
		Referensi='".$RfA."',
		Referensi_To='".$NewRefKIB."',
		Ref_Group='".$mRG['Ref_Group']."',
		Ref_Usulan='".$RfU."',
		Ref_History='".$RfA."',
		Ref_Usulan_His='".$mRG['Ref_Usulan']."',
		Kd_UPB='".$mRG['Kd_UPB']."',
		Kd_UPB_To='".$mRG['Kd_UPB']."',
		Kd_Aset='".$mRG['Kd_Aset']."',
		Kd_Aset_To='".$gRin."',
		No_Register='".$mRG['No_Register']."',
		Crit='".$mRG['Crit']."',
		Tanggal='".$mRG['Tanggal']."',
		Tgl_Mutasi_Masuk='".$mRG['Tgl_Mutasi']."',
		Tgl_Mutasi='".$TglMts."',
		Jns_Mutasi='LE',
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

function PostingKib_G($frUPB,$RfA,$NewRefKIB,$NewRefGrp,$RfU,$gUpb,$gRin,$NewReGAset,$TglMts,$UID)
{
	//Kib-G Posting
	$SQG = "SELECT * FROM ta_kib_post WHERE Referensi='$RfA' AND Kd_UPB LIKE '$frUPB%' ORDER BY Tanggal";
	$RsG = mysql_query($SQG);
	while ($mRG = mysql_fetch_array($RsG, MYSQL_BOTH))
	{
		$SW="INSERT INTO ta_kib_post SET 
		Referensi='$NewRefKIB',
		Ref_Group='$NewRefGrp',
		Ref_Usulan='".$RfU."',
		Ref_History='".$RfA."',
		Ref_Mutasi='".$RfA."',
		Kd_UPB='$gUpb',
		Kd_Aset='$gRin',
		No_Register='$NewReGAset',
		
		Crit='".$mRG['Crit']."',
		Tanggal='".$mRG['Tanggal']."',
		Tgl_Mutasi='".$TglMts."',
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
		IndexData='0'";
		$rW = mysql_query($SW);
	}
}

function UnExecuteRC($frUPB,$RfA,$RfU,$TbK,$tID,$UID)
{
	$DelMTS = 'NO';
	
	#Ambil record pada mutasi sebelumnya jika ada
	$RefU = "";
	$RefH = "";
	$RefM = "";
	$TglM = "0000-00-00";
	$DtE = fGlobal("Ref_Usulan:Ref_History:Referensi:Tgl_Mutasi_Masuk","ta_kib_post_mutasi","Referensi_To:Kd_UPB_To",$RfA.":".$frUPB."%","=:LIKE","IDT limit 0,1","");
	if ($DtE!="")
	{
		$DtEB = explode(":",$DtE);
		$RefU = $DtEB[0];
		$RefH = $DtEB[1];
		$RefM = $DtEB[2];
		$TglM = $DtEB[3];
	}
	
	$SQ = "SELECT * FROM ta_kib_".$TbK."_mutasi WHERE Referensi='".$RfA."' AND Ref_Usulan='".$RfU."' AND Kd_UPB LIKE '".$frUPB."%'";
	$Rs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($Rs, MYSQL_BOTH))
	{
		if ($TbK=="a")
		{
			$SQG="INSERT INTO ta_kib_a SET
			Referensi='".$mRo['Referensi']."',
			Ref_Group='".$mRo['Ref_Group']."',
			Ref_Mutasi='".$RefM."',
			Ref_Usulan='".$RefU."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_Aset='".$mRo['Kd_Aset']."',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			
			Luas_M2='".$mRo['Luas_M2']."',
			Alamat='".mysql_real_escape_string($mRo['Alamat'])."',
			Hak_Tanah='".$mRo['Hak_Tanah']."',
			Sertifikat='".$mRo['Sertifikat']."',
			Sertifikat_Tanggal='".$mRo['Sertifikat_Tanggal']."',
			Sertifikat_Nomor='".$mRo['Sertifikat_Nomor']."',
			Penggunaan='".mysql_real_escape_string($mRo['Penggunaan'])."',
			
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$TglM."',
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
				$DelMTS = 'YA';
			}
		}
		else if ($TbK=="b")
		{
			$SQG="INSERT INTO ta_kib_b SET
			Referensi='".$mRo['Referensi']."',
			Ref_Group='".$mRo['Ref_Group']."',
			Ref_Mutasi='".$RefM."',
			Ref_Usulan='".$RefU."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_Aset='".$mRo['Kd_Aset']."',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			Kd_Ruang='".$mRo['Kd_Ruang']."',
			Merk='".mysql_real_escape_string($mRo['Merk'])."',
			Type='".mysql_real_escape_string($mRo['Type'])."',
			Ukuran_CC='".mysql_real_escape_string($mRo['Ukuran_CC'])."',
			Bahan='".mysql_real_escape_string($mRo['Bahan'])."',
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
			No_SP2D='".mysql_real_escape_string($mRo['No_SP2D'])."',
			Post='".$mRo['Post']."',
			Status='".$mRo['Status']."',
			Recorded=now(),
			Pencatat='".$UID.":unexe'";
			$RsG = mysql_query($SQG);
			
			if ($RsG){
				$DelMTS = 'YA';
			}
		}
		else if ($TbK=="c")
		{
			$SQG="INSERT INTO ta_kib_c SET
			Referensi='".$mRo['Referensi']."',
			Ref_Group='".$mRo['Ref_Group']."',
			Ref_Mutasi='".$RefM."',
			Ref_Usulan='".$RefU."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_Aset='".$mRo['Kd_Aset']."',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			
			Bertingkat='".$mRo['Bertingkat']."',
			Beton='".$mRo['Beton']."',
			Luas_Lantai='".$mRo['Luas_Lantai']."',
			Lokasi='".mysql_real_escape_string($mRo['Lokasi'])."',
			Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',
			Dokumen_Nomor='".mysql_real_escape_string($mRo['Dokumen_Nomor'])."',
			Status_Tanah='".mysql_real_escape_string($mRo['Status_Tanah'])."',
			Kode_Tanah='".mysql_real_escape_string($mRo['Kode_Tanah'])."',
			
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$TglM."',
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
				$DelMTS = 'YA';
			}
		}
		else if ($TbK=="d")
		{
			$SQG="INSERT INTO ta_kib_d SET
			Referensi='".$mRo['Referensi']."',
			Ref_Group='".$mRo['Ref_Group']."',
			Ref_Mutasi='".$RefM."',
			Ref_Usulan='".$RefU."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_Aset='".$mRo['Kd_Aset']."',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			
			Konstruksi='".$mRo['Konstruksi']."',
			Panjang='".$mRo['Panjang']."',
			Lebar='".$mRo['Lebar']."',
			Luas='".$mRo['Luas']."',
			Lokasi='".mysql_real_escape_string($mRo['Lokasi'])."',
			Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',
			Dokumen_Nomor='".mysql_real_escape_string($mRo['Dokumen_Nomor'])."',
			Status_Tanah='".mysql_real_escape_string($mRo['Status_Tanah'])."',
			Kode_Tanah='".mysql_real_escape_string($mRo['Kode_Tanah'])."',
			
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Ref_Mutasi='".$TglM."',
			Asal_Usul='".$mRo['Asal_Usul']."',
			Kondisi='".$mRo['Kondisi']."',
			Harga='".$mRo['Harga']."',
			Nilai_Akhir='".$mRo['Nilai_Akhir']."',
			Masa_Manfaat='".$mRo['Masa_Manfaat']."',
			Keterangan='".mysql_real_escape_string($mRo['Keterangan'])."',
			No_SP2D='".mysql_real_escape_string($mRo['No_SP2D'])."',
			Post='".$mRo['Post']."',
			Status='".$mRo['Status']."',
			Recorded=now(),
			Pencatat='".$UID.":unexe'";
			$RsG = mysql_query($SQG);
			
			if ($RsG){
				$DelMTS = 'YA';
			}
		}
		else if ($TbK=="e")
		{
			$SQG="INSERT INTO ta_kib_e SET
			Referensi='".$mRo['Referensi']."',
			Ref_Group='".$mRo['Ref_Group']."',
			Ref_Mutasi='".$RefM."',
			Ref_Usulan='".$RefU."',
			Kd_UPB='".$mRo['Kd_UPB']."',
			Kd_Aset='".$mRo['Kd_Aset']."',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			
			Judul='".mysql_real_escape_string($mRo['Judul'])."',
			Spesifikasi='".mysql_real_escape_string($mRo['Spesifikasi'])."',
			Pencipta='".mysql_real_escape_string($mRo['Pencipta'])."',
			Daerah_Asal='".mysql_real_escape_string($mRo['Daerah_Asal'])."',
			Bahan='".mysql_real_escape_string($mRo['Bahan'])."',
			Jenis='".mysql_real_escape_string($mRo['Jenis'])."',
			Ukuran='".mysql_real_escape_string($mRo['Ukuran'])."',
			
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$TglM."',
			Asal_Usul='".$mRo['Asal_Usul']."',
			Kondisi='".$mRo['Kondisi']."',
			Harga='".$mRo['Harga']."',
			Nilai_Akhir='".$mRo['Nilai_Akhir']."',
			Masa_Manfaat='".$mRo['Masa_Manfaat']."',
			Keterangan='".mysql_real_escape_string($mRo['Keterangan'])."',
			No_SP2D='".mysql_real_escape_string($mRo['No_SP2D'])."',
			Post='".$mRo['Post']."',
			Status='".$mRo['Status']."',
			Recorded=now(),
			Pencatat='".$UID.":unexe'";
			$RsG = mysql_query($SQG);
			
			if ($RsG){
				$DelMTS = 'YA';
			}
		}
	}
	
	if ($DelMTS == 'YA'){
		$SQ = "DELETE FROM ta_kib_".$TbK."_mutasi WHERE Referensi='$RfA' AND Ref_Usulan='$RfU'";
		$Rs = mysql_query($SQ);
		
		$SQ = "DELETE FROM ta_kib_g WHERE Ref_History='$RfA' AND Ref_Usulan='$RfU'";
		$Rs = mysql_query($SQ);
	}
	
	$SQ = "SELECT * FROM ta_kib_post_mutasi WHERE Referensi='$RfA' AND Ref_Usulan='$RfU' ORDER BY IndexData";
	$Rs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($Rs, MYSQL_BOTH))
	{
		$SQG="INSERT INTO ta_kib_post SET
		Referensi='".$mRo['Referensi']."',
		Ref_Mutasi='".$RefM."',
		Ref_History='".$RefM."',
		Ref_Usulan='".$RefU."',
		Ref_Group='".$mRo['Ref_Group']."',
		Kd_UPB='".$mRo['Kd_UPB']."',
		Kd_Aset='".$mRo['Kd_Aset']."',
		No_Register='".$mRo['No_Register']."',
		Crit='".$mRo['Crit']."',
		Tanggal='".$mRo['Tanggal']."',
		Tgl_Mutasi='".$TglM."',
		Uraian='".$mRo['Uraian']."',
		DK='".$mRo['DK']."',
		Debet='".$mRo['Debet']."',
		Kredit='".$mRo['Kredit']."',
		No_Pengadaan='".$mRo['No_Pengadaan']."',
		Ref_Temp='".$mRo['Ref_Temp']."',
		Keterangan='".$mRo['Keterangan']."',
		Tmbh_Ms_Manfaat='".$mRo['Tmbh_Ms_Manfaat']."',
		HasilMerger='".$mRo['HasilMerger']."',
		Mrg_Ref_History='".$mRo['Mrg_Ref_History']."',
		Mrg_Crit_History='".$mRo['Mrg_Crit_History']."',
		Mrg_Tmbh_Ms_Manfaat_History='".$mRo['Mrg_Tmbh_Ms_Manfaat_History']."',
		IndexData='".$mRo['IndexData']."',
		Recorded=now(),
		Pencatat='".$UID.":unexe'";
		$RsG = mysql_query($SQG);
	}
	$SQ = "DELETE FROM ta_kib_post_mutasi WHERE Referensi='$RfA' AND Ref_Usulan='$RfU'";
	$Rs = mysql_query($SQ);
	
	$SQ = "DELETE FROM ta_kib_post WHERE Ref_History='$RfA' AND Ref_Usulan='$RfU'";
	$Rs = mysql_query($SQ);
	
	$SQ="UPDATE ta_usulan_verifikasi_rinci SET Eksekusi='Belum', Pencatat='".$UID.":unExe', Recorded=now() WHERE IDT='$tID'";
	$Rs = mysql_query($SQ);
}
?>