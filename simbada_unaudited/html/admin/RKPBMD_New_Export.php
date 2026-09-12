<?
require "Connection.php";
require "FileFunction.php";
extract($_GET);

$nSQ = "SELECT Referensi, Kd_Unit, Tahun, Uraian FROM ta_rkpbmd_new WHERE Kd_Unit='$gUNT' AND Tahun='$gTHN' AND Apbd='0' ORDER BY IDT";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	#cekData
	$mRF = $mRo[0];
	$gUNT= $mRo[1];
	$gTHN= $mRo[2];
	$gUR = $mRo[3];
	
	$CeK = CekData($mRF,'1',DatabaseSB,$ConSB);
	
	//insertData
	if ($CeK=='')
	{
		copyData($mRF,$gUNT,$gTHN,$gUR);
		copyDataProgram($mRF,'0',$gUNT,$gTHN);
		copyDataKegiatan($mRF,'0',$gUNT,$gTHN);
		copyDataRekening($mRF,'0',$gUNT,$gTHN);
		$MsG = "Proses berhasil..!";
	}
	else{
		$MsG = "Data perubahan terdeteksi sudah ada..!";
	}
}

function copyDataProgram($mRF,$ApB,$gUNT,$gTHN)
{
	$SQ = "SELECT Referensi, Kd_Unit, Tahun, Kd_Program, Nm_Program 
	FROM ta_rkpbmd_new_program WHERE Referensi='$mRF' AND Kd_Unit='$gUNT' AND Tahun='$gTHN' AND Apbd='$ApB' ORDER BY IDT";
	$nR = mysql_query($SQ);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$SW = "INSERT INTO ta_rkpbmd_new_program SET 
		Referensi='".$mR[0]."',
		Kd_Unit='".$mR[1]."',
		Tahun='".$mR[2]."',
		Apbd='1',
		Kd_Program='".$mR[3]."',
		Nm_Program='".$mR[4]."',
		LinkMurni='Ya',
		Recorded=now(),
		Pencatat='expperubahan'";
		$nW = mysql_query($SW);
	}
}

function copyDataKegiatan($mRF,$ApB,$gUNT,$gTHN)
{
	$SQ = "SELECT Referensi, Kd_Unit, Tahun, Kd_Program, Kd_Kegiatan, Nm_Kegiatan, Output 
	FROM ta_rkpbmd_new_kegiatan WHERE Referensi='$mRF' AND Kd_Unit='$gUNT' AND Tahun='$gTHN' AND Apbd='$ApB' ORDER BY IDT";
	$nR = mysql_query($SQ);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$SW = "INSERT INTO ta_rkpbmd_new_kegiatan SET 
		Referensi='".$mR[0]."',
		Kd_Unit='".$mR[1]."',
		Tahun='".$mR[2]."',
		Apbd='1',
		Kd_program='".$mR[3]."',
		Kd_Kegiatan='".$mR[4]."',
		Nm_Kegiatan='".$mR[5]."',
		Output='".$mR[6]."',
		LinkMurni='Ya',
		Recorded=now(),
		Pencatat='expperubahan'";
		$nW = mysql_query($SW);
	}
}

function copyDataRekening($mRF,$ApB,$gUNT,$gTHN)
{
	$SQ = "SELECT Referensi as A0, 
	Kd_Unit as A1, 
	Tahun as A2, 
	Kd_Kegiatan as A3,
	Kd_Rekening as A4,
	Nm_Rekening as A5,
	Usulan_Jumlah as A6,
	Status_Barang as A7,
	Kondisi_Barang as A8,
	UsulanKebthan_Jumlah as A9,
	UsulanKebthan_Satuan as A10,
	Nama_Pemeliharaan as A11,
	Keterangan as A12 
	FROM ta_rkpbmd_new_rekening WHERE Referensi='$mRF' AND Kd_Unit='$gUNT' AND Tahun='$gTHN' AND Apbd='$ApB' ORDER BY IDT";
	$nR = mysql_query($SQ);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$SW = "INSERT INTO ta_rkpbmd_new_rekening SET 
		Referensi='".$mR[0]."',
		Kd_Unit='".$mR[1]."',
		Tahun='".$mR[2]."',
		Apbd='1',
		Kd_Kegiatan='".$mR[3]."',
		Kd_Rekening='".$mR[4]."',
		Nm_Rekening='".$mR[5]."',
		Usulan_Jumlah='".$mR[6]."',
		Status_Barang='".$mR[7]."',
		Kondisi_Barang='".$mR[8]."',
		UsulanKebthan_Jumlah='".$mR[9]."',
		UsulanKebthan_Satuan='".$mR[10]."',
		Nama_Pemeliharaan='".$mR[11]."',
		Keterangan='".$mR[12]."',
		LinkMurni='Ya',
		Recorded=now(),
		Pencatat='expperubahan'";
		$nW = mysql_query($SW);
	}
}

function copyData($mRF,$gUNT,$gTHN,$gUR)
{
	$SQ = "INSERT INTO ta_rkpbmd_new SET 
	Referensi='$mRF',
	Kd_Unit='$gUNT',
	Tahun='$gTHN',
	Apbd='1',
	Uraian='$gUR',
	LinkMurni='Ya',
	Recorded=now(),
	Pencatat='expperubahan'";
	$ns = mysql_query($SQ);
}

function CekData($mRF,$ApB,$DatabaseSB,$ConSB)
{
	return fGlobal("IDT","ta_rkpbmd_new","Referensi:Apbd",$mRF.":".$ApB,"=:=","","");
	
}

?>
<script languange="javascript">
	alert('<?=$MsG?>');
	RefreshDATA('<?=$IdL?>');
</script>