<?php
require('Connection.php');
require "FileFunction.php";

$Smp  = $_POST['Simpan'];
$Crt  = $_POST['FormCr'];

$zUpb = $_GET['zUpb'];
$zKeg = $_GET['zKeg'];
$zThn = $_GET['zThn'];
$JusV = $_GET['JusV'];

if ($Smp=="Save")
	{
		if ($Crt!="")
		{
			$RefG = $Crt;
			$nSQL= "SELECT IDO FROM ta_rkpbmd_rinci WHERE Referensi='".$RefG."' ORDER BY IDO";
			$nRs = mysql_query($nSQL) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
			do
				{
					$rIDO = $mRo['IDO'];
					$rDes = $_POST['fDesk'.$rIDO];
					$rLok = $_POST['fLoka'.$rIDO];
					$rUkr = $_POST['fUkur'.$rIDO];
					$rQty = fConvertToNumeric($_POST['fQuan'.$rIDO]);
					$rSat = $_POST['fSatu'.$rIDO];
					$rHrg = fConvertToNumeric($_POST['fHarg'.$rIDO]);
					$rJml = $rQty * $rHrg;
					
					$SQL = "UPDATE ta_rkpbmd_rinci SET 
					Deskripsi='$rDes',
					Lokasi='$rLok',
					Qty='$rQty',
					Satuan='$rSat',
					Harga='$rHrg',
					Jumlah='$rJml' where IDO='".$rIDO."'";
					$rst = mysql_query($SQL) or die(mysql_error());
				
				}
			while ($mRo = mysql_fetch_assoc($nRs));	
			}
		}
		else
		{
			$nSQL= "SELECT Referensi FROM ta_rkpbmd WHERE Kd_UPB='".$zUpb."' AND Kd_Kegiatan = '".$zKeg."' AND Tahun = '".$zThn."' ORDER BY IDO";
			$nRs = mysql_query($nSQL) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
			do
				{
					$RefG = $mRo['Referensi'];
					$rnSQL= "SELECT IDO FROM ta_rkpbmd_rinci WHERE Referensi='".$RefG."' ORDER BY IDO";
					$rnRs = mysql_query($rnSQL) or die(mysql_error());
					$rmRo = mysql_fetch_assoc($rnRs);
					$rtRo = mysql_num_rows($rnRs);
					if ($rtRo > 0)
					{
					do
						{
							$rIDO = $rmRo['IDO'];
							$rDes = $_POST['fDesk'.$rIDO];
							$rLok = $_POST['fLoka'.$rIDO];
							$rUkr = $_POST['fUkur'.$rIDO];
							$rQty = fConvertToNumeric($_POST['fQuan'.$rIDO]);
							$rSat = $_POST['fSatu'.$rIDO];
							$rHrg = fConvertToNumeric($_POST['fHarg'.$rIDO]);
							$rJml = $rQty * $rHrg;
							
							$SQL = "UPDATE ta_rkpbmd_rinci SET 
							Deskripsi='$rDes',
							Lokasi='$rLok',
							Qty='$rQty',
							Satuan='$rSat',
							Harga='$rHrg',
							Jumlah='$rJml' where IDO='".$rIDO."'";
							$rst = mysql_query($SQL) or die(mysql_error());
						
						}
					while ($rmRo = mysql_fetch_assoc($rnRs));	
					}
					
				}
			while ($mRo = mysql_fetch_assoc($nRs));	
			}
		}
	}
else if ($Smp=="Add")
	{
		if ($Crt!="")
		{
			$RefG = $Crt;
			$SQL = "INSERT INTO ta_rkpbmd_rinci SET 
			Referensi='$RefG'";
			$rst = mysql_query($SQL);
			
		}
		else
		{
			//Creat Referensi
			$nSQL = "SELECT IFNULL(MAX(Referensi),0) AS LasRef FROM ta_rkpbmd WHERE Kd_Upb='".$zUpb."' AND Tahun='".$zThn."'";
			$nRst = mysql_query($nSQL) or die(mysql_error());
			$nRow = mysql_fetch_assoc($nRst);
			$LastRe = $nRow['LasRef'];
			$NewRef  = ((int)substr($LastRe,24,3)) + 1;
			$NewRef  = $zUpb.".".$zThn.".".fMakeReferensi($NewRef,3);
			
			$SQL = "INSERT INTO ta_rkpbmd SET 
			Referensi='$NewRef',
			Kd_Upb='$zUpb',
			Kd_Kegiatan='$zKeg',
			Tahun='$zThn'";
			$rst = mysql_query($SQL);
			
			$SQL = "INSERT INTO ta_rkpbmd_rinci SET 
			Referensi='$NewRef'";
			$rst = mysql_query($SQL);
		}
	}
	
else if ($Smp=="Del")
	{
		if ($Crt!="")
		{
			$RefG = $Crt;
			$nSQL= "SELECT IDO FROM ta_rkpbmd_rinci WHERE Referensi='".$RefG."' ORDER BY IDO";
			$nRs = mysql_query($nSQL) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
			do
				{
					$rIDO = $mRo['IDO'];
					if ($_POST['CheckD'.$rIDO]=="ON")
					{
						$SQL = "DELETE FROM ta_rkpbmd_rinci WHERE IDO='".$rIDO."'";
						$rst = mysql_query($SQL) or die(mysql_error());
					}
				
				}
			while ($mRo = mysql_fetch_assoc($nRs));	
			}
		}
		else
		{
			$nSQL= "SELECT IDO, Referensi FROM ta_rkpbmd WHERE Kd_UPB='".$zUpb."' AND Kd_Kegiatan = '".$zKeg."' AND Tahun = '".$zThn."' ORDER BY IDO";
			$nRs = mysql_query($nSQL) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
			do
				{
					$IDO = $mRo['IDO'];
					$Ref = $mRo['Referensi'];
					if ($_POST['CheckB'.$IDO]=="ON")
					{
						$SQL = "DELETE FROM ta_rkpbmd_rinci WHERE Referensi='".$Ref."'";
						$rst = mysql_query($SQL) or die(mysql_error());
						
						$SQL = "DELETE FROM ta_rkpbmd WHERE IDO='".$IDO."'";
						$rst = mysql_query($SQL) or die(mysql_error());
					}
					else
					{
						$RefG = $Ref;
						$rnSQL= "SELECT IDO FROM ta_rkpbmd_rinci WHERE Referensi='".$RefG."' ORDER BY IDO";
						$rnRs = mysql_query($rnSQL) or die(mysql_error());
						$rmRo = mysql_fetch_assoc($rnRs);
						$rtRo = mysql_num_rows($rnRs);
						if ($rtRo > 0)
						{
						do
							{
								$rIDO = $rmRo['IDO'];
								if ($_POST['CheckD'.$rIDO]=="ON")
								{
									$SQL = "DELETE FROM ta_rkpbmd_rinci WHERE IDO='".$rIDO."'";
									$rst = mysql_query($SQL) or die(mysql_error());
								}
							
							}
						while ($rmRo = mysql_fetch_assoc($rnRs));	
						}
					}
				}
			while ($mRo = mysql_fetch_assoc($nRs));	
			}
		}
	}	
$URL="RKPBMD_Mid.php?JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_GET['IdL'];
header("Location: ".$URL);
?>

<?php require('Connection_Close.php');?>
