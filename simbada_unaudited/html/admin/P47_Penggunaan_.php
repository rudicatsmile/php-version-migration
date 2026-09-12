<?
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
	
	#A
	$TgL_A = $fThnA."-".substr('00'.$fBlnA,-2,2)."-".substr('00'.$fHriA,-2,2);
	if ($TgL_A!='0000-00-00')
	{
		$fBastTanggal_A   = $fBaThnA."-".substr('00'.$fBaBlnA,-2,2)."-".substr('00'.$fBaHriA,-2,2);
		$SkHapusTanggal_A = $fSkThnA."-".substr('00'.$fSkBlnA,-2,2)."-".substr('00'.$fSkHriA,-2,2);
		
		$IdTa = fGlobal("IDT","ta_kib_108_p47_penggunaan_a","Referensi:RefGroup",$Ref.":".$Grp,"=:=","","");
		if ($IdTa)
		{
			$nSQ = "UPDATE ta_kib_108_p47_penggunaan_a SET 
			Tanggal='".$TgL_A."',
			Pengguna='".mysql_real_escape_string($fPengguna_A)."',
			Jumlah='".$fJumlah_A."',
			Satuan='".mysql_real_escape_string($fSatuan_A)."',
			Harga='".fConvertToNumeric($fHarga_A)."',
			NilaiAkhir='".fConvertToNumeric($fNilaiAkhir_A)."',
			DokumenSumber='".mysql_real_escape_string($fDokumenSumber_A)."',
			BastNomor='".mysql_real_escape_string($fBastNomor_A)."',
			BastTanggal='".$fBastTanggal_A."',
			SkHapusNomor='".mysql_real_escape_string($fSkHapusNomor_A)."',
			SkHapusTanggal='".$SkHapusTanggal_A."', Pencatat='".$UID."', Recorded=now() 
			WHERE IDT='".$IdTa."'";
			mysql_query($nSQ);
		}
		else
		{
			$nSQ = "INSERT INTO ta_kib_108_p47_penggunaan_a SET 
			Referensi='".$Ref."',
			RefGroup='".$Grp."',
			Tanggal='".$TgL_A."', 
			Pengguna='".mysql_real_escape_string($fPengguna_A)."',
			Jumlah='".$fJumlah_A."',
			Satuan='".mysql_real_escape_string($fSatuan_A)."',
			Harga='".fConvertToNumeric($fHarga_A)."',
			NilaiAkhir='".fConvertToNumeric($fNilaiAkhir_A)."',
			DokumenSumber='".mysql_real_escape_string($fDokumenSumber_A)."',
			BastNomor='".mysql_real_escape_string($fBastNomor_A)."',
			BastTanggal='".$fBastTanggal_A."',
			SkHapusNomor='".mysql_real_escape_string($fSkHapusNomor_A)."',
			SkHapusTanggal='".$SkHapusTanggal_A."',
			Pencatat='".$UID."', Recorded=now()";
			mysql_query($nSQ);
		}
	}
	
	#B
	$TgL_B = $fThnB."-".substr('00'.$fBlnB,-2,2)."-".substr('00'.$fHriB,-2,2);
	if ($TgL_B!='0000-00-00')
	{
		$fBastTanggal_B   = $fBaThnB."-".substr('00'.$fBaBlnB,-2,2)."-".substr('00'.$fBaHriB,-2,2);
		$SkHapusTanggal_B = $fSkThnB."-".substr('00'.$fSkBlnB,-2,2)."-".substr('00'.$fSkHriB,-2,2);
		
		$IdTb = fGlobal("IDT","ta_kib_108_p47_penggunaan_b","Referensi:RefGroup",$Ref.":".$Grp,"=:=","","");
		if ($IdTb)
		{
			$nSQ = "UPDATE ta_kib_108_p47_penggunaan_b SET 
			Tanggal='".$TgL_B."',
			Pengguna='".mysql_real_escape_string($fPengguna_B)."',
			Jumlah='".$fJumlah_B."',
			Satuan='".mysql_real_escape_string($fSatuan_B)."',
			Harga='".fConvertToNumeric($fHarga_B)."',
			NilaiAkhir='".fConvertToNumeric($fNilaiAkhir_B)."',
			DokumenSumber='".mysql_real_escape_string($fDokumenSumber_B)."',
			BastNomor='".mysql_real_escape_string($fBastNomor_B)."',
			BastTanggal='".$fBastTanggal_B."',
			SkHapusNomor='".mysql_real_escape_string($fSkHapusNomor_B)."',
			SkHapusTanggal='".$SkHapusTanggal_B."', Pencatat='".$UID."', Recorded=now() 
			WHERE IDT='".$IdTb."'";
			mysql_query($nSQ);
		}
		else
		{
			$nSQ = "INSERT INTO ta_kib_108_p47_penggunaan_b SET 
			Referensi='".$Ref."',
			RefGroup='".$Grp."',
			Tanggal='".$TgL_B."', 
			Pengguna='".mysql_real_escape_string($fPengguna_B)."',
			Jumlah='".$fJumlah_B."',
			Satuan='".mysql_real_escape_string($fSatuan_B)."',
			Harga='".fConvertToNumeric($fHarga_B)."',
			NilaiAkhir='".fConvertToNumeric($fNilaiAkhir_B)."',
			DokumenSumber='".mysql_real_escape_string($fDokumenSumber_B)."',
			BastNomor='".mysql_real_escape_string($fBastNomor_B)."',
			BastTanggal='".$fBastTanggal_B."',
			SkHapusNomor='".mysql_real_escape_string($fSkHapusNomor_B)."',
			SkHapusTanggal='".$SkHapusTanggal_B."',
			Pencatat='".$UID."', Recorded=now()";
			mysql_query($nSQ);
		}
	}
	
	#C
	$TgL_C = $fThnC."-".substr('00'.$fBlnC,-2,2)."-".substr('00'.$fHriC,-2,2);
	if ($TgL_C!='0000-00-00')
	{
		#$fBastTanggal_C   = $fBaThnC."-".substr('00'.$fBaBlnC,-2,2)."-".substr('00'.$fBaHriC,-2,2);
		#$SkHapusTanggal_C = $fSkThnC."-".substr('00'.$fSkBlnC,-2,2)."-".substr('00'.$fSkHriC,-2,2);
		$MulaiPenggunaan_C  = $fThnMulaiC."-".substr('00'.$fBlnMulaiC,-2,2)."-".substr('00'.$fHriMulaiC,-2,2);
		$AkhirPenggunaan_C  = $fThnAkhirC."-".substr('00'.$fBlnAkhirC,-2,2)."-".substr('00'.$fHriAkhirC,-2,2);
		$SpBupatiTanggal_C  = $fThnSpBC."-".substr('00'.$fBlnSpBC,-2,2)."-".substr('00'.$fHriSpBC,-2,2);
		$SpTanggal_C  = $fThnSpC."-".substr('00'.$fBlnSpC,-2,2)."-".substr('00'.$fHriSpC,-2,2);
		$DokLainnyaNomorTanggal_C  = $fThnDokLainC."-".substr('00'.$fBlnDokLainC,-2,2)."-".substr('00'.$fHriDokLainC,-2,2);
		
		$IdTc = fGlobal("IDT","ta_kib_108_p47_penggunaan_c","Referensi:RefGroup",$Ref.":".$Grp,"=:=","","");
		if ($IdTc)
		{
			$nSQ = "UPDATE ta_kib_108_p47_penggunaan_c SET 
			Tanggal='".$TgL_C."',
			Pengguna='".mysql_real_escape_string($fPengguna_C)."',
			Alamat='".mysql_real_escape_string($fAlamat_C)."',
			Jumlah='".$fJumlah_C."',
			Satuan='".mysql_real_escape_string($fSatuan_C)."',
			Tanah='".mysql_real_escape_string($fTanah_C)."',
			JangkaWaktu='".mysql_real_escape_string($fWaktu_C)."',
			MulaiPenggunaan='".$MulaiPenggunaan_C."',
			AkhirPenggunaan='".$AkhirPenggunaan_C."',
			Peruntukan='".$fPeruntukan_C."',
			SpBupatiNomor='".$fSpBNomor_C."',
			SpBupatiTanggal='".$SpBupatiTanggal_C."',
			SpNomor='".$fSpNomor_C."',
			SpTanggal='".$SpTanggal_C."',		
			DokLainnyaNama='".$fDokLainNama_C."',
			DokLainnyaNomor='".$fDokLainNomor_C."',
			DokLainnyaTanggal='".$DokLainnyaNomorTanggal_C."',
			Pencatat='".$UID."', Recorded=now() 
			WHERE IDT='".$IdTc."'";
			mysql_query($nSQ);
		}
		else
		{
			$nSQ = "INSERT INTO ta_kib_108_p47_penggunaan_c SET 
			Referensi='".$Ref."',
			RefGroup='".$Grp."',
			Tanggal='".$TgL_C."',
			Pengguna='".mysql_real_escape_string($fPengguna_C)."',
			Alamat='".mysql_real_escape_string($fAlamat_C)."',
			Jumlah='".$fJumlah_C."',
			Satuan='".mysql_real_escape_string($fSatuan_C)."',
			Tanah='".mysql_real_escape_string($fTanah_C)."',
			JangkaWaktu='".mysql_real_escape_string($fWaktu_C)."',
			MulaiPenggunaan='".$MulaiPenggunaan_C."',
			AkhirPenggunaan='".$AkhirPenggunaan_C."',
			Peruntukan='".$fPeruntukan_C."',
			SpBupatiNomor='".$fSpBNomor_C."',
			SpBupatiTanggal='".$SpBupatiTanggal_C."',
			SpNomor='".$fSpNomor_C."',
			SpTanggal='".$SpTanggal_C."',		
			DokLainnyaNama='".$fDokLainNama_C."',
			DokLainnyaNomor='".$fDokLainNomor_C."',
			DokLainnyaTanggal='".$DokLainnyaNomorTanggal_C."',
			Pencatat='".$UID."', Recorded=now()";
			#echo $nSQ;
			mysql_query($nSQ);
		}
	}
	
	#D
	$TgL_D = $fThnD."-".substr('00'.$fBlnD,-2,2)."-".substr('00'.$fHriD,-2,2);
	if ($TgL_D!='0000-00-00')
	{
		#$fBastTanggal_D   = $fBaThnD."-".substr('00'.$fBaBlnD,-2,2)."-".substr('00'.$fBaHriD,-2,2);
		#$SkHapusTanggal_D = $fSkThnD."-".substr('00'.$fSkBlnD,-2,2)."-".substr('00'.$fSkHriD,-2,2);
		$MulaiPenggunaan_D  = $fThnMulaiD."-".substr('00'.$fBlnMulaiD,-2,2)."-".substr('00'.$fHriMulaiD,-2,2);
		$AkhirPenggunaan_D  = $fThnAkhirD."-".substr('00'.$fBlnAkhirD,-2,2)."-".substr('00'.$fHriAkhirD,-2,2);
		$SpBupatiTanggal_D  = $fThnSpBD."-".substr('00'.$fBlnSpBD,-2,2)."-".substr('00'.$fHriSpBD,-2,2);
		$SpTanggal_D  = $fThnSpD."-".substr('00'.$fBlnSpD,-2,2)."-".substr('00'.$fHriSpD,-2,2);
		$DokLainnyaNomorTanggal_D  = $fThnDokLainD."-".substr('00'.$fBlnDokLainD,-2,2)."-".substr('00'.$fHriDokLainD,-2,2);
		
		$IdTd = fGlobal("IDT","ta_kib_108_p47_penggunaan_d","Referensi:RefGroup",$Ref.":".$Grp,"=:=","","");
		if ($IdTd)
		{
			$nSQ = "UPDATE ta_kib_108_p47_penggunaan_d SET 
			Tanggal='".$TgL_D."',
			Pengguna='".mysql_real_escape_string($fPengguna_D)."',
			Alamat='".mysql_real_escape_string($fAlamat_D)."',
			Jumlah='".$fJumlah_D."',
			Satuan='".mysql_real_escape_string($fSatuan_D)."',
			Tanah='".mysql_real_escape_string($fTanah_D)."',
			JangkaWaktu='".mysql_real_escape_string($fWaktu_D)."',
			MulaiPenggunaan='".$MulaiPenggunaan_D."',
			AkhirPenggunaan='".$AkhirPenggunaan_D."',
			Peruntukan='".$fPeruntukan_D."',
			SpBupatiNomor='".$fSpBNomor_D."',
			SpBupatiTanggal='".$SpBupatiTanggal_D."',
			SpNomor='".$fSpNomor_D."',
			SpTanggal='".$SpTanggal_D."',		
			DokLainnyaNama='".$fDokLainNama_D."',
			DokLainnyaNomor='".$fDokLainNomor_D."',
			DokLainnyaTanggal='".$DokLainnyaNomorTanggal_D."' 
			WHERE IDT='".$IdTd."'";
			mysql_query($nSQ);
		}
		else
		{
			$nSQ = "INSERT INTO ta_kib_108_p47_penggunaan_d SET 
			Referensi='".$Ref."',
			RefGroup='".$Grp."',
			Tanggal='".$TgL_D."',
			Pengguna='".mysql_real_escape_string($fPengguna_D)."',
			Alamat='".mysql_real_escape_string($fAlamat_D)."',
			Jumlah='".$fJumlah_D."',
			Satuan='".mysql_real_escape_string($fSatuan_D)."',
			Tanah='".mysql_real_escape_string($fTanah_D)."',
			JangkaWaktu='".mysql_real_escape_string($fWaktu_D)."',
			MulaiPenggunaan='".$MulaiPenggunaan_D."',
			AkhirPenggunaan='".$AkhirPenggunaan_D."',
			Peruntukan='".$fPeruntukan_D."',
			SpBupatiNomor='".$fSpBNomor_D."',
			SpBupatiTanggal='".$SpBupatiTanggal_D."',
			SpNomor='".$fSpNomor_D."',
			SpTanggal='".$SpTanggal_D."',		
			DokLainnyaNama='".$fDokLainNama_D."',
			DokLainnyaNomor='".$fDokLainNomor_D."',
			DokLainnyaTanggal='".$DokLainnyaNomorTanggal_D."',
			Pencatat='".$UID."', Recorded=now()";
			#echo $nSQ;
			mysql_query($nSQ);
		}
	}
	
	$URL="P47_Penggunaan.php?BckFrm=".$_GET['BckFrm']."&rIDT=".$_GET['rIDT']."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}
else
{
	$URL="P47_Penggunaan.php?BckFrm=".$_GET['BckFrm']."&rIDT=".$_GET['rIDT']."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}

?>