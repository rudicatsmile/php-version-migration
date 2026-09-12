<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
$NmCrt = fGlobal("deskripsi","ref_usulan_jenis","kode",$crt,"=","","");
?>
<body>
<table border="0" width="100%" height="25" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="14" style="padding-left:3px">&nbsp;</td>
    <td width="409" height="35" style="padding-left:3px; font-weight:bold; font-size:14px; text-shadow: #fff 1px 1px 0px ">FORM EKSEKUSI ASET - <font style="color:#FF0000"><?=$NmCrt?></font></td>
    <td width="205" style="font-weight:bold">Find (Kode Aset/Referensi)</td>
    <td width="287" style="font-family:arial; font-size:8pt">
	<input name="fFnDT" type="text" value="" onKeyPress="if (event.keyCode==13) {showEXEC_RefR('','0','<?=$IdT?>','<?=$IdL?>'); return false;} else if (event.keyCode==27){closeEXEC('','<?=$IdL?>'); return false;}" style="padding-left:5px; width:180px; border: 1px solid #C0C0C0"/>
	<div id="loadingImg3" style="width:0px; height:0px; display:none; vertical-align:middle; text-align:center"><img src="Images/loading3.gif" alt="" width="30" height="30"></div>
	</td>
    <td width="268" style="font-family:arial; font-size:8pt">
	<input type="button" name="B39" value="GO" onClick="showEXEC_RefR('','0','<?=$IdT?>','<?=$IdL?>'); return false;" style="width: 40px; height: 22px" />
	</td>
    <td width="134" style="text-align:right; padding-right:6px"><a href="#" onClick="closeEXEC('','<?=$IdL?>'); return false" class="ico clos"><u>C</u>LOSE</a></td>
  </tr>
</table>
</body>
<script languange="javascript">
	objfrm.fFnDT.focus();
</script>