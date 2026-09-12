<?
require('Connection.php');
require('FileFunction.php');
$Smp    = $_REQUEST['Simpan'];
$rIDT   = $_REQUEST['rIDT'];
$gNmA   = $_REQUEST['fNama'];

$gBid  = $_REQUEST['fBid'];
$gUnt  = $_REQUEST['fUnt'];

if ($Smp=="Save")
	{
		if ($rIDT!="")
		{
			$SQL = "UPDATE ref_sub_unit SET 
			Nm_Sub='$gNmA' WHERE IDT='".$rIDT."'";
			$rst = mysql_query($SQL) or die(mysql_error());		
		}
		else
		{
			//CARI KODE TERAKHIR
			$nSQL = "SELECT IFNULL(MAX(Kd_Sub),0) AS LasKd FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gBid.".".substr($gUnt,-2).".__'";
			$nRst = mysql_query($nSQL) or die(mysql_error());
			$nRow = mysql_fetch_assoc($nRst);
			$NewG = $nRow['LasKd'];
			$NewG = ((int)substr($NewG,-2)) + 1;
			$NewKode =$gBid.".".substr($gUnt,-2).".".fMakeReferensi($NewG,2);
			
			$SQL = "INSERT INTO ref_sub_unit SET 
			Kd_Sub='$NewKode', Nm_Sub='$gNmA'";
			$rst = mysql_query($SQL) or die(mysql_error());		
			
			$rIDT = fGlobal("IDT","Ref_Sub_Unit","Kd_Sub",$gBid.".".substr($gUnt,-2).".__","like","IDT desc LIMIT 1","");
		}
		$URL="Form_Sub_Unit_Mid.php?FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']."&rIDT=".$rIDT;
		header("Location: ".$URL);
	}
else if ($Smp=="Reset")
	{
		$URL="Form_Sub_Unit_Mid.php?IdL=".$_REQUEST['IdL']."&gBid=".$gBid."&gUnt=".$gUnt;
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
		$URL="Form_Sub_Unit_Mid.php?IdL=".$_REQUEST['IdL']."&gBid=".$gBid."&gUnt=".$gUnt;
		header("Location: ".$URL);
	}
?>

<?php require('Connection_Close.php');?>
