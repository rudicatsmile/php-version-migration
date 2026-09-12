<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>SimB@DA</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="global.js"></script>
</head>
<?php
extract($_GET);

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


$gDoc = $_POST['fDoK'];
if ($gDoc=="1")
{
	$List1 ="checked";
	$List2 ="";
	$List3 ="";	
} 
else if ($gDoc=="2")
{
	$List1 ="";
	$List2 ="checked";
	$List3 ="";	
} 
else 
{
	$List1 ="";
	$List2 ="";
	$List3 ="checked";	
}
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1000px">
  <tr>
    <td width="73">&nbsp;</td>
    <td width="20">&nbsp;</td>
    <td width="220">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  
	<tr>
	
    <td class="ar">UNIT KERJA</td>
    <td>&nbsp;</td>
    <td>
		<select name="fUnt" tabindex="0" style="width:480px" onchange="this.form.submit()">
			<?php
			if ($Lev <=1 ) {
				$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
				if ($rCrt<=4) {echo "<option value='All'>All</option>";}
				
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
		</select>
		<div id="dataMstCri" class="editrekn0Cri">
            <div id="dataDiv1Cri" class="editrekn1Cri"></div>
            <div id="dataDiv2Cri" class="editrekn2Cri"></div>
        </div>
	</td>
    <td></td>
    </tr>
  <tr>

  <tr>
    <td class="ar">SUB UNIT</td>
    <td>&nbsp;</td>
    <td>
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
		</select>
	</td>
    <td></td>
    </tr>
  <tr>

  <tr>
    <td class="ar">UPB</td>
    <td>&nbsp;</td>
    <td>
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
		</select>
	</td>
    <td></td>
    </tr>
  <tr>

  <tr>
    <td class="ar">FIND</td>
    <td>&nbsp;</td>
    <td>
		<input name="fFnD" id="fFnD" type="text" value="" onkeypress="if (event.keyCode==13) {RefreshDATA('<?=$IdL?>'); return false;}" style="padding-left:5px; width:200px; border: 1px solid #C0C0C0"/>
		<input type="button" name="B39" value="GO" onclick="RefreshDATA('<?=$IdL?>')" style="width:80px; height:21px" />
	</td>
    <td></td>
 </tr>
 <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
 </tr>

 <tr>
    <td class="ar"></td>
    <td>&nbsp;</td>
    <td><p>
		
		 <label><input name="fDoK" <?=$List1?> type="radio" value="1" onchange="this.form.submit()" />Belum Scan</label>
		<label><input name="fDoK" <?=$List2?> type="radio" value="2" onchange="this.form.submit()" />Sudah Scan</label>
		<label><input name="fDoK" <?=$List3?> type="radio" value="3" onchange="this.form.submit()" />Semua</label> 
		
	</td>
	</td><td>
		
	</td>
 </tr>
 

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:1000px; height:20px; background: #C9DCD8; font-weight:bold">
  <tr>
    <td width="30" align="center">NO</td>
    <td width="100" align="center">KODE UPB</td>
    <td width="110" align="center">KODE BAR</td>
    <td width="110" align="center">REFERENSI</td>
    <td width="140" align="center">TANGGAL BUAT</td>
    <td width="180" align="center">TANGGAL MAPING</td>
    <td width="200" align="left" style="padding-left:6px">USER
        <!-- <div id="dataMstCri" class="editrekn0Cri">
            <div id="dataDiv1Cri" class="editrekn1Cri"></div>
            <div id="dataDiv2Cri" class="editrekn2Cri"></div>
        </div> -->
	</td>
    <td class="ac">ACTION</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1000px; height:370px">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:0px; overflow:auto"></div>
	<div id="ViewDATA" style="height:370px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1000px; height:30px">
  <tr>
    <td>&nbsp;&nbsp;&nbsp;
	<!-- <a href="#" onClick="editDATA('<?=$ReO?>','1','addnew','','','<?=$IdL?>'); return false" class="ico add">&nbsp;Add Item</a>&nbsp;&nbsp;&nbsp; -->
	<!--a href="#" onClick="prinDATA('<?=$IdL?>'); return false" class="ico docu">&nbsp;Dokumen</a-->
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
		gFnD = ReplaceText(objfrm.fFnD.value);
		gUnt = ReplaceText(objfrm.fUnt.value);
		gSub = ReplaceText(objfrm.fSub.value);
		gUpb = ReplaceText(objfrm.fUpb.value);

		gDoK = ReplaceText(objfrm.fDoK.value);
		
		$(document).ready(function()
		{
			$.ajax({
				url:"Ref_Bar_Kode_Data.php",
				data: {gUnt:gUnt,gSub:gSub,gUpb:gUpb,gDoK:gDoK,gFnD:gFnD,IdL:IdL},
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
	
	function editDATA(codeContents,Lev,CrT,IdT,rCek,IdL)
	{
		// if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		// if (rCek){alert('Access denied..!!'); return false;}
		
		// if (CrT=='refr')
		// {
		// 	$(document).ready(function()
		// 	{
		// 		$("#dataDiv2Cri").load('Ref_ProKeg_90_All_Data_Mid.php?Lev='+Lev+'&IdT='+IdT+'&IdL='+IdL);
		// 	});
		// }
		// else if (CrT=='reset')
		// {
		// 	fKdM = "";
		// 	$(document).ready(function()
		// 	{
		// 		$("#dataDiv2Cri").load('Ref_ProKeg_90_All_Data_Mid.php?fKdM='+fKdM+'&Lev='+Lev+'&IdL='+IdL);
		// 	});
		// }
		// else
		// {
			fKdM = "";
			//alert(CrT); return false;
			dispBLOCK('dataDiv2Cri');
			$(document).ready(function()
			{
				$("#dataDiv1Cri").load('Ref_ProKeg_90_All_Data_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#dataDiv2Cri").load('Cetak_Ulang_Bar_Code.php?codeContents='+codeContents+'&Lev='+Lev+'&IdT='+IdT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('dataMstCri');
		//}
	}
	
	function saveDATA(ReO,Lev,IdT,IdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		KdR = ReplaceText($("#fKdR").val());
		NmR = ReplaceText($("#fNmR").val());
				
		$(document).ready(function()
		{
			$("#dataDiv2Cri").load('Ref_ProKeg_90_All_Data_Save.php?KdR='+KdR+'&NmR='+NmR+'&Lev='+Lev+'&IdT='+IdT+'&IdL='+IdL
			);
		});
	}
	
	function deleteDATA(ReO,Lev,IdT,rCek,IdL)
	{
		if (ReO=='Y') {alert('Access denied, akses readony..!!'); return false;}
		if (rCek!=''){alert('Access denied...!!'); return false;}
		AN = confirm('Delete data ..?');
		if (!AN){return false;}
		$(document).ready(function()
		{
			$("#ViewDELL").load('Ref_Bar_Kode_Data_Del.php?Lev='+Lev+'&IdT='+IdT+'&IdL='+IdL
			);
		});
	}
</script>