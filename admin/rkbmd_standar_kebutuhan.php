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
</head>
<?php
extract($_GET);
//echo $Crit;
$gHR  = 1;     //fGetDate('mday');
$gBL  = 1;     //fGetDate('mon');
$gTH  = (fGetDate('year')-1);
$gHRd = 31;    //fGetDate('mday');
$gBLd = 12;    //fGetDate('mon');
$gTHd = fGetDate('year');
$gJNS = "AA";

if ($gUNT==""){
	$gUNT="24.04.08.01";
}

if ($Lev > 1){
	$gUNT = substr($SkP,0,11);
	$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
}
?>
<body onload="B39.click()">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="<?="Invent_Usulan_Veri_Frm_.php?IdL=".$_GET['IdL']?>">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td width="14">&nbsp;</td>
    <td width="87">&nbsp;</td>
    <td width="15">&nbsp;</td>
    <td width="242">&nbsp;</td>
    <td width="62">&nbsp;</td>
    <td width="23">&nbsp;</td>
    <td width="270">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">TANGGAL</td>
    <td align="center">&nbsp;</td>
    <td><select class="boxs" name="fHR" tabindex="0" style="width:50px">
      <?php
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gHR) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="fBL" tabindex="0" style="width:95px">
	<?php
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBL) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTH" style="width: 60px" tabindex="0">
 	<?php
	for($i=2020; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select></td>
    <td align="right"> UNIT KERJA </td>
    <td align="center">&nbsp;</td>
    <td colspan="2">
	<?php if ($Lev <= 1) {?>
		<select class="boxs" name="fUNT" tabindex="0" style="width:496px" onchange="B39.click()">
		  <?php
			$nSQ="SELECT kd_unit, nm_unit FROM ref_unit ORDER BY kd_unit";
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
				echo "<option value'ALL'>ALL</option>"; 
				$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
			}
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
    <?php } else {?>
	<input name="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" type="text" value="<?=$dUNT?>" readonly style="padding-left:5px; width:406px; border: 1px solid #C0C0C0"/>
    <?php } ?>	</td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td class="ar">S.D TANGGAL </td>
    <td align="center">&nbsp;</td>
    <td>
      <select class="boxs" name="fHRd" tabindex="0" style="width:50px">
        <?php
	for($i=1; $i<=31; $i++)
	{
		$sel ="";
		if ($i==$gHRd) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
      </select>
      <select class="boxs" name="fBLd" tabindex="0" style="width:95px">
        <?php
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBLd) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmBulan($i).'</option>';
	}
	?>
      </select>
      <select class="boxs" name="fTHd" tabindex="0" style="width:60px">
        <?php
	for($i=2020; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTHd) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
      </select></td>
    <td align="right">FIND</td>
    <td align="center">&nbsp;</td>
    <td><input name="fFnD" id="fFnD" type="text" value="" placeholder='search' onkeypress="if (event.keyCode==13) {B39.click(); return false;}" style="padding-left:5px; width:250px; border: 1px solid #C0C0C0"/></td>
    <td style="padding-right:5px"><input type="button" name="B39" id="B39" value="GO" onclick="RefreshDATA('<?=$IdL?>')" style="width: 30px; height: 21px" />
      <!--div style="float:right">
	  <input type="button" name="B14" value="CETAK" onclick="showDOC('800','400','<?=$_GET['IdL']?>')" style="width: 100px; height: 21px; color:#0000FF" />
	  <input type="button" name="B14" value="CETAK RINCI" onclick="showDOC('800','400','<?=$_GET['IdL']?>')" style="width: 100px; height: 21px; color:#0000FF" />
	  </div-->	  </td>
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
    </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #C9DCD8; font-weight:bold">
  <tr style="text-align:center">
    <td width="28" style="border-right:1px solid #ccc">No</td>
    <td width="70" style="border-right:1px solid #ccc">Tanggal</td>
    <td width="120" style="border-right:1px solid #ccc">Referensi</td>
    <td width="170" style="border-right:1px solid #ccc">Nomor</td>
    <td width="50" style="border-right:1px solid #ccc">Tahun</td>
    <td width="353" style="border-right:1px solid #ccc">SKPD</td>
    <td width="353" style="border-right:1px solid #ccc">Uraian</td>
    <td align="center">Action</td>
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
				url:"rkbmd_standar_kebutuhan_data.php",
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
		window.open('rkbmd_standar_kebutuhan_frm.php?FrmG=STANDAR KEBUTUHAN BMD&IdT='+IdT+'&IdL='+IdL,'_self');
	}
	
	function P_Dokumen(w,h,IdT,Frm,Crit,IdL)
	{
		win=null;
		txtHTML = "";
		iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='rkbmd_standar_kebutuhan_frm_data_dok_'+Frm.toLowerCase()+'.php?Crit='+Crit+'&IdT='+IdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function showDOC(w,h,IdL)
	{
		gUNT = objfrm.fUNT.value;;
		
		HR1 = objfrm.fHR.value;
		BL1 = objfrm.fBL.value;
		TH1 = objfrm.fTH.value;
		
		HR2 = objfrm.fHRd.value;
		BL2 = objfrm.fBLd.value;
		TH2 = objfrm.fTHd.value;
		
		Today = new Date();
		
		HR3 = Today.getDay();
		BL3 = Today.getMonth();
		TH3 = Today.getFullYear();
		win=null;
		txtHTML = "";
		iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='standar_kebutuhan_data_dok.php?gUNT='+gUNT+'&HR1='+HR1+'&HR2='+HR2+'&HR3='+HR3+'&BL1='+BL1+'&BL2='+BL2+'&BL3='+BL3+'&TH1='+TH1+'&TH2='+TH2+'&TH3='+TH3+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
		//closeCLICK('choise');
	}
	
	function showDELE(IdT,Cek,IdL)
	{
		if (Cek=='NoDel'){alert('Access denied..!!'); return false;}
		
		var AN = confirm("Hapus transaski..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$.ajax({
					url:"rkbmd_standar_kebutuhan_data_dell.php",
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