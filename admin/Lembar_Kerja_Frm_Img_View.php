<?php
require "Connection.php";
require('FileFunction.php');
extract($_GET);
if ($CrT=='Img')
{
	$query = "SELECT filename FROM tb_lembar_kerja_upload_img where IDT='".$rIdT."'";
	$data = mysql_query($query);
	$data = mysql_fetch_array($data);
	$nName = $data[0];
	if ($nName!="")
	{
		echo "<img src='upload_img/".$nName."' style='width:600px' />";
	}
}
else if ($CrT=='Pdf')
{
	$query = "SELECT filename FROM tb_lembar_kerja_upload_pdf where IDT='".$rIdT."'";
	$data = mysql_query($query);
	$data = mysql_fetch_array($data);
	$nName = $data[0];
	if ($nName!="")
	{
		echo "<iframe src='upload_pdf/".$nName."' style='width:100%; height:100%' /></iframe>";
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
