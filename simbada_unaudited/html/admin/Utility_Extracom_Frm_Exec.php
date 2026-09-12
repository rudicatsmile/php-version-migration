<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$JmL  = (substr_count($gCrID, "-")-1);
$gDT  = explode("-",$gCrID);

$SyT = "";
for ($i=0; $i<=$JmL; $i++)
{
	if ($i>0){
		$SyT.= " OR IDT='".$gDT[$i]."'";
	}
	else{
		$SyT = "IDT='".$gDT[$i]."'";
	}
}

$iG=1;
$gTbL = fNmHuruf((int)$gExT);

if ($gNoN=="Y"){
	$rNoN="N";
}
else if ($gNoN=="N"){
	$rNoN="Y";
}
else{
	$rNoN="N";
}

#echo "ddddddd"; return false;

$SyTA ="Kd_Aset_108 LIKE '".$gExT."%' AND ";

if ($eMuT=="")
{
	$nSQ="SELECT IDT, Referensi, Kd_UPB, Ref_Mutasi FROM ta_kib_108 WHERE ".$SyTA." (".$SyT.") ORDER BY Referensi";
	#echo $nSQ;
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$rMuT= $mRo[3];
		$mSQ = "UPDATE ta_kib_108 SET extracom='".$rNoN."' WHERE IDT = '".$mRo[0]."'";
		$mRs = mysql_query($mSQ);
		
		$mSQ = "UPDATE ta_kib_post_108 SET extracom='".$rNoN."' WHERE Referensi='".$mRo[1]."' AND Kd_UPB LIKE '".$gUnT."%'";// AND Kd_Aset_108 LIKE '".$gExT."%'";
		$mRs = mysql_query($mSQ);
		
		if ($rMuT!="")
		{
			#UPDATE STATUS EXTRA DITABEL MUTASI
			$rExT = substr(fGlobal("Kd_Aset_108","ta_kib_post_108_mutasi","Referensi:Referensi_To:Kd_Aset_To",$rMuT.":".$mRo[1].":".$gExT."%","=:=:LIKE","",""),0,2);
			if ($rExT){
				$eTbL = fNmHuruf((int)$rExT);
				$mSQ = "UPDATE ta_kib_post_108_mutasi SET extracom='".$rNoN."' WHERE Referensi='".$rMuT."' AND Referensi_To='".$mRo[1]."'";// AND Kd_Aset_To LIKE '".$gExT."%'";
				$mRs = mysql_query($mSQ);
				
				$mSQ = "UPDATE ta_kib_108_mutasi SET extracom='".$rNoN."' WHERE Referensi='".$rMuT."' AND Referensi_To = '".$mRo[1]."'";// AND Kd_Aset_To LIKE '".$gExT."%'";
				$mRs = mysql_query($mSQ);
			}
		}
		$iG++;
	}
}
else
{
	$nSQ="SELECT IDT, Referensi, Kd_UPB FROM ta_kib_108".$eMuT." WHERE ".$SyTA." (".$SyT.") ORDER BY Referensi";
	$nRs = mysql_query($nSQ);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$mSQ = "UPDATE ta_kib_108".$eMuT." SET extracom='".$rNoN."' WHERE IDT = '".$mRo[0]."'";
		$mRs = mysql_query($mSQ);
		
		$mSQ = "UPDATE ta_kib_post_108".$eMuT." SET extracom='".$rNoN."' WHERE Referensi='".$mRo[1]."' AND Kd_UPB LIKE '".$gUnT."%' AND Kd_Aset_108 LIKE '".$gExT."%'";
		$mRs = mysql_query($mSQ);
	}
}
echo "<script languange='javascript'>RefreshDATA('".$IdL."')</script>";
?>
