<?php
require "Connection.php";
extract($_GET);
if ($CrT=='Img'){$TbL="tb_lembar_kerja_foto_denah";}
else {$TbL="tb_lembar_kerja_dokumen";}

$query = "SELECT file_content, file_type, file_name, file_size FROM ".$TbL." where IDT='".$rIdT."'";
$data = mysql_query($query);
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
	echo "<img src='Images/FileLogin_70' height='20' width='20'>";
}
?>
