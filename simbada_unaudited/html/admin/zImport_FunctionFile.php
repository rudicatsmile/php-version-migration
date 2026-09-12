<?
function fMakeReg($gRefVr,$nDgT)
{
	$gSTR = str_repeat("0", 20);
	$NewREG = substr($gSTR.$gRefVr,-$nDgT,$nDgT);
	return $NewREG;
}

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

function fHiSplitT2K($DataG,$xChr)
{
	$cTtK="";
	foreach (count_chars($DataG, 1) as $i => $val)
	{if (chr($i)==$xChr) {$cTtK = $val;}}
	return $cTtK;
}

function fGlobal($nFldD,$nTbl,$nFldF,$nSyR,$fArtM,$nOdr,$NmDB,$NmCon,$fShow)
{
	//Ex:
	//fGlobal("Nama_Program","program","Id_Program:Periode",$gPR.":".$gTH,"=:=","",DatabaseSA,$ConSA,"");
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

function AddField($nTbl,$nField,$nType,$nNull,$nDefa,$nAfter,$nIdx)
{
	$JumFld=0;
	if ($nDefa !="") {$nDefa = "default '".$nDefa."'";} else {$nDefa="default ''";}
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
}?>