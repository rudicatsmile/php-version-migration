<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);
#echo $IdT;
$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	$CrT ="WHERE (Kd_Unit LIKE '%$gFnD%' OR Nm_Unit LIKE '%$FnD%')";
}

$DtA = fGlobalNEW("Kd_Sub_Kegiatan:Referensi:Tahun:Apbd:Kd_Rekening:Kd_Unit","ta_rkpbmd_new_rekening","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
$DtA = explode(':',$DtA);
$IdK = $DtA[0];
$ReF = $DtA[1];
$ThN = $DtA[2];
$ApB = $DtA[3];
$ReK = $DtA[4];
$KdU = $DtA[5];
$ReN = substr($ReK,0,5);
?>
<table align="center" cellpadding="0" class="table-form" cellspacing="0" height="100%" border="0" style="width:880px">
	<?php
	$iG=1;
	
	$fD='P2.Alamat';
	if ($ReN=='1.3.1'){$fD="P2.Alamat";}
	if ($ReN=='1.3.2'){
		$fD="CONCAT('Merk: ',P2.Merk,'<br>Ukuran: ',P2.Ukuran_CC,'<br>Bahan: ',P2.Bahan,'<br>No.Pabrik: ',P2.Nomor_Pabrik,'<br>No.Rangka: ',P2.Nomor_Rangka,'<br>No.Mesin: ',P2.Nomor_Mesin,'<br>No.Polisi: ',P2.Nomor_Polisi,'<br>No.BPKB',P2.Nomor_BPKB)";
	}
	if ($ReN=='1.3.3'){$fD='P2.Lokasi';}
	if ($ReN=='1.3.4'){$fD='P2.Lokasi';}
	
	$nSQ = "SELECT 
	P1.IDT as A0, 
	P1.Ref_Aset as A1, 
	P1.No_Register as A2, 
	P2.Nm_Aset as A3, 
	$fD as A4, 
	P1.Gunakan as A5, 
	P1.Kondisi_Barang as A6, 
	P1.Nama_Pemeliharaan as A7, 
	P1.Status_Barang as A8 
	FROM ta_rkpbmd_new_rekening_detail P1 
	LEFT JOIN ta_kib_108 P2 ON P2.Referensi=P1.Ref_Aset AND left(P2.Kd_Upb,11)=P1.Kd_Unit 
	WHERE P1.Referensi='".$ReF."' AND P1.Kd_Unit='".$KdU."' AND P1.Tahun='".$ThN."' 
	AND P1.Apbd='".$ApB."' AND P1.Kd_Sub_Kegiatan='".$IdK."' AND P1.Kd_Rekening='".$ReK."' ORDER BY P1.Ref_Aset";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$IdR = $mRo[0];
		$GuN = $mRo[5];
		$chK = "";
		if ($GuN=='Y'){$chK = "checked";}
		$KonD =$mRo[6];
		$PenU =$mRo[7];
		$StaT =$mRo[8];
		?>
		<tr>
			<td valign="top" width="29" rowspan="4" style="text-align:center; border-bottom:1px dotted #ccc; border-right:1px solid #ccc"><?=$iG?>.</td>
			<td valign="top" width="96" rowspan="4" style="text-align:center; border-bottom:1px dotted #ccc; border-right:1px solid #ccc"><?=$mRo[1]?></td>
			<td valign="top" width="62" rowspan="4" style="text-align:center; border-bottom:1px dotted #ccc; border-right:1px solid #ccc"><?=$mRo[2]?></td>
			<td valign="top" width="193" rowspan="4" style="border-bottom:1px dotted #ccc; border-right:1px solid #ccc; padding-left:3px"><?=$mRo[3]?></td>
			<td valign="top" width="237" rowspan="4" style="border-bottom:1px dotted #ccc; border-right:1px solid #ccc; padding-left:3px"><?=$mRo[4]?></td>
			<td colspan="3" style="border-bottom:1px dotted #ccc">
			<label><input type="checkbox" name="gunakan" value="<?=$IdR?>" <?=$chK?> onchange="formDetailSave('gunakan','','<?=$IdT?>','<?=$IdR?>','<?=$stLOCK?>','<?=$IdL?>')" />Usulkan</label>			</td>
		</tr>
		<tr style="vertical-align:top">
		  <td width="80" style="border-bottom:1px dotted #ccc">Status Barang </td>
          <td width="9" style="border-bottom:1px dotted #ccc">:</td>
          <td width="174" style="border-bottom:1px dotted #ccc"><input name="StaT" id="StaT" type="text" value="<?=$StaT?>" onkeypress="if (event.keyCode==13) {formDetailSave('status_barang',this,'<?=$IdT?>','<?=$IdR?>','<?=$stLOCK?>','<?=$IdL?>'); return false;}" style="height:15px; border-radius:0px; text-align:left; width:114px; border: 1px solid #C0C0C0; background:#CCFF99"/></td>
  </tr>
		<tr style="vertical-align:top">
		  <td style="border-bottom:1px dotted #ccc">Kondisi</td>
          <td style="border-bottom:1px dotted #ccc">:</td>
          <td style="border-bottom:1px dotted #ccc">
			  <label><input name="Radio<?=$IdR?>" type="radio" onchange="formDetailSave('kondisi_barang','B','<?=$IdT?>','<?=$IdR?>','<?=$stLOCK?>','<?=$IdL?>'); return false;" value="B" <?php if ($KonD=='B'){echo "checked";}?> />B</label>
			  <label><input name="Radio<?=$IdR?>" type="radio" onchange="formDetailSave('kondisi_barang','RR','<?=$IdT?>','<?=$IdR?>','<?=$stLOCK?>','<?=$IdL?>'); return false;" value="RR" <?php if ($KonD=='RR'){echo "checked";}?> />RR</label>
			  <label><input name="Radio<?=$IdR?>" type="radio" onchange="formDetailSave('kondisi_barang','RB','<?=$IdT?>','<?=$IdR?>','<?=$stLOCK?>','<?=$IdL?>'); return false;" value="RB" <?php if ($KonD=='RB'){echo "checked";}?> />RB</label>
		  
		  </td>
  </tr>
		<tr style="vertical-align:top">
		  <td style="border-bottom:1px dotted #ccc">Pemeliharaan</td>
          <td style="border-bottom:1px dotted #ccc">:</td>
          <td style="border-bottom:1px dotted #ccc">
		  <input name="PenU" id="PenU" type="text" value="<?=$PenU?>" onkeypress="if (event.keyCode==13) {formDetailSave('nama_pemeliharaan',this,'<?=$IdT?>','<?=$IdR?>','<?=$stLOCK?>','<?=$IdL?>'); return false;}" style="height:15px; border-radius:0px; text-align:left; width:160px; border: 1px solid #C0C0C0; background:#CCFF99"/></td>
  </tr>
		<?php
		$iG++;
	}
	?>
	<?php if ($iG==1) {?>
	<tr height="20">
		<td colspan="8" style="text-align:center; vertical-align:middle">Data tidak ditemukan..!!</td>
	</tr>
	<?php } ?>
	<tr height="100%">
		<td style="border-right:1px solid #ccc">&nbsp;</td>
		<td style="border-right:1px solid #ccc">&nbsp;</td>
		<td style="border-right:1px solid #ccc">&nbsp;</td>
		<td style="border-right:1px solid #ccc">&nbsp;</td>
		<td style="border-right:1px solid #ccc">&nbsp;</td>
		<td colspan="3">&nbsp;</td>
	</tr>
</table>
