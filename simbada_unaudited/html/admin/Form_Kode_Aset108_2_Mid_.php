<?
require('Connection.php');
require('FileFunction.php');
extract($_POST);
extract($_GET);
$Smp    = $Simpan;
$rIDT   = $rIDT;
$gNmA   = $fNama;
$gBid  = $fBid;

if ($Smp=="Save")
	{
		if ($rIDT!="")
		{
			$SQL = "UPDATE ref_rek_aset108_3 SET 
			Nm_Aset='$gNmA' WHERE IDT='".$rIDT."'";
			$rst = mysql_query($SQL) or die(mysql_error());		
		}
		else
		{
			//CARI KODE TERAKHIR
			$nSQL = "SELECT IFNULL(MAX(Kd_Aset),0) AS LasKd FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '".$gBid."._'";
			$nRst = mysql_query($nSQL) or die(mysql_error());
			$nRow = mysql_fetch_assoc($nRst);
			$NewG = $nRow['LasKd'];
			$NewG = ((int)substr($NewG,-1,1)) + 1;
			$NewKode =$gBid.".".fMakeReferensi($NewG,1);
			
			$SQL = "INSERT INTO ref_rek_aset108_3 SET 
			Kd_Aset='$NewKode', Nm_Aset='$gNmA'";
			$rst = mysql_query($SQL) or die(mysql_error());		
			
			$rIDT = fGlobal("IDT","ref_rek_aset108_3","Kd_Aset",$gBid."._","LIKE","IDT desc LIMIT 1","");
		}
		$URL="Form_Kode_Aset108_2_Mid.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&rIDT=".$rIDT;
		header("Location: ".$URL);
	}
else if ($Smp=="Reset")
	{
		$URL="Form_Kode_Aset108_2_Mid.php?IdL=".$_GET['IdL']."&gBid=".$gBid;
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
		$URL="Form_Kode_Aset108_2_Mid.php?IdL=".$_GET['IdL']."&gBid=".$gBid;
		header("Location: ".$URL);
	}
?>

<?php require('Connection_Close.php');?>
