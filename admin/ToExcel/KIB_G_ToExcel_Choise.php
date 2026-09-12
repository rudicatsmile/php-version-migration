<?php
set_time_limit(300);
require "../Connection.php";
require "../FileFunction.php";
require "libs/class.writeexcel_workbook.inc.php";
require "libs/class.writeexcel_worksheet.inc.php";

if (isset($_GET['LmT'])) {$gLmT  = $_GET['LmT'];}
if (isset($_GET['HeA'])) {$gHeA  = $_GET['HeA'];}
if (isset($_GET['ReC'])) {$gReC  = $_GET['ReC'];}

if (isset($_GET['gUnt'])) {$gUnt  = $_GET['gUnt'];}
if (isset($_GET['gSub'])) {$gSub  = $_GET['gSub'];}
if (isset($_GET['gUpb'])) {$gUpb  = $_GET['gUpb'];}
if (isset($_GET['gBid'])) {$gBid  = $_GET['gBid'];}
if (isset($_GET['gKel'])) {$gKel  = $_GET['gKel'];}
if (isset($_GET['gOBJ'])) {$gOBJ  = $_GET['gOBJ'];}
if (isset($_GET['gRin'])) {$gRin  = $_GET['gRin'];}
if (isset($_GET['gFin'])) {$zFin  = $_GET['gFin'];} else {$zFin  = "";}

require "../KIB_Dokumen_Unit_Choise.php";
if (isset($_GET['gThA'])) {$zThA  = $_GET['gThA'];}
if (isset($_GET['gThB'])) {$zThB  = $_GET['gThB'];}
$gTgA = $zThA."-01-01";
$gTgB = $zThB."-12-31";

$zFin = addslashes($zFin);

if ($zFin!="" )
{
	$zBid  = "All";
	$zKel  = "All";
	$zOBJ  = "All";
	$zRin  = "All";
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
$worksheet->write(0, 0, " ASET LAINNYA ", $Merg1);
$worksheet->write_blank(0, 1, $Merg2);
$worksheet->write_blank(0, 2, $Merg2);
$worksheet->write_blank(0, 3, $Merg2);
$worksheet->write_blank(0, 4, $Merg2);
$worksheet->write_blank(0, 5, $Merg2);

$worksheet->write(1, 0, "Unit : ".$gNmUNT, $Merg1);
$worksheet->write_blank(1, 1, $Merg2);
$worksheet->write_blank(1, 2, $Merg2);
$worksheet->write_blank(1, 3, $Merg2);
$worksheet->write_blank(1, 4, $Merg2);
$worksheet->write_blank(1, 5, $Merg2);

$worksheet->write(2, 0, "Sub Unit : ".$gNmSUB, $Merg1);
$worksheet->write_blank(2, 1, $Merg2);
$worksheet->write_blank(2, 2, $Merg2);
$worksheet->write_blank(2, 3, $Merg2);
$worksheet->write_blank(2, 4, $Merg2);
$worksheet->write_blank(2, 5, $Merg2);

$worksheet->write(3, 0, "UPB : ".$gNmUPB, $Merg1);
$worksheet->write_blank(3, 1, $Merg2);
$worksheet->write_blank(3, 2, $Merg2);
$worksheet->write_blank(3, 3, $Merg2);
$worksheet->write_blank(3, 4, $Merg2);
$worksheet->write_blank(3, 5, $Merg2);

$worksheet->write(4, 0, "", $Merg1);
$worksheet->write_blank(4, 1, $Merg2);
$worksheet->write_blank(4, 2, $Merg2);
$worksheet->write_blank(4, 3, $Merg2);
$worksheet->write_blank(4, 4, $Merg2);
$worksheet->write_blank(4, 5, $Merg2);

$worksheet->write(5, 0, "BIDANG : ".$nAs1, $Merg1);
$worksheet->write_blank(5, 1, $Merg2);
$worksheet->write_blank(5, 2, $Merg2);
$worksheet->write_blank(5, 3, $Merg2);
$worksheet->write_blank(5, 4, $Merg2);
$worksheet->write_blank(5, 5, $Merg2);

$worksheet->write(6, 0, "KELOMPOK : ".$nAs2, $Merg1);
$worksheet->write_blank(6, 1, $Merg2);
$worksheet->write_blank(6, 2, $Merg2);
$worksheet->write_blank(6, 3, $Merg2);
$worksheet->write_blank(6, 4, $Merg2);
$worksheet->write_blank(6, 5, $Merg2);

$worksheet->write(7, 0, "JENIS : ".$nAs3, $Merg1);
$worksheet->write_blank(7, 1, $Merg2);
$worksheet->write_blank(7, 2, $Merg2);
$worksheet->write_blank(7, 3, $Merg2);
$worksheet->write_blank(7, 4, $Merg2);
$worksheet->write_blank(7, 5, $Merg2);

$worksheet->write(8, 0, "OBJEK : ".$nAs4, $Merg1);
$worksheet->write_blank(8, 1, $Merg2);
$worksheet->write_blank(8, 2, $Merg2);
$worksheet->write_blank(8, 3, $Merg2);
$worksheet->write_blank(8, 4, $Merg2);
$worksheet->write_blank(8, 5, $Merg2);

$worksheet->write(9, 0, "RINCIAN : ".$nAs5, $Merg1);
$worksheet->write_blank(9, 1, $Merg2);
$worksheet->write_blank(9, 2, $Merg2);
$worksheet->write_blank(9, 3, $Merg2);
$worksheet->write_blank(9, 4, $Merg2);
$worksheet->write_blank(9, 5, $Merg2);

$iA = 10;
#Write Coloum Header
$worksheet->write($iA, 0, "NO", $HeadTyp1);
$worksheet->write($iA, 1, "KODE", $HeadTyp1);
$worksheet->write($iA, 2, "REGISTER", $HeadTyp1);
$worksheet->write($iA, 3, "NAMA BARANG", $HeadTyp1);
$worksheet->write($iA, 4, "PEROLEHAN", $HeadTyp1);
$worksheet->write($iA, 5, "NILAI (Rp)", $HeadTyp2);

$tNIL= 0;
$iG  = 11;
$iB  = $iG+$gReC;
if ($gLmT=="YA")
{
	$nSQL= "SELECT * FROM ta_kib_g WHERE Kd_UPB LIKE '".$gUpb."' AND Kd_Aset LIKE '".$gAss."' AND (Tgl_Perolehan BETWEEN '".$gTgA."' AND '".$gTgB."') ".$fFindSy." ORDER BY Tgl_Perolehan, Kd_Aset, No_Register LIMIT ".$gReC.",10000";
}
else
{
	$nSQL= "SELECT * FROM ta_kib_g WHERE Kd_UPB LIKE '".$gUpb."' AND Kd_Aset LIKE '".$gAss."' AND (Tgl_Perolehan BETWEEN '".$gTgA."' AND '".$gTgB."') ".$fFindSy." ORDER BY Tgl_Perolehan, Kd_Aset, No_Register";
}
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
		$worksheet->write($iG, 0, $iB-$iA, $r_cent);
		$worksheet->write($iG, 1, $mRo['Kd_Aset'], $r_cent);
		$worksheet->write($iG, 2, $mRo['No_Register'], $r_cent);
		$worksheet->write($iG, 3, $NmB, $r_left);
		$worksheet->write($iG, 4, fConvertDateShort($mRo['Tgl_Perolehan']), $r_cent);
		$worksheet->write($iG, 5, $gNIL, $r_righ);
		$tNIL = $tNIL+$gNIL;
		$iG++;
		$iB++;
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

header("Content-Type: application/x-msexcel; name=\"KiB-G Choise.xls\"");
header("Content-Disposition: inline; filename=\"KiB-G Choise.xls\"");
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);
?>