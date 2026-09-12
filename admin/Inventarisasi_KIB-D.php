<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
/*
$gUnt  = $_GET['gUnt'];
$gSub  = $_GET['gSub'];
$gUpb  = $_GET['gUpb'];
$gThn  = $_GET['gThn'];
$gBid  = $_GET['gBid'];
$gKel  = $_GET['gKel'];
$gOBJ  = $_GET['gOBJ'];
$gRin  = $_GET['gRin'];
$gFin  = $_GET['gFin'];
*/

if (isset($_GET['gUnt'])) {$gUnt  = $_GET['gUnt'];} else {$gUnt  ="";}
if (isset($_GET['gSub'])) {$gSub  = $_GET['gSub'];} else {$gSub  ="";}
if (isset($_GET['gUpb'])) {$gUpb  = $_GET['gUpb'];} else {$gUpb  ="";}
if (isset($_GET['gThn'])) {$gThn  = $_GET['gThn'];} else {$gThn  ="";}
if (isset($_GET['gBid'])) {$gBid  = $_GET['gBid'];} else {$gBid  ="";}
if (isset($_GET['gKel'])) {$gKel  = $_GET['gKel'];} else {$gKel  ="";}
if (isset($_GET['gOBJ'])) {$gOBJ  = $_GET['gOBJ'];} else {$gOBJ  ="";}
if (isset($_GET['gRin'])) {$gRin  = $_GET['gRin'];} else {$gRin  ="";}
if (isset($_GET['gFin'])) {$gFin  = $_GET['gFin'];} else {$gFin  ="";}

$gFin = addslashes($gFin);
if ($gFin!="")
{
	$gBid  = "All";
	$gKel  = "All";
	$gOBJ  = "All";
	$gRin  = "All";
}
if ($gThn=="") {$gThn="____";}
if ($gThn=="All") {$gThn="____";}
?>

<body onload="javascript:myfrm.fFind.focus()">
<?php require "FileMenu.php";?>
<form name="myfrm" method="post" action="<?php echo "Inventarisasi_KIB-D_.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'] ?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CritIDT" size="10">
  <table border="0" align="center" width="900px">
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td width="92">UNIT</td>
      <td width="519"> 
        <select class="boxs" name="fUnt" tabindex="0" style="width: 470px" onchange="this.form.submit()">
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
        </select> </td>
      <td width="94">KELOMPOK</td>
      <td> <select class="boxs" name="fBid" tabindex="0" style="width: 480px" onchange="P_Change()">
          <option value=""></option>
          <option <?php if ($gBid=="All") {echo "selected";} ?> value="All">All</option>
          <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset2 WHERE Kd_Aset LIKE '04.__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
            if ($gBid!="All")
            {
			if ($gBid=="") {$gBid=$mRo['Kd_Aset'];}
            }
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gBid) 
				{
				$sel ="selected";
				$zBid=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
      <td>&nbsp;</td>
      <td align="right"><input type="button" name="B36" value="DOKUMEN KIB" onclick="OpenKIB('600','350','center')"  style="width: 90px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td width="92">SUB UNIT</td>
      <td width="519"> 
        <select class="boxs" name="fSub" tabindex="0" style="width: 470px" onchange="this.form.submit()">
          <?php
		if ($Lev <=3 ) {$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".__' ORDER BY Kd_Sub";}
		else {$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".".substr($SkP,12,2)."' ORDER BY Kd_Sub";}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gSub=="") {$gSub=$mRo['Kd_Sub'];}
			if (substr($gSub,0,11)!=$gUnt) {$gSub=$mRo['Kd_Sub'];}
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
        </select> </td>
      <td width="94">JENIS</td>
      <td> <select class="boxs" name="fKel" tabindex="0" style="width: 480px" onchange="this.form.submit()">
          <option <?php if ($gKel=="All") {echo "selected";} ?> value="All">All</option>
          <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset3 WHERE Kd_Aset LIKE '".$gBid.".__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gKel!="All")
            {
                if ($gKel=="") {$gKel=$mRo['Kd_Aset'];}
                if (substr($gKel,0,5)!=$gBid) {$gKel=$mRo['Kd_Aset'];}
            }
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gKel) 
				{
				$sel ="selected";
				$zKel=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
      <td>&nbsp;</td>
      <td align="right"><input type="button" name="B37" value="EXPORT DATA" onclick="P_ToExcel('800','400','center','ToExcel/KIB_D_ToExcel')" style="width: 90px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td width="92">UPB</td>
      <td width="519"> 
        <select class="boxs" name="fUpb" tabindex="0" style="width: 470px" onchange="this.form.submit()">
		<option value="All">All</option> 
          <?php
		$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_Upb";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUpb=="") {$gUpb = $mRo['Kd_Upb'];}
			//if (substr($gUpb,0,14)!=$gSub) {$gUpb = $mRo['Kd_Upb'];}
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
        </select> </td>
      <td width="94">OBJEK</td>
      <td> <select class="boxs" name="fOBJ" tabindex="0" style="width: 480px" onchange="this.form.submit()">
          <option <?php if ($gOBJ=="All") {echo "selected";} ?> value="All">All</option>
          <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset4 WHERE Kd_Aset LIKE '".$gBid.".".substr($gKel,6,2).".__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
            if ($gOBJ!="All")
            {  
			if ($gOBJ=="") {$gOBJ=$mRo['Kd_Aset'];}
			if (substr($gOBJ,0,8)!=$gKel) {$gOBJ=$mRo['Kd_Aset'];}
            }
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gOBJ) 
				{
				$sel ="selected";
				$zOBJ=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select></td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
    </tr>
    <tr> 
      <td>TAHUN</td>
      <td valign="middle"> <table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
          <tr> 
            <td width="24%"> <select class="boxs" name="fThn" style="width: 60px" tabindex="0" onchange="this.form.submit()">
                <option <?php if ($gThn=="All") {echo "selected";} ?> value="All">All</option>
                <?php
			for($nThn=1900; $nThn<=2030; $nThn++)
			{
			$sel ="";
			if ($gThn==$nThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
              </select> </td>
            <td width="8%">CARI</td>
            <td width="49%"> <input class="text" type="text" name="fFind" value="<?php echo $gFin?>" style="font-family: Calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" /></td>
            <td width="3%">&nbsp;</td>
            <td width="8%"> <input type="button" name="B39" value="GO" onclick="P_Find()" style="width: 50px; height: 21px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
            <td width="8%">&nbsp;</td>
          </tr>
        </table></td>
      <td>RINCIAN</td>
      <td width="496"> 
        <select class="boxs" name="fRin" tabindex="0" style="width: 480px" onchange="this.form.submit()">
          <option <?php if ($gRin=="All") {echo "selected";} ?> value="All">All</option>
          <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset5 WHERE Kd_Aset LIKE '".$gBid.".".substr($gKel,6,2).".".substr($gOBJ,9,2).".___' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gRin!="All")
            {
            if ($gRin=="") {$gRin=$mRo['Kd_Aset'];}
			if (substr($gRin,0,11)!=$gOBJ) {$gRin=$mRo['Kd_Aset'];}
            }
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gRin) 
				{
				$sel ="selected";
				$zRin=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
      <td width="10">&nbsp;</td>
      <td width="98" align="right"> 
        <input type="button" name="B38" value="CARI REKENING" onclick="OpenAccNumb('600','500','center')" style="width: 90px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	</table>
	
        <!-- Content -->
        <!-- Table -->
        <div class="table"> 
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
        <th width="33" align="left">No</th>
        <th width="85" align="left">Kode</th>
        <th width="66" align="left">Register</th>
        <th width="297" align="left">Nama Barang</th>
        <th width="14" align="left">&nbsp;</th>
        <th width="385" align="left">Uraian</th>
        <th width="69" align="left">Tgl.Perolehan</th>
        <th width="108" class="ar">Nilai Perolehan </th>
        <th width="104" class="ar">Nilai Akhir </th>
        <th width="109" class="ac">Actions</th>
            </tr>
            <?php
		if ($gUpb=="All") {$zUpb = $zSub.".%";}
		if ($gThn=="All")
			{$rThn="____";}
		else
			{$rThn=$gThn;}
				
		if ($gBid=="All")
			{
				$rBid="__.__";
				$rKel="__";
				$rOBJ="__";
				$rRin="___";
			}
			else
			{
				if ($gKel=="All")
					{
					$rBid=$zBid;
					$rKel="__";
					$rOBJ="__";
					$rRin="___";
					}
				else
					{
						if ($gOBJ=="All")
							{
							$rBid=$zBid;
							$rKel=substr($zKel,6,2);
							$rOBJ="__";
							$rRin="___";
							}
						else
							{
								if ($gRin=="All")
									{
									$rBid=$zBid;
									$rKel=substr($zKel,6,2);
									$rOBJ=substr($zOBJ,9,2);
									$rRin="___";
									}
								else
									{
									$rBid=$gBid;
									$rKel=substr($gKel,6,2);
									$rOBJ=substr($gOBJ,9,2);
									$rRin=substr($gRin,12,3);
									}
							}
					}
			}
		include "FilePagingTop.php";
		if ($gFin!="")
		{$fFindSy = "AND (Harga LIKE '%".$gFin."%' OR Referensi LIKE '%".$gFin."%' OR Kd_Aset LIKE '%".$gFin."%' OR Keterangan LIKE '%".$gFin."%')";}
		else
		{$fFindSy = "";}
		
		$nSQL= "SELECT * FROM ta_kib_d WHERE Kd_UPB LIKE '".$zUpb."' AND Kd_Aset LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy." ORDER BY Tgl_Perolehan, Kd_Aset, No_Register LIMIT $Offset, $DataPerPage";
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
			if ($mRo['Ref_Group']!="")
				{$RegGrp=$mRo['Ref_Group'];}
			else
				{$RegGrp="";}
			
			$gHRG = $mRo['Harga'];
			$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post","Referensi",$mRo['Referensi'],"=","","");
			$gNIb = fGlobal("IfNull(sum(Kredit),0)","Ta_KIB_Post","Referensi",$mRo['Referensi'],"=","","");
			if ($gNIb != 0) {$gNIL = $gNIa - $gNIb;}
			else {$gNIL=$gNIa;}
					
			if ($gHRG > $gNIL) {$ClR="style='color: #FF0000'";}
			else if ($gHRG < $gNIL) {$ClR="style='color: #0000FF'";}
			else {$ClR="";}
			
			$NmB=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");
			?>
			<tr style="cursor: pointer" title="clik disini untuk melihat rincian...!" onmouseover="this.style.cursor=&#39;pointer&#39" <?=fBackCLR($iG)?>> 
              <td style="border-bottom: #999999 dotted 1px"><?php echo $iG?>.</td>
              <td style="border-bottom: #999999 dotted 1px" onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)"><?php echo $mRo['Kd_Aset']?></td>
              <td style="border-bottom: #999999 dotted 1px" onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)"><?php echo $mRo['No_Register']?></td>
              <td style="border-bottom: #999999 dotted 1px" onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)"><?php echo $NmB ?></td>
              <td style="border-bottom: #999999 dotted 1px"></td>
              <td style="border-bottom: #999999 dotted 1px" onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)"> 
                <?php
				if  ((int) strlen($mRo['Keterangan']) > 65)
				{echo substr($mRo['Keterangan'],0,65)." .....";}
				else
				{echo $mRo['Keterangan'];}
				?>              </td>
              <td style="border-bottom: #999999 dotted 1px" onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)"> 
                <?php echo fConvertDateShort($mRo['Tgl_Perolehan'])?>              </td>
              <td style="border-bottom: #999999 dotted 1px" align="right" onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)"> 
                <?php echo fConvertToRupiah($mRo['Harga'])?>              </td>
              <td style="border-bottom: #999999 dotted 1px" align="right" onclick="$(&#39;#detail<?php echo $iG?>&#39;).toggle(&#39;past&#39;)" <?php echo $ClR?>><?php echo fConvertToRupiah($gNIL)?></td>
              <td style="border-bottom: #999999 dotted 1px" align="center">
			  <a href="#" class="ico edit" onclick="InventData('550','400','center','<?=$mRo['IDT']?>'); return false">INVENTARISASI</a>
			  </td>
            </tr>
      <tr> 
        <td colspan="10">
		<table id="detail<?php echo $iG?>" cellpadding="3" border="0" width="900" style="border:1px solid #C0C0C0; font-family: Calibri; font-size: 9pt; font-style: Italic; color: #800000; display: none; border-collapse:collapse">
            <tr> 
              <td width="26">&nbsp;</td>
              <td width="59">Kelompok</td>
              <td width="11">:</td>
              <td width="276"> 
                <?php echo fGlobal("Nm_Aset","Ref_Rek_Aset2","Kd_Aset",substr($mRo['Kd_Aset'],0,5),"=","","")?>              </td>
              <td width="11">&nbsp;</td>
              <td width="89">Panjang</td>
              <td width="10">:</td>
              <td width="113">
                <?php echo $mRo['Panjang']?>&nbsp;KM              </td>
              <td width="3">&nbsp;</td>
              <td width="105">Sertifikat Tanggal</td>
              <td width="10">:</td>
              <td width="290">
                <?php echo fConvertDateShort($mRo['Dokumen_Tanggal'])?>              </td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td>Jenis</td>
              <td>:</td>
              <td> 
                <?php echo fGlobal("Nm_Aset","Ref_Rek_Aset3","Kd_Aset",substr($mRo['Kd_Aset'],0,8),"=","","")?>              </td>
              <td>&nbsp;</td>
              <td>Lebar</td>
              <td>:</td>
              <td>
                <?php echo $mRo['Lebar']?> M              </td>
              <td>&nbsp;</td>
              <td>Sertifikat Nomor</td>
              <td>:</td>
              <td>
                <?php echo $mRo['Dokumen_Nomor']?>              </td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td>Objek</td>
              <td>:</td>
              <td> 
                <?php echo fGlobal("Nm_Aset","Ref_Rek_Aset4","Kd_Aset",substr($mRo['Kd_Aset'],0,11),"=","","")?>              </td>
              <td>&nbsp;</td>
              <td>Asal-usul</td>
              <td>:</td>
              <td>
                <?php echo $mRo['Asal_Usul']?>              </td>
              <td>&nbsp;</td>
              <td>Luas</td>
              <td>:</td>
              <td valign="top">
                <?php echo fConvertToRupiah($mRo['Luas'])?>&nbsp;m<sup>2</sup>              </td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td>Rincian</td>
              <td>:</td>
              <td> 
                <?php echo fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",substr($mRo['Kd_Aset'],0,15),"=","","")?>              </td>
              <td>&nbsp;</td>
              <td>Milik</td>
              <td>:</td>
              <td><?php echo fGlobal("Nm_Pemilik","Ref_Pemilik","Kd_Pemilik",substr($mRo['Kd_Pemilik'],0,11),"=","","")?></td>
              <td>&nbsp;</td>
              <td>Lokasi</td>
              <td>:</td>
              <td valign="top">
                <?php echo $mRo['Lokasi']?>              </td>
            </tr>
          </table>		</td>
      </tr>
            <?php
			  $iG++;
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
		else
		{
		?>
            <tr> 
              <td></td>
              <td colspan="3">Data tidak ditemukan..!!</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <?php
		}
		?>
          </table>
          <!-- Pagging -->
          <?php
			$nSQL= "SELECT COUNT(*) AS JmlRc FROM ta_kib_d WHERE Kd_UPB LIKE '".$zUpb."' AND Kd_Aset LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy;
			$fUlrR= "FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&gFin=".$gFin."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$gUpb."&gThn=".$gThn."&gBid=".$gBid."&gKel=".$gKel."&gOBJ=".$gOBJ."&gRin=".$gRin."&";
			include "FilePagingBot.php";
   		  ?>
        </div>
        <!-- Table --></div>
        <!-- End Content -->
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Change()
	{
		objfrm.fFind.value = "";
		objfrm.submit();
	}
	
	function P_DeleteR(xA,xB)
	{
		if (xB!="")
			{window.alert("Teknis input menggunakan fasilitas GROUP, penghapusan langsung belum diperbolehkan, \ngunakan fasilitas penghapusan dengan cara mengurangi jumlah item aset ...!");}
		else
		{
			var AN = confirm("Hapus data aset..?!!");
			if (AN)
			{
			objfrm.CritIDT.value = xA;
			objfrm.Simpan.value = "DeleteRecord";
			objfrm.submit();
			}
		}
	}
	
	function P_Find()
	{
		objfrm.Simpan.value = "Find";
		objfrm.submit();
	}
	
	function P_ToExcel(w,h,pos,doc)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL= doc +"<?=".php?gFin=".$gFin."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&gThn=".$gThn."&gBid=".$gBid."&gKel=".$gKel."&gOBJ=".$gOBJ."&gRin=".$gRin."&IdL=".$_GET['IdL']?>";
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function OpenKIB(w,h,pos)
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
						$URL_Top = "Open_KIB_Top.php";
						$URL_Mid = "Open_KIB_Mid.php?CrKIB=KIB_D&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_GET['IdL'];
						$URL_Bot = "Open_KIB_Bot.php";
					?>       			
       			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenKIB_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinOpenKIB_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinOpenKIB_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
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
						$URL_Top = "Find_Acc_Top.php?CrAcc=Inventarisasi_KIB-D&FrmG=".$_GET['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_GET['IdL'];
						$URL_Mid = "Find_Acc_Mid.php?CrAcc=Inventarisasi_KIB-D&FrmG=".$_GET['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_GET['IdL'];
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

	function InventData(w,h,pos,IDT)
	{	var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = "Form_Invent_Asset_Top.php?"+"<?="FrmG=".$_GET['FrmG']?>";
			URL_Mid = "Form_Invent_Asset_Opt.php?rKib=Kib_D&rIDT="+IDT+"<?="&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>";
			URL_Bot = "Form_Invent_Asset_Bot.php";
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
</script>            

<?php require('Connection_Close.php');?>
