<?
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";
extract($_GET);

if ($Ast=='ALL'){$Ast="";}
if ($JnM=='ALL'){$JnM="";}
?>
<table border="0" width="2100" cellspacing="1" align="center" style=" font-size: 10pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td style="font-size: 13pt; font-weight: bold" align="center">DAFTAR MUTASI KELUAR</td>
</tr>
<? if ($JnM!=''){?>
<tr>
  <td style="font-size: 10pt; font-weight: bold" align="center">( <?=fGlobalNEW("deskripsi","ref_usulan_jenis","kode",$JnM,"=","",$DatabaseSB,$ConSB,"")?> )</td>
</tr>
<? } ?>
</table>
<table border="0" width="2100" cellspacing="1" align="center" style=" font-size: 10pt; font-family: Calibri; border-collapse: collapse">
<tr>
  <td width="100">SKPD</td>
  <td width="30">:</td>
  <td><?=fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",$gUnt,"=","",$DatabaseSB,$ConSB,"")?></td>
</tr>
<tr>
  <td>KABUPATEN</td>
  <td>:</td>
  <td><?=$NmDaer?></td>
</tr>
<tr>
  <td>TAHUN</td>
  <td>:</td>
  <td><?=$gThn?></td>
</tr>
<? if ($Ast!=''){?>
<tr>
  <td>ASET</td>
  <td>:</td>
  <td><?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset",$Ast,"=","",DatabaseSB,$ConSB,""))?></td>
</tr>
<? } ?>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
</table>
<table border="0" width="2100" cellspacing="0" cellpadding="0" align="center" style="font-size: 9pt; font-family: Calibri; border-collapse: collapse">
<tr height="18" style="font-weight:bold">
  <td colspan="3" rowspan="2" style="border:1px solid #000; text-align:center">N O M O R</td>
  <td rowspan="3" style="border:1px solid #000; text-align:center">NAMA BARANG</td>
  <td colspan="2" rowspan="2" style="border:1px solid #000; text-align:center">T A N G G A L</td>
  <td colspan="10" style="border:1px solid #000; text-align:center">S P E S I F I K A S I</td>
  <td colspan="4" rowspan="2" style="border:1px solid #000; text-align:center">N I L A I</td>
  <td rowspan="3" style="border:1px solid #000; text-align:center">KETERANGAN</td>
</tr>
<tr height="18" style="font-weight:bold">
  <td rowspan="2" style="border:1px solid #000; text-align:center">Letak/Alamat</td>
  <td colspan="2" style="border:1px solid #000; text-align:center">Sertifikat / Dokumen </td>
  <td rowspan="2" style="border:1px solid #000; text-align:center">Konstruksi</td>
  <td rowspan="2" style="border:1px solid #000; text-align:center">Merk/Tipe</td>
  <td style="border:1px solid #000; text-align:center">Nomor</td>
  <td rowspan="2" style="border:1px solid #000; text-align:center">Bahan</td>
  <td colspan="3" style="border:1px solid #000; text-align:center">Ukuran</td>
  </tr>
<tr style="font-weight:bold">
  <td style="border:1px solid #000; text-align:center">No.</td>
  <td style="border:1px solid #000; text-align:center">Kode / Ref. </td>
  <td style="border:1px solid #000; text-align:center">Register</td>
  <td style="border:1px solid #000; text-align:center">Perolehan</td>
  <td style="border:1px solid #000; text-align:center">Mutasi</td>
  <td style="border:1px solid #000; text-align:center">Tanggal</td>
  <td style="border:1px solid #000; text-align:center">Nomor</td>
  <td style="border:1px solid #000; text-align:center">Polisi, Pabrik,<br>Chasis, Mesin,<br>BPKB</td>
  <td style="border:1px solid #000; text-align:center">Panjang<br>(m)</td>
  <td style="border:1px solid #000; text-align:center">Lebar<br>(m)</td>
  <td style="border:1px solid #000; text-align:center">Luas<br>(m<sup>2</sup>)</td>
  <td style="border:1px solid #000; text-align:center">Perolehan</td>
  <td style="border:1px solid #000; text-align:center">Akhir</td>
  <td style="border:1px solid #000; text-align:center">Akumulasi<br>Penyusutan<br>( N-1 ) </td>
  <td style="border:1px solid #000; text-align:center">B u k u</td>
</tr>
<tr height="18">
  <td width="25" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">1</td>
  <td width="100" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">2</td>
  <td width="55" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">3</td>
  <td width="200" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">4</td>
  <td width="70" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">5</td>
  <td width="70" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">6</td>
  <td width="170" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">7</td>
  <td width="70" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">8</td>
  <td width="140" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">9</td>
  <td width="100" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">10</td>
  <td width="100" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">11</td>
  <td width="100" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">12</td>
  <td width="100" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">13</td>
  <td width="50" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">14</td>
  <td width="50" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">15</td>
  <td width="50" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">16</td>
  <td width="100" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">17</td>
  <td width="100" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">18</td>
  <td width="100" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">19</td>
  <td width="100" style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">20</td>
  <td style="border:1px solid #000; border-bottom:2px solid #000; text-align:center">21</td>
</tr>
<?
$rCL = array();
function ClrVr()
{
	for ($i=1; $i<=21; $i++)
	{
		if ($i==14 || $i==15 || $i==16 || $i==17 || $i==18 || $i==20 || $i==21){
			$rCL = 0;
		}
		else{
			$rCL = "";
		}
	}
}

$tGa = $gThn."-01-01";
$tGb = $gThn."-12-31";

$iGG=1;
$SQL="SELECT 
Referensi as A0, 
Kd_UPB as A1, 
Kd_Aset_108 as A2, 
No_Register as A3, 
IfNull(sum(Debet),0) as A4, 
Kd_UPB_To as A5, 
Jns_Mutasi as A6,
Referensi_To as A7,
'xxxx' as A8,
'0' as A9,
'0' as A10 
FROM ta_kib_post_108_mutasi WHERE Kd_UPB LIKE '".$gUnt."%' 
AND Jns_Mutasi LIKE '".$JnM."%' AND Kd_Aset_108 LIKE '".$Ast."%' 
AND (Tgl_Mutasi BETWEEN '".$tGa."' AND '".$tGb."') GROUP BY Referensi ORDER BY Referensi";

$SQL="SELECT 
P1.Referensi as A0, 
P1.Kd_UPB as A1, 
P1.Kd_Aset_108 as A2, 
P1.No_Register as A3, 
IfNull(sum(P2.Debet),0) as A4, 
P1.Kd_UPB_To as A5, 
P1.Jns_Mutasi as A6,
P1.Referensi_To as A7,
P1.IDT as A8,
P1.AkmPenyusutan as A9,
P1.NilaiBuku as A10,
P1.extracom as A11 
FROM ta_kib_108_mutasi P1
LEFT JOIN ta_kib_post_108_mutasi P2 ON P2.Referensi=P1.Referensi AND P2.Kd_UPB=P1.Kd_UPB 
WHERE P1.Kd_UPB LIKE '".$gUnt."%' 
AND P1.Jns_Mutasi LIKE '".$JnM."%' AND P1.Kd_Aset_108 LIKE '".$Ast."%' 
AND (P1.Tgl_Mutasi BETWEEN '".$tGa."' AND '".$tGb."') 
GROUP BY P1.Referensi, P1.Kd_UPB 
ORDER BY P1.Referensi";
#echo $SQL."<br>";
$nRs = mysql_query($SQL);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	ClrVr();
	$xB = "<b>";
	$rIDT   = $mRo[8];
	$rRef   = $mRo[0];
	$rUpB   = $mRo[1];
	$rAsT   = $mRo[2];
	$rJnS   = $mRo[6];
	$rETO   = $mRo[7];
	$nAKM   = $mRo[9];
	$nBKU   = $mRo[10];
	$rExt   = $mRo[11];
	
	$Load="YA";
	#if ($JnM=='MS')
	#{
	#	$CeKR = fGlobalNEW("IDT","ta_kib_post_108_mutasi","Referensi:Kd_UPB_To:Jns_Mutasi:Tgl_Mutasi:Tgl_Mutasi",$rRef.":".substr($rUpB,0,11)."%:".$JnM.":".$tGa.":".$tGb,"=:LIKE:=:>=:<=","",$DatabaseSB,$ConSB,"");
	#	if ($CeKR=='') {$Load="NO";}
	#}
	
	if ($Load=="YA")
	{
		$rCL[1] = $iGG;
		if ($rJnS=='RB'){
			$rCL[2] = $mRo[2]."<br>".$mRo[0]."<br><font style='color:#999'>".$mRo[7]."</font>";
		}
		else {
			$rCL[2] = $mRo[2]."<br>".$mRo[0];
		}
		$rCL[3] = $mRo[3];
		$rCL[4] = "";$rCL[5]= "";$rCL[6]= "";$rCL[7]= "";$rCL[8]= "";$rCL[9]= "";$rCL[10]= "";$rCL[11]= "";$rCL[12]= "";$rCL[13]= "";$rCL[14]= "";$rCL[15]= "";$rCL[16]= "";$rCL[17]= "";$rCL[19]= "";$rCL[20]= 0;$rCL[21]= 0;
		
		## cari nilai penyusutan ##
		$rEF  = $mRo[0];
		$rTH  = ($gThn-1);
		$rUPB = substr($mRo[5],0,11);
		
		$rEG = $rEF;
		if ($rJnS=='RB'){
			$rEG = $rETO;
		}
		
		if ($nAKM!=0)
		{
			$rCL[20]= $nAKM;
			$rCL[21]= $nBKU;
		}
		else
		{
			if ($rJnS=='PH')
			{
				$ColDT  = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0):IfNull(sum(Nilai_Buku_Akhir),0):Umur_Sisa","ta_kib_post_penyusutan_108_ph","Kd_UPB:Referensi:PerLap",$rUPB."%:".$rEF.":".$rTH.":Y:IV","LIKE:=:=","",DatabaseSB,$ConSB,"");
				$ColDT  = explode(":",$ColDT);
				$rCL[20]= $ColDT[0];
				$rCL[21]= $ColDT[1];
			}
			
			else 
			{
				$ColDT  = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0):IfNull(sum(Nilai_Buku_Akhir),0):Umur_Sisa","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap",$rUPB."%:".$rEF.":".$rTH.":Y:IV","LIKE:=:=","",DatabaseSB,$ConSB,"");
				$ColDT  = explode(":",$ColDT);
				$rCL[20]= $ColDT[0];
				$rCL[21]= $ColDT[1];
				
				if ($rCL[20]==0)
				{
					$eUPB = substr($mRo[1],0,11);
					$ColDT  = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0):IfNull(sum(Nilai_Buku_Akhir),0):Umur_Sisa","ta_kib_post_penyusutan_108_ph","Kd_UPB:Referensi:PerLap",$eUPB."%:".$rEF.":".$rTH.":Y:IV","LIKE:=:=","",DatabaseSB,$ConSB,"");
					$ColDT  = explode(":",$ColDT);
					$rCL[20]= $ColDT[0];
					$rCL[21]= $ColDT[1];
				}
				
				#$TgLH = "";
				if ($rCL[20]==0)
				{
					$RefH  = fGlobalNEW("Referensi","ta_kib_108","Ref_History",$rEF,"=","",$DatabaseSB,$ConSB,"");
					if ($RefH!='')
					{
						if ($RefH!=$mRo[0]) {$rCL[2] = $mRo[2]."<br><font style='color:#999'>".$mRo[0]."</font><br>".$RefH;}
						
						$rUPB = fGlobalNEW("Kd_UPB","ta_kib_108","Ref_History",$rEF,"=","",$DatabaseSB,$ConSB,"");
						#$TgLH = fGlobalNEW("Tanggal","ta_kib_post_108","Ref_History:Crit",$RefH.":SLD","=:=","",$DatabaseSB,$ConSB,"");
						
						$ColDA = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0):IfNull(sum(Nilai_Buku_Akhir),0):Umur_Sisa","ta_kib_post_penyusutan_108","Kd_UPB:Referensi:PerLap",$rUPB."%:".$RefH.":".$rTH.":Y:IV","LIKE:=:=","",DatabaseSB,$ConSB,"");
						$ColDA  = explode(":",$ColDA);
						$rCL[20]= $ColDA[0];
						$rCL[21]= $ColDA[1];
					}
				}
				
				if ($rCL[20]==0)	#KEJADIAN: Mutasi LE dan record sudah dihapus
				{
					$RefH  = fGlobalNEW("Referensi","ta_kib_108_mutasi","Ref_History:Kd_Upb",$rEF.":".substr($rUpB,0,11)."%","=:LIKE","IDT DESC",$DatabaseSB,$ConSB,"");
					if ($RefH!='')
					{
						if ($RefH!=$mRo[0]) {$rCL[2] = $mRo[2]."<br><font style='color:#999'>".$mRo[0]."</font><br>".$RefH;}
						
						$rUPB = fGlobalNEW("Kd_UPB","ta_kib_108","Ref_History",$rEF,"=","",$DatabaseSB,$ConSB,"");
						#$TgLH = fGlobalNEW("Tanggal","ta_kib_post_108","Ref_History:Crit",$RefH.":SLD","=:=","",$DatabaseSB,$ConSB,"");
						
						$ColDA = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0):IfNull(sum(Nilai_Buku_Akhir),0):Umur_Sisa","ta_kib_post_penyusutan_108_ph","Kd_UPB:Referensi:PerLap",$rUPB."%:".$RefH.":".$rTH.":Y:IV","LIKE:=:=","",DatabaseSB,$ConSB,"");
						$ColDA  = explode(":",$ColDA);
						$rCL[20]= $ColDA[0];
						$rCL[21]= $ColDA[1];
					}
				}
				
				if ($rCL[20]==0)	#KEJADIAN: Mutasi SKPD dan record sudah dihapus
				{
					$DtA  = fGlobalNEW("Referensi_To:Kd_Upb_To","ta_kib_108_mutasi","Referensi:Kd_Upb:Jns_Mutasi",$rEF.":".substr($rUpB,0,11)."%:MS","=:LIKE:=","IDT DESC",$DatabaseSB,$ConSB,"");
					if ($DtA!='')
					{
						$DtA = explode(':',$DtA);
						$reA = $DtA[0];
						$upA = $DtA[1];
						
						$DtB  = fGlobalNEW("Referensi_To:Kd_Upb_To","ta_kib_108_mutasi","Referensi:Kd_Upb:Jns_Mutasi",$reA.":".substr($upA,0,11)."%:HB","=:LIKE:=","IDT DESC",$DatabaseSB,$ConSB,"");
						if ($DtB!='')
						{
							$DtB = explode(':',$DtB);
							$reB = $DtB[0];
							$upB = $DtB[1];
							
							$ColDA = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0):IfNull(sum(Nilai_Buku_Akhir),0):Umur_Sisa","ta_kib_post_penyusutan_108_ph","Kd_UPB:Referensi:PerLap",$upB."%:".$reB.":".$rTH.":Y:IV","LIKE:=:=","",DatabaseSB,$ConSB,"");
							$ColDA  = explode(":",$ColDA);
							$rCL[20]= $ColDA[0];
							$rCL[21]= $ColDA[1];
						}
						else
						{
							$ColDA = fGlobalNEW("IfNull(sum(Penyusutan_Akumulasi),0):IfNull(sum(Nilai_Buku_Akhir),0):Umur_Sisa","ta_kib_post_penyusutan_108_ph","Kd_UPB:Referensi:PerLap",$upA."%:".$reA.":".$rTH.":Y:IV","LIKE:=:=","",DatabaseSB,$ConSB,"");
							$ColDA  = explode(":",$ColDA);
							$rCL[20]= $ColDA[0];
							$rCL[21]= $ColDA[1];
						}
					}
				}
				
				if ($rCL[20] > $mRo[4]) {$rCL[20]=$mRo[4];}
				if ($rCL[21] < 0) {$rCL[21]=0;}
			}
			
			if ($rCL[20]!=0 && $rIDT!='xxxx')
			{
				$SW = "UPDATE ta_kib_108_mutasi SET AkmPenyusutan='".$rCL[20]."', NilaiBuku='".$rCL[21]."' WHERE IDT='".$rIDT."'";
				mysql_query($SW);
			}
		}
		####
		
		if (substr($rAsT,0,5)=="1.3.1"){
			$SQW="SELECT Nm_Aset, Tgl_Perolehan, Tgl_Mutasi, Harga, Kd_Upb_To, Alamat
			FROM ta_kib_108_mutasi WHERE Referensi='".$rRef."' AND Kd_UPB LIKE '".substr($rUpB,0,11)."%'";
			$nRW = mysql_query($SQW);
			while ($mRW = mysql_fetch_array($nRW, MYSQL_BOTH))
			{
				$rCL[4] = $mRW[0];
				$rCL[5] = fConvertDateShort($mRW[1]);
				$rCL[6] = fConvertDateShort($mRW[2]);
				$rCL[7] = $mRW[5];
				
				$rCL[17] = $mRW[3];
				
				$rCL[19]= "Mutasi dari:<br>";
				$rCL[19].= fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",substr($mRW[4],0,11),"=","",$DatabaseSB,$ConSB,"");
				$rCL[19].= "<br>Usulan: ".fGlobalNEW("Referensi","ta_usulan_rinci_108","Ref_Aset:Kd_UPB",$rRef.":".$rUpB,"=:=","",$DatabaseSB,$ConSB,"");
			}
		}
		
		if (substr($rAsT,0,5)=="1.3.2"){
			$SQW="SELECT Nm_Aset, Tgl_Perolehan, Tgl_Mutasi, Bahan, Merk, Type, Nomor_Polisi, Nomor_Pabrik, Nomor_Rangka, Nomor_Mesin, Nomor_BPKB, Harga, Kd_Upb_To 
			FROM ta_kib_108_mutasi WHERE Referensi='".$rRef."' AND Kd_UPB like '".substr($rUpB,0,11)."%'";
			$nRW = mysql_query($SQW);
			while ($mRW = mysql_fetch_array($nRW, MYSQL_BOTH))
			{
				$rCL[4] = $mRW[0];
				$rCL[5] = fConvertDateShort($mRW[1]);
				$rCL[6] = fConvertDateShort($mRW[2]);
				$rCL[7] = "-";
				$rCL[8] = "-";
				$rCL[9] = "-";
				$rCL[10]= "";
				if ($mRW[4]!="-" && $mRW[4]!="" && $mRW[4]!="0"){$rCL[11] = $mRW[4];}
				if ($mRW[5]!="-" && $mRW[5]!="" && $mRW[5]!="0"){$rCL[11].= $mRW[5];}
				
				if ($mRW[6]!="-" && $mRW[6]!=""){$rCL[12] = $mRW[6];}
				if ($mRW[7]!="-" && $mRW[7]!=""){$rCL[12].= "; ".$mRW[7];}
				if ($mRW[8]!="-" && $mRW[8]!=""){$rCL[12].= "; ".$mRW[8];}
				if ($mRW[9]!="-" && $mRW[9]!=""){$rCL[12].= "; ".$mRW[9];}
				if ($mRW[10]!="-" && $mRW[10]!=""){$rCL[12].= "; ".$mRW[10];}
				$rCL[13]= $mRW[3];
				$rCL[14]= "-";
				$rCL[15]= "-";
				$rCL[16]= "-";
				$rCL[17]= $mRW[11];
				$rCL[19]= "Mutasi ke:<br>";
				$rCL[19].= fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",substr($mRW[12],0,11),"=","",$DatabaseSB,$ConSB,"");
				$rCL[19].= "<br>Usulan: ".fGlobalNEW("Referensi","ta_usulan_rinci_108","Ref_Aset:Kd_UPB",$rRef.":".$rUpB,"=:=","",$DatabaseSB,$ConSB,"");
			}
		}
		
		if (substr($rAsT,0,5)=="1.3.3"){
			$SQW="SELECT Nm_Aset, Tgl_Perolehan, Tgl_Mutasi, Lokasi, Dokumen_Tanggal, Dokumen_Nomor, Bertingkat, Beton, Luas_Lantai, Harga, Kd_Upb_To 
			FROM ta_kib_108_mutasi WHERE Referensi='".$rRef."' AND Kd_UPB LIKE '".substr($rUpB,0,11)."%'";
			#echo $SQW."<br>";
			$nRW = mysql_query($SQW);
			while ($mRW = mysql_fetch_array($nRW, MYSQL_BOTH))
			{
				$rCL[4] = $mRW[0];
				$rCL[5] = fConvertDateShort($mRW[1]);
				$rCL[6] = fConvertDateShort($mRW[2]);
				$rCL[7] = $mRW[3];
				$rCL[8] = fConvertDateShort($mRW[4]);
				$rCL[9] = $mRW[5];
				
				$mRW6 = $mRW[6];
				if ($mRW6=="Beritngkat"){
					$rCL[10] = $mRW6;
				}
				
				$mRW7 = $mRW[7];
				if ($mRW7=="Beton"){
					$rCL[10].= $mRW7;
				}
				$rCL[16] = fConvertToRupiahBulat($mRW[8]);
				$rCL[17] = $mRW[9];
				
				$rCL[19]= "Mutasi ke:<br>";
				$rCL[19].= fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",substr($mRW[10],0,11),"=","",$DatabaseSB,$ConSB,"");
				$rCL[19].= "<br>Usulan: ".fGlobalNEW("Referensi","ta_usulan_rinci_108","Ref_Aset:Kd_UPB",$rRef.":".$rUpB,"=:=","",$DatabaseSB,$ConSB,"");
			}
		}
		
		if (substr($rAsT,0,5)=="1.3.4"){
			$SQW="SELECT Nm_Aset, Tgl_Perolehan, Tgl_Mutasi, Harga, Kd_Upb_To 
			FROM ta_kib_108_mutasi WHERE Referensi='".$rRef."' AND Kd_UPB LIKE '".substr($rUpB,0,11)."%'";
			$nRW = mysql_query($SQW);
			while ($mRW = mysql_fetch_array($nRW, MYSQL_BOTH))
			{
				$rCL[4] = $mRW[0];
				$rCL[5] = fConvertDateShort($mRW[1]);
				$rCL[6] = fConvertDateShort($mRW[2]);
				
				$rCL[17] = $mRW[3];
				
				$rCL[19]= "Mutasi ke:<br>";
				$rCL[19].= fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",substr($mRW[4],0,11),"=","",$DatabaseSB,$ConSB,"");
				$rCL[19].= "<br>Usulan: ".fGlobalNEW("Referensi","ta_usulan_rinci_108","Ref_Aset:Kd_UPB",$rRef.":".$rUpB,"=:=","",$DatabaseSB,$ConSB,"");
			}
		}
		
		if (substr($rAsT,0,5)=="1.3.5"){
			$SQW="SELECT Nm_Aset, Tgl_Perolehan, Tgl_Mutasi, Harga, Kd_Upb_To 
			FROM ta_kib_108_mutasi WHERE Referensi='".$rRef."' AND Kd_UPB LIKE '".substr($rUpB,0,11)."%'";
			$nRW = mysql_query($SQW);
			while ($mRW = mysql_fetch_array($nRW, MYSQL_BOTH))
			{
				$rCL[4] = $mRW[0];
				$rCL[5] = fConvertDateShort($mRW[1]);
				$rCL[6] = fConvertDateShort($mRW[2]);
				
				$rCL[17] = $mRW[3];
				
				$rCL[19]= "Mutasi ke:<br>";
				$rCL[19].= fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",substr($mRW[4],0,11),"=","",$DatabaseSB,$ConSB,"");
				$rCL[19].= "<br>Usulan: ".fGlobalNEW("Referensi","ta_usulan_rinci_108","Ref_Aset:Kd_UPB",$rRef.":".$rUpB,"=:=","",$DatabaseSB,$ConSB,"");
			}
		}
		
		if (substr($rAsT,0,5)=="1.5.3" || substr($rAsT,0,5)=="1.5.4"){
			$SQW="SELECT Nm_Aset, Tgl_Perolehan, Tgl_Mutasi, Harga, Kd_Upb_To 
			FROM ta_kib_108_mutasi WHERE Referensi='".$rRef."' AND Kd_UPB LIKE '".substr($rUpB,0,11)."%'";
			$nRW = mysql_query($SQW);
			while ($mRW = mysql_fetch_array($nRW, MYSQL_BOTH))
			{
				$rCL[4] = $mRW[0];
				$rCL[5] = fConvertDateShort($mRW[1]);
				$rCL[6] = fConvertDateShort($mRW[2]);
				
				$rCL[17] = $mRW[3];
				
				$rCL[19]= "Mutasi ke:<br>";
				$rCL[19].= fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",substr($mRW[4],0,11),"=","",$DatabaseSB,$ConSB,"");
				$rCL[19].= "<br>Usulan: ".fGlobalNEW("Referensi","ta_usulan_rinci_108","Ref_Aset:Kd_UPB",$rRef.":".$rUpB,"=:=","",$DatabaseSB,$ConSB,"");
			}
		}
		
		if (substr($rAsT,0,5)=="1.5.3" || substr($rAsT,0,5)=="1.5.4"){
			$SQW="SELECT Nm_Aset, Tgl_Perolehan, Tgl_Mutasi, Harga, Kd_Upb_To 
			FROM ta_kib_108_mutasi WHERE Referensi='".$rRef."' AND Kd_UPB LIKE '".substr($rUpB,0,11)."%'";
			$nRW = mysql_query($SQW);
			while ($mRW = mysql_fetch_array($nRW, MYSQL_BOTH))
			{
				$rCL[4] = $mRW[0];
				$rCL[5] = fConvertDateShort($mRW[1]);
				$rCL[6] = fConvertDateShort($mRW[2]);
				
				$rCL[17] = $mRW[3];
				
				$rCL[19]= "Mutasi ke:<br>";
				$rCL[19].= fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",substr($mRW[4],0,11),"=","",$DatabaseSB,$ConSB,"");
				$rCL[19].= "<br>Usulan: ".fGlobalNEW("Referensi","ta_usulan_rinci_108","Ref_Aset:Kd_UPB",$rRef.":".$rUpB,"=:=","",$DatabaseSB,$ConSB,"");
			}
		}
		
		$rCL[18] = $mRo[4];
		$rCL[19].= "<br>Referensi: ".$rRef;
		
		if ($rJnS=='RB'){$rCL[19]='Rusak Berat';}
		if ($rJnS=='PH'){$rCL[19]='Penghapusan';}
		if ($rJnS=='HB'){$rCL[19]='Hibah';}
		if ($rJnS=='LE'){$rCL[19]='Dalam Proses Lelang';}
		
		//if ($TgLH!='') {$rCL[5] = fConvertDateShort($TgLH);}
		
		#Jika nilai akumulasi NOL, Nilai Buku = NIlai Perolehan Akhir
		if ($rCL[20]==0)
		{
			$rCL[21] = $rCL[18];
		}
		
		ShowDATA($rExt,$rCL[1],$rCL[2],$rCL[3],$rCL[4],$rCL[5],$rCL[6],$rCL[7],$rCL[8],$rCL[9],$rCL[10],$rCL[11],$rCL[12],$rCL[13],$rCL[14],$rCL[15],$rCL[16],$rCL[17],$rCL[18],$rCL[19],$rCL[20],$rCL[21],$xB);
		$iGG++;
		
		
		$rCL17 = $rCL17 + $rCL[17];
		$rCL18 = $rCL18 + $rCL[18];
		$rCL20 = $rCL20 + $rCL[20];
		$rCL21 = $rCL21 + $rCL[21];
	}
}

?>
<? function ShowDATA($rExt,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18,$x19,$x20,$x21,$xB) {?>
<?
#$x20=0;
$z5 = substr($x5,-4,4);
$z6 = substr($x6,-4,4)-1;
$zT = "";
$zB = "";
if ($rExt!='Y')
{
	if (($z5 < $z6) && $x20==0){$zT="; color:#FF0000"; $zB=" **";}
	
	#Buku
	$x2A = substr($x2,0,5);
	$x2B = substr($x2,0,11);
	
	if ($x2A=='1.3.1') {$zT = ""; $zB = "";}
	if ($x2B=='1.5.4.01.74' || $x2B=='1.5.4.01.75' || $x2B=='1.5.4.01.76') {$zT = ""; $zB = "";}
	if ($x2B=='1.5.4.01.01' || $x2B=='1.5.4.02.01' || $x2B=='1.5.4.03.01' || $x2B=='1.5.4.04.01' || $x2B=='1.5.4.05.01') {$zT = ""; $zB = "";}
}
?>

<tr height="18" valign="top" style="vertical-align:top <?=$zT?>">
  <td style="border:1px solid #000; text-align:center" title="<?=$z5.":".$z6?>"><?=$x1?>.</td>
  <td style="border:1px solid #000; text-align:center <?=$zT?>"><?=$x2?></td>
  <td style="border:1px solid #000; text-align:center"><?=$x3?></td>
  <td style="border:1px solid #000; padding-left:3px"><?=$x4.$zB?></td>
  <td style="border:1px solid #000; text-align:center"><?=$x5?></td>
  <td style="border:1px solid #000; text-align:center"><?=$x6?></td>
  <td style="border:1px solid #000; padding-left:3px"><?=$x7?></td>
  <td style="border:1px solid #000; text-align:center"><?=$x8?></td>
  <td style="border:1px solid #000; padding-left:3px"><?=$x9?></td>
  <td style="border:1px solid #000; padding-left:3px"><?=$x10?></td>
  <td style="border:1px solid #000; padding-left:3px"><?=$x11?></td>
  <td style="border:1px solid #000; padding-left:3px"><?=$x12?></td>
  <td style="border:1px solid #000; padding-left:3px"><?=$x13?></td>
  <td style="border:1px solid #000; padding-left:3px"><?=$x14?></td>
  <td style="border:1px solid #000; padding-left:3px"><?=$x15?></td>
  <td style="border:1px solid #000; text-align:center"><?=$x16?></td>
  <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($x17)?></td>
  <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($x18)?></td>
  <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($x20)?></td>
  <td style="border:1px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($x21)?></td>
  <td style="border:1px solid #000; padding-left:3px; font-style:italic"><?=$x19?></td>
</tr>
<? } ?>
<tr>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
  <td style="border:1px solid #000">&nbsp;</td>
</tr>
<tr height="25" style="font-weight:bold">
  <td colspan="16" style="border:1px solid #000; border-top:2px solid #000; text-align:center">T O T A L</td>
  <td style="border:1px solid #000; border-top:2px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($rCL17)?></td>
  <td style="border:1px solid #000; border-top:2px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($rCL18)?></td>
  <td style="border:1px solid #000; border-top:2px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($rCL20)?></td>
  <td style="border:1px solid #000; border-top:2px solid #000; text-align:right; padding-right:3px"><?=fConvertToRupiah($rCL21)?></td>
  <td style="border:1px solid #000; border-top:2px solid #000">&nbsp;</td>
</tr>
</table>
