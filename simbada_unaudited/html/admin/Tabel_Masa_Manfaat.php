<?
require "Connection.php";
require "FileFunction.php";

$Ref = $_GET['ref'];
$rTH = $_GET['rTH'];

$nSQ ="SELECT Kd_Aset, Kd_UPB FROM ta_kib_post WHERE Referensi = '$Ref' LIMIT 0,1";
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$KdA = $mRo[0];
	$KdU = $mRo[1];
}

$gLaP= 2014;

$gUnt  = substr($KdU,0,11);
$frHri = date('d');
$frBln = date('m');
$frThn = date('Y');
?>
<table border="0" align="center" width="1300" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td style="font-size: 12pt; font-weight: bold" align="center">TABEL PENYUSUTAN &amp; MASA MANFAAT </td>
</tr>
<tr>
  <td style="font-size: 11pt; font-weight: bold" align="center">UPB : <?=strtoupper(fGlobalNEW("Nm_UPB","ref_upb","Kd_UPB",$KdU,"=","",DatabaseSB,$ConSB,""))?></td>
</tr>
<tr>
  <td style="font-size: 10pt; font-weight: bold" align="center">PER 31 DESEMBER <?=$rTH?></td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
</table>
<table border="0" align="center" width="1300" cellspacing="1" style="font-size: 8pt; font-weight:bold; font-family: Calibri; border-collapse: collapse">
<tr>
  <td width="70">BIDANG</td>
  <td width="20">:</td>
  <td><?=substr($KdA,0,2)?>&nbsp;-&nbsp;<?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset1","Kd_Aset",substr($KdA,0,2),"=","",DatabaseSB,$ConSB,""))?></td>
</tr>
<tr>
  <td>KELOMPOK</td>
  <td>:</td>
  <td><?=substr($KdA,0,5)?>&nbsp;-&nbsp;<?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset2","Kd_Aset",substr($KdA,0,5),"=","",DatabaseSB,$ConSB,""))?></td>
</tr>
<tr>
  <td>JENIS</td>
  <td>:</td>
  <td><?=substr($KdA,0,8)?>&nbsp;-&nbsp;<?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset3","Kd_Aset",substr($KdA,0,8),"=","",DatabaseSB,$ConSB,""))?></td>
</tr>
<tr>
  <td>OBJEK</td>
  <td>:</td>
  <td><?=substr($KdA,0,11)?>&nbsp;-&nbsp;<?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset4","Kd_Aset",substr($KdA,0,11),"=","",DatabaseSB,$ConSB,""))?></td>
</tr>
<tr>
  <td>RINCIAN</td>
  <td>:</td>
  <td><?=substr($KdA,0,15)?>&nbsp;-&nbsp;<?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset5","Kd_Aset",substr($KdA,0,15),"=","",DatabaseSB,$ConSB,""))?></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
<!--###-->
<table border="0" align="center" width="1300" cellspacing="0" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td width="32" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">No.<br>Urut</td>
  <td width="37" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Tahun Pela<br>poran</td>
  <td width="141" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Uraian</td>
  <td width="54" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Tahun Pengadaan/ Atribusi</td>
  <td width="59" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid"> Mulai Penyusutan</td>
  <td width="76" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Harga<br>Perolehan<br>Awal</td>
  <td colspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Masa<br>Manfaat</td>
  <td width="75" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Penambahan<br>Nilai</td>
  <td width="47" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Prosen tase <br>(%)</td>
  <td colspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Penambahan<br>Masa Manfaat</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">Masa Manfaat Baru</td>
  <td width="92" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Penyusutan<br>Perhari </td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">Masa Manfaat<br>Yang Telah Dilalui</td>
  <td width="83" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Beban</td>
  <td width="95" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Akumulasi<br>Penyusutan</td>
  <td width="92" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Nilai Buku</td>
  <td width="59" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">Sisa Masa Manfaat (hari)</td>
</tr>
<tr>
  <td width="35" style="text-align:center; font-weight:bold; border:1px #000000 solid">Tahun</td>
  <td width="42" style="text-align:center; font-weight:bold; border:1px #000000 solid">Hari</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">Tahun</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">Hari</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">Hari</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">Hari</td>
</tr>
<tr height="20" style="background:#CCCCFF">
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">0</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">1</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">2</td>
  <td colspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">3</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">4</td>
  <td colspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">5</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">6</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">7</td>
  <td colspan="2" style="text-align:center; font-weight:bold; border:1px #000000 solid">8</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">9</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">10</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">11</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">12</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">13</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">14</td>
  <td style="text-align:center; font-weight:bold; border:1px #000000 solid">15</td>
</tr>
<?
$iG=1;
$yCL4  = 0;
$yCL6  = 0;
$yCL8h = 0;
$yCL11 = 0;
$yCL11h= 0;
$yCL12 = 0;
$yCL13 = 0;
$yCL14 = 0;

/*
$nSQ ="SELECT Referensi,IndexData,Kd_UPB,Kd_Aset,No_Register,PerLap,Tahun,Tanggal,Nilai_Perolehan,Ms_Manfaat_Old,Ms_Manfaat_Old_Dlm_Hri,Nilai_Tambah,Prosentase,
Ms_Manfaat_Add,Ms_Manfaat_Add_Dlm_Hri,Ms_Manfaat_New,Ms_Manfaat_New_Dlm_Hri,Penyusutan,Ms_Manfaat_Telah_Dilalui,Ms_Manfaat_Telah_Dilalui_Dlm_Hri,
Beban_Tahun_Berjalan,Koreksi_Akumulasi,Nilai_Buku,Uraian,Nilai_Akhir, Ms_Manfaat_Sisa_Dlm_Hri 
FROM ta_kib_post_penyusutan WHERE Referensi = '$Ref' AND Tanggal<='2014-12-31' ORDER BY Tahun, IndexData";
*/

$nSQ ="SELECT Referensi,IndexData,Kd_UPB,Kd_Aset,No_Register,PerLap,Tahun,Tanggal,Nilai_Perolehan,Ms_Manfaat_Old,Ms_Manfaat_Old_Dlm_Hri,Nilai_Tambah,Prosentase,
Ms_Manfaat_Add,Ms_Manfaat_Add_Dlm_Hri,Ms_Manfaat_New,Ms_Manfaat_New_Dlm_Hri,Penyusutan,Ms_Manfaat_Telah_Dilalui,Ms_Manfaat_Telah_Dilalui_Dlm_Hri,
Beban_Tahun_Berjalan,Koreksi_Akumulasi,Nilai_Buku,Uraian,Nilai_Akhir, Ms_Manfaat_Sisa_Dlm_Hri 
FROM ta_kib_post_penyusutan WHERE Referensi = '$Ref' AND PerLap <='$rTH' ORDER BY PerLap, IndexData";
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$CL0  = $iG;
	$CL1  = $mRo['PerLap'];
	$CL2  = $mRo['Uraian'];
	$CL3  = $mRo['Tahun'];
	$CL3h = $mRo['Tanggal'];
	$CL4  = $mRo['Nilai_Perolehan'];
	$CL5  = $mRo['Ms_Manfaat_Old'];
	$CL5h = $mRo['Ms_Manfaat_Old_Dlm_Hri'];
	$CL6  = $mRo['Nilai_Tambah'];
	$CL7  = $mRo['Prosentase'];
	$CL8  = $mRo['Ms_Manfaat_Add'];
	$CL8h = $mRo['Ms_Manfaat_Add_Dlm_Hri'];
	$CL9  = $mRo['Ms_Manfaat_New'];
	$CL9h = $mRo['Ms_Manfaat_New_Dlm_Hri'];
	$CL10 = $mRo['Penyusutan'];
	$CL11 = $mRo['Ms_Manfaat_Telah_Dilalui'];
	$CL11h= $mRo['Ms_Manfaat_Telah_Dilalui_Dlm_Hri'];
	$CL12 = $mRo['Beban_Tahun_Berjalan'];
	$CL13 = $mRo['Koreksi_Akumulasi'];
	$CL14 = $mRo['Nilai_Buku'];
	$CL15h= $mRo['Ms_Manfaat_Sisa_Dlm_Hri'];
	
	
	//$newdate = strtotime ( '+47 year' , strtotime ( $CL3h ) ) ;
	//$newdate = date ( 'Y-m-j' , $newdate );
	//echo $newdate."<br>";
	//echo mktime(0, 0, 0, date("m"), date("d"), date("Y")+21)."<br>";
	
	//$CL3G = "1991-01-01";
	//$rDT = split("-",$CL3G);
	//$year2 = $rDT[0];
	//$month2= $rDT[1];
	//$date2 = $rDT[2];
	
	//echo makedate('Y-m-d',GregorianToJD($month2,$date2,$year2+10))."<br>";
	?>
	<tr height="23">
	  <td style="vertical-align:top; text-align:center; border:1px #000000 solid"><?=$CL0?>.</td>
	  <td style="vertical-align:top; text-align:center; border:1px #000000 solid"><?=$CL1?></td>
	  <td style="vertical-align:top; border:1px #000000 solid"><?=$CL2?></td>
	  <td style="vertical-align:top; text-align:center; border:1px #000000 solid"><?=$CL3?></td>
	  <td style="vertical-align:top; text-align:center; border:1px #000000 solid"><?=fConvertDateShort($CL3h)?></td>
	  <td style="vertical-align:top; text-align:right; border:1px #000000 solid; padding-right:2px"><? if ($CL4!=0) {echo fConvertToRupiahBulat($CL4);}else {echo "-";}?></td>
	  <td style="vertical-align:top; text-align:center; border:1px #000000 solid"><? if ($CL5!=0) {echo $CL5;} else {echo "-";}?></td>
	  <td style="vertical-align:top; text-align:center; border:1px #000000 solid"><? if ($CL5h!=0) {echo fConvertToRupiahBulat($CL5h);} else {echo "-";}?></td>
	  <td style="vertical-align:top; text-align:right; border:1px #000000 solid; padding-right:2px"><? if ($CL6!=0) {echo fConvertToRupiahBulat($CL6);} else {echo "-";}?></td>
	  <td style="vertical-align:top; text-align:center; border:1px #000000 solid"><? if ($CL7!=0) {echo fConvertToRupiah($CL7);} else {echo "-";}?></td>
	  <td width="44" style="vertical-align:top; text-align:center; border:1px #000000 solid"><? if ($CL8!=0) {echo $CL8;} else {echo "-";}?></td>
	  <td width="67" style="vertical-align:top; text-align:center; border:1px #000000 solid"><? if ($CL8h!=0) {echo fConvertToRupiahBulat($CL8h);} else {echo "-";}?></td>
	  <td width="80" style="vertical-align:top; text-align:center; border:1px #000000 solid"><? if ($CL9h!=0) {echo fConvertToRupiahBulat($CL9h);} else {echo "-";}?></td>
	  <td style="vertical-align:top; text-align:right; border:1px #000000 solid; padding-right:2px"><?=fConvertToRupiah($CL10)?></td>
	  <td width="52" style="vertical-align:top; text-align:center; border:1px #000000 solid"><? if ($CL11h!=0) {echo fConvertToRupiahBulat($CL11h);} else {echo "-";}?></td>
	  <td style="vertical-align:top; text-align:right; border:1px #000000 solid; padding-right:2px"><? if ($CL12!=0) {echo fConvertToRupiah($CL12);} else {echo "-";}?></td>
	  <td style="vertical-align:top; text-align:right; border:1px #000000 solid; padding-right:2px"><?=fConvertToRupiah($CL13)?></td>
	  <td style="vertical-align:top; text-align:right; border:1px #000000 solid; padding-right:2px"><?=fConvertToRupiah($CL14)?></td>
	  <td style="vertical-align:top; text-align:right; border:1px #000000 solid; padding-right:2px"><?=fConvertToRupiahBulat($CL15h)?></td>
	</tr>
	<?
	$yCL4  = $yCL4 + $CL4;
	$yCL6  = $yCL6 + $CL6;
	$yCL8h = $yCL8h + $CL8h;
	$yCL11 = $yCL11 + $CL11;
	$yCL11h= $yCL11h + $CL11h;
	$yCL12 = $yCL12 + $CL12;
	$yCL13 = $CL13;
	$yCL14 = $CL14;
	$iG++;
}
?>
<tr height="25">
  <td colspan="5" style="text-align:center; font-weight:bold; border:1px #000000 solid; border-top:3px #000000 double">TOTAL</td>
  <td style="font-weight:bold; text-align:right; border:1px #000000 solid; border-top:3px #000000 double; padding-right:2px"><?=fConvertToRupiahBulat($yCL4)?></td>
  <td colspan="2" style="font-weight:bold; border:1px #000000 solid; border-top:3px #000000 double">&nbsp;</td>
  <td style="font-weight:bold; text-align:right; border:1px #000000 solid; border-top:3px #000000 double; padding-right:2px"><?=fConvertToRupiahBulat($yCL6)?></td>
  <td colspan="2" style="font-weight:bold; border:1px #000000 solid; border-top:3px #000000 double">&nbsp;</td>
  <td style="font-weight:bold; text-align:center; border:1px #000000 solid; border-top:3px #000000 double"><?=fConvertToRupiahBulat($yCL8h)?></td>
  <td colspan="2" style="font-weight:bold; border:1px #000000 solid; border-top:3px #000000 double">&nbsp;</td>
  <td style="font-weight:bold; text-align:center; border:1px #000000 solid; border-top:3px #000000 double"><?=fConvertToRupiahBulat($yCL11h)?></td>
  <td style="font-weight:bold; text-align:right; border:1px #000000 solid; border-top:3px #000000 double; padding-right:2px"><?=fConvertToRupiah($yCL12)?></td>
  <td style="font-weight:bold; text-align:right; border:1px #000000 solid; border-top:3px #000000 double; padding-right:2px"><?=fConvertToRupiah($yCL13)?></td>
  <td style="font-weight:bold; text-align:right; border:1px #000000 solid; border-top:3px #000000 double; padding-right:2px"><?=fConvertToRupiah($yCL14)?></td>
  <td style="font-weight:bold; text-align:right; border:1px #000000 solid; border-top:3px #000000 double; padding-right:2px">&nbsp;</td>
</tr>
</table>
<table border="0" align="center" width="1300" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td valign="top" width="400">
	<table border="0" align="center" width="400" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse">
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
	  <td width="24">a.</td>
	  <td width="204"> Nilai Perolehan <i>( d + e )</i></td>
	  <td width="18">=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($yCL4+$yCL6)?></td>
	  </tr>
	<?
		$Col12 = fGlobalNEW("IfNull(sum(Beban_Tahun_Berjalan),0)","ta_kib_post_penyusutan","Referensi:PerLap",$Ref.":".$rTH,"=:=","",DatabaseSB,$ConSB,"");
		$Col13 = fGlobalNEW("IfNull(sum(Beban_Tahun_Berjalan),0)","ta_kib_post_penyusutan","Referensi:PerLap",$Ref.":".$rTH,"=:<","",DatabaseSB,$ConSB,"");
	?>
	<tr>
	  <td>b.</td>
	  <td>Beban Penyusutan Tahun <?=$rTH?></td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($Col12)?></td>
	  </tr>
	<tr>
	  <td>c.</td>
	  <td>Koreksi di LPE </td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($Col13)?></td>
	  </tr>
	<tr>
	  <td>d.</td>
	  <td>Akumulasi Penyusutan <i>( b + c )</i></td>
	  <td>=</td>
	  <!--td style="text-align:right"><?=fConvertToRupiah(($tCL12+$tCL13)+($yCL12+$yCL13))?></td-->
	  <td style="text-align:right"><?=fConvertToRupiah($yCL13)?></td>
	  </tr>
	<tr>
	  <td>e.</td>
	  <td>Nilai Akhir Buku <i>( a - d )</i></td>
	  <td>=</td>
	  <td style="text-align:right"><?=fConvertToRupiah($yCL14)?></td>
	  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	</table>
  </td>
  <td width="40">&nbsp;</td>
  <td><?php require "Lap_Bottom.php"?></td>
</tr>
</table>
