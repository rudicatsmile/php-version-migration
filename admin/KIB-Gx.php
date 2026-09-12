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
if ($UID =="creatorXX") {
	$SQL="CREATE TABLE `ta_kib_g` (
	`IDT` int(11) NOT NULL AUTO_INCREMENT,
	`Referensi` varchar(15) NOT NULL DEFAULT '',
	`Ref_Group` varchar(15) DEFAULT '',
	`Kd_UPB` varchar(17) NOT NULL DEFAULT '',
	`Kd_Aset` varchar(15) NOT NULL DEFAULT '',
	`No_Register` varchar(7) NOT NULL DEFAULT '',
	`Nm_Aset` varchar(100) DEFAULT '',
	`Kd_Pemilik` varchar(2) DEFAULT NULL,
	`Tgl_Perolehan` date DEFAULT NULL,
	`Lokasi` varchar(255) DEFAULT NULL,
	`Dokumen_Tanggal` date DEFAULT '0000-00-00',
	`Dokumen_Nomor` varchar(50) DEFAULT NULL,
	`Asal_Usul` varchar(50) DEFAULT NULL,
	`Kondisi` char(2) DEFAULT NULL,
	`Harga` double(19,2) NOT NULL DEFAULT '0.00',
	`Nilai_Akhir` double(19,2) DEFAULT '0.00',
	`Keterangan` varchar(255) DEFAULT NULL,
	`Post` enum('Y','N') DEFAULT 'N',
	`Status` varchar(20) DEFAULT '',
	`Pencatat` varchar(30) DEFAULT NULL,
	`Recorded` datetime DEFAULT '0000-00-00 00:00:00',
	PRIMARY KEY (`IDT`),
	KEY `Kd_Aset` (`Kd_Aset`),
	KEY `Kd_UPB` (`Kd_UPB`),
	KEY `No_Register` (`No_Register`),
	KEY `Ref_Group` (`Ref_Group`),
	KEY `Referensi` (`Referensi`)
	) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC";
	$nRs = mysql_query($SQL) or die(mysql_error());
}

extract($_GET);
if (isset($_GET['gUnt'])) {$gUnt  = $_GET['gUnt'];} else {$gUnt  ="";}
if (isset($_GET['gSub'])) {$gSub  = $_GET['gSub'];} else {$gSub  ="";}
if (isset($_GET['gUpb'])) {$gUpb  = $_GET['gUpb'];} else {$gUpb  ="";}
if (isset($_GET['gThn'])) {$gThn  = $_GET['gThn'];} else {$gThn  ="";}
if (isset($_GET['gBid'])) {$gBid  = $_GET['gBid'];} else {$gBid  ="";}
if (isset($_GET['gKel'])) {$gKel  = $_GET['gKel'];} else {$gKel  ="";}
if (isset($_GET['gOBJ'])) {$gOBJ  = $_GET['gOBJ'];} else {$gOBJ  ="";}
if (isset($_GET['gRin'])) {$gRin  = $_GET['gRin'];} else {$gRin  ="";}
if (isset($_GET['gFin'])) {$gFin  = $_GET['gFin'];} else {$gFin  ="";}
if (isset($_GET['eMuT'])) {$eMuT  = $_GET['eMuT'];} else {$eMuT  ="";}

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
$rKib = "07.__";
?>

<body onload="javascript:myfrm.fFind.focus()">
<?php require "FileMenu.php";?>
<form name="myfrm" method="post" action="<?php echo "KIB-G_.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>">
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
        </select> </td>
      <td width="94">KELOMPOK</td>
      <td> <select class="boxs" name="fBid" tabindex="0" style="width: 480px" onchange="P_Change()">
          <option value=""></option>
          <option <?php if ($gBid=="All") {echo "selected";} ?> value="All">All</option>
          <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset2 WHERE Kd_Aset LIKE '07.__' ORDER BY Kd_Aset";
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
		<option value="All">All</option> 
          <?php
		if ($Lev <=3 ) {$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".__' ORDER BY Kd_Sub";}
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
      <td align="right">
	  <!--input type="button" name="B36" value="DOKUMEN" onclick="OpenKIB('650','350','center')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /-->
	  <input type="button" name="B36" value="DOKUMEN KIB" onclick="P_OpenDoc('800','400','<?=$_GET['IdL']?>')"  style="color:#0000FF; width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  </td>
    </tr>
    <tr> 
      <td width="92">UPB</td>
      <td width="519"> 
        <select class="boxs" name="fUpb" id="fUpb" tabindex="0" style="width: 470px" onchange="this.form.submit()">
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
      <td align="right"><input type="button" name="B37" disabled value="EXPORT DATA" onclick="P_ToExcel('800','400','center','ToExcel/KIB_G_ToExcel')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
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
            <td width="35%"> <input class="text" type="text" name="fFind" value="<?php echo $gFin?>" style="font-family: Calibri; font-size: 10pt; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" /></td>
            <td width="1%">&nbsp;</td>
            <td width="11%"> <input type="button" name="B39" value="GO" onclick="P_Find()" style="width: 50px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
            <td width="21%">
			<?php if ($Lev=="0" || $Lev=="100") {?>
			<input type="button" name="B392" value="Import" onclick="P_Import(); return false;" style="width: 55px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
			<?php } ?>
			</td>
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
        <input type="button" name="B38" value="CARI REKENING" onclick="OpenAccNumb('600','500','center')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><div id="loadingImg" style="width:15px;height:15px;display:none"><img src="Images/loading3.gif" alt="" width="15" height="15"></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><label style="float:right; color:#FF0000"><input type="checkbox" name="fSdhMutasi" <?php if ($eMuT!="") {echo "checked";}?> onclick="P_Find()" value="ON" />Sudah Mutasi</label></td>
    </tr>
  <table border="0" align="center" id="tbViewData" style="width:99%">
    <tr> 
      <td><div id="ViewDATA" style="height:0px; width:500px; overflow:auto;"></div></td>
    </tr>
  </table>
  </table>
	  <table align="center" class="table-list" border="0" cellspacing="0" cellpadding="0" style="width:99%">
		<tr> 
			<th width="28" class="ac">No</th>
			<th width="100" class="ac">Referensi</th>
			<th width="59" class="ac">Register</th>
			<th width="262" style="padding-left:2px">Nama Barang</th>
			<th width="244" style="padding-left:2px">Uraian</th>
			<th width="102" style="padding-left:2px">Ref. History</th>
			<th width="79" class="ac">Perolehan</th>
			<th width="81" class="ac">TGL. MUTASI </th>
			<th width="112" class="ar" style="padding-right:2px">Nilai Perolehan</th>
			<th width="111" class="ar" style="padding-right:2px">Nilai Akhir</th>
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
		{$fFindSy = "AND (Ref_Usulan LIKE '%".$gFin."%' OR Nm_Aset LIKE '%".$gFin."%' OR Harga LIKE '%".$gFin."%' OR Referensi LIKE '%".$gFin."%' OR Ref_History LIKE '%".$gFin."%' OR Ref_Mutasi LIKE '%".$gFin."%' OR Kd_Aset LIKE '%".$gFin."%' OR Keterangan LIKE '%".$gFin."%')";}
		else
		{$fFindSy = "";}
		
		###################
		$rEXE="YAx";
		if ($rEXE=="YA"){
			#$nSQA= "SELECT Referensi, Ref_Group, No_Register, Kd_UPB, Kd_Aset, Tgl_Perolehan, Harga, No_Pengadaan FROM ta_kib_g WHERE Kd_UPB LIKE '".substr($zUpb,0,11)."%' $fFindSy AND Ref_Mutasi='' ORDER BY Kd_Aset, No_Register LIMIT $Offset, $DataPerPage";
			$nSQA= "SELECT Referensi, Ref_Group, No_Register, Kd_UPB, Kd_Aset, Tgl_Perolehan, Harga, No_Pengadaan FROM ta_kib_g where Kd_UPB LIKE '".$zUpb."' AND Kd_Aset LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy." AND Ref_Mutasi='' ORDER BY Kd_Aset, No_Register LIMIT $Offset, $DataPerPage";
			$nRsA= mysql_query($nSQA) or die(mysql_error());
			while ($mRoA = mysql_fetch_array($nRsA, MYSQL_BOTH))
			{
				$mHrG = $mRoA[6];
				$mRoRf = $mRoA[0];
				$mRoUP = substr($mRoA[3],0,11);
				$gCeK = fGlobalNEW("IDT","ta_kib_post","Referensi:Kd_UPB",$mRoRf.":".$mRoUP."%","=:LIKE","",DatabaseSB,$ConSB,"");
				if ($gCeK==""){
					$gREF = $mRoA[0];
					$gGRP = $mRoA[1];
					$gREG = $mRoA[2];
					$gUPB = $mRoA[3];
					$gAST = $mRoA[4];
					$gTGL = $mRoA[5];
					$gNIL = $mRoA[6];
					$gNOM = $mRoA[7];
					
					$gURA = "";
					$gKTR = "";
					
					PostingFromKIB($gREF,$gGRP,$gREG,$gUPB,$gAST,$gTGL,$gURA,$gNIL,$gNOM,$gKTR,DatabaseSB,$ConSB);
				}
				else{
					$gHrG = fGlobalNEW("IfNull(sum(Debet),0)","ta_kib_post","Referensi:Kd_UPB",$mRoRf.":".$mRoUP."%","=:LIKE","",DatabaseSB,$ConSB,"");
					if ($gHrG<$mHrG)
					{
						$SQW="UPDATE ta_kib_post SET debet='$mHrG' WHERE IDT='$gCeK'";
						#echo $SQW."<br>";
						$nRW= mysql_query($SQW);
					}
				}
			}
		}
		###################
		
		#$nSQL= "SELECT * FROM ta_kib_g".$tMuTZ." where Kd_UPB LIKE '".$zUpb."' AND Kd_Aset LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy." ORDER BY Kd_Aset, No_Register LIMIT $Offset, $DataPerPage";
		$nSQL= "SELECT * FROM ta_kib_g".$tMuTZ." where Kd_UPB LIKE '".$zUpb."' AND Kd_Aset LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy." ORDER BY Referensi LIMIT $Offset, $DataPerPage";
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
			$KdA = $mRo['Kd_Aset'];
			if ($mRo['Ref_Group']!="")
				{$RegGrp=$mRo['Ref_Group'];}
			else
				{$RegGrp="";}
			
			$nR = mysql_query($nSQ);
			
			$gCEU = fGlobal("referensi","ta_usulan_rinci_108","Ref_Aset:Kd_UPB",$mRo['Referensi'].":".$mRo['Kd_UPB'],"=:=","","");
			if ($gCEU!=""){
				$Blnk="; background:#F1F8A0";
			}
			else{
				$Blnk="";
			}
			
			$gCeU = $mRo['Ref_Mutasi'];
			if ($gCeU!=""){
				$ID=fGlobal("IDT","ta_usulan_rinci_108","Referensi:Ref_Aset",$mRo['Ref_Usulan'].":".$mRo['Ref_Mutasi'],"=:=","","");
				$ff = "fff";
				if ($ID==""){
					$ff = "ff0000";
				}
				$BV="<font style='background:#000000; color:#fff'>Mutasi Masuk : ".$mRo['Ref_Mutasi']."</font><br>";
				$BV.="<font style='background:#000000; color:#".$ff."'>Referensi : ".$mRo['Ref_Usulan']."</font><br>";
			}
			else{
				$BV="";
			}
			if ($tMuTZ!=""){$BV="";}
			
			$gNIa = fGlobal("IfNull(sum(Debet),0)","Ta_KIB_Post".$tMuTZ,"Referensi:Kd_UPB",$mRo['Referensi'].":".$mRo['Kd_UPB'],"=:=","","");
			$gNIb = 0;
			if ($gNIb != 0) {$gNIL = $gNIa - $gNIb;}
			else {$gNIL=$gNIa;}
			
			if ($gNIL==0){
				if ($mRo['Ref_Mutasi']<>""){
					$RfT  = $mRo['Referensi'];
					$RfA  = $mRo['Ref_Mutasi'];
					$RfU  = $mRo['Ref_Usulan'];
					$ReG  = $mRo['No_Register'];
					$mUPB = $mRo['Kd_UPB'];
					$mRoH = $mRo['Harga'];
					#PostingFromPOSTMUTASI($RfA,$RfU,$RfT,$mUPB,$ReG,$mRoH,$UID,DatabaseSB,$ConSB);
				}
			}
			
			$gHRG = $mRo['Harga'];
			if ($gHRG > $gNIL) {$ClR="; color: #FF0000";}
			else if ($gHRG < $gNIL) {$ClR="; color: #0000FF";}
			else {$ClR="";}
			
			$NmB=$mRo['Nm_Aset'];
			
			//Kunci Data
			$KiB = "G";
			$ThN = substr($mRo['Tgl_Perolehan'],0,4);
			$gSK = substr($mRo['Kd_UPB'],0,11);
			$CeK = CekKey($gSK,$ThN,'Kib_'.$KiB,'');
			if ($CeK=='Y') {$del="lock";} else {$del="del";}
			//
			
			$gCnT = fGlobal("count(*)","ta_kib_g","referensi:kd_upb",$mRo['Referensi'].":".substr($mRo['Kd_UPB'],0,11)."%","=:LIKE","","");
			$Ujung= substr($mRo['Kd_UPB'],-3,3);
			if ($Ujung=='000'){
				$kdUPB  = "<br><font style='color:#ff0000; font-style:italic'>error kode upb..!!</font>";
			}
			else{
				$kdUPB  = "";
			}
			
			#if ($gCnT>1 && $tMuTZ=='' && $mRo['Ref_Mutasi']=='BNG.00000000637'){
			#if ($gCnT>1 && $tMuTZ=='' && substr($mRo['Ref_Mutasi'],0,3)=='ALTxx'){
			#if ($gCnT>1 && $tMuTZ=='' && substr($mRo['Ref_Mutasi'],0,3)=='ATL'){
			if ($gCnT>1 && $tMuTZ=='' && (substr($mRo['Ref_Mutasi'],0,3)=='ALT'|| substr($mRo['Ref_Mutasi'],0,3)=='ATL')){
				$gCnT = "(<font style='color:#ff0000; font-style:italic'>".$gCnT."</font>)";
				repairREFERENSI($mRo['Referensi'],$mRo['Kd_UPB'],$mRo['IDT'],"");
			}
			else{
				$gCnT = "";
			}
			?>
			<tr <?=fBackCLR($iG)?> height="40" style=" vertical-align: middle <?=$Blnk?>"> 
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?php echo $iG?>.</td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?php echo $mRo['Referensi'].$gCnT.$kdUPB?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?php echo $mRo['No_Register']?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-left:2px; padding-right:2px"><?=$NmB ?><?php if ($gCEU){echo "<br><i><font style='color:#0000ff'>Usulan Mutasi: ".$gCEU."</font></i>";}?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-left:2px; padding-right:2px"> 
                <?php
				if  ((int) strlen($mRo['Keterangan']) > 65)
				{echo $BV.substr($mRo['Keterangan'],0,65)." .....";}
				else
				{echo $BV.$mRo['Keterangan'];}
				?>              </td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-left:2px; padding-right:2px"><?php echo $mRo['Ref_Mutasi']?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center; border-right:#999999 dotted 1px"><?=fConvertDateShort($mRo['Tgl_Perolehan'])?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center; border-right:#999999 dotted 1px"><?php if ($mRo['Tgl_Mutasi']!="0000-00-00") {echo fConvertDateShort($mRo['Tgl_Mutasi']);}?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-right:2px; text-align:right"><?=fConvertToRupiah($mRo['Harga'])?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-right:2px; text-align:right <?=$ClR?>"><?=fConvertToRupiah($gNIL)?></td>
              <td style="border-bottom: #999999 dotted 1px" align="center">
			  <a href="#" class="ico prev" onclick="P_Tabel('850','450','<?=$mRo['Referensi']?>','<?=substr($mRo['Kd_UPB'],0,11)?>','<?=$_GET['IdL']?>'); return false">Ms. MANFAAT</a>
			  <?php if ($eMuT==""){?>
			  <a href="#" class="ico edit" onclick="EditData('1020','550','<?=$KdA?>','<?=$mRo['IDT']?>'); return false">EDIT</a>&nbsp;&nbsp;|&nbsp;
			  <a href="#" class="ico <?=$del?>" onclick="P_DeleteR('<?=$CeK?>','<?=$ThN?>','<?=$KiB?>','<?=$mRo['IDT']?>','<?=$RegGrp?>','<?=$ReO?>'); return false">DELETE</a>
			  <?php } ?>
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
              <td>&nbsp;</td>
            </tr>
            <?php
		}
		?>
          </table>
          <!-- Pagging -->
          <?php
			$nSQL= "SELECT COUNT(*) AS JmlRc FROM ta_kib_g".$tMuTZ." WHERE Kd_UPB LIKE '".$zUpb."' AND Kd_Aset LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy;
			$fUlrR= "FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&gFin=".$gFin."&gUnt=".$zUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gBid=".$gBid."&gKel=".$gKel."&gOBJ=".$gOBJ."&gRin=".$gRin."&";
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
	
	function P_DeleteR(KeY,ThN,KiB,xA,xB,xR,xD)
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
						$URL_Top = "Form_Asset_G_Top.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
						$URL_Mid = "Form_Asset_G_Mid.php?gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&gBid=".$zBid."&gKel=".$zKel."&gOBJ=".$zOBJ."&gRin=".$zRin."&IdL=".$_GET['IdL'];
						$URL_Bot = "Form_Asset_G_Bot.php";
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

	function EditData(w,h,KdA,IDT)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		var rTM = "";
		//var iB;	
		var Kd8 = KdA.substr(0,5);
		var Kd2 = KdA.substr(6,2);
		//alert(Kd2); return false;
		var iB = parseInt(Kd2);
		
		if (Kd8=="07.21")
		{
			if (iB>=1 && iB<=13)
			{
				rTM = "A";
			}
			else if (iB>=14 && iB<=48)
			{
				rTM = "B";
			}
			else if (iB>=49 && iB<=59)
			{
				rTM = "C";
			}
			else if (iB>=60 && iB<=83)
			{
				rTM = "D";
				//alert(''); return false;
			}
			else if (iB>=84 && iB<=91)
			{
				rTM = "E";
				//alert(''); return false;
			}
		}
		else
		{
			//alert(''); return false;
			rTM = "";
		}
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = "Form_Asset_G"+rTM+"_Top.php?"+"<?="FrmG=".$_GET['FrmG']?>";
			URL_Mid = "Form_Asset_G"+rTM+"_Mid.php?rIDT="+IDT+"<?="&IdL=".$_GET['IdL']?>";
			URL_Bot = "Form_Asset_G"+rTM+"_Bot.php";
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
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
		
		var AN = confirm("Import data..?!!");
		if (AN)
		{
			$.ajax({
				url:"KIB-G_Import_.php", 
				data: 
				{
					fUnt:fUnt,fSub:fSub,fUpb:fUpb
				},
				type:"get",
				beforeSend:function()
				{
					//alert('Silahkan tunggu, akan memproses import data...!!');
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
		}
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
	gFin = objfrm.fFind.value;
	
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	TopPosition=(screen.height)?(screen.height-h)/2:100;
	URL= 'KIB_G_Dokumen.php?CriT=BPK&gUnt='+gUnt+'&gSub='+gSub+'&gUpb='+gUpb+'&gBid='+gBid+'&gKel='+gKel+'&gOBJ='+gOBJ+'&gRin='+gRin+'&gFin='+gFin+'&gThn='+gThn+'&IdL='+IdL;
	settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
	window.open(URL,'',settings);
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

</script>            

<?php
function PostingFromPOSTMUTASI($RfA,$RfU,$RfT,$mUPB,$ReG,$mRoH,$UID,$DatabaseSB,$ConSB)
{
	if ($RfT!="" && $RfU!="" && $mUPB!=""){
		#$SQD = "delete FROM ta_kib_post WHERE Referensi='".$RfT."' AND Ref_Usulan='".$RfU."' AND Kd_UPB LIKE '".substr($mUPB,0,11)."%'";
		#$RsD = mysql_query($SQD);
	}
	
	$SQM = "SELECT * FROM ta_kib_post_mutasi WHERE Referensi='".$RfA."' AND Ref_Usulan='".$RfU."' AND Kd_UPB_To LIKE '".substr($mUPB,0,11)."%' ORDER BY IndexData";
	#echo $SQM."<br>";
	$RsM = mysql_query($SQM);
	while ($mRoM = mysql_fetch_array($RsM, MYSQL_BOTH))
	{
		$mHrG = $mRoM['Debet'];
		if ($mHrG==0){
			$mHrG=$mRoH;
		}
		$SQG="INSERT INTO ta_kib_post SET
		Referensi='".$RfT."',
		Ref_Group='".$mRo['Ref_Group']."',
		Ref_Mutasi='".$RfA."',
		Ref_History='".$RfA."',
		Ref_Usulan='".$RfU."',
		Kd_UPB='".$mUPB."',
		Kd_Aset='".$mRoM['Kd_Aset']."',
		No_Register='".$ReG."',
		Crit='".$mRoM['Crit']."',
		Tanggal='".$mRoM['Tanggal']."',
		Tgl_Mutasi='".$mRoM['Tgl_Mutasi']."',
		Uraian='".$mRoM['Uraian']."',
		DK='".$mRoM['DK']."',
		Debet='".$mHrG."',
		Kredit='0',
		No_Pengadaan='".$mRoM['No_Pengadaan']."',
		Ref_Temp='".$mRoM['Ref_Temp']."',
		Keterangan='".mysql_real_escape_string($mRoM['Keterangan'])."',
		Tmbh_Ms_Manfaat='".$mRoM['Tmbh_Ms_Manfaat']."',
		HasilMerger='".$mRoM['HasilMerger']."',
		Mrg_Ref_History='".$mRoM['Mrg_Ref_History']."',
		Mrg_Crit_History='".$mRoM['Mrg_Crit_History']."',
		Mrg_Tmbh_Ms_Manfaat_History='".$mRoM['Mrg_Tmbh_Ms_Manfaat_History']."',
		IndexData='".$mRoM['IndexData']."',
		Recorded=now(),
		Pencatat='".$UID.":unexe'";
		$RsG = mysql_query($SQG);
	}
	
	#$gID = fGlobal("IDT","ta_kib_post_mutasi","Referensi:Kd_UPB_To",$mREF.":".$mUPB."%","=:LIKE","","");
	
}
function repairREFERENSI($kdRef,$kdUpb,$kdIdt,$fs)
{
	$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_g","IDT","%","LIKE","","");
	$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_g_mutasi","IDT","%","LIKE","","");
	$NewK = (int)substr($NewK,-11,11);
	$NewB = (int)substr($NewB,-11,11);
	if ($NewB > $NewK){$NewK = $NewB;}
	$NewK = $NewK + 1;
	$NewR = "KDL.".fMakeReferensi($NewK,11);
	
	$SD="UPDATE ta_kib_g SET referensi='".$NewR."' WHERE IDT='".$kdIdt."'";
	if ($fs) {echo $kdRef."=>".$SD."<br>";}
	$RsD = mysql_query($SD);
	
	$PosID = fGlobal("IDT","ta_kib_post","referensi:kd_upb",$kdRef.":".$kdUpb,"=:=","IDT LIMIT 0,1","");
	if ($PosID!=''){
		$SD="UPDATE ta_kib_post SET referensi='".$NewR."' WHERE IDT='".$PosID."'";
		if ($fs) {echo $kdRef."=>".$SD."<br>";}
		$RsD = mysql_query($SD);
	}
}
?>