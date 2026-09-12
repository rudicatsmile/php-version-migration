<?
extract($_GET);
?>
<table border="0" width="100%" height="25" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="14" style="padding-left:3px">&nbsp;</td>
    <td width="54" style="padding-left:3px; font-weight:bold">FIND</td>
    <td width="211"><input type="text" name="fFindP" id="fFindP" onkeypress="if (event.keyCode==13){showASET('find','<?=$IdL?>');} else if (event.keyCode==27){closeCLICK('aset'); return false}" style="width: 200px"></td>
    <td width="40"><a href="#" onclick="showASET('find','<?=$IdL?>'); return false;" class="ico prev">GO</a></td>
    <td style="font-family:arial; font-size:8pt">** Item yang tampil tanpa pencarian hanya 200 item</td>
    <td width="60" style="text-align:right; padding-right:6px"><a href="#" onclick="closeCLICK('aset'); return false" class="ico clos"><u>C</u>LOSE</a></td>
  </tr>
</table>
<script type="text/javascript">
$("#fFindP").focus();
</script>