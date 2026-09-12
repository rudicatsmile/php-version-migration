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
	$nSQ = "SELECT * FROM ta_kib_108 WHERE IDT='".$rIDT."'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$gIMG  = $mRo['file_name'];	
		$gREF  = $mRo['Referensi'];
		$gGRP  = $mRo['Ref_Group'];
		$gKDB  = $mRo['Kd_Aset_108'];
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
		
		$gPjg  = $mRo['Panjang'];
		$gLbr  = $mRo['Lebar'];
		$gLua  = $mRo['Luas'];
		$gNoD  = $mRo['Dokumen_Nomor'];
		$gKns  = $mRo['Konstruksi'];
		$gLKS  = $mRo['Lokasi'];
		$gSTT  = $mRo['Status_Tanah'];
		
		$gBTN  = $mRo['Beton'];
		$gTKT  = $mRo['Bertingkat'];
		
		$gKdT  = $mRo['Kode_Tanah'];
		$gKTR  = $mRo['Keterangan'];
		
		$gMLK  = $mRo['Kd_Pemilik'];
		$gKDS  = $mRo['Tipe_Bangunan'];
		$gAUS  = $mRo['Asal_Usul'];
		
		$gHri  = (int)substr($mRo['Tgl_Perolehan'],8,10);
		$gBln  = (int)substr($mRo['Tgl_Perolehan'],5,-3);
		$gThn  = (int)substr($mRo['Tgl_Perolehan'],0,-6);
		
		$tKib= "F";
		$KeY = CekKey($gUnt,$gThn,'Kib_'.$tKib,'');
		
		$gHriD = (int)substr($mRo['Dokumen_Tanggal'],8,10);
		$gBlnD = (int)substr($mRo['Dokumen_Tanggal'],5,-3);
		$gThnD = (int)substr($mRo['Dokumen_Tanggal'],0,-6);

		$gHriM = (int)substr($mRo['Tgl_Mulai'],8,10);
		$gBlnM = (int)substr($mRo['Tgl_Mulai'],5,-3);
		$gThnM = (int)substr($mRo['Tgl_Mulai'],0,-6);

		//CEK GROUP
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
		$gNIa = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi",$gREF,"=","","");
		$gNIb = fGlobal("IfNull(sum(Kredit),0)","ta_kib_post_108","Referensi",$gREF,"=","","");
		if ($gNIb != 0) {$gNIL = $gNIa - $gNIb;}
		else {$gNIL=$gNIa;}
	}
}
else
{
	$gMLK  = 12;
	$gSTN  = 0;
	$gTTL  = 0;
	$gHRG  = 0;
	$gPjg  = 0;
	$gLbr  = 0;
	$gLua  = 0;
	
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
	
	//$gHriD = fGetDate('mday');
	//$gBlnD = fGetDate('mon');
	//$gThnD = fGetDate('year');
}
?>
	<?
	#$rIDT="";
	?>
<body>
<form name="myfrm" method="post" action="<?php echo "Form_Asset_F_Mid_.php?IdL=".$_GET['IdL']."&rIDT=".$rIDT ?>">
<input type="hidden" name="Simpan">
  <table border="0" align="center" width="1165">
    <tr>
      <td height="5"></td>
      <td height="5"></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr> 
      <td width="114" align="right">UNIT KERJA</td>
      <td width="16">&nbsp;</td>
      <td width="528">
        <? if ($rIDT) {?>
		<input name="fUnt" type="text" readonly value="<?=$gUnt?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fUnG" type="text" readonly value="<?=fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUnt,"=","","")?>" style=" width:325px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<? } else {?>
	    <select name="fUnt" tabindex="0" style="width:480px" onchange="this.form.submit()">
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
	  <? } ?>      </td>
      <td width="16">&nbsp;</td>
      <td width="132" align="right">KEPEMILIKAN</td>
      <td width="11">&nbsp;</td>
      <td width="318"> <select class="boxs" name="fMilik" style="width: 250px" tabindex="0">
          <option value=""></option>
          <?
		$nSQ = "SELECT * FROM ref_pemilik ORDER BY Kd_Pemilik";
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
      <td width="114" align="right">SUB UNIT</td>
      <td width="16">&nbsp;</td>
      <td width="528">
        <? if ($rIDT) {?>
		<input name="fSub" type="text" readonly value="<?=$gSub?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fSuG" type="text" readonly value="<?=fGlobal("Nm_Sub","ref_sub_unit","Kd_Sub",$gSub,"=","","")?>" style=" width:325px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<? } else {?>
	    <select class="boxs" name="fSub" tabindex="0" style="width:480px" onchange="this.form.submit()">
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
      <td width="16">&nbsp;</td>
      <td align="right">TIPE BANGUNAN </td>
      <td>&nbsp;</td>
      <td>
	  <select class="boxs" name="fKondisi" style="width: 250px" tabindex="0">
	  <option value="-"></option>
	  <option <? if ($gKDS=="P") {echo "selected";}?> value="P">Permanen</option>
	  <option <? if ($gKDS=="SP") {echo "selected";}?> value="SP">Semi Permanen</option>
	  <option <? if ($gKDS=="D") {echo "selected";}?> value="D">Darurat</option>
      </select></td>
    </tr>
    <tr> 
      <td align="right">UPB</td>
      <td>&nbsp;</td>
      <td width="528">
        <? if ($rIDT) {?>
		<input name="fUpb" type="text" readonly value="<?=$gUpb?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fUpG" type="text" readonly value="<?=fGlobal("Nm_Upb ","ref_upb","Kd_Upb",$gUpb,"=","","")?>" style=" width:260px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="ico reff" onclick="P_MoveUPB('<?=$ReO?>','<?=$KeY?>','700','450','<?=$rIDT?>','<?=$_GET['IdL']?>'); return false" title="Ganti kode upb..!!">GANTI</a>
		<? } else {?>
	    <select class="boxs" name="fUpb" tabindex="0" style="width:480px" onchange="this.form.submit()">
        <?
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
		<? } ?>	  </td>
      <td width="16">&nbsp;</td>
      <td align="right">ASAL USUL</td>
      <td>&nbsp;</td>
      <td><select name="fAsalUsul" class="boxs" id="select2" style="width: 250px" tabindex="0">
          <option value="-"></option>
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
      <td>&nbsp;</td>
      <td valign="middle">&nbsp; </td>
      <td>&nbsp;</td>
      <td align="right">TANGGAL MULAI</td>
      <td>&nbsp;</td>
      <td>
	  <select class="boxs" name="fHriM" tabindex="0">';
	  <option value=""></option>
          <?
		for($nHriM=1; $nHriM<=31; $nHriM++)
		{
			$sel ="";
			if ($nHriM==$gHriM) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHriM.'">'.$nHriM.'</option>';
		}
		?>
        </select> &nbsp;
		<select class="boxs" name="fBlnM" tabindex="0">
		<option value=""></option>
          <?
		for($nBlnM=1; $nBlnM<=12; $nBlnM++)
		{
			$sel ="";
			if ($nBlnM==$gBlnM) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBlnM.'">'.fNmBulan($nBlnM).'</option>';
		}
		?>
        </select> &nbsp;
		<select class="boxs" name="fThnM" style="width: 60px" tabindex="0">
		<option value=""></option>
          <?
			for($nThnM=1900; $nThnM<=2030; $nThnM++)
			{
			$sel ="";
			if ($nThnM==$gThnM) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThnM.'">'.$nThnM.'</option>';
			}
			?>
        </select>	  </td>
    </tr>
    <tr> 
      <td align="right">OBJEK</td>
      <td>&nbsp;</td>
      <td>
        <? if ($rIDT) {?>
		<input name="fBid" type="text" readonly value="<?=$gBid?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fBiG" type="text" readonly value="<?=fGlobal("Nm_Aset ","ref_rek_aset108_4","Kd_Aset",$gBid,"=","","")?>" style=" width:325px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<? } else {?>
	  <select class="boxs" name="fBid" tabindex="0" style="width:480px" onchange="this.form.submit()">
          <option value=""></option>
          <?
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset2 WHERE Kd_Aset like '06.__' ORDER BY Kd_Aset";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '1.3.6.__' ORDER BY Kd_Aset";
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
      <td align="right">TANGGAL PEROLEHAN</td>
      <td>&nbsp;</td>
      <td><select class="boxs" name="fHri" tabindex="0">';
          <?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$gHri) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
        </select> &nbsp; <select class="boxs" name="fBln" tabindex="0">
          <?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$gBln) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
        </select> &nbsp; 
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
		<? } ?>	  </td>
    </tr>
    <tr> 
      <td align="right">RINCIAN OBJEK </td>
      <td>&nbsp;</td>
      <td>
        <? if ($rIDT) {?>
		<input name="fKel" type="text" readonly value="<?=$gKel?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fKeG" type="text" readonly value="<?=fGlobal("Nm_Aset ","ref_rek_aset108_5","Kd_Aset",$gKel,"=","","")?>" style=" width:325px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<? } else {?>
	  <select class="boxs" name="fKel" tabindex="0" style="width:480px" onchange="this.form.submit()">
          <?
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
		<? } ?>		</td>
      <td>&nbsp;</td>
      <td align="right">JUMLAH SATUAN</td>
      <td>&nbsp;</td>
      <td>
	  <input name="fSatuan" type="text" id="fSatuan" maxlength="4" value="<?=$gSTN?>" <? if ($KeY=="Y") {echo "readonly";}?> onBlur="NumValidate(this)" onKeyUp="addSeparator(this)" style="width:50px; text-align : right; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 5px; padding-top: 1px; padding-bottom: 1px" />	  </td>
    </tr>
    <tr> 
      <td align="right">SUB ROBJ</td>
      <td>&nbsp;</td>
      <td>
        <? if ($rIDT) {?>
		<input name="fOBJ" type="text" readonly value="<?=$gOBJ?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fOBG" type="text" readonly value="<?=fGlobal("Nm_Aset ","ref_rek_aset108_6","Kd_Aset",$gOBJ,"=","","")?>" style=" width:325px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<? } else {?>
	  <select class="boxs" name="fOBJ" tabindex="0" style="width:480px" onchange="this.form.submit()">
          <?
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
		<? } ?>		</td>
      <td>&nbsp;</td>
      <td align="right">HARGA SATUAN</td>
      <td>&nbsp;</td>
      <td>
	  <input name="fHarga" type="text" id="fHarga" value="<?=fConvertToRupiah($gHRG)?>" <? if ($KeY=="Y") {echo "readonly";}?> onBlur="NumValidate(this)" onKeyUp="addSeparator(this)" style="width:130px; text-align: right; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 5px; padding-top: 1px; padding-bottom: 1px" />	  </td>
    </tr>
    <tr> 
      <td align="right">SUB-SUB ROBJ</td>
      <td>&nbsp;</td>
      <td>
		<table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
			<? if ($rIDT) {?>
			<tr> 
				<td width="400px"> 
				<input name="fRin" type="text" readonly value="<?=$gRin?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
				<input name="fRiG" type="text" readonly value="<?=fGlobal("Nm_Aset ","ref_rek_aset108_7","Kd_Aset",$gRin,"=","","")?>" style=" width:255px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>				</td>
				<td><a href="#" class="ico reff" onclick="P_MoveAccount('<?=$ReO?>','<?=$KeY?>','700','450','<?=$rIDT?>','<?=$_GET['IdL']?>'); return false" title="Ganti kode aset..!!">GANTI</a></td>
			</tr>
			<? }else{?>
			<tr>
				<td width="427px"> 
				<select class="boxs" name="fRin" tabindex="0" style="width:427px">
				<?
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
				</select>				</td>
				<td valign="top">
				<input type="button" name="B392" value="FIND" <? if ($KeY=='Y') {echo "disabled";}?> onclick="OpenAccNumb('600','500','center')" style="width: 50px; height: 22px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />				</td>
			</tr>
			<? } ?>
		</table>	  </td>
      <td>&nbsp;</td>
      <td align="right">NILAI PEROLEHAN</td>
      <td>&nbsp;</td>
      <td>
	  <input name="fTotal" type="text" id="fTotal" <?=$gReaD?> value="<?=fConvertToRupiah($gTTL)?>" <? if ($KeY=="Y") {echo "readonly";}?> style="width:130px; text-align: right; background-color: #E1F986; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 5px; padding-top: 1px; padding-bottom: 1px"/>	  </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td align="right">NAMA BARANG</td>
      <td>&nbsp;</td>
      <td><input name="fNama" type="text" class="text" value="<? echo $fNma?>" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" size="60" maxlength="100" />      </td>
      <td>&nbsp;</td>
      <td colspan="3">
		<table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
          <tr> 
            <td width="47%"> 
<input type="button" name="B39" value="SIMPAN" onclick="P_Save('<?=$ReO?>')" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
              <input type="button" name="B393" value="RESET" onclick="P_Reset('<?=$ReO?>')" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /><? if ($KeY=='Y') { echo "<div style='float:right'><img src='css/images/keys.png' /></div>";}?></td>
            <td width="6%"> 
              <input <? echo $gDisB?> type="checkbox" name="fChoise" value="ON" /></td>
            <td width="47%">
              <? echo $gTexB?>            </td>
          </tr>
        </table>	  </td>
    </tr>
    <tr> 
      <td align="right">KONTRUKSI</td>
      <td>&nbsp;</td>
      <td>
		  <table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
		  <tr> 
			<td width="89" valign="top" style="font-weight: bold; color: #008000">BERTINGKAT </td>
			<td width="156" valign="middle">
              <select class="boxs" name="fTingkat" style="width: 190px; width:120px" tabindex="0">
                <option value=""></option>
                <option <? if ($gTKT=="Bertingkat") {echo "selected";}?> value="Bertingkat">Bertingkat</option>
                <option <? if ($gTKT=="Tidak") {echo "selected";}?> value="Tidak">Tidak</option>
            </select></td>
			<td width="59" valign="middle" style="font-weight: bold; color: #008000">BETON</td>
			<td width="214" valign="middle"> 
              <select class="boxs" name="fBeton" style="width: 150px; width:120px" tabindex="0">
				<option value=""></option>
				<option <? if ($gBTN=="Beton") {echo "selected";}?> value="Beton">Ya</option>
				<option <? if ($gBTN=="Tidak") {echo "selected";}?> value="Tidak">Tidak</option>
			</select>			</td>
		  </tr>
		  </table>	  </td>
      <td>&nbsp;</td>
      <td colspan="3">
	  <table align="center" border="0" width="430" class="table-list" cellspacing="0" cellpadding="0" height="22">
	  <tr>
		<?
		$iG=1;
		$SQL="SELECT IDT FROM ta_kib_108_pdf WHERE Referensi='$gREF' ORDER BY IDT";
		$nRs = mysql_query($SQL);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$gIDT = $mRo[0]; 
			?>
			<td width="30">PDF<?=$iG?></td>
			<td width="18"><a href="#" onClick="P_PRE('f','800','400','<?=$gIDT?>','<?=$_GET['IdL']?>'); return false" class="ico prev"></a></td>
			<td width="10" style="border-right:1px solid #CCCCCC"><a href="#" onClick="P_PDF('<?=$ReO?>','f','600','300','<?=$rIDT?>','<?=$gIDT?>','<?=$_GET['IdL']?>'); return false" class="ico reff"></a></td>
			<?
			$iG++;
		}
		?>
	  <td><a href="#" onClick="P_PDF('<?=$ReO?>','f','600','300','<?=$rIDT?>','','<?=$_GET['IdL']?>'); return false" class="ico pdf">&nbsp;&nbsp;Upl.PDF</a></td>
	  </tr>
	  </table>	  </td>
    </tr>
    <tr> 
      <td align="right">PANJANG</td>
      <td>&nbsp;</td>
      <td><input name="fPanjang" type="text" class="text" id="fPanjang2" onBlur="NumValidate(this)" onKeyUp="addSeparator(this)" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo fConvertToRupiah($gPjg)?>" size="20" maxlength="15" />
      M</td>
      <td>&nbsp;</td>
      <td colspan="3" rowspan="9"> <table border="0" width="430" style="border-collapse: collapse; color: #CC0000; border: 1px solid #8FA908; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
          <tr> 
            <td width="14" bgcolor="#8FA908">&nbsp;</td>
            <td width="116" bgcolor="#8FA908">RESULT</td>
            <td width="18" bgcolor="#8FA908">&nbsp;</td>
            <td colspan="2" bgcolor="#8FA908">&nbsp;</td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr> 
            <td width="14">&nbsp;</td>
            <td width="116">REFERENSI</td>
            <td width="18">:</td>
            <td colspan="2"> 
              <? echo $gREF?>            </td>
          </tr>
          <tr> 
            <td width="14">&nbsp;</td>
            <td width="116">KODE BARANG</td>
            <td width="18">:</td>
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
            <td>NILAI AKHIR</td>
            <td>:</td>
            <td colspan="2"> Rp.&nbsp;
              <? echo fConvertToRupiah($gNIL)?>            </td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td width="141">&nbsp;</td>
            <td width="117" rowspan="7" align="center" valign="middle">
			<table border="0" width="97" bgcolor="#FFFFFF" cellpadding="0" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
			  <tr>
			    <td height="15" align="center" valign="middle" style="border: 1px solid #C0C0C0"><a href="#" class="ico upl" onclick="OpenAccIMG('<?=$ReO?>','450','250','center')">&nbsp;&nbsp;FOTO OBJEK</a></td>
			  </tr>
			  <tr>
			    <td height="100" align="center" valign="middle" style="border: 1px solid #C0C0C0">
				<? if ($gIMG!="") {?>
					<a href="#"><img src="<?="SourceIMG.php?rCRT=f&rIDT=".$rIDT?>" height="75" width="80" onclick="PreviewIMG('400','300','center')"></a>
				<? } else {?>
					<img src="Images/FileLogin_70.gif" width="20" height="20">
				<? } ?>				</td>
			  </tr>
			</table>			</td>
          </tr>
          <tr> 
            <td width="14">&nbsp;</td>
            <td width="116">REFERENSI GROUP</td>
            <td width="18">:</td>
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
            <td width="14">&nbsp;</td>
            <td width="116">&nbsp;</td>
            <td width="18">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td width="14">&nbsp;</td>
            <td width="116">RECORDED</td>
            <td width="18">:</td>
            <td>-</td>
          </tr>
          <tr> 
            <td width="14">&nbsp;</td>
            <td width="116">PENCATAT</td>
            <td width="18">:</td>
            <td>-</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <!--tr>
            <td>&nbsp;</td>
            <td colspan="4">[&nbsp;<a href="#" class="ico edit" onclick="OpenUbahNilai('950','520','center'); return false">PERUBAHAN NILAI</a>&nbsp;]&nbsp;&nbsp;
			[&nbsp;<a href="#" class="ico his" onclick="P_ViewHistory('800','400','center'); return false">HISTORY PERUBAHAN</a>&nbsp;]&nbsp;&nbsp;
			[&nbsp;<a href="#" class="ico doc" onclick="P_OpenDoc('800','400','KIB_F_Dokumen'); return false">DOKUMEN KIB</a>&nbsp;]			</td>
          </tr-->
          <tr>
            <td>&nbsp;</td>
            <td colspan="4"><table border="0" width="97%" cellpadding="0" style="font-size: 8pt; font-family: Calibri; border-collapse: collapse">
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
                <td width="96"><a href="<?="P47_Penggunaan.php?BckFrm=F&rIDT=".$_GET['rIDT']."&IdL=".$_GET['IdL']?>" class="ico use">Penggunaan</a></td>
                <td width="115"><a href="#<?="P47_Pemanfaatan.php?BckFrm=F&rIDT=".$_GET['rIDT']."&IdL=".$_GET['IdL']?>" class="ico mesi">&nbsp;&nbsp;Pemanfaatan</a></td>
                <td width="92"><a href="#<?="P47_Pengamanan.php?BckFrm=F&rIDT=".$_GET['rIDT']."&IdL=".$_GET['IdL']?>" class="ico key">&nbsp;&nbsp;Pengamanan</a></td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr> 
            <td width="14">&nbsp;</td>
            <td width="116">&nbsp;</td>
            <td width="18">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td align="right">LEBAR</td>
      <td>&nbsp;</td>
      <td><input name="fLebar" type="text" class="text" id="fLebar" onBlur="NumValidate(this)" onKeyUp="addSeparator(this)" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo fConvertToRupiah($gLbr)?>" size="20" maxlength="15" />
      M</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td align="right">LUAS LANTAI </td>
      <td>&nbsp;</td>
      <td><input name="fLuas" type="text" class="text" id="fLuas" onBlur="NumValidate(this)" onKeyUp="addSeparator(this)" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo fConvertToRupiah($gLua)?>" size="20" maxlength="15" />
        M<sup>2</sup> </td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td align="right">TGL. DOKUMEN</td>
      <td>&nbsp;</td>
      <td>
	  <select name="fHriD" class="boxs" id="select6" tabindex="0">
	  <option value=""></option>
          <?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$gHriD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
        </select> &nbsp;
		<select name="fBlnD" class="boxs" id="select7" tabindex="0">
	    <option value=""></option>
          <?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$gBlnD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
        </select> &nbsp; 
		<select name="fThnD" class="boxs" id="select8" style="width: 60px" tabindex="0">
	    <option value=""></option>
          <?
			for($nThn=1900; $nThn<=2030; $nThn++)
			{
			$sel ="";
			if ($nThn==$gThnD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
        </select> </td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td align="right">NO. DOKUMEN</td>
      <td>&nbsp;</td>
      <td><input name="fNoDok" type="text" class="text" id="fNoDok4" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gNoD?>" size="60" maxlength="50" />      </td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td align="right">LOKASI</td>
      <td>&nbsp;</td>
      <td><input name="fLokasi" type="text" class="text" id="fAlamat3" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gLKS?>" size="60" maxlength="50" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td align="right">KODE TANAH</td>
      <td>&nbsp;</td>
      <td><table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
          <tr> 
            <td style="font-weight: bold; color: #008000" width="297"> <input name="fKdTanah" type="text" class="text" id="fKdTanah4" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gKdT?>" size="20" maxlength="23" /></td>
            <td width="226">&nbsp;</td>
          </tr>
        </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td align="right">STATUS TANAH</td>
      <td>&nbsp;</td>
      <td><input name="fStatusTnh" type="text" class="text" id="fStatusTnh2" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<? echo $gSTT?>" size="60" maxlength="50" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td valign="top" align="right">KETERANGAN</td>
      <td valign="top">&nbsp;</td>
      <td><textarea name="fKeterangan" id="textarea" style="border: 1px solid #C0C0C0; height:60px; width:433px"><? echo $gKTR ?></textarea></td>
      <td>&nbsp;</td>
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
		
		if (fMil==0) {
		window.alert("Kode Kepemilikan belum dipilih..!!");
		return false;}
		
		if (fAsa==0) {
		window.alert("Asal usul perolehan belum dipilih..!!");
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
						$URL_Top = "Find_Acc_Top.php?CrAcc=Form_Asset_F_Mid&IdL=".$_GET['IdL']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb;
						$URL_Mid = "Find_Acc_Mid.php?CrAcc=Form_Asset_F_Mid&IdL=".$_GET['IdL']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb;
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
					$URL_Top = "Form_Invent_Asset_Top.php?FrmG=INVENTARISASI -> PERUBAHAN NILAI -> KIB D (Jalan, Irigasi dan Jaringan)";
					$URL_Mid = "Form_Invent_Asset_Ubh.php?rKib=Kib_F&IdL=".$_GET['IdL']."&rIDT=".$rIDT;
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
			$URL="KIB_D_History.php?rIDT=".$rIDT."&IdL=".$_GET['IdL'];
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
			$URL="PreviewIMG.php?rCRT=f&rIDT=".$rIDT."&IdL=".$_GET['IdL'];
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
			URL_Top = "UploadIMG_Top.php?FrmG=UPLOAD FOTO ASET -> KIB F";
			URL_Mid = "UploadIMG_Mid.php?"+"<?="rCRT=f&rIDT=".$rIDT."&IdL=".$_GET['IdL']?>";
			URL_Bot = "UploadIMG_Bot.php";
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFindAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFindAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
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
			URL_Top = 'Move_Upb_Kib_Top.php?FrmG=PEMINDAHAN KODE UPB -> KIB D (Jalan, Irigasi dan Jaringan)';
			URL_Mid = 'Move_Upb_Kib_Mid.php?rKib=Kib_F&IdL='+IdL+'&rIDT='+rIDT;
			URL_Bot = 'Move_Upb_Kib_Bot.php';
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinReplAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinReplAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinReplAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
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
			URL_Top = 'Move_Account_Top.php?FrmG=PEMINDAHAN REKENING ASET -> KIB F (KDP)';
			URL_Mid = 'Move_Account_Mid.php?rKib=Kib_F&IdL='+IdL+'&rIDT='+rIDT;
			URL_Bot = 'Move_Account_Bot.php';
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinReplAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinReplAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinReplAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
	
	function P_OpenKibar(w,h,IdT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL= 'report/P47_Kibar_F.php?IdT='+IdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
</script>
