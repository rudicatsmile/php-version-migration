<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

if ($gUnT=="ALL"){$gUnT="%";}

$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	$CrTg ="AND (P1.Referensi LIKE '%$gFnD%' 
	OR P1.No_Pengadaan LIKE '%$FnD%' 
	OR P1.Keterangan LIKE '%$FnD%' 
	OR P1.Lokasi LIKE '%$FnD%' 
	OR P1.Dokumen_Nomor LIKE '%$FnD%' 
	OR P1.Harga LIKE '%$FnD%' 
	OR P1.Ref_Mutasi LIKE '%$FnD%' 
	OR P1.Judul LIKE '%$FnD%' 
	OR P1.Nomor_Polisi LIKE '%$FnD%' 
	OR P1.Pencipta LIKE '%$FnD%' 
	OR P1.Daerah_Asal LIKE '%$FnD%' 
	OR P1.Nm_Aset LIKE '%$FnD%' 
	OR P1.Kd_Aset_108 LIKE '%$FnD%')";
	
	$CrTg ="AND (P1.Referensi LIKE '%$gFnD%' 
	OR P1.No_Pengadaan LIKE '%$FnD%' 
	OR P1.Nomor_Polisi LIKE '%$FnD%' 
	OR P1.Nm_Aset LIKE '%$FnD%' 
	OR P1.Kd_Aset_108 LIKE '%$FnD%')";
}
?>
<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="385px" style="border:0px">
<?
$x=array();
$iG=1;
$tJmL= 0;
if ($FnD!=""){
	
	$nSQ = "SELECT IDT, Referensi, Kd_Aset_108, No_Register, Nm_Aset, Tgl_Perolehan, Kd_UPB, Harga, Ref_Mutasi 
	FROM ta_kib_108 WHERE Kd_UPB LIKE '$gUnT%' AND KdpToAset='N' $CrTg ORDER BY Tgl_Perolehan LIMIT 0,100";
	
	$nSQ = "SELECT P1.IDT as A0, 
	P1.Referensi as A1, 
	P1.Kd_Aset_108 as A2, 
	P1.No_Register as A3, 
	P1.Nm_Aset as A4, 
	P1.Tgl_Perolehan as A5, 
	P1.Kd_UPB as A6, 
	P1.Harga as A7, 
	P1.Ref_Mutasi as A8, 
	IfNull(sum(P2.Debet),0) as A9,
	P3.Nm_Unit as A10,
	P1.No_Pengadaan as A11 
	FROM ta_kib_108 P1 
	LEFT JOIN ta_kib_post_108 P2 ON P2.Referensi=P1.Referensi AND P2.Ref_Group=P1.Ref_Group AND P2.Kd_UPB=P1.Kd_UPB 
	LEFT JOIN ref_unit P3 ON P3.Kd_Unit=left(P1.Kd_UPB,11) 
	WHERE P1.Kd_UPB LIKE '$gUnT%' AND P1.KdpToAset='N' $CrTg 
	GROUP BY P1.Referensi, P1.Ref_Group 
	ORDER BY P1.Tgl_Perolehan, P1.Referensi LIMIT 0,200";
	
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$x[1] = ""; $x[2] = ""; $x[3] = ""; $x[4] = ""; $x[5] = ""; $x[6] = ""; $x[7] = ""; $x[8] = ""; $x[9] = ""; $x[10] = ""; $x[11] = "";
		$gIDT = $mRo[0];
		$x[1] = $mRo[1];
		$x[2] = $mRo[2];
		$x[3] = $mRo[3];
		$x[4] = $mRo[4];
		$x[5] = fConvertDateShort($mRo[5]);
		$x[6] = substr($mRo[6],0,11);
		$x[7] = $x[6]." : ".$mRo[10];#fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo[6],0,11),"=","","");
		$x[8] = $mRo[7];
		$x[9] = $mRo[9];#fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB",$mRo[1].":".$mRo[6],"=:=","","");
		$x[10]= $mRo[11];
		$x[11]= $mRo[8];
		rinciDATA($x[1],$x[2],$x[3],$x[4],$x[5],$x[6],$x[7],$x[8],$x[9],$x[10],$x[11],$iG,$xB);
		$iG++;
	}
}
?>
<? function rinciDATA($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$iG,$xB){?>
	<?
	$gBG  = fBackCLR($iG);
	if ($x11!=""){
		$r1T = fConvertDateShort(fGlobal("Tgl_Mutasi","ta_kib_post_108_mutasi","Referensi_To:Kd_Aset_108_To:Kd_UPB_To",$x1.":".$x2.":".$x6."%","=:=:LIKE","",""));
		$r11 = fGlobal("Kd_UPB","ta_kib_post_108_mutasi","Referensi_To:Kd_Aset_108_To:Kd_UPB_To",$x1.":".$x2.":".$x6."%","=:=:LIKE","","");
		$r11 = fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($r11,0,11),"=","","");
		$e11 = "RefDiVer:".fGlobal("Ref_Usulan","ta_usulan_verifikasi_rinci_108","Ref_Aset:To_UPB",$x1.":".substr($x7,0,11)."%","=:LIKE","","");
		$e11 = $e11." : RefDiAst:".fGlobal("Ref_Usulan","ta_kib_post_108","Referensi:Kd_Aset_108:Kd_UPB",$x1.":".$x2.":".$x6."%","=:=:LIKE","","");
		
		$x11.= " : ".$r1T."<br><i>".$r11."<br>".$e11;
	}
	?>
	<tr height="22"> 
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; text-align:center"><?=$iG?>.</td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$x1?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$x2?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$x3?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:left; padding-left:3px"><?=$x4?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$x5?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px"><?=$x7?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right"><?=fConvertToRupiah($x8)?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px; text-align:right"><?=fConvertToRupiah($x9)?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center"><?=$x10?></td>
	  <td valign="top" <?=$gBG?> style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px"><?=$x11?></td>
	</tr>
<? } ?>
<? if ($iG==1) {?>
<tr height="100%">
	  <td valign="top" style="border-bottom:1px #999999 dotted; text-align:center">&nbsp;</td>
	  <td valign="top" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">&nbsp;</td>
	  <td valign="top" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">&nbsp;</td>
	  <td valign="top" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">&nbsp;</td>
	  <td valign="top" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:left; padding-left:3px">&nbsp;</td>
	  <td valign="top" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">&nbsp;</td>
	  <td valign="top" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px">&nbsp;</td>
	  <td valign="top" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px">&nbsp;</td>
	  <td valign="top" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-right:3px">&nbsp;</td>
	  <td valign="top" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; text-align:center">&nbsp;</td>
	  <td valign="top" style="border-bottom:1px #999999 dotted; border-left:1px #ccc solid; padding-left:3px">&nbsp;</td>
</tr>
<? } ?>
<tr height="100%">
 <td width="25" style="border-bottom:0px #999999 dotted">&nbsp;</td>
 <td width="100" style="border-bottom:0px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
 <td width="100" style="border-bottom:0px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
 <td width="60" style="border-bottom:0px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
 <td width="220" style="border-bottom:0px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
 <td width="70" style="border-bottom:0px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
 <td width="248" style="border-bottom:0px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
 <td width="100" style="border-bottom:0px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
 <td width="90" style="border-bottom:0px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
 <td width="147" style="border-bottom:0px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
 <td style="border-bottom:0px #999999 dotted; border-left:1px #ccc solid">&nbsp;</td>
</tr>
</table>
