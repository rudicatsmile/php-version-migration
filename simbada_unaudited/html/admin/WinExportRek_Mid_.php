<?
require('Connection.php');
$Smp    = $_POST['Proses'];
$gBid   = $_POST['fBid'];
$gKel   = $_POST['fKel'];
$gJen   = $_POST['fJen'];

$gBid2   = $_POST['fBid2'];
$gKel2   = $_POST['fKel2'];
$gJen2   = $_POST['fJen2'];

if ($Smp=="Proses")
{
	$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset108_6 WHERE Kd_Aset LIKE '".$gJen.".__' ORDER BY Kd_Aset";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$gKD = fGlobalNEW("max(kd_aset)","ref_rek_aset108_6","kd_aset",$gJen2."%","LIKE","",DatabaseSB,$ConSB,"");
		if ($gKD!=''){
			$NeKd = ((int)substr($gKD,-2,2))+1;
		}
		else{
			$NeKd= 1;
		}
		$NeKd6 = $gJen2.".".fMakeDigit($NeKd,2);
		$NmRk6 = $mRo[1];
		
		$S66="INSERT INTO ref_rek_aset108_6 SET kd_aset='".$NeKd6."',nm_aset='".$NmRk6."'";
		$n66= mysql_query($S66);
		
		copy7($mRo[0],$NeKd6,DatabaseSB,$ConSB);
	}
	
	$URL="WinExportRek_Mid.php?gBid=".$gBid."&gKel=".$gKel."&gJen=".$gJen."&gBid2=".$gBid2."&gKel2=".$gKel2."&gJen2=".$gJen2."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}
else if ($Smp=="Close")
{
	?>
	<script LANGUAGE="JavaScript">            
	this.setTimeout("self.close()",0)
	</script>
	<?
}
else
{
	$URL="WinExportRek_Mid.php?gBid=".$gBid."&gKel=".$gKel."&gJen=".$gJen."&gBid2=".$gBid2."&gKel2=".$gKel2."&gJen2=".$gJen2."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}

function copy7($NeKd6Old,$NeKd6,$DatabaseSB,$ConSB)
{
	$i77 = 1;
	$nS77 = "SELECT kd_aset, nm_aset FROM ref_rek_aset108_7 WHERE kd_aset LIKE '".$NeKd6Old."%' ORDER BY kd_aset";
	$nR77 = mysql_query($nS77);
	while ($mR77 = mysql_fetch_array($nR77, MYSQL_BOTH))
	{
		$NeKd7 = $NeKd6.".".fMakeDigit($i77,3);
		$NmRk7 = $mR77[1];
		
		$S77="INSERT INTO ref_rek_aset108_7 SET kd_aset='".$NeKd7."',nm_aset='".$NmRk7."', Link_Kib_AE='".$mR77[0]."'";
		$n77= mysql_query($S77);
		
		$i77++;
	}
}

function fMakeDigit($gDGT,$nDgT)
{
	$NewKRg = substr("000".$gDGT,-$nDgT,strlen("000".$gDGT));
	return $NewKRg;
}

/*
function copy3($gJen,$gJen2,$gKel2,$NmRK3,$DatabaseSB,$ConSB)
{
	if ($gJen2==''){
		$gKD = fGlobalNEW("max(kd_aset)","ref_rek_aset108_5","kd_aset",$gKel2."%","LIKE","",$DatabaseSB,$ConSB,"");
		if ($gKD!=''){
			$NeKd = ((int)substr($gKD,-2,2))+1;
		}
		else{
			$NeKd= 1;
		}
		$NeKd5= $gKel2.".".fMakeDigit($NeKd,2);
		copy3insert5($gJen,$NeKd5,$NmRK3,$DatabaseSB,$ConSB);
	}
	else{
		$NeKd5= $gJen2;
		copy4insert6($gJen,$NeKd5,$DatabaseSB,$ConSB);
	}
}

function copy4insert6($gJen,$NeKd5,$DatabaseSB,$ConSB)
{
	$i46 = 1;
	$nS46 = "SELECT kd_aset, nm_aset, Ms_Manfaat, Satuan, nilaiExtracom FROM ref_rek_aset4 WHERE kd_aset LIKE '".$gJen."%' ORDER BY kd_aset";
	$nR46 = mysql_query($nS46);
	while ($mR46 = mysql_fetch_array($nR46, MYSQL_BOTH))
	{
		$KdOBJ17 = $mR46[0];
		$NeKd6   = $NeKd5.".".fMakeDigit($i46,2);
		$NmRk6   = $mR46[1];
		
		$S46="INSERT INTO ref_rek_aset108_6 SET kd_aset='".$NeKd6."',nm_aset='".$NmRk6."'";
		$n46= mysql_query($S46);
		
		if ($n46){
			copy5insert7($KdOBJ17,$NeKd6,$DatabaseSB,$ConSB);
			$i46++;
		}
	}
		
}

function copy5insert7($KdOBJ17,$NeKd6,$DatabaseSB,$ConSB)
{
	$i57 = 1;
	$nS57 = "SELECT kd_aset, nm_aset FROM ref_rek_aset5 WHERE kd_aset LIKE '".$KdOBJ17."%' ORDER BY kd_aset";
	$nR57 = mysql_query($nS57);
	while ($mR57 = mysql_fetch_array($nR57, MYSQL_BOTH))
	{
		$NeKd7 = $NeKd6.".".fMakeDigit($i57,3);
		$NmRk7 = $mR57[1];
		
		$S57="INSERT INTO ref_rek_aset108_7 SET kd_aset='".$NeKd7."',nm_aset='".$NmRk7."'";
		$n57= mysql_query($S57);
		
		$i57++;
	}
}

function copy3insert5($gJen,$NeKd5,$NmRK3,$DatabaseSB,$ConSB)
{
	$S35="INSERT INTO ref_rek_aset108_5 SET kd_aset='".$NeKd5."',nm_aset='".$NmRK3."'";
	$n35= mysql_query($S35);
	
	if ($n35) {
		copy4insert6($gJen,$NeKd5,$DatabaseSB,$ConSB);
	}
}
*/
?>
