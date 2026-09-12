<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
?>
<table border="0" width="100%" height="25" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="10" class="ac" style="padding-left:3px">&nbsp;</td>
    <td class="al">
	<input type="text" name="fFndUPB" id="fFndUPB" placeholder='search' onKeyPress="if (event.keyCode==13){findUPB('find','<?=$CrDiv?>','<?=$IdL?>');return false;} else if (event.keyCode==27){globalClose('<?=$CrDiv?>MstDiv0');return false;}" style="width:170px; height:14px; padding-left:20px; background-image: url('css/images/prev.gif'); background-position:2px 2px; background-repeat: no-repeat" tabindex="30"/>
	</td>
    <td width="60" style="text-align:right; padding-right:6px"><a href="#" onclick="globalClose('<?=$CrDiv?>MstDiv0'); return false" class="ico clos" tabindex="30"><u>C</u>LOSE</a></td>
  </tr>
</table>
<script languange="javascript"> 
$('#fFndUPB').focus();
</script>