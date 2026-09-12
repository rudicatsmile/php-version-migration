<?php
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
<?php
if (isset($_GET['gKG'])) {$gKG = $_GET['gKG'];} else {$gKG  = "";}
if (isset($_GET['gRK'])) {$gRK = $_GET['gRK'];} else {$gRK  = "";}
$gPR = substr($gKG,0,18);
$mPR = strtoupper(fGlobalNEW("nmProgram","ta_apbd_program_skpd","idProgram",$gPR,"=","",DatabaseSB,$ConSB,""));
$mKG = strtoupper(fGlobalNEW("nmKegiatan","ta_apbd_kegiatan_skpd","idKegiatan",$gKG,"=","",DatabaseSB,$ConSB,""));
$mRK = strtoupper(fGlobalNEW("nmRekening","ta_apbd_rekening_skpd","kdRekening",$gRK,"=","",DatabaseSB,$ConSB,""));
?>
<body background="css/images/newheader.gif" topmargin="0" onload="javascript:myfrm.fFind.focus()">
<form name="myfrm" method="post" action="<?php echo "Pengadaan_Mid_Top.php?gUnt=".$_GET['gUnt']."&IdL=".$_GET['IdL'] ?>">
  <table width="930" border="0" align="center">
    <tr> 
      <td valign="middle">
	  <table border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; color:#CCCCCC; font-weight:bold; font-family:calibri; font-size:9pt">
          <tr height="23">
            <td width="74" align="right">PROGRAM</td>
            <td width="25">&nbsp;</td>
            <td width="825">
			<input class="text" type="text" name="fPR" readonly value="<?=$gPR?>" style=" height:17px; border-radius: 3px; width:110px; font-family: Calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" />
			<input class="text" type="text" name="mPR" readonly value="<?=$mPR?>" style=" height:17px; border-radius: 3px; width:500px; font-family: Calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" />
			</td>
          </tr>
          <tr height="23">
            <td align="right">KEGIATAN</td>
            <td>&nbsp;</td>
            <td>
			<input class="text" type="text" name="fKG" readonly value="<?=$gKG?>" style=" height:17px; border-radius: 3px; width:110px; font-family: Calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" />
			<input class="text" type="text" name="mKG" readonly value="<?=$mKG?>" style=" height:17px; border-radius: 3px; width:500px; font-family: Calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" />
			</td>
          </tr>
          <tr height="23">
            <td align="right">REKENING</td>
            <td>&nbsp;</td>
            <td>
			<input class="text" type="text" name="fRK" readonly value="<?=$gRK?>" style=" height:17px; border-radius: 3px; width:110px; font-family: Calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" />
			<input class="text" type="text" name="mRK" readonly value="<?=$mRK?>" style=" height:17px; border-radius: 3px; width:500px; font-family: Calibri; font-size: 10pt; border: 1px solid #C0C0C0; padding-left: 4px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; background-color: #E1F986" />
			</td>
          </tr>
        </table>
	  </td>
    </tr>
  </table>
  <table width="100%" border="0" align="center" style="font-size:12px; font-family:calibri; border-collapse: collapse; color:#000; background:#999999; font-weight:bold">
    <tr>
	  <td width="68">&nbsp;</td>
	  <td width="143">&nbsp;</td>
	  <td width="95">&nbsp;</td>
	  <td width="55">&nbsp;</td>
	  <td width="75" style="text-align:right; padding-right:10px">&nbsp;</td>
	  <td width="78" style="text-align:right; padding-right:10px">&nbsp;</td>
	  <td width="80" style="text-align:right; padding-right:10px">&nbsp;</td>
	  <td>&nbsp;</td>
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
		fRK = objfrm.fRK.value;
		fnD = objfrm.fFind.value;
		window.open("Pengadaan_Mid_Mid.php?gYN="+fYN+"&gPR="+fPR+"&gKG="+fKG+"&gRK="+fRK+"&fnD="+fnD+"&gUnt="+UnT+"&IdL="+IdL,"WinFindBRK_Mid");
	}
	
</script>