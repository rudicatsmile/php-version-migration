<?
require('Connection.php');
require('FileFunction.php');
extract($_POST);
extract($_GET);
$Smp    = $Simpan;

$rKib  = $rKib;
$rIDT  = $rIDT;

$gBid   = $fBid;
$gKel   = $fKel;
$gObj   = $fObj;
$gRin   = $fRin;
$gSub   = $fSub;

if ($Smp=="Move")
{
	$gDTA = fGlobal("Referensi:Ref_Group:Kd_UPB","ta_kib_108","IDT",$rIDT,"=","","");
	if ($gDTA)
	{
		$gDTA = explode(":",$gDTA);
		$gRef = $gDTA[0];
		$gReG = $gDTA[1];
		$gUpb = $gDTA[2];
		
		#if ($gReG) {
		#	UpdateMultiRecord($gUpb,$gSub,substr($rKib,0,5),$gReG,DatabaseSB,$ConSB);
		#}
		#else {
			UpdateSingleRecord($gUpb,$gSub,substr($rKib,0,5),$gRef,DatabaseSB,$ConSB);
		#}
	}
	$URL="Move_Account_Mid.php?gBid=".$gBid."&gKel=".$gKel."&gObj=".$gObj."&gRin=".$gRin."&gSub=".$gSub."&rIDT=".$rIDT."&rKib=".$rKib."&IdL=".$IdL;
	header("Location: ".$URL);
}
else if ($Smp=="Close")
{
	if (strlen($rKib)==6){
		$rKib = substr($rKib,-2,2);
	}
	else{
		$rKib = substr($rKib,-1,1);
	}
	$URL="Form_Asset_".$rKib."_Mid.php?rIDT=".$rIDT."&IdL=".$IdL;
	?>
	<script LANGUAGE="JavaScript">            
	this.window.open ('<?=$URL?>','WinFormKIB_Mid')
	this.window.focus()
	this.window.document.close() 
	this.setTimeout("self.close()",0)
	</script>
	<?
}
else
{
	$URL="Move_Account_Mid.php?gBid=".$gBid."&gKel=".$gKel."&gObj=".$gObj."&gRin=".$gRin."&gSub=".$gSub."&rIDT=".$rIDT."&rKib=".$rKib."&IdL=".$IdL;
	header("Location: ".$URL);
}

function UpdateSingleRecord($gUpb,$gSub,$rKib,$gRef,$DatabaseSB,$ConSB)
{
	mysql_select_db($DatabaseSB,$ConSB);
	$NmAS = fGlobal("Nm_Aset","Ref_Rek_Aset108_7","Kd_Aset",$gSub,"=","","");
	
	$yRef = substr($gRef,0,3);
	if (substr($gSub,0,5)=='1.5.4' && $yRef!='KDL')
	{
		#New ref
		$NewK = fGlobal("count_referensi","ta_kib_108_count_referensi","ref_crit","KDL","=","","");
		if ($NewK==0)
		{
			$NewK = fGlobal("IfNull(max(referensi),0)","ta_kib_108","referensi","KDL%","LIKE","","");
			$NewB = fGlobal("IfNull(max(referensi),0)","ta_kib_108_mutasi","referensi","KDL%","LIKE","","");
			$NewC = fGlobal("IfNull(max(referensi),0)","ta_kib_108_merger_his","referensi","KDL%","LIKE","","");
			
			$NewK = (int)substr($NewK,-11,11);
			$NewB = (int)substr($NewB,-11,11);
				$NewC = (int)substr($NewC,-11,11);
			if ($NewB > $NewK){$NewK = $NewB;}
			if ($NewC > $NewK){$NewK = $NewC;}
		}
			
		$NewK = $NewK + 1;
	
		$SQ="UPDATE ta_kib_108_count_referensi SET count_referensi='".$NewK."' WHERE ref_crit='KDL'";
		mysql_query($SQ);
		#*************
			
		$NewRefKIB = "KDL.".fMakeReferensi($NewK,11);
		
		$SQ="UPDATE ta_kib_108 SET Kd_Aset_108='".$gSub."', Referensi='".$NewRefKIB."', Nm_Aset='".$NmAS."' WHERE Referensi='".$gRef."' AND Kd_UPB='".$gUpb."'";
		mysql_query($SQ) or die(mysql_error());
		
		$SQ="UPDATE ta_kib_post_108 SET Kd_Aset_108='".$gSub."', Referensi='".$NewRefKIB."' WHERE Referensi='".$gRef."' AND Kd_UPB='".$gUpb."'";
		mysql_query($SQ) or die(mysql_error());
		
		$SQ="UPDATE ta_kib_post_penyusutan_108 SET Kd_Aset_108='".$gSub."', Referensi='".$NewRefKIB."' WHERE Referensi='".$gRef."' AND Kd_UPB='".$gUpb."'";
		mysql_query($SQ) or die(mysql_error());
	}
	else if (substr($gSub,0,5)=='1.3.6' && $yRef!='KDP')
	{
		#New ref
		$NewK = fGlobal("count_referensi","ta_kib_108_count_referensi","ref_crit","KDP","=","","");
		if ($NewK==0)
		{
			$NewK = fGlobal("IfNull(max(referensi),0)","ta_kib_108","referensi","KDP%","LIKE","","");
			$NewB = fGlobal("IfNull(max(referensi),0)","ta_kib_108_mutasi","referensi","KDP%","LIKE","","");
			$NewC = fGlobal("IfNull(max(referensi),0)","ta_kib_108_merger_his","referensi","KDP%","LIKE","","");
			
			$NewK = (int)substr($NewK,-11,11);
			$NewB = (int)substr($NewB,-11,11);
				$NewC = (int)substr($NewC,-11,11);
			if ($NewB > $NewK){$NewK = $NewB;}
			if ($NewC > $NewK){$NewK = $NewC;}
		}
			
		$NewK = $NewK + 1;
		
		$SQ="UPDATE ta_kib_108_count_referensi SET count_referensi='".$NewK."' WHERE ref_crit='KDP'";
		mysql_query($SQ);
		#*************
			
		$NewRefKIB = "KDP.".fMakeReferensi($NewK,11);
		
		$SQ="UPDATE ta_kib_108 SET Kd_Aset_108='".$gSub."', Referensi='".$NewRefKIB."', Nm_Aset='".$NmAS."' WHERE Referensi='$gRef' AND Kd_UPB='".$gUpb."'";
		mysql_query($SQ) or die(mysql_error());
		
		$SQ="UPDATE ta_kib_post_108 SET Kd_Aset_108='".$gSub."', Referensi='".$NewRefKIB."' WHERE Referensi='".$gRef."' AND Kd_UPB='".$gUpb."'";
		mysql_query($SQ) or die(mysql_error());
		
		$SQ="UPDATE ta_kib_post_penyusutan_108 SET Kd_Aset_108='".$gSub."', Referensi='".$NewRefKIB."' WHERE Referensi='".$gRef."' AND Kd_UPB='".$gUpb."'";
		mysql_query($SQ) or die(mysql_error());
	}
	else
	{
		$SQ="UPDATE ta_kib_108 SET Kd_Aset_108='".$gSub."', Nm_Aset='".$NmAS."' WHERE Referensi='".$gRef."' AND Kd_UPB='".$gUpb."'";
		mysql_query($SQ) or die(mysql_error());
		
		$SQ="UPDATE ta_kib_post_108 SET Kd_Aset_108='".$gSub."' WHERE Referensi='".$gRef."' AND Kd_UPB='".$gUpb."'";
		mysql_query($SQ) or die(mysql_error());
		
		$SQ="UPDATE ta_kib_post_penyusutan_108 SET Kd_Aset_108='".$gSub."' WHERE Referensi='".$gRef."' AND Kd_UPB='".$gUpb."'";
		mysql_query($SQ) or die(mysql_error());
	}
}

function UpdateMultiRecord($gUpb,$gSub,$rKib,$gReG,$DatabaseSB,$ConSB)
{
	mysql_select_db($DatabaseSB,$ConSB);
	$gSQ = "SELECT Referensi FROM ta_kib_108 WHERE Ref_Group='$gReG' ORDER BY Referensi";
	$gRs = mysql_query($gSQ) or die(mysql_error('Error connections..!!'));
	while ($gRo = mysql_fetch_array($gRs, MYSQL_BOTH))
	{
		$gRef = $gRo[0];
		UpdateSingleRecord($gUpb,$gSub,$rKib,$gRef,$DatabaseSB,$ConSB);
	}
}

#function fMakeRegister($gRefVr,$nDgT)
#{
#	$NewKRg = substr("0000000".$gRefVr,-$nDgT,strlen("0000000".$gRefVr));
#	return $NewKRg;
#}

?>
