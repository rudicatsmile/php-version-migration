<?
require('Connection.php');
require('FileFunction.php');
$Smp    = $_REQUEST['Simpan'];
$rIDT   = $_REQUEST['rIDT'];
$gNmA   = $_REQUEST['fNama'];

$gBid  = $_REQUEST['fBid'];

if ($Smp=="Save")
	{
		if ($rIDT!="")
		{
			$SQL = "UPDATE ref_rek_aset2 SET 
			Nm_Aset='$gNmA' WHERE IDT='".$rIDT."'";
			$rst = mysql_query($SQL) or die(mysql_error());		
		}
		else
		{
			//CARI KODE TERAKHIR
			$nSQL = "SELECT IFNULL(MAX(Kd_Aset),0) AS LasKd FROM ref_rek_aset2 WHERE Kd_Aset LIKE '".$gBid.".__'";
			$nRst = mysql_query($nSQL) or die(mysql_error());
			$nRow = mysql_fetch_assoc($nRst);
			$NewG = $nRow['LasKd'];
			$NewG = ((int)substr($NewG,-2)) + 1;
			$NewKode =$gBid.".".fMakeReferensi($NewG,2);
			
			$SQL = "INSERT INTO ref_rek_aset2 SET 
			Kd_Aset='$NewKode', Nm_Aset='$gNmA'";
			$rst = mysql_query($SQL) or die(mysql_error());		
			
			$rIDT = fGlobal("IDT","Ref_Rek_Aset2","Kd_Aset",$gBid.".__","LIKE","IDT desc LIMIT 1","");
		}
		$URL="Form_Kode_Aset2_Mid.php?FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']."&rIDT=".$rIDT;
		header("Location: ".$URL);
	}
else if ($Smp=="Reset")
	{
		$URL="Form_Kode_Aset2_Mid.php?IdL=".$_REQUEST['IdL']."&gBid=".$gBid;
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
		<?
	}
else
	{
		$URL="Form_Kode_Aset2_Mid.php?IdL=".$_REQUEST['IdL']."&gBid=".$gBid;
		header("Location: ".$URL);
	}
?>

<?php require('Connection_Close.php');?>
