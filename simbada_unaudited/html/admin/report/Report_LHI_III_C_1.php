<?
require('../Connection.php');
require('../FileFunction.php');
require("../CheckLogin.php");
include "../zRepairData.php";
extract($_GET);

if ($ExT==''){$ExT="%";}

?>
<table border="0" cellspacing="0" cellpadding="0" align="center" style="width:800px; font-family:calibri; text-align:center; font-weight:bold; font-size:11pt">
<tr>
  	<td>LAPORAN HASIL INVENTARISASI (LHI)</td>
</tr>
<tr>
  	<td>REKAPITULASI HASIL INVENTARISASI </td>
</tr>

<tr>
	<td><?=$TiDaer." ".$NmDaer?></td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>
</table>
<? if ($fUnt!="00.00.00.00"){?>
<table align="center" cellpadding="0" cellspacing="0" border="0" width="800" style="border-collapse:collapse; font-family:calibri; font-size:10pt; font-weight:bold">
<tr>
	<td width="50">SKPD</td>
	<td>:</td>
	<td><?=fGlobal("Nm_Unit","ref_unit","Kd_Unit",$fUnt,"=","","")?></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
<? } ?>
<table align="center" cellpadding="0" cellspacing="0" border="0" width="800" style="border-collapse:collapse; font-family:calibri; font-size:9pt">
<tr style="text-align:center; font-weight:bold; height:20px">
  <td width="36" rowspan="2" style="border:1px solid #000">No</td>
  <td width="101" rowspan="2" style="border:1px solid #000">Kode</td>
  <td width="250" rowspan="2" style="border:1px solid #000"><? if ($fUnt=="00.00.00.00") {echo "SKPD";} else {echo "Bidang";}?></td>
  <td width="50" rowspan="2" style="border:1px solid #000">KIB</td>
  <td width="60" rowspan="2" style="border:1px solid #000">Total</td>
  <td colspan="4" style="border:1px solid #000">Sensus</td>
  <td rowspan="2" style="border:1px solid #000">Pros<br>( % )</td>
</tr>
<tr style="text-align:center; font-weight:bold; height:20px">
  <td width="60" style="border:1px solid #000">Selesai</td>
  <td width="60" style="border:1px solid #000">Proses</td>
  <td width="60" style="border:1px solid #000">Belum</td>
  <td width="60" style="border:1px solid #000">Pros (%)</td>
  </tr>
<?
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
	$nSQ = "SELECT Kd_UPB, Nm_UPB FROM ref_upb WHERE Kd_UPB LIKE '".$fUnt."%' ORDER BY Kd_UPB";
}
#echo $nSQ;
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$A_KiB = fGlobal("count(*)","ta_kib_108_sensus_2023","Kd_UPB:Tgl_Perolehan:Kd_Aset_108:extracom",$mRo[0]."%:2022-12-31:1.3.1%:".$ExT,"like:<=:like:like","","");
	$A_KiS = fGlobal("count(*)","tb_lembar_kerja","KdUPB:TglPerolehan:KdAset108:Extracom:DataSensusFix",$mRo[0]."%:2022-12-31:1.3.1%:".$ExT.":Y","like:<=:like:like:=","","");
	$A_KiP = fGlobal("count(*)","tb_lembar_kerja","KdUPB:TglPerolehan:KdAset108:Extracom:DataSensusFix",$mRo[0]."%:2022-12-31:1.3.1%:".$ExT.":P","like:<=:like:like:=","","");
	$A_KiN = $A_KiB - ($A_KiS + $A_KiP);
	$A_Pro = 0;
	if ($A_KiB!=0 && $A_KiS!=0)
	{
		$A_Pro = $A_KiS/$A_KiB*100;
	}
	
	$B_KiB = fGlobal("count(*)","ta_kib_108_sensus_2023","Kd_UPB:Tgl_Perolehan:Kd_Aset_108:extracom",$mRo[0]."%:2022-12-31:1.3.2%:".$ExT,"like:<=:like:like","","");
	$B_KiS = fGlobal("count(*)","tb_lembar_kerja","KdUPB:TglPerolehan:KdAset108:Extracom:DataSensusFix",$mRo[0]."%:2022-12-31:1.3.2%:".$ExT.":Y","like:<=:like:like:=","","");
	$B_KiP = fGlobal("count(*)","tb_lembar_kerja","KdUPB:TglPerolehan:KdAset108:Extracom:DataSensusFix",$mRo[0]."%:2022-12-31:1.3.2%:".$ExT.":P","like:<=:like:like:=","","");
	$B_KiN = $B_KiB - ($B_KiS + $B_KiP);
	$B_Pro = 0;
	if ($B_KiB!=0 && $B_KiS!=0)
	{
		$B_Pro = $B_KiS/$B_KiB*100;
	}
	
	$C_KiB = fGlobal("count(*)","ta_kib_108_sensus_2023","Kd_UPB:Tgl_Perolehan:Kd_Aset_108:extracom",$mRo[0]."%:2022-12-31:1.3.3%:".$ExT,"like:<=:like:like","","");
	$C_KiS = fGlobal("count(*)","tb_lembar_kerja","KdUPB:TglPerolehan:KdAset108:Extracom:DataSensusFix",$mRo[0]."%:2022-12-31:1.3.3%:".$ExT.":Y","like:<=:like:like:=","","");
	$C_KiP = fGlobal("count(*)","tb_lembar_kerja","KdUPB:TglPerolehan:KdAset108:Extracom:DataSensusFix",$mRo[0]."%:2022-12-31:1.3.3%:".$ExT.":P","like:<=:like:like:=","","");
	$C_KiN = $C_KiB - ($C_KiS + $C_KiP);
	$C_Pro = 0;
	if ($C_KiB!=0 && $C_KiS!=0)
	{
		$C_Pro = $C_KiS/$C_KiB*100;
	}
	
	$D_KiB = fGlobal("count(*)","ta_kib_108_sensus_2023","Kd_UPB:Tgl_Perolehan:Kd_Aset_108:extracom",$mRo[0]."%:2022-12-31:1.3.4%:".$ExT,"like:<=:like:like","","");
	$D_KiS = fGlobal("count(*)","tb_lembar_kerja","KdUPB:TglPerolehan:KdAset108:Extracom:DataSensusFix",$mRo[0]."%:2022-12-31:1.3.4%:".$ExT.":Y","like:<=:like:like:=","","");
	$D_KiP = fGlobal("count(*)","tb_lembar_kerja","KdUPB:TglPerolehan:KdAset108:Extracom:DataSensusFix",$mRo[0]."%:2022-12-31:1.3.4%:".$ExT.":P","like:<=:like:like:=","","");
	$D_KiN = $D_KiB - ($D_KiS + $D_KiP);
	$D_Pro = 0;
	if ($D_KiB!=0 && $D_KiS!=0)
	{
		$D_Pro = $D_KiS/$D_KiB*100;
	}
	
	$E_KiB = fGlobal("count(*)","ta_kib_108_sensus_2023","Kd_UPB:Tgl_Perolehan:Kd_Aset_108:extracom",$mRo[0]."%:2022-12-31:1.3.5%:".$ExT,"like:<=:like:like","","");
	$E_KiS = fGlobal("count(*)","tb_lembar_kerja","KdUPB:TglPerolehan:KdAset108:Extracom:DataSensusFix",$mRo[0]."%:2022-12-31:1.3.5%:".$ExT.":Y","like:<=:like:like:=","","");
	$E_KiP = fGlobal("count(*)","tb_lembar_kerja","KdUPB:TglPerolehan:KdAset108:Extracom:DataSensusFix",$mRo[0]."%:2022-12-31:1.3.5%:".$ExT.":P","like:<=:like:like:=","","");
	$E_KiN = $E_KiB - ($E_KiS + $E_KiP);
	$E_Pro = 0;
	if ($E_KiB!=0 && $E_KiS!=0)
	{
		$E_Pro = $E_KiS/$E_KiB*100;
	}
	
	$T_KiB = fGlobal("count(*)","ta_kib_108_sensus_2023","Kd_UPB:Tgl_Perolehan:Kd_Aset_108:extracom",$mRo[0]."%:2022-12-31:1.5.3%:".$ExT,"like:<=:like:like","","");
	$T_KiS = fGlobal("count(*)","tb_lembar_kerja","KdUPB:TglPerolehan:KdAset108:Extracom:DataSensusFix",$mRo[0]."%:2022-12-31:1.5.3%:".$ExT.":Y","like:<=:like:like:=","","");
	$T_KiP = fGlobal("count(*)","tb_lembar_kerja","KdUPB:TglPerolehan:KdAset108:Extracom:DataSensusFix",$mRo[0]."%:2022-12-31:1.5.3%:".$ExT.":P","like:<=:like:like:=","","");
	$T_KiN = $T_KiB - ($T_KiS + $T_KiP);
	$T_Pro = 0;
	if ($T_KiB!=0 && $T_KiS!=0)
	{
		$T_Pro = $T_KiS/$T_KiB*100;
	}
	
	#total
	$m_KiB = $A_KiB + $B_KiB + $C_KiB + $D_KiB + $E_KiB + $T_KiB;
	$m_KiS = $A_KiS + $B_KiS + $C_KiS + $D_KiS + $E_KiS + $T_KiS;
	$m_Pro = 0;
	if ($m_KiB!=0 && $m_KiS!=0)
	{
		$m_Pro = $m_KiS/$m_KiB*100;
	}
	
	$ttKiB = $ttKiB + $A_KiB + $B_KiB + $C_KiB + $D_KiB + $E_KiB + $T_KiB;
	$ttKiS = $ttKiS + $A_KiS + $B_KiS + $C_KiS + $D_KiS + $E_KiS + $T_KiS;
	$ttKiP = $ttKiP + $A_KiP + $B_KiP + $C_KiP + $D_KiP + $E_KiP + $T_KiP;
	$ttKiN = $ttKiN + $A_KiN + $B_KiN + $C_KiN + $D_KiN + $E_KiN + $T_KiN;
	?>
	<tr height="22">
	  <td style="border:1px solid #000; text-align:center"><?=$iG?>.</td>
	  <td style="border:1px solid #000; text-align:center"><?=$mRo[0]?></td>
	  <td style="border:1px solid #000; padding-left:3px"><?=$mRo[1]?></td>
	  <td colspan="6" style="border:1px solid #000">
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%" style="border-collapse:collapse; font-family:calibri; font-size:9pt">
	  <tr height="20">
	    <td width="50" style="text-align:center; border-bottom:1px solid #000; font-weight:bold">A</td>
	    <td width="60" style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($A_KiB)?></td>
	    <td width="60" style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($A_KiS)?></td>
	    <td width="60" style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($A_KiP)?></td>
	    <td width="60" style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($A_KiN)?></td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiah($A_Pro)?> %</td>
	  </tr>
	  <tr height="20">
	    <td style="text-align:center; border-bottom:1px solid #000; font-weight:bold">B</td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($B_KiB)?></td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($B_KiS)?></td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($B_KiP)?></td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($B_KiN)?></td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiah($B_Pro)?> %</td>
	  </tr>
	  <tr height="20">
	    <td style="text-align:center; border-bottom:1px solid #000; font-weight:bold">C</td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($C_KiB)?></td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($C_KiS)?></td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($C_KiP)?></td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($C_KiN)?></td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiah($C_Pro)?> %</td>
	  </tr>
	  <tr height="20">
	    <td style="text-align:center; border-bottom:1px solid #000; font-weight:bold">D</td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($D_KiB)?></td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($D_KiS)?></td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($D_KiP)?></td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($D_KiN)?></td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiah($D_Pro)?> %</td>
	  </tr>
	  <tr height="20">
	    <td style="text-align:center; border-bottom:1px solid #000; font-weight:bold">E</td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($E_KiB)?></td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($E_KiS)?></td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($E_KiP)?></td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiahBulat($E_KiN)?></td>
	    <td style="text-align:center; border-left:1px solid #000; border-bottom:1px solid #000"><?=fConvertToRupiah($E_Pro)?> %</td>
	  </tr>
	  <tr height="20">
	    <td style="text-align:center; font-weight:bold">ATB</td>
	    <td style="text-align:center; border-left:1px solid #000"><?=fConvertToRupiahBulat($T_KiB)?></td>
	    <td style="text-align:center; border-left:1px solid #000"><?=fConvertToRupiahBulat($T_KiS)?></td>
	    <td style="text-align:center; border-left:1px solid #000"><?=fConvertToRupiahBulat($T_KiP)?></td>
	    <td style="text-align:center; border-left:1px solid #000"><?=fConvertToRupiahBulat($T_KiN)?></td>
	    <td style="text-align:center; border-left:1px solid #000"><?=fConvertToRupiah($T_Pro)?> %</td>
	  </tr>
	  </table>	  </td>
	  <td style="border:1px solid #000; text-align:center"><?=fConvertToRupiah($m_Pro)?> %</td>
	</tr>
	<?
	$iG++;
}
$ttPro = 0;
if ($ttKiB!=0 && $ttKiS!=0)
{
	$ttPro = $ttKiS/$ttKiB*100;
}
?>
<tr height="26" style="text-align:center; font-weight:bold">
  <td colspan="4" style="border:1px solid #000">Jumlah</td>
  <td style="border:1px solid #000"><?=fConvertToRupiahBulat($ttKiB)?></td>
  <td style="border:1px solid #000"><?=fConvertToRupiahBulat($ttKiS)?></td>
  <td style="border:1px solid #000"><?=fConvertToRupiahBulat($ttKiP)?></td>
  <td style="border:1px solid #000"><?=fConvertToRupiahBulat($ttKiN)?></td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000"><?=fConvertToRupiah($ttPro)?> %</td>
</tr>
</table>
<br>
<!--table align="center" cellpadding="0" cellspacing="0" border="0" width="800" style="font-family:calibri; font-size:10pt">
  <tr>
    <td width="436">&nbsp;</td>
    <td width="433">&nbsp;</td>
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
  
  <tr height="20">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">Pengguna Barang, </td>
  </tr>
  <tr height="70">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?
  $Nma = fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit",substr($fUnt,0,11),"=","","");
  $LeN = strlen($Nma);
  #echo $LeN."<br>";
  
  $TxT = 0;
  if ($LeN < 45){
  	$TxT = (45-$LeN)/2;
  }
  $TxT = (int)$TxT;
  #echo $TxT."<br>";
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center" style="font-weight:bold; text-decoration:underline"><?=str_repeat('&nbsp;',$TxT)?><?=fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit",substr($fUnt,0,11),"=","","")?><?=str_repeat('&nbsp;',$TxT)?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="center">NIP. <?=fGlobal("Nip_Pimpinan","ref_unit","Kd_Unit",substr($fUnt,0,11),"=","","")?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table-->
