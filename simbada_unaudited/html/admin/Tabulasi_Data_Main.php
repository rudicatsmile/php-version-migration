<?
ini_set('max_execution_time', 3000);
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";
extract($_GET);

require "Tabulasi_Data_Head.php";
?>
<table align="center" border="0" width="1270" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-size:9pt">
<tr style="height:20pt; text-align:center; font-weight:bold; text-transform:uppercase">
  <td width="30" rowspan="2" style="border:1px #000 solid">No.</td>
  <td width="100" rowspan="2" style="border:1px #000 solid">Referensi</td>
  <td width="60" rowspan="2" style="border:1px #000 solid">Register</td>
  <td width="95" rowspan="2" style="border:1px #000 solid">Kode Aset</td>
  <td rowspan="2" style="border:1px #000 solid">Nama Aset</td>
  <td colspan="3" style="border:1px #000 solid">PEROLEHAN</td>
  <td colspan="3" style="border:1px #000 solid">PENYUSUTAN</td>
  </tr>
<tr style="height:20pt; text-align:center; font-weight:bold; text-transform:uppercase">
<td width="80" style="border:1px #000 solid">Tanggal</td>
<td width="100" style="border:1px #000 solid">Nilai<br>AWAL</td>
<td width="100" style="border:1px #000 solid">Nilai<br>Akhir</td>
<td width="100" style="border:1px #000 solid">Beban<br>Tahun <?=$rTH?></td>
<td width="100" style="border:1px #000 solid">Akumulasi</td>
<td width="100" style="border:1px #000 solid">Nilai Buku</td>
</tr>
<?
$iG=1;
$nRs = mysql_query($nSQL);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$ReF = $mRo['Referensi'];
	$KdU  = substr($mRo['Kd_UPB'],0,11);
	$KdA  = $mRo['Kd_Aset_108'];
	
	$NiLA = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB:Tanggal",$ReF.":".substr($mRo['Kd_UPB'],0,11)."%:".$gThn."-12-31","=:LIKE:<=","","");
	
	$Col06 = fGlobalNEW("IfNull(sum(Beban_Tahun_Berjalan),0)","ta_kib_post_penyusutan_bulanan_108","Referensi:Kd_UPB:Kd_Aset_108:PerLap",$ReF.":".$KdU."%:".$KdA.":".$rTH,"=:LIKE:=:=","",$DatabaseSB,$ConSB,"");
	$Col07 = fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan_bulanan_108","Referensi:Kd_UPB:Kd_Aset_108:PerLap:Nilai_Akhir:Triwulan",$ReF.":".$KdU."%:".$KdA.":".$rTH.":Y:IV","=:LIKE:=:=:=:=","",$DatabaseSB,$ConSB,"");
	$Col08 = fGlobalNEW("IfNull(sum(Nilai_Buku),0)","ta_kib_post_penyusutan_bulanan_108","Referensi:Kd_UPB:Kd_Aset_108:PerLap:Nilai_Akhir:Triwulan",$ReF.":".$KdU."%:".$KdA.":".$rTH.":Y:IV","=:LIKE:=:=:=:=","",$DatabaseSB,$ConSB,"");
	#$Col09 = fGlobalNEW("Ms_Manfaat_Sisa_Dlm_Bln","ta_kib_post_penyusutan_bulanan_108","Referensi:Kd_UPB:Kd_Aset_108:PerLap:Nilai_Akhir:Triwulan",$ReF.":".$KdU."%:".$KdA.":".$rTH.":Y:IV","=:LIKE:=:=:=:=","",$DatabaseSB,$ConSB,"");
	
	?>
	<tr height="23">
	<td style="border:1px #000 solid; text-align:center"><?=$iG?>.</td>
	<td style="border:1px #000 solid; text-align:center"><?=$mRo['Referensi']?></td>
	<td style="border:1px #000 solid; text-align:center"><?=$mRo['No_Register']?></td>
	<td style="border:1px #000 solid; text-align:center"><?=$mRo['Kd_Aset']?></td>
	<td style="border:1px #000 solid; padding-left:3px"><?=$mRo['Nm_Aset']?></td>
	<td style="border:1px #000 solid; text-align:center"><?=$mRo['Tgl_Perolehan']?></td>
	<td style="border:1px #000 solid; text-align:right; padding-right:2px"><?=fConvertToRupiah($mRo['Harga'])?></td>
	<td style="border:1px #000 solid; text-align:right; padding-right:2px"><?=fConvertToRupiah($NiLA)?></td>
	<td style="border:1px #000 solid; text-align:right; padding-right:2px"><?=fConvertToRupiah($Col06)?></td>
	<td style="border:1px #000 solid; text-align:right; padding-right:2px"><?=fConvertToRupiah($Col07)?></td>
	<td style="border:1px #000 solid; text-align:right; padding-right:2px"><?=fConvertToRupiah($Col08)?></td>
	</tr>
	<?
	$tHarga = $tHarga + $mRo['Harga'];
	$tNiLA  = $tNiLA + $NiLA;
	
	$tCol06 = $tCol06 + $Col06;
	$tCol07 = $tCol07 + $Col07;
	$tCol08 = $tCol08 + $Col08;
	$iG++; 
} 
?>
	<tr height="23">
	  <td colspan="6" style="border:1px #000 solid; text-align:center; font-weight:bold">T O T A L</td>
	  <td style="border:1px #000 solid; text-align:right; padding-right:2px; font-weight:bold"><?=fConvertToRupiah($tHarga)?></td>
  	  <td style="border:1px #000 solid; text-align:right; padding-right:2px; font-weight:bold"><?=fConvertToRupiah($tNiLA)?></td>
	  <td style="border:1px #000 solid; text-align:right; padding-right:2px; font-weight:bold"><?=fConvertToRupiah($tCol06)?></td>
	  <td style="border:1px #000 solid; text-align:right; padding-right:2px; font-weight:bold"><?=fConvertToRupiah($tCol07)?></td>
	  <td style="border:1px #000 solid; text-align:right; padding-right:2px; font-weight:bold"><?=fConvertToRupiah($tCol08)?></td>
  </tr>
</table>
