<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style_top.css" type="text/css" media="all" />
</head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
</head>
<?php
$gUnt  = $_GET['gUnt'];
$gSub  = $_GET['gSub'];
$gUpb  = $_GET['gUpb'];
$CrAcc = $_GET['CrAcc'];
if (isset($_GET['rKib'])) {$rKib  = $_GET['rKib'];}
if (isset($_GET['rIDT'])) {$rIDT  = $_GET['rIDT'];}
?>
<body background="css/images/newheader.gif" topmargin="0" onload="javascript:myfrm.fFind.focus()">
<form name="myfrm" method="post" action="<?php echo "Find_Acc_Mid.php?CrAcc=".$CrAcc."&rKib=".$rKib."&rIDT=".$rIDT."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>" target="WinFindAcc_Mid">
<table border="0" width="599" cellpadding="0" align="center" style="border-collapse: collapse">
  <tr height="7">
	<td></td>
	<td></td>
	<td></td>
	<td></td>
  </tr>
  <tr> 
	<td width="3%">&nbsp; </td>
	<td width="8%" style="color:#fff">CARI</td>
	<td width="43%"> <input class="text" type="text" name="fFind" size="32" value="<?php echo $gFin?>" style="font-family: Calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" /></td>
	<td width="46%"> <input type="button" name="B39" value="GO" onclick="P_Find()" style="width: 50px; height: 21px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
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