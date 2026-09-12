<?
extract($_GET);
require('Connection.php');
require('FileFunction.php');
require('Connection_CopyData.php');
require("CheckLogin.php");
CallConnection(DatabaseSC,$ConSC);

$gCrID= $gCrID;
$gTbL = $gTbL;
$nUnT = $nUNT;
$nSuB = $nSUB;
$nUpB = $nUPB;
$PgE  = $PgE;

if ($nUpB==""){$nUpB=$nSuB;}
if ($nUpB==""){$nUpB=$nUnT;}
if (strlen($nUpB)==14){$nUpB.=".001";}
if (strlen($nUpB)==11){$nUpB.=".01.001";}

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

$NmFL= array();
$NmFP= array();
$iG  = 0;

$SQL ="SHOW Fields FROM ta_kib_".$gTbL;
$nRs = mysql_query($SQL) or die(mysql_error());
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$iG++;
	$NmFL[$iG] = $mRo['Field'];
}

$nSQ="SELECT * FROM ta_kib_".$gTbL." WHERE (".$SyT.") ORDER BY IDT";
$nRs = mysql_query($nSQ);
while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
{
	$rRef= $mRo['Referensi'];
	$nUpA= $mRo['Kd_UPB'];
	
	$rFn = fGlobalNEW("IDT","ta_kib_".$gTbL,"referensi",$rRef,"=","",DatabaseSB,$ConSB,"");
	if ($rFn=="" && $gTbL!="f"){
		$rFn = fGlobalNEW("IDT","ta_kib_".$gTbL."_mutasi","referensi",$rRef,"=","",DatabaseSB,$ConSB,"");
	}
	
	if ($rFn=="" && ($gTbL=="a" || $gTbL=="c" || $gTbL=="d")){
		$rFn = fGlobalNEW("IDT","ta_kib_".$gTbL."_merger_his","referensi",$rRef,"=","",DatabaseSB,$ConSB,"");
	}
	
	if ($rFn==""){
		$New = $rRef;
	}
	else{
		$nRe = fGlobalNEW("max(referensi)","ta_kib_".$gTbL,"referensi","%","LIKE","",DatabaseSB,$ConSB,"");
		$nRa=0;
		if ($gTbL!="f"){
			$nRa = fGlobalNEW("max(referensi)","ta_kib_".$gTbL."_mutasi","referensi","%","LIKE","",DatabaseSB,$ConSB,"");
		}
		$nRb=0;
		if ($gTbL=="a" || $gTbL=="c" || $gTbL=="d"){
			$nRb = fGlobalNEW("max(referensi)","ta_kib_".$gTbL."_merger_his","referensi","%","LIKE","",DatabaseSB,$ConSB,"");
		}
		
		$New = (int)substr($nRe,-11,11);
		$Nea = (int)substr($nRa,-11,11);
		$Neb = (int)substr($nRb,-11,11);
		
		if ($Nea > $New){$New=$Nea;}
		if ($Neb > $New){$New=$Neb;}
		
		$New = $New + 1;
	
		if ($gTbL=='a'){$New = "TNH.".fMakeReferensi($New,11);}
		if ($gTbL=='b'){$New = "ALT.".fMakeReferensi($New,11);}
		if ($gTbL=='c'){$New = "BNG.".fMakeReferensi($New,11);}
		if ($gTbL=='d'){$New = "JLN.".fMakeReferensi($New,11);}
		if ($gTbL=='e'){$New = "ATL.".fMakeReferensi($New,11);}
	}
	
	$ySQa = "";
	for ($i=2; $i<=$iG; $i++)
	{
		$fVaL = mysql_real_escape_string($mRo[$NmFL[$i]]);
		if (is_null($mRo[$NmFL[$i]])) 
		{
			if ($NmFL[$i]=="Kd_Tanah1" || $NmFL[$i]=="Kd_Tanah2" || $NmFL[$i]=="Kd_Tanah3" || $NmFL[$i]=="Kd_Tanah4" || $NmFL[$i]=="Kd_Tanah5" || $NmFL[$i]=="Kode_Tanah_Old") {
				$fVaL = 0;
			}
			else if ($NmFL[$i]=="Luas_Tanah" || $NmFL[$i]=="Luas_Lantai")
			{
				$fVaL = 0;
			}
		}
		$NmFLi = strtolower($NmFL[$i]);
		if ($NmFLi!="kd_ruang")	#tidak dilibatkan
		{
			if ($i == 2) 
			{
				if ($NmFLi=="referensi") {
					$ySQa.="INSERT INTO ta_kib_".$gTbL." SET ".$NmFL[$i]."='".$New."'";
				}
				elseif ($NmFLi=="kd_upb") {
					$ySQa.="INSERT INTO ta_kib_".$gTbL." SET ".$NmFL[$i]."='".$nUpB."'";
				}
				else {
					$ySQa.="INSERT INTO ta_kib_".$gTbL." SET ".$NmFL[$i]."='".$fVaL."'";
				}
			}
			else
			{
				if ($NmFLi=="referensi") {
					$ySQa.=", ".$NmFL[$i]."='".$New."'";
				}
				elseif ($NmFLi=="kd_upb") {
					$ySQa.=", ".$NmFL[$i]."='".$nUpB."'";
				}
				else {
					$ySQa.=", ".$NmFL[$i]."='".$fVaL."'";
				}
			}
		}
	}
	
	//Proses insert ke tabel
	CallConnection(DatabaseSB,$ConSB);
	$rsa = mysql_query($ySQa);
	
	$ySQe="insert into tr_tempcopy_aset set 
	Referensi='".$rRef."', Kd_UPB='".$nUpA."', Referensi_To='".$New."', 
	Kd_UPB_To='".$nUpB."', Pencatat='".$UID."', Recorded=now()";
	$rsa = mysql_query($ySQe);
		
	dataPOST($rRef,$New,$nUpA,$nUpB,DatabaseSC,$ConSC,DatabaseSB,$ConSB);
}

function dataPOST($rRef,$New,$nUpA,$nUpB,$DatabaseSC,$ConSC,$DatabaseSB,$ConSB)
{
	CallConnection($DatabaseSC,$ConSC);
	$iP  = 0;
	$SQ ="SHOW Fields FROM ta_kib_post";
	$Rs = mysql_query($SQ) or die(mysql_error());
	while ($mR = mysql_fetch_array($Rs, MYSQL_BOTH))
	{
		$iP++;
		$NmFP[$iP] = $mR['Field'];
	}
	
	$SQ="SELECT * FROM ta_kib_post WHERE referensi='".$rRef."' AND Kd_UPB='".$nUpA."' ORDER BY tanggal,IndexData";
	$Rs = mysql_query($SQ);
	while ($mR = mysql_fetch_array($Rs, MYSQL_BOTH))
	{
		$ySWa = "";
		for ($i=2; $i<=$iP; $i++)
		{
			$fVaP = mysql_real_escape_string($mR[$NmFP[$i]]);
			$NmFPi = strtolower($NmFP[$i]);
			if ($i == 2) 
			{
				if ($NmFPi=='referensi'){
					$ySWa.="INSERT INTO ta_kib_post SET ".$NmFP[$i]."='".$New."'";
				}
				else if ($NmFPi=='kd_upb'){
					$ySWa.="INSERT INTO ta_kib_post SET ".$NmFP[$i]."='".$nUpB."'";
				}
				else if ($NmFPi=='kd_aset'){
					$ySWa.="INSERT INTO ta_kib_post SET ".$NmFP[$i]."='".$fVaP."'";
				}
				else {
					$ySWa.="INSERT INTO ta_kib_post SET ".$NmFP[$i]."='".$fVaP."'";
				}
			} 
			else 
			{
				if ($NmFPi=='referensi'){
					$ySWa.=", ".$NmFP[$i]."='".$New."'";
				}
				else if ($NmFPi=='kd_upb'){
					$ySWa.=", ".$NmFP[$i]."='".$nUpB."'";
				}
				else if ($NmFPi=='kd_aset'){
					$ySWa.=", ".$NmFP[$i]."='".$fVaP."'";
				}
				else{
					$ySWa.=", ".$NmFP[$i]."='".$fVaP."'";
				}
			}
		}
		
		//Proses insert ke tabel
		CallConnection($DatabaseSB,$ConSB);
		$rw = mysql_query($ySWa);
		
		//dataMERGER($rRef,$New,$nUpA,$nUpB,DatabaseSC,$ConSC,DatabaseSB,$ConSB);

	}
}
?>
<script languange="javascript">
	RefreshDT('<?=$IdL?>','<?=$PgE?>');
	$(document).ready(function()
	{
		$("#loadingImg").hide();
	});
</script>