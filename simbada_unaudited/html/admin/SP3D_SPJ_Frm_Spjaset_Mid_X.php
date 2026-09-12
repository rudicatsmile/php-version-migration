<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
#echo $rIdT;
#$eUPB = fGlobal("Kd_UPB","ta_sp3d_spj","IDT",$rIdT,"=","","");


?>
<table border="0" width="1000" height="23" cellspacing="0" cellpadding="0" align="center">
  <tr height="30">
    <td width="112">&nbsp;</td>
    <td width="24"></td>
    <td width="321"></td>
    <td width="123"></td>
    <td width="24"></td>
    <td width="396"></td>
  </tr>
  <tr height="25">
    <td class="ar">Referensi</td>
    <td class="ac">:</td>
    <td><input name="fNomKon22" id="fNomKon22" type="text" value="<?=$eUN3?>" style=" width:100px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td class="ar">Nama Barang </td>
    <td class="ac">:</td>
    <td><input name="fNomKon2" id="fNomKon2" type="text" value="<?=$eUN3?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Kepemilikan</td>
    <td class="ac">:</td>
    <td><select class="boxs" name="fMilik" style="width: 150px" tabindex="0">
      <option value=""></option>
      <?
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
				if ($mRo['Kd_Pemilik']==$gMLK) 
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
    <td class="ar">Lokasi</td>
    <td class="ac">:</td>
    <td><input name="fNomKon25" id="fNomKon25" type="text" value="<?=$eUN3?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Asal Usul</td>
    <td class="ac">:</td>
    <td><select name="fAsalUsul" class="boxs" style="width: 150px" tabindex="0">
      <option value=""></option>
      <?
		$nSQ = "SELECT * FROM ref_perolehan ORDER BY IDT";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			do
			{
				$sel ="";
				if ($mRo['Perolehan']==$gAUS) 
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
    <td class="ar">Kontruksi</td>
    <td class="ac">:</td>
    <td><input name="fNomKon252" id="fNomKon252" type="text" value="<?=$eUN3?>" style=" width:300px; border: 1px solid #C0C0C0"/>	  </td>
    <td class="ar">Jumlah Satuan</td>
    <td class="ac">:</td>
    <td><input name="fNomKon62" id="fNomKon62" type="text" value="<?=fConvertToRupiahBulat($eNIL)?>" style=" width:60px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/>&nbsp;&nbsp;&nbsp;(<i>Jumlah item / bidang tanah</i>)</td>
  </tr>
  <tr height="25">
    <td class="ar">Panjang</td>
    <td class="ac">:</td>
    <td>
	<input name="fNomKon26" id="fNomKon26" type="text" value="<?=$eUN3?>" style=" width:50px; border: 1px solid #C0C0C0; text-align:center"/>
      &nbsp;km&nbsp;&nbsp;&nbsp;Lebar 
      <input name="fNomKon262" id="fNomKon262" type="text" value="<?=$eUN3?>" style=" width:50px; border: 1px solid #C0C0C0; text-align:center"/>&nbsp;m&nbsp;&nbsp;&nbsp;
      Luas&nbsp;&nbsp;
      <input name="fNomKon263" id="fNomKon263" type="text" value="<?=$eUN3?>" style=" width:50px; border: 1px solid #C0C0C0; text-align:center"/>&nbsp;m<sup>2</sup>	</td>
    <td class="ar">Harga Satuan (Rp)</td>
    <td class="ac">:</td>
    <td><input name="fNomKon63" id="fNomKon63" type="text" value="<?=fConvertToRupiah($eNIL)?>" style=" width:90px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/>&nbsp;&nbsp;&nbsp;(<i>(Harga per item / bidang tanah</i>)</td>
  </tr>
  <tr height="25">
    <td class="ar">Keterangan</td>
    <td class="ac">:</td>
    <td rowspan="3">
	<textarea name="fURA" style="border: 1px solid #C0C0C0; height:65px; width:300px"><?=$gURA?></textarea></td>
    <td class="ar">Total Harga (Rp)</td>
    <td class="ac">:</td>
    <td><input name="fNomKon64" id="fNomKon64" type="text" value="<?=fConvertToRupiah($eNIL)?>" readonly="readonly" style=" width:90px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/></td>
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
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td><input type="button" name="B39" <?=$DisA?> value="SAVE" onclick="SaveMid('<?=$eIdT?>','<?=$rCek?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
    <input type="button" name="B392" <?=$DisA?> value="CLOSE" onclick="closeCLICK('spj'); return false" style="width: 80px; height: 21px" /></td>
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
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
