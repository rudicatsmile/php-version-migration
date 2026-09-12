<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
</head>
<?
extract($_GET);
?>
<body>
<table align="center" style="width:400px">
<tr>
  <td width="65" align="center">&nbsp;</td>
  <td width="473" align="center">&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>Pilih File <? if ($CrT=='Pdf') {echo "*.pdf";} else {echo "*.jpg, *jpeg, *.png, *.bmp, *.gif";}?> (Maximal 1 MB):</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
<td>
<input id="imgfile" name="imgfile" type="file">
<input type="button" value="Upload" onclick="P_Upload('<?=$CrT?>','<?=$gIdT?>')">
</tr>
</table>
</body>
</html>