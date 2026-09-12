<?php
require('Connection.php');
require("CheckLogin.php");
extract($_GET);
?>

<table border="0" width="1000" cellspacing="0" cellpadding="0" align="center">
  <tr height="30">
    <td width="14">&nbsp;</td>
    <td width="50">Search</td>
    <td width="214">
    <input type="text" name="fFindPL" id="fFindPL" placeholder='Search' onkeypress="if (event.keyCode==13){LoadASET('find','<?=$PgE?>','<?=$SkD?>','<?=$KdA?>','<?=$IdL?>');} else if (event.keyCode==27){closeCLICK('aset'); return false}" style="width:200px" />    </td>
    <td><a href="#" onclick="LoadASET('find','<?=$PgE?>','<?=$SkD?>','<?=$KdA?>','<?=$IdL?>'); return false;" class="ico prev">GO</a></td>
    <td width="50">Tampil</td>
    <td width="90">
	<select class="boxs" name="fTmpRecL" id="fTmpRecL" style="width:73px" tabindex="0" onchange="LoadASET('find','<?=$PgE?>','<?=$SkD?>','<?=$KdA?>','<?=$IdL?>'); return false;">
      <option value="400">400</option>
      <option value="800">800</option>
      <option value="1000">1.000</option>
      <option value="2000">2.000</option>
      <option value="4000">4.000</option>
      <option value="5000">5.000</option>
      <option value="7000">7.000</option>
      <option value="8000">8.000</option>
      <option value="9000">9.000</option>
      <option value="10000">10.000</option>
    </select></td>
    <td width="100" style="text-align:right; padding-right:6px"><a href="#" onclick="closeCLICK('aset'); return false" class="ico clos"><u>C</u>LOSE</a></td>
  </tr>
</table>
<script languange="javascript">
$("#fFindPL").focus();
</script>