<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
</head>
<?php
extract($_GET);
?>
<body>
<table align="center" style="width:550px">
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
<?php
if ($gIdT) {$BtN="Update";} else {$BtN="Upload";}
?>
<form method="post" name="myfrm" action="<?="UploadPDF_Mid_.php?crt=".$crt."&rIdT=".$rIdT."&gIdT=".$gIdT."&IdL=".$_GET['IdL'] ?>" style="font-family:calibri; font-size:10pt" enctype="multipart/form-data">
<input name="file" type="file">
<input type="hidden" name="Simpan">&nbsp;&nbsp;
<input type="button" value="<?=$BtN?>" onclick="P_Save()">&nbsp;&nbsp;
<input type="button" value="Remove" onclick="P_Dele()">
</form></td>
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
			window.alert('Silahkan pilih file terlebih dahulu..!!');
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
		var AN = confirm("Remove file hasil upload..?!!");
		if (AN)
		{
			objfrm.Simpan.value = "Delete";
			objfrm.target = "_top";
			objfrm.submit();
		}
	}
</script>
