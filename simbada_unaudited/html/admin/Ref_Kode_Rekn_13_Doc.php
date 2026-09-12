<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
#echo $Lev."<br>";
#echo $eKD."<br>";
#return false;
?>
<table align="center" border="0" width="700" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-family:calibri; font-size:10pt">
<tr>
  <td colspan="3" style="font-size:12pt; font-weight:bold">DAFTAR REKENING</td>
</tr>
<tr>
  <td colspan="3" style="font-size:12pt; font-weight:bold; border-bottom:3px double #000000">BERDASARKAN PERMENDAGRI NOMOR 13 TAHUN 2006</td>
</tr>
<tr height="10">
  <td colspan="3"></td>
</tr>
<? if ($Lev>0){?>
<tr>
  <td width="103">BIDANG</td>
  <td width="20">:</td>
  <td><?=substr($eKD,0,1)." : ".strtoupper(fGlobal("nm_rek","ref_rek_1","kd_rek",substr($eKD,0,1),"=","",""))?></td>
</tr>
<? } ?>
<? if ($Lev>1){?>
<tr>
  <td>KELOMPOK</td>
  <td>:</td>
  <td><?=substr($eKD,0,3)." : ".strtoupper(fGlobal("nm_rek","ref_rek_2","kd_rek",substr($eKD,0,3),"=","",""))?></td>
</tr>
<? } ?>
<? if ($Lev>2){?>
<tr>
  <td>JENIS</td>
  <td>:</td>
  <td><?=substr($eKD,0,6)." : ".strtoupper(fGlobal("nm_rek","ref_rek_3","kd_rek",substr($eKD,0,6),"=","",""))?></td>
</tr>
<? } ?>
<? if ($Lev>3){?>
<tr>
  <td>OBJEK</td>
  <td>:</td>
  <td><?=substr($eKD,0,10)." : ".strtoupper(fGlobal("nm_rek","ref_rek_4","kd_rek",substr($eKD,0,10),"=","",""))?></td>
</tr>
<? } ?>
<!--
<? if ($Lev>4){?>
<tr>
  <td>RINCIAN OBJEK</td>
  <td>:</td>
  <td><?=substr($eKD,0,15)." : ".strtoupper(fGlobal("nm_rek","ref_rek_5","kd_rek",substr($eKD,0,15),"=","",""))?></td>
</tr>
<? } ?>
-->
<tr height="10">
  <td colspan="3"></td>
</tr>
</table>
<table align="center" border="0" width="700" cellspacing="1" cellpadding="1" style="border-collapse:collapse; font-family:calibri; font-size:9pt">
<tr height="25">
  <td width="95" style="border:1px solid #000; text-align:center; font-weight:bold">KODE</td>
  <td style="border:1px solid #000; text-align:center; font-weight:bold">DESKRIPSI</td>
  </tr>
<?
if ($Lev=='0')
{
	$iA=1;
	if ($eKD!=""){
		$nSQ = "SELECT kd_rek, nm_rek FROM ref_rek_1 WHERE kd_rek LIKE '".$eKD."%' ORDER BY kd_rek";
	}
	else{
		$nSQ = "SELECT kd_rek, nm_rek FROM ref_rek_1 ORDER BY kd_rek";
	}
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$xB ="<b>";
		$A1 = $mRo[0];
		$A2 = $mRo[1];
		if ($iA>1){ListBlank();}
		ListData($A1,$A2,$A3,$A4,$xB);
		Level2($A1,"");
		$iA++;
	}
}
else if ($Lev=='1')
{
	Level2($eKD,'');
}
else if ($Lev=='2')
{
	Level3($eKD,'');
}
else if ($Lev=='3')
{
	Level4($eKD,'');
}
else if ($Lev=='4')
{
	Level5($eKD,'');
}

function Level2($Kd,$fS)
{
	$iB=1;
	$nSQa = "SELECT kd_rek, nm_rek FROM ref_rek_2 WHERE kd_rek LIKE '".$Kd."%' ORDER BY kd_rek";
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
	$nSQb = "SELECT kd_rek, nm_rek FROM ref_rek_3 WHERE kd_rek LIKE '".$Kd."%' ORDER BY kd_rek";
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
	$nSQc = "SELECT kd_rek, nm_rek FROM ref_rek_4 WHERE kd_rek LIKE '".$Kd."%' ORDER BY kd_rek";
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
	$nSQd = "SELECT kd_rek, nm_rek FROM ref_rek_5 WHERE kd_rek LIKE '".$Kd."%' ORDER BY kd_rek";
	if ($fS) echo $nSQd."<br>";
	$nRd = mysql_query($nSQd);
	while ($mRd = mysql_fetch_array($nRd, MYSQL_BOTH))
	{
		$xB ="";
		$A1 = $mRd[0];
		$A2 = $mRd[1];
		$A3 = "";
		$A4 = "";
		ListData($A1,$A2,$A3,$A4,$xB);
		$iE++;
	}
}

function ListData($A1,$A2,$A3,$A4,$xB)
{
?>
<tr height="20">
  <td style="border:1px solid #000; padding-left:5px"><?=$xB.$A1?></td>
  <td style="border:1px solid #000; padding-left:5px"><?=$xB.$A2?></td>
  </tr>
<? 
}

function ListBlank()
{
?>
<tr>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  </tr>
<? } ?>
<tr>
  <td colspan="2" style="border:1px solid #000">&nbsp;</td>
  </tr>
</table>
