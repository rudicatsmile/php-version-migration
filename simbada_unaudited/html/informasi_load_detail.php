<?
require('connfile.php');
if (!isset($_SESSION)) {session_start();}
$_SESSION['NaviG'] = 'BERANDA -> INFORMASI';
?>
<table width="95%" border="0" style="font-size:10pt; font-family:calibri">
	<?
	$gIdT = $_GET['gIdT'];
	$nSQL= "SELECT * FROM ta_informasi WHERE IDT='".$gIdT."'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tRo = mysql_num_rows($nRs);
	if ($tRo > 0)
	{
		$rIDT = $mRo['IDT'];
		$rSIZ = $mRo['file_size'];
		?>
			<tr>
				<td style="text-align:justify; font-weight:bold; text-decoration:underline; font-size:15px"><?=strtoupper($mRo['Header'])?></td>
			</tr>
			<tr>
				<td style="text-align:justify; padding-top:10px">
				<?
				if ($rSIZ>0) {
				echo "<img src='source_img.php?rFdR=informasi&rTBL=ta_informasi&rIDT=".$rIDT." height='100' width='130' align='left' style='padding-top:0px; padding-right:10px; padding-bottom:10px' />";
				} else {
				echo "<img src='images/kritiksaran/blank.gif' height='100' width='150' align='left' style='padding-top:0px; padding-right:10px; padding-bottom:10px' />";
				}
				?>
				<?=$mRo['Informasi']?>
				
				</td>
			</tr>
			<tr>
				<td><hr /></td>
			</tr>
			<tr>
				<td style="text-align:left"><?=$mRo['Recorded']?></td>
			</tr>
	<?
	}
	?>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
