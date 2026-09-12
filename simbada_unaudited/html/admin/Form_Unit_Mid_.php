<?
require('Connection.php');
require('Connection_Simkada.php');
require('FileFunction.php');
extract($_POST);
extract($_GET);

$Smp    = $Simpan;
$rIDT   = $rIDT;
$gNmA   = $fNama;
$gBid  = $fBid;
$gLNK  = $fLINK;

$gPimD   = $fHp_Pimpinan;
$gPimE   = $fPin_Pimpinan;
$gPimF   = $fEma_Pimpinan;
#echo $gPimE;
#return false;
$gPrsA   = $fNm_Pengurus;
$gPrsB   = $fNip_Pengurus;
$gPrsC   = $fJbt_Pengurus;
$gPrsD   = $fHp_Pengurus;
$gPrsF   = $fEma_Pengurus;
$gPrsG   = $fPkt_Pengurus;

$gPnyA   = $fNm_Penyimpan;
$gPnyB   = $fNip_Penyimpan;
$gPnyC   = $fJbt_Penyimpan;
$gPnyD   = $fHp_Penyimpan;
$gPnyF   = $fEma_Penyimpan;
$gPnyG   = $fPkT_Penyimpan;

$gAkuA   = $fNm_Akuntan;
$gAkuB   = $fNip_Akuntan;
$gAkuC   = $fJbt_Akuntan;
$gAkuD   = $fHp_Akuntan;
$gAkuF   = $fEma_Akuntan;
$gAkuG   = $fPkT_Akuntan;


if ($Smp=="Save")
	{
		if ($rIDT!="")
		{
			$SQL = "UPDATE ref_unit SET 
			Nm_Unit='$gNmA', 
			Kd_Unit_Link='$gLNK', 
			Nm_Unit_Link='$fLIND', 
			Nma_Pimpinan='".$fNmA."', 
			Nip_Pimpinan='$fNiP', 
			Jab_Pimpinan='$fJaB', 
			Pkt_Pimpinan='$fPkT', 
			Hp_Pimpinan='$gPimD',
			Ema_Pimpinan='$gPimF',
			
			Nm_Pengurus='$gPrsA',
			Nip_Pengurus='$gPrsB',
			Jbt_Pengurus='$gPrsC',
			Hp_Pengurus='$gPrsD',
			Ema_Pengurus='$gPrsF',
			Pkt_Pengurus='$gPrsG',
		
			Nm_Penyimpan='$gPnyA',
			Nip_Penyimpan='$gPnyB',
			Jbt_Penyimpan='$gPnyC', 
			Hp_Penyimpan='$gPnyD',
			Ema_Penyimpan='$gPnyF', 
			Pkt_Penyimpan='$gPnyG',
			
			Nm_Akuntan='$gAkuA',
			Nip_Akuntan='$gAkuB',
			Jbt_Akuntan='$gAkuC', 
			Hp_Akuntan='$gAkuD',
			Ema_Akuntan='$gAkuF', 
			Pkt_Akuntan='$gAkuG' 
			
			WHERE IDT='".$rIDT."'";
			$rst = mysql_query($SQL) or die(mysql_error());		
		}
		else
		{
			//CARI KODE TERAKHIR
			$nSQL = "SELECT IFNULL(MAX(Kd_Unit),0) AS LasKd FROM ref_unit WHERE Kd_Unit LIKE '".$gBid.".__'";
			$nRst = mysql_query($nSQL) or die(mysql_error());
			$nRow = mysql_fetch_assoc($nRst);
			$NewG = $nRow['LasKd'];
			$NewG = ((int)substr($NewG,-2)) + 1;
			$NewKode =$gBid.".".fMakeReferensi($NewG,2);
			
			$SQL = "INSERT INTO ref_unit SET 
			Kd_Unit='$NewKode', Nm_Unit='$gNmA', Kd_Unit_Link='$gLNK', Nma_Pimpinan='".$fNmA."', Nip_Pimpinan='$fNiP', Jab_Pimpinan='$fJaB', Pkt_Pimpinan='$fPkT'";
			$rst = mysql_query($SQL) or die(mysql_error());		
			
			$rIDT = fGlobal("max(IDT)","Ref_Unit","Kd_Unit",$gBid.".__","like","","");
		}
		$URL="Form_Unit_Mid.php?FrmG=".$FrmG."&IdL=".$IdL."&rIDT=".$rIDT;
		header("Location: ".$URL);
	}
else if ($Smp=="Reset")
	{
		$URL="Form_Unit_Mid.php?IdL=".$IdL."&gBid=".$gBid;
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
		$URL="Form_Unit_Mid.php?IdL=".$IdL."&gBid=".$gBid;
		header("Location: ".$URL);
	}
?>

<?php require('Connection_Close.php');?>
