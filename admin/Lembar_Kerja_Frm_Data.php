<?php
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
#echo $RoB."<br>";
#echo $SrO."<br>";
#echo $SsR."<br>";

if ($RoB=='0.0.0.00.00')
{
	$AsT = $AsT;
	$FiD = "AND (P1.Kd_Aset_108 LIKE '".$AsT."%' OR P1.Referensi LIKE '".$LRef."%')";
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
	$FiD = "AND P1.Kd_Aset_108 LIKE '".$AsT."%'";
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
if ($FnD){
	$SyT = " 
	AND (P1.Kd_Aset_108 LIKE '%".$FnD."%' OR P1.Referensi LIKE '%".$FnD."%' OR P1.Nm_Aset LIKE '%".$FnD."%' OR P1.No_Register LIKE '%".$FnD."%' OR P1.Alamat LIKE '%".$FnD."%' 
	OR P1.Nomor_Polisi LIKE '%".$FnD."%' OR P1.Merk LIKE '%".$FnD."%' OR P1.Harga LIKE '%".$FnD."%' OR P1.No_Pengadaan LIKE '%".$FnD."%' OR P1.Tgl_Perolehan LIKE '%".$FnD."%' OR P1.Harga LIKE '%".$FnD."%')
	";
}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="340px">
<?php
#$JeN = fGlobal("Jenis","ta_usulan_108","Referensi",$gREF,"=","","");

#$iG=$PgE+1;
$A = $_GET['PagA'];
$B = $_GET['PerPage'];
$iG= $A+1;

$tJmL=0;

$nSQ = "SELECT 
P1.IDT as A0,
P1.Referensi as A1,
P1.Ref_Group as A2,
P1.Ref_Mutasi as A3,
P1.Ref_Usulan as A4,
P1.Ref_History as A5,
P1.Ref_Usulan_His as A6,
P1.Ref_KdpToAset as A7,
P1.Kd_UPB as A8,
P1.Kd_Aset_108 as A9,
P1.Kd_Ruang as A10,
P1.No_Register as A11,
P1.No_Pengadaan as A12,
P1.Ref_Temp as A13,
P1.Nm_Aset as A14,
P1.Kd_Pemilik as A15,
P1.Tgl_Perolehan as A16,
P1.Tgl_Mutasi as A17,
P1.Tgl_Mulai as A18,
P1.Tahun as A19,
P1.Luas_M2 as A20,
P1.Alamat as A21,
P1.Hak_Tanah as A22,
P1.Sertifikat as A23,
P1.Sertifikat_Tanggal as A24,
P1.Sertifikat_Nomor as A25,
P1.Penggunaan as A26,
P1.Asal_Usul as A27,
P1.Harga as A28,
P1.Merk as A29,
P1.Type as A30,
P1.Ukuran_CC as A31,
P1.Bahan as A32,
P1.Nomor_Pabrik as A33,
P1.Nomor_Rangka as A34,
P1.Nomor_Mesin as A35,
P1.Nomor_Polisi as A36,
'' as A37,
P1.Nomor_BPKB as A38,
P1.Pemegang as A39,
P1.Pemegang_Lama as A40,
P1.Kondisi as A41,
P1.Masa_Manfaat as A42,
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
P1.Jenis as A061,
P1.Tipe_Bangunan as A62,
P1.Ukuran as A63,
P1.Keterangan as A64,
ifnull(sum(P2.Debet),0) as A65,
P1.file_name as A66,
P3.KeberadaanBarang as A67 
FROM ta_kib_108_sensus_2023 P1
LEFT JOIN ta_kib_post_108_sensus_2023 P2 ON P2.Referensi=P1.Referensi AND P2.Kd_UPB=P1.Kd_UPB 
LEFT JOIN tb_lembar_kerja P3 ON P3.Referensi=P1.Referensi AND P3.KdUPB=P1.Kd_UPB AND P3.RefGroup=P1.Ref_Group 
WHERE P1.Kd_UPB LIKE '".$UnT."%' $FiD AND P1.Extracom LIKE '".$ExT."' $SyT 
GROUP BY P1.Referensi 
ORDER BY P1.Referensi LIMIT $A,$B";
#echo $nSQ;
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG = fBackCLR($iG);
	$IdT = $mRo[0];
	$Lok = $mRo[21];
	if ($Lok==''){$Lok = $mRo[47];}
	else {$Lok.= ", ".$mRo[47];}
	
	$mRo66 = fGlobal("file_name","ta_kib_108","Referensi:Ref_Group",$mRo[1].":".$mRo[2],"=:=","","");
	//$mRo68 = fGlobal("file_size","ta_kib_108","Referensi:Ref_Group",$mRo[1].":".$mRo[2],"=:=","","");
	
	$TnD = "";
	$SnsCEK = fGlobal("DataSensusFix","tb_lembar_kerja","Referensi:KdUPB:RefGroup",$mRo[1].":".$mRo[8].":".$mRo[2],"=:=:=","","");
	if ($SnsCEK=='P')
	{
		$TnD = "<font style='color:#0000ff'>dalam proses</font>";
	}
	if ($SnsCEK=='Y')
	{
		$TnD = "<font style='color:#ff0000'>selesai</font>";
	}
	
	#Foto/Denah
	$SmD = "";
	$ImGCEK = fGlobal("IDT","tb_lembar_kerja_foto_denah","Referensi:KdUPB:file_size",$mRo[1].":".$mRo[8].":0","=:=:<>","","");
	if ($mRo66!='' || $ImGCEK!='')
	{
		$SmD = "<img src='css/images/newokey.gif' width='10' />";
	}
	
	if ($SmD =='')
	{
		$ImGCEK = fGlobal("IDT","tb_lembar_kerja_upload_img","Referensi:KdUPB:filesize",$mRo[1].":".$mRo[8].":0","=:=:<>","","");
		if ($mRo66!='' || $ImGCEK!='')
		{
			$SmD = "<img src='css/images/okey.gif' width='10' />";
		}
	}
	
	#Dokumen
	$SmA = "";
	$DoKCEK = fGlobal("IDT","tb_lembar_kerja_dokumen","Referensi:KdUPB:file_size",$mRo[1].":".$mRo[8].":0","=:=:<>","","");
	if ($DoKCEK !='')
	{
		$SmA = "<img src='css/images/newokey.gif' width='10' />";
	}
	if ($SmA=='')
	{
		$DoKCEK = fGlobal("IDT","tb_lembar_kerja_upload_pdf","Referensi:KdUPB:filesize",$mRo[1].":".$mRo[8].":0","=:=:<>","","");
		if ($DoKCEK !='')
		{
			$SmA = "<img src='css/images/okey.gif' width='10' />";
		}
	}
	?>
	<tr height="28"> 
	  <td width="38" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td width="101" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[1]?></td>
	  <td width="101" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[9]?></td>
	  <td width="56" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$mRo[11]?></td>
	  <td width="204" style="border-bottom:1px #999999 dotted; text-align:left; border-left:1px #ccc solid; padding-left:3px" <?=$gBG?>><?=$mRo[14]?></td>
	  <td width="76" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center" <?=$gBG?>><?=$mRo[16]?></td>
	  <td width="300" <?=$gBG?> style="border-bottom:1px #999999 dotted; padding-left:3px; padding-right:3px; border-left:1px #ccc solid"><?=$Lok?></td>
	  <td width="104" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right"><?=fConvertToRupiah($mRo[28])?></td>
	  <td width="104" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right"><?=fConvertToRupiah($mRo[65])?></td>
	  <td width="40" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:center" <?=$gBG?>><?=$TnD?></td>
	  <td width="60" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:center" <?=$gBG?>><?php if ($SnsCEK=='Y'){echo $mRo[67];}?></td>
	  <td width="47" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:center"><?=$SmD?></td>
	  <td width="47" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:center"><?=$SmA?></td>
	  <td <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">
	  <a href="#" onClick="showLKI('','<?=$LRef?>','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>'); return false" class="ico edit">&nbsp;&nbsp;L K I</a>	  </td>
	</tr>
	<?php
	$iG++;
}
?>
<?php if ($iG>1) {?>
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
<?php }else{ ?>
<tr height="100%">
 <td colspan="15" align="center">Data tidak ditemukan..!!</td>
</tr>
<?php } ?>
</table>
<script languange="javascript">
$("#fFinM").focus();
</script>