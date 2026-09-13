<?php
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
</head>
<?php
if (isset($_GET['rIDT'])) {$rIDT = $_GET['rIDT'];}
$gReaD= "readonly";
$gDisB= "hidden";
$KeY  = "N";
if ($rIDT!="")
{
	$nSQ = "SELECT * FROM ta_kib_108 where IDT='".$rIDT."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gNoR  = $mRo['No_Register'];
		$gIMG  = $mRo['file_name'];	
		$gREF  = $mRo['Referensi'];
		$gGRP  = $mRo['Ref_Group'];
		$gKDB  = $mRo['Kd_Aset_108'];
		$gRua  = $mRo['Kd_Ruang'];
		$gREG  = $mRo['No_Register'];
		
		if ($gGRP!="")
		{
			$gReaD="";
			$gDisB="";
			$gTexB="UPDATE SEMUA ITEM";
		}
		
		$gUnt  = substr($mRo['Kd_UPB'],0,11);
		$gSub  = substr($mRo['Kd_UPB'],0,14);
		$gUpb  = substr($mRo['Kd_UPB'],0,18);
	
		$gBid  = substr($mRo['Kd_Aset_108'],0,8);
		$gKel  = substr($mRo['Kd_Aset_108'],0,11);
		$gOBJ  = substr($mRo['Kd_Aset_108'],0,14);
		$gRin  = substr($mRo['Kd_Aset_108'],0,18);
		
		if ($mRo['Nm_Aset']=="") {$fNma = fGlobal("Nm_Aset","Ref_Rek_Aset108_7","Kd_Aset",$mRo['Kd_Aset'],"=","","");}
		else {$fNma = $mRo['Nm_Aset'];}
		
		$gMrk  = $mRo['Merk'];
		$gTyp  = $mRo['Type'];
		$gUcc  = $mRo['Ukuran_CC'];
		$gBHN  = $mRo['Bahan'];
		$gPBR  = $mRo['Nomor_Pabrik'];
		$gRKA  = $mRo['Nomor_Rangka'];
		$gMSN  = $mRo['Nomor_Mesin'];
		$gPLS  = $mRo['Nomor_Polisi'];
		$gPLSL = $mRo['Nomor_Polisi_Lama'];
		if ($gPLS==""){$gPLS="-";}
		$gBPK  = $mRo['Nomor_BPKB'];
		if ($gBPK==""){$gBPK="-";}
		
		$gPMG  = $mRo['Pemegang'];
		$gPMGL = $mRo['Pemegang_Lama'];
		
		$gKTR  = $mRo['Keterangan'];
		
		$gMLK  = $mRo['Kd_Pemilik'];
		$gKDS  = $mRo['Kondisi'];
		$gAUS  = $mRo['Asal_Usul'];
		$gMSM  = $mRo['Masa_Manfaat'];
		
		$gHri  = (int)substr($mRo['Tgl_Perolehan'],8,10);
		$gBln  = (int)substr($mRo['Tgl_Perolehan'],5,-3);
		$gThn  = (int)substr($mRo['Tgl_Perolehan'],0,-6);
		
		$gHriM = (int)substr($mRo['Tgl_Mutasi'],8,10);
		$gBlnM = (int)substr($mRo['Tgl_Mutasi'],5,-3);
		$gThnM = (int)substr($mRo['Tgl_Mutasi'],0,-6);
		
		$tKib= "B";
		$KeY = CekKey($gUnt,$gThn,'Kib_'.$tKib,'');
		
		#if ($gThn<=2014){
		#	$KeY="Y";
		#}
		
		#########
		if ($UID=="creator"){$KeY="N";}
		#########
		
		if ($gGRP!="")		//Jika input rombongan / Nilai Jumlah_Satuan lebih dari 1 (satu) --> Maka Field Ref_Group tidak kosong.
		{
			$gREGa = fMakeRegister(fGlobal("RegFrom","Ta_Kib_Group","Referensi",$gGRP,"=","",""),7);
			$gREGb = fMakeRegister(fGlobal("RegTo","Ta_Kib_Group","Referensi",$gGRP,"=","",""),7);
			
			$gSTN = fGlobal("Jml_Item","Ta_Kib_Group","Referensi",$gGRP,"=","","");
			$gTTL = fGlobal("Nilai_Total","Ta_Kib_Group","Referensi",$gGRP,"=","","");
			$gHRG = $mRo['Harga'];
		}
		else
		{
			$gGRP = "NON GROUP";
			$gSTN = 1;
			$gTTL = $mRo['Harga'];
			$gHRG = $mRo['Harga'];
		}
		$gNIL = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB",$gREF.":".$mRo['Kd_UPB'],"=:=","","");
	}
}
else
{
	$gNoR  = MakeNewNoRegiterAuto('ALT','');
	$gSTN  = 0;
	$gTTL  = 0;
	$gHRG  = 0;
	
	$gUnt  = $_GET['gUnt'];
	$gSub  = $_GET['gSub'];
	$gUpb  = $_GET['gUpb'];
	$gThn  = $_GET['gThn'];
	
	$gBid  = $_GET['gBid'];
	$gKel  = $_GET['gKel'];
	$gOBJ  = $_GET['gOBJ'];
	$gRin  = $_GET['gRin'];
	
	$gHri  = fGetDate('mday');
	$gBln  = fGetDate('mon');
	$gThn  = fGetDate('year');
	
	$gHriM = "00";
	$gBlnM = "00";
	$gThnM = "0000";
}
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Form_Asset_B_Mid_.php?IdL=".$_GET['IdL']."&rIDT=".$rIDT ?>">
<input type="hidden" name="Simpan">
  <table border="0" align="center" width="1165">
    <tr>
      <td height="5"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr> 
      <td width="120">UNIT KERJA</td>
      <td width="489"> 
        <?php if ($rIDT) {?>
		<input name="fUnt" type="text" readonly value="<?=$gUnt?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fUnG" type="text" readonly value="<?=fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUnt,"=","","")?>" style=" width:325px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<?php } else {?>
		<select name="fUnt" tabindex="0" style="width: 450px" onchange="this.form.submit()">
        <?php
		if ($Lev > 1 )
			{$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit WHERE Kd_Unit = '".substr($SkP,0,11)."' ORDER BY Kd_Unit";}
		else
			{$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUnt=="") {$gUnt=$mRo['Kd_Unit'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Unit']==$gUnt) 
				{
				$sel ="selected";
				$zUnt=$mRo['Kd_Unit'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Unit'].'">'.$mRo['Kd_Unit']." : ".$mRo['Nm_Unit'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select>
	  <?php } ?>	  </td>
      <td width="52">&nbsp;</td>
      <td width="149">KEPEMILIKAN</td>
      <td width="333"> 
        <select class="boxs" name="fMilik" style=" width:200px" tabindex="0">
          <option value=""></option>
          <?php
		$nSQ = "SELECT * from ref_pemilik ORDER BY Kd_Pemilik";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			//if ($gMLK=="") {$gMLK=$mRo['Kd_Pemilik'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Pemilik']==$gMLK) 
				{
				$sel ="selected";
				$gMLK=$mRo['Kd_Pemilik'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Pemilik'].'">'.$mRo['Nm_Pemilik'].'</option>';
			}
			  while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select></td>
    </tr>
    <tr> 
      <td width="120">SUB UNIT</td>
      <td width="489"> 
        <?php if ($rIDT) {?>
		<input name="fSub" type="text" readonly value="<?=$gSub?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fSuG" type="text" readonly value="<?=fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSub,"=","","")?>" style=" width:325px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<?php } else {?>
        <select class="boxs" name="fSub" tabindex="0" style="width: 450px" onchange="this.form.submit()">
        <?php
		if ($Lev <=3 ) {$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".__' ORDER BY Kd_Sub";}
		else {$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".".substr($SkP,12,2)."' ORDER BY Kd_Sub";}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gSub=="") {$gSub=$mRo['Kd_Sub'];}
			if (substr($gSub,0,11)!=$zUnt) {$gSub=$mRo['Kd_Sub'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Sub']==$gSub) 
				{
				$sel ="selected";
				$zSub=$mRo['Kd_Sub'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Sub'].'">'.$mRo['Kd_Sub']." : ".$mRo['Nm_Sub'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select>
	  <?php } ?>	  </td>
      <td width="52">&nbsp;</td>
      <td>KONDISI BARANG </td>
      <td> <select class="boxs" name="fKondisi" style="width:200px" tabindex="0">
          <option value=""></option>
          <?php
		$nSQ = "SELECT * from ref_kondisi ORDER BY IDT";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			//if ($gKDS=="") {$gKDS=$mRo['Kode'];}
			do
			{
				$sel ="";
				if ($mRo['Kode']==$gKDS) 
				{
				$sel ="selected";
				$gKDS=$mRo['Kode'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kode'].'">'.$mRo['Kondisi'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select></td>
    </tr>
    <tr> 
      <td width="120">UPB.</td>
      <td width="489"> 
        <?php if ($rIDT) {?>
		<input name="fUpb" type="text" readonly value="<?=$gUpb?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fUpG" type="text" readonly value="<?=fGlobal("Nm_Upb ","ref_upb","Kd_Upb",$gUpb,"=","","")?>" style=" width:260px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<a href="#" class="ico reff" onclick="P_MoveUPB('<?=$ReO?>','<?=$KeY?>','700','450','<?=$rIDT?>','<?=$_GET['IdL']?>'); return false" title="Ganti kode upb..!!">GANTI</a>
		<?php } else {?>
        <select class="boxs" name="fUpb" tabindex="0" style="width: 450px" onchange="this.form.submit()">
        <?php
		#$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb where Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_Upb";
		
		if ($Lev <=3 ) {$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_Upb";}
		else {$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".".substr($SkP,-3,3)."' ORDER BY Kd_Upb";}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUpb=="") {$gUpb = $mRo['Kd_Upb'];}
			if (substr($gUpb,0,14)!=$zSub) {$gUpb = $mRo['Kd_Upb'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Upb']==$gUpb) 
				{
				$sel ="selected";
				$zUpb=$mRo['Kd_Upb'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Upb'].'">'.$mRo['Kd_Upb']." : ".$mRo['Nm_Upb'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select>
	  <?php } ?>	  </td>
      <td width="52">&nbsp;</td>
      <td>ASAL USUL</td>
      <td><select name="fAsalUsul" class="boxs" id="select2" style="width:200px" tabindex="0">
          <option value=""></option>
          <?php
		$nSQ = "SELECT * FROM ref_perolehan ORDER BY IDT";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			//if ($gKDS=="") {$gKDS=$mRo['Kode'];}
			do
			{
				$sel ="";
				if ($mRo['Perolehan']==$gAUS) 
				{
				$sel ="selected";
				$gKDS=$mRo['Perolehan'];
				}
				echo '<option '.$sel.' value="'.$mRo['Perolehan'].'">'.$mRo['Perolehan'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
    </tr>
    <tr> 
      <td>RUANGAN (KIR)</td>
      <td valign="middle">
	  <select class="boxs" name="fRua" id="fRua" tabindex="0" style="width: 240px; background:#FFFFCC">
	  <option value="000"></option>
        <?php
		$nSQ = "SELECT Kd_Ruang, Nm_Ruang FROM ref_ruangan WHERE Kd_UPB = '".$gUpb."' ORDER BY Kd_Ruang";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			//if ($gUpb=="") {$gUpb = $mRo['Kd_UPB'];}
			//if (substr($gUPB,0,14)!=$gSub) {$gUPB = $mRo['Kd_UPB'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Ruang']==$gRua) 
				{
					$sel ="selected";
					$zRua=$mRo['Kd_Ruang'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Ruang'].'">'.$mRo['Nm_Ruang'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select></td>
      <td>&nbsp;</td>
      <td>TGL. PEROLEHAN</td>
      <td><select class="boxs" name="fHri" tabindex="0" style="width:45px">
        <?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$gHri) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
      </select>
		<select class="boxs" name="fBln" tabindex="0" style="width:90px">
		  <?php
				for($nBln=1; $nBln<=12; $nBln++)
				{
					$sel ="";
					if ($nBln==$gBln) {$sel ="selected";}
					echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
				}
				?>
		</select>
		<?php if ($KeY=="Y") {?>
			<input name="fThn" readonly type="text" value="<?=$gThn?>" style="width:50px; text-align : center; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
		<?php } else {?>
			<select class="boxs" name="fThn" style="width: 60px" tabindex="0">
			  <?php
				for($nThn=1900; $nThn<=2030; $nThn++)
				{
				$sel ="";
				if ($nThn==$gThn) {$sel ="selected";}
				echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
				}
				?>
			</select>
			<?php } ?>			</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>TGL. MUTASI MASUK </td>
      <td>
	  <select class="boxs" name="fHriM" tabindex="0" style="width:45px">
		<option value="00"></option>
        <?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$gHriM) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
      </select>
        <select class="boxs" name="fBlnM" tabindex="0" style="width:90px">
		<option value="00"></option>
          <?php
				for($nBln=1; $nBln<=12; $nBln++)
				{
					$sel ="";
					if ($nBln==$gBlnM) {$sel ="selected";}
					echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
				}
				?>
        </select>
        <select class="boxs" name="fThnM" style="width: 60px" tabindex="0">
		<option value="0000"></option>
          <?php
				for($nThn=1900; $nThn<=2030; $nThn++)
				{
				$sel ="";
				if ($nThn==$gThnM) {$sel ="selected";}
				echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
				}
				?>
        </select>		</td>
    </tr>
    <tr> 
      <td>KELOMPOK</td>
      <td>
        <?php if ($rIDT) {?>
		<input name="fBid" type="text" readonly value="<?=$gBid?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fBiG" type="text" readonly value="<?=fGlobal("Nm_Aset ","ref_rek_aset108_4","Kd_Aset",$gBid,"=","","")?>" style=" width:325px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<?php } else {?>
	    <select class="boxs" name="fBid" tabindex="0" style="width: 450px" onchange="this.form.submit()">
        <option value=""></option>
        <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset2 WHERE Kd_Aset LIKE '02.__' ORDER BY Kd_Aset";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '1.3.2.__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gBid=="") {$gBid=$mRo['Kd_Aset'];}
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
		<?php } ?>		</td>
      <td>&nbsp;</td>
      <td>UMUR EKONOMIS</td>
      <td>
	  <input name="fManfaat" type="text" id="fManfaat" value="<?=$gMSM?>" onblur="NumValidate(this)" style=" width:55px; text-align: center; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>&nbsp;Tahun	  </td>
    </tr>
    <tr> 
      <td>JENIS</td>
      <td>
        <?php if ($rIDT) {?>
		<input name="fKel" type="text" readonly value="<?=$gKel?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fKeG" type="text" readonly value="<?=fGlobal("Nm_Aset ","ref_rek_aset108_5","Kd_Aset",$gKel,"=","","")?>" style=" width:325px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<?php } else {?>
	    <select class="boxs" name="fKel" tabindex="0" style="width: 450px" onchange="this.form.submit()">
        <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset3 WHERE Kd_Aset LIKE '".$gBid.".__' ORDER BY Kd_Aset";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '".$gBid.".__' ORDER BY Kd_Aset";
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
		<?php } ?>		</td>
      <td>&nbsp;</td>
      <td>JUMLAH SATUAN</td>
      <td><input name="fSatuan" type="text" id="fSatuan" maxlength="4" value="<?php echo $gSTN?>" <?php if ($KeY=="Y") {echo "readonly";}?> onBlur="NumValidate(this)" onKeyUp="addSeparator(this)" style="width:50px; text-align : right; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 5px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr> 
      <td>OBJEK</td>
      <td>
        <?php if ($rIDT) {?>
		<input name="fOBJ" type="text" readonly value="<?=$gOBJ?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fOBG" type="text" readonly value="<?=fGlobal("Nm_Aset ","ref_rek_aset108_6","Kd_Aset",$gOBJ,"=","","")?>" style=" width:325px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<?php } else {?>
	    <select class="boxs" name="fOBJ" tabindex="0" style="width: 450px" onchange="this.form.submit()">
        <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset4 WHERE Kd_Aset LIKE '".$gBid.".".substr($gKel,6,2).".__' ORDER BY Kd_Aset";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_6 WHERE Kd_Aset LIKE '".$gBid.".".substr($gKel,-2,2).".__' ORDER BY Kd_Aset";
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
		<?php } ?>		</td>
      <td>&nbsp;</td>
      <td>HARGA SATUAN (@ Rp)</td>
      <td><input name="fHarga" type="text" id="fHarga" value="<?php echo fConvertToRupiah($gHRG)?>" <?php if ($KeY=="Y") {echo "readonly";}?> onBlur="NumValidate(this)" onKeyUp="addSeparator(this)" style="width:130px; text-align: right; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 5px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr> 
      <td>RINCIAN</td>
      <td><table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
          <tr> 
            <td width="79%"> 
        <?php if ($rIDT) {?>
		<input name="fRin" type="text" readonly value="<?=$gRin?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fRiG" type="text" readonly value="<?=fGlobal("Nm_Aset ","ref_rek_aset108_7","Kd_Aset",$gRin,"=","","")?>" style=" width:255px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<?php } else {?>
		<select class="boxs" name="fRin" tabindex="0" style="width: 390px">
        <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset5 WHERE Kd_Aset LIKE '".$gBid.".".substr($gKel,6,2).".".substr($gOBJ,9,2).".___' ORDER BY Kd_Aset";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_7 WHERE Kd_Aset LIKE '".$gBid.".".substr($gKel,-2,2).".".substr($gOBJ,-2,2).".___' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
            if ($gRin=="") {$gRin=$mRo['Kd_Aset'];}
			if (substr($gRin,0,14)!=$gOBJ) {$gRin=$mRo['Kd_Aset'];}
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
            </select>
			<?php } ?>			</td>
            <td width="21%" valign="top">
			<?php if ($rIDT) {?>
			<a href="#" class="ico reff" onclick="P_MoveAccount('<?=$ReO?>','<?=$KeY?>','700','450','<?=$rIDT?>','<?=$_GET['IdL']?>'); return false" title="Ganti kode aset..!!">GANTI</a>
			<?php } else {?>
			<input type="button" name="B392" value="FIND" onclick="OpenAccNumb('600','500','center')" style="width: 50px; height: 22px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
			<?php } ?>			</td>
          </tr>
        </table></td>
      <td>&nbsp;</td>
      <td>NILAI PEROLEHAN (Rp)</td>
      <td><input name="fTotal" type="text" id="fTotal" <?=$gReaD?> value="<?=fConvertToRupiah($gTTL)?>" <?php if ($KeY=="Y") {echo "readonly";}?> style="width:130px; text-align: right; background-color: #E1F986; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 5px; padding-top: 1px; padding-bottom: 1px"/></td>
    </tr>
    <tr> 
      <td>REGISTER</td>
      <td>
	  <input name="fNoREG" type="text" class="text" id="fNoREG" <?php if ($rIDT==""){echo "readonly";}?> style="width:80px; padding-left:5px; background:#CCFF99; border: 1px solid #C0C0C0" value="<?=$gNoR?>" maxlength="8" /> (<i>Otomatis</i>)
	  </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>NAMA ASET </td>
      <td><input name="fNama" type="text" class="text" value="<?php echo $fNma?>" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" size="60" maxlength="100" />      </td>
      <td>&nbsp;</td>
      <td colspan="2">
		<table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
          <tr> 
            <td width="47%"> 
				<input type="button" name="B39" value="SIMPAN" onclick="P_Save('<?=$ReO?>')" <?php if ($ReO=='Y'){echo "disabled";}?> style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
              <input type="button" name="B393" value="RESET" onclick="P_Reset('<?=$ReO?>')" <?php if ($ReO=='Y'){echo "disabled";}?> style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /><?php if ($KeY=='Y') { echo "<div style='float:right'><img src='css/images/keys.png' /></div>";}?></td>
            <td width="7%"> 
            <input <?php echo $gDisB?> type="checkbox" name="fChoise" value="ON" /></td>
            <td width="46%">
              <?php echo $gTexB?>            </td>
          </tr>
        </table>	  </td>
    </tr>
    <tr> 
      <td>MERK</td>
      <td><input name="fMerk" type="text" class="text" value="<?php echo $gMrk ?>" style="width:430px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
        <span class="style1">*</span></td>
      <td>&nbsp;</td>
      <td colspan="2">
	  <table align="center" border="0" width="430" class="table-list" cellspacing="0" cellpadding="0" height="22">
	  <tr>
		<?php
		$iG=1;
		$SQL="SELECT IDT FROM ta_kib_108_pdf WHERE Referensi='$gREF' ORDER BY IDT";
		$nRs = mysql_query($SQL);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$gIDT = $mRo[0]; 
			?>
			<td width="30">PDF<?=$iG?></td>
			<td width="18"><a href="#" onClick="P_PRE('b','800','400','<?=$gIDT?>','<?=$_GET['IdL']?>'); return false" class="ico prev"></a></td>
			<td width="10" style="border-right:1px solid #CCCCCC"><a href="#" onClick="P_PDF('<?=$ReO?>','b','600','300','<?=$rIDT?>','<?=$gIDT?>','<?=$_GET['IdL']?>'); return false" class="ico reff"></a></td>
			<?php
			$iG++;
		}
		?>
	  <td><a href="#" onClick="P_PDF('<?=$ReO?>','b','600','300','<?=$rIDT?>','','<?=$_GET['IdL']?>'); return false" class="ico pdf">&nbsp;&nbsp;Upl.PDF</a></td>
	  </tr>
	  </table>	  </td>
    </tr>
    <tr> 
      <td>TYPE</td>
      <td><input name="fType" type="text" class="text" value="<?php echo $gTyp ?>" style="width:180px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
      <span class="style1">*</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;UKURAN / CC&nbsp;&nbsp;&nbsp;
	  <input name="fUkuranCC" type="text" class="text" id="fUkuranCC" style="width:130px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gUcc?>"/>	  </td>
      <td>&nbsp;</td>
      <td colspan="2" rowspan="9"> <table border="0" width="430" style="border-collapse: collapse; color: #CC0000; border: 1px solid #8FA908; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
          <tr> 
            <td width="12" bgcolor="#8FA908">&nbsp;</td>
            <td width="108" bgcolor="#8FA908">RESULT</td>
            <td width="15" bgcolor="#8FA908">&nbsp;</td>
            <td colspan="2" bgcolor="#8FA908">&nbsp;</td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr> 
            <td width="12">&nbsp;</td>
            <td width="108">REFERENSI</td>
            <td width="15">:</td>
            <td colspan="2"> 
              <?php echo $gREF?>            </td>
          </tr>
          <tr> 
            <td width="12">&nbsp;</td>
            <td width="108">KODE BARANG</td>
            <td width="15">:</td>
            <td colspan="2"> 
              <?php echo $gKDB.".".$gREG?>            </td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>REGISTER</td>
            <td>:</td>
            <td colspan="2"> 
              <?php echo $gREG?>            </td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>KODE LOKASI</td>
            <td>:</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>NILAI AKHIR </td>
            <td>:</td>
            <td colspan="2"> Rp.&nbsp;
              <?php echo fConvertToRupiah($gNIL)?>            </td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td width="116" rowspan="7" align="center" valign="middle">
			<table border="0" width="97" bgcolor="#FFFFFF" cellpadding="0" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
			  <tr>
			    <td height="15" align="center" valign="middle" style="border: 1px solid #C0C0C0"><a href="#" class="ico upl" onclick="OpenAccIMG('<?=$ReO?>','450','250','center'); return false;">&nbsp;&nbsp;FOTO OBJEK</a></td>
			  </tr>
			  <tr>
			    <td height="100" align="center" valign="middle" style="border: 1px solid #C0C0C0">
				<?php if ($gIMG!="") {?>
					<a href="#"><img src="<?="SourceIMG.php?rCRT=b&rIDT=".$rIDT?>" height="75" width="80" onclick="PreviewIMG('400','300','center')"></a>
				<?php } else {?>
					<img src="Images/FileLogin_70.gif" width="20" height="20">
				<?php } ?>				</td>
			  </tr>
			</table>			</td>
          </tr>
          <tr> 
            <td width="12">&nbsp;</td>
            <td width="108">REFERENSI GROUP</td>
            <td width="15">:</td>
            <td> 
              <?php echo $gGRP?>            </td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>REGISTER GROUP</td>
            <td>:</td>
            <td> 
              <?php if ($gREGa!="") {echo $gREGa." s.d ";} else {echo "-";}?>
              <?php if ($gREGb!="") {echo $gREGb;}?>            </td>
          </tr>
          <tr> 
            <td width="12">&nbsp;</td>
            <td width="108">&nbsp;</td>
            <td width="15">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td width="12">&nbsp;</td>
            <td width="108">RECORDED</td>
            <td width="15">:</td>
            <td>-</td>
          </tr>
          <tr> 
            <td width="12">&nbsp;</td>
            <td width="108">PENCATAT</td>
            <td width="15">:</td>
            <td>-</td>
          </tr>
          <tr> 
            <td width="12">&nbsp;</td>
            <td width="108">&nbsp;</td>
            <td width="15">&nbsp;</td>
            <td width="155">&nbsp;</td>
          </tr>
          <!--tr>
            <td>&nbsp;</td>
            <td colspan="4">
			[&nbsp;<a href="#" class="ico edit" onclick="OpenUbahNilai('950','520','center'); return false">PERUBAHAN NILAI</a>&nbsp;]&nbsp;&nbsp;
			[&nbsp;<a href="#" class="ico his" onclick="P_ViewHistory('800','400','center'); return false">HISTORY PERUBAHAN</a>&nbsp;]&nbsp;&nbsp;
			[&nbsp;<a href="#" class="ico doc" onclick="P_OpenDoc('800','400','KIB_B_Dokumen'); return false">DOKUMEN KIB</a>&nbsp;]			</td>
          </tr-->
          <tr>
            <td>&nbsp;</td>
            <td colspan="4">
			<table border="0" width="97%" cellpadding="0" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
			  <tr>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td>&nbsp;</td>
			    <td width="78">&nbsp;</td>
			    </tr>
			  <tr height="20">
			    <td width="96"><a href="#" class="ico edit" onclick="OpenUbahNilai('950','520','center'); return false">Perubahan Nilai</a></td>
			    <td width="115"><a href="#" class="ico his" onclick="P_ViewHistory('800','400','center'); return false">History Perubahan</a></td>
			    <td width="92"><a href="#" class="ico doc" onclick="P_OpenDoc('800','400','KIB_A_Dokumen'); return false">&nbsp;&nbsp;Dokumen KIB</a></td>
			    <td><a href="#" class="ico docu" onclick="P_OpenKibar('800','400','<?=$_GET['rIDT']?>','<?=$_GET['IdL']?>'); return false">&nbsp;Kibar</a></td>
			  </tr>
			  <tr height="20">
			    <td width="96"><a href="<?="P47_Penggunaan.php?BckFrm=B&rIDT=".$_GET['rIDT']."&IdL=".$_GET['IdL']?>" class="ico use">Penggunaan</a></td>
			    <td width="115"><a href="<?="P47_Pemanfaatan.php?BckFrm=B&rIDT=".$_GET['rIDT']."&IdL=".$_GET['IdL']?>" class="ico mesi">&nbsp;&nbsp;Pemanfaatan</a></td>
			    <td width="92"><a href="<?="P47_Pengamanan.php?BckFrm=B&rIDT=".$_GET['rIDT']."&IdL=".$_GET['IdL']?>" class="ico key">&nbsp;&nbsp;Pengamanan</a></td>
			    <td>&nbsp;</td>
			  </tr>
			</table>
			
			</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td>BAHAN</td>
      <td><input name="fBahan" type="text" class="text" id="fBahan" style="width:430px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gBHN?>"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>NOMOR PABRIK </td>
      <td><input name="fPabrik" type="text" class="text" id="fPabrik" style="width:150px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gPBR?>"/>&nbsp;*
	  &nbsp;&nbsp;&nbsp;NOMOR RANGKA&nbsp;&nbsp;&nbsp;
	  <input name="fRangka" type="text" class="text" id="fRangka" style="width:150px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gRKA?>"/>&nbsp;*</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>NOMOR MESIN </td>
      <td><input name="fMesin" type="text" class="text" id="fMesin" style="width:150px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gMSN?>" />&nbsp;*
	  &nbsp;&nbsp;&nbsp;NOMOR BPKB&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <input name="fBPKB" type="text" class="text" id="fBPKB" style="width:150px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gBPK?>" />&nbsp;*</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>NOMOR POLISI </td>
      <td>
	  <input name="fPolisi" type="text" class="text" value="<?=$gPLS?>" style=" width:150px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
      *&nbsp;&nbsp;&nbsp;&nbsp;NO. POL. LAMA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="fPolisiL" type="text" class="text" value="<?=$gPLSL?>" style=" width:150px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>PEMEGANG</td>
      <td>SEKARANG&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="fPemeg" type="text" class="text" value="<?=$gPMG?>" style=" width:341px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>SEBELUMNYA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="fPemegL" type="text" class="text" value="<?=$gPMGL?>" style=" width:341px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>KETERANGAN</td>
      <td rowspan="2"><textarea name="fKeterangan" id="fKeterangan" style=" height:60px; width:431px; border: 1px solid #C0C0C0"><?php echo $gKTR ?></textarea></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td valign="top">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
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
	function P_Save(ReO)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		var fMil = objfrm.fMilik.selectedIndex;
		var fKon = objfrm.fKondisi.selectedIndex;
		var fAsa = objfrm.fAsalUsul.selectedIndex;
		
		var fMer = objfrm.fMerk.value.length;
		var fTyp = objfrm.fType.value.length;
		var fRan = objfrm.fRangka.value.length;
		var Mes = objfrm.fMesin.value.length;
		var fPol = objfrm.fPolisi.value.length;
		var fBPK = objfrm.fBPKB.value.length;
		
		if (fMil==0) {
		window.alert("Kode Kepemilikan belum dipilih..!!");
		return false;}
		
		if (fKon==0) {
		window.alert("Kondisi barang belum dipilih..!!");
		return false;}
		
		if (fAsa==0) {
		window.alert("Asal usul perolehan belum dipilih..!!");
		return false;}
		
		if (fMer==0) {
		window.alert("Data merk barang belum terisi..!!");
		return false;}
		
		if (fTyp==0) {
		window.alert("Data tipe barang belum terisi..!!");
		return false;}
		
		if (fRan==0) {
		window.alert("Nomor rangka belum terisi..!!");
		return false;}
		
		if (Mes==0) {
		window.alert("Nomor mesin belum terisi..!!");
		return false;}
		
		if (fPol==0) {
		window.alert("Nomor polisi belum terisi..!!");
		return false;}
		
		if (fBPK==0) {
		window.alert("Nomor BPKB belum terisi..!!");
		return false;}
		
		objfrm.Simpan.value = "Save";
		objfrm.submit();
	}

	function P_Reset(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
		objfrm.Simpan.value = "Reset";
		objfrm.submit();
	}
	
	function OpenAccNumb(w,h,pos)
	{
		var win=null;
		var txtHTML = "";
  		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100;
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			<?php
				$URL_Top = "Find_Acc_Top.php?CrAcc=Form_Asset_B_Mid&IdL=".$_GET['IdL']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb;
				$URL_Mid = "Find_Acc_Mid.php?CrAcc=Form_Asset_B_Mid&IdL=".$_GET['IdL']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb;
				$URL_Bot = "Find_Acc_Bot.php";
			?>       			
			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}

	function OpenUbahNilai(w,h,pos)
	{	var win=null;
		var txtHTML = "";
  		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
			win=window.open('','',settings);
			if (win!=null)
    			{
      				win.window.document.open()       			
					<?php
					$URL_Top = "Form_Invent_Asset_Top.php?FrmG=INVENTARISASI -> PERUBAHAN NILAI -> KIB B (Peralatan dan Mesin)";
					$URL_Mid = "Form_Invent_Asset_Ubh.php?rKib=Kib_B&IdL=".$_GET['IdL']."&rIDT=".$rIDT;
					$URL_Bot = "Form_Invent_Asset_Bot.php";
					?>       			
       			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}
	
	function P_ViewHistory(w,h,pos)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		<?php
			{
			$URL="KIB_B_History.php?rIDT=".$rIDT."&IdL=".$_GET['IdL'];
			}
		?>
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open('<?php echo $URL?>','',settings);
	}
	
	function P_MoveAccount(ReO,KeY,w,h,rIDT,IdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		if (KeY=='Y') {alert('Access denied, data sudah terkunci..!!'); return false;}
		var win=null;
		var txtHTML = "";
  		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = 'Move_Account_Top.php?FrmG=PEMINDAHAN REKENING ASET -> KIB B (Peralatan dan Mesin)';
			URL_Mid = 'Move_Account_Mid.php?rKib=Kib_B&IdL='+IdL+'&rIDT='+rIDT;
			URL_Bot = 'Move_Account_Bot.php';
			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinReplAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinReplAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinReplAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
	
	function P_MoveUPB(ReO,KeY,w,h,rIDT,IdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		if (KeY=='Y') {alert('Access denied, data sudah terkunci..!!'); return false;}
		var win=null;
		var txtHTML = "";
  		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = 'Move_Upb_Kib_Top.php?FrmG=PEMINDAHAN KODE UPB -> KIB B (Peralatan dan Mesin)';
			URL_Mid = 'Move_Upb_Kib_Mid.php?rKib=Kib_B&IdL='+IdL+'&rIDT='+rIDT;
			URL_Bot = 'Move_Upb_Kib_Bot.php';
			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinReplAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinReplAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinReplAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
		
	function OpenAccIMGxxxxxxxxxxxx(ReO,w,h,pos)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		<?php
			{
			$URL="TestIMG.php?rIDT=".$rIDT."&IdL=".$_GET['IdL'];
			}
		?>
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open('<?php echo $URL?>','',settings);
	}
   
	function PreviewIMG(w,h,pos)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		<?php
			{
			$URL="PreviewIMG.php?rCRT=b&rIDT=".$rIDT."&IdL=".$_GET['IdL'];
			}
		?>
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=no,navigation=no';
		window.open('<?php echo $URL?>','',settings);
	}

	function OpenAccIMG(ReO,w,h,pos)
	{	
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		var win=null;
		var txtHTML = "";
  		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = "UploadIMG_Top.php?FrmG=UPLOAD FOTO ASET -> KIB B (PERLATAN DAN MESIN)";
			URL_Mid = "UploadIMG_Mid.php?"+"<?="rCRT=b&rIDT=".$rIDT."&IdL=".$_GET['IdL']?>";
			URL_Bot = "UploadIMG_Bot.php";
			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFindAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFindAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
	
	function P_PDF(ReO,crt,w,h,rIdT,gIdT,IdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		var win=null;
		var txtHTML = "";
  		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = 'UploadPDF_Top.php?FrmG=UPLOAD PDF';
			URL_Mid = 'UploadPDF_Mid.php?crt='+crt+'&rIdT='+rIdT+'&gIdT='+gIdT+'&IdL='+IdL;
			URL_Bot = 'UploadPDF_Bot.php';
			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFindAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFindAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
	
	function P_PRE(crt,w,h,rIdT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='UploadPDF_Pre.php?crt='+crt+'&rIdT='+rIdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=no,navigation=no';
		window.open(URL,'',settings);
	}

	
	function P_OpenDoc(w,h,doc)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL= doc +"<?=".php?rIDT=".$rIDT."&gMLK=".$gMLK."&IdL=".$_GET['IdL']?>";
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function P_OpenKibar(w,h,IdT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL= 'report/P47_Kibar_B.php?IdT='+IdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
</script>
