<?
function ExecuteRC($frUPB,$RfA,$RfU,$TbK,$tID,$UID)
{
	$TglMts = fGlobal("Mutasi_Tanggal","ta_usulan_verifikasi_rinci_108","Ref_Aset:Ref_Usulan",$RfA.":".$RfU,"=:=","","");
	
	$NewRefKIB = mNewRefKIB_108('KDL');
	$NewRefGrp = "";
	
	$rRKO = fGlobal("Kd_Aset_108","ta_kib_108","referensi:kd_upb",$RfA.":".$frUPB."%","=:LIKE","","");
	$eRuH = fGlobal("ref_usulan","ta_kib_108","referensi:kd_upb",$RfA.":".$frUPB."%","=:LIKE","","");
	
	$gRin = "";
	$gNmB = "";
	$rDT = fGlobal("Kd_Aset:Nm_Aset","ref_rek_aset108_7","Kd_Aset:Link_Kib_AE","1.5.4.02.%:".$rRKO,"LIKE:=","","");
	if ($rDT){
		$rDT = explode(":",$rDT);
		$gRin = $rDT[0];
		$gNmB = $rDT[1];
	}
	
	$NewReGAset = mNewRegAset_108($gRin,$gUpb);
	
	$CekR = fGlobal("IDT","ta_kib_108_mutasi","Ref_Usulan:Referensi",$RfU.":".$RfA,"=:=","","");
	if ($CekR=='') 
	{
		InsertKib_Mutasi_108($frUPB,$RfA,$RfU,$NewRefKIB,$TglMts,$gRin,$UID);
		InsertPos_Mutasi_108($frUPB,$RfA,$RfU,$NewRefKIB,$TglMts,$gRin,$UID);
		
		UpdateKib_108($frUPB,$RfA,$RfU,$NewRefKIB,$NewReGAset,$TglMts,$gRin,$eRuH,$UID);
		UpdatePos_108($frUPB,$RfA,$RfU,$NewRefKIB,$NewReGAset,$TglMts,$gRin,$eRuH,$UID);
		
		UpdateUsulanVerRci($tID,$gRin,'Sudah',$UID);
	}
}

function UnExecuteRC($frUPB,$RfA,$RfU,$TbK,$tID,$UID)
{
	$DtE = fGlobal("Ref_Usulan:Ref_Usulan_His:Ref_History:Referensi:Referensi_To:Kd_Aset_108:No_Register:Tgl_Mutasi_Masuk","ta_kib_108_mutasi","Referensi:Ref_Usulan:Kd_UPB_To",$RfA.":".$RfU.":".$frUPB."%","=:=:LIKE","IDT limit 0,1","");
	if ($DtE!="")
	{
		$DeB = explode(":",$DtE);
		$RfU = $DeB[0];	#Ref_Usulan
		$RuH = $DeB[1];	#Ref_Usulan_His
		$RfH = $DeB[2];	#Ref_History
		$ReF = $DeB[3];	#Referensi
		$RfT = $DeB[4];	#Referensi_To
		$KdA = $DeB[5];	#Kd_Aset_108
		$ReG = $DeB[6];	#No_Register
		$TgM = $DeB[7];	#No_Register
	}
	
	UpdateKibPos_108($frUPB,$RfU,$RuH,$ReF,$RfH,$RfT,$KdA,$ReG,$TgM,$UID);
	DeleteKibPos_108_Mutasi($frUPB,$RfU,$ReF,$RfU);
	UpdateUsulanVerRci($tID,'','Belum',$UID);	
}

function DeleteKibPos_108_Mutasi($frUPB,$RfU,$ReF,$RfU)
{
	$SQU = "DELETE FROM ta_kib_108_mutasi WHERE Referensi='".$ReF."' AND Ref_Usulan='".$RfU."' AND Kd_UPB LIKE '".$frUPB."%'";
	$RsU = mysql_query($SQU);

	$SQU = "DELETE FROM ta_kib_post_108_mutasi WHERE Referensi='".$ReF."' AND Ref_Usulan='".$RfU."' AND Kd_UPB LIKE '".$frUPB."%'";
	$RsU = mysql_query($SQU);
}

function UpdateKibPos_108($frUPB,$RfU,$RuH,$ReF,$RfH,$RfT,$KdA,$ReG,$TgM,$UID)
{
	#No_Register='".$ReG."',
	$SQU = "UPDATE ta_kib_108 SET 
	Referensi='".$ReF."', 
	Ref_Usulan='".$RuH."',
	Ref_Usulan_His='',
	Ref_History='".$RfH."',
	Kd_Aset_108='".$KdA."',
	Tgl_Mutasi='".$TgM."',
	Kondisi='B',
	Recorded=now(),
	Pencatat='".$UID.":UnExe' 
	WHERE Referensi='".$RfT."' AND Ref_Usulan='".$RfU."' AND Kd_UPB LIKE '".$frUPB."%'";
	$RsU = mysql_query($SQU);
	
	#No_Register='".$ReG."',
	$SQU = "UPDATE ta_kib_post_108 SET 
	Referensi='".$ReF."', 
	Ref_Usulan='".$RuH."',
	Ref_Usulan_His='',
	Ref_History='".$RfH."',
	Kd_Aset_108='".$KdA."',
	Tgl_Mutasi='".$TgM."',
	Recorded=now(),
	Pencatat='".$UID.":UnExe' 
	WHERE Referensi='".$RfT."' AND Ref_Usulan='".$RfU."' AND Kd_UPB LIKE '".$frUPB."%'";
	$RsU = mysql_query($SQU);
	
	#No_Register='".$ReG."',
	$SQU = "UPDATE ta_kib_post_penyusutan_108 SET 
	Referensi='".$ReF."', 
	Ref_History='".$RfH."',
	Kd_Aset_108='".$KdA."' 
	WHERE Referensi='".$RfT."' AND Kd_UPB LIKE '".$frUPB."%'";
	$RsU = mysql_query($SQU);
}

function InsertPos_Mutasi_108($frUPB,$RfA,$RfU,$NewRefKIB,$TglMts,$gRin,$UID)
{
	$SQG = "SELECT * FROM ta_kib_post_108 WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%' ORDER BY Tanggal";
	$RsG = mysql_query($SQG);
	while ($mRG = mysql_fetch_array($RsG, MYSQL_BOTH))
	{
		$SW="INSERT INTO ta_kib_post_108_mutasi SET 
		Referensi='".$RfA."',
		Referensi_To='".$NewRefKIB."',
		Ref_Group='".$mRG['Ref_Group']."',
		Ref_Usulan='".$RfU."',
		Ref_History='".$RfA."',
		Ref_Usulan_His='".$mRG['Ref_Usulan']."',
		Kd_UPB='".$mRG['Kd_UPB']."',
		Kd_UPB_To='".$mRG['Kd_UPB']."',
		Kd_Aset='".$mRG['Kd_Aset']."',
		Kd_Aset_To='-',
		Kd_Aset_108='".$mRG['Kd_Aset_108']."',
		Kd_Aset_108_To='".$gRin."',
		No_Register='".$mRG['No_Register']."',
		Crit='".$mRG['Crit']."',
		Tanggal='".$mRG['Tanggal']."',
		Tgl_Mutasi='".$TglMts."',
		Tgl_Mutasi_Masuk='".$mRG['Tgl_Mutasi']."',
		Jns_Mutasi='HB',
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
		#echo $SW."<br>";
	}
}

function mNewRefKIB_108($rF)
{
	$NewK = fGlobal("count_referensi","ta_kib_108_count_referensi","ref_crit",$rF,"=","","");
	if ($NewK==0)
	{
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","Referensi",$rF."%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","Referensi",$rF."%","LIKE","","");
		$NewC = fGlobal("IfNull(max(referensi),0)","ta_kib_108_merger_his","referensi",$rF."%","LIKE","","");
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		$NewC = (int)substr($NewC,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		if ($NewC > $NewK){$NewK = $NewC;}
	}
	
	$NewK = $NewK + 1;
	
	$SQ="UPDATE ta_kib_108_count_referensi SET count_referensi='".$NewK."' WHERE ref_crit='".$rF."'";
	mysql_query($SQ);
	
	$NewR = $rF.".".fMakeReferensi($NewK,11);
	return $NewR;
}


function mNewRegAset_108($gRin,$gUpb)
{
	$LastReG = fGlobal("IfNull(max(No_Register),0)","ta_kib_108","Kd_Aset_108:Kd_Upb",$gRin.":".$gUpb,"=:=","","");
	$LastReG = ((int)$LastReG) + 1;
	$LastReG = fMakeRegister($LastReG,7);
	return $LastReG;
}

function InsertKib_Mutasi_108($frUPB,$RfA,$RfU,$NewRefKIB,$TglMts,$gRin,$UID)
{
	$SQ = "SELECT * FROM ta_kib_108 WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%'";
	$Rs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($Rs, MYSQL_BOTH))
	{
		$gUpb = $mRo['Kd_UPB'];
	
		$SQG = "INSERT INTO ta_kib_108_mutasi SET 
		Referensi='".$RfA."',
		Ref_Usulan='".$RfU."',
		Referensi_To='".$NewRefKIB."',
		Ref_Group='".$mRo['Ref_Group']."',
		Kd_UPB='".$mRo['Kd_UPB']."',
		Kd_UPB_To='".$mRo['Kd_UPB']."',
		Kd_Aset='".$mRo['Kd_Aset']."',
		Kd_Aset_To='',
		Kd_Aset_108='".$mRo['Kd_Aset_108']."',
		Kd_Aset_108_To='".$gRin."',
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
		Jns_Mutasi='HB',
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
		$RsG = mysql_query($SQG);
	}
}

function UpdateKib_108($frUPB,$RfA,$RfU,$NewRefKIB,$NewReGAset,$TglMts,$gRin,$eRuH,$UID)
{
	#No_Register='".$NewReGAset."',
	$SQU = "UPDATE ta_kib_108 SET 
	Referensi='".$NewRefKIB."', 
	Ref_Usulan='".$RfU."',
	Ref_Usulan_His='".$eRuH."',
	Ref_History='".$RfA."',
	Kd_Aset_108='".$gRin."',
	Tgl_Mutasi='".$TglMts."',
	Recorded=now(),
	Pencatat='".$UID.":exe' 
	WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%'";
	$RsU = mysql_query($SQU);
	#echo $SQU."<br>";
}

function UpdatePos_108($frUPB,$RfA,$RfU,$NewRefKIB,$NewReGAset,$TglMts,$gRin,$eRuH,$UID)
{
	#No_Register='".$NewReGAset."',
	$SQU = "UPDATE ta_kib_post_108 SET 
	Referensi='".$NewRefKIB."', 
	Ref_Usulan='".$RfU."',
	Ref_Usulan_His='".$RuH."',
	Ref_History='".$RfA."',
	Kd_Aset_108='".$gRin."',
	Tgl_Mutasi='".$TglMts."',
	Recorded=now(),
	Pencatat='".$UID.":exe' 
	WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%'";
	$RsU = mysql_query($SQU);
	
	#No_Register='".$NewReGAset."',
	$SQU = "UPDATE ta_kib_post_penyusutan_108 SET 
	Referensi='".$NewRefKIB."', 
	Ref_History='".$RfA."',
	Kd_Aset_108='".$gRin."' 
	WHERE Referensi='".$RfA."' AND Kd_UPB LIKE '".$frUPB."%'";
	$RsU = mysql_query($SQU);
}

function UpdateUsulanVerRci($tID,$gRin,$Sudah,$UID)
{
	$SQU = "UPDATE ta_usulan_verifikasi_rinci_108 SET Eksekusi='".$Sudah."', To_Kd_Aset='".$gRin."', Pencatat='".$UID.":exe', Recorded=now() WHERE IDT='".$tID."'";
	$RsU = mysql_query($SQU);
}

?>