<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

if ($gUPB!=''){
	$gUNT = substr($gUPB,0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	$gSUB = substr($gUPB,0,14);
	$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
	$gUPB = substr($gUPB,0,18);
	$dUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUPB,"=","","");
}
else{
	$gUNT = substr($SkP,0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
	$gSUB = substr($SkP,0,14);
	$dSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSUB,"=","","");
	$gUPB = substr($SkP,0,18);
	$dUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUPB,"=","","");
}

?>
<table align="center" border="0" width="1100" cellspacing="1" style="font-size:10pt; font-family: Calibri; border-collapse: collapse">
<tr>
	<td style="font-size: 12pt; font-weight: bold">DAFTAR SP3B DANA BOS</td>
</tr>
<tr>
  <td style="font-size: 12pt; font-weight: bold" align="center">&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="1100" cellspacing="1" style="font-size:10pt; font-family: Calibri; border-collapse: collapse">
<tr>
<td width="65">UNIT KERJA </td>
<td width="20" align="center">:</td>
<td width="350"><?=$dUNT?></td>
<td width="75">TAHUN</td>
<td width="20" align="center">:</td>
<td><?=$gTHN?></td>
</tr>
<tr>
  <td>SUB UNIT </td>
  <td align="center">:</td>
  <td><?=$dSUB?></td>
  <td>JENIS</td>
  <td align="center">:</td>
  <td><? if ($gJNS=='AA'){echo "SEMUA";} else {echo fGlobal("Deskripsi","ref_sp3d_jenis","Kode",$gJNS,"=","","");}?></td>
  </tr>
<tr>
  <td>UPB</td>
  <td align="center">:</td>
  <td><?=$dUPB?></td>
  <td>TAHAP</td>
  <td align="center">:</td>
  <td><? if ($gSES=='AA'){echo "SEMUA";} else {fGlobal("Deskripsi","ref_session","Kode",$gSES,"=","","");}?></td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td align="center">&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
<table align="center" border="0" width="1100" cellspacing="0" cellpadding="0" style="border:0px; font-size:10pt; font-family: Calibri; border-collapse: collapse">
  <tr style="font-weight:bold">
    <td width="28" align="center" style="border:1px #000 solid">NO</td>
    <td width="110" align="center" style="border:1px #000 solid">REFERENSI</td>
    <td width="70" align="center" style="border:1px #000 solid">TGL. SP3B</td>
    <td width="145" align="center" style="border:1px #000 solid">NOMOR SP3B</td>
    <td width="215" align="center" style="border:1px #000 solid">U P B</td>
    <td width="65" align="center" style="border:1px #000 solid">JENIS</td>
    <td width="56" align="center" style="border:1px #000 solid">TAHAP</td>
    <td width="245" align="center" style="border:1px #000 solid">URAIAN</td>
    <td width="101" align="right" style="border:1px #000 solid; padding:2px">NILAI SP3B</td>
    <td width="101" align="right" style="border:1px #000 solid; padding-right:2px">KAPITALISASI</td>
  </tr>
<?
if ($gUPB=="ALL"){
	if ($gSUB=="ALL"){
		$gUPB = $gUNT."%";
	}
	else{
		$gUPB = $gSUB."%";
	}
}
else{
	$gUPB = $gUPB;
}
$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (P1.Referensi LIKE '%$gFnD%' OR P1.Uraian LIKE '%$FnD%' OR P1.Nom_SP3D LIKE '%$FnD%' OR P5.Kd_UPB LIKE '%$FnD%' OR P5.Nm_UPB LIKE '%$FnD%')";
}
if ($gJNS=='AA') {$gJNS="%";}
if ($gSES=='AA') {$gSES="%";}

$iG=1;
$tJmL= 0;
$nSQ = "SELECT P1.IDT, P1.Tgl_SP3D, P1.Referensi, P1.Nom_SP3D, P3.Nm_Unit, P4.Nm_Sub, P5.Nm_UPB, P2.Deskripsi, P1.Uraian, P1.Nilai, P6.Deskripsi as NmJns, P2.Kode as KdSE, P6.Kode as KdJN 
FROM ta_sp3d P1 
LEFT JOIN ref_session P2 ON P2.Kode=P1.KdSesi 
LEFT JOIN ref_unit P3 ON P3.Kd_Unit=Left(P1.Kd_UPB,11) 
LEFT JOIN ref_sub_unit P4 ON P4.Kd_Sub=Left(P1.Kd_UPB,14) 
LEFT JOIN ref_upb P5 ON P5.Kd_UPB=P1.Kd_UPB 
LEFT JOIN ref_sp3d_jenis P6 ON P6.Kode=P1.KdJenis 
WHERE P1.Kd_UPB LIKE '$gUPB' AND P1.Tahun='$gTHN' AND P1.KdJenis LIKE '$gJNS' AND P1.KdSesi LIKE '$gSES' $CrT ORDER BY P1.Referensi LIMIT 0,500";
#echo $nSQ;
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gBG  = fBackCLR($iG);
	$gIdT = $mRo[0];
	$mRo1 = $mRo[1];
	$mRo2 = $mRo[2];
	$mRo3 = $mRo[3];
	$mRo4 = $mRo[4];
	$mRo5 = $mRo[5];
	$mRo6 = $mRo[6];
	$mRo7 = $mRo[7];
	$mRo8 = $mRo[8];
	#$mRo9 = $mRo[9];
	$mRo10= $mRo[10];
	$mRo9 = fGlobal("IfNull(sum(Nilai),0)","ta_sp3d_rinci","Referensi:Kd_ReknP90",$mRo[2].":5%","=:LIKE","","");
	$mRo11= fGlobal("IfNull(sum(Total),0)","ta_sp3d_spj_rinci","Referensi_SP3B",$mRo[2],"=","","");
	
	if ($mRo9=='Y') {$WgT="normal";} else {$WgT="normal";}
	$gJmL = 0;//fGlobal("Ifnull(sum(nilai_akhir),0)","ta_usulan_rinci_108","Referensi",$mRo2,"=","","");
	$gCnT = 0;//fGlobal("IfNull(count(*),0)","ta_usulan_rinci_108","Referensi",$mRo2,"=","","");
	$gCnB = 0;//fGlobal("IfNull(count(*),0)","ta_usulan_verifikasi_rinci_108","Ref_Usulan:Eksekusi",$mRo2.":Sudah","=:=","","");
	#echo $gCnT.":".$gCnB."<br>";
	if ($gCnT > $gCnB && $gCnB!=0){
		$rIco="edie";
		$rCap="<font style='color:#0000ff'><i>Executed</i></font>";
		$rEdi="Edit";
		$rDel="delt";
		$rCek="NoDelS";
	}
	else if ($gCnT==$gCnB && $gCnT!=0){
		$rIco="edie";
		$rCap="<font style='color:#ff0000'><i>Executed</i></font>";
		$rEdi="Edit";
		$rDel="delt";
		$rCek="NoDelA";
	}
	else{
		$rIco="edit";
		$rDel="dele";
		$rCap="-";
		$rCek="";
		$rEdi="Edit";
	}
	
	$tJmL = $tJmL + $mRo9;
	$tJmS = $tJmS + $mRo11;
	?>
	<tr height="32"> 
	  <td width="28" style="border:1px #000 solid; text-align:center"><?=$iG?>.</td>
	  <td width="110" style="border:1px #000 solid; border:1px #000 solid; text-align:center"><?=$mRo2?></td>
	  <td width="70" style="border:1px #000 solid; border:1px #000 solid; text-align:center"><?=fConvertDateShort($mRo1)?></td>
	  <td width="140" style="border:1px #000 solid; border:1px #000 solid; padding:5px"><?=$mRo3?></td>
	  <td width="210" style="border:1px #000 solid; text-align:left; border:1px #000 solid; padding:5px"> <?="UPB -> ".$mRo6?></td>
	  <td width="60" style="border:1px #000 solid; text-align:left; border:1px #000 solid; padding:5px"><?=$mRo10?></td>
	  <td width="50" style="border:1px #000 solid; padding:1px; padding-right:1px; border:1px #000 solid"><?=$mRo7?></td>
	  <td width="240" style="border:1px #000 solid; border:1px #000 solid; padding:5px"><?=$mRo8?></td>
	  <td width="100" style="border:1px #000 solid; border:1px #000 solid; padding-right:1px; text-align:right"><?=fConvertToRupiah($mRo9)?></td>
	  <td width="100" style="border:1px #000 solid; border:1px #000 solid; padding-right:1px; text-align:right"><?=fConvertToRupiah($mRo11)?></td>
    </tr>
	<?
	$iG++;
}
?>
<? if ($iG>1) {?>
<tr height="100%">
 <td style="border:0px #000 solid; border:1px #000 solid">&nbsp;</td>
 <td style="border:1px #000 solid; border:1px #000 solid">&nbsp;</td>
 <td style="border:1px #000 solid; border:1px #000 solid">&nbsp;</td>
 <td style="border:1px #000 solid; border:1px #000 solid">&nbsp;</td>
 <td style="border:1px #000 solid; border:1px #000 solid">&nbsp;</td>
 <td style="border:1px #000 solid; border:1px #000 solid">&nbsp;</td>
 <td style="border:1px #000 solid; border:1px #000 solid">&nbsp;</td>
 <td style="border:1px #000 solid; border:1px #000 solid">&nbsp;</td>
 <td style="border:1px #000 solid; border:1px #000 solid">&nbsp;</td>
 <td style="border:1px #000 solid; border:1px #000 solid">&nbsp;</td>
 </tr>
<tr height="20">
  <td style="text-align:right; font-weight:bold; padding-right:10px; border:1px #000 solid" colspan="7">T O T A L</td>
  <td style="text-align:right; font-weight:bold; padding-right:1px; border:1px #000 solid">&nbsp;</td>
  <td style="text-align:right; font-weight:bold; padding-right:1px; border:1px #000 solid"><?=fConvertToRupiah($tJmL)?></td>
  <td style="text-align:right; font-weight:bold; padding-right:1px; border:1px #000 solid"><?=fConvertToRupiah($tJmS)?></td>
  </tr>
<? }else{ ?>
<tr height="100%">
 <td colspan="11" align="center">Data tidak ditemukan..!!</td>
</tr>
<? } ?>
</table>
