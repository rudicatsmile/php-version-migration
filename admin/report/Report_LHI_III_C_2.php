<?php
require('../Connection.php');
require('../FileFunction.php');
require("../CheckLogin.php");
#include "../zRepairData.php";
extract($_GET);

if ($ExT==''){$ExT="%";}
?>
<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:1650px; font-family:calibri; text-align:center; font-weight:bold; font-size:11pt">
<tr>
  	<td>REKAPITULASI LAPORAN HASIL INVENTARISASI </td>
</tr>

<tr>
	<td><?=$TiDaer." ".$NmDaer?></td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
</table>
<?php if ($fUnt!="00.00.00.00"){?>
<table align="center" cellpadding="0" cellspacing="0" border="0" width="1650" style="border-collapse:collapse; font-family:calibri; font-size:10pt; font-weight:normal">
<tr>
	<td width="70">UNIT</td>
	<td width="20">:</td>
	<td><?=fGlobal("Nm_Unit","ref_unit","Kd_Unit",$fUnt,"=","","")?></td>
</tr>
<tr>
	<td width="50">SUB UNIT</td>
	<td>:</td>
	<td><?php
	if ($fSub=='00.00.00.00.00'){
		echo "SEMUA";
	} else { 
		echo fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$fSub,"=","","");
	}
	?></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
<?php } ?>
<table align="center" cellpadding="0" cellspacing="0" border="0" width="1650" style="border-collapse:collapse; font-family:calibri; font-size:9pt">
<tr style="text-align:center; font-weight:bold; height:20px">
  <td width="36" rowspan="3" style="border:1px solid #000">No</td>
  <td rowspan="3" style="border:1px solid #000"><?php if ($fUnt=="00.00.00.00"){echo "SKPD";} else {echo "BIDANG";}?></td>
  <td colspan="13" style="border:1px solid #000">REKAP LHI </td>
  </tr>
<tr style="text-align:center; font-weight:bold; height:20px">
  <td style="border:1px solid #000">LHI (III.B.1)</td>
  <td style="border:1px solid #000">LHI (III.B.2)</td>
  <td style="border:1px solid #000">LHI (III.B.3)</td>
  <td style="border:1px solid #000">LHI (III.B.4)</td>
  <td style="border:1px solid #000">LHI (III.B.5)</td>
  <td style="border:1px solid #000">LHI (III.B.6)</td>
  <td style="border:1px solid #000">LHI (III.B.7)</td>
  <td style="border:1px solid #000">LHI (III.B.8)</td>
  <td style="border:1px solid #000">LHI (III.B.9)</td>
  <td style="border:1px solid #000">LHI (III.B.10)</td>
  <td style="border:1px solid #000">LHI (III.B.11)</td>
  <td style="border:1px solid #000">LHI (III.B.12)</td>
  <td style="border:1px solid #000">LHI (III.B.13)</td>
</tr>
<tr style="text-align:center; font-weight:bold; height:20px; vertical-align:top">
  <td width="100" style="border:1px solid #000">Rekapitulasi BMD Hilang Karena Kecurian</td>
  <td width="100" style="border:1px solid #000">Rekapitulasi BMD Tidak Ada Karena Tidak Ditemukan</td>
  <td width="100" style="border:1px solid #000">Rekapitulasi BMD Belum Dikapitalisasi dan Diketahui Data Awal/Data Induknya</td>
  <td width="100" style="border:1px solid #000">Rekapitulasi BMD Belum Dikapitalisasi dan Tidak Diketahui Data Awal/Data Induknya </td>
  <td width="100" style="border:1px solid #000">Rekapitulasi BMD Dalam Digunakan Oleh Pegawai Pemerintah Daerah Yang Bersangkutan </td>
  <td width="100" style="border:1px solid #000">Rekapitulasi BMD Dalam Digunakan Oleh Pemerintah Pusat/Pemerintah Daerah Lainnya/Pihak Lain</td>
  <td width="100" style="border:1px solid #000">Rekapitulasi BMD Terjadi Perubahan Kondisi Fisik Barang </td>
  <td width="100" style="border:1px solid #000">Rekapitulasi BMD Terkait Perubahan Data</td>
  <td width="100" style="border:1px solid #000">Rekapitulasi BMD Tercatat Ganda</td>
  <td width="100" style="border:1px solid #000">Rekapitulasi BMD Berdiri Diatas Tanah Bukan Milik Pemerintah Daerah</td>
  <td width="100" style="border:1px solid #000">Rekapitulasi BMD Belum Tercatat</td>
  <td width="100" style="border:1px solid #000">Rekapitulasi BMD Tidak Terjadi Perubahan Kondisi Fisik Barang</td>
  <td width="100" style="border:1px solid #000">Rekapitulasi BMD Kondisi Akhir Fisik Barang Sesudah Inventarisasi</td>
  </tr>
<?php
$iG=1;
$ttKiB = 0;
$ttKiS = 0;
$ttKiP = 0;
$ttKiN = 0;

if ($fUnt=="00.00.00.00")
{
	$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
} 
else 
{
	if ($fSub=='00.00.00.00.00')
	{
		$nSQ = "SELECT Kd_UPB, Nm_UPB FROM ref_upb WHERE Kd_UPB LIKE '".$fUnt."%' ORDER BY Kd_UPB";
	}
	else
	{
		$nSQ = "SELECT Kd_UPB, Nm_UPB FROM ref_upb WHERE Kd_UPB LIKE '".$fSub."%' ORDER BY Kd_UPB";
	}
}
#echo $nSQ;
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$KdE = $mRo[0];
	$B1 = fGlobal("count(*)","tb_lembar_kerja","KdUPB:KeberadaanBarang:KeberadaanBarang_tidakada:DataSensusFix",$KdE."%:tidakada:hilang:Y","LIKE:=:=:=","","");
	$B2 = fGlobal("count(*)","tb_lembar_kerja","KdUPB:KeberadaanBarang:KeberadaanBarang_tidakada:DataSensusFix",$KdE."%:tidakada:tidakditemukan:Y","LIKE:=:=:=","","");
	$B3 = fGlobal("count(*)","tb_lembar_kerja","KdUPB:KeberadaanBarang:MerupakanAtribusi:MerupakanAtribusi_induk:DataSensusFix",$KdE."%:ada:ya:diketahui:Y","LIKE:=:=:=:=","","");
	$B4 = fGlobal("count(*)","tb_lembar_kerja","KdUPB:KeberadaanBarang:MerupakanAtribusi:MerupakanAtribusi_induk:DataSensusFix",$KdE."%:ada:ya:tidakdiketahui:Y","LIKE:=:=:=:=","","");
	$B5 = fGlobal("count(*)","tb_lembar_kerja","KdUPB:KeberadaanBarang:MerupakanAtribusi:DataSensusFix",$KdE."%:ada:%:Y","LIKE:=:LIKE:=","","");
	
	$B6 = fGlobal("count(*)","tb_lembar_kerja","KdUPB:KeberadaanBarang:PenggunaanBarang:DataSensusFix",$KdE."%:ada:PL:Y","LIKE:=:=:=","","");
	$B6 = $B6+fGlobal("count(*)","tb_lembar_kerja","KdUPB:KeberadaanBarang:PenggunaanBarang:DataSensusFix",$KdE."%:ada:PDL:Y","LIKE:=:=:=","","");
	
	$nSQ = "SELECT count(*) as A FROM tb_lembar_kerja WHERE KdUPB LIKE '".$KdE."%' AND KeberadaanBarang='ada' AND KondisiBarangAsal<>KondisiBarang AND DataSensusFix='Y'";
	$rs = mysql_query($nSQ);
	$mR = mysql_fetch_array($rs, MYSQL_BOTH);
	$B7 = $mR[0];
	
	$nSQ = "SELECT count(*) as A FROM tb_lembar_kerja WHERE KdUPB LIKE '".$KdE."%' 
	AND KeberadaanBarang='ada' 
	AND (KdRegister='tidaksesuai' OR KdBarang='tidaksesuai' OR NmBarang='tidaksesuai' OR SpecNamaBarang='tidaksesuai' OR Alamat='tidaksesuai') AND DataSensusFix='Y'";
	$rs = mysql_query($nSQ);
	$mR = mysql_fetch_array($rs, MYSQL_BOTH);
	$B8 = $mR[0];
	
	$B9 = fGlobal("count(*)","tb_lembar_kerja","KdUPB:KeberadaanBarang:DataTercatatGanda:DataSensusFix",$KdE."%:ada:ya:Y","LIKE:=:LIKE:=","","");
	
	$nSQ = "SELECT count(*) as A FROM tb_lembar_kerja WHERE KdUPB LIKE '".$KdE."%' 
	AND KeberadaanBarang='ada' 
	AND (DiatasTanahMilik='PDL' OR DiatasTanahMilik='PP' OR DiatasTanahMilik='PL') 
	AND (Referensi LIKE 'BNG.%' OR Referensi LIKE 'JLN.%') 
	AND DataSensusFix='Y'";
	$rs = mysql_query($nSQ);
	$mR = mysql_fetch_array($rs, MYSQL_BOTH);
	$B10 = $mR[0];
	
	$B11 = fGlobal("count(*)","tb_lembar_kerja_belum_tercatat","KdUPB:DataSensusFix",$KdE."%:Y","LIKE:=","","");
	
	$nSQ = "SELECT count(*) as A FROM tb_lembar_kerja WHERE KdUPB LIKE '".$KdE."%' AND KeberadaanBarang='ada' AND KondisiBarangAsal=KondisiBarang AND DataSensusFix='Y'";
	$rs = mysql_query($nSQ);
	$mR = mysql_fetch_array($rs, MYSQL_BOTH);
	$B12 = $mR[0];
	
	$nSQ = "SELECT count(*) as A FROM tb_lembar_kerja WHERE KdUPB LIKE '".$KdE."%' AND KeberadaanBarang='ada' AND KondisiBarangAsal<>KondisiBarang AND DataSensusFix='Y'";
	$rs = mysql_query($nSQ);
	$mR = mysql_fetch_array($rs, MYSQL_BOTH);
	$B13 = $mR[0];
	
	$tB1 = $tB1+$B1;
	$tB2 = $tB2+$B2;
	$tB3 = $tB3+$B3;
	$tB4 = $tB4+$B4;
	$tB5 = $tB5+$B5;
	$tB6 = $tB6+$B6;
	$tB7 = $tB7+$B7;
	$tB8 = $tB8+$B8;
	$tB9 = $tB9+$B9;
	$tB10 = $tB10+$B10;
	$tB11 = $tB11+$B11;
	$tB12 = $tB12+$B12;
	$tB13 = $tB13+$B13;
	?>
	<tr height="22">
	  <td style="border:1px solid #000; text-align:center"><?=$iG?>.</td>
	  <td style="border:1px solid #000; padding-left:3px"><?=$mRo[1]?></td>
	  <td style="border:1px solid #000; text-align:center"><?php if ($B1>0){echo fConvertToRupiahBulat($B1);}?></td>
	  <td style="border:1px solid #000; text-align:center"><?php if ($B2>0){echo fConvertToRupiahBulat($B2);}?></td>
	  <td style="border:1px solid #000; text-align:center"><?php if ($B3>0){echo fConvertToRupiahBulat($B3);}?></td>
	  <td style="border:1px solid #000; text-align:center"><?php if ($B4>0){echo fConvertToRupiahBulat($B4);}?></td>
	  <td style="border:1px solid #000; text-align:center"><?php if ($B5>0){echo fConvertToRupiahBulat($B5);}?></td>
	  <td style="border:1px solid #000; text-align:center"><?php if ($B6>0){echo fConvertToRupiahBulat($B6);}?></td>
	  <td style="border:1px solid #000; text-align:center"><?php if ($B7>0){echo fConvertToRupiahBulat($B7);}?></td>
	  <td style="border:1px solid #000; text-align:center"><?php if ($B8>0){echo fConvertToRupiahBulat($B8);}?></td>
	  <td style="border:1px solid #000; text-align:center"><?php if ($B9>0){echo fConvertToRupiahBulat($B9);}?></td>
	  <td style="border:1px solid #000; text-align:center"><?php if ($B10>0){echo fConvertToRupiahBulat($B10);}?></td>
	  <td style="border:1px solid #000; text-align:center"><?php if ($B11>0){echo fConvertToRupiahBulat($B11);}?></td>
	  <td style="border:1px solid #000; text-align:center"><?php if ($B12>0){echo fConvertToRupiahBulat($B12);}?></td>
	  <td style="border:1px solid #000; text-align:center"><?php if ($B13>0){echo fConvertToRupiahBulat($B13);}?></td>
	</tr>
	<?php
	$iG++;
}
?>
<tr height="26" style="text-align:center; font-weight:bold">
  <td colspan="2" style="border:1px solid #000">Jumlah</td>
  <td style="border:1px solid #000; text-align:center"><?php if ($tB1>0){echo fConvertToRupiahBulat($tB1);}?></td>
  <td style="border:1px solid #000; text-align:center"><?php if ($tB2>0){echo fConvertToRupiahBulat($tB2);}?></td>
  <td style="border:1px solid #000; text-align:center"><?php if ($tB3>0){echo fConvertToRupiahBulat($tB3);}?></td>
  <td style="border:1px solid #000; text-align:center"><?php if ($tB4>0){echo fConvertToRupiahBulat($tB4);}?></td>
  <td style="border:1px solid #000; text-align:center"><?php if ($tB5>0){echo fConvertToRupiahBulat($tB5);}?></td>
  <td style="border:1px solid #000; text-align:center"><?php if ($tB6>0){echo fConvertToRupiahBulat($tB6);}?></td>
  <td style="border:1px solid #000; text-align:center"><?php if ($tB7>0){echo fConvertToRupiahBulat($tB7);}?></td>
  <td style="border:1px solid #000; text-align:center"><?php if ($tB8>0){echo fConvertToRupiahBulat($tB8);}?></td>
  <td style="border:1px solid #000; text-align:center"><?php if ($tB9>0){echo fConvertToRupiahBulat($tB9);}?></td>
  <td style="border:1px solid #000; text-align:center"><?php if ($tB10>0){echo fConvertToRupiahBulat($tB10);}?></td>
  <td style="border:1px solid #000; text-align:center"><?php if ($tB11>0){echo fConvertToRupiahBulat($tB11);}?></td>
  <td style="border:1px solid #000; text-align:center"><?php if ($tB12>0){echo fConvertToRupiahBulat($tB12);}?></td>
  <td style="border:1px solid #000; text-align:center"><?php if ($tB13>0){echo fConvertToRupiahBulat($tB13);}?></td>
</tr>
</table>
<table align="center" cellpadding="0" cellspacing="0" border="0" width="1650" style="font-family:calibri; font-size:10pt">
  <tr>
    <td width="436">&nbsp;</td>
    <td >&nbsp;</td>
    <td width="481">&nbsp;</td>
  </tr>
  <tr height="20">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr height="20">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center"><?=$NmIbuk?>, <?=$fHR." ".fNmBulan((int)$fBL)." ".$fTH?></td>
  </tr>
	<?php
	if ($fUnt=="00.00.00.00")
	{
		$Tit = "Pengelola Barang,";
	  	$Nma = fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit","25.08.13.04","=","","");
		$Nip = fGlobal("Nip_Pimpinan","ref_unit","Kd_Unit","25.08.13.04","=","","");
	}
	else
	{
		$Tit = "Pengguna Barang,";
	  	$Nma = fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit",substr($fUnt,0,11),"=","","");
		$Nip = fGlobal("Nip_Pimpinan","ref_unit","Kd_Unit",substr($fUnt,0,11),"=","","");
	}
	
	$LeN = strlen($Nma);
	
	?>
  
  <tr height="20">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center"><?=$Tit?></td>
  </tr>
  <tr height="70">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" style="font-weight:bold; text-decoration:underline"><?=$Nma?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">NIP. <?=$Nip?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
