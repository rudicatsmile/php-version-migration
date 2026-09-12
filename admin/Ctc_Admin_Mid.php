<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<html>
<head>
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
if ($_REQUEST['fSimpan']=="Send")
{
	$Hea = $_REQUEST['fJdl'];
	$Psn = $_REQUEST['S1'];
	$Pgr = $_REQUEST['fPrm'];
	$SQL = "INSERT INTO ta_contact_Adm set Header='$Hea', Pesan='$Psn', Sender='$Pgr'";
	$rst = mysql_query($SQL) or die(mysql_error());
	$MsG = "Pesan anda sudah terkirim...!!";

}
?>
<body>
<form name="myfrm" method="POST" action="Ctc_Admin_Mid.php">
<input type="hidden" name="fSimpan">
<table border="0" width="561" cellspacing="1" align="center" style="font-family: Calibri; font-size: 9pt; border-collapse: collapse" id="table1">
	<tr>
	  <td height="5">JUDUL PESAN </td>
	</tr>
	<tr>
	  <td height="5"><input name="fJdl" type="text" style="border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" size="67" /></td>
	</tr>
	<tr>
	  <td height="5">&nbsp;</td>
	  </tr>
	<tr>
		<td width="557" height="5">PESAN</td>
	</tr>
	<tr>
	  <td height="5">
	  <textarea name="S1" cols="65" rows="8" style="border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"></textarea>	  </td>
	</tr>
	<tr>
	  <td height="5">&nbsp;</td>
	  </tr>
	<tr>
	  <td height="5">PENGIRIM</td>
	  </tr>
	<tr>
	  <td height="5"><input name="fPrm" type="text" value="<?php echo $fNma?>" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" size="50" maxlength="100" /></td>
	</tr>
	<tr>
	  <td height="5" style="color:#FF0000"><?php echo $MsG?>&nbsp;</td>
	</tr>
	<tr>
	  <td height="5"><input type="button" name="B39" value="KIRIM" onClick="P_Send()" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> <input type="button" name="B392" value="CLOSE" onClick="P_Close()" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
	</tr>
	<tr>
	  <td height="5">&nbsp;</td>
	</tr>
</table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Send()
	{
		if (objfrm.fJdl.value=="")
			{window.alert("Silahkan masukan judul pesan..!!");}
		else if (objfrm.S1.value=="")
			{window.alert("Tidak ada pesan yang tertulis, silahkan tuliskan pesan anda..!");}
		else if (objfrm.fPrm.value=="")
			{window.alert("Silahkan masukan identitas pengirim..!!");}
		else
		{
			var AN = confirm("Kirim pesan..?!!");
			if (AN)
				{
				objfrm.fSimpan.value = "Send";
				objfrm.submit();
				}
		}
	}
</script>
<?php require('Connection_Close.php');?>
