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
<?php if ($_POST['Simpan']=="RekapMutasi") {?>
	<?php require "File_Rekap_Mutasi.php"?>
	<script LANGUAGE="JavaScript">            
	window.alert("Proses rekap selesai..!!");
	</script>
<?php } ?>

<?php if ($_POST['Simpan']=="Close") {?>
	<script LANGUAGE="JavaScript">            
	this.setTimeout("self.close()",0)
	</script>
<?php } ?>

<?php
$gHri  = fGetDate('mday');
$gBln  = fGetDate('mon');
$gThn  = fGetDate('year');

$gThD = fGetDate('year')+1;

$rCrt = $_GET['rCrt'];
#echo $rCrt;

$gDoc = $_POST['fDoc'];
if ($gDoc=="") {$gDoc="5";}
if ($gDoc=="5")
{
	$List1 ="";
	$List2 ="";
	$List3 ="";
	$List4 ="";
	$List5 ="checked";
} 
else if ($gDoc=="4")
{
	$List1 ="";
	$List2 ="";
	$List3 ="";
	$List4 ="checked";
	$List5 ="";
} 
else if ($gDoc=="3")
{
	$List1 ="";
	$List2 ="";
	$List3 ="checked";
	$List4 ="";
	$List5 ="";
} 
else if ($gDoc=="2")
{
	$List1 ="";
	$List2 ="checked";
	$List3 ="";
	$List4 ="";
	$List5 ="";
} 
else
{
	$List1 ="checked";
	$List2 ="";
	$List3 ="";
	$List4 ="";
	$List5 ="";
} 

$gDoK = $_POST['fDoK'];
if ($gDoK=="") {$gDoK="2";}
if ($gDoK=="1"){
	$LisK1 ="checked";
	$LisK2 ="";
} 
else{
	$LisK1 ="";
	$LisK2 ="checked";
}	
switch ($rCrt)
{
	case 1:
		$nFile="Lap_Buku_Inventaris";
		break;
	case 2:
		$nFile="Lap_Buku_Inventaris_Rekap";
		break;
	case 3:
		$nFile="Lap_Daftar_Mutasi_Masuk";
		break;
	case 6:
		$nFile="Lap_Daftar_Mutasi_Keluar";
		break;
	case 4:
		$nFile="Lap_Daftar_Mutasi_Rekap";
		break;
	case 5:
		$nFile="Lap_Rekap_Per_Rekening";
		break;
}
	
if (isset($_GET['gUpb']))
{
	$gUnt  = $_GET['gUnt'];
	$gSub  = $_GET['gSub'];
	$gUpb  = $_GET['gUpb'];
}
else
{
	$gUnt  = $_POST['fUnt'];
	$gSub  = $_POST['fSub'];
	$gUpb  = $_POST['fUpb'];
}
$gMLK = $_POST['fMilik'];
if ($gMLK==''){$gMLK="12";}
$gThn = $_POST['fThn'];
$gThn2= $_POST['fThn2'];
$gJNS = $_POST['fJenis'];
$gAst = $_POST['fAst'];
#echo $gJNS;
if ($gThn =="") {$gThn  = fGetDate('year')-1;}
if ($gThn2=="") {$gThn2 = fGetDate('year')-1;}
?>

<body>
<form name="myfrm" method="post" action="<?php echo "Open_Report_Mid.php?rCrt=".$rCrt."&IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Simpan">
  <table border="0" align="center" style="width:650px;">
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td width="102" align="right">UNIT KERJA</td>
      <td width="24">&nbsp;</td>
      <td width="510"> 
        <select name="fUnt" tabindex="0" style="width:480px" onchange="this.form.submit()">
        <?php
		if ($Lev <=1 ) {
			$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
			if ($rCrt<=1) {echo "<option value='All'>All</option>";}
			
		}
		else{
			$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit WHERE Kd_Unit = '".substr($SkP,0,11)."' ORDER BY Kd_Unit";
		}
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
				$gUnt=$mRo['Kd_Unit'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Unit'].'">'.$mRo['Kd_Unit']." : ".$mRo['Nm_Unit'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select> </td>
    </tr>
    <tr> 
      <td align="right">SUB UNIT</td>
      <td>&nbsp;</td>
      <td width="510"> 
        <select class="boxs" name="fSub" tabindex="0" style="width:480px" onchange="this.form.submit()">
        <?php
		if ($Lev <=3 ) {
			if ($rCrt<=6) {echo "<option value='All'>All</option>";}
			$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".__' ORDER BY Kd_Sub";
		}
		else {
			$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".".substr($SkP,12,2)."' ORDER BY Kd_Sub";
		}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gSub=="") {$gSub=$mRo['Kd_Sub'];}
			if ($_GET['gUnt']!="All")
			{
				//if (substr($gSub,0,11)!=$gUnt) {$gSub=$mRo['Kd_Sub'];}
			}
			do
			{
				$sel ="";
				if ($mRo['Kd_Sub']==$gSub) 
				{
					$sel ="selected";
					$gSub=$mRo['Kd_Sub'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Sub'].'">'.$mRo['Kd_Sub']." : ".$mRo['Nm_Sub'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select> </td>
    </tr>
    <tr> 
      <td align="right">UPB</td>
      <td>&nbsp;</td>
      <td width="510"> 
        <select class="boxs" name="fUpb" tabindex="0" style="width:480px" onchange="this.form.submit()">
        <?php
		#if ($rCrt<=6) {echo "<option value='All'>All</option>";}
		#$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_Upb";
		
		if ($Lev <=3 ) {
			if ($rCrt<=6) {echo "<option value='All'>All</option>";}
			$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' ORDER BY Kd_Upb";
		}
		else {
			$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".".substr($SkP,-3,3)."' ORDER BY Kd_Upb";
			}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gUpb=="") {$gUpb = $mRo['Kd_Upb'];}
			if ($_GET['gSub']!="All")
			{
				//if (substr($gUpb,0,14)!=$gSub) {$gUpb = $mRo['Kd_Upb'];}
			}
			do
			{
				$sel ="";
				if ($mRo['Kd_Upb']==$gUpb) 
				{
				$sel ="selected";
				$gUpb=$mRo['Kd_Upb'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Upb'].'">'.$mRo['Kd_Upb']." : ".$mRo['Nm_Upb'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select> </td>
    </tr>
	<?php if ($rCrt==3 || $rCrt==6){?>
    <tr> 
      <td align="right">K I B</td>
      <td>&nbsp;</td>
      <td valign="middle">
	  <select class="boxs" name="fAst" id="fAst" style="width:300px" tabindex="0">
	  <option value="ALL">ALL KIB</option>
	  <option value="1.3.1" <?php if ($gAst=="1.3.1") {echo "selected";}?>>KIB-A (1.3.1 - <?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset","1.3.1","=","",DatabaseSB,$ConSB,""))?> )</option>
	  <option value="1.3.2" <?php if ($gAst=="1.3.2") {echo "selected";}?>>KIB-B (1.3.2 - <?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset","1.3.2","=","",DatabaseSB,$ConSB,""))?> )</option>
	  <option value="1.3.3" <?php if ($gAst=="1.3.3") {echo "selected";}?>>KIB-C (1.3.3 - <?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset","1.3.3","=","",DatabaseSB,$ConSB,""))?> )</option>
	  <option value="1.3.4" <?php if ($gAst=="1.3.4") {echo "selected";}?>>KIB-D (1.3.4 - <?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset","1.3.4","=","",DatabaseSB,$ConSB,""))?> )</option>
	  <option value="1.3.5" <?php if ($gAst=="1.3.5") {echo "selected";}?>>KIB-G (1.3.5 - <?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset","1.3.5","=","",DatabaseSB,$ConSB,""))?> )</option>
	  <option value="1.5.3" <?php if ($gAst=="1.5.3") {echo "selected";}?>>KIB-J (1.5.3 - <?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset","1.5.3","=","",DatabaseSB,$ConSB,""))?> )</option>
	  <option value="1.5.4" <?php if ($gAst=="1.5.4") {echo "selected";}?>>KIB-J (1.5.4 - <?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset","1.5.4","=","",DatabaseSB,$ConSB,""))?> )</option>
      </select>
      </td>
    </tr>
    <tr> 
      <td align="right">JENIS MUTASI</td>
      <td>&nbsp;</td>
      <td valign="middle">
	  <select class="boxs" name="fJenis" id="fJenis" style="width:300px" tabindex="0">
	  <option value="ALL">ALL</option>
      <?php
	  	#$gJNS = "MS";
		if ($rCrt==3){
			$nSQ = "SELECT kode, deskripsi FROM ref_usulan_jenis WHERE (kode='MS' OR kode='MK' ) AND aktif='Y' ORDER BY kode";
		}
		else{
			$nSQ = "SELECT kode, deskripsi FROM ref_usulan_jenis WHERE aktif LIKE '%' ORDER BY kode";
		}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			do
			{
				$sel ="";
				if ($mRo['kode']==$gJNS) 
				{
				$sel ="selected";
				}
				echo '<option '.$sel.' value="'.$mRo['kode'].'">'.$mRo['kode']." - ".$mRo['deskripsi'].'</option>';
			}
			  while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
    </tr>
	<?php } ?>
	<?php if ($rCrt!=3 && $rCrt!=4 && $rCrt!=6){?>
    <tr> 
      <td align="right">MILIK</td>
      <td>&nbsp;</td>
      <td valign="middle">
	  <select class="boxs" name="fMilik" style="width:250px" tabindex="0" onchange="this.form.submit()">
      <option value="All">All</option>
      <?php
		$nSQ = "SELECT * FROM ref_pemilik ORDER BY Kd_Pemilik";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
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
        </select> </td>
    </tr>
	<?php } ?>
    <tr> 
      <td align="right"><?php if ($rCrt==1 || $rCrt==2) {echo "S.D ";}?>TAHUN</td>
      <td>&nbsp;</td>
      <td valign="middle">
		<select class="boxs" name="fThn" style="width: 60px" tabindex="0" onchange="this.form.submit()">
		<?php if ($rCrt!=1 && $rCrt!=3 && $rCrt!=6 && $rCrt!=4 && $rCrt!=5){?>
		<option <?php if ($gThn=="All") {echo "selected";} ?> value="All">All</option>
		<?php } ?>
		<?php
			$eThn=1890;
			$wThn=2030;
			if ($rCrt==3 || $rCrt==4 || $rCrt==6){$eThn=2016;}
			//if ($rCrt==1111111111){$eThn=1890; $wThn=1890;}
			
			for($nThn=$eThn; $nThn<=$wThn; $nThn++)
			{
				$sel ="";
				if ($gThn==$nThn) {$sel ="selected";}
				echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
		?>
		</select>&nbsp;
		<?php if ($rCrt==111111 || $rCrt==5){?>
		&nbsp; S.D &nbsp;
		<select class="boxs" name="fThn2" style="width: 60px" tabindex="0" onchange="this.form.submit()">
		<?php
			$eThn=1890;
			if ($rCrt==3 || $rCrt==4 || $rCrt==6){$eThn=2016;}
			for($nThn2=$eThn; $nThn2<=2030; $nThn2++)
			{
				$sel ="";
				if ($gThn2==$nThn2) {$sel ="selected";}
				echo '<option '.$sel.' value="'.$nThn2.'">'.$nThn2.'</option>';
			}
		?>
		</select>
		<?php } ?>	  </td>
    </tr>
	<?php if ($rCrt==4){?>
    <tr height="25">
      <td align="right">DOKUMEN</td>
      <td>&nbsp;</td>
      <td valign="middle">
	  <table border="0" width="400" cellpadding="0" style="border-collapse: collapse">
		<tr>
			<td width="75"><label><input name="fDoK" <?=$LisK1?> type="radio" value="1" />REKAP</label></td>
			<td><label><input name="fDoK" <?=$LisK2?> type="radio" value="2" />RINCIAN MUTASI</label></td>
	      </tr>
	  </table>	  </td>
    </tr>
    <tr>
      <td align="right">REKENING LEVEL</td>
      <td>&nbsp;</td>
      <td valign="middle">
	  <table border="0" width="400" cellpadding="0" style="border-collapse: collapse">
		<tr>
			<td width="75"><label><input name="fDoc" <?php echo $List1?> type="radio" value="1" />BIDANG</label></td>
			<td width="65"><label><input name="fDoc" <?php echo $List2?> type="radio" value="2" />JENIS</label></td>
		    <td width="65"><label><input name="fDoc" <?php echo $List3?> type="radio" value="3" />OBJEK</label></td>
		    <td width="110"><label><input name="fDoc" <?php echo $List4?> type="radio" value="4" />RINCIAN OBJEK</label></td>
		    <td><label><input name="fDoc" <?php echo $List5?> type="radio" value="5" />R. OBJEK (<i>Jump</i>)<font style="color:#FF0000">**</font></label></td>
	      </tr>
	  </table>	  </td>
    </tr>
	<?php } ?>
	<?php if ($rCrt==13 || $rCrt==16) {?>
    <tr>
      <td align="right">ASET</td>
      <td>&nbsp;</td>
      <td valign="middle">
	  <table border="0" width="400" cellpadding="0" style="border-collapse: collapse">
		<tr>
			<td width="65"><label><input type="checkbox" name="fChKA" checked />KIB-A</label></td>
			<td width="65"><label><input type="checkbox" name="fChKB" checked />KIB-B</label></td>
			<td width="65"><label><input type="checkbox" name="fChKC" checked />KIB-C</label></td>
			<td width="65"><label><input type="checkbox" name="fChKD" checked />KIB-D</label></td>
			<td width="65"><label><input type="checkbox" name="fChKE" checked />KIB-E</label></td>
			<td width="65"><label><input type="checkbox" name="fChKF" checked />KIB-F</label></td>
			<td><label><input type="checkbox" name="fChKG" checked />KIB-G</label></td>
		</tr>
	  </table>	  </td>
    </tr>
	<?php } ?>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td align="right">TANGGAL CETAK</td>
      <td>&nbsp;</td>
      <td valign="middle">
	  <select class="boxs" name="frHri" tabindex="0">
        <?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$gHri) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
        </select> &nbsp; <select class="boxs" name="frBln" tabindex="0">
          <?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$gBln) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
        </select> &nbsp;
		<select class="boxs" name="frThn" style="width: 60px" tabindex="0">
          <?php
			for($nThn=1900; $nThn<=2030; $nThn++)
			{
			$sel ="";
			if ($nThn==$gThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
        </select>	  </td>
    </tr>
    <tr> 
      <td colspan="2">&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td colspan="2">&nbsp;</td>
      <td valign="middle">
	  <input type="button" name="B36" value="OPEN" onclick="P_View_Report('<?=$rCrt?>','800','400','<?=$nFile?>')"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B362" value="CLOSE" onclick="P_Close()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />      </td>
    </tr>
    <tr> 
      <td colspan="2">&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
	
    <!--tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="middle">
	  <?php if ($List2=="checked" || $List3=="checked" || $List4=="checked") {?>
	  <input type="button" name="B36" value="REKAP" onclick="P_RekapMutasi()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B36" value="OPEN" onclick="P_View_Report('<?=$rCrt?>','800','400','<?=$nFile?>')"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <?php } else {?>
	  <input type="button" name="B36" value="OPEN" onclick="P_View_Report('<?=$rCrt?>','800','400','<?=$nFile?>')"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <?php } ?>
	  <input type="button" name="B362" value="CLOSE" onclick="P_Close()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />      </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr-->
  </table>
  <?php
  	/*NOT MOVE*/
	if (substr($gSub,0,11)!=$gUnt) {$gSub = "All";}
	if (substr($gUpb,0,14)!=$gSub) {$gUpb = "All";}
  ?>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_View_Report(crt,w,h,nFld)
	{
		var JnM="";
		var Ast="";
		if (crt==3 || crt==6)
		{
			JnM = $("#fJenis").val();
			Ast = $("#fAst").val();
		}
		var win     = null;
		var txtHTML = "";
		var iErrors = 0;
		
		var frHri = objfrm.frHri.value;
		var frBln = objfrm.frBln.value;
		var frThn = objfrm.frThn.value;
		var gA="";
		var gB="";
		var gC="";
		var gD="";
		var gE="";
		var gF="";
		var gG="";
		var rPil="";
		var rPiY="";
		
		if (crt=='3')
		{
			//if (objfrm.fChKA.checked==true) {gA="Ya";}
			//if (objfrm.fChKB.checked==true) {gB="Ya";}
			//if (objfrm.fChKC.checked==true) {gC="Ya";}
			//if (objfrm.fChKD.checked==true) {gD="Ya";}
			//if (objfrm.fChKE.checked==true) {gE="Ya";}
			//if (objfrm.fChKF.checked==true) {gF="Ya";}
			//if (objfrm.fChKG.checked==true) {gG="Ya";}
			
			gA="Ya";
			gB="Ya";
			gC="Ya";
			gD="Ya";
			gE="Ya";
			gF="Ya";
			gG="Ya";
		}
		
		if (crt=='4')
		{
			Len = objfrm.fDoc.length;
			for (i=0; i<=Len; i++)
			{
				if (objfrm.fDoc[i].checked) {rPil = objfrm.fDoc[i].value; break; }
			}
			
			Yen = objfrm.fDoK.length;
			for (i=0; i<=Yen; i++)
			{
				if (objfrm.fDoK[i].checked) {rPiY = objfrm.fDoK[i].value; break; }
			}
			
			if (rPiY==2){
				rPiY="_RciMutasi_New_Ext";
			}
			else {
				rPiY="_New_Ext";
			}
		}
		
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL = nFld+rPiY+'.php?JnM='+JnM+'&Ast='+Ast+'&rPil='+rPil+'&gA='+gA+'&gB='+gB+'&gC='+gC+'&gD='+gD+'&gE='+gE+'&gF='+gF+'&gG='+gG+'&frHri='+frHri+'&frBln='+frBln+'&frThn='+frThn+'<?="&gDoc=".$gDoc."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThn=".$gThn."&gThn2=".$gThn2."&gMLK=".$gMLK."&IdL=".$_GET['IdL']?>';
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function P_RekapMutasi()
	{
		var AN = confirm("Rekap data mutasi..?!!");
		if (AN)
		{
			objfrm.Simpan.value = "RekapMutasi";
			objfrm.submit();
		}
	}

	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.Simpan.value = "Close";
		objfrm.submit();
	}

</script>

<?php require('Connection_Close.php');?>
