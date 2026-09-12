<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
#echo $UnT."<br>";
#echo $Thn."<br>";
#echo $Ast."<br>";

$KdLink = fGlobalNEW("Kd_Unit_Link","ref_unit","Kd_Unit",$UnT,"=","",DatabaseSB,$ConSB,"");

if ($KdLink!='')
{
	$KdL = explode(".",$KdLink);
	$KdU = (int)$KdL[0];
	$KdB = (int)$KdL[1];
	$KdS = (int)$KdL[2];
	
	if ($Ast=='prog')
	{
		$nSQ="SELECT 
		tahun as A0,
		kd_urusan as A1,
		kd_bidang as A2,
		kd_unit as A3,
		kd_sub as A4,
		kd_prog as A5,
		id_prog as A6,
		ket_program as A7,
		tolak_ukur as A8,
		target_angka as A9,
		target_uraian as A10,
		kd_urusan1 as A11,
		kd_bidang1 as A12 
		FROM ta_blg_program 
		WHERE kd_urusan='".$KdU."' AND kd_bidang='".$KdB."' AND kd_unit='".$KdS."' AND tahun='".$Thn."' ORDER BY IDT";
		#echo $nSQ;
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$mR0 = $mRo[0];
			$mR1 = $mRo[1];
			$mR2 = substr('00'.$mRo[2],-2,2);
			$mR3 = substr('00'.$mRo[3],-2,2);
			$mR4 = substr('00'.$mRo[4],-2,2);
			$mR5 = substr('00'.$mRo[5],-3,3);
			$NmP = $mRo[7];
			
			$KdP = $mR1.".".$mR2.".".$mR3.".".$mR4.".".$mR5;
			#echo $KdP."<br>";
			
			$CeK = fGlobalNEW("IDT","ta_apbd_program_skpd","idProgram",$KdP,"=","",DatabaseSB,$ConSB,"");
			if (!$CeK)
			{
				$SQ = "INSERT INTO ta_apbd_program_skpd SET 
				kdUnit='".$UnT."', idProgram='".$KdP."', idReferensi='', nmProgram='".$NmP."', periode='".$mR0."', apbd='0'";
				$nR = mysql_query($SQ);
				echo "Insert program $NmP <br>";
			}
		}
		echo "Proses done...!!";
	}
	
	#######
	if ($Ast=='kegi')
	{
		$nSQ="SELECT 
		tahun as A0,
		kd_urusan as A1,
		kd_bidang as A2,
		kd_unit as A3,
		kd_sub as A4,
		kd_prog as A5,
		kd_keg as A6,
		
		ket_kegiatan as A7,
		lokasi as A8,
		kelompok_sasaran as A9,
		status_kegiatan as A10,
		pagu_anggaran as A11,
		waktu_pelaksanaan as A12,
		kd_sumber as A13 
		
		FROM ta_blg_kegiatan 
		WHERE kd_urusan='".$KdU."' AND kd_bidang='".$KdB."' AND kd_unit='".$KdS."' AND tahun='".$Thn."' ORDER BY IDT";
		#echo $nSQ;
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$mR0 = $mRo[0];
			$mR1 = $mRo[1];
			$mR2 = substr('00'.$mRo[2],-2,2);
			$mR3 = substr('00'.$mRo[3],-2,2);
			$mR4 = substr('00'.$mRo[4],-2,2);
			$mR5 = substr('00'.$mRo[5],-3,3);
			$mR6 = substr('00'.$mRo[6],-3,3);
			$NmK = $mRo[7];
			
			$KdK = $mR1.".".$mR2.".".$mR3.".".$mR4.".".$mR5.".".$mR6;
			#echo $KdP."<br>";
			
			$CeK = fGlobalNEW("IDT","ta_apbd_kegiatan_skpd","idKegiatan",$KdK,"=","",DatabaseSB,$ConSB,"");
			if (!$CeK)
			{
				$SQ = "INSERT INTO ta_apbd_kegiatan_skpd SET 
				kdUnit='".$UnT."', idKegiatan='".$KdK."', idReferensi='', nmKegiatan='".$NmK."', periode='".$mR0."', apbd='0'";
				$nR = mysql_query($SQ);
				echo "Insert kegiatan $NmK <br>";
			}
		}
		echo "Proses done...!!";
	}
	#######

	#######
	if ($Ast=='bela')
	{
		$nSQ="SELECT 
		tahun as A0,
		kd_urusan as A1,
		kd_bidang as A2,
		kd_unit as A3,
		kd_sub as A4,
		kd_prog as A5,
		kd_keg as A6,
		
		kd_rek_1 as A7,
		kd_rek_2 as A8,
		kd_rek_3 as A9,
		kd_rek_4 as A10,
		kd_rek_5 as A11,
		no_rinc as A12, 
		keterangan as A13 
		
		FROM ta_blg_belanja_rinc  
		WHERE kd_urusan='".$KdU."' AND kd_bidang='".$KdB."' AND kd_unit='".$KdS."' AND tahun='".$Thn."' AND kd_rek_3 LIKE '_' ORDER BY IDT";
		#echo $nSQ;
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$mR0 = $mRo[0];
			$mR1 = $mRo[1];
			$mR2 = substr('00'.$mRo[2],-2,2);
			$mR3 = substr('00'.$mRo[3],-2,2);
			$mR4 = substr('00'.$mRo[4],-2,2);
			$mR5 = substr('000'.$mRo[5],-3,3);
			$mR6 = substr('000'.$mRo[6],-3,3);
			
			$mR7  = substr('0'.$mRo[7],-1,1);
			$mR8  = substr('0'.$mRo[8],-1,1);
			$mR9  = substr('00'.$mRo[9],-2,2);
			$mR10 = substr('000'.$mRo[10],-3,3);
			$mR11 = substr('0000'.$mRo[11],-4,4);
			$mR12 = substr('000'.$mRo[12],-3,3);
			
			$NmR  = $mRo[13];
			
			$KdK = $mR1.".".$mR2.".".$mR3.".".$mR4.".".$mR5.".".$mR6;
			$KdR = $mR7.".".$mR8.".".$mR9.".".$mR10.".".$mR11.".".$mR12;
			
			$CeK = fGlobalNEW("IDT","ta_apbd_rekening_skpd_rinci","idKegiatan:kdRekening",$KdK.":".$KdR,"=:=","",DatabaseSB,$ConSB,"");
			if (!$CeK)
			{
				$JmL = fGlobalNEW("ifnull(sum(total),0)","ta_blg_belanja_rinc_sub","kd_urusan:kd_bidang:kd_unit:kd_sub:kd_prog:kd_keg:kd_rek_1:kd_rek_2:kd_rek_3:kd_rek_4:kd_rek_5:no_rinc",$mRo[1].":".$mRo[2].":".$mRo[3].":".$mRo[4].":".$mRo[5].":".$mRo[6].":".$mRo[7].":".$mRo[8].":".$mRo[9].":".$mRo[10].":".$mRo[11].":".$mRo[12],"=:=:=:=:=:=:=:=:=:=:=:=","",DatabaseSB,$ConSB,"");
				
				$KdR90 = fGlobal("Kd_Rek_90","ref_rek_90_6_mapping_13","Kd_Rek_13",substr($KdR,0,15),"=","","");
				$NmR90 = fGlobal("Nm_Rek","ref_rek_90_6","Kd_Rek",$KdR90,"=","","");
				
				$SQ = "INSERT INTO ta_apbd_rekening_skpd_rinci SET 
				kdUnit='".$UnT."', 
				idKegiatan='".$KdK."', 
				kdRekening='".$KdR."', 
				nmRekening='".$NmR."', 
				kdRekening90='".$KdR90."', 
				nmRekening90='".$NmR90."', 
				periode='".$mR0."', 
				apbd='0', 
				fnJumlah='".$JmL."'";
				$nR = mysql_query($SQ);
				echo "Insert rekening $NmR <br>";
			}
		}
		
		$nSQ = "select idKegiatan, kdRekening90, nmRekening90, sum(fnJumlah) FROM ta_apbd_rekening_skpd_rinci 
		WHERE kdUnit='".$UnT."' AND periode='".$Thn."' AND apbd='0' GROUP BY idKegiatan, kdRekening90";
		#echo $nSQ;
		$nRs = mysql_query($nSQ);
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$CeK = fGlobalNEW("IDT","ta_apbd_rekening_skpd","idKegiatan:kdRekening90:periode:apbd",$mRo[0].":".$mRo[1].":".$Thn.":0","=:=:=:=","",DatabaseSB,$ConSB,"");
			if (!$CeK)
			{
				$SQ = "INSERT INTO ta_apbd_rekening_skpd SET 
				kdUnit='".$UnT."', 
				idKegiatan='".$mRo[0]."', 
				kdRekening90='".$mRo[1]."', 
				nmRekening90='".$mRo[2]."', 
				periode='".$Thn."', 
				apbd='0', 
				fnJumlah='".$mRo[3]."'";
				$nR = mysql_query($SQ);
				echo "Insert rekening90 ".$mRo[2]."<br>";
			
			}
		}
		
		echo "Proses done...!!";
	}
	#######
}
else
{
	$MsG="Kode maping unit link belum terisi..!!";
	echo "<script type='text/javascript'>errorMSG('".$MsG."')</script>";

}
?>