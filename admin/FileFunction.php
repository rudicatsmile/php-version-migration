<?php
date_default_timezone_set('Asia/Jakarta');
ini_set('max_execution_time', 10000);
$KdProp = "25";					//Kode Provinsi
$KdKabK = "08";					//Kode Kab./Kota.

$tTbl=2026;
$uTbl=0;

$TiDaer = "KABUPATEN";
$NmDaer = "HULU SUNGAI TENGAH";
$NmIbuk = "Barabai";
$NmProv = "KALIMATAN SELATAN";
$Almat1 = "-";
$Almat2 = "-";
$Almat3 = "Website : www.hstkab.go.id";

function funcDayBI($xB)
{
	$daynm = array("Sunday" => "Minggu", "Monday" => "Senin", "Tuesday" => "Selasa", "Wednesday" => "Rabu", "Thrusday" => "Kamis", "Friday" => "Jum'at", "Saturday" => "Sabtu");
	return $daynm[$xB];
}

#mysql_real_escape_string();
#addslashes();

$DataPerPageF=0;

function PostingFromKIB($gREF,$gGRP,$gREG,$gUPB,$gAST,$gTGL,$gURA,$gNIL,$gNOM,$gKTR,$DatabaseSB,$ConSB)
{
	CallConnection($DatabaseSB,$ConSB);
	$SQA="INSERT INTO ta_kib_post SET 
	Referensi='$gREF',
	Ref_Group='$gGRP',
	Kd_UPB='$gUPB',
	Kd_Aset='$gAST',
	No_Register='$gREG',
	Crit='SLD',
	Tanggal='$gTGL',
	Tmbh_Ms_Manfaat='TIDAK',
	Uraian='$gURA',
	DK='D',
	Debet='$gNIL',
	Kredit=0,
	No_Pengadaan='$gNOM',
	Keterangan='$gKTR',
	Recorded=now(),
	Pencatat='PostingFromKIB'";
	$RsA = mysql_query($SQA) or die(mysql_error());
}
		
function AddTable($mP,$ScripT,$DatabaseSB,$ConSB)
{
	CallConnection($DatabaseSB,$ConSB);
	$SqW="SHOW tables like '$mP'";
	$Rs = mysql_query($SqW);
	if(mysql_num_rows($Rs)==0)
	{
		$SqT=$ScripT;
		$RsT = mysql_query($SqT);
	}
}

function findMasaManfaat($mP,$DatabaseSB,$ConSB)
{
	mysql_select_db($DatabaseSB,$ConSB);
	$mD = fGlobal("Ms_Manfaat","ref_rek_aset108_7","Kd_Aset:Ms_Manfaat",$mP.":0","=:>","","");
	if ($mD==""){$mD=0;}
	return $mD;
}


function checkSusutkanTidak($mP,$DatabaseSB,$ConSB,$fSH)
{
	mysql_select_db($DatabaseSB,$ConSB);
	$xD = fGlobal("Ms_Manfaat","ref_rek_aset108_7","Kd_Aset:Ms_Manfaat",$mP.":0","=:>","",$fSH);
	if ($xD==""){$xD = 0;}
	return $xD;
}

function checkMasaManfaat($mP,$DatabaseSB,$ConSB)
{
	mysql_select_db($DatabaseSB,$ConSB);
	$mD = 0;
	$xD = fGlobal("Ms_Manfaat","ref_rek_aset5","Kd_Aset:Ms_Manfaat",$mP.":0","=:>","","");
	if ($xD){
		#Level Rincian Objek
		$mD = $mP;
	}
	else {
		$xD = fGlobal("Ms_Manfaat","ref_rek_aset4","Kd_Aset:Ms_Manfaat",substr($mP,0,11).":0","=:>","","");
		if ($xD){
			#Level Objek
			$mD = substr($mP,0,11);
		}
		else{
			#Level Jenis
			$mD = substr($mP,0,8);
		}
	}
	return $mD;
}

function checkMasaManfaat108($mP,$DatabaseSB,$ConSB)
{
	mysql_select_db($DatabaseSB,$ConSB);
	$mD = 0;
	$xD = fGlobal("Ms_Manfaat","ref_rek_aset108_7","Kd_Aset:Ms_Manfaat",$mP.":0","=:>","","");
	if ($xD)
	{
		$mD = $mP;
	}
	return $mD;
}

function datediff($tgl1, $tgl2)
{
	$tgl1 = (is_string($tgl1) ? strtotime($tgl1) : $tgl1);
	$tgl2 = (is_string($tgl2) ? strtotime($tgl2) : $tgl2);
	$diff_secs = abs($tgl2-$tgl1);
	$base_year = min(date("Y", $tgl1), date("Y", $tgl2));
	$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
	
	return array( 
	"year" => date("Y", $diff) - $base_year,
	"month_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
	"month" => date("n", $diff) - 1,
	"day_total" => floor($diff_secs / (3600 * 24)),
	"day" => date("j", $diff) - 1,
	"hour_total" => floor($diff_secs / 3600),
	"hour" => date("G", $diff),
	"minute_total" => floor($diff_secs / 60),
	"minute" => (int) date("i", $diff),
	"second_total" => $diff_secs,
	"second" => (int) date("s", $diff)."&nbsp; ");
}

function TakeTglThnMendatang($rTG,$rBL,$rTH,$PL)
{
	
	return $rTH+$PL."-".$rBL."-".$rTG;
}

function TakeTglThnMendatangKibB($rTG,$rBL,$rTH,$PL)
{
	list($today,$thisMonth,$thisYear) = explode(" ", "".$rTG." ".$rBL." ".$rTH);
	return date("Y-n-j", mktime(0,0,0, $thisMonth+0, $today+0, $thisYear+$PL));
}

function HitJmlHari($TG1,$TG2,$fSH)
{
	if ($fSH!="") {echo $TG1." : ".$TG2."<br>";}
	$pecah1 = explode("-", $TG1);
	$date1  = $pecah1[2];
	$month1 = $pecah1[1];
	$year1  = $pecah1[0];
	 
	$pecah2 = explode("-", $TG2);
	$date2  = $pecah2[2];
	$month2 = $pecah2[1];
	$year2  =  $pecah2[0];
	 
	$jd1 = GregorianToJD($month1,$date1,$year1);
	$jd2 = GregorianToJD($month2,$date2,$year2);
	 
	$selisih = abs($jd2 - $jd1);
	return $selisih;
}

function HitJmlBulan($TG1,$TG2,$fSH)
{
	$timeStart = strtotime("$TG1");
	$timeEnd   = strtotime("$TG2");
	$numBulan = 0 + (date("Y",$timeEnd) - date("Y",$timeStart))*12;
	$numBulan += date("m",$timeEnd) - date("m",$timeStart);
	$selisih = abs($numBulan);
	return $selisih;
}


function fGetDate($nVr)
{
    /*
	[seconds] => 40			Numeric representation of seconds						: 0 to 59	
    [minutes] => 58			Numeric representation of minutes						: 0 to 59
    [hours]   => 21			Numeric representation of hours							: 0 to 23
    [mday]    => 17			Numeric representation of the day of the month			: 1 to 31
    [wday]    => 2			Numeric representation of the day of the week			: 0 (for Sunday) through 6 (for Saturday)
    [mon]     => 6			Numeric representation of a month						: 1 through 12
    [year]    => 2003		A full numeric representation of a year, 4 digits		: Examples: 1999 or 2003
    [yday]    => 167		Numeric representation of the day of the year			: 0 through 365
    [weekday] => Tuesday	A full textual representation of the day of the week	: Sunday through Saturday
    [month]   => June		A full textual representation of a month, such as January or March		: January through December	
    [0]       => 1055901520	Seconds since the Unix Epoch, similar to the values returned by time() and used by date(). 	: System Dependent, typically -2147483648 through 2147483647. 
	*/
	$mArr = getdate();
	return $mArr[$nVr];
}


function ChangeNmOrLenghtField($nTBL,$nFLD,$mFLD,$nLHT,$mTYP,$mLHT,$nDEF,$gDatabase,$gCon)
{
	CallConnection($gDatabase,$gCon);
	$iB=0;
	$nSD=mysql_query("SELECT * FROM $nTBL LIMIT 0,1");
	while($iB< mysql_num_fields($nSD))
	{
		$meta   = mysql_fetch_field($nSD,$iB);
		$length = mysql_field_len($nSD,$iB);
		$iB++;
		if ($meta->name==$nFLD && $length==(int)$nLHT)
		{
			$SQD= "ALTER TABLE ".$nTBL." CHANGE COLUMN ".$nFLD." ".$mFLD." ".$mTYP."(".$mLHT.") NULL DEFAULT '".$nDEF."'";
			$nRs= mysql_query($SQD);
		}
	}
}

function AddField($nTbl,$nField,$nType,$nNull,$nDefa,$nAfter,$nIdx,$gDatabase,$gCon)
{
	CallConnection($gDatabase,$gCon);
	$JumFld=0;
	if ($nDefa !="") {$nDefa = "default '".$nDefa."'";} else {$nDefa = "default ''";}
	if ($nAfter!="") {$nAfter= "AFTER ".$nAfter;} else {$nAfter="";}
	
	$JumFld = HitField($nTbl,$nField);
	if ($JumFld == 0)
	{
		$sqlC="ALTER TABLE ".$nTbl." ADD ".$nField." ".$nType." ".$nNull." ".$nDefa." ".$nAfter;
		$nRs = mysql_query($sqlC) or die(mysql_error());
		if ($nIdx==1)
		{
			$sqlC="ALTER TABLE ".$nTbl." ADD INDEX ".$nField." (".$nField.")";
			$nRs = mysql_query($sqlC) or die(mysql_error());
		}
	}
}

function AddIndex($nTbl,$nField)
{
	$sqlA="SHOW Keys FROM ".$nTbl." WHERE Key_name='".$nField."'";
	$nRsA = mysql_query($sqlA) or die(mysql_error());
	$tRoA = mysql_num_rows($nRsA);
	if ($tRoA==0)
	{
		$sqlC="ALTER TABLE ".$nTbl." ADD INDEX ".$nField." (".$nField.")";
		$nRs = mysql_query($sqlC) or die(mysql_error());
	}
}

function HitField($nTbl,$nFild)
{
	$tJm = 0;
	$nSQ = "SHOW FIELDS FROM ".$nTbl;
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{
			if ($mRo['Field']==$nFild)
			{
				$tJm++;
			}
		}
		while ($mRo = mysql_fetch_assoc($nRs));	
	}
	return $tJm;
}

function fViewLimit($tTxt,$tDgt)
{
	if (strlen($tTxt) > $tDgt) {return substr($tTxt,0,80)."....";}
	else {return $tTxt;}
}

function fBackCLR($tNum)
{
	$tNum = $tNum%2;
	if ($tNum==0) {return "bgcolor='#F4F1F1'";}
	if ($tNum!=0) {return "bgcolor='#ffffff'";}
}

function TxBckCLR($tNum)
{
	$tNum = $tNum%2;
	if ($tNum==0) {return "background:#F4F1F1;";}
	if ($tNum!=0) {return "background:#ffffff;";}
}

function fNmHuruf($nX)
{
	$NmArr = array ('','a','b','c','d','e','f','g','h','i','j','k','l',"m","n","o","p","q","r","s","u");
	return $NmArr[$nX];
}

function fStrukKdLokasi($qMLK,$qKdProp,$qKdKabK,$qUnt,$qSub,$qThn)
{
	if ($qMLK=="__" || $qMLK=="All")
	{
		$KdKomp = "XX";
	}
	else
	{
		$KdKomp = $qMLK;			//Kode Komponen Kepemilikan
	}
	$KdProp = $qKdProp;					//Kode Provinsi
	$KdKabK = $qKdKabK;					//Kode Kab./Kota.
	if ($qUnt=="")
	{
		$KdBida = "XX";	//Kode Bidang
		$KdUnit = "XX";	//Kode Unit
		$KdSubU = "XX";		//Kode Sub Unit
	}
	else
	{
		
		$KdBida = substr($qUnt,6,2);	//Kode Bidang
		$KdUnit = substr($qUnt,9,2);	//Kode Unit
		if ($qSub=="")
		{
			$KdSubU = "XX";		//Kode Sub Unit
		}
		else
		{
			$KdSubU = substr($qSub,-2);		//Kode Sub Unit
		}
	}
	
	if ($qThn=="____" || $qThn=="%" || $qThn=="All")
	{
		$KdTahu = "XX";
	}
	else
	{
		$KdTahu = substr($qThn,-2);		//Tahun Pembelian
	}
	$gLok = $KdKomp.".".$KdProp.".".$KdKabK.".".$KdBida.".".$KdUnit.".".$KdTahu.".".$KdSubU;
	
	return $gLok;
}

function fNmBulan($nX)
{
	$nX = (int)$nX;
	$NmBulan = array ('','Januari','Februari','Maret','April',
	'Mei','Juni','Juli','Agustus',
	'September','Oktober','November','Desember');
	return $NmBulan[$nX];
}

function fNmBulanShort($nX)
{
	$NmBulan = array ('','Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Oct','Nov','Des');
	return $NmBulan[$nX];
}

function fLevelUser($nX)
{
	$NmLevel = array ('Creator','Administrator','Unit','Sub Unit','UPB');
	return $NmLevel[$nX];
}

function fLevelAdmin($nX)
{
	$NmLevel = array ('Reguler','Admin');
	return $NmLevel[$nX];
}

function fBckGround($nY)
{
	if ($nY % 2==0)
		{
		//$fBcG="E6E6E6";
		$fBcG="FFFFFF";
		}
	else
		{$fBcG="FFFFFF";}
	return $fBcG;

}
function fMakeReferensi($gRefVr,$nDgT)
{
	$NewKRf = substr("00000000000".$gRefVr,-$nDgT,strlen("00000000000".$gRefVr));
	return $NewKRf;
}

function MakeNewNoRegiterAuto($rf,$fS)
{
	$rNeK = (int)fGlobal("ifnull(max(no_register),0)","ta_kib_108","referensi:no_register NOT",$rf."%:%HEX%","LIKE:LIKE","",$fS);
	$rNeB = (int)fGlobal("ifnull(max(no_register),0)","ta_kib_108_mutasi","referensi:no_register NOT",$rf."%:%HEX%","LIKE:LIKE","",$fS);
	$rNeC = (int)fGlobal("ifnull(max(no_register),0)","ta_kib_108_merger_his","referensi:no_register NOT",$rf."%:%HEX%","LIKE:LIKE","",$fS);
	
	if ($rNeB > $rNeK){$rNeK = $rNeB;}
	if ($rNeC > $rNeK){$rNeK = $rNeC;}
	
	if ($rNeK){ $rNeK = ((int)$rNeK)+1;}
	else{$rNeK = 1;}
	
	return fMakeRegister($rNeK,7);
}

function fMakeRegister($gRefVr,$nDgT)
{
	$NewKRg = substr("0000000".$gRefVr,-$nDgT,strlen("0000000".$gRefVr));
	return $NewKRg;
}

function fConvertToRupiah($Angka)
{
	return number_format($Angka, 2, ",", ".");
	#return number_format($Angka, 0, ",", ".");
}

function fConvertToRupiah2dgt($Angka)
{
	return number_format($Angka, 2, ",", ".");
}

function fConvertToRupiahBulat($Angka)
{
	//return number_format($Angka);
	return number_format($Angka,0, "", ".");
}

function fConvert4Digit($mPin)
{
	return strrev(implode('-',str_split(strrev(strval($mPin)),4)));
}

function fConvertDateShort($mDt)
{
	if ($mDt!='0000-00-00')
	{
		$mD = (int)substr($mDt,8,10);
		$mB = (int)substr($mDt,5,-3);
		$mT = (int)substr($mDt,0,-3);
		return substr("00".$mD,-2,2)."/".substr("00".$mB,-2,2)."/".$mT;
	}
	else
	{
	return "-";
	}
}

function fConvertDateFull($mDt)
{
	if ($mDt=='0000-00-00')
	{
		return "-";
	}
	else
	{
		$mD = (int)substr($mDt,8,10);
		$mB = (int)substr($mDt,5,-3);
		$mT = (int)substr($mDt,0,-3);
		$aa = explode(' ',$mDt);
		$bb = $aa[1];
		return substr("00".$mD,-2,2)."/".substr("00".$mB,-2,2)."/".$mT.' '.$bb;
	}
}

function fDatePARSE($gTD,$gVe)
{
	$gTF = date_parse($gTD);
	return $gTF[$gVe];
}

function NmaSemester($x)
{
	$Arr=array('','Semester I','Semester II');
	return $Arr[$x];
}

function fNmBulanLong($nX)
{
	$NmBulan = array ('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
	return $NmBulan[$nX];
}

function fConvertDateShortBln($mDt)
{
	$mD = (int)substr($mDt,8,10);
	$mB = (int)substr($mDt,5,-3);
	$mT = (int)substr($mDt,0,-3);
	return substr("00".$mD,-2,2)." ".fNmBulanShort($mB)." ".$mT;
}

function fConvertDateLongsBln($mDt)
{
	$mD = (int)substr($mDt,8,10);
	$mB = (int)substr($mDt,5,-3);
	$mT = (int)substr($mDt,0,-3);
	return substr("00".$mD,-2,2)." ".fNmBulan($mB)." ".$mT;
}

function fFormatDateQuery($xTg,$xBl,$xTh)
{
	return $xTh."-".$xBl."-".$xTg;
}

function SumberDnXX($nX)
{
	$NmSbR = array('','DAU','DAK','PAD','DBH PAJAK','DBH SDA KEHUTANAN','DBH SDA PERTAMBANGAN','DBH SDA PERIKANAN','DBH CHT','DBH PAJAK DARI PROVINSI','HIBAH','DANA PENYESUAIAN','SILPA DBH/DAK DR','SILPA DAK NON DR','SILPA','PENE. PEMBIAYAAN','BANTUAN KEU.PROV.','SPK');
	return $NmSbR[$nX];
}

function SumberDn($nX)
{
	$NmSbR = fGlobal("Alias","ref_sumber_dana","Kode",$nX,"=","","");
	return $NmSbR;
}

function atasiKutif($gTX)
{
	return mysql_real_escape_string($gTX);
}

function CekKey($SK,$ThN,$KiB,$fS)
{
	if ((int)$ThN<=2013) {$ThN=2013;}
	$KeY=fGlobal($KiB,"ta_kib_lock","SKPD:Tahun",$SK.":".$ThN,"=:=","",$fS);
	return $KeY;
}

function CekRefToNmTbl($rR)
{
	$xArr = array("TNH" => "a", "ALT" => "b", "BNG" => "c", "JLN" => "d", "ATL" => "e", "KDP" => "f", "KDL" => "g");
	return $xArr[strtoupper(substr($rR,0,3))];
}

function AwalRef108($rR)
{
	$xArr = array("1.3.1" => "TNH", "1.3.2" => "ALT", "1.3.3" => "BNG", "1.3.4" => "JLN", "1.3.5" => "ATL", "1.3.6" => "KDP", "1.5.2" => "KP3", "1.5.3" => "ATB", "1.5.4" => "KDL");
	return $xArr[strtoupper($rR)];
}

function fNmHuruf108($rR)
{
	$xArr = array("1.3.1" => "a", "1.3.2" => "b", "1.3.3" => "c", "1.3.4" => "d", "1.3.5" => "e", "1.3.6" => "f", "1.5.4" => "g");
	return $xArr[$rR];
}

function fMakeDateToDB($HR,$BL,$TH)
{
	$NewTG = $TH."-".substr('00'.$BL,-2,2)."-".substr('00'.$HR,-2,2);
	return $NewTG;
}

function ReplaceTextPHP($TX)
{
	return str_replace('**',' ',$TX);
}

function fNmAngka($nX)
{
	$NmA = array ('','satu','dua','tiga','empat','lima','enam','tujuh','delapan','sembilan','sepuluh','sebelas','dua belas');
	return $NmA[$nX];
}

function fMakeDate($a,$b,$c)
{
	return $c."-".substr("00".$b,-2,2)."-".substr("00".$a,-2,2);
}

function TChek($CkR,$Text,$w)
{
	if ($CkR=='checked')
	{
		$tIMG = "<img src='../Images/checkada.gif' style='width:18px; height:18px'/>";
	}
	else {
		$tIMG = "<img src='../Images/checktidakada.gif' style='width:18px; height:16px'/>";
	}
	return "<table border='0' width='".$w."' cellspacing='0' cellpadding='0'><tr><td width='23'>".$tIMG."</td><td>".$Text."</td></tr></table>";
}

function fNmDaerah($rR)
{
	$xArr = array("PD" => "Pemerintah Daerah", "PDL" => "Pemerintah Daerah Lainnya", "PP" => "Pemerintah Pusat", "PL" => "Pihak Lainnya");
	return $xArr[$rR];
}

function fNmKondisi($rR)
{
	$xArr = array("00" => "Semua Kondisi", "B" => "Baik (B)", "RR" => "Rusak Ringan (RR)", "RB" => "Rusak Berat (RB)");
	return $xArr[$rR];
}

function rekonsPh1($mdl)
{
	$modar = array("V1" => "Pengurus Barang Pengguna", "V2" => "Pengurus Barang Pengguna", "V3" => "Pengurus Barang Pengguna", "V4" => "Pengurus Barang Pengelola");
	return $modar[$mdl];
}

function rekonsPh2($mdl)
{
	$modar = array("V1" => "Pengurus Barang Pembantu", "V2" => "Pengurus Barang Pengelola", "V3" => "Pelaksana Akuntansi", "V4" => "Pelaksana Akuntansi");
	return $modar[$mdl];
}

function terbilang($angka)
{
    $angka = (float)$angka;
    $bilangan = array(
            '',
            'satu',
            'dua',
            'tiga',
            'empat',
            'lima',
            'enam',
            'tujuh',
            'delapan',
            'sembilan',
            'sepuluh',
            'sebelas'
    );
     
    if ($angka < 12) {
        return $bilangan[$angka];
    } else if ($angka < 20) {
        return $bilangan[$angka - 10] . ' belas';
    } else if ($angka < 100) {
        $hasil_bagi = (int)($angka / 10);
        $hasil_mod = $angka % 10;
        return trim(sprintf('%s puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
    } else if ($angka < 200) {
        return sprintf('seratus %s', terbilang($angka - 100));
    } else if ($angka < 1000) {
        $hasil_bagi = (int)($angka / 100);
        $hasil_mod = $angka % 100;
        return trim(sprintf('%s ratus %s', $bilangan[$hasil_bagi], terbilang($hasil_mod)));
    } else if ($angka < 2000) {
        return trim(sprintf('seribu %s', terbilang($angka - 1000)));
    } else if ($angka < 1000000) {
        $hasil_bagi = (int)($angka / 1000);
        $hasil_mod = $angka % 1000;
        return sprintf('%s ribu %s', terbilang($hasil_bagi), terbilang($hasil_mod));
    } else if ($angka < 1000000000) {
        $hasil_bagi = (int)($angka / 1000000);
        $hasil_mod = $angka % 1000000;
        return trim(sprintf('%s juta %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
    } else if ($angka < 1000000000000) {
        $hasil_bagi = (int)($angka / 1000000000);
        $hasil_mod = fmod($angka, 1000000000);
        return trim(sprintf('%s milyar %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
    } else if ($angka < 1000000000000000) {
        $hasil_bagi = $angka / 1000000000000;
        $hasil_mod = fmod($angka, 1000000000000);
        return trim(sprintf('%s triliun %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
    } else {
        return '......';
    }
}

function gNmPrBG($xU)
{
	$fArr=array('MURNI','PERUBAHAN');
	return $fArr[$xU];
}

?>