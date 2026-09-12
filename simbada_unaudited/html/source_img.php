<?php require "connfile.php";?>
<?
if (isset($_GET['rIDT'])) {$rIDT = $_GET['rIDT'];}
if (isset($_GET['rTBL'])) {$rTBL = $_GET['rTBL'];}
if (isset($_GET['rFdR'])) {$rFdR = $_GET['rFdR'];}
if ($rTBL)
{
	$query = "SELECT photo, file_type, file_size FROM ".$rTBL." WHERE IDT='".$rIDT."'";
	$data = mysql_query($query);
	$data = mysql_fetch_array($data);
	$gCont = $data[0];
	$gType = $data[1];
	$nSize = $data[2];
	if ($nSize > 0)
	{
		header("Content-type: $gType");   // parsing ke mime tipe
		echo $gCont; 
	}
	else
	{
		header("Content-type: image/gif");   // parsing ke mime tipe
		echo "images/".$rFdR."/blank.gif";
	}
}
else
{
	header("Content-type: image/gif");   // parsing ke mime tipe
	echo "images/".$rFdR."/blank.gif";
}
?>

