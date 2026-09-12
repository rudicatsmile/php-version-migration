<?
require('Connection.php');
require('FileFunction.php');
$Smp    = $_POST['Simpan'];
$rIDO   = $_GET['rIDO'];

$gCod1  = strtoupper($_POST['fKode1']);
$gCod2  = strtoupper($_POST['fKode2']);
$gCod3  = strtoupper($_POST['fKode3']);

$Urt = $gCod1;
if ($gCod1=="X") {$Urt = "0";}

$gNmA   = $_POST['fNama'];

if ($Smp=="Save")
	{
		if ($rIDO!="")
		{
			$SQL = "UPDATE ref_kegiatan set 
			Nm_Referensi='$gNmA', Id_Urusan='$gCod1', Urut='$Urt' WHERE IDO='".$rIDO."'";
			$rst = mysql_query($SQL) or die(mysql_error());		
			$MsG = "Proses berhasil..!";
		}
		else
		{
			$NewKode= $gCod1.".".$gCod2.".".$gCod3;
			$CekKod = fGlobal("IDO","Ref_Kegiatan","Id_Referensi",$NewKode,"=","IDO","");
			if ($CekKod=="")
				{
				$SQL = "INSERT INTO ref_kegiatan SET 
				Id_Referensi='$NewKode', Nm_Referensi='$gNmA', Id_Urusan='$gCod1', Urut='$Urt'";
				$rst = mysql_query($SQL) or die(mysql_error());		
			
				$rIDO= fGlobal("IDO","Ref_Kegiatan","Id_Referensi","_.__.XX","LIKE","IDO desc LIMIT 1","");
				$MsG = "Proses berhasil..!";
				}
			else
				{
				$MsG = "Kode sudah dipergunakan oleh yang lain, Proses dibatalkan..!!";
				}
		}
		$URL="Form_ProKeg1_Mid.php?MsG=".$MsG."&IdL=".$_REQUEST['IdL']."&rIDO=".$rIDO;
		header("Location: ".$URL);
	}
else if ($Smp=="Reset")
	{
		$URL="Form_ProKeg1_Mid.php?IdL=".$_REQUEST['IdL'];
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
