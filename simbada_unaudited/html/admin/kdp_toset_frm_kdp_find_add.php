<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

#echo $IdR."<br>";
#echo $IdT."<br>";

#echo $Hri."<br>";
#echo $Bln."<br>";
#echo $Thn."<br>";


$ReT = fGlobalNEW("Referensi","ta_kib_kdptoaset","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
$CnT = fGlobalNEW("count(*)","ta_kib_kdptoaset_data","Referensi",$ReT,"=","",DatabaseSB,$ConSB,"");

$IdD = "N";
if ($CnT==0)
{
	$IdD = "Y";	
}

$nSQ = "SELECT Referensi as A0, 
Kd_UPB as A1, 
Kd_Aset_108 as A2,
No_Register as A3,
Nm_Aset as A4,
Tgl_Perolehan as A5,
Harga as A6,
Lokasi as A7 

FROM ta_kib_108 WHERE IDT='".$IdR."'";
$nRs = mysql_query($nSQ); 
while ($mRo = mysql_fetch_array($nRs)) 
{ 

	$ReA = $mRo[0];
	$UpB = $mRo[1];
	$KdA = $mRo[2];
	$ReG = $mRo[3];
	$NmA = $mRo[4];
	$TgL = $mRo[5];
	$HrG = $mRo[6];
	$LoK = $mRo[7];
	
	$Cek = fGlobalNEW("IDT","ta_kib_kdptoaset_data","Referensi:Ref_Aset:Kd_UPB",$ReT.":".$ReA.":".$UpB,"=:=:=","",DatabaseSB,$ConSB,"");
	if ($Cek=='')
	{
		$SQ = "INSERT INTO ta_kib_kdptoaset_data SET 
		Referensi='".$ReT."',
		Ref_Aset='".$ReA."',
		Kd_UPB='".$UpB."',
		Kd_Aset_108='".$KdA."',
		No_Register='".$ReG."',
		Nm_Aset='".$NmA."',
		Lokasi='".$LoK."',
		Tgl_Perolehan='".$TgL."',
		Nilai='".$HrG."',
		Induk='".$IdD."',
		Recorded=now(),
		Pencatat='".$UID."'";
		$rs = mysql_query($SQ); 
		
		$SQ = "SELECT Kd_Aset_108, No_Register, Tanggal, Debet FROM ta_kib_post_108 WHERE Referensi='".$ReA."' AND Kd_UPB='".$UpB."' ORDER BY IDT";
		$rs = mysql_query($SQ); 
		while ($mR = mysql_fetch_array($rs)) 
		{ 
			$KdA = $mR[0];
			$ReG = $mR[1];
			$TgL = $mR[2];
			$DeB = $mR[3];
			
			$SA = "INSERT INTO ta_kib_kdptoaset_data_post SET 
			Referensi='".$ReT."',
			Ref_Aset='".$ReA."',
			Kd_UPB='".$UpB."',
			Kd_Aset_108='".$KdA."',
			No_Register='".$ReG."',
			Tanggal='".$TgL."',
			Nilai='".$DeB."',
			Recorded=now(),
			Pencatat='".$UID."'";
			$ra = mysql_query($SA); 
		}
	}
}
?>

<script language="javascript">
	showKDPTA('refr','<?=$IdT?>','<?=$CrDiv?>','<?=$IdL?>');
</script>