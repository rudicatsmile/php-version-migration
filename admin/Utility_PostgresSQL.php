<?php

$host    =  "localhost";
$dbuser  =  "postgres";
$dbpass  =  "5116752011";
$dbname  =  "kabupaten";
$port    =  "5432";


#$link = new PDO("pgsql:dbname=$dbname; host=$host", $dbuser, $dbpass);  
#if(!$link)
#{
#   echo "Gagal melakukan Koneksi";
#}


#$conn = pg_connect("host=$host port=$port dbname=$dbname user=$dbuser password=$dbpass");

#$nSQ = "SELECT * FROM hak_tanah LIMIT 2";
#$nRs = pg_prepare($conn, "MyQuery", $nSQ);
#$nRs = pg_execute($conn, "MyQuery", array());
#while ($mRo = pg_fetch_array($nRs))
#{
#	echo $mRo[0]." : ".$mRo[1]."<br>";
#}


$pdo = new PDO("pgsql:dbname=$dbname; host=$host", $dbuser, $dbpass);
$stmt = $pdo->prepare('SELECT * FROM hak_tanah LIMIT 2');
$stmt->execute();
while ($mRo = pg_fetch_array($stmt))
{
	echo $mRo[0];
}
$pdo = null;
#sleep(60);

?>