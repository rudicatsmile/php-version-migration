<?php
require "Connection.php";
require('FileFunction.php');
extract($_GET);
if ($CrT=='Img')
{
	$query = "SELECT file_content, file_type, file_name, file_size FROM tb_lembar_kerja_foto_denah where IDT='".$rIdT."'";
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
}
else if ($CrT=='Pdf')
{
	$query = "SELECT file_content, file_type, file_name, file_size FROM tb_lembar_kerja_dokumen where IDT='".$rIdT."'";
	$data = mysql_query($query);
	$data = mysql_fetch_array($data);
	$gCont = $data[0];
	$gType = $data[1];
	$nName = $data[2];
	$nSize = $data[3];
	if ($nName!="")
	{
		header("Content-type: $gType");   // parsing ke mime tipe
		header('Content-disposition: inline; filename="'.$nName.'"');
		header('content-Transfer-Encoding:binary');
		header('Accept-Ranges:bytes');
		echo $gCont; 
	}
}
else if ($CrT=='Smd')
{
	?>
	<style>
	body {
	text-align:center;
	vertical-align:middle;
	margin-top:20pt;
	
	}
	</style>
	<?php
	$nName = fGlobal("file_name","ta_kib_108","IDT",$rIdT,"=","","");
	echo "<img src='simandor/images/".$rIdT."xyz".$nName."' style='width:600px' />";
}
else
{
	echo "<img src='Images/FileLogin_70' height='20' width='20'>";
}
?>
