<?php
require "Connection.php";
require "FileFunction.php";

$Ref = $_GET['ref'];
$upb = $_GET['upb'];

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
<?php
#for ($iG=2013; $iG<=($tY-1); $iG++)
for ($iG=2013; $iG<=$tY; $iG++)
{
$rTH = $iG;
?>
<tr height="20">
  <!--td align="center"><a href="<?php echo "Tabel_Masa_Manfaat_Tahunan.php?rTH=".$rTH."&ref=".$Ref."&upb=".$upb."&IdL=".$_GET['IdL']?>" class="ico prev">&nbsp;&nbsp;SAMPAI DENGAN TAHUN <?=$iG?></a></td-->
  <td align="center"><a href="<?php echo "Tabel_Masa_Manfaat_Bulanan.php?rTH=".$rTH."&ref=".$Ref."&upb=".$upb."&IdL=".$_GET['IdL']?>" class="ico prev">&nbsp;&nbsp;SAMPAI DENGAN TAHUN <?=$iG?></a></td>
</tr>
<?php
}
?>
<tr>
  <td>&nbsp;</td>
</tr>
</table>
</body>
</html>
