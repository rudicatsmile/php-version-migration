<?
require('Connection.php');
require('FileFunction.php');
//require("CheckLogin.php");
extract($_GET);
#echo $Ref."<br>";
#echo $IdT."<br>";
#echo $IdL;
$TglRe = fGlobal("Tgl_Cair","ta_pengadaan","IDT",$IdT,"=","",""); 
if ($TglRe!='')
{
	$TglRe = explode('-',$TglRe);
	$fRc = $TglRe[0];
	$fRb = $TglRe[1];
	$fRa = $TglRe[2];
}
$NoBKU = fGlobal("No_BKU","ta_pengadaan","IDT",$IdT,"=","",""); 
$Nilai = fGlobal("JmlPencairan","ta_pengadaan","IDT",$IdT,"=","",""); 

?>
<table align="center" class="table-form" cellpadding="0" cellspacing="0" width="450px" border="0"> 
<tr height="25">
	<td width="105">&nbsp;</td>
	<td width="24">&nbsp;</td>
	<td width="220">&nbsp;</td>
	<td width="26">&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr height="25">
	<td class="ar">Tgl. Pencairan</td>
	<td class="ac">:</td>
	<td class="al">
        <select name="fRa" id="fRa" style="width:50px" tabindex="1"> 
        <option value="00"></option>
		<? 
        for ($iG=1; $iG<=31; $iG++) 
        { 
            if ($fRa==$iG) {$gSL="selected"; $z01a=$iG;} else {$gSL="";} 
            echo "<option value='$iG' $gSL>".$iG."</option>"; 
        } 
        ?> 
        </select> 
        <select name="fRb" id="fRb" style="width:94px" tabindex="1"> 
        <option value="00"></option>
        <? 
        for ($iG=1; $iG<=12; $iG++) 
        { 
            if ($fRb==$iG) {$gSL="selected"; $z01b=$iG;} else {$gSL="";} 
            echo "<option value='$iG' $gSL>".fNmBulan($iG)."</option>"; 
        } 
        ?> 
        </select> 
        <select name="fRc" id="fRc" style="width:63px" tabindex="1"> 
        <option value="0000"></option>
        <? 
        for ($iG=2020; $iG<=date('Y'); $iG++) 
        { 
            if ($fRc==$iG) {$gSL="selected"; $z01c=$iG;} else {$gSL="";} 
            echo "<option value='$iG' $gSL>".$iG."</option>"; 
        } 
        ?> 
        </select>	
	</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
</tr>
<tr height="25">
  <td class="ar">No. BKU </td>
  <td class="ac">:</td>
  <td class="al"><input type="text" name="fBK" id="fBK" value="<?=$NoBKU?>" style="width:203px; padding-left:5px" tabindex="1"/></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr height="25">
  <td class="ar">Nilai Pencairan</td>
  <td class="ac">:</td>
  <td class="al"><input type="text" name="fNI" id="fNI" value="<?=fConvertToRupiah($Nilai)?>" onkeyup="addSeparator(this)" style="width:120px; text-align:right; padding-right:7px" tabindex="1"/></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr height="25">
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<tr height="25">
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>
  <input type="button" name="BSave" id="BSave" value="S A V E" onclick="saveRECO('<?=$Ref?>','<?=$IdT?>','<?=$IdL?>')" style="width:70px; height:22px" tabindex="2" />
  <input type="button" name="BClos" id="BClos" value="CLOSE" onclick="$('#BGO').click(); dispBlockOrNo('rekoMstDiv0')" style="width:70px; height:22px" tabindex="2" />
  </td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
