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

#$CeKa = fGlobal("count(*)","ta_kib_a","kd_upb:TarikKeTakKib108:tgl_perolehan:No_Pengadaan",$gUnt."%:N:2020-%-%:","LIKE:=:LIKE:<>","","");
#$CeKb = fGlobal("count(*)","ta_kib_b","kd_upb:TarikKeTakKib108:tgl_perolehan:No_Pengadaan",$gUnt."%:N:2020-%-%:","LIKE:=:LIKE:<>","","");
#$CeKc = fGlobal("count(*)","ta_kib_c","kd_upb:TarikKeTakKib108:tgl_perolehan:No_Pengadaan",$gUnt."%:N:2020-%-%:","LIKE:=:LIKE:<>","","");
#$CeKd = fGlobal("count(*)","ta_kib_d","kd_upb:TarikKeTakKib108:tgl_perolehan:No_Pengadaan",$gUnt."%:N:2020-%-%:","LIKE:=:LIKE:<>","","");
#$CeKe = fGlobal("count(*)","ta_kib_e","kd_upb:TarikKeTakKib108:tgl_perolehan:No_Pengadaan",$gUnt."%:N:2020-%-%:","LIKE:=:LIKE:<>","","");
#$CeKf = fGlobal("count(*)","ta_kib_f","kd_upb:TarikKeTakKib108:tgl_perolehan:No_Pengadaan",$gUnt."%:N:2020-%-%:","LIKE:=:LIKE:<>","","");
#$CeKg = fGlobal("count(*)","ta_kib_g","kd_upb:TarikKeTakKib108:tgl_perolehan:No_Pengadaan",$gUnt."%:N:2020-%-%:","LIKE:=:LIKE:<>","","");

$CeKa = fGlobal("count(*)","ta_kib_a","kd_upb:TarikKeTakKib108:tgl_perolehan",$gUnt."%:N:%-%-%","LIKE:=:LIKE","","");
$CeKb = fGlobal("count(*)","ta_kib_b","kd_upb:TarikKeTakKib108:tgl_perolehan",$gUnt."%:N:%-%-%","LIKE:=:LIKE","","");
$CeKc = fGlobal("count(*)","ta_kib_c","kd_upb:TarikKeTakKib108:tgl_perolehan",$gUnt."%:N:%-%-%","LIKE:=:LIKE","","");
$CeKd = fGlobal("count(*)","ta_kib_d","kd_upb:TarikKeTakKib108:tgl_perolehan",$gUnt."%:N:%-%-%","LIKE:=:LIKE","","");
$CeKe = fGlobal("count(*)","ta_kib_e","kd_upb:TarikKeTakKib108:tgl_perolehan",$gUnt."%:N:%-%-%","LIKE:=:LIKE","","");
$CeKf = fGlobal("count(*)","ta_kib_f","kd_upb:TarikKeTakKib108:tgl_perolehan",$gUnt."%:N:%-%-%","LIKE:=:LIKE","","");
$CeKg = fGlobal("count(*)","ta_kib_g","kd_upb:TarikKeTakKib108:tgl_perolehan",$gUnt."%:N:%-%-%","LIKE:=:LIKE","","");

$CeKaM = fGlobal("count(*)","ta_kib_a_merger_his","kd_upb:TarikKeTakKib108",$gUnt."%:N","LIKE:=","","");
$CeKcM = fGlobal("count(*)","ta_kib_c_merger_his","kd_upb:TarikKeTakKib108",$gUnt."%:N","LIKE:=","","");
$CeKdM = fGlobal("count(*)","ta_kib_d_merger_his","kd_upb:TarikKeTakKib108",$gUnt."%:N","LIKE:=","","");

$CeInV = fGlobal("count(*)","ta_kib_post","kd_upb:TarikKeTakKib108:Crit:tanggal",$gUnt."%:N:INV:2020-%-%","LIKE:=:=:LIKE","","");

$SQL = "select count(*) as JmlR FROM ta_kib_108_back_sdhada2020 WHERE kd_upb LIKE '".$gUnt.".%' AND tgl_perolehan like '2020-%-%' AND isNull(importFrom) AND TarikKeTakKib108='N'";
$nRo = mysql_query($SQL) or die(mysql_error());
$mRo = mysql_fetch_array($nRo);
$Ce108 = $mRo[0];
?>

<body>
<form name="myfrm" method="post" action="<?php echo "TarikDataAsetKe108_Mid_.php?IdL=".$_GET['IdL']?>">
  <input type="hidden" name="Proses">
  <table border="0" align="center" style="width:700px">
    <tr> 
      <td>&nbsp;</td>
      <td width="628">&nbsp;</td>
    </tr>
    <tr> 
      <td width="62">&nbsp;&nbsp;&nbsp;SKPD</td>
      <td>
	  <select name="fUnt" id="fUnt" tabindex="0" style="width: 500px" onchange="this.form.submit()">
          <?
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
	    <td width="9%">&nbsp;</td>
	    <td width="38%"><div id="div" style="border-radius: 4px; border:1px solid #999999; background-color:#fff; width:260px; height:158px">
          <table border="0" align="center" style="width:260px">
            <tr height="5">
              <td width="16"></td>
              <td colspan="2"></td>
              <td width="57"></td>
              <td width="116"></td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td width="37">KIB A </td>
              <td width="12">-&gt;</td>
              <td style="text-align:right; padding-right:15px"><?=fConvertToRupiahBulat($CeKa)?></td>
              <td>record</td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td>KIB B </td>
              <td>-&gt;</td>
              <td style="text-align:right; padding-right:15px"><?=fConvertToRupiahBulat($CeKb)?></td>
              <td>record</td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td>KIB C </td>
              <td>-&gt;</td>
              <td style="text-align:right; padding-right:15px"><?=fConvertToRupiahBulat($CeKc)?></td>
              <td>record</td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td>KIB D </td>
              <td>-&gt;</td>
              <td style="text-align:right; padding-right:15px"><?=fConvertToRupiahBulat($CeKd)?></td>
              <td>record</td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td>KIB E </td>
              <td>-&gt;</td>
              <td style="text-align:right; padding-right:15px"><?=fConvertToRupiahBulat($CeKe)?></td>
              <td>record</td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td>KIB F </td>
              <td>-&gt;</td>
              <td style="text-align:right; padding-right:15px"><?=fConvertToRupiahBulat($CeKf)?></td>
              <td>record</td>
            </tr>
            <tr height="18">
              <td>&nbsp;</td>
              <td>KIB G </td>
              <td>-&gt;</td>
              <td style="text-align:right; padding-right:15px"><?=fConvertToRupiahBulat($CeKg)?></td>
              <td>record</td>
            </tr>
          </table>
	      </div></td>
	    <td width="2%">&nbsp;</td>
	    <td width="51%">
		<div id="div" style="border-radius: 4px; border:1px solid #999999; background-color:#fff; width:260px; height:158px">
		<table border="0" align="center" style="width:260px">
          <tr height="5">
            <td width="12"></td>
            <td colspan="2"></td>
            <td width="54"></td>
            <td width="86"></td>
          </tr>
          <tr height="18">
            <td>&nbsp;</td>
            <td width="71">KIB A </td>
            <td width="15">-&gt;</td>
            <td style="text-align:right; padding-right:15px"><?=fConvertToRupiahBulat($CeKaM)?></td>
            <td>record</td>
          </tr>
          
          <tr height="18">
            <td>&nbsp;</td>
            <td>KIB C </td>
            <td>-&gt;</td>
            <td style="text-align:right; padding-right:15px"><?=fConvertToRupiahBulat($CeKcM)?></td>
            <td>record</td>
          </tr>
          <tr height="18">
            <td>&nbsp;</td>
            <td>KIB D </td>
            <td>-&gt;</td>
            <td style="text-align:right; padding-right:15px"><?=fConvertToRupiahBulat($CeKdM)?></td>
            <td>record</td>
          </tr>
          <tr height="18">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr height="18">
            <td>&nbsp;</td>
            <td>INV. POST</td>
            <td>-&gt;</td>
            <td style="text-align:right; padding-right:15px"><?=fConvertToRupiahBulat($CeInV)?></td>
            <td>record</td>
          </tr>
          <tr height="18">
            <td>&nbsp;</td>
            <td>TA_KIB108X</td>
            <td>-&gt;</td>
            <td style="text-align:right; padding-right:15px"><?=fConvertToRupiahBulat($Ce108)?></td>
            <td>record</td>
          </tr>
        </table>
		</div>		</td>
	  </tr>
	  <tr height="5">
	    <td colspan="2"></td>
	    <td colspan="2"></td>
	  </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	  </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td><input type="button" name="B1" value="PROSES" onclick="P_Proses('<?=$Lev?>')"  style="width:120px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	      <input type="button" name="B3" value="CLOSE" onclick="P_Close()"  style="width:120px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	  </tr>
	  </table>	  </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    
    <tr> 
      <td>&nbsp;</td>
      <td valign="middle" style="color:#FF0000">&nbsp;</td>
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

	$("#fUnt").focus();
</script>

<?php require('Connection_Close.php');?>
