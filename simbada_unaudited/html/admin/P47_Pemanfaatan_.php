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

	$TgL = $fThn."-".substr('00'.$fBln,-2,2)."-".substr('00'.$fHri,-2,2);
	if ($TgL!='0000-00-00')
	{
		$MulaiPenggunaan  = $fThnMulai."-".substr('00'.$fBlnMulai,-2,2)."-".substr('00'.$fHriMulai,-2,2);
		$AkhirPenggunaan  = $fThnAkhir."-".substr('00'.$fBlnAkhir,-2,2)."-".substr('00'.$fHriAkhir,-2,2);
		$fSetujuTanggal  = $fThnSpB."-".substr('00'.$fBlnSpB,-2,2)."-".substr('00'.$fHriSpB,-2,2);
		$fJanjiTanggal  = $fThnSp."-".substr('00'.$fBlnSp,-2,2)."-".substr('00'.$fHriSp,-2,2);
		$fDokLainnyaNomorTanggal  = $fThnDokLain."-".substr('00'.$fBlnDokLain,-2,2)."-".substr('00'.$fHriDokLain,-2,2);
		
		$IdTc = fGlobal("IDT","ta_kib_108_p47_pemanfaatan","Referensi:RefGroup",$Ref.":".$Grp,"=:=","","");
		if ($IdTc)
		{
			$nSQ = "UPDATE ta_kib_108_p47_pemanfaatan SET 
			Tanggal='".$TgL."',
			Bentuk='".mysql_real_escape_string($fBentuk)."',
			Mitra='".mysql_real_escape_string($fMitra)."',
			Pemanfaat='".mysql_real_escape_string($fPemanfaat)."',
			Alamat='".mysql_real_escape_string($fAlamat)."',
			Jumlah='".$fJumlah."',
			Satuan='".mysql_real_escape_string($fSatuan)."',
			Tanah='".mysql_real_escape_string($fTanah)."',
			JangkaWaktu='".mysql_real_escape_string($fWaktu)."',
			MulaiPenggunaan='".$MulaiPenggunaan."',
			AkhirPenggunaan='".$AkhirPenggunaan."',
			Peruntukan='".$fPeruntukan."',
			SetujuNomor='".$fSetujuNomor."',
			SetujuTanggal='".$fSetujuTanggal."',
			JanjiNomor='".$fJanjiNomor."',
			JanjiTanggal='".$fJanjiTanggal."',		
			DokLainnyaNama='".$fDokLainNama."',
			DokLainnyaNomor='".$fDokLainNomor."',
			DokLainnyaTanggal='".$fDokLainnyaNomorTanggal."',
			Pencatat='".$UID."', Recorded=now() 
			WHERE IDT='".$IdTc."'";
			mysql_query($nSQ);
		}
		else
		{
			$nSQ = "INSERT INTO ta_kib_108_p47_pemanfaatan SET 
			Referensi='".$Ref."',
			RefGroup='".$Grp."',
			Tanggal='".$TgL."',
			Bentuk='".mysql_real_escape_string($fBentuk)."',
			Mitra='".mysql_real_escape_string($fMitra)."',
			Pemanfaat='".mysql_real_escape_string($fPemanfaat)."',
			Alamat='".mysql_real_escape_string($fAlamat)."',
			Jumlah='".$fJumlah."',
			Satuan='".mysql_real_escape_string($fSatuan)."',
			Tanah='".mysql_real_escape_string($fTanah)."',
			JangkaWaktu='".mysql_real_escape_string($fWaktu)."',
			MulaiPenggunaan='".$MulaiPenggunaan."',
			AkhirPenggunaan='".$AkhirPenggunaan."',
			Peruntukan='".$fPeruntukan."',
			SetujuNomor='".$fSetujuNomor."',
			SetujuTanggal='".$fSetujuTanggal."',
			JanjiNomor='".$fJanjiNomor."',
			JanjiTanggal='".$fJanjiTanggal."',		
			DokLainnyaNama='".$fDokLainNama."',
			DokLainnyaNomor='".$fDokLainNomor."',
			DokLainnyaTanggal='".$fDokLainnyaNomorTanggal."',
			Pencatat='".$UID."', Recorded=now()";
			#echo $nSQ;
			mysql_query($nSQ);
		}
	}
	
	$URL="P47_Pemanfaatan.php?BckFrm=".$_GET['BckFrm']."&rIDT=".$_GET['rIDT']."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}
else
{
	$URL="P47_Pemanfaatan.php?BckFrm=".$_GET['BckFrm']."&rIDT=".$_GET['rIDT']."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}

?>