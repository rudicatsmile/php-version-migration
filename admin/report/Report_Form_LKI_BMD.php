<?php
require('../Connection.php');
require('../FileFunction.php');
extract($_GET);

$nSQ = "SELECT 
KdUPB as A0,
Referensi as A1,
KdBarang as A2,
NmBarang as A3,
NmBarang_Spec as A4,
KdRegister as A5,
Merk as A6,
Type as A7,
NoPolisi as A8,
NoRangka as A9,
NoMesin as A10,
JmlBarang as A11,
SatuanBarang as A12,
HargaSatuan as A13,
NilaiPerolehan as A14,
TglPerolehan as A15,
Alamat as A16,
DasarPencatatan as A17,
KondisiBarang as A18,
Lainnya as A19,
Keterangan as A20,
TanggalSensus as A21,

PetugasSensus_1 as A22,
PetugasSensus_2 as A23,
PetugasSensus_3 as A24,
PetugasSensus_4 as A25,
PetugasSensus_ttd as A26,
DataSensusFix as A267 

FROM tb_lembar_kerja_belum_tercatat WHERE IDT='".$IdT."'";
#echo $nSQ;
$nRs = mysql_query($nSQ) or die(mysql_error());
$mRo = mysql_fetch_array($nRs, MYSQL_BOTH);

$frmKUPB = $mRo[0];
$frmRefe = $mRo[1];
$frmKode = $mRo[2];
$frmNama = $mRo[3];
$frmSpec = $mRo[4];
$frmRegi = $mRo[5];
$frmMerk = $mRo[6];
$frmType = $mRo[7];
$frmNopo = $mRo[8];
$frmNora = $mRo[9];
$frmNome = $mRo[10];

$frmJumb = $mRo[11];
$frmSatu = $mRo[12];
$frmHarg = fConvertToRupiah($mRo[13]);
$frmNila = fConvertToRupiah($mRo[14]);

$mRo15 = $mRo[15];
$mRo15 = explode('-',$mRo15);
$frmTahu = $mRo15[0];
$frmBula = $mRo15[1];
$frmHari = $mRo15[2];

$frmAlam =  $mRo[16];
$frmDasa =  $mRo[17];

$CkKon1 = ""; 
$CkKon2 = ""; 
$CkKon3 = ""; 

if ($mRo[18]=='B') {
	$CkKon1 = "checked";
}
elseif ($mRo[18]=='RR') {
	$CkKon2 = "checked";
}
else {
	$CkKon3 = "checked";
}

$frmLain =  $mRo[19];
$frmKetr =  $mRo[20];

$gTG = $mRo[21];
$gTG = explode('-',$gTG);
$gTH = $gTG[0];
$gBL = $gTG[1];
$gHR = $gTG[2];

#$Petugas1 = fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$mRo[22],"=","","");
#$Petugas2 = fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$mRo[23],"=","","");
#$Petugas3 = fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$mRo[24],"=","","");
#$Petugas4 = fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$mRo[25],"=","","");
#$Petugas5 = fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$mRo[26],"=","","");

$Petugas = fGlobal("NmPetugas","tb_lembar_kerja_petugas","IdPetugas",$mRo[26],"=","","");
$Nipetug = fGlobal("NiPetugas","tb_lembar_kerja_petugas","IdPetugas",$mRo[26],"=","","");
?>
<table align="center" cellpadding="0" class="table-form" cellspacing="0" border="0" style="width:800px; border:1px solid #000; font-family:calibri;">
	<tr height="20">
	  <td width="10" style="border-bottom:1px solid #000">&nbsp;</td>
	  <td width="684" style="border-bottom:1px solid #000">
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
          <td>&nbsp;</td>
          <td width="100">Format : III.A.7</td>
        </tr>
      </table>	  </td>
	</tr>
	<tr style="text-align:center; font-weight:bold; font-size:11pt">
	  <td>&nbsp;</td>
		<td>LEMBAR KERJA INVENTARISASI (LKI)</td>
	</tr>
	<tr style="text-align:center; font-weight:bold; font-size:11pt">
	  <td>&nbsp;</td>
		<td>BMD BELUM TERCATAT</td>
	</tr>
	<tr style="text-align:center; font-weight:bold; font-size:11pt">
	  <td>&nbsp;</td>
		<td><?=$TiDaer." ".$NmDaer?></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>
	  <table align="center" cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr height="24">
          <td width="144">Kuasa Pengguna Barang</td>
          <td width="20">:</td>
          <td><?=$fKPB?></td>
        </tr>
        <tr height="24">
          <td>Pengguna Barang</td>
          <td>:</td>
          <td><?=fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit",substr($mRo[8],0,11),"=","","")?></td>
        </tr>
        <tr height="24">
          <td>Pengelola Barang</td>
          <td>:</td>
          <td><?=fGlobal("Nma_Pimpinan","ref_unit","Kd_Unit","24.04.04.01","=","","")?></td>
        </tr>
      </table>	  </td>
  </tr>
	<tr height="10">
	  <td></td>
	  <td></td>
	</tr>
	<tr>
	  <td style="border-top:1px solid #000">&nbsp;</td>
	  <td style="border-top:1px solid #000">&nbsp;</td>
  </tr>
	<tr>
	  <td style="border-top:0px solid #000">&nbsp;</td>
		<td style="border-top:0px solid #000">
		<!--#############-->
		  <table border="0" width="800" cellspacing="0" cellpadding="0" align="center">
		  <tr>
			<td width="164">&nbsp;</td>
			<td width="32">&nbsp;</td>
			<td colspan="3">
			<div id="loadMstCri" class="loadRekn0Cri">
				<div id="loadDiv1Cri" class="loadRekn1Cri"></div>
				<div id="loadDiv2Cri" class="loadRekn2Cri"></div>
			</div>	</td>
			</tr>
		  <tr height="24">
			<td align="right">Referensi</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmRefe?></td>
			</tr>
		  <tr height="24">
			<td align="right">Kode Barang</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmKode?></td>
			</tr>
		  <tr height="24">
			<td align="right">Nama Barang</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmNama?></td>
			</tr>
		  <tr height="24">
			<td align="right">Nama Spesifikasi Barang</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmSpec?></td>
			</tr>
		  <tr height="24">
			<td align="right">Kode Register</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmRegi?></td>
			</tr>
		  <tr height="24">
			<td align="right">Merk</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmMerk?></td>
			</tr>
		  <tr height="24">
			<td align="right">Tipe</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmType?></td>
			</tr>
		  <tr height="24">
			<td align="right">Nomor Polisi</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmNopo?></td>
			</tr>
		  <tr height="24">
			<td align="right">Nomor Rangka</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmNora?></td>
			</tr>
		  <tr height="24">
			<td align="right">Nomor Mesin</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmNome?></td>
			</tr>
		  <tr height="24">
			<td align="right">Jumlah</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmJumb?></td>
			</tr>
		  <tr height="24">
			<td align="right">Satuan Barang</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmSatu?></td>
			</tr>
		  <tr height="24">
			<td align="right">Harga Satuan Barang</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmHarg?></td>
			</tr>
		  <tr height="24">
			<td align="right">Nilai Perolehan Barang</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmNila?></td>
			</tr>
		  <tr height="24">
			<td align="right">Tanggal Perolehan</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmHari."-".$frmBula."-".$frmTahu?></td>
			</tr>
		  <tr height="24">
			<td align="right">Alamat</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmAlam?></td>
			</tr>
		  <tr height="24">
			<td align="right">Dasar Pencatatan</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmDasa?></td>
			</tr>
		  <tr height="24">
			<td align="right">Kondisi Barang</td>
			<td align="center">:</td>
			<td width="115"><?=TChek($CkKon1,'Baik (B)','130')?></td>
			<td width="131"><?=TChek($CkKon2,'Rusak Ringan (RR)','130')?></td>
			<td><?=TChek($CkKon3,'Rusak Berat (RB)','130')?></td>
			</tr>
		  <tr height="24">
			<td align="right">Lainnya</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmLain?></td>
			</tr>
		  <tr height="24">
			<td align="right">Keterangan</td>
			<td align="center">:</td>
			<td colspan="3"><?=$frmKetr?></td>
			</tr>
		  <tr height="24">
			<td align="right">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td colspan="3">&nbsp;</td>
			</tr>
		  <tr height="24">
		    <td align="right">&nbsp;</td>
		    <td align="center">&nbsp;</td>
		    <td colspan="3">&nbsp;</td>
		    </tr>
		  <tr height="24">
		    <td align="right">&nbsp;</td>
		    <td align="center">&nbsp;</td>
		    <td colspan="3">&nbsp;</td>
		    </tr>
  		</table>
		  <table border="0" width="800" cellspacing="0" cellpadding="0" align="center">
		  <tr height="20">
			<td width="300" style="text-align:center">&nbsp;</td>
			<td>&nbsp;</td>
			<td width="300" style="text-align:center"><?=$NmIbuk?>,&nbsp;&nbsp;&nbsp;<?=fConvertDateLongsBln($gTH."-".$gBL."-".$gHR)?></td>
		  </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td style="text-align:center">Petugas Inventarisasi</td>
		  </tr>
		  <tr height="60">
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		  </tr>
		  <tr height="20">
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td align="center" style="text-decoration:underline; font-weight:bold"><?=$Petugas?></td>
		  </tr>
		  <tr height="20">
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td align="center">NIP. <?=$Nipetug?></td>
		  </tr>
		  <tr>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    </tr>
		</table>
		<!--#############-->
		</td>
	</tr>

	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
</table>

