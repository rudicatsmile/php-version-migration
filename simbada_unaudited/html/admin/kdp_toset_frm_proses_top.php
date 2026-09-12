<?
#require('Connection.php');
#require('FileFunction.php');
#require("CheckLogin.php");
extract($_GET);
?>
<table border="0" width="100%" height="25" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="5" class="ac" style="padding-left:3px">&nbsp;</td>
    <td class="al" style="font-size:11pt; font-weight:bold">&nbsp;<img src="css/images/bukk.png" />&nbsp;&nbsp;PROSES KDP TO ASET</td>
    <td width="60" style="text-align:right; padding-right:6px"><a href="#" onclick="globalClose('<?=$CrDiv?>MstDiv0'); showKDPTA('refr','<?=$IdT?>','kdpt','<?=$IdL?>');" class="ico clos" tabindex="30"><u>C</u>LOSE</a></td>
  </tr>
</table>
