<?
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
</head>
<?
if (isset($_GET['rIDT'])) {$rIDT = $_GET['rIDT'];}
$gReaD= "readonly";
$gDisB= "hidden";
$KeY  = "N";
if ($rIDT!="")
{
	$nSQ = "SELECT * FROM ta_kib_g where IDT='".$rIDT."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gIMG  = $mRo['file_name'];	
		$gREF  = $mRo['Referensi'];
		$gGRP  = $mRo['Ref_Group'];
		$gKDB  = $mRo['Kd_Aset'];
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
	
		$gBid  = substr($mRo['Kd_Aset'],0,5);
		$gKel  = substr($mRo['Kd_Aset'],0,8);
		$gOBJ  = substr($mRo['Kd_Aset'],0,11);
		$gRin  = substr($mRo['Kd_Aset'],0,15);
		
		if ($mRo['Nm_Aset']=="") {$fNma = fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");}
		else {$fNma = $mRo['Nm_Aset'];}
		
		$gMrk  = $mRo['Merk'];
		$gTyp  = $mRo['Type'];
		$gUcc  = $mRo['Ukuran_CC'];
		$gBHN  = $mRo['Bahan'];
		$gPBR  = $mRo['Nomor_Pabrik'];
		$gRKA  = $mRo['Nomor_Rangka'];
		$gMSN  = $mRo['Nomor_Mesin'];
		$gPLS  = $mRo['Nomor_Polisi'];
		$gBPK  = $mRo['Nomor_BPKB'];
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
		
		$tKib= "G";
		$KeY = CekKey($gUnt,$gThn,'Kib_'.$tKib,'');
		
		//CEK GROUP
		if ($gGRP!="")		//Jika input rombongan / Nilai Jumlah_Satuan lebih dari 1 (satu) --> Maka Field Ref_Group tidak kosong.
		{
			$gREGa = fMakeRegister(fGlobal("RegFrom","ta_kib_group","Referensi",$gGRP,"=","",""),7);
			$gREGb = fMakeRegister(fGlobal("RegTo","ta_kib_group","Referensi",$gGRP,"=","",""),7);
			
			$gSTN = fGlobal("Jml_Item","ta_kib_group","Referensi",$gGRP,"=","","");
			$gTTL = fGlobal("Nilai_Total","ta_kib_group","Referensi",$gGRP,"=","","");
			$gHRG = $mRo['Harga'];
		}
		else
		{
			$gGRP = "NON GROUP";
			$gSTN = 1;
			$gTTL = $mRo['Harga'];
			$gHRG = $mRo['Harga'];
		}
		#$gNIa = fGlobal("IfNull(sum(debet),0)","ta_kib_post","Referensi",$gREF,"=","","");
		#$gNIb = fGlobal("IfNull(sum(kredit),0)","ta_kib_post","Referensi",$gREF,"=","","");
		
		$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi:Kd_UPB",$gREF.":".$gUnt."%","=:LIKE","","");
		$gNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Referensi:Kd_UPB",$gREF.":".$gUnt."%","=:LIKE","","");
		
		if ($gNIb != 0) {$gNIL = $gNIa - $gNIb;}
		else {$gNIL=$gNIa;}
	}
}
else
{
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
<form name="myfrm" method="post" action="<?php echo "Form_Asset_GB_Mid_.php?IdL=".$_GET['IdL']."&rIDT=".$rIDT ?>">
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
        <? if ($rIDT) {?>
		<input name="fUnt" type="text" readonly value="<?=$gUnt?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fUnG" type="text" readonly value="<?=fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUnt,"=","","")?>" style=" width:325px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<? } else {?>
		<select name="fUnt" tabindex="0" style="width: 450px" onchange="this.form.submit()">
        <?
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
	  <? } ?>	  </td>
      <td width="52">&nbsp;</td>
      <td width="149">KEPEMILIKAN</td>
      <td width="333"> 
        <select class="boxs" name="fMilik" style=" width:200px" tabindex="0">
          <option value=""></option>
          <?
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
        <? if ($rIDT) {?>
		<input name="fSub" type="text" readonly value="<?=$gSub?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fSuG" type="text" readonly value="<?=fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSub,"=","","")?>" style=" width:325px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<? } else {?>
        <select class="boxs" name="fSub" tabindex="0" style="width: 450px" onchange="this.form.submit()">
        <?
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
	  <? } ?>	  </td>
      <td width="52">&nbsp;</td>
      <td>KONDISI BARANG </td>
      <td> <select class="boxs" name="fKondisi" style="width:200px" tabindex="0">
          <option value=""></option>
          <?
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
      <td width="120">UPB</td>
      <td width="489"> 
        <? if ($rIDT) {?>
		<input name="fUpb" type="text" readonly value="<?=$gUpb?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fUpG" type="text" readonly value="<?=fGlobal("Nm_Upb ","ref_upb","Kd_Upb",$gUpb,"=","","")?>" style=" width:260px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="ico reff" onclick="P_MoveUPB('<?=$KeY?>','700','450','<?=$rIDT?>','<?=$_GET['IdL']?>'); return false" title="Ganti kode upb..!!">GANTI</a>
		<? } else {?>
        <select class="boxs" name="fUpb" tabindex="0" style="width: 450px" onchange="this.form.submit()">
        <?
		$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb where Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_Upb";
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
	  <? } ?>	  </td>
      <td width="52">&nbsp;</td>
      <td>ASAL USUL</td>
      <td><select name="fAsalUsul" class="boxs" id="select2" style="width:200px" tabindex="0">
          <option value=""></option>
          <?
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
      <td>&nbsp;</td>
      <td valign="middle">&nbsp;</td>
      <td>&nbsp;</td>
      <td>TGL. PEROLEHAN</td>
      <td><select class="boxs" name="fHri" tabindex="0" style="width:45px">
        <?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$gHri) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
      </select>
		&nbsp;
		<select class="boxs" name="fBln" tabindex="0" style="width:90px">
		  <?
				for($nBln=1; $nBln<=12; $nBln++)
				{
					$sel ="";
					if ($nBln==$gBln) {$sel ="selected";}
					echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
				}
				?>
		</select>
		&nbsp;
		<? if ($KeY=="Y") {?>
			<input name="fThn" readonly type="text" value="<?=$gThn?>" style="width:50px; text-align : center; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" />
		<? } else {?>
			<select class="boxs" name="fThn" style="width: 60px" tabindex="0">
			  <?
				for($nThn=1900; $nThn<=2030; $nThn++)
				{
				$sel ="";
				if ($nThn==$gThn) {$sel ="selected";}
				echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
				}
				?>
			</select>
			<? } ?>			</td>
    </tr>
    <tr> 
      <td>KELOMPOK</td>
      <td>
        <? if ($rIDT) {?>
		<input name="fBid" type="text" readonly value="<?=$gBid?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fBiG" type="text" readonly value="<?=fGlobal("Nm_Aset ","ref_rek_aset2","Kd_Aset",$gBid,"=","","")?>" style=" width:325px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<? } else {?>
	    <select class="boxs" name="fBid" tabindex="0" style="width: 450px" onchange="this.form.submit()">
        <option value=""></option>
        <?
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset2 WHERE Kd_Aset LIKE '02.__' ORDER BY Kd_Aset";
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
		<? } ?>		</td>
      <td>&nbsp;</td>
      <td>TGL. MUTASI MASUK </td>
      <td>
		<select class="boxs" name="fHriM" tabindex="0" style="width:45px">
		<option value="00"></option>
		<?
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
		<?
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
		<?
		for($nThn=1900; $nThn<=2030; $nThn++)
		{
			$sel ="";
			if ($nThn==$gThnM) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>
	  </td>
    </tr>
    <tr> 
      <td>JENIS</td>
      <td>
        <? if ($rIDT) {?>
		<input name="fKel" type="text" readonly value="<?=$gKel?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fKeG" type="text" readonly value="<?=fGlobal("Nm_Aset ","ref_rek_aset3","Kd_Aset",$gKel,"=","","")?>" style=" width:325px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<? } else {?>
	    <select class="boxs" name="fKel" tabindex="0" style="width: 450px" onchange="this.form.submit()">
        <?
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset3 WHERE Kd_Aset LIKE '".$gBid.".__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gKel=="") {$gKel=$mRo['Kd_Aset'];}
			if (substr($gKel,0,5)!=$gBid) {$gKel=$mRo['Kd_Aset'];}
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
		<? } ?>		</td>
      <td>&nbsp;</td>
      <td>UMUR EKONOMIS</td>
      <td><input name="fManfaat" type="text" id="fManfaat" value="<?=$gMSM?>" onblur="NumValidate(this)" style=" width:55px; text-align: center; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>&nbsp;Tahun</td>
    </tr>
    <tr> 
      <td>OBJEK</td>
      <td>
        <? if ($rIDT) {?>
		<input name="fOBJ" type="text" readonly value="<?=$gOBJ?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fOBG" type="text" readonly value="<?=fGlobal("Nm_Aset ","ref_rek_aset4","Kd_Aset",$gOBJ,"=","","")?>" style=" width:325px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<? } else {?>
	    <select class="boxs" name="fOBJ" tabindex="0" style="width: 450px" onchange="this.form.submit()">
        <?
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset4 WHERE Kd_Aset LIKE '".$gBid.".".substr($gKel,6,2).".__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gOBJ=="") {$gOBJ=$mRo['Kd_Aset'];}
			if (substr($gOBJ,0,8)!=$gKel) {$gOBJ=$mRo['Kd_Aset'];}
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
		<? } ?>		</td>
      <td>&nbsp;</td>
      <td>JUMLAH SATUAN</td>
      <td><input name="fSatuan" type="text" id="fSatuan" value="<? echo $gSTN?>" <? if ($KeY=="Y") {echo "readonly";}?> onblur="NumValidate(this)" onkeyup="addSeparator(this)" style="width:50px; text-align : right; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 5px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr> 
      <td>RINCIAN</td>
      <td><table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
          <tr> 
            <td width="79%"> 
        <? if ($rIDT) {?>
		<input name="fRin" type="text" readonly value="<?=$gRin?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fRiG" type="text" readonly value="<?=fGlobal("Nm_Aset ","ref_rek_aset5","Kd_Aset",$gRin,"=","","")?>" style=" width:255px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<? } else {?>
		<select class="boxs" name="fRin" tabindex="0" style="width: 390px">
        <?
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset5 WHERE Kd_Aset LIKE '".$gBid.".".substr($gKel,6,2).".".substr($gOBJ,9,2).".___' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
            if ($gRin=="") {$gRin=$mRo['Kd_Aset'];}
			if (substr($gRin,0,11)!=$gOBJ) {$gRin=$mRo['Kd_Aset'];}
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
			<? } ?>			</td>
            <td width="21%" valign="top">
			<? if ($rIDT) {?>
			<a href="#" class="ico reff" onclick="P_MoveAccount('<?=$KeY?>','700','450','<?=$rIDT?>','<?=$_GET['IdL']?>'); return false" title="Ganti kode aset..!!">GANTI</a>
			<? } else {?>
			<input type="button" name="B392" value="FIND" onclick="OpenAccNumb('600','500','center')" style="width: 50px; height: 22px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
			<? } ?>			</td>
          </tr>
        </table></td>
      <td>&nbsp;</td>
      <td>HARGA SATUAN (@ Rp)</td>
      <td><input name="fHarga" type="text" id="fHarga" value="<? echo fConvertToRupiah($gHRG)?>" <? if ($KeY=="Y") {echo "readonly";}?> onblur="NumValidate(this)" onkeyup="addSeparator(this)" style="width:130px; text-align: right; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 5px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>NILAI PEROLEHAN (Rp)</td>
      <td><input name="fTotal" type="text" id="fTotal" <?=$gReaD?> value="<?=fConvertToRupiah($gTTL)?>" <? if ($KeY=="Y") {echo "readonly";}?> style="width:130px; text-align: right; background-color: #E1F986; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 5px; padding-top: 1px; padding-bottom: 1px"/></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>NAMA ASET </td>
      <td><input name="fNama" type="text" class="text" value="<? echo $fNma?>" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" size="60" maxlength="100" />      </td>
      <td>&nbsp;</td>
      <td colspan="2">
		<table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
          <tr> 
            <td width="47%"> 
				<input type="button" name="B39" value="SIMPAN" onclick="P_Save('<?=$ReO?>')" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
              <input type="button" name="B393" value="RESET" onclick="P_Reset('<?=$ReO?>')" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /><? if ($KeY=='Y') { echo "<div style='float:right'><img src='css/images/keys.png' /></div>";}?></td>
            <td width="7%"> 
            <input <? echo $gDisB?> type="checkbox" name="fChoise" value="ON" /></td>
            <td width="46%">
              <? echo $gTexB?>            </td>
          </tr>
        </table>	  </td>
    </tr>
    <tr> 
      <td>MERK</td>
      <td><input name="fMerk" type="text" class="text" value="<?php echo $gMrk ?>" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" size="60" maxlength="50" />
        <span class="style1">*</span></td>
      <td>&nbsp;</td>
      <td colspan="2">
	  <table align="center" border="0" width="430" class="table-list" cellspacing="0" cellpadding="0" height="22">
	  <tr>
		<?
		$iG=1;
		$SQL="SELECT IDT FROM ta_kib_g_pdf WHERE Referensi='$gREF' ORDER BY IDT";
		$nRs = mysql_query($SQL);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$gIDT = $mRo[0]; 
			?>
			<td width="30">PDF<?=$iG?></td>
			<td width="18"><a href="#" onClick="P_PRE('gb','800','400','<?=$gIDT?>','<?=$_GET['IdL']?>'); return false" class="ico prev"></a></td>
			<td width="10" style="border-right:1px solid #CCCCCC"><a href="#" onClick="P_PDF('gb','600','300','<?=$rIDT?>','<?=$gIDT?>','<?=$_GET['IdL']?>'); return false" class="ico edit"></a></td>
			<?
			$iG++;
		}
		?>
	  <td><a href="#" onClick="P_PDF('gb','600','300','<?=$rIDT?>','','<?=$_GET['IdL']?>'); return false" class="ico pdf">&nbsp;&nbsp;Upl.PDF</a></td>
	  </tr>
	  </table>	  </td>
    </tr>
    <tr> 
      <td>TYPE</td>
      <td><input name="fType" type="text" class="text" value="<?php echo $gTyp ?>" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" size="60" maxlength="50" />
      <span class="style1">*</span></td>
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
              <? echo $gREF?>            </td>
          </tr>
          <tr> 
            <td width="12">&nbsp;</td>
            <td width="108">KODE BARANG</td>
            <td width="15">:</td>
            <td colspan="2"> 
              <? echo $gKDB.".".$gREG?>            </td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>REGISTER</td>
            <td>:</td>
            <td colspan="2"> 
              <? echo $gREG?>            </td>
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
              <? echo fConvertToRupiah($gNIL)?>            </td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td width="116" rowspan="7" align="center" valign="middle">
			<table border="0" width="97" bgcolor="#FFFFFF" cellpadding="0" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
			  <tr>
			    <td height="15" align="center" valign="middle" style="border: 1px solid #C0C0C0"><a href="#" class="ico upl" onclick="OpenAccIMG('450','250','center')">&nbsp;&nbsp;FOTO OBJEK</a></td>
			  </tr>
			  <tr>
			    <td height="100" align="center" valign="middle" style="border: 1px solid #C0C0C0">
				<? if ($gIMG!="") {?>
					<a href="#"><img src="<?="SourceIMG.php?rCRT=gb&rIDT=".$rIDT?>" height="75" width="80" onclick="PreviewIMG('400','300','center')"></a>
				<? } else {?>
					<img src="Images/FileLogin_70.gif" width="20" height="20">
				<? } ?>				</td>
			  </tr>
			</table>			</td>
          </tr>
          <tr> 
            <td width="12">&nbsp;</td>
            <td width="108">REFERENSI GROUP</td>
            <td width="15">:</td>
            <td> 
              <? echo $gGRP?>            </td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>REGISTER GROUP</td>
            <td>:</td>
            <td> 
              <? if ($gREGa!="") {echo $gREGa." s.d ";} else {echo "-";}?>
              <? if ($gREGb!="") {echo $gREGb;}?>            </td>
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
          <tr>
            <td>&nbsp;</td>
            <td colspan="4">
			[&nbsp;<a href="#" class="ico edit" onclick="OpenUbahNilai('950','520','center'); return false">PERUBAHAN NILAI</a>&nbsp;]&nbsp;&nbsp;
			[&nbsp;<a href="#" class="ico his" onclick="P_ViewHistory('800','400','center'); return false">HISTORY PERUBAHAN</a>&nbsp;]&nbsp;&nbsp;
			[&nbsp;<a href="#" class="ico doc" onclick="P_OpenDoc('800','400','KIB_G_Dokumen'); return false">DOKUMEN KIB</a>&nbsp;]			</td>
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
      <td>UKURAN / CC</td>
      <td><input name="fUkuranCC" type="text" class="text" id="fUkuranCC" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gUcc?>" size="60" maxlength="50" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>BAHAN</td>
      <td><input name="fBahan" type="text" class="text" id="fBahan" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gBHN?>" size="60" maxlength="50" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>NOMOR PABRIK</td>
      <td><input name="fPabrik" type="text" class="text" id="fPabrik" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gPBR?>" size="60" maxlength="50" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>NOMOR RANGKA</td>
      <td><input name="fRangka" type="text" class="text" id="fRangka" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gRKA?>" size="60" maxlength="50" />
      <span class="style1">*</span></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>NOMOR MESIN</td>
      <td><input name="fMesin" type="text" class="text" id="fMesin" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gMSN?>" size="60" maxlength="50" />
      <span class="style1">*</span></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>NOMOR POLISI</td>
      <td><input name="fPolisi" type="text" class="text" value="<? echo $gPLS?>" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" size="60" maxlength="50" />
      <span class="style1">*</span></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>NOMOR BPKB</td>
      <td><input name="fBPKB" type="text" class="text" id="fBPKB" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gBPK?>" size="60" maxlength="50" />
      <span class="style1">*</span></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td valign="top">KETERANGAN</td>
      <td><textarea name="fKeterangan" cols="58" rows="2" id="fKeterangan" style="border: 1px solid #C0C0C0"><? echo $gKTR ?></textarea></td>
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
	function P_Save(xR)
	{
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
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
			<?
				$URL_Top = "Find_Acc_Top.php?CrAcc=Form_Asset_GB_Mid&IdL=".$_GET['IdL']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb;
				$URL_Mid = "Find_Acc_Mid.php?CrAcc=Form_Asset_GB_Mid&IdL=".$_GET['IdL']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb;
				$URL_Bot = "Find_Acc_Bot.php";
			?>       			
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<? echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<? echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<? echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
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
					<?
					$URL_Top = "Form_Invent_Asset_Top.php?FrmG=INVENTARISASI -> PERUBAHAN NILAI -> KIB LAINNYA";
					$URL_Mid = "Form_Invent_Asset_Ubh.php?rKib=Kib_GB&IdL=".$_GET['IdL']."&rIDT=".$rIDT;
					$URL_Bot = "Form_Invent_Asset_Bot.php";
					?>       			
       			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<? echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<? echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<? echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
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
		<?
			{
			$URL="KIB_G_History.php?rIDT=".$rIDT."&IdL=".$_GET['IdL'];
			}
		?>
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open('<?php echo $URL?>','',settings);
	}
	
	function P_MoveAccount(KeY,w,h,rIDT,IdL)
	{
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
			URL_Top = 'Move_Account_Top.php?FrmG=PEMINDAHAN REKENING ASET -> KIB LAINNYA';
			URL_Mid = 'Move_Account_Mid.php?rKib=Kib_GB&IdL='+IdL+'&rIDT='+rIDT;
			URL_Bot = 'Move_Account_Bot.php';
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinReplAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinReplAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinReplAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
	
	function P_MoveUPB(KeY,w,h,rIDT,IdL)
	{
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
			URL_Top = 'Move_Upb_Kib_Top.php?FrmG=PEMINDAHAN KODE UPB -> KIB LAINNYA';
			URL_Mid = 'Move_Upb_Kib_Mid.php?rKib=Kib_GB&IdL='+IdL+'&rIDT='+rIDT;
			URL_Bot = 'Move_Upb_Kib_Bot.php';
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinReplAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinReplAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinReplAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}	
	
	function OpenAccIMGx(w,h,pos)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		<?
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
		<?
			{
			$URL="PreviewIMG.php?rCRT=gb&rIDT=".$rIDT."&IdL=".$_GET['IdL'];
			}
		?>
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=no,navigation=no';
		window.open('<?php echo $URL?>','',settings);
	}

	function OpenAccIMG(w,h,pos)
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
			URL_Top = "UploadIMG_Top.php?FrmG=UPLOAD FOTO ASET -> KIB LAINNYA";
			URL_Mid = "UploadIMG_Mid.php?"+"<?="rCRT=gb&rIDT=".$rIDT."&IdL=".$_GET['IdL']?>";
			URL_Bot = "UploadIMG_Bot.php";
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFindAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFindAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
	
	function P_PDF(crt,w,h,rIdT,gIdT,IdL)
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
			URL_Top = 'UploadPDF_Top.php?FrmG=UPLOAD PDF';
			URL_Mid = 'UploadPDF_Mid.php?crt='+crt+'&rIdT='+rIdT+'&gIdT='+gIdT+'&IdL='+IdL;
			URL_Bot = 'UploadPDF_Bot.php';
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFindAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFindAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
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
</script>
