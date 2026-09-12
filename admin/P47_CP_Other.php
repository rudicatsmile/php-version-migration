<?php
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
<?php
extract($_GET);
$gUNT = substr($SkP,0,11);
$dUNT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","","");
?>
<body onload="RefreshDATA('<?=$JnsNon?>','<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" id="myfrm" method="POST" enctype="multipart/form-data">
<input type="hidden" name="fA" id="fA" value="0" readonly style="width:50px"/>
<input type="hidden" name="fB" id="fB" value="0" readonly style="width:50px"/>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; color:#fff; background:#79a86a">
  <tr height="8">
    <td width="82">&nbsp;</td>
    <td width="14"></td>
    <td width="93"></td>
    <td width="474">
	<div id="lembMstCri" class="lmbrkerja0Cri">
		<div id="lembDiv1Cri" class="lmbrkerja1Cri"></div>
		<div id="lembDiv2Cri" class="lmbrkerja2Cri"></div>
	</div>
	<div id="asetMstAdd" class="lmbrkerja0Cri">
		<div id="asetDiv1Add" class="lmbrkerja1Cri"></div>
		<div id="asetDiv2Add" class="lmbrkerja2Cri"></div>
	</div>	</td>
    <td width="48"></td>
    <td width="11"></td>
    <td>&nbsp;</td>
    <td colspan="2"></td>
  </tr>
  <tr height="23">
    <td class="ar">Unit Kerja  </td>
    <td align="center">&nbsp;</td>
    <td colspan="2">
	<input name="fUNT" id="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:3px; width:105px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" id="dUNT" type="text" value="<?=$dUNT?>" readonly <?php if ($Lev <= 1) {?> onClick="showUNIT('','<?=$_GET['IdL']?>')" <?php } else {echo "readonly";}?> style="padding-left:3px; width:420px; border: 1px solid #C0C0C0"/>
	<div id="unitMstCri" class="Unit0Cri">
		<div id="unitDiv1Cri" class="Unit1Cri"></div>
		<div id="unitDiv2Cri" class="Unit2Cri"></div>
	</div>	</td>
    <td align="right">Record</td>
    <td align="center">&nbsp;</td>
    <td width="255"><select name="fPaG" id="fPaG" tabindex="0" style="width:100px; font-size:10pt; background:#FFFFFF; border:1px solid #999999" onchange="changePAGE('<?=$JnsNon?>','<?=$IdL?>')">
      <?php
	echo '<option selected value="100">100 Record</option>';
	echo '<option value="200">200 Record</option>';
	echo '<option value="300">300 Record</option>';
	echo '<option value="400">400 Record</option>';
	echo '<option value="500">500 Record</option>';
	?>
    </select></td>
    <td width="222">&nbsp;</td>
    <td width="92" rowspan="2" align="center"><div id="loadingImg" style="width:40px; height:10px; display:none"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></td>
  </tr>
  <tr height="23">
    <td align="right">Periode</td>
    <td align="center">&nbsp;</td>
    <td colspan="2">
	<select class="boxs" name="fSeM" id="fSeM" style="width:112px" onchange="BtnGO.click()">
	<option value="%">ALL</option>
	<option value="1" <?php if ($gSem=='1'){echo "selected";}?>>Semester 1</option>
	<option value="2" <?php if ($gSem=='2'){echo "selected";}?>>Semester 2</option>
	</select>
	<select class="boxs" name="fThN" id="fThN" style="width: 60px" onchange="BtnGO.click()">
	<option value="%">ALL</option>
	  <?php
		for($nThn=2021; $nThn<=2030; $nThn++)
		{
		$sel ="";
		if ($nThn==$tTbl) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
	</select></td>
    <td align="right">Cari</td>
    <td align="center">&nbsp;</td>
    <td><input type="text" name="fFinM" id="fFinM" placeholder='Search' onkeypress="if (event.keyCode==13){BtnGO.click();}" style="width:250px" /></td>
    <td><input type="button" name="BtnGO" id="BtnGO" value="GO" onclick="findDATA('<?=$JnsNon?>','<?=$IdL?>')" style="width:30px; height:21px" /></td>
  </tr>
  <tr height="8">
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="2"></td>
  </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #CEFBE3; font-weight:bold">
  <tr style="text-align:center">
    <td width="33" style="border-right:1px solid #ccc">No</td>
    <td width="65" style="border-right:1px solid #ccc">Tanggal</td>
    <td width="130" style="border-right:1px solid #ccc">Referensi</td>
    <td width="223" style="border-right:1px solid #ccc">Uraian</td>
    <td width="120" style="border-right:1px solid #ccc">Kontrak</td>
    <td width="120" style="border-right:1px solid #ccc">BAST</td>
    <td width="120" style="border-right:1px solid #ccc">Dokumen</td>
    <td width="120" style="border-right:1px solid #ccc">BAHI</td>
    <td width="120" style="border-right:1px solid #ccc">Dok Lain </td>
    <td width="103" style="border-right:1px solid #ccc">Nilai</td>
    <td>Dokumen P47</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td valign="top">
	<div id="ViewDELL" style="height:0px; width:300px; overflow:auto; border:0px"></div>
	<div id="ViewDATA" style="height:375px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td width="150">&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onClick="formAddItem('','<?=$ReO?>','<?=$JnsNon?>','','<?=$IdL?>'); return false" class="ico docu">&nbsp;&nbsp;Add Item</a></td>
    <td valign="top"><div id="ViewPAGE" style="height:38px; width:100%; overflow:auto; border:0px"></div></td>
  </tr>
</table>
</form>
</body>
</html>
<script languange="javascript">
	objfrm=document.myfrm;
	
	function findDATA(JnsNon,IdL)
	{
		$("#fA").val('0');
		$("#fB").val('0');
		RefreshDATA(JnsNon,IdL)
	}
	
	function changePAGE(JnsNon,IdL)
	{
		$("#fA").val('0');
		$("#fB").val('0');
		RefreshDATA(JnsNon,IdL)
	}
	
	function pageDATA(xA,xB,JnsNon,IdL)
	{
		$("#fA").val(xA);
		$("#fB").val(xB);
		
		RefreshDATA(JnsNon,IdL)
	}
	
	function RefreshDATA(JnsNon,IdL)
	{
		PerPage = $("#fPaG").val();
		
		PagA = $("#fA").val();
		PagB = $("#fB").val();
		
		FnD = ReplaceText($("#fFinM").val());
		UnT = ReplaceText($("#fUNT").val());
		SeM = $("#fSeM").val();
		ThN = $("#fThN").val();
		
		$(document).ready(function()
		{
			$.ajax({
				url:'P47_CP_Other_Data.php',
				data: {PerPage:PerPage,PagA:PagA,PagB:PagB,FnD:FnD,UnT:UnT,SeM:SeM,ThN:ThN,JnsNon:JnsNon,IdL:IdL},
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
			$("#ViewPAGE").load('P47_CP_Other_Data_Pages.php?PerPage='+PerPage+'&PagA='+PagA+'&PagB='+PagB+'&UnT='+UnT+'&SeM='+SeM+'&ThN='+ThN+'&JnsNon='+JnsNon+'&FnD='+FnD+'&IdL='+IdL);
		});
	}

	function showUNIT(CrT,IdL)
	{
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findUnT").val());
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('P47_CP_Other_Find_Unit_Mid.php?FnD='+FnD+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('unitDiv2Cri');
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('P47_CP_Other_Find_Unit_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('P47_CP_Other_Find_Unit_Mid.php?IdL='+IdL);
			});
			
			dispBlockOrNo('unitMstCri');
		}
	}
	
	function closeCLICK(crt)
	{
		document.getElementById(crt+'MstCri').style.display = "none";
	}

	function formAddItem(CrT,ReO,JnsNon,IdT,IdL)
	{
		UnT = $("#fUNT").val();
		ThN = $("#fThN").val();
		if (CrT=='refr')
		{
			$(document).ready(function()
			{
				$("#lembDiv2Cri").load('P47_CP_Other_Data_'+JnsNon+'_Mid.php?IdT='+IdT+'&ReO='+ReO+'&UnT='+UnT+'&ThN='+ThN+'&JnsNon='+JnsNon+'&IdL='+IdL);
			});
		}
		else if (CrT=='reset')
		{
			$(document).ready(function()
			{
				$("#lembDiv2Cri").load('P47_CP_Other_Data_'+JnsNon+'_Mid.php?IdT=&ReO='+ReO+'&UnT='+UnT+'&ThN='+ThN+'&JnsNon='+JnsNon+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('lembDiv2Cri');
			$(document).ready(function()
			{
				$("#lembDiv1Cri").load('P47_CP_Other_Data_FIIALL_Top.php?IdT='+IdT+'&ReO='+ReO+'&UnT='+UnT+'&ThN='+ThN+'&JnsNon='+JnsNon+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#lembDiv2Cri").load('P47_CP_Other_Data_'+JnsNon+'_Mid.php?IdT='+IdT+'&ReO='+ReO+'&UnT='+UnT+'&ThN='+ThN+'&JnsNon='+JnsNon+'&IdL='+IdL);
			});
			
			dispBlockOrNo('lembMstCri');
		}
	}
	
	function formAddAset(CrT,ReO,JnsNon,IdT,IdTA,IdL)
	{
		UnT  = $("#fUNT").val();
		ThN  = $("#fThN").val();
		if (CrT=='refr')
		{
			$(document).ready(function()
			{
				$("#asetDiv2Add").load('P47_CP_Other_Data_Aset_Mid.php?IdT='+IdT+'&IdTA='+IdTA+'&ReO='+ReO+'&UnT='+UnT+'&ThN='+ThN+'&JnsNon='+JnsNon+'&IdL='+IdL);
			});
		}
		else if (CrT=='reset')
		{
			$(document).ready(function()
			{
				$("#asetDiv2Add").load('P47_CP_Other_Data_Aset_Mid.php?IdT=&IdTA='+IdTA+'&ReO='+ReO+'&UnT='+UnT+'&ThN='+ThN+'&JnsNon='+JnsNon+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('asetDiv2Add');
			$(document).ready(function()
			{
				$("#asetDiv1Add").load('P47_CP_Other_Data_Aset_Top.php?IdT='+IdT+'&IdTA='+IdTA+'&ReO='+ReO+'&UnT='+UnT+'&ThN='+ThN+'&JnsNon='+JnsNon+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#asetDiv2Add").load('P47_CP_Other_Data_Aset_Mid.php?IdT='+IdT+'&IdTA='+IdTA+'&ReO='+ReO+'&UnT='+UnT+'&ThN='+ThN+'&JnsNon='+JnsNon+'&IdL='+IdL);
			});
			
			dispBlockOrNo('asetMstAdd');
		}
	}
	
	function formCetakDok(CrT,IdT,w,h,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL= 'report/permen_47/'+CrT+'.php?IdT='+IdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=yes,menubar=yes,toolbar=no,resizable=yes,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function showSUB(CrT,IdL)
	{
		UnT = $("#fUNT").val();
		if (UnT==''){alert('Silahkan pilih unit..!!'); return false;}
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findSuB").val());
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Sub_Mid.php?FnD='+FnD+'&UnT='+UnT+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('subDiv2Cri');
			dispNO('upbMstCri');
			$(document).ready(function()
			{
				$("#subDiv1Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Sub_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Sub_Mid.php?UnT='+UnT+'&IdL='+IdL);
			});
			
			dispBlockOrNo('subMstCri');
		}
	}
	
	function showUPB(CrT,IdL)
	{
		SuB = $("#fSUB").val();
		if (SuB==''){alert('Silahkan pilih sub unit..!!'); return false;}
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findUpB").val());
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Upb_Mid.php?FnD='+FnD+'&SuB='+SuB+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('upbDiv2Cri');
			$(document).ready(function()
			{
				$("#upbDiv1Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Upb_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Upb_Mid.php?SuB='+SuB+'&IdL='+IdL);
			});
			
			dispBlockOrNo('upbMstCri');
		}
	}
	
	function showREKN3(CrT,IdL)
	{
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findRek3").val());
			$(document).ready(function()
			{
				$("#rekn3Div2Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Rekn3_Mid.php?FnD='+FnD+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('rekn3Div2Cri');
			dispNO('rekn4MstCri');
			dispNO('rekn5MstCri');
			dispNO('rekn6MstCri');
			dispNO('rekn7MstCri');
			$(document).ready(function()
			{
				$("#rekn3Div1Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Rekn3_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#rekn3Div2Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Rekn3_Mid.php?IdL='+IdL);
			});
			
			dispBlockOrNo('rekn3MstCri');
		}
	}
		
	function showREKN4(CrT,IdL)
	{
		Rek3 = $("#fREK3").val();
		if (Rek3==''){alert('Silahkan pilih jenis rekening aset..!!'); return false;}
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findRek4").val());
			$(document).ready(function()
			{
				$("#rekn4Div2Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Rekn4_Mid.php?FnD='+FnD+'&Rek3='+Rek3+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('rekn4Div2Cri');
			dispNO('rekn5MstCri');
			dispNO('rekn6MstCri');
			dispNO('rekn7MstCri');
			$(document).ready(function()
			{
				$("#rekn4Div1Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Rekn4_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#rekn4Div2Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Rekn4_Mid.php?Rek3='+Rek3+'&IdL='+IdL);
			});
			
			dispBlockOrNo('rekn4MstCri');
		}
	}
	
	function showREKN5(CrT,IdL)
	{
		Rek4 = $("#fREK4").val();
		if (Rek4==''){alert('Silahkan pilih objek rekening aset..!!'); return false;}
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findRek5").val());
			$(document).ready(function()
			{
				$("#rekn5Div2Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Rekn5_Mid.php?FnD='+FnD+'&Rek4='+Rek4+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('rekn5Div2Cri');
			dispNO('rekn6MstCri');
			dispNO('rekn7MstCri');
			$(document).ready(function()
			{
				$("#rekn5Div1Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Rekn5_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#rekn5Div2Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Rekn5_Mid.php?Rek4='+Rek4+'&IdL='+IdL);
			});
			
			dispBlockOrNo('rekn5MstCri');
		}
	}
	
	function showREKN6(CrT,IdL)
	{
		Rek5 = $("#fREK5").val();
		if (Rek5==''){alert('Silahkan pilih rincian objek rekening aset..!!'); return false;}
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findRek6").val());
			$(document).ready(function()
			{
				$("#rekn6Div2Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Rekn6_Mid.php?FnD='+FnD+'&Rek5='+Rek5+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('rekn6Div2Cri');
			dispNO('rekn7MstCri');
			$(document).ready(function()
			{
				$("#rekn6Div1Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Rekn6_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#rekn6Div2Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Rekn6_Mid.php?Rek5='+Rek5+'&IdL='+IdL);
			});
			
			dispBlockOrNo('rekn6MstCri');
		}
	}
	
	function showREKN7(CrT,GoB,IdL)
	{
		Rek6 = $("#fREK6").val();
		if (Rek6=='' && GoB==''){alert('Silahkan pilih rincian sub rincian objek rekening aset..!!'); return false;}
		if (CrT=='find' || CrT=='findAll')
		{
			FnD = ReplaceText($("#findRek7").val());
			$(document).ready(function()
			{
				$("#rekn7Div2Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Rekn7_Mid.php?FnD='+FnD+'&Rek6='+Rek6+'&GoB='+GoB+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('rekn7Div2Cri');
			$(document).ready(function()
			{
				$("#rekn7Div1Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Rekn7_Top.php?GoB='+GoB+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#rekn7Div2Cri").load('P47_CP_Other_Data_Aset_Mid_Find_Rekn7_Mid.php?Rek6='+Rek6+'&GoB='+GoB+'&IdL='+IdL);
			});
			
			dispBlockOrNo('rekn7MstCri');
		}
	}
	
	function showCLICK(crt,kde,nma,IdL)
	{
		if (crt=='unit') 
		{
			$("#fUNT").val(kde);
			$("#dUNT").val(nma);
			$("#BtnGO").click();
		}
		if (crt=='sub') 
		{
			$("#fSUB").val(kde);
			$("#dSUB").val(nma);
			
			$("#fUPB").val('');
			$("#dUPB").val('');
		}
		if (crt=='upb') 
		{
			$("#fUPB").val(kde);
			$("#dUPB").val(nma);
		}
		if (crt=='rekn3') 
		{
			$("#fREK3").val(kde);
			$("#dREK3").val(nma);
			
			$("#fREK4").val('');
			$("#dREK4").val('');
			$("#fREK5").val('');
			$("#dREK5").val('');
			$("#fREK6").val('');
			$("#dREK6").val('');
			$("#fREK7").val('');
			$("#dREK7").val('');
		}
		if (crt=='rekn4') 
		{
			$("#fREK4").val(kde);
			$("#dREK4").val(nma);
			
			$("#fREK5").val('');
			$("#dREK5").val('');
			$("#fREK6").val('');
			$("#dREK6").val('');
			$("#fREK7").val('');
			$("#dREK7").val('');
		}
		if (crt=='rekn5') 
		{
			$("#fREK5").val(kde);
			$("#dREK5").val(nma);
			
			$("#fREK6").val('');
			$("#dREK6").val('');
			$("#fREK7").val('');
			$("#dREK7").val('');
		}
		if (crt=='rekn6') 
		{
			$("#fREK6").val(kde);
			$("#dREK6").val(nma);
			
			$("#fREK7").val('');
			$("#dREK7").val('');
		}
		if (crt=='rekn7') 
		{
			$("#fREK7").val(kde);
			$("#dREK7").val(nma);
		}
		if (crt=='rekn7find') 
		{
			$("#fREK7").val(kde);
			$("#dREK7").val(nma);
			crt = "rekn7";
			findJENIS(kde,IdL);
			
		}
		
		document.getElementById(crt+'MstCri').style.display = "none";
		
	}
	
	function findJENIS(kde,IdL)
	{
		$(document).ready(function()
		{
			$("#loadingImg").show();
			$.post("P47_CP_Other_Data_Aset_Mid_Find_Rekn7_Mid_Json.php",
			{"kde":kde,"IdL":IdL},
			function( data ) 
			{
				//if (data['Mess']!='') {alert(data['Mess']);}
				$("#fREK3").val(data['kde3']);
				$("#dREK3").val(data['nma3']);
				$("#fREK4").val(data['kde4']);
				$("#dREK4").val(data['nma4']);
				$("#fREK5").val(data['kde5']);
				$("#dREK5").val(data['nma5']);
				$("#fREK6").val(data['kde6']);
				$("#dREK6").val(data['nma6']);
				$("#loadingImg").hide();
			},"json");
		});		
	}
	
	function saveDataAset(ReO,JnsNon,IdT,IdTA,IdL)
	{
		UpB  = $("#fUPB").val();
		ReK7 = $("#fREK7").val();
		if (UpB==''){alert('UPB belum dipilih...!!'); return false;}
		if (ReK7==''){alert('Rekenig aset belum dipilih...!!'); return false;}
		NmaSP= $("#fNmaSP").val();
		NoRG = $("#fNoRG").val();
		Merk = $("#fMerk").val();
		Type = $("#fType").val();
		NoPB = $("#fNoPB").val();
		NoRK = $("#fNoRK").val();
		NoMS = $("#fNoMS").val();
		NoBP = $("#fNoBP").val();
		NoPL = $("#fNoPL").val();
		Alam = $("#fAlam").val();
		Judu = $("#fJudu").val();
		Spes = $("#fSpec").val();
		Cipt = $("#fCipt").val();
		Baha = $("#fBaha").val();
		Tahu = $("#fTahu").val();
		
		Panj = $("#fPanj").val();
		Leba = $("#fLeba").val();
		Luas = $("#fLuas").val();
		LuasL= $("#fLuasL").val();
		
		SrNom= $("#fSrNom").val();
		SrTgl= $("#fSrTgl").val();
		
		DoNom= $("#fDoNom").val();
		DoTgl= $("#fDoTgl").val();
		
		Guna= $("#fGuna").val();
		KdTnh = $("#fKdTnh").val();
		
		B1T = "";
		Len = objfrm.fB1T.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fB1T[i].checked) {B1T = objfrm.fB1T[i].value; break; }
		}
		
		B1B = "";
		Len = objfrm.fB1B.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fB1B[i].checked) {B1B = objfrm.fB1B[i].value; break; }
		}
		
		B1C = "";
		Len = objfrm.fB1C.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fB1C[i].checked) {B1C = objfrm.fB1C[i].value; break; }
		}
		
		KdTnh = $("#fKdTnh").val();
		StTnh = $("#fStTnh").val();
		LuTnh = $("#fLuTnh").val();
		HkTnh = $("#fHkTnh").val();
		LtTnh = $("#fLtTnh").val();
		
		LtTnhU = $("#fLtTnhU").val();
		LtTnhS = $("#fLtTnhS").val();
		LtTnhT = $("#fLtTnhT").val();
		LtTnhB = $("#fLtTnhB").val();
		Memo = $("#fMemo").val();
		
		$(document).ready(function()
		{
			$("#loadingImg").show();
			$.post("P47_CP_Other_Data_Aset_Mid_Save_Json.php",
			{"Memo":Memo,"LtTnhB":LtTnhB,"LtTnhT":LtTnhT,"LtTnhS":LtTnhS,"LtTnhU":LtTnhU,"LtTnh":LtTnh,"HkTnh":HkTnh,"LuTnh":LuTnh,"StTnh":StTnh,"KdTnh":KdTnh,"Guna":Guna,"DoTgl":DoTgl,"DoNom":DoNom,"SrTgl":SrTgl,"SrNom":SrNom,"LuasL":LuasL,"Luas":Luas,"Leba":Leba,"Panj":Panj,"B1C":B1C,"B1B":B1B,"B1T":B1T,"Tahu":Tahu,"Baha":Baha,"Cipt":Cipt,"Spes":Spes,"Judu":Judu,"Alam":Alam,"NoPL":NoPL,"NoBP":NoBP,"NoMS":NoMS,"NoRK":NoRK,"NoPB":NoPB,"Type":Type,"Merk":Merk,"NoRG":NoRG,"NmaSP":NmaSP,"UpB":UpB,"ReK7":ReK7,"JnsNon":JnsNon,"IdT":IdT,"IdTA":IdTA,"IdL":IdL},
			function( data ) 
			{
				if (data['Mess']!='') {alert(data['Mess']);}
				IdT  = data['IdT'];
				IdTA = data['IdTA'];
				formAddAset('refr',ReO,JnsNon,IdT,IdTA,IdL);
				$("#loadingImg").hide();
			},"json");
		});		
	}
	
	function formPosting(CrT,ReO,JnsNon,IdT,IdL)
	{
		alert('Under constructions...!!');
	}
	
	function saveDATA(ReO,JnsNon,IdT,IdL)
	{
		if (JnsNon=='FIIA12')
		{
			UnT = $("#fUNT").val();
			ThN = $("#fThN").val();
			TgL  = $("#fTgL").val();
			PiHA = $("#fPiHA").val();
			JmLB = $("#fJmLB").val();
			SaTB = $("#fSaTB").val();
			HrGB = $("#fHrGB").val();
			HrGT = $("#fHrGT").val();
			
			RaDB = "";
			Len = objfrm.fRadB.length;
			for (i=0; i<=Len; i++)
			{
				if (objfrm.fRadB[i].checked) {RaDB = objfrm.fRadB[i].value; break; }
			}
			
			NoBA = $("#fNoBA").val();
			TgBA = $("#fTgBA").val();
			
			DokPNm = $("#fDokPNm").val();
			DokPNo = $("#fDokPNo").val();
			DokPTg = $("#fDokPTg").val();
			
			$(document).ready(function()
			{
				$("#loadingImg").show();
				$.post("P47_CP_Other_Data_FIIALL_Save_Json.php",
				{"DokPNm":DokPNm,"DokPNo":DokPNo,"DokPTg":DokPTg,"NoBA":NoBA,"TgBA":TgBA,"RaDB":RaDB,"JmLB":JmLB,"SaTB":SaTB,"HrGB":HrGB,"HrGT":HrGT,"PiHA":PiHA,"TgL":TgL,"UnT":UnT,"ThN":ThN,"JnsNon":JnsNon,"IdT":IdT,"IdL":IdL},
				function( data ) 
				{
					if (data['Mess']!='') {alert(data['Mess']);}
					IdT = data['IdT'];
					formAddItem('refr',ReO,JnsNon,IdT,IdL);
					$("#loadingImg").hide();
				},"json");
			});
		}
		else if (JnsNon=='FIIA13')
		{
			UnT = $("#fUNT").val();
			ThN = $("#fThN").val();
			TgL  = $("#fTgL").val();
			PiHA = $("#fPiHA").val();
			JmLB = $("#fJmLB").val();
			SaTB = $("#fSaTB").val();
			HrGB = $("#fHrGB").val();
			HrGT = $("#fHrGT").val();
			
			DokNm = $("#fDokNm").val();
			DokNo = $("#fDokNo").val();
			DokTg = $("#fDokTg").val();
			
			NmKo = $("#fNmKo").val();
			NoKo = $("#fNoKo").val();
			TgKo = $("#fTgKo").val();
			
			DokPNm = $("#fDokPNm").val();
			DokPNo = $("#fDokPNo").val();
			DokPTg = $("#fDokPTg").val();
			
			$(document).ready(function()
			{
				$("#loadingImg").show();
				$.post("P47_CP_Other_Data_FIIALL_Save_Json.php",
				{"DokPNm":DokPNm,"DokPNo":DokPNo,"DokPTg":DokPTg,"NmKo":NmKo,"NoKo":NoKo,"TgKo":TgKo,"DokTg":DokTg,"DokNo":DokNo,"DokNm":DokNm,"JmLB":JmLB,"SaTB":SaTB,"HrGB":HrGB,"HrGT":HrGT,"PiHA":PiHA,"TgL":TgL,"UnT":UnT,"ThN":ThN,"JnsNon":JnsNon,"IdT":IdT,"IdL":IdL},
				function( data ) 
				{
					if (data['Mess']!='') {alert(data['Mess']);}
					IdT = data['IdT'];
					formAddItem('refr',ReO,JnsNon,IdT,IdL);
					$("#loadingImg").hide();
				},"json");
			});
		}
		else if (JnsNon=='FIIA14')
		{
			UnT = $("#fUNT").val();
			ThN = $("#fThN").val();
			TgL  = $("#fTgL").val();
			PiHA = $("#fPiHA").val();
			JmLB = $("#fJmLB").val();
			SaTB = $("#fSaTB").val();
			HrGB = $("#fHrGB").val();
			HrGT = $("#fHrGT").val();
			
			NoBA = $("#fNoBA").val();
			TgBA = $("#fTgBA").val();
			DsrHuk = $("#fDsrHuk").val();
			DokPNm = $("#fDokPNm").val();
			DokPNo = $("#fDokPNo").val();
			DokPTg = $("#fDokPTg").val();
			
			$(document).ready(function()
			{
				$("#loadingImg").show();
				$.post("P47_CP_Other_Data_FIIALL_Save_Json.php",
				{"DokPNm":DokPNm,"DokPNo":DokPNo,"DokPTg":DokPTg,"NoBA":NoBA,"TgBA":TgBA,"DsrHuk":DsrHuk,"JmLB":JmLB,"SaTB":SaTB,"HrGB":HrGB,"HrGT":HrGT,"PiHA":PiHA,"TgL":TgL,"UnT":UnT,"ThN":ThN,"JnsNon":JnsNon,"IdT":IdT,"IdL":IdL},
				function( data ) 
				{
					if (data['Mess']!='') {alert(data['Mess']);}
					IdT = data['IdT'];
					formAddItem('refr',ReO,JnsNon,IdT,IdL);
					$("#loadingImg").hide();
				},"json");
			});
		}
		else if (JnsNon=='FIIA15')
		{
			UnT = $("#fUNT").val();
			ThN = $("#fThN").val();
			TgL  = $("#fTgL").val();
			PiHA = $("#fPiHA").val();
			JmLB = $("#fJmLB").val();
			SaTB = $("#fSaTB").val();
			HrGB = $("#fHrGB").val();
			HrGT = $("#fHrGT").val();
			
			NoBA = $("#fNoBA").val();
			TgBA = $("#fTgBA").val();
			
			DokNm = $("#fDokNm").val();
			DokNo = $("#fDokNo").val();
			DokTg = $("#fDokTg").val();
			
			DokPNm = $("#fDokPNm").val();
			DokPNo = $("#fDokPNo").val();
			DokPTg = $("#fDokPTg").val();
			
			$(document).ready(function()
			{
				$("#loadingImg").show();
				$.post("P47_CP_Other_Data_FIIALL_Save_Json.php",
				{"DokNm":DokNm,"DokNo":DokNo,"DokTg":DokTg,"DokPNm":DokPNm,"DokPNo":DokPNo,"DokPTg":DokPTg,"NoBA":NoBA,"TgBA":TgBA,"JmLB":JmLB,"SaTB":SaTB,"HrGB":HrGB,"HrGT":HrGT,"PiHA":PiHA,"TgL":TgL,"UnT":UnT,"ThN":ThN,"JnsNon":JnsNon,"IdT":IdT,"IdL":IdL},
				function( data ) 
				{
					if (data['Mess']!='') {alert(data['Mess']);}
					IdT = data['IdT'];
					formAddItem('refr',ReO,JnsNon,IdT,IdL);
					$("#loadingImg").hide();
				},"json");
			});
		}
		else if (JnsNon=='FIIA16')
		{
			UnT = $("#fUNT").val();
			ThN = $("#fThN").val();
			TgL  = $("#fTgL").val();
			PiHA = $("#fPiHA").val();
			JmLB = $("#fJmLB").val();
			SaTB = $("#fSaTB").val();
			HrGB = $("#fHrGB").val();
			HrGT = $("#fHrGT").val();
			
			NoBA = $("#fNoBA").val();
			TgBA = $("#fTgBA").val();
			
			DokPNm = $("#fDokPNm").val();
			DokPNo = $("#fDokPNo").val();
			DokPTg = $("#fDokPTg").val();
			
			$(document).ready(function()
			{
				$("#loadingImg").show();
				$.post("P47_CP_Other_Data_FIIALL_Save_Json.php",
				{"DokPNm":DokPNm,"DokPNo":DokPNo,"DokPTg":DokPTg,"NoBA":NoBA,"TgBA":TgBA,"JmLB":JmLB,"SaTB":SaTB,"HrGB":HrGB,"HrGT":HrGT,"PiHA":PiHA,"TgL":TgL,"UnT":UnT,"ThN":ThN,"JnsNon":JnsNon,"IdT":IdT,"IdL":IdL},
				function( data ) 
				{
					if (data['Mess']!='') {alert(data['Mess']);}
					IdT = data['IdT'];
					formAddItem('refr',ReO,JnsNon,IdT,IdL);
					$("#loadingImg").hide();
				},"json");
			});
		}
		else if (JnsNon=='FIIA17')
		{
			UnT = $("#fUNT").val();
			ThN = $("#fThN").val();
			TgL  = $("#fTgL").val();
			PiHA = $("#fPiHA").val();
			JmLB = $("#fJmLB").val();
			SaTB = $("#fSaTB").val();
			HrGB = $("#fHrGB").val();
			HrGT = $("#fHrGT").val();
			
			NoBH = $("#fNoBH").val();
			TgBH = $("#fTgBH").val();
			
			DokPNm = $("#fDokPNm").val();
			DokPNo = $("#fDokPNo").val();
			DokPTg = $("#fDokPTg").val();
			
			$(document).ready(function()
			{
				$("#loadingImg").show();
				$.post("P47_CP_Other_Data_FIIALL_Save_Json.php",
				{"DokPNm":DokPNm,"DokPNo":DokPNo,"DokPTg":DokPTg,"NoBH":NoBH,"TgBH":TgBH,"JmLB":JmLB,"SaTB":SaTB,"HrGB":HrGB,"HrGT":HrGT,"PiHA":PiHA,"TgL":TgL,"UnT":UnT,"ThN":ThN,"JnsNon":JnsNon,"IdT":IdT,"IdL":IdL},
				function( data ) 
				{
					if (data['Mess']!='') {alert(data['Mess']);}
					IdT = data['IdT'];
					formAddItem('refr',ReO,JnsNon,IdT,IdL);
					$("#loadingImg").hide();
				},"json");
			});
		}
		else if (JnsNon=='FIIA18')
		{
			UnT = $("#fUNT").val();
			ThN = $("#fThN").val();
			TgL  = $("#fTgL").val();
			PiHA = $("#fPiHA").val();
			JmLB = $("#fJmLB").val();
			SaTB = $("#fSaTB").val();
			HrGB = $("#fHrGB").val();
			HrGT = $("#fHrGT").val();
			
			NoBA = $("#fNoBA").val();
			TgBA = $("#fTgBA").val();
			DsrHuk = $("#fDsrHuk").val();
			DokPNm = $("#fDokPNm").val();
			DokPNo = $("#fDokPNo").val();
			DokPTg = $("#fDokPTg").val();
			
			$(document).ready(function()
			{
				$("#loadingImg").show();
				$.post("P47_CP_Other_Data_FIIALL_Save_Json.php",
				{"DokPNm":DokPNm,"DokPNo":DokPNo,"DokPTg":DokPTg,"NoBA":NoBA,"TgBA":TgBA,"DsrHuk":DsrHuk,"JmLB":JmLB,"SaTB":SaTB,"HrGB":HrGB,"HrGT":HrGT,"PiHA":PiHA,"TgL":TgL,"UnT":UnT,"ThN":ThN,"JnsNon":JnsNon,"IdT":IdT,"IdL":IdL},
				function( data ) 
				{
					if (data['Mess']!='') {alert(data['Mess']);}
					IdT = data['IdT'];
					formAddItem('refr',ReO,JnsNon,IdT,IdL);
					$("#loadingImg").hide();
				},"json");
			});
		}
		else if (JnsNon=='FIIA19')
		{
			UnT = $("#fUNT").val();
			ThN = $("#fThN").val();
			TgL  = $("#fTgL").val();
			PiHA = $("#fPiHA").val();
			JmLB = $("#fJmLB").val();
			SaTB = $("#fSaTB").val();
			HrGB = $("#fHrGB").val();
			HrGT = $("#fHrGT").val();
			
			DokNm = $("#fDokNm").val();
			DokNo = $("#fDokNo").val();
			DokTg = $("#fDokTg").val();
			
			DokPNm = $("#fDokPNm").val();
			DokPNo = $("#fDokPNo").val();
			DokPTg = $("#fDokPTg").val();
			
			$(document).ready(function()
			{
				$("#loadingImg").show();
				$.post("P47_CP_Other_Data_FIIALL_Save_Json.php",
				{"DokPNm":DokPNm,"DokPNo":DokPNo,"DokPTg":DokPTg,"DokTg":DokTg,"DokNo":DokNo,"DokNm":DokNm,"JmLB":JmLB,"SaTB":SaTB,"HrGB":HrGB,"HrGT":HrGT,"PiHA":PiHA,"TgL":TgL,"UnT":UnT,"ThN":ThN,"JnsNon":JnsNon,"IdT":IdT,"IdL":IdL},
				function( data ) 
				{
					if (data['Mess']!='') {alert(data['Mess']);}
					IdT = data['IdT'];
					formAddItem('refr',ReO,JnsNon,IdT,IdL);
					$("#loadingImg").hide();
				},"json");
			});
		}
		else if (JnsNon=='FIIA20')
		{
			UnT = $("#fUNT").val();
			ThN = $("#fThN").val();
			TgL  = $("#fTgL").val();
			PiHA = $("#fPiHA").val();
			JmLB = $("#fJmLB").val();
			SaTB = $("#fSaTB").val();
			HrGB = $("#fHrGB").val();
			HrGT = $("#fHrGT").val();
			
			DokNm = $("#fDokNm").val();
			DokNo = $("#fDokNo").val();
			DokTg = $("#fDokTg").val();
			
			DokPNm = $("#fDokPNm").val();
			DokPNo = $("#fDokPNo").val();
			DokPTg = $("#fDokPTg").val();
			
			$(document).ready(function()
			{
				$("#loadingImg").show();
				$.post("P47_CP_Other_Data_FIIALL_Save_Json.php",
				{"DokPNm":DokPNm,"DokPNo":DokPNo,"DokPTg":DokPTg,"DokTg":DokTg,"DokNo":DokNo,"DokNm":DokNm,"JmLB":JmLB,"SaTB":SaTB,"HrGB":HrGB,"HrGT":HrGT,"PiHA":PiHA,"TgL":TgL,"UnT":UnT,"ThN":ThN,"JnsNon":JnsNon,"IdT":IdT,"IdL":IdL},
				function( data ) 
				{
					if (data['Mess']!='') {alert(data['Mess']);}
					IdT = data['IdT'];
					formAddItem('refr',ReO,JnsNon,IdT,IdL);
					$("#loadingImg").hide();
				},"json");
			});
		}
	}
	
</script>