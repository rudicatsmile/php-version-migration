<?
function ExecuteRC($NoRG,$frUPB,$RfA,$RfU,$TbK,$tID,$UID)
{
	$CekR = fGlobal("IDT","ta_kib_108_mutasi","Ref_Usulan:Referensi:No_Register",$RfU.":".$RfA.":".$NoRG,"=:=:=","","");
	if ($CekR=='') 
	{
		$TglMts = fGlobal("Mutasi_Tanggal","ta_usulan_verifikasi_rinci_108","Ref_Aset:Ref_Usulan:No_Register",$RfA.":".$RfU.":".$NoRG,"=:=:=","","");
		$NewAST = fGlobal("To_Kd_Aset","ta_usulan_verifikasi_rinci_108","Ref_Aset:Ref_Usulan:No_Register",$RfA.":".$RfU.":".$NoRG,"=:=:=","","");
		
		#Rek17 masih tetap dibawa
		$NewAST17 = fGlobal("Kd_Aset17","ref_rek_aset5_maping","Kd_Aset108",$NewAST,"=","","");
		
		$KdUPB  = fGlobal("Kd_UPB","ta_usulan_verifikasi_rinci_108","Ref_Aset:Ref_Usulan:No_Register",$RfA.":".$RfU.":".$NoRG,"=:=:=","","");
	
		$eRuH   = fGlobal("ref_usulan","ta_kib_108","referensi:kd_upb:No_Register",$RfA.":".$frUPB."%:".$NoRG,"=:LIKE:=","","");
		$uRef   = AwalRef108(substr($NewAST,0,5));
		
		$NewReGAset = mNewRegAset_108($NewAST,$KdUPB);
		$NewRefAset = mNewRefAset_108($uRef);
		
		InsertKib_Mutasi_108($NoRG,$frUPB,$RfA,$RfU,$NewRefAset,$TglMts,$NewAST,$NewAST17,$UID);
		InsertPos_Mutasi_108($NoRG,$frUPB,$RfA,$RfU,$NewRefAset,$TglMts,$NewAST,$NewAST17,$UID);
		
		UpdateKib_108($NoRG,$frUPB,$RfA,$RfU,$NewReGAset,$NewRefAset,$TglMts,$NewAST,$NewAST17,$eRuH,$UID);
		UpdatePos_108($NoRG,$frUPB,$RfA,$RfU,$NewReGAset,$NewRefAset,$TglMts,$NewAST,$NewAST17,$eRuH,$UID);
		
		UpdateUsulanVerRci($tID,'Sudah',$UID);
	}
}

function UnExecuteRC($NoRG,$frUPB,$RfA,$RfU,$TbK,$tID,$UID)
{
	$DtE = fGlobal("Ref_Usulan:Ref_Usulan_His:Ref_History:Referensi:Referensi_To:Kd_Aset_108:Kd_Aset:No_Register:Tgl_Mutasi_Masuk","ta_kib_108_mutasi","Referensi:Ref_Usulan:Kd_UPB:No_Register",$RfA.":".$RfU.":".$frUPB."%:".$NoRG,"=:=:LIKE:=","IDT limit 0,1","");
	if ($DtE!="")
	{
		$DeB   = explode(":",$DtE);
		$RfU   = $DeB[0];	#Ref_Usulan
		$RuH   = $DeB[1];	#Ref_Usulan_His
		$RfH   = $DeB[2];	#Ref_History
		$RefAs = $DeB[3];	#Referensi
		$RefTo = $DeB[4];	#Referensi_To
		$KdA   = $DeB[5];	#Kd_Aset_108
		$Kd7   = $DeB[6];	#Kd_Aset
		$ReG   = $DeB[7];	#No_Register
		$TgM   = $DeB[8];	#Tgl Mutasi_Masuk
	}
	
	UpdateKibPos_108($NoRG,$frUPB,$RfU,$RuH,$RefAs,$RefTo,$RfH,$KdA,$Kd7,$ReG,$TgM,$UID);
	DeleteKibPos_108_Mutasi($NoRG,$frUPB,$RfU,$RefAs);
	UpdateUsulanVerRci($tID,'Belum',$UID);	
}

function DeleteKibPos_108_Mutasi($NoRG,$frUPB,$RfU,$RefAs)
{
	$SQU = "DELETE FROM ta_kib_108_mutasi WHERE Referensi='".$RefAs."' AND Ref_Usulan='".$RfU."' AND Kd_UPB LIKE '".$frUPB."%' AND No_Register='".$NoRG."'";
	$RsU = mysql_query($SQU);

	$SQU = "DELETE FROM ta_kib_post_108_mutasi WHERE Referensi='".$RefAs."' AND Ref_Usulan='".$RfU."' AND Kd_UPB LIKE '".$frUPB."%' AND No_Register='".$NoRG."'";
	$RsU = mysql_query($SQU);
}

function UpdateKibPos_108($NoRG,$frUPB,$RfU,$RuH,$RefAs,$RefTo,$RfH,$KdA,$Kd7,$ReG,$TgM,$UID)
{
	#No_Register='".$ReG."',
	$SQU = "UPDATE ta_kib_108 SET 
	Referensi='".$RefAs."',
	Ref_Usulan='".$RuH."',
	Ref_Usulan_His='',
	Ref_History='".$RfH."',
	Kd_Aset='".$Kd7."',
	Kd_Aset_108='".$KdA."',
	Tgl_Mutasi='".$TgM."',
	Kondisi='B',
	Recorded=now(),
	Pencatat='".$UID.":UnExe' 
	WHERE Referensi='".$RefTo."' AND Ref_Usulan='".$RfU."' AND Kd_UPB LIKE '".substr($KdT,0,11)."%' AND No_Register='".$NoRG."'";
	$RsU = mysql_query($SQU);
	
	#No_Register='".$ReG."',
	$SQU = "UPDATE ta_kib_post_108 SET 
	Referensi='".$RefAs."',
	Ref_Usulan='".$RuH."',
	Ref_Usulan_His='',
	Ref_History='".$RfH."',
	Kd_Aset='".$Kd7."',
	Kd_Aset_108='".$KdA."',
	Tgl_Mutasi='".$TgM."',
	Recorded=now(),
	Pencatat='".$UID.":UnExe' 
	WHERE Referensi='".$RefTo."' AND Ref_Usulan='".$RfU."' AND Kd_UPB LIKE '".substr($KdT,0,11)."%' AND No_Register='".$NoRG."'";
	$RsU = mysql_query($SQU);
}

function InsertPos_Mutasi_108($NoRG,$frUPB,$RfA,$RfU,$NewRefAset,$TglMts,$NewAST,$NewAST17,$UID)
{
	$SQG = "SELECT * FROM ta_kib_post_108 WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%' AND No_Register='".$NoRG."' ORDER BY Tanggal";
	$RsG = mysql_query($SQG);
	while ($mRG = mysql_fetch_array($RsG, MYSQL_BOTH))
	{
		$SW="INSERT INTO ta_kib_post_108_mutasi SET 
		Referensi='".$RfA."',
		Referensi_To='".$NewRefAset."',
		Ref_Group='".$mRG['Ref_Group']."',
		Ref_Usulan='".$RfU."',
		Ref_History='".$RfA."',
		Ref_Usulan_His='".$mRG['Ref_Usulan']."',
		Kd_UPB='".$mRG['Kd_UPB']."',
		Kd_UPB_To='".$mRG['Kd_UPB']."',
		Kd_Aset='".$mRG['Kd_Aset']."',
		Kd_Aset_To='".$NewAST17."',
		Kd_Aset_108='".$mRG['Kd_Aset_108']."',
		Kd_Aset_108_To='".$NewAST."',
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

function mNewRegAset_108($NewAST,$gUpb)
{
	$LastReG = fGlobal("IfNull(max(No_Register),0)","ta_kib_108","Kd_Aset_108:Kd_Upb",$NewAST.":".$gUpb,"=:=","","");
	$LastReG = ((int)$LastReG) + 1;
	$LastReG = fMakeRegister($LastReG,7);
	return $LastReG;
}

function mNewRefAset_108($uRef)
{
	$NewK = fGlobal("count_referensi","ta_kib_108_count_referensi","ref_crit",$uRef,"=","","");
	if ($NewK==0)
	{
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","Referensi",$uRef."%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","Referensi",$uRef."%","LIKE","","");
		$NewC = fGlobal("IfNull(max(referensi),0)","ta_kib_108_merger_his","referensi",$uRef."%","LIKE","","");
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		$NewC = (int)substr($NewC,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		if ($NewC > $NewK){$NewK = $NewC;}
	}
	
	$NewK = $NewK + 1;
	
	$SQ="UPDATE ta_kib_108_count_referensi SET count_referensi='".$NewK."' WHERE ref_crit='".$uRef."'";
	mysql_query($SQ);
	
	$NewRefKIB = $uRef.".".fMakeReferensi($NewK,11);
	
	return $NewRefKIB;
}

function InsertKib_Mutasi_108($NoRG,$frUPB,$RfA,$RfU,$NewRefAset,$TglMts,$NewAST,$NewAST17,$UID)
{
	$SQ = "SELECT * FROM ta_kib_108 WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%' AND No_Register='".$NoRG."'";
	$Rs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($Rs, MYSQL_BOTH))
	{
		$gUpb = $mRo['Kd_UPB'];
	
		$SQG = "INSERT INTO ta_kib_108_mutasi SET 
		Referensi='".$RfA."',
		Ref_Usulan='".$RfU."',
		Referensi_To='".$NewRefAset."',
		Ref_Group='".$mRo['Ref_Group']."',
		Kd_UPB='".$mRo['Kd_UPB']."',
		Kd_UPB_To='".$mRo['Kd_UPB']."',
		Kd_Aset='".$mRo['Kd_Aset']."',
		Kd_Aset_To='".$NewAST17."',
		
		Kd_Aset_108='".$mRo['Kd_Aset_108']."',
		Kd_Aset_108_To='".$NewAST."',
		
		No_Register='".$mRo['No_Register']."',
		
		KdpToAset='".$mRo['KdpToAset']."',
		Ref_Usulan_His='".$mRo['Ref_Usulan_His']."',
		Ref_History='".$mRo['Ref_History']."',
		
		No_Pengadaan='".$mRo['No_Pengadaan']."',
		Ref_Temp='".$mRo['Ref_Temp']."',
		Nm_Aset='".$mRo['Nm_Aset']."',
		Kd_Pemilik='".$mRo['Kd_Pemilik']."',
		Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
		Tgl_Mutasi='".$TglMts."',
		Tgl_Mutasi_Masuk='".$mRo['Tgl_Mutasi']."',
		Jns_Mutasi='MK',
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
		extracom='".$mRo['extracom']."',
		file_content='".mysql_real_escape_string($mRo['file_content'])."',
		file_name='".mysql_real_escape_string($mRo['file_name'])."',
		file_type='".mysql_real_escape_string($mRo['file_type'])."',
		file_size='".mysql_real_escape_string($mRo['file_size'])."',
		Recorded=now(),
		Pencatat='".$UID.":exe'";
		mysql_query($SQG);
	}
}

function UpdateKib_108($NoRG,$frUPB,$RfA,$RfU,$NewReGAset,$NewRefAset,$TglMts,$NewAST,$NewAST17,$eRuH,$UID)
{
	#No_Register='".$NewReGAset."',
	$SQU = "UPDATE ta_kib_108 SET 
	Referensi='".$NewRefAset."', 
	Kd_Aset_108='".$NewAST."', 
	Kd_Aset='".$NewAST17."', 
	Ref_Usulan='".$RfU."',
	Ref_Usulan_His='".$eRuH."',
	Ref_History='".$RfA."',
	Tgl_Mutasi='".$TglMts."',
	Recorded=now(),
	Pencatat='".$UID.":exe' 
	WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%' AND No_Register='".$NoRG."'";
	$RsU = mysql_query($SQU);
}

function UpdatePos_108($NoRG,$frUPB,$RfA,$RfU,$NewReGAset,$NewRefAset,$TglMts,$NewAST,$NewAST17,$eRuH,$UID)
{
	#No_Register='".$NewReGAset."',
	$SQU = "UPDATE ta_kib_post_108 SET 
	Referensi='".$NewRefAset."', 
	Kd_Aset_108='".$NewAST."', 
	Kd_Aset='".$NewAST17."', 
	Ref_Usulan='".$RfU."',
	Ref_Usulan_His='".$RuH."',
	Ref_History='".$RfA."',
	Tgl_Mutasi='".$TglMts."',
	Recorded=now(),
	Pencatat='".$UID.":exe' 
	WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%' AND No_Register='".$NoRG."'";
	$RsU = mysql_query($SQU);
}

function UpdateUsulanVerRci($tID,$Sudah,$UID)
{
	$SQU = "UPDATE ta_usulan_verifikasi_rinci_108 SET Eksekusi='".$Sudah."', Pencatat='".$UID.":exe', Recorded=now() WHERE IDT='".$tID."'";
	$RsU = mysql_query($SQU);
}

?>