<?
require('Connection.php');
require('FileFunction.php');

extract($_POST);
extract($_GET);

if ($Simpan=="Save")
{
	CallConnection(DatabaseSB,$ConSB);
	
	if ($fCopy13=="ON")
	{
		$nSQ = "SELECT Kd_Aset FROM ref_rek_aset5 WHERE Kd_Aset LIKE '".substr($nRK,0,11)."%' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$mRK = $mRo[0];
			$gREC = fGlobalNEW("Kd_Aset17","ref_rek_aset5_maping","Kd_Aset17",$mRK,"=","",DatabaseSB,$ConSB,"");
			if ($gREC)
			{
				$SQL = "UPDATE ref_rek_aset5_maping SET 
				Kd_Aset13='$fRIN13' WHERE Kd_Aset17='$gREC'";
				$rst = mysql_query($SQL) or die(mysql_error());
				
			}
			else
			{
				$SQL = "INSERT INTO ref_rek_aset5_maping SET 
				Kd_Aset17='$mRK', Kd_Aset13='$fRIN13'";
				$rst = mysql_query($SQL) or die(mysql_error());
			}
		}
	}
	else if ($fCopy64=="ON")
	{
		$nSQ = "SELECT Kd_Aset FROM ref_rek_aset5 WHERE Kd_Aset LIKE '".substr($nRK,0,11)."%' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$mRK = $mRo[0];
			$gREC = fGlobalNEW("Kd_Aset17","ref_rek_aset5_maping","Kd_Aset17",$mRK,"=","",DatabaseSB,$ConSB,"");
			if ($gREC)
			{
				$SQL = "UPDATE ref_rek_aset5_maping SET 
				Kd_Aset64='$fRIN64' WHERE Kd_Aset17='$gREC'";
				$rst = mysql_query($SQL) or die(mysql_error());
				
			}
			else
			{
				$SQL = "INSERT INTO ref_rek_aset5_maping SET 
				Kd_Aset17='$mRK', Kd_Aset64='$fRIN64'";
				$rst = mysql_query($SQL) or die(mysql_error());
			}
		}
	}
	else
	{
		$gREC = fGlobalNEW("Kd_Aset17","ref_rek_aset5_maping","Kd_Aset17",$nRK,"=","",DatabaseSB,$ConSB,"");
		if ($gREC)
		{
			$SQL = "UPDATE ref_rek_aset5_maping SET 
			Kd_Aset64='$fRIN64', Kd_Aset13='$fRIN13' WHERE Kd_Aset17='$gREC'";
			$rst = mysql_query($SQL) or die(mysql_error());
			
		}
		else
		{
			$SQL = "INSERT INTO ref_rek_aset5_maping SET 
			Kd_Aset17='$nRK', Kd_Aset64='$fRIN'";
			$rst = mysql_query($SQL) or die(mysql_error());
			
		}
	}
	
	$URL="Ref_Kode_Aset_Maping_Mid.php?nRK=".$nRK."&rKdA=".$_GET['rKdA']."&rKdB=".$_GET['rKdB']."&rKdC=".$_GET['rKdC']."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}
else if ($Simpan=="Reset")
{
	$URL="Ref_Kode_Aset_Maping_Mid.php?nRK=".$nRK."&rKdA=".$_GET['rKdA']."&rKdB=".$_GET['rKdB']."&rKdC=".$_GET['rKdC']."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}

else if ($Simpan=="Close")
{
	$URL = "Ref_Kode_Aset_Maping.php?rKdA=".$_GET['rKdA']."&rKdB=".$_GET['rKdB']."&rKdC=".$_GET['rKdC']."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
	$gTrGt="MidFrame";
	?>
	<script language="JavaScript">  	
	this.window.open ('<?=$URL?>','<?=$gTrGt?>')
	this.window.focus()
	this.window.document.clear()
	this.window.document.close() 
	this.setTimeout("self.close()",1)
	</script>
	<?
}
?>
