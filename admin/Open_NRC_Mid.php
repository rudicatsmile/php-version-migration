<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
if (isset($_GET['gUnt'])) {$gUnt = $_GET['gUnt'];}
if (isset($_GET['gThn'])) {$gThn = $_GET['gThn'];}
if (isset($_GET['gAst'])) {$gAst = $_GET['gAst'];}
if ($gThn=="") {$gThn  = fGetDate('year');}
if (isset($_GET['MsG'])) {$MsG = $_GET['MsG'];} else {$MsG="";}
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Open_NRC_Mid_.php?IdL=".$_GET['IdL']?>">
  <input type="hidden" name="fSmP">
  <table border="0" align="center" style="width:600px">
    <tr>
      <td width="35">&nbsp;</td>
      <td width="113">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    
    <tr> 
      <td>&nbsp;</td>
      <td>UNIT KERJA</td>
      <td colspan="2"> 
        <select name="fUnt" tabindex="0" style="width: 420px">
		
        <?php
		if ($Lev > 1 )
			{$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit WHERE Kd_Unit = '".substr($SkP,0,11)."' ORDER BY Kd_Unit";}
		else
			{
			$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
			echo '<option value="All">All</option>';
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
				echo '<option '.$sel.' value="'.$mRo['Kd_Unit'].'">'.$mRo['Kd_Unit']." : ".strtoupper($mRo['Nm_Unit']).'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	  ?>
      </select> </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>ASET</td>
      <td colspan="2" valign="middle">
	  <select class="boxs" name="fAst" style="width: 260px" tabindex="0">
	  <option value="1.3.2" <?php if ($gAst=="1.3.2") {echo "selected";}?>>KIB-B ( <?="1.3.2 ".strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset","1.3.2","=","",DatabaseSB,$ConSB,""))?> )</option>
	  <option value="1.3.3" <?php if ($gAst=="1.3.3") {echo "selected";}?>>KIB-C ( <?="1.3.3 ".strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset","1.3.3","=","",DatabaseSB,$ConSB,""))?> )</option>
	  <option value="1.3.4" <?php if ($gAst=="1.3.4") {echo "selected";}?>>KIB-D ( <?="1.3.4 ".strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset","1.3.4","=","",DatabaseSB,$ConSB,""))?> )</option>
	  <option value="1.5.3" <?php if ($gAst=="1.5.3") {echo "selected";}?>>KIB-G ( <?="1.5.3 ".strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset","1.5.3","=","",DatabaseSB,$ConSB,""))?> )</option>
	  <option value="1.5.4" <?php if ($gAst=="1.5.4") {echo "selected";}?>>KIB-H ( <?="1.5.4 ".strtoupper(fGlobalNEW("Nm_Aset","ref_rek_aset108_3","Kd_Aset","1.5.4","=","",DatabaseSB,$ConSB,""))?> )</option>
      </select></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>TAHUN</td>
      <td colspan="2" valign="middle">
	  <select class="boxs" name="fThn" style="width: 60px" tabindex="0">
        <?php
			for($nThn=2016; $nThn<=2020; $nThn++)
			{
			$sel ="";
			//if ($gThn==$nThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
      </select>
	  </td>
    </tr>
    <tr> 
      <td colspan="4" align="center" valign="middle" height="30"><div id="loadingImg" style="width:0px; height:0px; display:none; vertical-align:middle; text-align:center"><img src="Images/loading3.gif" alt="" width="30" height="30"></div>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td width="155" valign="top"><input type="button" name="B01" value="REKAP" onclick="execFORM('<?=$_GET['IdL']?>')"  style="width: 60px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
      <input type="button" name="B02" value="CLOSE" onclick="P_Close()"  style="width: 60px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
      <td width="279">
	  <a href="#" class="ico prev" onclick="P_Dokumen('','850','450','1','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( NERACA )</a><br>
	  <!--
	  <a href="#" class="ico prev" onclick="P_Rekap('1','850','450','2','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( KIB ALL - BIDANG)</a><br>
	  <a href="#" class="ico prev" onclick="P_Rekap('2','850','450','2','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( KIB ALL - KELOMPOK)</a><br> 
	  <a href="#" class="ico prev" onclick="P_Rekap('3','850','450','2','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( KIB ALL - JENIS)</a><br>
	  <a href="#" class="ico prev" onclick="P_Rekap('4','850','450','2','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;Dokumen Rekap ( KIB ALL - OBJEK)</a>	  
	  -->
	  <div id="formDiv2Exec" style="color:#FF0000"></div>
	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2"><div id="ViewDATA" style="height:20px; width:500px; overflow:auto; display: block"></div></td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Dokumen(crt,w,h,nm,IdL)
	{
		var rAS = objfrm.fAst.value;
		var rTH = objfrm.fThn.value;
		var uNT = objfrm.fUnt.value;
		if (nm=='1') {nmF="Tabel_Rekap_Neraca_Bulan";}
		if (nm=='2') {nmF="Tabel_Rekap_Neraca_Bulan_Rinci";}
		
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(nmF+'.php?crt='+crt+'&uNT='+uNT+'&rTH='+rTH+'&rAS='+rAS+'&IdL='+IdL,'',settings);
	}
	
	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.fSmP.value = "Close";
		objfrm.submit();
	}

	function execFORM(IdL)
	{
		Unt = objfrm.fUnt.value;
		Thn = objfrm.fThn.value;
		Ast = objfrm.fAst.value;
		SmP = "Repair";
		var AN = confirm("Lanjutkan proses rekap neraca ..?!!");
		if (AN)
		{
			$(document).ready(function()
			{
				$.ajax({
					url:"Open_NRC_Mid_.php",
					data: {fSmP:SmP,fUnt:Unt,fThn:Thn,fAst:Ast,IdL:IdL},
					type:"get",
					beforeSend:function()
					{
						$("#formDiv2Exec").text('');
						$("#loadingImg").show();
					},
					success:function(data)
					{
						$("#loadingImg").hide();
						$("#formDiv2Exec").html(data);
						//$("#formDiv2Exec").text('Proses rekap selesai..!!');
					}
				});
			});
		}
	}
</script>

<?php require('Connection_Close.php');?>
