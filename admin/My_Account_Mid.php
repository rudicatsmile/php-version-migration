<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<html>
<head>
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php 
if (isset($_REQUEST['fFind'])) {$gFin= $_REQUEST['fFind'];} else {$gFin="";}
if (isset($_REQUEST['IdL']))   {$IdL = $_REQUEST['IdL'];} else {$IdL = "";}

$UPB = $SkP;
if ($IdL!="")
{
	if (isset($_REQUEST['Simpan']))
	{
		if ($_REQUEST['Simpan']=="Delete")
		{
		$gIdT = $_REQUEST['fIdT'];
		$SQ = "DELETE FROM ta_user WHERE IDT='$gIdT'";
		$rs = mysql_query($SQ) or die(mysql_error());
		}
	}
}

if ($gFin!="") {$tFin="AND (User_ID LIKE '%".$gFin."%' OR Full_Name LIKE '%".$gFin."%')";} else {$tFin="";}
?>
<body topmargin="0">
<form name="myfrm" method="POST" action="<?php "My_Account_Mid.php?IdL=".$IdL."&fFind=".$gFin ?>">
	<input type="hidden" name="Simpan">
	<input type="hidden" name="fIdT">
	<!--div class="table"-->
	<table border="0" width="100%" class="table-list" cellspacing="1" align="center" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" id="table1">
	<?php
	$iG=1;
	if ($Lev==0 || $Lev==1) 
		{$nSQ = "SELECT * FROM ta_user WHERE Level >='".$Lev."' ".$tFin." ORDER BY LEFT(Kode,11), Level, User_ID";}
	else if ($Lev==2) 
		{$nSQ = "SELECT * FROM ta_user WHERE Left(Kode,11)='".substr($UPB,0,11)."' AND Level >='".$Lev."' AND Admin <='".$Adm."' ".$tFin." ORDER BY LEFT(Kode,11), Level, Admin DESC, User_ID";}
	else if ($Lev==3) 
		{$nSQ = "SELECT * FROM ta_user WHERE Left(Kode,13)='".substr($UPB,0,13)."' AND Level >='".$Lev."' AND Admin <='".$Adm."' ".$tFin." ORDER BY LEFT(Kode,11), Level, Admin DESC, User_ID";}
	else
		{$nSQ = "SELECT * FROM ta_user WHERE Kode='".$UPB."' and Level >='".$Lev."' AND Admin <='".$Adm."' ".$tFin." ORDER BY LEFT(Kode,11), Level, Admin DESC, User_ID";}
	
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{
			
			$nLen = strlen($mRo['Kode']);
			//echo $nLen."<br>";
			#if ($nLen==11)
			#{
			$NmSkpD =  fGlobal("Nm_Unit","Ref_Unit","Kd_Unit",substr($mRo['Kode'],0,11),"=","","");
			#}
			#else if ($nLen==14)
			#{$NmSkpD =  fGlobal("Nm_Sub","Ref_Sub_Unit","Kd_Sub",$mRo['Kode'],"=","","");}
			#else if ($nLen==18)
			#{$NmSkpD =  fGlobal("Nm_UPB","Ref_UPB","Kd_UPB",$mRo['Kode'],"=","","");}
			
			if ($mRo['Active']=="Y")
			{$Act = "<img src='Images/sudah.gif' width='11' height='11'>";}
			else
			{$Act = "<img src='Images/belum.gif' width='11' height='11'>";}
			
			if ($mRo['Admin']=="1")
			{$fIco ="ico2 admi";}
			else
			{$fIco ="ico2 acct";}
			
			if ($mRo['Level']=="1" || $mRo['Level']=="0")
			{$tAdm=fLevelUser($mRo['Level']);}
			else
			{$tAdm=fLevelAdmin($mRo['Admin'])." ".fLevelUser($mRo['Level']);}
			?>
			<script language="javascript">
				function EditData<?php echo $mRo['IDT']?>(w,h,pos)
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
									$URL_Top = "Reg_User_Top.php?eIdT=".$mRo['IDT']."&IdL=".$IdL;
									$URL_Mid = "Reg_User_Mid.php?eIdT=".$mRo['IDT']."&IdL=".$IdL;
									$URL_Bot = "Reg_User_Bot.php?eIdT=".$mRo['IDT']."&IdL=".$IdL;
								?>       			
							txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormUser_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFormUser_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFormUser_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
							win.focus()
							win.window.document.clear()
							win.window.document.write(txtHTML)
							win.window.document.close() 
							win.setTimeout("self.close()",200000000)
						}
				}
			</script>            
			<tr style="cursor: pointer" <?=fBackCLR($iG)?>>
			  <td width="147" height="5"><a href="#" class="<?php echo $fIco ?>" onClick="EditData<?php echo $mRo['IDT']?>('800','450','center'); return false">&nbsp;&nbsp;<?php echo $mRo['User_ID']?></a></td>
			  <td width="180"><?php echo $mRo['Full_Name']?></td>
			  <td width="161"><?php echo $tAdm?></td>
			  <td width="397"><?php echo $NmSkpD?></td>
			  <td width="35" class="ac"><?php echo $Act?></td>
			  <td width="91" class="ac"><a href="#" class="ico del" onClick="P_Delete('<?php echo $mRo['IDT']?>','<?=$ReO?>')">Delete</a>&nbsp;&nbsp;&nbsp;<a href="#" class="ico edit" onClick="EditData<?php echo $mRo['IDT']?>('800','450','center'); return false">Edit</a></td>
			</tr>
			<?php 
			$iG++;
		}
		while ($mRo = mysql_fetch_assoc($nRs));	
	}
	?>
	<tr>
	  <td height="5">&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	</table>
	<!--/div-->
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Delete(xA,xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		var AN = confirm("Delete user..?!!");
		if (AN)
		{
		objfrm.fIdT.value = xA;
		objfrm.Simpan.value = "Delete";
		objfrm.submit();
		}
	}
</script>

<?php require('Connection_Close.php');?>
