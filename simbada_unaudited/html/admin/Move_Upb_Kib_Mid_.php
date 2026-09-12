<?
require('Connection.php');
extract($_POST);
extract($_GET);
$Smp    = $Simpan;

$rKib  = $rKib;
$rIDT  = $rIDT;

$gUnt   = $fUnt;
$gSub   = $fSub;
$gUpb   = $fUpb;

if ($Smp=="Move")
{
	$gNewUPB = $gUpb;
	#$gREF = fGlobal("Referensi","ta_".strtolower(substr($rKib,0,5)),"IDT",$rIDT,"=","","");
	#$gOldUPB = fGlobal("kd_upb","ta_".strtolower(substr($rKib,0,5)),"IDT",$rIDT,"=","","");
	
	$gREF = fGlobal("Referensi","ta_kib_108","IDT",$rIDT,"=","","");
	$gOldUPB = fGlobal("kd_upb","ta_kib_108","IDT",$rIDT,"=","","");
	
	UpdateDATA($gREF,$gNewUPB,$gOldUPB,strtolower(substr($rKib,0,5)),DatabaseSB,$ConSB);
	$URL="Move_Upb_Kib_Mid.php?gSub=".$gSub."&gUpb=".$gUpb."&rIDT=".$rIDT."&rKib=".$rKib."&IdL=".$IdL;
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
	$URL="Move_Upb_Kib_Mid.php?gSub=".$gSub."&gUpb=".$gUpb."&rIDT=".$rIDT."&rKib=".$rKib."&IdL=".$IdL;
	header("Location: ".$URL);
}

function UpdateDATA($gREF,$gNewUPB,$gOldUPB,$rKib,$DatabaseSB,$ConSB)
{
	mysql_select_db($DatabaseSB,$ConSB);
	#kib
	if ($rKib=="kib_b"){
		$SQ="UPDATE ta_kib_108 SET kd_upb='$gNewUPB', kd_ruang='000' WHERE referensi='$gREF' AND kd_upb='$gOldUPB'";
	}
	else{
		$SQ="UPDATE ta_kib_108 SET kd_upb='$gNewUPB' WHERE referensi='$gREF' AND kd_upb='$gOldUPB'";
	}
	$mRs = mysql_query($SQ);
	
	$SQ="UPDATE ta_kib_post_108 SET kd_upb='$gNewUPB' WHERE referensi='$gREF' AND kd_upb='$gOldUPB'";
	$mRs = mysql_query($SQ);
	
	#kib mutasi
	if ($rKib=="kib_b"){
		$SQ="UPDATE ta_kib_108_mutasi SET kd_upb='$gNewUPB', kd_ruang='000' WHERE referensi='$gREF' AND kd_upb='$gOldUPB'";
	}
	else{
		$SQ="UPDATE ta_kib_108_mutasi SET kd_upb='$gNewUPB' WHERE referensi='$gREF' AND kd_upb='$gOldUPB'";
	}
	
	$mRs = mysql_query($SQ);
	$SQ="UPDATE ta_kib_post_108_mutasi SET kd_upb='$gNewUPB' WHERE referensi='$gREF' AND kd_upb='$gOldUPB'";
	$mRs = mysql_query($SQ);
	
	$SQ="UPDATE ta_ta_kib_108_mutasi SET kd_upb_to='$gNewUPB' WHERE referensi_to='$gREF' AND kd_upb_to='$gOldUPB'";
	$mRs = mysql_query($SQ);
	
	$SQ="UPDATE ta_kib_post_108_mutasi SET kd_upb_to='$gNewUPB' WHERE referensi_to='$gREF' AND kd_upb_to='$gOldUPB'";
	$mRs = mysql_query($SQ);
	
	$SQ="UPDATE ta_kib_post_108_neraca SET kd_upb='$gNewUPB' WHERE referensi='$gREF' AND kd_upb='$gOldUPB'";
	$mRs = mysql_query($SQ);
	
	$SQ="UPDATE ta_kib_post_penyusutan_bulanan_108 SET kd_upb='$gNewUPB' WHERE referensi='$gREF' AND kd_upb='$gOldUPB'";
	$mRs = mysql_query($SQ);
	
	if ($rKib=="kib_a" || $rKib=="kib_c" || $rKib=="kib_d"){
		$SQ="UPDATE ta_kib_108_merger_his SET kd_upb='$gNewUPB' WHERE referensi='$gREF' AND kd_upb='$gOldUPB'";
		$mRs = mysql_query($SQ);
	}
	
	$SQ="UPDATE ta_usulan_rinci_108 SET kd_upb='$gNewUPB' WHERE ref_aset='$gREF' AND kd_upb='$gOldUPB'";
	$mRs = mysql_query($SQ);
	
	$SQ="UPDATE ta_usulan_rinci_108 SET kd_upb='$gNewUPB' WHERE ref_aset='$gREF' AND kd_upb='$gOldUPB'";
	$mRs = mysql_query($SQ);
	
	$SQ="UPDATE ta_usulan_verifikasi_rinci_108 SET kd_upb='$gNewUPB' WHERE ref_aset='$gREF' AND kd_upb='$gOldUPB'";
	$mRs = mysql_query($SQ);
	
	$SQ="UPDATE ta_usulan_verifikasi_rinci_syarat_108 SET kd_upb='$gNewUPB' WHERE ref_aset='$gREF' AND kd_upb='$gOldUPB'";
	$mRs = mysql_query($SQ);
	
	
}
?>
