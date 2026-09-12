<?
require('Connection.php');
require('Connection_Simkada.php');
require('FileFunction.php');
require('file_insertupdate.php');

extract($_POST);
extract($_GET);

$fNIL = fConvertToNumeric($fFak3);

$gPCT = fGlobalNEW("User_ID","ta_user_log","IDT",$IdL,"=","",DatabaseSB,$ConSB,"");
$gTGL = $fThn."-".substr("00".$fBln,-2,2)."-".substr("00".$fHri,-2,2);

if ($Simpan=="Save")
{
	if ($fUR=="") {$fUR = fGlobalNEW("Uraian","ta_penerimaan_berkas","Nomor",$gNOM,"=","",DatabaseSB,$ConSB,"");}
	$fFak3 = fGlobalNEW("Nilai","ta_penerimaan_berkas","Nomor",$gNOM,"=","",DatabaseSB,$ConSB,"");
	$fPro3 = fGlobalNEW("Pros","ta_penerimaan_berkas","Nomor",$gNOM,"=","",DatabaseSB,$ConSB,"");
	
	//Penggunaan Nilai Penerimaan Berkas di Pengadaan
	$gVaL = fGlobalNEW("IfNull(sum(Nilai),0)","ta_pengadaan","No_Berkas",$gNOM,"=","",DatabaseSB,$ConSB,"");
	
	//Automatic Mencari Data 30%, 70%
	if ($fPro3=="70")
	{
		$gR30 = fGlobalNEW("NomPros30","ta_penerimaan_berkas","Nomor",$gNOM,"=","",DatabaseSB,$ConSB,"");
		$gAST = fGlobalNEW("Aset","ta_pengadaan","No_Berkas",$gR30,"=","",$DatabaseSB,$ConSB,"");
		if ($gAST) {$fAST = $gAST;}
		$rRin = fGlobalNEW("Kd_Aset_108","ta_pengadaan","No_Berkas",$gR30,"=","",$DatabaseSB,$ConSB,"");
		if ($rRin) {$fRin = $rRin;}
	}
	else if ($fPro3=="100")
	{
		$gR70  = fGlobalNEW("NomPros70","ta_penerimaan_berkas","Nomor",$gNOM,"=","",DatabaseSB,$ConSB,"");
		$gR30  = fGlobalNEW("NomPros30","ta_penerimaan_berkas","Nomor",$gR70,"=","",DatabaseSB,$ConSB,"");
		$gAST = fGlobalNEW("Aset","ta_pengadaan","No_Berkas",$gR30,"=","",$DatabaseSB,$ConSB,"");
		if ($gAST) {$fAST = $gAST;}
		$rRin = fGlobalNEW("Kd_Aset_108","ta_pengadaan","No_Berkas",$gR30,"=","",$DatabaseSB,$ConSB,"");
		if ($rRin) {$fRin = $rRin;}
	}
	
	if ($gIdT)
	{
		$rAST = fGlobalNEW("Aset","ta_pengadaan","IDT",$gIdT,"=","",$DatabaseSB,$ConSB,"");
		
		if ($fNIL<=0)
		{
			$fNIL = 0;
		}
		else
		{
			$gOlD = fGlobalNEW("Nilai","ta_pengadaan","IDT",$gIdT,"=","",DatabaseSB,$ConSB,"");
			$gSIS = $fFak3 - ($gVaL-$gOlD);
			if ($fNIL <= $gSIS) {$fNIL=$fNIL;}
			else {$fNIL=$gSIS;}
		}
		
		$gRin = fGlobalNEW("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$fRin,"LIKE","",DatabaseSB,$ConSB,"");
		$eRin = fGlobalNEW("Kd_Aset_108","ta_pengadaan","IDT",$gIdT,"=","",DatabaseSB,$ConSB,""); 	//Kode aset sebelum diupdate
		$eAst = fGlobalNEW("Aset","ta_pengadaan","IDT",$gIdT,"=","",DatabaseSB,$ConSB,"");		//Aset baru / lama sebelum diupdate
		
		CallConnection(DatabaseSB,$ConSB);
		$SQL = "UPDATE ta_pengadaan SET 
		Tanggal='$gTGL', 
		Faktur_Nomor='$fFak1', 
		Faktur_Tanggal='$fFak2', 
		Kd_Aset_108='$fRin', 
		Nm_Aset_108='$gRin', 
		Nilai='$fNIL', 
		Pros='$fPro3', 
		Uraian='$fUR', 
		Aset='$fAST' 
		WHERE IDT='$gIdT'";
		$rst = mysql_query($SQL) or die(mysql_error());
		
		//JIKA ASET KE KDP / Beda rekening aset
		if ($eRin!=$fRin)
		{
			if ($eAst=="Baru") 
			{
				if ($gNOM!="")
				{
					$SQL = "DELETE FROM ta_kib_global_temp WHERE No_Pengadaan='".$gNOM."'";
					$rst = mysql_query($SQL) or die(mysql_error());
					
					$SQL = "DELETE FROM ta_kib_post_108 WHERE No_Pengadaan='".$gNOM."'";
					$rst = mysql_query($SQL) or die(mysql_error());
				}
			} 
			else 
			{
				$gTmD= strtolower(fNmHuruf((int)substr($eRin,0,2)));
				if ($gTmD){
					if ($gNOM!="")
					{
						$SQL = "DELETE FROM ta_kib_108_temp WHERE No_Pengadaan='".$gNOM."'";
						$rst = mysql_query($SQL) or die(mysql_error());
						
						$SQL = "DELETE FROM ta_kib_108 WHERE No_Pengadaan='".$gNOM."'";
						$rst = mysql_query($SQL) or die(mysql_error());
						
						$SQL = "DELETE FROM ta_kib_group WHERE No_Pengadaan='".$gNOM."'";
						$rst = mysql_query($SQL) or die(mysql_error());
						
						$SQL = "DELETE FROM ta_kib_post_108 WHERE No_Pengadaan='".$gNOM."'";
						$rst = mysql_query($SQL) or die(mysql_error());
					}
				}
			}
		}
		
		//JIKA ASET BARU ATAU PENBAMAHAN
		if ($fAST!=$rAST)
		{
			if ($fAST=="Baru")
			{
				if ($gNOM!="")
				{
					$SQL = "DELETE FROM ta_kib_global_temp WHERE No_Pengadaan='".$gNOM."'";
					$rst = mysql_query($SQL) or die(mysql_error());
					$SQL = "DELETE FROM ta_kib_post_108 WHERE No_Pengadaan='".$gNOM."'";
					$rst = mysql_query($SQL) or die(mysql_error());
				}
			}
			else
			{
				$gTmp= strtolower(fNmHuruf((int)substr($fRin,0,2)));
				if ($gTmp){
					if ($gNOM!="")
					{
						$SQL = "DELETE FROM ta_kib_108_temp WHERE No_Pengadaan='".$gNOM."'";
						$rst = mysql_query($SQL) or die(mysql_error());
						
						$SQL = "DELETE FROM ta_kib_108 WHERE No_Pengadaan='".$gNOM."'";
						$rst = mysql_query($SQL) or die(mysql_error());
						
						$SQL = "DELETE FROM ta_kib_group WHERE No_Pengadaan='".$gNOM."'";
						$rst = mysql_query($SQL) or die(mysql_error());
					
						$SQL = "DELETE FROM ta_kib_post_108 WHERE No_Pengadaan='".$gNOM."'";
						$rst = mysql_query($SQL) or die(mysql_error());
					}
				}
			}
		}
		$URL="Pengadaan_Mid.php?gIdT=".$gIdT."&IdL=".$_GET['IdL'];
	}
	else
	{
		$gUnt = $gUnt;
		$gThn = date('Y');
		
		$MaxNom = fGlobalNEW("IfNull(max(Nomor),0)","ta_pengadaan","Nomor",$gUnt.".".$gThn."%","LIKE","",DatabaseSB,$ConSB,"");
		if ($MaxNom)
		{
			$MaxNom = substr($MaxNom,-6,6);
			$MaxNom = (int)$MaxNom+1;
		}
		else
		{
			$MaxNom = 1;
		}
		$NewNom = $gUnt.".".$gThn.".".substr("000000".$MaxNom,-6,6);
		
		$gRin = fGlobalNEW("Nm_Aset","ref_rek_aset108_7","Kd_Aset",$fRin,"LIKE","",DatabaseSB,$ConSB,"");
		$nDTA = fGlobalNEW("Periode:Kd_Program:Nm_Program:Kd_Kegiatan:Nm_Kegiatan:Kd_SubKegiatan:Nm_SubKegiatan:Kd_Rek13:Nm_Rek13:SmbDana:Kd_Peruntukan:Nm_Peruntukan","ta_penerimaan_berkas","Nomor",$gNOM,"LIKE","",DatabaseSB,$ConSB,"");
		$nDTA = explode(':',$nDTA);
		$nTHN = $nDTA[0];
		$KdP  = $nDTA[1];
		$NmP  = $nDTA[2];
		$KdK  = $nDTA[3];
		$NmK  = $nDTA[4];
		$KdS  = $nDTA[5];
		$NmS  = $nDTA[6];
		$KdR  = $nDTA[7];
		$NmR  = $nDTA[8];
		$SmB  = $nDTA[9];
		$KdPr = $nDTA[10];
		$NmPr = $nDTA[11];
		
		$gSIS = $fFak3 - $gVaL;
		if ($fNIL <= $gSIS) {$fNIL = $fNIL ;}
		else {$fNIL = $gSIS;}
		
		CallConnection(DatabaseSB,$ConSB);
		$SQL = "INSERT INTO ta_pengadaan SET 
		Tanggal='$gTGL', 
		Nomor='$NewNom', 
		Kd_Unit='$gUnt', 
		No_Berkas='$gNOM', 
		Kd_Aset_108='$fRin', 
		Nm_Aset_108='$gRin', 
		Faktur_Nomor='$fFak1', 
		Faktur_Tanggal='$fFak2', 
		
		Kd_Program='".$KdP."',
		Nm_Program='".$NmP."',
		Kd_Kegiatan='".$KdK."',
		Nm_Kegiatan='".$NmK."',
		Kd_SubKegiatan='".$KdS."',
		Nm_SubKegiatan='".$NmS."',
		Kd_Rek13='".$KdR."',
		Nm_Rek13='".$NmR."',
		SmbDana='".$SmB."',
		Kd_Peruntukan='".$KdPr."',
		Nm_Peruntukan='".$NmPr."',
		
		Nilai='$fNIL', 
		Pros='$fPro3', 
		Uraian='$fUR', 
		Aset='$fAST', 
		Periode='$nTHN', 
		Recorded=now(), 
		Pencatat='$gPCT'";
		$rst = mysql_query($SQL) or die(mysql_error());
		
		$SQL = "UPDATE ta_penerimaan_berkas SET Proses='Y' WHERE Nomor='$gNOM'";
		$rst = mysql_query($SQL) or die(mysql_error());
		
		$gIdT = fGlobalNEW("Max(IDT)","ta_pengadaan","Nomor",$gUnt."%","LIKE","",DatabaseSB,$ConSB,"");
		$URL="Pengadaan_Mid.php?gIdT=".$gIdT."&gNOM=".$gNOM."&gUnt=".$gUnt."&IdL=".$_GET['IdL'];
	}
	
	if ($fPro3=="100")
	{
		#PostingSIMKADA64($gIdT,DatabaseSA,$ConSA,DatabaseSB,$ConSB,"");
	}
}
else if ($Simpan=="Delete")
{
	$gCRT = $CritIDT;
	$gTmp = strtolower(fNmHuruf((int)substr($fRin,0,2)));
	
	$yNoM = fGlobalNEW("No_Pengadaan","ta_kib_108_temp","IDT",$gCRT,"=","",DatabaseSB,$ConSB,"");
	$yReF = fGlobalNEW("Referensi","ta_kib_108_temp","IDT",$gCRT,"=","",DatabaseSB,$ConSB,"");
	if ($gTmp)
	{
		if ($yReF!="" && $yNoM!="")
		{
			$SQL = "DELETE FROM ta_kib_108 WHERE No_Pengadaan='$yNoM' AND Ref_Temp='$yReF'";
			$rst = mysql_query($SQL) or die(mysql_error());
			
			$SQL = "DELETE FROM ta_kib_group WHERE No_Pengadaan='$yNoM' AND Ref_Temp='$yReF'";
			$rst = mysql_query($SQL) or die(mysql_error());
			
			$SQL = "DELETE FROM ta_kib_post_108 WHERE No_Pengadaan='$yNoM' AND Ref_Temp='$yReF'";
			$rst = mysql_query($SQL) or die(mysql_error());
		}
		
		$SQL = "DELETE FROM ta_kib_108_temp WHERE IDT='$gCRT' ";
		$rst = mysql_query($SQL) or die(mysql_error());
	}
	$URL="Pengadaan_Mid.php?gIdT=".$gIdT."&gNOM=".$gNOM."&gUnt=".$gUnt."&IdL=".$_GET['IdL'];
}
else if ($Simpan=="Reset")
{
	$URL="Pengadaan_Mid.php?gUnt=".$gUnt."&IdL=".$_GET['IdL'];
}
else if ($Simpan=="Refresh")
{
	$URL="Pengadaan_Mid.php?gRin=".$fRin."&gNOM=".$gNOM."&gUnt=".$gUnt."&gIdT=".$gIdT."&IdL=".$_GET['IdL'];
}
else
{
	$URL="Pengadaan_Mid.php?gIdT=".$gIdT."&gNOM=".$gNOM."&gUnt=".$gUnt."&gBiA=".$fBiA."&gBid=".$fBid."&gKel=".$fKel."&gOBJ=".$fOBJ."&IdL=".$_GET['IdL'];
}

header("Location: ".$URL);

function PostingSIMKADA64($gIdT,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB,$fSH)
{
	
	$gNoP = fGlobalNEW("Nomor","ta_pengadaan","IDT",$gIdT,"=","",$DatabaseSB,$ConSB,"");
	$gKdA = fGlobalNEW("Kd_Aset","ta_pengadaan","IDT",$gIdT,"=","",$DatabaseSB,$ConSB,"");
	$gN100= fGlobalNEW("Nilai","ta_pengadaan","IDT",$gIdT,"=","",$DatabaseSB,$ConSB,"");
	
	$gBRK = fGlobalNEW("No_Berkas","ta_pengadaan","IDT",$gIdT,"=","",$DatabaseSB,$ConSB,"");
	
	$gSKP = fGlobalNEW("Id_Satker","ta_penerimaan_berkas","Nomor",$gBRK,"=","",$DatabaseSB,$ConSB,"");
	$gTGL = fGlobalNEW("Tg_Berita_Acara","ta_penerimaan_berkas","Nomor",$gBRK,"=","",$DatabaseSB,$ConSB,"");
	$gPRD = fGlobalNEW("Periode","ta_penerimaan_berkas","Nomor",$gBRK,"=","",$DatabaseSB,$ConSB,"");
	$gR13 = fGlobalNEW("Kd_Rek13","ta_penerimaan_berkas","Nomor",$gBRK,"=","",$DatabaseSB,$ConSB,"");
	
	//Cari Nilai 70
	$gP70 = fGlobalNEW("NomPros70","ta_penerimaan_berkas","Nomor",$gBRK,"=","",$DatabaseSB,$ConSB,"");
	$gN70 = 0;
	if ($gP70)
	{
		$gN70 = fGlobalNEW("Nilai","ta_pengadaan","No_Berkas:Kd_Aset",$gP70.":".$gKdA,"=:=","",$DatabaseSB,$ConSB,"");
	}
	
	//Cari Nilai 30
	$gN30 = 0;
	$gP30 = fGlobalNEW("NomPros30","ta_penerimaan_berkas","Nomor",$gP70,"=","",$DatabaseSB,$ConSB,"");
	if ($gP30)
	{
		$gN30 = fGlobalNEW("Nilai","ta_pengadaan","No_Berkas:Kd_Aset",$gP30.":".$gKdA,"=:=","",$DatabaseSB,$ConSB,"");
	}
	
	//Mapping Kode 64
	$gKdA64 = fGlobalNEW("Kd_Aset64","ref_rek_aset5_maping","Kd_Aset17",$gKdA,"=","",$DatabaseSB,$ConSB,"");
	if ($gKdA64)
	{
		$gLink64 = fGlobalNEW("Kd_Rek_64","ref_rek_5_link","Kd_Rek_13",$gR13,"=","IDT DESC LIMIT 0,1",$DatabaseSA,$ConSA,"");
		if ($gLink64)
		{
			if ($gP70) {
				$gPros="101";
				$vAST = $gN100 + $gN70 + $gN30;	//100%
				$vUAM = $gN70 + $gN30;			//70%
				$vUTA = $gN100;					//30%
			}
			else 
			{
				$gPros="100";
				$vAST = $gN100 + $gN70 + $gN30;	//100%
				$vUAM = 0;
				$vUTA = $gN100 + $gN70 + $gN30;	//100%
			}
			
			//LOAD STRUKTUR JURNAL 64
			CallConnection(DatabaseSA,$ConSA);
			$nSQ = "SELECT Kd_Atribut, DK FROM ref_posting_64_data 
			WHERE Kd_Rekening='$gLink64' AND Crit='UTANG' AND Prosentase='$gPros' 
			AND Jurnal='SKPD' AND Byr_Utang='Tidak' ORDER BY IDT";
			$nRs = mysql_query($nSQ) or die(mysql_error());
			while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
			{
				$gAT = $mRo[0];
				$gDK = $mRo[1];
			
				if (substr($gAT,0,3)=="1.3") {$gAT = $gKdA64;}	//Alihkan Kode Ke Hasil Mapping P17-P64 Simbada
				else {$gAT=$gAT;}
				
				//SET JUMLAH
				if (substr($gAT,0,3)=="1.3")   {$vJML=$vAST;}
				if (substr($gAT,0,5)=="1.1.4") {$vJML=$vUAM;}
				if (substr($gAT,0,5)=="2.1.5") {$vJML=$vUTA;}
				
				//POST ASET
				$gIDTa = fGlobalNEW("IDJU","jurnal_umum_64","Referensi:Kd_Rekening:DK",$gNoP.":".$gAT.":".$gDK,"=:=:=","",$DatabaseSA,$ConSA,"");
				if ($gIDTa)
				{
					$gTBL = "jurnal_umum_64";
					$gDTA = "";
					$gDTA = "Tanggal='".$gTGL."'";
					$gDTA.= ",Jumlah='".$vJML."'";
					$gIdX = "IDJU";
					$gSyR = $gIDTa;
					$gOpR = "=";
					UpdateGLOBAL($gTBL,$gDTA,$gIdX,$gSyR,$gOpR,$DatabaseSA,$ConSA);
				}
				else
				{
					$gTBL = "jurnal_umum_64";
					
					$gFLD = "";
					$gVAL = "";
					$gFLD.= "Referensi";
					$gVAL.= "'".$gNoP."'";
					$gFLD.= ", Id_Satker";
					$gVAL.= ", '".$gSKP."'";
					$gFLD.= ", Tanggal";
					$gVAL.= ", '".$gTGL."'";
					$gFLD.= ", Tanggal_Buat";
					$gVAL.= ", '".$gTGL."'";
					$gFLD.= ", Tanggal_RK";
					$gVAL.= ", '".$gTGL."'";
					$gFLD.= ", Kd_Rekening";
					$gVAL.= ", '".$gAT."'";
					$gFLD.= ", Jumlah";
					$gVAL.= ", '".$vJML."'";
					$gFLD.= ", DK";
					$gVAL.= ", '".$gDK."'";
					$gFLD.= ", Periode";
					$gVAL.= ", '".$gPRD."'";
					$gFLD.= ", Recorded";
					$gVAL.= ", now()";
					$gFLD.= ", Pencatat";
					$gVAL.= ", 'PostSimbada'";
					InsertGLOBAL($gTBL,$gFLD,$gVAL,$DatabaseSA,$ConSA);
				}
			}
		}
	}
}

?>

