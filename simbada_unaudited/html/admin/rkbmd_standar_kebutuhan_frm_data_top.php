<?
extract($_GET);
?>
<table border="0" width="100%" height="25" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="5" style="padding-left:3px">&nbsp;</td>
    <td height="35" width="54" style="padding-left:3px; font-weight:bold">FIND</td>
    <td width="211"><input type="text" name="fFindA" id="fFindA" onkeypress="if (event.keyCode==13){showDATA('find','<?=$IdT?>','<?=$IdL?>');} else if (event.keyCode==27){closeCLICK('tran'); return false}" style="width: 200px"></td>
    <td width="40"><a href="#" onclick="showDATA('find','<?=$IdT?>','<?=$IdL?>'); return false;" class="ico prev">GO</a></td>
    <td style="font-family:arial; font-size:8pt">** Item yang tampil tanpa pencarian hanya 300 item</td>
    <td width="60" style="text-align:right; padding-right:6px"><a href="#" onclick="closeCLICK('aset'); return false" class="ico clos"><u>C</u>LOSE</a></td>
  </tr>
</table>
<script languange="javascript">
$("#fFindA").focus();
</script>