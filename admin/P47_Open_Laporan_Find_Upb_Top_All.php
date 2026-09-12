<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
  <tr height="3">
    <td></td>
    <td colspan="2"></td>
    <td></td>
  </tr>
  <tr>
    <td width="10">&nbsp;</td>
    <td width="175"><input type="text" name="findUpBA" id="findUpBA" placeholder='search' onkeypress="if (event.keyCode==13){BtnFNX.click(); return false;} else if (event.keyCode==27) {globalClose('upbMstCri'); return false;}" style="width:150px; padding-left:20px; background-image: url('css/images/prev.gif'); background-position:2px 2px; background-repeat: no-repeat" /></td>
    <td width="255"><input type="button" name="BtnFNX" id="BtnFNX" value="..." onclick="cariUPB('find','<?=$_GET['IdL']?>')" style="width:25px; height:22px" /></td>
    <td style="text-align:right; padding-right:6px"><a href="#" onclick="globalClose('upbMstCri'); return false;" class="igo clos"><u>C</u>LOSE</a></td>
  </tr>
</table>
<script languange="javascript">
$("#findUpBA").focus();
</script>