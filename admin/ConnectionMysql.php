<?php
require_once dirname(__DIR__) . '/mysql_adapter.php';

define('TxReadOnly','Mohon maaf, akses data hanya readonly..!!');
define('HostnameMY','db-server');
define('DatabaseMY','sipper');
define('UsernameMY','root');
define('PasswordMY','ra11-192011');

define('PortMY','3306');

$ConMY = mysql_connect(HostnameMY.":".PortMY, UsernameMY, PasswordMY);
if ($ConMY==false)
{
	echo "Error: <font color='#FF0000'>Koneksi ke server tidak berhasil...!!</font>";
	exit;
}
?>
