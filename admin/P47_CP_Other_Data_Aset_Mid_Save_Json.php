<?php
require "Connection.php";
require "FileFunction.php";
require('CheckLogin.php');

$data = array();
extract($_POST);

/*
$TgL = explode('/',$TgL);
$TgL = $TgL[2]."-".$TgL[1]."-".$TgL[0];

$TgBA = explode('/',$TgBA);
$TgBA = $TgBA[2]."-".$TgBA[1]."-".$TgBA[0];

$DokPTg = explode('/',$DokPTg);
$DokPTg = $DokPTg[2]."-".$DokPTg[1]."-".$DokPTg[0];

$HrGT = 0;
if ($JmLB!='' && $HrGB!='')
{
	$HrGT = fConvertToNumeric($JmLB) * fConvertToNumeric($HrGB);
}
*/
if ($SrTgl==''){$SrTgl="0000-00-00";}
if ($DoTgl==''){$DoTgl="0000-00-00";}

$dReK7 = fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$ReK7,"=","","");
if ($IdTA=='')
{
	$RefNON = fGlobal("Referensi","ta_penerimaan_non_apbd","IDT",$IdT,"=","","");
	
	$SQ = "INSERT INTO ta_kib_108_temp SET 
	Tanggal=now(), 
	No_Pengadaan='".$RefNON."', 
	Referensi='".$RefNON."-001', 
	Kd_UPB='".$UpB."',
	Kd_Aset_108='".$ReK7."',
	Nm_Aset_108='".$dReK7."',
	
	Nm_Aset_108_Spesifikasi='".$NmaSP."',
	No_Register='".$NoRG."',
	Merk='".$Merk."',
	Type='".$Type."',
	Nomor_Pabrik='".$NoPB."',
	Nomor_Rangka='".$NoRK."',
	Nomor_Mesin='".$NoMS."',
	Nomor_Polisi='".$NoPL."',
	Nomor_BPKB='".$NoBP."',
	Alamat='".$Alam."',
	Judul='".$Judu."',
	Pencipta='".$Cipt."',
	Spesifikasi='".$Spes."',
	Bahan='".$Baha."',
	Tahun='".$Tahu."',
	Bertingkat='".$B1T."',
	Beton='".$B1B."',
	Panjang='".$Panj."',
	Lebar='".$Leba."',
	Luas='".$Luas."',
	Luas_Lantai='".$LuasL."',
	Sertifikat='".$B1C."',
	Sertifikat_Nomor='".$SrNom."',
	Sertifikat_Tanggal='".$SrTgl."',
	Dokumen_Tanggal='".$DoTgl."',
	Dokumen_Nomor='".$DoNom."',
	Penggunaan='".$Guna."',
	Kode_Tanah='".$KdTnh."',
	Status_Tanah='".$StTnh."',
	Luas_Tanah='".$LuTnh."',
	Hak_Tanah='".$HkTnh."',
	Lokasi='".$LtTnh."',
	Batas_Utara='".$LtTnhU."',
	Batas_Selatan='".$LtTnhS."',
	Batas_Timur='".$LtTnhT."',
	Batas_Barat='".$LtTnhB."',
	Keterangan='".$Memo."',
	
	Recorded=now(),
	Pencatat='".$UID."'";
	$rs = mysql_query($SQ);
	
	$data['IdTA']= fGlobal("max(IDT)","ta_kib_108_temp","No_Pengadaan","%","LIKE","","");
	$data['IdT']  = $IdT;
	
	if ($rs) {$data['Mess'] = "Proses berhasil..!!";}
	else {$data['Mess'] = "Proses tidak berhasil..!!";}
}
else
{
	$SQ = "UPDATE ta_kib_108_temp SET 
	Kd_UPB='".$UpB."',
	Kd_Aset_108='".$ReK7."',
	Nm_Aset_108='".$dReK7."',
	
	Nm_Aset_108_Spesifikasi='".$NmaSP."',
	No_Register='".$NoRG."',
	Merk='".$Merk."',
	Type='".$Type."',
	Nomor_Pabrik='".$NoPB."',
	Nomor_Rangka='".$NoRK."',
	Nomor_Mesin='".$NoMS."',
	Nomor_Polisi='".$NoPL."',
	Nomor_BPKB='".$NoBP."',
	Alamat='".$Alam."',
	Judul='".$Judu."',
	Pencipta='".$Cipt."',
	Spesifikasi='".$Spes."',
	Bahan='".$Baha."',
	Tahun='".$Tahu."',
	Bertingkat='".$B1T."',
	Beton='".$B1B."',
	Panjang='".$Panj."',
	Lebar='".$Leba."',
	Luas='".$Luas."',
	Luas_Lantai='".$LuasL."',
	Sertifikat='".$B1C."',
	Sertifikat_Nomor='".$SrNom."',
	Sertifikat_Tanggal='".$SrTgl."',
	Dokumen_Tanggal='".$DoTgl."',
	Dokumen_Nomor='".$DoNom."',
	Penggunaan='".$Guna."',
	Kode_Tanah='".$KdTnh."',
	Status_Tanah='".$StTnh."',
	Luas_Tanah='".$LuTnh."',
	Hak_Tanah='".$HkTnh."',
	Lokasi='".$LtTnh."',
	Batas_Utara='".$LtTnhU."',
	Batas_Selatan='".$LtTnhS."',
	Batas_Timur='".$LtTnhT."',
	Batas_Barat='".$LtTnhB."',
	Keterangan='".$Memo."',
	
	Recorded=now(),
	Pencatat='".$UID."' WHERE IDT='".$IdTA."'";
	$rs = mysql_query($SQ);

	$data['IdTA'] = $IdTA;
	$data['IdT']  = $IdT;
	
	if ($rs) 
	{
		$data['Mess'] = "Update berhasil..!!";
	}
	else {
		$data['Mess'] = "Update tidak berhasil..!!";
	}
}

$ReK5 = substr($ReK7,0,5);
$LRef = "XXX";
if ($ReK5=='1.3.1'){$LRef = "TNH";}
if ($ReK5=='1.3.2'){$LRef = "ALT";}
if ($ReK5=='1.3.3'){$LRef = "BNG";}
if ($ReK5=='1.3.4'){$LRef = "JLN";}
if ($ReK5=='1.3.5'){$LRef = "ATL";}
if ($ReK5=='1.3.6'){$LRef = "KDP";}
if ($ReK5=='1.5.2'){$LRef = "KMT";}
if ($ReK5=='1.5.3'){$LRef = "ATB";}

#$data['Mess'] = $UpB." : ".$ReK7;

echo json_encode($data);
?>
