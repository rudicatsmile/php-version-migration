<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$aRef = 'AST.'.fGetDate('year').'.XXXXXXXX';
$aTgL = fConvertDateShort(fGlobal("Tgl_BAST","ta_sp3d_spj","IDT",$rIdT,"=","",""));
if ($IdTR){
	$nSQ = "SELECT Referensi, Nm_Aset, Alamat, Hak_Tanah, Penggunaan, Luas_M2, Keterangan, Kd_Pemilik, Asal_Usul, JmlSatuan, Harga, Total 
	FROM ta_sp3d_spj_rinci WHERE IDT='".$IdTR."'";
	$nRs = mysql_query($nSQ);
	$mRo = mysql_fetch_array($nRs);
	$aRef = $mRo[0];
	$aNma = $mRo[1];
	$aLet = $mRo[2];
	$aHak = $mRo[3];
	$aGun = $mRo[4];
	$aLua = $mRo[5];
	$aKet = $mRo[6];
	$aMil = $mRo[7];
	$aAsa = $mRo[8];
	$aSat = $mRo[9];
	$aHrg = $mRo[10];
	$aTot = $mRo[11];
}

?>
<table border="0" width="1000" height="23" cellspacing="0" cellpadding="0" align="center">
  <tr height="10">
    <td width="112">&nbsp;</td>
    <td width="19"></td>
    <td width="345"></td>
    <td width="113"></td>
    <td width="23"></td>
    <td></td>
  </tr>
  <tr height="25">
    <td class="ar">Referensi</td>
    <td class="ac">:</td>
    <td>
	<input name="aRef" id="aRef" type="text" value="<?=$aRef?>" readonly style="width:115px; border: 1px solid #C0C0C0; background:#CCCCFF"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Tgl. Perolehan&nbsp;&nbsp;:&nbsp;&nbsp;<input name="aTgL" id="aTgL" type="text" value="<?=$aTgL?>" readonly style="width:78px; border: 1px solid #C0C0C0; background:#CCCCFF; text-align:center"/>
	</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td class="ar">Nama Barang </td>
    <td class="ac">:</td>
    <td><input name="aNma" id="aNma" type="text" value="<?=$aNma?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Kepemilikan</td>
    <td class="ac">:</td>
    <td>
	<select class="boxs" name="aMil" id="aMil" style="width: 180px" tabindex="0">
	<option value=""></option>
      <?php
		$nSQ = "SELECT * from ref_pemilik ORDER BY Kd_Pemilik";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			//if ($gMLK=="") {$gMLK=$mRo['Kd_Pemilik'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Pemilik']==$aMil) 
				{
				$sel ="selected";
				$gMLK=$mRo['Kd_Pemilik'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Pemilik'].'">'.$mRo['Nm_Pemilik'].'</option>';
			}
			  while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
    </select></td>
  </tr>
  <tr height="25">
    <td class="ar">Letak Tanah </td>
    <td class="ac">:</td>
    <td><input name="aLet" id="aLet" type="text" value="<?=$aLet?>" style=" width:300px; border: 1px solid #C0C0C0"/>      &nbsp;&nbsp;&nbsp;</td>
    <td class="ar">Asal Usul</td>
    <td class="ac">:</td>
    <td>
	<select name="aAsa" id="aAsa" class="boxs" style="width: 180px" tabindex="0">
	<option value=""></option>
	<?php
		$nSQ = "SELECT * FROM ref_perolehan ORDER BY Perolehan";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			do
			{
				$sel ="";
				if ($mRo['Perolehan']==$aAsa) 
				{
				$sel ="selected";
				}
				echo '<option '.$sel.' value="'.$mRo['Perolehan'].'">'.$mRo['Perolehan'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
    </select></td>
  </tr>
  <tr height="25">
    <td class="ar">Hak Tanah </td>
    <td class="ac">:</td>
    <td><input name="aHak" id="aHak" type="text" value="<?=$aHak?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Jumlah Satuan</td>
    <td class="ac">:</td>
    <td><input name="aSat" id="aSat" type="text" value="<?=fConvertToRupiahBulat($aSat)?>" onKeyUp="addSeparatorNum(this)" style=" width:50px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/>
    &nbsp;&nbsp;&nbsp;(<i> Jumlah  bidang tanah </i>)</td>
  </tr>
  <tr height="25">
    <td class="ar">Penggunaan</td>
    <td class="ac">:</td>
    <td><input name="aGun" id="aGun" type="text" value="<?=$aGun?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Harga Satuan (Rp)</td>
    <td class="ac">:</td>
    <td><input name="aHrg" id="aHrg" type="text" value="<?=fConvertToRupiah($aHrg)?>" onKeyUp="addSeparatorNum(this)" style=" width:100px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/>
    &nbsp;&nbsp;&nbsp;(<i> Harga per  bidang tanah </i>)</td>
  </tr>
  <tr height="25">
    <td class="ar">Luas Tanah </td>
    <td class="ac">:</td>
    <td><input name="aLua" id="aLua" type="text" value="<?=fConvertToRupiah($aLua)?>" style=" width:80px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/>&nbsp;m<sup>2</sup></td>
    <td class="ar">Total Harga (Rp)</td>
    <td class="ac">:</td>
    <td><input name="aTot" id="aTot" type="text" value="<?=fConvertToRupiah($aTot)?>" readonly="readonly" style=" width:100px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/></td>
  </tr>
  <tr height="25">
    <td class="ar">Keterangan</td>
    <td class="ac">:</td>
    <td rowspan="3">
	<textarea name="aKet" id="aKet" style="border: 1px solid #C0C0C0; height:65px; width:300px"><?=$aKet?></textarea></td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td><input type="button" name="B39" <?=$DisA?> value="SAVE" onclick="SaveMidASET('A','<?=$IdTR?>','<?=$rIdT?>','<?=$rCek?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
      <input type="button" name="B393" <?=$DisA?> value="RESET" onclick="ResetMidASET('A','<?=$rIdT?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
      <input type="button" name="B392" <?=$DisA?> value="CLOSE" onclick="showASET('refr','<?=$rIdT?>','','<?=$IdL?>')" style="width: 80px; height: 21px" /></td>
  </tr>
  <tr height="25">
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td colspan="3" class="al" style="font-style:italic; color:#0000FF">&nbsp;&nbsp;** Tgl. Perolehan berasal dari Tgl. BAST Berkas</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
