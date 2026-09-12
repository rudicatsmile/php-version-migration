<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_top.css" type="text/css" media="all" />
</head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
</head>
<body background="css/images/newheader.gif" topmargin="0" onload="javascript:myfrm.fFind.focus()">
<form name="myfrm" method="post" action="<?php echo "Form_Invent_Asset_Ubh_Mid_Mid.php?rIDT=".$rIDT."&rRef=".$rRef."&rKib=".$rKib."&IdL=".$_GET['IdL'] ?>" target="WinFindBBB_Mid">
  <table width="599" border="0" align="center">
    <tr> 
      <td width="193">&nbsp;</td>
      <td width="897" valign="middle"><table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
          <tr> 
            <td width="14%">&nbsp; </td>
            <td width="14%">CARI</td>
            <td width="52%"> <input class="text" type="text" name="fFind" size="32" value="<? echo $gFin?>" style="font-family: Calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" /></td>
            <td width="3%">&nbsp;</td>
            <td width="14%"> <input type="button" name="B39" value="GO" onclick="P_Find()" style="width: 50px; height: 21px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
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