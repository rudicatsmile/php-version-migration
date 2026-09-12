<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<html>
<head>
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<?php
$dir = "D:\Backup_Data_Simbada";
$dh  = opendir($dir);
?>
<form name="myfrm" method="post" action="<?php echo "Backup_Dump_Mid_.php?IdL=".$_GET['IdL'] ?>">
<table width="300px" border="0" cellspacing="0" cellpadding="0" style="font-size:9pt">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="submit" name="submit" value="Backup Data REFERENSI">
      <input type="submit" name="submit" value="Backup Data TRANSAKSI"></td>
    </tr>
  <tr>
    <td width="20">&nbsp;</td>
    <td width="240">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php
	while (false !== ($filename = readdir($dh)))
	{
		if ($filename!="." && $filename!="..")
		{$Fld=$filename;
		  ?>
		  <tr>
			<td>&nbsp;</td>
			<td height="21"><?=$Fld?></td>
			<td><a href="<?="Backup_Dump_Download.php?DownL=YA&NmFL=".$Fld."&IdL=".$_GET['IdL'] ?>" class="ico down">&nbsp;&nbsp;Download</a></td>
		  </tr>
		  <?php
		  }
	}
	?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>