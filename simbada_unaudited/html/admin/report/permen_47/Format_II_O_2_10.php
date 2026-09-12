<?
require('../../Connection.php');
require('../../FileFunction.php');
require("../../CheckLogin.php");
extract($_GET);

$ThN   = $Thn;
$NmSkP = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$KdS,"=","","");	
$TgD   = $HriA." ".fNmBulanLong($BlnA)." ".$ThnA;

$fP1Kde = "-";
$Vx = "PENGGUNA BARANG";

$fP1NmaP  = fGlobal("Nm_Pengurus","ref_unit","Kd_Unit",$KdS,"=","","");
$fP1NipP  = fGlobal("Nip_Pengurus","ref_unit","Kd_Unit",$KdS,"=","","");
$fP1PktP  = fGlobal("Pkt_Pengurus","ref_unit","Kd_Unit",$KdS,"=","","");
$fP1JabP  = fGlobal("Jbt_Pengurus","ref_unit","Kd_Unit",$KdS,"=","","");

$fP1Nma  = fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit",$KdS,"=","","");
$fP1Nip  = fGlobal("Nip_Pimpinan","ref_unit","Kd_Unit",$KdS,"=","","");
$fP1Pkt  = fGlobal("Pkt_Pimpinan","ref_unit","Kd_Unit",$KdS,"=","","");
$fP1Jab  = fGlobal("Jab_Pimpinan","ref_unit","Kd_Unit",$KdS,"=","","");

$iG=1;
?>
<body>
<table border="0" width="1350" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td width="567"></td>
    <td width="131" style="text-align:right; font-size:10pt">Format II.O.2.10</td>
  </tr>
</table>
<table border="0" width="1350" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">DAFTAR BMD PADA PENGGUNA BARANG</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">PERSEDIAAN RUSAK BERAT ATAU USANG</td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri"><?=$NmSkP?></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">PEMERINTAH <?=strtoupper($TiDaer." ".$NmDaer)?></td>
  </tr>
  <tr>
    <td style="text-align:center; font-size:10pt; font-weight:bold; font-family:calibri">TAHUN <?=substr($ThN,0,4)?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" width="1350" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; font-family:Calibri; font-size:10pt">  
  <tr>
    <td width="140"><?=ucwords(strtolower($Vx))?></td>
    <td width="20">:</td>
    <td><?=$fP1NmaP?></td>
  </tr>
  <tr>
    <td>Kode Lokasi</td>
    <td>:</td>
    <td><?=$fP1Kde?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" width="1350" cellspacing="0" cellpadding="0" align="center" style="border-collapse: collapse; font-family:Calibri; font-size:9pt">  
  <tr style="text-align:center; font-weight:bold">
    <td style="border:1px solid #000">Kode Barang </td>
    <td style="border:1px solid #000">Nama Barang </td>
    <td style="border:1px solid #000">NUSP</td>
    <td style="border:1px solid #000">Nomor<br>Register </td>
    <td style="border:1px solid #000">Spesifikasi Nama <br>Barang</td>
    <td style="border:1px solid #000">Jumlah</td>
    <td style="border:1px solid #000">Satuan<br>Barang</td>
    <td style="border:1px solid #000">Harga Satuan<br>Perolehan<br>(Rp) </td>
    <td style="border:1px solid #000">Nilai Total <br>(Rp) </td>
    <td style="border:1px solid #000">Cara Perolehan </td>
    <td style="border:1px solid #000">Status<br>Penggunaan </td>
    <td style="border:1px solid #000">Keterangan</td>
  </tr>
  
  <tr style="text-align:center">
    <td width="100" style="border:1px solid #000; border-bottom:3px double #000">1</td>
    <td width="200" style="border:1px solid #000; border-bottom:3px double #000">2</td>
    <td width="100" style="border:1px solid #000; border-bottom:3px double #000">3</td>
    <td width="50" style="border:1px solid #000; border-bottom:3px double #000">4</td>
    <td width="150" style="border:1px solid #000; border-bottom:3px double #000">5</td>
    <td width="50" style="border:1px solid #000; border-bottom:3px double #000">8</td>
    <td width="80" style="border:1px solid #000; border-bottom:3px double #000">9</td>
    <td width="100" style="border:1px solid #000; border-bottom:3px double #000">10</td>
    <td width="100" style="border:1px solid #000; border-bottom:3px double #000">11</td>
    <td width="90" style="border:1px solid #000; border-bottom:3px double #000">12</td>
    <td width="100" style="border:1px solid #000; border-bottom:3px double #000">14</td>
    <td style="border:1px solid #000; border-bottom:3px double #000">15</td>
  </tr>
	<?
	$iGa = 1;
	$t8  = 0;
	$t11 = 0;
	$SQa = "SELECT '' as A0, 
	P3.Kd_Aset as A1, 
	P3.Nm_Aset as A2,
	IfNull(sum(P1.Harga),0) as A3,
	IfNull(sum(P2.Debet),0) as A4 
	FROM ta_kib_108 P1 
	LEFT JOIN ta_kib_post_108 P2 ON P2.Referensi=P1.Referensi AND P2.Ref_Group=P1.Ref_Group AND P2.Kd_UPB=P1.Kd_UPB 
	LEFT JOIN ref_rek_aset108_4 P3 ON P3.Kd_Aset=left(P1.Kd_Aset_108,8)
	WHERE P1.Kd_UPB LIKE '".$KdS.".%' AND P1.Kd_Aset_108 LIKE 'x.x.x.%' 
	AND P1.Tgl_Perolehan<='".$ThN."-12-31' 
	GROUP BY left(P1.Kd_Aset_108,8) 
	ORDER BY left(P1.Kd_Aset_108,8)";
	#echo $SQa;
	$nRa = mysql_query($SQa);
	while ($mRa = mysql_fetch_array($nRa)) 
	{
		$x1 ="";$x2=""; $x3=""; $x4=""; $x5=""; $x6=""; $x7=""; $x8=""; $x9=""; $x10=0;
		$x11=0;$x12="";$x13="";$x14="";$x15="";
		$x0 = "";
		$x1 = $mRa[1];
		$x2 = ucwords(strtolower($mRa[2]));
		$x10= $mRa[3];
		$x11= $mRa[4];
		
		$t11 = $t11+$x11;
		
		$xB = "bold";
		if ($iGa>1) {detaBlank();}
		detaData($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18,$x19,$x20,$xB);
		Lev5($KdS,$x1,$ThN,$HostnameSB,$ConSB,"");
		$iGa++;
	}
	
	function Lev5($KdS,$x1,$ThN,$HostnameSB,$ConSB)
	{
		$iGb=1;
		$SQb = "SELECT '' as A0, 
		P3.Kd_Aset as A1, 
		P3.Nm_Aset as A2,
		IfNull(sum(P1.Harga),0) as A3,
		IfNull(sum(P2.Debet),0) as A4 
		FROM ta_kib_108 P1 
		LEFT JOIN ta_kib_post_108 P2 ON P2.Referensi=P1.Referensi AND P2.Ref_Group=P1.Ref_Group AND P2.Kd_UPB=P1.Kd_UPB 
		LEFT JOIN ref_rek_aset108_5 P3 ON P3.Kd_Aset=left(P1.Kd_Aset_108,11)
		WHERE P1.Kd_UPB LIKE '".$KdS.".%' AND P1.Kd_Aset_108 LIKE '".$x1.".%'
		AND P1.Tgl_Perolehan<='".$ThN."-12-31' 
		GROUP BY left(P1.Kd_Aset_108,11) 
		ORDER BY left(P1.Kd_Aset_108,11)";
		#echo $SQb;
		$nRb = mysql_query($SQb);
		while ($mRb = mysql_fetch_array($nRb)) 
		{
			$x1 ="";$x2=""; $x3=""; $x4=""; $x5=""; $x6=""; $x7=""; $x8=""; $x9=""; $x10=0;
			$x11=0;$x12="";$x13="";$x14="";$x15="";
			$x0 = "";
			$x1 = $mRb[1];
			$x2 = ucwords(strtolower($mRb[2]));
			$x10= $mRb[3];
			$x11= $mRb[4];
			
			$xB = "bold";
			if ($iGb>1) {detaBlank();}
			detaData($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18,$x19,$x20,$xB);
			Lev6($KdS,$x1,$ThN,$HostnameSB,$ConSB,"");
			$iGb++;
		}
	}
	
	function Lev6($KdS,$x1,$ThN,$HostnameSB,$ConSB)
	{
		$iGc=1;
		$SQc = "SELECT '' as A0, 
		P3.Kd_Aset as A1, 
		P3.Nm_Aset as A2,
		IfNull(sum(P1.Harga),0) as A3,
		IfNull(sum(P2.Debet),0) as A4 
		FROM ta_kib_108 P1 
		LEFT JOIN ta_kib_post_108 P2 ON P2.Referensi=P1.Referensi AND P2.Ref_Group=P1.Ref_Group AND P2.Kd_UPB=P1.Kd_UPB 
		LEFT JOIN ref_rek_aset108_6 P3 ON P3.Kd_Aset=left(P1.Kd_Aset_108,14)
		WHERE P1.Kd_UPB LIKE '".$KdS.".%' AND P1.Kd_Aset_108 LIKE '".$x1.".%'
		AND P1.Tgl_Perolehan<='".$ThN."-12-31' 
		GROUP BY left(P1.Kd_Aset_108,14) 
		ORDER BY left(P1.Kd_Aset_108,14)";
		#echo $SQc;
		$nRc = mysql_query($SQc);
		while ($mRc = mysql_fetch_array($nRc)) 
		{
			$x1 ="";$x2=""; $x3=""; $x4=""; $x5=""; $x6=""; $x7=""; $x8=""; $x9=""; $x10=0;
			$x11=0;$x12="";$x13="";$x14="";$x15="";
			$x0 = "";
			$x1 = $mRc[1];
			$x2 = ucwords(strtolower($mRc[2]));
			
			$x10= $mRc[3];
			$x11= $mRc[4];
			
			$xB = "bold";
			if ($iGc>1) {detaBlank();}
			detaData($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18,$x19,$x20,$xB);
			Lev7($KdS,$x1,$ThN,$HostnameSB,$ConSB,"");
			$iGc++;
		}
	}
	
	function Lev7($KdS,$x1,$ThN,$HostnameSB,$ConSB)
	{
		$iGd=1;
		$SQd = "SELECT '' as A0, P3.Kd_Aset as A1, P3.Nm_Aset as A2, 
		P1.Referensi as A3,
		P1.No_Register as A4,
		P1.Nm_Aset as A5,
		'-' as A6,
		P1.Alamat as A7,
		'1' as A8,
		'buah' as A9,
		P1.Harga as A10,
		IfNull(sum(P2.Debet),0) as A11,
		P1.Asal_Usul as A12,
		P1.Tgl_Perolehan as A13,
		P1.Penggunaan as A14,
		P1.Keterangan as A15 
		FROM ta_kib_108 P1 
		LEFT JOIN ta_kib_post_108 P2 ON P2.Referensi=P1.Referensi AND P2.Ref_Group=P1.Ref_Group AND P2.Kd_UPB=P1.Kd_UPB 
		LEFT JOIN ref_rek_aset108_7 P3 ON P3.Kd_Aset=P1.Kd_Aset_108 
		
		WHERE P1.Kd_UPB LIKE '".$KdS.".%' AND P1.Kd_Aset_108 LIKE '".$x1.".%' 
		AND P1.Tgl_Perolehan<='".$ThN."-12-31' 
		GROUP BY P1.Referensi, P1.Ref_Group 
		ORDER BY P1.Kd_Aset_108, P1.Referensi, P1.Ref_Group";
		#echo $SQd;
		$nRd = mysql_query($SQd);
		while ($mRd = mysql_fetch_array($nRd)) 
		{
			$x1 ="";$x2=""; $x3=""; $x4=""; $x5=""; $x6=""; $x7=""; $x8=""; $x9=""; $x10="";
			$x11="";$x12="";$x13="";$x14="";$x15=0; $x16=0;$x17="";$x18="";$x19="";$x20="";
			$x0 = "";
			$x1 = $mRd[1];
			$x2 = $mRd[2];
			$x3 = $mRd[3];
			$x4 = $mRd[4];
			$x5 = $mRd[5];
			$x6 = $mRd[6];
			$x7 = $mRd[7];
			$x8 = $mRd[8];
			$x9 = $mRd[9];
			$x10= $mRd[10];
			$x11= $mRd[11];
			$x12= $mRd[12];
			$x13= fConvertDateShort($mRd[13]);
			$x14= $mRd[14];
			$x15= $mRd[15];
			
			$xB = "normal";
			detaData($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18,$x19,$x20,$xB);
			$iGd++;
			
			if(isset($_COOKIE['t8'])) 
			{
				$t8 = $_COOKIE['t8'] + $x8;
			}
			else
			{
				$t8 = $x8;
			}
			$_COOKIE['t8']=$t8;
		}
	}
	?>
	<? function detaData($x0,$x1,$x2,$x3,$x4,$x5,$x6,$x7,$x8,$x9,$x10,$x11,$x12,$x13,$x14,$x15,$x16,$x17,$x18,$x19,$x20,$xB) {?>
		<tr height="19" style="font-weight:<?=$xB?>">
		<td style="border:1px solid #000; padding-left:2px"><?=$x1?></td>
		<td style="border:1px solid #000; padding-left:2px"><?=$x2?></td>
		<td style="border:1px solid #000; text-align:center"><?=$x3?></td>
		<td style="border:1px solid #000; text-align:center"><?=$x4?></td>
		<td style="border:1px solid #000; padding-left:2px"><?=$x5?></td>
		<td style="border:1px solid #000; text-align:center"><?=$x8?></td>
		<td style="border:1px solid #000; padding-left:2px"><?=$x9?></td>
		<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($x10)?></td>
		<td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($x11)?></td>
		<td style="border:1px solid #000; padding-left:2px"><?=$x12?></td>
		<td style="border:1px solid #000; padding-left:2px"><?=$x14?></td>
		<td style="border:1px solid #000; padding-left:2px"><?=$x15?></td>
		</tr>
	<? } ?>
	<? function detaBlank() {?>
		<tr height="19">
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
	<? } ?>
	<?	if ($iGa==1){?>
		<tr height="100">
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
	<? } ?>
  <tr height="19" style="font-weight:bold">
    <td colspan="5" style="border:1px solid #000; text-align:right">T O T A L<?=str_repeat('&nbsp;',20)?></td>
    <td style="border:1px solid #000; text-align:center"><?=fConvertToRupiahBulat($_COOKIE['t8'])?></td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000; text-align:right; padding-right:2px"><?=fConvertToRupiahBulat($t11)?></td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
    <td style="border:1px solid #000">&nbsp;</td>
  </tr>
</table>
<table border="0" width="1350" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt">
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
  </tr>
  <tr>
    <td width="600" style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td width="600" style="text-align:center">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center"><?=$NmIbuk?>, <?=$TgD?></td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center"><?=$Vx?></td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
  </tr>
  <tr height="50">
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center; font-weight:bold; text-decoration:underline"><?=$fP1Nma?></td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">NIP. <?=$fP1Nip?></td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center"><?=$fP1Pkt?></td>
  </tr>
  <tr>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
    <td style="text-align:center">&nbsp;</td>
  </tr>
</table>
</body>