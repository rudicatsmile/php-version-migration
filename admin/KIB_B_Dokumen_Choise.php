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
#echo $page; return false;
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
	<table border="0" width="2050" cellspacing="1" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table1">
		<tr>
			<td style="font-size: 13pt; font-weight: bold" align="center">KARTU 
			INVENTARIS BARANG (KIB B)</td>
		</tr>
		<tr>
			<td style="font-size: 13pt; font-weight: bold" align="center">
			PERALATAN DAN MESIN <?php if($gExt=='Y') {echo "(EXTRAKOMPTABEL)";}?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
			<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
          <tr> 
            <td width="103">UNIT KERJA</td>
            <td width="16">:</td>
            <td width="650"><?=$gNmUNT ?></td>
            <td width="106">BIDANG ASET </td>
            <td width="19">:</td>
            <td><?=$nAs1?></td>
          </tr>
          <tr> 
            <td width="103">SUB UNIT</td>
            <td width="16">:</td>
            <td><?=$gNmSUB ?></td>
            <td>KELOMPOK ASET </td>
            <td>:</td>
            <td><?=$nAs2?></td>
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
        </table>		</td>
		</tr>
		<tr>
			<td height="5"></td>
		</tr>
		<tr>
			<td>
			<table border="0" width="2050" cellpadding="0" cellspacing="0" style="border:0 solid #000000; font-size: 8pt; font-family: Calibri; border-collapse: collapse" id="table2" bordercolor="#000000">
				<tr>
					<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">No</td>
					<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">U N I T</td>
					<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">SUB UNIT</td>
					<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">U P B</td>
					<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Kode Barang</td>
					<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Nama Barang</td>
					<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Nomor Register</td>
					<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Merk</td>
					<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Type</td>
					<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Ukuran / CC</td>
					<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Bahan</td>
					<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Tahun</td>
					<td style="border:1px solid #000000; font-weight: bold" align="center" colspan="5">Nomor</td>
					<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Asal-Usul</td>
					<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Harga (Rp)</td>
					<td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Pengguna</td>
				    <td rowspan="2" style="border:1px solid #000000; font-weight: bold" align="center">Keterangan</td>
				</tr>
				<tr>
					<td style="border:1px solid #000000; font-weight: bold" align="center">Pabrik</td>
					<td style="border:1px solid #000000; font-weight: bold" align="center">Rangka</td>
					<td style="border:1px solid #000000; font-weight: bold" align="center">Mesin</td>
					<td style="border:1px solid #000000; font-weight: bold" align="center">Polisi</td>
					<td style="border:1px solid #000000; font-weight: bold" align="center">BPKB</td>
				</tr>
				<tr>
					<td width="30" style="border:1px solid #000000; font-weight: bold" align="center">1</td>
					<td width="200" align="center" style="border:1px solid #000000; font-weight: bold">2</td>
					<td width="200" align="center" style="border:1px solid #000000; font-weight: bold">3</td>
					<td width="200" align="center" style="border:1px solid #000000; font-weight: bold">4</td>
					<td width="90" align="center" style="border:1px solid #000000; font-weight: bold">5</td>
					<td width="200" style="border:1px solid #000000; font-weight: bold" align="center">6</td>
					<td width="50" style="border:1px solid #000000; font-weight: bold" align="center">7</td>
					<td width="80" align="center" style="border:1px solid #000000; font-weight: bold">8</td>
					<td width="80" align="center" style="border:1px solid #000000; font-weight: bold">9</td>
					<td width="80" style="border:1px solid #000000; font-weight: bold" align="center">10</td>
					<td width="80" style="border:1px solid #000000; font-weight: bold" align="center">11</td>
					<td width="40" style="border:1px solid #000000; font-weight: bold" align="center">12</td>
					<td width="100" style="border:1px solid #000000; font-weight: bold" align="center">13</td>
					<td width="100" style="border:1px solid #000000; font-weight: bold" align="center">14</td>
					<td width="100" style="border:1px solid #000000; font-weight: bold" align="center">15</td>
					<td width="60" style="border:1px solid #000000; font-weight: bold" align="center">16</td>
					<td width="80" style="border:1px solid #000000; font-weight: bold" align="center">17</td>
					<td width="80" style="border:1px solid #000000; font-weight: bold" align="center">18</td>
					<td width="90" style="border:1px solid #000000; font-weight: bold" align="center">19</td>
					<td width="90" align="center" style="border:1px solid #000000; font-weight: bold">20</td>
				    <td align="center" style="border:1px solid #000000; font-weight: bold">21</td>
				</tr>
				<?php
				$Col[15];
				
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
				
				$iGG=0;
				$nSQL= "SELECT * FROM ta_kib_108 WHERE extracom LIKE '".$gExt."' AND Kd_Aset_108 LIKE '".$gAss."' AND Kd_UPB LIKE '".$gUpb."' AND (Tgl_Perolehan BETWEEN '".$gTglA."' AND '".$gTglB."') AND Kd_Pemilik LIKE '".$gMLK."' AND Status='' 
				ORDER BY Tgl_Perolehan, Kd_Aset, No_Register 
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
						
						$Col[4]= $mRo['Merk'];
						
						$Col[5] = $mRo['Ukuran_CC'];
						$Col[6] = $mRo['Bahan'];
						$Col[7] = fConvertDateShort($mRo['Tgl_Perolehan']);
						$Col[8] = $mRo['Nomor_Pabrik'];
						$Col[9] = $mRo['Nomor_Rangka'];
						$Col[10] = $mRo['Nomor_Mesin'];
						$Col[11] = $mRo['Nomor_Polisi'];
						$Col[12] = $mRo['Nomor_BPKB'];
						$Col[13] = $mRo['Asal_Usul'];
						
						$gREF = $mRo['Referensi'];
						$gGRP = $mRo['Ref_Group'];
						$eUPB = $mRo['Kd_UPB'];
						$rUPB = substr($mRo['Kd_UPB'],0,11);
						
						$gAKH = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB:Ref_Group",$gREF.":".$eUPB.":".$gGRP,"=:=:=","","");
						
						$Col[14] = $gAKH;
						$Col[15] = $mRo['Keterangan'];
						
						$Col[16] = fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($mRo['Kd_UPB'],0,11),"=","","");
						$Col[17] = fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",substr($mRo['Kd_UPB'],0,14),"=","","");
						$Col[18] = fGlobal("Nm_Upb","ref_upb","Kd_Upb",$mRo['Kd_UPB'],"=","","");
						$Col[19] = $mRo['Pemegang'];
						$Col[20] = $mRo['Type'];
						
						$gHrg = $gHrg + $gAKH;;
						ViewRincian($Col[0],$Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],$Col[19],$Col[20]);
						$iG++;
					}
					while ($mRo = mysql_fetch_assoc($nRs));	
				}
				else
				{
					ViewBlank();
				}
				?>
				<?php function ViewRincian($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18,$x19,$x20) {?>
				<tr height="30">
            		<td style="border: 1px solid #000000" align="center"><?=$x0?>.</td>
					<td style="border: 1px solid #000000; padding-left:2px"><?=$x16?></td>
					<td style="border: 1px solid #000000; padding-left:2px"><?=$x17?></td>
					<td style="border: 1px solid #000000; padding-left:2px"><?=$x18?></td>
					<td align="center" style="border: 1px solid #000000"><?=$x1?></td>
					<td style="border: 1px solid #000000; padding-left:2px"><?php echo $x2?></td>
					<td style="border: 1px solid #000000" align="center"><?=$x3?></td>
					<td style="border: 1px solid #000000; padding-left:2px"><?=$x4?></td>
					<td style="border: 1px solid #000000; padding-left:2px"><?=$x20?></td>
					<td style="border: 1px solid #000000; padding-left:2px"><?=$x5?></td>
					<td style="border: 1px solid #000000; padding-left:2px"><?=$x6?></td>
					<td style="border: 1px solid #000000" align="center"><?=substr($x7,-4,4)?></td>
					<td style="border: 1px solid #000000; padding-left:2px"><?=$x8?></td>
					<td style="border: 1px solid #000000; padding-left:2px"><?=$x9?></td>
					<td style="border: 1px solid #000000; padding-left:2px"><?=$x10?></td>
					<td style="border: 1px solid #000000; padding-left:2px"><?=$x11?></td>
					<td style="border: 1px solid #000000; padding-left:2px"><?=$x12?></td>
					<td style="border: 1px solid #000000; padding-left:2px"><?=$x13?></td>
					<td style="border: 1px solid #000000; padding-right:2px" align="right"><?=fConvertToRupiah($x14)?></td>
					<td style="border: 1px solid #000000; padding-left:2px"><?=$x19?></td>
				    <td style="border: 1px solid #000000; padding-left:2px"><?=$x15?></td>
				</tr>
		<?php } ?>
		<?php function ViewBlank() {?>
		<tr>
			<td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
            <td style="border: 1px solid #000000">&nbsp;</td>
		    <td style="border: 1px solid #000000">&nbsp;</td>
		</tr>
		<?php } ?>
		<tr height="27">
            <td colspan="18" style="border:1px solid #000000; font-weight: bold" align="center">SUB TOTAL</td>
            <td style="border:1px solid #000000; font-weight: bold; padding-right:2px" align="right"><?php echo fConvertToRupiah($gHrg)?></td>
            <td style="border: 1px solid #000000">&nbsp;</td>
		    <td style="border: 1px solid #000000">&nbsp;</td>
		</tr>
		<?php if ($tRo < 5000) {?>
		<?php
		#$SQL="SELECT sum(P2.debet) as JmL 
		#FROM ta_kib_108 P1 
		#LEFT JOIN ta_kib_post_108 P2 ON P2.referensi=P1.referensi AND left(P2.Kd_UPB,11)=left(P1.Kd_UPB,11) 
		#WHERE P1.extracom LIKE '".$gExt."' AND P1.Kd_Aset_108 LIKE '".$gAss."' AND P1.Kd_UPB LIKE '".$gUpb."' 
		#AND (P1.Tgl_Perolehan BETWEEN '".$gTglA."' AND '".$gTglB."') AND P1.Kd_Pemilik LIKE '".$gMLK."' AND P1.Status=''";
		
		$SQL="SELECT sum(P2.debet) as JmL 
		FROM ta_kib_108 P1 
		LEFT JOIN ta_kib_post_108 P2 ON P2.referensi=P1.referensi AND P2.Kd_UPB=P1.Kd_UPB AND P2.Ref_Group=P1.Ref_Group 
		WHERE P1.extracom LIKE '".$gExt."' AND P1.Kd_Aset_108 LIKE '".$gAss."' AND P1.Kd_UPB LIKE '".$gUpb."' 
		AND (P1.Tgl_Perolehan BETWEEN '".$gTglA."' AND '".$gTglB."') AND P1.Kd_Pemilik LIKE '".$gMLK."' AND P1.Status=''";
		#echo $SQL;
		$rs = mysql_query($SQL);
		$mR = mysql_fetch_array($rs,MYSQL_BOTH);
		$gTot = $mR[0];
		?>
		<tr height="27">
            <td colspan="18" style="border:1px solid #000000; font-weight: bold" align="center">T O T A L</td>
            <td style="border:1px solid #000000; font-weight: bold; padding-right:2px" align="right"><?php echo fConvertToRupiah($gTot)?></td>
            <td style="border: 1px solid #000000">&nbsp;</td>
		    <td style="border: 1px solid #000000">&nbsp;</td>
		</tr>
		<?php } ?>
		</table>
		</td>
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

<?php require('Connection_Close.php');?>
