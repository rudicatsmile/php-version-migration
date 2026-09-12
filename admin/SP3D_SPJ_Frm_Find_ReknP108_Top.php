<?php
require('Connection.php');
extract($_GET);
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
  <tr height="35">
    <td width="10">&nbsp;</td>
    <td width="60"><label style="cursor:pointer; font-weight:bold"><input name="fREK" type="radio" value="1.3"   onclick="showReknP108('find','<?=$fIdT?>','<?=$IdL?>')" checked />ALL</label></td>
    <td width="85"><label style="cursor:pointer; font-weight:bold"><input name="fREK" type="radio" value="1.3.1" onclick="showReknP108('find','<?=$fIdT?>','<?=$IdL?>')" />TANAH</label></td>
    <td width="105"><label style="cursor:pointer; font-weight:bold"><input name="fREK" type="radio" value="1.3.2" onclick="showReknP108('find','<?=$fIdT?>','<?=$IdL?>')" />PERALATAN</label></td>
    <td width="95"><label style="cursor:pointer; font-weight:bold"><input name="fREK" type="radio" value="1.3.3" onclick="showReknP108('find','<?=$fIdT?>','<?=$IdL?>')" />GEDUNG</label></td>
    <td width="90"><label style="cursor:pointer; font-weight:bold"><input name="fREK" type="radio" value="1.3.4" onclick="showReknP108('find','<?=$fIdT?>','<?=$IdL?>')" />JALAN</label></td>
    <td width="95"><label style="cursor:pointer; font-weight:bold"><input name="fREK" type="radio" value="1.3.5" onclick="showReknP108('find','<?=$fIdT?>','<?=$IdL?>')" />LAINNYA</label></td>
    <td width="90"><label style="cursor:pointer; font-weight:bold"><input name="fREK" type="radio" value="1.3.6" onclick="showReknP108('find','<?=$fIdT?>','<?=$IdL?>')" />KDP</label></td>
    <td width="57" style="color:#0000FF">TAMPIL</td>
    <td width="60"><select class="boxs" name="fTmpRec" id="fTmpRec" style="width: 60px" tabindex="0" onchange="showReknP108('find','<?=$fIdT?>','<?=$IdL?>'); return false;">
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
    <td width="154"><input type="text" name="fFindP" id="fFindP" onkeypress="if (event.keyCode==13){showReknP108('find','<?=$fIdT?>','<?=$IdL?>');} else if (event.keyCode==27){closeCLICK('aset'); return false}" style="width:130px" /></td>
    <td><a href="#" onclick="showReknP108('find','<?=$fIdT?>','<?=$IdL?>'); return false;" class="ico prev">GO</a></td>
    <td width="60" style="text-align:right; padding-right:6px"><a href="#" onclick="closeCLICK('aset'); return false" class="ico clos"><u>C</u>LOSE</a></td>
  </tr>
</table>
<script languange="javascript">
$("#fFindP").focus();
</script>