<?
require('Connection.php');
require('FileFunction.php');
require('Connection_SQL.php');
extract($_GET);

$gUnL=$gUnT;
if ($gUnT=='25.08.13.03') #BADAN PENGELOLA PAJAK DAN RETRIBUSI DAERAH baru
{
	$gUnT='25.08.13.01';	#BADAN PENGELOLA PAJAK DAN RETRIBUSI lama
}
else if ($gUnT=='25.08.13.01') #BADAN PENGELOLAAN KEUANGAN DAN PENDAPATAN DAERAH baru
{
	$gUnT='25.08.04.04';	#BADAN PENGELOLAAN KEUANGAN DAN PENDAPATAN DAERAH lama
}
else if ($gUnT=='25.08.13.04') #PENGELOLA BARANG baru
{
	$gUnT='25.08.04.05';	#PENGELOLA BARANG lama
}

$kd_prv = substr($gUnT,0,2);
$kd_kab = (int)substr($gUnT,4,2);
$kd_bdg = (int)substr($gUnT,6,2);
$kd_unt = (int)substr($gUnT,9,2); 

if ($gSuB!='')
{
	$kd_sub = (int)substr($gSuB,12,2);
}
else
{
	$kd_sub = "%";
}

if ($gUpB!='')
{
	$kd_upb = (int)substr($gUpB,15,3); 
}
else
{
	$kd_upb = "%"; 
}
/*
$impUnit="Yax";
if ($impUnit=="Ya")
{
	$iG=1;
	$nSQ = "SELECT Kd_Prov, Kd_Kab_Kota, Kd_Bidang, Kd_Unit, Nm_Unit 
	FROM Ref_Unit";
	$rst = sqlsrv_query($conn, $nSQ);
	while($mRo= sqlsrv_fetch_array($rst))
	{
		$x[0] = $mRo[0];
		$x[1] = $mRo[1];
		$x[2] = $mRo[2];
		$x[3] = $mRo[3];
		$x[4] = $mRo[4];
		
		CallConnection($DatabaseSB,$ConSB);
		$Kod= $x0.".".substr('0'.$x1,-2,2).".".substr('0'.$x2,-2,2).".".substr('0'.$x3,-2,2);
		$SQ ="INSERT INTO ref_unit SET kd_unit='".$Kod."', nm_unit='".$x4."'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$iG++;
	}
}

$impSubUnit="YaX";
if ($impSubUnit=="Ya")
{
	$iG=1;
	$nSQ = "SELECT kd_prov, kd_kab_kota, kd_bidang, kd_unit, kd_sub, nm_sub_unit 
	FROM ref_sub_unit";
	$rst = sqlsrv_query($conn, $nSQ);
	while($mRo= sqlsrv_fetch_array($rst))
	{
		
		CallConnection(DatabaseSB,$ConSB);
		$Kod= $mRo[0].".".substr('0'.$mRo[1],-2,2).".".substr('0'.$mRo[2],-2,2).".".substr('0'.$mRo[3],-2,2).".".substr('0'.$mRo[4],-2,2);
		$SQ ="INSERT INTO ref_sub_unit SET kd_sub='".$Kod."', nm_sub='".$mRo[5]."'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$iG++;
	}
}
	
$impUPB="YaX";
if ($impUPB=="Ya")
{
	$iG=1;
	$nSQ = "SELECT kd_prov as A0, kd_kab_kota as A1, kd_bidang as A2, kd_unit as A3, kd_sub as A4, kd_upb as A5, nm_upb as A6 
	FROM ref_upb";
	$rst = sqlsrv_query($conn, $nSQ);
	while($mRo= sqlsrv_fetch_array($rst))
	{
		
		CallConnection(DatabaseSB,$ConSB);
		$Kod= $mRo[0].".".substr('0'.$mRo[1],-2,2).".".substr('0'.$mRo[2],-2,2).".".substr('0'.$mRo[3],-2,2).".".substr('0'.$mRo[4],-2,2).".".substr('00'.$mRo[5],-3,3);
		$SQ ="INSERT INTO ref_upb SET kd_upb='".$Kod."', nm_upb='".$mRo[6]."'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$iG++;
	}
}
*/
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="100%">
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td colspan="2"></td>
<td></td>
<td></td>
</tr>
<?
$PageNumber = $gPaG;
$RowspPage  = $gReC;
$iG = ($PageNumber*$gReC)-$gReC+1;
$iiG = 0;

if ($gMsL!='null'){$MsL = "AND P1.Kd_Masalah=".$gMsL;}
else {$MsL = "AND P1.Kd_Masalah IS NULL";}

$nSQ = "SELECT 
P1.IDPemda as A0
,P1.Kd_Prov as A1
,P1.Kd_Kab_Kota as A2
,P1.Kd_Bidang as A3
,P1.Kd_Unit as A4
,P1.Kd_Sub as A5
,P1.Kd_UPB as A6

,P1.Kd_Aset8 as A7
,P1.Kd_Aset80 as A8
,P1.Kd_Aset81 as A9
,P1.Kd_Aset82 as A10
,P1.Kd_Aset83 as A11
,P1.Kd_Aset84 as A12
,P1.Kd_Aset85 as A13

,P1.No_Reg8 as A14
,P1.No_Register as A15

,P1.Kd_Ruang as A16
,P1.Kd_Pemilik as A17
,P1.Merk as A18
,P1.Type as A19
,P1.CC as A20
,P1.Bahan as A21
,P1.Tgl_Perolehan as A22
,P1.Nomor_Pabrik as A23
,P1.Nomor_Rangka as A24
,P1.Nomor_Mesin as A25
,P1.Nomor_Polisi as A26
,P1.Nomor_BPKB as A27
,P1.Asal_usul as A28
,P1.Kondisi as A29

,P1.Harga as A30

,P1.Masa_Manfaat as A31
,P1.Nilai_Sisa as A32
,P1.Keterangan as A33
,P1.Tahun as A34
,P1.No_SP2D as A35
,P1.No_ID as A36
,P1.Tgl_Pembukuan as A37
,P1.Kd_Kecamatan as A38
,P1.Kd_Desa as A39
,P1.Invent as A40
,P1.No_SKGuna as A41
,P1.Kd_Penyusutan as A42
,P1.Kd_Data as A43
,P1.Kd_Masalah as A44
,P1.Ket_Masalah as A45
,P1.Kd_KA as A46
,P1.No_SIPPT as A47
,P1.Dev_Id as A48
,P1.Kd_Hapus as A49
,P1.IDData as A50
,P1.Tg_Update8 as A51 
,P2.Nm_Aset5 as A52 

FROM ta_kib_b P1 
LEFT JOIN Ref_Rek5_108 P2 ON 
P2.Kd_Aset =P1.Kd_Aset8
AND P2.Kd_Aset0=P1.Kd_Aset80
AND P2.Kd_Aset1=P1.Kd_Aset81
AND P2.Kd_Aset2=P1.Kd_Aset82
AND P2.Kd_Aset3=P1.Kd_Aset83
AND P2.Kd_Aset4=P1.Kd_Aset84
AND P2.Kd_Aset5=P1.Kd_Aset85  
WHERE P1.Kd_Prov='".$kd_prv."' AND P1.Kd_Kab_Kota = '".$kd_kab."' AND P1.Kd_Bidang = '".$kd_bdg."' AND P1.Kd_Unit = '".$kd_unt."' AND P1.Kd_Sub LIKE '".$kd_sub."' AND P1.Kd_UPB LIKE '".$kd_upb."'  
AND P1.Kd_Hapus=$gHpS 
ORDER BY P1.IDPemda
OFFSET (($PageNumber - 1) * $RowspPage) ROWS
FETCH NEXT $RowspPage ROWS ONLY";
#echo $nSQ;
$mRoA = 0;
$mRoB = 0;
$mRoC = 0;
$rst = sqlsrv_query($conn,$nSQ);
while($mRo = sqlsrv_fetch_array($rst))
{
	$Upb= $mRo[1].".".substr('0'.$mRo[2],-2,2).".".substr('0'.$mRo[3],-2,2).".".substr('0'.$mRo[4],-2,2).".".substr('0'.$mRo[5],-2,2).".".substr('00'.$mRo[6],-3,3);
	$UpB= $gUnL.".".substr('0'.$mRo[5],-2,2).".".substr('00'.$mRo[6],-3,3);
	$Rek= $mRo[7].".".$mRo[8].".".$mRo[9].".".substr('0'.$mRo[10],-2,2).".".substr('0'.$mRo[11],-2,2).".".substr('0'.$mRo[12],-2,2).".".substr('00'.$mRo[13],-3,3);
	
	#$SQb = "SELECT harga FROM ta_fn_kib_b WHERE IDPemda='".$mRo[0]."' AND Tahun='2025'";
	$SQb = "SELECT sum(harga) FROM ta_kibbr WHERE IDPemda='".$mRo[0]."'";
	$rsb = sqlsrv_query($conn,$SQb);
	$mRb = sqlsrv_fetch_array($rsb);
	
	#if ($mRb[0]==0)
	#{
	#	$mRb[0]=$mRa[0];
	#}
	$AkH = $mRo[30]+$mRb[0];
	
	$TnD = "";
	$DtA = fGlobal("IDT:Kd_Ruang:Referensi:Harga","ta_kib_108","IdTabelMaster",$mRo[0],"=","","");
	$DtA = explode(":",$DtA);
	$IdT = $DtA[0];
	$KdR = $DtA[1];
	$ReF = $DtA[2];
	$HrG = $DtA[3];
	if ($IdT!='')
	{
		$TnD = "&nbsp;<font style='color:#0000ff'>*</font>";
		if (!is_null($mRo[16]) && $KdR=='000')
		{
			if (substr('00'.$mRo[16],-3,3)!='000')
			{
				$SW="UPDATE ta_kib_108 SET Kd_Ruang='".substr('00'.$mRo[16],-3,3)."' WHERE IDT='".$IdT."'";
				echo $mRo[16]." : ".$SW."<br>";
				#mysql_query($SW);
			}
		}
		
		$DeB = fGlobal("sum(debet)","ta_kib_post_108","referensi",$ReF,"=","","");
		
		$ClrA = "";
		$ClrB = "";
		if ($mRo[30]<$HrG)
		{
			$ClrA = "; color:#0000FF";
			$ClrB = "; color:#FF0000";
		}
		else if ($mRo[30]>$HrG)
		{
			$ClrA = "; color:#FF0000";
			$ClrB = "; color:#0000FF";
			#Update
			$SW="UPDATE ta_kib_108 SET harga='".$mRo[30]."', nilai_akhir='".$mRo[30]."' WHERE IDT='".$IdT."'";
			echo $SW."<br>";
			mysql_query($SW);
			
			$SW="UPDATE ta_kib_post_108 SET debet='".$mRo[30]."' WHERE referensi='".$ReF."'";
			echo $SW."<br>";
			mysql_query($SW);
		}
		
		$ClrC = "";
		if ($AkH<$DeB)
		{
			$ClrC = "; color:#FF0000";
		}
		else if ($AkH>$DeB)
		{
			$ClrC = "; color:#0000FF";
			#Update
		}
	}
	else
	{
		$iiG++;
		$TnD = "&nbsp;<font style='color:#ff0000'>#</font>";
	}
	
	$mRoA = $mRoA+$mRo[30];
	$mRoB = $mRoB+0;
	$mRoC = $mRoC+0;
	
  	?>
	<tr height="20">
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:center"><?=$iG++?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:center"><?=$mRo[0]."<br>".$ReF.$TnD?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:center"><?="L:".$Upb."<br>B:".$UpB?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:center"><?=$Rek?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:center"><?=date_format($mRo[22],"Y-m-d")?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:center"><?=substr('0000000'.$mRo[15],-7,7)?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding-left:2px"><?="<b>".$mRo[52]."</b><br>".$mRo[33]?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding-left:2px"><?=$mRo[18].", ".$mRo[19].", ".$mRo[20]?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:right; padding-right:2px <?=$ClrA?>"><?=fConvertToRupiahBulat($mRo[30])?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:right; padding-right:2px <?=$ClrB?>"><?=fConvertToRupiahBulat($HrG)?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($mRb[0])?></td>
	  <td style="border-right:0px solid #ccc; border-bottom:1px solid #ccc; text-align:right; padding-right:2px <?=$ClrC?>"><?=fConvertToRupiahBulat($DeB)?></td>
	</tr>
	<?
}
?>
<tr height="100%">
  <td width="40" style="border-right:1px solid #ccc; border-bottom:1px solid #ccc"></td>
  <td width="120" style="border-right:1px solid #ccc; border-bottom:1px solid #ccc"></td>
  <td width="110" style="border-right:1px solid #ccc; border-bottom:1px solid #ccc"></td>
  <td width="110" style="border-right:1px solid #ccc; border-bottom:1px solid #ccc"></td>
  <td width="70" style="border-right:1px solid #ccc; border-bottom:1px solid #ccc"></td>
  <td width="70" style="border-right:1px solid #ccc; border-bottom:1px solid #ccc"></td>
  <td width="350" style="border-right:1px solid #ccc; border-bottom:1px solid #ccc"></td>
  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc"></td>
  <td width="80" style="border-right:1px solid #ccc; border-bottom:1px solid #ccc"></td>
  <td width="80" style="border-right:1px solid #ccc; border-bottom:1px solid #ccc"></td>
  <td width="90" style="border-right:1px solid #ccc; border-bottom:1px solid #ccc"></td>
  <td width="90" style="border-bottom:1px solid #ccc"></td>
</tr>
<tr height="30" style="font-weight:bold">
  <td colspan="7" align="center">T O T A L</td>
  <td style="border-right:1px solid #ccc"></td>
  <td style="border-right:1px solid #ccc; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($mRoA)?></td>
  <td style="border-right:1px solid #ccc; text-align:right; padding-right:2px">&nbsp;</td>
  <td style="border-right:1px solid #ccc; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($mRoB)?></td>
  <td style="border-right:1px solid #ccc; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($mRoC)?></td>
</tr>
</table>
<script languange="javascript">
$("#fMIS").val('<?=$iiG?>');
$("#fPAG").focus();
</script>