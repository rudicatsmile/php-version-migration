<? require "Import_Time_Stamp.php"; ?>
<table border="1" width="1155" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="font-family: Arial Narrow; font-size: 8pt; border-collapse: collapse">
  <tr style="font-weight:bold"> 
    <td rowspan="3" width="20" class="ac">NO</td>
    <td rowspan="3" class="ac">NAMA BARANG</td>
    <td colspan="2" class="ac">NOMOR</td>
    <td rowspan="3" class="ac" width="40">LUAS</td>
    <td rowspan="3" class="ac" width="40">TAHUN</td>
    <td rowspan="3" class="ac" width="150">LETAK / ALAMAT</td>
    <td colspan="3" class="ac">STATUS TANAH</td>
    <td rowspan="3" width="100">PENGGUNAAN</td>
    <td rowspan="3" width="70" class="ac">ASAL-USUL</td>
    <td rowspan="3" width="85" class="ar">HARGA</td>
    <td rowspan="3" class="ac">KETERANGAN</td>
  </tr>
  <tr style="font-weight:bold"> 
    <td rowspan="2" class="ac" width="75">KODE</td>
    <td rowspan="2" class="ac" width="50">REGISTER</td>
    <td rowspan="2" class="ac" width="50">HAK</td>
    <td colspan="2" class="ac">SERTIFIKAT</td>
  </tr>
  <tr style="font-weight:bold"> 
    <td width="50" class="ac">Tanggal</td>
    <td width="50" class="ac">Nomor</td>
  </tr>
  <?
  	$tJML=0;
  	$tG=1;
	for ($i = 3; $i <= $data->sheets[0]['numRows']; $i++) {
		if ($data->sheets[0]['cells'][$i][3]!="")
		{
			$tJML= $tJML + $data->sheets[0]['cells'][$i][16];
			#$gA  = substr($data->sheets[0]['cells'][$i][3],0,11);
			#$gB = explode(":", (str_replace('.',':',$data->sheets[0]['cells'][$i][3])));
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
			
			$rTgl= $data->sheets[0]['cells'][$i][12];	//Kondisikan
			#if ($rTgl!="") 
			#{
				#$gTglV = excel2timestamp($rTgl);
				$gTglV = $rTgl;
			#	$gTglV = date("Y-m-d",$gTglV);
			#} 
			#else
			#{
			#	$gTglV="0000-00-00";
			#}
		?>
		  <tr> 
			<td class="ac"><?=$tG?></td>
			<td><? echo $data->sheets[0]['cells'][$i][5].$WrN ?></td>
			<td class="ac"><? echo $WrM.$data->sheets[0]['cells'][$i][6] ?></td>
			<td class="ac"><? echo $data->sheets[0]['cells'][$i][7] ?></td>
			<td class="ac"><? echo $data->sheets[0]['cells'][$i][8] ?></td>
			<td class="ac"><? echo $data->sheets[0]['cells'][$i][9] ?></td>
			<td><? echo $data->sheets[0]['cells'][$i][10] ?></td>
			<td><? echo $data->sheets[0]['cells'][$i][11] ?></td>
			<td><? echo $gTglV ?></td>
			<td><? echo $data->sheets[0]['cells'][$i][13] ?></td>
			<td><? echo $data->sheets[0]['cells'][$i][14] ?></td>
			<td class="ac"><? echo $data->sheets[0]['cells'][$i][15] ?></td>
			<td class="ar"><? echo fConvertToRupiahBulat($data->sheets[0]['cells'][$i][16]) ?></td>
			<td><? echo $data->sheets[0]['cells'][$i][17] ?></td>
		  </tr>
	  <? } ?>
  <? 
  $tG++;
  } ?>
  <tr style="font-weight:bold"> 
    <td colspan="12" class="ar">J U M L A H&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="ar"><? echo fConvertToRupiahBulat($tJML) ?></td>
    <td>&nbsp;</td>
  </tr>
</table>
