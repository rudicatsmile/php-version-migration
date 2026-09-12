<?php require('connfile.php');?>
<table align="center" width="95%" border="0" style="font-size:10pt; font-family:calibri">
	<?php
	$nSQL= "SELECT * FROM ta_kritik_saran WHERE Tampil='Y' ORDER BY IDT DESC LIMIT 100";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		do
		{
			$rIDT = $mRo['IDT'];
			$rSIZ = $mRo['file_size'];
			?>
			<tr>
			  <td width="40" rowspan="3" valign="top">
			  <?php
			  if ($rSIZ>0) {
			  echo "<img src='source_img.php?rFdR=kritiksaran&rTBL=ta_kritik_saran&rIDT=".$rIDT." height='26' width='26' />";
			  } else {
			  echo "<img src='images/kritiksaran/blank.gif' height='26' width='26' />";
			  }
			  ?>
			  </td>
			  <td style="text-align:justify; font-weight:bold; text-decoration:underline"><?=strtoupper($mRo['Sumber'])?><?php if ($mRo['Alamat']) {echo " - ".$mRo['Alamat'];}?></td>
			</tr>
			<tr>
			  <td style="text-align:justify"><?=$mRo['Deskripsi']?></td>
			</tr>
			<tr>
			  <td style="text-align:center"><?=$mRo['Recorded']?></td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
			  <td><hr /></td>
			</tr>
			<?php
		}
		while ($mRo = mysql_fetch_assoc($nRs));
	}
	?>
	<tr>
	  <td>&nbsp;</td>
	  <td><!--a href="#" onClick="func_view_data('detail_data','kritiksaran_form.php',''); return false">Kirim Kritik & Saran</a-></td>
	</tr>
</table>
