<?
require('Connection.php');
$Smpn  = $_POST['fSimpan'];

$IdL  = $_GET['IdL'];
$rIDT = $_GET['rIDT'];

$gHea = $_POST['fJdl'];
$gInf = $_POST['S1'];
$gHea = $_POST['fJdl'];
$gTmp = $_POST['fTmpl'];

$file_content="";
$file_type="";
$file_size=0;
$file_name = $_FILES['fT2']['name'];
if ($file_name)
{
	$tmp_name  = $_FILES['fT2']['tmp_name'];
	$file_size = $_FILES['fT2']['size'];
	$file_type = $_FILES['fT2']['type'];
	$fp = fopen($tmp_name, 'r');
	$file_content = fread($fp, $file_size) or die("Tidak dapat membaca source file X");
	$file_content = mysql_real_escape_string($file_content) or die("Tidak dapat membaca source file..");
	fclose($fp);
}
if ($file_size > 1000000) {
	$file_content="";
	$file_type="";
	$file_size=0;
}

if ($Smpn=="Save")
	{
		if ($gTmp=="ON") {$gTmp="Y";} else {$gTmp="N";}
		$gUid=fGlobal("User_ID","Ta_User_Log","IDT",$IdL,"=","","");
		if ($rIDT=="")
		{			
			$SQ = "INSERT INTO ta_informasi set 
			Header='$gHea',
			Informasi='$gInf',
			Tampil='$gTmp',
			photo='$file_content', 
			file_type='$file_type', 
			file_size='$file_size',
			Recorded=now(),
			Pencatat='$gUid'";
			$rs = mysql_query($SQ) or die(mysql_error());
			
			$MsG="Rekam data BERHASIL...!!";
			$rIDT=fGlobal("IDT","Ta_Informasi","IDT","%","like","IDT desc limit 0,1","");
			
		}
		else
		{
			$SQ = "UPDATE ta_informasi SET 
			Header='$gHea',
			Informasi='$gInf',
			Tampil='$gTmp',
			photo='$file_content', 
			file_type='$file_type', 
			file_size='$file_size',
			Recorded=now(),
			Pencatat='$gUid' WHERE IDT='".$rIDT."'";
			$rs = mysql_query($SQ) or die(mysql_error());
			$MsG="Update data BERHASIL...!!";
		}	
		$rIDT=$rIDT;
		
		$URL="Form_Info_Mid.php?rIDT=".$rIDT."&IdL=".$IdL."&gMsG=".$MsG;
		header("Location: ".$URL);
	}
else if ($Smpn=="Reset")
	{
	$URL="Form_Info_Mid.php?IdL=".$IdL;
	header("Location: ".$URL);
	}
else if ($Smpn=="Close")
	{
	$URL="Information_Mid.php?IdL=".$IdL;
	?>
	<script LANGUAGE="JavaScript">
	this.window.open ('<? echo $URL ?>','WinInfo_Mid')
	this.setTimeout("self.close()",0)
	</script>
	<?
	}

?>

<?php require('Connection_Close.php');?>
