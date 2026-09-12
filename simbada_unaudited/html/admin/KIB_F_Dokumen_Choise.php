<?php require "CheckSession.php"?>
<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php require "CheckLogin.php"?>
<?
ini_set('max_execution_time', 300);
extract($_GET);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Simbada</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?
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
	<table border="0" width="1900" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
		<tr>
			
      <td style="font-size: 13pt; font-weight: bold" align="center">KARTU INVENTARIS 
        BARANG (KIB F)</td>
		</tr>
		<tr>
			
      <td style="font-size: 13pt; font-weight: bold" align="center">KONSTRUKSI DALAM PENGERJAAN </td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
			  <tr> 
				<td width="80">UNIT KERJA</td>
				<td width="18">:</td>
				<td width="424"><? echo $gNmUNT ?></td>
				<td width="94">BIDANG ASET </td>
				<td width="18">:</td>
				<td width="1247"><? echo $nAs1?></td>
			  </tr>
			  <tr> 
				<td width="80">SUB UNIT</td>
				<td width="18">:</td>
				<td><? echo $gNmSUB ?></td>
				<td>KELOMPOK ASET </td>
				<td>:</td>
				<td><? echo $nAs2?></td>
			  </tr>
			  <tr>
				<td>UPB</td>
				<td>:</td>
				<td><? echo $gNmUPB?></td>
				<td>JENIS ASET </td>
				<td>:</td>
				<td><? echo $nAs3?></td>
			  </tr>
			  <tr>
				<td>KEPEMILIKAN</td>
				<td>:</td>
				<td><? echo $nMLK?></td>
				<td>OBJEK ASET </td>
				<td>:</td>
				<td><? echo $nAs4?></td>
			  </tr>
			  <tr>
				<td>TAHUN</td>
				<td>:</td>
				<td><? echo $gThA?> s.d <? echo $gThB?></td>
				<td>RINCIAN ASET </td>
				<td>:</td>
				<td><? echo $nAs5?></td>
			  </tr>
			</table>			</td>
		</tr>
		<tr>
			<td height="5"></td>
		</tr>
		<tr>
		  <td>
		  <table border="0" width="1900" cellpadding="0" cellspacing="0" style="border:0 solid #000; font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table2" bordercolor="#000">
          <tr style="text-align:center"> 
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">NO</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">U N I T</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">SUB UNIT</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">U P B</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">NAMA BARANG</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">BANGUNAN (P,SPD)</td>
            <td colspan="2" style="border:1px solid #000; font-weight: bold">KONSTRUKSI BANGUNAN </td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">LUAS (M<sup>2</sup>)</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">LETAK / LOKASI ALAMAT </td>
            <td colspan="2" style="border:1px solid #000; font-weight: bold">DOKUMEN </td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">Tanggal, Bulan, Tahun Mulai </td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">STATUS TANAH </td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">NOMOR KODE TANAH</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">ASAL-USUL PEMBIAYAAN </td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">NILAI KONTRAK (Rp)</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold">KETERANGAN</td>
          </tr>
          <tr style="text-align:center"> 
            <td style="border:1px solid #000; font-weight: bold">BERTINGKAT/ TIDAK</td>
            <td style="border:1px solid #000; font-weight: bold">BETON/ TIDAK </td>
            <td style="border:1px solid #000; font-weight: bold">TANGGAL</td>
            <td style="border:1px solid #000; font-weight: bold">NOMOR</td>
          </tr>
          <tr style="text-align:center"> 
            <td width="30" style="border:1px solid #000; font-weight: bold">1</td>
            <td width="200" style="border:1px solid #000; font-weight: bold">2</td>
            <td width="200" style="border:1px solid #000; font-weight: bold">3</td>
            <td width="200" style="border:1px solid #000; font-weight: bold">4</td>
            <td width="200" style="border:1px solid #000; font-weight: bold">5</td>
            <td width="60" style="border:1px solid #000; font-weight: bold">6</td>
            <td width="70" style="border:1px solid #000; font-weight: bold">7</td>
            <td width="60" style="border:1px solid #000; font-weight: bold">8</td>
            <td width="60" style="border:1px solid #000; font-weight: bold">9</td>
            <td width="150" style="border:1px solid #000; font-weight: bold">10</td>
            <td width="60" style="border:1px solid #000; font-weight: bold">11</td>
            <td width="100" style="border:1px solid #000; font-weight: bold">12</td>
            <td width="60" style="border:1px solid #000; font-weight: bold">13</td>
            <td width="60" style="border:1px solid #000; font-weight: bold">14</td>
            <td width="70" style="border:1px solid #000; font-weight: bold">15</td>
            <td width="70" style="border:1px solid #000; font-weight: bold">16</td>
            <td width="90" style="border:1px solid #000; font-weight: bold">17</td>
            <td style="border:1px solid #000; font-weight: bold">18</td>
          </tr>
          <?
				$Col[16];
				$iG = 1;
				$gHrg = 0;
				function ClrVr()
				{
					for($nG=0; $nG<=15; $nG++)
					{
						$Col[$nG]="";
					}
				}
				
				$nSQL= "SELECT * FROM ta_kib_108 WHERE Kd_Aset_108 LIKE '".$gAss."' AND Kd_UPB LIKE '".$gUpb."' AND (Tgl_Perolehan BETWEEN '".$gTglA."' AND '".$gTglB."') AND Kd_Pemilik LIKE '".$gMLK."' AND Status='' 
				AND KdpToAset='N' ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";
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
						if ($Col[1]=="") {$Col[1]=fGlobal("Nm_Aset","Ref_Rek_Aset108_7","Kd_Aset",$mRo['Kd_Aset_108'],"=","","");}
						$Col[2] = $mRo['Tipe_Bangunan'];
						$Col[3] = $mRo['Bertingkat'];
						$Col[4] = $mRo['Beton'];
						$Col[5] = $mRo['Luas'];
						$Col[6] = $mRo['Lokasi'];
						$Col[7] = $mRo['Dokumen_Tanggal'];
						$Col[8] = $mRo['Dokumen_Nomor'];
						$Col[9] = $mRo['Tgl_Perolehan'];
						$Col[10] = $mRo['Status_Tanah'];
						$Col[11] = $mRo['Kode_Tanah'];
						$Col[12] = $mRo['Asal_Usul'];
						
						$gREF = $mRo['Referensi'];
						$rUPB = substr($mRo['Kd_UPB'],0,11);
						
						$gAKH = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB:Tanggal:KdpToAset",$gREF.":".$rUPB."%:".$gTglB.":N","=:LIKE:<=:=","","");
						
						$Col[13] = $gAKH;
						
						$Col[14] = $mRo['Keterangan'];
						$Col[15] = fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo['Kd_UPB'],0,11),"=","","");
						$Col[16] = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",substr($mRo['Kd_UPB'],0,14),"=","","");
						$Col[17] = fGlobal("Nm_Upb","ref_upb","Kd_Upb",$mRo['Kd_UPB'],"=","","");
						
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
						ViewRincian($Col[0],$Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17]);
						$iG++;
					}
					while ($mRo = mysql_fetch_assoc($nRs));	
				}
				else
				{
					ViewBlank();
				}
				?>
          <? function ViewRincian($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17) {?>
          <tr height="30"> 
            <td style="border: 1px solid #000" align="center"><?=$x0?>.</td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x15?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x16?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x17?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x1?></td>
            <td style="border: 1px solid #000" align="center"><?=$x2?></td>
            <td style="border: 1px solid #000" align="center"><?=$x3?></td>
            <td style="border: 1px solid #000" align="center"><?=$x4?></td>
            <td style="border: 1px solid #000" align="center"><?=$x5?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x6?></td>
            <td style="border: 1px solid #000"><? if ($x7!="" && $x7!="0000-00-00" && $x7!="00-00-0000") {echo fConvertDateShort($x7);}?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x8?></td>
            <td style="border: 1px solid #000"><? if ($x9!="" && $x9!="0000-00-00" && $x9!="00-00-0000") {echo fConvertDateShort($x9);}?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x10?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x11?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x12?></td>
            <td style="border: 1px solid #000; padding-right:2px" align="right"><?=fConvertToRupiah($x13)?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x14?></td>
          </tr>
          <? } ?>
          <? function ViewBlank() {?>
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
          <? } ?>
          <tr height="30"> 
            <td style="border:1px solid #000; font-weight: bold" align="center">&nbsp;</td>
            <td colspan="4" align="center" style="border:1px solid #000; font-weight: bold">&nbsp;</td>
            <td style="border:1px solid #000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000; font-weight: bold" align="center">&nbsp;</td>
            <td style="border:1px solid #000; font-weight: bold; padding-right:2px" align="right"><? echo fConvertToRupiah($gHrg)?></td>
            <td style="border: 1px solid #000">&nbsp;</td>
          </tr>
        </table>		  </td>
		</tr>
		<tr>
		  <td style="font-family: Calibri Narrow; font-style: italic">&nbsp;</td>
	  </tr>
		<tr>
			<td style="font-family: Calibri Narrow; font-style: italic">
			<? if ($gUnt!="All") { ?>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; border-collapse: collapse" id="table6">
				<? require "Dokumen_Footer.php";?>
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">Mengetahui,</td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230"><? echo $NmIbKt.", ".str_repeat("&nbsp;",15)."/".str_repeat("&nbsp;",15)."/ ".$gThB?></td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center" style="font-weight: bold">&nbsp;</td>
					<td width="230" align="center" style="font-weight: bold"><? echo $FotA[1]?></td>
					<td align="center">&nbsp;</td>
					<td align="center" style="font-weight: bold" width="230"><? echo $FotC[1]?></td>
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
					<td width="230" align="center" style="font-weight: bold"><u><? echo $FotA[2]?></u></td>
					<td align="center">&nbsp;</td>
					<td align="center" style="font-weight: bold" width="230"><u><? echo $FotC[2]?></u></td>
					<td align="center" style="font-weight: bold" width="50">&nbsp;</td>
				</tr>
				<tr>
					<td width="50" align="center">&nbsp;</td>
					<td width="230" align="center">NIP. <? echo $FotA[3]?></td>
					<td align="center">&nbsp;</td>
					<td align="center" width="230">NIP. <? echo $FotC[3]?></td>
					<td align="center" width="50">&nbsp;</td>
				</tr>
			</table>
			<? } ?>
			</td>
		</tr>
	</table>
</div>

</body>

</html>