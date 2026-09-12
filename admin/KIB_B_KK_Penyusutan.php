<?php require "CheckSession.php"?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php"?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Simbada Kab. Hulu Sungai Tengah</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
$gUnt  = $_GET['gUnt'];
$gSub  = $_GET['gSub'];
$gUpb  = $_GET['gUpb'];
$gThn  = $_GET['gThn'];

require "KIB_Dokumen_Unit.php";

$gMLK  = $_GET['gMLK'];
if ($gThn=="") {$gThn="____";}
if ($gThn=="All") {$gThn="____";}
if ($gMLK=="") {$gMLK="__";}
if ($gMLK=="All") {$gMLK="__";}

$gHr =$_GET['rHri'];
$gBl =$_GET['rBln'];
$gTh =$_GET['rThn'];
$TG2 = $gTh."-".substr("0".$gBl,-2,2)."-".substr("0".$gHr,-2,2);

//KODE LOKASI
if ($gMLK!="__")
{
	$KdKomp = $gMLK;				//Kode Komponen Kepemilikan
	$KdProp = "24";					//Kode Provinsi
	$KdKabK = "00";					//Kode Kab./Kota.
	$KdBida = substr($gSub,6,2);	//Kode Bidang
	$KdUnit = substr($gSub,9,2);	//Kode Unit Bidang
	$KdTahu = substr($gThn,-2);		//Tahun Pembelian
	$KdSubU = substr($gSub,-2);		//Kode Sub Unit
	$gLok = $KdKomp.".".$KdProp.".".$KdKabK.".".$KdBida.".".$KdUnit.".".$KdTahu.".".$KdSubU;
}
else
{$gLok = "-";}
?>
<body>

<div align="center">
	<table border="0" width="1300" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
		<tr>
			<td style="font-size: 13pt; font-weight: bold" align="center">KERTAS KERJA PENYUSUTAN </td>
		</tr>
		<tr>
			<td style="font-size: 13pt; font-weight: bold" align="center">PERALATAN DAN MESIN</td>
		</tr>
		<tr>
		  <td style="font-size: 10pt; font-weight: bold" align="center">PERTANGGAL <?=fConvertDateShort($TG2)?></td>
	  </tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
          <tr> 
            <td width="91">UNIT KERJA</td>
            <td width="22">:</td>
            <td width="923"><?php echo $gNmUNT ?></td>
          </tr>
		  <?php if ($gUnt!="All") { ?>
          <tr> 
            <td width="91">SUB UNIT</td>
            <td width="22">:</td>
            <td><?php echo $gNmSUB ?></td>
          </tr>
          <tr>
            <td>UPB</td>
            <td>:</td>
            <td><?php echo $gNmUPB?></td>
          </tr>
          <tr> 
            <td width="91">KODE LOKASI</td>
            <td width="22">:</td>
            <td><?php echo $gLok?></td>
          </tr>
		  <?php } else {?>
          <tr> 
            <td width="109">TAHUN</td>
            <td width="31">:</td>
            <td><?php echo $gThn?></td>
          </tr>
		  <?php } ?>
        </table>		</td>
		</tr>
		<tr>
			<td height="5"></td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" style="border:0 solid #000000; font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table2" bordercolor="#000000">
				<tr>
					<td width="3%" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">NO.</td>
					
            <td width="8%" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">KODE BARANG </td>
					
            <td width="17%" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold"> 
              <table border="0" width="100%" cellpadding="0" style="font-family: Calibri; font-size: 8pt; font-weight: bold; border-collapse: collapse" id="table5">
						<tr>
							<td align="center">JENIS BARANG  / </td>
						</tr>
						<tr>
							<td align="center">NAMA BARANG </td>
						</tr>
					</table>					</td>
					
            <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold"> PEROLEHAN </td>
            <td width="7%" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">NILAI DI NERACA SEBELUM PENYUSUTAN </td>
            <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold">MASA MANFAAT YANG TELAH DILALUI S.D 31 DES <?=$gTh-1?></td>
            <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold">MASA MANFAAT</td>
            <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold">BEBAN PENYUSUTAN</td>
            <td colspan="3" align="center" style="border:1px solid #000000; font-weight: bold">PENYUSUTAN</td>
            <td width="7%" rowspan="2" align="center" style="border:1px solid #000000; font-weight: bold">NILAI BUKU </td>
            </tr>
			<tr>
			  <td width="3%" align="center" style="border:1px solid #000000; font-weight: bold">TAHUN</td>
			  <td width="6%" align="center" style="border:1px solid #000000; font-weight: bold">TANGGAL</td>
			  <td width="5%" align="center" style="border:1px solid #000000; font-weight: bold">TAHUN</td>
			  <td width="5%" align="center" style="border:1px solid #000000; font-weight: bold">HARI</td>
			  <td width="3%" align="center" style="border:1px solid #000000; font-weight: bold">TAHUN</td>
			  <td width="4%" align="center" style="border:1px solid #000000; font-weight: bold">HARI</td>
			  <td width="6%" align="center" style="border:1px solid #000000; font-weight: bold">TAHUN</td>
			  <td width="6%" align="center" style="border:1px solid #000000; font-weight: bold">HARI</td>
			  <td style="border:1px solid #000000; font-weight: bold" align="center">KOREKSI TAHUN-TAHUN SEBELUMNYA </td>
			  <td width="7%" align="center" style="border:1px solid #000000; font-weight: bold">TAHUN <?=$gTh?></td>
			  <td width="6%" align="center" style="border:1px solid #000000; font-weight: bold">JUMLAH</td>
		  	</tr>
			<tr>
			<td style="border:1px solid #000000; font-weight: bold" align="center" width="3%">1</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="8%">2</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="17%"> 3 </td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="3%">4</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="6%">5</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="7%">6</td>
            <td width="5%" align="center" style="border:1px solid #000000; font-weight: bold">7</td>
            <td width="5%" align="center" style="border:1px solid #000000; font-weight: bold">8</td>
            <td width="3%" align="center" style="border:1px solid #000000; font-weight: bold">9</td>
            <td width="4%" align="center" style="border:1px solid #000000; font-weight: bold">10</td>
            <td width="6%" align="center" style="border:1px solid #000000; font-weight: bold">11</td>
            <td width="6%" align="center" style="border:1px solid #000000; font-weight: bold">12</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="7%">13=8x12</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="7%">14</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="6%">15</td>
            <td style="border:1px solid #000000; font-weight: bold" align="center" width="7%">16</td>
            </tr>
				<?php
				$Col[16];
				$iG = 1;
				$gHrg = 0;
				function ClrVr()
				{
					for($nG=0; $nG<=16; $nG++)
					{
						$Col[$nG]="";
					}
				}
				
				$tx6  = 0;
				$tx11 = 0;
				$tx12 = 0;
				$tx13 = 0;
				$tx14 = 0;
				$tx15 = 0;
				$tx16 = 0;
				
				$nSQL= "SELECT * FROM ta_kib_b WHERE Kd_UPB LIKE '".$gUpb."' AND Tgl_Perolehan LIKE '".$gThn."-__-__' AND Kd_Pemilik LIKE '".$gMLK."' AND Status='' ORDER BY Tgl_Perolehan, Kd_Aset, No_Register";
				$nRs = mysql_query($nSQL) or die(mysql_error());
				$mRo = mysql_fetch_assoc($nRs);
				$tRo = mysql_num_rows($nRs);
				if ($tRo > 0)
				{
					do
					{
						ClrVr();
						$Col[1] = $iG;
						$Col[2] = $mRo['Kd_Aset'];
						$Col[3] = $mRo['Nm_Aset'];
						if ($Col[3]=="") {$Col[3]=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");}
						
						$Col4 = (int)substr($mRo['Tgl_Perolehan'],0,4);
						
						if ($Col4 >= 2015) {$TglPNY = $mRo['Tgl_Perolehan'];}
						else {$TglPNY = ($Col4+1)."-01-01";}
						
						//$Col[4] = $TglPNY."<br>".($gTh-1)."-12-31";
						$Col[4] = substr($mRo['Tgl_Perolehan'],0,4);
						$Col[5] = $TglPNY;
						
						$gREF = $mRo['Referensi'];
						
						$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi",$gREF,"=","","");
						$gNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Referensi",$gREF,"=","","");
						if ($gNIb!=0) {$gAKH = $gNIa - $gNIb;}
						else {$gAKH=$gNIa;}
						
						$Col[6] = $gAKH;
						
						$Col[8] = HitJmlHari($TglPNY,($gTh-1)."-12-31","");
						
						//Kolom 10
						$Col[9] = fGlobal("Ms_Manfaat","Ref_Rek_Aset3","Kd_Aset",substr($mRo['Kd_Aset'],0,8),"=","","");
						//Menentukan tanggal ... pada tahun mendatang
						$rTG = substr($TglPNY,-2,2);
						$rBL = substr($TglPNY,5,2);
						$rTH = substr($TglPNY,0,4);
						
						//Kurangkan tahun mendatang dengan tanggal BAST (agar bisa menghitung tahun kabisat)
						//echo TakeTglThnMendatang($rTG,$rBL,$rTH,$Col[9])."<br>";
						$Col[10] = HitJmlHari($TglPNY,TakeTglThnMendatang($rTG,$rBL,$rTH,$Col[9]),"");
						
						if ($Col[8] >= $Col[10]) {$Col[8] = $Col[10];}
						if ($Col[8] < 0) {$Col[8] = 0;}
						
						//Kolom 7
						$Col[7]=0;
						if ($Col[8] >= 364) {$Col[7]= round($Col[8]/364);}
						
						if ((int)$Col[6]>0 && (int)$Col[9]>0) {
							$Col[11] = round($Col[6] / $Col[9],2);}
						else {
							$Col[11]=0;}
						
						if ((int)$Col[6]>0 && (int)$Col[10]>0) {
							$Col[12] = $Col[6] / $Col[10];}
						else {
							$Col[12] = 09;}
						
						if ($Col[8] < 0) {
							$Col[13] = 0;
						} 
						else {
							$Col[13] = round($Col[8] * $Col[12],2);
						}
						
						//Kolom 14
						if ($Col4 >= 2015){
							$gJaN = HitJmlHari($TglPNY,$TG2,"");
						} else {
							$gJaN = HitJmlHari(($gTh)."-01-01",$TG2,"");
						}
						
						//Jika kurang dari 1 tahun cukup ambil perbedaan data hari
						if (($Col[10] - $Col[8]) < 364){
							$gJaN = ($Col[10] - $Col[8]);
						}
						
						$Col[14]= $gJaN * $Col[12];
						$Col[15] = $Col[13]+$Col[14];
						$Col[16] = round($Col[6]-$Col[15],2);
						
						$tx6 = $tx6 + $Col[6];
						$tx11 = $tx11 + $Col[11];
						$tx12 = $tx12 + $Col[12];
						$tx13 = $tx13 + $Col[13];
						$tx14 = $tx14 + $Col[14];
						$tx15 = $tx15 + $Col[15];
						$tx16 = $tx16 + $Col[16];
						echo ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$gJaN);
						$iG++;
					}
					while ($mRo = mysql_fetch_assoc($nRs));	
				}
				else
				{
				echo ViewBlank();
				}
				?>
			<?php function ViewRincian($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$gJaN) {?>
			<tr>
				<td width="3%" style="border: 1px solid #000000" valign="top" align="center"><?=$x1?>.</td>
				<td width="8%" style="border: 1px solid #000000" valign="top" align="center"><?=$x2?></td>
				<td width="17%" style="border: 1px solid #000000" valign="top"><?=$x3?></td>
				<td width="3%" align="center" valign="top" style="border: 1px solid #000000"><?=$x4?></td>
				<td width="6%" align="center" valign="top" style="border: 1px solid #000000"><?=fConvertDateShort($x5)?></td>
				<td width="7%" style="border: 1px solid #000000" valign="top" align="right"><?=fConvertToRupiah($x6)?></td>
				<td width="5%" align="center" valign="top" style="border: 1px solid #000000"><?=$x7?></td>
				<td width="5%" align="center" valign="top" style="border: 1px solid #000000"><?=$x8?></td>
				<td width="3%" align="center" valign="top" style="border: 1px solid #000000"><?=$x9?></td>
				<td width="4%" align="center" valign="top" style="border: 1px solid #000000"><?=$x10?></td>
				<td width="6%" align="right" valign="top" style="border: 1px solid #000000"><?=fConvertToRupiah($x11)?></td>
				<td width="6%" align="right" valign="top" style="border: 1px solid #000000"><?=fConvertToRupiah($x12)?></td>
				<td width="7%" style="border: 1px solid #000000" valign="top" align="right"><?=fConvertToRupiah($x13)?></td>
				<td width="7%" style="border: 1px solid #000000; background:#CCCCCC" valign="top" align="right" title="<?=$gJaN?>"><?=fConvertToRupiah($x14)?></td>
				<td width="6%" style="border: 1px solid #000000" valign="top" align="right"><?=fConvertToRupiah($x15)?></td>
				<td width="7%" style="border: 1px solid #000000" valign="top" align="right"><?=fConvertToRupiah($x16)?></td>
            </tr>
		<?php } ?>
		<?php function ViewBlank() {?>
		<tr>
			<td width="3%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="8%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="17%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="3%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="6%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="7%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="5%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="5%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="3%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="4%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="6%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="6%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="7%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="7%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="6%" style="border: 1px solid #000000">&nbsp;</td>
            <td width="7%" style="border: 1px solid #000000">&nbsp;</td>
            </tr>
		<?php } ?>
		<tr>
					
            <td colspan="5" align="center" style="border:1px solid #000000; font-weight: bold"> JUMLAH</td>
            <td style="border:1px solid #000000; font-weight: bold" align="right"><?=fConvertToRupiah($tx6)?></td>
            <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold">&nbsp;</td>
            <td colspan="2" align="center" style="border:1px solid #000000; font-weight: bold">&nbsp;</td>
            <td style="border:1px solid #000000; font-weight: bold" align="right"><?=fConvertToRupiah($tx11)?></td>
            <td align="right" style="border:1px solid #000000; font-weight: bold"><?=fConvertToRupiah($tx12)?></td>
            <td style="border:1px solid #000000; font-weight: bold" align="right"><?=fConvertToRupiah($tx13)?></td>
            <td style="border:1px solid #000000; font-weight: bold; background:#CCCCCC" align="right"><?=fConvertToRupiah($tx14)?></td>
            <td style="border:1px solid #000000; font-weight: bold" align="right"><?=fConvertToRupiah($tx15)?></td>
            <td style="border:1px solid #000000; font-weight: bold" align="right"><?=fConvertToRupiah($tx16)?></td>
		</tr>
			</table>			</td>
		</tr>
		<tr>
			<td style="font-family: Calibri Narrow; font-style: italic">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<?php if ($gUnt!="All") { ?>
		<tr>
		  <td>&nbsp;</td>
		</tr>
		<?php } ?>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
</div>

</body>

</html>

