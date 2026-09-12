<?php
require('Connection.php');
require('FileFunction.php');
$Smp    = $_REQUEST['Simpan'];
$rIDT   = $_REQUEST['rIDT'];
$gNmU   = $_REQUEST['fNmUpb'];
$gBdg = $_REQUEST['fBdg'];
$gUnt = $_REQUEST['fUnt'];
$gSub = $_REQUEST['fSub'];

if ($Smp=="Save")
	{
		if ($rIDT!="")
		{
			$SQL = "UPDATE ref_upb SET 
			Nm_UPB='$gNmU' WHERE IDT='".$rIDT."'";
			$rst = mysql_query($SQL) or die(mysql_error());		
		}
		else
		{
			//CARI KODE TERAKHIR
			$nSQL = "SELECT IFNULL(MAX(Kd_UPB),0) AS LasKd FROM ref_upb WHERE Kd_UPB LIKE '".$gSub.".___'";
			$nRst = mysql_query($nSQL) or die(mysql_error());
			$nRow = mysql_fetch_assoc($nRst);
			$NewG = $nRow['LasKd'];
			$NewG = ((int)substr($NewG,-3,3)) + 1;
			$NewKode =$gSub.".".fMakeReferensi($NewG,3);
			
			$SQL = "INSERT INTO ref_upb SET 
			Kd_UPB='$NewKode', Nm_UPB='$gNmU'";
			$rst = mysql_query($SQL) or die(mysql_error());		
			
			$rIDT = fGlobal("IDT","Ref_UPB","Kd_UPB",$gSub.".___","like","IDT desc","");
		}
		$URL="Form_UPB_Mid.php?FrmG=".$_REQUEST['FrmG']."&rIDT=".$rIDT."&IdL=".$_REQUEST['IdL'];
		header("Location: ".$URL);
	}
else if ($Smp=="DeleteRecord")
	{
		$DeLIDT   = $_REQUEST['CritIDT'];
		$SQL = "DELETE FROM ta_upb WHERE IDT='".$DeLIDT."'";
		$rst = mysql_query($SQL) or die(mysql_error());
		
		$URL="Form_UPB_Mid.php?FrmG=".$_REQUEST['FrmG']."&rIDT=".$rIDT."&IdL=".$_REQUEST['IdL'];
		header("Location: ".$URL);
	}
else if ($Smp=="Reset")
	{
		$URL="Form_UPB_Mid.php?gBdg=".$gBdg."&gUnt=".$gUnt."&gSub=".$gSub."&IdL=".$_REQUEST['IdL'];
		header("Location: ".$URL);
	}
else if ($Smp=="Refresh")
	{
		$URL="Form_UPB_Mid.php?rIDT=".$rIDT."&IdL=".$_REQUEST['IdL'];
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
	$gBdg  = $_REQUEST['fBdg'];
	$gUnt  = $_REQUEST['fUnt'];
	$gSub  = $_REQUEST['fSub'];
	
	$URL="Form_UPB_Mid.php?gBdg=".$gBdg."&gUnt=".$gUnt."&gSub=".$gSub."&IdL=".$_REQUEST['IdL'];
	header("Location: ".$URL);
	}
?>

<?php require('Connection_Close.php');?>
