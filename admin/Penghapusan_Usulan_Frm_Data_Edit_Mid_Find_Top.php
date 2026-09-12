<?php
extract($_GET);
?>
<table border="0" width="100%" height="25" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="50" style="padding-left:3px">Search</td>
    <td><input type="text" name="fFindDTA" onkeypress="if (event.keyCode==13){findEDIT('<?=$rMsT?>','<?=$gFrm?>','find','<?=$gID?>','<?=$IdL?>');} else if (event.keyCode==27){closeCLICK('alas'); return false}" style="width: 200px"></td>
    <td style="text-align:right; padding-right:6px"><a href="#" onclick="closeCLICK('alas'); return false" class="ico clos"><u>C</u>LOSE</a></td>
  </tr>
</table>