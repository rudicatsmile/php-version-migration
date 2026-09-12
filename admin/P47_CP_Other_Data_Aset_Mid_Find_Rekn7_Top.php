<?php
extract($_GET);
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
  <tr height="3">
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td width="10">&nbsp;</td>
    <td width="510"><input type="text" name="findRek7" id="findRek7" placeholder='search' onkeypress="if (event.keyCode==13){showREKN7('find','<?=$GoB?>','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {globalClose('rekn7MstCri'); return false;}" style="width:150px; padding-left:20px; background-image: url('css/images/prev.gif'); background-position:2px 2px; background-repeat: no-repeat" /></td>
    <td style="text-align:right; padding-right:6px"><a href="#" onclick="globalClose('rekn7MstCri'); return false;" class="igo clos"><u>C</u>LOSE</a></td>
  </tr>
</table>
<script languange="javascript">
$("#findRek7").focus();
</script>