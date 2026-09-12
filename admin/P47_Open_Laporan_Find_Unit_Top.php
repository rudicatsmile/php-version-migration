<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
  <tr height="3">
    <td></td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td width="10">&nbsp;</td>
    <td width="510"><input type="text" name="findUnT" id="findUnT" placeholder='search' onkeypress="if (event.keyCode==13){showUNIT('find','<?=$_GET['IdL']?>'); return false;} else if (event.keyCode==27) {globalClose('unitMstCri'); return false;}" style="width:150px; padding-left:20px; background-image: url('css/images/prev.gif'); background-position:2px 2px; background-repeat: no-repeat" /></td>
    <td style="text-align:right; padding-right:6px"><a href="#" onclick="globalClose('unitMstCri'); return false;" class="igo clos"><u>C</u>LOSE</a></td>
  </tr>
</table>
<script languange="javascript">
$("#findUnT").focus();
</script>