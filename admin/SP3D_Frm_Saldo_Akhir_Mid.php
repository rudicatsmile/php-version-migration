<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
#echo $IdT;
#return false;
#echo $Lev."<br>";
#echo $fKdM;

$NmR = "";
if ($IdT){
	$nSQ = "SELECT Kd_UPB, KdSesi, KdJenis, Tahun 
	FROM ta_sp3d WHERE IDT='".$IdT."'";
	$nRs = mysql_query($nSQ);
	$mRo = mysql_fetch_array($nRs);
	$KdU = $mRo[0];
	$KdS = $mRo[1];
	$KdJ = $mRo[2];
	$ThN = $mRo[3];
	
	$fSLD = fGlobal("Nilai","ta_sp3d_saldo_akhir","Kd_UPB:KdJenis:KdTahap:Tahun",$KdU.":".$KdJ.":".$KdS.":".$ThN,"=:=:=:=","","");
	$fBan = fGlobal("KasBank","ta_sp3d_saldo_akhir","Kd_UPB:KdJenis:KdTahap:Tahun",$KdU.":".$KdJ.":".$KdS.":".$ThN,"=:=:=:=","","");
	$fBen = fGlobal("KasBendahara","ta_sp3d_saldo_akhir","Kd_UPB:KdJenis:KdTahap:Tahun",$KdU.":".$KdJ.":".$KdS.":".$ThN,"=:=:=:=","","");
}

?>
<table border="0" width="600" height="23" cellspacing="0" cellpadding="0" align="center">
  <tr height="25">
    <td width="250">&nbsp;</td>
    <td width="26"></td>
    <td width="454"></td>
  </tr>
  
  <tr height="30">
    <td class="ar">Saldo Akhir</td>
    <td class="ac">:</td>
    <td><input name="fSLD" id="fSLD" type="text" value="<?=fConvertToRupiah($fSLD)?>" readonly style="width:120px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px; background:#ccc"/></td>
  </tr>
  <tr height="30">
    <td class="ar">Posisi Kas di Bank</td>
    <td class="ac">:</td>
    <td>
	<input name="fBan" id="fBan" type="text" value="<?=fConvertToRupiah($fBan)?>" 
	onKeyUp="addSeparatorNum(this)" 
	onkeypress="if (event.keyCode==13){saveSALDO('<?=$IdT?>','<?=$IdL?>'); return false;}"	
	style="width:120px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/></td>
  </tr>
  <tr height="30">
    <td class="ar">Posisi Kas di Bendahara Pengeluaran</td>
    <td class="ac">:</td>
    <td>
	<input name="fBen" id="fBen" type="text" value="<?=fConvertToRupiah($fBen)?>" 
	onKeyUp="addSeparatorNum(this)" 
	onkeypress="if (event.keyCode==13){saveSALDO('<?=$IdT?>','<?=$IdL?>'); return false;}"	
	style="width:120px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/></td>
  </tr>
  
  
  <tr>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td><input type="button" name="B1" value="SAVE" onclick="saveSALDO('<?=$IdT?>','<?=$IdL?>')" style="width: 80px; height: 21px" /></td>
  </tr>
  <tr height="25">
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<script languange="javascript">
$("#fNmR").focus();
</script>