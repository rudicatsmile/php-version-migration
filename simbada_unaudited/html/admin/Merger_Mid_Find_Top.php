<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_top.css" type="text/css" media="all" />
</head>
<?
if (isset($_GET['rIDT'])) {$rIDT = $_GET['rIDT'];}
if (isset($_GET['CrT'])) {$CrT = $_GET['CrT'];}
//echo $CrT;
?>
<body background="css/images/newheader.gif" topmargin="0" onload="javascript:myfrm.fFind.focus()">
<form name="myfrm" method="post" action="<?php echo "Merger_Mid_Find_Mid.php?rIDT=".$_GET['rIDT']."&CrT=".$_GET['CrT']."&IdL=".$_GET['IdL'] ?>" target="WinFindAcc_Mid">
  <table border="0" width="100%" cellpadding="0" style="border-collapse: collapse; color:#FFFFFF; font-family:Calibri; font-size:9pt">
	  <tr> 
		<td width="16">&nbsp; </td>
		<td width="52">CARI</td>
		<td width="266"> <input class="text" type="text" name="fFind" size="32" value="<? echo $gFin?>" style="font-family: Calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" /></td>
		<td width="993"> <input type="button" name="B39" value="GO" onclick="P_Find()" style="width: 50px; height: 21px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
	  </tr>
	</table>
  <table border="0" width="100%" cellpadding="0" style="border-collapse: collapse; color:#000; background-color:#999999; font-family:Calibri; font-weight:bold; font-size:9pt">
	  <tr height="18"> 
		<td width="132">KODE</td>
		<td width="248">NAMA ASET</td>
		<td width="293">DESKRIPSI</td>
		<td width="100" align="right">NILAI AWAL</td>
		<td width="98" align="right">NILAI AKHIR</td>
		<td>&nbsp; </td>
	  </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Find()
	{
		objfrm.submit();
	}
</script>