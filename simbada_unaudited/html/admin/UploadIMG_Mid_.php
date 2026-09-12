<?
require "Connection.php";
$rIDT = $_GET['rIDT'];
$rCRT = $_GET['rCRT'];
$IdL  = $_GET['IdL'];

if ($_POST['Simpan']=="Upload")
{
	$file_name = $_FILES['file']['name']; 		//nama file (tanpa path)
	$tmp_name  = $_FILES['file']['tmp_name']; 	//nama local temp file di server
	$file_size = $_FILES['file']['size']; 		//ukuran file (dalam bytes)
	$file_type = $_FILES['file']['type']; 		//tipe filenya (langsung detect MIMEnya)
	$fp = fopen($tmp_name, 'r'); 				// open file (read-only, binary)
	$file_content = fread($fp, $file_size) or die("Tidak dapat membaca source file X"); // read file
	$file_content = mysql_real_escape_string($file_content) or die("Tidak dapat membaca source file XX"); // parse image ke string
	fclose($fp);

	#$nSQL = "UPDATE ta_kib_".substr($rCRT,0,1)." SET 
	$nSQL = "UPDATE ta_kib_108 SET 
	file_content='$file_content', 
	file_name='$file_name', 
	file_type='$file_type', 
	file_size='$file_size' WHERE IDT='".$rIDT."'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	echo CloseWin($rIDT,$rCRT,$IdL);
}
if ($_POST['Simpan']=="Delete")
{
	#$nSQL = "UPDATE ta_kib_".substr($rCRT,0,1)." SET 
	$nSQL = "UPDATE ta_kib_108 SET 
	file_content='', 
	file_name='', 
	file_type='', 
	file_size='0' WHERE IDT='".$rIDT."'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	echo CloseWin($rIDT,$rCRT,$IdL);
}

function CloseWin($rIDT,$rCRT,$IdL)
{
	$URL="Form_Asset_".strtoupper($rCRT)."_Mid.php?rIDT=".$rIDT."&IdL=".$IdL;
	?>
	<script language='JavaScript'>
	this.window.open('<?=$URL?>','WinFormKIB_Mid');
	this.window.focus();
	this.window.document.clear();
	this.window.document.close();
	this.setTimeout('self.close()',1);
	</script>
	<?
}
?>
