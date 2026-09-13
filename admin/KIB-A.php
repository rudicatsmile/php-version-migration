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
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
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
if (isset($_GET['gFin'])) {$gFin  = $_GET['gFin'];} else {$gFin  ="";}
if (isset($_GET['eMuT'])) {$eMuT  = $_GET['eMuT'];} else {$eMuT  ="";}

#if (isset($_GET['gExt'])) {$gExt  = $_GET['gExt'];} else {$gExt  ="N";}
$gExt="N";

$gFin = addslashes($gFin);
if ($gFin!="" )
{
	$gBid  = "All";
	$gKel  = "All";
	$gOBJ  = "All";
	$gRin  = "All";
}
if ($gThn=="" || $gThn=="All") {$gThn="____";}

$rKib = "01.__";
$gRf = "TNH";
?>

<?php require "FileMenu.php";?>
<body>
<form name="myfrm" method="post" action="<?php echo "KIB-A_.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'] ?>">
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
      <td width="83">UNIT</td>
      <td width="500"> 
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
      <td width="115">OBJEK</td>
      <td> <select class="boxs" name="fBid" tabindex="0" style="width: 480px" onchange="P_Change()">
          <option value=""></option>
          <option <?php if ($gBid=="All") {echo "selected";} ?> value="All">All</option>
          <?php
		#$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset2 WHERE Kd_Aset LIKE '01.__' ORDER BY Kd_Aset";
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '1.3.1.__' ORDER BY Kd_Aset";
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
      <td width="83">SUB UNIT</td>
      <td width="500"> 
        <select class="boxs" name="fSub" id="fSub" tabindex="0" style="width: 470px" onchange="this.form.submit()">
          <?php
		if ($Lev <=2 ) 
		{
			echo "<option value='All'>All</option>";
			$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".__' ORDER BY Kd_Sub";
		}
		else 
		{
			$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".".substr($SkP,12,2)."' ORDER BY Kd_Sub";
		}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gSub=="") {$gSub=$mRo['Kd_Sub'];}
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
      <td width="115">RINCIAN OBJEK </td>
      <td> <select class="boxs" name="fKel" tabindex="0" style="width: 480px" onchange="this.form.submit()">
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
      <td width="83">UPB</td>
      <td width="500">
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
        </select> </td>
      <td width="115">SUB ROBJ</td>
      <td> <select class="boxs" name="fOBJ" tabindex="0" style="width: 480px" onchange="this.form.submit()">
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
      <td align="right"><input type="button" name="B37" disabled value="EXPORT DATA" onclick="P_ToExcel('800','400','center','ToExcel/KIB_A_ToExcel')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td>TAHUN</td>
      <td valign="middle"> <table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
          <tr> 
            <td width="19%"> <select class="boxs" name="fThn" style="width: 60px" tabindex="0" onchange="this.form.submit()">
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
            <td width="9%">FIND</td>
            <td width="36%"> <input class="text" type="text" name="fFind" id="fFind" placeholder='Search' value="<?=$gFin?>" style="font-family: Calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986; width:200px" /></td>
            <td width="2%">&nbsp;</td>
            <td width="12%"> <input type="button" name="B39" value="GO" onclick="P_Find()" style="width: 50px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
            <td width="22%">
            <?php if ($Lev=="0" || $Lev=="100") {?>
			<input type="hidden" name="B392" value="Import" disabled onclick="P_Import(); return false;" style="width: 55px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
			<?php } ?>			</td>
          </tr>
        </table></td>
      <td>SUB-SUB ROBJ</td>
      <td width="481"> 
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
        </select> </td>
      <td width="5">&nbsp;</td>
      <td width="100" align="right"> 
        <input type="button" name="B38" value="CARI REKENING" onclick="OpenAccNumb('600','500','center')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><div id="loadingImg" style="width:40px;height:10px;display:none"><img src="Images/loading3.gif" alt="" width="40" height="40"></div></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><label style="float:right; color:#FF0000"><input type="checkbox" name="fSdhMutasi" <?php if ($eMuT!="") {echo "checked";}?> onclick="P_Find()" value="ON" />Sudah Mutasi</label></td>
    </tr>
  </table>
  <table border="0" align="center" id="tbViewData" style="width:99%">
    <tr> 
      <td><div id="ViewDATA" style="height:30px; width:500px; overflow:auto; display:none"></div></td>
    </tr>
  </table>
    <table align="center" border="0" class="table-list" cellspacing="0" cellpadding="0" style="width:99%">
      <tr> 
        <th width="26" class="ac">No</th>
        <th width="105" class="ac">REFERENSI</th>
        <th width="51" class="ac">Register</th>
        <th width="246" class="ac">Nama Barang</th>
        <th width="228" class="ac">Lokasi</th>
        <th width="62" class="ac">Perolehan</th>
        <th width="85" class="ac">Tgl.Mutasi</th>
        <th width="125" class="ac">Nilai Perolehan </th>
        <th width="125" class="ac">Nilai Akhir </th>
        <th width="255" class="ac">Actions</th>
      </tr>
      <?php
		if ($eMuT!=""){
			$tMuTZ="_mutasi";
		}
		else{
			$tMuTZ="";
		}
		
		if ($gUpb=="All") {$zUpb = $zSub.".%";}
		if ($gExt=="All") {$zExt = "%";} else {$zExt=$gExt;}
		if ($gSub=="All") {$zUpb = $zUnt.".%.%";}
	  
		if ($gThn=="All")
			{$rThn="____";}
		else
			{$rThn=$gThn;}
		
		$ALLK = "NO";
		if ($gBid=="All")
		{
			$rBid="_._._.__";
			$rKel="__";
			$rOBJ="__";
			$rRin="___";
			$ALLK = "YA";
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
		{
			$fFindSy = "AND (Nm_Aset LIKE '%".$gFin."%' OR No_Register LIKE '%".$gFin."%' OR Harga = '".$gFin."' OR Referensi LIKE '%".$gFin."%' OR Kd_Aset_108 LIKE '%".$gFin."%' OR Keterangan LIKE '%".$gFin."%')";
		}
		else
		{$fFindSy = "";}
		
		if ($ALLK == "YA"){
			$nSQL= "SELECT * FROM ta_kib_108".$tMuTZ." WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$zExt."' AND Kd_UPB LIKE '".$zUpb."' AND Kd_Aset_108 LIKE '%' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy." ORDER BY Tgl_Perolehan, No_Register LIMIT $Offset, $DataPerPage";
		}
		else{
			$nSQL= "SELECT * FROM ta_kib_108".$tMuTZ." WHERE referensi LIKE '$gRf%' AND extracom LIKE '".$zExt."' AND Kd_UPB LIKE '".$zUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy." ORDER BY Tgl_Perolehan, No_Register LIMIT $Offset, $DataPerPage";
		}

		$nSQLForMAP = str_replace("'", "^",$nSQL);
		echo "
			<div align='right'>
				<input type='button' name='B36A' value='Lokasi Pada Peta' onclick='OpenAccMAP()'  
					style='color:#0000FF; width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; 
					padding-bottom: 0px' />&nbsp;&nbsp;&nbsp;
			</div>	";


		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
			if ((substr((int)$mRo['Tgl_Perolehan'],0,4)>=2022) && $mRo['No_Pengadaan']==""){
				$TtK="";//<div style='color:#ff0000; float:right'>**&nbsp;</div>";
			}
			else{
				$TtK="";
			}
			
			if ($mRo['Ref_Group']!="")
				{$RegGrp=$mRo['Ref_Group'];}
			else
				{$RegGrp="";}
			
			$gCEU = fGlobal("IDT","ta_usulan_rinci_108","Ref_Aset:Kd_UPB",$mRo['Referensi'].":".$mRo['Kd_UPB'],"=:=","","");
			if ($gCEU!="") {
				$gCEK = fGlobal("IDT","ta_usulan_verifikasi_rinci_108","Ref_Aset:Kd_UPB:Eksekusi",$mRo['Referensi'].":".$mRo['Kd_UPB'].":Sudah","=:=:=","","");
				if ($gCEK!='') {
					$Blnk="";
				}
				else {
					$Blnk="; background:#F1F8A0";
				}
			}
			else {
				$Blnk="";
			}
			
			$BV = "";
			if ($tMuTZ==""){
				$gCeU = $mRo['Ref_Mutasi'];
				if ($gCeU!=""){
					$SG = fGlobal("Kd_UPB","ta_kib_108_mutasi","Referensi_To:Kd_UPB_To",$mRo['Referensi'].":".substr($mRo['Kd_UPB'],0,11)."%","=:LIKE","","");
					$SG = "<i>".fGlobal("Nm_Unit","ref_unit","Kd_Unit",substr($SG,0,11),"=","","")."</i>";
					$BV="<font style='background:#000000; color:#fff'>Mutasi masuk dari ".$SG."<br>Ref : ".$mRo['Ref_Mutasi']."<br>Usulan : ".$mRo['Ref_Usulan']."</font><br>";
				}
			}
			
			$gHRG = $mRo['Harga'];
			$gNIa = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108".$tMuTZ,"Referensi:Kd_UPB",$mRo['Referensi'].":".substr($mRo['Kd_UPB'],0,11)."%","=:LIKE","","");
			$gNIb = 0;
			if ($gNIb != 0) {$gNIL = $gNIa - $gNIb;}
			else {$gNIL=$gNIa;}
			
			if ($gNIL==0 && $tMuTZ=="") {
				#$SQG="UPDATE ta_kib_108 set Post='N' WHERE IDT='".$mRo['IDT']."'";
				#$Rs = mysql_query($SQG);
			}
			
			if ($gHRG > $gNIL) {$ClR="; color: #FF0000";}
			else if ($gHRG < $gNIL) {$ClR="; color: #0000FF";}
			else {$ClR="";}
			
			$NmB=$mRo['Nm_Aset'];
			if ($NmB==""){
				#$NmB=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");
				$NmB=fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$mRo['Kd_Aset_108'],"=","","");
			}
			
			//Kunci Data
			$KiB = "A";
			$ThN = substr($mRo['Tgl_Perolehan'],0,4);
			$gSK = substr($mRo['Kd_UPB'],0,11);
			$CeK = CekKey($gSK,$ThN,'Kib_'.$KiB,'');
			if ($CeK=='Y') {$del="lock";} else {$del="del";}
			$NeN = fGlobal("count(*)","ta_kib_post_108".$tMuTZ,"Referensi:HasilMerger",$mRo['Referensi'].":Y","=:=","","");
			
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
			
			$KdPTA = $mRo['Ref_KdpToAset'];
			$RfPTA  = "";
			if ($KdPTA!=''){
				$RfPTA  = "<br>".$KdPTA;
			}
			?>
			<tr height="40" style="cursor: pointer <?=$Blnk?>" onmouseover="this.style.cursor=&#39;pointer&#39" <?=fBackCLR($iG)?>> 
				<td style="border-bottom: #999999 dotted 1px; text-align:center; border-right:#999999 dotted 1px; padding-left:2px" ><?php echo $iG?>.</td>
				<td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?php echo $mRo['Referensi'].$kdUPB.$RfPTA?></td>
				<td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><?php echo $mRo['No_Register']?></td>
				<td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-left:2px"><?php echo $NmB.$TtK?></td>
				<td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-left:2px"> <?=$BV.$mRo['Alamat']?></td>
				<td style="text-align:center; border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-left:2px"><?=substr($mRo['Tgl_Perolehan'],0,4)?></td>
				<td style="text-align:center; border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-left:2px"><?php if ($mRo['Tgl_Mutasi']!="0000-00-00"){echo fConvertDateShort($mRo['Tgl_Mutasi']);}?></td>
				<td style="border-bottom:#999999 dotted 1px; border-right:#999999 dotted 1px; padding-right:2px"  align="right"><?php echo fConvertToRupiah($mRo['Harga'])?></td>
				<td align="right" style="border-bottom:#999999 dotted 1px; border-right:#999999 dotted 1px; padding-right:2px <?=$ClR?>" <?php echo $ClR?>> <?=fConvertToRupiah($gNIL)?>        </td>
				<td style="border-bottom: #999999 dotted 1px" align="center">
				<a href="#" class="ico docu" onclick="P_OpenKibar('800','400','<?=$mRo['IDT']?>','<?=$_GET['IdL']?>'); return false">&nbsp;Kibar</a>
				<?php if ($eMuT==""){?>
				&nbsp;|&nbsp;&nbsp;<a href="#" class="ico edit" onclick="EditData('1020','550','center','<?=$mRo['IDT']?>'); return false">&nbsp;Edit</a>&nbsp;&nbsp;|&nbsp;
				<a href="#" class="ico merg" onclick="MergerData('<?=$ReO?>','<?=$NeN?>','<?=$CeK?>','<?=$ThN?>','<?=$KiB?>','950','525','center','<?=$mRo['IDT']?>','<?=$_GET['IdL']?>'); return false">&nbsp;Merger</a>&nbsp;&nbsp;
				<?php if ($Lev <= 1) {?>
					|&nbsp;<a href="#" class="ico <?=$del?>" onclick="P_DeleteR('<?=$NeN?>','<?=$CeK?>','<?=$ThN?>','<?=$KiB?>','<?=$mRo['IDT']?>','<?=$RegGrp?>','<?=$ReO?>'); return false">&nbsp;Delete</a>
				<?php } ?>
				<?php } ?>				</td>
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
			$nSQL= "SELECT COUNT(*) AS JmlRc FROM ta_kib_108".$tMuTZ." WHERE referensi LIKE '$gRf%' AND extracom LIKE '$zExt' AND Kd_UPB LIKE '".$zUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy;
			$fUlrR= "FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&gFin=".$gFin."&gUnt=".$zUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gBid=".$gBid."&gKel=".$gKel."&gOBJ=".$gOBJ."&gRin=".$gRin."&";
			include "FilePagingBot.php";
   		  ?>
        <!--/div-->
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

     function OpenAccMAP()
     	{	
     		var w = '850';
     		var h = '600';
     		var pos = 'center';
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
     			URL_Top = "UploadIMG_Top.php?FrmG=Lokasi Peta -> KIB A (ASET TANAH)";
     			URL_Mid = "FindMAP_Mid.php?"+"<?="rCRT=a&rIDT=".$rIDT."&nSQL=".$nSQLForMAP."&IdL=".$_GET['IdL']?>";
     			URL_Bot = "UploadIMG_Bot.php";
     			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindAcc_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFindAcc_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFindAcc_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
     			win.focus()
     			win.window.document.clear()
     			win.window.document.write(txtHTML)
     			win.window.document.close() 
     			win.setTimeout("self.close()",200000000)
     		}
     	}

	
	function P_DeleteR(NeN,KeY,ThN,KiB,xA,xB,xR)
	{
		if (NeN > 0) {alert('Access denied, data sudah memiliki nilai hasil merger, silahkan RESTORE atau KAPITALISASI lebih dulu..!!'); return false;}
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
						$URL_Top = "Form_Asset_A_Top.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
						$URL_Mid = "Form_Asset_A_Mid.php?gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&gBid=".$zBid."&gKel=".$zKel."&gOBJ=".$zOBJ."&gRin=".$zRin."&IdL=".$_GET['IdL'];
						$URL_Bot = "Form_Asset_A_Bot.php";
					?>       			
       			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFormKIB_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFormKIB_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"
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
						$URL_Mid = "Open_KIB_Mid.php?CrKIB=KIB_A&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_GET['IdL'];
						$URL_Bot = "Open_KIB_Bot.php";
					?>       			
       			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenKIB_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinOpenKIB_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinOpenKIB_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
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
						$URL_Top = "Find_Acc_Top.php?CrAcc=KIB-A&FrmG=".$_GET['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_GET['IdL'];
						$URL_Mid = "Find_Acc_Mid.php?CrAcc=KIB-A&FrmG=".$_GET['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_GET['IdL'];
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
			URL_Top = "Form_Asset_A_Top.php?"+"<?="FrmG=".$_GET['FrmG']?>";
			URL_Mid = "Form_Asset_A_Mid.php?rIDT="+IDT+"<?="&IdL=".$_GET['IdL']?>";
			URL_Bot = "Form_Asset_A_Bot.php";
			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>" 
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
		
		$.ajax({
			url:"KIB-A_Import_.php", 
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

	function MergerData(ReO,NeN,KeY,ThN,KiB,w,h,pos,IDT,IdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		if (NeN > 0) {alert('Access denied, data sudah memiliki nilai hasil merger, silahkan RESTORE atau KAPITALISASI lebih dulu..!!'); return false;}
		if (KeY=='Y') {alert('Access denied, data kib '+KiB+' tahun '+ThN+' sudah terkunci..!!'); return false;}
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
			URL_Top = "Merger_Top.php?"+"<?="FrmG=MERGER DATA ASET"?>";
			URL_Mid = "Merger_Mid.php?CrT=a&rIDT="+IDT+"&IdL="+IdL;
			URL_Bot = "Merger_Bot.php";
			txtHTML="<html><head><title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormMRG_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormMRG_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormMRG_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
	
	function P_OpenDoc(w,h,IdL)
	{
		gUnt = objfrm.fUnt.value;
		gSub = objfrm.fSub.value;
		gUpb = objfrm.fUpb.value;
		gExt = "N";
		
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
		URL= 'KIB_A_Dokumen.php?CriT=BPK&gUnt='+gUnt+'&gSub='+gSub+'&gUpb='+gUpb+'&gBid='+gBid+'&gKel='+gKel+'&gOBJ='+gOBJ+'&gRin='+gRin+'&gExt='+gExt+'&gFin='+gFin+'&gThn='+gThn+'&IdL='+IdL;
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
		URL= 'report/P47_Kibar_A.php?IdT='+IdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	$("#fFind").focus();
</script>
