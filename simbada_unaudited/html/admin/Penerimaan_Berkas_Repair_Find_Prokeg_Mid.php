<?
require('Connection.php');
require('FileFunction.php');

extract($_GET);

#echo $SkP."<br>";
#echo $MsT."<br>";
#echo $IdT."<br>";
#echo $IdL;
?>
<table align="center" cellpadding="0" class="table-listpop" cellspacing="0" width="100%" border="0">
<?
if ($CrT=='Prog')
{
	$SQL = "SELECT idProgram, nmProgram FROM ta_apbd_program_skpd WHERE kdUnit='".$SkP."' GROUP BY idProgram";
	$WD = 60;
}
else if ($CrT=='Kegi')
{
	$SQL = "SELECT idKegiatan, nmKegiatan FROM ta_apbd_kegiatan_skpd WHERE kdUnit='".$SkP."' AND idProgram='".$MsT."' GROUP BY idKegiatan";
	$WD = 90;
}
else if ($CrT=='Subk')
{
	$SQL = "SELECT idSubKegiatan, nmSubKegiatan FROM ta_apbd_kegiatan_sub_skpd WHERE kdUnit='".$SkP."' AND idKegiatan='".$MsT."' GROUP BY idSubKegiatan";
	$WD = 100;
}
else if ($CrT=='Rekn')
{
	$SQL = "SELECT kdRekening, nmRekening FROM ta_apbd_rekening_skpd WHERE kdUnit='".$SkP."' AND idSubKegiatan='".$MsT."' GROUP BY kdRekening";
	$WD = 120;
}
#echo $SQL;
$nRs = mysql_query($SQL);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$gKd = $mRo[0];
	$gNm = $mRo[1];
	?>
	<tr height="26" style="cursor:pointer" onclick="showCLICK('<?=$CrT?>','<?=$gKd?>','<?=$gNm?>','<?=$IdT?>','<?=$IdL?>'); return false;">
	  <td width="10" style="border-bottom:1px dotted #ccc">&nbsp;</td>
	  <td width="<?=$WD?>" style="border-bottom:1px dotted #ccc"><?=$mRo[0]?></td>
	  <td style="border-bottom:1px dotted #ccc"><?=$mRo[1]?></td>
	</tr>
	<?
}
?>
</table>