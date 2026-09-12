<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
extract($_POST);
$Smp    = $Simpan;
$rIDT   = $rIDT;
$gNmA   = $fNama;

$gBid  = $fBid;
$gKel  = $fKel;
$gUMR  = $fUmur;

if ($Smp=="Add")
	{
		$gKD = fGlobal("Kd_Aset","Ref_Rek_Aset3","IDT",$rIDT,"LIKE","","");
		$SQ  = "INSERT INTO ta_masa_manfaat SET 
		Kode='$gKD', tA='0', tB='0', tUmur='0'";
		$rs = mysql_query($SQ) or die(mysql_error());		
		
		$URL="Form_Kode_Aset3_Mid.php?FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']."&rIDT=".$rIDT;
		header("Location: ".$URL);
	}
else if ($Smp=="DelItem")
	{
		$gDL = $_POST['fDL'];
		$SQ  = "DELETE FROM ta_masa_manfaat WHERE IDT = '".$gDL."'";
		$rs = mysql_query($SQ) or die(mysql_error());		
		
		$URL="Form_Kode_Aset3_Mid.php?FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']."&rIDT=".$rIDT;
		header("Location: ".$URL);
	}
else if ($Smp=="Save")
	{
		if ($rIDT!="")
		{
			$SQL = "update ref_rek_aset3 set 
			Nm_Aset='$gNmA', Ms_Manfaat='$gUMR' where IDT='".$rIDT."'";
			$rst = mysql_query($SQL) or die(mysql_error());		
			
			$gCod= fGlobal("Kd_Aset","Ref_Rek_Aset3","IDT",$rIDT,"LIKE","","");
			$nSQ = "SELECT IDT FROM ta_masa_manfaat WHERE Kode = '".$gCod."' ORDER BY IDT";
			$nRs = mysql_query($nSQ) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
				do
				{
					$gID = $mRo['IDT'];
					$gA  = fConvertToNumeric($_POST['fA'.$gID]);
					$gB  = fConvertToNumeric($_POST['fB'.$gID]);
					$gU  = fConvertToNumeric($_POST['fU'.$gID]);
					
					$SQ  = "UPDATE ta_masa_manfaat SET 
					tA='$gA', tB='$gB', tUmur='$gU' WHERE IDT='".$gID."'";
					$rs = mysql_query($SQ) or die(mysql_error());		
				}
				while ($mRo = mysql_fetch_assoc($nRs));	
			}
			//return false;
		}
		else
		{
			//CARI KODE TERAKHIR
			$nSQL = "SELECT IFNULL(MAX(Kd_Aset),0) AS LasKd FROM ref_rek_aset3 WHERE Kd_Aset LIKE '".$gKel.".__'";
			$nRst = mysql_query($nSQL) or die(mysql_error());
			$nRow = mysql_fetch_assoc($nRst);
			$NewG = $nRow['LasKd'];
			$NewG = ((int)substr($NewG,-2)) + 1;
			$NewKode =$gKel.".".fMakeReferensi($NewG,2);
			
			$SQL = "INSERT INTO ref_rek_aset3 SET 
			Kd_Aset='$NewKode', Nm_Aset='$gNmA', Ms_Manfaat='$gUMR'";
			$rst = mysql_query($SQL) or die(mysql_error());		
			
			$rIDT = fGlobal("IDT","Ref_Rek_Aset3","Kd_Aset",$gKel.".__","LIKE","IDT desc LIMIT 1","");
		}
		$URL="Form_Kode_Aset3_Mid.php?FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']."&rIDT=".$rIDT;
		header("Location: ".$URL);
	}
else if ($Smp=="Reset")
	{
		$URL="Form_Kode_Aset3_Mid.php?IdL=".$_REQUEST['IdL']."&gBid=".$gBid."&gKel=".$gKel;
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
		$URL="Form_Kode_Aset3_Mid.php?IdL=".$_REQUEST['IdL']."&gBid=".$gBid."&gKel=".$gKel;
		header("Location: ".$URL);
	}
?>

<?php require('Connection_Close.php');?>
