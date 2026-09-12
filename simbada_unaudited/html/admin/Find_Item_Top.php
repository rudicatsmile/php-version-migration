<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_top.css" type="text/css" media="all" />
</head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
</head>
<?
$gUnt  = $_REQUEST['gUnt'];
$gSub  = $_REQUEST['gSub'];
$gUpb  = $_REQUEST['gUpb'];
?>
<body background="css/images/newheader.gif" topmargin="0" onload="javascript:myfrm.fFind.focus()">
<form name="myfrm" method="post" action="<?php echo "Find_Item_Mid.php?rIDT=".$_REQUEST['rIDT']."&FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL']."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb ?>" target="WinFindItem_Mid">
<table border="0" width="100%" cellpadding="0" style="font-size:10pt; color:#FFFFFF; border-collapse: collapse">
  <tr>
    <td>&nbsp;</td> 
	<td width="70">ASET </td>
	<td width="300">
	<select name="fAst" style="width: 200pt; font-family: Calibri; font-size: 9pt; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" onchange="P_GO()">
	<option value="1">KIB-A (Tanah)</option>
	<option value="2">KIB-B (Peralatan & Mesin)</option>
	<option value="3">KIB-C (Gedung & Bangunan)</option>
	<option value="4">KIB-D (Jalan, Irigasi & Jaringan)</option>
	<option value="5">KIB-E (Aset Tetap Lainnya)</option>
	</select>
	</td>
	<td width="40">&nbsp;</td>
	<td width="80">CARI</td>
	<td width="180"> <input class="text" type="text" name="fFind" size="32" style="font-family: Calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" /></td>
	<td width="20">&nbsp;</td>
	<td width="70"> <input type="button" name="B39" value="GO" onclick="P_GO()" style="width: 50px; height: 21px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
  </tr>
</table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_GO()
	{
		objfrm.submit();
	}
</script>