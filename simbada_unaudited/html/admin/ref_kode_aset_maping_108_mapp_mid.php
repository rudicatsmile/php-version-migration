<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$gBid = substr($kde,0,2);
$dBid = fGlobal("Nm_Aset","ref_rek_aset1","Kd_Aset",$gBid,"=","","");

$gKel = substr($kde,0,5);
$dKel = fGlobal("Nm_Aset","ref_rek_aset2","Kd_Aset",$gKel,"=","","");

$gJen = substr($kde,0,8);
$dJen = fGlobal("Nm_Aset","ref_rek_aset3","Kd_Aset",$gJen,"=","","");

$gObj = substr($kde,0,11);
$dObj = fGlobal("Nm_Aset","ref_rek_aset4","Kd_Aset",$gObj,"=","","");

$gRin = $kde;
$dRin = fGlobal("Nm_Aset","ref_rek_aset5","Kd_Aset",$gRin,"=","","");

###########
$gBidE = "1";
$dBidE = fGlobal("Nm_Aset","ref_rek_aset108_1","Kd_Aset",$gBidE,"=","","");

$CeK108 = fGlobal("Kd_Aset108","ref_rek_aset5_maping","Kd_Aset17",$kde,"=","","");
if ($CeK108){
	$gKelE = substr($CeK108,0,3);
	$dKelE = fGlobal("Nm_Aset","ref_rek_aset108_2","Kd_Aset",$gKelE,"=","","");
	
	$gJenE = substr($CeK108,0,5);
	$dJenE = fGlobal("Nm_Aset","ref_rek_aset108_3","Kd_Aset",$gJenE,"=","","");
	
	$gObjE = substr($CeK108,0,8);
	$dObjE = fGlobal("Nm_Aset","ref_rek_aset108_4","Kd_Aset",$gObjE,"=","","");
	
	$gRinE = substr($CeK108,0,11);
	$dRinE = fGlobal("Nm_Aset","ref_rek_aset108_5","Kd_Aset",$gRinE,"=","","");
	
	$gSu1E = substr($CeK108,0,14);
	$dSu1E = fGlobal("Nm_Aset","ref_rek_aset108_6","Kd_Aset",$gSu1E,"=","","");
	
	$gSu2E = substr($CeK108,0,18);
	$dSu2E = fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$gSu2E,"=","","");
}
else{
	$gKelE = "1.3";
	$dKelE = fGlobal("Nm_Aset","ref_rek_aset108_2","Kd_Aset",$gKelE,"=","","");
}
?>
<table align='center' border='0' width='100%' class='table-form' cellspacing='0' cellpadding='0' style='border-collapse:collapse'>
<tr>
 <td width="50">&nbsp;</td>
 <td width="130">
	<div id="mapmDivShow0" class="find0Mapm">
		<div id="mapmDivShow1" class="find1Mapm"></div>
		<div id="mapmDivShow2" class="find2Mapm"></div>
	</div> </td>
 <td width="30">&nbsp;</td>
  <td colspan="2" style="font-weight:bold">&nbsp;</td>
 <td>&nbsp;</td>
</tr>
<tr height="25px">
  <td colspan="2">&nbsp;</td>
  <td>
	<div id="mapnDivShow0" class="find0Mapn">
		<div id="mapnDivShow1" class="find1Mapn"></div>
		<div id="mapnDivShow2" class="find2Mapn"></div>
	</div> </td>
 <td colspan="2" style="font-weight:bold">PERMENDAGRI 17</td>
  <td>&nbsp;</td>
</tr>
<tr height="25px">
 <td colspan="2" align="right">Bidang</td>
 <td align="center">:</td>
 <td colspan="2"><input name="fMapBid2" id="fMapBid2" type="text" value="<?=$gBid?>" readonly style="padding-left:5px; width:120px; border: 1px solid #C0C0C0; background:#CCFF99"/>
   <input name="dMapBid" id="dMapBid" type="text" value="<?=$dBid?>" readonly style="padding-left:5px; width:387px; border: 1px solid #C0C0C0; background:#CCFF99; text-transform:uppercase"/> </td>
 <td>&nbsp;</td>
</tr>
<tr height="25px">
 <td colspan="2" align="right">Kelompok</td>
 <td align="center">:</td>
 <td colspan="2">
	<input name="fMapKel" id="fMapKel" type="text" value="<?=$gKel?>" readonly style="padding-left:5px; width:120px; border: 1px solid #C0C0C0; background:#CCFF99"/>
	<input name="dMapKel" id="dMapKel" type="text" value="<?=$dKel?>" readonly style="padding-left:5px; width:387px; border: 1px solid #C0C0C0; background:#CCFF99; text-transform:uppercase"/> </td>
 <td>&nbsp;</td>
</tr>
<tr height="25px">
 <td colspan="2" align="right">Jenis</td>
 <td align="center">:</td>
 <td colspan="2">
	<input name="fMapJen" id="fMapJen" type="text" value="<?=$gJen?>" readonly style="padding-left:5px; width:120px; border: 1px solid #C0C0C0; background:#CCFF99"/>
	<input name="dMapJen" id="dMapJen" type="text" value="<?=$dJen?>" readonly style="padding-left:5px; width:387px; border: 1px solid #C0C0C0; background:#CCFF99; text-transform:uppercase"/> </td>
 <td>&nbsp;</td>
</tr>
<tr height="25px">
  <td colspan="2" align="right">Objek</td>
  <td align="center">:</td>
 <td colspan="2">
	<input name="fMapObj" id="fMapObj" type="text" value="<?=$gObj?>" readonly style="padding-left:5px; width:120px; border: 1px solid #C0C0C0; background:#CCFF99"/>
	<input name="dMapObj" id="dMapObj" type="text" value="<?=$dObj?>" readonly style="padding-left:5px; width:387px; border: 1px solid #C0C0C0; background:#CCFF99; text-transform:uppercase"/> </td>
  <td>&nbsp;</td>
</tr>
<tr height="25px">
  <td colspan="2" align="right">Rincian Objek </td>
  <td align="center">:</td>
 <td colspan="2">
	<input name="fMapRin" id="fMapRin" type="text" value="<?=$gRin?>" readonly style="padding-left:5px; width:120px; border: 1px solid #C0C0C0; background:#CCFF99"/>
	<input name="dMapRin" id="dMapRin" type="text" value="<?=$dRin?>" readonly style="padding-left:5px; width:387px; border: 1px solid #C0C0C0; background:#CCFF99; text-transform:uppercase"/> </td>
  <td>&nbsp;</td>
</tr>
<tr height="25px">
  <td colspan="2" align="right">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td colspan="2">&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr height="25px">
  <td colspan="2" align="right">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td colspan="2" style="font-weight:bold">PERMENDAGRI 108</td>
  <td>&nbsp;</td>
</tr>
<tr height="25px">
  <td colspan="2" align="right">Bidang</td>
  <td align="center">:</td>
 <td colspan="2"><input name="fMapBidE" id="fMapBidE" type="text" value="<?=$gBidE?>" readonly style="padding-left:5px; width:120px; border: 1px solid #C0C0C0; background:#CCFF99"/>
   <input name="dMapBidE" id="dMapBidE" type="text" value="<?=$dBidE?>" readonly style="padding-left:5px; width:387px; border: 1px solid #C0C0C0; background:#CCFF99"/> </td>
  <td>&nbsp;</td>
</tr>
<tr height="25px">
  <td colspan="2" align="right">Kelompok</td>
  <td align="center">:</td>
 <td colspan="2">
	<input name="fMapKelE" id="fMapKelE" type="text" value="<?=$gKelE?>" readonly style="padding-left:5px; width:120px; border: 1px solid #C0C0C0"/>
	<input name="dMapKelE" id="dMapKelE" type="text" value="<?=$dKelE?>" readonly onClick="showGlobalPopupKELO('view','mapnDivShow','ref_kode_aset_maping_108_mapp_find_mid','ref_kode_aset_maping_108_mapp_find_top','','Lev=kelo&IdL=<?=$_GET['IdL']?>')" style="padding-left:5px; width:387px; border: 1px solid #C0C0C0"/>	</td>
  <td>&nbsp;</td>
</tr>
<tr height="25px">
  <td colspan="2" align="right">Jenis</td>
  <td align="center">:</td>
 <td colspan="2">
	<input name="fMapJenE" id="fMapJenE" type="text" value="<?=$gJenE?>" readonly style="padding-left:5px; width:120px; border: 1px solid #C0C0C0"/>
	<input name="dMapJenE" id="dMapJenE" type="text" value="<?=$dJenE?>" readonly onClick="showGlobalPopupJENI('view','mapnDivShow','ref_kode_aset_maping_108_mapp_find_mid','ref_kode_aset_maping_108_mapp_find_top','','Lev=jeni&IdL=<?=$_GET['IdL']?>')" style="padding-left:5px; width:387px; border: 1px solid #C0C0C0"/> </td>
  <td>&nbsp;</td>
</tr>
<tr height="25px">
  <td colspan="2" align="right">Objek</td>
  <td align="center">:</td>
 <td colspan="2">
	<input name="fMapObjE" id="fMapObjE" type="text" value="<?=$gObjE?>" readonly style="padding-left:5px; width:120px; border: 1px solid #C0C0C0"/>
	<input name="dMapObjE" id="dMapObjE" type="text" value="<?=$dObjE?>" readonly onClick="showGlobalPopupOBJE('view','mapnDivShow','ref_kode_aset_maping_108_mapp_find_mid','ref_kode_aset_maping_108_mapp_find_top','','Lev=obje&IdL=<?=$_GET['IdL']?>')" style="padding-left:5px; width:387px; border: 1px solid #C0C0C0"/> </td>
  <td>&nbsp;</td>
</tr>
<tr height="25px">
  <td colspan="2" align="right">Rincian Objek </td>
  <td align="center">:</td>
 <td colspan="2">
	<input name="fMapRinE" id="fMapRinE" type="text" value="<?=$gRinE?>" readonly style="padding-left:5px; width:120px; border: 1px solid #C0C0C0"/>
	<input name="dMapRinE" id="dMapRinE" type="text" value="<?=$dRinE?>" readonly onClick="showGlobalPopupRINC('view','mapnDivShow','ref_kode_aset_maping_108_mapp_find_mid','ref_kode_aset_maping_108_mapp_find_top','','Lev=rinc&IdL=<?=$_GET['IdL']?>')" style="padding-left:5px; width:387px; border: 1px solid #C0C0C0"/> </td>
  <td>&nbsp;</td>
</tr>
<tr height="25px">
  <td colspan="2" align="right">Sub Rincian Objek </td>
  <td align="center">:</td>
 <td colspan="2">
	<input name="fMapSu1E" id="fMapSu1E" type="text" value="<?=$gSu1E?>" readonly style="padding-left:5px; width:120px; border: 1px solid #C0C0C0"/>
	<input name="dMapSu1E" id="dMapSu1E" type="text" value="<?=$dSu1E?>" readonly onClick="showGlobalPopupSUB1('view','mapnDivShow','ref_kode_aset_maping_108_mapp_find_mid','ref_kode_aset_maping_108_mapp_find_top','','Lev=sub1&IdL=<?=$_GET['IdL']?>')" style="padding-left:5px; width:387px; border: 1px solid #C0C0C0"/> </td>
  <td><input type="button" name="B12" value="Save" style="width:100px; height:22px" onclick="SaveMapi('ViewDELL','ref_kode_aset_maping_108_mapp_save','kde=<?=$kde?>&IdL=<?=$_GET['IdL']?>')" /></td>
</tr>
<tr height="25px">
  <td colspan="2" align="right">Sub Sub Rincian Objek </td>
  <td align="center">:</td>
 <td width="478">
	<input name="fMapSu2E" id="fMapSu2E" type="text" value="<?=$gSu2E?>" readonly style="padding-left:5px; width:120px; border: 1px solid #C0C0C0"/>
	<input name="dMapSu2E" id="dMapSu2E" type="text" value="<?=$dSu2E?>" readonly onClick="showGlobalPopupSUB2('view','mapnDivShow','ref_kode_aset_maping_108_mapp_find_mid','ref_kode_aset_maping_108_mapp_find_top','','Lev=sub2&IdL=<?=$_GET['IdL']?>')" style="padding-left:5px; width:330px; border: 1px solid #C0C0C0"/> </td>
  <td width="70"><input type="button" name="B1" value="CARI" style="width:50px; height:22px; color:#0000FF" onClick="showGlobalPopup('view','mapmDivShow','ref_kode_aset_maping_108_mapp_find_fmid','ref_kode_aset_maping_108_mapp_find_ftop','','IdL=<?=$_GET['IdL']?>')" /></td>
  <td><input type="button" name="B122" value="Close" style="width:100px; height:22px" onclick="closePopup('<?=$nmDiv?>0')" /></td>
</tr>
<tr height="25px">
  <td colspan="2" align="right">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td style="font-style:italic; font-size:9pt; color:#666666">** Note : pencarian sudah bisa digunakan **</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
