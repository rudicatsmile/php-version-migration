<?
require "Connection.php";
require "Connection_Simkada.php";
require "FileFunction.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_top.css" type="text/css" media="all" />
</head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
</head>
<?
$gUnt = $_GET['gUnt'];
$mSKD = fGlobalNEW("Kd_Unit_Link","ref_unit","Kd_Unit",$gUnt,"=","",DatabaseSB,$ConSB,"");

if (isset($_POST['fPR'])) {$gPR  = $_POST['fPR'];} else {$gPR  = "";}
if (isset($_POST['fKG'])) {$gKG  = $_POST['fKG'];} else {$gKG  = "";}
if (isset($_POST['fSB'])) {$gSB  = $_POST['fSB'];} else {$gSB  = "";}
if (isset($_POST['fRK'])) {$gRK  = $_POST['fRK'];} else {$gRK  = "";}
if (isset($_POST['fYN'])) {$gYN  = $_POST['fYN'];} else {$gYN  = "";}

?>
<body background="css/images/newheader.gif" topmargin="0" onload="javascript:myfrm.fFind.focus()">
<form name="myfrm" method="post" action="<?php echo "Pengadaan_Mid_Top.php?gUnt=".$_GET['gUnt']."&IdL=".$_GET['IdL'] ?>">
  <table width="930" border="0" align="center">
    <tr> 
      <td valign="middle">
	  <table border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; color:#CCCCCC; font-weight:bold; font-family:calibri; font-size:9pt">
          <tr height="23">
            <td width="80" align="right">Program</td>
            <td width="20">&nbsp;</td>
            <td width="550">
			<select name="fPR" style="width:514px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
			<option value="">ALL</option>
			<?
			#CallConnection(DatabaseSA,$ConSA);
			$zPR = "";
			#$nSQ = "SELECT Id_Program, Nama_Program FROM program WHERE Id_Program LIKE '_.__.".$mSKD."%' GROUP BY Id_Program";
			#$nSQ = "SELECT idProgram, nmProgram FROM ta_apbd_program_skpd WHERE idProgram LIKE '_.__.".$mSKD."%' and periode='$tTbl' and apbd='$uTbl' GROUP BY idProgram";
			$nSQ = "SELECT idProgram, nmProgram FROM ta_apbd_program_skpd WHERE kdUnit = '".$gUnt."' and periode='$tTbl' and apbd='$uTbl' GROUP BY idProgram";
			$nRs = mysql_query($nSQ) or die(mysql_error());
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				$sel = "";
				//if ($gPR == "") {$gPR = $mRo[0];}
				if ($mRo[0]==$gPR) 
				{
					$sel = "selected";
					$zPR = $mRo[0];
				}
				echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper(fViewLimit($mRo[1],50)).'</option>';
			}
			?>
			</select>            </td>
            <td width="55">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr height="23">
            <td align="right">Kegiatan</td>
            <td>&nbsp;</td>
            <td><select name="fKG" style="width:514px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
              <option value="">ALL</option>
              <?
			if ($zPR!="")
			{
				$zKG = "";
				$nSQ = "SELECT idKegiatan, nmKegiatan FROM ta_apbd_kegiatan_skpd WHERE kdUnit = '".$gUnt."' and idKegiatan LIKE '".$zPR."%' and periode='$tTbl' and apbd='$uTbl' GROUP BY idKegiatan";
				$nRs = mysql_query($nSQ) or die(mysql_error());
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
					$sel = "";
					if ($mRo[0]==$gKG) 
					{
						$sel = "selected";
						$zKG = $mRo[0];
					}
					echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper(fViewLimit($mRo[1],50)).'</option>';
				}
			}
		    ?>
            </select></td>
            <td>Proses</td>
            <td>
			<select name="fYN" style="width:130px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="P_Find('<?=$_GET['gUnt']?>','<?=$_GET['IdL']?>')">
              <option value="N" <? if ($gYN=='N'){echo "selected";}?>>BELUM</option>
              <option value="Y" <? if ($gYN=='Y'){echo "selected";}?>>SUDAH</option>
              <option value=""  <? if ($gYN==''){echo "selected";}?>>ALL</option>
            </select></td>
          </tr>
          <tr height="23">
            <td align="right">Sub Kegiatan</td>
            <td>&nbsp;</td>
            <td>
			<select name="fSB" style="width:514px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="this.form.submit()">
            <option value="">ALL</option>
            <?
			if ($zKG!="")
			{
				$zSB = "";
				$nSQ = "SELECT idSubKegiatan, nmSubKegiatan FROM ta_apbd_kegiatan_sub_skpd WHERE kdUnit = '".$gUnt."' and idSubKegiatan LIKE '".$zKG.".%' and periode='$tTbl' and apbd='$uTbl' GROUP BY idSubKegiatan";
				$nRs = mysql_query($nSQ) or die(mysql_error());
				while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
				{
					$sel = "";
					if ($mRo[0]==$gSB) 
					{
						$sel = "selected";
						$zSB = $mRo[0];
					}
					echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper(fViewLimit($mRo[1],50)).'</option>';
				}
			}
		    ?>
            </select></td>
            <td>Cari</td>
            <td>
			<input class="text" type="text" name="fFind" value="<?=$gFin?>" onkeypress="if (event.keyCode==13){B39.click(); return false;}" style=" height:17px; border-radius: 3px; width:120px; font-family: Calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" />
            <!--input class="text" type="text" name="gFind" value="" style=" height:17px; border-radius: 0px; width:0px; font-family: Calibri; font-size: 10pt; border: 0px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px; background-color: #E1F986" /--></td>
          <tr height="23">
            <td align="right">Belanja</td>
            <td>&nbsp;</td>
            <td>
			<select name="fRK" style="width:514px; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px" onchange="P_Find('<?=$_GET['gUnt']?>','<?=$_GET['IdL']?>')">
              <option value="">ALL</option>
              <?
		if ($zSB!="")
		{
			$zRK = "";
			$nSQ = "SELECT kdRekening, nmRekening FROM ta_apbd_rekening_skpd WHERE kdUnit = '".$gUnt."' and idSubKegiatan = '".$zSB."' and periode='$tTbl' and apbd='$uTbl' GROUP BY kdRekening";
			$nRs = mysql_query($nSQ) or die(mysql_error());
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				$sel = "";
				if ($mRo[0]==$gRK) 
				{
					$sel ="selected";
					$zRK = $mRo[0];
				}
				echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[0]." : ".strtoupper(fViewLimit($mRo[1],50)).'</option>';
			}
		}
	  ?>
            </select></td>
            <td>&nbsp;</td>
            <td><input type="button" name="B39" id="B39" value="GO" onclick="P_Find('<?=$_GET['gUnt']?>','<?=$_GET['IdL']?>'); return false;" style="width: 130px; height: 21px; border: 1px solid #C0C0C0; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" /></td>
          </tr>
        </table>
	  </td>
    </tr>
  </table>
  <table width="100%" border="0" align="center" style="font-size:12px; font-family:calibri; border-collapse: collapse; color:#000; background:#999999; font-weight:bold">
    <tr height="23" style="vertical-align:middle">
	  <td width="68">TANGGAL</td>
	  <td width="143">NOMOR BERKAS</td>
	  <td width="95">PEMBAYARAN</td>
	  <td width="55">PROSES</td>
	  <td width="75" style="text-align:right; padding-right:10px">NILAI BAST</td>
	  <td width="78" style="text-align:right; padding-right:10px">PENGADAAN</td>
	  <td width="80" style="text-align:right; padding-right:10px">S I S A</td>
	  <td>KETERANGAN</td>
	</tr>
	</table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Find(UnT,IdL)
	{
		fYN = objfrm.fYN.value;
		fPR = objfrm.fPR.value;
		fKG = objfrm.fKG.value;
		fSB = objfrm.fSB.value;
		fRK = objfrm.fRK.value;
		fnD = objfrm.fFind.value;
		window.open("Pengadaan_Mid_Mid.php?gYN="+fYN+"&gPR="+fPR+"&gKG="+fKG+"&gSB="+fSB+"&gRK="+fRK+"&fnD="+fnD+"&gUnt="+UnT+"&IdL="+IdL,"WinFindBRK_Mid");
	}
	
</script>