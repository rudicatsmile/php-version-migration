<?
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";
#echo base64_decode(base64_decode("TVRJek5EVTI="));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="global.js"></script>
</head>
<?
if (isset($_GET['gUnt'])) {$gUnt = $_GET['gUnt'];}
if (isset($_GET['gThn'])) {$gThn = $_GET['gThn'];}
if (isset($_GET['gAst'])) {$gAst = $_GET['gAst'];}
if ($gThn=="") {$gThn  = fGetDate('year')-1;}
if (isset($_GET['MsG'])) {$MsG = $_GET['MsG'];} else {$MsG="";}
$rHri = date('d');
$rBln = date('m');
$rThn = date('Y');
$gX = fGetDate('year');
$gSst="THN";
?>
<body onload="P_Mess('<?=$MsG?>')">
<form name="myfrm" method="post" action="<?php echo "Open_KKM_Mid_108_.php?IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Simpan">
  <table border="0" align="center" style="width:700px">
    <tr>
      <td width="23">&nbsp;</td>
      <td width="113">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    
    <tr>
      <td>&nbsp;</td>
      <td>Referensi</td>
      <td colspan="2"><input type="text" name="fRef" id="fRef" style="width:120px" onKeyPress="if (event.keyCode==13) {B01.click();}"/></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>Unit Kerja </td>
      <td colspan="2"> 
        <select name="fUnt" id="fUnt" tabindex="0" style="width: 420px" onchange="fCariDATA('CrSub','fUnt','fSub','fUpb')">
		<!--option value="All">All</option-->
        <?
		//$Lev = 2;
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
				$mRoNm = $mRo['Nm_Unit'];
				if (strlen($mRoNm)>50){
					$mRoNm = substr($mRoNm,0,50)."....";
				}
				
				if ($mRo['Kd_Unit']==$gUnt) 
				{
				$sel ="selected";
				$gUnt=$mRo['Kd_Unit'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Unit'].'">'.$mRo['Kd_Unit']." : ".strtoupper($mRoNm).'</option>';
				#echo '<option '.$sel.' value="'.$mRo['Kd_Unit'].'">'.strtoupper($mRoNm).'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select> </td>
    </tr>
    <!--tr>
      <td>&nbsp;</td>
      <td>SUB UNIT </td>
      <td colspan="2" valign="middle">
	  <select class="boxs" name="fSub" id="fSub" tabindex="0" style="width: 420px" onchange="fCariDATA('CrUpb','fSub','fUpb','')">
		<option value="All">All</option> 
          <?
		if ($Lev <=3 ) {$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".__' ORDER BY Kd_Sub";}
		else {$nSQ = "SELECT Kd_Sub, Nm_Sub FROM ref_sub_unit WHERE Kd_Sub LIKE '".$gUnt.".".substr($SkP,12,2)."' ORDER BY Kd_Sub";}
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			#if ($gSub=="") {$gSub=$mRo['Kd_Sub'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Sub']==$gSub) 
				{
				$sel ="selected";
				$zSub=$mRo['Kd_Sub'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Sub'].'">'.strtoupper($mRo['Nm_Sub']).'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select>	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>UPB</td>
      <td colspan="2" valign="middle">
	  <select class="boxs" name="fUpb" id="fUpb" tabindex="0" style="width: 420px">
		<option value="All">All</option> 
         <?
		$nSQ = "SELECT Kd_Upb, Nm_Upb FROM ref_upb WHERE Kd_Upb LIKE '".$gUnt.".".substr($gSub,12,2).".___' GROUP BY Kd_Upb";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			#if ($gUpb=="") {$gUpb = $mRo['Kd_Upb'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Upb']==$gUpb) 
				{
				$sel ="selected";
				$zUpb=$mRo['Kd_Upb'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Upb'].'">'.strtoupper($mRo['Nm_Upb']).'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
        </select>	  </td>
    </tr-->
    <tr>
      <td>&nbsp;</td>
      <td>Aset</td>
      <td colspan="2" valign="middle">
	  <select class="boxs" name="fAst" id="fAst" style="width: 320px" tabindex="0" onchange="changeTHN()">
        <option value="1.3.2" <? if ($gAst=="1.3.2") {echo "selected";}?>>KIB-B (1.3.2 -
          <?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset","1.3.2","=","",DatabaseSB,$ConSB,""))?>
          )</option>
        <option value="1.3.3" <? if ($gAst=="1.3.3") {echo "selected";}?>>KIB-C (1.3.3 -
          <?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset","1.3.3","=","",DatabaseSB,$ConSB,""))?>
          )</option>
        <option value="1.3.4" <? if ($gAst=="1.3.4") {echo "selected";}?>>KIB-D (1.3.4 -
          <?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset","1.3.4","=","",DatabaseSB,$ConSB,""))?>
          )</option>
        <option value="1.3.5" <? if ($gAst=="1.3.5") {echo "selected";}?>>KIB-E (1.3.5 -
          <?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset","1.3.5","=","",DatabaseSB,$ConSB,""))?>
          )</option>
        <option value="1.5.3" <? if ($gAst=="1.5.3") {echo "selected";}?>>KIB-J (1.5.3 -
          <?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset","1.5.3","=","",DatabaseSB,$ConSB,""))?>
          )</option>
        <option value="1.5.4" <? if ($gAst=="1.5.4") {echo "selected";}?>>KIB-G (1.5.4 -
          <?=strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset","1.5.4","=","",DatabaseSB,$ConSB,""))?>
          )</option>
      </select></td>
    </tr>
	<?
	$eCKa = "checked";
	$eCKb = "";
	?>
    <tr height="20">
      <td>&nbsp;</td>
      <td>Data</td>
      <td colspan="2" valign="middle">
	  <label><input name="radiobutton" type="radio" value="N" <?=$eCKa?> />NON EXTRACOM</label>&nbsp;&nbsp;&nbsp;
	  <label><input name="radiobutton" type="radio" value="Y" <?=$eCKb?> />EXTRACOM</label>	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>PENYUSUTAN</td>
      <td colspan="2" valign="middle">
	  <select class="boxs" name="fSst" id="fSst" style="width: 120px" tabindex="0">
        <option value="BLN" <? if ($gSst=="BLN") {echo "selected";}?>>PERBULAN</option>
        <!--option value="THN" <? if ($gSst=="THN") {echo "selected";}?>>PERTAHUN</option-->
      </select></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>THN. PELAPORAN</td>
      <td valign="middle"><select class="boxs" name="fThn" id="fThn" style="width: 60px; background:#FFFF99" tabindex="0">
        <?
			for($nThn=2013; $nThn<=($rThn+1); $nThn++)
			{
				$sel ="";
				if ($gThn==$nThn) {$sel ="selected";}
				echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
      </select>
      <input type="hidden" name="B02" value="NEXT" onclick="nextEXE('<?=$_GET['IdL']?>')"  style="width: 60px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />      </td>
      <td valign="middle"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>TANGGAL CETAK</td>
      <td colspan="2" valign="middle">
	  <select class="boxs" name="fHriC" tabindex="0" style="width:50px">
        <?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$rHri) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
      </select>
		&nbsp;
		<select class="boxs" name="fBlnC" tabindex="0" style="width:100px">
  		<?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$rBln) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		&nbsp;
		<select class="boxs" name="fThnC" tabindex="0" style="width:60px">
  		<?
		for($nThn<= date('Y')+1; $nThn>=2010; $nThn--)
		{
			$sel ="";
			if ($nThn==$rThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>		</td>
    </tr>
    <tr height="20px"> 
      <td colspan="4" valign="middle" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"></td>
      <td valign="top"><input type="button" name="B01" id="B01" value="REKAP" onclick="execFORM('<?=$ReO?>','<?=$_GET['IdL']?>')"  style="width: 100px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
      <td ondblclick="P_Rekap('1','850','450','3','','<?=$_GET['IdL']?>')">
	  <div id="loadingImg" style="width:0px; height:0px; display:none; vertical-align:middle; text-align:center"><img src="Images/loading3.gif" alt="" width="50" height="50"></div>	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"></td>
      <td valign="top">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td align="center"></td>
      <td width="313" valign="top">
	  <a href="#" class="ico prev" onclick="P_Rekap('','850','450','1','','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( KIB )</a><br>
	  <a href="#" class="ico prev" onclick="P_Rekap('1','850','450','2','','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( KIB ALL - BIDANG)</a><br>
	  <a href="#" class="ico prev" onclick="P_Rekap('2','850','450','2','','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( KIB ALL - KELOMPOK)</a><br> 
	  <a href="#" class="ico prev" onclick="P_Rekap('3','850','450','2','','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( KIB ALL - JENIS)</a><br>
	  <a href="#" class="ico prev" onclick="P_Rekap('4','850','450','2','','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( KIB ALL - OBJEK)</a><br>
	  <a href="#" class="ico prev" onclick="P_Rekap('5','850','450','2','','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( KIB ALL - R.OBJEK)</a>	  </td>
      <td width="233">
	  <!--a href="#" class="ico prev" onclick="P_RekapX('','850','450','1','_mutasi','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( Ke Aset Lainnya )#</a><br>
	  <a href="#" class="ico prev" onclick="P_RekapX('1','850','450','2','_mutasi','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( Ke Aset Lainnya - BIDANG)#</a><br>
	  <a href="#" class="ico prev" onclick="P_RekapX('2','850','450','2','_mutasi','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( Ke Aset Lainnya - KELOMPOK)#</a><br> 
	  <a href="#" class="ico prev" onclick="P_RekapX('3','850','450','2','_mutasi','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( Ke Aset Lainnya - JENIS)#</a><br>
	  <a href="#" class="ico prev" onclick="P_RekapX('4','850','450','2','_mutasi','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( Ke Aset Lainnya - OBJEK)#</a><br>
	  <a href="#" class="ico prev" onclick="P_RekapX('5','850','450','2','_mutasi','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( Ke Aset Lainnya - R.OBJEK)#</a-->	  </td>
    </tr>
    <tr>
      <td colspan="4" valign="middle" align="center"><div style="color:#FF0000; height:40px; width:100%" id="formDiv2Exec"></div></td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Rekap(crt,w,h,nm,mts,IdL)
	{
		var gHriC = objfrm.fHriC.value;
		var gBlnC = objfrm.fBlnC.value;
		var gThnC = objfrm.fThnC.value;
		
		var rAS = objfrm.fAst.value;
		var rTH = objfrm.fThn.value;
		
		var uNT = objfrm.fUnt.value;
		var uSU = "All";//objfrm.fSub.value;
		var uUP = "All";//objfrm.fUpb.value;
		
		Len = objfrm.radiobutton.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.radiobutton[i].checked) {ExtR = objfrm.radiobutton[i].value; break; }
		}
		
		if (nm=='1') {nmF="Tabel_Masa_Manfaat_Rekap_Tahun";}
		if (nm=='2') {nmF="Tabel_Masa_Manfaat_Rekap_Tahun_All";}
		if (nm=='2_bdg') {nmF="Tabel_Masa_Manfaat_Rekap_Tahun_All_Bidang";}
		if (nm=='3') {nmF="Tabel_Masa_Manfaat_Rekap_Tahun_All_Skp";}
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(nmF+'.php?ExtR='+ExtR+'&mts='+mts+'&crt='+crt+'&gHriC='+gHriC+'&gBlnC='+gBlnC+'&gThnC='+gThnC+'&uNT='+uNT+'&uSU='+uSU+'&uUP='+uUP+'&rTH='+rTH+'&rAS='+rAS+'&IdL='+IdL,'',settings);
	}
	
	function P_Proses()
	{
		var Th = objfrm.fThn.value;
		var Tx = objfrm.fAst.value;
		if (Tx=='02') {Tx='KIB-B';}
		if (Tx=='03') {Tx='KIB-C';}
		if (Tx=='04') {Tx='KIB-D';}
		if (Tx=='05') {Tx='KIB-E';}
		var AN = confirm("Rekep data tahun "+Th+"..?!!");
		if (AN)
		{
			alert('Silahkan tunggu beberapa saat sampai pemberitahuan berikutnya..!!');
			objfrm.Simpan.value = "Repair";
			objfrm.submit();
		}
	}

	function P_Mess(MsG)
	{
		if (MsG) {alert(MsG); return false;}
	}
	
	function execFORM(ReO,IdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		Ref = $("#fRef").val();
		Unt = $("#fUnt").val();
		Thn = $("#fThn").val();
		Ast = $("#fAst").val();
		Sst = $("#fSst").val();
		
		if (Ast=='1.3.2') {Tx='KIB-B';}
		if (Ast=='1.3.3') {Tx='KIB-C';}
		if (Ast=='1.3.4') {Tx='KIB-D';}
		if (Ast=='1.3.5') {Tx='KIB-E';}
		if (Ast=='1.5.3') {Tx='KIB-J';}
		if (Ast=='1.5.4') {Tx='KIB-G';}
		
		Len = objfrm.radiobutton.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.radiobutton[i].checked) {ExtR = objfrm.radiobutton[i].value; break; }
		}						
		
		SmP = "Repair";
		var AN = confirm("Lanjutkan proses penyusutan perbulan "+Tx+" tahun "+Thn+"..?!!");
		if (AN)
		{
			pFr = 2;
			tProses = "Open_KKM_Mid_108_Blg_.php";
			
			if (pFr == 1)
			{
				$(document).ready(function()
				{
					$("#loadingImg").hide();
					$("#formDiv2Exec").load(tProses+'?Simpan='+SmP+'&fRef='+Ref+'&fUnt='+Unt+'&fThn='+Thn+'&fAst='+Ast+'&Sst='+Sst+'&ExtR='+ExtR+'&IdL='+IdL);
				});
			}
			else
			{
				$(document).ready(function()
				{
					$.ajax({
						url:tProses,
						data: {Simpan:SmP,fRef:Ref,fUnt:Unt,fThn:Thn,fAst:Ast,Sst:Sst,ExtR:ExtR,IdL:IdL},
						type:"get",
						beforeSend:function()
						{
							$("#formDiv2Exec").text('');
							$("#loadingImg").show();
						},
						success:function(data)
						{
							$("#loadingImg").hide();
							$("#formDiv2Exec").html(data);
							//$("#formDiv2Exec").text("Proses rekap "+Tx+" tahun "+Thn+" selesai..!!");
						}
					});
				});
			}
		}
	}
	
	function changeTHN()
	{
		objfrm.fThn.value=2013;
	}
	
	function nextEXE(IdL)
	{
		OlD = objfrm.fThn.value;
		NeW = parseInt(OlD)+1;
		alert(NeW); return false;
		if (NeW > 2017){
			alert('Sementara hanya s.d tahun 2017..!!'); return false;
		}
		else{
			objfrm.fThn.value=NeW;
			execFORM(IdL);
		}
	}
</script>
