<?php
require "CheckSession.php";
require "Connection.php";
#require "Connection_Simkada.php";
require "FileFunction.php";
require "CheckLogin.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>SimB@DA</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="global.js"></script>
</head>
<?php
extract($_GET);
#echo $gTRMt;
if (isset($_GET['gIdT'])) {$gIdT = $_GET['gIdT'];}
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
$gFak3 = 0;
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
		
		$gReJK = substr($gRin,0,5);
		$gReJD = fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset",substr($gRin,0,5),"=","",DatabaseSB,$ConSB,"");
			
		$gReOK = substr($gRin,0,8);
		$gReOD = fGlobalNEW("Nm_Aset","ref_rek_aset108_4","Kd_Aset",substr($gRin,0,8),"=","",DatabaseSB,$ConSB,"");
			
		$gReRK = substr($gRin,0,11);
		$gReRD = fGlobalNEW("Nm_Aset","ref_rek_aset108_5","Kd_Aset",substr($gRin,0,11),"=","",DatabaseSB,$ConSB,"");
			
		$gReSK = substr($gRin,0,14);
		$gReSD = fGlobalNEW("Nm_Aset","ref_rek_aset108_6","Kd_Aset",substr($gRin,0,14),"=","",DatabaseSB,$ConSB,"");
		
		$gReXK = $gRin;
		$gReXD = $mRo['Nm_Aset_108'];
		$gREKN = $mRo['Kd_Rek13']." : ".strtoupper($mRo['Nm_Rek13']);
		
		
		$gNOR = $mRo['Nomor'];
		
		$gFak1 = $mRo['Faktur_Nomor'];
		$gFak2 = $mRo['Faktur_Tanggal'];
		$gFak3 = $mRo['Nilai'];
		
		$gNOMB = $mRo['No_Berita_Acara'];
		$gTGLB = $mRo['Tg_Berita_Acara'];
		$gTGLB = explode("-",$gTGLB);
		$gHriB = $gTGLB[2];
		$gBlnB = $gTGLB[1];
		$gThnB = $gTGLB[0];
		
		$fUR   = $mRo['Uraian'];
		$gSPP  = $mRo['SPP'];
		
		$CrTY = $mRo['CritBayar']; 
		$CrTB = str_replace("UangMuka","Uang Muka",$mRo['CritBayar']);
		
		$fCrT = $mRo['CritBayar_Termin'];
		
		if ($CrTB=="Termin") {$CrTB.="-".$fCrT;}
		if ($CrTB=="Pelunasan") {$CrTB ="100% (".$CrTB.")";}
		#$CrTR  = $mRo['CritBayar_MultiYears']; 
		$fPOS  = $mRo['CritBayar_PostingKe']; 
		if ($CrTY !="Pelunasan") {$gTmp = strtoupper(fNmHuruf(6));}
		$gCrM  = $mRo['CritBayar_MultiYears']; 
	}
}

if ($gCrT!=''){$fCrT=$gCrT;}
if ($gUR!=''){$fUR=$gUR;}

if ($gCrM!=''){$fCrM=$gCrM;}

if ($fCrM=="Y") {
	$gM1="";
	$gM2="checked";
} else {
	$gM1="checked";
	$gM2="";
}

if ($gPOS!=''){$fPOS=$gPOS;}

if ($fPOS=="KDP") {
	$gA1="";
	$gA2="checked";
} else {
	$gA1="checked";
	$gA2="";
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
	
	if ($gTmp){
		$rIDT = fGlobalNEW("IDT","ta_kib_108_temp","No_Pengadaan",$gNOR,"=","",DatabaseSB,$ConSB,"");
	}
	else {
		$rIDT = "";
	}
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
		$gNOMK = $mRo['No_Kontrak'];
		$gTGLK = $mRo['Tg_Kontrak'];
		$gNOM3 = $mRo['No_Berita_Acara'];
		$gTGL2 = fConvertDateLongsBln($mRo['Tg_Berita_Acara']);
		#$gTGLB = $mRo['Tg_Berita_Acara'];
		#$gTGLB = explode("-",$gTGLB);
		#$gHriB = $gTGLB[2];
		#$gBlnB = $gTGLB[1];
		#$gThnB = $gTGLB[0];
		$gITM  = $mRo['JmlItem'];
		if ($gFak3==0){$gFak3=$mRo['Nilai'];}
		$gR30  = $mRo['NomPros30'];
		$gR70  = $mRo['NomPros70'];
		$gNIL  = $mRo['Nilai'];
		$gTRM  = $mRo['Pros'];
		$gPROG = $mRo['Kd_Program']." : ".strtoupper($mRo['Nm_Program']);
		$gKEGI = $mRo['Kd_Kegiatan']." : ".strtoupper($mRo['Nm_Kegiatan']);
		$gSUBK = $mRo['Kd_SubKegiatan']." : ".strtoupper($mRo['Nm_SubKegiatan']);
		$gREKN = $mRo['Kd_Rek13']." : ".strtoupper($mRo['Nm_Rek13']);
		
		$gSMBD = $mRo['SmbDana']." : ".strtoupper(fGlobalNEW("Deskripsi","ref_sumber_dana","Kode",$mRo['SmbDana'],"=","",DatabaseSB,$ConSB,""));
		
		$gUT   = $mRo['Peruntukan'];
		$gVenK = $mRo['IdRekanan'];
		$gVenD = fGlobalNEW("Nma_Perusahaan","ta_rekanan","Kode",$gVenK,"=","",DatabaseSB,$ConSB,"");
		
		#$CrTY = $mRo['CritBayar'];
		#$CrTY = $mRo['CritBayar']; 
		#$CrTB = str_replace("UangMuka","Uang Muka",$mRo['CritBayar']);
		#$fCrT = $mRo['CritBayar_Termin'];
		
		#if ($CrTB=="Termin") {$CrTB.="-".$fCrT;}
		#if ($CrTB=="Pelunasan") {$CrTB ="100% (".$CrTB.")";}
		#$CrTR  = $mRo['CritBayar_MultiYears']; 
		#$fPOS  = $mRo['CritBayar_PostingKe']; 
		
		#if ($CrTY !="Pelunasan") {$gTmp = strtoupper(fNmHuruf(6));}
		
		
	}
}
else
{
	$gNIL = 0;
	$gN30 = 0;
	$CrTY = "";
}

$mUnt = fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",$gUnt,"=","",DatabaseSB,$ConSB,"");

if ($gTRMt!=''){$CrTY=$gTRMt;}

if ($CrTY == "Perencanaan")
{
	$gC1="checked";
	$gC2="";
	$gC3="";
	$gC4="";
	$gC5="";
}
elseif ($CrTY == "UangMuka")
{
	$gC1="";
	$gC2="checked";
	$gC3="";
	$gC4="";
	$gC5="";
}
elseif ($CrTY == "Termin")
{
	$gC1="";
	$gC2="";
	$gC3="checked";
	$gC4="";
	$gC5="";
}
elseif ($CrTY == "Pengawasan")
{
	$gC1="";
	$gC2="";
	$gC3="";
	$gC4="";
	$gC5="checked";
}
else
{
	$gC1="";
	$gC2="";
	$gC3="";
	$gC4="checked";
	$gC5="";
}
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
    <tr height="20">
      <td>&nbsp;</td>
      <td>PERUNTUKAN</td>
      <td colspan="3">
	  <input name="fUK" id="fUK" type="text" readonly value="<?php if ($gUT) {echo $gUT." : ".fGlobalNEW("nm_upb","ref_upb","kd_upb",$gUT,"=","",DatabaseSB,$ConSB,"");} else {echo "NONE";}?>" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <input name="fUT" id="fUT" type="hidden" value="<?=$gUT?>" style="width:100px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  </td>
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
      <td>Nomor</td>
      <td colspan="3">
	  <table border="0" width="900" cellpadding="0" style="border-collapse: collapse">
        <tr> 
          <td width="165"> 
	      <input name="fNOM1" type="text" value="<?=$gNOM1?>" readonly style="width:160px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />		  </td>
		  <td>
	      <input type="button" name="B392" value="FIND" onclick="FindBERKAS('1070','580','<?=$gIdT?>')" style="width:42px; height:19px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />		  </td>
		</tr>
		</table>	  </td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>Tanggal</td>
      <td colspan="3"><input name="fTGL1" type="text" value="<?=$gTGL1?>" readonly="readonly" style="width:204px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>Nomor Kontrak</td>
      <td colspan="3"><input name="fNOM2" type="text" value="<?=$gNOMK?>" readonly style="width:204px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>Tanggal Kontrak</td>
      <td colspan="3"><input name="fTGLK" type="text" value="<?=$gTGLK?>" readonly="readonly" style="width:204px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>Vendor / Rekanan </td>
      <td colspan="3">
	  <input name="fVenK" id="fVenK" type="hidden" value="<?=$gVenK?>" onclick="showREKA_xx('','<?=$gIdT?>','<?=$_GET['IdL']?>'); return false;" style="width:40px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <input name="fVenD" id="fVenD" type="text" value="<?=$gVenD?>" readonly style="width:354px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />	  </td>
    </tr>
    <!--tr height="23">
      <td>&nbsp;</td>
      <td>NOMOR BAST</td>
      <td colspan="3"><input name="fNOM3" type="text" value="<?=$gNOM3?>" readonly style="width:204px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>TANGGAL BAST</td>
      <td colspan="3"><input name="fTGL2" type="text" value="<?=$gTGL2?>" readonly style="width:150px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background: #FFFFCC" /></td>
    </tr-->
    <tr height="23">
      <td>&nbsp;</td>
      <td>Nilai</td>
      <td colspan="3"><input name="fNIL" type="text" value="<?=fConvertToRupiah($gNIL)?>" readonly style="text-align:right; width:125px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 5px; padding-top: 1px; padding-bottom: 1px" />
        <!--div id="welcomeMstCri" class="finddataspp0Cri">
			<div id="welcomeDiv1Cri" class="finddataspp1Cri"></div>
			<div id="welcomeDiv2Cri" class="finddataspp2Cri"></div>
		</div-->      </td>
    </tr>
    <!--tr height="23">
      <td>&nbsp;</td>
      <td>PEMBAYARAN</td>
      <td colspan="3">
	  <input name="fCrB" type="text" value="<?=$CrTB?>" readonly="readonly" style="text-transform: uppercase; width:150px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  &nbsp;&nbsp;&nbsp;&nbsp;PROYEK MULTIYEARS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <input name="fCrR" type="text" value="<?=str_replace("N","NO",str_replace("Y","YES",$CrTR))?>" readonly="readonly" style="width:60px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  &nbsp;&nbsp;&nbsp;&nbsp;POSTING DATA KE &nbsp;&nbsp;&nbsp;&nbsp;
	  <input name="fPOS" type="text" value="<?=strtoupper($fPOS)?>" readonly="readonly" style="width:60px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />	  </td>
    </tr-->
    <tr height="23">
      <td>&nbsp;</td>
      <td>Program</td>
      <td colspan="3"><input name="fPROG" type="text" value="<?=$gPROG?>" readonly="readonly" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>Kegiatan</td>
      <td colspan="3"><input name="fKEGI" type="text" value="<?=$gKEGI?>" readonly="readonly" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>Sub Kegiatan</td>
      <td colspan="3"><input name="fSUBK" type="text" value="<?=$gSUBK?>" readonly="readonly" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>Rekening</td>
      <td colspan="3"><input name="fREKN" type="text" value="<?=$gREKN?>" readonly="readonly" style="width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>Sumber Dana</td>
      <td colspan="3"><input name="fSMBD" type="text" value="<?=$gSMBD?>" readonly="readonly" style="width:250px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="15">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
	<!--###########-->
	<tr height="23">
      <td>&nbsp;</td>
      <td colspan="4" style="font-weight:bold; font-size:11pt">DATA PENGADAAN :</td>
    </tr>
    <tr height="23">

      <td>&nbsp;</td>
      <td>Tanggal</td>
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
		</select>
	<!--div id="alayMstCri" class="data0Reko">
		<div id="alayDiv1Cri" class="data1Reko"></div>
		<div id="alayDiv2Cri" class="data2Reko"></div>
	</div-->	  </td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>Nomor</td>
      <td colspan="3"><input name="fNOR" id="fNOR" type="text" value="<?=$gNOR?>" readonly="readonly" style="width:204px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>Nomor BAST </td>
      <td colspan="3"><input name="fNOM3" id="fNOM3" type="text" value="<?=$gNOMB?>" style="width:204px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background: #FFFFFF" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>Tanggal BAST </td>
      <td colspan="3">
		<select name="fHriB" id="fHriB" tabindex="0" class="boxs" style="width:50px">
		<option value="00"></option>
		<?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$gHriB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
        </select>&nbsp;
		<select class="boxs" name="fBlnB" id="fBlnB" style="width:87px">
		<option value="00"></option>
		<?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$gBlnB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
        </select>&nbsp;
		<select class="boxs" name="fThnB" id="fThnB" style="width: 60px">
		<option value="0000"></option>
		<?php
		for($nThn=2021; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$gThnB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>	  </td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>Nomor Faktur</td>
      <td colspan="3"><input name="fFak1" type="text" value="<?=$gFak1?>" style="width:204px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>Tanggal Faktur </td>
      <td colspan="3"><input name="fFak2" type="text" value="<?=$gFak2?>" style="width:204px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>Nilai Faktur (Rp.)</td>
      <td colspan="3"><input name="fFak3" type="text" value="<?=fConvertToRupiah($gFak3)?>" onKeyUp="addSeparator(this)" style="text-align:right; width:130px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <?php if ($gIdT!='' && $gRin!=''){?>
	  <a href="#" class="ico item" onclick="InputSmbDN('<?=$gIdT?>','<?=$gCK1?>','<?=$iGG?>','700','350'); return false;">&nbsp;&nbsp;INPUT NILAI PER SUMBER DANA</a>
	  <?php } ?>	  </td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>Jumlah Barang </td>
      <td colspan="3"><input name="fITM" type="text" value="<?=$gITM?>" onKeyUp="addSeparator(this)" style="width:50px; border: 1px solid #C0C0C0; text-align:center; padding-top: 1px; padding-bottom: 1px; background: #FFFFFF" />&nbsp;&nbsp;&nbsp;&nbsp;(<i>Unit/Buah/Bidang</i>)</td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>Pembayaran</td>
      <td colspan="3">
	  <table>
        <tr>
          <td width="100"><label><input name="fTRMt" type="radio" value="Perencanaan" <?=$gC1?> />&nbsp;Perencanaan</label></td>
          <td width="90"><label><input name="fTRMt" type="radio" value="UangMuka" <?=$gC2?> />&nbsp;Uang Muka</label></td>
          <td width="80"><label><input name="fTRMt" type="radio" value="Termin" <?=$gC3?> />&nbsp;Termin Ke </label></td>
          <td width="60">
		  <select name="fKe" id="fKe" tabindex="0" class="boxs" style="width:50px">
		  <option value="0"></option>
			<?php
			for($nHrT=1; $nHrT<=10; $nHrT++)
			{
				$sel ="";
				if ($nHrT==$fCrT) {$sel ="selected";}
				echo '<option '.$sel.' value="'.$nHrT.'">'.$nHrT.'</option>';
			}
			?>
		  </select>		  </td>
          <td width="125"><label><input name="fTRMt" type="radio" value="Pelunasan" <?=$gC4?> />&nbsp;100 % / <i>Pelunasan</i> </label></td>
          <td><label><input name="fTRMt" type="radio" value="Pengawasan" <?=$gC5?> />&nbsp;Pengawasan</label></td>
        </tr>
      </table>	  </td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td>Proyek Multi Years</td>
      <td colspan="2">
	  <label><input name="fMLT" type="radio" value="Y" <?=$gM2?> />&nbsp;YA</label>&nbsp;&nbsp;&nbsp;&nbsp;
	  <label><input name="fMLT" type="radio" value="N" <?=$gM1?> />&nbsp;BUKAN</label>
	  <div id="reknMstCri" class="data0Rekn">
		<div id="reknDiv1Cri" class="data1Rekn"></div>
		<div id="reknDiv2Cri" class="data2Rekn"></div>
	  </div>	  </td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>Uraian</td>
      <td colspan="3" rowspan="3"><textarea name="fUR" rows="3" id="textarea" style="border-radius:5px; width:550px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background: #FFFFFF"><?=$fUR?></textarea></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
	<!--###########-->
    <tr height="23">
      <td>&nbsp;</td>
      <td colspan="4" style="font-weight:bold; font-size:11pt">REKENING ASET PERMENDAGRI 108 :</td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>JENIS</td>
      <td colspan="3">
	  <input name="fReJK" id="fReJK" type="text" value="<?=$gReJK?>" onclick="showREKN('','Tb3','','<?=$gIdT?>','<?=$IdL?>'); return false;" style="width:110px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <input name="fReJD" id="fReJD" type="text" value="<?=$gReJD?>" onclick="fReJK.click(); return false;" style="width:430px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />	  </td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>OBJEK</td>
      <td colspan="3">
	  <input name="fReOK" id="fReOK" type="text" value="<?=$gReOK?>" onclick="showREKN('','Tb4','fReJK','<?=$gIdT?>','<?=$IdL?>'); return false;" style="width:110px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <input name="fReOD" id="fReOD" type="text" value="<?=$gReOD?>" onclick="fReOK.click(); return false;" style="width:430px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />	  </td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>R. OBJEK</td>
      <td colspan="3">
	  <input name="fReRK" id="fReRK" type="text" value="<?=$gReRK?>" onclick="showREKN('','Tb5','fReOK','<?=$gIdT?>','<?=$IdL?>'); return false;" style="width:110px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <input name="fReRD" id="fReRD" type="text" value="<?=$gReRD?>" onclick="fReRK.click(); return false;" style="width:430px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />	  </td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>SUB R. OBJEK</td>
      <td colspan="3">
	  <input name="fReSK" id="fReSK" type="text" value="<?=$gReSK?>" onclick="showREKN('','Tb6','fReRK','<?=$gIdT?>','<?=$IdL?>'); return false;" style="width:110px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <input name="fReSD" id="fReSD" type="text" value="<?=$gReSD?>" onclick="fReSK.click(); return false;" style="width:430px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />	  </td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td>SUB-SUB R. OBJEK</td>
      <td width="523">
	  <input name="fReXK" id="fReXK" type="text" value="<?=$gReXK?>" onclick="showREKN('','Tb7','fReSK','<?=$gIdT?>','<?=$IdL?>'); return false;" style="width:110px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <input name="fReXD" id="fReXD" type="text" value="<?=$gReXD?>" onclick="fReXK.click(); return false;" style="width:400px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
      <td><input type="button" name="B39X" value="find" onclick="showREKN('','Tb8','','<?=$gIdT?>','<?=$IdL?>'); return false;" 
	  style="width:25px; height: 19px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
      <td width="0">&nbsp;</td>
    </tr>
    <tr height="23">
      <td>&nbsp;</td>
      <td valign="top" style="padding-top:4px">A S E T</td>
      <td colspan="3" valign="top">
	  <table width="200">
	    <tr>
	     <td valign="top">
	          <?php if ($gIdT) {?>
				<div style="overflow: auto; border:solid 1px; border-color: #999999; width:545px; height:150px">
				<table border="0" width="100%" style="background:#FFFFFF; border-collapse:collapse; border: 0px solid #999999; font-family:calibri; font-size:11px; font-weight:bold; color: #999999">
				<?php 
				$iGG = 1;
				$tmRo2=0;
				#$nSQ="SELECT IDT, Referensi, Nilai_Pengadaan, Keterangan FROM ta_kib_".strtolower($gTmp)."_temp WHERE No_Pengadaan='$gNOR' ORDER BY IDT";
				$nSQ="SELECT IDT, Referensi, Nilai_Pengadaan, Keterangan, kd_upb, jumlah_unit, harga_satuan FROM ta_kib_108_temp WHERE No_Pengadaan='$gNOR' ORDER BY IDT";
				$nRs = mysql_query($nSQ) or die(mysql_error());
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
					$rIDT = $mRo[0];
					$eCeK = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108","Ref_Temp",$mRo[1],"=","","");
					$TnE="";
					if ($eCeK < $mRo[2])
					{
						$TnE="<font style='color:#0000FF'>*</font>";
					}
					else if ($eCeK > $mRo[2])
					{
						$TnE="<font style='color:#FF0000'>*</font>";
					}
					
					$DtB = fGlobal("kd_upb","ta_kib_post_108","Ref_Temp:kd_upb NOT",$mRo[1].":".substr($mRo[4],0,11)."%","=:LIKE","IDT LIMIT 0,1","");
					$dell="dell";
					$edit="edit";
					$mess="";
					if ($DtB)
					{
						$dell="delt";
						$edit="edie";
						$mess="alert('Access denied, data aset sudah ada yang dimutasi..!!'); return false; ";
					}
					
					?>
					<tr height="20">
					<td width="26" style="border-bottom:1px dotted; border-right:1px dotted; text-align:center"><?=$iGG?>.</td>
					<td width="150" style="border-bottom:1px dotted; border-right:1px dotted; text-align:center" title="<?=fConvertToRupiah($mRo[2]-$eCeK)?>"><?=$mRo[1].$TnE?></td>
					<td width="50" style="border-bottom:1px dotted; border-right:1px dotted; text-align:center"><?=$mRo[5]?></td>
					<td width="90" style="border-bottom:1px dotted; border-right:1px dotted; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($mRo[6])?></td>
					<td width="100" style="border-bottom:1px dotted; border-right:1px dotted; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($mRo[2])?></td>
					<td style="border-bottom:1px dotted; text-align:center">
					<?php if ($gIdT!='' && $gRin!=''){?>
					<?php if ($mess==''){?>
						<a href="<?="Form_Asset_".$gTmp."_Mid_Temp.php?gIdT=".$gIdT."&rIDT=".$rIDT."&IdL=".$_GET['IdL']?>" class="ico edit">
					<?php } else {?>
						<a href="#" class="ico <?=$edit?>" onclick="<?=$mess?>">
					<?php } ?>
					edit</a>&nbsp;&nbsp;
					
					<a href="#" class="ico <?=$dell?>" onclick="<?=$mess?>P_Delete('<?=$rIDT?>'); return false">&nbsp;del</a>
					<?php } ?>					</td>
					</tr>
					<?php
					$tmRo2=$tmRo2+$mRo[2];
					$tmRo5=$tmRo5+$mRo[5];
					$iGG++;
				}
				?>
					<tr height="19">
					  <td colspan="2" style="border-bottom:1px dotted; border-right:1px dotted; text-align:center">T O T A L
					  <input name="fCek" id="fCek" type="hidden" value="<?=$iGG?>" style="width:20px" />					  </td>
					  <td style="border-bottom:1px dotted; border-right:1px dotted; text-align:center"><?=$tmRo5?></td>
					  <td style="border-bottom:1px dotted; border-right:1px dotted">&nbsp;</td>
					  <td style="border-bottom:1px dotted; border-right:1px dotted; text-align:right; padding-right:3px"><?=fConvertToRupiahBulat($tmRo2)?></td>
					  <td style="border-bottom:1px dotted"></td>
				  </tr>
				</table>
				</div>
				<?php if ($gIdT!='' && $gRin!=''){?>
				<a href="<?="Form_Asset_".$gTmp."_Mid_Temp.php?gIdT=".$gIdT."&IdL=".$_GET['IdL']?>" class="ico item">&nbsp;&nbsp;Input Detail Data Aset <?php if ($iG>1) {echo "BARU";}?>
				</a>
				<?php } ?>
	          <?php } ?>
		 &nbsp;</td>
	     </tr>
	  </table>	  </td>
    </tr>
    <tr height="20">
      <td></td>
      <td></td>
      <td colspan="3"></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">
	  <input type="button" name="B1" value="SAVE" <?=$EdS?> onclick="P_Save('<?=$gSPP?>','<?=$CrTY?>')"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B2" value="RESET"  onclick="P_Reset()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B3" value="REFRESH"  onclick="P_Refresh()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />	  </td>
    </tr>
    <tr height="30"> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	objfrm=document.myfrm;
	
	function P_Save(spp,CrTY)
	{
		if (objfrm.fNOM1.value=="")
		{
			window.alert('Silahkan pilih NOMOR BERKAS terlebih dahulu...!!');
			return false;
		}
		
		if ($("#fReXK").val()== "")
		{
			window.alert('Silahkan pilih REKENING ASET terlebih dahulu...!!');
			return false;
		}
		
		objfrm.Simpan.value = "Save";
		objfrm.submit();
	}
	
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
       			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='102,*,30' frameborder='0'><frame name='WinFindBRK_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindBRK_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindBRK_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
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
       			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
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
       			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}
	
	function showREKN(CrT,Jns,MsT,IdT,IdL)
	{
		CeK = $("#fCek").val();
		if (CeK > 1){alert('Data aset sudah diinput, rekening aset tidak bisa dirubah..!'); return false;}
		
		VsT = "";
		if (MsT!=''){VsT = $("#"+MsT).val();}
		
		if (Jns=='Tb4' && VsT==''){alert('Silahkan pilih jenis rekening..!'); return false;}
		if (Jns=='Tb5' && VsT==''){alert('Silahkan pilih objek rekening..!'); return false;}
		if (Jns=='Tb6' && VsT==''){alert('Silahkan pilih rincian objek rekening..!'); return false;}
		if (Jns=='Tb7' && VsT==''){alert('Silahkan pilih sub rincian objek rekening..!'); return false;}
		
		if (CrT=='find')
		{
			FnD = ReplaceText($("#fDataRekn").val());
			$(document).ready(function()
			{
				$("#reknDiv2Cri").load('Pengadaan_Mid_Find_Rekn_Mid.php?FnD='+FnD+'&VsT='+VsT+'&IdT='+IdT+'&Jns='+Jns+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('reknDiv2Cri');
			$(document).ready(function()
			{
				$("#reknDiv1Cri").load('Pengadaan_Mid_Find_Rekn_Top.php?MsT='+MsT+'&IdT='+IdT+'&Jns='+Jns+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#reknDiv2Cri").load('Pengadaan_Mid_Find_Rekn_Mid.php?VsT='+VsT+'&IdT='+IdT+'&Jns='+Jns+'&IdL='+IdL);
			});
			dispBlockOrNo('reknMstCri');
		}
	}	
	
	function showCLICK(Jns,Kd,Nm,IdT,IdL)
	{
		if (Jns=='Tb3')
		{
			$("#fReJK").val(Kd);
			$("#fReJD").val(Nm);
			
			$("#fReOK").val('');
			$("#fReOD").val('');
			
			$("#fReRK").val('');
			$("#fReRD").val('');
			
			$("#fReSK").val('');
			$("#fReSD").val('');
			
			$("#fReXK").val('');
			$("#fReXD").val('');
		}
		if (Jns=='Tb4')
		{
			$("#fReOK").val(Kd);
			$("#fReOD").val(Nm);
			
			$("#fReRK").val('');
			$("#fReRD").val('');
			
			$("#fReSK").val('');
			$("#fReSD").val('');
			
			$("#fReXK").val('');
			$("#fReXD").val('');
		}
		if (Jns=='Tb5')
		{
			$("#fReRK").val(Kd);
			$("#fReRD").val(Nm);
			
			$("#fReSK").val('');
			$("#fReSD").val('');
			
			$("#fReXK").val('');
			$("#fReXD").val('');
		}
		if (Jns=='Tb6')
		{
			$("#fReSK").val(Kd);
			$("#fReSD").val(Nm);
			
			$("#fReXK").val('');
			$("#fReXD").val('');
		}
		if (Jns=='Tb7')
		{
			$("#fReXK").val(Kd);
			$("#fReXD").val(Nm);
		}
		
		if (Jns=='Tb8')
		{
			if (Kd!='')
			{
				$(document).ready(function()
				{
					filepost = "Pengadaan_Mid_Find_Rekn_Mid_Select.php";
					$.post(filepost,
					{"Kd":Kd,"Nm":Nm,"IdT":IdT,"IdL":IdL},
					function( data ) 
					{
						$("#fReJK").val(data['Kd3']);
						$("#fReJD").val(data['Nm3']);
						
						$("#fReOK").val(data['Kd4']);
						$("#fReOD").val(data['Nm4']);
						
						$("#fReRK").val(data['Kd5']);
						$("#fReRD").val(data['Nm5']);
						
						$("#fReSK").val(data['Kd6']);
						$("#fReSD").val(data['Nm6']);
						
						$("#fReXK").val(data['Kd7']);
						$("#fReXD").val(data['Nm7']);
						
						//alert(data['mss']);
					},"json");
				});		
			}
		}
		
		dispNO('reknMstCri'); return false;
		
	}

</script>
<?php
require "FileFormatNum.php";
?>