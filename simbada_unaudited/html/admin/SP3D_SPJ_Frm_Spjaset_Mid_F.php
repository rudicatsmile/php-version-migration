<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$fRef = 'AST.'.fGetDate('year').'.XXXXXXXX';
$fTgL = fConvertDateShort(fGlobal("Tgl_BAST","ta_sp3d_spj","IDT",$rIdT,"=","",""));
if ($IdTR){
	$nSQ = "SELECT Referensi as A0, Nm_Aset as A1, 
	Lokasi as A2, Bertingkat as A3, Beton as A4, Panjang as A5, Lebar as A6, Luas as A7, 
	Keterangan as A8, Kd_Pemilik as A9, Asal_Usul as A10, JmlSatuan as A11, Harga as A12, Total as A13 
	FROM ta_sp3d_spj_rinci WHERE IDT='".$IdTR."'";
	$nRs = mysql_query($nSQ);
	$mRo = mysql_fetch_array($nRs);
	$fRef = $mRo[0];
	$fNma = $mRo[1];
	
	$fLok = $mRo[2];
	
	$fTin = $mRo[3];
	$fBet = $mRo[4];
	
	$fPan = $mRo[5];
	$fLeb = $mRo[6];
	$fLua = $mRo[7];
	
	$fKet = $mRo[8];
	$fMil = $mRo[9];
	$fAsa = $mRo[10];
	$fSat = $mRo[11];
	$fHrg = $mRo[12];
	$fTot = $mRo[13];
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
	<input name="fRef" id="fRef" type="text" value="<?=$fRef?>" readonly style="width:115px; border: 1px solid #C0C0C0; background:#CCCCFF"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Tgl. Perolehan&nbsp;&nbsp;:&nbsp;&nbsp;<input name="fTgL" id="fTgL" type="text" value="<?=$fTgL?>" readonly style="width:80px; border: 1px solid #C0C0C0; background:#CCCCFF; text-align:center"/>	</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td class="ar">Nama Barang </td>
    <td class="ac">:</td>
    <td><input name="fNma" id="fNma" type="text" value="<?=$fNma?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Kepemilikan</td>
    <td class="ac">:</td>
    <td>
	<select class="boxs" name="fMil" id="fMil" style="width:180px" tabindex="0">
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
				if ($mRo['Kd_Pemilik']==$fMil) 
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
    <td><input name="fLok" id="fLok" type="text" value="<?=$fLok?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Asal Usul</td>
    <td class="ac">:</td>
    <td>
	<select name="fAsa" id="fAsa" class="boxs" style="width:180px" tabindex="0">
	<option value=""></option>
      <?
		$nSQ = "SELECT * FROM ref_perolehan ORDER BY Perolehan";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			do
			{
				$sel ="";
				if ($mRo['Perolehan']==$fAsa) 
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
    <td><select class="boxs" name="fTin" id="fTin" style="width:170px" tabindex="0">
      <option value=""></option>
      <option <? if ($fTin=="Bertingkat") {echo "selected";}?> value="Bertingkat">Bertingkat</option>
      <option <? if ($fTin=="Tidak") {echo "selected";}?> value="Tidak">Tidak Bertingkat</option>
    </select>
      <select class="boxs" name="fBet" id="fBet" style="width:134px" tabindex="0">
        <option value=""></option>
        <option <? if ($fBet=="Beton") {echo "selected";}?> value="Beton">Beton</option>
        <option <? if ($fBet=="Tidak") {echo "selected";}?> value="Tidak">Bukan Beton</option>
      </select></td>
    <td class="ar">Jumlah Satuan</td>
    <td class="ac">:</td>
    <td>
	<input name="fSat" id="fSat" type="text" value="<?=fConvertToRupiahBulat($fSat)?>" onkeyup="addSeparatorNum(this)" style="width:50px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/>      &nbsp;&nbsp;&nbsp;(<i> Jumlah KDP </i>)	</td>
  </tr>
  <tr height="25">
    <td class="ar">Panjang</td>
    <td class="ac">:</td>
    <td><input name="fPan" id="fPan" type="text" value="<?=fConvertToRupiah($fPan)?>" style="width:50px; border: 1px solid #C0C0C0; text-align:center"/>      
      &nbsp;m&nbsp;&nbsp;&nbsp;Lebar 
      <input name="fLeb" id="fLeb" type="text" value="<?=fConvertToRupiah($fLeb)?>" style="width:40px; border: 1px solid #C0C0C0; text-align:center"/>&nbsp;m&nbsp;&nbsp;&nbsp;
      Luas&nbsp;&nbsp;
    <input name="fLua" id="fLua" type="text" value="<?=fConvertToRupiah($fLua)?>" style="width:75px; border: 1px solid #C0C0C0; text-align:center"/>&nbsp;m<sup>2</sup></td><td class="ar">Harga Satuan (Rp)</td>
    <td class="ac">:</td>
    <td>
	<input name="fHrg" id="fHrg" type="text" value="<?=fConvertToRupiah($fHrg)?>" onkeyup="addSeparatorNum(this)" style=" width:100px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/>      
      &nbsp;&nbsp;&nbsp;(<i> Harga per KDP</i>)	</td>
  </tr>
  <tr height="25">
    <td class="ar">Keterangan</td>
    <td class="ac">:</td>
    <td rowspan="4"><textarea name="fKet" id="fKet" style="border: 1px solid #C0C0C0; height:85px; width:300px"><?=$fKet?></textarea></td>
    <td class="ar">Total Harga (Rp)</td>
    <td class="ac">:</td>
    <td><input name="fTot" id="fTot" type="text" value="<?=fConvertToRupiah($fTot)?>" readonly="readonly" style=" width:100px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/>	  </td>
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
    <td><input type="button" name="B39" <?=$DisA?> value="SAVE" onclick="SaveMidASET('F','<?=$IdTR?>','<?=$rIdT?>','<?=$rCek?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
    <input type="button" name="B393" <?=$DisA?> value="RESET" onclick="ResetMidASET('f','<?=$rIdT?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
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
