<?php
require "../../connfile.php";
require "../../configfile.php";
require "../../functionfile.php";
extract($_GET);

$TGa = $r01c."-".fMakeReg($r01b,2)."-".fMakeReg($r01a,2); 
$TGb = $r02c."-".fMakeReg($r02b,2)."-".fMakeReg($r02a,2); 

$SalD = fGlobal("ifnull(sum(qty),0)","tb_post","KdBidang:KdPersediaan:Tanggal:DK:Crit:Crit",$KdB.":".$KdR.":".$TGa.":D:SLF:SLB","=:=:<:=:<>:<>","",DatabaseSA,$ConSA,"");
$SalK = fGlobal("ifnull(sum(qty),0)","tb_post","KdBidang:KdPersediaan:Tanggal:DK:Crit:Crit",$KdB.":".$KdR.":".$TGa.":K:SLF:SLB","=:=:<:=:<>:<>","",DatabaseSA,$ConSA,"");
$Awal = $SalD-$SalK;
$Sisa = $Awal;
$Tisa = $Sisa;

$HarD = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:DK:Crit:Crit",$KdB.":".$KdR.":".$TGa.":D:SLF:SLB","=:=:<:=:<>:<>","",DatabaseSA,$ConSA,"");
$HarK = fGlobal("ifnull(sum(TotalHarga),0)","tb_post","KdBidang:KdPersediaan:Tanggal:DK:Crit:Crit",$KdB.":".$KdR.":".$TGa.":K:SLF:SLB","=:=:<:=:<>:<>","",DatabaseSA,$ConSA,"");
$HarG = $HarD-$HarK;
$TarG = $HarG;
?>
<table border="0" width="850" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <tr>
    <td style="text-align:right; font-size:10pt">Format II.I.5</td>
  </tr>
</table>
<table border="0" width="850" cellspacing="0" cellpadding="0" align="center" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:11pt">
  <!--tr>
    <td colspan="6" style="text-align:center; font-size:10pt; font-weight:bold; font-family:verdana">PEMERINTAH <?=strtoupper($NmTING." ".$NmDAER)?></td>
  </tr-->
  <tr>
    <td colspan="6" style="text-align:center; font-size:11pt; font-weight:bold; font-family:verdana">KARTU BARANG PERSEDIAAN</td>
  </tr>
  <tr>
    <td colspan="6" style="text-align:center; font-size:10pt; font-weight:bold; font-family:verdana">SKPD : <?=fGlobal("bidang","tb_bidang","kode",substr($KdB,0,11),"=","",DatabaseSA,$ConSA,"");?></td>
  </tr>
  <tr>
    <td colspan="6" style="text-align:center; font-size:10pt; font-family:calibri">Periode : <?=fConvertDateLongBln($TGa)?> s.d <?=fConvertDateLongBln($TGb)?></td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
  <tr>
    <td width="95">Kode Barang</td>
    <td width="23">:</td>
    <td width="228"><?=substr($KdR,0,19)?></td>
    <td width="158">NUSP</td>
    <td width="16">:</td>
    <td width="330"><?=substr($KdR,-5,5)?></td>
  </tr>
  <tr>
    <td>Nama Barang</td>
    <td>:</td>
    <td><?=fGlobal("Nm_Rek","ref_rek_90_7_persediaan","Kd_Rek",substr($KdR,0,19),"=","",DatabaseSA,$ConSA,"");?></td>
    <td>Spesifikasi Nama Barang</td>
    <td>:</td>
    <td><?=fGlobal("Nm_Rek","ref_rek_90_8_persediaan","Kd_Rek",$KdR,"=","",DatabaseSA,$ConSA,"");?></td>
  </tr>
  <tr>
    <td>Satuan Barang </td>
    <td>:</td>
    <td><?=fGlobal("Satuan","ref_rek_90_8_persediaan","Kd_Rek",$KdR,"=","",DatabaseSA,$ConSA,"");?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>

<table align="center" cellpadding="0" cellspacing="0" width="850" border="0" style="border:0px solid #000; border-collapse: collapse; font-family:Calibri; font-size:10pt"> 
  <tr height="23" style="text-align:center; font-weight:bold">
    <td rowspan="2" style="border-left:1px solid #000; border-right:1px solid #000; border-top:1px solid #000; border-bottom:2px double #000">Tanggal</td>
	<td colspan="3" style="border-right:1px solid #000; border-bottom:1px solid #000; border-top:1px solid #000">Masuk</td>
	<td colspan="3" style="border-right:1px solid #000; border-bottom:1px solid #000; border-top:1px solid #000">Keluar</td>
	<td colspan="3" style="border-right:1px solid #000; border-bottom:1px solid #000; border-top:1px solid #000">Sisa / Saldo Tersedia</td>
  </tr>
  <tr height="23" style="text-align:center; font-weight:bold">
    <td width="70" style="border-right:1px solid #000; border-bottom:2px double #000">Jumlah</td>
    <td width="80" style="border-right:1px solid #000; border-bottom:2px double #000">Harga</td>
    <td width="90" style="border-right:1px solid #000; border-bottom:2px double #000">Total</td>
    <td width="70" style="border-right:1px solid #000; border-bottom:2px double #000">Jumlah</td>
    <td width="80" style="border-right:1px solid #000; border-bottom:2px double #000">Harga</td>
    <td width="90" style="border-right:1px solid #000; border-bottom:2px double #000">Total</td>
    <td width="70" style="border-right:1px solid #000; border-bottom:2px double #000">Jumlah</td>
    <td width="80" style="border-right:1px solid #000; border-bottom:2px double #000">Harga</td>
    <td width="110" style="border-right:1px solid #000; border-bottom:2px double #000">Total</td>
  </tr>
  <?php if($Sisa!=0) {?>
  <tr height="26" style="vertical-align:top; font-weight:bold">
    <td class="ac" style="border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000">&nbsp;</td>
	<td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align:center">-</td>
	<td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align:center">&nbsp;</td>
	<td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align:center">&nbsp;</td>
	<td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align:center">-</td>
	<td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align:center">&nbsp;</td>
	<td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align:center">&nbsp;</td>
	<td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align:center"><?php if($Sisa!=0){echo fConvertToRupiahBulat($Sisa);} else {echo '-';}?></td>
    <td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align:center">&nbsp;</td>
    <td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align:right; padding-right:3px"><?php if($HarG!=0){echo fConvertToRupiah($HarG);} else {echo '-';}?></td>
  </tr>
  <?php } ?>
  <?php 
	$iG=1; 
	$nSQ = "SELECT IDT as A0, 
	Tanggal as A1,
	Referensi as A2,
	ReferensiDetail as A3,
	ReferensiDetailAsal as A4,
	KdPersediaan as A5,
	QTY as A6,
	Harga as A7,
	TotalHarga as A8,
	NoPemakai as A9,
	Crit as A10,
	DK as A11,
	Nomor as A12 
	FROM tb_post 
	WHERE KdBidang='$KdB' AND KdPersediaan='".$KdR."' AND (tanggal BETWEEN '$TGa' AND '$TGb') AND Crit <> 'SLF' AND Crit <> 'SLB' $SyT 
	ORDER BY Tanggal, IDT"; 
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs)) 
	{ 
		$gID = $mRo[0]; 
		$gBG = fBackCLR($iG); 
		
		$gUR = "";
		if ($mRo[10]=='MTS' && $mRo[11]=='D')
		{
			$KdB = fGlobal("KdBidang","tb_mutasi","Nomor",$mRo[2],"=","",DatabaseSA,$ConSA,"");
			$CrT = fGlobal("Mutasi","tb_mutasi","Nomor",$mRo[2],"=","",DatabaseSA,$ConSA,"");
			$gUR = "Mutasi dari ".fGlobal("sub_bidang","tb_bidang_sub","kode",$KdB,"=","",DatabaseSA,$ConSA,"");
			if ($CrT=='skpd'){
				$gUR.="<br><i>".fGlobal("bidang","tb_bidang","kode",substr($KdB,0,11),"=","",DatabaseSA,$ConSA,"")."</i>";
			}
		}
		else if ($mRo[10]=='MTS' && $mRo[11]=='K')
		{
			$KdB = fGlobal("KdBidangTo","tb_mutasi","Nomor",$mRo[2],"=","",DatabaseSA,$ConSA,"");
			$CrT = fGlobal("Mutasi","tb_mutasi","Nomor",$mRo[2],"=","",DatabaseSA,$ConSA,"");
			$gUR = "Mutasi ke ".fGlobal("sub_bidang","tb_bidang_sub","kode",$KdB,"=","",DatabaseSA,$ConSA,"");
			if ($CrT=='skpd'){
				$gUR.="<br><i>".fGlobal("bidang","tb_bidang","kode",substr($KdB,0,11),"=","",DatabaseSA,$ConSA,"")."</i>";
			}
		}
		else if ($mRo[10]=='PGD' && $mRo[11]=='D')
		{
			$KdB = fGlobal("Kd_Rekanan","tb_pengadaan","Referensi",$mRo[2],"=","",DatabaseSA,$ConSA,"");
			$gUR = "Pengadaan Nomor ".$mRo[12]."<br>Rekanan : ".fGlobal("Nma_Perusahaan","tb_rekanan","Kode",$KdB,"=","",DatabaseSA,$ConSA,"");
		}
		else if ($mRo[10]=='HBH' && $mRo[11]=='D')
		{
			$KdB = fGlobal("IdSumber","tb_non_apbd","Nomor",$mRo[2],"=","",DatabaseSA,$ConSA,"");
			$gUR = "Penerimaan Hibah Nomor ".$mRo[12]."<br>Rekanan : ".fGlobal("Nma_Perusahaan","tb_rekanan","Kode",$KdB,"=","",DatabaseSA,$ConSA,"");
		}
		else if ($mRo[10]=='PMK' && $mRo[11]=='K')
		{
			$KdB = fGlobal("IdPengguna","tb_pemakaian","Nomor",$mRo[2],"=","",DatabaseSA,$ConSA,"");
			$gUR = "Pemakaian ".$mRo[12]."<br>Pengguna : ".fGlobal("Pengguna","tb_pengguna","Kode",$KdB,"=","",DatabaseSA,$ConSA,"");
		}
		else if ($mRo[10]=='PMS' && $mRo[11]=='K')
		{
			$gUR = "Pemusnahan";
		}
		else if ($mRo[10]=='SLD')
		{
			$gUR = "Saldo awal ";
		}
		else if ($mRo[10]=='PNY')
		{
			$gUR = "Penyesuaian";
		}
		else if ($mRo[10]=='RTR')
		{
			$gUR = "Retur Pembelian";
		}
		
		$Awal = $Sisa;
		if ($mRo[11]=='D')
		{
			$PosA = $mRo[6];
			$PosB = 0;
			$Sisa = $Sisa+$PosA-$PosB;
			
			$HrgM = $mRo[7];
			$TtlM = $mRo[8];
			$HrgK = 0;
			$TtlK = 0;
			
			$HarG = $HarG + $TtlM;
		}
		else if ($mRo[11]=='K')
		{
			$PosA = 0;
			$PosB = $mRo[6];
			$Sisa = $Sisa+$PosA-$PosB;
			
			$HrgM = 0;
			$TtlM = 0;
			$HrgK = $mRo[7];
			$TtlK = $mRo[8];
			$HarG = $HarG - $TtlK;
			
		}
		$TosA = $TosA+$PosA;
		$TosB = $TosB+$PosB;
		
		$EtlM = $EtlM+$TtlM;
		$EtlK = $EtlK+$TtlK;
		
		$Tisa = $Sisa;
		$TarG = $HarG;
		if ($Sisa<=0){$HarG=0;}
        ?> 
          <tr height="26" style="cursor: pointer">
            <td class="ac" style="border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; text-align:center"><?=fConvertDateShort($mRo[1])?></td> 
            <td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align:center"><?php if($PosA!=0){echo fConvertToRupiahBulat($PosA);} else {echo '-';}?></td>
            <td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align:right; padding-right:3px"><?php if($HrgM!=0){echo fConvertToRupiah($HrgM);} else {echo '-';}?></td>
            <td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align:right; padding-right:3px"><?php if($TtlM!=0){echo fConvertToRupiahBulat($TtlM);} else {echo '-';}?></td>
            <td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align:center"><?php if($PosB!=0){echo fConvertToRupiahBulat($PosB);} else {echo '-';}?></td>
            <td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align:right; padding-right:3px"><?php if($HrgK!=0){echo fConvertToRupiah($HrgK);} else {echo '-';}?></td>
            <td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align:right; padding-right:3px"><?php if($TtlK!=0){echo fConvertToRupiah($TtlK);} else {echo '-';}?></td>
            <td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align:center"><?php if($Sisa!=0){echo fConvertToRupiahBulat($Sisa);} else {echo '-';}?></td>
            <td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align:right; padding-right:3px"><?php if($HarG!=0 && $Sisa!=0){echo fConvertToRupiah($HarG/$Sisa);} else {echo '-';}?></td>
            <td style="border-right:1px solid #000; border-bottom:1px solid #000; text-align:right; padding-right:3px"><?php if($HarG!=0){echo fConvertToRupiah($HarG);} else {echo '-';}?></td>
          </tr> 
          <?php 
        $iG++; 
    } 
    ?> 
	<?php if ($iG==1){?>
  <tr height="20">
    <td style="border-left:1px solid #000; border-right:1px solid #000">&nbsp;</td>
		<td style="border-right:1px solid #000">&nbsp;</td>
		<td style="border-right:1px solid #000">&nbsp;</td>
		<td style="border-right:1px solid #000">&nbsp;</td>
		<td style="border-right:1px solid #000">&nbsp;</td>
		<td style="border-right:1px solid #000">&nbsp;</td>
		<td style="border-right:1px solid #000">&nbsp;</td>
		<td style="border-right:1px solid #000">&nbsp;</td>
	    <td style="border-right:1px solid #000">&nbsp;</td>
	    <td style="border-right:1px solid #000">&nbsp;</td>
  </tr>
	<?php } 
	if ($Tisa<=0){$TarG=0;}
	?>
  <tr height="30" style="cursor: pointer; font-weight:bold">
	<td style="border-left:1px solid #000; border-right:1px solid #000; border-top:0px solid #000; text-align:center; border-bottom:1px solid #000">T O T A L</td>
	<td style="border-right:1px solid #000; border-top:0px solid #000; border-bottom:1px solid #000; text-align:center"><?php if($TosA!=0){echo fConvertToRupiahBulat($TosA);} else {echo '-';}?></td>
	<td style="border-right:1px solid #000; border-top:0px solid #000; border-bottom:1px solid #000; text-align:center">-</td>
	<td style="border-right:1px solid #000; border-top:0px solid #000; border-bottom:1px solid #000; text-align:right; padding-right:3px"><?php if($EtlM!=0){echo fConvertToRupiah($EtlM);} else {echo '-';}?></td>
	<td style="border-right:1px solid #000; border-top:0px solid #000; border-bottom:1px solid #000; text-align:center"><?php if($TosB!=0){echo fConvertToRupiahBulat($TosB);} else {echo '-';}?></td>
	<td style="border-right:1px solid #000; border-top:0px solid #000; border-bottom:1px solid #000; text-align:center">-</td>
	<td style="border-right:1px solid #000; border-top:0px solid #000; border-bottom:1px solid #000; text-align:right; padding-right:3px"><?php if($EtlK!=0){echo fConvertToRupiah($EtlK);} else {echo '-';}?></td>
	<td style="border-right:1px solid #000; border-top:0px solid #000; border-bottom:1px solid #000; text-align:center"><?php if($Tisa!=0){echo fConvertToRupiahBulat($Tisa);} else {echo '-';}?></td>
    <td style="border-right:1px solid #000; border-top:0px solid #000; border-bottom:1px solid #000; text-align:center">-</td>
    <td style="border-right:1px solid #000; border-top:0px solid #000; border-bottom:1px solid #000; text-align:right; padding-right:3px"><?php if($TarG!=0){echo fConvertToRupiah($TarG);} else {echo '-';}?></td>
  </tr>
</table>
