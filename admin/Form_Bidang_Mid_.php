<?php
require('Connection.php');
require('FileFunction.php');
$Smp    = $_REQUEST['Simpan'];
$rIDT   = $_REQUEST['rIDT'];
$gNmA   = $_REQUEST['fNama'];

if ($Smp=="Save")
	{
		if ($rIDT!="")
		{
			$SQL = "UPDATE ref_bidang SET 
			Nm_Bidang='$gNmA' WHERE IDT='".$rIDT."'";
			$rst = mysql_query($SQL) or die(mysql_error());		
		}
		else
		{
			//CARI KODE TERAKHIR
			$nSQL = "SELECT IFNULL(MAX(Kd_Bidang),0) AS LasKd FROM ref_bidang WHERE Kd_Bidang LIKE '__.__.__'";
			$nRst = mysql_query($nSQL) or die(mysql_error());
			$nRow = mysql_fetch_assoc($nRst);
			$NewG = $nRow['LasKd'];
			$NewG = ((int)substr($NewG,-2)) + 1;
			$NewKode = $KdProp.".".$KdKabK.".".fMakeReferensi($NewG,2);
			
			$SQL = "INSERT INTO ref_bidang SET 
			Kd_Bidang='$NewKode', Nm_Bidang='$gNmA'";
			$rst = mysql_query($SQL) or die(mysql_error());		
			
			$rIDT = fGlobal("IDT","Ref_Bidang","Kd_Bidang","__.__.__","LIKE","IDT desc LIMIT 1","");
		}
		$URL="Form_Bidang_Mid.php?FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']."&rIDT=".$rIDT;
		header("Location: ".$URL);
	}
else if ($Smp=="Reset")
	{
		$URL="Form_Bidang_Mid.php?IdL=".$_REQUEST['IdL'];
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
?>

<?php require('Connection_Close.php');?>
