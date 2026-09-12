<table border="0" width="100%" height="25" cellspacing="0" cellpadding="0" align="center" style="font-family:Calibri; font-size:9pt">
  <tr>
    <td width="50" style="padding-left:3px">Search.</td>
    <td><input type="text" name="fFindPR" id="fFindPR" onkeypress="if (event.keyCode==13){ showREKN('find','<?=$_GET['IdL']?>');} else if (event.keyCode==27) {closeCLICK('rekn');}" style="width: 200px"></td>
    <td style="text-align:right; padding-right:6px"><a href="#" onclick="closeCLICK('rekn'); return false" class="ico clos"><u>C</u>LOSE</a></td>
  </tr>
</table>
<script languange="javascript">
$("#fFindPR").focus();
</script>