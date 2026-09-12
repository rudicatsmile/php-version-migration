<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$TmT = "MUTASI";
$rHri= 1;
$rBln= 12;
$rThn= fGetDate('year');
?>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:490px; height:210px">
  <tr>
    <td width="40"></td>
    <td width="98"></td>
    <td width="20"></td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" style="padding-left:50px"><div id="loadingImg2" style="width:0px; height:0px; display:none; vertical-align:middle; text-align:center"><img src="Images/loading3.gif" alt="" width="50" height="50"></div></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td align="right">STATUS</td>
    <td>&nbsp;</td>
    <td width="107"><label><input name="fProT" id="fProT" type="radio" value="A" />BELUM</label></td>
    <td width="245"><label><input name="fProT" id="fProT" type="radio" value="B" />DALAM PROSES</label></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
	<label><input name="fProT" id="fProT" type="radio" value="C" />CEK FISIK</label></td>
    <td>
	<label><input name="fProT" id="fProT" type="radio" value="D" />DITOLAK</label></td>
  </tr>
  
  <tr>
    <td height="25">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">
	<label><input name="fProT" id="fProT" type="radio" value="E" checked />DISETUJUI</label></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"></td>
  </tr>
  <tr>
    <td height="25">&nbsp;</td>
    <td align="right">TANGGAL <?=$TmT?></td>
    <td>&nbsp;</td>
    <td colspan="2">
		<select name="mHri" id="mHri" tabindex="0" style="width:50px; text-align:center">
        <?
		echo '<option value="00"></option>';
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==(int)$rHri) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
      </select>
	  <select name="mBln" id="mBln" tabindex="0" style="width:55px; text-align:center">
		<?
		echo '<option value="00"></option>';
		for($i=1; $i<=12; $i++)
		{
			$sel ="";
			if ($i==(int)$rBln) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.fNmBulanShort($i).'</option>';
		}
		?>
		</select>
		<select name="mThn" id="mThn" style="width: 55px; text-align:center">
		<?
		echo '<option value="0000"></option>';
		for($i=2016; $i<=2030; $i++)
		{
			$sel ="";
			if ($i==(int)$rThn) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
		</select>	
	</td>
  </tr>
  <tr height="100%">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"><input type="button" name="B3923" value="Proses" onclick="exeALL('<?=$Ref?>','<?=$IdL?>')" style="width: 166px; height: 21px" /></td>
  </tr>
</table>
