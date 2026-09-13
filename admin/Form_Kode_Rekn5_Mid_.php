<?php
require('Connection.php');
require('FileFunction.php');
$Smp    = $_REQUEST['Simpan'] ?? '';
$rIDT   = $_REQUEST['rIDT'] ?? '';
$gNmA   = $_REQUEST['fNama'] ?? '';

$gBid  = $_REQUEST['fBid'] ?? '';
$gKel  = $_REQUEST['fKel'] ?? '';
$gJNS  = $_REQUEST['fJNS'] ?? '';
$gOBJ  = $_REQUEST['fOBJ'] ?? '';

if ($Smp=="Save")
	{
		if ($rIDT!="")
		{
			$SQL = "UPDATE ref_rek_5 SET 
			Nm_Rek='$gNmA' WHERE IDT='".$rIDT."'";
			$rst = mysql_query($SQL) or die(mysql_error());		
		}
		else
		{
			//CARI KODE TERAKHIR
			$nSQL = "SELECT IFNULL(MAX(Kd_Rek),0) AS LasKd FROM ref_rek_5 WHERE Kd_Rek LIKE '".$gOBJ.".__'";
			$nRst = mysql_query($nSQL) or die(mysql_error());
			$nRow = mysql_fetch_assoc($nRst);
			$NewG = $nRow['LasKd'];
			$NewG = ((int)substr($NewG,-2)) + 1;
			$NewKode =$gOBJ.".".fMakeReferensi($NewG,2);
			
			$SQL = "INSERT INTO ref_rek_5 SET 
			Kd_Rek='$NewKode', Nm_Rek='$gNmA'";
			$rst = mysql_query($SQL) or die(mysql_error());		
			
			$rIDT = fGlobal("IDT","Ref_Rek_5","Kd_Rek",$gOBJ.".__","like","IDT desc LIMIT 1","");
		}
		$URL="Form_Kode_Rekn5_Mid.php?FrmG=".($_REQUEST['FrmG'] ?? '')."&IdL=".($_REQUEST['IdL'] ?? '')."&rIDT=".$rIDT;
		header("Location: ".$URL);
	}
else if ($Smp=="Reset")
	{
		$URL="Form_Kode_Rekn5_Mid.php?FrmG=".($_REQUEST['FrmG'] ?? '')."&IdL=".($_REQUEST['IdL'] ?? '')."&gBid=".$gBid."&gKel=".$gKel."&gJNS=".$gJNS."&gOBJ=".$gOBJ;
		header("Location: ".$URL);
	}
else if ($Smp=="Close")
	{
		?>
		<script language="JavaScript">  	
		this.window.focus()
		this.window.document.clear()
		this.window.document.close() 
		this.setTimeout("self.close()",1)
		</script>
		<?php
	}
else
	{
		$URL="Form_Kode_Rekn5_Mid.php?FrmG=".($_REQUEST['FrmG'] ?? '')."&IdL=".($_REQUEST['IdL'] ?? '')."&gBid=".$gBid."&gKel=".$gKel."&gJNS=".$gJNS."&gOBJ=".$gOBJ;
		header("Location: ".$URL);
	}
?>

<?php require('Connection_Close.php');?>
