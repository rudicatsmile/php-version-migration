<?php require "CheckSession.php";?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php";?>
<?php
ini_set('max_execution_time', 300);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Simbada</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
$gUnt  = $_GET['gUnt'];
$gSub  = $_GET['gSub'];
$gUpb  = $_GET['gUpb'];

$xUnt  = $_GET['gUnt'];
$xSub  = $_GET['gSub'];
$xUpb  = $_GET['gUpb'];

$gThA  = $_GET['gThA'];
$gThB  = $_GET['gThB'];

$gBid= $_GET['gBid'];
$gKel= $_GET['gKel'];
$gJns= $_GET['gJns'];
$gOBJ= $_GET['gOBJ'];
$gRin= $_GET['gRin'];
$gMLK= $_GET['gMLK'];
$gExt= $_GET['gExt'];
require "KIB_Dokumen_Unit_Choise.php";

$gTglA= $gThA."-01-01";
$gTglB= $gThB."-12-31";

?>

<body>

<div align="center">
	<table border="0" width="2000" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
		
		<tr>
			
      <td style="font-size: 13pt; font-weight: bold" align="center">ASET LAINNYA<br>KEMITERAAN DENGAN PIHAK KETIGA</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
			  <tr> 
				<td width="80">UNIT KERJA</td>
				<td width="17">:</td>
				<td width="484"><?php echo $gNmUNT ?></td>
				<td width="96">BIDANG ASET </td>
				<td width="17">:</td>
				<td width="1287"><?php echo $nAs1?></td>
			  </tr>
			  <tr> 
				<td width="80">SUB UNIT</td>
				<td width="17">:</td>
				<td><?php echo $gNmSUB ?></td>
				<td>KELOMPOK ASET </td>
				<td>:</td>
				<td><?php echo $nAs2?></td>
			  </tr>
			  <tr>
				<td>UPB</td>
				<td>:</td>
				<td><?php echo $gNmUPB?></td>
				<td>JENIS ASET </td>
				<td>:</td>
				<td><?php echo $nAs3?></td>
			  </tr>
			  <tr>
				<td>KEPEMILIKAN</td>
				<td>:</td>
				<td><?php echo $nMLK?></td>
				<td>OBJEK ASET </td>
				<td>:</td>
				<td><?php echo $nAs4?></td>
			  </tr>
			  <tr>
				<td>TAHUN</td>
				<td>:</td>
				<td><?php echo $gThA?> s.d <?php echo $gThB?></td>
				<td>RINCIAN ASET </td>
				<td>:</td>
				<td><?php echo $nAs5?></td>
			  </tr>
			</table>			</td>
		</tr>
		<tr>
			<td height="5"></td>
		</tr>
		<tr>
		  <td>
		  <table border="0" width="2000" cellpadding="0" cellspacing="0" style="border:0 solid #000; font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table2" bordercolor="#000">
          <tr style="text-align:center"> 
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">NO</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">U N I T</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">SUB UNIT</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">U P B</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">KODE BARANG </td>
            <td style="border:1px solid #000; font-weight: bold" colspan="2">DOKUMEN </td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold" width="7%">MERK / TYPE </td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold" width="8%">NO.SERTIFIKAT NO.PABRIK NO.CHASIS NO.MESIN</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">BAHAN</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">ASAL / CARA PEROLEHAN BARANG </td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">TAHUN BELI / TGL.PEROLEHAN </td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">UKURAN BARANG/ KONTRUKSI (P.S.D)</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">SATUAN</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">KEADAAN BARANG (B/KB/RB) </td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">JUMLAH BARANG</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">NILAI PEROLEHAN </td>
            </tr>
          <tr style="text-align:center"> 
            <td align="center" style="border:1px solid #000; font-weight: bold">REGISTER</td>
            <td align="center" style="border:1px solid #000; font-weight: bold">NAMA BARANG </td>
            </tr>
          <tr style="text-align:center">
            <td width="30" style="border:1px solid #000; font-weight: bold">1</td>
            <td width="200" style="border:1px solid #000; font-weight: bold">2</td>
            <td width="200" style="border:1px solid #000; font-weight: bold">3</td>
            <td width="200" style="border:1px solid #000; font-weight: bold">4</td>
            <td width="90" style="border:1px solid #000; font-weight: bold">5</td>
            <td width="50" style="border:1px solid #000; font-weight: bold">6</td>
            <td style="border:1px solid #000; font-weight: bold">7</td>
            <td width="90" style="border:1px solid #000; font-weight: bold">8</td>
            <td width="150" style="border:1px solid #000; font-weight: bold">9</td>
            <td width="80" style="border:1px solid #000; font-weight: bold">10</td>
            <td width="80" style="border:1px solid #000; font-weight: bold">11</td>
            <td width="80" style="border:1px solid #000; font-weight: bold">12</td>
            <td width="100" style="border:1px solid #000; font-weight: bold">13</td>
            <td width="60" style="border:1px solid #000; font-weight: bold">14</td>
            <td width="70" style="border:1px solid #000; font-weight: bold">15</td>
            <td width="50" style="border:1px solid #000; font-weight: bold">16</td>
            <td width="90" style="border:1px solid #000; font-weight: bold">17</td>
            </tr>
          <?php
				$Col[16];
				$iG = 1;
				$gITM=0;
				$gHrg = 0;
				function ClrVr()
				{
					for($nG=0; $nG<=15; $nG++)
					{
						$Col[$nG]="";
					}
				}
				$gReC   = $_GET['ReC'];
				$gLmT   = $_GET['LmT'];
				$LoadEND= $_GET['LoadEND'];
				if ($gLmT=="YA")
				{
					$iG  = $gReC+1;
					$nSQL= "SELECT * FROM ta_kib_108 WHERE Kd_Aset_108 LIKE '".$gAss."' AND Kd_UPB LIKE '".$gUpb."' AND (Tgl_Perolehan BETWEEN '".$gTglA."' AND '".$gTglB."') 
					AND Kd_Pemilik LIKE '".$gMLK."' AND Status='' AND extracom LIKE '".$gExt."' 
					GROUP BY Referensi, LEFT(Kd_UPB,11), Ref_History 
					ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register LIMIT ".$gReC.",5000";
					
					$mSQL= "SELECT IfNull(sum(debet),0) as JmlG FROM ta_kib_post_108 
					WHERE Kd_Aset_108 LIKE '".$gAss."' AND Kd_UPB LIKE '".$gUpb."' AND extracom LIKE '".$gExt."' 
					AND Tanggal >= '".$gTglA."' AND Tanggal<='".$gTglB."'";
				}
				else{
					$nSQL= "SELECT * FROM ta_kib_108 WHERE Kd_Aset_108 LIKE '".$gAss."' AND Kd_UPB LIKE '".$gUpb."' AND (Tgl_Perolehan BETWEEN '".$gTglA."' AND '".$gTglB."') 
					AND Kd_Pemilik LIKE '".$gMLK."' AND Status='' AND extracom LIKE '".$gExt."' 
					GROUP BY Referensi, LEFT(Kd_UPB,11), Ref_History 
					ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";
				}
				#echo $nSQL;
				
				$nRs = mysql_query($nSQL) or die(mysql_error());
				$mRo = mysql_fetch_assoc($nRs);
				$tRo = mysql_num_rows($nRs);
				if ($tRo > 0)
				{
					do
					{
						$gITM++;
						ClrVr();
						$Col[1] = $iG;
						$Col[2] = $mRo['Kd_Aset_108'];
						$Col[3] = $mRo['No_Register'];
						$Col[4] = $mRo['Nm_Aset'];
						$Col[5] = $mRo['Merk'];
						$rUPB   = substr($mRo['Kd_UPB'],0,11);
						$RefH = $mRo['Ref_History'];
						$Urai = $mRo['Keterangan'];
						if ($mRo['Type']!="" && $mRo['Type']!="-") {$Col[5].= "/ ".$mRo['Type'];}
						
						$Col[6] = "";
						if ($mRo['Sertifikat_Nomor']!=""){$Col[6].= $mRo['Sertifikat_Nomor'];}
						if ($mRo['Nomor_Pabrik']!="" && $mRo['Nomor_Pabrik']!="-")
						{
							if ($Col[6]!=""){$Col[6].= "/ ";}
							$Col[6].= $mRo['Nomor_Pabrik'];
						}
						if ($mRo['Nomor_Rangka']!="" && $mRo['Nomor_Rangka']!="-")
						{
							if ($Col[6]!=""){$Col[6].= "/ ";}
							$Col[6].= $mRo['Nomor_Rangka'];
						}
						if ($mRo['Nomor_Mesin']!="" && $mRo['Nomor_Mesin']!="-")
						{
							if ($Col[6]!=""){$Col[6].= "/ ";}
							$Col[6].= $mRo['Nomor_Mesin'];
						}
						if ($mRo['Nomor_Polisi']!="" && $mRo['Nomor_Polisi']!="-")
						{
							if ($Col[6]!=""){$Col[6].= "/ ";}
							$Col[6].= $mRo['Nomor_Polisi'];
						}
						if ($mRo['Nomor_BPKB']!="" && $mRo['Nomor_BPKB']!="-")
						{
							if ($Col[6]!=""){$Col[6].= "/ ";}
							$Col[6].= $mRo['Nomor_BPKB'];
						}
						
						#if ($Col[1]=="") {$Col[1]=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");}
						
						$Col[7] = $mRo['Bahan'];
						$Col[8] = $mRo['Asal_Usul'];
						$Col[9] = fConvertDateShort($mRo['Tgl_Perolehan']);
						
						$Col[10] = "";
						if ($mRo['Ukuran_CC']!=""){$Col[10].= $mRo['Ukuran_CC'];}
						if ($mRo['Luas_Lantai']!="" && $mRo['Luas_Lantai']!="-" && $mRo['Luas_Lantai']!="0.00")
						{
							if ($Col[10]!=""){$Col[10].= "/ ";}
							$Col[10].= $mRo['Luas_Lantai'];
						}
						if ($mRo['Luas_Tanah']!="" && $mRo['Luas_Tanah']!="-" && $mRo['Luas_Lantai']!="0.00")
						{
							if ($Col[10]!=""){$Col[10].= "/ ";}
							$Col[10].= $mRo['Luas_Tanah'];
						}
						if ($mRo['Luas']!="" && $mRo['Luas']!="-" && $mRo['Luas_Lantai']!="0.00")
						{
							if ($Col[10]!=""){$Col[10].= "/ ";}
							$Col[10].= $mRo['Luas'];
						}
						if ($mRo['Ukuran']!="" && $mRo['Ukuran']!="-" && $mRo['Ukuran']!="0.00")
						{
							if ($Col[10]!=""){$Col[10].= "/ ";}
							$Col[10].= $mRo['Ukuran'];
						}
						if ($mRo['Spesifikasi']!="" && $mRo['Spesifikasi']!="-")
						{
							if ($Col[10]!=""){$Col[10].= "/ ";}
							$Col[10].= $mRo['Spesifikasi'];
						}
						if ($mRo['Konstruksi']!="" && $mRo['Konstruksi']!="-")
						{
							if ($Col[10]!=""){$Col[10].= "/ ";}
							$Col[10].= $mRo['Konstruksi'];
						}
						$Col[11]= "";
						$Col[12]= $mRo['Kondisi'];
						$Col[13]= "1";
						
						$gREF = $mRo['Referensi'];
						$gREG = $mRo['No_Register'];
						$gReM = $mRo['Ref_Mutasi'];
						$gReH = $mRo['Ref_History'];
						$gNIa = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB:Ref_History:Tanggal",$gREF.":".$rUPB."%:".$gReH.":".$gTglB,"=:LIKE:=:<=","","");
						
						$NilSS = 0;
						if ($RefH!=""){
							if ($UID=='creator'){
								$DissP="";
							}
							else{
								$DissP="";
							}
							$NilSS = 0;//fGlobal("Koreksi_Akumulasi","ta_kib_post_penyusutan_bulanan","Referensi:Kd_UPB:Triwulan:sdhmutasi",$RefH.":".$rUPB."%:IV:Y","=:LIKE:=:=","IDT DESC LIMIT 0,1","$DissP");;
						}
						
						$gAKH = $gNIa-$NilSS;
						$Col[14] = $gNIa;
						$Col[15] = $NilSS;
						$Col[16] = $gAKH;
						
						$Col[17] = fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo['Kd_UPB'],0,11),"=","","");
						$Col[18] = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",substr($mRo['Kd_UPB'],0,14),"=","","");
						$Col[19] = fGlobal("Nm_Upb","ref_upb","Kd_Upb",$mRo['Kd_UPB'],"=","","");
						
						$gTOA = $gTOA + $Col[14];
						$gTOB = $gTOB + $gAKH;
						$gPNY = $gPNY + $NilSS;
						
						ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$RefH,$Urai,$NilSS,$Col[17],$Col[18],$Col[19]);
						$iG++;
					}
					while ($mRo = mysql_fetch_assoc($nRs));	
				}
				else
				{
					ViewBlank();
				}
				#$gITM=$iG-1;
				?>
          <?php function ViewRincian($x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$RefH,$Urai,$NilSS,$x17,$x18,$x19) 
		  {?>
          <tr height="30"> 
            <td style="border: 1px solid #000" align="center"><?=$x1?>.</td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x17?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x18?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x19?></td>
            <td style="border: 1px solid #000; text-align:center"><?=$x2?></td>
            <td style="border: 1px solid #000; text-align:center"><?=$x3?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x4?><?php if ($Urai!=""){echo "<br>(<i>".$Urai."</i>)";}?><?php if ($RefH!=""){echo "<br>(<i>Ref. Mutasi : ".$RefH."</i>)";}?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x5?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x6?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x7?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x8?></td>
            <td style="border: 1px solid #000; text-align:center"><?=$x9?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x10?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x11?></td>
            <td style="border: 1px solid #000; text-align:center"><?=$x12?></td>
            <td style="border: 1px solid #000; text-align:center"><?=$x13?></td>
            <td style="border: 1px solid #000; padding-right:2px; text-align:right"><?=fConvertToRupiah($x14)?></td>
            </tr>
          <?php } ?>
          <?php function ViewBlank() {?>
          <tr> 
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
            </tr>
          <?php } ?>
          <tr height="30"> 
            <td colspan="15" align="center" style="border:1px solid #000; font-weight: bold">
			<?php
			if ($gLmT=="YA"){
				echo "SUB TOTAL";
			}
			else{
				echo "T O T A L";
			}
			?>
			</td>
            <td style="border: 1px solid #000; text-align:center; font-weight:bold"><?=fConvertToRupiahBulat($gITM)?></td>
            <td style="border: 1px solid #000; padding-right:2px; text-align:right; font-weight:bold"><?=fConvertToRupiah($gTOA)?></td>
          </tr>
		  <?php 
		  if ($gLmT=="YA" && $LoadEND=="YA")
		  {
		  	#echo $mSQL;
			$nRe = mysql_query($mSQL);
			$mRe = mysql_fetch_assoc($nRe);
		  ?>
          <tr height="30">
            <td colspan="15" align="center" style="border:1px solid #000; font-weight: bold">T O T A L</td>
            <td style="border: 1px solid #000; text-align:center; font-weight:bold"><?=fConvertToRupiahBulat($iG-1)?></td>
            <td style="border: 1px solid #000; padding-right:2px; text-align:right; font-weight:bold"><?=fConvertToRupiah($mRe['JmlG'])?></td>
            </tr>
		  <?php } ?>
        </table>
		</td>
		</tr>
		<tr>
			<td style="font-family: Calibri Narrow; font-style: italic">&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<?php if ($gUnt!="All") { ?>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table6">
				<?php require "Dokumen_Footer.php";?>
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">Mengetahui,</td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230"><?php echo $NmIbKt.", ".$rHri." ".fNmBulan($rBln)." ".$rThn?></td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
					<td width="230" align="center" style="font-weight: bold"><?php echo $FotA[1]?></td>
					<td align="center">&nbsp;</td>
					<td align="center" style="font-weight: bold" width="230"><?php echo $FotC[1]?></td>
					<td align="center" style="font-weight: bold" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230">&nbsp;</td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230">&nbsp;</td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">&nbsp;</td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230">&nbsp;</td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
					<td width="230" align="center" style="font-weight: bold"><u><?php echo $FotA[2]?></u></td>
					<td align="center">&nbsp;</td>
					<td align="center" style="font-weight: bold" width="230"><u><?php echo $FotC[2]?></u></td>
					<td align="center" style="font-weight: bold" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">NIP. <?php echo $FotA[3]?></td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230">NIP. <?php echo $FotC[3]?></td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
			</table>
			<?php } ?>			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
</div>

</body>

</html>

<?php require('Connection_Close.php');?>
