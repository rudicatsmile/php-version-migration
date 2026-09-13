<?php
require "CheckSession.php";
require "Connection.php";
require "Connection_Simkada.php";
require "FileFunction.php";
require "CheckLogin.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
if (isset($_GET['gIdT'])) {$gIdT = $_GET['gIdT'];}
//echo $gIdT;
if (isset($_GET['gUnt'])) {$gUnt = $_GET['gUnt'];}
if (isset($_GET['gNOM'])) {$gNOM = $_GET['gNOM'];}

if (isset($_GET['gBiA'])) {$gBiA = $_GET['gBiA'];}
if (isset($_GET['gBid'])) {$gBid = $_GET['gBid'];}
if (isset($_GET['gKel'])) {$gKel = $_GET['gKel'];}
if (isset($_GET['gOBJ'])) {$gOBJ = $_GET['gOBJ'];}
if (isset($_GET['gRin'])) {$gRin = $_GET['gRin'];}

$gHri = date('d');
$gBln = date('m');
$gThn = date('Y');
$gNOR = $gUnt.date('Y').".".".XXXXXX";

#echo "xxxxxxxx";
$gSPP  = "N";
if ($gIdT)
{
	$nSQ = "SELECT * FROM ta_pengadaan WHERE IDT='$gIdT'";
	#echo $nSQ;
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gUnt  = $mRo['Kd_Unit'];
		$gTGL  = $mRo['Tanggal'];
		$gTGL  = explode("-", $gTGL);
		$gHri = $gTGL[2];
		$gBln = $gTGL[1];
		$gThn = $gTGL[0];
		$gNOM = $mRo['No_Berkas'];
		$gRin = $mRo['Kd_Aset_108'];
		#echo $gRin;
		$mBiA = substr($gRin,0,5)." : ".fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset",substr($gRin,0,5),"=","",DatabaseSB,$ConSB,"");
		$mBid = substr($gRin,0,8)." : ".fGlobalNEW("Nm_Aset","ref_rek_aset108_4","Kd_Aset",substr($gRin,0,8),"=","",DatabaseSB,$ConSB,"");
		$mKel = substr($gRin,0,11)." : ".fGlobalNEW("Nm_Aset","ref_rek_aset108_5","Kd_Aset",substr($gRin,0,11),"=","",DatabaseSB,$ConSB,"");
		$mOBJ = substr($gRin,0,14)." : ".fGlobalNEW("Nm_Aset","ref_rek_aset108_6","Kd_Aset",substr($gRin,0,14),"=","",DatabaseSB,$ConSB,"");
		$mRin = $gRin." : ".$mRo['Nm_Aset_108'];
		
		$gNOR = $mRo['Nomor'];
		
		$gFak1 = $mRo['Faktur_Nomor'];
		$gFak2 = $mRo['Faktur_Tanggal'];
		$gFak3 = $mRo['Nilai'];
		
		$gUR   = $mRo['Uraian'];
		$gSPP  = $mRo['SPP'];
		$gAST  = $mRo['Aset'];
	}
}

if ($gAST=="Penambahan Nilai")
{
	$gCK1 = ""; $gCK2 = "checked";
}
else
{
	$gCK1 = "checked"; $gCK2 = "";
}

if ($gRin)
{
	$gBiA = substr($gRin,0,5);
	$gBid = substr($gRin,0,8);
	$gKel = substr($gRin,0,11);
	$gOBJ = substr($gRin,0,14);
	
	$gTmp = substr($gRin,0,5);
	
	if ($gTmp=='1.5.3')
	{
		$gTmp = "10";
		$gTmp = strtoupper(fNmHuruf((int)substr($gTmp,-2,2)));
	}
	else
	{
		if (substr($gRin,0,3)=="1.5"){
			$gTmp = "5";
		}
		$gTmp = strtoupper(fNmHuruf((int)substr($gTmp,-1,1)));
	}
	#$gTmp = strtoupper(fNmHuruf((int)substr($gTmp,-1,1)));
	
	#echo $gTmp;	
	#if ($gTmp){$rIDT = fGlobalNEW("IDT","ta_kib_".strtolower($gTmp)."_temp","No_Pengadaan",$gNOR,"=","",DatabaseSB,$ConSB,"");}
	if ($gTmp){$rIDT = fGlobalNEW("IDT","ta_kib_108_temp","No_Pengadaan",$gNOR,"=","",DatabaseSB,$ConSB,"");}
	else {$rIDT = "";}
}

if ($gNOM)
{
	$gNOM1 = $gNOM;
	$nSQ = "SELECT * FROM ta_penerimaan_berkas WHERE Nomor='$gNOM'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gTGL1 = fConvertDateLongsBln($mRo['Tanggal']);
		$gNOM2 = $mRo['No_Kontrak'];
		$gNOM3 = $mRo['No_Berita_Acara'];
		$gTGL2 = fConvertDateLongsBln($mRo['Tg_Berita_Acara']);
		$gR30  = $mRo['NomPros30'];
		$gR70  = $mRo['NomPros70'];
		$gNIL  = $mRo['Nilai'];
		$gTRM  = $mRo['Pros'];
		$gPROG = $mRo['Kd_Program']." : ".strtoupper($mRo['Nm_Program']);
		$gKEGI = $mRo['Kd_Kegiatan']." : ".strtoupper($mRo['Nm_Kegiatan']);
		$gSUBK = $mRo['Kd_SubKegiatan']." : ".strtoupper($mRo['Nm_SubKegiatan']);
		$gREKN = $mRo['Kd_Rek13']." : ".strtoupper($mRo['Nm_Rek13']);
		
		$gSMBD = $mRo['SmbDana']." : ".strtoupper(fGlobalNEW("Deskripsi","ref_sumber_dana","Kode",$mRo['SmbDana'],"=","",DatabaseSB,$ConSB,""));
		
		$CrTY = $mRo['CritBayar'];
		$CrTB = str_replace("UangMuka","Uang Muka",$mRo['CritBayar']);
		$CrTT = $mRo['CritBayar_Termin'];
		
		if ($CrTB=="Termin") {$CrTB.="-".$CrTT;}
		if ($CrTB=="Pelunasan") {$CrTB ="100% (".$CrTB.")";}
		$CrTR  = $mRo['CritBayar_MultiYears']; 
		$gPOS  = $mRo['CritBayar_PostingKe']; 
		
		if ($CrTY !="Pelunasan") {$gTmp = strtoupper(fNmHuruf(6));}
	}
}
else
{
	$gNIL = 0;
	$gN30 = 0;
	$gCrB = "";
}
$mUnt = fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",$gUnt,"=","",DatabaseSB,$ConSB,"");
//echo "<br>".$gPOS;
?>
<body>
<form name="myfrm" method="post" action="<?="Pengadaan_Mid_.php?gNOM=".$gNOM."&gIdT=".$gIdT."&gUnt=".$gUnt."&IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CritIDT">
  <table border="0" align="center" style="width:900px">
    <tr> 
      <td width="24">&nbsp;</td>
      <td width="140">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>UNIT KERJA</td>
      <td colspan="3"><input name="f01" type="text" readonly value="<?=$gUnt." : ".strtoupper($mUnt)?>" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="15">
      <td></td>
      <td></td>
      <td colspan="3"></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td colspan="4" style="font-weight:bold; font-size:11pt">DATA PENERIMAAN BERKAS :</td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>NOMOR</td>
      <td colspan="3">
	  <table border="0" width="900" cellpadding="0" style="border-collapse: collapse">
        <tr> 
          <td width="165"> 
	      <input name="fNOM1" type="text" value="<?=$gNOM1?>" readonly style="width:160px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />		  </td>
		  <td>
	      <input type="button" name="B392" value="FIND" onclick="FindBERKAS('950','500','<?=$gIdT?>')" style="width: 40px; height: 19px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />		  </td>
		</tr>
		</table>	  </td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>TANGGAL</td>
      <td colspan="3"><input name="fTGL1" type="text" value="<?=$gTGL1?>" readonly="readonly" style="width:204px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>NOMOR KONTRAK</td>
      <td colspan="3"><input name="fNOM2" type="text" value="<?=$gNOM2?>" readonly style="width:204px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>NOMOR BAST</td>
      <td colspan="3"><input name="fNOM3" type="text" value="<?=$gNOM3?>" readonly style="width:204px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>TANGGAL BAST</td>
      <td colspan="3"><input name="fTGL2" type="text" value="<?=$gTGL2?>" readonly style="width:150px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background: #FFFFCC" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>NILAI</td>
      <td colspan="3"><input name="fNIL" type="text" value="<?=fConvertToRupiah($gNIL)?>" readonly style="text-align:right; width:145px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 5px; padding-top: 1px; padding-bottom: 1px" />
        <div id="welcomeMstCri" class="finddataspp0Cri">
			<div id="welcomeDiv1Cri" class="finddataspp1Cri"></div>
			<div id="welcomeDiv2Cri" class="finddataspp2Cri"></div>
		</div>	  </td>
    </tr>
    <!--tr height="23">
      <td>&nbsp;</td>
      <td>TERMIN PEMBAYARAN</td>
      <td width="94"><input name="fTRM" type="text" value="<?=$gTRM?>" readonly style="text-align:right; width:40px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />&nbsp;%</td>
      <td width="110">
	  <?php
	  if ($gTRM=="70") {echo "LINK DATA 30% (Rp)";}
	  if ($gTRM=="100") {echo "LINK DATA 30% (Rp)";}
	  ?>	  </td>
      <td><?php if ($gTRM=="70" || $gTRM=="100") {?>
      <input name="fN30" type="text" value="<?=fConvertToRupiah($gN30)?>" readonly style="text-align:right; width:100px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <?php if ($gTRM=="100") {?>
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;70%&nbsp;(Rp)&nbsp;&nbsp;&nbsp;&nbsp;<input name="fN70" type="text" value="<?=fConvertToRupiah($gN70)?>" readonly style="text-align:right; width:100px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <?php }} ?>	  </td>
    </tr-->
    <tr height="23">
      <td>&nbsp;</td>
      <td>PEMBAYARAN</td>
      <td colspan="3">
	  <input name="fCrB" type="text" value="<?=$CrTB?>" readonly="readonly" style="text-transform: uppercase; width:150px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  &nbsp;&nbsp;&nbsp;&nbsp;PROYEK MULTIYEARS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <input name="fCrR" type="text" value="<?=str_replace("N","NO",str_replace("Y","YES",$CrTR))?>" readonly="readonly" style="width:60px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  &nbsp;&nbsp;&nbsp;&nbsp;POSTING DATA KE &nbsp;&nbsp;&nbsp;&nbsp;
	  <input name="fPOS" type="text" value="<?=strtoupper($gPOS)?>" readonly="readonly" style="width:60px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />	  </td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>PROGRAM</td>
      <td colspan="3"><input name="fPROG" type="text" value="<?=$gPROG?>" readonly="readonly" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>KEGIATAN</td>
      <td colspan="3"><input name="fKEGI" type="text" value="<?=$gKEGI?>" readonly="readonly" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>SUB KEGIATAN</td>
      <td colspan="3"><input name="fKEGI" type="text" value="<?=$gSUBK?>" readonly="readonly" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>REKENING</td>
      <td colspan="3"><input name="fREKN" type="text" value="<?=$gREKN?>" readonly="readonly" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>SUMBER DANA</td>
      <td colspan="3"><input name="fSMBD" type="text" value="<?=$gSMBD?>" readonly="readonly" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="15">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
	<!--? if ($CrTY=="Pelunasan") {?-->
    <tr height="23">
      <td>&nbsp;</td>
      <td colspan="4" style="font-weight:bold; font-size:11pt">REKENING (ASET) PERMEN-108 :</td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>JENIS</td>
      <td colspan="3">
	  <?php if ($gIdT) {?>
	  <input name="fBiaD" type="text" value="<?=$mBiA?>" readonly="readonly" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <?php } else {?>
	  <select class="boxs" name="fBiA" tabindex="0" style="width: 550px" onchange="this.form.submit()">
        <option value=""></option>
        <?php
		if ($gPOS=="KDP") {
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '1.3.6%' ORDER by Kd_Aset";
		} else {
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '1.3.1%' OR Kd_Aset LIKE '1.3.2%' OR Kd_Aset LIKE '1.3.3%' OR Kd_Aset LIKE '1.3.4%' OR Kd_Aset LIKE '1.3.5%' ORDER by Kd_Aset";
			$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE Kd_Aset LIKE '1.3.1%' OR Kd_Aset LIKE '1.3.2%' OR Kd_Aset LIKE '1.3.3%' OR Kd_Aset LIKE '1.3.4%' OR Kd_Aset LIKE '1.3.5%' OR Kd_Aset LIKE '1.5.3%' ORDER by Kd_Aset";
		}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gBiA=="") {$gBiA=$mRo['Kd_Aset'];}
			if ($gPOS=="KDP") {$gBiA="1.3.6";}
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gBiA) 
				{
				$sel ="selected";
				$gBiA=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select>
	  <?php } ?>	  </td>
    </tr>
    
    <tr height="23">
      <td>&nbsp;</td>
      <td>OBJEK</td>
      <td colspan="3">
	  <?php if ($gIdT) {?>
	  <input name="fBid" type="text" value="<?=$mBid?>" readonly="readonly" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <?php } else {?>
	  <select class="boxs" name="fBid" tabindex="0" style="width: 550px" onchange="this.form.submit()">
        <option value=""></option>
        <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '".$gBiA."%' ORDER by Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gBid=="") {$gBid=$mRo['Kd_Aset'];}
			#if ($gPOS=="KDP") {$gBid="06.20";}
			if (substr($gBid,0,5)!=$gBiA) {$gBid=$mRo['Kd_Aset'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gBid) 
				{
				$sel ="selected";
				$gBid=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select>
	  <?php } ?>	  </td>
    </tr>
    <tr height="23">

      <td>&nbsp;</td>
      <td>R.OBJEK</td>
      <td colspan="3">
	  <?php if ($gIdT) {?>
	  <input name="fKelD" type="text" value="<?=$mKel?>" readonly="readonly" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <?php } else {?>
	  <select class="boxs" name="fKel" tabindex="0" style="width: 550px" onchange="this.form.submit()">
        <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_5 where Kd_Aset LIKE '".$gBid.".%' ORDER by Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gKel=="") {$gKel=$mRo['Kd_Aset'];}
			if (substr($gKel,0,8)!=$gBid) {$gKel=$mRo['Kd_Aset'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gKel) 
				{
				$sel ="selected";
				$gKel=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select>
	  <?php } ?>	  </td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>SUB R.OBJEK</td>
      <td colspan="3">
	  <?php if ($gIdT) {?>
	  <input name="fOBJD" type="text" value="<?=$mOBJ?>" readonly="readonly" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <?php } else {?>
	  <select class="boxs" name="fOBJ" tabindex="0" style="width: 550px" onchange="this.form.submit()">
        <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_6 where Kd_Aset LIKE '".$gKel.".%' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gOBJ=="") {$gOBJ=$mRo['Kd_Aset'];}
			if (substr($gOBJ,0,11)!=$gKel) {$gOBJ=$mRo['Kd_Aset'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gOBJ) 
				{
				$sel ="selected";
				$gOBJ=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select>
	  <?php } ?>	  </td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>SUB2 R.OBJEK</td>
      <td colspan="3" valign="top">
	  <?php if ($gIdT) {?>
	  <input name="fRin" type="hidden" value="<?=$gRin?>" readonly="readonly" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <input name="fRinD" type="text" value="<?=$mRin?>" readonly="readonly" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <?php } else {?>
	  <table border="0" width="900" cellpadding="0" style="border-collapse: collapse">
      <tr> 
        <td width="500"> 
	    <select class="boxs" name="fRin" tabindex="0" style="width: 490px">
		<option value=""></option>
        <?php
		#$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset5 where Kd_Aset LIKE '".$gBid.".".substr($gKel,6,2).".".substr($gOBJ,9,2).".___' ORDER BY Kd_Aset";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_7 where Kd_Aset LIKE '".$gOBJ.".%' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gRin) {$gRin = $gRin;} else {$gRin="";}
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gRin) 
				{
				$sel ="selected";
				$gRin=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	    ?>
        </select>		</td>
	    <td>
	    <input type="button" name="B3922" value="FIND" onclick="FindRekASET('850','450')" style="width: 49px; height: 19px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />		</td>
	  </tr>
	  </table>
		<?php } ?>     </td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td valign="top">ASET</td>
      <td colspan="3" valign="top">
	  <table width="200">
	    <tr>
	     <td width="70" valign="top">
		 <label><input name="fAST" type="radio" value="Baru" <?=$gCK1?> />&nbsp;&nbsp;BARU</label></td>
		 <?php if ($gPOS=="Aset") {?>
	     <td width="135" valign="top">
		 <label><input name="fAST" type="radio" value="Penambahan Nilai" <?=$gCK2?> />&nbsp;&nbsp;PENAMBAHAN NILAI</label></td>
		 <?php } ?>
	     <td>
		 <?php if ($gIdT) {?>
			 <?php if ($gCK1=="checked") {?>
				<div style="overflow: auto; border:solid 1px; border-color: #999999; width:360px; height:150px">
				<table border="0" style="background:#FFFFFF; width:342px; border-collapse:collapse; border: 0px solid #999999; font-family:calibri; font-size:11px; font-weight:bold; color: #999999">
				<?php 
				$iGG = 1;
				$tmRo2=0;
				#$nSQ="SELECT IDT, Referensi, Nilai_Pengadaan, Keterangan FROM ta_kib_".strtolower($gTmp)."_temp WHERE No_Pengadaan='$gNOR' ORDER BY IDT";
				$nSQ="SELECT IDT, Referensi, Nilai_Pengadaan, Keterangan FROM ta_kib_108_temp WHERE No_Pengadaan='$gNOR' ORDER BY IDT";
				$nRs = mysql_query($nSQ) or die(mysql_error());
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
					$rIDT = $mRo[0];
					$eCeK = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108","Ref_Temp",$mRo[1],"=","","");
					$TnE="";
					if ($eCeK < $mRo[2]){
						$TnE="<font style='color:#0000FF'>*</font>";
					}
					else if ($eCeK > $mRo[2]){
						$TnE="<font style='color:#FF0000'>*</font>";
					}
					?>
					<tr height="19">
					<td width="26px" style="border-bottom:1px dotted"><?=$iGG?>.</td>
					<td style="border-bottom:1px dotted" title="<?=fConvertToRupiah($mRo[2]-$eCeK)?>"><?=$mRo[1].$TnE?></td>
					<td width="90px" style="border-bottom:1px dotted" align="right"><?=fConvertToRupiah($mRo[2])?></td>
					<td width="90px" align="right" style="border-bottom:1px dotted">
					<?php if ($gIdT!='' && $gRin!=''){?>
					<a href="<?="Form_Asset_".$gTmp."_Mid_Temp.php?gIdT=".$gIdT."&rIDT=".$rIDT."&IdL=".$_GET['IdL']?>" class="ico edit">edit</a>&nbsp;&nbsp;
					<a href="#" class="ico dell" onclick="P_Delete('<?=$rIDT?>'); return false">&nbsp;del</a>
					<?php } ?>
					</td>
					<td width="5px" style="border-bottom:1px dotted"></td>
					</tr>
					<?php
					$tmRo2=$tmRo2+$mRo[2];
					$iGG++;
				}
				?>
					<tr height="19">
					  <td style="border-bottom:1px dotted; text-align:right; padding-right:5px" colspan="2">TOTAL</td>
					  <td style="border-bottom:1px dotted" align="right"><?=fConvertToRupiah($tmRo2)?></td>
					  <td align="right" style="border-bottom:1px dotted"></td>
					  <td style="border-bottom:1px dotted"></td>
				  </tr>
				</table>
				</div>
				<?php if ($gIdT!='' && $gRin!=''){?>
				<a href="<?="Form_Asset_".$gTmp."_Mid_Temp.php?gIdT=".$gIdT."&IdL=".$_GET['IdL']?>" class="ico item">&nbsp;&nbsp;INPUT DETAIL DATA <?php if ($iG>1) {echo "BARU";}?></a>
				<?php } ?>
			 <?php } else {?>
					<?php if ($gIdT!='' && $gRin!=''){?>
					<a href="<?="Form_Asset_Global_Mid_Temp.php?gIdT=".$gIdT."&rIDT=".$rIDT."&IdL=".$_GET['IdL']?>" class="ico deta">&nbsp;&nbsp;PILIH DATA ASET</a>
					<?php } ?>
			 <?php } ?>
		 <?php } ?>
		 &nbsp;</td>
	    </tr>
	  </table>	  </td>
    </tr>
    <tr height="15">
      <td></td>
      <td></td>
      <td colspan="3"></td>
    </tr>
	<!--? } 
	else 
	{
		echo "<input name='fRin' type='hidden' value=''/>";
	}
	?-->
    <tr height="23">
      <td>&nbsp;</td>
      <td colspan="4" style="font-weight:bold; font-size:11pt">DATA PENGADAAN :</td>
    </tr>
    <tr height="23">

      <td>&nbsp;</td>
      <td>TANGGAL</td>
      <td colspan="3"><select name="fHri" tabindex="0" class="boxs" style="width:50px">
        <?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$gHri) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
		</select>
		&nbsp;
		<select class="boxs" name="fBln" style="width:80px">
		  <?php
				for($nBln=1; $nBln<=12; $nBln++)
				{
					$sel ="";
					if ($nBln==$gBln) {$sel ="selected";}
					echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
				}
				?>
		</select>
		&nbsp;
		<select class="boxs" name="fThn" style="width: 60px">
		  <?php
			for($nThn=1990; $nThn<=2030; $nThn++)
			{
			$sel ="";
			if ($nThn==$gThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
		</select></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>NOMOR</td>
      <td colspan="3"><input name="fNOR" type="text" value="<?=$gNOR?>" readonly="readonly" style="width:204px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>NOMOR FAKTUR</td>
      <td colspan="3"><input name="fFak1" type="text" value="<?=$gFak1?>" style="width:204px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>TANGGAL FAKTUR</td>
      <td colspan="3"><input name="fFak2" type="text" value="<?=$gFak2?>" style="width:204px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>NILAI FAKTUR</td>
      <td colspan="3">Rp.<input name="fFak3" type="text" value="<?=fConvertToRupiah($gFak3)?>" onKeyUp="addSeparator(this)" style="text-align:right; width:150px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <?php if ($gIdT!='' && $gRin!=''){?>
	  <a href="#" class="ico item" onclick="InputSmbDN('<?=$gIdT?>','<?=$gCK1?>','<?=$iGG?>','700','350'); return false;">&nbsp;&nbsp;INPUT NILAI PER SUMBER DANA</a>
	  <?php } ?>
	  </td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>URAIAN</td>
      <td colspan="3"><textarea name="fUR" rows="3" id="textarea" style="border-radius:5px; width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background: #FFFFFF"><?=$gUR ?></textarea></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">
	  <?php 
	  $EdS ="";
	  if ($gIdT!='' && $gRin==''){
		  $EdS ="disabled";
	  }
	  ?>
	  <input type="button" name="B1" value="SAVE" <?=$EdS?> onclick="P_Save('<?=$gSPP?>','<?=$CrTY?>')"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B2" value="RESET"  onclick="P_Reset()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B3" value="REFRESH"  onclick="P_Refresh()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />	  </td>
	</tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Print(w,h,pos)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		<?php
		$URL = $nFile."?gDoc=".$gDoc."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gThn2=".$gThn2."&gMLK=".$gMLK."&IdL=".$_REQUEST['IdL'];
		?>
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open('<?php echo $URL?>','',settings);
	}
	
	function P_Save(spp,CrTY)
	{
		if (spp=="Y")
		{
			//window.alert('Access denied, data sudah digunakan di SimKADA..!!'); 
			//return false;
		}
		
		if (objfrm.fNOM1.value=="")
		{
			window.alert('Silahkan pilih NOMOR BERKAS terlebih dahulu...!!');
			return false;
		}
		
		if (CrTY == "Pelunasan" && objfrm.fRin.value=="")
		{
			window.alert('Silahkan pilih REKENING ASET terlebih dahulu...!!');
			return false;
		}
		
		objfrm.Simpan.value = "Save";
		objfrm.submit();
	}

	function P_Refresh()
	{
		objfrm.Simpan.value = "Refresh";
		objfrm.submit();
	}
	
	function P_Reset()
	{
		objfrm.Simpan.value = "Reset";
		objfrm.submit();
	}
	
	function FindBERKAS(w,h,idt)
	{	
		if (idt) {window.alert('Access denied..!!'); return false;}
		var win=null;
		var txtHTML = "";
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
			win=window.open('','',settings);
			if (win!=null)
    			{
      				win.window.document.open()       			
					<?php
						$URL_Top = "Pengadaan_Mid_Top.php?gUnt=".$gUnt."&IdL=".$_GET['IdL'];
						$URL_Mid = "Pengadaan_Mid_Mid.php?gUnt=".$gUnt."&IdL=".$_GET['IdL'];
						$URL_Bot = "Pengadaan_Mid_Bot.php";
					?>       			
       			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='122,*,30' frameborder='0'><frame name='WinFindBRK_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindBRK_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindBRK_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}

	function FindRekASET(w,h)
	{	var win=null;
		var txtHTML = "";
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
			win=window.open('','',settings);
			if (win!=null)
    			{
      				win.window.document.open()       			
					<?php
						$URL_Top = "Pengadaan_Mid_Aset_Top.php?gNOM=".$gNOM."&gUnt=".$gUnt."&IdL=".$_GET['IdL'];
						$URL_Mid = "Pengadaan_Mid_Aset_Mid.php?gNOM=".$gNOM."&gUnt=".$gUnt."&IdL=".$_GET['IdL'];
						$URL_Bot = "Pengadaan_Mid_Aset_Bot.php";
					?>       			
       			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}
	
	function P_Mess(xG)
	{
		alert(xG);
	}
	
	function P_Delete(rIDT)
	{
		var AN = confirm("Delete record..?!!");
		if (AN)
		{
			objfrm.CritIDT.value = rIDT;
			objfrm.Simpan.value = "Delete";
			objfrm.submit();
		}
	}
	
	function InputSmbDN(idt,gck,igg,w,h)
	{
		if (!idt) {window.alert('Silahkan simpan data telebih dahulu..!!'); return false;}
		if ((gck=="checked") && (parseInt(igg)<2)) {window.alert('Silahkan isi data rincian Aset atau KDP telebih dahulu..!!'); return false;}
		
		var win=null;
		var txtHTML = "";
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
			win=window.open('','',settings);
			if (win!=null)
    			{
      				win.window.document.open()       			
					<?php
						$URL_Top = "Pengadaan_Mid_Dana_Top.php?FrmG=INPUT PER SUMBER DANA&IdL=".$_GET['IdL'];
						$URL_Mid = "Pengadaan_Mid_Dana_Mid.php?gNOR=".$gNOR."&IdL=".$_GET['IdL'];
						$URL_Bot = "Pengadaan_Mid_Dana_Bot.php";
					?>       			
       			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}
</script>
<?php
require "FileFormatNum.php";
?>