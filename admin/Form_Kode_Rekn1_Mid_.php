<?php
require('Connection.php');
require('FileFunction.php');
$Smp    = $_REQUEST['Simpan'] ?? '';
$rIDT   = $_REQUEST['rIDT'] ?? '';
$gNmA   = $_REQUEST['fNama'] ?? '';

if ($Smp=="Save")
	{
		if ($rIDT!="")
		{
			$SQL = "UPDATE ref_rek_1 set 
			Nm_Rek='$gNmA' WHERE IDT='".$rIDT."'";
			$rst = mysql_query($SQL) or die(mysql_error());		
		}
		else
		{
			//CARI KODE TERAKHIR
			$nSQL = "SELECT IFNULL(MAX(Kd_Rek),0) AS LasKd FROM ref_rek_1 WHERE Kd_Rek LIKE '_'";
			$nRst = mysql_query($nSQL) or die(mysql_error());
			$nRow = mysql_fetch_assoc($nRst);
			$NewG = $nRow['LasKd'];
			$NewG = ((int)substr($NewG,-1)) + 1;
			$NewKode =fMakeReferensi($NewG,1);
			
			$SQL = "INSERT INTO ref_rek_1 SET 
			Kd_Rek='$NewKode', Nm_Rek='$gNmA'";
			$rst = mysql_query($SQL) or die(mysql_error());		
			
			$rIDT = fGlobal("IDT","Ref_Rek_1","Kd_Rek","_","LIKE","IDT desc LIMIT 1","");
		}
		$URL="Form_Kode_Rekn1_Mid.php?FrmG=".($_REQUEST['FrmG'] ?? '')."&IdL=".($_REQUEST['IdL'] ?? '')."&rIDT=".$rIDT;
		header("Location: ".$URL);
	}
else if ($Smp=="Reset")
	{
		$URL="Form_Kode_Rekn1_Mid.php?FrmG=".($_REQUEST['FrmG'] ?? '')."&IdL=".($_REQUEST['IdL'] ?? '');
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
