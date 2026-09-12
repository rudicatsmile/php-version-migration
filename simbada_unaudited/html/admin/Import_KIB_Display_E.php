<? require "Import_Time_Stamp.php"; ?>
<table border="1" width="1055" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="font-family: Arial Narrow; font-size: 8pt; border-collapse: collapse">
  <tr style="font-weight:bold"> 
    <td rowspan="2" width="20" class="ac">NO</td>
    <td rowspan="2" class="ac">NAMA BARANG</td>
    <td rowspan="2" width="65" class="ac">KODE</td>
    <td rowspan="2" width="50" class="ac">REGISTER</td>
    <td colspan="2" class="ac">BUKU / PERPUSTAKAAN</td>
    <td colspan="3" class="ac">BARANG BERCORAK<br>KESENIAN KEBUDAYAAN</td>
    <td colspan="2" class="ac">HEWAN / TERNAK DAN TUMBUHAN</td>
    <td rowspan="2" width="45" class="ac">JUMLAH</td>
    <td width="40" rowspan="2" class="ac">TAHUN CETAK</td>
    <td rowspan="2" width="70">ASAL-USUL</td>
    <td rowspan="2" width="60" class="ar">HARGA</td>
    <td rowspan="2" width="90" class="ac">KETERANGAN</td>
  </tr>
  <tr style="font-weight:bold"> 
    <td width="50" class="ac">Judul</td>
    <td width="50" class="ac">Spesifikasi</td>
    <td width="60" class="ac">Asal Daerah</td>
    <td width="50" class="ac">Pencipta</td>
    <td width="50" class="ac">Bahan</td>
    <td width="50" class="ac">Jenis</td>
    <td width="50" class="ac">Ukuran</td>
  </tr>
  <?
  	$tJML=0;
	$tG=1;
	for ($i = 3; $i <= $data->sheets[0]['numRows']; $i++) {
		if ($data->sheets[0]['cells'][$i][3]!="")
		{
			$tJML= $tJML + $data->sheets[0]['cells'][$i][17];
			#$gA  = substr($data->sheets[0]['cells'][$i][3],0,11);
			#$gB = split(":", (str_replace('.',':',$data->sheets[0]['cells'][$i][3])));
			#$gC  = $gA.".".fMakeReferensi($gB[4],3);
			#$gNmB= fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$gC,"=","","");
			#if ($gNmB=="") 
			#{
			#	$WrM="<font color='#FF0000'>";
			#	$WrN="<font color='#FF0000'><br><i>Rekening aset tidak ditemukan..!!!";
			#} 
			#else 
			#{
				$WrM="";
				$WrN="";
			#}
			
			$gTgl= "0000-00-00";
			$gDT = $data->sheets[0]['cells'][$i][13];
			if ($gDT!="") 
			{
				$gDT  = excel2timestamp($gDT);
				$gTgl = date("Y-m-d",$gDT);
			} 
			?>
		  <tr> 
			<td class="ac"><?=$tG?></td>
			<td><?=$data->sheets[0]['cells'][$i][5].$WrN ?></td>
			<td class="ac"><?=$WrM.$data->sheets[0]['cells'][$i][6] ?></td>
			<td class="ac"><?=$data->sheets[0]['cells'][$i][7] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][8] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][9] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][10] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][11] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][12] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][13] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][14] ?></td>
			<td class="ac"><?="-"?></td>
			<td class="ac"><?=$data->sheets[0]['cells'][$i][15] ?></td>
			<td class="ac"><?=$data->sheets[0]['cells'][$i][16] ?></td>
			<td class="ar"><?=fConvertToRupiahBulat($data->sheets[0]['cells'][$i][17]) ?></td>
			<td><?=$data->sheets[0]['cells'][$i][18] ?></td>
		  </tr>
		 <? }
  	$tG++;
  } ?>
  <tr style="font-weight:bold"> 
    <td colspan="14" class="ar">J U M L A H&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="ar"><?=fConvertToRupiahBulat($tJML) ?></td>
    <td>&nbsp;</td>
  </tr>
</table>
