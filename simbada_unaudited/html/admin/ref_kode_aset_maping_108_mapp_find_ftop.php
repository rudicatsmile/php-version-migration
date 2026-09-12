<?
extract($_GET);
?>
<table border="0" width="100%" height="23" cellspacing="0" cellpadding="0" align="center">
  <tr height="6">
  <td colspan="7"></td>
  </tr>
  <tr>
    <td width="26" style="padding-left:3px">&nbsp;</td>
	<td width="60" align="right">Search</td>
	<td width="20"></td>
	<td width="330">
	<input name="fndRkn" id="fndRkn" type="text" tabindex="0" onfocus="funcSelect()" placeholder="Cari data ketik disini..!!" onKeyPress="if (event.keyCode==13) {showGlobalPopup('find','<?=$nmDiv?>','<?=$fileMid?>','','fndRkn','Lev=<?=$Lev?>&IdL=<?=$IdL?>'); return false;} else if (event.keyCode==27){closePopup('<?=$nmDiv?>0'); return false;}" style="padding-left:5px; width:250px"/>
	&nbsp;<a href="#" onclick="showGlobalPopup('find','<?=$nmDiv?>','<?=$fileMid?>','','fndRkn','Lev=<?=$Lev?>&IdL=<?=$IdL?>'); return false;" class="ico prev">CARI</a>	</td>
    <td>
	<select name="LisFilter" id="LisFilter" style="padding-left:5px; width:160px" onchange="showGlobalPopup('find','<?=$nmDiv?>','<?=$fileMid?>','','fndRkn','Lev=<?=$Lev?>&IdL=<?=$IdL?>'); return false;">
	<option value="1.3">1.3 : Aset Tetap</option>
	<option value="1.5">1.5 : Aset Lainnya</option>
	<option value="ALL">All</option>
	</select>
	</td>
    <td>&nbsp;</td>
    <td width="100" style="text-align:center"><a href="#" onclick="closePopup('<?=$nmDiv?>0'); return false" class="igo clos"><u>C</u>LOSE</a></td>
  </tr>
</table>

<script languange="javascript"> 
	function funcSelect(){
		$("#fndRkn").select();
	}
	$("#fndRkn").focus();
</script>
