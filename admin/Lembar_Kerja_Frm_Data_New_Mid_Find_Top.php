<table border="0" width="1000" cellspacing="0" cellpadding="0" align="center">
  <tr height="3">
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td width="10" align="center">&nbsp;</td>
    <td width="855"><input type="text" name="findRekN" id="findRekN" placeholder='search' onkeypress="if (event.keyCode==13){P_LoadKd('find','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>'); return false;} else if (event.keyCode==27) {globalClose('loadMstCri'); return false;}" style="width:150px; padding-left:20px; background-image: url('css/images/prev.gif'); background-position:2px 2px; background-repeat: no-repeat" /></td>
    <td style="text-align:right; padding-right:6px"><a href="#" onclick="globalClose('loadMstCri'); return false;" class="igo clos"><u>C</u>LOSE</a></td>
  </tr>
</table>
<script languange="javascript">
$("#findRekN").focus();
</script>