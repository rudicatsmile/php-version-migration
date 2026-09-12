<?
require('Connection.php');
require('FileFunction.php');
require('Connection_SQL.php');
extract($_GET);
#echo $gReC."<br>";
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
</tr>
<?
$PageNumber = $gPaG;
$RowspPage  = $gReC;
$iG = ($PageNumber*$gReC)-$gReC+1;
$iiG = 0;
$nSQ = "SELECT P1.IDPemda as A0
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

,P1.Kd_Pemilik as A16
,P1.Tgl_Perolehan as A17
,P1.Luas_M2 as A18
,P1.Alamat as A19
,P1.Hak_Tanah as A20
,P1.Sertifikat_Tanggal as A21
,P1.Sertifikat_Nomor as A22
,P1.Penggunaan as A23
,P1.Asal_usul as A24
,P1.Harga as A25
,P1.Keterangan as A26
,P1.Tahun as A27
,P1.No_SP2D as A28
,P1.No_ID as A29
,P1.Tgl_Pembukuan as A30
,P1.Kd_Kecamatan as A31
,P1.Kd_Desa as A32
,P1.Invent as A33
,P1.No_SKGuna as A34
,P1.Kd_Penyusutan as A35
,P1.Kd_Data as A36
,P1.Log_User as A37
,P1.Log_entry as A38
,P1.Kd_Masalah as A39
,P1.Ket_Masalah as A40
,P1.Kd_KA as A41
,P1.No_SIPPT as A42
,P1.Dev_Id as A43
,P1.Kd_Hapus as A44
,P1.IDData as A45 
,P2.Nm_Aset5 as A46 
FROM ta_kib_a P1 
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
AND P1.Kd_Data=$gDtA 
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
	
	#$SQa = "SELECT sum(harga) FROM Ta_KIBBR WHERE IDPemda='".$mRo[0]."' ";
	##echo $SQa."<br>";
	#$rsa = sqlsrv_query($conn,$SQa);
	$mRa = 0;//sqlsrv_fetch_array($rsa);
	
	$SQb = "SELECT harga FROM ta_fn_kib_a WHERE IDPemda='".$mRo[0]."' AND Tahun='2025'";
	#echo $SQb."<br>";
	$rsb = sqlsrv_query($conn,$SQb);
	$mRb = sqlsrv_fetch_array($rsb);
	
	if ($mRb[0]==0)
	{
		$mRb[0]=$mRo[33]+$mRa[0];
	}
	
	$TnD = "";
	$CeK = fGlobal("IDT","ta_kib_108","IdTabelMaster",$mRo[0],"=","","");
	if ($CeK!='')
	{
		$TnD = "&nbsp;<font style='color:#0000ff'>*</font>";
	}
	else
	{
		$TnD = "&nbsp;<font style='color:#ff0000'>#</font>";
		$iiG++;
	}
	
	$mRoA = $mRoA+$mRo[25];
	$mRoB = $mRoB+$mRa[0];
	$mRoC = $mRoC+$mRb[0];
  	?>
	<tr height="20">
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:center"><?=$iG++?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:center"><?=$mRo[0].$TnD?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:center"><?="L:".$Upb."<br>B:".$UpB?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:center"><?=$Rek?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:center"><?=date_format($mRo[17],"Y-m-d")?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:center"><?=substr('0000000'.$mRo[15],-7,7)?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding-left:2px"><?="<b>".$mRo[46]."</b><br>".$mRo[26]?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; padding-left:2px"><?=$mRo[49]?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($mRo[25])?></td>
	  <td style="border-right:1px solid #ccc; border-bottom:1px solid #ccc; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($mRa[0])?></td>
	  <td style="border-right:0px solid #ccc; border-bottom:1px solid #ccc; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($mRb[0])?></td>
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
  <td width="100" style="border-right:1px solid #ccc; border-bottom:1px solid #ccc"></td>
  <td width="100" style="border-right:1px solid #ccc; border-bottom:1px solid #ccc"></td>
  <td width="100" style="border-bottom:1px solid #ccc"></td>
</tr>
<tr height="30" style="font-weight:bold">
  <td colspan="7" align="center">T O T A L</td>
  <td style="border-right:1px solid #ccc"></td>
  <td style="border-right:1px solid #ccc; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($mRoA)?></td>
  <td style="border-right:1px solid #ccc; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($mRoB)?></td>
  <td style="border-right:1px solid #ccc; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($mRoC)?></td>
</tr>
<script languange="javascript">
$("#fMIS").val('<?=$iiG?>');
$("#fPAG").focus();
</script>