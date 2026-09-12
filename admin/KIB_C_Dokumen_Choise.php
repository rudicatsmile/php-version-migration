<?php require "CheckSession.php"?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php"?>
<?php
ini_set('max_execution_time', 300);
extract($_GET);
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
	<table border="0" width="2150" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
		<tr>
			
      <td style="font-size: 13pt; font-weight: bold" align="center">KARTU INVENTARIS 
        BARANG (KIB C)</td>
		</tr>
		<tr>
			
      <td style="font-size: 13pt; font-weight: bold" align="center"> GEDUNG DAN 
        BANGUNAN <?php if($gExt=='Y') {echo "(EXTRAKOMPTABEL)";}?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
			  <tr> 
				<td width="79">UNIT KERJA</td>
				<td width="24">:</td>
				<td width="515"><?php echo $gNmUNT ?></td>
				<td width="96">BIDANG ASET </td>
				<td width="17">:</td>
				<td width="1300"><?php echo $nAs1?></td>
			  </tr>
			  <tr> 
				<td width="79">SUB UNIT</td>
				<td width="24">:</td>
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
		  <table border="0" width="2250" style="border:0 solid #000; font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table2" bordercolor="#000">
          <tr> 
            <td rowspan="2" style="border:1px solid #000; font-weight: bold" align="center" width="2%">NO</td>
            <td rowspan="2" align="center" style="border:1px solid #000; font-weight: bold">U N I T</td>
            <td rowspan="2" align="center" style="border:1px solid #000; font-weight: bold">SUB UNIT</td>
            <td rowspan="2" align="center" style="border:1px solid #000; font-weight: bold">U P B</td>
            <td rowspan="2" align="center" style="border:1px solid #000; font-weight: bold">NAMA BARANG</td>
            <td colspan="2" align="center" style="border:1px solid #000; font-weight: bold"> NOMOR</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold" align="center">KONDISI BANGUNAN (B,KB,RB)</td>
            <td colspan="2" align="center" style="border:1px solid #000; font-weight: bold">KONSTRUKSI BANGUNAN </td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold" align="center">LUAS LANTAI (M<sup>2</sup>)</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold" align="center">LETAK / LOKASI</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold" align="center">KOORDINAT</td>
            <td style="border:1px solid #000; font-weight: bold" align="center" colspan="2">DOKUMEN GEDUNG </td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold" align="center">LUAS (M<sup>2</sup>) </td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold" align="center">STATUS TANAH </td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold" align="center">NOMOR KODE TANAH</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold" align="center">ASAL-USUL</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold" align="center">HARGA (Rp)</td>
            <td rowspan="2" align="center" style="border:1px solid #000; font-weight: bold">KETERANGAN</td>
          </tr>
          <tr> 
            <td align="center" style="border:1px solid #000; font-weight: bold">KODE BARANG </td>
            <td align="center" style="border:1px solid #000; font-weight: bold">REGISTER</td>
            <td align="center" style="border:1px solid #000; font-weight: bold">BERTINGKAT/ TIDAK</td>
            <td align="center" style="border:1px solid #000; font-weight: bold">BETON/ TIDAK </td>
            <td align="center" style="border:1px solid #000; font-weight: bold">TANGGAL</td>
            <td align="center" style="border:1px solid #000; font-weight: bold">NOMOR</td>
          </tr>
          <tr> 
            <td width="30" align="center" style="border:1px solid #000; font-weight: bold">1</td>
            <td width="200" align="center" style="border:1px solid #000; font-weight: bold">2 </td>
            <td width="200" align="center" style="border:1px solid #000; font-weight: bold">3</td>
            <td width="200" align="center" style="border:1px solid #000; font-weight: bold">4</td>
            <td width="200" align="center" style="border:1px solid #000; font-weight: bold">5</td>
            <td width="90" align="center" style="border:1px solid #000; font-weight: bold">6</td>
            <td width="50" align="center" style="border:1px solid #000; font-weight: bold">7</td>
            <td width="50" align="center" style="border:1px solid #000; font-weight: bold">8</td>
            <td width="60" align="center" style="border:1px solid #000; font-weight: bold">9</td>
            <td width="60" align="center" style="border:1px solid #000; font-weight: bold">10</td>
            <td width="60" align="center" style="border:1px solid #000; font-weight: bold">11</td>
            <td width="150" align="center" style="border:1px solid #000; font-weight: bold">12</td>
            <td width="100" align="center" style="border:1px solid #000; font-weight: bold">13</td>
            <td width="60" align="center" style="border:1px solid #000; font-weight: bold">14</td>
            <td width="100" align="center" style="border:1px solid #000; font-weight: bold">15</td>
            <td width="60" align="center" style="border:1px solid #000; font-weight: bold">16</td>
            <td width="60" align="center" style="border:1px solid #000; font-weight: bold">17</td>
            <td width="60" align="center" style="border:1px solid #000; font-weight: bold">18</td>
            <td width="80" align="center" style="border:1px solid #000; font-weight: bold">19</td>
            <td width="90" align="center" style="border:1px solid #000; font-weight: bold">20</td>
            <td align="center" style="border:1px solid #000; font-weight: bold">21</td>
          </tr>
          <?php
				$Col[16];
				
				#$iG = 1;
				if ($page==0){$iG = 1;} else {$iG = $page+1;}
				
				$gHrg = 0;
				function ClrVr()
				{
					for($nG=0; $nG<=15; $nG++)
					{
						$Col[$nG]="";
					}
				}
				
				//$gExt="N";
				$nSQL= "SELECT * FROM ta_kib_108 WHERE extracom LIKE '".$gExt."' AND Kd_Aset_108 LIKE '".$gAss."' AND Kd_UPB LIKE '".$gUpb."' AND (Tgl_Perolehan BETWEEN '".$gTglA."' AND '".$gTglB."') 
				AND Kd_Pemilik LIKE '".$gMLK."' AND Status='' 
				ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register 
				LIMIT $page, 5000";
				#echo $nSQL;
				$nRs = mysql_query($nSQL) or die(mysql_error());
				$mRo = mysql_fetch_assoc($nRs);
				$tRo = mysql_num_rows($nRs);
				if ($tRo > 0)
				{
					do
					{
						ClrVr();
						$Col[0] = $iG;
						$Col[1] = $mRo['Nm_Aset'];
						$Col[2] = $mRo['Kd_Aset_108'];
						if ($Col[1]=="") {$Col[1]=fGlobal("Nm_Aset","Ref_Rek_Aset108_7","Kd_Aset",$mRo['Kd_Aset_108'],"=","","");}
						$Col[3] = $mRo['No_Register'];
						$Col[4] = $mRo['Kondisi'];
						$Col[5] = $mRo['Bertingkat'];
						$Col[6] = $mRo['Beton'];
						$Col[7] = $mRo['Luas_Lantai'];
						$Col[8] = $mRo['Lokasi'];
						$Col[9] = $mRo['Dokumen_Tanggal'];
						$Col[10] = $mRo['Dokumen_Nomor'];
						$Col[14] = $mRo['Asal_Usul'];
						$Col[20] = $mRo['lat_lng'];
						
						$gREF = $mRo['Referensi'];
						$rUPB = substr($mRo['Kd_UPB'],0,11);
						
						$gAKH = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB:Tanggal",$gREF.":".$rUPB."%:".$gTglB,"=:LIKE:<=","","");
						
						$Col[15] = $gAKH;
						$Col[16] = $mRo['Keterangan'];
						$Col[17] = fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo['Kd_UPB'],0,11),"=","","");
						$Col[18] = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",substr($mRo['Kd_UPB'],0,14),"=","","");
						$Col[19] = fGlobal("Nm_Upb","ref_upb","Kd_Upb",$mRo['Kd_UPB'],"=","","");
						
						$gHrg = $gHrg + $gAKH;
						ViewRincian($Col[0],$Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],$Col[19],$Col[20]);
						$iG++;
					}
					while ($mRo = mysql_fetch_assoc($nRs));	
				}
				else
				{
				echo ViewBlank();
				}
				?>
          <?php function ViewRincian($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18,$x19,$x20) {?>
          <tr height="30"> 
            <td style="border: 1px solid #000" align="center"><?=$x0?>.</td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x17?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x18?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x19?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x1?></td>
            <td style="border: 1px solid #000" align="center"><?=$x2?></td>
            <td style="border: 1px solid #000" align="center"><?=$x3?></td>
            <td style="border: 1px solid #000" align="center"><?=$x4?></td>
            <td style="border: 1px solid #000" align="center"><?=$x5?></td>
            <td style="border: 1px solid #000" align="center" ><?=$x6?></td>
            <td style="border: 1px solid #000" align="center"><?=$x7?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x8?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x20?></td>
            <td style="border: 1px solid #000" align="center"><?php if ($x9!='0000-00-00') {echo fConvertDateShort($x9);}?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x10?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x11?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x12?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x13?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x14?></td>
            <td style="border: 1px solid #000; padding-right:2px" align="right"><?=fConvertToRupiah($x15)?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x16?></td>
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
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
            <td style="border: 1px solid #000">&nbsp;</td>
          </tr>
          <?php } ?>
          <tr height="30"> 
            <td colspan="19" style="border:1px solid #000; font-weight: bold" align="center"> 
              JUMLAH</td>
            <td style="border:1px solid #000; font-weight: bold; padding-right:2px" align="right"><?php echo fConvertToRupiah($gHrg)?></td>
            <td style="border: 1px solid #000">&nbsp;</td>
          </tr>
        </table>			</td>
		</tr>
		<tr>
		  <td style="font-family: Calibri Narrow; font-style: italic">&nbsp;</td>
	  </tr>
		<tr>
			<td style="font-family: Calibri Narrow; font-style: italic">
			<?php if ($gUnt!="All") { ?>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table6">
				<?php require "Dokumen_Footer.php";?>
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">Mengetahui,</td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230"><?php echo $NmIbKt.", ".str_repeat("&nbsp;",15)."/".str_repeat("&nbsp;",15)."/ ".$gThB?></td>
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
			<?php } ?>
			</td>
		</tr>
	</table>
</div>

</body>

</html>
<?php
$colors = array('red', 'blue', 'green', 'yellow');

foreach ($colors as $color) {
	//echo "Do you like $color?\n";
}

?> 

<?php require('Connection_Close.php');?>
