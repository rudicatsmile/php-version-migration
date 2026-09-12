<?
//echo "xxxxxxx";
//return false;
$nSQ = "SELECT Referensi,Kd_Unit,Nomor,Tanggal,Dokumen_Nom,Dokumen_Tgl,Uraian FROM ta_permohonan_repla_rek_aset WHERE IDT='$IdT'";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$RefU= $mRo[0];
	$rID = fGlobal("IDT","ta_permohonan_repla_rek_aset_verifikasi","Ref_Usulan",$RefU,"=","","");
	if (!$rID)
	{
		$gNeW = 1;
		$rMax = fGlobal("max(Referensi)","ta_permohonan_repla_rek_aset_verifikasi","Referensi","VER.".fGetDate('year')."%","LIKE","","");
		if ($rMax)
		{
			$gNeW = (int)substr($rMax,-8,8)+1;
		}
		
		$gREF = "VER.".fGetDate('year').".".substr(str_repeat('0',8).$gNeW,-8,8);

		$gTG = $gTH = fGetDate('year')."-".$gBL = fGetDate('mon')."-".$gBL = fGetDate('mday');
		$SQ = "INSERT INTO ta_permohonan_repla_rek_aset_verifikasi SET 
		Referensi='$gREF',
		Ref_Usulan='$RefU',
		Kd_Unit='".$mRo[1]."',
		Nomor='',
		Tanggal='$gTG',
		Nma_Verifikator='',
		Jab_Verifikator='',
		Nip_Verifikator='',
		Uraian=''";
		$Rs = mysql_query($SQ);
		$rID = fGlobal("max(IDT)","ta_permohonan_repla_rek_aset_verifikasi","IDT","%","LIKE","","");
	}
	
	$SQ = "UPDATE ta_permohonan_repla_rek_aset SET OpenRec='Y' WHERE IDT='$IdT'";
	$Rs = mysql_query($SQ);
}

?>