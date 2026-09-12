<?
require "Connection.php";
require "FileFunction.php";
$tY = date('Y');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<body>
<br>
<br>
<br>
<table border="0" align="center" width="800" cellspacing="1" style="font-size: 12pt; font-family: Calibri; border-collapse: collapse">
<?
for ($iG=2013; $iG<=($tY-1); $iG++)
{
$rTH = $iG;
?>
<tr height="20">
  <td align="center"><a href="<?php echo "Tabulasi_Data_Main.php?rTH=".$rTH."&CriT=".$_GET['CriT']."&gUnt=".$_GET['gUnt']."&gSub=".$_GET['gSub']."&gUpb=".$_GET['gUpb']."&gBid=".$_GET['gBid']."&gKel=".$_GET['gKel']."&gOBJ=".$_GET['gOBJ']."&gRin=".$_GET['gRin']."&gExt=".$_GET['gExt']."&gFin=".$_GET['gFin']."&gThn=".$_GET['gThn']."&gThnA=".$_GET['gThnA']."&IdL=".$_GET['IdL']?>" class="ico prev">&nbsp;&nbsp;SAMPAI DENGAN TAHUN <?=$iG?></a></td>
</tr>
<?
}
?>
<tr>
  <td>&nbsp;</td>
</tr>
</table>
</body>
</html>
