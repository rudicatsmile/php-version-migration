<?
require('Connection.php');
require('FileFunction.php');
require('CheckLogin.php');
extract($_GET);

function fNmDesk($nX)
{
	$Nm= array ('','Kode sub kegiatan','Uraian sub kegiatan',' 	Kode belanja','Uraian belanja','Kode barang','Nama barang','Spesifikasi nama barang','Tgl, Bulan, Tahun Perolehan','Jumlah Barang','Harga Satuan Barang','Biaya Atribusi');
	return $Nm[$nX];
}

###########
$NoM = fGlobal("Nomor","ta_pengadaan","IDT",$IdT,"=","","");
$KdU = fGlobal("Kd_Unit","ta_pengadaan","IDT",$IdT,"=","","");
$NoB = fGlobal("No_Berkas","ta_pengadaan","IDT",$IdT,"=","","");
$NiL = fGlobal("Nilai","ta_pengadaan","IDT",$IdT,"=","","");
$KdSB = fGlobal("Kd_SubKegiatan","ta_pengadaan","IDT",$IdT,"=","","");
$NmSB = fGlobal("Nm_SubKegiatan","ta_pengadaan","IDT",$IdT,"=","","");
$KdBL = fGlobal("Kd_Rek13","ta_pengadaan","IDT",$IdT,"=","","");
$NmBL = fGlobal("Nm_Rek13","ta_pengadaan","IDT",$IdT,"=","","");

$TgP = fGlobal("Tg_Berita_Acara","ta_penerimaan_berkas","Nomor",$NoB,"=","","");
if ($TgP!='')
{
	$TgP = explode('-',$TgP);
	$TgP = $TgP[2]."/".$TgP[1]."/".$TgP[0];
}

$TgKN = fGlobal("Tg_Kontrak","ta_penerimaan_berkas","Nomor",$NoB,"=","","");
$NoKN = fGlobal("No_Kontrak","ta_penerimaan_berkas","Nomor",$NoB,"=","","");

$DtA = fGlobal("Nm_Unit:Nma_Pimpinan:Nip_Pimpinan:Jab_Pimpinan:Pkt_Pimpinan:Nm_Pengurus:Nip_Pengurus:Pkt_Pengurus:Jbt_Pengurus:Nm_Penyimpan:Nip_Penyimpan:Pkt_Penyimpan:Jbt_Penyimpan","ref_unit","Kd_Unit",$KdU,"=","","");
$DtA = explode(':',$DtA);
$NmaSkp = $DtA[0];
$NmaPim = $DtA[1];
$NipPim = $DtA[2];
$JabPim = $DtA[3];
$PktPim = $DtA[4];

$NmPeng = $DtA[5];
$NiPeng = $DtA[6];
$PkPeng = $DtA[7];
$JbPeng = $DtA[8];

$NmPeny = $DtA[9];
$NpPeny = $DtA[10];
$PkPeny = $DtA[11];
$JbPeny = $DtA[12];

$ThN = fGetDate("year");

$Max = fGlobal("max(NomPernyataan)","ta_pengadaan_pernyataan","NomPernyataan","%/SP/".$KdU."/".$ThN,"LIKE","","");	

$Cek = fGlobal("IDT","ta_pengadaan_pernyataan","nomor",$NoM,"=","","");	
if ($Cek=='')
{
	$NoSP = "1/SP/".$KdU."/".$ThN;
	$Max = fGlobal("max(NomPernyataan)","ta_pengadaan_pernyataan","NomPernyataan","%/SP/".$KdU."/".$ThN,"LIKE","","");	
	if ($Max!='')
	{
		$Max = explode('/',$Max);
		$NoSP = $Max[0]+1;
		$NoSP = $NoSP."/SP/".$KdU."/".$ThN;
	}
	
	$SQ="INSERT INTO ta_pengadaan_pernyataan SET 
	Nomor='".$NoM."',
	TglPernyataan=now(),
	NomPernyataan='".$NoSP."',
	NmaPenandatangan='".$NmPeng."',
	NipPenandatangan='".$NiPeng."',
	PktPenandatangan='".$PkPeng."',
	JabPenandatangan='".$JbPeng."',
	Selaku='".$JbPeng."',
	Pada='".$NmaSkp."',
	NmaMengetahui='".$NmaPim."',
	NipMengetahui='".$NipPim."',
	PktMengetahui='".$PktPim."',
	JabMengetahui='".$JabPim."',
	
	BntKontrak='-',
	PnyKontrak='-',
	TglKontrak='".$TgKN."',
	NomKontrak='".$NoKN."',
	Recorded=now(),
	Pencatat='".$UID."'";
	mysql_query($SQ);
}

$DtA = fGlobal("TglPernyataan:NomPernyataan:NmaPenandatangan:NipPenandatangan:PktPenandatangan:JabPenandatangan:Selaku:Pada:NmaMengetahui:NipMengetahui:PktMengetahui:JabMengetahui:BntKontrak:PnyKontrak:NomKontrak:TglKontrak","ta_pengadaan_pernyataan","nomor",$NoM,"=","","");	
$DtA = explode(':',$DtA);
$TglP = explode('-',$DtA[0]);
$TglP = $TglP[2]."/".$TglP[1]."/".$TglP[0];
$NomP = $DtA[1];
$NmaP = $DtA[2];
$NipP = $DtA[3];
$PktP = $DtA[4];
$JabP = $DtA[5];
$Sela = $DtA[6];
$Pada = $DtA[7];
$NmaM = $DtA[8];
$NipM = $DtA[9];
$PktM = $DtA[10];
$JabM = $DtA[11];

$BntK = $DtA[12];
$PnyK = $DtA[13];
$NomK = $DtA[14];
$TglK = explode('-',$DtA[15]);
$TglK = $TglK[2]."/".$TglK[1]."/".$TglK[0];

########################

$DtA = fGlobal("TglVerifikasi:JbtVerifikator:NmaVerifikator:NipVerifikator","ta_pengadaan_verifikator","nomor",$NoM,"=","","");	
$DtA = explode(":",$DtA);

$fVrTg = explode("-",$DtA [0]);
$fVrTg = $fVrTg[2]."/".$fVrTg[1]."/".$fVrTg[0];

$fVrJb = $DtA [1];
$fVrNm = $DtA [2];
$fVrNi = $DtA [3];

?>
<table align="center" border="0" width="1000" cellspacing="0" cellpadding="0" style="border-collapse:collapse; font-family:calibri; font-size:10pt">
  <tr>
    <td width="161">&nbsp;</td>
    <td width="134">&nbsp;</td>
    <td width="23">&nbsp;</td>
    <td width="381">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Nomor</td>
    <td>:</td>
    <td><input type="text" name="fKt12" id="fKt12" value="<?=$NomP?>" readonly style="width:240px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td>Tanggal</td>
    <td>:</td>
    <td><input type="text" name="fVrTg" id="fVrTg" value="<?=$TglP?>" onkeypress="if (event.keyCode==13){saveRecordPern('TglPernyataan',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:80px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td colspan="3" style="font-weight:bold; text-decoration:underline">PENANDATANGAN</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:11px"><li>Nama</td>
    <td>:</td>
    <td><input type="text" name="fKt122" id="fKt122" value="<?=$NmaP?>" onkeypress="if (event.keyCode==13){saveRecordPern('NmaPenandatangan',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:11px"><li>NIP</td>
    <td>:</td>
    <td><input type="text" name="fKt123" id="fKt123" value="<?=$NipP?>" onkeypress="if (event.keyCode==13){saveRecordPern('NipPenandatangan',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:11px"><li>Pangkat/Gol</td>
    <td>:</td>
    <td><input type="text" name="fKt124" id="fKt124" value="<?=$PktP?>" onkeypress="if (event.keyCode==13){saveRecordPern('PktPenandatangan',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:11px"><li>Jabatan</td>
    <td>:</td>
    <td><input type="text" name="fKt125" id="fKt125" value="<?=$JabP?>" onkeypress="if (event.keyCode==13){saveRecordPern('JabPenandatangan',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:11px"><li>Selaku</td>
    <td>:</td>
    <td><input type="text" name="fKt126" id="fKt126" value="<?=$Sela?>" onkeypress="if (event.keyCode==13){saveRecordPern('Selaku',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:11px"><li>Pada</td>
    <td>:</td>
    <td><input type="text" name="fKt127" id="fKt127" value="<?=$Pada?>" onkeypress="if (event.keyCode==13){saveRecordPern('Pada',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:400px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td colspan="3" style="font-weight:bold; text-decoration:underline">PERNYATAAN</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:11px"><li>Kode sub Kegiatan</td>
    <td>:</td>
    <td><input type="text" name="fKt128" id="fKt128" value="<?=$KdSB?>" readonly style="width:400px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:11px"><li>Nama sub kegiatan</td>
    <td>:</td>
    <td><input type="text" name="fKt1282" id="fKt1282" value="<?=$NmSB?>" readonly style="width:400px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:11px"><li>Kode belanja</td>
    <td>:</td>
    <td><input type="text" name="fKt1283" id="fKt1283" value="<?=$KdBL?>" readonly style="width:400px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:11px"><li>Uraian belanja</td>
    <td>:</td>
    <td><input type="text" name="fKt1283" id="fKt1283" value="<?=$NmBL?>" readonly style="width:400px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:11px"><li>Bentuk Kontrak</td>
    <td>:</td>
    <td><input type="text" name="fKt1284" id="fKt1284" value="<?=$BntK?>" onkeypress="if (event.keyCode==13){saveRecordPern('BntKontrak',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:400px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:12px">a. Nama penyedia</td>
    <td>:</td>
    <td><input type="text" name="fKt12842" id="fKt12842" value="<?=$PnyK?>" onkeypress="if (event.keyCode==13){saveRecordPern('PnyKontrak',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:400px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:12px">b. Nomor</td>
    <td>:</td>
    <td><input type="text" name="fKt1272" id="fKt1272" value="<?=$NomK?>" onkeypress="if (event.keyCode==13){saveRecordPern('NomKontrak',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:12px">c. Tanggal</td>
    <td>:</td>
    <td><input type="text" name="fVrTg2" id="fVrTg2" value="<?=$TglK?>" onkeypress="if (event.keyCode==13){saveRecordPern('TglKontrak',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:80px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td style="padding-left:11px">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:11px"><li>Tanggal Perolehan</td>
    <td>:</td>
    <td><input type="text" name="fVrTg22" id="fVrTg22" value="<?=$TgP?>" readonly style="width:80px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:11px"><li>Nilai (Rp.)</td>
    <td>:</td>
    <td><input type="text" name="fKt12722" id="fKt12722" value="<?=fConvertToRupiahBulat($NiL)?>" readonly style="width:100px" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td colspan="3" style="font-weight:bold; text-decoration:underline"> MENGETAHUI </td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:11px"><li>Nama</td>
    <td>:</td>
    <td><input type="text" name="fKt1222" id="fKt1222" value="<?=$NmaM?>" onkeypress="if (event.keyCode==13){saveRecordPern('NmaMengetahui',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:11px"><li>NIP</td>
    <td>:</td>
    <td><input type="text" name="fKt1223" id="fKt1223" value="<?=$NipM?>" onkeypress="if (event.keyCode==13){saveRecordPern('NipMengetahui',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:11px"><li>Pangkat/Gol</td>
    <td>:</td>
    <td><input type="text" name="fKt1224" id="fKt1224" value="<?=$PktM?>" onkeypress="if (event.keyCode==13){saveRecordPern('PktMengetahui',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px; background:#fff" /></td>
    <td>&nbsp;</td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td style="padding-left:11px"><li>Jabatan</td>
    <td>:</td>
    <td><input type="text" name="fKt1225" id="fKt1225" value="<?=$JabM?>" onkeypress="if (event.keyCode==13){saveRecordPern('JabMengetahui',this,'<?=$NoM?>','<?=$IdT?>','<?=$IdL?>');}" style="width:240px; background:#fff" /></td>
    <td><a href="#" onClick="formCetakDok('Format_II_A_11.2','<?=$IdT?>','800','400','<?=$IdL?>'); return false" class="ico docu">&nbsp;&nbsp;Format II.A.11.2</a></td>
  </tr>
  <tr height="24">
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
