<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style_bot.css" type="text/css" media="all" />
</head>
<?php
require('Connection.php');
$eIdT = $_REQUEST['eIdT'];
$IdL  = $_REQUEST['IdL'];
$ReO  = fFindUID($IdL,"Readonly");
?>
<?php
if (isset($_REQUEST['Simpan']))
{
	if ($_REQUEST['Simpan']=="Delete")
	{
		$SQ = "DELETE FROM ta_user WHERE IDT='$eIdT'";
		$rs = mysql_query($SQ) or die(mysql_error());
		?>
		<script LANGUAGE="JavaScript">            
		this.setTimeout("self.close()",0)
		</script>
		<?php
	}

	if ($_REQUEST['Simpan']=="Close") 
	{
		?>
		<script LANGUAGE="JavaScript">            
		this.setTimeout("self.close()",0)
		</script>
		<?php
	}
} 
?>

<body>
<form name="myfrm" method="post" action="<?php echo "Reg_User_Bot.php?IdL=".$IdL."&eIdT=".$eIdT?>">
  <input type="hidden" name="Simpan">
	<table border="0" width="100%" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse" id="table1">
		<tr>
		  <td width="8">&nbsp;</td>
			<td width="20"><?php if ($IdL!="") {?><img src="Images/e_contents_view.gif" width="16" height="16" /><?php } ?></td>
			<td width="70"><?php if ($IdL!="") {?><a href="<?php echo "Reg_User_Mid.php?IdL=".$IdL."&eIdT=".$eIdT?>" target="WinFormUser_Mid">PREVIEW</a><?php } ?></td>
			<td width="20"><?php if ($IdL!="") {?><img src="Images/edit.png" width="16" height="16" /><?php } ?></td>
			<td width="70"><?php if ($IdL!="") {?><a href="<?php echo "Reg_User_Mid_Add.php?IdL=".$IdL."&eIdT=".$eIdT?>" target="WinFormUser_Mid">EDIT USER</a><?php } ?></td>
			<td width="20"><?php if ($IdL!="") {?><img src="Images/del.gif" width="12" height="12" /><?php } ?></td>
			<td><?php if ($IdL!="") {?><a href="" onclick="P_Delete('<?=$ReO?>')">HAPUS USER</a><?php } ?></td>
			<td width="20"><img src="css/images/account.gif" width="13" height="13" /></td>
			<td width="80"><a href="<?php echo "Reg_User_Mid_Add.php?IdL=".$IdL?>" target="WinFormUser_Mid">TAMBAH USER</a></td>
		  <td width="83" class="ar"><input type="button" name="B39" value="TUTUP" onclick="P_Close()" style="width: 60px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />&nbsp;</td>
		</tr>
	</table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.Simpan.value = "Close";
		objfrm.submit();
	}
	
	function P_Delete(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		var AN = confirm("Delete user..?!!");
		if (AN)
		{
		objfrm.Simpan.value = "Delete";
		objfrm.target = "_top";
		objfrm.submit();
		}
	}
</script>