<?php
require_once dirname(__DIR__) . '/mysql_adapter.php';

ini_set('max_execution_time', 300);

define('HostnameSA','localhost');
define('DatabaseSA','bimtek_bmd');
define('UsernameSA','proiso');
define('PasswordSA','ra11-19');
define('PortSA','3309');
$ConSA = mysql_connect(HostnameSA.":".PortSA, UsernameSA, PasswordSA);
if ($ConSA==false)
{
	echo "Error: <font color='#FF0000'>Koneksi ke server ".DatabaseSA." tidak berhasil...!!</font>";
	exit;
}

define('HostnameSB','localhost');
define('DatabaseSB','simbada_kobar_data');
define('UsernameSB','proiso');
define('PasswordSB','ra11-19');
define('PortSB','3309');
$ConSB = mysql_connect(HostnameSB.":".PortSB, UsernameSB, PasswordSB);
if ($ConSB==false)
{
	echo "Error: <font color='#FF0000'>Koneksi ke server ".DatabaseSB." tidak berhasil...!!</font>";
	exit;
}

function CallConnection($gDatabase,$gCon)
{
	$SelDB =  mysql_select_db($gDatabase, $gCon);
	if ($SelDB==false)
	{
		echo "Error: Database <font color='#FF0000'><b>".$gDatabase."</b></font> tidak ditemukan xx...!!";
		exit;
	}
}

//var $result_id				= NULL;
//var $result_array			= array();
function result_array()
{
	if (count($this->result_array) > 0)
	{
		return $this->result_array;
	}

	// In the event that query caching is on the result_id variable
	// will return FALSE since there isn't a valid SQL resource so
	// we'll simply return an empty array.
	if ($this->result_id === FALSE OR $this->num_rows() == 0)
	{
		return array();
	}

	$this->_data_seek(0);
	while ($row = $this->_fetch_assoc())
	{
		$this->result_array[] = $row;
	}

	return $this->result_array;
}

?>
