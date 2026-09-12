<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$eRef = 'AST.'.fGetDate('year').'.XXXXXXXX';
$eTgL = fConvertDateShort(fGlobal("Tgl_BAST","ta_sp3d_spj","IDT",$rIdT,"=","",""));
if ($IdTR){
	$nSQ = "SELECT Referensi as A0, Nm_Aset as A1, 
	Judul as A2, Daerah_Asal as A3, Jenis as A4, Spesifikasi as A5, Pencipta as A6, Ukuran as A7, Bahan as A8, Tahun as A9,
	Keterangan as A10, Kd_Pemilik as A11, Kondisi as A12, Asal_Usul as A13, JmlSatuan as A14, Harga as A15, Total as A16 
	FROM ta_sp3d_spj_rinci WHERE IDT='".$IdTR."'";
	$nRs = mysql_query($nSQ);
	$mRo = mysql_fetch_array($nRs);
	$eRef = $mRo[0];
	$eNma = $mRo[1];
	
	$eJud =  $mRo[2];
	$eDae =  $mRo[3];
	$eJen =  $mRo[4];
	$eSpe =  $mRo[5];
	$ePen =  $mRo[6];
	$eUku =  $mRo[7];
	$eBah =  $mRo[8];
	$eThn =  $mRo[9];
	
	$eKet = $mRo[10];
	$eMil = $mRo[11];
	$eKon = $mRo[12];
	$eAsa = $mRo[13];
	$eSat = $mRo[14];
	$eHrg = $mRo[15];
	$eTot = $mRo[16];
}

?>
<table border="0" width="1000" height="23" cellspacing="0" cellpadding="0" align="center">
  <tr height="15">
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
	<input name="eRef" id="eRef" type="text" value="<?=$eRef?>" readonly style="width:115px; border: 1px solid #C0C0C0; background:#CCCCFF"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Tgl. Perolehan&nbsp;&nbsp;:&nbsp;&nbsp;<input name="eTgL" id="eTgL" type="text" value="<?=$eTgL?>" readonly style="width:80px; border: 1px solid #C0C0C0; background:#CCCCFF; text-align:center"/>	</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="25">
    <td class="ar">Nama Barang </td>
    <td class="ac">:</td>
    <td><input name="eNma" id="eNma" type="text" value="<?=$eNma?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Kepemilikan</td>
    <td class="ac">:</td>
    <td>
	<select class="boxs" name="eMil" id="eMil" style="width:180px" tabindex="0">
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
				if ($mRo['Kd_Pemilik']==$eMil) 
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
    <td class="ar">Judul</td>
    <td class="ac">:</td>
    <td><input name="eJud" id="eJud" type="text" value="<?=$eJud?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Asal Usul</td>
    <td class="ac">:</td>
    <td>
	<select name="eAsa" id="eAsa" class="boxs" style="width:180px" tabindex="0">
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
				if ($mRo['Perolehan']==$eAsa) 
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
    <td class="ar">Asal Daerah </td>
    <td class="ac">:</td>
    <td><input name="eDae" id="eDae" type="text" value="<?=$eDae?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Kondisi</td>
    <td class="ac">:</td>
    <td>
	<select class="boxs" name="eKon" id="eKon" style="width:180px" tabindex="0">
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
				if ($mRo['Kode']==$eKon) 
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
    <td class="ar">Jenis</td>
    <td class="ac">:</td>
    <td><input name="eJen" id="eJen" type="text" value="<?=$eJen?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Jumlah Satuan</td>
    <td class="ac">:</td>
    <td><input name="eSat" id="eSat" type="text" value="<?=fConvertToRupiahBulat($eSat)?>" onkeyup="addSeparatorNum(this)" style="width:50px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/>      
      &nbsp;&nbsp;&nbsp;(<i> Jumlah item / barang </i>)</td>
  </tr>
  <tr height="25">
    <td class="ar">Spesifikasi</td>
    <td class="ac">:</td>
    <td><input name="eSpe" id="eSpe" type="text" value="<?=$eSpe?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Harga Satuan (Rp)</td>
    <td class="ac">:</td>
    <td><input name="eHrg" id="eHrg" type="text" value="<?=fConvertToRupiah($eHrg)?>" onkeyup="addSeparatorNum(this)" style=" width:100px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/>      
      &nbsp;&nbsp;&nbsp;(<i> Harga per item / barang</i> )</td>
  </tr>
  <tr height="25">
    <td class="ar">Pencipta</td>
    <td class="ac">:</td>
    <td><input name="ePen" id="ePen" type="text" value="<?=$ePen?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Total Harga (Rp)</td>
    <td class="ac">:</td>
    <td><input name="eTot" id="eTot" type="text" value="<?=fConvertToRupiah($eTot)?>" readonly="readonly" style=" width:100px; border: 1px solid #C0C0C0; text-align:right; padding-right:5px"/></td>
  </tr>
  <tr height="25">
    <td class="ar">Ukuran</td>
    <td class="ac">:</td>
    <td><input name="eUku" id="eUku" type="text" value="<?=$eUku?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">Keterangan</td>
    <td class="ac">:</td>
    <td rowspan="2">
	<textarea name="eKet" id="eKet" style="border: 1px solid #C0C0C0; height:40px; width:300px"><?=$eKet?></textarea></td>
  </tr>
  <tr height="25">
    <td class="ar">Bahan</td>
    <td class="ac">:</td>
    <td><input name="eBah" id="eBah" type="text" value="<?=$eBah?>" style=" width:300px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
  </tr>
  <tr height="25">
    <td class="ar">Tahun Cetak </td>
    <td class="ac">:</td>
    <td><input name="eThn" id="eThn" type="text" value="<?=$eThn?>" style=" width:50px; border: 1px solid #C0C0C0"/></td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td><input type="button" name="B39" <?=$DisA?> value="SAVE" onclick="SaveMidASET('E','<?=$IdTR?>','<?=$rIdT?>','<?=$rCek?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
    <input type="button" name="B393" <?=$DisA?> value="RESET" onclick="ResetMidASET('E','<?=$rIdT?>','<?=$IdL?>')" style="width: 80px; height: 21px" />
    <input type="button" name="B392" <?=$DisA?> value="CLOSE" onclick="showASET('refr','<?=$rIdT?>','','<?=$IdL?>')" style="width: 80px; height: 21px" /></td>
  </tr>
  
  <tr height="25">
    <td colspan="3" class="al" style="font-style:italic; color:#0000FF">&nbsp;&nbsp;** Tgl. Perolehan berasal dari Tgl. BAST Berkas</td>
    <td class="ar">&nbsp;</td>
    <td class="ac">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
