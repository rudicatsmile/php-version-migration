<?
require "Connection.php";
require "FileFunction.php";
extract($_GET);
#$ReG = fGlobal("Referensi","ta_kib_".substr($crt,0,1),"IDT",$rIdT,"=","","");
$ReG = fGlobal("Referensi","ta_kib_108","IDT",$rIdT,"=","","");

if ($_POST['Simpan']=="Upload")
{
	$file_name = $_FILES['file']['name']; //nama file (tanpa path)
	$tmp_name  = $_FILES['file']['tmp_name']; //nama local temp file di server
	$file_size = $_FILES['file']['size']; //ukuran file (dalam bytes)
	$file_type = $_FILES['file']['type']; //tipe filenya (langsung detect MIMEnya)
	$fp = fopen($tmp_name, 'r'); // open file (read-only, binary)
	$file_content = fread($fp, $file_size) or die("Tidak dapat membaca source file"); // read file
	$file_content = mysql_real_escape_string($file_content) or die("Tidak dapat membaca source file"); // parse image ke string
	fclose($fp);
	if ($gIdT)
	{
		#$nSQL = "UPDATE ta_kib_".substr($crt,0,1)."_pdf SET 
		$nSQL = "UPDATE ta_kib_108_pdf SET 
		file_content='$file_content', 
		file_name='$file_name', 
		file_type='$file_type', 
		file_size='$file_size' WHERE IDT='".$gIdT."'";
	} else {
		#$nSQL = "INSERT INTO ta_kib_".substr($crt,0,1)."_pdf SET 
		$nSQL = "INSERT INTO ta_kib_108_pdf SET 
		Referensi='$ReG', 
		file_content='$file_content', 
		file_name='$file_name', 
		file_type='$file_type', 
		file_size='$file_size'";
	}
	$nRs = mysql_query($nSQL) or die(mysql_error());
	
	CloseWin($crt,$rIdT,$IdL);
}
if ($_POST['Simpan']=="Delete")
{
	#$nSQL = "DELETE FROM ta_kib_".substr($crt,0,1)."_pdf WHERE IDT='".$gIdT."'";
	$nSQL = "DELETE FROM ta_kib_108_pdf WHERE IDT='".$gIdT."'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	CloseWin($crt,$rIdT,$IdL);
}

function CloseWin($crt,$rIdT,$IdL)
{
	$URL="Form_Asset_".strtoupper($crt)."_Mid.php?rIDT=".$rIdT."&IdL=".$IdL;
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
