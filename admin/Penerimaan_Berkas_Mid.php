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
<title>Simbada</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="global.js"></script>
</head>
<?php
require "FileFormatNum.php";
if (isset($_GET['gIdT'])) {$gIdT = $_GET['gIdT'];}
if (isset($_GET['gUnt'])) {$gUnt = $_GET['gUnt'];}
if (isset($_GET['gPR'])) {$gPR = $_GET['gPR'];}
if (isset($_GET['gKG'])) {$gKG = $_GET['gKG'];}
if (isset($_GET['gSB'])) {$gSB = $_GET['gSB'];}
if (isset($_GET['gRK'])) {$gRK = $_GET['gRK'];}
if (isset($_GET['gDN'])) {$gDN = $_GET['gDN'];}
if (isset($_GET['gRP'])) {$gRP = $_GET['gRP'];}

########### SEMENTARA NGEJAR DATA 2030 P1
if ($gUnt=='25.08.05.01')
{
	#$tTbl="2030";
	#$uTbl="1";
}
###########

if (isset($_GET['gPer'])) {$gPer = $_GET['gPer'];} else {$gPer = $tTbl;}
if (isset($_GET['gApb'])) {$gApb = $_GET['gApb'];} else {$gApb = $uTbl;}
if (isset($_GET['gUT'])) {$gUT = $_GET['gUT'];}

$gHri = date('d');
$gBln = date('m');
$gThn = date('Y');

$gHriB= "00";
$gBlnB= "00";
$gThnB= "0000";

$gHriK= "00";
$gBlnK= "00";
$gThnK= "0000";

$gNOM1= $gUnt.".".date('Y').".XXXXXX";
$nTHN = $tTbl;
$nAGG = $uTbl;

$gPRS = "N";
if ($gIdT)
{
	$nSQ = "SELECT * FROM ta_penerimaan_berkas WHERE IDT='$gIdT'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gTGL  = $mRo['Tanggal'];
		$gTGL  = explode("-", $gTGL);
		
		$gHri = $gTGL[2];
		$gBln = $gTGL[1];
		$gThn = $gTGL[0];
		
		$gTGLB = $mRo['Tg_Berita_Acara'];
		$gTGLB = explode("-", $gTGLB);
		$gHriB= $gTGLB[2];
		$gBlnB= $gTGLB[1];
		$gThnB= $gTGLB[0];
		
		$gTGLK = $mRo['Tg_Kontrak'];
		$gTGLK = explode("-", $gTGLK);
		$gHriK= $gTGLK[2];
		$gBlnK= $gTGLK[1];
		$gThnK= $gTGLK[0];
		
		$gNOM1= $mRo['Nomor'];
		$gNOMN= $mRo['NomorNew'];
		$gUnt  = $mRo['Kd_Unit'];
		$gUT   = $mRo['Peruntukan'];
		#echo $gUT;
		$mSKD  = $mRo['Id_Satker'];
		$nSKD  = $mRo['Nm_Satker'];
		$gPR   = $mRo['Kd_Program'];
		$mPR   = $mRo['Nm_Program'];
		
		$gKG   = $mRo['Kd_Kegiatan'];
		$zKG   = $mRo['Kd_Kegiatan'];
		$mKG   = $mRo['Nm_Kegiatan'];

		$gSB   = $mRo['Kd_SubKegiatan'];
		$zSB   = $mRo['Kd_SubKegiatan'];
		$mSB   = $mRo['Nm_SubKegiatan'];
		
		$gNOM2 = $mRo['No_Kontrak'];
		$gNIL  = $mRo['Nilai'];
		$gITM  = $mRo['JmlItem'];
		$gNOM3 = $mRo['No_Berita_Acara'];
		$gRK   = $mRo['Kd_Rek13'];
		$zRK   = $mRo['Kd_Rek13'];
		$mRK   = $mRo['Nm_Rek13'];
		$gRP   = $mRo['Kd_Peruntukan'];
		$zRP   = $mRo['Kd_Peruntukan'];
		$mRP   = $mRo['Nm_Peruntukan'];
		 
		$gUR   = $mRo['Uraian'];
		$nTHN  = $mRo['Periode'];
		$nAGG  = $mRo['Perubahan'];
		
		$gAGG  = $mRo['Anggaran']; 
		$gPRS  = $mRo['Proses']; 
		
		$gCrB  = $mRo['CritBayar']; 
		$gCrT  = $mRo['CritBayar_Termin']; 
		$gCrM  = $mRo['CritBayar_MultiYears']; 
		$gPOS  = $mRo['CritBayar_PostingKe']; 
		$gDN   = $mRo['SmbDana'];
		$mDN   = fGlobalNEW("Deskripsi","ref_sumber_dana","Kode",$gDN,"=","",DatabaseSB,$ConSB,"");
		
		$gVenK = $mRo['IdRekanan'];
		$gVenD = fGlobalNEW("Nma_Perusahaan","ta_rekanan","Kode",$gVenK,"=","",DatabaseSB,$ConSB,"");
	}
}
else
{
	$gNIL = 0;
	$mSKD = fGlobalNEW("Kd_Unit_Link","ref_unit","Kd_Unit",$gUnt,"=","",DatabaseSB,$ConSB,"");
	$nSKD = fGlobalNEW("Nm_Unit_Link","ref_unit","Kd_Unit",$gUnt,"=","",DatabaseSB,$ConSB,"");
	
	$nTHN = 2026;
	$nAGG = 0;
	$gCrB = "";
	$gCrT = 0;
	$zRP  = "";
	$gNOMN = "XXXXXX/PB-ASET/HST/".date('Y');
}

$mUnt = fGlobalNEW("Nm_Unit","ref_unit","Kd_Unit",$gUnt,"=","",DatabaseSB,$ConSB,"");

if ($gCrB == "Perencanaan")
{
	$gC1="checked";
	$gC2="";
	$gC3="";
	$gC4="";
	$gC5="";
}
elseif ($gCrB == "UangMuka")
{
	$gC1="";
	$gC2="checked";
	$gC3="";
	$gC4="";
	$gC5="";
}
elseif ($gCrB == "Termin")
{
	$gC1="";
	$gC2="";
	$gC3="checked";
	$gC4="";
	$gC5="";
}
elseif ($gCrB == "Pengawasan")
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

if ($gCrM=="Y") {
	$gM1="";
	$gM2="checked";
} else {
	$gM1="checked";
	$gM2="";
}

if ($gPOS=="KDP") {
	$gA1="";
	$gA2="checked";
} else {
	$gA1="checked";
	$gA2="";
}

########### SEMENTARA NGEJAR DATA 2030 P1
#if ($gUnt=='25.08.05.01')
#{
#	$tTbl="2030";
#}
############
?>
<body>
<form name="myfrm" method="post" action="<?="Penerimaan_Berkas_Mid_.php?gIdT=".$gIdT."&gUnt=".$gUnt."&IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Simpan">
  <table border="0" align="center" style="width:900px">
    <tr> 
      <td width="24">&nbsp;</td>
      <td width="140">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr height="20">
      <td>&nbsp;</td>
      <td>UNIT KERJA</td>
      <td colspan="2"><input name="f01" type="text" readonly value="<?=$gUnt." : ".strtoupper($mUnt)?>" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="20">
      <td>&nbsp;</td>
      <td>PERUNTUKAN</td>
      <td colspan="2">
	  <?php if ($gIdTX=='') {?>
	  <select name="fUT" id="fUT" style="width:605px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px">
        <option value="">None</option>
        <?php
		$zPB = "";
		$nSQ = "SELECT kd_upb, nm_upb FROM ref_upb WHERE kd_upb LIKE '".$gUnt."%' ORDER BY kd_upb";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$sel = "";
			if ($mRo[0]==$gUT) 
			{
				$sel ="selected";
				$zPB = $mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper(fViewLimit($mRo[1],50)).'</option>';
		}
	  ?>
      </select>
	  <?php } else {?>
	  <input name="fUK" id="fUK" type="text" readonly value="<?=$gUT." : ".fGlobalNEW("nm_upb","ref_upb","kd_upb",$gUT,"=","",DatabaseSB,$ConSB,"")?>" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <input name="fUT" id="fUT" type="hidden" value="<?=$gUT?>" style="width:100px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <?php } ?>	  </td>
    </tr>
    <tr height="15">
      <td></td>
      <td></td>
      <td colspan="2"></td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td colspan="3" style="font-weight:bold; font-size:11pt">BELANJA KEGIATAN:</td>
    </tr>
    <!--tr height="25">
      <td>&nbsp;</td>
      <td>UNIT KERJA</td>
      <td colspan="2"><input name="f01" type="text" readonly value="<?=$gUnt." : ".strtoupper($mUnt)?>" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr-->
    <tr height="25">
      <td>&nbsp;</td>
      <td>PERIODE</td>
      <td colspan="2">
	  <?php if ($gIdT) {?>
	  <input name="fPeK" id="fPeK" type="text" readonly value="<?=$nTHN?>" style="width:60px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <input name="fPer" id="fPer" type="hidden" value="<?=$nTHN?>" style="width:60px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  &nbsp;
	  <input name="fApK" id="fApK" type="text" readonly value="<?=gNmPrBG($nAGG)?>" style="width:90px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <input name="fApb" id="fApb" type="hidden" value="<?=$nAGG?>" style="width:90px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <?php } else {?>
	  <select class="boxs" name="fPer" id="fPer" style="width: 60px" onchange="this.form.submit()">
	  <?php
			for($nThn=2021; $nThn<=2030; $nThn++)
			{
			$sel ="";
			if ($nThn==$gPer) 
			{
				$sel ="selected";
			}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
      </select>
	  &nbsp;
	  <select class="boxs" name="fApb" id="fApb" style="width:90px" onchange="this.form.submit()">
	  <option <?php if ($gApb=='0'){echo "selected";}?> value="0">Murni</option>
	  <option <?php if ($gApb=='1'){echo "selected";}?> value="1">Perubahan</option>
      </select>	  
	  <?php } ?>	  </td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td>PROGRAM</td>
      <td colspan="2">
	  <?php if ($gIdT) {?>
	  <input name="fPRD" type="text" readonly value="<?=$gPR." : ".strtoupper($mPR)?>" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <input name="fPR" type="hidden" value="<?=$gPR?>" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <?php } else {?>
	  <select name="fPR" style="width: 605px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
        <?php
		//CallConnection(DatabaseSA,$ConSA);
		//$nSQ = "SELECT Id_Program, Nama_Program FROM program WHERE Id_Program LIKE '_.__.".$mSKD."%' GROUP BY Id_Program";
		
		#$nSQ = "SELECT idProgram, nmProgram FROM ta_apbd_program_skpd WHERE idProgram LIKE '_.__.".$mSKD."%' AND Periode='".$tTbl."' GROUP BY idProgram";
		$nSQ = "SELECT idProgram, nmProgram FROM ta_apbd_program_skpd WHERE kdUnit = '".$gUnt."' AND Periode='".$gPer."' AND apbd='".$gApb."' ORDER BY idProgram";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$sel = "";
			if ($gPR == "") {$gPR = $mRo[0];}
			if ($mRo[0]==$gPR) 
			{
				$sel = "selected";
				$zPR = $mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper(fViewLimit($mRo[1],50)).'</option>';
		}
	  ?>
      </select>
	  <?php } ?>	  </td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td>KEGIATAN</td>
      <td colspan="2">
	  <?php if ($gIdT) {?>
	  <input name="fKGD" type="text" readonly value="<?=$gKG." : ".strtoupper($mKG)?>" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <input name="fKG" type="hidden" value="<?=$gKG?>" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <?php } else {?>
	  <select name="fKG" style="width: 605px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
        <?php
		$nSQ = "SELECT idKegiatan, nmKegiatan FROM ta_apbd_kegiatan_skpd WHERE kdUnit = '".$gUnt."' AND idKegiatan LIKE '".$zPR."%' AND Periode='".$gPer."' AND Apbd='".$gApb."' ORDER BY idKegiatan";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$sel = "";
			if ($gKG == "") {$gKG = $mRo[0];}
			#if (substr($gKG,0,18) != $gPR) {$gKG = $mRo[0];}
			if (substr($gKG,0,7) != $gPR) {$gKG = $mRo[0];}
			
			if ($mRo[0]==$gKG) 
			{
				$sel ="selected";
				$zKG=$mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper(fViewLimit($mRo[1],50)).'</option>';
		}
	  ?>
      </select>
	  <?php } ?>	  </td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td>SUBKEGIATAN</td>
      <td colspan="2">
	  <?php if ($gIdT) {?>
	  <input name="fSBD" type="text" readonly value="<?=$gSB." : ".strtoupper($mSB)?>" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <input name="fSB" type="hidden" value="<?=$gSB?>" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <?php } else {?>
	  <select name="fSB" style="width: 605px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
        <?php
		$nSQ = "SELECT idSubKegiatan, nmSubKegiatan FROM ta_apbd_kegiatan_sub_skpd WHERE kdUnit = '".$gUnt."' AND idSubKegiatan LIKE '".$zKG."%' AND Periode='".$gPer."' AND Apbd='".$gApb."' ORDER BY idSubKegiatan";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$sel = "";
			if ($gSB == "") {$gSB = $mRo[0];}
			if (substr($gSB,0,12) != $gKG) {$gSB = $mRo[0];}
			
			
			if ($mRo[0]==$gSB) 
			{
				$sel ="selected";
				$zSB=$mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper(fViewLimit($mRo[1],50)).'</option>';
		}
	  ?>
      </select>
	  <?php } ?>	  </td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td>REKENING BELANJA</td>
      <td colspan="2">
	  <?php if ($gIdT) {?>
	  <input name="fRKD" type="text" readonly value="<?=$gRK." : ".strtoupper($mRK)?>" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <input name="fRK" type="hidden" value="<?=$gRK?>" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <?php } else {?>
	  <select name="fRK" style="width: 605px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
	  <option value=""></option>
        <?php
		$nSQ = "SELECT kdRekening, nmRekening FROM ta_apbd_rekening_skpd WHERE kdUnit = '".$gUnt."' AND idSubKegiatan = '".$zSB."' AND Periode='".$gPer."' AND Apbd='".$gApb."' GROUP BY kdRekening ORDER BY kdRekening";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$sel = "";
			if ($mRo[0]==$gRK) 
			{
				$sel = "selected";
				$zRK = $mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper($mRo[1]).'</option>';
		}
	  ?>
      </select>
	  <?php } ?>	  </td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td>SUMBER DANA</td>
      <td colspan="2">
	  <?php if ($xIdT!='') {?>
	  <input name="fDND" type="text" readonly value="<?=$gDN." : ".strtoupper($mDN)?>" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <input name="fDN" type="hidden" value="<?=$gDN?>" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <?php } else {?>
	  <select name="fDN" style="width: 605px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px">
	  <option value=""></option>
        <?php
		$nSQ = "SELECT kode, deskripsi FROM ref_sumber_dana ORDER BY kode";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$sel = "";
			if ($mRo[0]==$gDN) 
			{
				$sel = "selected";
				$zDN = $mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.strtoupper($mRo[1]).'</option>';
		}
	  ?>
      </select>
	  <?php } ?>	  </td>
    </tr>
	<?php if ($gUnt=='24.04.07.01' || $gUnt=='24.04.23.06' || $gUnt=='24.04.23.08') {?>
    <tr height="25">
      <td>&nbsp;</td>
      <td style="color:#0000FF">PERUNTUKAN</td>
      <td colspan="2">
	  <?php if ($gIdT) {?>
			<input name="fRPD" type="text" readonly value="<?=$gRP." : ".strtoupper($mRP)?>" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
			<input name="fRP" type="hidden" value="<?=$gRP?>" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  <?php } else {?>
			<select name="fRP" style="width: 605px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
			<option value=""></option>
			<?php
			$nSQ = "SELECT idSubUnit, nmSubUnit FROM ta_apbd_rekening_skpd WHERE kdUnit = '".$gUnt."' AND idSubKegiatan = '".$zSB."' AND kdRekening='".$zRK."' AND Periode='".$gPer."' AND Apbd='".$gApb."' ORDER BY kdRekening";
			$nRs = mysql_query($nSQ) or die(mysql_error());
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				$sel = "";
				if ($mRo[0]==$gRP) 
				{
					$sel ="selected";
					$zRP = $mRo[0];
				}
				echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper($mRo[1]).'</option>';
			}
			?>
			</select>
	  <?php } ?></td>
    </tr>
	<?php } else {?>
	<input name="fRP" type="hidden" value="" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	<?php } ?>
    <tr height="25">
      <td>&nbsp;</td>
      <td>ANGGARAN (Rp)</td>
      <td colspan="2">
	  <?php
		#if ($zRP!='' && substr($zRP,-4,4)!="0000")
		if ($zRP!='')
		{
			$gAGG = fGlobalNEW("IfNull(sum(fnJumlah),0)","ta_apbd_rekening_skpd","kdUnit:kdRekening:idSubKegiatan:Periode:idSubUnit:Apbd",$gUnt.":".$zRK.":".$zSB.":".$nTHN.":".$zRP.":".$nAGG,"=:=:=:=:=:=","",DatabaseSB,$ConSB,"");
			$gToA = $gAGG;//fGlobalNEW("IfNull(sum(fnJumlah),0)","ta_apbd_rekening_skpd","kdUnit:kdRekening:idSubKegiatan:Periode:idSubUnit",$gUnt.":".$zRK.":".$zSB.":".$tTbl.":".$zRP,"=:=:=:=:=","",DatabaseSB,$ConSB,"");
			$gBrK = fGlobalNEW("IfNull(sum(Nilai),0)","ta_penerimaan_berkas","Kd_Unit:Kd_Rek13:Kd_SubKegiatan:Periode:Kd_Peruntukan:Perubahan",$gUnt.":".$zRK.":".$zSB.":".$nTHN.":".$zRP.":".$nAGG,"=:=:=:=:=:=","",DatabaseSB,$ConSB,"");
		}
		else
		{
			$gAGG = fGlobalNEW("IfNull(sum(fnJumlah),0)","ta_apbd_rekening_skpd","kdUnit:kdRekening:idSubKegiatan:Periode:Apbd",$gUnt.":".$zRK.":".$zSB.":".$nTHN.":".$nAGG,"=:=:=:=:=","",DatabaseSB,$ConSB,"");
			$gToA = $gAGG;//fGlobalNEW("IfNull(sum(fnJumlah),0)","ta_apbd_rekening_skpd","kdUnit:kdRekening:idSubKegiatan:Periode",$gUnt.":".$zRK.":".$zSB.":".$tTbl,"=:=:=:=","",DatabaseSB,$ConSB,"");
			$gBrK = fGlobalNEW("IfNull(sum(Nilai),0)","ta_penerimaan_berkas","Kd_Unit:Kd_Rek13:Kd_SubKegiatan:Periode:Perubahan",$gUnt.":".$zRK.":".$zSB.":".$nTHN.":".$nAGG,"=:=:=:=:=","",DatabaseSB,$ConSB,"");
		}
		$gSiA = $gToA-$gBrK;
	  ?>
	  <input name="fAgg" type="text" readonly="readonly" value="<?=fConvertToRupiah($gAGG)?>" style="font-size:12px; text-align:right; width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 2px; padding-top: 1px; padding-bottom: 1px" />
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PEMBERKASAN (Rp)&nbsp;&nbsp;&nbsp;
	  <input name="fBer" type="text" readonly="readonly" value="<?=fConvertToRupiah($gBrK)?>" style="font-size:12px; text-align:right; width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 2px; padding-top: 1px; padding-bottom: 1px" />
	  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SISA AGG. (Rp)&nbsp;&nbsp;&nbsp;
	  <input name="fSis" type="text" readonly="readonly" value="<?=fConvertToRupiah($gSiA)?>" style="font-size:12px; text-align:right; width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 2px; padding-top: 1px; padding-bottom: 1px; color:#0000ff" />	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">
		<div id="alayMstCri" class="data0Reko">
			<div id="alayDiv1Cri" class="data1Reko"></div>
			<div id="alayDiv2Cri" class="data2Reko"></div>
		</div>	  </td>
    </tr>
    <tr height="10">
      <td>&nbsp;</td>
      <td colspan="3" style="font-weight:bold; font-size:11pt">PENERIMAAN BERKAS :</td>
      <td width="-1">&nbsp;</td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td>REFERENSI</td>
      <td colspan="2">
	  <input name="fNOM1" type="text" value="<?=$gNOM1?>" readonly style="width:204px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	  </td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td>TANGGAL</td>
      <td colspan="2">
		<select name="fHri" tabindex="0" class="boxs" style="width:50px">
		<?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$gHri) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
        </select>&nbsp;
		<select class="boxs" name="fBln" style="width:87px">
		<?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$gBln) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
        </select>&nbsp;
		<select class="boxs" name="fThn" style="width: 60px">
		<?php
		for($nThn=2021; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$gThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
        </select>      </td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td>NOMOR</td>
      <td colspan="2">
	  <input name="fNOMN" type="text" value="<?=$gNOMN?>" readonly style="width:204px; border: 1px solid #C0C0C0; padding-left:3px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td>NOMOR KONTRAK</td>
      <td width="211">
	  <input name="fNOM2" type="text" value="<?=$gNOM2?>" style="width:170px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background: #FFFFFF" />
	  <!--select name="fNOM2" style="width: 210px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px">
      <option value=""></option>
	    <?php
		CallConnection(DatabaseSB,$ConSB);
		//No_Rekening:Id_Kegiatan:Periode:Perubahan",$zRK.":".$zKG.":".$nTHN.":".$nAGG
		$nSQ = "SELECT Nomor FROM ta_kontrak WHERE Kegiatan = '$zKG' AND Rekening='$zRK' AND Periode='$nTHN' ORDER BY Nomor";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$sel = "";
			//if ($gPR == "") {$gPR = $mRo[0];}
			if ($mRo[0]==$gNOM2) 
			{
				$sel = "selected";
				$zNOM2 = $mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0].'</option>';
		}
	  ?>
      </select-->	  </td>
      <td width="504"><!--input type="button" name="B392" value="..." onclick="FindKONTRAK('800','400','<?=$gPR?>','<?=$gKG?>','<?=$gRK?>','<?=$_GET['IdL']?>')" style="width: 30px; height: 18px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /--></td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td>TANGGAL KONTRAK</td>
      <td colspan="2">
		<select name="fHriK" tabindex="0" class="boxs" style="width:50px">
		<option value="00"></option>
		<?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$gHriK) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
        </select>&nbsp;
		<select class="boxs" name="fBlnK" style="width:87px">
		<option value="00"></option>
		<?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$gBlnK) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
        </select>&nbsp;
		<select class="boxs" name="fThnK" style="width: 60px">
		<option value="0000"></option>
		<?php
		for($nThn=2021; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$gThnK) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>	  </td>
    </tr>
    <!--tr height="25">
      <td>&nbsp;</td>
      <td>NOMOR BAST</td>
      <td colspan="2"><input name="fNOM3" type="text" value="<?=$gNOM3?>" style="width:204px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background: #FFFFFF" /></td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td>TANGGAL BAST </td>
      <td colspan="2">
		<select name="fHriB" tabindex="0" class="boxs" style="width:50px">
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
		<select class="boxs" name="fBlnB" style="width:87px">
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
		<select class="boxs" name="fThnB" style="width: 60px">
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
    </tr-->
    <tr height="25">
      <td>&nbsp;</td>
      <td>JUMLAH BARANG</td>
      <td colspan="2"><input name="fITM" type="text" value="<?=$gITM?>" onKeyUp="addSeparator(this)" style="width:45px; border: 1px solid #C0C0C0; text-align:center; padding-top: 1px; padding-bottom: 1px; background: #FFFFFF" />&nbsp;&nbsp;&nbsp;&nbsp;(<i>Unit/Buah/Bidang</i>)</td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td>NILAI BARANG</td>
      <td colspan="2"><input name="fNIL" type="text" value="<?=fConvertToRupiah($gNIL)?>" onKeyUp="addSeparator(this)" style="text-align:right; width:130px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right:4px; padding-top: 1px; padding-bottom: 1px; background: #FFFFFF" />&nbsp;&nbsp;&nbsp;&nbsp;(<i>Rp</i>)</td>
    </tr>
    <tr height="25">
      <td>&nbsp;</td>
      <td>REKANAN</td>
      <td colspan="2">
	  <input name="fVenK" id="fVenK" type="text" value="<?=$gVenK?>" onclick="showREKA('','<?=$gIdT?>','<?=$_GET['IdL']?>'); return false;" style="width:40px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background:#faf9aa" />
	  <input name="fVenD" id="fVenD" type="text" value="<?=$gVenD?>" onclick="fVenK.click(); return false;" style="width:354px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background:#faf9aa" />	  </td>
    </tr>
    <!--tr height="25">
      <td>&nbsp;</td>
      <td>PEMBAYARAN</td>
      <td colspan="2">
	  <table>
        <tr>
          <td width="100"><label><input name="fTRMt" type="radio" value="Perencanaan" <?=$gC1?> />&nbsp;Perencanaan</label></td>
          <td width="90"><label><input name="fTRMt" type="radio" value="UangMuka" <?=$gC2?> />&nbsp;Uang Muka</label></td>
          <td width="80"><label><input name="fTRMt" type="radio" value="Termin" <?=$gC3?> />&nbsp;Termin Ke </label></td>
          <td width="60">
		  <select name="fKe" tabindex="0" class="boxs" style="width:50px">
		  <option value="0"></option>
			<?php
			for($nHrT=1; $nHrT<=10; $nHrT++)
			{
				$sel ="";
				if ($nHrT==$gCrT) {$sel ="selected";}
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
      <td>PROYEK MULTI YEARS </td>
      <td colspan="2">
	  <table>
        <tr>
          <td width="60"><label><input name="fMLT" type="radio" value="N" <?=$gM1?> />&nbsp;NO</label></td>
          <td width="60"><label><input name="fMLT" type="radio" value="Y" <?=$gM2?> />&nbsp;YES</label></td>
		  <td width="40">&nbsp;</td>
		  <td width="75" style="font-weight:bold; color:#0066CC">POSTING KE</td>
		  <td width="20" style="font-weight:bold; color:#0066CC">:</td>
		  <td width="70" style="font-weight:bold; color:#0066CC"><label><input name="fPOS" type="radio" value="Aset" <?=$gA1?> />&nbsp;ASET</label></td>
		  <td style="font-weight:bold; color:#0066CC"><label><input name="fPOS" type="radio" value="KDP" <?=$gA2?> />&nbsp;KDP</label></td>
        </tr>
	  </table>	  </td>
    </tr-->
    <!--tr height="25">
      <td>&nbsp;</td>
      <td>LINK DATA (REFERENSI)</td>
      <td>
	  <table>
	  <tr>
	    <td width="170">
	      <input name="fRf30" type="text" value="<?=$gRf30?>" readonly="readonly" style="width:170px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
	      <input name="fRf30" type="text" value="<?=$gCrP?>" readonly="readonly" style="width:170px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />		  </td>
		<td width="46">
		<input type="button" name="B392" value="..." onclick="FinddATA30('800','400','<?=$gIdT?>',<?=$gTRM?>','<?=$_GET['IdL']?>')" style="width: 30px; height: 19px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
		<input type="button" name="B392" disabled value="..." onclick="FinddATAUM('800','400','<?=$gIdT?>','<?=$gCrB?>','<?=$_GET['IdL']?>')" style="width: 30px; height: 19px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />		</td>
	    <td width="489">(<i>Ex: <b>Uang Muka</b> Link data ke <b>Perencanaan</b></i>)</td>
	  </tr>
	  </table>      </td>
    </tr-->
    <tr height="25">
      <td>&nbsp;</td>
      <td>URAIAN</td>
      <td colspan="2"><textarea name="fUR" rows="3" id="textarea" style="border-radius:5px; width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; background: #FFFFFF"><?=$gUR ?></textarea></td>
    </tr>
    <tr height="10">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">
	  <input type="button" name="B1" value="SAVE"  onclick="P_Save('<?=$gPRS?>')"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B2" value="RESET"  onclick="P_Reset()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />&nbsp;&nbsp;&nbsp;
	  <input type="button" name="B3" value="PRINT"  onclick="P_Print('800','400','<?=$gIdT?>','<?=$_GET['IdL']?>')"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />	  </td>
	</tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Print(w,h,idt,IdL)
	{
		var win=null;
		var txtHTML = "";
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition =(screen.height)?(screen.height-h)/2:100;
		rURL='Penerimaan_Berkas_Print.php?gIdT='+idt+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars=yes,location=no,directories=no,status=no,menubar=yes,toolbar=no,resizable=yes,maximize=yes,navigation=no';
		window.open(rURL,'',settings);
	}
	
	function P_Save(xG)
	{
		if (xG=="Y")
		{
			//window.alert('Access denied, data sudah diproses...!!');
			//return false;
		}
		
		if (objfrm.fPR.value=="")
		{
			window.alert('Silahkan pilih PROGRAM terlebih dahulu...!!');
			return false;
		}
		
		if (objfrm.fKG.value=="")
		{
			window.alert('Silahkan pilih KEGIATAN terlebih dahulu...!!');
			return false;
		}
		
		if (objfrm.fRK.value=="")
		{
			window.alert('Silahkan pilih REKENING BELANJA terlebih dahulu...!!');
			return false;
		}
		
		if (objfrm.fNOM2.value=="")
		{
			window.alert('Silahkan pilih NOMOR KONTRAK terlebih dahulu...!!');
			return false;
		}
		
		objfrm.Simpan.value = "Save";
		objfrm.submit();
	}

	function P_Reset()
	{
		objfrm.Simpan.value = "Reset";
		objfrm.submit();
	}
	
	function FinddATA30(w,h,gIdT,gTRM,IdL)
	{
		if (!gIdT)
		{
			window.alert('Silahkan simpan data terlebih dahulu..!!');
			return false;
		}
		if (gTRM==30)
		{
			window.alert('Link termin digunakan untuk termin 70% dan 100%..!!');
			return false;
		}
		var win=null;
		var txtHTML = "";
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = 'Penerimaan_Berkas_Mid_30_Top.php?gIdT='+gIdT+'&IdL='+IdL;
			URL_Mid = 'Penerimaan_Berkas_Mid_30_Mid.php?gIdT='+gIdT+'&IdL='+IdL;
			URL_Bot = 'Penerimaan_Berkas_Mid_30_Bot.php';
			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFind30_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFind30_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFindAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
	
	function FinddATAUM(w,h,gIdT,gCrB,IdL)
	{
		if (!gIdT)
		{
			window.alert('Silahkan simpan data terlebih dahulu..!!');
			return false;
		}
		if (gCrB=="UangMuka")
		{
			window.alert('Link termin digunakan untuk termin 1 s.d n... dan 100% / pelunasan ..!!');
			return false;
		}
		var win=null;
		var txtHTML = "";
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = 'Penerimaan_Berkas_Mid_30_Top.php?gIdT='+gIdT+'&IdL='+IdL;
			URL_Mid = 'Penerimaan_Berkas_Mid_30_Mid.php?gIdT='+gIdT+'&IdL='+IdL;
			URL_Bot = 'Penerimaan_Berkas_Mid_30_Bot.php';
			
			URL_Top = 'Penerimaan_Berkas_Mid_UM_Top.php?gIdT='+gIdT+'&IdL='+IdL;
			URL_Mid = 'Penerimaan_Berkas_Mid_UM_Mid.php?gIdT='+gIdT+'&IdL='+IdL;
			URL_Bot = 'Penerimaan_Berkas_Mid_UM_Bot.php';
			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFind30_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFind30_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFindAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
	
	function FindKONTRAK(w,h,gPR,gKG,gRK,IdL)
	{
		if (objfrm.fRK.value=="") {alert('Silahkan pilih Rekening B. Modal terlebih dahulu..!!');return false;}
		
		var win=null;
		var txtHTML = "";
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
			win=window.open('','',settings);
			if (win!=null)
			{
				win.window.document.open()       			
				URL_Top = 'Penerimaan_Berkas_Mid_Kontrak_Top.php?gKG='+gKG+'&gRK='+gRK+'&IdL='+IdL;
				URL_Mid = 'Penerimaan_Berkas_Mid_Kontrak_Mid.php?gKG='+gKG+'&gRK='+gRK+'&IdL='+IdL;
				URL_Bot = 'Penerimaan_Berkas_Mid_Kontrak_Bot.php';
       			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='95,*,30' frameborder='0'><frame name='WinFindBRK_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFindBRK_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFindBRK_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}
	
	function showREKA(CrT,IdT,IdL)
	{
		if (CrT=='find')
		{
			FnD = ReplaceText($("#fDataFind").val());
			$(document).ready(function()
			{
				$("#alayDiv2Cri").load('Penerimaan_Berkas_Mid_Find_Reka_Mid.php?FnD='+FnD+'&IdT='+IdT+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('alayDiv2Cri');
			
			$(document).ready(function()
			{
				$("#alayDiv1Cri").load('Penerimaan_Berkas_Mid_Find_Reka_Top.php?IdT='+IdT+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#alayDiv2Cri").load('Penerimaan_Berkas_Mid_Find_Reka_Mid.php?IdT='+IdT+'&IdL='+IdL);
			});
			dispBlockOrNo('alayMstCri');
		}
	}	
	
	function showCLICK(pil,Kd,Nm,IdT,IdL)
	{
		if (pil=='reka')
		{
			if (Kd=='R000'){Kd='';}
			if (Nm=='Kosongkan.......!!'){Nm='';}
			
			$("#fVenK").val(Kd);
			$("#fVenD").val(Nm);
			if (IdT!='')
			{
				$(document).ready(function()
				{
					filepost = "Penerimaan_Berkas_Mid_Find_Reka_Mid_Save.php";
					$.post(filepost,
					{"Kd":Kd,"IdT":IdT,"IdL":IdL},
					function( data ) 
					{
						//alert(data['mess']);
					},"json");
				});		
			}
			dispNO('alayMstCri'); return false;
		}
	}
	
</script>
