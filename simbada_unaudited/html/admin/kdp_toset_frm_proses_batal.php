<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

#echo $Rin."<br>";

if ($IdT!='')
{
	#REFERENSI
	$nREf = fGlobalNEW("Referensi","ta_kib_kdptoaset","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
	$nREk = fGlobalNEW("KeReferensi","ta_kib_kdptoaset","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
	
	$nSQ = "DELETE FROM ta_kib_108 WHERE Ref_KdpToAset='".$nREf."' AND Referensi='".$nREk."'";
	$nRs = mysql_query($nSQ); 

	$nSQ = "DELETE FROM ta_kib_post_108 WHERE Ref_KdpToAset='".$nREf."' AND Referensi='".$nREk."'";
	$nRs = mysql_query($nSQ); 

	$nSQ = "SELECT Ref_Aset, Kd_UPB FROM ta_kib_kdptoaset_data WHERE Referensi='".$nREf."'";
	$nRs = mysql_query($nSQ); 
	while ($mRo = mysql_fetch_array($nRs))
	{
		$SQ = "UPDATE ta_kib_108 SET KdpToAset='N' WHERE Referensi='".$mRo[0]."' AND Kd_UPB='".$mRo[1]."'";
		$rs = mysql_query($SQ);
		
		$SQ = "UPDATE ta_kib_post_108 SET KdpToAset='N' WHERE Referensi='".$mRo[0]."' AND Kd_UPB='".$mRo[1]."'";
		$rs = mysql_query($SQ);
	}
	
	$SQ = "UPDATE ta_kib_kdptoaset SET 
	KeReferensi='', 
	KeRegister='',
	ExePencatat='".$UID."', 
	Execute='N',
	ExeRecorded=now() WHERE IDT='".$IdT."'";
	$rs = mysql_query($SQ);
}

	

?>

<script language="javascript">
	alert('Proses pembatalan berhasil..!!');
	prosToAset('refr','<?=$IdT?>','<?=$CrDiv?>','<?=$IdL?>');
</script>