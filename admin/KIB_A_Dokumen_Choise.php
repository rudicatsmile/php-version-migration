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

require "KIB_Dokumen_Unit_Choise.php";

$gTglA= $gThA."-01-01";
$gTglB= $gThB."-12-31";
?>
<body>
<div align="center">
	<table border="0" width="1850" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
		<tr>
			
      <td style="font-size: 13pt; font-weight: bold" align="center">KARTU INVENTARIS 
        BARANG (KIB A)</td>
		</tr>
		<tr>
			
      <td style="font-size: 13pt; font-weight: bold" align="center"> TANAH</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
			  <tr> 
				<td width="95">UNIT KERJA</td>
				<td width="21">:</td>
				<td width="447"><?php echo $gNmUNT ?></td>
				<td width="98">BIDANG ASET </td>
				<td width="18">:</td>
				<td width="1152"><?php echo $nAs1?></td>
			  </tr>
			  <tr> 
				<td width="95">SUB UNIT</td>
				<td width="21">:</td>
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
			<table border="0" width="1850" cellpadding="0" cellspacing="0" style="border:0 solid #000; font-size: 8pt; font-family: calibri; border-collapse: collapse" id="table2" bordercolor="#000">
          <tr> 
            <td rowspan="3" style="border:1px solid #000; font-weight: bold" align="center">NO</td>
            <td rowspan="3" align="center" style="border:1px solid #000; font-weight: bold">U N I T</td>
            <td rowspan="3" align="center" style="border:1px solid #000; font-weight: bold">SUB UNIT</td>
            <td rowspan="3" align="center" style="border:1px solid #000; font-weight: bold">U P B</td>
            <td rowspan="3" align="center" style="border:1px solid #000; font-weight: bold">NAMA BARANG</td>
            <td colspan="2" align="center" style="border:1px solid #000; font-weight: bold">NOMOR</td>
            <td rowspan="3" style="border:1px solid #000; font-weight: bold" align="center">LUAS<br>(M<sup>2</sup>) </td>
            <td rowspan="3" style="border:1px solid #000; font-weight: bold" align="center">TAHUN</td>
            <td rowspan="3" align="center" style="border:1px solid #000; font-weight: bold">LETAK / ALAMAT</td>
            <td rowspan="3" align="center" style="border:1px solid #000; font-weight: bold">KOORDINAT</td>
            <td style="border:1px solid #000; font-weight: bold" align="center" colspan="3">STATUS TANAH </td>
            <td rowspan="3" style="border:1px solid #000; font-weight: bold" align="center">PENGGUNAAN</td>
            <td rowspan="3" style="border:1px solid #000; font-weight: bold" align="center">ASAL-USUL</td>
            <td rowspan="3" style="border:1px solid #000; font-weight: bold" align="center">HARGA (Rp)</td>
            <td rowspan="3" style="border:1px solid #000; font-weight: bold" align="center">KETERANGAN</td>
          </tr>
          <tr> 
            <td rowspan="2" align="center" style="border:1px solid #000; font-weight: bold">KODE BARANG </td>
            <td rowspan="2" align="center" style="border:1px solid #000; font-weight: bold">REGISTER</td>
            <td rowspan="2" align="center" style="border:1px solid #000; font-weight: bold">HAK</td>
            <td colspan="2" align="center" style="border:1px solid #000; font-weight: bold">SERTIFIKAT</td>
          </tr>
          <tr> 
            <td style="border:1px solid #000; font-weight: bold" align="center">TANGGAL</td>
            <td align="center" style="border:1px solid #000; font-weight: bold">NOMOR</td>
          </tr>
          <tr> 
            <td width="30" style="border:1px solid #000; font-weight: bold" align="center">1</td>
            <td width="150" align="center" style="border:1px solid #000; font-weight: bold">2</td>
            <td width="150" align="center" style="border:1px solid #000; font-weight: bold">3</td>
            <td width="150" align="center" style="border:1px solid #000; font-weight: bold">4</td>
            <td width="200" align="center" style="border:1px solid #000; font-weight: bold">5</td>
            <td width="90" style="border:1px solid #000; font-weight: bold" align="center">6</td>
            <td width="50" style="border:1px solid #000; font-weight: bold" align="center">7</td>
            <td width="50" style="border:1px solid #000; font-weight: bold" align="center">8</td>
            <td width="40" style="border:1px solid #000; font-weight: bold" align="center">9</td>
            <td width="100" style="border:1px solid #000; font-weight: bold" align="center">10</td>
            <td width="100" style="border:1px solid #000; font-weight: bold" align="center">11</td>
            <td width="60" style="border:1px solid #000; font-weight: bold" align="center">12</td>
            <td width="60" align="center" style="border:1px solid #000; font-weight: bold">13</td>
            <td width="100" align="center" style="border:1px solid #000; font-weight: bold">14</td>
            <td width="140" style="border:1px solid #000; font-weight: bold" align="center">15</td>
            <td width="100" align="center" style="border:1px solid #000; font-weight: bold">16</td>
            <td width="90" style="border:1px solid #000; font-weight: bold" align="center">17</td>
            <td style="border:1px solid #000; font-weight: bold" align="center">17</td>
          </tr>
          <?php
				$Col[15];
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
				$nSQL= "SELECT * FROM ta_kib_108 WHERE Kd_Aset_108 LIKE '".$gAss."' AND Kd_UPB LIKE '".$gUpb."' AND (Tgl_Perolehan BETWEEN '".$gTglA."' AND '".$gTglB."') AND Kd_Pemilik LIKE '".$gMLK."' AND Status='' 
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
						$Col[1] = $mRo['Kd_Aset_108'];
						$Col[2] = $mRo['Nm_Aset'];
						if ($Col[2]=="") {$Col[2]=fGlobal("Nm_Aset","Ref_Rek_Aset108_7","Kd_Aset",$mRo['Kd_Aset_108'],"=","","");}
						$Col[3] = $mRo['No_Register'];
						if ($nType!="") {$nType="Type : ".$nType;} else {$nType="";}
						if ($Col[4]!="") {$Col[4]=$Col[4]."<br> ".$nType;}
						$Col[5] = str_replace('.00','',str_replace(' m2','',$mRo['Luas_M2']));
						//$Col[6] = substr($mRo['Tgl_Perolehan'],0,-6);
						$Col[6] = fConvertDateShort($mRo['Tgl_Perolehan']);
						$Col[7] = $mRo['Alamat'];
						$Col[8] = $mRo['Hak_Tanah'];
						$Col[9] = $mRo['Sertifikat_Tanggal'];
						$Col[10] = $mRo['Sertifikat_Nomor'];
						$Col[11] = $mRo['Penggunaan'];
						$Col[12] = $mRo['Asal_Usul'];
						
						$gREF = $mRo['Referensi'];
						$rUPB = substr($mRo['Kd_UPB'],0,11);
						$gAKH = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB:Tanggal",$gREF.":".$rUPB."%:".$gTglB,"=:LIKE:<=","","");
						
						$Col[13] = $gAKH;
						$Col[14] = $mRo['Keterangan'];
						$Col[16] = fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo['Kd_UPB'],0,11),"=","","");
						$Col[17] = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",substr($mRo['Kd_UPB'],0,14),"=","","");
						$Col[18] = fGlobal("Nm_Upb","ref_upb","Kd_Upb",$mRo['Kd_UPB'],"=","","");
						$Col[19] = $mRo['lat_lng'];
						
						if ($xUnt=="All")
						{
							#if ($Col[14]!="") {$Col[14]=$Col[14]."<br>SKPD: <i>".fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo['Kd_UPB'],0,11),"=","","")."</i>";}
							#else {$Col[14]="SKPD: <i>".fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo['Kd_UPB'],0,11),"=","","")."</i>";}
						}
						if ($xSub=="All")
						{
							#if ($Col[14]!="") {$Col[14]=$Col[14]."<br>Sub Unit: <i>".fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",substr($mRo['Kd_UPB'],0,14),"=","","")."</i>";}
							#else {$Col[14]="Sub Unit: <i>".fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",substr($mRo['Kd_UPB'],0,14),"=","","")."</i>";}
						}
						if ($xUpb=="All")
						{
							#if ($Col[14]!="") {$Col[14]=$Col[14]."<br>UPB: <i>".fGlobal("Nm_Upb","ref_upb","Kd_Upb",$mRo['Kd_UPB'],"=","","")."</i>";}
							#else {$Col[14]="UPB: <i>".fGlobal("Nm_Upb","ref_upb","Kd_Upb",$mRo['Kd_UPB'],"=","","")."</i>";}
						}
						
						$gHrg = $gHrg + $gAKH;
						
						ViewRincian($Col[0],$Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],$Col[19]);
						$iG++;
					}
					while ($mRo = mysql_fetch_assoc($nRs));	
				}
				else
				{
					ViewBlank();
				}
				?>
          <?php function ViewRincian($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18,$x19) {?>
          <tr height="30"> 
            <td style="border: 1px solid #000" align="center"><?php echo $x0?>.</td>
            <td style="border: 1px solid #000; padding-left:3px"><?=$x16?></td>
            <td style="border: 1px solid #000; padding-left:3px"><?=$x17?></td>
            <td style="border: 1px solid #000; padding-left:3px"><?=$x18?></td>
            <td style="border: 1px solid #000; padding-left:3px"><?=$x2?></td>
            <td style="border: 1px solid #000" align="center"><?=$x1?></td>
            <td style="border: 1px solid #000" align="center"><?=$x3?></td>
            <td style="border: 1px solid #000" align="center"><?=$x5?></td>
            <td style="border: 1px solid #000" align="center"><?=substr($x6,-4,4)?></td>
            <td style="border: 1px solid #000; padding-left:3px"><?=$x7?></td>
            <td style="border: 1px solid #000; padding-left:3px"><?=$x19?></td>
            <td style="border: 1px solid #000; padding-left:3px"><?=$x8?></td>
            <td style="border: 1px solid #000" align="center"><?=$x9?></td>
            <td style="border: 1px solid #000"><?=$x10?></td>
            <td style="border: 1px solid #000; padding-left:3px"><?=$x11?></td>
            <td style="border: 1px solid #000; padding-left:3px"><?=$x12?></td>
            <td style="border: 1px solid #000; padding-right:3px" align="right"><?=fConvertToRupiah($x13)?></td>
            <td style="border: 1px solid #000; padding-left:3px"><?=$x14?></td>
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
          </tr>
          <?php } ?>
          <tr height="30"> 
            <td colspan="16" style="border:1px solid #000; font-weight: bold" align="center"> 
              JUMLAH</td>
            <td style="border:1px solid #000; font-weight: bold; padding-right:2px" align="right"><?php echo fConvertToRupiah($gHrg)?></td>
            <td style="border: 1px solid #000">&nbsp;</td>
          </tr>
        </table>		</td>
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

