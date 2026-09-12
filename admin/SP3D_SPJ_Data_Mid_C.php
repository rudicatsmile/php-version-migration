<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$cRef = 'AST.'.fGetDate('year').'.XXXXXXXX';
$cTgL = fConvertDateShort(fGlobal("Tgl_BAST","ta_sp3d_spj","IDT",$rIdT,"=","",""));
if ($IdTR){
	$nSQ = "SELECT Referensi as A0, Nm_Aset as A1, Lokasi as A2, Bertingkat as A3, Beton as A4, Luas_Lantai as A5, 
	Keterangan as A6, Kd_Pemilik as A7, Kondisi as A8, Asal_Usul as A9, JmlSatuan as A10, Harga as A11, Total as A12 
	FROM ta_sp3d_spj_rinci WHERE IDT='".$IdTR."'";
	$nRs = mysql_query($nSQ);
	$mRo = mysql_fetch_array($nRs);
	$cRef = $mRo[0];
	$cNma = $mRo[1];
	
	$cLet = $mRo[2];
	$cTin = $mRo[3];
	$cBet = $mRo[4];
	$cLua = $mRo[5];
	
	$cKet = $mRo[6];
	$cMil = $mRo[7];
	$cKon = $mRo[8];
	$cAsa = $mRo[9];
	$cSat = $mRo[10];
	$cHrg = $mRo[11];
	$cTot = $mRo[12];
}

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
    <td>
	<input name="cRef" id="cRef" type="text" value="<?=$cRef?>" readonly style="width:115px; border: 1px solid #C0C0C0; background:#CCCCFF"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Tgl. Perolehan&nbsp;&nbsp;:&nbsp;&nbsp;<input name="cTgL" id="cTgL" type="text" value="<?=$cTgL?>" readonly style="width:80px; border: 1px solid #C0C0C0; background:#CCCCFF; text-align:center"/>	</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td class="ar">Nama Barang </td>
    <td class="ac">:</td>
    <td><input name="cNma" id="cNma" type="text" value="<?=$cNma?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Kepemilikan</td>
    <td class="ac">:</td>
    <td><select class="boxs" name="cMil" id="cMil" style="width:180px" tabindex="0">
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
				if ($mRo['Kd_Pemilik']==$cMil) 
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
    <td class="ar">Letak / Alamat </td>
    <td class="ac">:</td>
    <td><input name="cLet" id="cLet" type="text" value="<?=$cLet?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Asal Usul</td>
    <td class="ac">:</td>
    <td><select name="cAsa" id="cAsa" class="boxs" style="width:180px" tabindex="0">
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
				if ($mRo['Perolehan']==$cAsa) 
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
    <td><select class="boxs" name="cTin" id="cTin" style="width:170px" tabindex="0">
      <option value=""></option>
      <option <?php if ($cTin=="Bertingkat") {echo "selected";}?> value="Bertingkat">Bertingkat</option>
      <option <?php if ($cTin=="Tidak") {echo "selected";}?> value="Tidak">Tidak Bertingkat</option>
    </select>
      <select class="boxs" name="cBet" id="cBet" style="width:134px" tabindex="0">
        <option value=""></option>
        <option <?php if ($cBet=="Beton") {echo "selected";}?> value="Beton">Beton</option>
        <option <?php if ($cBet=="Tidak") {echo "selected";}?> value="Tidak">Bukan Beton</option>
      </select></td>
    <td class="ar">Kondisi</td>
    <td class="ac">:</td>
    <td><select class="boxs" name="cKon" id="cKon" style="width:180px" tabindex="0">
      <option value=""></option>
      <?php
		$nSQ = "SELECT * from ref_kondisi ORDER BY IDT";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			do
			{
				$sel ="";
				if ($mRo['Kode']==$cKon) 
				{
				$sel ="selected";
				$gKDS=$mRo['Kode'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kode'].'">'.$mRo['Kondisi'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
    </select></td>
  </tr>
  <tr height="25">
    <td class="ar">Luas Lantai </td>
    <td class="ac">:</td>
    <td><input name="cLua" id="cLua" type="text" value="<?=fConvertToRupiah($cLua)?>" style=" width:80px; border: 1px solid #C0C0C0; text-align:right; padding-right:3px"/>&nbsp;m<sup>2</sup></td>
    <td class="ar">Jumlah Satuan</td>
    <td class="ac">:</td>
    <td><input name="cSat" id="cSat" type="text" value="<?=fConvertToRupiahBulat($cSat)?>" onkeyup="addSeparatorNum(this)" style=" width:50px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/>      &nbsp;&nbsp;&nbsp;(<i> Jumlah bangunan </i>)</td>
  </tr>
  <tr height="25">
    <td class="ar">Keterangan</td>
    <td class="ac">:</td>
    <td rowspan="3">
	<textarea name="cKet" id="cKet" style="border: 1px solid #C0C0C0; height:65px; width:300px"><?=$cKet?></textarea></td>
    <td class="ar">Harga Satuan (Rp)</td>
    <td class="ac">:</td>
    <td><input name="cHrg" id="cHrg" type="text" value="<?=fConvertToRupiah($cHrg)?>" onkeyup="addSeparatorNum(this)" style=" width:100px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/>      &nbsp;&nbsp;&nbsp;(<i> Harga per bangunan</i> )</td>
  </tr>
  <tr height="25">
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td class="ar">Total Harga (Rp)</td>
    <td class="ac">:</td>
    <td><input name="cTot" id="cTot" type="text" value="<?=fConvertToRupiah($cTot)?>" readonly="readonly" style=" width:100px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/></td>
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
    <td>
	<input type="button" name="B39" <?=$DisA?> value="SAVE" onclick="SaveMidASET('C','<?=$IdTR?>','<?=$rIdT?>','<?=$rCek?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
    <input type="button" name="B393" <?=$DisA?> value="RESET" onclick="ResetMidASET('C','<?=$rIdT?>','<?=$IdL?>')" style="width: 80px; height: 21px" /></td>
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
