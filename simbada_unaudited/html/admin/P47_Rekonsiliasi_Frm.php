<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
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
<?
extract($_GET);

$g02a = date('d'); 
$g02b = date('m'); 
$g02c = date('Y'); 

$g02ax = "00";
$g02bx = "00";
$g02cx = "0000";

$gUNT = substr($SkP,0,11);
$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");

if ($model=='L1'){
	$Txt="LAPORAN BMD";
	$Fil="P47_Laporan_BMD";
}
else if ($model=='L2'){
	$Txt="LAPORAN PEROLEHAN BMD";
	$Fil="P47_Laporan_Perolehan_BMD";
}
else if ($model=='L3'){
	$Txt="LAPORAN PENERIMAAN INTERNAL BMD";
	$Fil="P47_Laporan_Penerimaan_Internal_BMD";
}
else if ($model=='L4'){
	$Txt="LAPORAN PENGELUARAN INTERNAL BMD";
	$Fil="P47_Laporan_Pengeluaran_Internal_BMD";
}
else if ($model=='L5'){
	$Txt="LAPORAN KOREKSI BMD";
	$Fil="P47_Laporan_Koreksi_BMD";
}
else if ($model=='L6'){
	$Txt="LAPORAN PENGHAPUSAN BMD";
	$Fil="P47_Laporan_Penghapusan_BMD";
}
else if ($model=='L7'){
	$Txt="LAPORAN PENYUSUTAN BMD";
	$Fil="P47_Laporan_Penyusutan_BMD";
}
else if ($model=='L8'){
	$Txt="LAPORAN PENAMBAHAN AKIBAT REKLAS";
	$Fil="P47_Laporan_Penambahan_Akibat_Reklas_BMD";
}
else if ($model=='L9'){
	$Txt="LAPORAN PENGURANGAN AKIBAT REKLAS";
	$Fil="P47_Laporan_Pengurangan_Akibat_Reklas_BMD";
}

$SvE = "Save";
$clr = "000";
$g01 = "XXXXX/RKO/".date('m')."/".date('Y'); 

if ($gID) 
{ 
    $nSQ = "SELECT IDT as A0,
	Nomor as A1,
	Tanggal as A2,
	KdSkpd as A3,
	PI_Nama as A4,
	PI_Nip as A5,
	PI_PangkatGol as A6,
	PI_Jabatan as A7,
	PII_Nama as A8,
	PII_Nip as A9,
	PII_PangkatGol as A10,
	PII_Jabatan as A11,
	Tanggal_BMD as A12,
	Model as A13 
    FROM tb_rekonsiliasi 
	WHERE IDT='$gID'"; 
	#echo $nSQ;
    $nRs = mysql_query($nSQ); 
    while ($mRo = mysql_fetch_array($nRs)) 
    { 
        $g01 = $mRo[1];
        $g02 = $mRo[2];
        $g02x= $mRo[12];
        $model= $mRo[13];
		
        $g02a= fDatePARSE($g02,'day'); 
        $g02b= fDatePARSE($g02,'month'); 
        $g02c= fDatePARSE($g02,'year'); 
        
		if ($g02x!='3000-01-01' && $g02x!='0000-00-00')
		{
			$g02ax= fDatePARSE($g02x,'day'); 
			$g02bx= fDatePARSE($g02x,'month'); 
			$g02cx= fDatePARSE($g02x,'year'); 
		}
		//echo $g02ax;
		$g02v = substr($mRo[3],0,11);
		
        $gP1Nma = $mRo[4];
        $gP1Nip = $mRo[5];
        $gP1Pkt = $mRo[6];
        $gP1Jab = $mRo[7];
		
        $gP2Nma = $mRo[8];
        $gP2Nip = $mRo[9];
        $gP2Pkt = $mRo[10];
        $gP2Jab = $mRo[11];
    }
} 

?>
<body>
<?php require "FileMenu.php";?>
<form name="myfrm" id="myfrm" method="POST" action="<?="P47_Rekonsiliasi_Frm_.php?gID=".$gID."&model=".$_GET['model']."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>">
<input type="hidden" name="CrSaveData" size="100" style="width: 100px"> 
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:800px">
  <tr>
    <td width="150">&nbsp;</td>
    <td width="15"></td>
    <td colspan="3"></td>
  </tr>
  <tr height="23">
    <td class="ar">Unit Kerja  </td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<input name="fUNT" id="fUNT" type="hidden" value="<?=$gUNT?>" readonly style="padding-left:3px; width:105px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" id="dUNT" type="text" value="<?=$dUNT?>" readonly <? if ($Lev <= 1) {?> onClick="showUNIT('','<?=$_GET['IdL']?>')" <? } else {echo "readonly";}?> style="padding-left:3px; width:450px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="Unit0Cri">
		<div id="unitDiv1Cri" class="Unit1Cri"></div>
		<div id="unitDiv2Cri" class="Unit2Cri"></div>
	</div>	</td>
  </tr>
  <tr height="23">
    <td align="right">Format</td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<select name="f03v" id="f03v" style="width:457px; height:20px; padding-left:2px" tabindex="1"> 
	<option value="00"></option>
	<option value="V1" <? if ($model=='V1'){echo "selected";}?>>Format V.1 ( <?=rekonsPh1('V1')." -> ".rekonsPh2('V1')?> )</option>
	<option value="V2" <? if ($model=='V2'){echo "selected";}?>>Format V.2 ( <?=rekonsPh1('V2')." -> ".rekonsPh2('V2')?> )</option>
	<option value="V3" <? if ($model=='V3'){echo "selected";}?>>Format V.3 ( <?=rekonsPh1('V3')." -> ".rekonsPh2('V3')?> )</option>
	<option value="V4" <? if ($model=='V4'){echo "selected";}?>>Format V.4 ( <?=rekonsPh1('V4')." -> ".rekonsPh2('V4')?> )</option>
	</select>	</td>
  </tr>
  <tr height="23">
    <td align="right">Nomor BA</td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<input type="text" name="f01" readonly value="<?=$g01?>" maxlength="100" style="width: 186px" tabindex="1" /></td>
  </tr>
  <tr height="23">
    <td align="right">Tanggal BA</td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<select name="f02a" style="width:45px; text-align:center" tabindex="1">
	<? 
	for ($iG=1; $iG<=31; $iG++) 
	{ 
		if ($g02a==$iG) {$gSL="selected";} else {$gSL="";} 
		echo "<option value='$iG' $gSL>".$iG."</option>"; 
	} 
	?>
  </select>
	<select name="f02b" style="width:85px; text-align:center" tabindex="1">
	  <? 
	for ($iG=1; $iG<=12; $iG++) 
	{ 
		if ($g02b==$iG) {$gSL="selected";} else {$gSL="";} 
		echo "<option value='$iG' $gSL>".fNmBulanLong($iG)."</option>"; 
	} 
	?>
	</select>
	<select name="f02c" style="width:58px; text-align:center" tabindex="1">
	  <? 
	for ($iG=2020; $iG<=date('Y'); $iG++) 
	{ 
		if ($g02c==$iG) {$gSL="selected";} else {$gSL="";} 
		echo "<option value='$iG' $gSL>".$iG."</option>"; 
	} 
	?>
	</select>	</td>
  </tr>
  <tr height="23">
    <td align="right">Tgl. Laporan BMD</td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<select name="f02ax" style="width:45px; text-align:center" tabindex="1">
	<option value="00"></option>
	<? 
	for ($iG=1; $iG<=31; $iG++) 
	{ 
		if ($g02ax==$iG) {$gSL="selected";} else {$gSL="";} 
		echo "<option value='$iG' $gSL>".$iG."</option>"; 
	} 
	?>
	</select>
	<select name="f02bx" style="width:85px; text-align:center" tabindex="1">
	<option value="00"></option>
	<? 
	for ($iG=1; $iG<=12; $iG++) 
	{ 
		if ($g02bx==$iG) {$gSL="selected";} else {$gSL="";} 
		echo "<option value='$iG' $gSL>".fNmBulanLong($iG)."</option>"; 
	} 
	?>
	</select>
	<select name="f02cx" style="width:58px; text-align:center" tabindex="1">
	<option value="0000"></option>
	<? 
	for ($iG=2020; $iG<=date('Y'); $iG++) 
	{ 
		if ($g02cx==$iG) {$gSL="selected";} else {$gSL="";} 
		echo "<option value='$iG' $gSL>".$iG."</option>"; 
	} 
	?>
	</select>	</td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr height="23">
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="3" style="font-weight:bold">PIHAK I : <?=rekonsPh1($model)?></td>
  </tr>
  <tr height="23">
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td width="120">Nama</td>
    <td width="23">:</td>
    <td width="490"><input type="text" name="fP1Nma" id="fP1Nma" value="<?=$gP1Nma?>" style="width:280px" tabindex="2" /></td>
  </tr>
  <tr height="23">
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>NIP</td>
    <td>:</td>
    <td><input type="text" name="fP1Nip" id="fP1Nip" value="<?=$gP1Nip?>" style="width:280px" tabindex="2" /></td>
  </tr>
  <tr height="23">
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>Pangkat / Gol. </td>
    <td>:</td>
    <td><input type="text" name="fP1Pkt" id="fP1Pkt" value="<?=$gP1Pkt?>" style="width:280px" tabindex="2" /></td>
  </tr>
  <tr height="23">
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>Jabatan</td>
    <td>:</td>
    <td><input type="text" name="fP1Jab" id="fP1Jab" value="<?=$gP1Jab?>" style="width:280px" tabindex="2" /></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr height="23">
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="3" style="font-weight:bold">PIHAK II : <?=rekonsPh2($model)?></td>
    </tr>
  <tr height="23">
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>Nama</td>
    <td>:</td>
    <td><input type="text" name="fP2Nma" id="fP2Nma" value="<?=$gP2Nma?>" style="width:280px" tabindex="2" /></td>
  </tr>
  <tr height="23">
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>NIP</td>
    <td>:</td>
    <td><input type="text" name="fP2Nip" id="fP2Nip" value="<?=$gP2Nip?>" style="width:280px" tabindex="2" /></td>
  </tr>
  <tr height="23">
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td>Pangkat / Gol. </td>
    <td>:</td>
    <td><input type="text" name="fP2Pkt" id="fP2Pkt" value="<?=$gP2Pkt?>" style="width:280px" tabindex="2" /></td>
  </tr>
  <tr height="8">
    <td></td>
    <td></td>
    <td>Jabatan</td>
    <td>:</td>
    <td><input type="text" name="fP2Jab" id="fP2Jab" value="<?=$gP2Jab?>" style="width:280px" tabindex="2" /></td>
  </tr>
  <tr height="8">
    <td></td>
    <td></td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr height="8">
    <td></td>
    <td></td>
    <td colspan="3"><input type="button" value="<?=$SvE?>"  onclick="P_Save()" name="B12" <?=$Dis?> style="width:80px; height:30px; color:#<?=$clr?>" tabindex="3" />
      <input type="button" value="Reset" onclick="P_Reset()" name="B1" style="width:80px; height:30px" tabindex="3" /></td>
  </tr>
  <tr height="8">
    <td></td>
    <td></td>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:800px; height:30px">
  <tr>  
    <td width="5">&nbsp;</td> 
    <td width="120"><a href="<?="P47_Rekonsiliasi.php?gUNT=".$gUNT."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>" class="ico docu" tabindex="4">&nbsp;&nbsp;Daftar Transaksi</a></td> 
    <td width="170"><a href="#" onClick="showDoc('Format_V1_V4','','<?=$gID?>','<?=$model?>','<?=$_GET['IdL']?>'); return false" class="ico docu" tabindex="4">&nbsp;&nbsp;P47 BA Rekon ( Format <?=$model?> )</a></td>
    <td width="210">
	<a href="#" onClick="showDoc('pilihlagi','AWAL','<?=$gID?>','<?=$model?>','<?=$_GET['IdL']?>'); return false" class="ico docu" tabindex="4">&nbsp;&nbsp;P47 BA Rekon Lampiran (Saldo Awal)</a></td>
    <td>
	<a href="#" onClick="showDoc('pilihlagi','AKHIR','<?=$gID?>','<?=$model?>','<?=$_GET['IdL']?>'); return false" class="ico docu" tabindex="4">&nbsp;&nbsp;P47 BA Rekon Lampiran (Saldo Akhir)</a></td>
  </tr> 
</table>
<br><br>
</form>
</body>
</html>
<script languange="javascript">
	objfrm=document.myfrm;
	
	function P_Save() 
	{
		f03v = $("#f03v").val();
		if (f03v=='00') {alert('Silahkan pilih Format Rekonsiliasi..!!'); return false;}
		objfrm.CrSaveData.value="Save"; 
		objfrm.submit(); 
	}
		 
	function P_Reset() 
	{ 
		objfrm.CrSaveData.value="Reset"; 
		objfrm.submit(); 
	}
	
	function showUNIT(CrT,IdL)
	{
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findUnT").val());
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('P47_Open_Laporan_Find_Unit_Mid.php?FnD='+FnD+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('unitDiv2Cri');
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('P47_Open_Laporan_Find_Unit_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('P47_Open_Laporan_Find_Unit_Mid.php?IdL='+IdL);
			});
			
			dispBlockOrNo('unitMstCri');
		}
	}
	

	function showCLICK(crt,kde,nma,IdL)
	{
		if (crt=='unit') 
		{
			$("#fUNT").val(kde);
			$("#dUNT").val(nma);
		
			$("#fSUB").val('00.00.00.00.00');
			$("#dSUB").val('ALL');
			
			$("#fUPB").val('00.00.00.00.00.000');
			$("#dUPB").val('ALL');
		}
		
		document.getElementById(crt+'MstCri').style.display = "none";
		
		$("#BtnGO").click();
	}
	
	function closeCLICK(crt)
	{
		document.getElementById(crt+'MstCri').style.display = "none";
	}
	
	function cariUPB(CrT,IdL)
	{
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findUpBA").val());
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('P47_Open_Laporan_Find_Upb_Mid_All.php?FnD='+FnD+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('upbDiv2Cri');
			$(document).ready(function()
			{
				$("#upbDiv1Cri").load('P47_Open_Laporan_Find_Upb_Top_All.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('P47_Open_Laporan_Find_Upb_Mid_All.php?IdL='+IdL);
			});
			
			dispBlockOrNo('upbMstCri');
		}
	}
	
	function leavejson(kde,IdL)
	{
		$(document).ready(function()
		{
			//alert('xx');
			$.post("P47_Open_Laporan_Find_Upb_Mid_All_Json.php",
			{"kde":kde,"IdL":IdL},
			function( data ) 
			{
				//alert(data['kdUnt']);
				$("#fUNT").val(data['kdUnt']);
				$("#dUNT").val(data['nmUnt']);
				
				$("#fSUB").val(data['kdSub']);
				$("#dSUB").val(data['nmSub']);
			},"json");
		});		
	}

	function formCetakDok(doc,w,h,IdL)
	{
		//alert(doc); return false;
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL= 'report/'+doc+'.php?IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=no,navigation=no';
		window.open(URL,'',settings);
	}
	
</script>