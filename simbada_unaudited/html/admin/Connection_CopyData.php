<?
date_default_timezone_set('Asia/Jakarta');
define('HostnameSC','localhost');
define('DatabaseSC','Simbada_data_2025_back');
define('UsernameSC','root');
define('PasswordSC','ra11-192011');
define('Port','3307');
$gPCT  = "";
$ConSC = mysql_connect(HostnameSC.":".Port, UsernameSC, PasswordSC);
if ($ConSC==false)
{
	echo "Error: <font color='#FF0000'>Koneksi ke server tidak berhasil...!!</font>";
	exit;
}
?>
