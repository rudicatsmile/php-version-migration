<?php
require "Connection.php";
require "FileFunction.php";

extract($_GET);
extract($_POST);

$rIDT    = $rIDT;
$gUpb   = $gUpb;
$gThn   = $fThn;
$Smp    = $Simpan;

$gPimA   = $fNm_Pimpinan;
$gPimB   = $fNip_Pimpinan;
$gPimC   = $fJbt_Pimpinan;

$gPimD   = $fHp_Pimpinan;
$gPimE   = $fPin_Pimpinan;
$gPimF   = $fEma_Pimpinan;

$gPrsA   = $fNm_Pengurus;
$gPrsB   = $fNip_Pengurus;
$gPrsC   = $fJbt_Pengurus;

$gPrsD   = $fHp_Pengurus;
$gPrsE   = $fPin_Pengurus;
$gPrsF   = $fEma_Pengurus;

$gPnyA   = $fNm_Penyimpan;
$gPnyB   = $fNip_Penyimpan;
$gPnyC   = $fJbt_Penyimpan;

$gPnyD   = $fHp_Penyimpan;
$gPnyE   = $fPin_Penyimpan;
$gPnyF   = $fEma_Penyimpan;

$gBosA   = $fNm_BendBOS;
$gBosB   = $fNip_BendBOS;
$gBosC   = $fJbt_BendBOS;

$gBosD   = $fHp_BendBOS;
$gBosE   = $fPin_BendBOS;
$gBosF   = $fEma_BendBOS;

if ($Smp=="Save")
{
	if ($rIDT!="")
	{
		$SQL = "UPDATE ta_upb SET 
		Tahun='$gThn',
		Nm_Pimpinan='$gPimA',
		Nip_Pimpinan='$gPimB',
		Jbt_Pimpinan='$gPimC',
		
		HP_Pimpinan='$gPimD',
		Pin_Pimpinan='$gPimE',
		Ema_Pimpinan='$gPimF',
		
		Nm_Pengurus='$gPrsA',
		Nip_Pengurus='$gPrsB',
		Jbt_Pengurus='$gPrsC',
		
		HP_Pengurus='$gPrsD',
		Pin_Pengurus='$gPrsE',
		Ema_Pengurus='$gPrsF',
	
		Nm_Penyimpan='$gPnyA',
		Nip_Penyimpan='$gPnyB',
		Jbt_Penyimpan='$gPnyC', 
		
		HP_Penyimpan='$gPnyD',
		Pin_Penyimpan='$gPnyE',
		Ema_Penyimpan='$gPnyF',
		
		Nm_Bend_BOS='$gBosA',
		Nip_Bend_BOS='$gBosB',
		Jbt_Bend_BOS='$gBosC', 
		
		HP_Bend_BOS='$gBosD',
		Pin_Bend_BOS='$gBosE',
		Ema_Bend_BOS='$gBosF' 
		
		WHERE IDT='".$rIDT."'";
		$rst = mysql_query($SQL) or die(mysql_error());		
	}
	else
	{
		$SQL = "INSERT INTO ta_upb SET 
		Tahun='$gThn',
		Kd_UPB='$gUpb',
		Nm_Pimpinan='$gPimA',
		Nip_Pimpinan='$gPimB',
		Jbt_Pimpinan='$gPimC',
		
		HP_Pimpinan='$gPimD',
		Pin_Pimpinan='$gPimE',
		Ema_Pimpinan='$gPimF',
		
		Nm_Pengurus='$gPrsA',
		Nip_Pengurus='$gPrsB',
		Jbt_Pengurus='$gPrsC',
		
		HP_Pengurus='$gPrsD',
		Pin_Pengurus='$gPrsE',
		Ema_Pengurus='$gPrsF',
	
		Nm_Penyimpan='$gPnyA',
		Nip_Penyimpan='$gPnyB',
		Jbt_Penyimpan='$gPnyC',
		
		HP_Penyimpan='$gPnyD',
		Pin_Penyimpan='$gPnyE',
		Ema_Penyimpan='$gPnyF', 
		
		Nm_Bend_BOS='$gBosA',
		Nip_Bend_BOS='$gBosB',
		Jbt_Bend_BOS='$gBosC', 
		
		HP_Bend_BOS='$gBosD',
		Pin_Bend_BOS='$gBosE',
		Ema_Bend_BOS='$gBosF'";
		
		$rst = mysql_query($SQL) or die(mysql_error());		
		$rIDT = fGlobal("IDT","Ta_UPB","Kd_UPB",$gUpb,"=","IDT desc","");
	}
	$URL="Form_UPB_Edit_Mid.php?IdL=".$IdL."&rIDT=".$rIDT;
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
