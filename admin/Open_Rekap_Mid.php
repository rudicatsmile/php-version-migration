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
extract($_GET);
extract($_POST);
if (isset($Simpan))
{
	if ($Simpan=="Close") 
	{
		?>
		<script LANGUAGE="JavaScript">            
		this.setTimeout("self.close()",0)
		</script>
		<?php 
	}
}

if (isset($fBdg)) {$gBdg  = $fBdg;}
if ($gThA=="") {$gThA = 2000;}
if ($gThB=="") {$gThB = fGetDate('year');}

$gHri  = fGetDate('mday');
$gBln  = fGetDate('mon');
$gThn  = fGetDate('year');

$gThD = fGetDate('year')+1;
?>

<body>
<form name="myfrm" method="post" action="<?php echo "Open_Rekap_Mid.php?IdL=".$IdL?>">
  <input type="hidden" name="Simpan">
  <table border="0" align="center" style="width:550px">
    <tr> 
      <td width="31">&nbsp;</td>
      <td width="113">&nbsp;</td>
      <td width="392">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>BIDANG</td>
      <td> 
        <select name="fBdg" tabindex="0" style="width: 250px">
        <?php
		$nSQ = "SELECT * FROM ref_rek_aset1 ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			if ($gBdg=="") {$gBdg=$mRo['Kd_Aset'];}
			do
			{
				$sel ="";
				if ($mRo['Kd_Aset']==$gBdg) 
				{
				$sel = "selected";
				$gBdg= $mRo['Kd_Aset'];
				}
				echo '<option '.$sel.' value="'.$mRo['Kd_Aset'].'">'.$mRo['Kd_Aset']." : ".$mRo['Nm_Aset'].'</option>';
			}
			while ($mRo = mysql_fetch_assoc($nRs));	
		}
	    ?>
        </select>		</td>
    </tr>
    
    <tr> 
      <td>&nbsp;</td>
      <td>TAHUN</td>
      <td valign="middle">
		<select class="boxs" name="fThA" style="width: 60px" tabindex="0">
		<?php
			for($nThA=$gThD; $nThA>=1890; $nThA--)
			{
				$sel ="";
				if ($gThA==$nThA) {$sel ="selected";}
				echo '<option '.$sel.' value="'.$nThA.'">'.$nThA.'</option>';
			}
		?>
		</select>&nbsp;
		&nbsp; S.D &nbsp;
		<select class="boxs" name="fThB" style="width: 60px" tabindex="0">
		<?php
		for($nThB=$gThD; $nThB>=1890; $nThB--)
		{
			$sel ="";
			if ($gThB==$nThB) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThB.'">'.$nThB.'</option>';
		}
		?>
		</select>		</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>TANGGAL CETAK </td>
      <td valign="middle">
	  <select class="boxs" name="frHri" tabindex="0">
        <?php
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$gHri) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
        </select> &nbsp; <select class="boxs" name="frBln" tabindex="0">
          <?php
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$gBln) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
        </select> &nbsp; <select class="boxs" name="frThn" style="width: 60px" tabindex="0">
          <?php
			for($nThn=1900; $nThn<=2030; $nThn++)
			{
			$sel ="";
			if ($nThn==$gThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
			}
			?>
        </select>
	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>PENANDATANGAN</td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td valign="middle"><input type="button" name="B36" value="OPEN" onclick="P_View_Report('800','400','<?=$IdL?>')"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B362" value="CLOSE" onclick="P_Close()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />      </td>
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
	function P_View_Report(w,h,IdL)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		
		var gBdg=objfrm.fBdg.value;
		var gThA=objfrm.fThA.value;
		var gThB=objfrm.fThB.value;
		
		var frHri = objfrm.frHri.value;
		var frBln = objfrm.frBln.value;
		var frThn = objfrm.frThn.value;
		
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL = "Lap_Rekap_Kelompok.php?gBdg="+gBdg+"&gThA="+gThA+"&gThB="+gThB+'&frHri='+frHri+'&frBln='+frBln+'&frThn='+frThn+'&IdL='+IdL;
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