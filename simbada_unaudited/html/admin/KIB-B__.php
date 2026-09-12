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
<?
if (isset($_GET['gUnt'])) {$gUnt  = $_GET['gUnt'];} else {$gUnt  ="";}
if (isset($_GET['gSub'])) {$gSub  = $_GET['gSub'];} else {$gSub  ="";}
if (isset($_GET['gUpb'])) {$gUpb  = $_GET['gUpb'];} else {$gUpb  ="";}
if (isset($_GET['gThn'])) {$gThn  = $_GET['gThn'];} else {$gThn  ="";}
if (isset($_GET['gBid'])) {$gBid  = $_GET['gBid'];} else {$gBid  ="";}
if (isset($_GET['gKel'])) {$gKel  = $_GET['gKel'];} else {$gKel  ="";}
if (isset($_GET['gOBJ'])) {$gOBJ  = $_GET['gOBJ'];} else {$gOBJ  ="";}
if (isset($_GET['gRin'])) {$gRin  = $_GET['gRin'];} else {$gRin  ="";}
if (isset($_GET['gFin'])) {$gFin  = $_GET['gFin'];} else {$gFin  ="";}

if (isset($_GET['gExt'])) {$gExt  = $_GET['gExt'];} else {$gExt  ="N";}

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
<form name="myfrm" method="post" action="<?php echo "KIB-B_.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'] ?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CritIDT" size="10">
  <table border="0" align="center" style="width:99%">
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
        </select> </td>
      <td width="94">OBJEK</td>
      <td> <select class="boxs" name="fBid" tabindex="0" style="width: 480px" onchange="P_Change()">
          <option value=""></option>
          <option <? if ($gBid=="All") {echo "selected";} ?> value="All">All</option>
          <?
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
      <td>&nbsp;</td>
      <td align="right"><input type="button" name="B35" value="INPUT DATA" onclick="InputData('950','520','center')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td width="92">SUB UNIT</td>
      <td width="519"> 
        <select class="boxs" name="fSub" tabindex="0" style="width: 470px" onchange="this.form.submit()">
          <?
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
      <td width="94">RINCIAN OBJ </td>
      <td> <select class="boxs" name="fKel" tabindex="0" style="width: 480px" onchange="this.form.submit()">
          <option <? if ($gKel=="All") {echo "selected";} ?> value="All">All</option>
          <?
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
      <td align="right"><input type="button" name="B36" value="DOKUMEN KIB" onclick="OpenKIB('650','350','center')"  style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td width="92">UPB</td>
      <td width="519"> 
        <select class="boxs" name="fUpb" tabindex="0" style="width: 470px" onchange="this.form.submit()">
		<option value="All">All</option>
          <?
		$nSQ = "SELECT Kd_UPB, Nm_UPB FROM ref_upb WHERE Kd_UPB LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_UPB";
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
				if ($mRo['Kd_UPB']==$gUpb) 
				{
					$sel ="selected";
					$zUpb=$mRo['Kd_UPB'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_UPB'].'">'.$mRo['Kd_UPB']." : ".$mRo['Nm_UPB'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
      <td width="94">SUB ROBJ </td>
      <td> <select class="boxs" name="fOBJ" tabindex="0" style="width: 480px" onchange="this.form.submit()">
          <option <? if ($gOBJ=="All") {echo "selected";} ?> value="All">All</option>
          <?
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
      <td align="right"><input type="button" name="B37" disabled value="EXPORT DATA" onclick="P_ToExcel('800','400','center','ToExcel/KIB_B_ToExcel')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td>TAHUN</td>
      <td valign="middle"> <table border="0" width="100%" cellpadding="0" style="border-collapse: collapse">
          <tr> 
            <td width="24%"> <select class="boxs" name="fThn" style="width: 60px" tabindex="0" onchange="this.form.submit()">
                <option <? if ($gThn=="All") {echo "selected";} ?> value="All">All</option>
                <?
			for($nThn=1900; $nThn<=2030; $nThn++)
			{
			$sel ="";
			if ($gThn==$nThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
              </select> </td>
            <td width="8%">CARI</td>
            <td width="34%"> <input class="text" type="text" name="fFind" value="<? echo $gFin?>" style="font-family: Calibri; font-size: 10pt; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" /></td>
            <td width="2%">&nbsp;</td>
            <td width="25%"> <input type="button" name="B39" value="GO" onclick="P_Find()" style="width: 50px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
            <td width="7%">&nbsp;</td>
          </tr>
        </table></td>
      <td>SUB SUB ROBJ </td>
      <td width="496"> 
        <select class="boxs" name="fRin" tabindex="0" style="width: 480px" onchange="this.form.submit()">
          <option <? if ($gRin=="All") {echo "selected";} ?> value="All">All</option>
          <?
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
        <input type="button" name="B38" value="CARI REKENING" onclick="OpenAccNumb('600','500','center')" style="width: 90px; height: 24px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>ASET / EXTRACOM</td>
      <td>
	  <select class="boxs" name="fExt" style="width: 120px" tabindex="0" onchange="this.form.submit()">
        <option <? if ($gExt=="All") {echo "selected";} ?> value="All">ALL</option>
        <option <? if ($gExt=="N") {echo "selected";} ?> value="N">A S E T</option>
        <option <? if ($gExt=="Y") {echo "selected";} ?> value="Y">EXTRACOMP</option>
      </select>
	  </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
	
        <!-- Content -->
        <!-- Table -->
        <!--div class="table"--> 
	  <table align="center" border="0" class="table-list" cellspacing="0" cellpadding="0" style="width:99%">
		<tr> 
        <th width="30" style="text-align:center">No</th>
        <th width="84" style="text-align:center">Kode</th>
        <th width="60" style="text-align:center">Register</th>
        <th style="padding-left:2px">Nama Barang</th>
        <th width="140" style="padding-left:2px">Merk</th>
        <th align="left">Uraian</th>
        <th width="78" style="text-align:center">Perolehan</th>
        <th width="100" class="ar">Nilai Perolehan </th>
        <th width="100" class="ar">Nilai Akhir </th>
        <th width="80" class="ac">Penyusutan</th>
        <th width="200" class="ac">Actions</th>
		</tr>
		<?
		if ($gUpb=="All") {$zUpb = $zSub.".%";}
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
		{
			$fFindSy = "AND (Harga LIKE '%".$gFin."%' OR Referensi LIKE '%".$gFin."%' OR Nomor_Polisi LIKE '%".$gFin."%' OR Nomor_Rangka LIKE '%".$gFin."%' OR Nomor_BPKB LIKE '%".$gFin."%' OR Nomor_Mesin LIKE '%".$gFin."%' OR Kd_Aset_108 LIKE '%".$gFin."%' OR Keterangan LIKE '%".$gFin."%' OR Merk LIKE '%".$gFin."%')";
		}
		else
		{
			$fFindSy = "";
		}
		
		$nSQL= "SELECT * FROM ta_kib_b WHERE extracom LIKE '".$zExt."' AND Kd_UPB LIKE '".$zUpb."' AND Kd_Aset_108 LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy." ORDER BY Kd_Aset_108, No_Register LIMIT $Offset, $DataPerPage";
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
			
			if ($gNIL==0) {
				$SQG="UPDATE ta_kib_b set Post='N' WHERE IDT='".$mRo['IDT']."'";
				$Rs = mysql_query($SQG);
			}
			
			if ($gHRG > $gNIL) {$ClR="style='color: #FF0000'";}
			else if ($gHRG < $gNIL) {$ClR="style='color: #0000FF'";}
			else {$ClR="";}
			
			#$NmB=fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","");
			$NmB=fGlobal("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$mRo['Kd_Aset_108'],"=","","");
			
			//Kunci Data
			$KiB = "B";
			$ThN = substr($mRo['Tgl_Perolehan'],0,4);
			$gSK = substr($mRo['Kd_UPB'],0,11);
			$CeK = CekKey($gSK,$ThN,'Kib_'.$KiB,'');
			if ($CeK=='Y') {$del="lock";} else {$del="del";}
			//
			?>
			<tr height="23" style="cursor: pointer" onmouseover="this.style.cursor=&#39;pointer&#39" <?=fBackCLR($iG)?>> 
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center"><? echo $iG?>.</td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center" onclick="$(&#39;#detail<? echo $iG?>&#39;).toggle(&#39;past&#39;)"><? echo $mRo['Kd_Aset_108']?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center" onclick="$(&#39;#detail<? echo $iG?>&#39;).toggle(&#39;past&#39;)"><? echo $mRo['No_Register']?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-left:2px" onclick="$(&#39;#detail<? echo $iG?>&#39;).toggle(&#39;past&#39;)"><? echo $NmB ?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-left:2px" onclick="$(&#39;#detail<? echo $iG?>&#39;).toggle(&#39;past&#39;)"><? echo $mRo['Merk']?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-left:2px; padding-right:2px" onclick="$(&#39;#detail<? echo $iG?>&#39;).toggle(&#39;past&#39;)"> <?=$mRo['Keterangan']?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; text-align:center" onclick="$(&#39;#detail<? echo $iG?>&#39;).toggle(&#39;past&#39;)"> <?=fConvertDateShort($mRo['Tgl_Perolehan'])?></td>
              <td style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-right:2px" align="right" onclick="$(&#39;#detail<? echo $iG?>&#39;).toggle(&#39;past&#39;)"><? echo fConvertToRupiah($mRo['Harga'])?></td>
              <td align="right" style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px; padding-right:2px" onclick="$(&#39;#detail<? echo $iG?>&#39;).toggle(&#39;past&#39;)" <? echo $ClR?>><? echo fConvertToRupiah($gNIL)?></td>
              <td align="center" style="border-bottom: #999999 dotted 1px; border-right:#999999 dotted 1px">
			  <a href="#" class="ico deta" onclick="OpenHARI('650','350','<?=$mRo['Referensi']?>','<?=$gSK?>','<?=$_GET['IdL']?>'); return false">s.d Tggal</a>			  </td>
              <td style="border-bottom: #999999 dotted 1px" align="center">
			  <a href="#" class="ico prev" onclick="P_Tabel('850','450','<?=$mRo['Referensi']?>','<?=$_GET['IdL']?>'); return false">Ms. Manfaat</a>&nbsp;&nbsp;&nbsp;
			  <a href="#" class="ico <?=$del?>" onclick="P_DeleteR('<?=$CeK?>','<?=$ThN?>','<?=$KiB?>','<?=$mRo['IDT']?>','<?=$RegGrp?>','<?=$ReO?>'); return false">&nbsp;Delete</a>&nbsp;&nbsp
			  <a href="#" class="ico edit" onclick="EditData('950','520','center','<?=$mRo['IDT']?>'); return false">Edit</a>			  </td>
            </tr>
      	<!--tr> 
        <td colspan="11">
		<table id="detail<? echo $iG?>" cellpadding="3" border="0" width="900" style="border:1px solid #C0C0C0; font-family: Calibri; font-size: 9pt; font-style: Italic; color: #800000; display: none; border-collapse:collapse">
            <tr> 
              <td width="20">&nbsp;</td>
              <td width="30">Kelompok</td>
              <td width="10">:</td>
              <td width="200"> 
                <? echo fGlobal("Nm_Aset","Ref_Rek_Aset2","Kd_Aset",substr($mRo['Kd_Aset'],0,5),"=","","")?>              xxxxxx</td>
              <td width="10">&nbsp;</td>
              <td width="40">Merk</td>
              <td width="9">:</td>
              <td width="100">
                <? echo $mRo['Merk']?>              </td>
              <td width="4">&nbsp;</td>
              <td width="60">Nomor Mesin</td>
              <td width="9">:</td>
              <td width="200">
                <? echo $mRo['Nomor_Mesin']?>              </td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td>Jenis</td>
              <td>:</td>
              <td> 
                <? echo fGlobal("Nm_Aset","Ref_Rek_Aset3","Kd_Aset",substr($mRo['Kd_Aset'],0,8),"=","","")?>              </td>
              <td>&nbsp;</td>
              <td>Type</td>
              <td>:</td>
              <td>
                <? echo $mRo['Type']?>              </td>
              <td>&nbsp;</td>
              <td>Nomor Rangka</td>
              <td>:</td>
              <td>
                <? echo $mRo['Nomor_Rangka']?>              </td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td>Objek</td>
              <td>:</td>
              <td> 
                <? echo fGlobal("Nm_Aset","Ref_Rek_Aset4","Kd_Aset",substr($mRo['Kd_Aset'],0,11),"=","","")?>              </td>
              <td>&nbsp;</td>
              <td>Ukuran/CC</td>
              <td>:</td>
              <td>
                <? echo $mRo['Ukuran_CC']?>              </td>
              <td>&nbsp;</td>
              <td>Nomor Polisi</td>
              <td>:</td>
              <td valign="top">
                <? echo $mRo['Nomor_Polisi']?>              </td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td>Rincian</td>
              <td>:</td>
              <td> 
                <? echo fGlobal("Nm_Aset","Ref_Rek_Aset5","Kd_Aset",substr($mRo['Kd_Aset'],0,15),"=","","")?></td>
              <td>&nbsp;</td>
              <td>Kepemilikan</td>
              <td>:</td>
              <td><? echo fGlobal("Nm_Pemilik","Ref_Pemilik","Kd_Pemilik",substr($mRo['Kd_Pemilik'],0,11),"=","","")?></td>
              <td>&nbsp;</td>
              <td>Referensi</td>
              <td>:</td>
              <td valign="top">
                <? echo $mRo['Referensi']?>              </td>
            </tr>
        </table>		</td>
      </tr-->            
	  <?
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
              <td colspan="2">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <?
		}
		?>
          </table>
          <!-- Pagging -->
          <?
			$nSQL= "SELECT COUNT(*) AS JmlRc FROM ta_kib_b WHERE extracom LIKE '$zExt' AND Kd_UPB LIKE '".$zUpb."' AND Kd_Aset LIKE '".$rBid.".".$rKel.".".$rOBJ.".".$rRin."' AND Tgl_Perolehan LIKE '".$rThn."-__-__' ".$fFindSy;
			$fUlrR= "FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&gExt=".$gExt."&gFin=".$gFin."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$gUpb."&gThn=".$gThn."&gBid=".$gBid."&gKel=".$gKel."&gOBJ=".$gOBJ."&gRin=".$gRin."&";
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
					<?
						$URL_Top = "Form_Asset_B_Top.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
						$URL_Mid = "Form_Asset_B_Mid.php?gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&gBid=".$zBid."&gKel=".$zKel."&gOBJ=".$zOBJ."&gRin=".$zRin."&IdL=".$_GET['IdL'];
						$URL_Bot = "Form_Asset_B_Bot.php";
					?>       			
       			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='<? echo $URL_Top?>' scrolling='no'><frame name='WinFormKIB_Mid' src='<? echo $URL_Mid?>' scrolling='auto'><frame name='WinFormKIB_Bot' src= '<? echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
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
					<?
						$URL_Top = "Open_KIB_Top.php";
						$URL_Mid = "Open_KIB_Mid.php?CrKIB=KIB_B&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_GET['IdL'];
						$URL_Bot = "Open_KIB_Bot.php";
					?>       			
       			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinOpenKIB_Top' noresize src='<? echo $URL_Top?>' scrolling='no'><frame name='WinOpenKIB_Mid' src='<? echo $URL_Mid?>' scrolling='auto'><frame name='WinOpenKIB_Bot' src= '<? echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
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
					<?
						$URL_Top = "Find_Acc_Top.php?CrAcc=KIB-B&FrmG=".$_GET['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_GET['IdL'];
						$URL_Mid = "Find_Acc_Mid.php?CrAcc=KIB-B&FrmG=".$_GET['FrmG']."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&IdL=".$_GET['IdL'];
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
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}

	function P_Tabel(w,h,ref,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		//window.open('Tabel_Masa_Manfaat.php?ref='+ref+'&IdL='+IdL,'',settings);
		window.open('Tabel_Masa_Manfaat_Choise.php?ref='+ref+'&IdL='+IdL,'',settings);
	}
	
	function OpenHARI(w,h,Ref,Unt,IdL)
	{	var win=null;
		var txtHTML = "";
  		var iErrors=0;
		gUnt = 
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = "Open_KKM_Top.php";
			URL_Mid = "Open_KKM_Mid_sdTgl.php?gAst=02&Ref="+Ref+"&gUnt="+Unt+"&IdL="+IdL;
			URL_Bot = "Open_KKM_Bot.php";
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFindData_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFindData_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFindData_Bot' src='"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"            
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
</script>

<?php require('Connection_Close.php');?>
