<?
require "CheckSession.php";
require "Connection.php";
#require "Connection_Simkada.php";
require "FileFunction.php";
require "CheckLogin.php";

echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>";
echo "<html xml:lang='en'>";
echo "<head>";
echo "<meta http-equiv='Content-Type' content='text/html; charset=windows-1252'>";
?>
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_popup.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="file_global.js"></script>
</head>

<?
if (isset($_GET['nRK'])) {$nRK = $_GET['nRK'];}

$g171 = substr($nRK,0,5)." : ".fGlobalNEW("Nm_Aset","ref_rek_aset2","Kd_Aset",substr($nRK,0,5),"=","",DatabaseSB,$ConSB,"");
$g172 = substr($nRK,0,8)." : ".fGlobalNEW("Nm_Aset","ref_rek_aset3","Kd_Aset",substr($nRK,0,8),"=","",DatabaseSB,$ConSB,"");
$g173 = substr($nRK,0,11)." : ".fGlobalNEW("Nm_Aset","ref_rek_aset4","Kd_Aset",substr($nRK,0,11),"=","",DatabaseSB,$ConSB,"");
$g174 = substr($nRK,0,15)." : ".fGlobalNEW("Nm_Aset","ref_rek_aset5","Kd_Aset",substr($nRK,0,15),"=","",DatabaseSB,$ConSB,"");

$gRINC = fGlobalNEW("Kd_Aset64","ref_rek_aset5_maping","Kd_Aset17",$nRK,"=","",DatabaseSB,$ConSB,"");
if ($gRINC)
{
	$gJNS64 = substr($gRINC,0,5);
	$gOBJ64 = substr($gRINC,0,8);
	$gRIN64 = substr($gRINC,0,11);
}
$gRIND = fGlobalNEW("Kd_Aset13","ref_rek_aset5_maping","Kd_Aset17",$nRK,"=","",DatabaseSB,$ConSB,"");
if ($gRIND)
{
	$gJNS13 = substr($gRIND,0,5);
	$gOBJ13 = substr($gRIND,0,8);
	$gRIN13 = substr($gRIND,0,11);
}
?>
<body>
<form name="myfrm" method="post" action="<?php echo "Ref_Kode_Aset_Maping_Mid_.php?nRK=".$nRK."&rKdA=".$_GET['rKdA']."&rKdB=".$_GET['rKdB']."&rKdC=".$_GET['rKdC']."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL'] ?>">
<input type="hidden" name="Simpan">
<table border="0" align="center" width="580" style="font-family:Calibri; font-size:10pt">
	<tr height="5">
	  <td width="5"></td>
	  <td width="100" height="5"></td>
	  <td></td>
	  <td width="24"></td>
	</tr>
	<tr height="22">
	  <td>&nbsp;</td>
	  <td colspan="3" valign="top" style="font-weight:bold; text-decoration:underline">PERMENDAGRI 17 :</td>
    </tr>
	<tr height="22">
	  <td>&nbsp;</td>
	  <td>KELOMPOK</td>
	  <td><input name="f171" type="text" value="<?=$g171?>" readonly style="width:420px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
	  <td>&nbsp;</td>
    </tr>
	<tr height="22">
	  <td>&nbsp;</td>
	  <td>JENIS</td>
	  <td><input name="f172" type="text" value="<?=$g172?>" readonly style="width:420px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
	  <td>&nbsp;</td>
    </tr>
	<tr height="22">
	  <td>&nbsp;</td>
	  <td>OBJEK</td>
	  <td><input name="f173" type="text" value="<?=$g173?>" readonly style="width:420px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
	  <td>&nbsp;</td>
    </tr>
	<tr height="22">
	  <td>&nbsp;</td>
	  <td>RINCIAN OBJEK </td>
	  <td><input name="f174" type="text" value="<?=$g174?>" readonly style="width:420px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" /></td>
	  <td>&nbsp;</td>
    </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
	<tr height="22">
	  <td>&nbsp;</td>
	  <td colspan="3" valign="top" style="font-weight:bold; text-decoration:underline">PERMENDAGRI 13 :</td>
    </tr>
	<tr height="23">
	  <td>&nbsp;</td>
	  <td>JENIS</td>
	  <td>
	  <select class="boxs" name="fJNS13" id="fJNS13" tabindex="0" style="width:420px" onChange="func_select('CrJNS13','fJNS13','fOBJ13','LoadNuL')">
	  <option value=""></option>
        <?
		#CallConnection(DatabaseSA,$ConSA);
		$nSQ = "SELECT Kd_Rek, Nm_Rek FROM ref_rek_13_3 WHERE Kd_Rek LIKE '1.3.%' ORDER BY Kd_Rek";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			//if (!$gJNS) {$gJNS=$mRo[0];}
			$sel = "";
			if ($mRo[0]==$gJNS13) 
			{
				$sel ="selected";
				$zJNS13=$mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper(fViewLimit($mRo[1],50)).'</option>';
		}
	  ?>
      </select>	  </td>
	  <td>&nbsp;</td>
	</tr>
	<tr height="22">
	  <td>&nbsp;</td>
	  <td>OBJEK</td>
	  <td>
	  <select class="boxs" name="fOBJ13" id="fOBJ13" tabindex="0" style="width:420px" onChange="func_select('CrOBJ13','fOBJ13','fRIN13','LoadNuL')">
	  <option value=""></option>
        <?
		#CallConnection(DatabaseSA,$ConSA);
		$nSQ = "SELECT Kd_Rek, Nm_Rek FROM ref_rek_13_4 WHERE Kd_Rek LIKE '$zJNS13.%' ORDER BY Kd_Rek";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			//if (!$gOBJ) {$gOBJ=$mRo[0];}
			$sel = "";
			if ($mRo[0]==$gOBJ13) 
			{
				$sel ="selected";
				$zOBJ13=$mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".fViewLimit($mRo[1],50).'</option>';
		}
	  ?>
      </select>	  </td>
	  <td>&nbsp;</td>
	</tr>
	<tr height="23">
	  <td>&nbsp;</td>
	  <td>RINCIAN OBJEK</td>
	  <td>
	  <select class="boxs" name="fRIN13" id="fRIN13" tabindex="0" style="width:420px">
	  <option value=""></option>
        <?
		#CallConnection(DatabaseSA,$ConSA);
		$nSQ = "SELECT Kd_Rek, Nm_Rek FROM ref_rek_13_5 WHERE Kd_Rek LIKE '$zOBJ13.%' ORDER BY Kd_Rek";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			//if (!$gRIN) {$gRIN=$mRo[0];}
			$sel = "";
			if ($mRo[0]==$gRIN13)
			{
				$sel ="selected";
				$zRIN13=$mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".fViewLimit($mRo[1],50).'</option>';
		}
	  ?>
      </select>	  </td>
	  <td>&nbsp;</td>
	</tr>
	<tr height="23">
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><label><input type="checkbox" name="fCopy13" value="ON"> Copy Ke Semua Rincian (Permen 17)</label></td>
	  <td>&nbsp;</td>
    </tr>
	<tr height="22">
	  <td>&nbsp;</td>
	  <td colspan="3" valign="top" style="font-weight:bold; text-decoration:underline">PERMENDAGRI 64 :</td>
    </tr>
	<tr height="23">
	  <td>&nbsp;</td>
	  <td>JENIS</td>
	  <td>
	  <select class="boxs" name="fJNS64" id="fJNS64" tabindex="0" style="width:420px" onChange="func_select('CrJNS64','fJNS64','fOBJ64','LoadNuL')">
	  <option value=""></option>
        <?
		#CallConnection(DatabaseSA,$ConSA);
		$nSQ = "SELECT Kd_Rek, Nm_Rek FROM ref_rek_64_3 WHERE Kd_Rek LIKE '1.3.%' ORDER BY Kd_Rek";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			//if (!$gJNS) {$gJNS=$mRo[0];}
			$sel = "";
			if ($mRo[0]==$gJNS64) 
			{
				$sel ="selected";
				$zJNS64=$mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper(fViewLimit($mRo[1],50)).'</option>';
		}
	  ?>
      </select>	  </td>
	  <td>&nbsp;</td>
	</tr>
	<tr height="22">
	  <td>&nbsp;</td>
	  <td>OBJEK</td>
	  <td>
	  <select class="boxs" name="fOBJ64" id="fOBJ64" tabindex="0" style="width:420px" onChange="func_select('CrOBJ64','fOBJ64','fRIN64','LoadNuL')">
	  <option value=""></option>
        <?
		#CallConnection(DatabaseSA,$ConSA);
		$nSQ = "SELECT Kd_Rek, Nm_Rek FROM ref_rek_64_4 WHERE Kd_Rek LIKE '$zJNS64.%' ORDER BY Kd_Rek";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			//if (!$gOBJ) {$gOBJ=$mRo[0];}
			$sel = "";
			if ($mRo[0]==$gOBJ64) 
			{
				$sel ="selected";
				$zOBJ64=$mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".fViewLimit($mRo[1],50).'</option>';
		}
	  ?>
      </select>	  </td>
	  <td>&nbsp;</td>
	</tr>
	<tr height="23">
	  <td>&nbsp;</td>
	  <td>RINCIAN OBJEK</td>
	  <td>
	  <select class="boxs" name="fRIN64" id="fRIN64" tabindex="0" style="width:420px">
	  <option value=""></option>
        <?
		#CallConnection(DatabaseSA,$ConSA);
		$nSQ = "SELECT Kd_Rek, Nm_Rek FROM ref_rek_64_5 WHERE Kd_Rek LIKE '$zOBJ64.%' ORDER BY Kd_Rek";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			//if (!$gRIN) {$gRIN=$mRo[0];}
			$sel = "";
			if ($mRo[0]==$gRIN64)
			{
				$sel ="selected";
				$zRIN=$mRo[0];
			}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".fViewLimit($mRo[1],50).'</option>';
		}
	  ?>
      </select>	  </td>
	  <td>&nbsp;</td>
	</tr>
	<tr height="23">
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><label><input type="checkbox" name="fCopy64" value="ON"> Copy Ke Semua Rincian (Permen 17)</label></td>
	  <td>&nbsp;</td>
    </tr>
	<tr height="23">
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>
	  <input type="button" name="B1" value="SAVE"  onclick="P_Save()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B2" value="CLOSE"  onclick="P_Close()"  style="width: 80px; height: 24px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />&nbsp;&nbsp;&nbsp;
	  </td>
	  <td>&nbsp;</td>
    </tr>
	<tr height="23">
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
</table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Save()
	{
		objfrm.Simpan.value = "Save";
		objfrm.submit();
	}
	
	function P_Close()
	{
		objfrm.Simpan.value = "Close";
		objfrm.target="_top";
		objfrm.submit();
	}
</script>