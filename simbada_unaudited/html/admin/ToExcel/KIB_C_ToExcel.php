<?php
set_time_limit(300);
require "../Connection.php";
require "../FileFunction.php";
require "libs/class.writeexcel_workbook.inc.php";
require "libs/class.writeexcel_worksheet.inc.php";

if (isset($_GET['gUnt'])) {$zUnt  = $_GET['gUnt'];}
if (isset($_GET['gSub'])) {$zSub  = $_GET['gSub'];}
if (isset($_GET['gUpb'])) {$zUpb  = $_GET['gUpb'];}
if (isset($_GET['gThn'])) {$zThn  = $_GET['gThn'];}
if (isset($_GET['gBid'])) {$zBid  = $_GET['gBid'];}
if (isset($_GET['gKel'])) {$zKel  = $_GET['gKel'];}
if (isset($_GET['gOBJ'])) {$zOBJ  = $_GET['gOBJ'];}
if (isset($_GET['gRin'])) {$zRin  = $_GET['gRin'];}
if (isset($_GET['gFin'])) {$zFin  = $_GET['gFin'];}
$zFin = addslashes($zFin);

if ($zFin!="" )
{
	$zBid  = "All";
	$zKel  = "All";
	$zOBJ  = "All";
	$zRin  = "All";
}

if ($zThn=="" || $zThn=="All") {$zThn="____";}
if ($zThn=="____")
	{$rThn="____";}
else
	{$rThn=$zThn;}
		
if ($zBid=="All")
	{
		$rBid="__.__";
		$rKel="__";
		$rOBJ="__";
		$rRin="___";
	}
	else
	{
		if ($zKel=="All")
			{
			$rBid=$zBid;
			$rKel="__";
			$rOBJ="__";
			$rRin="___";
			}
		else
			{
				if ($zOBJ=="All")
					{
					$rBid=$zBid;
					$rKel=substr($zKel,6,2);
					$rOBJ="__";
					$rRin="___";
					}
				else
					{
						if ($zRin=="All")
							{
							$rBid=$zBid;
							$rKel=substr($zKel,6,2);
							$rOBJ=substr($zOBJ,9,2);
							$rRin="___";
							}
						else
							{
							$rBid=$zBid;
							$rKel=substr($zKel,6,2);
							$rOBJ=substr($zOBJ,9,2);
							$rRin=substr($zRin,12,3);
							}
					}
			}
	}

if ($zFin!="")
	{$fFindSy = "AND (Harga LIKE '%".$zFin."%' OR Referensi LIKE '%".$zFin."%' OR Kd_Aset LIKE '%".$zFin."%' OR Keterangan LIKE '%".$zFin."%')";}
else
	{$fFindSy = "";}

$fname = tempnam("/tmp", "textwrap.xls");
$workbook = &new writeexcel_workbook($fname);
$worksheet = &$workbook->addworksheet();

$worksheet->set_column(0, 0, 7);
$worksheet->set_column(1, 1, 15);
$worksheet->set_column(2, 2, 10);
$worksheet->set_column(3, 3, 60);
$worksheet->set_column(4, 4, 15);
$worksheet->set_column(5, 5, 20);

# Format Title 1
$Merg1=& $workbook->addformat(array(
	'font'=> 'calibri',
	'size'=> 10,
	'bold'=> 1,
	'fg_color'=> 'Aqua',
	'align'=>'left',
	'align'=>'vcenter',
	'merge'=> 1));

$Merg2=& $workbook->addformat(array(
	'fg_color'=> 'Aqua',
	'merge'=> 1));

# Format Title 2
$HeadTyp0=& $workbook->addformat(array(
	'font'=>'calibri',
	'bold'=> 1,
	'size'=>9,
	'align'=> 'left',
	'align'=> 'vcenter'));

# Format Header Type 1
$HeadTyp1=& $workbook->addformat(array(
	'font'=> 'calibri',
	'color'=>'white',
	'fg_color'=> 'green',
	'bold'=> 1,
	'size'=> 9,
	'align'=> 'center',
	'border'=> 1));

# Format Header Type 2
$HeadTyp2=& $workbook->addformat(array(
	'font'=> 'calibri',
	'color'=> 'white',
	'fg_color'=> 'green',
	'bold'=> 1,
	'size'=> 9,
	'align'=> 'right',
	'border'=> 1));

#Write Format
$r_left=& $workbook->addformat(array(
	'font'=> 'calibri',
	'size'=> 9,
	'align'=> 'left',
	'border'=> 1));

$r_cent =& $workbook->addformat(array(
	'font'=> 'calibri',
	'size'=> 9,
	'align'=> 'center',
	'border'=> 1));

$r_righ =& $workbook->addformat(array(
	'num_format'=> '#,##0.00', 
	'font'  => 'calibri', 
	'size'  => 9,
	'align' => 'right',
	'border'=> 1));

#Format Summary
$FootA =& $workbook->addformat(array(
	'font'=>'calibri',
	'color'=>'white',
	'fg_color'=>'green',
	'bold'=>1,
	'size'=>9,
	'align'=>'center',
	'border'=> 1,
	'merge'=> 1));

$FootB =& $workbook->addformat(array(
	'font'=>'calibri',
	'color'=>'white',
	'fg_color'=>'green',
	'bold'=>1,
	'num_format'=> '#,##0.00', 
	'size'=>9,
	'align'=>'right',
	'border'=> 1));

#Write Title
$worksheet->write(0, 0, "KIB-C ( ASET GEDUNG DAN BANGUNAN )", $Merg1);
$worksheet->write_blank(0, 1, $Merg2);
$worksheet->write_blank(0, 2, $Merg2);
$worksheet->write_blank(0, 3, $Merg2);
$worksheet->write_blank(0, 4, $Merg2);
$worksheet->write_blank(0, 5, $Merg2);

$worksheet->write(1, 0, "Unit : ".fGlobal("Nm_Unit","Ref_Unit","Kd_Unit",$zUnt,"=","",""), $Merg1);
$worksheet->write_blank(1, 1, $Merg2);
$worksheet->write_blank(1, 2, $Merg2);
$worksheet->write_blank(1, 3, $Merg2);
$worksheet->write_blank(1, 4, $Merg2);
$worksheet->write_blank(1, 5, $Merg2);

$worksheet->write(2, 0, "Sub Unit : ".fGlobal("Nm_Sub","Ref_Sub_Unit","Kd_Sub",$zSub,"=","",""), $Merg1);
$worksheet->write_blank(2, 1, $Merg2);
$worksheet->write_blank(2, 2, $Merg2);
$worksheet->write_blank(2, 3, $Merg2);
$worksheet->write_blank(2, 4, $Merg2);
$worksheet->write_blank(2, 5, $Merg2);

$worksheet->write(3, 0, "UPB : ".fGlobal("Nm_Upb","Ref_Upb","Kd_Upb",$zUpb,"=","",""), $Merg1);
$worksheet->write_blank(3, 1, $Merg2);
$worksheet->write_blank(3, 2, $Merg2);
$worksheet->write_blank(3, 3, $Merg2);
$worksheet->write_blank(3, 4, $Merg2);
$worksheet->write_blank(3, 5, $Merg2);

$worksheet->write(4, 0, "-", $Merg1);
$worksheet->write_blank(4, 1, $Merg2);
$worksheet->write_blank(4, 2, $Merg2);
$worksheet->write_blank(4, 3, $Merg2);
$worksheet->write_blank(4, 4, $Merg2);
$worksheet->write_blank(4, 5, $Merg2);

$iA = 5;
#Write Coloum Header
$worksheet->write($iA, 0, "NO", $HeadTyp1);
$worksheet->write($iA, 1, "KODE", $HeadTyp1);
$worksheet->write($iA, 2, "REGISTER", $HeadTyp1);
$worksheet->write($iA, 3, "NAMA BARANG", $HeadTyp1);
$worksheet->write($iA, 4, "PEROLEHAN", $HeadTyp1);
$worksheet->write($iA, 5, "NILAI (Rp)", $HeadTyp2);

$tNIL= 0;
$iG  = 6;
$nSQL= "SELECT * FROM ta_kib_c WHERE Kd_UPB='".$zUpb."' AND Kd_Aset LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy." ORDER BY Tgl_Perolehan, Kd_Aset, No_Register";
$nRs = mysql_query($nSQL) or die(mysql_error());
$mRo = mysql_fetch_assoc($nRs);
$tRo = mysql_num_rows($nRs);
if ($tRo > 0)
{
do
	{
		$NmB=$mRo['Nm_Aset'];
		if ($NmB=="") {$NmB=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");}

		$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi",$mRo['Referensi'],"=","","");
		$gNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Referensi",$mRo['Referensi'],"=","","");
		if ($gNIb != 0) {$gNIL = $gNIa - $gNIb;}
		else {$gNIL=$gNIa;}

		#Write Body
		$worksheet->write($iG, 0, $iG-5, $r_cent);
		$worksheet->write($iG, 1, $mRo['Kd_Aset'], $r_cent);
		$worksheet->write($iG, 2, $mRo['No_Register'], $r_cent);
		$worksheet->write($iG, 3, $NmB, $r_left);
		$worksheet->write($iG, 4, fConvertDateShort($mRo['Tgl_Perolehan']), $r_cent);
		$worksheet->write($iG, 5, $gNIL, $r_righ);
		$tNIL = $tNIL+$gNIL;
		$iG++;
	}
	while ($mRo = mysql_fetch_assoc($nRs));	
}
#Write Summary
$worksheet->write($iG, 0, "T O T A L", $FootA);
$worksheet->write_blank($iG, 1, $FootA);
$worksheet->write_blank($iG, 2, $FootA);
$worksheet->write_blank($iG, 3, $FootA);
$worksheet->write_blank($iG, 4, $FootA);
$worksheet->write($iG, 5, $tNIL, $FootB);

$workbook->close();

header("Content-Type: application/x-msexcel; name=\"KiB-C.xls\"");
header("Content-Disposition: inline; filename=\"KiB-C.xls\"");
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);
?>