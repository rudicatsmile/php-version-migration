<?php
require('Connection.php');
require('CheckLogin.php');
extract($_GET);

$nSQ = "SELECT Referensi, Kd_Unit, Tahun, Uraian FROM ta_rkbmd_new WHERE Kd_Unit='$gUNT' AND Tahun='$gTHN' AND Apbd='0' ORDER BY IDT";
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
	}
}

function copyDataProgram($mRF,$ApB,$gUNT,$gTHN)
{
	$SQ = "SELECT Referensi, Kd_Unit, Tahun, Kd_Program, Nm_Program 
	FROM ta_rkbmd_new_program WHERE Referensi='$mRF' AND Kd_Unit='$gUNT' AND Tahun='$gTHN' AND Apbd='$ApB' ORDER BY IDT";
	$nR = mysql_query($SQ);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$SW = "INSERT INTO ta_rkbmd_new_program SET 
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
	#echo "ta_rkbmd_new_program done..!<br>";
}

function copyDataKegiatan($mRF,$ApB,$gUNT,$gTHN)
{
	$SQ = "SELECT Referensi, Kd_Unit, Tahun, Kd_Kegiatan, Nm_Kegiatan, Output 
	FROM ta_rkbmd_new_kegiatan WHERE Referensi='$mRF' AND Kd_Unit='$gUNT' AND Tahun='$gTHN' AND Apbd='$ApB' ORDER BY IDT";
	$nR = mysql_query($SQ);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$SW = "INSERT INTO ta_rkbmd_new_kegiatan SET 
		Referensi='".$mR[0]."',
		Kd_Unit='".$mR[1]."',
		Tahun='".$mR[2]."',
		Apbd='1',
		Kd_Kegiatan='".$mR[3]."',
		Nm_Kegiatan='".$mR[4]."',
		Output='".$mR[5]."',
		LinkMurni='Ya',
		Recorded=now(),
		Pencatat='expperubahan'";
		$nW = mysql_query($SW);
	}
	#echo "ta_rkbmd_new_kegiatan done..!<br>";
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
	Usulan_Satuan as A7,
	Maksimum_Jumlah as A8,
	Maksimum_Satuan as A9,
	Optimalisasi_Jumlah as A10,
	Optimalisasi_Satuan as A11,
	KebutuhanReal_Jumlah as A12,
	KebutuhanReal_Satuan as A13,
	Cara_Pemenuhan as A14,
	Keterangan as A15 
	FROM ta_rkbmd_new_rekening WHERE Referensi='$mRF' AND Kd_Unit='$gUNT' AND Tahun='$gTHN' AND Apbd='$ApB' ORDER BY IDT";
	$nR = mysql_query($SQ);
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$SW = "INSERT INTO ta_rkbmd_new_rekening SET 
		Referensi='".$mR[0]."',
		Kd_Unit='".$mR[1]."',
		Tahun='".$mR[2]."',
		Apbd='1',
		Kd_Kegiatan='".$mR[3]."',
		Kd_Rekening='".$mR[4]."',
		Nm_Rekening='".$mR[5]."',
		Usulan_Jumlah='".$mR[6]."',
		Usulan_Satuan='".$mR[7]."',
		Maksimum_Jumlah='".$mR[8]."',
		Maksimum_Satuan='".$mR[9]."',
		Optimalisasi_Jumlah='".$mR[10]."',
		Optimalisasi_Satuan='".$mR[11]."',
		KebutuhanReal_Jumlah='".$mR[12]."',
		KebutuhanReal_Satuan='".$mR[13]."',
		Cara_Pemenuhan='".$mR[14]."',
		Keterangan='".$mR[15]."',
		LinkMurni='Ya',
		Recorded=now(),
		Pencatat='expperubahan'";
		$nW = mysql_query($SW);
	}
	#echo "ta_rkbmd_new_rekening done..!<br>";
}

function copyData($mRF,$gUNT,$gTHN,$gUR)
{
	$SQ = "INSERT INTO ta_rkbmd_new SET 
	Referensi='$mRF',
	Kd_Unit='$gUNT',
	Tahun='$gTHN',
	Apbd='1',
	Uraian='$gUR',
	LinkMurni='Ya',
	Recorded=now(),
	Pencatat='expperubahan'";
	$ns = mysql_query($SQ);
	#echo "ta_rkbmd_new done..!<br>";

}

function CekData($mRF,$ApB,$DatabaseSB,$ConSB)
{
	return fGlobalNEW("IDT","ta_rkbmd_new","Referensi:Apbd",$mRF.":".$ApB,"=:=","",$DatabaseSB,$ConSB,"");
	
}

?>
<script languange="javascript">
	RefreshDATA('<?=$IdL?>');
	//alert('Proses copy data done..!');
</script>