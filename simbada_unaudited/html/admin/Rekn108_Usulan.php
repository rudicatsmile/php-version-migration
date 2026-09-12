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
</head>
<?
extract($_GET);
$gHR  = 1;     //fGetDate('mday');
$gBL  = 1;     //fGetDate('mon');
$gTH  = 2019;  //fGetDate('year');
$gHRd = fGetDate('mday');
$gBLd = fGetDate('mon');
$gTHd = fGetDate('year');

if ($gUNT==""){
	$gUNT="24.04.01.01";
}

if ($Lev > 1){
	$gUNT = substr($SkP,0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
}
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="Invent_Usulan_Veri_Frm_.php?IdL=".$_GET['IdL']?>">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
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
    <td><select class="boxs" name="fHR" tabindex="0" style="width:50px" onclick="RefreshDATA('<?=$IdL?>')">
      <?
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gHR) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="fBL" tabindex="0" style="width:95px" onclick="RefreshDATA('<?=$IdL?>')">
	<?
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBL) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTH" style="width: 60px" tabindex="0" onclick="RefreshDATA('<?=$IdL?>')">
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
	<? if ($Lev <= 1) {?>
		<select class="boxs" name="fUNT" tabindex="0" style="width:496px" onchange="RefreshDATA('<?=$IdL?>')">
		  <option value="ALL">ALL</option>
		  <?
			$nSQ="SELECT kd_unit, nm_unit FROM ref_unit ORDER BY kd_unit";
			$nRs = mysql_query($nSQ);
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				$sel ="";
				if ($mRo[0]==$gUNT) {$sel ="selected";}
				if ($mRo[0]=="24.04.07.03"){
					echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".substr($mRo[1],0,70).'....</option>';
				}
				else{
					echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".$mRo[1].'</option>';
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
      <select class="boxs" name="fHRd" tabindex="0" style="width:50px" onclick="RefreshDATA('<?=$IdL?>')">
        <?
	for($i=1; $i<=31; $i++)
	{
		$sel ="";
		if ($i==$gHRd) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
      </select>
      <select class="boxs" name="fBLd" tabindex="0" style="width:95px" onclick="RefreshDATA('<?=$IdL?>')">
        <?
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBLd) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
      </select>
      <select class="boxs" name="fTHd" tabindex="0" style="width:60px" onclick="RefreshDATA('<?=$IdL?>')">
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
    <td><span style="padding-right:5px">
      <input name="fFnD" type="text" value="" onkeypress="if (event.keyCode==13) {RefreshDATA('<?=$IdL?>'); return false;}" style="padding-left:5px; width:140px; border: 1px solid #C0C0C0"/>
      <input type="button" name="B39" value="GO" onclick="RefreshDATA('<?=$IdL?>')" style="width: 40px; height: 21px" />
    </span></td>
    <td>&nbsp;</td>
    <td style="padding-right:5px"><div style="float:right">
	  <!--input type="button" name="B14" value="CETAK" onclick="showDOC('1','800','400','<?=$_GET['IdL']?>')" style="width: 100px; height: 21px; color:#0000FF" />
	  <input type="button" name="B14" value="CETAK RINCI" onclick="showDOC('2','800','400','<?=$_GET['IdL']?>')" style="width: 100px; height: 21px; color:#0000FF" /-->
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
  <tr>
    <td width="32" align="center" style="border-right:1px #999 solid">NO</td>
    <td width="81" align="center" style="border-right:1px #999 solid">TANGGAL</td>
    <td width="120" align="center" style="border-right:1px #999 solid">REFERENSI</td>
    <td width="118" align="center" style="border-right:1px #999 solid">NOMOR</td>
    <td width="300" align="center" style="border-right:1px #999 solid">SKPD</td>
    <td width="160" align="center" style="border-right:1px #999 solid">NOMOR DOKUMEN</td>
    <td width="87" align="center" style="border-right:1px #999 solid">TGL.DOC</td>
    <td width="100" align="center" style="border-right:1px #999 solid">NILAI</td>
    <td align="center" width="180" style="border-right:1px #999 solid">ACTION</td>
    <td align="center">STATUS</td>
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
	
	function RefreshDATA(IdL)
	{
		var gUnT = objfrm.fUNT.value;
		var gHR  = objfrm.fHR.value;
		var gBL  = objfrm.fBL.value;
		var gTH  = objfrm.fTH.value;
		var gHRd = objfrm.fHRd.value;
		var gBLd = objfrm.fBLd.value;
		var gTHd = objfrm.fTHd.value;
		var gFnD = ReplaceText(objfrm.fFnD.value);
		//$(document).ready(function()
		//{
		//	$("#ViewDATA").load('Invent_Usulan_Data.php?gUnT='+gUnT+'&gHR='+gHR+'&gBL='+gBL+'&gTH='+gTH+'&gHRd='+gHRd+'&gBLd='+gBLd+'&gTHd='+gTHd+'&gFnD='+gFnD+'&IdL='+IdL);
		//});
		
		$(document).ready(function()
		{
			$.ajax({
				url:"Rekn108_Usulan_Data.php",
				data: {gUnT:gUnT,gHR:gHR,gBL:gBL,gTH:gTH,gHRd:gHRd,gBLd:gBLd,gTHd:gTHd,gFnD:gFnD,IdL:IdL},
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
	
	function showEDIT(IdT,IdL)
	{
		window.open('Rekn108_Usulan_Frm.php?IdT='+IdT+'&IdL='+IdL,'_self');
	}
	
	function P_Dokumen(w,h,IdT,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='Rekn108_Usulan_Frm_Data_Dok_Rinci.php?IdT='+IdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function showDOC(pil,w,h,IdL)
	{
		var gUNT = objfrm.fUNT.value;;
		
		var HR1 = objfrm.fHR.value;
		var BL1 = objfrm.fBL.value;
		var TH1 = objfrm.fTH.value;
		
		var HR2 = objfrm.fHRd.value;
		var BL2 = objfrm.fBLd.value;
		var TH2 = objfrm.fTHd.value;
		
		Today = new Date();
		
		var HR3 = Today.getDay();
		var BL3 = Today.getMonth();
		var TH3 = Today.getFullYear();
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='Rekn108_Usulan_Frm_Data_Dok_'+pil+'.php?gUNT='+gUNT+'&JeNS='+JeNS+'&HR1='+HR1+'&HR2='+HR2+'&HR3='+HR3+'&BL1='+BL1+'&BL2='+BL2+'&BL3='+BL3+'&TH1='+TH1+'&TH2='+TH2+'&TH3='+TH3+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
		//closeCLICK('choise');
	}
	
	function showDELE(IdT,Cek,IdL)
	{
		//if (Cek=='NoDelA'){alert('Access denied, transaksi usulan sudah dieksekusi..!!'); return false;}
		//if (Cek=='NoDelS'){alert('Access denied, transaksi usulan sudah dieksekusi sebagian..!!'); return false;}
		
		var AN = confirm("Hapus transaski usulan ini ..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$.ajax({
					url:"Rekn108_Usulan_Data_Dell.php",
					data: {IdT:IdT,IdL:IdL},
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
	}
</script>