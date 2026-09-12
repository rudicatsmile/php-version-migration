<?
require "Connection.php";
require "FileFunction.php";
require('CheckLogin.php');

$data = array();
extract($_POST);

$TgL = explode('/',$TgL);
$TgL = $TgL[2]."-".$TgL[1]."-".$TgL[0];

if (isset($TgBA))
{
	$TgBA = explode('/',$TgBA);
	$TgBA = $TgBA[2]."-".$TgBA[1]."-".$TgBA[0];
}
if (isset($TgBH))
{
	$TgBH = explode('/',$TgBH);
	$TgBH = $TgBH[2]."-".$TgBH[1]."-".$TgBH[0];
}
if (isset($DokPTg))
{
	$DokPTg = explode('/',$DokPTg);
	$DokPTg = $DokPTg[2]."-".$DokPTg[1]."-".$DokPTg[0];
}
if (isset($DokTg))
{
	$DokTg = explode('/',$DokTg);
	$DokTg = $DokTg[2]."-".$DokTg[1]."-".$DokTg[0];
}
if (isset($TgKo))
{
	$TgKo = explode('/',$TgKo);
	$TgKo = $TgKo[2]."-".$TgKo[1]."-".$TgKo[0];
}

$HrGT = 0;
if ($JmLB!='' && $HrGB!='')
{
	$HrGT = fConvertToNumeric($JmLB) * fConvertToNumeric($HrGB);
}

if ($JnsNon=='FIIA20')
{
	if ($IdT=='')
	{
		$NeW = makeREF($UnT,$ThN);
		$SQ = "INSERT INTO ta_penerimaan_non_apbd SET 
		Tanggal='".$TgL."', 
		Referensi='".$NeW."', 
		JenisNonApbd='".$JnsNon."',
		Kd_Unit='".$UnT."',
		Id_Rekanan='".$PiHA."',
		JumlahBarang='".$JmLB."',
		SatuanBarang='".$SaTB."',
		HargaSatuan='".fConvertToNumeric($HrGB)."',
		TotalNilai='".$HrGT."',
		
		Dokumen_Nama='".$DokNm."',
		Dokumen_Nomor='".$DokNo."',
		Dokumen_Tanggal='".$DokTg."',
		
		DokPendukung_Nama='".$DokPNm."',
		DokPendukung_Nomor='".$DokPNo."',
		DokPendukung_Tanggal='".$DokPTg."',
		Recorded=now(),
		Pencatat='".$UID."'";
		$rs = mysql_query($SQ);
		
		$data['IdT'] = fGlobal("max(IDT)","ta_penerimaan_non_apbd","Referensi","%","LIKE","","");
		
		if ($rs) {$data['Mess'] = "Proses berhasil..!!";}
		else {$data['Mess'] = "Proses tidak berhasil..!!";}
	}
	else
	{
		$SQ = "UPDATE ta_penerimaan_non_apbd SET 
		Tanggal='".$TgL."', 
		Id_Rekanan='".$PiHA."',
		JumlahBarang='".fConvertToNumeric($JmLB)."',
		SatuanBarang='".$SaTB."',
		HargaSatuan='".fConvertToNumeric($HrGB)."',
		TotalNilai='".$HrGT."',
		
		Dokumen_Nama='".$DokNm."',
		Dokumen_Nomor='".$DokNo."',
		Dokumen_Tanggal='".$DokTg."',
		
		DokPendukung_Nama='".$DokPNm."',
		DokPendukung_Nomor='".$DokPNo."',
		DokPendukung_Tanggal='".$DokPTg."',
		
		Recorded=now(),
		Pencatat='".$UID."' WHERE IDT='".$IdT."'";
		$rs = mysql_query($SQ);
	
		$data['IdT']  = $IdT;
		
		if ($rs) 
		{
			$data['Mess'] = "Update berhasil..!!";
		}
		else {
			$data['Mess'] = "Update tidak berhasil..!!";
		}
	}
}

if ($JnsNon=='FIIA19')
{
	if ($IdT=='')
	{
		$NeW = makeREF($UnT,$ThN);
		$SQ = "INSERT INTO ta_penerimaan_non_apbd SET 
		Tanggal='".$TgL."', 
		Referensi='".$NeW."', 
		JenisNonApbd='".$JnsNon."',
		Kd_Unit='".$UnT."',
		Id_Rekanan='".$PiHA."',
		JumlahBarang='".$JmLB."',
		SatuanBarang='".$SaTB."',
		HargaSatuan='".fConvertToNumeric($HrGB)."',
		TotalNilai='".$HrGT."',
		
		Dokumen_Nama='".$DokNm."',
		Dokumen_Nomor='".$DokNo."',
		Dokumen_Tanggal='".$DokTg."',
		
		DokPendukung_Nama='".$DokPNm."',
		DokPendukung_Nomor='".$DokPNo."',
		DokPendukung_Tanggal='".$DokPTg."',
		Recorded=now(),
		Pencatat='".$UID."'";
		$rs = mysql_query($SQ);
		
		$data['IdT'] = fGlobal("max(IDT)","ta_penerimaan_non_apbd","Referensi","%","LIKE","","");
		
		if ($rs) {$data['Mess'] = "Proses berhasil..!!";}
		else {$data['Mess'] = "Proses tidak berhasil..!!";}
	}
	else
	{
		$SQ = "UPDATE ta_penerimaan_non_apbd SET 
		Tanggal='".$TgL."', 
		Id_Rekanan='".$PiHA."',
		JumlahBarang='".fConvertToNumeric($JmLB)."',
		SatuanBarang='".$SaTB."',
		HargaSatuan='".fConvertToNumeric($HrGB)."',
		TotalNilai='".$HrGT."',
		
		Dokumen_Nama='".$DokNm."',
		Dokumen_Nomor='".$DokNo."',
		Dokumen_Tanggal='".$DokTg."',
		
		DokPendukung_Nama='".$DokPNm."',
		DokPendukung_Nomor='".$DokPNo."',
		DokPendukung_Tanggal='".$DokPTg."',
		
		Recorded=now(),
		Pencatat='".$UID."' WHERE IDT='".$IdT."'";
		$rs = mysql_query($SQ);
	
		$data['IdT']  = $IdT;
		
		if ($rs) 
		{
			$data['Mess'] = "Update berhasil..!!";
		}
		else {
			$data['Mess'] = "Update tidak berhasil..!!";
		}
	}
}

if ($JnsNon=='FIIA18')
{
	if ($IdT=='')
	{
		$NeW = makeREF($UnT,$ThN);
		$SQ = "INSERT INTO ta_penerimaan_non_apbd SET 
		Tanggal='".$TgL."', 
		Referensi='".$NeW."', 
		JenisNonApbd='".$JnsNon."',
		Kd_Unit='".$UnT."',
		Id_Rekanan='".$PiHA."',
		JumlahBarang='".$JmLB."',
		SatuanBarang='".$SaTB."',
		HargaSatuan='".fConvertToNumeric($HrGB)."',
		TotalNilai='".$HrGT."',
		No_BAST='".$NoBA."',
		Tg_BAST='".$TgBA."',
		Dasar_Hukum='".$DsrHuk."',
		DokPendukung_Nama='".$DokPNm."',
		DokPendukung_Nomor='".$DokPNo."',
		DokPendukung_Tanggal='".$DokPTg."',
		Recorded=now(),
		Pencatat='".$UID."'";
		$rs = mysql_query($SQ);
		
		$data['IdT'] = fGlobal("max(IDT)","ta_penerimaan_non_apbd","Referensi","%","LIKE","","");
		
		if ($rs) {$data['Mess'] = "Proses berhasil..!!";}
		else {$data['Mess'] = "Proses tidak berhasil..!!";}
	}
	else
	{
		$SQ = "UPDATE ta_penerimaan_non_apbd SET 
		Tanggal='".$TgL."', 
		Id_Rekanan='".$PiHA."',
		JumlahBarang='".fConvertToNumeric($JmLB)."',
		SatuanBarang='".$SaTB."',
		HargaSatuan='".fConvertToNumeric($HrGB)."',
		TotalNilai='".$HrGT."',
		No_BAST='".$NoBA."',
		Tg_BAST	='".$TgBA."',
		Dasar_Hukum='".$DsrHuk."',
		DokPendukung_Nama='".$DokPNm."',
		DokPendukung_Nomor='".$DokPNo."',
		DokPendukung_Tanggal='".$DokPTg."',
		Recorded=now(),
		Pencatat='".$UID."' WHERE IDT='".$IdT."'";
		$rs = mysql_query($SQ);
	
		$data['IdT']  = $IdT;
		
		if ($rs) 
		{
			$data['Mess'] = "Update berhasil..!!";
		}
		else {
			$data['Mess'] = "Update tidak berhasil..!!";
		}
	}
}

if ($JnsNon=='FIIA17')
{
	if ($IdT=='')
	{
		$NeW = makeREF($UnT,$ThN);
		$SQ = "INSERT INTO ta_penerimaan_non_apbd SET 
		Tanggal='".$TgL."', 
		Referensi='".$NeW."', 
		JenisNonApbd='".$JnsNon."',
		Kd_Unit='".$UnT."',
		Id_Rekanan='".$PiHA."',
		JumlahBarang='".$JmLB."',
		SatuanBarang='".$SaTB."',
		HargaSatuan='".fConvertToNumeric($HrGB)."',
		TotalNilai='".$HrGT."',
		No_BAHI='".$NoBH."',
		Tg_BAHI='".$TgBH."',
		DokPendukung_Nama='".$DokPNm."',
		DokPendukung_Nomor='".$DokPNo."',
		DokPendukung_Tanggal='".$DokPTg."',
		Recorded=now(),
		Pencatat='".$UID."'";
		$rs = mysql_query($SQ);
		
		$data['IdT'] = fGlobal("max(IDT)","ta_penerimaan_non_apbd","Referensi","%","LIKE","","");
		
		if ($rs) {$data['Mess'] = "Proses berhasil..!!";}
		else {$data['Mess'] = "Proses tidak berhasil..!!";}
	}
	else
	{
		$SQ = "UPDATE ta_penerimaan_non_apbd SET 
		Tanggal='".$TgL."', 
		Id_Rekanan='".$PiHA."',
		JumlahBarang='".fConvertToNumeric($JmLB)."',
		SatuanBarang='".$SaTB."',
		HargaSatuan='".fConvertToNumeric($HrGB)."',
		TotalNilai='".$HrGT."',
		No_BAHI='".$NoBH."',
		Tg_BAHI='".$TgBH."',
		DokPendukung_Nama='".$DokPNm."',
		DokPendukung_Nomor='".$DokPNo."',
		DokPendukung_Tanggal='".$DokPTg."',
		Recorded=now(),
		Pencatat='".$UID."' WHERE IDT='".$IdT."'";
		$rs = mysql_query($SQ);
	
		$data['IdT']  = $IdT;
		
		if ($rs) 
		{
			$data['Mess'] = "Update berhasil..!!";
		}
		else {
			$data['Mess'] = "Update tidak berhasil..!!";
		}
	}
}

if ($JnsNon=='FIIA16')
{
	if ($IdT=='')
	{
		$NeW = makeREF($UnT,$ThN);
		$SQ = "INSERT INTO ta_penerimaan_non_apbd SET 
		Tanggal='".$TgL."', 
		Referensi='".$NeW."', 
		JenisNonApbd='".$JnsNon."',
		Kd_Unit='".$UnT."',
		Id_Rekanan='".$PiHA."',
		JumlahBarang='".$JmLB."',
		SatuanBarang='".$SaTB."',
		HargaSatuan='".fConvertToNumeric($HrGB)."',
		TotalNilai='".$HrGT."',
		No_BAST='".$NoBA."',
		Tg_BAST='".$TgBA."',
		
		DokPendukung_Nama='".$DokPNm."',
		DokPendukung_Nomor='".$DokPNo."',
		DokPendukung_Tanggal='".$DokPTg."',
		Recorded=now(),
		Pencatat='".$UID."'";
		$rs = mysql_query($SQ);
		
		$data['IdT'] = fGlobal("max(IDT)","ta_penerimaan_non_apbd","Referensi","%","LIKE","","");
		
		if ($rs) {$data['Mess'] = "Proses berhasil..!!";}
		else {$data['Mess'] = "Proses tidak berhasil..!!";}
	}
	else
	{
		$SQ = "UPDATE ta_penerimaan_non_apbd SET 
		Tanggal='".$TgL."', 
		Id_Rekanan='".$PiHA."',
		JumlahBarang='".fConvertToNumeric($JmLB)."',
		SatuanBarang='".$SaTB."',
		HargaSatuan='".fConvertToNumeric($HrGB)."',
		TotalNilai='".$HrGT."',
		No_BAST='".$NoBA."',
		Tg_BAST	='".$TgBA."',
		
		DokPendukung_Nama='".$DokPNm."',
		DokPendukung_Nomor='".$DokPNo."',
		DokPendukung_Tanggal='".$DokPTg."',
		Recorded=now(),
		Pencatat='".$UID."' WHERE IDT='".$IdT."'";
		$rs = mysql_query($SQ);
	
		$data['IdT']  = $IdT;
		
		if ($rs) 
		{
			$data['Mess'] = "Update berhasil..!!";
		}
		else {
			$data['Mess'] = "Update tidak berhasil..!!";
		}
	}
}

if ($JnsNon=='FIIA15')
{
	if ($IdT=='')
	{
		$NeW = makeREF($UnT,$ThN);
		$SQ = "INSERT INTO ta_penerimaan_non_apbd SET 
		Tanggal='".$TgL."', 
		Referensi='".$NeW."', 
		JenisNonApbd='".$JnsNon."',
		Kd_Unit='".$UnT."',
		Id_Rekanan='".$PiHA."',
		JumlahBarang='".$JmLB."',
		SatuanBarang='".$SaTB."',
		HargaSatuan='".fConvertToNumeric($HrGB)."',
		TotalNilai='".$HrGT."',
		No_BAST='".$NoBA."',
		Tg_BAST='".$TgBA."',
		
		Dokumen_Nama='".$DokNm."',
		Dokumen_Nomor='".$DokNo."',
		Dokumen_Tanggal='".$DokTg."',
		
		DokPendukung_Nama='".$DokPNm."',
		DokPendukung_Nomor='".$DokPNo."',
		DokPendukung_Tanggal='".$DokPTg."',
		Recorded=now(),
		Pencatat='".$UID."'";
		$rs = mysql_query($SQ);
		
		$data['IdT'] = fGlobal("max(IDT)","ta_penerimaan_non_apbd","Referensi","%","LIKE","","");
		
		if ($rs) {$data['Mess'] = "Proses berhasil..!!";}
		else {$data['Mess'] = "Proses tidak berhasil..!!";}
	}
	else
	{
		$SQ = "UPDATE ta_penerimaan_non_apbd SET 
		Tanggal='".$TgL."', 
		Id_Rekanan='".$PiHA."',
		JumlahBarang='".fConvertToNumeric($JmLB)."',
		SatuanBarang='".$SaTB."',
		HargaSatuan='".fConvertToNumeric($HrGB)."',
		TotalNilai='".$HrGT."',
		No_BAST='".$NoBA."',
		Tg_BAST	='".$TgBA."',
		
		Dokumen_Nama='".$DokNm."',
		Dokumen_Nomor='".$DokNo."',
		Dokumen_Tanggal='".$DokTg."',
		
		DokPendukung_Nama='".$DokPNm."',
		DokPendukung_Nomor='".$DokPNo."',
		DokPendukung_Tanggal='".$DokPTg."',
		Recorded=now(),
		Pencatat='".$UID."' WHERE IDT='".$IdT."'";
		$rs = mysql_query($SQ);
	
		$data['IdT']  = $IdT;
		
		if ($rs) 
		{
			$data['Mess'] = "Update berhasil..!!";
		}
		else {
			$data['Mess'] = "Update tidak berhasil..!!";
		}
	}
}

if ($JnsNon=='FIIA14')
{
	if ($IdT=='')
	{
		$NeW = makeREF($UnT,$ThN);
		$SQ = "INSERT INTO ta_penerimaan_non_apbd SET 
		Tanggal='".$TgL."', 
		Referensi='".$NeW."', 
		JenisNonApbd='".$JnsNon."',
		Kd_Unit='".$UnT."',
		Id_Rekanan='".$PiHA."',
		JumlahBarang='".$JmLB."',
		SatuanBarang='".$SaTB."',
		HargaSatuan='".fConvertToNumeric($HrGB)."',
		TotalNilai='".$HrGT."',
		No_BAST='".$NoBA."',
		Tg_BAST='".$TgBA."',
		Dasar_Hukum='".$DsrHuk."',
		DokPendukung_Nama='".$DokPNm."',
		DokPendukung_Nomor='".$DokPNo."',
		DokPendukung_Tanggal='".$DokPTg."',
		Recorded=now(),
		Pencatat='".$UID."'";
		$rs = mysql_query($SQ);
		
		$data['IdT'] = fGlobal("max(IDT)","ta_penerimaan_non_apbd","Referensi","%","LIKE","","");
		
		if ($rs) {$data['Mess'] = "Proses berhasil..!!";}
		else {$data['Mess'] = "Proses tidak berhasil..!!";}
	}
	else
	{
		$SQ = "UPDATE ta_penerimaan_non_apbd SET 
		Tanggal='".$TgL."', 
		Id_Rekanan='".$PiHA."',
		JumlahBarang='".fConvertToNumeric($JmLB)."',
		SatuanBarang='".$SaTB."',
		HargaSatuan='".fConvertToNumeric($HrGB)."',
		TotalNilai='".$HrGT."',
		No_BAST='".$NoBA."',
		Tg_BAST	='".$TgBA."',
		Dasar_Hukum='".$DsrHuk."',
		DokPendukung_Nama='".$DokPNm."',
		DokPendukung_Nomor='".$DokPNo."',
		DokPendukung_Tanggal='".$DokPTg."',
		Recorded=now(),
		Pencatat='".$UID."' WHERE IDT='".$IdT."'";
		$rs = mysql_query($SQ);
	
		$data['IdT']  = $IdT;
		
		if ($rs) 
		{
			$data['Mess'] = "Update berhasil..!!";
		}
		else {
			$data['Mess'] = "Update tidak berhasil..!!";
		}
	}
}

if ($JnsNon=='FIIA13')
{
	if ($IdT=='')
	{
		$NeW = makeREF($UnT,$ThN);
		$SQ = "INSERT INTO ta_penerimaan_non_apbd SET 
		Tanggal='".$TgL."', 
		Referensi='".$NeW."', 
		JenisNonApbd='".$JnsNon."',
		Kd_Unit='".$UnT."',
		Id_Rekanan='".$PiHA."',
		JumlahBarang='".$JmLB."',
		SatuanBarang='".$SaTB."',
		HargaSatuan='".fConvertToNumeric($HrGB)."',
		TotalNilai='".$HrGT."',
		
		Dokumen_Nama='".$DokNm."',
		Dokumen_Nomor='".$DokNo."',
		Dokumen_Tanggal='".$DokTg."',
		
		Nm_Kontrak='".$NmKo."',
		No_Kontrak='".$NoKo."',
		Tg_Kontrak='".$TgKo."',
		
		DokPendukung_Nama='".$DokPNm."',
		DokPendukung_Nomor='".$DokPNo."',
		DokPendukung_Tanggal='".$DokPTg."',
		Recorded=now(),
		Pencatat='".$UID."'";
		$rs = mysql_query($SQ);
		
		$data['IdT'] = fGlobal("max(IDT)","ta_penerimaan_non_apbd","Referensi","%","LIKE","","");
		
		if ($rs) {$data['Mess'] = "Proses berhasil..!!";}
		else {$data['Mess'] = "Proses tidak berhasil..!!";}
	}
	else
	{
		$SQ = "UPDATE ta_penerimaan_non_apbd SET 
		Tanggal='".$TgL."', 
		Id_Rekanan='".$PiHA."',
		JumlahBarang='".fConvertToNumeric($JmLB)."',
		SatuanBarang='".$SaTB."',
		HargaSatuan='".fConvertToNumeric($HrGB)."',
		TotalNilai='".$HrGT."',
		
		Dokumen_Nama='".$DokNm."',
		Dokumen_Nomor='".$DokNo."',
		Dokumen_Tanggal='".$DokTg."',
		
		Nm_Kontrak='".$NmKo."',
		No_Kontrak='".$NoKo."',
		Tg_Kontrak='".$TgKo."',
		
		DokPendukung_Nama='".$DokPNm."',
		DokPendukung_Nomor='".$DokPNo."',
		DokPendukung_Tanggal='".$DokPTg."',
		
		Recorded=now(),
		Pencatat='".$UID."' WHERE IDT='".$IdT."'";
		$rs = mysql_query($SQ);
	
		$data['IdT']  = $IdT;
		
		if ($rs) 
		{
			$data['Mess'] = "Update berhasil..!!";
		}
		else {
			$data['Mess'] = "Update tidak berhasil..!!";
		}
	}
}
if ($JnsNon=='FIIA12')
{
	if ($IdT=='')
	{
		$NeW = makeREF($UnT,$ThN);
		$SQ = "INSERT INTO ta_penerimaan_non_apbd SET 
		Tanggal='".$TgL."', 
		Referensi='".$NeW."', 
		JenisNonApbd='".$JnsNon."',
		Kd_Unit='".$UnT."',
		Id_Rekanan='".$PiHA."',
		JumlahBarang='".$JmLB."',
		SatuanBarang='".$SaTB."',
		HargaSatuan='".fConvertToNumeric($HrGB)."',
		TotalNilai='".$HrGT."',
		Sumber_Dana='".$RaDB."',
		No_BAST='".$NoBA."',
		Tg_BAST	='".$TgBA."',
		DokPendukung_Nama='".$DokPNm."',
		DokPendukung_Nomor='".$DokPNo."',
		DokPendukung_Tanggal='".$DokPTg."',
		Recorded=now(),
		Pencatat='".$UID."'";
		$rs = mysql_query($SQ);
		
		$data['IdT'] = fGlobal("max(IDT)","ta_penerimaan_non_apbd","Referensi","%","LIKE","","");
		
		if ($rs) {$data['Mess'] = "Proses berhasil..!!";}
		else {$data['Mess'] = "Proses tidak berhasil..!!";}
	}
	else
	{
		$SQ = "UPDATE ta_penerimaan_non_apbd SET 
		Tanggal='".$TgL."', 
		Id_Rekanan='".$PiHA."',
		JumlahBarang='".fConvertToNumeric($JmLB)."',
		SatuanBarang='".$SaTB."',
		HargaSatuan='".fConvertToNumeric($HrGB)."',
		TotalNilai='".$HrGT."',
		Sumber_Dana='".$RaDB."',
		No_BAST='".$NoBA."',
		Tg_BAST	='".$TgBA."',
		DokPendukung_Nama='".$DokPNm."',
		DokPendukung_Nomor='".$DokPNo."',
		DokPendukung_Tanggal='".$DokPTg."',
		Recorded=now(),
		Pencatat='".$UID."' WHERE IDT='".$IdT."'";
		$rs = mysql_query($SQ);
	
		$data['IdT']  = $IdT;
		
		if ($rs) 
		{
			$data['Mess'] = "Update berhasil..!!";
		}
		else {
			$data['Mess'] = "Update tidak berhasil..!!";
		}
	}
}

function makeREF($UnT,$ThN)
{
	$MaK = fGlobal("max(Referensi)","ta_penerimaan_non_apbd","Referensi","%/NONAPBD/".$UnT."/".$ThN,"LIKE","","");
	if ($MaK!='')
	{
		$NeW = explode('/',$MaK);
		$NeW = (int)$NeW[0]+1;
		$NeW = substr('00000'.$NeW,-5,5)."/NONAPBD/".$UnT."/".$ThN;
	}
	else
	{
		$NeW = "00001/NONAPBD/".$UnT."/".$ThN;
	}
	return $NeW;
}

echo json_encode($data);
?>
