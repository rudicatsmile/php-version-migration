<?php
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";

extract($_GET);
extract($_POST);

if ($fCritP=='Save')
{
	$Dta = fGlobal("Referensi:Ref_Group","ta_kib_108","IDT",$rIDT,"=","","");
	$Dta = explode(":",$Dta);
	$Ref = $Dta[0];
	$Grp = $Dta[1];

	$TgLP = $fThnP."-".substr('00'.$fBlnP,-2,2)."-".substr('00'.$fHriP,-2,2);
	$TgLK = $fThnK."-".substr('00'.$fBlnK,-2,2)."-".substr('00'.$fHriK,-2,2);
	if ($TgL!='0000-00-00')
	{
		$fBastP  = $fThnBastP."-".substr('00'.$fBlnBastP,-2,2)."-".substr('00'.$fHriBastP,-2,2);
		$fBastK = $fThnBastK."-".substr('00'.$fBlnBastK,-2,2)."-".substr('00'.$fHriBastK,-2,2);
		
		$IdTc = fGlobal("IDT","ta_kib_108_p47_pengamanan","Referensi:RefGroup",$Ref.":".$Grp,"=:=","","");
		if ($IdTc)
		{
			$nSQ = "UPDATE ta_kib_108_p47_pengamanan SET 
			Tanggal_p='".$TgLP."',
			Nama_p='".mysql_real_escape_string($fNamaP)."',
			Status_p='".mysql_real_escape_string($fStatusP)."',
			Jabatan_p='".mysql_real_escape_string($fJabatanP)."',
			Identitas_p='".mysql_real_escape_string($fIdentitasP)."',
			BastNomor_p='".mysql_real_escape_string($fBastNomorP)."',
			BastTanggal_p='".$fBastP."',
			Tanggal_k='".$TgLK."',
			Nama_k='".mysql_real_escape_string($fNamaK)."',
			Identitas_k='".mysql_real_escape_string($fIdentitasK)."',
			Alamat_k='".mysql_real_escape_string($fAlamatK)."',
			Penyebab_k='".mysql_real_escape_string($fPenyebabK)."',
			BastNomor_k='".mysql_real_escape_string($fBastNomorK)."',
			BastTanggal_k='".$fBastK."',
			Pencatat='".$UID."', Recorded=now() 
			WHERE IDT='".$IdTc."'";
			mysql_query($nSQ);
		}
		else
		{
			$nSQ = "INSERT INTO ta_kib_108_p47_pengamanan SET 
			Referensi='".$Ref."',
			RefGroup='".$Grp."',
			Tanggal_p='".$TgLP."',
			Nama_p='".mysql_real_escape_string($fNamaP)."',
			Status_p='".mysql_real_escape_string($fStatusP)."',
			Jabatan_p='".mysql_real_escape_string($fJabatanP)."',
			Identitas_p='".mysql_real_escape_string($fIdentitasP)."',
			BastNomor_p='".mysql_real_escape_string($fBastNomorP)."',
			BastTanggal_p='".$fBastP."',
			Tanggal_k='".$TgLK."',
			Nama_k='".mysql_real_escape_string($fNamaK)."',
			Identitas_k='".mysql_real_escape_string($fIdentitasK)."',
			Alamat_k='".mysql_real_escape_string($fAlamatK)."',
			Penyebab_k='".mysql_real_escape_string($fPenyebabK)."',
			BastNomor_k='".mysql_real_escape_string($fBastNomorK)."',
			BastTanggal_k='".$fBastK."',
			Pencatat='".$UID."', Recorded=now()";
			#echo $nSQ;
			mysql_query($nSQ);
		}
	}
	
	$URL="P47_Pengamanan.php?BckFrm=".$_GET['BckFrm']."&rIDT=".$_GET['rIDT']."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}
else
{
	$URL="P47_Pengamanan.php?BckFrm=".$_GET['BckFrm']."&rIDT=".$_GET['rIDT']."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}

?>