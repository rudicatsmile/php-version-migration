<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_header_top.css" type="text/css" media="all" />
</head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
</head>
<?php
$IDO  = $_REQUEST['IDO'];
$zUpb = $_REQUEST['zUpb'];
$zKeg = $_REQUEST['zKeg'];
$zThn = $_REQUEST['zThn'];
?>
<body background="css/images/newheader.gif" topmargin="0" onload="javascript:myfrm.fFind.focus()">
<form name="myfrm" method="post" action="<?php echo "Find_AssRKPB_Mid.php?IDO=".$IDO."&JusV=".$JusV."&zUpb=".$zUpb."&zKeg=".$zKeg."&zThn=".$zThn."&IdL=".$_REQUEST['IdL'] ?>" target="FormRKPBMid">
  <table width="900" border="0" align="center">
    <tr> 
      <td width="90">&nbsp;DATA : </td>
      <td width="20"><input name="radiobutton" type="radio" value="ta_kib_a" onclick="this.form.submit()" checked /></td>
      <td width="56">KIB-A</td>
      <td width="18"><input name="radiobutton" type="radio" value="ta_kib_b" onclick="this.form.submit()"/></td>
      <td width="56">KIB-B</td>
      <td width="18"><input name="radiobutton" type="radio" value="ta_kib_c" onclick="this.form.submit()"/></td>
      <td width="56">KIB-C</td>
      <td width="18"><input name="radiobutton" type="radio" value="ta_kib_d" onclick="this.form.submit()"/></td>
      <td width="56">KIB-D</td>
      <td width="18"><input name="radiobutton" type="radio" value="ta_kib_e" onclick="this.form.submit()"/></td>
      <td width="170">KIB-E</td>
      <td width="370" valign="middle"><table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
          <tr> 
            <td width="15%">&nbsp; </td>
            <td width="44%">CARI</td>
            <td width="32%"> <input class="text" type="text" name="fFind" size="32" value="<?php echo $gFin?>" style="font-family: Calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" /></td>
            <td width="2%">&nbsp;</td>
            <td width="7%"> <input type="button" name="B39" value="GO" onclick="P_Find()" style="width: 50px; height: 21px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
          </tr>
      </table></td>
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