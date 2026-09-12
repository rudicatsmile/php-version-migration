<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

//echo $CrT.":".$TbS.":".$TbT.":".$PgE.":".$tID.":".$IdT.":".$IdL;
//echo $CrT;
//return false;

$gDT = fGlobal("ref_aset:ref_usulan:kd_aset:kd_upb:to_upb","ta_usulan_verifikasi_rinci","IDT",$tID,"=","","");
if ($gDT){
	$gDT = explode(":",$gDT);
	$RfA = $gDT[0];
	$RfU = $gDT[1];
	$KdA = $gDT[2];
	$UpB = $gDT[3];
	$UpT = $gDT[4];
	
	if ($UpT==""){$UpT=$UpB;}
	$JnS = fGlobal("Jenis","ta_usulan","Referensi",$RfU,"=","","");
}

function mNewRegAset($ToAsT,$gUpb,$ToKiB)
{
	$TbT = fNmHuruf((int)$ToKiB);
	$LastReG = fGlobal("IfNull(max(No_Register),0)","ta_kib_".$TbT,"Kd_Aset:Kd_Upb",$ToAsT.":".$gUpb,"=:=","","");
	$LastReG = ((int)$LastReG) + 1;
	$LastReG = fMakeRegister($LastReG,7);
	return $LastReG;
}

if ($CrT=="ta_kib_:tujuan"){
	#cari data sumber
	
	$NewReG = fGlobal("No_Register","ta_kib_post","ref_mutasi:ref_usulan",$RfA.":".$RfU,"=:=","","");
		
	$gDT = fGlobal("IDT","ta_kib_".$TbS."_mutasi","referensi:ref_usulan",$RfA.":".$RfU,"=:=","","");
	if ($gDT){
		$SQL="SELECT * FROM ta_kib_".$TbS."_mutasi where IDT='".$gDT."'";
		$Rs = mysql_query($SQL);
		while ($mRo = mysql_fetch_array($Rs, MYSQL_BOTH))
		{
			$ToAsT  = $mRo['Kd_Aset_To'];
			$gUpb   = $mRo['Kd_UPB_To'];
			$ToKiB  = substr($mRo['Kd_Aset_To'],0,2);
			
			if ($NewReG=="" && $ToAsT!=""){
				$NewReG = mNewRegAset($ToAsT,$gUpb,$ToKiB);
			}
			
			if ($TbS=="a")
			{
				$AddFL = "Luas_M2='".$mRo['Luas_M2']."',";
				$AddFL.= "Alamat='".mysql_real_escape_string($mRo['Alamat'])."',";
				$AddFL.= "Hak_Tanah='".$mRo['Hak_Tanah']."',";
				$AddFL.= "Sertifikat='".$mRo['Sertifikat']."',";
				$AddFL.= "Sertifikat_Tanggal='".$mRo['Sertifikat_Tanggal']."',";
				$AddFL.= "Sertifikat_Nomor='".$mRo['Sertifikat_Nomor']."',";
				$AddFL.= "Penggunaan='".mysql_real_escape_string($mRo['Penggunaan'])."',";
			}
			if ($TbS=="b")
			{
				$AddFL = "Merk='".mysql_real_escape_string($mRo['Merk'])."',";
				$AddFL.= "Type='".mysql_real_escape_string($mRo['Type'])."',";
				$AddFL.= "Ukuran_CC='".mysql_real_escape_string($mRo['Ukuran_CC'])."',";
				$AddFL.= "Bahan='".mysql_real_escape_string($mRo['Bahan'])."',";
				$AddFL.= "Nomor_Pabrik='".mysql_real_escape_string($mRo['Nomor_Pabrik'])."',";
				$AddFL.= "Nomor_Rangka='".mysql_real_escape_string($mRo['Nomor_Rangka'])."',";
				$AddFL.= "Nomor_Mesin='".mysql_real_escape_string($mRo['Nomor_Mesin'])."',";
				$AddFL.= "Nomor_Polisi='".mysql_real_escape_string($mRo['Nomor_Polisi'])."',";
				$AddFL.= "Nomor_BPKB='".mysql_real_escape_string($mRo['Nomor_BPKB'])."',";
			}
			if ($TbS=="c")
			{
				$AddFL = "Bertingkat='".$mRo['Bertingkat']."',";
				$AddFL.= "Beton='".$mRo['Beton']."',";
				$AddFL.= "Luas_Lantai='".$mRo['Luas_Lantai']."',";
				$AddFL.= "Lokasi='".$mRo['Lokasi']."',";
				$AddFL.= "Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',";
				$AddFL.= "Dokumen_Nomor='".$mRo['Dokumen_Nomor']."',";
				$AddFL.= "Status_Tanah='".$mRo['Status_Tanah']."',";
				$AddFL.= "Kode_Tanah='".$mRo['Kode_Tanah']."',";
			}
			if ($TbS=="d")
			{
				$AddFL = "Konstruksi='".$mRo['Konstruksi']."',";
				$AddFL.= "Panjang='".$mRo['Panjang']."',";
				$AddFL.= "Lebar='".$mRo['Lebar']."',";
				$AddFL.= "Luas='".$mRo['Luas']."',";
				$AddFL.= "Lokasi='".$mRo['Lokasi']."',";
				$AddFL.= "Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',";
				$AddFL.= "Dokumen_Nomor='".$mRo['Dokumen_Nomor']."',";
				$AddFL.= "Status_Tanah='".$mRo['Status_Tanah']."',";
				$AddFL.= "Kode_Tanah='".$mRo['Kode_Tanah']."',";
			}
			if ($TbS=="e")
			{
				$AddFL = "Judul='".$mRo['Judul']."',";
				$AddFL.= "Spesifikasi='".$mRo['Spesifikasi']."',";
				$AddFL.= "Pencipta='".$mRo['Pencipta']."',";
				$AddFL.= "Daerah_Asal='".$mRo['Daerah_Asal']."',";
				$AddFL.= "Bahan='".$mRo['Bahan']."',";
				$AddFL.= "Jenis='".$mRo['Jenis']."',";
				$AddFL.= "Ukuran='".$mRo['Ukuran']."',";
			}
			if ($TbS=="g" && $TbT=="g")
			{
				$AddFL = "Luas_M2='".$mRo['Luas_M2']."',";
				$AddFL.= "Alamat='".mysql_real_escape_string($mRo['Alamat'])."',";
				$AddFL.= "Hak_Tanah='".$mRo['Hak_Tanah']."',";
				$AddFL.= "Sertifikat='".$mRo['Sertifikat']."',";
				$AddFL.= "Sertifikat_Tanggal='".$mRo['Sertifikat_Tanggal']."',";
				$AddFL.= "Sertifikat_Nomor='".$mRo['Sertifikat_Nomor']."',";
				$AddFL.= "Penggunaan='".mysql_real_escape_string($mRo['Penggunaan'])."',";
			
				$AddFL.= "Merk='".mysql_real_escape_string($mRo['Merk'])."',";
				$AddFL.= "Type='".mysql_real_escape_string($mRo['Type'])."',";
				$AddFL.= "Ukuran_CC='".mysql_real_escape_string($mRo['Ukuran_CC'])."',";
				$AddFL.= "Bahan='".mysql_real_escape_string($mRo['Bahan'])."',";
				$AddFL.= "Nomor_Pabrik='".mysql_real_escape_string($mRo['Nomor_Pabrik'])."',";
				$AddFL.= "Nomor_Rangka='".mysql_real_escape_string($mRo['Nomor_Rangka'])."',";
				$AddFL.= "Nomor_Mesin='".mysql_real_escape_string($mRo['Nomor_Mesin'])."',";
				$AddFL.= "Nomor_Polisi='".mysql_real_escape_string($mRo['Nomor_Polisi'])."',";
				$AddFL.= "Nomor_BPKB='".mysql_real_escape_string($mRo['Nomor_BPKB'])."',";
				
				$AddFL.= "Bertingkat='".$mRo['Bertingkat']."',";
				$AddFL.= "Beton='".$mRo['Beton']."',";
				$AddFL.= "Luas_Lantai='".$mRo['Luas_Lantai']."',";
				$AddFL.= "Lokasi='".$mRo['Lokasi']."',";
				$AddFL.= "Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',";
				$AddFL.= "Dokumen_Nomor='".$mRo['Dokumen_Nomor']."',";
				$AddFL.= "Status_Tanah='".$mRo['Status_Tanah']."',";
				$AddFL.= "Kode_Tanah='".$mRo['Kode_Tanah']."',";
				
				$AddFL.= "Konstruksi='".$mRo['Konstruksi']."',";
				$AddFL.= "Panjang='".$mRo['Panjang']."',";
				$AddFL.= "Lebar='".$mRo['Lebar']."',";
				$AddFL.= "Luas='".$mRo['Luas']."',";
				$AddFL.= "Lokasi='".$mRo['Lokasi']."',";
				$AddFL.= "Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',";
				$AddFL.= "Dokumen_Nomor='".$mRo['Dokumen_Nomor']."',";
				$AddFL.= "Status_Tanah='".$mRo['Status_Tanah']."',";
				$AddFL.= "Kode_Tanah='".$mRo['Kode_Tanah']."',";
				
				$AddFL.= "Judul='".$mRo['Judul']."',";
				$AddFL.= "Spesifikasi='".$mRo['Spesifikasi']."',";
				$AddFL.= "Pencipta='".$mRo['Pencipta']."',";
				$AddFL.= "Daerah_Asal='".$mRo['Daerah_Asal']."',";
				$AddFL.= "Bahan='".$mRo['Bahan']."',";
				$AddFL.= "Jenis='".$mRo['Jenis']."',";
				$AddFL.= "Ukuran='".$mRo['Ukuran']."',";
			}
			
			$SQG = "INSERT INTO ta_kib_".$TbT." SET 
			Referensi='".$mRo['Referensi_To']."',
			Ref_Group='',
			Ref_Mutasi='".$RfA."',
			Ref_Usulan='".$RfU."',
			Kd_Aset='".$mRo['Kd_Aset_To']."',
			No_Register='".$NewReG."',
			
			Kd_UPB='".$mRo['Kd_UPB_To']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$mRo['Tgl_Mutasi']."',
			
			$AddFL 
			
			Asal_Usul='".$mRo['Asal_Usul']."',
			Harga='".$mRo['Harga']."',
			Keterangan='".mysql_real_escape_string($mRo['Keterangan'])."',
			No_SP2D='".$mRo['No_SP2D']."',
			Post='".$mRo['Post']."',
			Status='".$mRo['Status']."',
			Recorded=now(),
			Pencatat='".$UID.":repair',
			extracom='".$mRo['extracom']."'";
			
			$RsG = mysql_query($SQG);
			if (!$RsG){
				#echo $SQG;
				echo "Error..!!";
				return false;
			}
		}
	}
}

if ($CrT=="ta_kib_mutasi"){
	#cari data sumber
	$gDT = fGlobal("IDT","ta_kib_".$TbT,"ref_mutasi:ref_usulan",$RfA.":".$RfU,"=:=","","");
	if ($gDT){
		$SQL="SELECT * FROM ta_kib_".$TbT." where IDT='".$gDT."'";
		$Rs = mysql_query($SQL);
		while ($mRo = mysql_fetch_array($Rs, MYSQL_BOTH))
		{
			if ($TbS=="a")
			{
				$AddFL = "Luas_M2='".$mRo['Luas_M2']."',";
				$AddFL.= "Alamat='".mysql_real_escape_string($mRo['Alamat'])."',";
				$AddFL.= "Hak_Tanah='".$mRo['Hak_Tanah']."',";
				$AddFL.= "Sertifikat='".$mRo['Sertifikat']."',";
				$AddFL.= "Sertifikat_Tanggal='".$mRo['Sertifikat_Tanggal']."',";
				$AddFL.= "Sertifikat_Nomor='".$mRo['Sertifikat_Nomor']."',";
				$AddFL.= "Penggunaan='".mysql_real_escape_string($mRo['Penggunaan'])."',";
			}
			if ($TbS=="b")
			{
				$AddFL = "Merk='".mysql_real_escape_string($mRo['Merk'])."',";
				$AddFL.= "Type='".mysql_real_escape_string($mRo['Type'])."',";
				$AddFL.= "Ukuran_CC='".mysql_real_escape_string($mRo['Ukuran_CC'])."',";
				$AddFL.= "Bahan='".mysql_real_escape_string($mRo['Bahan'])."',";
				$AddFL.= "Nomor_Pabrik='".mysql_real_escape_string($mRo['Nomor_Pabrik'])."',";
				$AddFL.= "Nomor_Rangka='".mysql_real_escape_string($mRo['Nomor_Rangka'])."',";
				$AddFL.= "Nomor_Mesin='".mysql_real_escape_string($mRo['Nomor_Mesin'])."',";
				$AddFL.= "Nomor_Polisi='".mysql_real_escape_string($mRo['Nomor_Polisi'])."',";
				$AddFL.= "Nomor_BPKB='".mysql_real_escape_string($mRo['Nomor_BPKB'])."',";
			}
			if ($TbS=="c")
			{
				$AddFL = "Bertingkat='".$mRo['Bertingkat']."',";
				$AddFL.= "Beton='".$mRo['Beton']."',";
				$AddFL.= "Luas_Lantai='".$mRo['Luas_Lantai']."',";
				$AddFL.= "Lokasi='".$mRo['Lokasi']."',";
				$AddFL.= "Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',";
				$AddFL.= "Dokumen_Nomor='".$mRo['Dokumen_Nomor']."',";
				$AddFL.= "Status_Tanah='".$mRo['Status_Tanah']."',";
				$AddFL.= "Kode_Tanah='".$mRo['Kode_Tanah']."',";
			}
			if ($TbS=="d")
			{
				$AddFL = "Konstruksi='".$mRo['Konstruksi']."',";
				$AddFL.= "Panjang='".$mRo['Panjang']."',";
				$AddFL.= "Lebar='".$mRo['Lebar']."',";
				$AddFL.= "Luas='".$mRo['Luas']."',";
				$AddFL.= "Lokasi='".$mRo['Lokasi']."',";
				$AddFL.= "Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',";
				$AddFL.= "Dokumen_Nomor='".$mRo['Dokumen_Nomor']."',";
				$AddFL.= "Status_Tanah='".$mRo['Status_Tanah']."',";
				$AddFL.= "Kode_Tanah='".$mRo['Kode_Tanah']."',";
			}
			if ($TbS=="e")
			{
				$AddFL = "Judul='".$mRo['Judul']."',";
				$AddFL.= "Spesifikasi='".$mRo['Spesifikasi']."',";
				$AddFL.= "Pencipta='".$mRo['Pencipta']."',";
				$AddFL.= "Daerah_Asal='".$mRo['Daerah_Asal']."',";
				$AddFL.= "Bahan='".$mRo['Bahan']."',";
				$AddFL.= "Jenis='".$mRo['Jenis']."',";
				$AddFL.= "Ukuran='".$mRo['Ukuran']."',";
			}
			if ($TbS=="g" && $TbT=="g")
			{
				$AddFL = "Luas_M2='".$mRo['Luas_M2']."',";
				$AddFL.= "Alamat='".mysql_real_escape_string($mRo['Alamat'])."',";
				$AddFL.= "Hak_Tanah='".$mRo['Hak_Tanah']."',";
				$AddFL.= "Sertifikat='".$mRo['Sertifikat']."',";
				$AddFL.= "Sertifikat_Tanggal='".$mRo['Sertifikat_Tanggal']."',";
				$AddFL.= "Sertifikat_Nomor='".$mRo['Sertifikat_Nomor']."',";
				$AddFL.= "Penggunaan='".mysql_real_escape_string($mRo['Penggunaan'])."',";
			
				$AddFL.= "Merk='".mysql_real_escape_string($mRo['Merk'])."',";
				$AddFL.= "Type='".mysql_real_escape_string($mRo['Type'])."',";
				$AddFL.= "Ukuran_CC='".mysql_real_escape_string($mRo['Ukuran_CC'])."',";
				$AddFL.= "Bahan='".mysql_real_escape_string($mRo['Bahan'])."',";
				$AddFL.= "Nomor_Pabrik='".mysql_real_escape_string($mRo['Nomor_Pabrik'])."',";
				$AddFL.= "Nomor_Rangka='".mysql_real_escape_string($mRo['Nomor_Rangka'])."',";
				$AddFL.= "Nomor_Mesin='".mysql_real_escape_string($mRo['Nomor_Mesin'])."',";
				$AddFL.= "Nomor_Polisi='".mysql_real_escape_string($mRo['Nomor_Polisi'])."',";
				$AddFL.= "Nomor_BPKB='".mysql_real_escape_string($mRo['Nomor_BPKB'])."',";
				
				$AddFL.= "Bertingkat='".$mRo['Bertingkat']."',";
				$AddFL.= "Beton='".$mRo['Beton']."',";
				$AddFL.= "Luas_Lantai='".$mRo['Luas_Lantai']."',";
				$AddFL.= "Lokasi='".$mRo['Lokasi']."',";
				$AddFL.= "Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',";
				$AddFL.= "Dokumen_Nomor='".$mRo['Dokumen_Nomor']."',";
				$AddFL.= "Status_Tanah='".$mRo['Status_Tanah']."',";
				$AddFL.= "Kode_Tanah='".$mRo['Kode_Tanah']."',";
				
				$AddFL.= "Konstruksi='".$mRo['Konstruksi']."',";
				$AddFL.= "Panjang='".$mRo['Panjang']."',";
				$AddFL.= "Lebar='".$mRo['Lebar']."',";
				$AddFL.= "Luas='".$mRo['Luas']."',";
				$AddFL.= "Lokasi='".$mRo['Lokasi']."',";
				$AddFL.= "Dokumen_Tanggal='".$mRo['Dokumen_Tanggal']."',";
				$AddFL.= "Dokumen_Nomor='".$mRo['Dokumen_Nomor']."',";
				$AddFL.= "Status_Tanah='".$mRo['Status_Tanah']."',";
				$AddFL.= "Kode_Tanah='".$mRo['Kode_Tanah']."',";
				
				$AddFL.= "Judul='".$mRo['Judul']."',";
				$AddFL.= "Spesifikasi='".$mRo['Spesifikasi']."',";
				$AddFL.= "Pencipta='".$mRo['Pencipta']."',";
				$AddFL.= "Daerah_Asal='".$mRo['Daerah_Asal']."',";
				$AddFL.= "Bahan='".$mRo['Bahan']."',";
				$AddFL.= "Jenis='".$mRo['Jenis']."',";
				$AddFL.= "Ukuran='".$mRo['Ukuran']."',";
			}
			
			$SQG = "INSERT INTO ta_kib_".$TbS."_mutasi SET 
			Referensi='".$RfA."',
			Referensi_To='".$mRo['Referensi']."',
			Ref_Usulan='".$RfU."',
			Ref_Group='".$mRo['Ref_Group']."',
			Kd_UPB='".$UpB."',
			Kd_UPB_To='".$UpT."',
			Kd_Aset='".$KdA."',
			Kd_Aset_To='".$mRo['Kd_Aset']."',
			No_Register='".$mRo['No_Register']."',
			No_Pengadaan='".$mRo['No_Pengadaan']."',
			Ref_Temp='".$mRo['Ref_Temp']."',
			Nm_Aset='".$mRo['Nm_Aset']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$mRo['Tgl_Mutasi']."',
			Tgl_Mutasi_Masuk='0000-00-00',
			Jns_Mutasi='".$JnS."',
			$AddFL 
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
			Pencatat='".$UID.":repair',
			extracom='".$mRo['extracom']."'";
			
			$RsG = mysql_query($SQG);
			if (!$RsG){
				echo "Error..!!";
				return false;
			}
		}
	}
	else{
		echo "data master tidak ditemukan, di ta_kib_".$TbT;
		return false;
	}
}

if ($CrT=="ta_kib_post_mutasi"){
	#cari data sumber
	$gDT = fGlobal("IDT","ta_kib_post","ref_mutasi:ref_usulan",$RfA.":".$RfU,"=:=","","");
	if ($gDT){
		$SQL="SELECT * FROM ta_kib_post where IDT='".$gDT."'";
		$Rs = mysql_query($SQL);
		while ($mRG = mysql_fetch_array($Rs, MYSQL_BOTH))
		{
			$SW="INSERT INTO ta_kib_post_mutasi SET 
			Referensi='".$RfA."',
			Referensi_To='".$mRG['Referensi']."',
			Ref_Group='".$mRG['Ref_Group']."',
			Ref_Usulan='".$RfU."',
			Ref_History='".$RfA."',
			Kd_UPB='".$UpB."',
			Kd_UPB_To='".$UpT."',
			Kd_Aset='".$KdA."',
			Kd_Aset_To='".$mRG['Kd_Aset']."',
			No_Register='".$mRG['No_Register']."',
			Crit='".$mRG['Crit']."',
			Tanggal='".$mRG['Tanggal']."',
			Tgl_Mutasi='".$mRG['Tgl_Mutasi']."',
			Tgl_Mutasi_Masuk='0000-00-00',
			Jns_Mutasi='".$JnS."',
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
			IndexData='".$mRG['IndexData']."',
			extracom='".$mRG['extracom']."'";
			
			$rW = mysql_query($SW);
			if (!$rW){
				#echo $SW;
				echo "<br>Error..!!";
				return false;
			}
		}
	}
	else{
		echo "data master tidak ditemukan, di ta_kib_".$TbT;
		return false;
	}
}


if ($CrT=="ta_kib_post:tujuan"){
	#cari data sumber
	$NewReG = fGlobal("No_Register","ta_kib_".$TbT,"ref_mutasi:ref_usulan",$RfA.":".$RfU,"=:=","","");
	
	$gDT = fGlobal("IDT","ta_kib_post_mutasi","referensi:ref_usulan",$RfA.":".$RfU,"=:=","","");
	if ($gDT){
		$SQL="SELECT * FROM ta_kib_post_mutasi where IDT='".$gDT."'";
		$Rs = mysql_query($SQL);
		while ($mRG = mysql_fetch_array($Rs, MYSQL_BOTH))
		{
			$ToAsT  = $mRG['Kd_Aset_To'];
			$gUpb   = $mRG['Kd_UPB_To'];
			$ToKiB  = substr($mRG['Kd_Aset_To'],0,2);
			
			if ($NewReG=="" && $ToAsT!=""){
				$NewReG = mNewRegAset($ToAsT,$gUpb,$ToKiB);
			}
			
			$SW="INSERT INTO ta_kib_post SET 
			Referensi='".$mRG['Referensi_To']."',
			Ref_Group='".$mRG['Ref_Group']."',
			Ref_Usulan='".$RfU."',
			Ref_History='".$RfA."',
			Ref_Mutasi='".$RfA."',
			Kd_UPB='".$mRG['Kd_UPB_To']."',
			Kd_Aset='".$mRG['Kd_Aset_To']."',
			No_Register='".$NewReG."',
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
			Pencatat='".$UID.":repair',
			Tmbh_Ms_Manfaat='".$mRG['Tmbh_Ms_Manfaat']."',
			HasilMerger='".$mRG['HasilMerger']."',
			Mrg_Ref_History='".$mRG['Mrg_Ref_History']."',
			Mrg_Crit_History='".$mRG['Mrg_Crit_History']."',
			Mrg_Tmbh_Ms_Manfaat_History='".$mRG['Mrg_Tmbh_Ms_Manfaat_History']."',
			IndexData='".$mRG['IndexData']."',
			extracom='".$mRG['extracom']."'";
			
			$rW = mysql_query($SW);
			if (!$rW){
				#echo $SW;
				echo "<br>Error..!!";
				return false;
			}
		}
	}
	else{
		echo "data master tidak ditemukan, di ta_kib_".$TbS;
		return false;
	}
}

?>
<script languange="javascript">
	showEXEC_RefR('','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>');
</script>