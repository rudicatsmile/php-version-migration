<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

if ($IdTR=='')
{
	$gNeW = 1;
	$rMax = fGlobal("max(Referensi)","ta_sp3d_spj_rinci","Referensi","AST.".fGetDate('year')."%","LIKE","","");
	if ($rMax)
	{
		$gNeW = (int)substr($rMax,-8,8)+1;
	}
	$gRef = "AST.".fGetDate('year').".".substr(str_repeat('0',8).$gNeW,-8,8);

	$gP3B = fGlobal("Referensi_SP3B","ta_sp3d_spj","IDT",$rIdT,"=","","");
	$gSPJ = fGlobal("Referensi","ta_sp3d_spj","IDT",$rIdT,"=","","");
	$gUPB = fGlobal("Kd_UPB","ta_sp3d_spj","IDT",$rIdT,"=","","");
	$gKd108 = fGlobal("Kd_ReknP108","ta_sp3d_spj","IDT",$rIdT,"=","","");
	$gNm108 = fGlobal("Nm_ReknP108","ta_sp3d_spj","IDT",$rIdT,"=","","");
	$gKdR90 = fGlobal("Kd_ReknP90","ta_sp3d_spj","IDT",$rIdT,"=","","");
}
$gTgL = fGlobal("Tgl_BAST","ta_sp3d_spj","IDT",$rIdT,"=","","");

if ($CrtSave=='A')
{
	$aSat = fConvertToNumeric($aSat);
	$aHrg = fConvertToNumeric($aHrg);
	$aTot = $aSat * $aHrg;
	if ($IdTR=='')
	{
		$nSQ = "INSERT INTO ta_sp3d_spj_rinci SET 
		Tgl_Perolehan='".$gTgL."',
		Referensi='".$gRef."',
		Referensi_SP3B='".$gP3B."',
		Referensi_SPJ='".$gSPJ."',
		Kd_UPB='".$gUPB."',
		Kd_ReknP90='".$gKdR90."',
		Kd_Aset_108='".$gKd108."',
		Nm_Aset_108='".$gNm108."',
		Nm_Aset='".ReplaceTextPHP($aNma)."',
		Alamat='".ReplaceTextPHP($aLet)."',
		Hak_Tanah='".ReplaceTextPHP($aHak)."',
		Penggunaan='".ReplaceTextPHP($aGun)."',
		Luas_M2='".fConvertToNumeric($aLua)."', 
		Keterangan='".ReplaceTextPHP($aKet)."',
		Kd_Pemilik='".$aMil."',
		Asal_Usul='".ReplaceTextPHP($aAsa)."',
		JmlSatuan='".$aSat."',
		Harga='".$aHrg."',
		Total='".$aTot."',
		Pencatat='".$UID."',
		Recorded= now()";
		$nRs = mysql_query($nSQ);
		$IdTR = fGlobal("max(IDT)","ta_sp3d_spj_rinci","IDT","%","LIKE","","");
	}
	else{
		$nSQ = "UPDATE ta_sp3d_spj_rinci SET 
		Tgl_Perolehan='".$gTgL."',
		Nm_Aset='".ReplaceTextPHP($aNma)."',
		Alamat='".ReplaceTextPHP($aLet)."',
		Hak_Tanah='".ReplaceTextPHP($aHak)."',
		Penggunaan='".ReplaceTextPHP($aGun)."',
		Luas_M2='".fConvertToNumeric($aLua)."', 
		Keterangan='".ReplaceTextPHP($aKet)."', 
		Kd_Pemilik='".$aMil."',
		Asal_Usul='".ReplaceTextPHP($aAsa)."',
		JmlSatuan='".$aSat."',
		Harga='".$aHrg."',
		Total='".$aTot."',
		Pencatat='".$UID."',
		Recorded= now() 
		WHERE IDT='".$IdTR."'";
		$nRs = mysql_query($nSQ);
	}
}

if ($CrtSave=='B'){
	$bSat = fConvertToNumeric($bSat);
	$bHrg = fConvertToNumeric($bHrg);
	$bTot = $bSat * $bHrg;
	if ($IdTR=='')
	{
		$nSQ = "INSERT INTO ta_sp3d_spj_rinci SET 
		Tgl_Perolehan='".$gTgL."',
		Referensi='".$gRef."',
		Referensi_SP3B='".$gP3B."',
		Referensi_SPJ='".$gSPJ."',
		Kd_UPB='".$gUPB."',
		Kd_ReknP90='".$gKdR90."',
		Kd_Aset_108='".$gKd108."',
		Nm_Aset_108='".$gNm108."',
		Nm_Aset='".ReplaceTextPHP($bNma)."',
		
		Merk='".ReplaceTextPHP($bMer)."',
		Type='".ReplaceTextPHP($bTip)."',
		Ukuran_CC='".ReplaceTextPHP($bUku)."',
		Bahan='".ReplaceTextPHP($bBhn)."',
		Nomor_Pabrik='".ReplaceTextPHP($bPab)."',
		Nomor_Rangka='".ReplaceTextPHP($bRan)."',
		Nomor_Mesin='".ReplaceTextPHP($bMes)."',
		Nomor_Polisi='".ReplaceTextPHP($bPol)."',
		Nomor_BPKB='".ReplaceTextPHP($bBpk)."',
		
		Keterangan='".ReplaceTextPHP($bKet)."',
		Kd_Pemilik='".$bMil."',
		Kondisi='".$bKon."',
		Asal_Usul='".ReplaceTextPHP($bAsa)."',
		JmlSatuan='".$bSat."',
		Harga='".$bHrg."',
		Total='".$bTot."',
		Pencatat='".$UID."',
		Recorded= now()";
		$nRs = mysql_query($nSQ);
		$IdTR = fGlobal("max(IDT)","ta_sp3d_spj_rinci","IDT","%","LIKE","","");
	}
	else{
		$nSQ = "UPDATE ta_sp3d_spj_rinci SET 
		Tgl_Perolehan='".$gTgL."',
		Nm_Aset='".ReplaceTextPHP($bNma)."',
		
		Merk='".ReplaceTextPHP($bMer)."',
		Type='".ReplaceTextPHP($bTip)."',
		Ukuran_CC='".ReplaceTextPHP($bUku)."',
		Bahan='".ReplaceTextPHP($bBhn)."',
		Nomor_Pabrik='".ReplaceTextPHP($bPab)."',
		Nomor_Rangka='".ReplaceTextPHP($bRan)."',
		Nomor_Mesin='".ReplaceTextPHP($bMes)."',
		Nomor_Polisi='".ReplaceTextPHP($bPol)."',
		Nomor_BPKB='".ReplaceTextPHP($bBpk)."',
		
		Keterangan='".ReplaceTextPHP($bKet)."', 
		Kd_Pemilik='".$bMil."',
		Kondisi='".$bKon."',
		Asal_Usul='".ReplaceTextPHP($bAsa)."',
		JmlSatuan='".$bSat."',
		Harga='".$bHrg."',
		Total='".$bTot."',
		Pencatat='".$UID."',
		Recorded= now() 
		WHERE IDT='".$IdTR."'";
		$nRs = mysql_query($nSQ);
	}
}

if ($CrtSave=='C')
{
	$cSat = fConvertToNumeric($cSat);
	$cHrg = fConvertToNumeric($cHrg);
	$cTot = $cSat * $cHrg;
	if ($IdTR=='')
	{
		$nSQ = "INSERT INTO ta_sp3d_spj_rinci SET 
		Tgl_Perolehan='".$gTgL."',
		Referensi='".$gRef."',
		Referensi_SP3B='".$gP3B."',
		Referensi_SPJ='".$gSPJ."',
		Kd_UPB='".$gUPB."',
		Kd_ReknP90='".$gKdR90."',
		Kd_Aset_108='".$gKd108."',
		Nm_Aset_108='".$gNm108."',
		Nm_Aset='".ReplaceTextPHP($cNma)."',
		
		Lokasi='".ReplaceTextPHP($cLet)."',
		Bertingkat='".ReplaceTextPHP($cTin)."',
		Beton='".ReplaceTextPHP($cBet)."',
		Luas_Lantai='".fConvertToNumeric($cLua)."', 
		
		Keterangan='".ReplaceTextPHP($cKet)."',
		Kd_Pemilik='".$cMil."',
		Kondisi='".$cKon."',
		Asal_Usul='".ReplaceTextPHP($cAsa)."',
		JmlSatuan='".$cSat."',
		Harga='".$cHrg."',
		Total='".$cTot."',
		Pencatat='".$UID."',
		Recorded= now()";
		$nRs = mysql_query($nSQ);
		$IdTR = fGlobal("max(IDT)","ta_sp3d_spj_rinci","IDT","%","LIKE","","");
	}
	else{
		$nSQ = "UPDATE ta_sp3d_spj_rinci SET 
		Tgl_Perolehan='".$gTgL."',
		Nm_Aset='".ReplaceTextPHP($cNma)."',
		
		Lokasi='".ReplaceTextPHP($cLet)."',
		Bertingkat='".ReplaceTextPHP($cTin)."',
		Beton='".ReplaceTextPHP($cBet)."',
		Luas_Lantai='".fConvertToNumeric($cLua)."', 
		
		Keterangan='".ReplaceTextPHP($cKet)."', 
		Kd_Pemilik='".$cMil."',
		Kondisi='".$cKon."',
		Asal_Usul='".ReplaceTextPHP($cAsa)."',
		JmlSatuan='".$cSat."',
		Harga='".$cHrg."',
		Total='".$cTot."',
		Pencatat='".$UID."',
		Recorded= now() 
		WHERE IDT='".$IdTR."'";
		$nRs = mysql_query($nSQ);
	}
}

if ($CrtSave=='D')
{
	$dSat = fConvertToNumeric($dSat);
	$dHrg = fConvertToNumeric($dHrg);
	$dTot = $dSat * $dHrg;
	if ($IdTR=='')
	{
		$nSQ = "INSERT INTO ta_sp3d_spj_rinci SET 
		Tgl_Perolehan='".$gTgL."',
		Referensi='".$gRef."',
		Referensi_SP3B='".$gP3B."',
		Referensi_SPJ='".$gSPJ."',
		Kd_UPB='".$gUPB."',
		Kd_ReknP90='".$gKdR90."',
		Kd_Aset_108='".$gKd108."',
		Nm_Aset_108='".$gNm108."',
		Nm_Aset='".ReplaceTextPHP($dNma)."',
		
		Lokasi='".ReplaceTextPHP($dLok)."',
		Konstruksi='".ReplaceTextPHP($dKot)."',
		Panjang='".fConvertToNumeric($dPan)."',
		Lebar='".fConvertToNumeric($dLeb)."',
		Luas='".fConvertToNumeric($dLua)."', 
		
		Keterangan='".ReplaceTextPHP($dKet)."',
		Kd_Pemilik='".$dMil."',
		Kondisi='".$dKon."',
		Asal_Usul='".ReplaceTextPHP($dAsa)."',
		JmlSatuan='".$dSat."',
		Harga='".$dHrg."',
		Total='".$dTot."',
		Pencatat='".$UID."',
		Recorded= now()";
		$nRs = mysql_query($nSQ);
		$IdTR = fGlobal("max(IDT)","ta_sp3d_spj_rinci","IDT","%","LIKE","","");
	}
	else{
		$nSQ = "UPDATE ta_sp3d_spj_rinci SET 
		Tgl_Perolehan='".$gTgL."',
		Nm_Aset='".ReplaceTextPHP($dNma)."',
		
		Lokasi='".ReplaceTextPHP($dLok)."',
		Konstruksi='".ReplaceTextPHP($dKot)."',
		Panjang='".fConvertToNumeric($dPan)."',
		Lebar='".fConvertToNumeric($dLeb)."',
		Luas='".fConvertToNumeric($dLua)."', 
		
		Keterangan='".ReplaceTextPHP($dKet)."', 
		Kd_Pemilik='".$dMil."',
		Kondisi='".$dKon."',
		Asal_Usul='".ReplaceTextPHP($dAsa)."',
		JmlSatuan='".$dSat."',
		Harga='".$dHrg."',
		Total='".$dTot."',
		Pencatat='".$UID."',
		Recorded= now() 
		WHERE IDT='".$IdTR."'";
		$nRs = mysql_query($nSQ);
	}
}

if ($CrtSave=='F')
{
	$fSat = fConvertToNumeric($fSat);
	$fHrg = fConvertToNumeric($fHrg);
	$fTot = $fSat * $fHrg;
	if ($IdTR=='')
	{
		$nSQ = "INSERT INTO ta_sp3d_spj_rinci SET 
		Tgl_Perolehan='".$gTgL."',
		Referensi='".$gRef."',
		Referensi_SP3B='".$gP3B."',
		Referensi_SPJ='".$gSPJ."',
		Kd_UPB='".$gUPB."',
		Kd_ReknP90='".$gKdR90."',
		Kd_Aset_108='".$gKd108."',
		Nm_Aset_108='".$gNm108."',
		Nm_Aset='".ReplaceTextPHP($fNma)."',
		
		Lokasi='".ReplaceTextPHP($fLok)."',
		Bertingkat='".ReplaceTextPHP($fTin)."',
		Beton='".ReplaceTextPHP($fBet)."',
		Panjang='".fConvertToNumeric($fPan)."',
		Lebar='".fConvertToNumeric($fLeb)."',
		Luas='".fConvertToNumeric($fLua)."', 
		
		Keterangan='".ReplaceTextPHP($fKet)."',
		Kd_Pemilik='".$fMil."',
		Asal_Usul='".ReplaceTextPHP($fAsa)."',
		JmlSatuan='".$fSat."',
		Harga='".$fHrg."',
		Total='".$fTot."',
		Pencatat='".$UID."',
		Recorded= now()";
		$nRs = mysql_query($nSQ);
		$IdTR = fGlobal("max(IDT)","ta_sp3d_spj_rinci","IDT","%","LIKE","","");
	}
	else{
		$nSQ = "UPDATE ta_sp3d_spj_rinci SET 
		Tgl_Perolehan='".$gTgL."',
		Nm_Aset='".ReplaceTextPHP($fNma)."',
		
		Lokasi='".ReplaceTextPHP($fLok)."',
		Bertingkat='".ReplaceTextPHP($fTin)."',
		Beton='".ReplaceTextPHP($fBet)."',
		Panjang='".fConvertToNumeric($fPan)."',
		Lebar='".fConvertToNumeric($fLeb)."',
		Luas='".fConvertToNumeric($fLua)."', 
		
		Keterangan='".ReplaceTextPHP($fKet)."', 
		Kd_Pemilik='".$fMil."',
		Asal_Usul='".ReplaceTextPHP($fAsa)."',
		JmlSatuan='".$fSat."',
		Harga='".$fHrg."',
		Total='".$fTot."',
		Pencatat='".$UID."',
		Recorded= now() 
		WHERE IDT='".$IdTR."'";
		$nRs = mysql_query($nSQ);
	}
}

if ($CrtSave=='E')
{
	$eThn = fConvertToNumeric($eThn);
	$eSat = fConvertToNumeric($eSat);
	$eHrg = fConvertToNumeric($eHrg);
	$eTot = $eSat * $eHrg;
	if ($IdTR=='')
	{
		$nSQ = "INSERT INTO ta_sp3d_spj_rinci SET 
		Tgl_Perolehan='".$gTgL."',
		Referensi='".$gRef."',
		Referensi_SP3B='".$gP3B."',
		Referensi_SPJ='".$gSPJ."',
		Kd_UPB='".$gUPB."',
		Kd_ReknP90='".$gKdR90."',
		Kd_Aset_108='".$gKd108."',
		Nm_Aset_108='".$gNm108."',
		Nm_Aset='".ReplaceTextPHP($eNma)."',
		
		Judul='".ReplaceTextPHP($eJud)."',
		Daerah_Asal='".ReplaceTextPHP($eDae)."',
		Jenis='".ReplaceTextPHP($eJen)."',
		Spesifikasi='".ReplaceTextPHP($eSpe)."',
		Pencipta='".ReplaceTextPHP($ePen)."',
		Ukuran='".ReplaceTextPHP($eUku)."',
		Bahan='".ReplaceTextPHP($eBah)."',
		Tahun='".$eThn."',
		
		Keterangan='".ReplaceTextPHP($eKet)."',
		Kd_Pemilik='".$eMil."',
		Asal_Usul='".ReplaceTextPHP($eAsa)."',
		Kondisi='".ReplaceTextPHP($eKon)."',
		JmlSatuan='".$eSat."',
		Harga='".$eHrg."',
		Total='".$eTot."',
		Pencatat='".$UID."',
		Recorded= now()";
		$nRs = mysql_query($nSQ);
		$IdTR = fGlobal("max(IDT)","ta_sp3d_spj_rinci","IDT","%","LIKE","","");
	}
	else{
		$nSQ = "UPDATE ta_sp3d_spj_rinci SET 
		Tgl_Perolehan='".$gTgL."',
		Nm_Aset='".ReplaceTextPHP($eNma)."',
		
		Judul='".ReplaceTextPHP($eJud)."',
		Daerah_Asal='".ReplaceTextPHP($eDae)."',
		Jenis='".ReplaceTextPHP($eJen)."',
		Spesifikasi='".ReplaceTextPHP($eSpe)."',
		Pencipta='".ReplaceTextPHP($ePen)."',
		Ukuran='".ReplaceTextPHP($eUku)."',
		Bahan='".ReplaceTextPHP($eBah)."',
		Tahun='".$eThn."',
		
		Keterangan='".ReplaceTextPHP($eKet)."',
		Kd_Pemilik='".$eMil."',
		Asal_Usul='".ReplaceTextPHP($eAsa)."',
		Kondisi='".ReplaceTextPHP($eKon)."',
		JmlSatuan='".$eSat."',
		Harga='".$eHrg."',
		Total='".$eTot."',
		Pencatat='".$UID."',
		Recorded= now() 
		WHERE IDT='".$IdTR."'";
		$nRs = mysql_query($nSQ);
	}
}

?>
<script type="text/javascript">
	EditMidASET('<?=$IdTR?>','<?=$rIdT?>','<?=$CrtSave?>','<?=$IdL?>');
</script>
