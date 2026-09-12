<?
require "CheckSession.php";
require "Connection.php";
require "FileFunction.php";
$CnSb = fGlobal("count(*)","ref_sumber_dana","Kode","%","LIKE","","");

if (isset($_GET['gNOR'])) {$gNOR= $_GET['gNOR'];}
$gTTL = fGlobalNEW("Nilai","ta_pengadaan","Nomor",$gNOR,"=","",DatabaseSB,$ConSB,"");
$gSPP ="";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style_mid.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<body>
<form name="myfrm" method="post" action="<?="Pengadaan_Mid_Dana_Mid_.php?gNOR=".$gNOR."&IdL=".$_GET['IdL'] ?>">
  <input type="hidden" name="Simpan" style="width:100px">
  <input type="hidden" name="CriteR" style="width:100px">
	  <table border="0" style="background:#FFFFFF; height:100%; width:680px; border-collapse:collapse; border: 1px solid #999999; font-family:calibri; font-size:11px; font-weight:bold; color: #999999">
        <tr height="2">
          <td colspan="4" style="border-top:0px dotted; text-align:right; padding-right:30px"></td>
          <td style="border-top:0px dotted"></td>
          <td style="border-top:0px dotted; text-align:right"></td>
        </tr>
        <tr height="22">
          <td colspan="4" style="border-bottom:1px dotted; text-align:right; padding-right:30px">NILAI BERKAS PENGADAAN </td>
          <td style="border-bottom:1px dotted"><input name="tNIL" readonly type="text" id="tNIL" value="<? echo fConvertToRupiah($gTTL)?>" onKeyUp="addSeparator(this)" style="width:130px; text-align: right; background-color: #E1F986; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; font-size:9pt; font-weight:bold; color:#000" />          </td>
          <td style="border-bottom:1px dotted; text-align:right">&nbsp;</td>
        </tr>
        <tr height="10">
          <td colspan="2" style="border-top:0px dotted"></td>
          <td colspan="2" align="right" style="border-top:0px dotted"></td>
          <td style="border-top:0px dotted"></td>
          <td width="69" align="center" style="border-top:0px dotted"></td>
        </tr>
        <?
			$iG   = 1;
			$mTTL = 0;
			$nSQ="SELECT IDT, Nilai, SmbDana, SPP FROM ta_pengadaan_rinci WHERE Nomor='$gNOR' ORDER BY IDT";
			$nRs = mysql_query($nSQ) or die(mysql_error());
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				$mIDT = $mRo[0];
				$mNIL = $mRo[1];
				$mDNA = $mRo[2];
				$mSPP = $mRo[3];
				$mTTL = $mTTL+$mNIL;
				if ($mSPP=="Y") {$gReD="readonly";} else {$gReD="";}
				?>
        <tr height="22">
          <td width="26" style="border-top:0px dotted; text-align:center"><?=$iG?>.</td>
          <td width="99" style="border-top:0px dotted">SUMBER DANA : </td>
          <td width="273" style="border-top:0px dotted"><? if ($mSPP=="N") {?>
              <select class="boxs" name="fDnA<?=$mIDT?>" style="width: 250px; font-size:9pt" tabindex="0">
                <option value=""></option>
                <?
				
				for($nDNA=1; $nDNA<=$CnSb; $nDNA++)
				{
					$sel ="";
					if ($mDNA==$nDNA) {$sel ="selected";}
					echo '<option '.$sel.' value="'.$nDNA.'">'.SumberDn($nDNA).'</option>';
				}
				  ?>
              </select>
              <? }else{?>
              <input name="fDnA<?=$mIDT?>" type="hidden" id="fDnA<?=$mIDT?>" value="<?=$mDNA?>" style="width:30px; background-color: #E1F986; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; font-size:9pt" />
              <input name="fDnD" type="text" id="fDnD" value="<?=SumberDn($mDNA)?>" readonly onKeyUp="addSeparator(this)" style="width:250px; background-color: #E1F986; border: 1px solid #C0C0C0; padding-left: 6px; padding-right: 1px; padding-top: 1px; padding-bottom: 1px; font-size:9pt" />
              <? } ?>          </td>
          <td width="26" style="border-top:0px dotted">Rp.</td>
          <td width="159" style="border-top:0px dotted"><input name="fNIL<?=$mIDT?>" type="text" id="fNIL<?=$mIDT?>" <?=$gReD?> value="<? echo fConvertToRupiah($mNIL)?>" onKeyUp="addSeparator(this)" style="width:130px; text-align: right; background-color: #E1F986; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; font-size:9pt" /></td>
          <td align="center" style="border-top:0px dotted"><a href="#" class="ico dell" onClick="P_Delete('<?=$mIDT?>','<?=$mSPP?>'); return false">&nbsp;delete</a></td>
        </tr>
        <? 
				$iG++;
			}
			if ($mTTL<$gTTL)
			{
				$CLR="0000FF";
				$msG="<font style='color:#FF0000'>TOTAL rincian belum sama dengan NILAI (Rp)...!!</font>";
			}
			else if ($mTTL>$gTTL)
			{
				$CLR="FF0000";
				$msG="<font style='color:#FF0000'>TOTAL rincian belum sama dengan NILAI (Rp)...!!</font>";
			}
			else
			{
				$CLR="000000";
				$msG="";
			}
			?>
        <tr height="10">
          <td colspan="2" style="border-top:0px dotted"></td>
          <td colspan="2" align="right" style="border-top:0px dotted"></td>
          <td style="border-top:0px dotted"></td>
          <td align="center" style="border-top:0px dotted"></td>
        </tr>
        <tr height="22">
          <td colspan="4" style="border-top:1px dotted; text-align:right; padding-right:30px">TOTAL PER SUMBER DANA</td>
          <td style="border-top:1px dotted"><input name="tNIL" readonly type="text" id="tNIL" value="<? echo fConvertToRupiah($mTTL)?>" onKeyUp="addSeparator(this)" style="width:130px; text-align: right; background-color: #E1F986; border: 1px solid #C0C0C0; padding-left: 1px; padding-right: 4px; padding-top: 1px; padding-bottom: 1px; font-size:9pt; font-weight:bold; color:#<?=$CLR?>" />          </td>
          <td style="border-top:1px dotted; text-align:right">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="6" style="border-top:1px dotted; text-align:left; padding-left:10px">
		  <a href="#" onClick="P_Save('<?=$gSPP?>'); return false" class="ico save">SAVE</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
		  <a href="#" onClick="P_Add('<?=$gSPP?>'); return false" class="ico edit">ADD ITEM</a>		  </td>
        </tr>
      </table>
</form>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Add(spp)
	{
		objfrm.Simpan.value = "AddRc";
		objfrm.submit();
	}
	
	function P_Save(spp)
	{
		objfrm.Simpan.value = "SaveRc";
		objfrm.submit();
	}
	
	function P_Delete(idt,spp)
	{
		if (spp=="Y")
		{
			window.alert('Access denied, data sudah digunakan di SimKADA..!!'); 
			return false;
		}
		var AN = confirm("Delete record..?!!");
		if (AN)
		{
			objfrm.CriteR.value = idt;
			objfrm.Simpan.value = "DellRc";
			objfrm.submit();
		}
	}
</script>
<?
require "FileFormatNum.php";
?>