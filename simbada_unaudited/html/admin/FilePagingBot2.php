<table align="center" border="0" cellspacing="0" cellpadding="0" class="table-list" style="width:900px">
  <tr> 
  <td>
<?
$RecList = $tRo;		//Ambil di master SQL - mysql_num_rows($nRs)
$Hasil   = mysql_query($nSQL);
$Data    = mysql_fetch_assoc($Hasil);
$JumData = $Data['JmlRc'];
$JumPage = ceil($JumData/$DataPerPage);

$nGa=(int)$Data * $NoPage;
if (1+$Offset > $nGa)
	{$nDatG=$JumData;}
else
	{$nDatG=$nGa;}

$iB  = (int)$JumData/$DataPerPage;
if ($RecList < $DataPerPage)
	{$RecList=$RecList;}
else
	{$RecList=$DataPerPage;}
?>
<!-- Pagging -->
<div class="pagging"> 
<div class="left">
  <? echo "Page ".$NoPage?>
  <<< # >>> 
  <? if ($iG > 1) {echo "Item ".($iG-$RecList)."-".($iG-1);} else {echo "0";}?>
  of 
  <? echo $JumData?>
</div>
<div class="left" style="font-weight:bold">
  <? 
	if ($rBid=="__.__"){$yBid=$rKib;}else{$yBid=$rBid;}
	$NilAset = fGlobal("ifnull(sum(debet-kredit),0)","ta_kib_post","kd_upb:kd_aset",$zUpb.":".$yBid.".".$rKel.".".$rOBJ.".".$rRin."%","LIKE:LIKE","","");
	#$SW="select referensi,kd_aset,debet,kredit from ta_kib_post where kd_upb like '$zUpb' and kd_aset like '".$yBid.".".$rKel.".".$rOBJ.".".$rRin."%'";
	#echo $SW."<br>";
	#$mRs = mysql_query($SW) or die(mysql_error());
	#while ($mRo = mysql_fetch_array($mRs, MYSQL_BOTH))
	#{
	#	echo $mRo[0].":".$mRo[1].":".$mRo[2].":".$mRo[3]."<br>";
	#}
  	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NILAI ASET&nbsp;&nbsp;:&nbsp;&nbsp;".fConvertToRupiah($NilAset);
  ?>
</div>
<div class="right"> 
  <?
if ($NoPage > 1) 
	{echo "<a href='".$_SERVER['PHP_SELF']."?".$fUlrR."iG=".($iG-($DataPerPage*2)+($DataPerPage-$RecList))."&Page=".($NoPage-1)."'>Prev Page</a>";}
else
	{echo "<a href='#'>Prev Page</a>";}

if ($iB > 1)
{
echo "<a href='".$_SERVER['PHP_SELF']."?".$fUlrR."iG=1&Page=1'>1</a>";

if ($iB > 15) {$iB=15;}
for ($iA = 2; $iA <= $iB+1; $iA++)
	{
	echo "<a href='".$_SERVER['PHP_SELF']."?".$fUlrR."iG=".($DataPerPage*($iA-1)+1)."&Page=".$iA."'>".$iA."</a>";
	}
}
?>
<div class="right">
<?
if (($iB > 1) && (($iG-1) != $JumData))
	{echo "<a href='".$_SERVER['PHP_SELF']."?".$fUlrR."iG=".$iG."&Page=".($NoPage+1)."'>Next Page</a>";}
else
	{echo "<a href='#'>Next Page</a>";}
?>
</div>
</div>
<!-- End Pagging -->
</div>
</td>
</tr>
</table>