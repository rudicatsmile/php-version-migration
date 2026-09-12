<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
extract($_POST);

$Smp    = $Simpan;
$rIDT   = $rIDT;
$gNmA   = $fNama;
$gMsA   = $fMasa;

$gBid  = $fBid;
$gKel  = $fKel;
$gJNS  = $fJNS;
$gOBJ  = $fOBJ;
$gSUB  = $fSUB;

if ($Smp=="Add")
	{
		$gKD = fGlobal("kd_aset","ref_rek_aset108_7","IDT",$rIDT,"=","","");
		$SQ  = "INSERT INTO ta_masa_manfaat_108 SET 
		Kode='$gKD', tA='0', tB='0', tUmur='0'";
		$rs = mysql_query($SQ) or die(mysql_error());		
		
		#$URL="Form_Kode_Aset5_Mid.php?FrmG=".$FrmG."&IdL=".$IdL."&rIDT=".$rIDT;
		$URL="Form_Kode_Aset108_6_Mid.php?FrmG=".$FrmG."&IdL=".$IdL."&rIDT=".$rIDT;
		header("Location: ".$URL);
	}
else if ($Smp=="DelItem")
	{
		$gDL = $_POST['fDL'];
		$SQ  = "DELETE FROM ta_masa_manfaat_108 WHERE IDT = '".$gDL."'";
		$rs = mysql_query($SQ) or die(mysql_error());		
		
		#$URL="Form_Kode_Aset5_Mid.php?FrmG=".$FrmG."&IdL=".$IdL."&rIDT=".$rIDT;
		$URL="Form_Kode_Aset108_6_Mid.php?FrmG=".$FrmG."&IdL=".$IdL."&rIDT=".$rIDT;
		header("Location: ".$URL);
	}
else if ($Smp=="Save")
	{
		if ($rIDT!="")
		{
			$SQL = "UPDATE ref_rek_aset108_7 set 
			Nm_Aset='$gNmA', Ms_Manfaat='$gMsA' where IDT='".$rIDT."'";
			$rst = mysql_query($SQL) or die(mysql_error());
		
			$gCod= fGlobal("Kd_Aset","ref_rek_aset108_7","IDT",$rIDT,"=","","");
			$nSQ = "SELECT IDT FROM ta_masa_manfaat_108 WHERE Kode = '".$gCod."' ORDER BY IDT";
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
					
					$SQ  = "UPDATE ta_masa_manfaat_108 SET 
					tA='$gA', tB='$gB', tUmur='$gU' WHERE IDT='".$gID."'";
					$rs = mysql_query($SQ) or die(mysql_error());		
				}
				while ($mRo = mysql_fetch_assoc($nRs));	
			}
		}
		else
		{
			//CARI KODE TERAKHIR
			$nSQL = "SELECT IFNULL(MAX(Kd_Aset),0) AS LasKd FROM ref_rek_aset108_7 WHERE Kd_Aset LIKE '".$gSUB.".___'";
			$nRst = mysql_query($nSQL) or die(mysql_error());
			$nRow = mysql_fetch_assoc($nRst);
			$NewG = $nRow['LasKd'];
			$NewG = ((int)substr($NewG,-3)) + 1;
			$NewKode =$gSUB.".".fMakeReferensi($NewG,3);
			
			$SQL = "INSERT INTO ref_rek_aset108_7 SET 
			Kd_Aset='$NewKode', Nm_Aset='$gNmA', Ms_Manfaat='$gMsA'";
			$rst = mysql_query($SQL) or die(mysql_error());		
			
			$rIDT = fGlobal("IDT","ref_rek_aset108_7","Kd_Aset",$gSUB.".___","LIKE","IDT desc LIMIT 1","");
		}
		$URL="Form_Kode_Aset108_6_Mid.php?FrmG=".$FrmG."&IdL=".$IdL."&rIDT=".$rIDT;
		header("Location: ".$URL);
	}
else if ($Smp=="Reset")
	{
		$URL="Form_Kode_Aset108_6_Mid.php?gBid=".$gBid."&gKel=".$gKel."&gJNS=".$gJNS."&gOBJ=".$gOBJ."&gSUB=".$gSUB."&IdL=".$IdL;
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
		$URL="Form_Kode_Aset108_6_Mid.php?gBid=".$gBid."&gKel=".$gKel."&gJNS=".$gJNS."&gOBJ=".$gOBJ."&gSUB=".$gSUB."&IdL=".$IdL;
		header("Location: ".$URL);
	}
?>

<?php require('Connection_Close.php');?>
