<? require('connfile.php');?>
<table align="center" width="95%" border="0" cellpadding="0" cellspacing="0" style="font-size:10pt; font-family:calibri">
	<?
	$dt = date('Y-m-d');
	$SQ = "SELECT count(*) as Jml FROM ta_user_log WHERE Login_Time LIKE '".$dt."%'";
	$rs = mysql_query($SQ);
	$mR = mysql_fetch_array($rs);
	$HriIni = $mR[0];
	
	$dt = date('Y-m-d', strtotime("-1 day", strtotime(date("Y-m-d"))));
	$SQ = "SELECT count(*) as Jml FROM ta_user_log WHERE Login_Time LIKE '".$dt."%'";
	#echo $SQ;
	$rs = mysql_query($SQ);
	$mR = mysql_fetch_array($rs);
	$HriKmr = $mR[0];
	
	$dt = date('Y-m');
	$SQ = "SELECT count(*) as Jml FROM ta_user_log WHERE Login_Time LIKE '".$dt."-%'";
	$rs = mysql_query($SQ);
	$mR = mysql_fetch_array($rs);
	$BlnIni = $mR[0];
	
	$dt = date('Y');
	$SQ = "SELECT count(*) as Jml FROM ta_user_log WHERE Login_Time LIKE '".$dt."-%'";
	$rs = mysql_query($SQ);
	$mR = mysql_fetch_array($rs);
	$ThnIni = $mR[0];
	
	?>
	<tr height="10">
	  <td></td>
	  <td></td>
	</tr>
	<tr>
	<td width="40"><img src="css/images/adm.gif" /></td>
	<td style="font-weight:bold; color:#FF0000">PENGUNJUNG</td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td>
	<table width="300" border="0" cellpadding="0" cellspacing="0" style="font-size:10pt; font-family:calibri">
		<tr height="22">
		  <td width="60">Hari ini</td>
		  <td width="20">:</td>
		  <td><?=$HriIni?></td>
		</tr>
		<tr height="22">
		  <td>Kemarin</td>
		  <td>:</td>
		  <td><?=$HriKmr?></td>
	    </tr>
		<!--tr height="22">
		  <td>Mingguan</td>
		  <td>:</td>
		  <td>-</td>
	    </tr-->
		<tr height="22">
		  <td>Bulanan</td>
		  <td>:</td>
		  <td><?=$BlnIni?></td>
	    </tr>
		<tr height="22">
		  <td>Tahunan</td>
		  <td>:</td>
		  <td><?=$ThnIni?></td>
	    </tr>
		<!--tr height="22">
		  <td>Total</td>
		  <td>:</td>
		  <td>-</td>
	    </tr-->
	</table>	</td>
	</tr>
	<?
	$nSQL= "SELECT * FROM ta_informasi WHERE Tampil='Y' ORDER BY IDT DESC LIMIT 100";
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
			  <td width="40" rowspan="3" class="judulinfo" style="text-align:center" valign="top">
			  <?
			  if ($rSIZ>0) {
			  echo "<img src='source_img.php?rFdR=informasi&rTBL=ta_informasi&rIDT=".$rIDT." height='26' width='26' />";
			  } else {
			  echo "<img src='images/kritiksaran/blank.gif' height='26' width='26' />";
			  }
			  ?>			  </td>
				<td style="text-align:justify; font-weight:bold; text-decoration:underline" class="judulinfo"><?=strtoupper($mRo['Header'])?></td>
			</tr>
			<tr>
			  <td style="text-align:justify"><?=substr($mRo['Informasi'],0,100)."...."?>[ <a href="#" class="info read" onClick="func_view_data('detail_data','informasi_load_detail.php','<?=$mRo['IDT']?>'); return false">SELENGKAPNYA</a>]</td>
			</tr>
			<tr>
			  <td style="text-align:center"><?=$mRo['Recorded']?></td>
			</tr>
			<tr>
			  <td>&nbsp;</td>
				<td><hr /></td>
			</tr>
			<?
		}
		while ($mRo = mysql_fetch_assoc($nRs));
	}
	?>
	<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	</tr>
</table>
