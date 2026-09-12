<?php
require('Connection.php');
require('FileFunction.php');

extract($_GET);
$Tg1 = $TH1."-".substr("0".$BL1,-2,2)."-".substr("0".$HR1,-2,2);
$Tg2 = $TH2."-".substr("0".$BL2,-2,2)."-".substr("0".$HR2,-2,2);
$Tg3 = $TH3."-".substr("0".$BL3,-2,2)."-".substr("0".$HR3,-2,2);
?>
<div align="center">
<table border="0" width="1830" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
	<tr>
		<td style="font-size: 12pt; font-weight: bold" align="center">PEMERINTAH <?=$TiDaer." ".$NmDaer?></td>
	</tr>
	<tr>
		<td style="font-size: 12pt; font-weight: bold" align="center"> USULAN MUTASI ASET TETAP</td>
	</tr>
	<tr>
	  <td style="font-size: 12pt; font-weight: bold" align="center">&nbsp;</td>
  </tr>
</table>
<table border="0" width="1830" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse" id="table1">
	<tr>
		<td width="96">UNIT KERJA</td>
		<td width="26">:</td>
		<td width="968">
		<?php
		if ($gUNT=="ALL"){
			echo "SEMUA SKPD";
			$gUNT="__.__.__.__";
		}
		else{
			echo fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
		}
		?></td>
	</tr>
	<tr>
	  <td>JENIS USULAN </td>
	  <td>:</td>
	  <td><?php if ($JeNS!="All" && $JeNS!="AA") {echo fGlobal("Deskripsi","ref_usulan_jenis","Kode",$JeNS,"=","","");} else {echo "SEMUA JENIS USULAN";}?></td>
    </tr>
	
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
</table>
<table border="0" width="2000" cellspacing="0" style="font-size: 8pt; font-family: arial; border-collapse: collapse" id="table1">
  <tr height="23" style="text-align:center; font-weight:bold">
    <td width="30" rowspan="3" style="border:1px #000000 solid">NO</td>
    <td colspan="4" style="border:1px #000000 solid">A S E T</td>
    <td colspan="9" style="border:1px #000000 solid">U S U L A N</td>
    <td colspan="2" style="border:1px #000000 solid"> TINDAK LANJUT </td>
    <td colspan="4" style="border:1px #000000 solid; background:#ffffcc">PENYUSUTAN</td>
    </tr>
  <tr height="20" style="text-align:center; font-weight:bold">
    <td rowspan="2" style="border:1px #000000 solid">REFERENSI</td>
    <td rowspan="2" style="border:1px #000000 solid">KODE</td>
    <td rowspan="2" style="border:1px #000000 solid">NOREG</td>
    <td rowspan="2" style="border:1px #000000 solid">DESKRIPSI</td>
    <td rowspan="2" style="border:1px #000000 solid">JENIS</td>
    <td rowspan="2" style="border:1px #000000 solid">TANGGAL</td>
    <td rowspan="2" style="border:1px #000000 solid">REFERENSI</td>
    <td colspan="2" style="border:1px #000000 solid">DOKUMEN PENDUKUNG </td>
    <td rowspan="2" style="border:1px #000000 solid">URAIAN</td>
    <td rowspan="2" style="border:1px #000000 solid; background:#ffffcc">Tanggal Perolehan</td>
    <td rowspan="2" style="border:1px #000000 solid">Nilai<br>Perolehan</td>
    <td rowspan="2" style="border:1px #000000 solid">Nilai<br>Akhir </td>
    <td rowspan="2" style="border:1px #000000 solid">N i l a i</td>
    <td rowspan="2" style="border:1px #000000 solid">Executed</td>
    <td rowspan="2" style="border:1px #000000 solid; background:#ffffcc">Akumulasi Penyusutan s.d Tahun <?=((int)$TH2-1)?></td>
    <td rowspan="2" style="border:1px #000000 solid; background:#ffffcc">Beban Penyusutan Tahun <?=$TH2?></td>
    <td rowspan="2" style="border:1px #000000 solid; background:#ffffcc">Akumulasi Penyusutan s.d Tahun <?=$TH2?></td>
    <td rowspan="2" style="border:1px #000000 solid; background:#ffffcc">Nilai Buku</td>
  </tr>
  <tr height="20" style="text-align:center; font-weight:bold">
    <td style="border:1px #000000 solid">NOMOR</td>
    <td style="border:1px #000000 solid">TANGGAL</td>
    </tr>
  <tr style="text-align:center">
    <td width="30" style="border:1px #000000 solid">1</td>
    <td width="90" style="border:1px #000000 solid">2</td>
    <td width="85" style="border:1px #000000 solid">3</td>
    <td width="45" style="border:1px #000000 solid">4</td>
    <td style="border:1px #000000 solid">5</td>
    <td width="100" style="border:1px #000000 solid">6</td>
    <td width="65" style="border:1px #000000 solid">7</td>
    <td width="110" style="border:1px #000000 solid">8</td>
    <td width="90" style="border:1px #000000 solid">9</td>
    <td width="65" style="border:1px #000000 solid">10</td>
    <td width="270" style="border:1px #000000 solid">11</td>
    <td width="70" style="border:1px #000000 solid; background:#ffffcc">12</td>
    <td width="90" style="border:1px #000000 solid">13</td>
    <td width="90" style="border:1px #000000 solid">14</td>
    <td width="90" style="border:1px #000000 solid">15</td>
    <td width="90" style="border:1px #000000 solid">16</td>
    <td width="90" style="border:1px #000000 solid; background:#ffffcc">17</td>
    <td width="90" style="border:1px #000000 solid; background:#ffffcc">18</td>
    <td width="90" style="border:1px #000000 solid; background:#ffffcc">19</td>
    <td width="90" style="border:1px #000000 solid; background:#ffffcc">20</td>
  </tr>
  
	<?php
	$aK	= 20000;
	$aW = 0;
	#$aW = $aK+$aW+1;
	#$aW = $aK+$aW;
	#$aW = $aK+$aW;
	#$aW = $aK+$aW;
	#$aW = $aK+$aW;
	#$aW = $aK+$aW;
	#$aW = $aK+$aW;
	#$aW = $aK+$aW;
	#$aW = $aK+$aW;
	#$aW = $aK+$aW;
	#$aW = $aK+$aW;
	#$aW = $aK+$aW;
	#$aW = $aK+$aW;
	#$aW = $aK+$aW;
	#$aW = $aK+$aW;
	#$aW = $aK+$aW;
	#$aW = $aK+$aW;
	#$aW = $aK+$aW;
	
	#$aW = $aK+$aW;
	##$aW = $aK+$aW;
	##$aW = $aK+$aW;
	##$aW = $aK+$aW;
	##$aW = $aK+$aW;
	##$aW = $aK+$aW;
	##$aW = $aK+$aW;
	##$aW = $aK+$aW;
	##$aW = $aK+$aW;
	##$aW = $aK+$aW;
	##$aW = $aK+$aW;
	#$aW = $aK+$aW;

	$xY=array();
	$iG=$aW;
	if ($aW==0){$iG=$aW+1;}
	$xY12= 0;
	$xY13= 0;
	$xY14= 0;
	$xY15= 0;
	$KdA = "";
	$KdB = "";
	if ($JeNS=="All" || $JeNS=="AA") {$JeNS="%";}
	#P4.Eksekusi,
	#P4.Kd_UPB,
	$nSQ = "SELECT P2.Ref_Aset, P2.Kd_Aset, P2.No_Register, P2.Nm_Aset, P3.Deskripsi, P1.Tanggal, P1.Referensi, P1.Dokumen_Nom, 
	P1.Dokumen_Tgl, P1.Uraian, P2.Harga, P2.Nilai_Akhir, P4.Nilai_Akhir, P4.Nilai_Akhir,
	P4.Eksekusi as A14,
	P1.Jenis as A15 
	FROM ta_usulan_108 P1 
	LEFT JOIN ta_usulan_rinci_108 P2 ON P2.Referensi=P1.Referensi 
	LEFT JOIN ref_usulan_jenis P3 ON P3.Kode=P1.Jenis 
	LEFT JOIN ta_usulan_verifikasi_rinci_108 P4 ON P4.Ref_Usulan=P1.Referensi AND P4.Ref_Aset=P2.Ref_Aset 
	WHERE P1.Kd_UPB LIKE '$gUNT%' AND (P1.Tanggal BETWEEN '$Tg1' AND '$Tg2') AND P1.Jenis LIKE '$JeNS%' 
	AND P1.OpenRec='Y' AND P4.Eksekusi='Sudah' 
	ORDER BY P2.Kd_Aset, P2.No_Register LIMIT $aW,$aK";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$xY[1]=""; $xY[2]=""; $xY[3]=""; $xY[4]=""; $xY[5]=""; $xY[6]=""; $xY[7]=""; $xY[8]=""; $xY[9]=""; $xY[10]=""; $xY[11]=""; $xY[12]=0; $xY[13]=0; $xY[14]=0; $xY[15]=0;
		$xY[1]= $iG;
		$KdA = substr($mRo[1],0,2);
		$xY[2]= $mRo[0];
		$xY[3]= $mRo[1];
		$xY[4]= $mRo[2];
		$xY[5]= $mRo[3];
		$xY[6]= str_replace("MUTASI ANTAR SKPD","MUTASI SKPD",$mRo[4]);
		$xY[6]= str_replace("MUTASI ANTAR KIB","MUTASI KIB",$xY[6]);
		$xY[7]= fConvertDateShort($mRo[5]);
		$xY[8]= $mRo[6];
		$xY[9]= $mRo[7];
		$xY[10]= fConvertDateShort($mRo[8]);
		$xY[11]= $mRo[9];
		$xY[12]= $mRo[10];
		$xY[13]= $mRo[11];
		$xY[14]= $mRo[12];
		$xY[15]= $mRo[13];
		
		if (round($xY[14],2)>round($xY[13],2)){
			$RlA="; color:#FF0000";
		}
		else if (round($xY[14],2)<round($xY[13],2)){
			$RlA="; color:#0000FF";
		}
		else{
			$RlA="";
		}
		
		if (round($xY[15],2)>round($xY[13],2)){
			$RlB="; color:#FF0000";
		}
		else if (round($xY[15],2)<round($xY[13],2)){
			$RlB="; color:#0000FF";
		}
		else{
			$RlB="";
		}
		
		$xY12= $xY12+$mRo[10];
		$xY13= $xY13+$mRo[11];
		$xY14= $xY14+$mRo[12];
		$xY15= $xY15+$mRo[13];
		
		if ($KdA!=$KdB){
			if ($KdA==99){
				$xBB = "<b>.......????????";
			}
			else{
				$xBB = "<b>".strtoupper(fGlobal("Nm_Aset","ref_rek_aset1","Kd_Aset",$KdA,"=","",""));
			}
			HeaderR($xBB);
		}
		$rAS = substr($mRo[1],0,2);
		#echo $mRo[14]."<br>";
		$TbL  = fNmHuruf((int)$rAS);
		$rUPB = $gUNT;
		$rEF  = $mRo[0];
		$RefH = "";
		$rTH  = $TH2;
		
		$sM = "Y";
		if ($mRo[14]=='Sudah')
		{
			if ($mRo[15]=='MS')
			{
				$rEF = fGlobal("Referensi_To","ta_kib_post_mutasi","Referensi:Kd_UPB",$rEF.":".$rUPB."%","=:LIKE","","");
				$rUPB= substr(fGlobal("Kd_UPB_To","ta_kib_post_mutasi","Referensi:Kd_UPB:",$rEF.":".$rUPB."%","=:LIKE","",""),0,11);
				$sM = "N";
			}
			if ($mRo[15]=='PH')
			{
				$rEF = fGlobal("Referensi","ta_kib_post_mutasi","Referensi_To:Kd_UPB",$rEF.":".$rUPB."%","=:LIKE","","");
				$rUPB= $rUPB;
				$sM = "%";
			}
		}
		
		if ($TbL=="gX"){
			$Col11 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Referensi:Ref_History:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$rUPB."%:".$rEF.":".$RefH.":".((int)$rTH-1).":Y:IV:".$sM,"LIKE:=:=:=:=:=:LIKE","",DatabaseSB,$ConSB,"");
			$Col12 = fGlobalNEW("IfNull(sum(Beban_Tahun_Berjalan),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Referensi:Ref_History:PerLap:SdhMutasi",$rUPB."%:".$rEF.":".$RefH.":".$rTH.":".$sM,"LIKE:=:=:=:LIKE","",DatabaseSB,$ConSB,"");
			$ColDT = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0):IfNull(sum(Nilai_Buku),0):Ms_Manfaat_Sisa_Dlm_Bln","ta_kib_post_penyusutan_bulanan","Kd_UPB:Referensi:Ref_History:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$rUPB."%:".$rEF.":".$RefH.":".$rTH.":Y:IV:".$sM,"LIKE:=:=:=:=:=:LIKE","",DatabaseSB,$ConSB,"");
		}
		else{
			$Col11 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Referensi:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$rUPB."%:".$rEF.":".((int)$rTH-1).":Y:IV:".$sM,"LIKE:=:=:=:=:LIKE","",DatabaseSB,$ConSB,"");
			$Col12 = fGlobalNEW("IfNull(sum(Beban_Tahun_Berjalan),0)","ta_kib_post_penyusutan_bulanan","Kd_UPB:Referensi:PerLap:SdhMutasi",$rUPB."%:".$rEF.":".$rTH.":".$sM,"LIKE:=:=:LIKE","",DatabaseSB,$ConSB,"");
			$ColDT = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0):IfNull(sum(Nilai_Buku),0):Ms_Manfaat_Sisa_Dlm_Bln","ta_kib_post_penyusutan_bulanan","Kd_UPB:Referensi:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$rUPB."%:".$rEF.":".$rTH.":Y:IV:".$sM,"LIKE:=:=:=:=:LIKE","",DatabaseSB,$ConSB,"");
		}
		
		$ColDT = explode(":",$ColDT);
		$Col13 = $ColDT[0];
		if ($TbL=='gx'){
			$Col14 = ($Col09+$Col10)-$Col13;
		}
		else{
			$Col14 = $ColDT[1];
		}
		
		if (substr($xY[2],0,3)=="TNH"){
			$Col14 = $xY[14];
		}
		
		$Col15 = $ColDT[2];
		
		$xY16= $xY16+$Col11;
		$xY17= $xY17+$Col12;
		$xY18= $xY18+$Col13;
		$xY19= $xY19+$Col14;
		
		$x0  = fConvertDateShort(fGlobal("Tanggal","ta_kib_post_mutasi","referensi",$xY[2],"=","",""));
		
		DatarR($x0,$xY[1],$xY[2],$xY[3],$xY[4],$xY[5],$xY[6],$xY[7],$xY[8],$xY[9],$xY[10],$xY[11],$xY[12],$xY[13],$xY[14],$xY[15],$Col11,$Col12,$Col13,$Col14,$RlA,$RlB,$xB);
		$KdB=$KdA;
		$iG++;
	}
	?>
	<?php function DatarR($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$Col11,$Col12,$Col13,$Col14,$RlA,$RlB,$xB){?>
	  <tr height="20" style="vertical-align:top">
		<td style="border:1px #000000 solid; text-align:center"><?=$x1?>.</td>
		<td style="border:1px #000000 solid; text-align:center"><?=$x2?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=$x3?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=$x4?></td>
		<td style="border:1px #000000 solid; padding-left:3px"><?=$x5?></td>
		<td style="border:1px #000000 solid; padding-left:3px"><?=$x6?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=$x7?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=$x8?></td>
		<td style="border:1px #000000 solid; padding-left:5px"><?=$x9?></td>
		<td style="border:1px #000000 solid; text-align:center"><?=$x10?></td>
		<td style="border:1px #000000 solid; padding-left:5px"><?=$x11?></td>
		<td style="border:1px #000000 solid; text-align:center; background:#ffffcc"><?=$x0?></td>
		<td style="border:1px #000000 solid; text-align:right; padding-right:5px"><?=fConvertToRupiah($x12)?></td>
		<td style="border:1px #000000 solid; text-align:right; padding-right:5px"><?=fConvertToRupiah($x13)?></td>
	    <td style="border:1px #000000 solid; text-align:right; padding-right:5px <?=$RlA?>"><?=fConvertToRupiah($x14)?></td>
	    <td style="border:1px #000000 solid; text-align:right; padding-right:5px <?=$RlB?>"><?=fConvertToRupiah($x15)?></td>
	    <td style="border:1px #000000 solid; text-align:right; padding-right:5px; background:#ffffcc"><?=fConvertToRupiah($Col11)?></td>
	    <td style="border:1px #000000 solid; text-align:right; padding-right:5px; background:#ffffcc"><?=fConvertToRupiah($Col12)?></td>
	    <td style="border:1px #000000 solid; text-align:right; padding-right:5px; background:#ffffcc"><?=fConvertToRupiah($Col13)?></td>
	    <td style="border:1px #000000 solid; text-align:right; padding-right:5px; background:#ffffcc"><?=fConvertToRupiah($Col14)?></td>
	  </tr>
	<?php
	}
	?>
	<?php function HeaderR($xBB){?>
	  <tr height="20">
		<td style="border:1px #000000 solid; background: #CCCC99">&nbsp;</td>
		<td colspan="4" style="border:1px #000000 solid; background: #CCCC99"><?=$xBB?></td>
		<td style="border:1px #000000 solid; background: #CCCC99">&nbsp;</td>
		<td style="border:1px #000000 solid; background: #CCCC99">&nbsp;</td>
		<td style="border:1px #000000 solid; background: #CCCC99">&nbsp;</td>
		<td style="border:1px #000000 solid; background: #CCCC99">&nbsp;</td>
		<td style="border:1px #000000 solid; background: #CCCC99">&nbsp;</td>
		<td style="border:1px #000000 solid; background: #CCCC99">&nbsp;</td>
		<td style="border:1px #000000 solid; background: #CCCC99">&nbsp;</td>
		<td style="border:1px #000000 solid; background: #CCCC99">&nbsp;</td>
		<td style="border:1px #000000 solid; background: #CCCC99">&nbsp;</td>
		<td style="border:1px #000000 solid; background: #CCCC99">&nbsp;</td>
		<td style="border:1px #000000 solid; background: #CCCC99">&nbsp;</td>
	    <td style="border:1px #000000 solid; background: #CCCC99">&nbsp;</td>
	    <td style="border:1px #000000 solid; background: #CCCC99">&nbsp;</td>
	    <td style="border:1px #000000 solid; background: #CCCC99">&nbsp;</td>
	    <td style="border:1px #000000 solid; background: #CCCC99">&nbsp;</td>
	  </tr>
	<?php } ?>
  <tr height="25">
    <td colspan="12" style="border:1px #000000 solid; text-align:center; font-weight:bold">T O T A L</td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:5px"><?=fConvertToRupiah($xY12)?></td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:5px"><?=fConvertToRupiah($xY13)?></td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:5px <?=$ClA?>"><?=fConvertToRupiah($xY14)?></td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:5px <?=$ClB?>"><?=fConvertToRupiah($xY15)?></td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:5px; background:#ffffcc <?=$ClB?>"><?=fConvertToRupiah($xY16)?></td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:5px; background:#ffffcc <?=$ClB?>"><?=fConvertToRupiah($xY17)?></td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:5px; background:#ffffcc <?=$ClB?>"><?=fConvertToRupiah($xY18)?></td>
    <td style="border:1px #000000 solid; font-weight:bold; text-align:right; padding-right:5px; background:#ffffcc <?=$ClB?>"><?=fConvertToRupiah($xY19)?></td>
  </tr>
</table>
<table border="0" width="1830" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse">
	<?php 
	$gUpb = $gUNT;
	require "Dokumen_Footer.php";
	?>
	<tr>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
	  <td align="center">&nbsp;</td>
    </tr>
	<tr>
		<td width="50" align="center">&nbsp;</td>
		<td width="230" align="center">Mengetahui,</td>
		<td align="center">&nbsp;</td>
		<td align="center" width="230"><?php echo $NmIbKt.", ".fConvertDateLongsBln($Tg3)?></td>
		<td align="center" width="50">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
		<td width="230" align="center" style="font-weight: bold"><?php echo $FotA[1]?></td>
		<td align="center">&nbsp;</td>
		<td align="center" style="font-weight: bold" width="230"><?php echo $FotC[1]?></td>
		<td align="center" style="font-weight: bold" width="50">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center">&nbsp;</td>
		<td width="230" align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center" width="230">&nbsp;</td>
		<td align="center" width="50">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center">&nbsp;</td>
		<td width="230" align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center" width="230">&nbsp;</td>
		<td align="center" width="50">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center">&nbsp;</td>
		<td width="230" align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center" width="230">&nbsp;</td>
		<td align="center" width="50">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
		<td width="230" align="center" style="font-weight: bold"><u><?php echo $FotA[2]?></u></td>
		<td align="center">&nbsp;</td>
		<td align="center" style="font-weight: bold" width="230"><u><?php echo $FotC[2]?></u></td>
		<td align="center" style="font-weight: bold" width="50">&nbsp;</td>
	</tr>
	<tr>
		<td width="50" align="center">&nbsp;</td>
		<td width="230" align="center">NIP. <?php echo $FotA[3]?></td>
		<td align="center">&nbsp;</td>
		<td align="center" width="230">NIP. <?php echo $FotC[3]?></td>
		<td align="center" width="50">&nbsp;</td>
	</tr>
</table>
</div>