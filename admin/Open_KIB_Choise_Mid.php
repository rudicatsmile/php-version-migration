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
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php if ($_POST['Simpan']=="Close") {?>
	<script LANGUAGE="JavaScript">            
	this.setTimeout("self.close()",0)
	</script>
<?php } ?>

<?php
if (isset($_POST['fUnt'])) {$gUnt  = $_POST['fUnt'];}
if (isset($_POST['fSub'])) {$gSub  = $_POST['fSub'];}
if (isset($_POST['fUpb'])) {$gUpb  = $_POST['fUpb'];}
if (isset($_POST['fBid'])) {$gBid  = $_POST['fBid'];}
if (isset($_POST['fKel'])) {$gKel  = $_POST['fKel'];}
if (isset($_POST['fJns'])) {$gJns  = $_POST['fJns'];}
if (isset($_POST['fOBJ'])) {$gOBJ  = $_POST['fOBJ'];}
if (isset($_POST['fRin'])) {$gRin  = $_POST['fRin'];}
if (isset($_POST['fThA'])) {$gThA  = $_POST['fThA'];}
if (isset($_POST['fThB'])) {$gThB  = $_POST['fThB'];}
if (isset($_POST['fMlk'])) {$gMLK  = $_POST['fMlk'];}
if (isset($_POST['fExt'])) {$gExt  = $_POST['fExt'];}
#echo $gBid;

$MLK = $gMLK;
if ($gMLK=="All"){$MLK="%";}
if ($gThA=="") 
{
	$gThA  = 1890;
	//#fGetDate('year');
}
if ($gThB=="") {$gThB  = (fGetDate('year')-1);}

if ($gKel=='All') {
	$KdB = $gBid.".%";
}
else if ($gJns=='All'){
	$KdB = $gKel.".%";
}
else if ($gOBJ=='All'){
	$KdB = $gJns.".%";
}
else if ($gRin=='All'){
	$KdB = $gOBJ.".%";
}
else {
	$KdB = $gRin;
}

if ($gUnt=='All') {
	$SkP = "%";
}
else if ($gSub=='All') {
	$SkP = $gUnt.".%";
}
else if ($gUpb=='All') {
	$SkP = $gSub.".%";
}
else {
	$SkP = $gUpb;
}


#echo $SkP."<br>";
#echo $KdB."<br>";

$DataPerPage = 5000;
$CnT = fGlobalNEW("count(*)","ta_kib_108","Kd_UPB:Kd_Aset_108:Tgl_Perolehan:Tgl_Perolehan:Kd_Pemilik:extracom:KdpToAset",$SkP.":".$KdB.":".$gThA."-01-01:".$gThB."-12-31:".$MLK.":".$gExt.":N","LIKE:LIKE:>=:<=:LIKE:LIKE:=","",DatabaseSB,$ConSB,"");
$JumData = $CnT;
$JumPage = ceil($JumData/$DataPerPage);

$nGa=(int)$Data * $NoPage;
if (1+$Offset > $nGa) {
	$nDatG=$JumData;
}
else {
	$nDatG=$nGa;
}

$iB  = (int)$JumData/$DataPerPage;

if ($RecList < $DataPerPage) {
	$RecList=$RecList;
}
else {
	$RecList=$DataPerPage;
}

#echo base64_decode(base64_decode('TlRVMU5UVT0='));
?>

<body>
<form name="myfrm" method="post" action="<?php echo "Open_KIB_Choise_Mid.php?IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Simpan">
  <table border="0" align="center" style="width:740px">
    <tr> 
      <td width="-1">&nbsp;</td>
      <td width="120">&nbsp;</td>
      <td width="21">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td align="right">UNIT KERJA</td>
      <td>&nbsp;</td>
      <td colspan="3"> 
        <select name="fUnt" tabindex="0" style="width: 480px" onchange="this.form.submit()">
        <?php
		if ($Lev <= 1 ) {echo "<option value='All'>All</option>";}
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
      <td>&nbsp;</td>
      <td align="right">SUB UNIT</td>
      <td>&nbsp;</td>
      <td colspan="3"> 
        <select class="boxs" name="fSub" tabindex="0" style="width: 480px" onchange="this.form.submit()">
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
			if ((substr($gSub,0,11)!=$gUnt) && ($gSub!="All")) {$gSub=$mRo['Kd_Sub'];}
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
      <td>&nbsp;</td>
      <td align="right">UPB</td>
      <td>&nbsp;</td>
      <td colspan="3"> 
        <select class="boxs" name="fUpb" tabindex="0" style="width: 480px" onchange="this.form.submit()">
		<option value="All">All</option>
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
			if ((substr($gUpb,0,14)!=$gSub) && ($gUpb!="All")) {$gUpb = $mRo['Kd_Upb'];}
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
    <tr height="10">
      <td>&nbsp;</td>
      <td></td>
      <td></td>
      <td colspan="3" valign="middle"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right">JENIS</td>
      <td>&nbsp;</td>
      <td colspan="3" valign="middle">
	    <select class="boxs" name="fBid" tabindex="0" style="width: 480px" onchange="this.form.submit()">
        <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_3 WHERE Kd_Aset NOT LIKE '1.1.%' AND Kd_Aset NOT LIKE '1.3.7' AND Kd_Aset NOT LIKE '1.5.5' AND Kd_Aset NOT LIKE '1.5.6' ORDER BY Kd_Aset";
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
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right">OBJEK</td>
      <td>&nbsp;</td>
      <td colspan="3" valign="middle">
	    <select class="boxs" name="fKel" tabindex="0" style="width: 480px" onchange="this.form.submit()">
        <option <?php if ($gBid=="All") {echo "selected";} ?> value="All">All</option>
        <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_4 WHERE Kd_Aset LIKE '".$zBid.".__' ORDER BY Kd_Aset";
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
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right">RINCIAN OBJEK </td>
      <td>&nbsp;</td>
      <td colspan="3" valign="middle">
	    <select class="boxs" name="fJns" tabindex="0" style="width: 480px" onchange="this.form.submit()">
        <option <?php if ($gKel=="All") {echo "selected";} ?> value="All">All</option>
        <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_5 WHERE Kd_Aset LIKE '".$zKel.".__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gJns!="All")
            {
                if ($gJns=="") {$gJns=$mRo['Kd_Aset'];}
                if (substr($gJns,0,8)!=$gKel) {$gJns=$mRo['Kd_Aset'];}
            }
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gJns) 
				{
				$sel ="selected";
				$zJns=$mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right">SUB R.OBJEK</td>
      <td>&nbsp;</td>
      <td colspan="3" valign="middle">
	  <select class="boxs" name="fOBJ" tabindex="0" style="width: 480px" onchange="this.form.submit()">
        <option <?php if ($gOBJ=="All") {echo "selected";} ?> value="All">All</option>
        <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_6 WHERE Kd_Aset LIKE '".$gKel.".".substr($gJns,-2,2).".__' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
            if ($gOBJ!="All")
            {  
			if ($gOBJ=="") {$gOBJ=$mRo['Kd_Aset'];}
			if (substr($gOBJ,0,11)!=$gJns) {$gOBJ=$mRo['Kd_Aset'];}
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
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right">SUB SUB R.OBJEK </td>
      <td>&nbsp;</td>
      <td colspan="3" valign="middle">
	    <select class="boxs" name="fRin" tabindex="0" style="width: 480px" onchange="this.form.submit()">
        <option <?php if ($gRin=="All") {echo "selected";} ?> value="All">All</option>
        <?php
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_7 WHERE Kd_Aset LIKE '".$zOBJ.".___' ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gRin!="All")
            {
	            if ($gRin=="") {
					$gRin=$mRo['Kd_Aset'];
				}
				if (substr($gRin,0,14)!=$gOBJ) {
					$gRin=$mRo['Kd_Aset'];
				}
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
      </select></td>
    </tr>
    <tr height="10">
      <td></td>
      <td colspan="2"></td>
      <td colspan="3" valign="middle"></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td align="right">MILIK</td>
      <td>&nbsp;</td>
      <td width="194" valign="middle">
	  <select class="boxs" name="fMlk" style="width: 155px" tabindex="0" onchange="this.form.submit()">
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
      <td width="91" valign="middle">ASET/EXTRACOM</td>
      <td valign="middle">
		<select class="boxs" name="fExt" style="width: 120px" tabindex="0" onchange="this.form.submit()">
		<option <?php if ($gExt=="All") {echo "selected";} ?> value="%">ALL</option>
		<option <?php if ($gExt=="N") {echo "selected";} ?> value="N">A S E T</option>
		<option <?php if ($gExt=="Y") {echo "selected";} ?> value="Y">EXTRACOM</option>
		</select>	  
	  
	  </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td align="right">TAHUN</td>
      <td>&nbsp;</td>
      <td colspan="3" valign="middle">
		<select class="boxs" name="fThA" style="width: 60px" tabindex="0" onchange="this.form.submit()">
		<?php
		for($nThn=2030; $nThn>=1890; $nThn--)
		{
			$sel ="";
			if ($gThA==$nThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>&nbsp;&nbsp;&nbsp;S.D&nbsp;&nbsp;&nbsp; 
		<select class="boxs" name="fThB" style="width: 60px" tabindex="0" onchange="this.form.submit()">
		<?php
		for($nThn=2030; $nThn>=1900; $nThn--)
		{
			$sel ="";
			if ($gThB==$nThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>	</td>
    </tr>
    <?php if ($zBid!='1.5.4' && $zBid!='1.3.5') {?>
    <tr>
      <td>&nbsp;</td>
      <td align="right" title="<?=$CnT?>">DOKUMEN</td>
      <td>&nbsp;</td>
      <td colspan="3" valign="middle">
		<div class="pagging"> 
		<div class="left"> 
		<?php
		if ($iB > 0)
		{
			?>
			<a href='#' onclick="P_OpenDoc('800','400','0','<?=$_GET['IdL']?>'); return false;" title="0">1</a>
			<?php
			if ($iB > 5000) {$iB=5000;}
		
			for ($iA = 2; $iA <= $iB+1; $iA++)
			{
				?>
				<a href='#' onclick="P_OpenDoc('800','400','<?=(5000*$iA)-5000+0?>','<?=$_GET['IdL']?>'); return false;" title="<?=(5000*$iA)-5000+0?>"><?=$iA?></a>
				<?php
			}
		}
		?>
		</div>
		</div>	  </td>
    </tr>
	<?php } else {?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3" valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3" valign="middle">
	  <input type="button" name="B01" value="DOKUMEN KIB" onclick="P_OpenDoc('800','400','0','<?=$_GET['IdL']?>')"  style="width: 100px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />	  </td>
    </tr>
	<?php } ?>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3" valign="middle">
	  <!--input type="button" name="B01" value="DOKUMEN KIB" onclick="P_OpenDoc('800','400','0','<?=$_GET['IdL']?>')"  style="width: 100px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
        <input type="hidden" name="B012" value="EXPORT DATA (*.XLS)" onclick="P_ToExcel('800','400')"  style="width: 100px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
        <input type="button" name="B02" value="TUTUP" onclick="P_Close()"  style="width: 100px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /-->	  </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td colspan="3" align="center">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function test(pg)
	{
		alert(pg); return false;
	}
	
	function P_ToExcel(w,h)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		
		var rUnt=objfrm.fUnt.value;
		var rSub=objfrm.fSub.value;
		var rUpb=objfrm.fUpb.value;
		
		var rBid=objfrm.fBid.value;
		var rKel=objfrm.fKel.value;
		var rJns=objfrm.fJns.value;
		var rOBJ=objfrm.fOBJ.value;
		var rRin=objfrm.fRin.value;

		var rMLK=objfrm.fMlk.value;
		var rThA=objfrm.fThA.value;
		var rThB=objfrm.fThB.value;
		
		rPil=parseInt(rBid);
		switch(rPil)
		{
		case 1 :
			fDoc ="KIB_A_ToExcel_Choise"
			break;
		case 2 :
			fDoc ="KIB_B_ToExcel_Choise"
			break;
		case 3 :
			fDoc ="KIB_C_ToExcel_Choise"
			break;
		case 4 :
			fDoc ="KIB_D_ToExcel_Choise"
			break;
		case 5 :
			fDoc ="KIB_E_ToExcel_Choise"
			break;
		case 6 :
			fDoc ="KIB_F_ToExcel_Choise"
			break;
		//case 7 :
		//	fDoc ="ToExcel/KIB_G_ToExcel_Choise"
		//	break;
		}
		
		if (fDoc=="")
		{
			window.alert('Under construction...!!');
			return false;
		}
		
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL= "ToExcel/KIB_X_ToExcel_Count.php?gDoc="+fDoc+"&gUnt="+rUnt+"&gSub="+rSub+"&gUpb="+rUpb+"&gThA="+rThA+"&gThB="+rThB+"&gMLK="+rMLK+"&gBid="+rBid+"&gKel="+rKel+"&gJns="+rJns+"&gOBJ="+rOBJ+"&gRin="+rRin+"<?="&IdL=".$_GET['IdL']?>";
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function P_OpenDoc(w,h,pg,IdL)
	{
		//alert(pg); return false;
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		
		var rUnt=objfrm.fUnt.value;
		var rSub=objfrm.fSub.value;
		var rUpb=objfrm.fUpb.value;
		
		var rBid=objfrm.fBid.value;
		var rKel=objfrm.fKel.value;
		var rJns=objfrm.fJns.value;
		var rOBJ=objfrm.fOBJ.value;
		var rRin=objfrm.fRin.value;

		var rMLK=objfrm.fMlk.value;
		var rThA=objfrm.fThA.value;
		var rThB=objfrm.fThB.value;
		var rExt=objfrm.fExt.value;
		rPil=rBid;
		switch(rPil)
		{
		case '1.3.1' :
			fDoc ="KIB_A_Dokumen_Choise"
			break;
		case '1.3.2' :
			fDoc ="KIB_B_Dokumen_Choise"
			break;
		case '1.3.3' :
			fDoc ="KIB_C_Dokumen_Choise"
			break;
		case '1.3.4' :
			fDoc ="KIB_D_Dokumen_Choise"
			break;
		case '1.3.5' :
			fDoc ="KIB_E_Count_Choise"
			break;
		case '1.3.6' :
			fDoc ="KIB_F_Dokumen_Choise"
			break;
		case '1.5.3' :
			fDoc ="KIB_G_Count_Choise"
			break;
		case '1.5.2' :
			fDoc ="KIB_I_Count_Choise"
			break;
		case '1.5.4' :
			fDoc ="KIB_G_Count_Choise"
			break;
		}
		
		if (fDoc=="")
		{
			window.alert('Under construction...!!');
			return false;
		}
		
		LeftPosition=(screen.width)?(screen.width-w)/2:100;
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL= fDoc+".php?page="+pg+"&gUnt="+rUnt+"&gSub="+rSub+"&gUpb="+rUpb+"&gThA="+rThA+"&gThB="+rThB+"&gMLK="+rMLK+"&gBid="+rBid+"&gKel="+rKel+"&gJns="+rJns+"&gOBJ="+rOBJ+"&gRin="+rRin+"&gExt="+rExt+"&IdL="+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.Simpan.value = "Close";
		objfrm.submit();
	}

</script>

<?php require('Connection_Close.php');?>
