<?
extract($_GET);
?>
<table border="0" width="100%" height="25" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="14" style="padding-left:3px">&nbsp;</td>
	<td width="60" style="padding-left:3px; font-weight:bold"><label style="cursor:pointer"><input name="fKIB" type="radio" value="TNH" onclick="showASET('<?=$stLOCK?>','find','<?=$IdT?>','<?=$IdL?>')" checked />KIB A</label></td>
    <td width="60" style="padding-left:3px; font-weight:bold"><label style="cursor:pointer"><input name="fKIB" type="radio" value="ALT" onclick="showASET('<?=$stLOCK?>','find','<?=$IdT?>','<?=$IdL?>')" />KIB B</label></td>
    <td width="60" style="padding-left:3px; font-weight:bold"><label style="cursor:pointer"><input name="fKIB" type="radio" value="BNG" onclick="showASET('<?=$stLOCK?>','find','<?=$IdT?>','<?=$IdL?>')" />KIB C</label></td>
    <td width="60" style="padding-left:3px; font-weight:bold"><label style="cursor:pointer"><input name="fKIB" type="radio" value="JLN" onclick="showASET('<?=$stLOCK?>','find','<?=$IdT?>','<?=$IdL?>')" />KIB D</label></td>
    <td width="60" style="padding-left:3px; font-weight:bold"><label style="cursor:pointer"><input name="fKIB" type="radio" value="ATL" onclick="showASET('<?=$stLOCK?>','find','<?=$IdT?>','<?=$IdL?>')" />KIB E</label></td>
    <td width="50" style="padding-left:3px; font-weight:bold"><label style="cursor:pointer"><input name="fKIB" type="radio" value="ATB" onclick="showASET('<?=$stLOCK?>','find','<?=$IdT?>','<?=$IdL?>')" />ATB</label></td>
    <td width="90" style="padding-left:3px; font-weight:bold"><label style="cursor:pointer"><input name="fKIB" type="radio" value="KDL" onclick="showASET('<?=$stLOCK?>','find','<?=$IdT?>','<?=$IdL?>')" />LAINNYA</label></td>
    <td height="35" width="54" style="padding-left:3px; font-weight:bold">FIND</td>
    <td width="211"><input type="text" name="fFindP" onkeypress="if (event.keyCode==13){showASET('<?=$stLOCK?>','find','<?=$IdT?>','<?=$IdL?>');} else if (event.keyCode==27){closeCLICK('aset'); return false}" style="width: 200px"></td>
    <td width="40"><a href="#" onclick="showASET('<?=$stLOCK?>','find','<?=$IdT?>','<?=$IdL?>'); return false;" class="ico prev">GO</a></td>
    <td style="font-family:arial; font-size:8pt">** Item yang tampil tanpa pencarian hanya 200 item</td>
    <td width="60" style="text-align:right; padding-right:6px"><a href="#" onclick="closeCLICK('aset'); return false" class="ico clos"><u>C</u>LOSE</a></td>
  </tr>
</table>
