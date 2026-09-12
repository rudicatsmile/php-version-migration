<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
$FnD = str_replace('**',' ',$FnD);
#echo $PagA;
#echo $AsT;

$LRef = "%";
if ($AsT=='1.3.1'){$LRef="TNH";}
if ($AsT=='1.3.2'){$LRef="ALT";}
if ($AsT=='1.3.3'){$LRef="BNG";}
if ($AsT=='1.3.4'){$LRef="JLN";}
if ($AsT=='1.3.5'){$LRef="ATL";}
if ($AsT=='1.5.3'){$LRef="ATB";}


if ($RoB=='0.0.0.00.00')
{
	$AsT = $AsT;
	$FiD = "AND (KdBarang LIKE '".$AsT."%' OR Referensi LIKE '".$LRef."%')";
}
else
{
	if ($SsR=='0.0.0.00.00.00.000')
	{
		if ($SrO=='0.0.0.00.00.00')
		{
			$AsT = $RoB;
		}
		else
		{
			$AsT = $SrO;
		}
	}
	else
	{
		$AsT = $SsR;
	}
	$FiD = "AND KdBarang LIKE '".$AsT."%'";
}

if ($UpB=='00.00.00.00.00.000')
{
	if ($SuB=='00.00.00.00.00')
	{
		$UnT = $UnT;
	}
	else
	{
		$UnT = $SuB;
	}
}
else
{
	$UnT = $UpB;
}

$SyT = "";
if ($FnD)
{
	$SyT = " 
	AND (KdBarang LIKE '%".$FnD."%' OR Referensi LIKE '%".$FnD."%' OR NmBarang LIKE '%".$FnD."%' OR NmBarang_Spec LIKE '%".$FnD."%' OR KdRegister LIKE '%".$FnD."%' OR Alamat LIKE '%".$FnD."%' 
	OR Merk LIKE '%".$FnD."%' OR Type LIKE '%".$FnD."%' OR NoPolisi LIKE '%".$FnD."%' OR NoRangka LIKE '%".$FnD."%' OR NoMesin LIKE '%".$FnD."%' OR Alamat LIKE '%".$FnD."%')
	";
}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="340px">
<?
#$JeN = fGlobal("Jenis","ta_usulan_108","Referensi",$gREF,"=","","");

#$iG=$PgE+1;
$A = $_GET['PagA'];
$B = $_GET['PerPage'];
$iG= $A+1;

$tJmL=0;

$nSQ = "SELECT 
IDT as A0,
Referensi as A1,
KdUPB as A2,
KdBarang as A3,
NmBarang as A4,
NmBarang_Spec as A5,
KdRegister as A6,
Merk as A7,
Type as A8,
NoPolisi as A9,
NoRangka as A10,
NoMesin as A11,
JmlBarang as A12,
SatuanBarang as A13,
HargaSatuan as A14,
NilaiPerolehan as A15,
TglPerolehan as A16,
Alamat as A17,
DasarPencatatan as A18,
KondisiBarang as A19,
Lainnya as A20,
Keterangan as A21,
TanggalSensus as A22 
FROM tb_lembar_kerja_belum_tercatat 
WHERE KdUPB LIKE '".$UnT."%' $FiD $SyT 
ORDER BY Referensi LIMIT $A,$B";
#echo $nSQ;
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG = fBackCLR($iG);
	$IdT = $mRo[0];
	
	$Lok = "Alamat : ".$mRo[17];
	if ($Lok!='' && $mRo[18]!='')
	{
		$Lok.= "<br>Dasar Pencatatan : ".$mRo[18];
	}
	
	if ($Lok!='' && $mRo[20]!='')
	{
		$Lok.= "<br>Ket. Lainnya : ".$mRo[20];
	}
	
	if ($Lok!='' && $mRo[21]!='')
	{
		$Lok.= "<br>Keterangan : ".$mRo[21];
	}
	
	$mRo4 = $mRo[4];
	if ($mRo4!='' && $mRo[5]!='')
	{
		$mRo4.= "<br>".$mRo[5];
	}
	?>
	<tr height="48" valign="top"> 
	  <td width="38" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="101" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
	  <td width="101" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[3]?></td>
	  <td width="56" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[6]?></td>
	  <td width="204" style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; padding-left:3px" <?=$gBG?>><?=$mRo4?></td>
	  <td width="76" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$mRo[16]?></td>
	  <td width="327" <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid"><?=$Lok?></td>
	  <td width="40" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:center"><?=$mRo[12]?></td>
	  <td width="104" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right"><?=fConvertToRupiah($mRo[14])?></td>
	  <td width="104" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right"><?=fConvertToRupiah($mRo[15])?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <a href="#" onClick="NewAset('','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;&nbsp;L K I</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <a href="#" onClick="NewAsetDelete('<?=$ReO?>','<?=$IdT?>','<?=$IdL?>'); return false" class="ico dell">&nbsp;&nbsp;Delete</a>
	  </td>
	</tr>
	<?
	$iG++;
}
?>
<? if ($iG>1) {?>
<tr height="100%">
 <td style="border-left:0px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
 <td style="border-left:1px #ccc solid; border-bottom:0px #ccc double">&nbsp;</td>
</tr>
<!--tr height="20">
  <td style="text-align:right; font-weight:bold; padding-right:10px" colspan="7"><div style="float:left; font-weight:normal; font-style:italic"><font style="color:#FF0000">&nbsp;**</font> &lt;-- Aset sudah tidak ada pada skpd bersangkuatn.</div>
    T O T A L</td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($tJmL)?></td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid"><?=fConvertToRupiah($tJmA)?></td>
  <td style="text-align:right; font-weight:bold; padding-right:3px; border-left:1px #ccc solid">&nbsp;</td>
  <td style="border-left:1px #ccc solid"></td>
  <td colspan="3"></td>
</tr-->
<? }else{ ?>
<tr height="100%">
 <td colspan="12" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
<script languange="javascript">
$("#fFinM").focus();
</script>