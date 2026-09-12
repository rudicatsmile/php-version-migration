<?php
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";
extract($_GET);
/*
echo $gA.":";
echo $gB.":";
echo $gC.":";
echo $gD.":";
echo $gE.":";
echo $gF.":";
echo $gG;
*/
#echo $JnM;
?>
<table border="0" width="1900" cellspacing="1" align="center" style=" font-size: 10pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td style="font-size: 13pt; font-weight: bold" align="center">DAFTAR MUTASI KELUAR</td>
</tr>
</table>
<table border="0" width="1900" cellspacing="1" align="center" style=" font-size: 10pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td width="100">SKPD</td>
  <td width="30">:</td>
  <td><?=fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",$gUnt,"=","",$DatabaseSB,$ConSB,"")?></td>
</tr>
<tr>
  <td>KABUPATEN</td>
  <td>:</td>
  <td><?=$NmDaer?></td>
</tr>
<tr>
  <td>TAHUN</td>
  <td>:</td>
  <td><?=$gThn?></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
<table border="0" width="1900" cellspacing="0" cellpadding="0" align="center" style="font-size: 9pt; font-family: Calibri; border-collapse: collapse">
<tr height="18" style="font-weight:bold">
  <td colspan="3" rowspan="2" style="border:1px solid #000; text-align:center">N O M O R</td>
  <td rowspan="3" style="border:1px solid #000; text-align:center">NAMA BARANG</td>
  <td colspan="2" rowspan="2" style="border:1px solid #000; text-align:center">T A N G G A L</td>
  <td colspan="10" style="border:1px solid #000; text-align:center">S P E S I F I K A S I</td>
  <td colspan="2" rowspan="2" style="border:1px solid #000; text-align:center">N I L A I</td>
  <td rowspan="3" style="border:1px solid #000; text-align:center">KETERANGAN</td>
</tr>
<tr height="18" style="font-weight:bold">
  <td rowspan="2" style="border:1px solid #000; text-align:center">Letak/Alamat</td>
  <td colspan="2" style="border:1px solid #000; text-align:center">Sertifikat / Dokumen </td>
  <td rowspan="2" style="border:1px solid #000; text-align:center">Konstruksi</td>
  <td rowspan="2" style="border:1px solid #000; text-align:center">Merk/Tipe</td>
  <td style="border:1px solid #000; text-align:center">Nomor</td>
  <td rowspan="2" style="border:1px solid #000; text-align:center">Bahan</td>
  <td colspan="3" style="border:1px solid #000; text-align:center">Ukuran</td>
  </tr>
<tr style="font-weight:bold">
  <td style="border:1px solid #000; text-align:center">No.</td>
  <td style="border:1px solid #000; text-align:center">Kode</td>
  <td style="border:1px solid #000; text-align:center">Register</td>
  <td style="border:1px solid #000; text-align:center">Perolehan</td>
  <td style="border:1px solid #000; text-align:center">Mutasi</td>
  <td style="border:1px solid #000; text-align:center">Tanggal</td>
  <td style="border:1px solid #000; text-align:center">Nomor</td>
  <td style="border:1px solid #000; text-align:center">Polisi, Pabrik,<br>Chasis, Mesin,<br>BPKB</td>
  <td style="border:1px solid #000; text-align:center">Panjang<br>(m)</td>
  <td style="border:1px solid #000; text-align:center">Lebar<br>(m)</td>
  <td style="border:1px solid #000; text-align:center">Luas<br>(m<sup>2</sup>)</td>
  <td style="border:1px solid #000; text-align:center">Awal</td>
  <td style="border:1px solid #000; text-align:center">Akhir</td>
</tr>
<tr height="18">
  <td width="25" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">1</td>
  <td width="100" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">2</td>
  <td width="55" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">3</td>
  <td style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">4</td>
  <td width="70" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">5</td>
  <td width="70" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">6</td>
  <td width="170" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">7</td>
  <td width="70" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">8</td>
  <td width="140" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">9</td>
  <td width="100" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">10</td>
  <td width="100" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">11</td>
  <td width="100" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">12</td>
  <td width="100" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">13</td>
  <td width="50" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">14</td>
  <td width="50" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">15</td>
  <td width="50" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">16</td>
  <td width="110" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">17</td>
  <td width="110" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">18</td>
  <td width="210" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">19</td>
</tr>
<?php
$rCL = array();
function ClrVr()
{
	for ($i=1; $i<=19; $i++)
	{
		if ($i==14 || $i==15 || $i==16 || $i==17 || $i==18){
			$rCL = 0;
		}
		else{
			$rCL = "";
		}
	}
}

if ($JnM=='ALL'){$JnM="%";}
if ($Ast=='ALL'){$Ast="%";}

$iGG=1;
$SQL="SELECT P1.IDT as A0,
P1.Referensi as A1,
P1.Referensi_To as A2,
P1.Ref_Usulan as A3,
P1.Ref_Group as A4,
P1.Ref_History as A5,
P1.Kd_UPB as A6,
P1.Kd_UPB_To as A7,
P1.Kd_Aset as A8,
P1.Kd_Aset_To as A9,
P1.Kd_Aset_108 as A10,
P1.Kd_Aset_108_To as A11,
P1.No_Register as A12,
P1.No_Pengadaan as A13,
P1.Nm_Aset as A14,
P1.Tgl_Perolehan as A15,
P1.Tgl_Mutasi as A16,
P1.Tgl_Mutasi_Masuk as A17,
P1.Luas_M2 as A18,
concat(P1.Lokasi,'<br>',P1.Alamat) as A19,
P1.Hak_Tanah as A20,
P1.Sertifikat as A21,
P1.Sertifikat_Tanggal as A22,
P1.Sertifikat_Nomor as A23,
P1.Penggunaan as A24,
P1.Asal_Usul as A25,
P1.Kondisi as A26,
P1.Harga as A27,
P1.Keterangan as A28,
P1.No_SP2D as A29,
P1.Kd_Ruang as A30,
P1.Merk as A31,
P1.Type as A32,
P1.Ukuran_CC as A33,
P1.Bahan as A34,
P1.Nomor_Pabrik as A35,
P1.Nomor_Rangka as A36,
P1.Nomor_Mesin as A37,
P1.Nomor_Polisi as A38,
P1.Nomor_Polisi_Lama as A39,
P1.Nomor_BPKB as A40,
P1.Pemegang as A41,
P1.Pemegang_Lama as A42,
P1.Nilai_Akhir as A43,
P1.Bertingkat as A44,
P1.Beton as A45,
P1.Luas_Lantai as A46,
P1.Lokasi as A47,
P1.Dokumen_Tanggal as A48,
P1.Dokumen_Nomor as A49,
P1.Status_Tanah as A50,
P1.Luas_Tanah as A51,
P1.Kode_Tanah as A52,
P1.Konstruksi as A53,
P1.Panjang as A54,
P1.Lebar as A55,
P1.Luas as A56,
P1.Judul as A57,
P1.Spesifikasi as A58,
P1.Pencipta as A59,
P1.Daerah_Asal as A60,
P1.Jenis as A61,
P1.Ukuran as A62,
P1.Tahun as A63,
P1.Tgl_Mulai as A64,
P1.Tipe_Bangunan as A65,
P2.Deskripsi as A66 
FROM ta_kib_108_mutasi P1 
LEFT JOIN ref_usulan_jenis P2 ON P2.Kode=P1.Jns_Mutasi 
WHERE P1.Kd_UPB LIKE '".$gUnt."%' AND P1.Tgl_Mutasi LIKE '".$gThn."-%-%' 
AND P1.Jns_Mutasi LIKE '".$JnM."' AND P1.Kd_Aset_108 LIKE '".$Ast."%'
ORDER BY P1.Referensi";
#AND Kd_UPB_To<>'' AND Kd_UPB_To<>Kd_UPB AND Kd_Aset_108_To=Kd_Aset_108 
#echo $SQL."<br>";
$nRs = mysql_query($SQL);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	ClrVr();
	$xB = "<b>";
	$rRef   = $mRo[1];
	$rUpb   = $mRo[6];
	$rAsT   = $mRo[10];
	
	$rCL[1] = $iGG;
	$rCL[2] = $mRo[10];
	$rCL[3] = $mRo[12];
	$rCL[4] = $mRo[14];
	$rCL[5] = $mRo[15];
	$rCL[6] = $mRo[16];
	$rCL[7] = $mRo[19];
	$rCL[8] = $mRo[22];
	$rCL[9] = $mRo[23];
	$rCL[10]= $mRo[53];
	$rCL[11]= $mRo[31];
	if ($mRo[32]!='-' && $mRo[32]!=''){
		$rCL[11].= " / ".$mRo[32];
	}
	
	$rCL[12]= $mRo[38];
	$rCL[12].= " ".$mRo[35];
	$rCL[12].= " ".$mRo[36];
	$rCL[12].= " ".$mRo[37];
	$rCL[12].= " ".$mRo[39];
	$rCL[12].= " ".$mRo[40];
	
	$rCL[13]= $mRo[34];
	
	$rCL[14]= $mRo[54];
	$rCL[15]= $mRo[55];
	$rCL[16]= $mRo[56];
	
	$rCL[17]= $mRo[27];
	
	$rCL[18] = fGlobal("IfNull(sum(debet),0)","ta_kib_post_108_mutasi","referensi:kd_upb",$rRef.":".$rUpb,"=:=","","");
	
	$rCL[19] = "Referensi: ".$rRef;
	$rCL[19].= "<br>Mutasi: ".$mRo[66];
	
	ShowDATA($rCL[1],$rCL[2],$rCL[3],$rCL[4],$rCL[5],$rCL[6],$rCL[7],$rCL[8],$rCL[9],$rCL[10],$rCL[11],$rCL[12],$rCL[13],$rCL[14],$rCL[15],$rCL[16],$rCL[17],$rCL[18],$rCL[19],$xB);
	$iGG++;
	
	$rCL18 = $rCL18 + $rCL[18];
}

?>
<?php function ShowDATA($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18,$x19,$xB) {?>
<tr height="18" valign="top">
  <td style="border:1px solid #000; text-align:center"><?=$x1?>.</td>
  <td style="border:1px solid #000; text-align:center"><?=$x2?></td>
  <td style="border:1px solid #000; text-align:center"><?=$x3?></td>
  <td style="border:1px solid #000; padding-left:3px"><?=$x4?></td>
  <td style="border:1px solid #000; text-align:center"><?php if ($x5!='0000-00-00'){echo fConvertDateShort($x5);}?></td>
  <td style="border:1px solid #000; text-align:center"><?php if ($x6!='0000-00-00'){echo fConvertDateShort($x6);}?></td>
  <td style="border:1px solid #000; padding-left:3px"><?=$x7?></td>
  <td style="border:1px solid #000; text-align:center"><?php if ($x8!='0000-00-00'){echo fConvertDateShort($x8);}?></td>
  <td style="border:1px solid #000; padding-left:3px"><?=$x9?></td>
  <td style="border:1px solid #000; padding-left:3px"><?=$x10?></td>
  <td style="border:1px solid #000; padding-left:3px"><?=$x11?></td>
  <td style="border:1px solid #000; padding-left:3px"><?=$x12?></td>
  <td style="border:1px solid #000; padding-left:3px"><?=$x13?></td>
  <td style="border:1px solid #000; text-align:center"><?php if ($x14!='0' || $x14!='0.00') {echo $x14;}?></td>
  <td style="border:1px solid #000; text-align:center"><?php if ($x15!='0' || $x15!='0.00') {echo $x15;}?></td>
  <td style="border:1px solid #000; text-align:center"><?php if ($x16!='0' || $x16!='0.00') {echo $x16;}?></td>
  <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($x17)?></td>
  <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($x18)?></td>
  <td style="border:1px solid #000; padding-left:3px; font-style:italic"><?=$x19?></td>
</tr>
<?php } ?>
<tr>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
</tr>
<tr height="25" style="font-weight:bold">
  <td colspan="16" style="border:1px solid #000; border-top:2px solid #000; text-align:center">TOTAL</td>
  <td style="border:1px solid #000; border-top:2px solid #000; text-align:right; padding-right:3px">&nbsp;</td>
  <td style="border:1px solid #000; border-top:2px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($rCL18)?></td>
  <td style="border:1px solid #000; border-top:2px solid #000">&nbsp;</td>
</tr>
</table>
