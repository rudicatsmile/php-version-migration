<?php require "connfile.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>SIMBAD@</title>
<link rel="stylesheet" href="css/style_new.css" type="text/css" media="all" />
</head>
<body>
<form name="myfrm" method="post" action="">
  <input type="hidden" name="fSimpan">
  <div id="AddUser" style="width:0px; height:0px; display:none"></div>
    <table width="623" border="0" cellspacing="3" cellpadding="0" style="font-family:Calibri; font-size:9pt">
      <tr valign="top">
        <td align="left">&nbsp;</td>
        <td colspan="2" align="left" style=" border-bottom:3px double #666666; font-family:calibri; font-weight:normal; font-size:12pt; text-shadow: #999933 1px 1px 0px ">:: REGISTER USER BARU</td>
      </tr>
      <tr valign="top">
        <td align="left">&nbsp;</td>
        <td align="left">&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr valign="top">
        <td width="17" align="left">&nbsp;</td>
        <td width="119" align="left">User Id</td>
        <td width="475" align="left"><input name="fUid" id="fUid" type="text" value="" style="width:150px"/> ** 
		  </td>
      </tr>
      <tr valign="top">
        <td width="17" align="left" >&nbsp;</td>
        <td width="119" align="left">Password</td>
        <td width="475" align="left"><input name="fPasA" id="fPasA" type="Password" class="text" value="" style="width:150px"/> ** 
		</td>
      </tr>
      <tr valign="top">
        <td width="17" align="left">&nbsp;</td>
        <td width="119" align="left">Retype Password</td>
        <td width="475" align="left"><input name="fPasB" id="fPasB" type="Password" class="text" value="" style="width:150px"/> ** 
		</td>
      </tr>
      <tr valign="top">
        <td align="left">&nbsp;</td>
        <td align="left">Nama Lengkap</td>
        <td align="left"><input name="fNmaA" id="fNmaA" type="text" class="text" value="" style="width:250px"/></td>
      </tr>
      <tr valign="top">
        <td align="left">&nbsp;</td>
        <td align="left">Unit Kerja</td>
        <td align="left">
		<input name="fUntK" id="fUntK" type="text" class="text" readonly value="" onClick="showUNIT('')" style="width:65px"/>
		<input name="fUntD" id="fUntD" type="text" class="text" value="" onClick="showUNIT('')" onkeypress="if (event.keyCode==13) {showUNIT('find'); return false;} else if (event.keyCode==27) {closeCLICK('unit'); return false;}" style="width:330px"/>
		<div id="unitMstCri" class="find0Cri">
			<div id="unitDiv1Cri" class="find1Cri"></div>
			<div id="unitDiv2Cri" class="find2Cri"></div>
		</div>
		</td>
      </tr>
      <tr valign="top">
        <td align="left">&nbsp;</td>
        <td align="left">Sub Unit Kerja</td>
        <td align="left">
		<input name="fSubK" id="fSubK" type="text" class="text" readonly value="" onClick="showSUB('')" style="width:80px"/>
		<input name="fSubD" id="fSubD" type="text" class="text" value="" onClick="showSUB('')" style="width:315px"/>
		<div id="subMstCri" class="find0Cri">
			<div id="subDiv1Cri" class="find1Cri"></div>
			<div id="subDiv2Cri" class="find2Cri"></div>
		</div>	  
		</td>
      </tr>
      <tr valign="top">
        <td align="left">&nbsp;</td>
        <td align="left">UPB</td>
        <td align="left">
		<input name="fUpbK" id="fUpbK" type="text" class="text" readonly onclick="showUPB('')" value="" style="width:95px"/>
		<input name="fUpbD" id="fUpbD" type="text" class="text" value="" onclick="showUPB('')" style="width:300px"/>
		<div id="upbMstCri" class="find0Cri">
			<div id="upbDiv1Cri" class="find1Cri"></div>
			<div id="upbDiv2Cri" class="find2Cri"></div>
		</div>	  
		</td>
      </tr>
      <tr valign="top">
        <td align="left">&nbsp;</td>
        <td align="left">Deskripsi Tugas</td>
        <td align="left"><textarea name="fKeT" id="fKeT" style="width:404px; height:40px"></textarea></td>
      </tr>
      <tr valign="top">
        <td align="left">&nbsp;</td>
        <td align="left">&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
      <tr valign="top">
        <td align="left">&nbsp;</td>
        <td align="left">&nbsp;</td>
        <td align="left"><input type="button" name="B39" value="Submit" onclick="P_Save()" style="height:22; width:70px"/></td>
      </tr>
      <tr>
        <td align="left">&nbsp;</td>
        <td align="left">&nbsp;</td>
        <td align="left">&nbsp;</td>
      </tr>
</table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function showUNIT(CrT)
	{
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.fUntD.value);
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('reg_user_find_unit_mid.php?gFnD='+gFnD);
			});
		}
		else
		{
			document.getElementById('subMstCri').style.display = "none";
			document.getElementById('upbMstCri').style.display = "none";
			
			document.getElementById('unitDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#unitDiv1Cri").load('reg_user_find_unit_top.php');
			});
			
			$(document).ready(function()
			{
				$("#unitDiv2Cri").load('reg_user_find_unit_mid.php');
			});
			
			if (document.getElementById('unitMstCri').style.display == "block")
			{
				document.getElementById('unitMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('unitMstCri').style.display = "block";
			}
		}
	}
	
	function showSUB(CrT)
	{
		var fUNT = objfrm.fUntK.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.fSubD.value);
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('reg_user_find_sub_mid.php?gFnD='+gFnD+'&gUNT='+fUNT);
			});
		}
		else
		{
			document.getElementById('upbMstCri').style.display = "none";
			
			if (!fUNT) {alert('Silahkan pilih Unit Kerja terlebih dahulu..!!'); return false;}
			document.getElementById('subDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#subDiv1Cri").load('reg_user_find_sub_top.php');
			});
			
			$(document).ready(function()
			{
				$("#subDiv2Cri").load('reg_user_find_sub_mid.php?gUNT='+fUNT);
			});
			
			if (document.getElementById('subMstCri').style.display == "block")
			{
				document.getElementById('subMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('subMstCri').style.display = "block";
			}
		}
	}
	
	function showUPB(CrT)
	{
		var fSUB  = objfrm.fSubK.value;
		if (CrT=='find')
		{
			var gFnD = ReplaceText(objfrm.fUpbD.value);
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('reg_user_find_upb_mid.php?gFnD='+gFnD+'&gSUB='+fSUB);
			});
		}
		else
		{
			if (!fSUB) {alert('Silahkan pilih Sub Unit terlebih dahulu..!!'); return false;}
			document.getElementById('upbDiv2Cri').style.display = "block";
			$(document).ready(function()
			{
				$("#upbDiv1Cri").load('reg_user_find_upb_top.php');
			});
			
			$(document).ready(function()
			{
				$("#upbDiv2Cri").load('reg_user_find_upb_mid.php?gSUB='+fSUB);
			});
			
			if (document.getElementById('upbMstCri').style.display == "block")
			{
				document.getElementById('upbMstCri').style.display = "none";
			}
			else
			{
				document.getElementById('upbMstCri').style.display = "block";
			}
		}
	}	
	
	function ReplaceText(gFnD)
	{
		for (i=1; i<=100; i++)
		{
			gFnD = gFnD.replace(' ','**');
		}
		return gFnD;
	}
	
	function closeCLICK(crt)
	{
		document.getElementById(crt+'MstCri').style.display = "none";
	}
	
	function showCLICK(crt,kde,nma)
	{
		if (crt=='unit') 
		{
			objfrm.fUntK.value = kde;
			objfrm.fUntD.value = nma;
			
			objfrm.fSubK.value = '';
			objfrm.fSubD.value = '';
			
			objfrm.fUpbK.value = '';
			objfrm.fUpbD.value = '';
		}
		if (crt=='sub') 
		{
			objfrm.fSubK.value = kde;
			objfrm.fSubD.value = nma;
			
			objfrm.fUpbK.value = '';
			objfrm.fUpbD.value = '';
		}
		if (crt=='upb') 
		{
			objfrm.fUpbK.value = kde;
			objfrm.fUpbD.value = nma;
		}
		document.getElementById(crt+'MstCri').style.display = "none";
	}	
	
	function P_Save()
	{
		var gUid = ReplaceText(document.getElementById('fUid').value);
		var gPsA = ReplaceText(document.getElementById('fPasA').value);
		var gPsB = ReplaceText(document.getElementById('fPasB').value);
		
		var gNmA = ReplaceText(document.getElementById('fNmaA').value);
		var gUnT = document.getElementById('fUntK').value;
		var gSuB = document.getElementById('fSubK').value;
		var gUpB = document.getElementById('fUpbK').value;
		var gKeT = ReplaceText(document.getElementById('fKeT').value);
		
		if (gUid=="")   {alert('User id belum terisi..!!'); return false;}
		if (gPsA=="")   {alert('Password belum terisi..!!'); return false;}
		if (gPsB=="")   {alert('Retype Password belum terisi..!!'); return false;}
		if (gUpB=="")   {alert('Unit / Sub / Upb kerja belum dipilih..!!'); return false;}
		
		if (gUid.length < 5)   {alert('User tidak boleh kurang dari 5 digit..!!'); return false;}
		if (gPsA.length < 5)   {alert('Password tidak boleh kurang dari 5 digit..!!'); return false;}
		if (gPsA!=gPsB) {alert('Retype password tidak sesuai, mohon dicek ulang..!!'); return false;}
		
		$(document).ready(function()
		{
			$("#AddUser").load('reg_user_add_.php?gUid='+gUid+'&gPsA='+gPsA+'&gNmA='+gNmA+'&gUnT='+gUnT+'&gSuB='+gSuB+'&gUpB='+gUpB+'&gKeT='+gKeT);
		});
	}
	
	function retFeddback(xA)
	{
		if (xA=='OK'){
			alert('Proses registrasi berhasil...!!\nUntuk aktivasi user anda silahkan hubungi administrator.\nTerima kasih.');
			window.open('index.php','_self','');
		}
		else{
			alert('User sudah digunakan, silahkan ulangi dan gunakan user yang lain..!!');
		}
	}
</script>

