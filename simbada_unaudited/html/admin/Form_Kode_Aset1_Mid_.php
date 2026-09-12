<?
require('Connection.php');
require('FileFunction.php');
extract($_POST);
extract($_GET);
$Smp    = $Simpan;
$rIDT   = $rIDT;
$gNmA   = $fNama;
$gEXT  = fConvertToNumeric($fExtra);

if ($fKode!="01" && $fKode!="02" && $fKode!="03" && $fKode!="04" && $fKode!="05"){
	$gEXT=0;
}

if ($Smp=="Save")
	{
		if ($rIDT!="")
		{
			$SQL = "UPDATE ref_rek_aset1 SET 
			Nm_Aset='$gNmA', nilaiExtracom='$gEXT' WHERE IDT='".$rIDT."'";
			$rst = mysql_query($SQL) or die(mysql_error());		
		}
		else
		{
			//CARI KODE TERAKHIR
			$nSQL = "SELECT IFNULL(MAX(Kd_Aset),0) AS LasKd FROM ref_rek_aset1 WHERE Kd_Aset LIKE '__'";
			$nRst = mysql_query($nSQL) or die(mysql_error());
			$nRow = mysql_fetch_assoc($nRst);
			$NewG = $nRow['LasKd'];
			$NewG = ((int)substr($NewG,-2)) + 1;
			$NewKode =fMakeReferensi($NewG,2);
			
			$SQL = "INSERT INTO ref_rek_aset1 SET 
			Kd_Aset='$NewKode', Nm_Aset='$gNmA', nilaiExtracom='$gEXT'";
			$rst = mysql_query($SQL) or die(mysql_error());		
			
			$rIDT = fGlobal("IDT","Ref_Rek_Aset1","Kd_Aset","__","LIKE","IDT desc LIMIT 1","");
		}
		$URL="Form_Kode_Aset1_Mid.php?FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']."&rIDT=".$rIDT;
		header("Location: ".$URL);
	}
else if ($Smp=="Reset")
	{
		$URL="Form_Kode_Aset1_Mid.php?IdL=".$_REQUEST['IdL'];
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
?>

<?php require('Connection_Close.php');?>
