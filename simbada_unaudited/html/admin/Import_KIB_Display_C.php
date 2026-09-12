<? require "Import_Time_Stamp.php"; ?>
<table border="1" width="1300" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="font-family: Arial Narrow; font-size: 8pt; border-collapse: collapse">
<tr style="font-weight:bold"> 
    <td rowspan="2" width="20" class="ac">NO</td>
    <td rowspan="2" class="ac">NAMA BARANG</td>
    <td rowspan="2" width="65" class="ac">KODE</td>
    <td rowspan="2" width="40" class="ac">REGISTER</td>
    <td rowspan="2" width="48" class="ac">KONDISI</td>
    <td colspan="2" class="ac">KONSTRUKSI BANGUNAN</td>
    <td width="50" rowspan="2" class="ac">LUAS LANTAI</td>
    <td width="114" rowspan="2" class="ac">LETAK / LOKASI</td>
    <td colspan="2" class="ac">DOKUMEN</td>
    <td rowspan="2" width="45" class="ac">LUAS</td>
    <td width="50" rowspan="2" class="ac">STATUS TANAH</td>
    <td width="40" rowspan="2" class="ac">KODE TANAH</td>
    <td rowspan="2" width="50">ASAL-USUL</td>
    <td rowspan="2" width="80" class="ar">HARGA</td>
    <td rowspan="2" width="150" class="ac">KETERANGAN</td>
  </tr>
  <tr style="font-weight:bold"> 
    <td width="67" class="ac">Bertingkat/Tidak</td>
    <td width="48" class="ac">Beton/Tidak</td>
    <td width="50" class="ac">Tanggal</td>
    <td width="50" class="ac">Nomor</td>
  </tr>
  <?
  	$tJML=0;
  	$tG=1;
	for ($i = 3; $i <= $data->sheets[0]['numRows']; $i++) {
		if ($data->sheets[0]['cells'][$i][5]!="")
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
			
			$rTgl= $data->sheets[0]['cells'][$i][13];	//Kondisikan
			#if ($rTgl!="") 
			#{
			#	$gTglD = excel2timestamp($rTgl);
			#	$gTglD = date("Y-m-d",$gTglD);
			#} 
			#else
			$gTglD = $rTgl;
			if ($gTglD==''){
				$gTglD="0000-00-00";
			}
			?>
		  <tr> 
			<td class="ac"><?=$tG ?></td>
			<td><? echo $data->sheets[0]['cells'][$i][5].$WrN ?></td>
			<td class="ac"><? echo $WrM.$data->sheets[0]['cells'][$i][6] ?></td>
			<td class="ac"><? echo $data->sheets[0]['cells'][$i][7] ?></td>
			<td class="ac"><? echo $data->sheets[0]['cells'][$i][8] ?></td>
			<td class="ac"><? echo $data->sheets[0]['cells'][$i][9] ?></td>
			<td class="ac"><? echo $data->sheets[0]['cells'][$i][10] ?></td>
			<td class="ac"><? echo $data->sheets[0]['cells'][$i][11] ?></td>
			<td><? echo $data->sheets[0]['cells'][$i][12] ?></td>
			<td><? echo $gTglD ?></td>
			<td><? echo $data->sheets[0]['cells'][$i][14] ?></td>
			<td class="ac"><? echo $data->sheets[0]['cells'][$i][16] ?></td>
			<td class="ac"><? echo $data->sheets[0]['cells'][$i][17] ?></td>
			<td class="ac"><? echo $data->sheets[0]['cells'][$i][18] ?></td>
			<td class="ac"><? echo $data->sheets[0]['cells'][$i][19] ?></td>
			<td class="ar"><? echo fConvertToRupiahBulat($data->sheets[0]['cells'][$i][20]) ?></td>
			<td><? echo $data->sheets[0]['cells'][$i][21] ?></td>
		  </tr>
	  <? } ?>
  <? 
  $tG++;
  } 
  ?>
  <tr style="font-weight:bold"> 
    <td colspan="15" class="ar">J U M L A H&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="ar"><? echo fConvertToRupiahBulat($tJML) ?></td>
    <td>&nbsp;</td>
  </tr>
</table>
