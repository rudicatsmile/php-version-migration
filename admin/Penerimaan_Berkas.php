<?php
require "CheckSession.php";
require "Connection.php";
require "Connection_Simkada.php";
require "FileFunction.php";
require "CheckLogin.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="global.js"></script>
</head>
<?php
extract($_GET);
if (isset($_GET['gUnt'])) {$gUnt  = $_GET['gUnt'];} else {$gUnt  = "";}
if (isset($_GET['gFin'])) {$gFin  = $_GET['gFin'];} else {$gFin  = "";}
if (isset($_GET['gThn'])) {$gThn  = $_GET['gThn'];} else {$gThn  = $tTbl;}

if (isset($_GET['gPR'])) {$gPR  = $_GET['gPR'];} else {$gPR  = "";}
if (isset($_GET['gKG'])) {$gKG  = $_GET['gKG'];} else {$gKG  = "";}
if (isset($_GET['gSB'])) {$gSB  = $_GET['gSB'];} else {$gSB  = "";}
if (isset($_GET['gRK'])) {$gRK  = $_GET['gRK'];} else {$gRK  = "";}

if (isset($_GET['gPer'])) {$gPer = $_GET['gPer'];} else {$gPer = $tTbl;}
if (isset($_GET['gApb'])) {$gApb = $_GET['gApb'];} else {$gApb = $uTbl;}
if (isset($_GET['gUT'])) {$gUT   = $_GET['gUT'];} else {$gUT = "";}

$gFin = addslashes($gFin);

?>
<body>
<?php require "FileMenu.php";?>
<form name="myfrm" method="post" action="<?php echo "Penerimaan_Berkas_.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'] ?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CritIDT" size="10">
  <table border="0" align="center" width="1858">
    <tr> 
      <td width="78"></td>
      <td width="16"></td>
      <td width="620"></td>
      <td width="83"></td>
      <td width="12"></td>
      <td width="222"></td>
      <td></td>
    </tr>
    <tr>
      <td class="ar">PERIODE</td>
      <td>&nbsp;</td>
      <td>
	  <select class="boxs" name="fPer" id="fPer" style="width: 60px" onchange="this.form.submit()">
	  <?php
			for($nThn=2021; $nThn<=2030; $nThn++)
			{
			$sel ="";
			if ($nThn==$gPer) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
      </select>&nbsp;
	  <select class="boxs" name="fApb" id="fApb" style="width:90px" onchange="this.form.submit()">
	  <option <?php if ($gApb=='0'){echo "selected";}?> value="0">Murni</option>
	  <option <?php if ($gApb=='1'){echo "selected";}?> value="1">Perubahan</option>
      </select>	  
	  
	  </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td class="ar">UNIT KERJA</td>
      <td>&nbsp;</td>
      <td> 
        <select class="boxs" name="fUnt" tabindex="0" style="width:600px" onchange="this.form.submit()">
        <?php
		if ($Lev > 1 )
			{$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit WHERE Kd_Unit = '".substr($SkP,0,11)."' ORDER BY Kd_Unit";}
		else
		{
			if ($xMen == 'Ya')
			{
				$nSQ = "SELECT p1.skpdkode as Kd_Unit, p2.Nm_Unit 
				FROM ta_user_mentor p1 
				LEFT JOIN ref_unit p2 ON p2.Kd_Unit=p1.skpdkode 
				WHERE p1.userid='".$UID."' 
				ORDER BY p2.Kd_Unit";
			}
			else
			{
				$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
			}
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
				$zUnt=$mRo['Kd_Unit'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Unit'].'">'.$mRo['Kd_Unit']." : ".strtoupper($mRo['Nm_Unit']).'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <?php
	$mSKD = fGlobalNEW("Kd_Unit_Link","ref_unit","Kd_Unit",$zUnt,"=","",DatabaseSB,$ConSB,"");
	$mSKD = $zUnt;
	?>
	
    <tr>
      <td class="ar">PROGRAM</td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle">
	  <select name="fPR" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
      <option value="">ALL</option>
	    <?php
		
		//CallConnection(DatabaseSA,$ConSA);
		$zPR = "";
		#$nSQ = "SELECT idProgram, nmProgram FROM ta_apbd_program_skpd WHERE idProgram LIKE '_.__.".$mSKD."%' and periode='$tTbl' and apbd='$uTbl' GROUP BY idProgram";
		$nSQ = "SELECT idProgram, nmProgram FROM ta_apbd_program_skpd WHERE kdUnit = '".$mSKD."' and periode='".$gPer."' and apbd='".$gApb."' ORDER BY idProgram";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$sel = "";
			//if ($gPR == "") {$gPR = $mRo[0];}
			if ($mRo[0]==$gPR) 
			{
				$sel = "selected";
				$zPR = $mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper(fViewLimit($mRo[1],50)).'</option>';
		}
	  ?>
      </select>	  </td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td class="ar">KEGIATAN</td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle">
	  <select name="fKG" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
      <option value="ALL">ALL</option>
	    <?php
		if ($zPR!="")
		{
			$zKG = "";
			$nSQ = "SELECT idKegiatan, nmKegiatan FROM ta_apbd_kegiatan_skpd WHERE kdUnit = '".$mSKD."' AND idKegiatan LIKE '".$zPR."%' and periode='".$gPer."' and apbd='".$gApb."' GROUP BY idKegiatan";
			$nRs = mysql_query($nSQ) or die(mysql_error());
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				$sel = "";
				if ($mRo[0]==$gKG) 
				{
					$sel = "selected";
					$zKG = $mRo[0];
				}
				echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper(fViewLimit($mRo[1],50)).'</option>';
			}
		}
	  ?>
      </select></td>
      <td valign="middle" align="right">PERUNTUKAN</td>
      <td valign="middle">&nbsp;</td>
      <td colspan="2" valign="middle">
		<select name="fUT" id="fUT" style="width:450px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
        <option value="">ALL</option>
        <?php
		if ($zUnt!="")
		{
			$zPB = "";
			$nSQ = "SELECT kd_upb, nm_upb FROM ref_upb WHERE kd_upb LIKE '".$zUnt."%' ORDER BY kd_upb";
			$nRs = mysql_query($nSQ) or die(mysql_error());
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				$sel = "";
				if ($mRo[0]==$gUT) 
				{
					$sel ="selected";
					$zPB = $mRo[0];
				}
				echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper(fViewLimit($mRo[1],50)).'</option>';
			}
		}
	  ?>
      </select>	  </td>
    </tr>
    <tr>
      <td class="ar">SUBKEGIATAN</td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle">
	  <select name="fSB" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
      <option value="ALL">ALL</option>
	    <?php
		if ($zKG!="")
		{
			$zSB = "";
			$nSQ = "SELECT idSubKegiatan, nmSubKegiatan FROM ta_apbd_kegiatan_sub_skpd WHERE kdUnit = '".$mSKD."' AND idSubKegiatan LIKE '".$zKG."%' and periode='".$gPer."' and apbd='".$gApb."' ORDER BY idSubKegiatan";
			$nRs = mysql_query($nSQ) or die(mysql_error());
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				$sel = "";
				if ($mRo[0]==$gSB) 
				{
					$sel = "selected";
					$zSB = $mRo[0];
				}
				echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper(fViewLimit($mRo[1],50)).'</option>';
			}
		}
	  ?>
      </select></td>
      <td valign="middle" align="right">TAHUN</td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle"><select class="boxs" name="fThn" style="width: 60px">
        <option value="%">ALL</option>
        <?php
				for($nThn=2021; $nThn<=2030; $nThn++)
				{
				$sel ="";
				if ($nThn==$gThn) {$sel ="selected";}
				echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
				}
				?>
      </select></td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td class="ar">REKENING</td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle">
	  <select name="fRK" style="width:600px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
        <option value="">ALL</option>
        <?php
		if ($zKG!="")
		{
			$zRK = "";
			//CallConnection(DatabaseSA,$ConSA);
			
			$nSQ = "SELECT kdRekening, nmRekening FROM ta_apbd_rekening_skpd WHERE kdUnit = '".$mSKD."' AND idSubKegiatan = '".$zSB."' and periode='".$gPer."' and apbd='".$gApb."' GROUP BY kdRekening";
			$nRs = mysql_query($nSQ) or die(mysql_error());
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				$sel = "";
				if ($mRo[0]==$gRK) 
				{
					$sel ="selected";
					$zRK = $mRo[0];
				}
				echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper(fViewLimit($mRo[1],50)).'</option>';
			}
		}
	  ?>
      </select></td>
      <td valign="middle" align="right">CARI</td>
      <td valign="middle">&nbsp;</td>
      <td valign="middle"><input class="text" type="text" name="fFind" id="fFind" value="<?php echo $gFin?>" style="font-family: Calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986; width:200px" /></td>
      <td valign="middle"><input type="button" name="B39" value="GO" onclick="P_Find()" style="width: 50px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
      &nbsp;&nbsp;<input type="button" name="B35" value="INPUT PENERIMAAN BERKAS" onclick="InputData('950','520','center')" style="width:168px; color:#0000FF; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
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
        <th width="27" style="border-left: #fff dotted 1px; border-right: #fff dotted 1px; padding-left:3px; text-align:center">NO.</th>
        <th width="67" style="border-right: #fff dotted 1px; padding-left:3px">TANGGAL</th>
        <th width="130" style="border-right: #fff dotted 1px; padding-left:3px">NOMOR</th>
        <th width="170" style="border-right: #fff dotted 1px; padding-left:3px">NO. KONTRAK </th>
        <th width="90" class="ar" style="border-right: #fff dotted 1px; padding-left:3px; padding-right:3px">NILAI KONTRAK</th>
        <th width="250" style="border-right: #fff dotted 1px; padding-left:3px">KEGIATAN, REKENING (P13)</th>
        <th style="border-right: #fff dotted 1px; padding-left:3px">URAIAN</th>
        <th width="45" style="border-right: #fff dotted 1px; text-align:center">PROSES</th>
        <th width="90" style="border-right: #fff dotted 1px; text-align:right">PENGADAAN</th>
        <th width="170" class="ac" style="border-right: #fff dotted 1px">ACTION</th>
      </tr>
      <?php
	  CallConnection(DatabaseSB,$ConSB);
	  if ($gUpb=="All") {$zUpb = $zSub.".%";}
		if ($gThn=="All")
			{$rThn="____";}
		else
			{$rThn=$gThn;}
				
		include "FilePagingTop.php";
		if ($gFin!="")
			{$fFindSy = "AND (Nomor LIKE '%".$gFin."%' OR No_Kontrak LIKE '%".$gFin."%' OR Uraian LIKE '%".$gFin."%' OR Nm_Kegiatan LIKE '%".$gFin."%' OR Nm_Rek13 LIKE '%".$gFin."%')";}
		else
			{$fFindSy = "";}
		
		if ($zPR=="") 
		{
			$SyTKG = "%";
		}
		else 
		{
			if ($zKG=="") 
			{
				$SyTKG = $zPR."%";
			}
			else 
			{
				if ($zSB=="") 
				{
					$SyTKG = $zKG."%";
				}
				else
				{
					$SyTKG = $zSB;
				}
			}
		}
		if ($zRK=="") {
			$SyTRK = "%";
		} else {
			$SyTRK = $zRK;
		}
		
		$nSQL= "SELECT * FROM ta_penerimaan_berkas WHERE Kd_SubKegiatan LIKE '$SyTKG' AND Kd_Rek13 LIKE '$SyTRK' 
		AND Tanggal LIKE '".$gThn."-%-%' AND Peruntukan LIKE '".$zPB."%' 
		AND Kd_Unit LIKE '".$zUnt."' ".$fFindSy." 
		ORDER BY Tanggal, Nomor LIMIT $Offset, $DataPerPage";
		#if ($Lev == 0){echo $nSQL;}
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
				$CrTB = str_replace("UangMuka","Uang Muka",$mRo['CritBayar']);
				$CrTT = $mRo['CritBayar_Termin'];
				if ($CrTB=="Termin") {$CrTB.="-".$CrTT;}
				if ($CrTB=="Pelunasan") {$CrTB ="100% (".$CrTB.")";}
				$NilP = fGlobal("ifnull(sum(nilai),0)","ta_pengadaan","No_Berkas:Periode",$mRo['Nomor'].":".$mRo['Periode'],"=:=","","");
				if ($NilP>$mRo['Nilai']){
					$CA="; color:#0000FF";
					$CB="; color:#FF0000";
				}
				else if ($NilP<$mRo['Nilai']){
					$CA="; color:#FF0000";
					$CB="; color:#0000FF";
				}
				else{
					$CA="";
					$CB="";
				}
				$edit = "edit";
				$dele = "del";
				$DelT = "";
				$CeK = fGlobal("IDT","ta_pengadaan","No_Berkas:Periode",$mRo['Nomor'].":".$mRo['Periode'],"=:=","IDT LIMIT 0,1","");
				if ($CeK){
					$edit = "edie";
					$dele = "delt";
					$DelT = "NO";
				}
				
				$LnKdP = strlen($mRo['Kd_Program']);
				$LnKdK = strlen($mRo['Kd_Kegiatan']);
				$LnKdS = strlen($mRo['Kd_SubKegiatan']);
				$LnKdR = strlen($mRo['Kd_Rek13']);
				
				$Wrn = "";
				$rL=15;
				if ($gThn>=2024){$rL=17;}
				
				#if ($LnKdP != 7 || $LnKdK != 12 || $LnKdS != 15 || $LnKdR != 17)
				if ($LnKdP != 7 || $LnKdK != 12 || $LnKdS != $rL || $LnKdR != 17)
				{
					$Wrn = "; color:#ff0000";
				}
			?>
		  <tr <?=fBackCLR($iG)?>> 
			<td valign="top" style="border-bottom: #999 dotted 1px; border-left: #999 dotted 1px; border-right: #999 dotted 1px; padding-left:3px; text-align:center <?=$Wrn?>"><?=$iG?>.</td>
			<td valign="top" style="border-bottom: #999 dotted 1px; border-right: #999 dotted 1px; padding-left:3px <?=$Wrn?>"><?=fConvertDateShort($mRo['Tanggal'])?></td>
			<td valign="top" style="border-bottom: #999 dotted 1px; border-right: #999 dotted 1px; padding-left:3px <?=$Wrn?>"><?=$mRo['Nomor']?></td>
			<td valign="top" style="border-bottom: #999 dotted 1px; border-right: #999 dotted 1px; padding-left:3px <?=$Wrn?>">
			<div id="repaDiv0<?=$mRo['IDT']?>" class="repairkodeprog0">
				<div id="repaDiv1<?=$mRo['IDT']?>" class="repairkodeprog1"></div>
				<div id="repaDiv2<?=$mRo['IDT']?>" class="repairkodeprog2"></div>
			</div>			
			<?=$mRo['No_Kontrak']?></td>
        	<td valign="top" style="border-bottom: #999 dotted 1px; border-right: #999 dotted 1px; padding-left:3px <?=$Wrn?>; padding-right:3px; text-align:right <?=$CA?>"><?=fConvertToRupiah($mRo['Nilai'])?></td>
			<td valign="top" style="border-bottom: #999 dotted 1px; border-right: #999 dotted 1px; padding-left:3px <?=$Wrn?>"><?=$mRo['Kd_Kegiatan']." : ".$mRo['Nm_Kegiatan']."<br>".$mRo['Kd_Rek13']." : ".$mRo['Nm_Rek13']?></td>
            <td valign="top" style="border-bottom: #999 dotted 1px; border-right: #999 dotted 1px; padding-left:3px <?=$Wrn?>"><?=$mRo['Uraian']?></td>
        	<td valign="top" style="border-bottom: #999 dotted 1px; border-right: #999 dotted 1px; padding-left:3px <?=$Wrn?>; text-align:center"><?=$mRo['Proses']?></td>
        	<td valign="top" style="border-bottom: #999 dotted 1px; border-right: #999 dotted 1px; padding-left:3px <?=$Wrn?>; padding-right:3px; text-align:right <?=$CB?>"><?=fConvertToRupiah($NilP)?></td>
        	<td valign="top" style="border-bottom: #999 dotted 1px; border-right: #999 dotted 1px; text-align:center <?=$Wrn?>">
			<a href="#" class="ico <?=$edit?>" onclick="EditData('950','520','center','<?=$mRo['IDT']?>','<?=$FrmG?>','<?=$IdL?>'); return false">Edit</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="#" class="ico <?=$dele?>" onclick="P_DeleteR('<?=$DelT?>','<?=$mRo['IDT']?>','<?=$mRo['Proses']?>'); return false">Delete</a>&nbsp;&nbsp;
			<!--a href="#" class="ico reff" onclick="P_RepairX('<?=$mRo['IDT']?>','<?=$_GET['IdL']?>'); return false;">Repair</a-->			</td>
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
        <td colspan="4">Data tidak ditemukan..!!</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <?php
		}
		?>
    </table>
          <!-- Pagging -->
          <?php
			$nSQL= "SELECT COUNT(*) AS JmlRc FROM ta_penerimaan_berkas WHERE Tanggal LIKE '".$gThn."-%-%' AND Kd_Unit LIKE '".$zUnt."' ".$fFindSy;
			$fUlrR= "FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&gFin=".$gFin."&gThn=".$gThn."&gPR=".$gPR."&gKG=".$gKG."&gRK=".$gRK."&gUnt=".$zUnt."&";
			include "FilePagingBot_Berkas.php";
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
	
	function P_DeleteR(DelT,xA,xR)
	{
		if (DelT!="") {window.alert('Access denied, data sudah diproses..!!'); return false;}
		
		var AN = confirm("Delete record..?!!");
		if (AN)
		{
			objfrm.CritIDT.value = xA;
			objfrm.Simpan.value = "DeleteRecord";
			objfrm.submit();
		}
	}
	
	function P_Find()
	{
		objfrm.Simpan.value = "Find";
		objfrm.submit();
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
						$URL_Top = "Penerimaan_Berkas_Top.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
						$URL_Mid = "Penerimaan_Berkas_Mid.php?gPer=".$gPer."&gApb=".$gApb."&gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&gBid=".$zBid."&IdL=".$_GET['IdL'];
						$URL_Bot = "Penerimaan_Berkas_Bot.php";
					?>       			
       			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='<?php echo $URL_Top?>' scrolling='no'><frame name='WinFormKIB_Mid' src='<?php echo $URL_Mid?>' scrolling='auto'><frame name='WinFormKIB_Bot' src= '<?php echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"
       			win.focus()
      			win.window.document.clear()
      			win.window.document.write(txtHTML)
      			win.window.document.close() 
      			win.setTimeout("self.close()",200000000)
    		}
	}
	
	function EditData(w,h,pos,IdT,FrmG,IdL)
	{
		var win=null; txtHTML = ""; iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = "Penerimaan_Berkas_Top.php?FrmG="+FrmG;
			URL_Mid = "Penerimaan_Berkas_Mid.php?gIdT="+IdT+"&IdL="+IdL;
			URL_Bot = "Penerimaan_Berkas_Bot.php";
			txtHTML="<html><head><title>Simbada</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormKIB_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormKIB_Mid' src='"+URL_Mid+"' scrolling='auto'><frame name='WinFormKIB_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>" 
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}

	function P_Repair(IdT,IdL)
	{
		dispBLOCK('repaDiv2'+IdT);
		
		$(document).ready(function()
		{
			$("#repaDiv1"+IdT).load('Penerimaan_Berkas_Repair_Top.php?IdT='+IdT+'&IdL='+IdL);
		});
		
		$(document).ready(function()
		{
			$("#repaDiv2"+IdT).load('Penerimaan_Berkas_Repair_Mid.php?IdT='+IdT+'&IdL='+IdL);
		});
		
		dispBlockOrNo('repaDiv0'+IdT);
	}
	
	function showProKg(FnD,CrT,IdT,IdL)
	{
		SkP = $("#fSKP"+IdT).val();
		if (CrT=='Prog'){
			MsT = $("#fSKP"+IdT).val();
		}
		else if (CrT=='Kegi'){
			MsT = $("#fPRG"+IdT).val();
			if (MsT==''){alert('Program belum dipilih..!!'); return false;}
		}
		else if (CrT=='Subk'){
			MsT = $("#fKEG"+IdT).val();
			if (MsT==''){alert('Kegiatan belum dipilih..!!'); return false;}
		}
		else if (CrT=='Rekn'){
			MsT = $("#fSUB"+IdT).val();
			if (MsT==''){alert('Sub Kegiatan belum dipilih..!!'); return false;}
		}
		
		if (FnD=='find')
		{
			FnD = "";//ReplaceText(objfrm.fFindP.value);
			$(document).ready(function()
			{
				$('#progDiv2Cri'+IdT).load('Penerimaan_Berkas_Repair_Find_Prokeg_Mid.php?FnD='+FnD+'&CrT='+CrT+'&SkP='+SkP+'&MsT='+MsT+'&IdT='+IdT+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('progDiv2Cri'+IdT);
			$(document).ready(function()
			{
				$('#progDiv1Cri'+IdT).load('Penerimaan_Berkas_Repair_Find_Prokeg_Top.php?IdT='+IdT+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$('#progDiv2Cri'+IdT).load('Penerimaan_Berkas_Repair_Find_Prokeg_Mid.php?CrT='+CrT+'&SkP='+SkP+'&MsT='+MsT+'&IdT='+IdT+'&IdL='+IdL);
			});
			
			
			dispBlockOrNo('progDiv0Cri'+IdT);
		}
	}	


function showCLICK(CrT,gKd,gNm,IdT,IdL)
{
	if (CrT=='Prog'){
		$("#fPRG"+IdT).val(gKd);
		$("#dPRG"+IdT).val(gNm);
		
		$("#fKEG"+IdT).val('');
		$("#dKEG"+IdT).val('');
		
		$("#fSUB"+IdT).val('');
		$("#dSUB"+IdT).val('');
		
		$("#fREK"+IdT).val('');
		$("#dREK"+IdT).val('');
	}
	if (CrT=='Kegi'){
		$("#fKEG"+IdT).val(gKd);
		$("#dKEG"+IdT).val(gNm);
		
		$("#fSUB"+IdT).val('');
		$("#dSUB"+IdT).val('');
		
		$("#fREK"+IdT).val('');
		$("#dREK"+IdT).val('');
	}
	if (CrT=='Subk'){
		$("#fSUB"+IdT).val(gKd);
		$("#dSUB"+IdT).val(gNm);
		
		$("#fREK"+IdT).val('');
		$("#dREK"+IdT).val('');
	}
	if (CrT=='Rekn'){
		$("#fREK"+IdT).val(gKd);
		$("#dREK"+IdT).val(gNm);
	}
	
	dispNO('progDiv0Cri'+IdT);
}

function saveDATA(IdT,IdL)	//JSON
{
	idPro = $("#fPRG"+IdT).val();
	nmPro = $("#dPRG"+IdT).val();
	
	idKeg = $("#fKEG"+IdT).val();
	nmKeg = $("#dKEG"+IdT).val();
	
	idSub = $("#fSUB"+IdT).val();
	nmSub = $("#dSUB"+IdT).val();
	
	idRek = $("#fREK"+IdT).val();
	nmRek = $("#dREK"+IdT).val();
	
	if (idPro==''){alert('Program belum dipilih..!!'); return false;}
	if (idKeg==''){alert('Kegiatan belum dipilih..!!'); return false;}
	if (idSub==''){alert('Sub Kegiatan belum dipilih..!!'); return false;}
	if (idRek==''){alert('Belanja belum dipilih..!!'); return false;}
	
	AN = confirm('Save data..?');
	if (!AN){return false;}
	
	$(document).ready(function()
	{
		
		$.post("Penerimaan_Berkas_Repair_Mid_Save.php",
		{"idPro":idPro,"nmPro":nmPro,"idKeg":idKeg,"nmKeg":nmKeg,"idSub":idSub,"nmSub":nmSub,"idRek":idRek,"nmRek":nmRek,"IdT":IdT,"IdL":IdL},
		function( data ) 
		{
			//alert('Proses berhasil..!');
		},"json");
	});
	dispNO('repaDiv0'+IdT);
}

$("#fFind").focus();
</script>
