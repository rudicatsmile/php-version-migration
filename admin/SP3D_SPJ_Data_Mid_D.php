<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$dRef = 'AST.'.fGetDate('year').'.XXXXXXXX';
$dTgL = fConvertDateShort(fGlobal("Tgl_BAST","ta_sp3d_spj","IDT",$rIdT,"=","",""));
if ($IdTR){
	$nSQ = "SELECT Referensi as A0, Nm_Aset as A1, 
	Lokasi as A2, Konstruksi as A3, Panjang as A4, Lebar as A5, Luas as A6, 
	Keterangan as A7, Kd_Pemilik as A8, Kondisi as A9, Asal_Usul as A10, JmlSatuan as A11, Harga as A12, Total as A13 
	FROM ta_sp3d_spj_rinci WHERE IDT='".$IdTR."'";
	$nRs = mysql_query($nSQ);
	$mRo = mysql_fetch_array($nRs);
	$dRef = $mRo[0];
	$dNma = $mRo[1];
	
	$dLok = $mRo[2];
	$dKot = $mRo[3];
	$dPan = $mRo[4];
	$dLeb = $mRo[5];
	$dLua = $mRo[6];
	
	$dKet = $mRo[7];
	$dMil = $mRo[8];
	$dKon = $mRo[9];
	$dAsa = $mRo[10];
	$dSat = $mRo[11];
	$dHrg = $mRo[12];
	$dTot = $mRo[13];
}

?>
<table border="0" width="1000" height="23" cellspacing="0" cellpadding="0" align="center">
  <tr height="20">
    <td width="112"></td>
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
	<input name="dRef" id="dRef" type="text" value="<?=$dRef?>" readonly style="width:115px; border: 1px solid #C0C0C0; background:#CCCCFF"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Tgl. Perolehan&nbsp;&nbsp;:&nbsp;&nbsp;<input name="dTgL" id="dTgL" type="text" value="<?=$dTgL?>" readonly style="width:80px; border: 1px solid #C0C0C0; background:#CCCCFF; text-align:center"/>	</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td class="ar">Nama Barang </td>
    <td class="ac">:</td>
    <td><input name="dNma" id="dNma" type="text" value="<?=$dNma?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Kepemilikan</td>
    <td class="ac">:</td>
    <td>
	<select class="boxs" name="dMil" id="dMil" style="width:180px" tabindex="0">
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
				if ($mRo['Kd_Pemilik']==$dMil) 
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
    <td><input name="dLok" id="dLok" type="text" value="<?=$dLok?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Asal Usul</td>
    <td class="ac">:</td>
    <td>
	<select name="dAsa" id="dAsa" class="boxs" style="width:180px" tabindex="0">
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
				if ($mRo['Perolehan']==$dAsa) 
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
    <td><input name="dKot" id="dKot" type="text" value="<?=$dKot?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Kondisi</td>
    <td class="ac">:</td>
    <td>
	<select class="boxs" name="dKon" id="dKon" style="width:180px" tabindex="0">
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
				if ($mRo['Kode']==$dKon) 
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
    <td class="ar">Panjang</td>
    <td class="ac">:</td>
    <td><input name="dPan" id="dPan" type="text" value="<?=fConvertToRupiah($dPan)?>" style="width:50px; border: 1px solid #C0C0C0; text-align:center"/>      &nbsp;km&nbsp;&nbsp;&nbsp;Lebar 
      <input name="dLeb" id="dLeb" type="text" value="<?=fConvertToRupiah($dLeb)?>" style="width:40px; border: 1px solid #C0C0C0; text-align:center"/>&nbsp;m&nbsp;&nbsp;&nbsp;
      Luas&nbsp;&nbsp;
    <input name="dLua" id="dLua" type="text" value="<?=fConvertToRupiah($dLua)?>" style="width:75px; border: 1px solid #C0C0C0; text-align:center"/>&nbsp;m<sup>2</sup></td><td class="ar">Jumlah Satuan</td>
    <td class="ac">:</td>
    <td><input name="dSat" id="dSat" type="text" value="<?=fConvertToRupiahBulat($dSat)?>" onkeyup="addSeparatorNum(this)" style="width:50px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/>      
      &nbsp;&nbsp;&nbsp;(<i> Jumlah item/ruas </i>)</td>
  </tr>
  <tr height="25">
    <td class="ar">Keterangan</td>
    <td class="ac">:</td>
    <td rowspan="4"><textarea name="dKet" id="dKet" style="border: 1px solid #C0C0C0; height:85px; width:300px"><?=$dKet?></textarea></td>
    <td class="ar">Harga Satuan (Rp)</td>
    <td class="ac">:</td>
    <td><input name="dHrg" id="dHrg" type="text" value="<?=fConvertToRupiah($dHrg)?>" onkeyup="addSeparatorNum(this)" style=" width:100px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/>      
      &nbsp;&nbsp;&nbsp;(<i> Harga per item/ruas </i>)</td>
  </tr>
  <tr height="25">
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td class="ar">Total Harga (Rp)</td>
    <td class="ac">:</td>
    <td><input name="dTot" id="dTot" type="text" value="<?=fConvertToRupiah($dTot)?>" readonly="readonly" style=" width:100px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/></td>
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
    <td>
	<input type="button" name="B39" <?=$DisA?> value="SAVE" onclick="SaveMidASET('D','<?=$IdTR?>','<?=$rIdT?>','<?=$rCek?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
    <input type="button" name="B393" <?=$DisA?> value="RESET" onclick="ResetMidASET('D','<?=$rIdT?>','<?=$IdL?>')" style="width: 80px; height: 21px" /></td>
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
