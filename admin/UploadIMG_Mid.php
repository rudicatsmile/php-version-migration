<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
</head>
<?php
$rIDT = $_GET['rIDT'];
$rCRT = $_GET['rCRT'];
echo "<br>";
?>
<body>
<table align="center" style="width:400px">
<tr>
  <td width="65" align="center">&nbsp;</td>
  <td width="473" align="center">&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>Pilih File (Max 1 MB):</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
<td>
<form method="post" name="myfrm" action="<?="UploadIMG_Mid_.php?rIDT=".$rIDT."&rCRT=".$rCRT."&IdL=".$_GET['IdL'] ?>" enctype="multipart/form-data">
<input name="file" type="file">
<input type="hidden" name="Simpan">
<input type="button" value="Upload" onclick="P_Save()">
<input type="button" value="Delete" onclick="P_Dele()">
</form>
</tr>
</table>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Save()
	{
		if (objfrm.file.value=="")
		{
			window.alert('Silahkan pilih file gambar terlebih dahulu..!!');
		}
		else
		{
			objfrm.Simpan.value = "Upload";
			objfrm.target = "_top";
			objfrm.submit();
		}
	}
	
	function P_Dele()
	{
		var AN = confirm("Hapus foto objek aset..?!!");
		if (AN)
		{
			objfrm.Simpan.value = "Delete";
			objfrm.target = "_top";
			objfrm.submit();
		}
	}
</script>
