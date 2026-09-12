<?php
extract($_GET);
?>
<table border="0" width="100%" height="25" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="50" style="padding-left:3px">Search</td>
    <td><input type="text" name="fFindSP3" id="fFindSP3" onkeypress="if (event.keyCode==13){showDATA('find','<?=$IdT?>','<?=$IdL?>');} else if (event.keyCode==27){closeCLICK('tran'); return false}" style="width: 200px"></td>
	<td style="text-align:right; padding-right:6px"><a href="#" onclick="closeCLICK('tran'); return false" class="ico clos"><u>C</u>LOSE</a></td>
  </tr>
</table>
<table border="0" width="100%" height="25" cellspacing="0" cellpadding="0" align="center" style="background:#000; color:#FFFFFF">
  <tr style="font-weight:bold">
  <td width="103" style="border-right:1px solid #fff; padding-left:7px">Ref.SP3B</td>
  <td width="69" style="border-right:1px solid #fff; padding-left:11px">Tgl.SP3B</td>
  <td width="139" style="border-right:1px solid #fff; padding-left:4px">Nom.SP3B</td>
  <td width="259" style="border-right:1px solid #fff; padding-left:4px">Uraian</td>
  <td width="100" style="border-right:1px solid #fff; text-align:right; padding-right:3px">Nilai SP3B</td>
  <td width="100" style="border-right:1px solid #fff; text-align:right; padding-right:3px">Nilai Aset</td>
  <td style="border-right:1px solid #fff; text-align:center">Action</td>
  </tr>
</table>

<script languange="javascript">
$("#fFindSP3").focus();
</script>