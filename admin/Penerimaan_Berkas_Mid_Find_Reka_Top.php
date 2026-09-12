<?php
extract($_GET);
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
  <tr height="6">
    <td></td>
    <td colspan="2"></td>
    <td></td>
  </tr>
  <tr>
    <td width="10">&nbsp;</td>
    <td width="255"><input type="text" name="fDataFind" id="fDataFind" placeholder='Search' onkeypress="if (event.keyCode==13){showREKA('find','<?=$IdT?>','<?=$IdL?>'); return false;}" style="width:160px; padding: 1px 1px 3px 25px; background-image: url('css/images/prev.gif'); background-position: 3px 3px; background-repeat: no-repeat" /></td>
    <td width="255"></td>
    <td style="text-align:right; padding-right:6px"><a href="#" onclick="dispNO('alayMstCri'); return false;" class="igo clos"><u>C</u>LOSE</a></td>
  </tr>
</table>
<script>
$("#fDataFind").focus();
</script>
