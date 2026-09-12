<html>
<head>
<title>SIMKAD@</title>
<link rel="stylesheet" href="css/main.css" type="text/css" media="all" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?
if (isset($_GET['IdL'])) {$IdL = $_GET['IdL'];} else {$IdL = "";}
if ($IdL!="")
{
	if (isset($_SESSION)) {session_destroy();}
	require('Connection.php');
	require('FileFunction.php');
	
	$Uid=fGlobal("User_ID","Ta_User_Log","IDT",$IdL,"=","","");
	
	$Lev=fGlobal("Level","Ta_User","User_ID",$Uid,"=","","");
	$Adm=fGlobal("Admin","Ta_User","User_ID",$Uid,"=","","");
	if ($Lev=="0" || $Lev=="1")	{$Uid = strtoupper($Uid)." (".fLevelUser($Lev).")";}
	else {$Uid = strtoupper($Uid)." (".fLevelAdmin($Adm)." ".fLevelUser($Lev).")";}
	if (isset($_GET['Logout']))
	{
		if ($_GET['Logout']=="Ya")
		{
			$SQL = "UPDATE ta_user_log SET 
			Logout_Time=now(), Online='N' where IDT='".$IdL."'";
			$rst = mysql_query($SQL) or die(mysql_error());
		}
	}
}
?>
<body>
<form name="myfrm" method="post" action="<?php echo "ErrorPage_.php?IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="fWinNm">
	<table border="0" width="100%" cellspacing="1" cellpadding="0" style=" font-family:calibri; font-size:9pt; border-collapse: collapse">
		<tr>
		  <td>&nbsp;</td>
		  <td colspan="3" align="center">&nbsp;</td>
		  <td>&nbsp;</td>
	  </tr>
		<tr>
		  <td>&nbsp;</td>
		  <td colspan="3" align="center">&nbsp;</td>
		  <td>&nbsp;</td>
	  </tr>
		<tr>
		  <td>&nbsp;</td>
		  <td colspan="3" align="center">&nbsp;</td>
		  <td>&nbsp;</td>
	  </tr>
		<tr>
		  <td>&nbsp;</td>
		  <td colspan="3" align="center">&nbsp;</td>
		  <td>&nbsp;</td>
	  </tr>
		<tr>
		  <td>&nbsp;</td>
		  <td colspan="3" align="center"><? echo $_REQUEST['MesG']?></td>
		  <td width="362">&nbsp;</td>
	  </tr>
		<tr>
		  <td>&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td align="center">&nbsp;</td>
		  <td>&nbsp;</td>
	  </tr>
		<tr>
		  <td width="376">&nbsp;</td>
			<td width="244" align="center">&nbsp;</td>
			<td width="80" align="center"><a href="#" class="ico lout" onClick="P_Link()">&nbsp;LOGIN</a></td>
			<td width="232" align="center">&nbsp;</td>
			<td width="362">&nbsp;</td>
		</tr>
	</table>		
</form>
</body>
</html>
<script language="JavaScript">	
	var objfrm=document.myfrm;
	var WinNm = window.name;
	objfrm.fWinNm.value=WinNm;
	function P_Link()
	{
		objfrm.target = "_top";
		//objfrm.Simpan.value = "Close";
		objfrm.submit();
	}
</script>
