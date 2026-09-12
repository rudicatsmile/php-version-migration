<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<html>
<head>
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?
$rIDT = $_REQUEST['rIDT'];
$IdL  = $_REQUEST['IdL'];
$gUid = fGlobal("User_ID","Ta_User_Log","IDT",$IdL,"=","","");

$gTmp="";
if ($rIDT!="")
{
	$nSQL= "SELECT * FROM ta_informasi WHERE IDT = '".$rIDT."'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	{
		$gJdl  = $mRo['Header'];
		$gInf  = $mRo['Informasi'];
		$gUid  = $mRo['Pencatat'];
		$gTmp  = $mRo['Tampil'];
		
		if ($gTmp=="Y") {$gTmp="checked";} else {$gTmp="";}
	}
}
?>
<body>
<form name="myfrm" method="POST" action="<? echo "Form_Info_Mid_.php?rIDT=".$rIDT."&IdL=".$_REQUEST['IdL'] ?>" enctype="multipart/form-data">
<input type="hidden" name="fSimpan">
<table border="0" width="561" cellspacing="1" align="center" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" id="table1">
	<tr>
	  <td height="5" colspan="3">&nbsp;</td>
	</tr>
	<tr>
	  <td height="5">JUDUL</td>
	  <td height="5">&nbsp;</td>
	  <td height="5"><input name="fJdl" type="text" value="<? echo $gJdl?>" style="border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; width:300px"/></td>
    </tr>
	<tr>
	  <td height="5">FOTO</td>
	  <td height="5">&nbsp;</td>
	  <td height="5"><input type="file" name="fT2" style="text-align:left; width:300px" /></td>
	</tr>
	<tr>
	  <td height="5" colspan="3">&nbsp;</td>
	  </tr>
	<tr>
		<td height="5" colspan="3">INFORMASI / BERITA </td>
	</tr>
	<tr>
	  <td height="5" colspan="3">
	  <textarea name="S1" cols="65" rows="8" style="border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; width:600px;"><? echo $gInf?></textarea>	  </td>
	</tr>
	
	<tr>
	  <td height="5" colspan="3">&nbsp;</td>
	  </tr>
	<tr>
	  <td height="5">PENCATAT</td>
	  <td>&nbsp;</td>
	  <td valign="middle"><input readonly name="fPcc" type="text" value="<? echo $gUid?>" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; width:200px" maxlength="100" /></td>
    </tr>
	<tr>
	  <td height="5">STATUS</td>
	  <td>&nbsp;</td>
	  <td valign="middle"><label><input type="checkbox" name="fTmpl" value="ON" <? echo $gTmp?>> TAMPILKAN</label></td>
    </tr>
	<tr>
	  <td width="58" height="5">&nbsp;</td>
	  <td width="12"><label></label></td>
	  <td width="481" valign="middle">&nbsp;</td>
	</tr>
	<tr>
	  <td height="5" colspan="3" style="color:#FF0000"><? echo $MsG?>&nbsp;</td>
	</tr>
	<tr>
	  <td height="5" colspan="3"><input type="button" name="B39" value="SIMPAN" onClick="P_Save()" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
	  <input type="button" name="B392" value="RESET" onClick="P_Reset()" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> <input type="button" name="B3922" value="TUTUP" onClick="P_Close()" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
	</tr>
	<tr>
	  <td height="5" colspan="3">&nbsp;</td>
	</tr>
</table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Save()
	{
		if (objfrm.fJdl.value=="")
			{window.alert("Silahkan masukan judul Informasi..!!");}
		else if (objfrm.S1.value=="")
			{window.alert("Tidak ada infotmasi yang tertulis..!!");}
		else
		{
			var AN = confirm("Simpan data..?!!");
			if (AN)
				{
				objfrm.fSimpan.value = "Save";
				objfrm.submit();
				}
		}
	}
	
	function P_Reset()
	{
		objfrm.fSimpan.value = "Reset";
		objfrm.submit();
	}
	
	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.fSimpan.value = "Close";
		objfrm.submit();
	}
</script>

<?php require('Connection_Close.php');?>
