<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_bot.css" type="text/css" media="all" />
</head>
<?php require('Connection.php'); ?>
<?php require('CheckLogin.php'); ?>
<?php
if (isset($_REQUEST['Simpan']))
{
	if ($_REQUEST['Simpan']=="Close")
	{
		?>
		<script LANGUAGE="JavaScript">            
		this.setTimeout("self.close()",0)
		</script>
		<?php
	}
} ?>
<?php
$IdL = $_REQUEST['IdL'];
//$Lev = fFindUID($IdL,"Level");
//$Adm = fFindUID($IdL,"Admin");
?>
<body background="css/images/newheader.gif">
<form name="myfrm" method="post" action="<?php echo "My_Account_Bot.php?IdL=".$IdL?>">
<input type="hidden" name="Simpan">
	<table border="0" width="100%" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse" id="table1">
		<tr>
		  <td width="6%">&nbsp;</td>
		  <td width="6%">&nbsp;</td>
		  <td width="6%">&nbsp;</td>
		  <td width="6%">&nbsp;</td>
		  <td width="6%">&nbsp;</td>
		  <td>&nbsp;</td>
		  <td width="30"><img src="css/images/account.gif" width="13" height="13" /></td>
		  <td width="130"><a href="#" onClick="AddUser('800','450','center'); return false">REGISTER USER BARU </a></td>
		  <td width="20">&nbsp;</td>
		  <td width="70" class="ar"><input type="button" name="B39" value="TUTUP" onclick="P_Close()" style="width: 60px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />&nbsp;</td>
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
	
	function AddUser(w,h,pos)
	{	var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
			win=window.open('','',settings);
			if (win!=null)
				{
					win.window.document.open()       			
					<?php
						$URL_Top = "Reg_User_Top.php?IdL=".$IdL;
						$URL_Mid = "Reg_User_Mid_Add.php?IdL=".$IdL;
						$URL_Bot = "Reg_User_Bot.php?IdL=".$IdL;
					?>       			
				txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormUser_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFormUser_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFormUser_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
				win.focus()
				win.window.document.clear()
				win.window.document.write(txtHTML)
				win.window.document.close() 
				win.setTimeout("self.close()",200000000)
			}
	}
</script>            

<?php
//**Tutup otomatis jika level / jenis admin user aktif tidak ditemukan**//
?>
<?php if ($Lev=="" || $Adm=="") {?>
	<script LANGUAGE="JavaScript">            
	objfrm.target = "_top";
	objfrm.Simpan.value = "Close";
	objfrm.submit();
	</script>
<?php } ?>


<?php require('Connection_Close.php');?>
