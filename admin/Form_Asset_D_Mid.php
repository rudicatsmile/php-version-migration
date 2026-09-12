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
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
</head>
<?php
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
		$gNoR  = $mRo['No_Register'];
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
		
		if ($mRo['Nm_Aset']=="") {$fNma = fGlobal("Nm_Aset","Ref_Rek_Aset108_7","Kd_Aset",$mRo['Kd_Aset_108'],"=","","");}
		else {$fNma = $mRo['Nm_Aset'];}
		
		$gPjg  = $mRo['Panjang'];
		$gLbr  = $mRo['Lebar'];
		$gLua  = $mRo['Luas'];
		$gNoD  = $mRo['Dokumen_Nomor'];
		$gKns  = $mRo['Konstruksi'];
		$gLKS  = $mRo['Lokasi'];
		$gSTT  = $mRo['Status_Tanah'];
		$gKdT  = $mRo['Kode_Tanah'];
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
		
		$tKib= "D";
		$KeY = CekKey($gUnt,$gThn,'Kib_'.$tKib,'');
		#if ($gThn<=2014){
		#	$KeY="Y";
		#}
		
		#########
		if ($UID=="creator"){$KeY="N";}
		#########
		
		$gHriD = (int)substr($mRo['Dokumen_Tanggal'],8,10);
		$gBlnD = (int)substr($mRo['Dokumen_Tanggal'],5,-3);
		$gThnD = (int)substr($mRo['Dokumen_Tanggal'],0,-6);

		$latitude  = $mRo['lat'];
		$longitude  = $mRo['lng'];
		
		$posisi_koordinat = $latitude .' , ' . $longitude;

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
	$gNoR  = MakeNewNoRegiterAuto('JLN','');
	$gMLK  = 12;
	$gKDS  = "B";
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
	
	$gHriM = "00";
	$gBlnM = "00";
	$gThnM = "0000";
	
	$gHriD = fGetDate('mday');
	$gBlnD = fGetDate('mon');
	$gThnD = fGetDate('year');

	$posisi_koordinat = '';

}
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Form_Asset_D_Mid_.php?IdL=".$_GET['IdL']."&rIDT=".$rIDT ?>">
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
      <td width="130">UNIT KERJA</td>
      <td width="500">
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
      <td width="38">&nbsp;</td>
      <td width="166">KEPEMILIKAN</td>
      <td width="309"> <select class="boxs" name="fMilik" style="width: 250px" tabindex="0">
          <option value=""></option>
          <?php
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
      <td width="130">SUB UNIT</td>
      <td width="500">
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
      <td width="38">&nbsp;</td>
      <td>KONDISI BARANG</td>
      <td> <select class="boxs" name="fKondisi" style="width: 250px" tabindex="0">
          <option value=""></option>
          <?php
		$nSQ = "SELECT * FROM ref_kondisi ORDER BY IDT";
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
      <td width="130">UPB</td>
      <td width="500">
        <?php if ($rIDT) {?>
		<input name="fUpb" type="text" readonly value="<?=$gUpb?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fUpG" type="text" readonly value="<?=fGlobal("Nm_Upb ","ref_upb","Kd_Upb",$gUpb,"=","","")?>" style=" width:260px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="ico reff" onclick="P_MoveUPB('<?=$ReO?>','<?=$KeY?>','700','450','<?=$rIDT?>','<?=$_GET['IdL']?>'); return false" title="Ganti kode upb..!!">GANTI</a>
		<?php } else {?>
        <select class="boxs" name="fUpb" tabindex="0" style="width: 450px" onchange="this.form.submit()">
        <?php
		#$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_Upb";
		
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
      <td width="38">&nbsp;</td>
      <td>ASAL USUL</td>
      <td><select name="fAsalUsul" class="boxs" id="select2" style="width: 250px" tabindex="0">
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
      <td>&nbsp;</td>
      <td valign="middle">&nbsp; </td>
      <td>&nbsp;</td>
      <td>UMUR EKONOMIS</td>
      <td>
	  <select class="boxs" name="fManfaat" style="width: 250px" tabindex="0">
	  <option value=""></option>
          <?php
			for($nMSM=0; $nMSM<=100; $nMSM++)
			{
			$sel ="";
			if ($gMSM==$nMSM) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nMSM.'">'.$nMSM.' Tahun</option>';
			}
			?>
        </select> </td>
    </tr>
    <tr> 
      <td>OBJEK</td>
      <td>
        <?php if ($rIDT) {?>
		<input name="fBid" type="text" readonly value="<?=$gBid?>" style="width:115px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<input name="fBiG" type="text" readonly value="<?=fGlobal("Nm_Aset ","ref_rek_aset108_4","Kd_Aset",$gBid,"=","","")?>" style=" width:325px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/>
		<?php } else {?>
	    <select class="boxs" name="fBid" tabindex="0" style="width: 450px" onchange="this.form.submit()">
        <option value=""></option>
        <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset2 WHERE Kd_Aset like '04.__' ORDER BY Kd_Aset";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '1.3.4.__' ORDER BY Kd_Aset";
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
		<?php } ?>	  </td>
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
        </select> &nbsp; <select class="boxs" name="fBln" tabindex="0" style="width:90px">
          <?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$gBln) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
        </select> &nbsp; 
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
		<?php } ?>		</td>
    </tr>
    <tr> 
      <td>RINCIAN OBJEK </td>
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
		</select>
	  </td>
    </tr>
    <tr> 
      <td>SUB ROBJ </td>
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
      <td>JUMLAH SATUAN</td>
      <td><input name="fSatuan" type="text" id="fSatuan" maxlength="4" value="<?=$gSTN?>" <?php if ($KeY=="Y") {echo "readonly";}?> onblur="NumValidate(this)" onkeyup="addSeparator(this)" style="width:50px; text-align : right; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 5px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr> 
      <td>SUB-SUB ROBJ</td>
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
		<?php } ?>		</td>
            <td width="21%" valign="top">
			<?php if ($rIDT) {?>
			<a href="#" class="ico reff" onclick="P_MoveAccount('<?=$ReO?>','<?=$KeY?>','700','450','<?=$rIDT?>','<?=$_GET['IdL']?>'); return false" title="Ganti kode aset..!!">GANTI</a>
			<?php } else {?>
			<input type="button" name="B392" value="FIND" onclick="OpenAccNumb('600','500','center')" style="width: 50px; height: 22px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
			<?php } ?>			</td>
          </tr>
        </table></td>
      <td>&nbsp;</td>
      <td>HARGA SATUAN (@ Rp)</td>
      <td><input name="fHarga" type="text" id="fHarga" value="<?=fConvertToRupiah($gHRG)?>" <?php if ($KeY=="Y") {echo "readonly";}?> onblur="NumValidate(this)" onkeyup="addSeparator(this)" style="width:130px; text-align: right; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 5px; padding-top: 1px; padding-bottom: 1px" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>NILAI PEROLEHAN (Rp)</td>
      <td><input name="fTotal" type="text" id="fTotal" <?=$gReaD?> value="<?=fConvertToRupiah($gTTL)?>" <?php if ($KeY=="Y") {echo "readonly";}?> style="width:130px; text-align: right; background-color: #E1F986; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 5px; padding-top: 1px; padding-bottom: 1px"/></td>
    </tr>
    <tr> 
      <td>REGISTER</td>
      <td><input name="fNoREG" type="text" class="text" id="fNoREG" <?php if ($rIDT==""){echo "readonly";}?> style="width:80px; padding-left:5px; background:#CCFF99; border: 1px solid #C0C0C0" value="<?=$gNoR?>" maxlength="8" /> (<i>Otomatis</i>)</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>NAMA BARANG</td>
      <td><input name="fNama" type="text" class="text" value="<?php echo $fNma?>" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" size="60" maxlength="100" />      </td>
      <td>&nbsp;</td>
      <td colspan="2">
		<table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
          <tr> 
            <td width="49%"> 
<input type="button" name="B39" value="SIMPAN" onclick="P_Save('<?=$ReO?>')" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
            <input type="button" name="B393" value="RESET" onclick="P_Reset('<?=$ReO?>')" style="width: 90px; height: 23px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /><?php if ($KeY=='Y') { echo "<div style='float:right'><img src='css/images/keys.png' /></div>";}?></td>
            <td width="7%"> 
            <input <?php echo $gDisB?> type="checkbox" name="fChoise" value="ON" /></td>
            <td width="44%">
              <?php echo $gTexB?>            </td>
          </tr>
        </table>	  </td>
    </tr>
    <tr> 
      <td>KONTRUKSI</td>
      <td><input name="fKonstruksi" type="text" class="text" id="fKonstruksi" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gKns?>" size="60" maxlength="50" />      </td>
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
			<td width="18"><a href="#" onClick="P_PRE('d','800','400','<?=$gIDT?>','<?=$_GET['IdL']?>'); return false" class="ico prev"></a></td>
			<td width="10" style="border-right:1px solid #CCCCCC"><a href="#" onClick="P_PDF('<?=$ReO?>','d','600','300','<?=$rIDT?>','<?=$gIDT?>','<?=$_GET['IdL']?>'); return false" class="ico reff"></a></td>
			<?php
			$iG++;
		}
		?>
	  <td><a href="#" onClick="P_PDF('<?=$ReO?>','d','600','300','<?=$rIDT?>','','<?=$_GET['IdL']?>'); return false" class="ico pdf">&nbsp;&nbsp;Upl.PDF</a></td>
	  </tr>
	  </table>	  </td>
    </tr>
    <tr> 
      <td>PANJANG</td>
      <td><input name="fPanjang" type="text" class="text" id="fPanjang2" onBlur="NumValidate(this)" onKeyUp="addSeparator(this)" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gPjg?>" size="20" maxlength="15" />
        M</td>
      <td>&nbsp;</td>
      <td colspan="2" rowspan="9"> <table border="0" width="430" style="border-collapse: collapse; color: #CC0000; border: 1px solid #8FA908; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px">
          <tr> 
            <td width="15" bgcolor="#8FA908">&nbsp;</td>
            <td width="120" bgcolor="#8FA908">RESULT</td>
            <td width="20" bgcolor="#8FA908">&nbsp;</td>
            <td colspan="2" bgcolor="#8FA908">&nbsp;</td>
          </tr>
          <tr> 
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr> 
            <td width="15">&nbsp;</td>
            <td width="120">REFERENSI</td>
            <td width="20">:</td>
            <td colspan="2"> 
              <?php echo $gREF?>            </td>
          </tr>
          <tr> 
            <td width="15">&nbsp;</td>
            <td width="120">KODE BARANG</td>
            <td width="20">:</td>
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
            <td>NILAI AKHIR</td>
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
					<a href="#"><img src="<?="SourceIMG.php?rCRT=d&rIDT=".$rIDT?>" height="75" width="80" onclick="PreviewIMG('400','300','center')"></a>
				<?php } else {?>
					<img src="Images/FileLogin_70.gif" width="20" height="20">
				<?php } ?>				</td>
			  </tr>
			</table>			</td>
          </tr>
          <tr> 
            <td width="15">&nbsp;</td>
            <td width="120">REFERENSI GROUP</td>
            <td width="20">:</td>
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
            <td width="15">&nbsp;</td>
            <td width="120">&nbsp;</td>
            <td width="20">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr> 
            <td width="15">&nbsp;</td>
            <td width="120">RECORDED</td>
            <td width="20">:</td>
            <td>-</td>
          </tr>
          <tr> 
            <td width="15">&nbsp;</td>
            <td width="120">PENCATAT</td>
            <td width="20">:</td>
            <td>-</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td width="135">&nbsp;</td>
          </tr>
          <!--tr>
            <td>&nbsp;</td>
            <td colspan="4">[&nbsp;<a href="#" class="ico edit" onclick="OpenUbahNilai('950','520','center'); return false">PERUBAHAN NILAI</a>&nbsp;]&nbsp;&nbsp;
			[&nbsp;<a href="#" class="ico his" onclick="P_ViewHistory('800','400','center'); return false">HISTORY PERUBAHAN</a>&nbsp;]&nbsp;&nbsp;
			[&nbsp;<a href="#" class="ico doc" onclick="P_OpenDoc('800','400','KIB_D_Dokumen'); return false">DOKUMEN KIB</a>&nbsp;]			</td>
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
                <td width="96"><a href="<?="P47_Penggunaan.php?BckFrm=D&rIDT=".$_GET['rIDT']."&IdL=".$_GET['IdL']?>" class="ico use">Penggunaan</a></td>
                <td width="115"><a href="<?="P47_Pemanfaatan.php?BckFrm=D&rIDT=".$_GET['rIDT']."&IdL=".$_GET['IdL']?>" class="ico mesi">&nbsp;&nbsp;Pemanfaatan</a></td>
                <td width="92">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr> 
            <td width="15">&nbsp;</td>
            <td width="120">&nbsp;</td>
            <td width="20">&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td>LEBAR</td>
      <td><input name="fLebar" type="text" class="text" id="fLebar" onBlur="NumValidate(this)" onKeyUp="addSeparator(this)" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gLbr?>" size="20" maxlength="15" />
        M</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>LUAS</td>
      <td><input name="fLuas" type="text" class="text" id="fLuas" onBlur="NumValidate(this)" onKeyUp="addSeparator(this)" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?=$gLua?>" size="20" maxlength="15" />
        M<sup>2</sup> </td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>TGL. DOKUMEN</td>
      <td><select name="fHriD" class="boxs" id="select6" tabindex="0">';
          <?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$gHriD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
        </select> &nbsp; <select name="fBlnD" class="boxs" id="select7" tabindex="0">
          <?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$gBlnD) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
        </select> &nbsp; <select name="fThnD" class="boxs" id="select8" style="width: 60px" tabindex="0">
          <?php
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
      <td>NO. DOKUMEN</td>
      <td><input name="fNoDok" type="text" class="text" id="fNoDok4" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gNoD?>" size="60" maxlength="50" />      </td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>LOKASI</td>
      <td>
		<input name="fLokasi" type="text" class="text" id="fAlamat3" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gLKS?>" size="60" maxlength="50" />
		<a href="#" class="ico upl" onclick="OpenAccMAP('<?=$ReO?>','750','450','center'); return false;">&nbsp;&nbsp;Lokasi Pada Peta</a>
	  </td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>KOORDINAT</td>
		<td>
			<?php //echo $posisi_koordinat;?>		
			<input name="fPosisi_koordinat" type="text" class="text" id="fPosisi_koordinat" 
				style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" 
				value="<?php echo $posisi_koordinat?>" size="50" maxlength="50" disabled />			
		</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>KODE TANAH</td>
      <td><table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
          <tr> 
            <td style="font-weight: bold; color: #008000" width="297"> <input name="fKdTanah" type="text" class="text" id="fKdTanah4" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gKdT?>" size="20" maxlength="23" /></td>
            <td width="226">&nbsp;</td>
          </tr>
        </table></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>STATUS TANAH</td>
      <td><input name="fStatusTnh" type="text" class="text" id="fStatusTnh2" style="widht:100%; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" value="<?php echo $gSTT?>" size="60" maxlength="50" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td valign="top">KETERANGAN</td>
      <td><textarea name="fKeterangan" id="textarea" style="height:60px; width:440px; border: 1px solid #C0C0C0"><?php echo $gKTR ?></textarea></td>
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
		
		if (fKon==0) {
		window.alert("Kondisi barang belum dipilih..!!");
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
					<?php
						$URL_Top = "Find_Acc_Top.php?CrAcc=Form_Asset_D_Mid&IdL=".$_GET['IdL']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb;
						$URL_Mid = "Find_Acc_Mid.php?CrAcc=Form_Asset_D_Mid&IdL=".$_GET['IdL']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb;
						$URL_Bot = "Find_Acc_Bot.php";
					?>       			
       			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
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
					$URL_Top = "Form_Invent_Asset_Top.php?FrmG=INVENTARISASI -> PERUBAHAN NILAI -> KIB D (Jalan, Irigasi dan Jaringan)";
					$URL_Mid = "Form_Invent_Asset_Ubh.php?rKib=Kib_D&IdL=".$_GET['IdL']."&rIDT=".$rIDT;
					$URL_Bot = "Form_Invent_Asset_Bot.php";
					?>       			
       			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
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
			$URL="KIB_D_History.php?rIDT=".$rIDT."&IdL=".$_GET['IdL'];
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
			URL_Top = 'Move_Account_Top.php?FrmG=PEMINDAHAN REKENING ASET -> KIB D (Peralatan dan Mesin)';
			URL_Mid = 'Move_Account_Mid.php?rKib=Kib_D&IdL='+IdL+'&rIDT='+rIDT;
			URL_Bot = 'Move_Account_Bot.php';
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinReplAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinReplAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinReplAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
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
			URL_Top = 'Move_Upb_Kib_Top.php?FrmG=PEMINDAHAN KODE UPB -> KIB D (Jalan, Irigasi dan Jaringan)';
			URL_Mid = 'Move_Upb_Kib_Mid.php?rKib=Kib_D&IdL='+IdL+'&rIDT='+rIDT;
			URL_Bot = 'Move_Upb_Kib_Bot.php';
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinReplAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinReplAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinReplAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
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
			$URL="PreviewIMG.php?rCRT=d&rIDT=".$rIDT."&IdL=".$_GET['IdL'];
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
			URL_Top = "UploadIMG_Top.php?FrmG=UPLOAD FOTO ASET -> KIB D";
			URL_Mid = "UploadIMG_Mid.php?"+"<?="rCRT=d&rIDT=".$rIDT."&IdL=".$_GET['IdL']?>";
			URL_Bot = "UploadIMG_Bot.php";
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFindAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFindAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
	
	function OpenAccMAP(ReO,w,h,pos)
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
			URL_Top = "UploadIMG_Top.php?FrmG=Lokasi Peta -> KIB D";
			URL_Mid = "UploadMAP_Mid.php?"+"<?="rCRT=d&rIDT=".$rIDT."&IdL=".$_GET['IdL']?>";
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
	
	function P_OpenKibar(w,h,IdT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL= 'report/P47_Kibar_D.php?IdT='+IdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
</script>
