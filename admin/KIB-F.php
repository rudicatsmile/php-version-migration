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
<script type="text/javascript" src="global.js"></script>
</head>
<?php
extract($_GET);
if (isset($_GET['gUnt'])) {$gUnt  = $_GET['gUnt'];} else {$gUnt  ="";}
if (isset($_GET['gSub'])) {$gSub  = $_GET['gSub'];} else {$gSub  ="";}
if (isset($_GET['gUpb'])) {$gUpb  = $_GET['gUpb'];} else {$gUpb  ="";}

if (isset($_GET['gThn'])) {$gThn  = $_GET['gThn'];} else {$gThn  ="";}
if (isset($_GET['gBid'])) {$gBid  = $_GET['gBid'];} else {$gBid  ="";}
if (isset($_GET['gKel'])) {$gKel  = $_GET['gKel'];} else {$gKel  ="";}
if (isset($_GET['gOBJ'])) {$gOBJ  = $_GET['gOBJ'];} else {$gOBJ  ="";}
if (isset($_GET['gRin'])) {$gRin  = $_GET['gRin'];} else {$gRin  ="";}
if (isset($_GET['gRad'])) {$gRad  = $_GET['gRad'];} else {$gRad  ="All";}
if (isset($_GET['gFin'])) {$gFin  = $_GET['gFin'];} else {$gFin  ="";}
if (isset($_GET['gSD']))  {$gSD   = $_GET['gSD'];}  else {$gSD   ="";}

$eSD ="";
if ($gSD=='Ya' && $gThn!="All")
{
	$eSD ="checked";
}
#echo $gThn;
$CkA = "checked";
$CkB = "";
$CkC = "";
if ($gRad =="Y")
{
	$CkA = "";
	$CkB = "checked";
	$CkC = "";
}
else if ($gRad =="N")
{
	$CkA = "";
	$CkB = "";
	$CkC = "checked";
}

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
$rKib = "06.__";


if ($gUnt=='24.04.05.01'){
#echo "::<br>";
}

$gRf = "KDP";

?>

<body>
<?php require "FileMenu.php";?>
<form name="myfrm" method="post" action="<?php echo "KIB-F_.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CritIDT" size="10">
  <table border="0" align="center" style="width:99%">
    <tr> 
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
    <tr> 
      <td width="92">UNIT</td>
      <td width="519"> 
        <select class="boxs" name="fUnt" id="fUnt" tabindex="0" style="width: 470px" onchange="this.form.submit()">
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
        <div id="kdptMstDiv0" class="editdata0KDPT"> 
            <div id="kdptMstDiv1" class="editdata1KDPT"></div> 
            <div id="kdptMstDiv2" class="editdata2KDPT"></div> 
            <div id="kdptMstDiv3" class="editdata3KDPT"></div> 
        </div>		
		<div id="MstDELL" style="height:1px; overflow:auto"></div>		</td>
      <td width="94">OBJEK</td>
      <td> <select class="boxs" name="fBid" id="fBid" tabindex="0" style="width: 480px" onchange="P_Change()">
          <option value=""></option>
          <option <?php if ($gBid=="All") {echo "selected";} ?> value="All">All</option>
          <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '1.3.6.__' ORDER BY Kd_Aset";
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
      <td align="right"><input type="button" name="B35" value="INPUT DATA" onclick="InputData('950','520','center')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td width="92">SUB UNIT</td>
      <td width="519"> 
        <select class="boxs" name="fSub" id="fSub" tabindex="0" style="width: 470px" onchange="this.form.submit()">
          <?php
		if ($Lev <=2 ) {
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
			//if (substr($gSub,0,11)!=$gUnt) {$gSub=$mRo['Kd_Sub'];}
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
        </select>		</td>
      <td width="94">RINCIAN OBJEK </td>
      <td> <select class="boxs" name="fKel" id="fKel" tabindex="0" style="width: 480px" onchange="this.form.submit()">
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
      <td>&nbsp;</td>
      <td align="right">
	  <!--input type="button" name="B36" value="DOKUMEN KIB" onclick="OpenKIB('650','350','center')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /-->
	  <input type="button" name="B36" value="DOKUMEN KIB" onclick="P_OpenDoc('800','400','<?=$_GET['IdL']?>')"  style="color:#0000FF; width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />	  </td>
    </tr>
    <tr> 
      <td width="92">UPB</td>
      <td width="519"> 
        <select class="boxs" name="fUpb" id="fUpb" tabindex="0" style="width: 470px" onchange="this.form.submit()">
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
        </select>	  </td>
      <td width="94">SUB ROBJ </td>
      <td> <select class="boxs" name="fOBJ" id="fOBJ" tabindex="0" style="width: 480px" onchange="this.form.submit()">
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
      <td>&nbsp;</td>
      <td align="right">
	  <!--input type="button" name="B37" value="EXPORT DATA" onclick="P_ToExcel('800','400','center','ToExcel/KIB_F_ToExcel')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /-->
	  <!--input type="button" name="B37" value="KDP To KIB" onclick="P_ToKIB('900','580','<?=$gUnt?>','<?=$gSub?>','<?=$gUpb?>','<?=$_GET['IdL']?>')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px; color:#FF0000" /-->
	  <input type="button" name="B37" value="KDP To KIB *" onClick="showKDPTA('','','kdpt','<?=$_GET['IdL']?>')"
	  style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px; color:#FF0000" />	  </td>
    </tr>
    <tr> 
      <td>TAHUN</td>
      <td valign="middle"> <table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
          <tr> 
            <td width="12%"> <select class="boxs" name="fThn" style="width: 60px" tabindex="0" onchange="this.form.submit()">
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
            <td width="12%"><label>
              <input type="checkbox" name="fSD" value="Ya" <?=$eSD?> />
            s.d</label></td>
            <td width="8%">FIND</td>
            <td width="35%"> <input class="text" type="text" name="fFind" id="fFind" value="<?php echo $gFin?>" placeholder='Search' style="width:200px; font-family: Calibri; font-size: 10pt; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" /></td>
            <td width="1%">&nbsp;</td>
            <td width="26%"><input type="button" name="B39" id="B39" value="GO" onclick="P_Find()" style="width: 50px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
        <div id="printKdpDiv0" class="printKdpToAset0"> 
            <div id="printKdpDiv1" class="printKdpToAset1"></div> 
            <div id="printKdpDiv2" class="printKdpToAset2"></div> 
        </div>		
			
            <?php if ($Lev=="0x" || $Lev=="100x") {?>
            <input type="hidden" name="B392" value="Import" onclick="P_Import(); return false;" style="width: 55px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
            <?php } ?>			</td>
            <td width="6%">&nbsp;</td>
          </tr>
        </table></td>
      <td>SUB-SUB ROBJ</td>
      <td width="496"> 
        <select class="boxs" name="fRin" id="fRin" tabindex="0" style="width: 480px" onchange="this.form.submit()">
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
        </select> </td>
      <td width="10">&nbsp;</td>
      <td width="98" align="right">
	  <input type="button" name="B372" value="KDP To KIB (dok)" onclick="printKdpToAset('printKdp','<?=$_GET['IdL']?>')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px; color:#FF0000" /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>KDP TO ASET</td>
      <td>
	  <label> <input name="radioKAPI" type="radio" value="All" <?=$CkA?> onchange="B39.click()" />All</label>
	  <label> <input name="radioKAPI" type="radio" value="Y" <?=$CkB?> onchange="B39.click()" />Sudah</label>
	  <label> <input name="radioKAPI" type="radio" value="N" <?=$CkC?> onchange="B39.click()" />Belum</label>	  </td>
      <td>&nbsp;</td>
      <td align="right"><input type="button" name="B38" value="CARI REKENING" onclick="OpenAccNumb('600','500','center')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><div id="loadingImg" style="width:40px;height:10px;display:none"><img src="Images/loading3.gif" alt="" width="40" height="40"></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table border="0" align="center" id="tbViewData" style="width:99%">
    <tr> 
      <td><div id="ViewDATA" style="height:20px; width:500px; overflow:auto; display:none"></div></td>
    </tr>
  </table>
	  <table align="center" class="table-list" border="0" cellspacing="0" cellpadding="0" style="width:99%">
		<tr> 
        <th width="33" class="ac">No</th>
        <th width="110" class="ac">Referensi</th>
        <th width="65" class="ac">Register</th>
        <th align="left">Nama Barang</th>
        <th width="140" align="left">No. Pengadaan</th>
        <th width="290" align="left">Uraian</th>
        <th width="71" align="left">Perolehan</th>
        <th width="95" class="ar">Nilai Awal</th>
        <th width="99" class="ar">Nilai Akhir</th>
        <th width="140" class="ac">Actions</th>
		</tr>
		<?php
		if ($gUpb=="All") {$zUpb = $zSub.".%";}
		if ($gSub=="All") {$zUpb = $zUnt.".%.%";}
		
		if ($gThn=="All")
			{$rThn="____";}
		else
			{$rThn=$gThn;}
				
		/*
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
		*/
		
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
		{$fFindSy = "AND (Nm_Aset LIKE '%".$gFin."%' OR Harga LIKE '%".$gFin."%' OR Referensi LIKE '%".$gFin."%' OR Kd_Aset_108 LIKE '%".$gFin."%' OR Keterangan LIKE '%".$gFin."%' OR No_Pengadaan LIKE '%".$gFin."%')";}
		else
		{$fFindSy = "";}
		
		###################
		/*
		$nSQA= "SELECT Referensi, Ref_Group, No_Register, Kd_UPB, Kd_Aset, Tgl_Perolehan, Harga, No_Pengadaan FROM ta_kib_f WHERE Kd_UPB LIKE '".substr($zUpb,0,11)."%' AND Tgl_Perolehan LIKE '2017-__-__' ORDER BY Kd_Aset, No_Register";
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
				$gTGL = $mRoA[5];
				$gNIL = $mRoA[6];
				$gNOM = $mRoA[7];
				
				$gURA = "Penambahan Nilai.";
				$gKTR = "Penambahan Nilai dari Pengadaan Barang Nomor. : ".$gNOM;
				
				PostingFromKIB($gREF,$gGRP,$gREG,$gUPB,$gAST,$gTGL,$gURA,$gNIL,$gNOM,$gKTR,DatabaseSB,$ConSB);
			}
		}
		*/
		###################
		
		$POSTINGY="Yax";
		if ($POSTINGY=="Ya")
		{
			$nSQA= "SELECT Referensi as A0, Ref_Group as A1, No_Register as A2, Kd_UPB as A3, Kd_Aset as A4, Kd_Aset_108 as A5, Tgl_Perolehan as A6, Harga as A7, No_Pengadaan as A8 
			FROM ta_kib_108 WHERE Kd_UPB LIKE '".$zUpb."' AND referensi LIKE '$gRf%' AND Tgl_Perolehan LIKE '".$rThn."-__-__' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' 
			ORDER BY Kd_Aset, No_Register";
			#echo $nSQA."<br>";
			#return false;
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
					#$gKDU = fGlobalNEW("Kd_UPB","ta_kib_post_108","Referensi",$mRoRf,"=","",DatabaseSB,$ConSB,"");
					#if ($gNil==0 || $gKDU!=$mRoA[3])
					#{
						#$SQ = "UPDATE ta_kib_post_108 SET Kd_UPB='".$mRoA[3]."' WHERE IDT='".$gCeK."'";
						#$nR = mysql_query($SQ) or die(mysql_error());
					#}
				}
			}
		}
		###################
		
		$rSQ= "SELECT Referensi, KdpToAset FROM ta_kib_post_108 WHERE Referensi LIKE 'KDP%' AND Kd_UPB LIKE '".$zUpb."' ORDER BY Referensi";
		$rRs = mysql_query($rSQ);
		while ($rRo = mysql_fetch_array($rRs, MYSQL_BOTH))
		{
			$eRe = $rRo[0];
			$KdpT = fGlobal("KdpToAset","ta_kib_108","Referensi",$eRe,"=","","");
			if ($KdpT){
				$eAQ="UPDATE ta_kib_post_108 SET KdpToAset='".$KdpT."' WHERE Referensi = '".$eRe."'";
				#echo $eAQ."<br>";
				$re = mysql_query($eAQ);
			}
		}
		
		
		if ($Lev > 1 )
		{
			$N = "N";
		}
		if ($gRad=='All'){$N = "%";}
		else {$N = $gRad;}
		
		if ($eSD=="checked")
		{
			$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND KdpToAset LIKE '".$N."' AND Kd_UPB LIKE '".$zUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan <= '".$rThn."-12-31' ".$fFindSy." 
			ORDER BY KdpToAset DESC, Ref_KdpToAset, Kd_Aset, No_Register LIMIT $Offset, $DataPerPage";
		}
		else
		{	
			$nSQL= "SELECT * FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND KdpToAset LIKE '".$N."' AND Kd_UPB LIKE '".$zUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy." 
			ORDER BY KdpToAset DESC, Ref_KdpToAset, Kd_Aset, No_Register LIMIT $Offset, $DataPerPage";
		}
		#echo $nSQL."<br>";
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
			#$ReO="N";
			$kDP = $mRo['KdpToAset'];
			if ($mRo['No_Pengadaan']!="") {$DiS="NoDell";} else {$DiS="";}
			$DiS="";
			if ($mRo['Ref_Group']!="")
				{$RegGrp=$mRo['Ref_Group'];}
			else
				{$RegGrp="";}
			
			$NmB = $mRo['Nm_Aset'];
			if ($NmB==""){
				$NmB=fGlobal("Nm_Aset","Ref_Rek_Aset108_7","Kd_Aset",$mRo['Kd_Aset108'],"=","","");
			}
			
			$ClR="";
			$gHRG = $mRo['Harga'];
			$gNIL = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","Referensi:Kd_UPB",$mRo['Referensi'].":".substr($mRo['Kd_UPB'],0,11)."%","=:LIKE","","");
			if ($gHRG < $gNIL) {$ClR="; color: #0000FF";}
			
			//Kunci Data
			$KiB = "F";
			$ThN = substr($mRo['Tgl_Perolehan'],0,4);
			$gSK = substr($mRo['Kd_UPB'],0,11);
			$CeK = CekKey($gSK,$ThN,'Kib_'.$KiB,'');
			if ($CeK=='Y') {$del="lock";} else {$del="del";}
			//
			
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
			?>
			<tr height="40" <?=fBackCLR($iG)?>> 
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?=$iG?>.</td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?=$mRo['Referensi'].$kdUPB.$kd108?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?=$mRo['No_Register']?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-left:2px"><?=$NmB ?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?=$mRo['No_Pengadaan']?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-left:2px; padding-right:2px"><?=$mRo['Keterangan']?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?=fConvertDateShort($mRo['Tgl_Perolehan'])?></td>
              <td align="right" style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-right:2px"><?=fConvertToRupiah($mRo['Harga'])?></td>
              <td align="right" style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-right:2px <?=$ClR?>"><?=fConvertToRupiah($gNIL)?></td>
              <td style="border-bottom: #999999 dotted 1px" align="center">
			  <a href="#" class="ico docu" onclick="P_OpenKibar('800','400','<?=$mRo['IDT']?>','<?=$_GET['IdL']?>'); return false">&nbsp;Kibar</a>
			  <?php if ($mRo['KdpToAset']=='N'){?>
			  <a href="#" class="ico edit" onclick="EditData('1020','550','center','<?=$mRo['IDT']?>'); return false">Edit</a>&nbsp;&nbsp;
			  <?php if ($Lev <= 1) {?>
			  	|&nbsp;<a href="#" class="ico <?=$del?>" onclick="P_DeleteR('<?=$ReO?>','<?=$CeK?>','<?=$ThN?>','<?=$KiB?>','<?=$mRo['IDT']?>','<?=$RegGrp?>','<?=$DiS?>'); return false">Delete</a>
			  <?php } ?>
			  <?php } else {
			  	#echo "<b>==> ".fGlobal("Referensi","ta_kib_kdptoaset_data","Ref_Aset:Kd_UPB",$mRo['Referensi'].":".substr($mRo['Kd_UPB'],0,11)."%","=:LIKE","","")."</b>";
			   } ?>
			  </td>
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
		  	if ($eSD=='checked')
			{
				$nSQL= "SELECT COUNT(*) AS JmlRc FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND KdpToAset LIKE '".$N."' AND Kd_UPB LIKE '".$zUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan <= '".$rThn."-12-31' ".$fFindSy;
			}
			else
			{
				$nSQL= "SELECT COUNT(*) AS JmlRc FROM ta_kib_108 WHERE referensi LIKE '$gRf%' AND KdpToAset LIKE '".$N."' AND Kd_UPB LIKE '".$zUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy;
			}
			$fUlrR= "FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&eSD=".$eSD."&gFin=".$gFin."&gRad=".$gRad."&gUnt=".$zUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gBid=".$gBid."&gKel=".$gKel."&gOBJ=".$gOBJ."&gRin=".$gRin."&";
			include "FilePagingBot.php";
			
			#$eSD
			#gRad
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
	
	function P_DeleteR(ReO,KeY,ThN,KiB,xA,xB,xD)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		if (KeY=='Y') {alert('Access denied, data kib '+KiB+' tahun '+ThN+' sudah terkunci..!!'); return false;}
		if (xD=="NoDell") {window.alert('Access denied..!!'); return false;}
		
		if (xB!="")
			{window.alert("Teknis input menggunakan fasilitas GROUP, penghapusan langsung belum diperbolehkan, \ngunakan fasilitas penghapusan dengan cara mengurangi jumlah item aset ...!");}
		else
		{
			var AN = confirm("Hapus data KDP..?!!");
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
						$URL_Top = "Form_Asset_F_Top.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
						$URL_Mid = "Form_Asset_F_Mid.php?gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&gBid=".$zBid."&gKel=".$zKel."&gOBJ=".$zOBJ."&gRin=".$zRin."&IdL=".$_GET['IdL'];
						$URL_Bot = "Form_Asset_F_Bot.php";
					?>       			
       			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFormKIB_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFormKIB_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"
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
						$URL_Mid = "Open_KIB_Mid.php?CrKIB=KIB_F&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_GET['IdL'];
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
						$URL_Top = "Find_Acc_Top.php?CrAcc=KIB-F&FrmG=".$_GET['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_GET['IdL'];
						$URL_Mid = "Find_Acc_Mid.php?CrAcc=KIB-F&FrmG=".$_GET['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_GET['IdL'];
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
			URL_Top = "Form_Asset_F_Top.php?"+"<?="FrmG=".$_GET['FrmG']?>";
			URL_Mid = "Form_Asset_F_Mid.php?rIDT="+IDT+"<?="&IdL=".$_GET['IdL']?>";
			URL_Bot = "Form_Asset_F_Bot.php";
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}

	function P_ToKIB(w,h,gUnt,gSub,gUpb,IdL)
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
			win.window.document.open();
			URL_Top = 'Form_Asset_F_KdpToKib_Top.php?gUnt='+gUnt+'&gSub='+gSub+'&gUpb='+gUpb+'&IdL='+IdL;
			URL_Mid = 'Form_Asset_F_KdpToKib_Mid.php?gUnt='+gUnt+'&gSub='+gSub+'&gUpb='+gUpb+'&IdL='+IdL;
			URL_Bot = 'Form_Asset_F_KdpToKib_Bot.php';
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='230,*,30' frameborder='0'>"+
			"<frame name='WinFormKDP_Top' noresize src='"+URL_Top+"' scrolling='no'>"+
			"<frame name='WinFormKDP_Mid' noresize src='"+URL_Mid+"' scrolling='auto'>"+
			"<frame name='WinFormKDP_Bot' noresize src='"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>";
			win.focus();
			win.window.document.clear();
			win.window.document.write(txtHTML);
			win.window.document.close() ;
			win.setTimeout("self.close()",200000000);
		}
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
			url:"KIB-F_Import_.php", 
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

function P_OpenDoc(w,h,IdL)
{
	gUnt = objfrm.fUnt.value;
	gSub = objfrm.fSub.value;
	gUpb = objfrm.fUpb.value;
	
	gBid = objfrm.fBid.value;
	gKel = objfrm.fKel.value;
	gOBJ = objfrm.fOBJ.value;
	gRin = objfrm.fRin.value;
	
	gThn = objfrm.fThn.value;
	eSD  = objfrm.fSD.value;
	if (objfrm.fSD.checked==false)
	{
		fSD="No";
	}
	else
	{
		fSD="Ya";
	}
	//alert(eSD); return false;
	
	gKDP = "";
	Len = objfrm.radioKAPI.length;
	for (i=0; i<=Len; i++)
	{
		if (objfrm.radioKAPI[i].checked) {gKDP = objfrm.radioKAPI[i].value; break; }
	}
	//alert(gKDP); return false;
	gFin = objfrm.fFind.value;
	
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	TopPosition=(screen.height)?(screen.height-h)/2:100;
	URL= 'KIB_F_Dokumen.php?CriT=BPK&gKDP='+gKDP+'&fSD='+fSD+'&gUnt='+gUnt+'&gSub='+gSub+'&gUpb='+gUpb+'&gBid='+gBid+'&gKel='+gKel+'&gOBJ='+gOBJ+'&gRin='+gRin+'&gFin='+gFin+'&gThn='+gThn+'&IdL='+IdL;
	settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
	window.open(URL,'',settings);
}

function showKDPTA(CrT,IdT,CrDiv,IdL)
{ 
	if (CrT=='refr'){
		
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv1").load('kdp_toset_frm_edit_top.php?IdT='+IdT+'&CrDiv='+CrDiv+'&IdL='+IdL);
			$("#"+CrDiv+"MstDiv2").load('kdp_toset_frm_edit_mid.php?IdT='+IdT+'&CrDiv='+CrDiv+'&IdL='+IdL);
			$("#"+CrDiv+"MstDiv3").load('kdp_toset_frm_edit_bot.php?IdT='+IdT+'&CrDiv='+CrDiv+'&IdL='+IdL);
		});
	}
	else 
	{
		Upb = $("#fUpb").val();
		Rin = $("#fRin").val();
		//if (Upb=='All'){alert('Pilihan UPB belum tepat...!!'); return false;};
		//if (Rin=='All'){alert('Pilihan SUB-SUB ROBJ belum tepat...!!'); return false;};
		
		if (CrT!='reset') {dispBLOCK(CrDiv+'MstDiv2');}
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv1").load('kdp_toset_frm_edit_top.php?kUpb='+Upb+'&kRin='+Rin+'&CrDiv='+CrDiv+'&IdL='+IdL);
			$("#"+CrDiv+"MstDiv2").load('kdp_toset_frm_edit_mid.php?kUpb='+Upb+'&kRin='+Rin+'&CrDiv='+CrDiv+'&IdL='+IdL);
			$("#"+CrDiv+"MstDiv3").load('kdp_toset_frm_edit_bot.php?kUpb='+Upb+'&kRin='+Rin+'&CrDiv='+CrDiv+'&IdL='+IdL);
		});
		if (CrT!='reset') {dispBlockOrNo(CrDiv+'MstDiv0');}
	}
}

function SaveDATA(CrDiv,IdT,IdL)
{
	Rin = $("#kRin").val();
	Upb = $("#kUpb").val();
	Hri = $("#fH").val();
	Bln = $("#fB").val();
	Thn = $("#fT").val();
	Nom = $("#fNom").val();
	Mem = ReplaceText($("#fMem").val());
	
	if (Upb=='' || Upb=='All'){alert('Pilihan UPB belum tepat...!!'); return false;}
	if (Rin=='' || Rin=='All'){alert('Pilihan REKENING belum tepat...!!'); return false;}
	
	$(document).ready(function() 
	{
		$("#"+CrDiv+"MstDiv2").load('kdp_toset_frm_edit_save.php?IdT='+IdT+'&Upb='+Upb+'&Rin='+Rin+'&Hri='+Hri+'&Bln='+Bln+'&Thn='+Thn+'&Nom='+Nom+'&Mem='+Mem+'&CrDiv='+CrDiv+'&IdL='+IdL);
	});
}

function findDATA(fnD,CrDiv,IdL)
{
	SkP = $("#fUnt").val();
	Upb = $("#fUpb").val();
	ThN = $("#eThn").val();
	
	if (fnD!=''){
		FnD = $("#fFndDTA").val();
		for (iG=1; iG<=100;iG++)
		{
			FnD =  FnD.replace(' ','**'); 
		}
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv2").load('kdp_toset_frm_find_mid.php?FnD='+FnD+'&SkP='+SkP+'&ThN='+ThN+'&CrDiv='+CrDiv+'&IdL='+IdL);
		});
	}
	else
	{
		ThN = "";
		dispNO('upbMstDiv0');
		dispNO('rekMstDiv0');
		
		dispBLOCK(CrDiv+'MstDiv2');
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv1").load('kdp_toset_frm_find_top.php?CrDiv='+CrDiv+'&IdL='+IdL);
			$("#"+CrDiv+"MstDiv2").load('kdp_toset_frm_find_mid.php?SkP='+SkP+'&ThN='+ThN+'&CrDiv='+CrDiv+'&IdL='+IdL);
		});
		dispBlockOrNo(CrDiv+'MstDiv0');
	}
}

function deleDATA(CrDiv,IdT,ExT,IdL)
{
	if (ExT=='Y'){alert('Access denied..!!'); return false;}
	AN = confirm('Remove data..!');
	if (!AN){return false;}
	$(document).ready(function() 
	{
		$("#kdptMstDiv2").load('kdp_toset_frm_find_del.php?IdT='+IdT+'&CrDiv='+CrDiv+'&IdL='+IdL);
		//$("#MstDELL").load('kdp_toset_frm_find_del.php?IdT='+IdT+'&CrDiv='+CrDiv+'&IdL='+IdL);
		
	});
}

function findKDP(fnD,eXe,IdT,CrDiv,IdL)
{
	if (IdT==''){alert('Data belum disave..!!'); return false;}
	if (eXe=='Y'){alert('Access denied..!!'); return false;}
	
	if (fnD!=''){
		FnD = $("#fFndKDPDTA").val();
		for (iG=1; iG<=100;iG++)
		{
			FnD =  FnD.replace(' ','**'); 
		}
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv2").load('kdp_toset_frm_kdp_find_mid.php?IdT='+IdT+'&FnD='+FnD+'&CrDiv='+CrDiv+'&IdL='+IdL);
		});
	}
	else
	{
		dispBLOCK(CrDiv+'MstDiv2');
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv1").load('kdp_toset_frm_kdp_find_top.php?IdT='+IdT+'&CrDiv='+CrDiv+'&eXe='+eXe+'&IdL='+IdL);
			$("#"+CrDiv+"MstDiv2").load('kdp_toset_frm_kdp_find_mid.php?IdT='+IdT+'&CrDiv='+CrDiv+'&eXe='+eXe+'&IdL='+IdL);
		});
		dispBlockOrNo(CrDiv+'MstDiv0');
	}
}

function AddKDP(CrDiv,IdR,IdT,IdL)
{
	$(document).ready(function() 
	{
		//$("#kdptMstDiv2").load('kdp_toset_frm_kdp_find_add.php?IdR='+IdR+'&IdT='+IdT+'&CrDiv='+CrDiv+'&IdL='+IdL);
		$("#MstDELL").load('kdp_toset_frm_kdp_find_add.php?IdR='+IdR+'&IdT='+IdT+'&CrDiv='+CrDiv+'&IdL='+IdL);
		
	});
}

function RemKDP(CrDiv,IdR,IdT,ExT,IdL)
{
	if (ExT=='Y'){alert('Access denied..!!'); return false;}
	AN = confirm('Remove data..!');
	if (!AN){return false;}
	$(document).ready(function() 
	{
		//$("#kdptMstDiv2").load('kdp_toset_frm_edit_rem.php?IdR='+IdR+'&IdT='+IdT+'&CrDiv='+CrDiv+'&IdL='+IdL);
		$("#MstDELL").load('kdp_toset_frm_edit_rem.php?IdR='+IdR+'&IdT='+IdT+'&CrDiv='+CrDiv+'&IdL='+IdL);
		
	});
}

function IndKDP(CrDiv,IdR,IdT,IdL)
{
	AN = confirm('Jadikan induk ..!');
	if (!AN){return false;}
	$(document).ready(function() 
	{
		//$("#kdptMstDiv2").load('kdp_toset_frm_edit_rec.php?IdR='+IdR+'&IdT='+IdT+'&CrDiv='+CrDiv+'&IdL='+IdL);
		$("#MstDELL").load('kdp_toset_frm_edit_rec.php?IdR='+IdR+'&IdT='+IdT+'&CrDiv='+CrDiv+'&IdL='+IdL);
		
	});
}

function findUPB(fnD,CrDiv,IdL)
{
	SkP = $("#fUnt").val();
	
	if (fnD!=''){
		FnD = $("#fFndUPB").val();
		for (iG=1; iG<=100;iG++)
		{
			FnD =  FnD.replace(' ','**'); 
		}
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv2").load('kdp_toset_frm_find_upb_mid.php?FnD='+FnD+'&SkP='+SkP+'&CrDiv='+CrDiv+'&IdL='+IdL);
		});
	}
	else
	{
		dispNO('rekMstDiv0');
		dispBLOCK(CrDiv+'MstDiv2');
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv1").load('kdp_toset_frm_find_upb_top.php?CrDiv='+CrDiv+'&IdL='+IdL);
			$("#"+CrDiv+"MstDiv2").load('kdp_toset_frm_find_upb_mid.php?SkP='+SkP+'&CrDiv='+CrDiv+'&IdL='+IdL);
		});
		dispBlockOrNo(CrDiv+'MstDiv0');
	}
}

function findREK(fnD,CrDiv,IdL)
{
	if (fnD!=''){
		FnD = $("#fFndREK").val();
		for (iG=1; iG<=100;iG++)
		{
			FnD =  FnD.replace(' ','**'); 
		}
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv2").load('kdp_toset_frm_find_rek_mid.php?FnD='+FnD+'&CrDiv='+CrDiv+'&IdL='+IdL);
		});
	}
	else
	{
		dispBLOCK(CrDiv+'MstDiv2');
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv1").load('kdp_toset_frm_find_rek_top.php?CrDiv='+CrDiv+'&IdL='+IdL);
			$("#"+CrDiv+"MstDiv2").load('kdp_toset_frm_find_rek_mid.php?CrDiv='+CrDiv+'&IdL='+IdL);
		});
		dispBlockOrNo(CrDiv+'MstDiv0');
	}
}

function showLst_Add(KdE,NmA,CrDiv,IdL)
{
	
	dispBlockOrNo(CrDiv+'MstDiv0');
	
	if (CrDiv=='upb'){
		$("#kUpb").val(KdE);
		$("#eUpb").val(NmA);
		
	}
	if (CrDiv=='rek'){
		$("#kRin").val(KdE);
		$("#eRin").val(NmA);
		
	}
}

function prosToAset(CrT,IdT,CrDiv,IdL)
{
	tCnT = $("#tCnT").val();
	if (IdT==''){alert('Data belum disimpan...!!'); return false;}
	if (tCnT==0){alert('Belum ada item aset...!!'); return false;}
	if (CrT!=''){
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv2").load('kdp_toset_frm_proses_mid.php?IdT='+IdT+'&CrDiv='+CrDiv+'&IdL='+IdL);
		});
	}
	else
	{
		dispBLOCK(CrDiv+'MstDiv2');
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv1").load('kdp_toset_frm_proses_top.php?IdT='+IdT+'&CrDiv='+CrDiv+'&IdL='+IdL);
			$("#"+CrDiv+"MstDiv2").load('kdp_toset_frm_proses_mid.php?IdT='+IdT+'&CrDiv='+CrDiv+'&IdL='+IdL);
		});
		dispBlockOrNo(CrDiv+'MstDiv0');
	}
}

function prosToAsetSave(IdT,CrDiv,IdL)
{
	rInd = $("#rInd").val();
	if (rInd==''){alert('Indukan aset belum dipilih...!!'); return false;}
	
	tSu2 = $("#tSu2").val();
	if (tSu2==0){alert('Rekening aset belum dipilih...!!'); return false;}
	
	fNmA = ReplaceText($("#fNmA").val());
	if (fNmA==''){alert('Silahkan isi nama aset...!!'); return false;}
	
	AN = confirm('Lanjutkan Proses KDP to Aset..??');
	if (!AN){return false;}
	
	$(document).ready(function() 
	{
		$("#"+CrDiv+"MstDiv2").load('kdp_toset_frm_proses_save.php?IdT='+IdT+'&fNmA='+fNmA+'&tSu2='+tSu2+'&CrDiv='+CrDiv+'&IdL='+IdL);
	});
}

function prosToAsetBatal(IdT,CrDiv,IdL)
{
	AN = confirm('Batalkan data KDP to Aset..??');
	if (!AN){return false;}
	
	$(document).ready(function() 
	{
		$("#"+CrDiv+"MstDiv2").load('kdp_toset_frm_proses_batal.php?IdT='+IdT+'&CrDiv='+CrDiv+'&IdL='+IdL);
	});
}

function reknFIND(fnD,CrDiv,crt,eXe,IdL)
{
	if (eXe=='Y'){alert('Access denied..!!'); return false;}
	if (crt=='4'){
		rRin = $("#rRin").val(); 
		if (rRin=='1.3.6.01.01.01.001'){
			MsT = "1.3.1";
		}
		else if (rRin=='1.3.6.01.01.01.002'){
			MsT = "1.3.2";
		}
		else if (rRin=='1.3.6.01.01.01.003'){
			MsT = "1.3.3";
		}
		else if (rRin=='1.3.6.01.01.01.004'){
			MsT = "1.3.4";
		}
		else if (rRin=='1.3.6.01.01.01.005'){
			MsT = "1.3.5";
		}
	}
	else if (crt=='5'){
		MsT = $("#tObj").val();
		if (MsT==''){alert('Objek belum dipiih..!!'); return false;}
	}
	else if (crt=='6'){
		MsT = $("#tRio").val();
		if (MsT==''){alert('Rincian objek belum dipiih..!!'); return false;}
	}
	else if (crt=='7'){
		MsT = $("#tSub").val();
		if (MsT==''){alert('Sub rincian objek belum dipiih..!!'); return false;}
	}
	
	if (fnD!=''){
		FnD = $("#fFndREKN").val();
		for (iG=1; iG<=100;iG++)
		{
			FnD =  FnD.replace(' ','**'); 
		}
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv2").load('kdp_toset_frm_proses_mid_fnd_rekn_mid.php?FnD='+FnD+'&crt='+crt+'&MsT='+MsT+'&CrDiv='+CrDiv+'&IdL='+IdL);
		});
	}
	else
	{
		dispBLOCK(CrDiv+'MstDiv2');
		$(document).ready(function() 
		{
			$("#"+CrDiv+"MstDiv1").load('kdp_toset_frm_proses_mid_fnd_rekn_top.php?crt='+crt+'&CrDiv='+CrDiv+'&IdL='+IdL);
			$("#"+CrDiv+"MstDiv2").load('kdp_toset_frm_proses_mid_fnd_rekn_mid.php?crt='+crt+'&MsT='+MsT+'&CrDiv='+CrDiv+'&IdL='+IdL);
		});
		dispBlockOrNo(CrDiv+'MstDiv0');
	}
}

function reknFIND_Add(KdE,NmA,crt,CrDiv,IdL)
{
	
	dispBlockOrNo(CrDiv+'MstDiv0');
	
	if (crt=='4'){
		$("#tObj").val(KdE); $("#dObj").val(NmA);
		$("#tRio").val(''); $("#dRio").val('');
		$("#tSub").val(''); $("#dSub").val('');
		$("#tSu2").val(''); $("#dSu2").val('');
	}
	if (crt=='5'){
		$("#tRio").val(KdE); $("#dRio").val(NmA);
		$("#tSub").val(''); $("#dSub").val('');
		$("#tSu2").val(''); $("#dSu2").val('');
	}
	if (crt=='6'){
		$("#tSub").val(KdE); $("#dSub").val(NmA);
		$("#tSu2").val(''); $("#dSu2").val('');
	}
	if (crt=='7'){
		$("#tSu2").val(KdE); $("#dSu2").val(NmA);
	}
}


function printKdpToAset(CrDiv,IdL)
{
	//alert(CrDiv); return false;
	dispBLOCK(CrDiv+'Div2');
	$(document).ready(function() 
	{
		$("#"+CrDiv+"Div1").load('kdp_toset_print_top.php?CrDiv='+CrDiv+'&IdL='+IdL);
		$("#"+CrDiv+"Div2").load('kdp_toset_print_mid.php?CrDiv='+CrDiv+'&IdL='+IdL);
	});
	dispBlockOrNo(CrDiv+'Div0');
}

function P_OpenDC(doc,w,h,IdL)
{
	HrA = $("#fHriA").val();
	HrB = $("#fHriB").val();

	BnA = $("#fBlnA").val();
	BnB = $("#fBlnB").val();
	
	ThA = $("#fThnA").val();
	ThB = $("#fThnB").val();
	
	Bid = $("#fBid").val();
	Kel = $("#fKel").val();
	OBJ = $("#fOBJ").val();
	Rin = $("#fRin").val();
	
	Unt = $("#fUnt").val();
	Sub = $("#fSub").val();
	Upb = $("#fUpb").val();
	
	//alert(Bid+':'+Kel+':'+OBJ+':'+Rin);
	
	//alert(HrA+':'+HrB+'#'+BnA+':'+BnB+'#'+ThA+':'+ThB);
	
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	TopPosition=(screen.height)?(screen.height-h)/2:100;
	URL= doc+'.php?Unt='+Unt+'&Sub='+Sub+'&Upb='+Upb+'&Bid='+Bid+'&Kel='+Kel+'&OBJ='+OBJ+'&Rin='+Rin+'&HrA='+HrA+'&HrB='+HrB+'&BnA='+BnA+'&BnB='+BnB+'&ThA='+ThA+'&ThB='+ThB+'&IdL='+IdL;
	settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
	window.open(URL,'WinOpen'+doc,settings);
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

$("#fFind").focus();

</script>            
