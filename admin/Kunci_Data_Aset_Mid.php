<?php require "CheckSession.php"?>
<?php require "Connection.php"?>
<?php require "FileFunction.php"?>
<?php require "CheckLogin.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<?php
if (isset($_GET['gUnt'])) {
	$gUnt = $_GET['gUnt'];
} else {
	$gUnt = substr($SkP,0,11);
}

if (isset($_GET['gThn'])) {
	$gThn = $_GET['gThn'];
} else {
	$gThn = 2015;
}

$gKibA="N";
$gKibB="N";
$gKibC="N";
$gKibD="N";
$gKibE="N";
$gKibF="N";
$gKibG="N";

$gKibAb="N";
$gKibBb="N";
$gKibCb="N";
$gKibDb="N";
$gKibEb="N";
$gKibFb="N";
$gKibGb="N";

$CeK = fGlobal("IDT","ta_kib_lock","SKPD:Tahun",$gUnt.":2014","=:=","","");
if (!$CeK)
{
	$SQ="INSERT INTO ta_kib_lock SET SKPD='$gUnt', Tahun='2014', Recorded=now(), Pencatat='$UID'";
	$rs=mysql_query($SQ);
}
else
{
	$DaT = fGlobal("Kib_A:Kib_B:Kib_C:Kib_D:Kib_E:Kib_F:Kib_G","ta_kib_lock","IDT",$CeK,"=","","");	
	if ($DaT)
	{
		$DaT = explode(':',$DaT);
		$gKibA = $DaT[0];
		$gKibB = $DaT[1];
		$gKibC = $DaT[2];
		$gKibD = $DaT[3];
		$gKibE = $DaT[4];
		$gKibF = $DaT[5];
		$gKibG = $DaT[6];
	}
}

$CeK = fGlobal("IDT","ta_kib_lock","SKPD:Tahun",$gUnt.":".$gThn,"=:=","","");
if (!$CeK)
{
	$SQ="INSERT INTO ta_kib_lock SET SKPD='$gUnt', Tahun='$gThn', Recorded=now(), Pencatat='$UID'";
	$rs=mysql_query($SQ);
}
else
{
	$DaG = fGlobal("Kib_A:Kib_B:Kib_C:Kib_D:Kib_E:Kib_F:Kib_G","ta_kib_lock","IDT",$CeK,"=","","");	
	if ($DaG)
	{
		$DaG = explode(':',$DaG);
		$gKibAb = $DaG[0];
		$gKibBb = $DaG[1];
		$gKibCb = $DaG[2];
		$gKibDb = $DaG[3];
		$gKibEb = $DaG[4];
		$gKibFb = $DaG[5];
		$gKibGb = $DaG[6];
	}
}
?>

<body>
<form name="myfrm" method="post" action="<?php echo "Kunci_Data_Aset_Mid_.php?IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Proses">
  <table border="0" align="center" style="width:700px">
    <tr> 
      <td>&nbsp;</td>
      <td width="628">&nbsp;</td>
    </tr>
    <tr> 
      <td width="62">SKPD</td>
      <td>
	  <select name="fUnt" tabindex="0" style="width: 500px" onchange="this.form.submit()">
          <?php
		$nSQ = "SELECT Kd_Unit, Nm_Unit FROM ref_unit ORDER BY Kd_Unit";
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
        </select> </td>
    </tr>
    
    <tr>
      <td colspan="2">
	  <table border="0" align="center" style="width:100%">
	  <tr>
	    <td width="10%">S.D TAHUN	      </td>
	    <td width="35%"><input name="f2014" type="text" value="2014" readonly style=" width:50px; text-align: center; border: 1px solid #C0C0C0; padding-left: 3px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px"/></td>
	    <td width="8%">TAHUN</td>
	    <td width="47%">
		<select name="fThn" tabindex="0" style="width: 70px; color:#FF0000" onchange="this.form.submit()">
		<?php
		for ($i=2015; $i<=2030; $i++) 
		{
			$CK="";
			if ($i==$gThn) {$CK="selected";}
			echo "<option ".$CK." value='".$i."'>".$i."</option>";
		} 
		?>
		</select>
		</td>
	  </tr>
	  <tr height="5">
	    <td colspan="2"></td>
	    <td colspan="2"></td>
	  </tr>
	  <tr>
	    <td colspan="2"><div id="div" style="border-radius: 4px; border:1px solid #999999; background-color:#fff; width:260px; height:158px">
          <table border="0" align="center" style="width:260px">
            <tr height="5">
              <td width="16"></td>
              <td colspan="2"></td>
              <td width="75"></td>
              <td></td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td width="37">KIB A </td>
              <td width="12">-&gt;</td>
              <td><label <?php if ($gKibA=="N") {echo "style='color:#0000FF'";} ?>><input name="fKibA" type="radio" value="N" <?php if ($gKibA=="N") {echo "checked";}?> />&nbsp;UnLock</label></td>
              <td><label <?php if ($gKibA=="Y") {echo "style='color:#FF0000'";} ?>><input name="fKibA" type="radio" value="Y" <?php if ($gKibA=="Y") {echo "checked";}?> />&nbsp;Lock</label></td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td>KIB B </td>
              <td>-&gt;</td>
              <td><label <?php if ($gKibB=="N") {echo "style='color:#0000FF'";} ?>><input name="fKibB" type="radio" value="N" <?php if ($gKibB=="N") {echo "checked";}?> />&nbsp;UnLock</label></td>
              <td><label <?php if ($gKibB=="Y") {echo "style='color:#FF0000'";} ?>><input name="fKibB" type="radio" value="Y" <?php if ($gKibB=="Y") {echo "checked";}?> />&nbsp;Lock</label></td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td>KIB C </td>
              <td>-&gt;</td>
              <td><label <?php if ($gKibC=="N") {echo "style='color:#0000FF'";} ?>><input name="fKibC" type="radio" value="N" <?php if ($gKibC=="N") {echo "checked";}?> />&nbsp;UnLock</label></td>
              <td><label <?php if ($gKibC=="Y") {echo "style='color:#FF0000'";} ?>><input name="fKibC" type="radio" value="Y" <?php if ($gKibC=="Y") {echo "checked";}?> />&nbsp;Lock</label></td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td>KIB D </td>
              <td>-></td>
              <td><label <?php if ($gKibD=="N") {echo "style='color:#0000FF'";} ?>><input name="fKibD" type="radio" value="N" <?php if ($gKibD=="N") {echo "checked";}?> />&nbsp;UnLock</label></td>
              <td><label <?php if ($gKibD=="Y") {echo "style='color:#FF0000'";} ?>><input name="fKibD" type="radio" value="Y" <?php if ($gKibD=="Y") {echo "checked";}?> />&nbsp;Lock</label></td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td>KIB E </td>
              <td>-></td>
              <td><label <?php if ($gKibE=="N") {echo "style='color:#0000FF'";} ?>><input name="fKibE" type="radio" value="N" <?php if ($gKibE=="N") {echo "checked";}?> />&nbsp;UnLock</label></td>
              <td><label <?php if ($gKibE=="Y") {echo "style='color:#FF0000'";} ?>><input name="fKibE" type="radio" value="Y" <?php if ($gKibE=="Y") {echo "checked";}?> />&nbsp;Lock</label></td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td>KIB F </td>
              <td>-></td>
              <td><label <?php if ($gKibF=="N") {echo "style='color:#0000FF'";} ?>><input name="fKibF" type="radio" value="N" <?php if ($gKibF=="N") {echo "checked";}?> />&nbsp;UnLock</label></td>
              <td><label <?php if ($gKibF=="Y") {echo "style='color:#FF0000'";} ?>><input name="fKibF" type="radio" value="Y" <?php if ($gKibF=="Y") {echo "checked";}?> />&nbsp;Lock</label></td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td>KIB G </td>
              <td>-></td>
              <td><label <?php if ($gKibG=="N") {echo "style='color:#0000FF'";} ?>><input name="fKibG" type="radio" value="N" <?php if ($gKibG=="N") {echo "checked";}?> />&nbsp;UnLock</label></td>
              <td><label <?php if ($gKibG=="Y") {echo "style='color:#FF0000'";} ?>><input name="fKibG" type="radio" value="Y" <?php if ($gKibG=="Y") {echo "checked";}?> />&nbsp;Lock</label></td>
            </tr>
          </table>
	      </div></td>
	    <td colspan="2"><div id="div2" style="border-radius: 4px; border:1px solid #999999; background-color:#fff; width:260px; height:158px">
          <table border="0" align="center" style="width:260px">
            <tr height="5">
              <td width="16"></td>
              <td colspan="2"></td>
              <td width="75"></td>
              <td></td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td width="37">KIB A </td>
              <td width="12">-&gt;</td>
              <td><label <?php if ($gKibAb=="N") {echo "style='color:#0000FF'";}?>><input name="fKibAb" type="radio" value="N" <?php if ($gKibAb=="N") {echo "checked";}?> />&nbsp;UnLock</label></td>
              <td><label <?php if ($gKibAb=="Y") {echo "style='color:#FF0000'";}?>><input name="fKibAb" type="radio" value="Y" <?php if ($gKibAb=="Y") {echo "checked";}?> />&nbsp;Lock</label></td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td>KIB B </td>
              <td>-&gt;</td>
              <td><label <?php if ($gKibBb=="N") {echo "style='color:#0000FF'";}?>><input name="fKibBb" type="radio" value="N" <?php if ($gKibBb=="N") {echo "checked";}?> />&nbsp;UnLock</label></td>
              <td><label <?php if ($gKibBb=="Y") {echo "style='color:#FF0000'";}?>><input name="fKibBb" type="radio" value="Y" <?php if ($gKibBb=="Y") {echo "checked";}?> />&nbsp;Lock</label></td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td>KIB C </td>
              <td>-&gt;</td>
              <td><label <?php if ($gKibCb=="N") {echo "style='color:#0000FF'";}?>><input name="fKibCb" type="radio" value="N" <?php if ($gKibCb=="N") {echo "checked";}?> />&nbsp;UnLock</label></td>
              <td><label <?php if ($gKibCb=="Y") {echo "style='color:#FF0000'";}?>><input name="fKibCb" type="radio" value="Y" <?php if ($gKibCb=="Y") {echo "checked";}?> />&nbsp;Lock</label></td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td>KIB D </td>
              <td>-&gt;</td>
              <td><label <?php if ($gKibDb=="N") {echo "style='color:#0000FF'";}?>><input name="fKibDb" type="radio" value="N" <?php if ($gKibDb=="N") {echo "checked";}?> />&nbsp;UnLock</label></td>
              <td><label <?php if ($gKibDb=="Y") {echo "style='color:#FF0000'";}?>><input name="fKibDb" type="radio" value="Y" <?php if ($gKibDb=="Y") {echo "checked";}?> />&nbsp;Lock</label></td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td>KIB E </td>
              <td>-&gt;</td>
              <td><label <?php if ($gKibEb=="N") {echo "style='color:#0000FF'";}?>><input name="fKibEb" type="radio" value="N" <?php if ($gKibEb=="N") {echo "checked";}?> />&nbsp;UnLock</label></td>
              <td><label <?php if ($gKibEb=="Y") {echo "style='color:#FF0000'";}?>><input name="fKibEb" type="radio" value="Y" <?php if ($gKibEb=="Y") {echo "checked";}?> />&nbsp;Lock</label></td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td>KIB F </td>
              <td>-&gt;</td>
              <td><label <?php if ($gKibFb=="N") {echo "style='color:#0000FF'";}?>><input name="fKibFb" type="radio" value="N" <?php if ($gKibFb=="N") {echo "checked";}?> />&nbsp;UnLock</label></td>
              <td><label <?php if ($gKibFb=="Y") {echo "style='color:#FF0000'";}?>><input name="fKibFb" type="radio" value="Y" <?php if ($gKibFb=="Y") {echo "checked";}?> />&nbsp;Lock</label></td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td>KIB G </td>
              <td>-></td>
              <td><label <?php if ($gKibGb=="N") {echo "style='color:#0000FF'";}?>><input name="fKibGb" type="radio" value="N" <?php if ($gKibGb=="N") {echo "checked";}?> />&nbsp;UnLock</label></td>
              <td><label <?php if ($gKibGb=="Y") {echo "style='color:#FF0000'";}?>><input name="fKibGb" type="radio" value="Y" <?php if ($gKibGb=="Y") {echo "checked";}?> />&nbsp;Lock</label></td>
            </tr>
          </table>
	      </div></td>
	    </tr>
	  <tr>
	    <td colspan="2">&nbsp;</td>
	    <td colspan="2">&nbsp;</td>
	    </tr>
	  </table>	  </td>
    </tr>
    <tr>
      <td colspan="2"><input type="button" name="B1" value="SAVE" onclick="P_Proses('<?=$Lev?>')"  style="width: 60px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
      <input type="button" name="B3" value="CLOSE" onclick="P_Close()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
    </tr>
    
    <tr> 
      <td>&nbsp;</td>
      <td valign="middle" style="color:#FF0000"> 
        <?php if (isset($_GET['MsG'])) {echo $_GET['MsG'];}?>
        &nbsp;</td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td valign="middle">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;

	function P_Proses(lev)
	{
		if (lev > 1) {alert('Access denied..!!'); return false;}
		var AN = confirm("Proses..?!!");
		if (AN)
		{
			objfrm.Proses.value = "Proses";
			objfrm.submit();
		}
	}

	function P_Close()
	{
		objfrm.target = "_top";
		objfrm.Proses.value = "Close";
		objfrm.submit();
	}
</script>

<?php require('Connection_Close.php');?>
