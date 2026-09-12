<?php
require "Connection.php";
require "FileFunction.php";
extract($_GET);
#echo $gUnT."<br>";
#echo $gThn."<br>";
#echo $Ast."<br>";
#echo $Ext."<br>";
#echo $IdL."<br>";
?>
<table border="0" align="center" width="1450" cellspacing="0" style="font-size:10pt; font-family: Calibri; border-collapse: collapse; font-weight:bold">
<tr>
  <td width="70">SKPD</td>
  <td width="20">:</td>
  <td><?=fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",$gUnT,"=","",$DatabaseSB,$ConSB,"")?></td>
</tr>
<tr>
  <td>ASET</td>
  <td>:</td>
  <td><?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset",$Ast,"=","",DatabaseSB,$ConSB,""))?></td>
</tr>
<tr>
  <td>JENIS</td>
  <td>:</td>
  <td><?php if ($Ext=='Y') {echo "EXTRACOM";} else {echo "NON EXTRACOM";} ?></td>
</tr>
<tr>
  <td>SD TAHUN</td>
  <td>:</td>
  <td><?=$gThn?></td>
</tr>
</table>
<table border="0" align="center" width="1450" cellspacing="0" style="font-size:10pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td width="35" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000 solid">NO</td>
  <td width="105" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000 solid">REFERENSI</td>
  <td width="60" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000 solid">REGISTER</td>
  <td width="116" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000 solid">KODE</td>
  <td rowspan="2" style="text-align:center; font-weight:bold; border:1px #000 solid">NAMA ASET</td>
  <td width="70" rowspan="2" style="text-align:center; font-weight:bold; border:1px #000 solid">UMUR<br>EKONOMIS</td>
  <td colspan="2" style="text-align:center; font-weight:bold; border:1px #000 solid">TANGGAL</td>
  <td colspan="5" style="text-align:center; font-weight:bold; border:1px #000 solid">N I L A I&nbsp;&nbsp;&nbsp;( s.d Tahun <?=$gThn?> )</td>
</tr>
<tr>
  <td width="75" style="text-align:center; font-weight:bold; border:1px #000 solid">PEROLEHAN</td>
  <td width="75" style="text-align:center; font-weight:bold; border:1px #000 solid">MUTASI</td>
  <td width="115" style="text-align:center; font-weight:bold; border:1px #000 solid">PEROLEHAN</td>
  <td width="115" style="text-align:center; font-weight:bold; border:1px #000 solid">ATRIBUSI</td>
  <td width="115" style="text-align:center; font-weight:bold; border:1px #000 solid">AKHIR</td>
  <td width="115" style="text-align:center; font-weight:bold; border:1px #000 solid">AKUMULASI<br>PENYUSUTAN</td>
  <td width="115" style="text-align:center; font-weight:bold; border:1px #000 solid">NILAI BUKU</td>
</tr>
<?php
$iG=1;
$tRo5 = 0;
$tRo6 = 0;
$tRo7 = 0;
$tRo8 = 0;
$tRo9 = 0;

#$SQL = "SELECT Referensi as A0, Kd_Aset_108 as A1, Nm_Aset as A2, Tgl_Perolehan as A3, Tgl_Mutasi as A4, Harga as A5 FROM ta_kib_108 WHERE Kd_UPB LIKE '".$gUnT."%' AND Kd_Aset_108 LIKE '".$Ast."%' AND Tgl_Perolehan <= '".$gThn."-12-31' AND Tgl_Mutasi <= '".$gThn."-12-31' AND extracom='".$Ext."' ORDER BY Referensi";
$SQL = "SELECT 
P1.Referensi as A0, 
P1.Kd_Aset_108 as A1, 
P1.Nm_Aset as A2, 
P1.Tgl_Perolehan as A3, 
P1.Tgl_Mutasi as A4, 
P1.Harga as A5,
P2.Ms_Manfaat as A6,
P2.Link_Kib_AE as A7,
P2.IDT as A8,
P1.No_Register as A9 
FROM ta_kib_108 P1 
LEFT JOIN ref_rek_aset108_7 P2 ON P2.Kd_Aset=P1.Kd_Aset_108 
WHERE P1.Kd_UPB LIKE '".$gUnT."%' AND P1.Kd_Aset_108 LIKE '".$Ast."%' AND P1.Tgl_Perolehan <= '".$gThn."-12-31' AND P1.extracom='".$Ext."' ORDER BY P1.Referensi";
$nRs = mysql_query($SQL);
#echo $SQL;
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$mRo6 = fGlobal("IfNull(sum(debet),0)","ta_kib_post_108","referensi:kd_upb:crit:tanggal",$mRo[0].":".$gUnT."%:INV:".$gThn."-12-31","=:LIKE:=:<=","","");
	$mRo7 = $mRo[5] + $mRo6;
	
	$ColDT  = 0;//fGlobalNEW("IfNull(sum(Koreksi_Akumulasi),0):IfNull(sum(Nilai_Buku),0):Ms_Manfaat_Sisa","ta_kib_post_penyusutan_bulanan_108","Kd_UPB:Referensi:PerLap:Nilai_Akhir:Triwulan",$gUnT."%:".$mRo[0].":".$gThn.":Y:IV","LIKE:=:=:=:=","",DatabaseSB,$ConSB,"");
	$ColDT  = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0):IfNull(sum(Nilai_Buku_Akhir),0):Umur_Sisa","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap",$gUnT."%:".$mRo[0].":".$gThn,"LIKE:=:=","",DatabaseSB,$ConSB,"");
	
	$ColDT  = explode(":",$ColDT);
	$mRo8 = round($ColDT[0],2);
	#$mRo9 = round($ColDT[1],2);
	$mRo9 = $mRo7 - $mRo8;
	
	if ($mRo8 > $mRo7) {$mRo8 = $mRo7;}
	if ($mRo9 < 0) {$mRo9 = 0;}
	
	if ($mRo8==0)
	{
		$mCEK = fGlobal("IDT","ref_rek_aset108_7","Kd_Aset",$mRo[1],"=","","");
		if ($mCEK=='')
		{
			$NmAS = "";
			$LiNK = "";
			$MaSA = 0;
			$DtA = fGlobal("Nm_Aset:Link_Kib_AE:Ms_Manfaat","ref_rek_aset108_7_barsel","Kd_Aset",$mRo[1],"=","","");
			if ($DtA!='')
			{
				$DtA = explode(':',$DtA);
				$NmAS = $DtA[0];
				$LiNK = $DtA[1];
				$MaSA = $DtA[2];
			}
			if ($MaSA==0)
			{
				$MaSA = fGlobal("Ms_Manfaat","ref_rek_aset108_7","Kd_Aset",substr($mRo[1],0,14)."%","LIKE","IDT asc","");
			}
			$SQ = "INSERT INTO ref_rek_aset108_7 SET Kd_Aset='".$mRo[1]."', Nm_Aset='".$NmAS."', Link_Kib_AE='".$LiNK."', Ms_Manfaat='".$MaSA."'";
			$nR = mysql_query($SQ);
		}
	}
	
	if ($mRo[6]==0)
	{
		$nEW = fGlobal("Ms_Manfaat","ref_rek_aset108_7","Kd_Aset",$mRo[7],"=","","");
		if ($nEW!=0)
		{
			$SQ = "UPDATE ref_rek_aset108_7 SET Ms_Manfaat='".$nEW."' WHERE IDT='".$mRo[8]."'";
			#echo $SQ."<br>";
			$nR = mysql_query($SQ);
		}
	}
	?>
	<tr height="23">
	  <td style="text-align:center; border:1px #000 solid"><?=$iG?></td>
	  <td style="text-align:center; border:1px #000 solid"><?=$mRo[0]?></td>
	  <td style="text-align:center; border:1px #000 solid"><?=$mRo[9]?></td>
	  <td style="text-align:center; border:1px #000 solid"><?=$mRo[1]?></td>
	  <td style="border:1px #000 solid; padding-left:3px"><?=$mRo[2]?></td>
	  <td style="border:1px #000 solid; text-align:center"><?=$mRo[6]?></td>
	  <td style="text-align:center; border:1px #000 solid"><?=fConvertDateShort($mRo[3])?></td>
	  <td style="text-align:center; border:1px #000 solid"><?php if ($mRo[4]!='0000-00-00') echo fConvertDateShort($mRo[4]);?></td>
	  <td style="text-align:right; border:1px #000 solid; padding-right:3px"><?=fConvertToRupiah2dgt($mRo[5])?></td>
	  <td style="text-align:right; border:1px #000 solid; padding-right:3px"><?=fConvertToRupiah2dgt($mRo6)?></td>
	  <td style="text-align:right; border:1px #000 solid; padding-right:3px"><?=fConvertToRupiah2dgt($mRo7)?></td>
	  <td style="text-align:right; border:1px #000 solid; padding-right:3px"><?=fConvertToRupiah2dgt($mRo8)?></td>
	  <td style="text-align:right; border:1px #000 solid; padding-right:3px"><?=fConvertToRupiah2dgt($mRo9)?></td>
	</tr>
	<?php
	$iG++;
	$tRo5 = $tRo5 + $mRo[5];
	$tRo6 = $tRo6 + $mRo6;
	$tRo7 = $tRo7 + $mRo7;
	$tRo8 = $tRo8 + $mRo8;
	$tRo9 = $tRo9 + $mRo9;
}
?>
<tr height="25" style="font-weight:bold">
  <td colspan="8" style="text-align:center; border:1px #000 solid">T O T A L</td>
  <td style="text-align:right; border:1px #000 solid; padding-right:3px"><?=fConvertToRupiah2dgt($tRo5)?></td>
  <td style="text-align:right; border:1px #000 solid; padding-right:3px"><?=fConvertToRupiah2dgt($tRo6)?></td>
  <td style="text-align:right; border:1px #000 solid; padding-right:3px"><?=fConvertToRupiah2dgt($tRo7)?></td>
  <td style="text-align:right; border:1px #000 solid; padding-right:3px"><?=fConvertToRupiah2dgt($tRo8)?></td>
  <td style="text-align:right; border:1px #000 solid; padding-right:3px"><?=fConvertToRupiah2dgt($tRo9)?></td>
</tr>
</table>
