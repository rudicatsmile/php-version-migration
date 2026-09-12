<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
#echo $NeR;
if ($IdT)
{
	$nSQ = "SELECT 
	Kd_UPB as A0,
	Kd_REK as A1,
	Referensi as A2,
	Nomor as A3,
	Tanggal as A4,
	Uraian as A5,
	Execute as A6,
	KeRekening as A7,
	ExePencatat as A8,
	ExeRecorded as A9,
	KeReferensi as A10,
	KeRegister as A11 
	FROM ta_kib_kdptoaset WHERE IDT='".$IdT."'";
	$nRs = mysql_query($nSQ); 
	$mRo = mysql_fetch_array($nRs); 
	$rUpb = $mRo[0]; 
	$rRin = $mRo[1];
	$rRef = $mRo[2];
	$rNom = $mRo[3];
	$rTgl = $mRo[4];
	$rMem = $mRo[5];
	$rXec = $mRo[6];
	$kRef = $mRo[10]; 

	$rMut = fGlobalNEW("IDT","ta_usulan_rinci_108","Ref_Aset:Kd_Upb",$kRef.":".$rUpb,"=:=","",DatabaseSB,$ConSB,"");
	
	$rInd = fGlobalNEW("Ref_Aset","ta_kib_kdptoaset_data","Referensi:Induk",$rRef.":Y","=:=","",DatabaseSB,$ConSB,"");
	$rPer = fGlobalNEW("Tgl_Perolehan","ta_kib_kdptoaset_data","Referensi:Induk",$rRef.":Y","=:=","",DatabaseSB,$ConSB,"");
	$rNil = fGlobalNEW("Nilai","ta_kib_kdptoaset_data","Referensi:Induk",$rRef.":Y","=:=","",DatabaseSB,$ConSB,"");
	$rTot = fGlobalNEW("ifnull(sum(Nilai),0)","ta_kib_kdptoaset_data_post","Referensi",$rRef,"=","",DatabaseSB,$ConSB,"");
	
	$tObj = substr($mRo[7],0,8);
	$dObj = fGlobalNEW("Nm_Aset","ref_rek_aset108_4","Kd_Aset",$tObj,"=","",DatabaseSB,$ConSB,"");
	
	$tRio = substr($mRo[7],0,11);
	$dRio = fGlobalNEW("Nm_Aset","ref_rek_aset108_5","Kd_Aset",$tRio,"=","",DatabaseSB,$ConSB,"");
	
	$tSub = substr($mRo[7],0,14);
	$dSub = fGlobalNEW("Nm_Aset","ref_rek_aset108_6","Kd_Aset",$tSub,"=","",DatabaseSB,$ConSB,"");
	
	$tSu2 = $mRo[7];
	$dSu2 = fGlobalNEW("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$tSu2,"=","",DatabaseSB,$ConSB,"");
	
	$PctKe = $mRo[8];
	$RecKe = $mRo[9];
	$RefKe = $mRo[10];
	$RegKe = $mRo[11];
	
	$fNmA  = fGlobalNEW("Nm_Aset","ta_kib_108","Ref_KdpToAset",$rRef,"=","",DatabaseSB,$ConSB,"");
	#echo $mRo[1];
}

$dUpb = fGlobalNEW("Nm_UPB","ref_upb","Kd_UPB",$rUpb,"=","",DatabaseSB,$ConSB,"");
$dRin = fGlobalNEW("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$rRin,"=","",DatabaseSB,$ConSB,"");

?>
<table border="0" width="600" height="25" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="10">&nbsp;</td>
    <td width="91">&nbsp;</td>
    <td width="25">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td class="ar">Referensi</td>
    <td class="ac">:
	<div id="reknMstDiv0" class="finddata0GNR"> 
		<div id="reknMstDiv1" class="finddata1GNR"></div> 
		<div id="reknMstDiv2" class="finddata2GNR"></div> 
	</div>	</td>
    <td colspan="5">
	<input name="rRef" id="rRef" type="text" value="<?=$rRef?>" readonly style="padding-left:5px; height:15px; width:110px; border: 1px solid #C0C0C0"/>	</td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td class="ar">Tanggal</td>
    <td class="ac">:</td>
    <td><input name="rTgl" id="rTgl" type="text" value="<?=$rTgl?>" readonly style="padding-left:5px; height:15px; width:110px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Nomor</td>
    <td class="ac">:</td>
    <td colspan="2"><input name="rNom" id="rNom" type="text" value="<?=$rNom?>" readonly style="padding-left:5px; height:15px; width:110px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td class="ar">UPB</td>
    <td class="ac">:</td>
    <td colspan="5">
	<input name="rUpb" id="rUpb" type="hidden" value="<?=$rUpb?>" readonly style="padding-left:5px; height:15px; width:100px; border: 1px solid #C0C0C0"/>
	<input name="dUpb" id="dUpb" type="text" value="<?=$dUpb?>" readonly style="padding-left:5px; height:15px; width:330px; border: 1px solid #C0C0C0"/>	</td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td class="ar">Rekening</td>
    <td class="ac">:</td>
    <td colspan="5">
	<input name="rRin" id="rRin" type="hidden" value="<?=$rRin?>" readonly style="padding-left:5px; height:15px; width:100px; border: 1px solid #C0C0C0"/>
	<input name="dRin" id="dRin" type="text" value="<?=$dRin?>" readonly style="padding-left:5px; height:15px; width:330px; border: 1px solid #C0C0C0"/>	</td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td class="ar">Induk Aset</td>
    <td class="ac">:</td>
    <td width="122"><input name="rInd" id="rInd" type="text" value="<?=$rInd?>" readonly style="padding-left:5px; height:15px; width:110px; border: 1px solid #C0C0C0"/></td>
    <td width="78" class="ar">Nilai</td>
    <td width="20" class="ac">:</td>
    <td colspan="2"><input name="rNil" id="rNil" type="text" value="<?=fConvertToRupiah($rTot)?>" readonly style="text-align:right; padding-right:5px; height:15px; width:110px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td class="ar">Tgl. Perolehan</td>
    <td class="ac">:</td>
    <td><input name="rPer" id="rPer" type="text" value="<?=$rPer?>" readonly style="padding-left:5px; height:15px; width:110px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Nilai Total </td>
    <td class="ac">:</td>
    <td colspan="2"><input name="rTot" id="rTot" type="text" value="<?=fConvertToRupiah($rTot)?>" readonly style="text-align:right; padding-right:5px; height:15px; width:110px; border: 1px solid #C0C0C0"/></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td class="ar">Objek</td>
    <td class="ac">:</td>
    <td colspan="5">
	<input name="tObj" id="tObj" type="hidden" value="<?=$tObj?>" readonly style="padding-left:5px; height:15px; width:100px; border: 1px solid #C0C0C0"/>
	<input name="dObj" id="dObj" type="text" value="<?=$dObj?>" readonly style="padding-left:5px; height:15px; width:307px; border: 1px solid #C0C0C0"/>
	<input type="button" name="B99" value="..." onclick="reknFIND('','rekn','4','<?=$rXec?>','<?=$IdL?>'); return false;" style="width:20px; height:19px" />	</td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td class="ar">Rincian Objek </td>
    <td class="ac">:</td>
    <td colspan="4">
	<input name="tRio" id="tRio" type="hidden" value="<?=$tRio?>" readonly style="padding-left:5px; height:15px; width:100px; border: 1px solid #C0C0C0"/>
	<input name="dRio" id="dRio" type="text" value="<?=$dRio?>" readonly style="padding-left:5px; height:15px; width:307px; border: 1px solid #C0C0C0"/>
	<input type="button" name="B992" value="..." onclick="reknFIND('','rekn','5','<?=$rXec?>','<?=$IdL?>'); return false;" style="width:20px; height:19px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td class="ar">Sub RO </td>
    <td class="ac">:</td>
    <td colspan="4">
	<input name="tSub" id="tSub" type="hidden" value="<?=$tSub?>" readonly style="padding-left:5px; height:15px; width:100px; border: 1px solid #C0C0C0"/>
	<input name="dSub" id="dSub" type="text" value="<?=$dSub?>" readonly style="padding-left:5px; height:15px; width:307px; border: 1px solid #C0C0C0"/>
	<input type="button" name="B993" value="..." onclick="reknFIND('','rekn','6','<?=$rXec?>','<?=$IdL?>'); return false;" style="width:20px; height:19px" /></td>
    <td rowspan="2" valign="bottom"><input type="button" name="B99" value="PROSES" <? if ($rXec=='Y'){echo 'disabled';}?> onclick="prosToAsetSave('<?=$IdT?>','<?=$CrDiv?>','<?=$IdL?>')" style="width:95px; height:41px<? if ($rXec=='N'){echo "; color:#0000ff";}?>" /></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td class="ar">Sub-Sub RO </td>
    <td class="ac">:</td>
    <td colspan="4">
	<input name="tSu2" id="tSu2" type="hidden" value="<?=$tSu2?>" readonly style="padding-left:5px; height:15px; width:100px; border: 1px solid #C0C0C0"/>
	<input name="dSu2" id="dSu2" type="text" value="<?=$dSu2?>" readonly style="padding-left:5px; height:15px; width:307px; border: 1px solid #C0C0C0"/>
	<input type="button" name="B994" value="..." onclick="reknFIND('','rekn','7','<?=$rXec?>','<?=$IdL?>'); return false;" style="width:20px; height:19px" /></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td class="ar">Nama Aset </td>
    <td class="ac">&nbsp;</td>
    <td colspan="4"><input name="fNmA" id="fNmA" type="text" value="<?=$fNmA?>" placeholder='Input nama detail aset disini...!!' style="padding-left:5px; height:15px; width:330px; border: 1px solid #C0C0C0; background:#CCFFFF"/></td>
    <td width="121" rowspan="3" valign="top" style="padding-top:4px"><input type="button" name="B99" value="BATALKAN" <? if ($rXec=='N' || $rMut!=''){echo "disabled";}?> onclick="prosToAsetBatal('<?=$IdT?>','<?=$CrDiv?>','<?=$IdL?>')" style="width:95px; height:41px " /></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td class="ar">Ke Referensi </td>
    <td class="ac">:</td>
    <td><input name="RefKe" id="RefKe" type="text" value="<?=$RefKe?>" readonly style="padding-left:5px; height:15px; width:110px; border: 1px solid #C0C0C0; color:#0000FF"/></td>
    <td class="ar">Ke Register</td>
    <td class="ac">:</td>
    <td width="133"><input name="RegKe" id="RegKe" type="text" value="<?=$RegKe?>" readonly style="padding-left:5px; height:15px; width:110px; border: 1px solid #C0C0C0; color:#0000FF"/></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td class="ar">Pencatat</td>
    <td class="ac">:</td>
    <td><input name="PctKe" id="PctKe" type="text" value="<?=$PctKe?>" readonly="readonly" style="padding-left:5px; height:15px; width:110px; border: 1px solid #C0C0C0; color:#0000FF"/></td>
    <td class="ar">Recorded</td>
    <td class="ac">:</td>
    <td><input name="RecKe" id="RecKe" type="text" value="<?=$RecKe?>" readonly="readonly" style="padding-left:5px; height:15px; width:110px; border: 1px solid #C0C0C0; color:#0000FF"/></td>
  </tr>
  <tr height="23">
    <td>&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td colspan="5">&nbsp;</td>
  </tr>
</table>
