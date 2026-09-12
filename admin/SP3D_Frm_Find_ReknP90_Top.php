<?php
require('Connection.php');
extract($_GET);
?>

<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
  <tr height="35">
    <td width="10">&nbsp;</td>
    <td width="50"><label style="cursor:pointer"><input name="fREK" type="radio" value="4_5"   onclick="showReknP90('find','<?=$IdT?>','<?=$IdL?>')" checked />ALL</label></td>
    <td width="95"><label style="cursor:pointer"><input name="fREK" type="radio" value="4" onclick="showReknP90('find','<?=$IdT?>','<?=$IdL?>')" />PENDAPATAN</label></td>
    <td width="80"><label style="cursor:pointer"><input name="fREK" type="radio" value="5.1" onclick="showReknP90('find','<?=$IdT?>','<?=$IdL?>')" />B.OPERASI</label></td>
    <td width="80"><label style="cursor:pointer"><input name="fREK" type="radio" value="5.2" onclick="showReknP90('find','<?=$IdT?>','<?=$IdL?>')" />B.MODAL</label></td>
    <td width="110"><label style="cursor:pointer"><input name="fREK" type="radio" value="5.3" onclick="showReknP90('find','<?=$IdT?>','<?=$IdL?>')" />B.TAK TERDUGA</label></td>
    <td width="10">&nbsp;</td>
    <td width="50" style="color:#0000FF">TAMPIL</td>
    <td width="50"><select class="boxs" name="fTmpRec" id="fTmpRec" style="width: 60px" tabindex="0" onchange="showReknP90('find','<?=$IdT?>','<?=$IdL?>'); return false;">
	<option value="100">100</option>
	<option value="200">200</option>
	<option value="400">400</option>
	<option value="800">800</option>
	<option value="1000">1000</option>
	<option value="2000">2000</option>
	<option value="4000">4000</option>
	<option value="5000">5000</option>
    </select></td>
    <td width="40" align="right" style="color:#0000FF">CARI</td>
    <td width="20">&nbsp;</td>
    <td width="180"><input type="text" name="fFindP" id="fFindP" onkeypress="if (event.keyCode==13){showReknP90('find','<?=$IdT?>','<?=$IdL?>');} else if (event.keyCode==27){closeCLICK('aset'); return false}" style="width:140px" /></td>
    <td><a href="#" onclick="showReknP90('find','<?=$IdT?>','<?=$IdL?>'); return false;" class="ico prev">GO</a></td>
    <td width="60" style="text-align:right; padding-right:6px"><a href="#" onclick="closeCLICK('aset'); return false" class="ico clos"><u>C</u>LOSE</a></td>
  </tr>
</table>
<script languange="javascript">
$("#fFindP").focus();
</script>