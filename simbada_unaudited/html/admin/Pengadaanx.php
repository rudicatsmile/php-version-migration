<?
require "CheckSession.php";
require "Connection.php";
require "Connection_Simkada.php";
require "FileFunction.php";
require "CheckLogin.php";

$JalanKAN="YAxxxxxxx";	#NoDelete AutoRepair
if ($JalanKAN=="YA")
{
	#NoDelete
	$SQ="select IDT, No_Pengadaan, Referensi from ta_kib_post_108 WHERE Tanggal='0000-00-00' and No_Pengadaan<>'' ORDER BY IDT";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rIDX = $mRo[0];
		$rNOP = $mRo[1];
		$rREF = $mRo[2];
		$rFR  = substr($rREF,0,3);
		
		$rTGL = fGlobal("Tanggal","ta_pengadaan","Nomor",$rNOP,"=","","");
		if ($rTGL){
			
			$SW="update ta_kib_post_108 set Tanggal='$rTGL', Tanggal_BAST='$rTGL' where IDT='".$rIDX."'";
			$rw = mysql_query($SW);
			
			if ($rFR=="TNH"){
				$SW="update ta_kib_a set Tgl_Perolehan='$rTGL' where Referensi='".$rREF."'";
				$rw = mysql_query($SW);
			}
			
			if ($rFR=="ALT"){
				$SW="update ta_kib_b set Tgl_Perolehan='$rTGL' where Referensi='".$rREF."'";
				$rw = mysql_query($SW);
			}
			
			if ($rFR=="BNG"){
				$SW="update ta_kib_c set Tgl_Perolehan='$rTGL' where Referensi='".$rREF."'";
				$rw = mysql_query($SW);
			}
			
			if ($rFR=="JLN"){
				$SW="update ta_kib_d set Tgl_Perolehan='$rTGL' where Referensi='".$rREF."'";
				$rw = mysql_query($SW);
			}
			
			if ($rFR=="ATL"){
				$SW="update ta_kib_e set Tgl_Perolehan='$rTGL' where Referensi='".$rREF."'";
				$rw = mysql_query($SW);
			}
			
			if ($rFR=="KDP"){
				$SW="update ta_kib_f set Tgl_Perolehan='$rTGL' where Referensi='".$rREF."'";
				$rw = mysql_query($SW);
			}
			
			$SW="update ta_kib_108 set Tgl_Perolehan='$rTGL' where Referensi='".$rREF."'";
			$rw = mysql_query($SW);
		}
	}
	
	$SQ="select IDT, No_Berkas from ta_pengadaan WHERE Kd_Program='-' ORDER BY IDT";
	$nRs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rIDX =  $mRo[0];
		$rNoM =  $mRo[1];
		$rDTA = fGlobal("Kd_Program:Nm_Program:Kd_Kegiatan:Nm_Kegiatan:Kd_Rek13:Nm_Rek13","ta_penerimaan_berkas","Nomor",$rNoM,"=","","");
		if ($rDTA){
			$rDTA = explode(":",$rDTA);
			$KdPro = $rDTA[0];
			$NmPro = $rDTA[1];
			$KdKeg = $rDTA[2];
			$NmKeg = $rDTA[3];
			$KdRek = $rDTA[4];
			$NmRek = $rDTA[5];
			
			$SW="UPDATE ta_pengadaan SET 
			Kd_Program='$KdPro',
			Nm_Program='$NmPro',
			Kd_Kegiatan='$KdKeg',
			Nm_Kegiatan='$NmKeg',
			Kd_Rek13='$KdRek',
			Nm_Rek13 ='$NmRek' 
			where IDT='$rIDX'";
			$rw = mysql_query($SW);	
		}	
	}
	#EnNoDelete
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?
extract($_GET);
if (isset($_GET['gUnt'])) {$gUnt = $_GET['gUnt'];} else {$gUnt = "";}
if (isset($_GET['gFin'])) {$gFin = $_GET['gFin'];} else {$gFin = "";}
if (isset($_GET['gThn'])) {$gThn = $_GET['gThn'];} else {$gThn = $tTbl;}
if (isset($_GET['gSem'])) {$gSem = $_GET['gSem'];} else {$gSem = 2;}
if (isset($_GET['gAst'])) {$gAst = $_GET['gAst'];} else {$gAst = "";}

if (isset($_GET['gPR'])) {$gPR = $_GET['gPR'];} else {$gPR = "";}
if (isset($_GET['gKG'])) {$gKG = $_GET['gKG'];} else {$gKG = "";}
if (isset($_GET['gSB'])) {$gSB = $_GET['gSB'];} else {$gSB = "";}
if (isset($_GET['gRK'])) {$gRK = $_GET['gRK'];} else {$gRK = "";}

$gFin = addslashes($gFin);
?>
<body onload="javascript:myfrm.fFind.focus()">
<?php require "FileMenu.php";?>
<form name="myfrm" method="post" action="<?php echo "Pengadaan_.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'] ?>">
  <input type="hidden" name="Simpan">
  <input type="hidden" name="CritIDT" size="10">
  <table border="0" align="center" width="1858" style="">
    <tr> 
      <td width="100"></td>
      <td width="20"></td>
      <td width="500"></td>
      <td width="80"></td>
      <td width="20"></td>
      <td width="210"></td>
      <td width="70"></td>
      <td></td>
    </tr>
    <tr> 
      <td class="ar">UNIT KERJA</td>
      <td>&nbsp;</td>
      <td> 
        <select class="boxs" name="fUnt" tabindex="0" style="width:500px" onchange="this.form.submit()">
        <?
		if ($Lev > 1 )
			{$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit WHERE aktif='Y' AND Kd_Unit = '".substr($SkP,0,11)."' ORDER BY Kd_Unit";}
		else
			{$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit WHERE aktif='Y' ORDER BY Kd_Unit";}
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
				
				$mRoUnt = $mRo['Nm_Unit'];
				if (strlen($mRoUnt)>70) 
				{
					$mRoUnt= substr($mRoUnt,0,70)."....";
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Unit'].'">'.$mRo['Kd_Unit']." : ".strtoupper($mRoUnt).'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select> </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <?
	$mSKD = fGlobalNEW("Kd_Unit_Link","ref_unit","Kd_Unit",$zUnt,"=","",DatabaseSB,$ConSB,"");
	$mSKD = $zUnt;
	#$nSQ = "SELECT idProgram, nmProgram FROM ta_apbd_program_skpd WHERE kdUnit LIKE '".$mSKD."%' and periode='$tTbl' and apbd='$uTbl' GROUP BY idProgram";
	#echo $nSQ;
	?>
    <tr>
      <td class="ar">PROGRAM</td>
      <td>&nbsp;</td>
      <td><select name="fPR" style="width:500px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
        <option value="">ALL</option>
        <?
		
		#CallConnection(DatabaseSA,$ConSA);
		$zPR = "";
		$nSQ = "SELECT idProgram, nmProgram FROM ta_apbd_program_skpd WHERE kdUnit LIKE '".$mSKD."%' and periode='$tTbl' and apbd='$uTbl' GROUP BY idProgram";
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
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper($mRo[1]).'</option>';
		}
	  ?>
      </select></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="ar">KEGIATAN</td>
      <td>&nbsp;</td>
      <td>
	  <select name="fKG" style="width:500px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
        <option value="">ALL</option>
        <?
		if ($zPR!="")
		{
			$zKG = "";
			$nSQ = "SELECT idKegiatan, nmKegiatan FROM ta_apbd_kegiatan_skpd WHERE idKegiatan LIKE '".$zPR."%' and periode='$tTbl' and apbd='$uTbl' GROUP BY idKegiatan";
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
      <td align="right">Posting Ke </td>
      <td align="center">&nbsp;</td>
      <td>
	  <select class="boxs" name="fAst" style="width:200px; background:#FFFF00">
        <option value="%">ALL</option>
        <option value="1.3.1" <? if ($gAst=='1.3.1'){echo "selected";}?>>Aset ( Tanah )</option>
        <option value="1.3.2" <? if ($gAst=='1.3.2'){echo "selected";}?>>Aset ( Peratalan & Mesin )</option>
        <option value="1.3.3" <? if ($gAst=='1.3.3'){echo "selected";}?>>Aset ( Gedung & Bangunan )</option>
        <option value="1.3.4" <? if ($gAst=='1.3.4'){echo "selected";}?>>Aset ( Jalan, Jaringan & Irigasi )</option>
        <option value="1.3.5" <? if ($gAst=='1.3.5'){echo "selected";}?>>Aset ( Tetap Lainnya )</option>
		<option value="1.5.3" <? if ($gAst=='1.5.3'){echo "selected";}?>>Aset ( ATB )</option>
        <option value="1.5.4" <? if ($gAst=='1.5.4'){echo "selected";}?>>Aset ( Lain-Lain )</option>
        <option value="1.3.6.01.01.01.001" <? if ($gAst=='1.3.6.01.01.01.001'){echo "selected";}?>>KDP ( Tanah )</option>
        <option value="1.3.6.01.01.01.002" <? if ($gAst=='1.3.6.01.01.01.002'){echo "selected";}?>>KDP ( Peralatan & Mesin )</option>
        <option value="1.3.6.01.01.01.003" <? if ($gAst=='1.3.6.01.01.01.003'){echo "selected";}?>>KDP ( Gedung & Bangunan )</option>
        <option value="1.3.6.01.01.01.004" <? if ($gAst=='1.3.6.01.01.01.004'){echo "selected";}?>>KDP ( Jalan, Jaringan & Irigasi )</option>
        <option value="1.3.6.01.01.01.005" <? if ($gAst=='1.3.6.01.01.01.005'){echo "selected";}?>>KDP ( Aset Tetap Lainnya )</option>
      </select>	  </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="ar">SUB KEGIATAN</td>
      <td>&nbsp;</td>
      <td>
	  <select name="fSB" style="width:500px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
        <option value="">ALL</option>
        <?
		if ($zKG!="")
		{
			$zSB= "";
			$nSQ = "SELECT idSubKegiatan, nmSubKegiatan FROM ta_apbd_kegiatan_sub_skpd WHERE idSubKegiatan LIKE '".$zKG."%' and periode='$tTbl' and apbd='$uTbl' GROUP BY idSubKegiatan";
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
      <td align="right">Periode</td>
      <td align="center">&nbsp;</td>
      <td>
	  <select class="boxs" name="fSem" style="width:137px">
        <option value="%">ALL</option>
        <option value="1" <? if ($gSem=='1'){echo "selected";}?>>Semester 1</option>
        <option value="2" <? if ($gSem=='2'){echo "selected";}?>>Semester 2</option>
      </select>
      <select class="boxs" name="fThn" style="width: 60px">
	  <option value="%">ALL</option>
	  <?
			for($nThn=2021; $nThn<=2030; $nThn++)
			{
			$sel ="";
			if ($nThn==$gThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
      </select></td>
      <td rowspan="2"><input type="button" name="B39" value="GO" onclick="P_Find()" style="width: 50px; height:44px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />      </td>
      <td rowspan="2"><input type="button" name="B35" value="INPUT DATA" onclick="InputData('950','520','center')" style="width:100px; height:44px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    <tr>
      <td class="ar">REKENING</td>
      <td>&nbsp;</td>
      <td><select name="fRK" style="width:500px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
        <option value="">ALL</option>
        <?
		if ($zKG!="")
		{
			$zRK = "";
			#CallConnection(DatabaseSA,$ConSA);
			#$nSQ = "SELECT P1.No_Rekening, P2.Nama_COA FROM anggaran_kegiatan P1
			#INNER JOIN coa_kota P2 ON P2.No_Rekening=P1.No_Rekening 
			#WHERE P1.Id_Kegiatan = '".$zKG."' AND P2.No_Rekening LIKE '5.2.3.%' GROUP BY P1.No_Rekening";
			$nSQ = "SELECT kdRekening, nmRekening FROM ta_apbd_rekening_skpd WHERE idSubKegiatan = '".$zSB."' and periode='$tTbl' and apbd='$uTbl' GROUP BY kdRekening";
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
      <td align="right">Cari</td>
      <td align="center">&nbsp;</td>
      <td><input class="text" type="text" name="fFind" value="<? echo $gFin?>" style="font-family: Calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986; width:190px" /></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
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
        <th width="29" class="ac" style="border-left: #fff dotted 1px; border-right: #fff dotted 1px">No</th>
        <th width="71" style="border-right: #fff dotted 1px; padding-left:3px">TANGGAL</th>
        <th width="134" style="border-right: #fff dotted 1px; padding-left:3px">NOMOR</th>
        <th width="124" style="border-right: #fff dotted 1px; padding-left:3px">NO. FAKTUR</th>
        <th width="94" class="ar" style="border-right: #fff dotted 1px; padding-right:3px">NILAI (Rp)</th>
        <th width="81" class="ac" style="border-right: #fff dotted 1px; padding-right:0px">PEMBAYARAN</th>
        <th width="73" style="border-right: #fff dotted 1px; padding-left:3px">POSTING</th>
        <th width="190" style="border-right: #fff dotted 1px; padding-left:3px">REKENING P.17 / 108</th>
        <th width="171" align="left" style="border-right: #fff dotted 1px; padding-left:3px">URAIAN</th>
        <th width="100" class="al" style="border-right: #fff dotted 1px; padding-left:3px">ASET</th>
        <th width="100" class="ac" style="border-right: #fff dotted 1px">POST ASET/KDP</th>
        <th width="108" class="ac" style="border-right: #fff dotted 1px">Actions</th>
      </tr>
      <?
	  CallConnection(DatabaseSB,$ConSB);
		include "FilePagingTop.php";
		if ($gFin!="")
		{
			#$fFindSy = "AND (P1.Nomor LIKE '%".$gFin."%' OR P1.No_Berkas LIKE '%".$gFin."%' OR P1.Faktur_Nomor LIKE '%".$gFin."%' OR P1.Kd_Aset LIKE '%".$gFin."%' OR P1.Nm_Aset LIKE '%".$gFin."%' OR P1.Uraian LIKE '%".$gFin."%')";
			$fFindSy = "AND (P1.Nomor LIKE '%".$gFin."%' OR P1.Faktur_Nomor LIKE '%".$gFin."%' OR P1.Kd_Aset LIKE '%".$gFin."%' OR P1.Nm_Aset LIKE '%".$gFin."%' OR P1.Uraian LIKE '%".$gFin."%')";
		}
		else
		{$fFindSy = "";}

		if ($zPR=="") {
			$SyTKG = "%";
		}
		else {
			if ($zKG=="") {
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
		
		$eTG = "P2.Tg_Berita_Acara LIKE '".$gThn."-%-%'";
		if ($gSem=='1')
		{
			$TgA = $gThn."-01-01"; $TgB = $gThn."-06-30";
			$eTG = "(P2.Tg_Berita_Acara BETWEEN '".$TgA."' AND '".$TgB."')";
		}
		else if ($gSem=='2')
		{
			$TgA = $gThn."-01-01"; $TgB = $gThn."-12-31";
			$eTG = "(P2.Tg_Berita_Acara BETWEEN '".$TgA."' AND '".$TgB."')";
		}
		
		$nSQL= "SELECT P1.IDT, P1.SPP, P1.Tanggal, P1.Nomor, P1.Faktur_Nomor, P1.Nilai, P1.Pros, P1.Kd_Aset, P1.Nm_Aset, P1.Kd_Aset_108, Nm_Aset_108, 
		P1.Uraian, P1.SPP, P1.Aset, P1.Kd_Kegiatan, P2.CritBayar, P2.CritBayar_Termin, P1.No_Berkas, P2.Periode 
		FROM ta_pengadaan P1 
		LEFT JOIN ta_penerimaan_berkas P2 ON P2.Nomor=P1.No_Berkas 
		WHERE P2.Kd_SubKegiatan LIKE '$SyTKG' AND P2.Kd_Rek13 LIKE '$SyTRK' 
		AND P1.Kd_Aset_108 LIKE '".$gAst."%' 
		AND $eTG AND P1.Kd_Unit LIKE '".$zUnt."' ".$fFindSy." 
		ORDER BY P1.No_Berkas, P1.Tanggal, P1.Nomor LIMIT $Offset, $DataPerPage";
		#echo $nSQL;
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
		do
			{
			$KdAset = $mRo['Kd_Aset'];
			$NmAset = $mRo['Nm_Aset'];
			if ($KdAset==''){
				$KdAset = $mRo['Kd_Aset_108'];
				$NmAset = $mRo['Nm_Aset_108'];
			}
			
			$gSPP = "";#fGlobalNEW("IfNull(sum(Jumlah),0)","daftar_spp","Pengadaan",$mRo['Nomor'],"=","",DatabaseSA,$ConSA,"");
			$gPOS = fGlobalNEW("CritBayar_PostingKe","ta_penerimaan_berkas","Nomor",$mRo['No_Berkas'],"=","",DatabaseSB,$ConSB,"");
			
			$CrTB = str_replace("UangMuka","Uang Muka",$mRo['CritBayar']);
			$CrTT = $mRo['CritBayar_Termin'];
			if ($CrTB=="Termin") {$CrTB.="-".$CrTT;}
			if ($CrTB=="Pelunasan") {$CrTB ="100% (".$CrTB.")";}
			
			$rCNT = fGlobalNEW("count(*)","ta_pengadaan_rinci","Nomor",$mRo['Nomor'],"=","",DatabaseSB,$ConSB,"");
			if ($rCNT > 0){
				$rSPP = "";
				$SQW  = "SELECT SmbDana, SPP FROM ta_pengadaan_rinci WHERE Nomor='".$mRo['Nomor']."'";
				$nRsR = mysql_query($SQW) or die(mysql_error());
				$mRoR = mysql_fetch_assoc($nRsR);
				do
				{
					if ($rSPP=="") 
					{
						$rSPP = SumberDn($mRoR['SmbDana'])." : <b>".$mRoR['SPP']."</b>";
					}
					else
					{
						$rSPP.= "<br>".SumberDn($mRoR['SmbDana'])." : <b>".$mRoR['SPP']."</b>";
					}
				}
				while ($mRoR = mysql_fetch_assoc($nRsR));	
			}
			else {
				$rSPP ="???";
			}
			
			#$NilP = fGlobal("ifnull(sum(debet),0)","ta_kib_post","No_Pengadaan:Tanggal",$mRo['Nomor'].":".substr($mRo['Tanggal'],0,4)."%","=:LIKE","","");
			#if ($NilP==0){
				#$NilP = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108","No_Pengadaan:Tanggal",$mRo['Nomor'].":".substr($mRo['Tanggal'],0,4)."%","=:LIKE","","");
				$NilP = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108","No_Pengadaan",$mRo['Nomor'],"=","","");
			#}
			#if (round($NilP) > round($mRo['Nilai'])){
			if ($NilP > $mRo['Nilai']){
				$CA="; color:#0000FF";
				$CB="; color:#FF0000";
			}
			#else if (round($NilP) < round($mRo['Nilai'])){
			else if ($NilP < $mRo['Nilai']){
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
			
			$Tmp="";
			if ($Lev=='0'){$Tmp="";}
			$CeK = fGlobal("IDT","ta_kib_post_108","No_Pengadaan:Tanggal",$mRo['Nomor'].":".substr($mRo['Tanggal'],0,4)."%","=:LIKE","",$Tmp);
			if ($CeK){
				$edit = "edie";
				$dele = "delt";
				$DelT = "NO";
			}
			
			?>
		  <tr <?=fBackCLR($iG)?>> 
			<td valign="top" class="ac" style="border-bottom: #999999 dotted 1px; border-left: #999999 dotted 1px; border-right: #999999 dotted 1px"><? echo $iG?>.</td>
			<td valign="top" style="border-bottom: #999999 dotted 1px; border-right: #999999 dotted 1px; padding-left:3px"><?=fConvertDateShort($mRo['Tanggal'])?></td>
			<!--td valign="top" style="border-bottom: #999999 dotted 1px; border-right: #999999 dotted 1px; padding-left:3px"><?=$mRo['Nomor']."<br>".$mRo['No_Berkas']?></td-->
			<td valign="top" style="border-bottom: #999999 dotted 1px; border-right: #999999 dotted 1px; padding-left:3px"><?=$mRo['Nomor']?></td>
			<td valign="top" style="border-bottom: #999999 dotted 1px; border-right: #999999 dotted 1px; padding-left:3px"><?=$mRo['Faktur_Nomor']?></td>
			<td valign="top" style="border-bottom: #999999 dotted 1px; border-right: #999999 dotted 1px; padding-right:3px; text-align:right <?=$CA?>"><?=fConvertToRupiah(round($mRo['Nilai'],2))?></td>
			<td valign="top" style="border-bottom: #999999 dotted 1px; border-right: #999999 dotted 1px; padding-right:3px; text-align:center; font-style:italic"><?=$CrTB?></td>
			<td valign="top" style="border-bottom: #999999 dotted 1px; border-right: #999999 dotted 1px; padding-left:3px; text-align:center; font-style:italic"><?=$gPOS?></td>
            <td valign="top" style="border-bottom: #999999 dotted 1px; border-right: #999999 dotted 1px; padding-left:3px"><?=$KdAset." : ".$NmAset?></td>
            <td valign="top" style="border-bottom: #999999 dotted 1px; border-right: #999999 dotted 1px; padding-left:3px"><?=$mRo['Uraian'].$mess?></td>
        	<td valign="top" style="border-bottom: #999999 dotted 1px; border-right: #999999 dotted 1px; padding-left:3px"><?=str_replace('Tambah','Penambahan',$mRo['Aset'])?></td>
        	<!--td valign="top" style="border-bottom: #999999 dotted 1px; border-right: #999999 dotted 1px; padding-right:3px; text-align:right <?=$CB?>"><?=fConvertToRupiah(round($NilP,2))?></td-->
        	<td valign="top" style="border-bottom: #999999 dotted 1px; border-right: #999999 dotted 1px; padding-right:3px; text-align:right <?=$CB?>"><?=fConvertToRupiah($NilP)?></td>
        	<td valign="top" style="border-bottom: #999999 dotted 1px; border-right: #999999 dotted 1px"  align="center">
			<a href="#" class="ico <?=$edit?>" onclick="EditData('950','520','center','<? echo $mRo['IDT']?>'); return false">EDIT</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<? if ($Lev<=2){?>
			<a href="#" class="ico <?=$dele?>" onclick="P_DeleteR('<?=$DelT?>','<?=$mRo['IDT']?>','<?=$rSPP?>','<?=$UID?>'); return false">DELETE</a>
			<? } ?>			</td>
      </tr>
      <?
			  $iG++;
			  $mNilai = $mNilai + $mRo['Nilai'];
			  $mNilP  = $mNilP + $NilP;
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
		else
		{
		?>
      <tr> 
        <td></td>
        <td colspan="5">Data tidak ditemukan..!!</td>
        <td colspan="2">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <?
		}
		?>
      <tr height="30" style="font-weight:bold">
        <td colspan="4" style="border-top:#999 solid 1px; border-bottom:#999 dotted 1px; border-right:#999 dotted 1px; text-align:center">T o t a l</td>
        <td align="right" style="border-top:#999 solid 1px; border-bottom:#999 dotted 1px; border-right:#999 dotted 1px; padding-right:3px"><?=fConvertToRupiah($mNilai)?></td>
        <td style="border-top:#999 solid 1px; border-bottom:#999 dotted 1px; border-right:#999 dotted 1px">&nbsp;</td>
        <td colspan="4" style="border-top:#999 solid 1px; border-bottom:#999 dotted 1px; border-right:#999 dotted 1px; text-align:center">T o t a l</td>
        <td align="right" style="border-top:#999 solid 1px; border-bottom:#999 dotted 1px; border-right:#999 dotted 1px; padding-right:3px"><?=fConvertToRupiah($mNilP)?></td>
        <td style="border-top:#999 solid 1px; border-bottom:#999 dotted 1px; border-right:#999 dotted 1px">&nbsp;</td>
      </tr>
    </table>
          <!-- Pagging -->
          <?
		  CallConnection(DatabaseSB,$ConSB);
			//$nSQL= "SELECT COUNT(*) AS JmlRc FROM ta_pengadaan WHERE Tanggal LIKE '".$gThn."-%-%' AND Kd_Unit LIKE '".$zUnt."' ".$fFindSy;
			
			$nSQL= "SELECT COUNT(*) AS JmlRc FROM ta_pengadaan P1 LEFT JOIN ta_penerimaan_berkas P2 ON P2.Nomor=P1.No_Berkas 
			WHERE P2.Kd_Kegiatan LIKE '$SyTKG' AND P2.Kd_Rek13 LIKE '$SyTRK' 
			AND P1.Kd_Aset_108 LIKE '".$gAst."%' 
			AND P1.Tanggal LIKE '".$gThn."-%-%' AND P1.Kd_Unit LIKE '".$zUnt."' ".$fFindSy;
			$fUlrR= "FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&gAst=".$gAst."&gFin=".$gFin."&gThn=".$gThn."&gPR=".$gPR."&gKG=".$gKG."&gRK=".$gRK."&gUnt=".$zUnt."&";
			include "FilePagingBot_Pengadaan.php";
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
	
	function P_DeleteR(DelT,xA,xR,uid)
	{
		if (DelT!="") {window.alert('Access denied, data sudah digunakan di input aset..!!'); return false;}
		
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
					<?
						$URL_Top = "Pengadaan_Top.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'];
						$URL_Mid = "Pengadaan_Mid.php?gUnt=".$zUnt."&gSub=".$zSub."&gUpb=".$zUpb."&gBid=".$zBid."&IdL=".$_GET['IdL'];
						$URL_Bot = "Pengadaan_Bot.php";
					?>       			
       			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormPNG_Top' noresize src='<? echo $URL_Top?>' scrolling='no'><frame name='WinFormPNG_Mid' src='<? echo $URL_Mid?>' scrolling='auto'><frame name='WinFormPNG_Bot' src= '<? echo $URL_Bot?>' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>"
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
			URL_Top = "Pengadaan_Top.php?"+"<?="FrmG=".$_GET['FrmG']?>";
			URL_Mid = "Pengadaan_Mid.php?gIdT="+IDT+"<?="&IdL=".$_GET['IdL']?>";
			URL_Bot = "Pengadaan_Bot.php";
			txtHTML = "<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormPNG_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormPNG_Mid' src='"+URL_Mid+" scrolling='auto'><frame name='WinFormPNG_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes></noframes></frameset></html>";
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
</script>
