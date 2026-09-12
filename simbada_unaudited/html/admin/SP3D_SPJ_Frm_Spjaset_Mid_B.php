<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$bRef = 'AST.'.fGetDate('year').'.XXXXXXXX';
$bTgL = fConvertDateShort(fGlobal("Tgl_BAST","ta_sp3d_spj","IDT",$rIdT,"=","",""));
if ($IdTR){
	$nSQ = "SELECT Referensi as A0, Nm_Aset as A1, Merk as A2, Type as A3, Ukuran_CC as A4, Bahan as A5, 
	Nomor_Pabrik as A6, Nomor_Rangka as A7, Nomor_Mesin as A8, Nomor_Polisi as A9, Nomor_BPKB as A10, 
	Keterangan as A11, Kd_Pemilik as A12, Kondisi as A13, Asal_Usul as A14, JmlSatuan as A15, Harga as A16, Total as A17 
	FROM ta_sp3d_spj_rinci WHERE IDT='".$IdTR."'";
	$nRs = mysql_query($nSQ);
	$mRo = mysql_fetch_array($nRs);
	$bRef = $mRo[0];
	$bNma = $mRo[1];
	
	$bMer = $mRo[2];
	$bTip = $mRo[3];
	$bUku = $mRo[4];
	$bBhn = $mRo[5];
	$bPab = $mRo[6];
	$bRan = $mRo[7];
	$bMes = $mRo[8];
	$bPol = $mRo[9];
	$bBpk = $mRo[10];
	
	$bKet = $mRo[11];
	$bMil = $mRo[12];
	$bKon = $mRo[13];
	$bAsa = $mRo[14];
	$bSat = $mRo[15];
	$bHrg = $mRo[16];
	$bTot = $mRo[17];
}
?>
<table border="0" width="1000" height="23" cellspacing="0" cellpadding="0" align="center">
  <tr height="10">
    <td width="118"></td>
    <td width="22"></td>
    <td colspan="4"></td>
    <td width="108"></td>
    <td width="22"></td>
    <td width="367"></td>
  </tr>
  <tr height="25">
    <td class="ar">Referensi</td>
    <td class="ac">:</td>
    <td colspan="4">
	<input name="bRef" id="bRef" type="text" value="<?=$bRef?>" readonly style="width:115px; border: 1px solid #C0C0C0; background:#CCCCFF"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Tgl. Perolehan&nbsp;&nbsp;:&nbsp;&nbsp;<input name="bTgL" id="bTgL" type="text" value="<?=$bTgL?>" readonly style="width:78px; border: 1px solid #C0C0C0; background:#CCCCFF; text-align:center"/>
	</td>
    <td class="ar">Kepemilikan</td>
    <td class="ac">:</td>
    <td><select class="boxs" name="bMil" id="bMil" style="width: 180px" tabindex="0">
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
				if ($mRo['Kd_Pemilik']==$bMil) 
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
    <td class="ar">Nama Barang </td>
    <td class="ac">:</td>
    <td colspan="4"><input name="bNma" id="bNma" type="text" value="<?=$bNma?>" style=" width:310px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Asal Usul</td>
    <td class="ac">:</td>
    <td><select name="bAsa" id="bAsa" class="boxs" style="width: 180px" tabindex="0">
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
				if ($mRo['Perolehan']==$bAsa) 
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
    <td class="ar">Merk</td>
    <td class="ac">:</td>
    <td colspan="4"><input name="bMer" id="bMer" type="text" value="<?=$bMer?>" style=" width:310px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Kondisi</td>
    <td class="ac">:</td>
    <td><select class="boxs" name="bKon" id="bKon" style="width: 180px" tabindex="0">
      <option value=""></option>
      <?
		$nSQ = "SELECT * from ref_kondisi ORDER BY IDT";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			do
			{
				$sel ="";
				if ($mRo['Kode']==$bKon) 
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
    <td class="ar">Tipe</td>
    <td class="ac">:</td>
    <td colspan="4"><input name="bTip" id="bTip" type="text" value="<?=$bTip?>" style=" width:310px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Jumlah Satuan</td>
    <td class="ac">:</td>
    <td><input name="bSat" id="bSat" type="text" value="<?=fConvertToRupiahBulat($bSat)?>" onkeyup="addSeparatorNum(this)" style=" width:50px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/>      &nbsp;&nbsp;&nbsp;(<i> Jumlah item barang </i>)</td>
  </tr>
  <tr height="25">
    <td class="ar">Ukuran / CC</td>
    <td class="ac">:</td>
    <td colspan="4"><input name="bUku" id="bUku" type="text" value="<?=$bUku?>" style=" width:310px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Harga Satuan (Rp)</td>
    <td class="ac">:</td>
    <td><input name="bHrg" id="bHrg" type="text" value="<?=fConvertToRupiah($bHrg)?>" onkeyup="addSeparatorNum(this)" style=" width:100px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/>      &nbsp;&nbsp;&nbsp;(<i> Harga per item barang </i>)</td>
  </tr>
  <tr height="25">
    <td class="ar">Bahan</td>
    <td class="ac">:</td>
    <td colspan="4"><input name="bBhn" id="bBhn" type="text" value="<?=$bBhn?>" style=" width:310px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Total Harga (Rp)</td>
    <td class="ac">:</td>
    <td><input name="bTot" id="bTot" type="text" value="<?=fConvertToRupiah($bTot)?>" readonly="readonly" style=" width:100px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/></td>
  </tr>
  <tr height="25">
    <td class="ar">Nomor Pabrik </td>
    <td class="ac">:</td>
    <td width="102"><input name="bPab" id="bPab" type="text" value="<?=$bPab?>" style=" width:100px; border: 1px solid #C0C0C0"/></td>
    <td width="91" class="ar">Nomor Rangka</td>
    <td width="18" class="ac">:</td>
    <td width="152"><input name="bRan" id="bRan" type="text" value="<?=$bRan?>" style=" width:100px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Keterangan</td>
    <td class="ac">:</td>
    <td rowspan="3"><textarea name="bKet" id="bKet" style="border: 1px solid #C0C0C0; height:65px; width:300px"><?=$bKet?></textarea></td>
  </tr>
  <tr height="25">
    <td class="ar">Nomor Mesin </td>
    <td class="ac">:</td>
    <td><input name="bMes" id="bMes" type="text" value="<?=$bMes?>" style=" width:100px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Nomor Polisi</td>
    <td class="ac">:</td>
    <td><input name="bPol" id="bPol" type="text" value="<?=$bPol?>" style=" width:100px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
  </tr>
  <tr height="25">
    <td class="ar">Nomor BPKB </td>
    <td class="ac">:</td>
    <td colspan="4"><input name="bBpk" id="bBpk" type="text" value="<?=$bBpk?>" style=" width:100px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
  </tr>
  <tr height="5">
    <td class="ar"></td>
    <td class="ac"></td>
    <td colspan="4"></td>
    <td class="ar"></td>
    <td class="ac"></td>
    <td></td>
  </tr>
  <tr height="25">
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>
	<input type="button" name="B39" <?=$DisA?> value="SAVE" onclick="SaveMidASET('B','<?=$IdTR?>','<?=$rIdT?>','<?=$rCek?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
    <input type="button" name="B393" <?=$DisA?> value="RESET" onclick="ResetMidASET('B','<?=$rIdT?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
    <input type="button" name="B392" <?=$DisA?> value="CLOSE" onclick="showASET('refr','<?=$rIdT?>','','<?=$IdL?>')" style="width: 80px; height: 21px" />
	</td>
  </tr>
  <tr height="25">
    <td colspan="6" class="al" style="font-style:italic; color:#0000FF">&nbsp;&nbsp;** Tgl. Perolehan berasal dari Tgl. BAST Berkas</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
