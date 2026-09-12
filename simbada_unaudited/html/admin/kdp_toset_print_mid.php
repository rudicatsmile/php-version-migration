<?
require "FileFunction.php";
$rHri = 1;
$rBln = 1;
$rThn = (date('Y')-1);
$sHri = 31;
$sBln = 12;
$sThn = (date('Y')-1);
extract($_GET);
#echo $IdL."<br>";
#echo $CrDiv;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
  <table border="0" align="center" style="width:400px">
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td width="100">&nbsp;</td>
      <td width="20">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr height="30">
      <td align="right">Tanggal</td>
      <td align="center">:</td>
      <td>
	  <select class="boxs" name="fHriA" id="fHriA" tabindex="0" style="width:45px">
        <?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$rHri) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
      </select>
		&nbsp;
		<select class="boxs" name="fBlnA" id="fBlnA" tabindex="0" style="width:100px">
  		<?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$rBln) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		&nbsp;
		<select class="boxs" name="fThnA" id="fThnA" tabindex="0" style="width:60px">
  		<?
		for($nThn=2020; $nThn<=2040; $nThn++)
		{
			$sel ="";
			if ($nThn==$rThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>      </td>
    </tr>
    <tr height="30">
      <td align="right">S.d Tanggal</td>
      <td align="center">:</td>
      <td>
	  <select class="boxs" name="fHriB" id="fHriB" tabindex="0" style="width:45px">
        <?
		for($nHri=1; $nHri<=31; $nHri++)
		{
			$sel ="";
			if ($nHri==$sHri) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nHri.'">'.$nHri.'</option>';
		}
		?>
      </select>
		&nbsp;
		<select class="boxs" name="fBlnB" id="fBlnB" tabindex="0" style="width:100px">
  		<?
		for($nBln=1; $nBln<=12; $nBln++)
		{
			$sel ="";
			if ($nBln==$sBln) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nBln.'">'.fNmBulan($nBln).'</option>';
		}
		?>
		</select>
		&nbsp;
		<select class="boxs" name="fThnB" id="fThnB" tabindex="0" style="width:60px">
  		<?
		for($nThn=2020; $nThn<=2040; $nThn++)
		{
			$sel ="";
			if ($nThn==$sThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$nThn.'">'.$nThn.'</option>';
		}
		?>
		</select>	  </td>
    </tr>
    <tr height="30">
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr height="30">
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>
	  <input type="button" name="B39x" value="Dok. Rekap" onclick="P_OpenDC('kdp_toset_print_doc','800','400','<?=$IdL?>')" style="width:80px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B39x" value="Dok. Rinci" onclick="P_OpenDC('kdp_toset_print_docs','800','400','<?=$IdL?>')" style="width:80px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  <input type="button" name="B39x" value="Close" onclick="globalClose('<?=$CrDiv?>Div0')" style="width: 50px; height: 21px; padding-left: 0px; padding-right: 0px; padding-top: 0px; padding-bottom: 0px" />
	  </td>
    </tr>
    <tr height="30">
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
</table>
