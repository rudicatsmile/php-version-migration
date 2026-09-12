<?php
require('Connection.php');
$Smp  = $_POST['Simpan'];
$zUpb = $_GET['zUpb'];
$zKeg = $_GET['zKeg'];
$zThn = $_GET['zThn'];
$JusV = $_GET['JusV'];
$TakeOff=$_GET['TakeOff'];

if ($Smp=="Save")
{
	$nSQL= "SELECT IDO FROM ta_rkbmd WHERE Kd_UPB='".$zUpb."' AND Kd_Kegiatan = '".$zKeg."' AND Tahun = '".$zThn."' ".$fFindSy." ORDER BY IDO";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
	do
		{
			$IDO = $mRo['IDO'];
			$rDes = $_POST['fDesk'.$IDO];
			$rMrk = $_POST['fMerk'.$IDO];
			$rUkr = $_POST['fUkur'.$IDO];
			$rQty = fConvertToNumeric($_POST['fQuan'.$IDO]);
			$rSat = $_POST['fSatu'.$IDO];
			$rHrg = fConvertToNumeric($_POST['fHarg'.$IDO]);
			$rJml = $rQty * $rHrg;

			$SQL = "UPDATE ta_rkbmd SET 
			Deskripsi='$rDes',
			Merk_Type='$rMrk',
			Ukuran='$rUkr',
			Qty='$rQty',
			Satuan='$rSat',
			Harga='$rHrg',
			Jumlah='$rJml' where IDO='".$IDO."'";
			$rst = mysql_query($SQL) or die(mysql_error());
		}
	while ($mRo = mysql_fetch_assoc($nRs));	
	}
}
else if ($Smp=="Add")
{
	$SQL = "INSERT INTO ta_rkbmd SET 
	Kd_Upb='$zUpb',
	Kd_Kegiatan='$zKeg',
	Tahun='$zThn'";
	$rst = mysql_query($SQL) or die(mysql_error());
}
else if ($Smp=="Del")
{
	$nSQL= "SELECT IDO FROM ta_rkbmd WHERE Kd_UPB='".$zUpb."' AND Kd_Kegiatan = '".$zKeg."' AND Tahun = '".$zThn."' ".$fFindSy." ORDER BY IDO";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
	do
		{
			$IDO = $mRo['IDO'];
			if ($_POST['CheckB'.$IDO]=="ON")
			{
				$SQL = "DELETE FROM ta_rkbmd WHERE IDO='".$IDO."'";
				$rst = mysql_query($SQL) or die(mysql_error());
			}
		}
	while ($mRo = mysql_fetch_assoc($nRs));	
	}
}	
else if ($TakeOff=="Ya")
{
	#gKd=".$gKd."&IDO=".$IDO."&JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_GET['IdL'];
	$gKd = $_GET['gKd'];
	$IDO  = $_GET['IDO'];
	
	$gNm = fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$gKd,"=","","");
	$SQL = "update ta_rkbmd set Kd_Aset='".$gKd."', Nm_Aset='".$gNm."' WHERE IDO='".$IDO."'";
	#echo $SQL;
	#return false;
	$rst = mysql_query($SQL);

}
$URL="RKBMD_Mid.php?JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_GET['IdL'];
header("Location: ".$URL);
?>

<?php require('Connection_Close.php');?>
