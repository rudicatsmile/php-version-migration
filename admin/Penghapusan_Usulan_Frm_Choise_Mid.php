<?php
require('Connection.php');
$gHR = date('d');
$gBL = date('m');
$gTH = date('Y');
function fNmB($nX)
{
	$nX = (int)$nX;
	$NmB = array ('','Januari','Februari','Maret','April',
	'Mei','Juni','Juli','Agustus',
	'September','Oktober','November','Desember');
	return $NmB[$nX];
}

?>
<table border="0" width="350" cellspacing="1" style="font-size: 10pt; font-family: Calibri; border-collapse: collapse">
	<tr height="20">
		<td width="17">&nbsp;</td>
		<td width="77">&nbsp;</td>
		<td width="14">&nbsp;</td>
	    <td width="229">&nbsp;</td>
	</tr>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">JENIS USULAN</td>
	  <td>&nbsp;</td>
	  <td>
	  <select class="boxs" name="fJeNS" tabindex="0" style="width:211px">
        <option value="All">ALL</option>
        <?php
		$nSQ="SELECT Kode, Deskripsi FROM ref_usulan_jenis ORDER BY IDT";
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$sel ="";
			if ($mRo[0]==$gJNS) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$mRo[0].'">'.$mRo[1].'</option>';
		}
		?>
      </select></td>
	</tr>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">TANGGAL</td>
	  <td>&nbsp;</td>
	  <td>
	  <select class="boxs" name="fHR1" tabindex="0" style="width:50px">
      <?php
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gHR) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="fBL1" tabindex="0" style="width:95px">
	<?php
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBL) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmB($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTH1" style="width: 60px" tabindex="0">
 	<?php
	for($i=2016; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select>	  </td>
	</tr>
	<tr height="25">
	  <td>&nbsp;</td>
	  <td class="ar">S.D TANGGAL </td>
	  <td>&nbsp;</td>
	  <td>
	  <select class="boxs" name="fHR2" tabindex="0" style="width:50px">
      <?php
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gHR) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="fBL2" tabindex="0" style="width:95px">
	<?php
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBL) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmB($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTH2" style="width: 60px" tabindex="0">
 	<?php
	for($i=2016; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select>	  </td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
	<tr>
	  <td>&nbsp;</td>
	  <td class="ar">TANGGAL CETAK </td>
	  <td>&nbsp;</td>
	  <td>
	  <select class="boxs" name="fHR3" tabindex="0" style="width:50px">
      <?php
		for($i=1; $i<=31; $i++)
		{
			$sel ="";
			if ($i==$gHR) {$sel ="selected";}
			echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
		}
		?>
    </select>
	<select class="boxs" name="fBL3" tabindex="0" style="width:95px">
	<?php
	for($i=1; $i<=12; $i++)
	{
		$sel ="";
		if ($i==$gBL) {$sel ="selected";}
		echo '<option '.$sel.' value="'.$i.'">'.fNmB($i).'</option>';
	}
	?>
	</select>
	<select class="boxs" name="fTH3" style="width: 60px" tabindex="0">
 	<?php
	for($i=2016; $i<=2030; $i++)
	{
	$sel ="";
	if ($i==$gTH) {$sel ="selected";}
	echo '<option '.$sel.' value="'.$i.'">'.$i.'</option>';
	}
	?>
	</select>	  </td>
	</tr>
	<tr height="30">
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="button" name="B12" value="Open" onclick="showDOC('800','400','<?=$_GET['IdL']?>')" style="width: 80px; height: 21px" />
      <input type="button" name="B122" value="Close" onclick="closeCLICK('choise'); return false" style="width: 80px; height: 21px" /></td>
	</tr>
	<tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
  </tr>
</table>
