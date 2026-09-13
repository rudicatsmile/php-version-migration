<?php require "CheckSession.php"?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php"?>
<?php
ini_set('max_execution_time', 300);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
extract($_GET);
$gNmUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($gUpb,0,11),"=","","");
$gNmSUB = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",substr($gUpb,0,14),"=","","");
$gNmUPB = fGlobal("Nm_UPB","ref_upb","Kd_UPB",$gUpb,"=","","");
$gNmRUA = fGlobal("Nm_Ruang","ref_ruangan","Kd_UPB:Kd_Ruang",$gUpb.":".$gRua,"=:=","","");

$nSQ = "SELECT Jab_Pimpinan,Nma_Pimpinan,Pkt_Pimpinan,Nip_Pimpinan FROM ref_unit WHERE Kd_Unit LIKE '".substr($gUpb,0,11)."'";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$HeanGP = $mRo[0];
	$NmPnGP = $mRo[1];
	$NmPnKP = $mRo[2];
	$NiPnGP = $mRo[3];
}


$nSQ = "SELECT Nm_Pejabat,Nm_Jabatan, Nip_Pejabat FROM ref_ruangan WHERE Kd_UPB LIKE '".$gUpb."' AND Kd_Ruang = '".$gRua."'";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$NmPnGG = $mRo[0];
	$NmPnKT = $mRo[1];
	$NiPnGG = $mRo[2];
}

#echo $gUpb.":".$gRua;
?>
	<table align="center" border="0" width="1300" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
		<tr>
			<td style="font-size: 13pt; font-weight: bold" align="center">KARTU INVENTARIS RUANGAN (KIR)</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
		<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table3">
          <tr>
            <td>KABUPATEN</td>
            <td>:</td>
            <td><?=$NmDaer?></td>
          </tr>
          <tr>
            <td>PROVINSI</td>
            <td>:</td>
            <td><?=$NmProv?></td>
          </tr>
          <tr> 
            <td width="89">UNIT</td>
            <td width="32">:</td>
            <td width="1065"><?=strtoupper($gNmUNT)?></td>
          </tr>
          <tr> 
            <td width="89">SUB UNIT</td>
            <td width="32">:</td>
            <td><?=strtoupper($gNmSUB)?></td>
          </tr>
          <tr>
            <td>UPB</td>
            <td>:</td>
            <td><?=strtoupper($gNmUPB)?></td>
          </tr>
          <tr> 
            <td width="89">RUANGAN</td>
            <td width="32">:</td>
            <td><?=strtoupper($gNmRUA)?></td>
          </tr>
        </table></td>
		</tr>
		<tr>
		  <td>&nbsp;</td>
	  </tr>
		<tr>
		  <td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table3">
			<tr style="text-align:center; font-weight: bold">
			  <td width="30" style="border:1px solid #000; border-bottom:3px double #000">NO.</td>
			  <td style="border:1px solid #000; border-bottom:3px double #000">NAMA / JENIS BARANG</td>
			  <td width="200" style="border:1px solid #000; border-bottom:3px double #000">MERK / MODEL</td>
			  <td width="100" style="border:1px solid #000; border-bottom:3px double #000">NO. SERI<br>PABRIK</td>
			  <td width="80" style="border:1px solid #000; border-bottom:3px double #000">UKURAN</td>
			  <td width="100" style="border:1px solid #000; border-bottom:3px double #000">BAHAN</td>
			  <td width="100" style="border:1px solid #000; border-bottom:3px double #000">TAHUN PEMBUATAN/ <br>PEMBELIAN</td>
			  <td width="100" style="border:1px solid #000; border-bottom:3px double #000">KODE<br>BARANG</td>
			  <td width="60" style="border:1px solid #000; border-bottom:3px double #000">JUMLAH<br>BARANG</td>
			  <td width="90" style="border:1px solid #000; border-bottom:3px double #000">HARGA<br>BELI</td>
			  <td width="60" style="border:1px solid #000; border-bottom:3px double #000">KEADAAN<br>BARANG</td>
			  <td width="100" style="border:1px solid #000; border-bottom:3px double #000">KETERANGAN</td>
			</tr>
			<!--tr style="text-align:center; font-weight: bold">
				<td width="30" style="border:1px solid #000; border-bottom:3px double #000">1</td>
				<td style="border:1px solid #000; border-bottom:3px double #000">2</td>
				<td width="200" style="border:1px solid #000; border-bottom:3px double #000">3</td>
				<td width="100" style="border:1px solid #000; border-bottom:3px double #000">4</td>
				<td width="80" style="border:1px solid #000; border-bottom:3px double #000">5</td>
				<td width="100" style="border:1px solid #000; border-bottom:3px double #000">6</td>
				<td width="100" style="border:1px solid #000; border-bottom:3px double #000">7</td>
				<td width="100" style="border:1px solid #000; border-bottom:3px double #000">8</td>
				<td width="60" style="border:1px solid #000; border-bottom:3px double #000">9</td>
				<td width="90" style="border:1px solid #000; border-bottom:3px double #000">10</td>
				<td width="60" style="border:1px solid #000; border-bottom:3px double #000">11</td>
				<td width="80" style="border:1px solid #000; border-bottom:3px double #000">12</td>
			</tr-->
			<?php
			$iG=1;
			$nSQ = "SELECT count(*) as gItm, Nm_Aset,Merk,Nomor_Pabrik,Ukuran_CC,Bahan,Tgl_Perolehan,sum(Harga),Kondisi, Kd_Aset_108 
			FROM ta_kib_108 WHERE Kd_UPB LIKE '".$gUpb."' AND Kd_Ruang='".$gRua."' 
			GROUP BY Kd_Aset_108,Nm_Aset,Merk,Nomor_Pabrik,Ukuran_CC,Bahan,Tgl_Perolehan,Harga,Kondisi";
			$nRs = mysql_query($nSQ);
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				$mRo1 = fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$mRo[9],"=","","");
				?>
				<tr>
				  <td valign="top" style="border:1px solid #000; text-align:center"><?=$iG?>.</td>
				  <td valign="top" style="border:1px solid #000"><?=$mRo1." (<i>".$mRo[1]."</i>)"?></td>
				  <td valign="top" style="border:1px solid #000"><?=$mRo[2]?></td>
				  <td valign="top" style="border:1px solid #000"><?=$mRo[3]?></td>
				  <td valign="top" style="border:1px solid #000"><?=$mRo[4]?></td>
				  <td valign="top" style="border:1px solid #000"><?=$mRo[5]?></td>
				  <td valign="top" style="border:1px solid #000; text-align:center"><?=substr($mRo[6],0,4)?></td>
				  <td valign="top" style="border:1px solid #000; text-align:center"><?=$mRo[9]?></td>
				  <td valign="top" style="border:1px solid #000; text-align:center"><?=$mRo[0]?></td>
				  <td valign="top" style="border:1px solid #000; text-align:right"><?=fConvertToRupiahBulat($mRo[7])?></td>
				  <td valign="top" style="border:1px solid #000; text-align:center"><?=$mRo[8]?></td>
				  <td valign="top" style="border:1px solid #000">&nbsp;</td>
				</tr>
				<?php
				$iG++;
				$mRo0 = $mRo0+$mRo[0];
				$mRo7 = $mRo7+$mRo[7];
			}
			?>
			  <tr height="23" style="font-weight:bold">
			  <td colspan="8" style="border:1px solid #000; text-align:center">T O T A L</td>
			  <td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($mRo0)?></td>
			  <td style="border:1px solid #000; text-align:right"><?=fConvertToRupiahBulat($mRo7)?></td>
			  <td style="border:1px solid #000; text-align:center">&nbsp;</td>
			  <td style="border:1px solid #000">&nbsp;</td>
			  </tr>
			</table>
		  </td>
	  </tr>
		<tr>
		  <td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table3">
			<tr>
			  <td width="350">&nbsp;</td>
			  <td>&nbsp;</td>
			  <td width="350">&nbsp;</td>
			</tr>
			<tr>
			  <td style="text-align:center">MENGETAHUI,</td>
			  <td>&nbsp;</td>
			  <td style="text-align:center"><?=$NmIbuk?>, <?=str_repeat("&nbsp;",10)?>/<?=str_repeat("&nbsp;",10)?>/</td>
			  </tr>
			<tr>
			  <td style="text-align:center"><?=$HeanGP?></td>
			  <td>&nbsp;</td>
			  <td style="text-align:center">PENANGGUNG JAWAB RUANGAN</td>
			  </tr>
			<tr>
			  <td height="70">&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  </tr>
			<tr>
			  <td style="text-align:center; text-decoration:underline; font-weight:bold"><?=$NmPnGP?></td>
			  <td>&nbsp;</td>
			  <td style="text-align:center; text-decoration:underline; font-weight:bold"><?=$NmPnGG?></td>
			  </tr>
			<tr>
			  <td style="font-size:9pt; text-align:center"><?=strtoupper($NmPnKP)?></td>
			  <td>&nbsp;</td>
			  <td style="font-size:9pt; text-align:center"><?=strtoupper($NmPnKT)?></td>
			  </tr>
			<tr>
			  <td style="text-align:center">NIP. <?=$NiPnGP?></td>
			  <td>&nbsp;</td>
			  <td style="text-align:center">NIP. <?=$NiPnGG?></td>
			  </tr>
		  </table>
		  </td>
	  </tr>
</table>
</html>
