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
$gTH  = 2017;  //fGetDate('year');
$gHRd = 31;    //fGetDate('mday');
$gBLd = 12;    //fGetDate('mon');
$gTHd = 2017;  //fGetDate('year');
$gJNS = "AA";

#$Lev = 2;

$gTHN = fGetDate('year');

if ($gUNT==""){
	$gUNT="24.04.01.01";
}

if ($Lev > 1){
	$gUNT = substr($SkP,0,11);
	$dUNT = strtoupper(fGlobal("Nm_Unit","ref_unit","Kd_Unit",$gUNT,"=","",""));
}
?>
<body onload="RefreshDATA('<?=$IdL?>')">
<?php require "FileMenu.php";?>
<form name="myfrm" method="POST" action="">
<input type="hidden" name="fSave" style="width:50px" />
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:99%">
  <tr>
    <td width="21">&nbsp;</td>
    <td width="74">&nbsp;</td>
    <td width="20">&nbsp;</td>
    <td width="85">&nbsp;</td>
    <td width="43">&nbsp;</td>
    <td width="1048">&nbsp;</td>
    </tr>
  
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right"> UNIT KERJA </td>
    <td align="center">&nbsp;</td>
    <td colspan="3">
	<? 
	if ($Lev <= 1) {?>
		<select class="boxs" name="fUNT" tabindex="0" style="width:496px" onchange="RefreshDATA('<?=$IdL?>')">
		  <option value="ALL">ALL</option>
		  <?
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
    <? } else {?>
	<input name="fUNT" type="text" value="<?=$gUNT?>" readonly style="padding-left:5px; width:70px; border: 1px solid #C0C0C0"/>
	<input name="dUNT" type="text" value="<?=$dUNT?>" readonly style="padding-left:5px; width:406px; border: 1px solid #C0C0C0"/>
    <? } ?>	</td>
    </tr>
  <tr height="25">
    <td>&nbsp;</td>
    <td align="right">PERIODE</td>
    <td align="center">&nbsp;</td>
    <td>
	
	<select class="boxs" name="fTHN" tabindex="0" style="width:60px" onchange="RefreshDATA('<?=$IdL?>')">
      <!--option value="AA">ALL</option-->
	<?
	for ($i=2019; $i<=2030; $i++)
	{
		$sel ="";
		if ($i==$gTHN) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
    </select>
	</td>
    <td>FIND</td>
    <td style="padding-right:5px">
	  <input name="fFnD" type="text" value="" onkeypress="if (event.keyCode==13) {RefreshDATA('<?=$IdL?>'); return false;}" style="padding-left:5px; width:200px; border: 1px solid #C0C0C0"/>
      <input type="button" name="B39" value="GO" onclick="RefreshDATA('<?=$IdL?>')" style="width: 40px; height: 21px" />
      <div style="float:right">
	  <input type="hidden" name="B14" value="CETAK" onclick="showDOC('','800','400','<?=$_GET['IdL']?>')" style="width: 100px; height: 21px; color:#0000FF" />
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
    <td width="90">HARGA</td>
    <td width="90">NILAI AKHIR </td>
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
		var gFnD = ReplaceText(objfrm.fFnD.value);
		
		$(document).ready(function()
		{
			$("#ViewDATA").load('RPBMD_New_Data.php?gUnT='+gUnT+'&gFnD='+gFnD+'&gTHN='+gTHN+'&IdL='+IdL);
		});
		
		/*
		$(document).ready(function()
		{
			$.ajax({
				url:"Invent_Usulan_Data.php",
				data: {gUnT:gUnT,gHR:gHR,gBL:gBL,gTH:gTH,gHRd:gHRd,gBLd:gBLd,gTHd:gTHd,gFnD:gFnD,gJNS:gJNS,IdL:IdL},
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
		*/
	}
	
	function showEDIT(IdT,IdL)
	{
		window.open('RPBMD_New_Frm.php?FrmG=RENCANA PEMINDAHTANGANAN BARANG MILIK DAERAH&IdT='+IdT+'&IdL='+IdL,'_self');
	}
	
	function P_Dokumen(IdT,w,h,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='RPBMD_New_Dokumen.php?IdT='+IdT+'&IdL='+IdL;
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
		URL='RPBMD_New_DokumenX.php?IdT='+IdT+'&IdL='+IdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
		//closeCLICK('choise');
	}
	
	function showDELE(IdT,stLOCK,IdL)
	{
		if (stLOCK=='1'){alert('Access denied, data sudah terkunci..!!'); return false;}
		var AN = confirm("Hapus transaski usulan ini ..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$.ajax({
					url:"RPBMD_New_Data_Dell.php",
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
	
	/*
	function closeEXEC(crt,IdL)
	{
		document.getElementById('formMstExec').style.display = "none";
		//if (crt=='form') {RefreshDATA(IdL);}
	}
	
	function showFORM(crt,IdT,gIdL)
	{
		if (crt=='refr')
		{
			$(document).ready(function()
			{
				$("#formDiv2Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid.php?IdT='+IdT+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('formDiv2Veri').style.display = "block";
			$(document).ready(function()
			{
				$("#formDiv1Veri").load('Invent_Usulan_Veri_Frm_Veri_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#formDiv2Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid.php?IdT='+IdT+'&IdL='+gIdL);
			});
			
			if (document.getElementById('formMstVeri').style.display == "block")
			{
				document.getElementById('formMstVeri').style.display = "none";
			}
			else
			{
				document.getElementById('formMstVeri').style.display = "block";
			}
		}
	}
	*/
	/*
	function showEXEC_RefR(crt,IdT,gIdL)
	{
		$(document).ready(function()
		{
			$("#formDiv2Exec").load('Invent_Usulan_Exec_Frm_Mid.php?IdT='+IdT+'&IdL='+gIdL);
		});
	}
	
	function showEXEC(crt,IdT,gIdL)
	{
		document.getElementById('formDiv2Exec').style.display = "block";
		$(document).ready(function()
		{
			$("#formDiv1Exec").load('Invent_Usulan_Exec_Frm_Top.php?crt='+crt+'&IdL='+gIdL);
		});
		
		$(document).ready(function()
		{
			$("#formDiv2Exec").load('Invent_Usulan_Exec_Frm_Mid.php?IdT='+IdT+'&IdL='+gIdL);
		});
		
		if (document.getElementById('formMstExec').style.display == "block")
		{
			document.getElementById('formMstExec').style.display = "none";
		}
		else
		{
			document.getElementById('formMstExec').style.display = "block";
		}
	}
	
	function SaveDATA(rID,IdT,gIdL)
	{
		var gH  = objfrm.fH.value;
		var gB  = objfrm.fB.value;
		var gT  = objfrm.fT.value;
		var nO  = ReplaceText(objfrm.fNoM.value);
		var mE  = ReplaceText(objfrm.fMeM.value);
		var gNm = ReplaceText(objfrm.fNmA.value);
		var gJb = ReplaceText(objfrm.fJbT.value);
		var gNi = ReplaceText(objfrm.fNiP.value);
		
		$(document).ready(function()
		{
			$.ajax({
				url:"Invent_Usulan_Veri_Frm_Veri_Save.php",
				data: {gNm:gNm,gJb:gJb,gNi:gNi,nO:nO,mE:mE,gH:gH,gB:gB,gT:gT,rID:rID,IdT:IdT,IdL:gIdL},
				type:"get",
				beforeSend:function()
				{
					$("#loadingImg").show();
				},
				success:function(data)
				{
					$("#loadingImg").hide();
					$("#formDiv2Veri").html(data);
					$("#formDiv2Veri").show("fast");
				}
			});
		});
	}
	

	function unexecFORM(tID,IdT,IdL)
	{
		rBatal = 'YA';
		var AN = confirm("Batalkan eksekusi...?!!");
		if (AN)
		{
			//$(document).ready(function()
			//{
			//	$("#ViewDATA").load('Invent_Usulan_Exec_Frm_Save.php?rBatal='+rBatal+'&tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
			//	//$("#formDiv2Exec").load('Invent_Usulan_Exec_Frm_Save.php?tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
			//});
			
			
			$(document).ready(function()
			{
				$.ajax({
					url:"Invent_Usulan_Exec_Frm_Save.php",
					data: {rBatal:rBatal,tID:tID,IdT:IdT,IdL:IdL},
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
			
		}
	}
	
	function editFORM(crt,mS,tID,gIdL)
	{
		for (i=1; i<=100; i++)
		{
			mS = mS.replace('**',' ');
			mS = mS.replace('*^*','\n');
		}
		
		if (mS!=""){
			alert(mS); return false;
		}
		if (crt=='refr')
		{
			$(document).ready(function()
			{
				$("#editDiv2Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid_Edit_Mid.php?tID='+tID+'&IdL='+gIdL);
			});
		}
		else
		{
			document.getElementById('editDiv2Veri').style.display = "block";
			if (document.getElementById('editMstVeri').style.display == "block")
			{
				document.getElementById('editMstVeri').style.display = "none";
			}
			else
			{
				document.getElementById('editMstVeri').style.display = "block";
			}
			
			$(document).ready(function()
			{
				$("#editDiv1Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid_Edit_Top.php?IdL='+gIdL);
			});
			
			$(document).ready(function()
			{
				$("#editDiv2Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid_Edit_Mid.php?tID='+tID+'&IdL='+gIdL);
			});
		}
	}
	
	function saveRECO(fLD,rVal,mID,tID,gIdL)
	{
		var gVer="NO";
		if (fLD=='Memo') {
			rVal = ReplaceText(document.getElementById('fMeM'+mID).value);
		}
		if (fLD=='Fisik') {
			rVal = rVal;
		}
		
		if (fLD=='Status') {
			rVal = rVal;
		}
		
		$(document).ready(function()
		{
			$("#editDiv2Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid_Edit_Save.php?gVer='+gVer+'&fLD='+fLD+'&rVal='+rVal+'&mID='+mID+'&tID='+tID+'&IdL='+gIdL);
		});
	}
	
	function saveVERI(fLD,JnS,rVal,tID,gIdL)
	{
		var UnTo = objfrm.fUniT.value;
		if (JnS=="MS" && UnTo==""){alert('UNIT KERJA TUJUAN MUTASI belum lengkapi pada tahap usulan mutasi..!!');return false;}
		
		var gVer="YA";
		if (rVal=='Disetujui'){
			var mHri = document.getElementById('mHri').value;
			var mBln = document.getElementById('mBln').value;
			var mThn = document.getElementById('mThn').value;
			if (mHri=='00' || mBln=='00' || mThn=='0000'){
				alert('Silahkan tentukan tanggal mutasi terlebih dahulu..!!'); 
				return false;
			}
		}
		$(document).ready(function()
		{
			$("#editDiv2Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid_Edit_Save.php?gVer='+gVer+'&fLD='+fLD+'&rVal='+rVal+'&tID='+tID+'&IdL='+gIdL);
		});
	}

	function saveVERItgl(fLD,field,tID,gIdL)
	{
		var gVer="YA";
		var rVal = field.value
		$(document).ready(function()
		{
			$("#editDiv2Veri").load('Invent_Usulan_Veri_Frm_Veri_Mid_Edit_Save.php?gVer='+gVer+'&fLD='+fLD+'&rVal='+rVal+'&tID='+tID+'&IdL='+gIdL);
		});
	}
	
	function closeIMG()
	{
		document.getElementById('imgMstCri').style.display = "none";
	}
	
	function showIMG(CrT,tID,gIdL)
	{
		document.getElementById('imgDiv2Cri').style.display = "block";
		if (document.getElementById('imgMstCri').style.display == "block")
		{
			document.getElementById('imgMstCri').style.display = "none";
		}
		else
		{
			document.getElementById('imgMstCri').style.display = "block";
		}
		
		$(document).ready(function()
		{
			$("#imgDiv1Cri").load('Invent_Usulan_Veri_Frm_Data_Img_Top.php?CrT='+CrT+'&IdL='+gIdL);
		});
		
		$(document).ready(function()
		{
			$("#imgDiv2Cri").load('Invent_Usulan_Veri_Frm_Data_Img_Mid.php?CrT='+CrT+'&tID='+tID+'&IdL='+gIdL);
		});
	}
	
	
	function viewIMG(rIdT,w,h,gIdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL='Invent_Usulan_Frm_Data_Edit_Upl_Top_Vie.php?rIdT='+rIdT+'&IdL='+gIdL;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no,maximize=no,scrollbars=no,navigation=no';
		window.open(URL,'',settings);
	}

	function execFORM(KdA,JenS,tbl,wrn,exc,tID,IdT,IdL)
	{
		//alert(KdA.substring(0,2)); return false;
		if (JenS=="MK" && KdA.substring(0,2)!="07"){
			alert('Eksekusi MUTASI ANTAR KIB baru bisa digunakan dari KIB LAINNYA ke KIB (A,B,C,D,E), tools masih dalam proses..!!');
			return false;
		}
		if (tbl!='a' && tbl!='b' && tbl!='c' && tbl!='d' && tbl!='e' && tbl!='g'){
			alert('Eksekusi kib-'+tbl+' belum bisa dilakukan, tools masih dalam proses..!!');
			return false;
		}
		
		if (wrn=='Executed'){
			alert('Eksekusi sudah dilakukan..!!');
			return false;
		}
		if (exc!='Disetujui'){
			alert('Eksekusi belum bisa dilakukan, status verifikasi belum DISETUJUI..!!');
			return false;
		}
		var AN = confirm("Lanjutkan proses eksekusi usulan..?!!");
		if (AN)
		{
			//$(document).ready(function()
			//{
			//	$("#ViewDATA").load('Invent_Usulan_Exec_Frm_Save.php?tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
			//	//$("#formDiv2Exec").load('Invent_Usulan_Exec_Frm_Save.php?tID='+tID+'&IdT='+IdT+'&IdL='+IdL);
			//});
						
			$(document).ready(function()
			{
				$.ajax({
					url:"Invent_Usulan_Exec_Frm_Save.php",
					data: {tID:tID,IdT:IdT,IdL:IdL},
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
		}
	}
	*/
</script>