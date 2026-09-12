<table border="1" width="1300" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="font-family: Arial Narrow; font-size: 8pt; border-collapse: collapse">
  <tr style="font-weight:bold"> 
    <td width="20" rowspan="2" class="ac">NO</td>
    <td width="150" rowspan="2" class="ac">NAMA BARANG</td>
    <td colspan="2" class="ac">NOMOR</td>
    <td width="40" rowspan="2" class="ac">BANGUNAN (P,SPD)</td>
    <td colspan="2" class="ac">KONSTRUKSI</td>
    <td width="50" rowspan="2" class="ac">LUAS </td>
    <td width="150" rowspan="2" class="ac">LETAK / LOKASI</td>
    <td colspan="2" class="ac">DOKUMEN</td>
    <td width="100" rowspan="2" class="ac">TANGGAL, BULAN, TAHUN MULAI</td>
    <td width="100" rowspan="2" class="ac">STATUS TANAH</td>
    <td width="40" rowspan="2" class="ac">KODE TANAH</td>
    <td width="55" rowspan="2">ASAL-USUL</td>
    <td width="40" rowspan="2" class="ac">NILAI KONTRAK</td>
    <td rowspan="2" class="ac">KETERANGAN</td>
  </tr>
  <tr style="font-weight:bold"> 
    <td width="70" class="ac">KODE</td>
    <td width="40" class="ac">REGISTER</td>
    <td width="40" class="ac">BERTINGKAT/ TIDAK</td>
    <td width="40" class="ac">BETON/ TIDAK</td>
    <td width="55" class="ac">Tanggal</td>
    <td width="55" class="ac">Nomor</td>
  </tr>
  <tr style="font-weight:bold"> 
    <td class="ac">1</td>
    <td class="ac">2</td>
    <td class="ac">3</td>
    <td class="ac">4</td>
    <td class="ac">5</td>
    <td class="ac">6</td>
    <td class="ac">7</td>
    <td class="ac">8</td>
    <td class="ac">9</td>
    <td class="ac">10</td>
    <td class="ac">11</td>
    <td class="ac">12</td>
    <td class="ac">13</td>
    <td class="ac">14</td>
    <td class="ac">15</td>
    <td class="ac">16</td>
    <td class="ac">17</td>
  </tr>
  <?
	define("MIN_DATES_DIFF", 25569);	// Numbers of second in a day:
	define("SEC_IN_DAY", 86400);
	
	function excel2timestamp($excelDate)
	{
		if ($excelDate <= MIN_DATES_DIFF) {return 0;}
		return  ($excelDate - MIN_DATES_DIFF) * SEC_IN_DAY;
	}  
  	$tJML=0;
  	$tG=1;
	for ($i = 3; $i <= $data->sheets[0]['numRows']; $i++) {
		if ($data->sheets[0]['cells'][$i][3]!="")
		{
			$tJML= $tJML + $data->sheets[0]['cells'][$i][20];
			#$gA = substr($data->sheets[0]['cells'][$i][3],0,11);
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
			
			$rTgl= $data->sheets[0]['cells'][$i][13];
			if ($rTgl!="") 
			{
				#$gTglD = excel2timestamp($rTgl);
				#$gTglD = date("Y-m-d",$gTglD);
				$gTglD = $rTgl;
			} 
			else
			{
				$gTglD="0000-00-00";
			}
			?>
		  <tr> 
			<td class="ac"><?=$tG?></td>
			<td><?=$data->sheets[0]['cells'][$i][5].$WrN ?></td>
			<td class="ac"><?=$WrM.$data->sheets[0]['cells'][$i][6] ?></td>
			<td class="ac"><?=$data->sheets[0]['cells'][$i][7] ?></td>
			<td class="ac"><?="-"?></td>
			<td class="ac"><?=$data->sheets[0]['cells'][$i][9] ?></td>
			<td class="ac"><?=$WrM.$data->sheets[0]['cells'][$i][10] ?></td>
			<td class="ac"><?=$data->sheets[0]['cells'][$i][11] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][12] ?></td>
			<td><?=$gTglD ?></td>
			<td><?=$data->sheets[0]['cells'][$i][14] ?></td>
			<td class="ac"><?=$WrM.$data->sheets[0]['cells'][$i][15] ?></td>
			<td class="ac"><?=$data->sheets[0]['cells'][$i][17] ?></td>
			<td class="ac"><?=$data->sheets[0]['cells'][$i][18] ?></td>
			<td class="ac"><?=$data->sheets[0]['cells'][$i][19] ?></td>
			<td class="ar"><?=fConvertToRupiahBulat($data->sheets[0]['cells'][$i][20]) ?></td>
			<td><?=$data->sheets[0]['cells'][$i][21] ?></td>
		  </tr>
  	<? }
  	$tG++;
	} ?>
  <tr style="font-weight:bold"> 
    <td colspan="15" class="ar">J U M L A H&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="ar"><?=fConvertToRupiahBulat($tJML) ?></td>
    <td>&nbsp;</td>
  </tr>
</table>
