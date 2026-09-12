<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
#echo $Lev."<br>";
#echo $eKD."<br>";
#return false;
?>
<table align="center" border="0" width="800" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-family:calibri; font-size:10pt">
<tr>
  <td colspan="3" style="font-size:12pt; font-weight:bold">DAFTAR REKENING ASET</td>
</tr>
<tr>
  <td colspan="3" style="font-size:12pt; font-weight:bold; border-bottom:3px double #000000">BERDASARKAN PERMENDAGRI NOMOR 108 TAHUN 2016</td>
</tr>
<tr height="10">
  <td colspan="3"></td>
</tr>
<tr>
  <td width="120">BIDANG</td>
  <td width="18">:</td>
  <td><?=substr($eKD,0,1)." : ".fGlobal("nm_aset","ref_rek_aset108_1","kd_aset",substr($eKD,0,1),"=","","");?></td>
</tr>
<? if ($Lev>1){?>
<tr>
  <td>KELOMPOK</td>
  <td>:</td>
  <td><?=substr($eKD,0,3)." : ".fGlobal("nm_aset","ref_rek_aset108_2","kd_aset",substr($eKD,0,3),"=","","");?></td>
</tr>
<? } ?>
<? if ($Lev>2){?>
<tr>
  <td>JENIS</td>
  <td>:</td>
  <td><?=substr($eKD,0,5)." : ".fGlobal("nm_aset","ref_rek_aset108_3","kd_aset",substr($eKD,0,5),"=","","");?></td>
</tr>
<? } ?>
<? if ($Lev>3){?>
<tr>
  <td>OBJEK</td>
  <td>:</td>
  <td><?=substr($eKD,0,8)." : ".fGlobal("nm_aset","ref_rek_aset108_4","kd_aset",substr($eKD,0,8),"=","","");?></td>
</tr>
<? } ?>
<? if ($Lev>4){?>
<tr>
  <td>RINCIAN OBJEK</td>
  <td>:</td>
  <td><?=substr($eKD,0,11)." : ".fGlobal("nm_aset","ref_rek_aset108_5","kd_aset",substr($eKD,0,11),"=","","");?></td>
</tr>
<? } ?>
<? if ($Lev>5){?>
<tr>
  <td>SUB RINCIAN OBJEK</td>
  <td>:</td>
  <td><?=substr($eKD,0,14)." : ".fGlobal("nm_aset","ref_rek_aset108_6","kd_aset",substr($eKD,0,14),"=","","");?></td>
</tr>
<? } ?>
<? if ($Lev>6){?>
<tr>
  <td>SUB SUB R. OBJEK</td>
  <td>:</td>
  <td>&nbsp;</td>
</tr>
<? } ?>
<tr height="10">
  <td colspan="3"></td>
</tr>
</table>
<table align="center" border="0" width="800" cellspacing="1" cellpadding="1" style="border-collapse:collapse; font-family:calibri; font-size:9pt">
<tr height="30">
  <td width="99" style="border:1px solid #000; text-align:center; font-weight:bold">KODE</td>
  <td style="border:1px solid #000; text-align:center; font-weight:bold">DESKRIPSI</td>
  <td width="57" style="border:1px solid #000; text-align:center; font-weight:bold">UMUR EKONOMIS </td>
  <td width="273" style="border:1px solid #000; text-align:center; font-weight:bold">OVERHOULE</td>
</tr>
<?
#return false;
if ($Lev=='1')
{
	$iA=1;
	if ($eKD!=""){
		$nSQ = "SELECT kd_aset, nm_aset FROM ref_rek_aset108_2 WHERE kd_aset LIKE '".$eKD."%' ORDER BY kd_aset";
	}
	else{
		$nSQ = "SELECT kd_aset, nm_aset FROM ref_rek_aset108_2 ORDER BY kd_aset";
	}
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$xB ="<b>";
		$A1 = $mRo[0];
		$A2 = $mRo[1];
		$A3 = "";
		$A4 = "";
		if ($iA>1){ListBlank();}
		ListData($A1,$A2,$A3,$A4,$xB);
		Level2($A1,"");
		$iA++;
	}
}
else if ($Lev=='2')
{
	Level2($eKD,'');
}
else if ($Lev=='3')
{
	Level3($eKD,'');
}
else if ($Lev=='4')
{
	Level4($eKD,'');
}
else if ($Lev=='5')
{
	Level5($eKD,'');
}
else if ($Lev=='6')
{
	Level6($eKD,'');
}

function Level2($Kd,$fS)
{
	$iB=1;
	$nSQa = "SELECT kd_aset, nm_aset FROM ref_rek_aset108_3 WHERE kd_aset LIKE '".$Kd."%' ORDER BY kd_aset";
	if ($fS) echo $nSQa."<br>";
	$nRa = mysql_query($nSQa);
	while ($mRa = mysql_fetch_array($nRa, MYSQL_BOTH))
	{
		$xB ="<b>";
		$A1 = $mRa[0];
		$A2 = $mRa[1];
		$A3 = "";
		$A4 = "";
		if ($iB>1){ListBlank();}
		ListData($A1,$A2,$A3,$A4,$xB);
		Level3($A1,"");
		$iB++;
	}
}

function Level3($Kd,$fS)
{
	$iC=1;
	$nSQb = "SELECT kd_aset, nm_aset FROM ref_rek_aset108_4 WHERE kd_aset LIKE '".$Kd."%' ORDER BY kd_aset";
	if ($fS) echo $nSQb."<br>";
	$nRb = mysql_query($nSQb);
	while ($mRb = mysql_fetch_array($nRb, MYSQL_BOTH))
	{
		$xB ="<b>";
		$A1 = $mRb[0];
		$A2 = $mRb[1];
		$A3 = "";
		$A4 = "";
		if ($iC>1){ListBlank();}
		ListData($A1,$A2,$A3,$A4,$xB);
		Level4($A1,"");
		$iC++;
	}
}

function Level4($Kd,$fS)
{
	$iD=1;
	$nSQc = "SELECT kd_aset, nm_aset FROM ref_rek_aset108_5 WHERE kd_aset LIKE '".$Kd."%' ORDER BY kd_aset";
	if ($fS) echo $nSQc."<br>";
	$nRc = mysql_query($nSQc);
	while ($mRc = mysql_fetch_array($nRc, MYSQL_BOTH))
	{
		$xB ="<b>";
		$A1 = $mRc[0];
		$A2 = $mRc[1];
		$A3 = "";
		$A4 = "";
		if ($iD>1){ListBlank();}
		ListData($A1,$A2,$A3,$A4,$xB);
		Level5($A1,"");
		$iD++;
	}
}

function Level5($Kd,$fS)
{
	$iE=1;
	$nSQd = "SELECT kd_aset, nm_aset FROM ref_rek_aset108_6 WHERE kd_aset LIKE '".$Kd."%' ORDER BY kd_aset";
	if ($fS) echo $nSQd."<br>";
	$nRd = mysql_query($nSQd);
	while ($mRd = mysql_fetch_array($nRd, MYSQL_BOTH))
	{
		$xB ="<b>";
		$A1 = $mRd[0];
		$A2 = $mRd[1];
		$A3 = "";
		$A4 = "";
		if ($iE>1){ListBlank();}
		ListData($A1,$A2,$A3,$A4,$xB);
		Level6($A1,"");
		$iE++;
	}
}

function Level6($Kd,$fS)
{
	$nSQe = "SELECT kd_aset, nm_aset, Ms_Manfaat FROM ref_rek_aset108_7 WHERE kd_aset LIKE '".$Kd."%' ORDER BY kd_aset";
	if ($fS) echo $nSQe."<br>";
	$nRe = mysql_query($nSQe);
	while ($mRe = mysql_fetch_array($nRe, MYSQL_BOTH))
	{
		$xB ="";
		$A1 = $mRe[0];
		$A2 = $mRe[1];
		$A3 = $mRe[2];
		$A4 = LoadOverHoul($A1);
		ListData($A1,$A2,$A3,$A4,$xB);
	}
}
function ListData($A1,$A2,$A3,$A4,$xB)
{
?>
<tr height="20">
  <td style="border:1px solid #000; padding-left:5px"><?=$xB.$A1?></td>
  <td style="border:1px solid #000; padding-left:5px"><?=$xB.$A2?></td>
  <td style="border:1px solid #000; text-align:center"><? if ($A3>0) {echo $xB.$A3;} else {echo "-";}?></td>
  <td style="border:1px solid #000; text-align:center"><?=$xB.$A4?></td>
</tr>
<? 
}

function ListBlank()
{
?>
<tr>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
</tr>
<? } ?>
<tr>
  <td colspan="4" style="border:1px solid #000">&nbsp;</td>
  </tr>
</table>
<?
function LoadOverHoul($gA)
{
	$eV = "";
	$iGE = 1;
	$SQO="SELECT tA, tB, tUmur FROM ta_masa_manfaat_108 WHERE Kode = '".$gA."' ORDER BY IDT";
	$nR = mysql_query($SQO) or die(mysql_error());
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		if ($iGE==1)
		{
			$eV = $mR[0]."-".$mR[1]."% = ".$mR[2];
		}
		else
		{
			$eV.= "; ".$mR[0]."-".$mR[1]."% = ".$mR[2];
		}
		$iGE++;
	}
	return $eV;
}
?>
