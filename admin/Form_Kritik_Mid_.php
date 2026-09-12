<?php
require('Connection.php');
$Smpn  = $_POST['fSimpan'];

$IdL  = $_GET['IdL'];
$rIDT = $_GET['rIDT'];
$gTmp = $_POST['fTmpl'];
if ($Smpn=="Save")
	{
		if ($gTmp=="ON") {$gTmp="Y";} else {$gTmp="N";}
		$SQ = "UPDATE ta_kritik_saran SET 
		Tampil='$gTmp' WHERE IDT='".$rIDT."'";
		$rs = mysql_query($SQ) or die(mysql_error());
		$MsG="Update data BERHASIL...!!";
		$rIDT=$rIDT;
		
		$URL="Form_Kritik_Mid.php?rIDT=".$rIDT."&IdL=".$IdL."&gMsG=".$MsG;
		header("Location: ".$URL);
	}
else if ($Smpn=="Close")
	{
	$URL="Kritik_Mid.php?IdL=".$IdL;
	?>
	<script LANGUAGE="JavaScript">
	this.window.open ('<?php echo $URL ?>','WinInfo_Mid')
	this.setTimeout("self.close()",0)
	</script>
	<?php
	}

?>

<?php require('Connection_Close.php');?>
