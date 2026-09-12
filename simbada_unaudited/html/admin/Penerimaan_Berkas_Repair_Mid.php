<?
require('Connection.php');
require('FileFunction.php');

extract($_GET);

#echo $IdT;
$nSQ = "SELECT IDT as A0,
Kd_Program as A1,
Nm_Program as A2,
Kd_Kegiatan as A3,
Nm_Kegiatan as A4,
Kd_SubKegiatan as A5,
Nm_SubKegiatan as A6,
Kd_Rek13 as A7,
Nm_Rek13 as A8,
Kd_Unit as A9 

FROM ta_penerimaan_berkas WHERE IDT='".$IdT."'";
#echo $nSQ;
$nRs = mysql_query($nSQ);
$mRo = mysql_fetch_array($nRs);

?>
<table width="800" border="0" align="center" style="font-weight:bold">
<tr> 
  <td width="30">&nbsp;</td>
  <td>:: PROGRAM KEGIATAN LAMA :</td>
</tr>
</table>
<table width="800" border="0" align="center">
<tr> 
  <td width="114">&nbsp;</td>
  <td width="20">&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr height="24"> 
  <td align="right">Program</td>
  <td align="center">:</td>
  <td>
  <input name="fDAT" id="fDAT" type="text" value="<?=$mRo[1]?>" readonly style="padding-left:5px; width:100px; border: 1px solid #C0C0C0"/>
  <input name="dDAT" id="dDAT" type="text" value="<?=$mRo[2]?>" readonly style="padding-left:5px; text-transform:uppercase; width:450px; border: 1px solid #C0C0C0"/>
  </td>
</tr>
<tr height="24"> 
  <td align="right">Kegiatan</td>
  <td align="center">:</td>
  <td>
  <input name="fDAT" id="fDAT" type="text" value="<?=$mRo[3]?>" readonly style="padding-left:5px; width:100px; border: 1px solid #C0C0C0"/>
  <input name="dDAT" id="dDAT" type="text" value="<?=$mRo[4]?>" readonly style="padding-left:5px; text-transform:uppercase; width:450px; border: 1px solid #C0C0C0"/>
  </td>
</tr>
<tr height="24"> 
  <td align="right">Sub Kegiatan</td>
  <td align="center">:</td>
  <td>
  <input name="fDAT" id="fDAT" type="text" value="<?=$mRo[5]?>" readonly style="padding-left:5px; width:100px; border: 1px solid #C0C0C0"/>
  <input name="dDAT" id="dDAT" type="text" value="<?=$mRo[6]?>" readonly style="padding-left:5px; text-transform:uppercase; width:450px; border: 1px solid #C0C0C0"/>
  </td>
</tr>
<tr height="24"> 
  <td align="right">Belanja</td>
  <td align="center">:</td>
  <td>
  <input name="fDAT" id="fDAT" type="text" value="<?=$mRo[7]?>" readonly style="padding-left:5px; width:100px; border: 1px solid #C0C0C0"/>
  <input name="dDAT" id="dDAT" type="text" value="<?=$mRo[8]?>" readonly style="padding-left:5px; text-transform:uppercase; width:450px; border: 1px solid #C0C0C0"/>
  </td>
</tr>
</table>
<br>
<table width="800" border="0" align="center" style="font-weight:bold">
<tr> 
  <td width="30">&nbsp;</td>
  <td>:: PROGRAM KEGIATAN BARU :<input type="hidden" name="fSKP<?=$IdT?>" id="fSKP<?=$IdT?>" value="<?=$mRo[9]?>" readonly style="padding-left:5px; width:50px; border: 1px solid #C0C0C0"/></td>
</tr>
</table>
<table width="800" border="0" align="center" style="border-collapse:collapse">
<tr> 
  <td width="114">&nbsp;</td>
  <td width="20">&nbsp;</td>
  <td>
 <div id="progDiv0Cri<?=$IdT?>" class="find0CriProgKeg">
	<div id="progDiv1Cri<?=$IdT?>" class="find1CriProgKeg"></div>
	<div id="progDiv2Cri<?=$IdT?>" class="find2CriProgKeg"></div>
 </div>  </td>
</tr>
<tr height="25">
 <td class="ar">PROGRAM</td>
 <td align="center">:</td>
 <td>
 <input name="fPRG<?=$IdT?>" id="fPRG<?=$IdT?>" type="text" value="" readonly style="padding-left:5px; width:100px; border: 1px solid #C0C0C0"/>
 <input name="dPRG<?=$IdT?>" id="dPRG<?=$IdT?>" type="text" value="" onClick="showProKg('','Prog','<?=$IdT?>','<?=$IdL?>')" onkeypress="if (event.keyCode==13) {showProKg('find','Prog','<?=$IdT?>','<?=$IdL?>'); return false;} else if (event.keyCode==27) {closeCLICK('prog'); return false;}" style="padding-left:5px; text-transform:uppercase; width:450px; border: 1px solid #C0C0C0"/> </td>
 </tr>
<tr height="25">
 <td class="ar">KEGIATAN</td>
 <td align="center">:</td>
 <td>
 <input name="fKEG<?=$IdT?>" id="fKEG<?=$IdT?>" type="text" value="" readonly style="padding-left:5px; width:100px; border: 1px solid #C0C0C0"/>
 <input name="dKEG<?=$IdT?>" id="dKEG<?=$IdT?>" type="text" value="" onClick="showProKg('','Kegi','<?=$IdT?>','<?=$IdL?>')" onkeypress="if (event.keyCode==13) {showProKg('find','Kegi','<?=$IdT?>','<?=$IdL?>'); return false;} else if (event.keyCode==27) {closeCLICK('kegi'); return false;}" style="padding-left:5px; text-transform:uppercase; width:450px; border: 1px solid #C0C0C0"/></td>
 </tr>
<tr height="25">
 <td class="ar">SUB KEGIATAN</td>
 <td align="center">:</td>
 <td>
 <input name="fSUB<?=$IdT?>" id="fSUB<?=$IdT?>" type="text" value="" readonly style="padding-left:5px; width:100px; border: 1px solid #C0C0C0"/>
 <input name="dSUB<?=$IdT?>" id="dSUB<?=$IdT?>" type="text" value="" onClick="showProKg('','Subk','<?=$IdT?>','<?=$IdL?>')" onkeypress="if (event.keyCode==13) {showProKg('find','Subk','<?=$IdT?>','<?=$IdL?>'); return false;} else if (event.keyCode==27) {closeCLICK('subk'); return false;}" style="padding-left:5px; text-transform:uppercase; width:450px; border: 1px solid #C0C0C0"/> </td>
 </tr>
<tr height="25">
 <td class="ar">BELANJA</td>
 <td align="center">:</td>
 <td>
 <input name="fREK<?=$IdT?>" id="fREK<?=$IdT?>" type="text" value="" readonly style="padding-left:5px; width:100px; border: 1px solid #C0C0C0"/>
 <input name="dREK<?=$IdT?>" id="dREK<?=$IdT?>" type="text" value="" onClick="showProKg('','Rekn','<?=$IdT?>','<?=$IdL?>')" onkeypress="if (event.keyCode==13) {showProKg('find','Rekn','<?=$IdT?>','<?=$IdL?>'); return false;} else if (event.keyCode==27) {closeCLICK('subk'); return false;}" style="padding-left:5px; text-transform:uppercase; width:450px; border: 1px solid #C0C0C0"/> </td>
 </tr>
<tr height="25">
  <td class="ar">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr height="25">
  <td class="ar">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td><input type="button" name="B394" value="Save" onclick="saveDATA('<?=$IdT?>','<?=$IdL?>')" style="width: 70px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
</tr>
<tr height="25">
  <td class="ar">&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
