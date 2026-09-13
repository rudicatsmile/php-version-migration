<table align="center" border="0" cellspacing="0" cellpadding="0" class="table-list" style="width:99%">
  <tr> 
  <td>
<?php
#echo $gRf." : ".$rKib;

$RecList = $tRo ?? 0;		//Ambil di master SQL - mysql_num_rows($nRs)
$Hasil   = mysql_query($nSQL);
$Data    = $Hasil ? mysql_fetch_assoc($Hasil) : null;
$JumData = $Data['JmlRc'] ?? 0;
$DataPerPage = !empty($DataPerPage) ? $DataPerPage : 20;
$JumPage = ceil($JumData/$DataPerPage);

$NoPage  = $NoPage ?? 1;
$Offset  = $Offset ?? 0;
$iG      = $iG ?? 1;
$fUlrR   = $fUlrR ?? '';

$nGa = (int)$JumData * $NoPage;
if (1+$Offset > $nGa)
	{$nDatG=$JumData;}
else
	{$nDatG=$nGa;}

$iB  = (int)($JumData/$DataPerPage);
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
	if ($rBid=="__.__"){$yBid=$rKib;}else{$yBid=$rBid;}
	$yBid = $yBid ?? '';
	$tMuTZ = $tMuTZ ?? '';
	$zExt = $zExt ?? '%';
	$gThnA = $gThnA ?? '';
	$gThn = $gThn ?? '';
	$gRf = $gRf ?? '';
	$rKel = $rKel ?? '';
	$rOBJ = $rOBJ ?? '';
	$rRin = $rRin ?? '';
	$zUpb = $zUpb ?? '';
	$eSD = $eSD ?? '';
	$NilAset = 0;

	if ($gThnA)
	{
		$NilAset = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108".$tMuTZ,"kd_upb:kd_aset_108:tanggal:tanggal:extracom:referensi",$zUpb.":".$yBid.".".$rKel.".".$rOBJ.".".$rRin."%:".$gThnA."-01-01:".$gThn."-12-31:".$zExt.":".$gRf."%","LIKE:LIKE:>=:<=:LIKE:LIKE","","");
	}
	else{
		if ($rKib == "05.__"){
			$NilAset = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108".$tMuTZ,"kd_upb:kd_aset_108:extracom:referensi",$zUpb.":".$yBid.".".$rKel.".".$rOBJ.".".$rRin."%:".$zExt.":".$gRf."%","LIKE:LIKE:LIKE:LIKE","","");
		}
		else{
		
		  	if ($eSD=='checked')
			{
				$NilAset = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108".$tMuTZ,"kd_upb:kd_aset_108:extracom:referensi:tanggal",$zUpb.":".$yBid.".".$rKel.".".$rOBJ.".".$rRin."%:".$zExt.":".$gRf."%:".$gThn."-12-31","LIKE:LIKE:LIKE:LIKE:<=","","");
			}
			else
			{
				if ($gThn!="" && $gThn!="____")
				{
					$NilAset = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108".$tMuTZ,"kd_upb:kd_aset_108:extracom:referensi:tanggal:tanggal",$zUpb.":".$yBid.".".$rKel.".".$rOBJ.".".$rRin."%:".$zExt.":".$gRf."%:".$gThn."-01-01:".$gThn."-12-31","LIKE:LIKE:LIKE:LIKE:>=:<=","","");
				}
				else
				{
					$NilAset = fGlobal("ifnull(sum(debet),0)","ta_kib_post_108".$tMuTZ,"kd_upb:kd_aset_108:extracom:referensi",$zUpb.":".$yBid.".".$rKel.".".$rOBJ.".".$rRin."%:".$zExt.":".$gRf."%","LIKE:LIKE:LIKE:LIKE","","");
				}
			}
		}
	}
	#echo $gThn."";
  	echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NILAI ASET&nbsp;&nbsp;:&nbsp;&nbsp;".fConvertToRupiah($NilAset);
  ?>
</div>
<div class="right"> 
  <?php
if ($NoPage > 1) 
	{
	echo "<a href='".$_SERVER['PHP_SELF']."?".$fUlrR."iG=".($iG-($DataPerPage*2)+($DataPerPage-$RecList))."&Page=".($NoPage-1)."'>Prev Page</a>";
	}
else
	{
	echo "<a href='#'>Prev Page</a>";
	}

if ($iB > 1)
{
	$xBG="";
	if ($Offset==0){
		$xBG="<font style='color:#ff0000; font-weight:bold'>";
	}
	echo "<a href='".$_SERVER['PHP_SELF']."?".$fUlrR."iG=1&Page=1'>".$xBG."1</a>";

	if ($rKib == "05.__"){
		if ($iB > 500) {$iB=500;}
	}
	else{
		if ($iB > 500) {$iB=500;}
	}

	for ($iA = 2; $iA <= $iB+1; $iA++)
		{
		if ((($Offset/$DataPerPage)+1)==$iA){
			$xBG="<font style='color:#ff0000; font-weight:bold'>";
		}
		else{
			$xBG="";
		}
		echo "<a href='".$_SERVER['PHP_SELF']."?".$fUlrR."iG=".($DataPerPage*($iA-1)+1)."&Page=".$iA."'>".$xBG.$iA."</a>";
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
	$qBid = substr((string)$yBid,0,2);
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