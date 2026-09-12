<?php
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";

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

if ($gRin!='All')
{
	$gRek = $gRin;
}
else
{
	if ($gOBJ!='All')
	{
		$gRek = $gOBJ;
	}
	else
	{
		if ($gJns!='All')
		{
			$gRek = $gJns;
		}
		else
		{
			if ($gKel!='All')
			{
				$gRek = $gKel;
			}
			else
			{
				$gRek = $gBid;
			}
		}
	}
}

$gTglA= $gThA."-01-01";
$gTglB= $gThB."-12-31";
?>
<body>
<div align="center">
	<table border="0" width="2000" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
		<tr>
			
      <td style="font-size: 13pt; font-weight: bold" align="center">KARTU INVENTARIS 
        BARANG (KIB E)</td>
		</tr>
		<tr>
			
      <td style="font-size: 13pt; font-weight: bold" align="center"> ASET TETAP 
        LAINNYA <?php if($gExt=='Y') {echo "(EXTRAKOMPTABEL)";}?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
			  <tr> 
				<td width="78">UNIT KERJA</td>
				<td width="20">:</td>
				<td width="475"><?php echo $gNmUNT ?></td>
				<td width="98">BIDANG ASET </td>
				<td width="20">:</td>
				<td width="1290"><?php echo $nAs1?></td>
			  </tr>
			  <tr> 
				<td width="78">SUB UNIT</td>
				<td width="20">:</td>
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
          <tr> 
            <td rowspan="2" style="border:1px solid #000; font-weight: bold" align="center">NO</td>
            <td rowspan="2" align="center" style="border:1px solid #000; font-weight: bold">U N I T</td>
            <td rowspan="2" align="center" style="border:1px solid #000; font-weight: bold">SUB UNIT</td>
            <td rowspan="2" align="center" style="border:1px solid #000; font-weight: bold">U P B</td>
            <td rowspan="2" align="center" style="border:1px solid #000; font-weight: bold">NAMA BARANG</td>
            <td colspan="2" align="center" style="border:1px solid #000; font-weight: bold">NOMOR</td>
            <td colspan="2" align="center" style="border:1px solid #000; font-weight: bold">BUKU / PERPUSTAKAAN</td>
            <td colspan="3" align="center" style="border:1px solid #000; font-weight: bold">BARANG BERCORAK KESENIAN / KEBUDAYAAN</td>
            <td colspan="2" align="center" style="border:1px solid #000; font-weight: bold">HEWAN / TERNAK DAN TUMBUHAN</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold" align="center">JUMLAH</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold" align="center">TAHUN CETAK / PEMBELIAN</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold" align="center">ASAL - USUL</td>
            <td rowspan="2" style="border:1px solid #000; font-weight: bold" align="center">HARGA (Rp)</td>
            <td rowspan="2" align="center" style="border:1px solid #000; font-weight: bold">KETERANGAN</td>
          </tr>
          <tr> 
            <td align="center" style="border:1px solid #000; font-weight: bold">KODE BARANG </td>
            <td align="center" style="border:1px solid #000; font-weight: bold">REGISTER</td>
            <td style="border:1px solid #000; font-weight: bold" align="center">JUDUL/ PENCIPTA</td>
            <td align="center" style="border:1px solid #000; font-weight: bold">SPESIFIKASI</td>
            <td align="center" style="border:1px solid #000; font-weight: bold">ASAL DAERAH </td>
            <td align="center" style="border:1px solid #000; font-weight: bold">PENCIPTA</td>
            <td style="border:1px solid #000; font-weight: bold" align="center">BAHAN</td>
            <td style="border:1px solid #000; font-weight: bold" align="center">JENIS</td>
            <td style="border:1px solid #000; font-weight: bold" align="center">UKURAN</td>
          </tr>
          <tr> 
            <td width="30" style="border:1px solid #000; font-weight: bold" align="center">1</td>
            <td width="200" style="border:1px solid #000; font-weight: bold" align="center">2</td>
            <td width="200" style="border:1px solid #000; font-weight: bold" align="center">3</td>
            <td width="200" style="border:1px solid #000; font-weight: bold" align="center">4</td>
            <td width="200" style="border:1px solid #000; font-weight: bold" align="center">5</td>
            <td width="90" style="border:1px solid #000; font-weight: bold" align="center">6</td>
            <td width="50" style="border:1px solid #000; font-weight: bold" align="center">7</td>
            <td width="80" style="border:1px solid #000; font-weight: bold" align="center">8</td>
            <td width="80" style="border:1px solid #000; font-weight: bold" align="center">9</td>
            <td width="80" style="border:1px solid #000; font-weight: bold" align="center">10</td>
            <td width="80" style="border:1px solid #000; font-weight: bold" align="center">11</td>
            <td width="80" style="border:1px solid #000; font-weight: bold" align="center">12</td>
            <td width="80" style="border:1px solid #000; font-weight: bold" align="center">13</td>
            <td width="80" style="border:1px solid #000; font-weight: bold" align="center">14</td>
            <td width="50" style="border:1px solid #000; font-weight: bold" align="center">15</td>
            <td width="60" style="border:1px solid #000; font-weight: bold" align="center">16</td>
            <td width="100" style="border:1px solid #000; font-weight: bold" align="center">18</td>
            <td width="90" style="border:1px solid #000; font-weight: bold" align="center">19</td>
            <td style="border:1px solid #000; font-weight: bold" align="center">20</td>
          </tr>
          <?php
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
		
		if ($gExt=="All" || $gExt==""){$gExt="%";}
		//$gExt="N";
		$gReC   = $_GET['ReC'];
		$gLmT   = $_GET['LmT'];
		$LoadEND= $_GET['LoadEND'];
		if ($gLmT=="YA")
		{
			$iG  = $gReC+1;
			$nSQL= "SELECT * FROM ta_kib_108 WHERE kd_aset_108 LIKE '".$gRek."%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND (Tgl_Perolehan BETWEEN '".$gTglA."' AND '".$gTglB."') AND Kd_Pemilik LIKE '".$gMLK."' 
			GROUP BY Referensi, Ref_Group, Kd_UPB 
			ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register LIMIT ".$gReC.",5000";
			#echo $nSQL;
			
			$mSQL= "SELECT IfNull(sum(debet),0) as JmlG FROM ta_kib_post_108 
			WHERE Kd_Aset_108 LIKE '".$gAss."' AND Kd_UPB LIKE '".$gUpb."' 
			AND Tanggal >= '".$gTglA."' AND Tanggal<='".$gTglB."'";
		}
		else
		{
			$nSQL= "SELECT * FROM ta_kib_108 WHERE kd_aset_108 LIKE '".$gRek."%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND (Tgl_Perolehan BETWEEN '".$gTglA."' AND '".$gTglB."') AND Kd_Pemilik LIKE '".$gMLK."' 
			GROUP BY Referensi, Ref_Group, Kd_UPB 
			ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register ";
			#echo $nSQL;
		}
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
				if ($Col[1]=="") {$Col[1]=fGlobal("Nm_Aset","Ref_Rek_Aset108_7","Kd_Aset",$mRo['Kd_Aset'],"=","","");}
				$Col[3] = $mRo['No_Register'];
				$Col[4] = $mRo['Judul'];
				$Col[5] = $mRo['Spesifikasi'];
				$Col[6] = $mRo['Daerah_Asal'];
				$Col[7] = $mRo['Pencipta'];
				$Col[8] = $mRo['Bahan'];
				$Col[9] = $mRo['Jenis'];
				$Col[10] = $mRo['Ukuran'];
				$Col[11] = "";
				$Col[12] = $mRo['Tahun'];
				$Col[13] = $mRo['Asal_Usul'];
				
				$gREF = $mRo['Referensi'];
				$rUPB = $mRo['Kd_UPB'];
				$rREG = $mRo['Ref_Group'];
				$gAKH = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB:Ref_Group:Tanggal",$gREF.":".$rUPB."%:".$rREG.":".$gTglB,"=:LIKE:=:<=","","");
				$Col[14] = $gAKH;
				$Col[15] = $mRo['Keterangan'];
				
				$Col[16] = fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo['Kd_UPB'],0,11),"=","","");
				$Col[17] = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",substr($mRo['Kd_UPB'],0,14),"=","","");
				$Col[18] = fGlobal("Nm_Upb","ref_upb","Kd_Upb",$mRo['Kd_UPB'],"=","","");
				
				if ($xUnt=="All")
				{
					#if ($Col[15]!="") {$Col[15]=$Col[15]."<br>SKPD: <i>".fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo['Kd_UPB'],0,11),"=","","")."</i>";}
					#else {$Col[15]="SKPD: <i>".fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo['Kd_UPB'],0,11),"=","","")."</i>";}
				}
				if ($xSub=="All")
				{
					#if ($Col[15]!="") {$Col[15]=$Col[15]."<br>Sub Unit: <i>".fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",substr($mRo['Kd_UPB'],0,14),"=","","")."</i>";}
					#else {$Col[15]="Sub Unit: <i>".fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",substr($mRo['Kd_UPB'],0,14),"=","","")."</i>";}
				}
				if ($xUpb=="All")
				{
					#if ($Col[15]!="") {$Col[15]=$Col[15]."<br>UPB: <i>".fGlobal("Nm_Upb","ref_upb","Kd_Upb",$mRo['Kd_UPB'],"=","","")."</i>";}
					#else {$Col[15]="UPB: <i>".fGlobal("Nm_Upb","ref_upb","Kd_Upb",$mRo['Kd_UPB'],"=","","")."</i>";}
				}
						
				$gHrg = $gHrg + $gAKH;
				ViewRincian($Col[0],$Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18]);
				$iG++;
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
		else
		{
			ViewBlank();
		}
		?>
          <?php function ViewRincian($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18) {?>
          <tr height="30"> 
            <td style="border: 1px solid #000" align="center"><?=$x0?>.</td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x16?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x17?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x18?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x1?></td>
            <td style="border: 1px solid #000" align="center"><?=$x2?></td>
            <td style="border: 1px solid #000" align="center"><?=$x3?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x4?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x5?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x6?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x7?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x8?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x9?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?php if ($x10!=0) {echo $x10;}?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x11?></td>
            <td style="border: 1px solid #000; padding-left:2px" align="center"><?php if ($x12!=0) {echo $x12;}?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x13?></td>
            <td style="border: 1px solid #000; padding-right:2px" align="right"><?=fConvertToRupiah($x14)?></td>
            <td style="border: 1px solid #000; padding-left:2px"><?=$x15?></td>
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
          </tr>
          <?php } ?>
          <tr height="30"> 
            <td style="border:1px solid #000; font-weight: bold" align="center" colspan="17">
			<?php
			if ($gLmT=="YA"){
				echo "SUB TOTAL";
			}
			else{
				echo "T O T A L";
			}
			?>
			</td>
            <td style="border:1px solid #000; font-weight: bold; padding-right:2px" align="right"><?php echo fConvertToRupiah($gHrg)?></td>
            <td style="border: 1px solid #000">&nbsp;</td>
          </tr>
		  <?php 
		  if ($gLmT=="YA" && $LoadEND=="YA")
		  {
		  	#echo $mSQL;
			$nRe = mysql_query($mSQL);
			$mRe = mysql_fetch_assoc($nRe);
		  ?>
          <tr height="30"> 
            <td style="border:1px solid #000; font-weight: bold" align="center" colspan="17">T O T A L</td>
            <td style="border:1px solid #000; font-weight: bold; padding-right:2px" align="right"><?=fConvertToRupiah($mRe['JmlG'])?></td>
            <td style="border: 1px solid #000">&nbsp;</td>
          </tr>
		  <?php } ?>
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
