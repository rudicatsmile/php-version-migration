<?php
require_once dirname(__DIR__) . '/mysql_adapter.php';

date_default_timezone_set('Asia/Jakarta');
define('HostnameSC','localhost');
define('DatabaseSC','Simbada_data_2030_back');
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
