<table align="center" border="0" cellspacing="0" cellpadding="0" class="table-list" style="width:99%">
  <tr> 
  <td>
<?php
$RecList = $tRo ?? 0;		//Ambil di master SQL - mysql_num_rows($nRs)
$Hasil   = mysql_query($nSQL);
$Data    = $Hasil ? mysql_fetch_assoc($Hasil) : null;
$JumData = (int)($Data['JmlRc'] ?? 0);
$DataPerPage = (int)($DataPerPage ?? 500);
if ($DataPerPage <= 0) {
	$DataPerPage = 500;
}
$NoPage  = (int)($NoPage ?? 1);
$Offset  = (int)($Offset ?? 0);
$iG      = (int)($iG ?? 1);
$JumPage = ceil($JumData/$DataPerPage);

$nGa = (int)$JumData * $NoPage;
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
  <?php echo "Page ".$NoPage?>
  <<< # >>> 
  <?php if ($iG > 1) {echo "Item ".($iG-$RecList)."-".($iG-1);} else {echo "0";}?>
  of 
  <?php echo $JumData?>
</div>
<div class="left" style="font-weight:bold">
  <?php 
	$rBid = $rBid ?? '';
	$rKib = $rKib ?? '';
	$zUnt = $zUnt ?? '';
	$gThn = $gThn ?? '';
	$fUlrR = $fUlrR ?? '';
	if ($rBid=="__.__"){$yBid=$rKib;}else{$yBid=$rBid;}
	$NilBerK = fGlobal("ifnull(sum(nilai),0)","ta_penerimaan_berkas","Kd_Unit:Periode",$zUnt.":".$gThn."%","=:LIKE","","");
	$NilPenG = fGlobal("ifnull(sum(nilai),0)","ta_pengadaan","Kd_Unit:Periode",$zUnt.":".$gThn,"=:=","","");
	if ($NilPenG>$NilBerK){
		$cLA="style='color:#0000ff'";
		$cLR="style='color:#ff0000'";
	}
	else if ($NilPenG<$NilBerK){
		$cLA="style='color:#ff0000'";
		$cLR="style='color:#0000ff'";
	}
	else{
		$cLA="";
		$cLR="";
	}
  	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NILAI PENERIMAAN BERKAS&nbsp;&nbsp;:&nbsp;&nbsp;<font $cLA>".fConvertToRupiah($NilBerK)."</font>";
  	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NILAI PENGADAAN&nbsp;&nbsp;:&nbsp;&nbsp;<font $cLR>".fConvertToRupiah($NilPenG)."</font>";
  ?>
</div>
<div class="right"> 
  <?php
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
<?php
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
<?php
$qBid = substr($yBid,0,2);
?>
</table>
<?php 
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
<?php } ?>