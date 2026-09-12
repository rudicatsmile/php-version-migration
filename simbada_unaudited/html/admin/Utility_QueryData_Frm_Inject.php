<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
echo $crt;
$nmF = array();
	if ($crt=="KibB"){
		$tb = "ta_kib_b";
	}

	$iG=0;
	$SQ ="SHOW Fields FROM ".$tb;
	$nR = mysql_query($SQ) or die(mysql_error());
	while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
	{
		$iG++;
		$nmF[$iG] = $mR['Field'];
		echo $nmF[$iG]."<br>";
	}
	//$JmF = $iG;
	
?>

