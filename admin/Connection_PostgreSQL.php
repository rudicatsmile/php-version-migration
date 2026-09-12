<?php
#date_default_timezone_set('Asia/Jakarta');
#define('HostnameSA','localhost');
#define('DatabaseSA','Sapbd_Kobar_2019');
#define('UsernameSA','proiso');
#define('PasswordSA','ra11-192011');
#define('Port','3306');
#$gPCT  = "";
#$ConSA = mysql_connect(HostnameSA.":".Port, UsernameSA, PasswordSA);
#if ($ConSA==false)
#{
#	echo "Error: <font color='#FF0000'>Koneksi ke server tidak berhasil...!!</font>";
#	exit;
#}

$host    =  "localhost";
$dbuser  =  "postgres";
$dbpass  =  "5116752011";
$dbname  =  "kabupaten";
$port    =  "5432";

/*
$link = new PDO("pgsql:dbname=$dbname; host=$host", $dbuser, $dbpass);  
if($link)
{
    echo "Koneksi Berhasil";
}else
{
    echo "Gagal melakukan Koneksi";
}
*/

$PgConn = pg_connect("host=$host port=$port dbname=$dbname user=$dbuser password=$dbpass");

#$nSQ = "SELECT * FROM hak_tanah LIMIT 2";
#$nRs = pg_prepare($PgConn, "MyQuery", $nSQ);
#$nRs = pg_execute($PgConn, "MyQuery", array());
#while ($mRo = pg_fetch_array($nRs))
#{
#	echo $mRo[0]." : ".$mRo[1]."<br>";
#}

?>
