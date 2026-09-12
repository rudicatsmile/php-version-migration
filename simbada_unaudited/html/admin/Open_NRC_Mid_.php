<?
require "Connection.php";
require "FileFunction.php";
require "CheckLogin.php";

extract($_GET);
mysql_select_db(DatabaseSB,$ConSB);
if ($fUnt=="All"){$fUnt="__.__.__.__";}
if ($fSmP=="Repair") 
{
	mysql_select_db(DatabaseSB,$ConSB);
	$nSQ="DELETE FROM ta_kib_post_neraca_108 WHERE kd_upb LIKE '".substr($fUnt,0,11)."%' AND mid(kd_aset_108,1,5) = '$fAst' AND periode='$fThn'";
	$nRs = mysql_query($nSQ) or die(mysql_error());
	
	$mSQ ="SELECT Referensi, Kd_UPB, Kd_Aset_108, IfNull(sum(Debet),0) as JmlA, No_Register 
	FROM ta_kib_post_108 WHERE Kd_UPB LIKE '".substr($fUnt,0,11)."%' AND mid(Kd_Aset_108,1,5) = '$fAst' AND Tanggal <= '".$fThn."-12-31' AND extracom='N' GROUP BY Referensi ORDER BY Referensi";
	$mRs = mysql_query($mSQ) or die(mysql_error());
	while ($mRo = mysql_fetch_array($mRs, MYSQL_BOTH))
	{
		$gREF = $mRo[0];
		$gUPB = $mRo[1];
		$gKDA = $mRo[2];
		$JmlA = $mRo[3];
		$NorR = $mRo[4];
		$rUPB = substr($gUPB,0,11);
		
		$gNIM = fGlobal("IfNull(sum(Koreksi_Akumulasi),0)","ta_kib_post_penyusutan_bulanan_108","Kd_UPB:Referensi:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$rUPB."%:".$gREF.":".($fThn-1).":Y:IV:N","LIKE:=:=:=:=:=","","");
		$gNIT = fGlobal("IfNull(sum(Beban_Tahun_Berjalan),0)","ta_kib_post_penyusutan_bulanan_108","Kd_UPB:Referensi:PerLap:Nilai_Akhir:SdhMutasi",$rUPB."%:".$gREF.":".$fThn.":N:N","LIKE:=:=:=:=","IndexData DESC LIMIT 0,1","");
		
		$gNID = fGlobal("IfNull(sum(Koreksi_Akumulasi),0):IfNull(sum(Nilai_Buku),0)","ta_kib_post_penyusutan_bulanan_108","Kd_UPB:Referensi:PerLap:Nilai_Akhir:Triwulan:SdhMutasi",$rUPB."%:".$gREF.":".$fThn.":Y:IV:N","LIKE:=:=:=:=:=","","");
		$gNID = explode(":",$gNID);
		$gNIA = $gNID[0];
		$gNIB = $gNID[1];
		
		$ThnPer = "";
		$NoRegi = "";
		$NilPer = 0;
		
		$DtA = fGlobal("harga:tgl_perolehan:no_register:nm_aset","ta_kib_108","kd_upb:referensi:extracom",$rUPB."%:".$gREF.":N","LIKE:=:=","","");
		if ($DtA){
			$DtB = explode(":",$DtA);
			$NilPer = $DtB[0];
			$TglPer = $DtB[1];
			$NoRegi = $DtB[2];
			$NmAset = $DtB[3];
			$ThnPer = substr($TglPer,0,4);
		}
		
		$NilAWL = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","kd_upb:referensi:tanggal:extracom",$rUPB."%:".$gREF.":".$fThn."-01-01:N","LIKE:=:<:=","","");
		if ($NilAWL==0) {$NilAWL=$NilPer;}
		
		$NilATR = fGlobal("IfNull(sum(Debet),0)","ta_kib_post_108","kd_upb:referensi:crit:tanggal:tanggal:extracom",$rUPB."%:".$gREF.":SLD:".$fThn."-01-01:".$fThn."-12-31:N","LIKE:=:<>:>=:<=:=","","");
		
		$CeK  = fGlobal("IDT","ta_kib_post_neraca_108","Referensi:Kd_UPB:Periode",$gREF.":".$gUPB.":".$fThn,"=:=:=","","");
		if ($CeK=="")
		{
			$SQ = "INSERT INTO ta_kib_post_neraca_108 SET 
			Referensi='".$mRo['Referensi']."',
			Kd_UPB='".$gUPB."',
			Kd_Aset_108='".$gKDA."',
			Nm_Aset='".$NmAset."',
			No_Register='".$NorR."',
			Tahun_Perolehan='".$ThnPer."',
			Nilai_Perolehan='".$NilPer."',
			Periode='".$fThn."',
			Nilai_Awal='".$NilAWL."',
			Nilai_Atribusi='".$NilATR."',
			Nilai_Aset='".$mRo['JmlA']."',
			Akumulasi_PenyusutanMin='".$gNIM."',
			Beban_Tahun_Berjalan='".$gNIT."',
			Akumulasi_Penyusutan='".$gNIA."',
			Nilai_Buku='".$gNIB."',
			Pencatat='".$UID."',
			Recorded=now()";
			#echo $SQ."<br>";
			$mR = mysql_query($SQ);
		}
		else
		{
			#$SQ = "UPDATE ta_kib_post_neraca_108 SET 
			#Nm_Aset='".$NmAset."',
			#Tahun_Perolehan='".$ThnPer."',
			#Nilai_Perolehan='".$NilPer."',
			#Nilai_Awal='".$NilAWL."',
			#Nilai_Atribusi='".$NilATR."',
			#Nilai_Aset='".$mRo['JmlA']."',
			#Akumulasi_PenyusutanMin='".$gNIM."',
			#Beban_Tahun_Berjalan='".$gNIT."',
			#Akumulasi_Penyusutan='".$gNIA."',
			#Nilai_Buku='".$gNIB."',
			#Pencatat='".$UID."',
			#Recorded=now() WHERE IDT='".$CeK."'";
			#$mR = mysql_query($SQ);
		}
	}
}
if ($fSmP=="Close") 
{
	echo "<script LANGUAGE='JavaScript'>";
	echo "this.setTimeout('self.close()',0)";
	echo "</script>";
}
?>