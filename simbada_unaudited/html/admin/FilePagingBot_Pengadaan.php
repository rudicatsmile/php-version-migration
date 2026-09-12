<table align="center" border="0" cellspacing="0" cellpadding="0" class="table-list" style="width:99%">
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
	$NilAda = fGlobal("ifnull(sum(nilai),0)","ta_pengadaan","Kd_Unit:Tanggal:Kd_Aset_108",$zUnt.":".$gThn."%:".$gAst."%","=:LIKE:LIKE","","");
	$NilAst = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108","Kd_UPB:Tanggal:No_Pengadaan:Kd_Aset_108",$zUnt."%:".$gThn."%:".$zUnt.".____.______:".$gAst."%","LIKE:LIKE:LIKE:LIKE","","");
  	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NILAI PENGADAAN&nbsp;&nbsp;:&nbsp;&nbsp;".fConvertToRupiah($NilAda);
	if ($NilAst>$NilAda){
		$cLR="style='color:#ff0000'";
	}
	else if ($NilAst<$NilAda){
		$cLR="style='color:#0000ff'";
	}
	else{
		$cLR="";
	}
  	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NILAI ASET&nbsp;&nbsp;:&nbsp;&nbsp;<font $cLR>".fConvertToRupiah($NilAst)."</font>";
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
<?
$qBid = substr($yBid,0,2);
?>
</table>
<? 
if ($qBid=="01" || $qBid=="02" || $qBid=="03" || $qBid=="04" || $qBid=="05") 
{
?>
<table align="center" border="0" cellspacing="0" cellpadding="0" class="table-list" style="width:99%">
  <tr> 
  <td style="text-align:center; font-style:italic; font-size:10pt">Catatan : <font style="color:#FF0000">**</font> Input data tidak melalui Modul Pengadaan</td>
</tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<? } ?>