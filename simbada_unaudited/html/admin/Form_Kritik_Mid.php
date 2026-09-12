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
$rIDT = $_GET['rIDT'];
$IdL  = $_GET['IdL'];

$gTmp="";
if ($rIDT!="")
{
	$nSQL= "SELECT * FROM ta_kritik_saran WHERE IDT = '".$rIDT."'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	{
		$gIdt  = $mRo['IDT'];
		$gJdl  = $mRo['Sumber'];
		$gAlm  = $mRo['Alamat'];
		$gInf  = $mRo['Deskripsi'];
		$gTmp  = $mRo['Tampil'];
		
		if ($gTmp=="Y") {$gTmp="checked";} else {$gTmp="";}
	}
}
?>
<body>
<form name="myfrm" method="POST" action="<? echo "Form_Kritik_Mid_.php?rIDT=".$rIDT."&IdL=".$_GET['IdL'] ?>">
<input type="hidden" name="fSimpan">
<table border="0" width="561" cellspacing="1" align="center" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" id="table1">
	<tr>
	  <td width="89" height="5">PENGIRIM </td>
	  <td width="13" height="5">&nbsp;</td>
	  <td width="449" height="5"><input name="fJdl" type="text" readonly value="<? echo $gJdl?>" style="border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; width:200px" /></td>
	</tr>
	
	
	<tr>
	  <td height="5">ALAMAT</td>
      <td height="5">&nbsp;</td>
      <td height="5"><input name="fAlm" type="text" readonly value="<? echo $gAlm?>" style="border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; width:200px" /></td>
	</tr>
	
	<tr>
		<td height="5" colspan="3">KRITIK &amp; SARAN </td>
	</tr>
	<tr>
	  <td height="5" colspan="3">
	  <textarea name="S1" readonly style="border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; width: 600px; height:130px"><? echo $gInf?></textarea></td>
	</tr>
	<tr>
	  <td height="5" colspan="3">&nbsp;</td>
	  </tr>
	<tr>
	  <td height="5" colspan="3"><label><input type="checkbox" name="fTmpl" value="ON" <? echo $gTmp?>> TAMPILKAN </label></td>
    </tr>
	
	<tr>
	  <td height="5" colspan="3" style="color:#FF0000"><? echo $MsG?>&nbsp;</td>
	</tr>
	<tr>
	  <td height="5" colspan="3"><input type="button" name="B39" value="SIMPAN" onClick="P_Save()" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	    <input type="button" name="B3922" value="TUTUP" onClick="P_Close()" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
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
	
	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.fSimpan.value = "Close";
		objfrm.submit();
	}
</script>

<?php require('Connection_Close.php');?>
