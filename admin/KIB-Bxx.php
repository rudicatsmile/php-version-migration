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
<title>SIMBAD@</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
extract($_GET);
if (isset($_GET['gUnt'])) {$gUnt  = $_GET['gUnt'];} else {$gUnt  ="";}
if (isset($_GET['gSub'])) {$gSub  = $_GET['gSub'];} else {$gSub  ="";}
if (isset($_GET['gUpb'])) {$gUpb  = $_GET['gUpb'];} else {$gUpb  ="";}
if (isset($_GET['gRua'])) {$gRua  = $_GET['gRua'];} else {$gRua  ="";}

if (isset($_GET['gThnA'])) {$gThnA = $_GET['gThnA'];} else {$gThnA  ="1900";}
if (isset($_GET['gThn'])) {$gThn   = $_GET['gThn'];} else {$gThn  = date('Y');}

if (isset($_GET['gBid'])) {$gBid  = $_GET['gBid'];} else {$gBid  ="";}
if (isset($_GET['gKel'])) {$gKel  = $_GET['gKel'];} else {$gKel  ="";}
if (isset($_GET['gOBJ'])) {$gOBJ  = $_GET['gOBJ'];} else {$gOBJ  ="";}
if (isset($_GET['gRin'])) {$gRin  = $_GET['gRin'];} else {$gRin  ="";}
if (isset($_GET['gFin'])) {$gFin  = $_GET['gFin'];} else {$gFin  ="";}

if (isset($_GET['gExt'])) {$gExt  = $_GET['gExt'];} else {$gExt  ="N";}
if (isset($_GET['eMuT'])) {$eMuT  = $_GET['eMuT'];} else {$eMuT  ="";}
if (isset($_GET['gMuT'])) {$gMuT  = $_GET['gMuT'];} else {$gMuT  ="";}

if ($gMuT!=""){$tMuT="AND Ref_Mutasi<>''";} else {$tMuT="";}

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
$rKib = "02.__";
$gRf = "ALT";
?>

<body>
<?php require "FileMenu.php";?>
<form name="myfrm" method="post" action="<?php echo "KIB-B_.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'] ?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CritIDT" size="10">
  <table border="0" align="center" style="width:99%">
    <tr> 
      <td></td>
      <td></td>
      <td></td>
      <td colspan="6"></td>
      <td></td>
    </tr>
    <tr> 
      <td width="72">UNIT</td>
      <td width="467">
	  <select class="boxs" name="fUnt" id="fUnt" tabindex="0" style="width: 415px" onchange="this.form.submit()">
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
      </select></td>
      <td width="99">OBJEK</td>
      <td colspan="6"> 
	  <select class="boxs" name="fBid" tabindex="0" style="width: 480px" onchange="P_Change()">
          <option value=""></option>
          <option <?php if ($gBid=="All") {echo "selected";} ?> value="All">All</option>
          <?php
		#$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset2 WHERE Kd_Aset LIKE '02.__' ORDER BY Kd_Aset";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '1.3.2.__' ORDER BY Kd_Aset";
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
      <td align="right"><input type="button" name="B35" value="INPUT DATA" onclick="InputData('950','520','center')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td width="72">SUB UNIT</td>
      <td width="467"> 
        <select class="boxs" name="fSub" id="fSub" tabindex="0" style="width: 415px" onchange="this.form.submit()">
          <?php
		if ($Lev <=3 ) {
			echo "<option value='All'>All</option>";
			$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".__' ORDER BY Kd_Sub";
		}
		else {$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".".substr($SkP,12,2)."' ORDER BY Kd_Sub";}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gSub=="") {$gSub=$mRo['Kd_Sub'];}
			#if (substr($gSub,0,11)!=$gUnt) {$gSub=$mRo['Kd_Sub'];}
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
      <td width="99">RINCIAN OBJ</td>
      <td colspan="6"> <select class="boxs" name="fKel" tabindex="0" style="width: 480px" onchange="this.form.submit()">
          <option <?php if ($gKel=="All") {echo "selected";} ?> value="All">All</option>
          <?php
		#$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset3 WHERE Kd_Aset LIKE '".$gBid.".__' ORDER BY Kd_Aset";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '".$gBid.".__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gKel!="All")
            {
                if ($gKel=="") {$gKel=$mRo['Kd_Aset'];}
                if (substr($gKel,0,8)!=$gBid) {$gKel=$mRo['Kd_Aset'];}
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
      <td align="right">
	  <!--input type="button" name="B36" value="DOKUMEN KIB" onclick="OpenKIB('650','350','center')"  style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /-->
	  <input type="button" name="B36" value="DOKUMEN KIB" onclick="P_OpenDoc('800','400','','','<?=$_GET['IdL']?>')"  style="color:#0000FF; width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />	  </td>
    </tr>
    <tr> 
      <td width="72">UPB</td>
      <td width="467"> 
        <select class="boxs" name="fUpb" id="fUpb" tabindex="0" style="width: 415px" onchange="this.form.submit()">
          <?php
		if ($Lev <=3 ) {
			echo "<option value='All'>All</option>";
			$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_Upb";
		}
		else {$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".".substr($SkP,-3,3)."' ORDER BY Kd_Upb";}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUpb=="") {$gUpb = $mRo['Kd_Upb'];}
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
      <td width="99">SUB ROBJ</td>
      <td colspan="6"> <select class="boxs" name="fOBJ" tabindex="0" style="width: 480px" onchange="this.form.submit()">
          <option <?php if ($gOBJ=="All") {echo "selected";} ?> value="All">All</option>
          <?php
		#$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset4 WHERE Kd_Aset LIKE '".$gBid.".".substr($gKel,6,2).".__' ORDER BY Kd_Aset";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_6 WHERE Kd_Aset LIKE '".$gBid.".".substr($gKel,-2,2).".__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
            if ($gOBJ!="All")
            {  
			if ($gOBJ=="") {$gOBJ=$mRo['Kd_Aset'];}
			if (substr($gOBJ,0,11)!=$gKel) {$gOBJ=$mRo['Kd_Aset'];}
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
      <td align="right">
	  <!--input type="button" name="B37" value="EXPORT DATA" disabled onclick="P_ToExcel('800','400','center','ToExcel/KIB_B_ToExcel')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /-->
	  <input type="button" name="B36" value="TABULASI DATA" onclick="P_OpenDoc('800','400','TaB','ALT','<?=$_GET['IdL']?>')"  style="color:#0000FF; width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  </td>
    </tr>
    <tr>
      <td>RUANG</td>
      <td valign="middle">
	  <select class="boxs" name="fRua" id="fRua" tabindex="0" style="width: 270px" onchange="this.form.submit()">
        <option value="All">All</option>
        <?php
		$nSQ = "SELECT Kd_Ruang, Nm_Ruang FROM ref_ruangan WHERE Kd_UPB = '".$zUpb."' ORDER BY Kd_Ruang";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUpb=="") {$gUpb = $mRo['Kd_UPB'];}
			//if (substr($gUPB,0,14)!=$gSub) {$gUPB = $mRo['Kd_UPB'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Ruang']==$gRua) 
				{
					$sel ="selected";
					$zRua=$mRo['Kd_Ruang'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Ruang'].'">'.$mRo['Kd_Ruang']." : ".$mRo['Nm_Ruang'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select>	  </td>
      <td>SUB SUB ROBJ</td>
      <td colspan="6">
	  <select class="boxs" name="fRin" tabindex="0" style="width: 480px" onchange="this.form.submit()">
          <option <?php if ($gRin=="All") {echo "selected";} ?> value="All">All</option>
          <?php
		#$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset5 WHERE Kd_Aset LIKE '".$gBid.".".substr($gKel,6,2).".".substr($gOBJ,9,2).".___' ORDER BY Kd_Aset";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_7 WHERE Kd_Aset LIKE '".$gBid.".".substr($gKel,-2,2).".".substr($gOBJ,-2,2).".___' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gRin!="All")
            {
            if ($gRin=="") {$gRin=$mRo['Kd_Aset'];}
			if (substr($gRin,0,14)!=$gOBJ) {$gRin=$mRo['Kd_Aset'];}
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
        </select>	  </td>
      <td align="right"><input type="button" name="B38" value="CARI REKENING" onclick="OpenAccNumb('600','500','center')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td>FIND</td>
      <td valign="middle"> <table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
          <tr> 
            <td width="46%"> <input class="text" type="text" name="fFind" placeholder='Search' value="<?php echo $gFin?>" style="width: 200px; font-family: Calibri; font-size: 10pt; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" /></td>
            <td width="22%"> <input type="button" name="B39" value="GO" onclick="P_Find()" style="width: 50px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
            <?php if ($Lev=="0" || $Lev=="1") {?>
            <input type="hidden" name="B392" value="Import" disabled onclick="P_Import(); return false;" style="width: 55px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
            <?php } ?>			</td>
            <td width="32%">&nbsp;</td>
          </tr>
        </table></td>
      <td>ASET / EXTRACOM</td>
      <td width="129">
		<select class="boxs" name="fExt" style="width: 120px" tabindex="0" onchange="this.form.submit()">
		<option <?php if ($gExt=="All") {echo "selected";} ?> value="All">ALL</option>
		<option <?php if ($gExt=="N") {echo "selected";} ?> value="N">A S E T</option>
		<option <?php if ($gExt=="Y") {echo "selected";} ?> value="Y">EXTRACOM</option>
	  </select>	  </td>
      <td width="38">TAHUN</td>
      <td width="73">
	  <select class="boxs" name="fThnA" style="width: 70px; color:#FF0000" tabindex="0" onchange="this.form.submit()">
        <!--option <?php if ($gThn=="All") {echo "selected";} ?> value="All">All</option-->
        <?php
			for($nThn=2030; $nThn>=1900; $nThn--)
			{
			$sel ="";
			if ($gThnA==$nThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
      </select>	  </td>
      <td width="57">S.D TAHUN </td>
      <td width="80">
	  <select class="boxs" name="fThn" style="width: 70px; color:#FF0000" tabindex="0" onchange="this.form.submit()">
        <!--option <?php if ($gThn=="All") {echo "selected";} ?> value="All">All</option-->
        <?php
			for($nThn=2030; $nThn>=1900; $nThn--)
			{
			$sel ="";
			if ($gThn==$nThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
      </select>&nbsp;	  </td>
      <td width="134" valign="bottom"><label><input type="checkbox" <?php if ($gMuT!=""){echo "checked";}?> name="fMuT" value="ON" onclick="this.form.submit()"/>MUTASI MASUK</label></td>
      <td width="119" align="right"><input type="button" name="B362" value="DOKUMEN KIR" onclick="P_KIR('650','350','<?=$_GET['IdL']?>')"  style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><div id="loadingImg" style="width:40px;height:10px;display:none"><img src="Images/loading3.gif" alt="" width="40" height="40"></div></td>
      <td colspan="6">&nbsp;</td>
      <td><label style="float:right; color:#FF0000"><input type="checkbox" name="fSdhMutasi" <?php if ($eMuT!="") {echo "checked";}?> onclick="P_Find()" value="ON" />
      Sudah Mutasi</label></td>
    </tr>
  </table>
  <table border="0" align="center" id="tbViewData" style="width:99%">
    <tr> 
      <td><div id="ViewDATA" style="height:30px; width:500px; overflow:auto; display:none"></div></td>
    </tr>
  </table>
	  <table align="center" border="0" class="table-list" cellspacing="0" cellpadding="0" style="width:99%">
		<tr>
		  <th width="30" style="text-align:center">No</th>
		  <th width="100" style="text-align:center">Referensi</th>
		  <th width="60" style="text-align:center">Register</th>
		  <th width="250" style="padding-left:2px">Nama Barang</th>
		  <th width="140" style="padding-left:2px">Merk</th>
		  <th align="left">Uraian</th>
		  <th style="text-align:center">TANGGAL</th>
		  <th style="text-align:center">TGL.MUTASI</th>
		  <th width="100" class="ar">Nilai Perolehan </th>
		  <th width="100" class="ar">Nilai Akhir </th>
		  <th width="200" class="ac">Actions</th>
	    </tr>
		
		<?php
		if ($eMuT!=""){
			$tMuTZ="_mutasi";
		}
		else{
			$tMuTZ="";
		}
		if ($gUpb=="All") {$zUpb = $zSub.".%";}
		if ($gSub=="All") {$zUpb = $zUnt.".%.%";}
		if ($gRua=="All") {$zRua = "%";}
		if ($gExt=="All") {$zExt = "%";} else {$zExt=$gExt;}
		
		if ($gThn=="All")
			{$rThn="____";}
		else
			{$rThn=$gThn;}
		
		if ($gBid=="All")
		{
			$rBid="_._._.__";
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
					$rKel=substr($zKel,-2,2);
					$rOBJ="__";
					$rRin="___";
				}
				else
				{
					if ($gRin=="All")
					{
						$rBid=$zBid;
						$rKel=substr($zKel,-2,2);
						$rOBJ=substr($zOBJ,-2,2);
						$rRin="___";
					}
					else
					{
						$rBid=$gBid;
						$rKel=substr($gKel,-2,2);
						$rOBJ=substr($gOBJ,-2,2);
						$rRin=substr($gRin,-3,3);
					}
				}
			}
		}
		
		include "FilePagingTop.php";
		if ($gFin!="")
		{$fFindSy = "AND (Ref_KdpToAset LIKE '%".$gFin."%' OR No_Register LIKE '%".$gFin."%' OR Kd_Aset_108 LIKE '%".$gFin."%' OR Ref_Temp LIKE '%".$gFin."%' OR Nm_Aset LIKE '%".$gFin."%' OR Harga LIKE '%".$gFin."%' OR Referensi LIKE '%".$gFin."%' OR Nomor_Polisi LIKE '%".$gFin."%' OR Nomor_Rangka LIKE '%".$gFin."%' OR Nomor_BPKB LIKE '%".$gFin."%' OR Nomor_Mesin LIKE '%".$gFin."%' OR Keterangan LIKE '%".$gFin."%' OR Merk LIKE '%".$gFin."%' OR No_Pengadaan LIKE '%".$gFin."%')";}
		else
		{$fFindSy = "";}
		
		###################
		$POSTINGY="Yax";
		if ($POSTINGY=="Ya")
		{
			$nSQA= "SELECT Referensi as A0, Ref_Group as A1, No_Register as A2, Kd_UPB as A3, Kd_Aset as A4, Kd_Aset_108 as A5, Tgl_Perolehan as A6, Harga as A7, No_Pengadaan as A8 
			FROM ta_kib_108 WHERE Kd_UPB LIKE '".$zUpb."' AND Tgl_Perolehan >='".$gThnA."-01-01' AND Tgl_Perolehan <='".$gThn."-12-31' 
			AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' 
			ORDER BY Kd_Aset_108, No_Register";
			#echo $nSQA."<br>";
			$nRsA= mysql_query($nSQA) or die(mysql_error());
			while ($mRoA = mysql_fetch_array($nRsA, MYSQL_BOTH))
			{
				$mRoRf = $mRoA[0];
				$gCeK = fGlobalNEW("IDT","ta_kib_post_108","Referensi",$mRoRf,"=","",DatabaseSB,$ConSB,"");
				if ($gCeK==""){
					$gREF = $mRoA[0];
					$gGRP = $mRoA[1];
					$gREG = $mRoA[2];
					$gUPB = $mRoA[3];
					$gAST = $mRoA[4];
					$g108 = $mRoA[5];
					$gTGL = $mRoA[6];
					$gNIL = $mRoA[7];
					$gNOM = $mRoA[8];
					
					$gURA = "Saldo awal (nilai perolehan)";
					$gKTR = "";
					
					PostingFromKIB($gREF,$gGRP,$gREG,$gUPB,$gAST,$g108,$gTGL,$gURA,$gNIL,$gNOM,$gKTR,DatabaseSB,$ConSB);
				}
				else{
					$gNil = fGlobalNEW("debet","ta_kib_post_108","Referensi",$mRoRf,"=","",DatabaseSB,$ConSB,"");
					if ($gNil==0){
						$SQ = "UPDATE ta_kib_post_108 SET debet='".$mRoA[7]."' WHERE IDT='".$gCeK."'";
						#echo $SQ."<br>";
						$nR = mysql_query($SQ) or die(mysql_error());
					}
				}
			}
		}
		###################
		
		#$nSQL= "SELECT * FROM ta_kib_108 WHERE extracom LIKE '".$zExt."' AND Kd_UPB LIKE '".$zUpb."' AND Kd_Ruang LIKE '$zRua' AND Kd_Aset LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy." ORDER BY Kd_Aset, Tgl_Perolehan, No_Register LIMIT $Offset, $DataPerPage";
		
		$nSQL= "SELECT * FROM ta_kib_108".$tMuTZ." WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$zExt."' AND Kd_UPB LIKE '".$zUpb."' AND Kd_Ruang LIKE '$zRua' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' 
		AND Tgl_Perolehan >='".$gThnA."-01-01' AND Tgl_Perolehan <='".$gThn."-12-31' ".$fFindSy.$tMuT."ORDER BY Kd_UPB, Tgl_Perolehan, Kd_Aset_108, No_Register LIMIT $Offset, $DataPerPage";
		#echo $nSQL;
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
			$SkT = substr($mRo['Kd_UPB'],0,11);
			if ((substr((int)$mRo['Tgl_Perolehan'],0,4)>=2022) && $mRo['No_Pengadaan']=="")
			{
				$TtK="<div style='color:#ff0000; float:right'>**&nbsp;</div>";
			}
			else{
				$TtK="";
			}
			
			if ($mRo['Ref_Group']!="")
				{$RegGrp=$mRo['Ref_Group'];}
			else
				{$RegGrp="";}
			
			$eP="";
			#$g108 = fGlobal("count(*)","ta_kib_post_penyusutan_bulanan_108","Referensi:Kd_UPB",$mRo['Referensi'].":".$mRo['Kd_UPB'],"=:=","","");
			#if ($g108==0){
			#	$eP="<font style='color:#FF0000'><br>***</font>";
			#}
			
			$gCEU = fGlobal("Referensi","ta_usulan_rinci_108","Ref_Aset:Kd_UPB",$mRo['Referensi'].":".$mRo['Kd_UPB'],"=:=","","");
			if ($gCEU!="")
			{
				$gCEK = fGlobal("IDT","ta_usulan_verifikasi_rinci_108","Ref_Aset:Kd_UPB:Eksekusi",$mRo['Referensi'].":".$mRo['Kd_UPB'].":Sudah","=:=:=","","");
				if ($gCEK!='') {
					$Blnk = "";
					$gSkM = "";
					$BT   = "";
				}
				else {
					
					$gSkP = substr(fGlobal("To_UPB","ta_usulan_rinci_108","Ref_Aset:Kd_UPB",$mRo['Referensi'].":".$mRo['Kd_UPB'],"=:=","",""),0,11);
					$gSkM = "";
					if ($gSkP!="" && $gSkP!=$SkT){
						$gSkM = "<br><i>Ke:".fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($gSkP,0,11),"=","","")."</i>";
					}
					$BT="<font style='background:#97928A; color:#fff'>Usulan Mutasi : ".$gCEU.$gSkM."</font><br>";
					
					$Blnk="; background:#F1F8A0";
				}
			}
			else{
				$Blnk="";
				$BT="";
			}
			
			$BV = "";
			if ($tMuTZ!=""){
				$gCeU = $mRo['Ref_Mutasi'];
				if ($gCeU!=""){
					$SG = fGlobal("Kd_UPB","ta_kib_108".$tMuTZ,"Referensi_To:Kd_UPB_To",$mRo['Referensi'].":".substr($mRo['Kd_UPB'],0,11)."%","=:LIKE","","");
					$SG = "<i>".fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($SG,0,11),"=","","")."</i>";
					$BV="<font style='background:#000000; color:#fff'>Mutasi masuk dari ".$SG."<br>Ref : ".$mRo['Ref_Mutasi']."<br>Usulan : ".$mRo['Ref_Usulan']."</font><br>";
				}
			}
			
			$gAda="";
			if ($mRo['Tgl_Mutasi']=="0000-00-00"){
				$gAda = fGlobal("IDT","ta_kib_post_108","Referensi:Kd_UPB:Ref_Mutasi",$mRo['Referensi'].":".substr($mRo['Kd_UPB'],0,11)."%:","=:LIKE:<>","","");
				if ($gAda){
					$gAda="**";
				}
			}
			
			$gHRG = $mRo['Harga'];
			$gNIa = fGlobal("IfNull(sum(debet),0)","ta_kib_post_108","referensi:kd_upb",$mRo['Referensi'].":".substr($mRo['Kd_UPB'],0,11)."%","=:LIKE","","");
			#$gNIa = fGlobal("IfNull(sum(debet),0)","ta_kib_post_108".$tMuTZ,"referensi:kd_upb",$mRo['Referensi'].":".$mRo['Kd_UPB'],"=:LIKE","","");
			$gNIb = 0;
			if ($gNIb != 0) {$gNIL = $gNIa - $gNIb;}
			else {$gNIL=$gNIa;}
			
			if ($gHRG > $gNIL) {$ClR="; color: #FF0000";}
			else if ($gHRG < $gNIL) {$ClR="; color: #0000FF";}
			else {$ClR="";}
			
			$NmB=$mRo['Nm_Aset'];
			
			//Kunci Data
			$KiB = "B";
			$ThN = substr($mRo['Tgl_Perolehan'],0,4);
			$gSK = substr($mRo['Kd_UPB'],0,11);
			$CeK = CekKey($gSK,$ThN,'Kib_'.$KiB,'');
			if ($CeK=='Y') {$del="lock";} else {$del="del";}
			
			$Ujung= substr($mRo['Kd_UPB'],-3,3);
			if ($Ujung=='000'){
				$kdUPB  = "<br><font style='color:#ff0000; font-style:italic'>error kode upb..!!</font>";
			}
			else{
				$kdUPB  = "";
			}
			$Kd108K = $mRo['Kd_Aset_108'];
			if ($Kd108K==''){
				$kd108  = "<br><font style='color:#ff0000; font-style:italic'>Kode aset 108..??</font>";
			}
			else{
				$kd108  = "<br>".$Kd108K;
			}
			
			$Non = "";
			
			$KdPTA = $mRo['Ref_KdpToAset'];
			$RfPTA  = "";
			if ($KdPTA!=''){
				$RfPTA  = "<br>".$KdPTA;
			}
			?>
			<tr height="40" style="cursor: pointer <?=$Blnk?>" <?=fBackCLR($iG)?>> 
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?=$iG?>.</td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?=$mRo['Referensi'].$eP.$RfPTA?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?php echo $mRo['No_Register']."<br>".$aTR?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-left:2px"><?=$NmB.$TtK?><?php if ($mRo['Kd_Ruang']==''){echo "<font style='color:#ff0000'><i><br>Belum Masuk KIR</i></font>";}?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-left:2px"><?php echo $mRo['Merk']?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-left:2px; padding-right:2px"><?=$BV.$BT.$mRo['Keterangan']?></td>
              <td width="70" style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?=fConvertDateShort($mRo['Tgl_Perolehan'])?></td>
              <td width="70" style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?php if ($mRo['Tgl_Mutasi']!="0000-00-00") {echo fConvertDateShort($mRo['Tgl_Mutasi']);}?><?=$gAda?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-right:2px" align="right"><?php echo fConvertToRupiah($mRo['Harga'])?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-right:2px <?=$ClR?>" align="right"><?php echo fConvertToRupiah($gNIL)?></td>
              <td style="border-bottom: #999999 dotted 1px" align="center">
			  <a href="#" class="ico prev" onclick="P_Tabel('850','450','<?=$mRo['Referensi']?>','<?=substr($mRo['Kd_UPB'],0,11)?>','<?=$_GET['IdL']?>'); return false">Ms. MANFAAT</a>
			  <?php if ($eMuT==""){?>
			  &nbsp;&nbsp;|&nbsp;
			  <a href="#" class="ico edit" onclick="EditData('1020','550','center','<?=$mRo['IDT']?>'); return false">EDIT</a>&nbsp;&nbsp;
			  <?php if ($Lev <= 1) {?>
			  |&nbsp;<a href="#" class="ico <?=$del?>" onclick="P_DeleteR('<?=$CeK?>','<?=$ThN?>','<?=$KiB?>','<?=$mRo['IDT']?>','<?=$RegGrp?>','<?=$ReO?>'); return false">DELETE</a>
			  <?php } ?>
			  <?php } ?>
			  </td>
            </tr>
      <tr> 
        <td colspan="11">
		<table id="detail<?php echo $iG?>" cellpadding="3" border="0" width="900" style="border:1px solid #C0C0C0; font-family: Calibri; font-size: 9pt; font-style: Italic; color: #800000; display: none; border-collapse:collapse">
            <tr> 
              <td width="20">&nbsp;</td>
              <td width="30">Kelompok</td>
              <td width="10">:</td>
              <td width="200"> 
                <?php echo fGlobal("Nm_Aset","Ref_Rek_Aset2","Kd_Aset",substr($mRo['Kd_Aset'],0,5),"=","","")?>-------              </td>
              <td width="10">&nbsp;</td>
              <td width="40">Merk</td>
              <td width="9">:</td>
              <td width="100">
                <?php echo $mRo['Merk']?>              </td>
              <td width="4">&nbsp;</td>
              <td width="60">Nomor Mesin</td>
              <td width="9">:</td>
              <td width="200">
                <?php echo $mRo['Nomor_Mesin']?>              </td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td>Jenis</td>
              <td>:</td>
              <td> 
                <?php echo fGlobal("Nm_Aset","Ref_Rek_Aset3","Kd_Aset",substr($mRo['Kd_Aset'],0,8),"=","","")?>              </td>
              <td>&nbsp;</td>
              <td>Type</td>
              <td>:</td>
              <td>
                <?php echo $mRo['Type']?>              </td>
              <td>&nbsp;</td>
              <td>Nomor Rangka</td>
              <td>:</td>
              <td>
                <?php echo $mRo['Nomor_Rangka']?>              </td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td>Objek</td>
              <td>:</td>
              <td> 
                <?php echo fGlobal("Nm_Aset","Ref_Rek_Aset4","Kd_Aset",substr($mRo['Kd_Aset'],0,11),"=","","")?>              </td>
              <td>&nbsp;</td>
              <td>Ukuran/CC</td>
              <td>:</td>
              <td>
                <?php echo $mRo['Ukuran_CC']?>              </td>
              <td>&nbsp;</td>
              <td>Nomor Polisi</td>
              <td>:</td>
              <td valign="top">
                <?php echo $mRo['Nomor_Polisi']?>              </td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td>Rincian</td>
              <td>:</td>
              <td> 
                <?php echo fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",substr($mRo['Kd_Aset'],0,15),"=","","")?></td>
              <td>&nbsp;</td>
              <td>Kepemilikan</td>
              <td>:</td>
              <td><?php echo fGlobal("Nm_Pemilik","Ref_Pemilik","Kd_Pemilik",substr($mRo['Kd_Pemilik'],0,11),"=","","")?></td>
              <td>&nbsp;</td>
              <td>Referensi</td>
              <td>:</td>
              <td valign="top">
                <?php echo $mRo['Referensi']?>              </td>
            </tr>
        </table>		</td>
      </tr>            <?php
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
              <td>&nbsp;</td>
            </tr>
            <?php
		}
		?>
  </table>
          <!-- Pagging -->
          <?php
			$nSQL= "SELECT COUNT(*) AS JmlRc FROM ta_kib_108".$tMuTZ." WHERE referensi LIKE '$gRf%' AND extracom LIKE '$zExt' AND Kd_UPB LIKE '".$zUpb."' AND Kd_Ruang LIKE '$zRua' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan >= '".$gThnA."-01-01' AND Tgl_Perolehan <= '".$gThn."-12-31' ".$fFindSy.$tMuT;
			$fUlrR= "FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&gMuT=".$gMuT."&eMuT=".$eMuT."&gExt=".$gExt."&gFin=".$gFin."&gUnt=".$zUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gRua=".$gRua."&gThn=".$gThn."&gThnA=".$gThnA."&gBid=".$gBid."&gKel=".$gKel."&gOBJ=".$gOBJ."&gRin=".$gRin."&";
			include "FilePagingBot.php";
   		  ?>
        <!--/div>
        <!-- Table --><!--/div-->
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
	
	function P_DeleteR(KeY,ThN,KiB,xA,xB,xR)
	{
		if (KeY=='Y') {alert('Access denied, data kib '+KiB+' tahun '+ThN+' sudah terkunci..!!'); return false;}
		if (xR=="Y") {window.alert('<?=TxReadOnly?>'); return false;}
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
		URL= doc +"<?=".php?gFin=".$gFin."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&gRua=".$zRua."&gThn=".$gThn."&gBid=".$gBid."&gKel=".$gKel."&gOBJ=".$gOBJ."&gRin=".$gRin."&IdL=".$_GET['IdL']?>";
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function InputData(w,h,pos)
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
					<?php
						$URL_Top = "Form_Asset_B_Top.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
						$URL_Mid = "Form_Asset_B_Mid.php?gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&gBid=".$zBid."&gKel=".$zKel."&gOBJ=".$zOBJ."&gRin=".$zRin."&IdL=".$_GET['IdL'];
						$URL_Bot = "Form_Asset_B_Bot.php";
					?>       			
       			txtHTML="<html><head><title>SIMBAD@</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFormKIB_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFormKIB_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
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
						$URL_Mid = "Open_KIB_Mid.php?CrKIB=KIB_B&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_GET['IdL'];
						$URL_Bot = "Open_KIB_Bot.php";
					?>       			
       			txtHTML="<html><head><title>SIMBAD@</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenKIB_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinOpenKIB_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinOpenKIB_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
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
						$URL_Top = "Find_Acc_Top.php?CrAcc=KIB-B&FrmG=".$_GET['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_GET['IdL'];
						$URL_Mid = "Find_Acc_Mid.php?CrAcc=KIB-B&FrmG=".$_GET['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_GET['IdL'];
						$URL_Bot = "Find_Acc_Bot.php";
					?>       			
       			txtHTML="<html><head><title>SIMBAD@</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFindAcc_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFindAcc_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}

	function EditData(w,h,pos,IDT)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = "Form_Asset_B_Top.php?"+"<?="FrmG=".$_GET['FrmG']?>";
			URL_Mid = "Form_Asset_B_Mid.php?rIDT="+IDT+"<?="&IdL=".$_GET['IdL']?>";
			URL_Bot = "Form_Asset_B_Bot.php";
			txtHTML="<html><head><title>SIMBAD@</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}

	function P_Tabel(w,h,ref,upb,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open('Tabel_Masa_Manfaat_Choise.php?ref='+ref+'&upb='+upb+'&IdL='+IdL,'',settings);
	}
	
	function P_KIR(w,h,IdL)
	{
		$(document).ready(function()
		{
			fUpb = $("#fUpb").val();
			fRua = $("#fRua").val();
		});
		if (fRua=="All") {alert('error choise..!!'); return false;}
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open('KIB_B_Dokumen_KIR.php?gUpb='+fUpb+'&gRua='+fRua+'&IdL='+IdL,'',settings);
	}

	function P_Import()
	{
		$(document).ready(function()
		{
			fUnt = $("#fUnt").val();
			fSub = $("#fSub").val();
			fUpb = $("#fUpb").val();
			/*
			if (fUpb=="All") {
				alert('Silahkan pilih UPB..!!'); return false;
			}
			*/
			
			$.ajax({
				url:"KIB-B_Import_.php", 
				data: 
				{
					fUnt:fUnt,fSub:fSub,fUpb:fUpb
				},
				type:"get",
				beforeSend:function()
				{
					alert('Silahkan tunggu, akan memproses import data...!!');
					$("#ViewDATA").show();
					$("#ViewDATA").text("Silahkan tunggu, sedang proses...!!");
					$("#loadingImg").show();
				},
				success:function(data)
				{
					$("#loadingImg").hide();
					$("#ViewDATA").html(data);
				}
			});
		});
	}
	
	function P_OpenDoc(w,h,tab,ref,IdL)
	{
		//alert(tab); return false;
		gUnt = objfrm.fUnt.value;
		gSub = objfrm.fSub.value;
		gUpb = objfrm.fUpb.value;
		
		gBid = objfrm.fBid.value;
		gKel = objfrm.fKel.value;
		gOBJ = objfrm.fOBJ.value;
		gRin = objfrm.fRin.value;
		
		gExt = objfrm.fExt.value;
		gThn = objfrm.fThn.value;
		gThnA= objfrm.fThnA.value;
		gFin = objfrm.fFind.value;
		
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		
		eDok = "KIB_B_Dokumen.php";
		if (tab!=''){
			//eDok = "Tabulasi_Data_Main.php";
			eDok = "Tabulasi_Data_Choice.php";
		}
		
		
		URL= eDok+'?CriT=BPK&ref='+ref+'&gUnt='+gUnt+'&gSub='+gSub+'&gUpb='+gUpb+'&gBid='+gBid+'&gKel='+gKel+'&gOBJ='+gOBJ+'&gRin='+gRin+'&gExt='+gExt+'&gFin='+gFin+'&gThn='+gThn+'&gThnA='+gThnA+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
</script>
