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
<? 
if (isset($_POST['Simpan']))
{
	if ($_POST['Simpan']=="Close") 
	{
		?>
		<script LANGUAGE="JavaScript">            
		this.setTimeout("self.close()",0)
		</script>
		<? 
	}
}

if (isset($_GET['rCrt'])) {$rCrt = $_GET['rCrt'];}
if ($gThA=="") {$gThA = 1890;}
if ($gThB=="") {$gThB = (fGetDate('year')-1);}
?>

<body>
<form name="myfrm" method="post" action="<?php echo "Open_Rekap_AllSKPD_Mid.php?IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Simpan">
  <table border="0" align="center" style="width:500px">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td width="44">&nbsp;</td>
      <td width="197">&nbsp;</td>
      <td width="873">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>TAHUN</td>
      <td valign="middle"> <select class="boxs" name="fThA" style="width: 60px" tabindex="0">
          <?
		for($nThA=1800; $nThA<=2030; $nThA++)
		{
			$sel ="";
			if ($gThA==$nThA) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThA.'">'.$nThA.'</option>';
		}
		?>
        </select> &nbsp; &nbsp; S.D &nbsp; <select class="boxs" name="fThB" style="width: 60px" tabindex="0">
          <?
		for($nThB=1900; $nThB<=2030; $nThB++)
		{
			$sel ="";
			if ($gThB==$nThB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThB.'">'.$nThB.'</option>';
		}
		?>
        </select> </td>
    </tr>
    <tr> 
      <td></td>
      <td>ASET</td>
      <td valign="middle">
	  <select class="boxs" name="fExt" style="width: 120px" tabindex="0">
		<option <? if ($gExt=="All") {echo "selected";} ?> value="All">ALL</option>
		<option <? if ($gExt=="N") {echo "selected";} ?> value="N">A S E T</option>
		<option <? if ($gExt=="Y") {echo "selected";} ?> value="Y">EXTRACOMP</option>
	  </select>
	  </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="middle"><input type="button" name="B36" value="OPEN" onclick="P_View_Report('800','400','<? echo $rCrt?>')"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
        <input type="button" name="B362" value="CLOSE" onclick="P_Close()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /> 
      </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_View_Report(w,h,crt)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		
		gThA = objfrm.fThA.value;
		gThB = objfrm.fThB.value;
		gExt = objfrm.fExt.value;
		
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL = "Lap_Rekapitulasi_PerSKPD_"+crt+".php?gExt="+gExt+"&gThA="+gThA+"&gThB="+gThB+"<?="&IdL=".$_GET['IdL']?>";
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
	
	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.Simpan.value = "Close";
		objfrm.submit();
	}

</script>