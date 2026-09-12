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
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" id="myfrm" method="POST" enctype="multipart/form-data">
<input type="hidden" name="fA" id="fA" value="0" readonly style="width:50px"/>
<input type="hidden" name="fB" id="fB" value="0" readonly style="width:50px"/>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%; color:#fff; background:#79a86a">
  <tr height="8">
    <td width="76">&nbsp;</td>
    <td width="13"></td>
    <td width="104"></td>
    <td width="471">
	<div id="lembMstCri" class="lmbrkerja0Cri">
		<div id="lembDiv1Cri" class="lmbrkerja1Cri"></div>
		<div id="lembDiv2Cri" class="lmbrkerja2Cri"></div>
	</div>	</td>
    <td width="42"></td>
    <td width="13"></td>
    <td colspan="4"></td>
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
    <td align="right">Periode</td>
    <td align="center">&nbsp;</td>
    <td width="166">
	<select class="boxs" name="fSeM" id="fSeM" style="width:90px" onchange="BtnGO.click()">
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
	</select>	</td>
    <td width="37">Record</td>
    <td width="12">&nbsp;</td>
    <td width="110"><select name="fPaG" id="fPaG" tabindex="0" style="width:100px; font-size:10pt; background:#FFFFFF; border:1px solid #999999" onchange="changePAGE('<?=$IdL?>')">
      <?php
	echo '<option selected value="100">100 Record</option>';
	echo '<option value="200">200 Record</option>';
	echo '<option value="300">300 Record</option>';
	echo '<option value="400">400 Record</option>';
	echo '<option value="500">500 Record</option>';
	?>
    </select></td>
    <td width="195" rowspan="2">
	<input type="button" name="BtnGO" id="BtnGO" value="GO" onclick="findDATA('<?=$IdL?>')" style="width:50px; height:45px" /></td>
    <td width="69" rowspan="2" align="center"><div id="loadingImg" style="width:40px; height:10px; display:none"><img src="Images/loading3.gif" alt="" width="30" height="30"></div></td>
  </tr>
  <tr height="23">
    <td align="right">Belanja </td>
    <td align="center">&nbsp;</td>
    <td colspan="2">
	<label><input name="fRadB" type="radio" value="_._" checked onchange="BtnGO.click()" />SEMUA</label>&nbsp;&nbsp;&nbsp;
	<label><input name="fRadB" type="radio" value="5.1" onchange="BtnGO.click()" />OPERASI</label>&nbsp;&nbsp;&nbsp;
	<label><input name="fRadB" type="radio" value="5.2" onchange="BtnGO.click()" />MODAL</label>&nbsp;&nbsp;&nbsp;
	<label><input name="fRadB" type="radio" value="5.3" onchange="BtnGO.click()" />TAK TERDUGA</label>	</td>
    <td align="right">Cari</td>
    <td align="center">&nbsp;</td>
    <td colspan="4"><input type="text" name="fFinM" id="fFinM" placeholder='Search' onkeypress="if (event.keyCode==13){findDATA('<?=$IdL?>');}" style="width:316px" /></td>
    </tr>
  <tr height="8">
    <td></td>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td colspan="4"></td>
    <td colspan="2"></td>
  </tr>
</table>
<table border="0" cellspacing="0" class="table-link" cellpadding="0" align="center" style="width:99%; height:20px; background: #CEFBE3; font-weight:bold">
  <tr style="text-align:center">
    <td width="33" style="border-right:1px solid #ccc">No</td>
    <td width="65" style="border-right:1px solid #ccc">Tanggal</td>
    <td width="130" style="border-right:1px solid #ccc">Referensi</td>
    <td width="433" style="border-right:1px solid #ccc">Program/Kegiatan/Sub Kegiatan/Belanja</td>
    <td width="150" style="border-right:1px solid #ccc">Kontrak</td>
    <td width="150" style="border-right:1px solid #ccc">BAST</td>
    <td width="123" style="border-right:1px solid #ccc">Nilai</td>
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
    <td valign="top">
	<div id="ViewPAGE" style="height:38px; width:100%; overflow:auto; border:0px"></div>
	</td>
  </tr>
</table>
</form>
</body>
</html>
<script languange="javascript">
	objfrm=document.myfrm;
	
	function findDATA(IdL)
	{
		$("#fA").val('0');
		$("#fB").val('0');
		RefreshDATA(IdL)
	}
	
	function changePAGE(IdL)
	{
		$("#fA").val('0');
		$("#fB").val('0');
		RefreshDATA(IdL)
	}
	
	function pageDATA(xA,xB,IdL)
	{
		$("#fA").val(xA);
		$("#fB").val(xB);
		
		RefreshDATA(IdL)
	}
	
	function RefreshDATA(IdL)
	{
		PerPage = $("#fPaG").val();
		
		PagA = $("#fA").val();
		PagB = $("#fB").val();
		
		FnD = ReplaceText($("#fFinM").val());
		UnT = ReplaceText($("#fUNT").val());
		SeM = $("#fSeM").val();
		ThN = $("#fThN").val();
		
		RaB = "";
		Len = objfrm.fRadB.length;
		for (i=0; i<=Len; i++)
		{
			if (objfrm.fRadB[i].checked) {RaB = objfrm.fRadB[i].value; break; }
		}
		
		$(document).ready(function()
		{
			$.ajax({
				url:'P47_CP_APBD_Data.php',
				data: {PerPage:PerPage,PagA:PagA,PagB:PagB,FnD:FnD,UnT:UnT,RaB:RaB,SeM:SeM,ThN:ThN,IdL:IdL},
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
			$("#ViewPAGE").load('P47_CP_APBD_Data_Pages.php?PerPage='+PerPage+'&PagA='+PagA+'&PagB='+PagB+'&UnT='+UnT+'&RaB='+RaB+'&SeM='+SeM+'&ThN='+ThN+'&FnD='+FnD+'&IdL='+IdL);
		});
	}	

	function showUNIT(CrT,IdL)
	{
		if (CrT=='find')
		{
			FnD = ReplaceText($("#findUnT").val());
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('P47_CP_APBD_Find_Unit_Mid.php?FnD='+FnD+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('unitDiv2Cri');
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('P47_CP_APBD_Find_Unit_Top.php?IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('P47_CP_APBD_Find_Unit_Mid.php?IdL='+IdL);
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
		}
		document.getElementById(crt+'MstCri').style.display = "none";
		$("#BtnGO").click();
	}
	
	function closeCLICK(crt)
	{
		document.getElementById(crt+'MstCri').style.display = "none";
	}

	function formVerifikasi(CrT,ReO,IdT,IdL)
	{
		if (CrT=='refr')
		{
			$(document).ready(function()
			{
				$("#lembDiv2Cri").load('P47_CP_APBD_Data_Veri_Mid.php?IdT='+IdT+'&ReO='+ReO+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('lembDiv2Cri');
			$(document).ready(function()
			{
				$("#lembDiv1Cri").load('P47_CP_APBD_Data_Veri_Top.php?IdT='+IdT+'&ReO='+ReO+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#lembDiv2Cri").load('P47_CP_APBD_Data_Veri_Mid.php?IdT='+IdT+'&ReO='+ReO+'&IdL='+IdL);
			});
			
			dispBlockOrNo('lembMstCri');
		}
	}
	
	function formPernyataan(CrT,ReO,IdT,IdL)
	{
		if (CrT=='refr')
		{
			$(document).ready(function()
			{
				$("#lembDiv2Cri").load('P47_CP_APBD_Data_Pern_Mid.php?IdT='+IdT+'&ReO='+ReO+'&IdL='+IdL);
			});
		}
		else
		{
			dispBLOCK('lembDiv2Cri');
			$(document).ready(function()
			{
				$("#lembDiv1Cri").load('P47_CP_APBD_Data_Pern_Top.php?IdT='+IdT+'&ReO='+ReO+'&IdL='+IdL);
			});
			
			$(document).ready(function()
			{
				$("#lembDiv2Cri").load('P47_CP_APBD_Data_Pern_Mid.php?IdT='+IdT+'&ReO='+ReO+'&IdL='+IdL);
			});
			
			dispBlockOrNo('lembMstCri');
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
	
	function saveRecordVeri(fld,NoID,val,NoM,IdT,IdL)
	{
		if (fld=='Jumlah' || fld=='Keterangan' || fld=='Deskripsi' || fld=='NmaVerifikator' || fld=='NipVerifikator' || fld=='JbtVerifikator' || fld=='TglVerifikasi')
		{
			val = val.value;
		}
		
		$(document).ready(function()
		{
			$("#loadingImg").show();
			$.post("P47_CP_APBD_Data_Veri_Mid_Save_Json.php",
			{"fld":fld,"NoID":NoID,"val":val,"NoM":NoM,"IdT":IdT,"IdL":IdL},
			function( data ) 
			{
				if (data['Mess']!='') {alert(data['Mess']);}
				formVerifikasi('refr','',IdT,IdL);
				$("#loadingImg").hide();
			},"json");
		});		
	}
	
	function saveRecordPern(fld,val,NoM,IdT,IdL)
	{
		//if (fld=='Jumlah' || fld=='Keterangan' || fld=='Deskripsi' || fld=='NmaVerifikator' || fld=='NipVerifikator' || fld=='JbtVerifikator' || fld=='TglVerifikasi')
		//{
			val = val.value;
		//}
		
		$(document).ready(function()
		{
			$("#loadingImg").show();
			$.post("P47_CP_APBD_Data_Pern_Mid_Save_Json.php",
			{"fld":fld,"val":val,"NoM":NoM,"IdT":IdT,"IdL":IdL},
			function( data ) 
			{
				if (data['Mess']!='') {alert(data['Mess']);}
				formPernyataan('refr','',IdT,IdL);
				$("#loadingImg").hide();
			},"json");
		});		
	}
	
</script>