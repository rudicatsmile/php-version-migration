<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
$gRef = fGlobal("Referensi","ta_rkpbmd","IDO",$mID,"=","","");
?>
<table border="0" width="100%" height="325" class="table-list" cellspacing="0" cellpadding="0" align="center">
  <tr height="20" style="background:#999999; color:#fff; font-weight:bold">
  <td style="border-bottom:1px dotted #999; border-right:1px solid #999">REKENING</td>
  <td style="border-bottom:1px dotted #999; border-right:1px solid #999">NAMA REKENING</td>
  <td style="border-bottom:1px dotted #999; border-right:1px solid #999">DESKRIPSI</td>
  <td style="border-bottom:1px dotted #999; border-right:1px solid #999">LOKASI</td>
  <td style="border-bottom:1px dotted #999; border-right:1px solid #999">QTY</td>
  <td style="border-bottom:1px dotted #999; border-right:1px solid #999">SATUAN</td>
  <td style="border-bottom:1px dotted #999; border-right:1px solid #999">HARGA</td>
  <td style="border-bottom:1px dotted #999; border-right:1px solid #999">TOTAL</td>
  <td style="border-bottom:1px dotted #999; border-right:0px solid #999">ACTION</td>
  </tr>
<?php
$iG=1;
$rTTL = 0;
$nSQ = "SELECT IDO,
Rekening,
Nm_Rekening,
Deskripsi,
Lokasi,
Qty,
Satuan,
Harga,
Jumlah 
FROM ta_rkpbmd_rinci WHERE Referensi='$gRef' ORDER BY IDO";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$rID=$mRo[0];
	?>
	<tr height="25">
		<td style="border-bottom:1px dotted #999; border-right:1px solid #999">
		<input name="fReF<?=$mID?>" id="fReF<?=$mID?>" type="text" value="<?=$mRo[1]?>" readonly style="border-radius: 0px; padding-left:5px; width:65px; border: 0px solid #C0C0C0; <?=TxBckCLR($iG)?>"/>
		</td>
		<td style="border-bottom:1px dotted #999; border-right:1px solid #999">
		<input name="fReF<?=$mID?>2" id="fReF<?=$mID?>2" type="text" value="<?=$mRo[2]?>" readonly style="border-radius: 0px; padding-left:5px; width:235px; border: 0px solid #C0C0C0; <?=TxBckCLR($iG)?>"/>
		</td>
		<td style="border-bottom:1px dotted #999; border-right:1px solid #999">
		<input name="fReF<?=$mID?>" id="fReF<?=$mID?>" type="text" value="<?=$mRo[3]?>" title="Tekan ENTER untuk menyimpan.." onkeypress="if (event.keyCode==13) {saveRECO(this,'Desk','','<?=$rID?>','<?=$mID?>','<?=$IdL?>'); return false;}" style="border-radius: 0px; padding-left:5px; width:200px; border: 0px solid #C0C0C0; <?=TxBckCLR($iG)?>"/>
		</td>
		<td style="border-bottom:1px dotted #999; border-right:1px solid #999">
		<input name="fReF<?=$mID?>" id="fReF<?=$mID?>" type="text" value="<?=$mRo[4]?>" onkeypress="if (event.keyCode==13) {saveRECO(this,'Loka','','<?=$rID?>','<?=$mID?>','<?=$IdL?>'); return false;}" style="border-radius: 0px; padding-left:5px; width:110px; border: 0px solid #C0C0C0; <?=TxBckCLR($iG)?>"/>
		</td>
		<td style="border-bottom:1px dotted #999; border-right:1px solid #999">
		<input name="fReF<?=$mID?>" id="fReF<?=$mID?>" type="text" value="<?=$mRo[5]?>" onkeypress="if (event.keyCode==13) {saveRECO(this,'Qty','','<?=$rID?>','<?=$mID?>','<?=$IdL?>'); return false;}" style="border-radius: 0px; text-align:center; width:60px; border: 0px solid #C0C0C0; <?=TxBckCLR($iG)?>"/>
		</td>
		<td style="border-bottom:1px dotted #999; border-right:1px solid #999">
		<input name="fReF<?=$mID?>" id="fReF<?=$mID?>" type="text" value="<?=$mRo[6]?>" onkeypress="if (event.keyCode==13) {saveRECO(this,'Satu','','<?=$rID?>','<?=$mID?>','<?=$IdL?>'); return false;}" style="border-radius: 0px; padding-left:5px; width:100px; border: 0px solid #C0C0C0; <?=TxBckCLR($iG)?>"/>
		</td>
		<td style="border-bottom:1px dotted #999; border-right:1px solid #999">
		<input name="fReF<?=$mID?>" id="fReF<?=$mID?>" type="text" value="<?=fConvertToRupiah($mRo[7])?>" onkeypress="if (event.keyCode==13) {saveRECO(this,'Harga','','<?=$rID?>','<?=$mID?>','<?=$IdL?>'); return false;}" style="text-align:right; border-radius: 0px; padding-right:2px; width:100px; border: 0px solid #C0C0C0; <?=TxBckCLR($iG)?>"/>
		</td>
		<td style="border-bottom:1px dotted #999; border-right:1px solid #999">
		<input name="fReF<?=$mID?>" id="fReF<?=$mID?>" type="text" value="<?=fConvertToRupiah($mRo[8])?>" readonly style="text-align:right; border-radius: 0px; padding-right:2px; width:100px; border: 0px solid #C0C0C0; <?=TxBckCLR($iG)?>"/>
		</td>
		<td style="border-bottom:1px dotted #999; border-right:0px solid #999; text-align:center">
		<a href="#" onClick="P_RemItemRekn('<?=$rID?>','<?=$mID?>','<?=$IdL?>'); return false" class="ico dele">&nbsp;remove</a>  </td>
	</tr>
	<?php
	$rTTL = $rTTL+$mRo[8];
	$iG++;
}
?>
  <tr>
  <td style="border-bottom:1px dotted #999; border-right:1px solid #999">&nbsp;</td>
  <td style="border-bottom:1px dotted #999; border-right:1px solid #999">&nbsp;</td>
  <td style="border-bottom:1px dotted #999; border-right:1px solid #999">&nbsp;</td>
  <td style="border-bottom:1px dotted #999; border-right:1px solid #999">&nbsp;</td>
  <td style="border-bottom:1px dotted #999; border-right:1px solid #999">&nbsp;</td>
  <td style="border-bottom:1px dotted #999; border-right:1px solid #999">&nbsp;</td>
  <td style="border-bottom:1px dotted #999; border-right:1px solid #999">&nbsp;</td>
  <td style="border-bottom:1px dotted #999; border-right:1px solid #999">&nbsp;</td>
  <td style="border-bottom:1px dotted #999; border-right:0px solid #999">&nbsp;</td>
  </tr>
  <tr height="100%">
  <td width="72" style="border-bottom:1px dotted #999; border-right:1px solid #999">&nbsp;</td>
  <td style="border-bottom:1px dotted #999; border-right:1px solid #999">&nbsp;</td>
  <td width="200" style="border-bottom:1px dotted #999; border-right:1px solid #999">&nbsp;</td>
  <td width="100" style="border-bottom:1px dotted #999; border-right:1px solid #999">&nbsp;</td>
  <td width="65" style="border-bottom:1px dotted #999; border-right:1px solid #999">&nbsp;</td>
  <td width="100" style="border-bottom:1px dotted #999; border-right:1px solid #999">&nbsp;</td>
  <td width="100" style="border-bottom:1px dotted #999; border-right:1px solid #999">&nbsp;</td>
  <td width="100" style="border-bottom:1px dotted #999; border-right:1px solid #999">&nbsp;</td>
  <td width="80" style="border-bottom:1px dotted #999; border-right:0px solid #999">&nbsp;</td>
  </tr>
  <tr height="20">
  <td colspan="2" style="border-bottom:1px dotted #999; border-right:1px solid #999">
  <a href="#" onClick="P_AddItemRekn('','<?=$mID?>','<?=$IdL?>'); return false" class="ico add">&nbsp;Tambah Rekening</a></td>
  <td colspan="5" style="border-bottom:1px dotted #999; border-right:1px solid #999; text-align:center; font-weight:bold">T O T A L</td>
  <td style="border-bottom:1px dotted #999; border-right:1px solid #999; text-align:right; font-weight:bold; padding-right:2px"><?=fConvertToRupiah($rTTL)?></td>
  <td style="border-bottom:1px dotted #999; border-right:0px solid #999">&nbsp;</td>
  </tr>
</table>
<script languange="javascript">
	//P_Next('<?=$MsG?>','<?=$IdL?>');
</script>