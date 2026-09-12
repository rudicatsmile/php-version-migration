<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<?php require "Import_KIB_Reader.php"?>
<html>
<head>
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
$gUnt= $_GET['gUnt'];
$gSub= $_GET['gSub'];
$gUpb= $_GET['gUpb'];
$gThn= $_GET['gThn'];
$gKib= $_GET['gKib'];
$gIDT= $_GET['gIDT'];

$gNmF= fGlobal("Nm_File","ta_upload_excel","IDT",$gIDT,"=","","");
$gST = fGlobal("Imported","ta_upload_excel","IDT",$gIDT,"=","","");
$data = new Spreadsheet_Excel_Reader();		// ExcelFile($filename, $encoding);
$data->setOutputEncoding('CP1251');			// Set output Encoding.
$data->read('xls_file/kib_'.strtolower($gKib).'_xls_file/'.$gNmF);
?>
<body>
<?php
error_reporting(E_ALL ^ E_NOTICE);
require "Import_KIB_Display_".strtoupper($gKib).".php";
?>
<table border="0" width="600" cellpadding="0" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse">
  <tr> 
    <td width="85">&nbsp;</td>
    <td width="109">&nbsp;</td>
    <td width="84">&nbsp;</td>
    <td width="312">&nbsp;</td>
  </tr>
  <tr bgcolor="#FFFFFF"> 
    <td height="23" style="border-top: 2px solid #808000; border-bottom: 1px solid #808000; border-left: 2px solid #808000"><a href="#" class="ico reff" onClick="P_Refresh()">&nbsp;&nbsp;REFRESH</a></td>
    <td height="23" style="border-top: 2px solid #808000; border-bottom: 1px solid #808000"><a href="#" class="ico upl" onClick="P_Import('_import_test','<?=$gST?>')">&nbsp;&nbsp;TEST IMPORT</a></td>
    <td height="23" style="border-top: 2px solid #808000; border-bottom: 1px solid #808000"><a href="#" class="ico upl" onClick="P_Import('','<?=$gST?>')">&nbsp;&nbsp;IMPORT</a></td>
    <td height="23" style="border-top: 2px solid #808000; border-bottom: 1px solid #808000; border-right: 2px solid #808000; color: #FF9933">
      <?php if (isset($_GET['MSG'])) {echo $_GET['MSG'];} ?>    </td>
  </tr>
</table>
</body>
</html>
<script language="javascript">
function P_Refresh()
{
	window.open("Import_KIB_Source.php?"+"<?="gIDT=".$gIDT."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gKib=".$gKib."&IdL=".$_GET['IdL']?>","_self");
}

function P_Import(fL,xD)
{
	if (xD=="Y") {
		var AN = confirm("FILE ini sudah pernah diimport, APAKAH AKAH DIIMPORT ULANG..?!!");
		if (AN) {P_Proses(fL);}
	}
	else {
		var AN = confirm("Proses import data..?!!");
		if (AN) {P_Proses(fL);}
	}
}
function P_Proses(fL)
{
	window.open("Import_KIB_Source_.php?fL="+fL+"<?="&gIDT=".$gIDT."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gKib=".$gKib."&IdL=".$_GET['IdL']?>","_self");
}
</script>