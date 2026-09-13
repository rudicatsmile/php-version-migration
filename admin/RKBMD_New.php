<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");

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
$gHR  = 1;     //fGetDate('mday');
$gBL  = 1;     //fGetDate('mon');
$gTH  = 2017;  //fGetDate('year');
$gHRd = 31;    //fGetDate('mday');
$gBLd = 12;    //fGetDate('mon');
$gTHd = 2017;  //fGetDate('year');
$gJNS = "AA";

$gUNT = substr($SkP,0,11);
$dUNT = strtoupper(fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","",""));

?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="Invent_Usulan_Veri_Frm_.php?IdL=".$_GET['IdL']?>">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td width="21">&nbsp;</td>
    <td width="74">&nbsp;</td>
    <td width="20">&nbsp;</td>
    <td width="75">&nbsp;</td>
    <td width="119">&nbsp;</td>
    <td width="39">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right"> UNIT KERJA. </td>
    <td align="center">&nbsp;</td>
    <td colspan="4">
	<?php 
	if ($Lev <= 1) {?>
		<select class="boxs" name="fUNT" id="fUNT" tabindex="0" style="width:496px" onchange="RefreshDATA('<?=$IdL?>')">
		  <option value="ALL">ALL</option>
		  <?php
			$nSQ="SELECT kd_unit, nm_unit FROM ref_unit WHERE aktif='Y' ORDER BY kd_unit";
			$nRs = mysql_query($nSQ);
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				$sel ="";
				if ($mRo[0]==$gUNT) {$sel ="selected";}
				echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper($mRo[1]).'</option>';
			}
			?>
		</select>
    <?php } else {?>
	<input name="fUNT" id="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" id="dUNT" type="text" value="<?=$dUNT?>" readonly style="padding-left:5px; width:406px; border: 1px solid #C0C0C0"/>
    <?php } ?>	</td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">PERIODE</td>
    <td align="center">&nbsp;</td>
    <td>
	
	<select class="boxs" name="fTHN" id="fTHN" tabindex="0" style="width:60px" onchange="RefreshDATA('<?=$IdL?>')">
	<?php
	$gTHN = fGetDate('year')+1;
	for ($i=2019; $i<=2030; $i++)
	{
		$sel ="";
		if ($i==$gTHN) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
    </select>	</td>
    <td><select class="boxs" name="fUBH" id="fUBH" tabindex="0" style="width:90px; background:#99FF00" onchange="RefreshDATA('<?=$IdL?>')">
      <option value="0">Murni</option>
      <option value="1">Perubahan</option>
    </select></td>
    <td>FIND</td>
    <td style="padding-right:5px">
	  <input name="fFnD" type="text" value="" onkeypress="if (event.keyCode==13) {RefreshDATA('<?=$IdL?>'); return false;}" style="padding-left:5px; width:200px; border: 1px solid #C0C0C0"/>
      <input type="button" name="b1" value="GO" onclick="RefreshDATA('<?=$IdL?>')" style="width: 40px; height: 21px" />
      <div style="float:right">
	  <input type="hidden" name="B2" value="CETAK" onclick="showDOC('','800','400','<?=$_GET['IdL']?>')" style="width: 100px; height: 21px; color:#0000FF" />
	  <input type="button" name="B3" value="EXPORT KE PERUBAHAN" disabled onclick="exportFORM('<?=$_GET['IdL']?>')" style="width: 140px; height: 21px; color:#FF0000" />
	  </div>	  </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
	<!--div id="imgMstCri" class="upload_a">
		<div id="imgDiv1Cri" class="upload_b"></div>
		<div id="imgDiv2Cri" class="upload_c"></div>
	</div-->	</td>
    <td align="center"><div id="loadingImg" style="width:40px; height:10px; display:none; text-align:center"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #C9DCD8; font-weight:bold">
  <tr>
    <td width="30" align="center">NO</td>
    <td width="120">REFERENSI</td>
    <td width="80">TAHUN</td>
    <td width="80">KODE</td>
    <td width="300">UNIT</td>
    <td>DESKRIPSI</td>
    <td width="90">USULAN BARU</td>
    <td width="90">KEB. MAX</td>
    <td width="90">OPTIMALISASI</td>
    <td width="165" align="center">ACTION</td>
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
		var gTHN = objfrm.fTHN.value;
		var gUBH= objfrm.fUBH.value;
		
		var gFnD = ReplaceText(objfrm.fFnD.value);
		
		//$(document).ready(function()
		//{
		//	$("#ViewDATA").load('RKBMD_New_Data.php?gUnT='+gUnT+'&gFnD='+gFnD+'&gTHN='+gTHN+'&gUBH='+gUBH+'&IdL='+IdL);
		//});
		
		$(document).ready(function()
		{
			$.ajax({
				url:"RKBMD_New_Data.php",
				data: {gUnT:gUnT,gFnD:gFnD,gTHN:gTHN,gUBH:gUBH,IdL:IdL},
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
		window.open('RKBMD_New_Frm.php?FrmG=RENCANA KEBUTUHAN BARANG MILIK DAERAH&IdT='+IdT+'&IdL='+IdL,'_self');
	}
	
	function P_Dokumen(IdT,Ubh,w,h,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		file="";
		if (Ubh=='1'){
			file="_Abt";
		}
		URL='RKBMD_New_Dokumen'+file+'.php?IdT='+IdT+'&IdL='+IdL;
		//URL='RKBMD_New_Dokumen.php?IdT='+IdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function showDOC(IdT,w,h,IdL)
	{
		Today = new Date();
		
		var HR3 = Today.getDay();
		var BL3 = Today.getMonth();
		var TH3 = Today.getFullYear();
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='RKBMD_New_DokumenX.php?IdT='+IdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function showDELE(IdT,stLOCK,Link,eCek,IdL)
	{
		if (stLOCK=='1'){alert('Access denied, data sudah terkunci..!!'); return false;}
		if (Link=='Ya'){alert('Access denied, data terkait data murni..!!'); return false;}
		if (eCek!=''){alert('Access denied, data terkait data perubahan..!!'); return false;}
		var AN = confirm("Hapus transaski usulan ini ..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$.ajax({
					url:"RKBMD_New_Data_Dell.php",
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
	
	function exportFORM(IdL)
	{
		gUNT = $("#fUNT").val();
		gTHN = $("#fTHN").val();
		gUBH = $("#fUBH").val();
		
		var AN = confirm("Export data ke perubahan..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$("#ViewDELL").load('RKBMD_New_Export.php?gUNT='+gUNT+'&gTHN='+gTHN+'&gUBH='+gUBH+'&IdL='+IdL);
			});
			
			/*
			$(document).ready(function()
			{
				$.ajax({
					url:"RKBMD_New_Export.php",
					data: {gUNT:gUNT,gTHN:gTHN,gUBH:gUBH,IdL:IdL},
					type:"get",
					beforeSend:function()
					{
						$("#loadingImg").show();
					},
					success:function(data)
					{
						$("#loadingImg").hide();
						$("#formDiv2Exec").html(data);
						$("#formDiv2Exec").show("fast");
					}
				});
			});
			*/
		}
	}
</script>