<?php require "Import_Time_Stamp.php"; ?>
<table border="1" width="1055" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" style="font-family: Arial Narrow; font-size: 8pt; border-collapse: collapse">
  <tr style="font-weight:bold"> 
    <td width="27" class="ac">NO</td>
    <td>NAMA BARANG</td>
    <td width="65" class="ac">KODE</td>
    <td width="40" class="ac">REGISTER</td>
    <td width="62">KONDISI</td>
    <td width="62">TAHUN</td>
    <td width="62">ASAL USUL </td>
    <td width="40" class="ac">MERK</td>
    <td width="62">UKURAN</td>
    <td width="62">BAHAN</td>
    <td width="62">NO.PAB</td>
    <td width="55">NO.RANGKA</td>
    <td width="62">NO.MESIN</td>
    <td width="62">NO.POLISI</td>
    <td width="70">NO.BPKB</td>
    <td width="70">HARGA</td>
    <td width="70">KETERANGAN</td>
  </tr>
  <?php
  	$tJML=0;
	for ($i = 3; $i <= $data->sheets[0]['numRows']; $i++) {
		if ($data->sheets[0]['cells'][$i][2]!="")
		{
			$tJML= $tJML + $data->sheets[0]['cells'][$i][16];
			#$gA  = substr($data->sheets[0]['cells'][$i][6],0,11);
			#$gB  = explode(":", (str_replace('.',':',$data->sheets[0]['cells'][$i][2])));
			#$gC  = $gA.".".fMakeReferensi($gB[4],3);
			#$gNmB= fGlobal("Nm_Aset","Ref_Rek_Aset108_7","Kd_Aset",$gC,"=","","d");
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
			
			$gDT = $data->sheets[0]['cells'][$i][8];
			//if ($gDT){
			//	$gDT  = explode('/',$gDT);
			//	$gTgl = $gDT[2]."-".$gDT[1]."-".$gDT[0];
			//}
			
			if ($gDT!="") 
			{
				$gDT = excel2timestamp($gDT);
				$gTgl = date("Y-m-d",$gDT);
			} 
			else
			{
				$gTgl ="0000-00-00";
			}
			?>
			<tr> 
			<td class="ac"><?=$data->sheets[0]['cells'][$i][1] ?></td>
			<td><?=$WrM.$data->sheets[0]['cells'][$i][2] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][3].$WrN ?></td>
			<td class="ac"><?=$data->sheets[0]['cells'][$i][4] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][5] ?></td>
			<td class="ac"><?=$data->sheets[0]['cells'][$i][6] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][7] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][8] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][9] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][10] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][11] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][12] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][13] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][14] ?></td>
			<td><?=$data->sheets[0]['cells'][$i][15] ?></td>
			<td class="ar"><?=fConvertToRupiahBulat($data->sheets[0]['cells'][$i][16]) ?></td>
			<td><?=$data->sheets[0]['cells'][$i][17] ?></td>
			</tr>
	  <?php } ?>
  <?php } ?>
  <tr style="font-weight:bold"> 
    <td colspan="15" class="ar">J U M L A H&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="ar"><?=fConvertToRupiahBulat($tJML) ?></td>
    <td>&nbsp;</td>
  </tr>
</table>
