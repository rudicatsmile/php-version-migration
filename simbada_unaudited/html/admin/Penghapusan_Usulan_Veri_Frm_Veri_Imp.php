<?
$nSQ = "SELECT Referensi,Kd_UPB,Nomor,Tanggal,Jenis,Dokumen_Nom,Dokumen_Tgl,Uraian FROM ta_usulan_108 WHERE IDT='$IdT'";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$RefU= $mRo[0];
	$TglM= $mRo[6];
	if ($TglM=='0000-00-00'){$TglM='2021-08-30';}
	$rID = fGlobal("IDT","ta_usulan_verifikasi_108","Ref_Usulan",$RefU,"=","","");
	if (!$rID)
	{
		$gNeW = 1;
		$rMax = fGlobal("max(Referensi)","ta_usulan_verifikasi_108","Referensi","ADM.".fGetDate('year')."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = (int)substr($rMax,-8,8)+1;
		}
		
		$gREF = "ADM.".fGetDate('year').".".substr(str_repeat('0',8).$gNeW,-8,8);

		$gTG = $gTH = fGetDate('year')."-".$gBL = fGetDate('mon')."-".$gBL = fGetDate('mday');
		$SQ = "INSERT INTO ta_usulan_verifikasi_108 SET 
		Referensi='$gREF',
		Ref_Usulan='$RefU',
		Kd_UPB='".$mRo[1]."',
		Nomor='',
		Tanggal='$gTG',
		Nma_Verifikator='',
		Jab_Verifikator='',
		Nip_Verifikator='',
		Jenis='".$mRo[4]."',
		Uraian=''";
		$Rs = mysql_query($SQ);
		$rID = fGlobal("max(IDT)","ta_usulan_verifikasi_108","IDT","%","LIKE","","");
	}
	else
	{
		$gREF = fGlobal("Referensi","ta_usulan_verifikasi_108","IDT",$rID,"=","","");
	}

	$SQ = "SELECT Referensi, Ref_Aset, Kd_UPB, Kd_Aset, No_Register, 
	Tgl_Perolehan, Nm_Aset, Harga,Uraian, To_UPB, KIB_From, KIB_To, To_Kd_Aset, Kd_Rinci, Nilai_Akhir 
	FROM ta_usulan_rinci_108 WHERE Referensi='$RefU' ORDER BY IDT";
	$Rs = mysql_query($SQ);
	while ($nRo = mysql_fetch_array($Rs, MYSQL_BOTH))
	{
		$RefA = $nRo[1];
		$NomR = $nRo[4];
		$CeK = fGlobal("IDT","ta_usulan_verifikasi_rinci_108","Referensi:Ref_Usulan:Ref_Aset:No_Register",$gREF.":".$RefU.":".$RefA.":".$NomR,"=:=:=:=","","");
		if (!$CeK)
		{
			$SW="INSERT INTO ta_usulan_verifikasi_rinci_108 SET
			Referensi='".$gREF."',
			Ref_Usulan='".$nRo['Referensi']."',
			Ref_Aset='".$nRo['Ref_Aset']."',
			Kd_UPB='".$nRo['Kd_UPB']."',
			Kd_Aset='".$nRo['Kd_Aset']."',
			Nm_Aset='".mysql_real_escape_string($nRo['Nm_Aset'])."',
			No_Register='".$nRo['No_Register']."',
			Tgl_Perolehan='".$nRo['Tgl_Perolehan']."',
			Uraian='".mysql_real_escape_string($nRo['Uraian'])."',
			Harga='".$nRo['Harga']."',
			Nilai_Akhir='".$nRo['Nilai_Akhir']."',
			To_UPB='".$nRo['To_UPB']."',
			KIB_From='".$nRo['KIB_From']."',
			KIB_To='".$nRo['KIB_To']."',
			To_Kd_Aset='".$nRo['To_Kd_Aset']."',
			
			Mutasi_Tanggal='".$TglM."',
			Verifikasi='Disetujui',
			
			Kd_Rinci='".$nRo['Kd_Rinci']."'";
			$Rw = mysql_query($SW);
		}
		else
		{
			$SW="UPDATE ta_usulan_verifikasi_rinci_108 SET 
			KIB_From='".$nRo['KIB_From']."',
			KIB_To='".$nRo['KIB_To']."',
			To_Kd_Aset='".$nRo['To_Kd_Aset']."',
			To_UPB='".$nRo['To_UPB']."', 
			Mutasi_Tanggal='".$TglM."',
			Verifikasi='Disetujui',
			Nilai_Akhir='".$nRo['Nilai_Akhir']."' 
			WHERE IDT='$CeK'";
			//mysql_query($SW);
		}
	}
	
	$SQ = "UPDATE ta_usulan_108 SET OpenRec='Y' WHERE IDT='$IdT'";
	$Rs = mysql_query($SQ);
}

?>