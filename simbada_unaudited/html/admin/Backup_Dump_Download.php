<?
$dir = "BackupData/";
if ($_GET['DownL']=="YA")
{
	$file=$_GET['NmFL'];
	// header yang menunjukkan nama file yang akan didownload
	header("Content-Disposition: attachment; filename=".$file);
	// header yang menunjukkan ukuran file yang akan didownload
	header("Content-length: ".$file);
	// header yang menunjukkan jenis file yang akan didownload
	header("Content-type: ".$file);
	// proses membaca isi file yang akan didownload dari folder ‘data’
	$fp  = fopen('BackupData/'.$file, 'r');
	$content = fread($fp, filesize('BackupData/'.$file));
	fclose($fp);
	// menampilkan isi file yang akan didownload
	echo $content;
	exit;
}
?>