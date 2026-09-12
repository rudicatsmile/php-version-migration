<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
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
extract($_GET);
#$Lev =2;
$gHR  = 1;     //fGetDate('mday');
$gBL  = 1;     //fGetDate('mon');
$gTH  = fGetDate('year');
$gHRd = 31;    //fGetDate('mday');
$gBLd = 12;    //fGetDate('mon');
$gTHd = fGetDate('year');
$gJNS = "AA";

if ($gUNT==""){
	$gUNT="24.04.01.01";
}

if ($Lev > 1){
	$gUNT = substr($SkP,0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
}
?>
<body onload="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="Penghapusan_Usulan.php?IdL=".$_GET['IdL']?>">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; color:#fff; background:#79a86a">
  <tr>
    <td width="20">&nbsp;</td>
    <td width="91">&nbsp;</td>
    <td width="16">&nbsp;</td>
    <td width="223">&nbsp;</td>
    <td width="93">&nbsp;</td>
    <td width="18">&nbsp;</td>
    <td width="209">&nbsp;</td>
    <td width="35">&nbsp;</td>
    <td width="586">&nbsp;</td>
    </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">TANGGAL</td>
    <td align="center">&nbsp;</td>
    <td><select class="boxs" name="fHR" tabindex="0" style="width:50px" onchange="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')">
      <?
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gHR) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="fBL" tabindex="0" style="width:95px" onchange="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')">
	<?
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBL) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTH" style="width: 60px" tabindex="0" onchange="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')">
 	<?
	for($i=2014; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select></td>
    <td align="right"> UNIT KERJA </td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<? 
	if ($Lev <= 1) {?>
		<select class="boxs" name="fUNT" tabindex="0" style="width:496px" onchange="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')">
		  <option value="ALL">ALL</option>
		  <?
			$nSQ="SELECT kd_unit, nm_unit FROM ref_unit ORDER BY kd_unit";
			$nRs = mysql_query($nSQ);
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				$sel ="";
				if ($mRo[0]==$gUNT) {$sel ="selected";}
				
				$mRo1 = strlen($mRo[1]);
				if ($mRo1>70){$mRo1 = substr($mRo[1],0,70)."...";} else {$mRo1 = $mRo[1];}
				
				if ($mRo[0]=="24.04.07.03"){
					echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".$mRo1.'</option>';
				}
				else{
					echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".$mRo1.'</option>';
				}
			}
			?>
		</select>
    <? } else {?>
	<input name="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" type="text" value="<?=$dUNT?>" readonly style="padding-left:5px; width:406px; border: 1px solid #C0C0C0"/>
    <? } ?>	</td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">S.D TANGGAL </td>
    <td align="center">&nbsp;</td>
    <td>
	<!--div id="formMstVeri" class="findaset0Veri" style="background-color: #C9DCD8">
		<div id="formDiv1Veri" class="findaset1Veri"></div>
		<div id="formDiv2Veri" class="findaset2Veri" style="background-color: #C9DCD8"></div>
	</div>	
	<div id="formMstExec" class="findaset0Veri" style="background-color: #C9DCD8">
		<div id="formDiv1Exec" class="findaset1Veri"></div>
		<div id="formDiv2Exec" class="findaset2Veri" style="background-color: #C9DCD8"></div>
	</div>	
	<div id="editMstVeri" class="findaset0Veri" style="background-color: #C9DCD8; height:450px; width:900px; top:51px; left:200px">
		<div id="editDiv1Veri" class="findaset1Veri" style="width:900px"></div>
		<div id="editDiv2Veri" class="findaset2Veri" style="background-color: #C9DCD8; height:410px; width:900px"></div>
	</div-->	
      <select class="boxs" name="fHRd" tabindex="0" style="width:50px" onchange="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')">
        <?
	for($i=1; $i<=31; $i++)
	{
		$sel ="";
		if ($i==$gHRd) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
      </select>
      <select class="boxs" name="fBLd" tabindex="0" style="width:95px" onchange="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')">
        <?
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBLd) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
      </select>
      <select class="boxs" name="fTHd" tabindex="0" style="width:60px" onchange="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')">
        <?
	for($i=2014; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTHd) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
      </select></td>
    <td align="right">FIND</td>
    <td align="center">&nbsp;</td>
    <td><input name="fFnD" id="fFnD" type="text" value="" onkeypress="if (event.keyCode==13) {RefreshDATA('<?=$FrmG?>','<?=$IdL?>'); return false;}" style="padding-left:5px; width:200px; border: 1px solid #C0C0C0"/></td>
    <td><input type="button" name="B39" value="GO" onclick="RefreshDATA('<?=$FrmG?>','<?=$IdL?>')" style="width: 40px; height: 21px" /></td>
    <td style="padding-right:5px"><div style="float:right">
	  <input type="hidden" name="B14" value="CETAK" onclick="showDOC('1','800','400','<?=$_GET['IdL']?>')" style="width: 100px; height: 21px; color:#0000FF" />
	  <input type="hidden" name="B14" value="CETAK RINCI" onclick="showDOC('2','800','400','<?=$_GET['IdL']?>')" style="width: 100px; height: 21px; color:#0000FF" />
	  </div>	  </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
	<!--div id="imgMstCri" class="upload_a">
		<div id="imgDiv1Cri" class="upload_b"></div>
		<div id="imgDiv2Cri" class="upload_c"></div>
	</div-->	</td>
    <td align="center"><div id="loadingImg" style="width:40px; height:10px; display:none; text-align:center"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #C9DCD8; font-weight:bold">
  <tr style="text-align:center">
    <td width="29" style="border-right: 1px solid #999">N.</td>
    <td width="146" style="border-right: 1px solid #999">Nomor/No. Berkas</td>
    <td width="70" style="border-right: 1px solid #999">Tanggal</td>
    <td width="70" style="border-right: 1px solid #999">Tgl. Cair</td>
    <td width="70" style="border-right: 1px solid #999">No.BKU</td>
    <td width="397" style="border-right: 1px solid #999; padding-left:3px">Program, Kegiatan, Rekening
	<div id="rekoMstDiv0" class="data0Reko">
		<div id="rekoMstDiv1" class="data1Reko"></div>
		<div id="rekoMstDiv2" class="data2Reko"></div>
	</div>	
	</td>
    <td width="250" style="border-right: 1px solid #999">Uraian</td>
    <td width="110" style="border-right: 1px solid #999">Nilai</td>
    <td width="110" style="border-right: 1px solid #999">Nilai Cair</td>
    <td style="border-right: 1px solid #999">Action</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:390px">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:0px; overflow:auto"></div>
	<div id="ViewDATA" style="height:390px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; height:20px; background-color:#D2DAC4">
  <tr>
    <td valign="top">
	</td>
  </tr>
</table>
</form>
</body>
</html>
<script languange="javascript">
	var objfrm=document.myfrm;
	function ReplaceText(gFnD)
	{
		for (i=1; i<=100; i++)
		{
			gFnD = gFnD.replace(' ','**');
		}
		return gFnD;
	}
	
	function closeCLICK(crt,IdL)
	{
		document.getElementById(crt+'MstVeri').style.display = "none";
		if (crt=='form') {RefreshDATA(IdL);}
	}
	
	function RefreshDATA(FrmG,IdL)
	{
		gJNS = "";
		gUnT = objfrm.fUNT.value;
		gHR  = objfrm.fHR.value;
		gBL  = objfrm.fBL.value;
		gTH  = objfrm.fTH.value;
		gHRd = objfrm.fHRd.value;
		gBLd = objfrm.fBLd.value;
		gTHd = objfrm.fTHd.value;
		gFnD = ReplaceText(objfrm.fFnD.value);
		
		$(document).ready(function()
		{
			$.ajax({
				url:"Rekon_Pengadaan_Data.php",
				data: {FrmG:FrmG,gUnT:gUnT,gHR:gHR,gBL:gBL,gTH:gTH,gHRd:gHRd,gBLd:gBLd,gTHd:gTHd,gFnD:gFnD,IdL:IdL},
				type:"get",
				beforeSend:function()
				{
					$("#loadingImg").show();
				},
				success:function(data)
				{
					$("#loadingImg").hide();
					$("#ViewDATA").html(data);
					$("#ViewDATA").show("fast");
				}
			});
		});
		
	}
	
	function P_DokumenX(w,h,IdT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='Penghapusan_Usulan_Frm_Data_Dok_Rinci.php?IdT='+IdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function showRECO(CrT,Ref,IdT,IdL)
	{
		
		//alert(CrT+':'+Ref+':'+IdT+':'+IdL);// return false;
		if (CrT=='refr')
		{
			$(document).ready(function()
			{
				//alert(CrT+':'+Ref+':'+IdT+':'+IdL);// return false;
				$("#rekoMstDiv2").load('Rekon_Pengadaan_Data_Mid.php?Ref='+Ref+'&IdT='+IdT+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('rekoMstDiv2');
			
			$(document).ready(function()
			{
				$("#rekoMstDiv1").load('Rekon_Pengadaan_Data_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#rekoMstDiv2").load('Rekon_Pengadaan_Data_Mid.php?Ref='+Ref+'&IdT='+IdT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('rekoMstDiv0');
		}
	}
	
	function saveRECO(Ref,IdT,IdL)
	{
		fRa = $("#fRa").val();
		fRb = $("#fRb").val();
		fRc = $("#fRc").val();
		
		fBK = ReplaceText($("#fBK").val());
		fNI = $("#fNI").val();
		
		//alert(Ref+':'+IdT+':'+IdL); return false;
		$(document).ready(function()
		{
			$("#rekoMstDiv2").load('Rekon_Pengadaan_Data_Save.php?fRa='+fRa+'&fRb='+fRb+'&fRc='+fRc+'&fBK='+fBK+'&fNI='+fNI+'&Ref='+Ref+'&IdT='+IdT+'&IdL='+IdL);
		});
	}
</script>