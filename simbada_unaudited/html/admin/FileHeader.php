<?php require "CheckSession.php"?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/header.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?
if (isset($_GET['IdL'])) {$IdL = $_GET['IdL'];} else {$IdL = "";}
if ($IdL!="")
{
	require('Connection.php');
	require('FileFunction.php');
	
	$Uid = fGlobal("User_ID","Ta_User_Log","IDT",$IdL,"=","","");
	$Lev = fGlobal("Level","Ta_User","User_ID",$Uid,"=","","");
	$Adm = fGlobal("Admin","Ta_User","User_ID",$Uid,"=","","");
	$SEN = fFindData("User_Sekolah",$Uid,"");
	if ($Lev=="0" || $Lev=="1")	{$Uid = strtoupper($Uid);}
	else {$Uid = strtoupper($Uid);}
	if (isset($_GET['Logout']))
	{
		if ($_GET['Logout']=="Ya")
		{
			$_SESSION['UserSB'] = "";
			if (!isset($_SESSION)) {session_destroy();}

			$SQL = "UPDATE ta_user_log SET 
			Logout_Time=now(), Online='N' where IDT='".$IdL."'";
			$rst = mysql_query($SQL) or die(mysql_error());
			$URL="../index.php";
			?>
			<script language="JavaScript">	
			window.open("<? echo $URL ?>","_main");
			</script>
			<?
		}
	}
}
?>
<body topmargin="0">
<div id="header">
	<table border="0" align="center" width="100%" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" height="100%">
		<tr>
		  <td valign="top"><img src="Images/LogoGBNew.gif" height="50"></td>
		  <td valign="top" width="320">
			<? if ($IdL!="") {?>
			<table border="0" width="320" cellspacing="1" style="font-family: calibri; font-size: 10pt; border-collapse: collapse" height="26">
				
				<tr>
				  <td height="20">&nbsp;</td>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
				  <td>&nbsp;</td>
				  <td width="0">&nbsp;</td>
			  </tr>
				<tr>
				  <td width="84" class="ac">&nbsp;</td>
				  <td width="71" class="ac">&nbsp;</td>
				  <!--td width="85" class="ac"><? if ($SEN!='Y') {?><a href="#" class="ico user" onClick="ManageAccount('900','500','center'); return false">&nbsp;<? echo $Uid ?></a><? } ?></td-->
				  <td width="85" class="ac"><a href="#" class="ico user" onClick="ManageAccount('900','500','center'); return false">&nbsp;<? echo $Uid ?></a></td>
				  <td width="64" class="ac"><a href="<? echo "FileHeader.php?Logout=Ya&IdL=".$IdL ?>" class="ico lout" onClick="MyAccount('600','500','center'); return false"> LOGOUT</a></td>
				  <td>&nbsp;</td>
				</tr>
			</table>
			<? } ?>
		  </td>
		</tr>
	</table>
  </div>
</body>
<? if ($IdL!="") {$URL="Home.php?IdL=".$IdL;?>
	<script language="JavaScript">	
	window.open("<? echo $URL ?>","MidFrame");
	</script>
<? } else {$URL="index.php";?>
	<script language="JavaScript">	
	window.open("<? echo $URL ?>","_main");
	</script>
<? } ?>

<script language="JavaScript">	
	function ManageAccount(w,h,pos)
	{	var win=null;
		var txtHTML = "";
  		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
			win=window.open('','',settings);
			if (win!=null)
    			{
      				win.window.document.open()       			
					<?
						$URL_Top = "My_Account_Top.php?IdL=".$IdL;
						$URL_Mid = "My_Account_Mid.php?IdL=".$IdL;
						$URL_Bot = "My_Account_Bot.php?IdL=".$IdL;
					?>       			
       			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='59,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<? echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<? echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<? echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}
	function ManageInfo(w,h,pos)
	{	var win=null;
		var txtHTML = "";
  		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
			win=window.open('','',settings);
			if (win!=null)
    			{
      				win.window.document.open()       			
					<?
						$URL_Top = "Information_Top.php?IdL=".$IdL;
						$URL_Mid = "Information_Mid.php?IdL=".$IdL;
						$URL_Bot = "Information_Bot.php?IdL=".$IdL;
					?>       			
       			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='59,*,30' frameborder='0'><frame name='WinInfo_Top' noresize src='<? echo $URL_Top?>' scrolling='no'><frame name='WinInfo_Mid' src='<? echo $URL_Mid?>' scrolling='auto'><frame name='WinInfo_Bot' src= '<? echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}
</script>

<? require('Connection_Close.php');?>