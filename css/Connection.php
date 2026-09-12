<?
date_default_timezone_set('Asia/Jakarta');
define('TxReadOnly','Mohon maaf, akses data hanya readonly..!!');
define('HostnameSB','localhost');
define('DatabaseSB','simbada_barsel_data');
define('UsernameSB','simbada');
define('PasswordSB','simbada2000');
define('Port','3306');
$gPCT = "";
$ConSB = mysql_connect(HostnameSB.":".Port, UsernameSB, PasswordSB);
if ($ConSB==false)
{
	echo "Error: <font color='#FF0000'>Koneksi ke server tidak berhasil...!!</font>";
	exit;
}

function CallConnection($gDatabase,$gCon)
{
	$SelDA =  mysql_select_db($gDatabase, $gCon);
	if ($SelDA==false)
	{
		echo "Error: Database <font color='#FF0000'><b>".$gDatabase."</b></font> tidak ditemukan...!!";
		exit;
	}
}

CallConnection(DatabaseSB,$ConSB);

function fConvertToNumeric($Angka)
{
	if ($Angka=="")
	{
		return 0;
	}
	else
	{
		$CnvR = str_replace('.', '',$Angka);
		$CnvR = str_replace(',', '.',$CnvR);
		return $CnvR;
	}
}

function fFindData($nFnd,$UID,$gSh)
{
	return fGlobal($nFnd,"ta_user","User_ID",$UID,"=","",$gSh);
}

function fFindUID($nIdL,$nFnd)
{
	$UID=fGlobal("User_ID","ta_user_log","IDT",$nIdL,"=","","");
	$UID=fGlobal($nFnd,"ta_user","User_ID",$UID,"=","","");
	return $UID;
}

function fHiSplitT2K($DataG,$xChr)
{
	$cTtK="";
	foreach (count_chars($DataG, 1) as $i => $val)
	{if (chr($i)==$xChr) {$cTtK = $val;}}
	return $cTtK;
}

function fGlobalNEW($nFldD,$nTbl,$nFldF,$nSyR,$fArtM,$nOdr,$NmDB,$NmCon,$fShow)
{
	//$fGlobal="";
	$JmLa=fHiSplitT2K($nFldD,":");
	$JmLb=fHiSplitT2K($nFldF,":");
	
	$fArtM = str_replace("Like", "LIKE",$fArtM);
	$fArtM = str_replace("like", "LIKE",$fArtM);
	
	if ($JmLb > 0 )
	{
		$SxR = split(':', $nFldF);
		$SyR = split(':', $nSyR);
		if ($fArtM!="") {$ArT = split(':', $fArtM);}
		for ($iGL=0; $iGL<=$JmLb; $iGL++)
		{
			if ($fArtM!="") {$fOpr=$ArT[$iGL];} else {$fOpr="LIKE";}
			
			if ($iGL==0)
			{$zFldF = $SxR[$iGL]." ".$fOpr." '".$SyR[$iGL]."'";}
			else
			{$zFldF = $zFldF." AND ".$SxR[$iGL]." ".$fOpr." '".$SyR[$iGL]."'";}
		}
	}
	else
	{
		if ($fArtM!="") {$fOpr=$fArtM;} else {$fOpr="LIKE";}
		$zFldF= $nFldF." ".$fOpr." '".$nSyR."'";
	}
	
	$nFldD = str_replace("IfNull", "IFNULL",$nFldD);
	$nFldD = str_replace("Ifnull", "IFNULL",$nFldD);
	$nFldD = str_replace("ifnull", "IFNULL",$nFldD);
	
	$nFldD = str_replace("sum", "SUM",$nFldD);
	$nFldD = str_replace("Sum", "SUM",$nFldD);
	
	$nFldD = str_replace("Count", "COUNT",$nFldD);
	$nFldD = str_replace("count", "COUNT",$nFldD);
	
	$nFldD = str_replace("Max", "MAX",$nFldD);
	$nFldD = str_replace("max", "MAX",$nFldD);
	
	$nFldD = str_replace("Min", "MIN",$nFldD);
	$nFldD = str_replace("min", "MIN",$nFldD);
	
	$nFldD = str_replace("Desc", "DESC",$nFldD);
	$nFldD = str_replace("desc", "DESC",$nFldD);

	$nFldD = str_replace("Limit", "LIMIT",$nFldD);
	$nFldD = str_replace("limit", "LIMIT",$nFldD);

	if ($nOdr!="") { $nOdr=" ORDER BY ".$nOdr;}
	if ($JmLa > 0) {$SQGL="SELECT ".str_replace(":", ", ",$nFldD)." FROM ".strtolower($nTbl)." WHERE ".$zFldF.$nOdr;}
	else {$SQGL="SELECT ".str_replace(":", ", ",$nFldD)." AS FldD FROM ".strtolower($nTbl)." WHERE ".$zFldF.$nOdr;}
	if ($fShow!="") {echo $SQGL."<br>";}
	mysql_select_db($NmDB, $NmCon);
	$nRstGlo = mysql_query($SQGL) or die(mysql_error());
	$mRowGlo = mysql_fetch_assoc($nRstGlo);
	$tRowGlo = mysql_num_rows($nRstGlo);
	if ($tRowGlo > 0)
	{
		if ($JmLa > 0)
		{
			$Sx=split(':',$nFldD);
			for ($iGL=0; $iGL<=$JmLa; $iGL++)
			{
				if ($iGL==0)
					{$zFldD=$mRowGlo[$Sx[$iGL]];}
				else
					{$zFldD=$zFldD.":".$mRowGlo[$Sx[$iGL]];}
			}
			return $zFldD;
		}
		else
		{
			return $mRowGlo['FldD'];
		}
	}
}

function fGlobal($nFldD,$nTbl,$nFldF,$nSyR,$fArtM,$nOdr,$fShow)
{
	$fGlobal="";
	$JmLa=fHiSplitT2K($nFldD,":");
	$JmLb=fHiSplitT2K($nFldF,":");
	
	$fArtM = str_replace("Like", "LIKE",$fArtM);
	$fArtM = str_replace("like", "LIKE",$fArtM);
	
	if ($JmLb > 0 )
	{
		$SxR = split(':', $nFldF);
		$SyR = split(':', $nSyR);
		if ($fArtM!="") {$ArT = split(':', $fArtM);}
		for ($iGL=0; $iGL<=$JmLb; $iGL++)
		{
			if ($fArtM!="") {$fOpr=$ArT[$iGL];} else {$fOpr="LIKE";}
			
			if ($iGL==0)
			{$zFldF = $SxR[$iGL]." ".$fOpr." '".$SyR[$iGL]."'";}
			else
			{$zFldF = $zFldF." AND ".$SxR[$iGL]." ".$fOpr." '".$SyR[$iGL]."'";}
		}
	}
	else
	{
		if ($fArtM!="") {$fOpr=$fArtM;} else {$fOpr="LIKE";}
		$zFldF= $nFldF." ".$fOpr." '".$nSyR."'";
	}
	
	$nFldD = str_replace("IfNull", "IFNULL",$nFldD);
	$nFldD = str_replace("Ifnull", "IFNULL",$nFldD);
	$nFldD = str_replace("ifnull", "IFNULL",$nFldD);
	
	$nFldD = str_replace("sum", "SUM",$nFldD);
	$nFldD = str_replace("Sum", "SUM",$nFldD);
	
	$nFldD = str_replace("Count", "COUNT",$nFldD);
	$nFldD = str_replace("count", "COUNT",$nFldD);
	
	$nFldD = str_replace("Max", "MAX",$nFldD);
	$nFldD = str_replace("max", "MAX",$nFldD);
	
	$nFldD = str_replace("Min", "MIN",$nFldD);
	$nFldD = str_replace("min", "MIN",$nFldD);
	
	$nFldD = str_replace("Desc", "DESC",$nFldD);
	$nFldD = str_replace("desc", "DESC",$nFldD);

	$nFldD = str_replace("Limit", "LIMIT",$nFldD);
	$nFldD = str_replace("limit", "LIMIT",$nFldD);

	if ($nOdr!="") { $nOdr=" ORDER BY ".$nOdr;}
	if ($JmLa > 0) {$SQGL="SELECT ".str_replace(":", ", ",$nFldD)." FROM ".strtolower($nTbl)." WHERE ".$zFldF.$nOdr;}
	else {$SQGL="SELECT ".str_replace(":", ", ",$nFldD)." AS FldD FROM ".strtolower($nTbl)." WHERE ".$zFldF.$nOdr;}
	if ($fShow!="") {echo $SQGL."<br>";}
	$nRstGlo = mysql_query($SQGL) or die(mysql_error());
	$mRowGlo = mysql_fetch_assoc($nRstGlo);
	$tRowGlo = mysql_num_rows($nRstGlo);
	if ($tRowGlo > 0)
	{
		if ($JmLa > 0)
		{
			$Sx=split(':',$nFldD);
			for ($iGL=0; $iGL<=$JmLa; $iGL++)
			{
				if ($iGL==0)
					{$zFldD=$mRowGlo[$Sx[$iGL]];}
				else
					{$zFldD=$zFldD.":".$mRowGlo[$Sx[$iGL]];}
			}
			return $zFldD;
		}
		else
		{
			return $mRowGlo['FldD'];
		}
	}
}
?>
