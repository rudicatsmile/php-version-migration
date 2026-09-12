<?
require "Connection.php";
extract($_GET);
$SQL = "SELECT file_content, file_type, file_name, file_size FROM ta_usulan_rinci_file_108 where IDT='".$rIdT."'";
$data = mysql_query($SQL);
$data = mysql_fetch_array($data);
$gCont = $data[0];
$gType = $data[1];
$nName = $data[2];
$nSize = $data[3];
if ($nName!="")
{
	header("Content-length: $nSize");
	header("Content-type: $gType");   // parsing ke mime tipe
	echo $gCont; 
}
else
{
	header("Content-type: image/gif");   // parsing ke mime tipe
	echo "Images/FileLogin_14.gif";
}
?>