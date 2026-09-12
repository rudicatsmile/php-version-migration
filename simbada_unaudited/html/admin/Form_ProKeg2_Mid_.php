<?
require('Connection.php');
require('FileFunction.php');
$Smp    = $_POST['Simpan'];
$rIDO   = $_REQUEST['rIDO'];
$gCod1  = strtoupper($_POST['fKode1']);
$gCod2  = strtoupper($_POST['fKode2']);
$gCod3  = strtoupper($_POST['fKode3']);
$gCod4  = strtoupper($_POST['fKode4']);

$Urt = $gCod1;
if ($gCod1=="X") {$Urt = "0";}

$gNmA   = $_POST['fNama'];
$IdRef1  = $_GET['IdRef1'];

if ($Smp=="Save")
	{
		if ($rIDO!="")
		{
			$SQL = "UPDATE ref_kegiatan SET 
			Nm_Referensi='$gNmA', Id_Urusan='$gCod1', Urut='$Urt'  WHERE IDO='".$rIDO."'";
			$rst = mysql_query($SQL) or die(mysql_error());		
			$MsG = "Proses berhasil..!";
		}
		else
		{
			$NewKode= $gCod1.".".$gCod2.".".$gCod3.".".$gCod4;
			$CekKod = fGlobal("IDO","Ref_Kegiatan","Id_Referensi",$NewKode,"=","IDO","");
			if ($CekKod=="")
				{
				$SQL = "INSERT INTO ref_kegiatan SET 
				Id_Referensi='$NewKode', Nm_Referensi='$gNmA', Id_Urusan='$gCod1', Urut='$Urt'";
				$rst = mysql_query($SQL) or die(mysql_error());		
			
				$rIDO= fGlobal("IDO","Ref_Kegiatan","Id_Referensi",$IdRef1.".__","LIKE","IDO desc LIMIT 1","");
				$MsG = "Proses berhasil..!";
				}
			else
				{
				$MsG = "Kode sudah dipergunakan oleh yang lain, Proses dibatalkan..!!";
				}
		}
		$URL="Form_ProKeg2_Mid.php?MsG=".$MsG."&rIDO=".$rIDO."&IdRef1=".$IdRef1."&IdL=".$_REQUEST['IdL'];
		header("Location: ".$URL);
	}
else if ($Smp=="Reset")
	{
		$URL="Form_ProKeg2_Mid.php?IdRef1=".$IdRef1."&IdL=".$_REQUEST['IdL'];
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
