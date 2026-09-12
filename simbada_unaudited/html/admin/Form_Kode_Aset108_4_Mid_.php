<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
extract($_POST);
$Smp    = $Simpan;
$rIDT   = $rIDT;
$gNmA   = $fNama;
$gLiN   = $fLin;

$gBid  = $fBid;
$gKel  = $fKel;
$gJNS  = $fJNS;

if ($Smp=="Save")
	{
		if ($rIDT!="")
		{
			$SQL = "UPDATE ref_rek_aset108_5 SET 
			Nm_Aset='$gNmA', LinkKeAsetTetap='$gLiN' WHERE IDT='".$rIDT."'";
			$rst = mysql_query($SQL) or die(mysql_error());	
		}
		else
		{
			//CARI KODE TERAKHIR
			$nSQL = "SELECT IFNULL(MAX(Kd_Aset),0) AS LasKd FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '".$gJNS.".__'";
			$nRst = mysql_query($nSQL) or die(mysql_error());
			$nRow = mysql_fetch_assoc($nRst);
			$NewG = $nRow['LasKd'];
			$NewG = ((int)substr($NewG,-2)) + 1;
			$NewKode =$gJNS.".".fMakeReferensi($NewG,2);
			
			$SQL = "INSERT INTO ref_rek_aset108_5 SET 
			Kd_Aset='$NewKode', Nm_Aset='$gNmA', LinkKeAsetTetap='$gLiN'";
			$rst = mysql_query($SQL) or die(mysql_error());		
			
			$rIDT = fGlobal("IDT","ref_rek_aset108_5","Kd_Aset",$gJNS.".__","LIKE","IDT desc LIMIT 1","");
		}
		$URL="Form_Kode_Aset108_4_Mid.php?FrmG=".$FrmG."&IdL=".$IdL."&rIDT=".$rIDT;
		header("Location: ".$URL);
	}
else if ($Smp=="Reset")
	{
		$URL="Form_Kode_Aset108_4_Mid.php?IdL=".$IdL."&gBid=".$gBid."&gKel=".$gKel."&gJNS=".$gJNS;
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
		$URL="Form_Kode_Aset108_4_Mid.php?IdL=".$IdL."&gBid=".$gBid."&gKel=".$gKel."&gJNS=".$gJNS;
		header("Location: ".$URL);
	}
?>

<?php require('Connection_Close.php');?>
