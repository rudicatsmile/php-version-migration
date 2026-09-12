<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
#echo $rIdT;
$eUPB = fGlobal("Kd_UPB","ta_sp3d_spj","IDT",$rIdT,"=","","");
$ReKN = fGlobal("Kd_ReknP108","ta_sp3d_spj","IDT",$rIdT,"=","","");
$eTGL = "";//fGlobal("Tgl_SPJ","ta_sp3d_spj","IDT",$rIdT,"=","","");
$eBAS = fGlobal("Tgl_BAST","ta_sp3d_spj","IDT",$rIdT,"=","","");
$eNIL = 0;//fGlobal("Nilai","ta_sp3d_spj","IDT",$rIdT,"=","","");

$eUN1 = fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($eUPB,0,11),"=","","");
$eUN2 = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",substr($eUPB,0,14),"=","","");
$eUN3 = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$eUPB,"=","","");

$eRK1 = fGlobal("Nm_Aset","ref_rek_aset108_4","Kd_Aset",substr($ReKN,0,8),"=","","");
$eRK2 = fGlobal("Nm_Aset","ref_rek_aset108_5","Kd_Aset",substr($ReKN,0,11),"=","","");
$eRK3 = fGlobal("Nm_Aset","ref_rek_aset108_6","Kd_Aset",substr($ReKN,0,14),"=","","");
$eRK4 = fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$ReKN,"=","","");
//echo substr($ReKN,0,5);

?>
<table border="0" width="900" height="23" cellspacing="0" cellpadding="0" align="center">
  <tr height="5">
    <td width="59"></td>
    <td width="26"></td>
    <td colspan="3"></td>
    <td width="371"></td>
  </tr>
  <tr height="25">
    <td class="ar">Unit</td>
    <td class="ac">:</td>
    <td width="324"><input name="fNomKon" id="fNomKon" type="text" value="<?=$eUN1?>" readonly style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td width="95" class="ar">Objek</td>
    <td width="25" class="ac">:</td>
    <td><input name="fNomKon2" id="fNomKon2" type="text" value="<?=$eRK1?>" readonly style=" width:300px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="25">
    <td class="ar">Sub Unit </td>
    <td class="ac">:</td>
    <td><input name="fNomKon" id="fNomKon" type="text" value="<?=$eUN2?>" readonly style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Rincian Objek </td>
    <td class="ac">:</td>
    <td><input name="fNomKon3" id="fNomKon3" type="text" value="<?=$eRK2?>" readonly style=" width:300px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="25">
    <td class="ar">UPB</td>
    <td class="ac">:</td>
    <td><input name="fNomKon" id="fNomKon" type="text" value="<?=$eUN3?>" readonly style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Sub ROBJ </td>
    <td class="ac">:</td>
    <td><input name="fNomKon4" id="fNomKon4" type="text" value="<?=$eRK3?>" readonly style=" width:300px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="25">
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>
	<input type="button" name="B39AddItem" id="B39AddItem" value="Add ASET" onclick="AddMidASET('<?=substr($ReKN,0,5)?>','<?=$eBAS?>','<?=$rIdT?>','<?=$IdL?>')" style="width: 80px; height: 21px; color:#0000FF" />
	<input type="button" name="B39Refresh" id="B39Refresh" value="Refresh"  onclick="showASET('refr','<?=$rIdT?>','','<?=$IdL?>')" style="width: 80px; height: 21px; color:#0000FF" />
	</td>
    <td class="ar">Sub-Sub ROBJ </td>
    <td class="ac">:</td>
    <td><input name="fNomKon5" id="fNomKon5" type="text" value="<?=$eRK4?>" readonly style=" width:300px; border: 1px solid #C0C0C0; background:#CCFF99"/></td>
  </tr>
</table>
