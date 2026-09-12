<?
$RepairIdTabelMaster="YAXXXXXXX";
if ($RepairIdTabelMaster=="YA" && $UID =="creator")
{
	$SQA ="SELECT P1.IdTabelMaster as A0, P1.Referensi as A1 
	FROM ta_kib_108 P1 
	WHERE (P1.Referensi LIKE 'TNH.%' OR P1.Referensi LIKE 'TNH.%' OR P1.Referensi LIKE 'TNH.%') AND P1.IdTabelMaster<>'' 
	GROUP BY P1.Referensi";
	$iG=1;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$SW = "UPDATE ta_kib_post_108 SET IdTabelHarga='".$mRo[0]."' WHERE Referensi='".$mRo[1]."' AND (IdTabelHarga='' OR IdTabelHarga='-')";
		mysql_query($SW);
		echo $iG++.". ".$SW."<br><br>";
	}
}

$RepairTGLATRIBUSI="YAXXXXXXXXX";
if ($RepairTGLATRIBUSI=="YA" && $UID =="creator")
{
	$SQA ="SELECT P1.IdTabelMaster as A0, P1.Referensi as A1, P1.Harga as A2, sum(P2.Debet) as A3 
	FROM ta_kib_108 P1 
	left join ta_kib_post_108 P2 ON P2.Referensi=P1.Referensi 
	WHERE P1.Referensi like 'BNG.%' AND P1.IdTabelMaster<>'' 
	GROUP BY P1.Referensi";
	$iG=1;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		if ($mRo[2] != $mRo[3])
		{
			#echo $iG++.". ".$mRo[0].":".$mRo[1]." => ".$mRo[2]." : ".$mRo[3]."<br>";
			echo "Old Ref : ".$mRo[1]."<br>";
			$RefNew = fGlobal("Referensi","ta_kib_108_ada_atribusi","IdTabelMaster",$mRo[0],"=","","");
			echo "New Ref : ".$RefNew."<br>";
			
			$SQ = "SELECT IDT, Referensi, Tanggal, Debet FROM ta_kib_post_108 WHERE Referensi='".$mRo[1]."' AND Crit='INV' ORDER BY Referensi";
			$nR = mysql_query($SQ);
			while ($mR = mysql_fetch_array($nR, MYSQL_BOTH))
			{
				echo $mR[0].":".$mR[1].":".$mR[2].":".$mR[3]."<br>";
				$NewDtA = fGlobal("Tanggal:Debet","ta_kib_post_108_ada_atribusi","Referensi:Debet",$RefNew.":".$mR[3],"=:=","","");
				$NewTgL = fGlobal("Tanggal","ta_kib_post_108_ada_atribusi","Referensi:Debet",$RefNew.":".$mR[3],"=:=","","");
				echo $RefNew.":".$NewDtA."<br>";
				
				if ($NewTgL!='' && $NewTgL!='0000-00-00' && ($NewTgL!=$mR[2]))
				{
					$SW = "UPDATE ta_kib_post_108 SET Tanggal='".$NewTgL."' WHERE IDT='".$mR[0]."'";
					#mysql_query($SW);
					echo $SW."<br><br>";
				}
			}
		}
	}
}


$RepairKDP="YAxxxxxx";

if ($RepairKDP=="YA" && $UID =="creator")
{
	$SQA ="SELECT Referensi, IdTabelMaster FROM ta_kib_108 WHERE (
	IdTabelMaster='08010010013000059' OR 
	IdTabelMaster='08010010013000060' OR 
	IdTabelMaster='08010010013000061' OR 
	IdTabelMaster='08010010013000062' OR 
	IdTabelMaster='08010020093000015' OR 
	IdTabelMaster='08010020103000026' OR 
	IdTabelMaster='08010020113000027' OR 
	IdTabelMaster='08010020123000010' OR 
	IdTabelMaster='08010020133000015' OR 
	IdTabelMaster='08010020143000015' OR 
	IdTabelMaster='08010020153000014' OR 
	IdTabelMaster='08010020203000019' OR 
	IdTabelMaster='08010020213000004' OR 
	IdTabelMaster='08010020223000008' OR 
	IdTabelMaster='08010020223000010' OR 
	IdTabelMaster='08010020233000006' OR 
	IdTabelMaster='08010020293000005' OR 
	IdTabelMaster='08010020393000001' OR 
	IdTabelMaster='08010020543000007' OR 
	IdTabelMaster='08010030023000008' OR 
	IdTabelMaster='08010030073000010' OR 
	IdTabelMaster='08010030103000012' OR 
	IdTabelMaster='08010030113000004' OR 
	IdTabelMaster='08010030183000007' OR 
	IdTabelMaster='08010030213000003' OR 
	IdTabelMaster='08010030343000012' OR 
	IdTabelMaster='08010030363000001' OR 
	IdTabelMaster='08010040033000019' OR 
	IdTabelMaster='08010040043000004' OR 
	IdTabelMaster='08010040224000001' OR 
	IdTabelMaster='08010040363000010' OR 
	IdTabelMaster='08010050023000012' OR 
	IdTabelMaster='08010050233000003' OR 
	IdTabelMaster='08010050233000004' OR 
	IdTabelMaster='08010050243000006' OR 
	IdTabelMaster='08010060023000004' OR 
	IdTabelMaster='08010060123000005' OR 
	IdTabelMaster='08010060123000006' OR 
	IdTabelMaster='08010060193000009' OR 
	IdTabelMaster='08010070133000015' OR 
	IdTabelMaster='08010070183000009' OR 
	IdTabelMaster='08010070303000011' OR 
	IdTabelMaster='08010070323000003' OR 
	IdTabelMaster='08010080023000008' OR 
	IdTabelMaster='08010080033000001' OR 
	IdTabelMaster='08010080033000010' OR 
	IdTabelMaster='08010080033000011' OR 
	IdTabelMaster='08010080053000002' OR 
	IdTabelMaster='08010080214000002' OR 
	IdTabelMaster='08010080283000012' OR 
	IdTabelMaster='08010090023000009' OR 
	IdTabelMaster='08010090213000003' OR 
	IdTabelMaster='08010100033000004' OR 
	IdTabelMaster='08010100043000006' OR 
	IdTabelMaster='08010100343000007' OR 
	IdTabelMaster='08010100353000006' OR 
	IdTabelMaster='08010110013000009' OR 
	IdTabelMaster='08010110023000008' OR 
	IdTabelMaster='08010110033000015' OR 
	IdTabelMaster='08010110043000001' OR 
	IdTabelMaster='08010110043000009' OR 
	IdTabelMaster='08010110133000001' OR 
	IdTabelMaster='08010110353000007' OR 
	IdTabelMaster='08010120023000027' OR 
	IdTabelMaster='08010120093000006' OR 
	IdTabelMaster='08010120093000007' OR 
	IdTabelMaster='08010120103000007' OR 
	IdTabelMaster='08010120223000001')
	ORDER BY Referensi";
	$iG=1;
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		echo $mRo[0].":".$mRo[1]."<br>";
		$eRef = $mRo[0];
		if (substr($mRo[0],0,3)!="KDP")
		{
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
			#mysql_query($SQ);
			
			$NewRefKIB  = "KDP.".fMakeReferensi($NewK,11);
			
			$SQ="UPDATE ta_kib_108 SET Referensi='".$NewRefKIB."', Kd_Aset_108='1.3.6.01.01.01.003' WHERE Referensi='".$eRef."'";
			#mysql_query($SQ);
			
			$SQ="UPDATE ta_kib_post_108 SET Referensi='".$NewRefKIB."', Kd_Aset_108='1.3.6.01.01.01.003', IdTabelHarga='".$mRo[1]."' WHERE Referensi='".$eRef."'";
			#mysql_query($SQ);
		}
		else
		{
			$SQ="UPDATE ta_kib_108 SET Nm_Aset='Gedung dan Bangunan Dalam Pengerjaan' WHERE Referensi='".$eRef."'";
			echo $SQ."<br>";
			mysql_query($SQ);
			
			#$SQ="UPDATE ta_kib_post_108 SET IdTabelHarga='".$mRo[1]."' WHERE Referensi='".$eRef."'";
			#echo $SQ."<br>";
			#mysql_query($SQ);
		}
	}
}


$RepairNilaiAset="YAzzzzzz";
if ($RepairNilaiAset=="YA" && $UID =="creator")
{
	$SQA ="SELECT IDT, Referensi FROM ta_kib_108 WHERE Harga='0' ORDER BY Referensi LIMIT 0,100";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$Ref = $mRo[1];
		$HrG = fGlobal("IfNull(sum(debet),0)","ta_kib_post_108","referensi",$Ref,"=","","");
		if ($HrG > 0)
		{
			$SQ = "UPDATE ta_kib_108 SET Harga='".$HrG."', Nilai_Akhir='".$HrG."' WHERE IdT='".$mRo[0]."'";
			echo $SQ."<br><br>";
			mysql_query($SQ);
		}
	}
}

$RepairNmAset="YAxxx";

if ($RepairNmAset=="YA" && $UID =="creator")
{
	$SQA = "select 
	p1.referensi as A0, 
	p1.nm_Aset_108 as A1, 
	p2.referensi as A2, 
	p2.nm_Aset as A3,
	p2.referensi as A4 
	FROM ta_kib_108_temp p1 
	LEFT JOIN ta_kib_108 p2 on p2.ref_temp=p1.referensi
	where p1.no_pengadaan like '24.04.__.__.2024.______' 
	group by p1.referensi";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		if ($mRo[1]!='' && $mRo[4]!='' && ($mRo[3]!=$mRo[1]))
		{
			echo $mRo[1].":".$mRo[3]."<br>";
			
			$SQ = "UPDATE ta_kib_108 SET nm_Aset='".$mRo[1]."' WHERE ref_temp='".$mRo[0]."'";
			echo $SQ."<br><br>";
			mysql_query($SQ);
		}
	}
}


$CopyUPB="YAxxx";

if ($CopyUPB=="YA" && $UID =="creator")
{
	$SQA = "select Kd_UPB, Nm_UPB FROM ref_upb WHERE Kd_UPB LIKE '24.04.07.01.__.___' ORDER BY Kd_UPB";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$Old = $mRo[0];
		$New = "24.04.07.06.".substr($mRo[0],-6,6);
		echo $Old."<br>".$New."<br><br>";
		$CeK = fGlobal("IDT","ref_upb","Kd_UPB",$New,"=","","s");
		if ($CeK=='')
		{
			$SQ = "INSERT INTO ref_upb SET Kd_UPB='".$New."', Nm_UPB='".$mRo[1]."'";
			echo $SQ."<br>";
			mysql_query($SQ);
		}
	}
}

$CopyRUA="YAxx";

if ($CopyRUA=="YA" && $UID =="creator")
{
	$SQA = "select 
	bp_kode as A0,
	unit_kode as A1,
	sunit_kode as A2,
	ssunit_kode as A3,
	Kd_UPB as A4,
	Kd_Ruang as A5,
	Nm_Ruang as A6,
	No_Ruang as A7,
	Nm_Pejabat as A8,
	Nip_Pejabat as A9,
	Nm_Jabatan as A10,
	No_Urut as A11 
	FROM ref_ruangan WHERE Kd_UPB LIKE '24.04.07.01.__.___' ORDER BY Kd_UPB";
	$nRs = mysql_query($SQA);
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
		$Old = $mRo[4];
		$New = "24.04.07.06.".substr($mRo[4],-6,6);
		echo $Old."<br>".$New."<br><br>";
		$CeK = fGlobal("IDT","ref_ruangan","Kd_UPB:Kd_Ruang",$New.":".$mRo[5],"=:=","","s");
		if ($CeK=='')
		{
			$SQ = "INSERT INTO ref_ruangan SET 
			bp_kode='".$mRo[0]."',
			unit_kode='".$mRo[1]."',
			sunit_kode='".$mRo[2]."',
			ssunit_kode='".$mRo[3]."',
			Kd_UPB='".$New."',
			Kd_Ruang='".$mRo[5]."',
			Nm_Ruang='".$mRo[6]."',
			No_Ruang='".$mRo[7]."',
			Nm_Pejabat='".$mRo[8]."',
			Nip_Pejabat='".$mRo[9]."',
			Nm_Jabatan='".$mRo[10]."',
			No_Urut='".$mRo[11]."'";
			echo $SQ."<br>";
			mysql_query($SQ);
		}
	}
}

?>