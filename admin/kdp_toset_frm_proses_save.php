<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

if ($IdT!='')
{
	#Nama Aset baru
	$fNmA = str_replace('**',' ',$fNmA);
	
	#REFERENSI
	$nTGL = fGlobalNEW("Tanggal","ta_kib_kdptoaset","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
	$nREf = fGlobalNEW("Referensi","ta_kib_kdptoaset","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
	$nREK = fGlobalNEW("Kd_REK","ta_kib_kdptoaset","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
	if ($nREK=='1.3.6.01.01.01.001'){$NewRF = "TNH";}
	if ($nREK=='1.3.6.01.01.01.002'){$NewRF = "ALT";}
	if ($nREK=='1.3.6.01.01.01.003'){$NewRF = "BNG";}
	if ($nREK=='1.3.6.01.01.01.004'){$NewRF = "JLN";}
	if ($nREK=='1.3.6.01.01.01.005'){$NewRF = "ATL";}
	
	#$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","Referensi",$NewRF."%","LIKE","","");
	#$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","Referensi",$NewRF."%","LIKE","","");
	#$NewC = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_merger_his","Referensi",$NewRF."%","LIKE","","");
	
	#$NewK = (int)substr($NewK,-11,11);
	#$NewB = (int)substr($NewB,-11,11);
	#$NewC = (int)substr($NewC,-11,11);
	#if ($NewB > $NewK){$NewK = $NewB;}
	#if ($NewC > $NewK){$NewK = $NewC;}
	#$NewK = $NewK + 1;
	
	#*************
	$NewK = fGlobal("count_referensi","ta_kib_108_count_referensi","ref_crit",$NewRF,"=","","");
	if ($NewK==0)
	{
		$NewK = fGlobal("IfNull(max(referensi),0)","ta_kib_108","referensi",$NewRF."%","LIKE","","");
		$NewB = fGlobal("IfNull(max(referensi),0)","ta_kib_108_mutasi","referensi",$NewRF."%","LIKE","","");
		$NewC = fGlobal("IfNull(max(referensi),0)","ta_kib_108_merger_his","referensi",$NewRF."%","LIKE","","");
		
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
			$NewC = (int)substr($NewC,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		if ($NewC > $NewK){$NewK = $NewC;}
	}
		
	$NewK = $NewK + 1;

	$SQ="UPDATE ta_kib_108_count_referensi SET count_referensi='".$NewK."' WHERE ref_crit='".$NewRF."'";
	mysql_query($SQ);
	#*************
	
	$NewRefKIB = $NewRF.".".fMakeReferensi($NewK,11);
	
	#REGISTER
	$NewRegist = MakeNewNoRegiterAuto('','');
	
	#INDUK
	$nSQ = "SELECT Ref_Aset, Kd_UPB FROM ta_kib_kdptoaset_data WHERE Referensi='".$nREf."' AND Induk='Y'";
	$nRs = mysql_query($nSQ); 
	$mRo = mysql_fetch_array($nRs);
	$ReA = $mRo[0];
	$UpB = $mRo[1];
	
	if ($ReA)
	{
		$SQ = "SELECT Ref_Mutasi,Kd_UPB,No_Pengadaan,Nm_Aset,Kd_Pemilik,Tgl_Perolehan,Tgl_Mutasi,
		Tgl_Mulai,Tahun,Luas_M2,Alamat,Hak_Tanah,Sertifikat,Sertifikat_Tanggal,Sertifikat_Nomor,Penggunaan,
		Asal_Usul,Harga,No_SP2D,Merk,Type,Ukuran_CC,Bahan,Nomor_Pabrik,Nomor_Rangka,Nomor_Mesin,Nomor_Polisi,Nomor_Polisi_Lama,
		Nomor_BPKB,Pemegang,Pemegang_Lama,Kondisi,Bertingkat,Beton,Luas_Lantai,Lokasi,Dokumen_Tanggal,Dokumen_Nomor,Status_Tanah,
		Luas_Tanah,Kode_Tanah,Konstruksi,Panjang,Lebar,Luas,Judul,Spesifikasi,Pencipta,Daerah_Asal,Jenis,Tipe_Bangunan,Ukuran,Keterangan 
		FROM ta_kib_108 WHERE Referensi='".$ReA."' AND Kd_UPB='".$UpB."'";
		$rs = mysql_query($SQ);
		while ($mR = mysql_fetch_array($rs))
		{
			$mRMM = fGlobalNEW("Ms_Manfaat","ref_rek_aset108_7","Kd_Aset",$tSu2,"=","",DatabaseSB,$ConSB,"");						#masa manfaat
			$mRNI = fGlobalNEW("IfNull(sum(Nilai),0)","ta_kib_kdptoaset_data_post","Referensi",$nREf,"=","",DatabaseSB,$ConSB,"");	#nilai akhir
			
			#Nm_Aset='".mysql_real_escape_string($mR['Nm_Aset'])."',
			$SW="INSERT INTO ta_kib_108 SET 
			Referensi='".$NewRefKIB."',
			No_Register='".$NewRegist."',
			Kd_Aset_108='".$tSu2."',
			Ref_KdpToAset='".$nREf."',
			
			Ref_Mutasi='".$mR['Ref_Mutasi']."',
			Kd_UPB='".$mR['Kd_UPB']."',
			No_Pengadaan='".mysql_real_escape_string($mR['No_Pengadaan'])."',
			
			Nm_Aset='".mysql_real_escape_string($fNmA)."',
			
			Kd_Pemilik='".$mR['Kd_Pemilik']."',
			Tgl_Perolehan='".$nTGL."',
			Tgl_Mutasi='".$mR['Tgl_Mutasi']."',
			Tgl_Mulai='".$mR['Tgl_Mulai']."',
			Tahun='".$mR['Tahun']."',
			Luas_M2='".$mR['Luas_M2']."',
			Alamat='".mysql_real_escape_string($mR['Alamat'])."',
			Hak_Tanah='".$mR['Hak_Tanah']."',
			Sertifikat='".mysql_real_escape_string($mR['Sertifikat'])."',
			Sertifikat_Tanggal='".$mR['Sertifikat_Tanggal']."',
			Sertifikat_Nomor='".mysql_real_escape_string($mR['Sertifikat_Nomor'])."',
			Penggunaan='".mysql_real_escape_string($mR['Penggunaan'])."',
			Asal_Usul='".mysql_real_escape_string($mR['Asal_Usul'])."',
			Harga='".$mRNI."',
			No_SP2D='".mysql_real_escape_string($mR['No_SP2D'])."',
			Merk='".mysql_real_escape_string($mR['Merk'])."',
			Type='".mysql_real_escape_string($mR['Type'])."',
			Ukuran_CC='".mysql_real_escape_string($mR['Ukuran_CC'])."',
			Bahan='".mysql_real_escape_string($mR['Bahan'])."',
			Nomor_Pabrik='".mysql_real_escape_string($mR['Nomor_Pabrik'])."',
			Nomor_Rangka='".mysql_real_escape_string($mR['Nomor_Rangka'])."',
			Nomor_Mesin='".mysql_real_escape_string($mR['Nomor_Mesin'])."',
			Nomor_Polisi='".mysql_real_escape_string($mR['Nomor_Polisi'])."',
			Nomor_Polisi_Lama='".mysql_real_escape_string($mR['Nomor_Polisi_Lama'])."',
			Nomor_BPKB='".mysql_real_escape_string($mR['Nomor_BPKB'])."',
			Pemegang='".mysql_real_escape_string($mR['Pemegang'])."',
			Pemegang_Lama='".mysql_real_escape_string($mR['Pemegang_Lama'])."',
			Kondisi='B',
			Masa_Manfaat='".$mRMM."',
			Nilai_Akhir='".$mRNI."',
			Bertingkat='".$mR['Bertingkat']."',
			Beton='".$mR['Beton']."',
			Luas_Lantai='".mysql_real_escape_string($mR['Luas_Lantai'])."',
			Lokasi='".mysql_real_escape_string($mR['Lokasi'])."',
			Dokumen_Tanggal='".$mR['Dokumen_Tanggal']."',
			Dokumen_Nomor='".mysql_real_escape_string($mR['Dokumen_Nomor'])."',
			Status_Tanah='".$mR['Status_Tanah']."',
			Luas_Tanah='".$mR['Luas_Tanah']."',
			Kode_Tanah='".$mR['Kode_Tanah']."',
			Konstruksi='".$mR['Konstruksi']."',
			Panjang='".mysql_real_escape_string($mR['Panjang'])."',
			Lebar='".mysql_real_escape_string($mR['Lebar'])."',
			Luas='".mysql_real_escape_string($mR['Luas'])."',
			Judul='".mysql_real_escape_string($mR['Judul'])."',
			Spesifikasi='".mysql_real_escape_string($mR['Spesifikasi'])."',
			Pencipta='".mysql_real_escape_string($mR['Pencipta'])."',
			Daerah_Asal='".mysql_real_escape_string($mR['Daerah_Asal'])."',
			Jenis='".mysql_real_escape_string($mR['Jenis'])."',
			Tipe_Bangunan='".mysql_real_escape_string($mR['Tipe_Bangunan'])."',
			Ukuran='".mysql_real_escape_string($mR['Ukuran'])."',
			Keterangan='".mysql_real_escape_string($mR['Keterangan'])."',
			Recorded=now(),
			Pencatat='".$UID."'";
			$rw = mysql_query($SW);
			
			#POSTING
			$mKET = $mR['Keterangan'];
			
			$SW = "INSERT INTO ta_kib_post_108 SET 
			Referensi='".$NewRefKIB."',
			No_Register='".$NewRegist."',
			Kd_Aset_108='".$tSu2."',
			Ref_KdpToAset='".$nREf."',
			
			Ref_Mutasi='".$mR['Ref_Mutasi']."',
			Kd_UPB='".$mR['Kd_UPB']."',
			Crit='SLD',
			Tanggal='".$nTGL."',
			Tgl_Mutasi='".$mR['Tgl_Mutasi']."',
			Uraian='Saldo awal (nilai perolehan)',
			DK='D',
			Debet='".$mRNI."',
			Kredit='0',
			No_Pengadaan='-',
			Ref_Temp='',
			Keterangan='".mysql_real_escape_string($mKET)."'";
			$rw = mysql_query($SW);
		}
	}
	
	$nSQ = "SELECT Ref_Aset, Kd_UPB FROM ta_kib_kdptoaset_data WHERE Referensi='".$nREf."'";
	$nRs = mysql_query($nSQ); 
	while ($mRo = mysql_fetch_array($nRs))
	{
		$SQ = "UPDATE ta_kib_108 SET KdpToAset='Y' WHERE Referensi='".$mRo[0]."' AND Kd_UPB='".$mRo[1]."'";
		$rs = mysql_query($SQ);
		
		$SQ = "UPDATE ta_kib_post_108 SET KdpToAset='Y' WHERE Referensi='".$mRo[0]."' AND Kd_UPB='".$mRo[1]."'";
		$rs = mysql_query($SQ);
	}
	
	$nSu2 = fGlobalNEW("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$tSu2,"=","",DatabaseSB,$ConSB,"");
	$SQ = "UPDATE ta_kib_kdptoaset SET 
	KeRekening='".$tSu2."', 
	KeRekeningNma='".$nSu2."', 
	KeReferensi='".$NewRefKIB."', 
	KeRegister='".$NewRegist."',
	ExePencatat='".$UID."', 
	Execute='Y',
	ExeRecorded=now() WHERE IDT='".$IdT."'";
	$rs = mysql_query($SQ);
}

	

?>

<script language="javascript">
	alert('Proses KDP to Aset berhasil..!!');
	prosToAset('refr','<?=$IdT?>','<?=$CrDiv?>','<?=$IdL?>');
</script>