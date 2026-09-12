<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

$gDT = fGlobal("ref_aset:ref_usulan:kd_aset:kd_upb:to_upb","ta_usulan_verifikasi_rinci","IDT",$tID,"=","","");
if ($gDT){
	$gDT = explode(":",$gDT);
	$RfA = $gDT[0];
	$RfU = $gDT[1];
	$KdA = $gDT[2];
	$UpB = $gDT[3];
	$UpT = $gDT[4];
	$Tb = fNmHuruf((int)substr($KdA,0,2));
	
	if ($MdL=='RepairKib-RB' || $MdL=='RepairKib-HB' || $MdL=='RepairKib-PH' || $MdL=='RepairKib-LE' || $MdL=='RepairKib-PL' || $MdL=='RepairKib-KR' || $MdL=='RepairKib-HL' || $MdL=='RepairKib-AR')
	{
		$CekK = fGlobal("IDT","ta_kib_".$Tb."_mutasi","Referensi:Ref_Usulan",$RfA.":".$RfU,"=:=","","");
		$CekP = fGlobal("IDT","ta_kib_post_mutasi","Referensi:Ref_Usulan",$RfA.":".$RfU,"=:=","","");
		if ($CekK!=="" && $CekP!="")
		{
			insertKibAbcdeKeG($Tb,$RfA,$RfU,"");
		}
		else
		{
			if (!$CekK){echo "data mutasi kib $Tb tidak ditemukan..!!";}
			if (!$CekK){echo "data mutasi kib post tidak ditemukan..!!";}
			return false;
		}
	}
}

function insertKibAbcdeKeG($Tb,$RfA,$RfU,$LoD)
{
	$SQ="SELECT * FROM ta_kib_".$Tb."_mutasi WHERE Referensi='$RfA' AND Ref_Usulan='$RfU' ORDER BY Referensi";
	$Rs = mysql_query($SQ);
	while ($mRo = mysql_fetch_array($Rs, MYSQL_BOTH))
	{
		$gUpb = $mRo['Kd_UPB'];
		$NewRefKIB = mNewRefKIB_G();
		$NewReGAset= mNewRegAset_G($gRin,$gUpb);
		
		$gRin = "";
		$gNmB = "";
		$rDT = fGlobal("Kd_Aset:Nm_Aset","ref_rek_aset5","Kd_Aset:Link_Kib_AE","07.28.%:".$mRo['Kd_Aset'],"LIKE:=","","");
		if ($rDT){
			$rDT = explode(":",$rDT);
			$gRin = $rDT[0];
			$gNmB = $rDT[1];
		}
		
		if ($gRin==""){
			$gRin = "07.28.".substr($mRo['Kd_Aset'],-9,9);
			$gNmB = fGlobal("Nm_Aset","ref_rek_aset5","Kd_Aset",$mRo['Kd_Aset'],"=","","s");
			$SwE = "INSERT INTO ref_rek_aset5 SET Kd_Aset='$gRin', Nm_Aset='$gNmB', Link_Kib_AE='".$mRo['Kd_Aset']."'";
			$RsE = mysql_query($SwE);
		}
		if ($Tb=="a"){
			
		}
		else if ($Tb=="b"){
			$SQG = "INSERT INTO ta_kib_g SET 
			Referensi='$NewRefKIB',
			Ref_Group='',
			Ref_Usulan='$RfU',
			Ref_History='$RfA',
			Ref_Mutasi='$RfA',
			Kd_UPB='$gUpb',
			Kd_Aset='$gRin',
			Nm_Aset='$gNmB',
			No_Register='$NewReGAset',
			
			Merk='".mysql_real_escape_string($mRo['Merk'])."',
			Type='".mysql_real_escape_string($mRo['Type'])."',
			Ukuran_CC='".mysql_real_escape_string($mRo['Ukuran_CC'])."',
			Bahan='".$mRo['Bahan']."',
			Nomor_Pabrik='".$mRo['Nomor_Pabrik']."',
			Nomor_Rangka='".$mRo['Nomor_Rangka']."',
			Nomor_Mesin='".$mRo['Nomor_Mesin']."',
			Nomor_Polisi='".$mRo['Nomor_Polisi']."',
			Nomor_BPKB='".$mRo['Nomor_BPKB']."',
			Keterangan='".$mRo['Keterangan']."',
			
			Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
			Tgl_Mutasi='".$mRo['Tgl_Mutasi']."',
			Kd_Pemilik='".$mRo['Kd_Pemilik']."',
			Kondisi='".$mRo['Kondisi']."',
			Asal_Usul='".$mRo['Asal_Usul']."',
			Masa_Manfaat='".$mRo['Masa_Manfaat']."',
			Harga='".$mRo['Harga']."',
			Nilai_Akhir='".$mRo['Harga']."',
			Post='Y',
			Recorded=now(),
			Pencatat='".$UID.":exe'";
			$RsG = mysql_query($SQG);
		}
		
		if ($RsG){
			$succs="NO";
			$SG = "SELECT * FROM ta_kib_post_mutasi WHERE Referensi='$RfA' AND Kd_UPB LIKE '$frUPB%' ORDER BY IndexData";
			$rG = mysql_query($SG);
			while ($mRG = mysql_fetch_array($rG, MYSQL_BOTH))
			{
				$SW="INSERT INTO ta_kib_post SET 
				Referensi='$NewRefKIB',
				Ref_Group='$NewRefGrp',
				Ref_Usulan='$RfU',
				Ref_Mutasi='$RfA',
				Ref_History='$RfA',
				Kd_UPB='$gUpb',
				Kd_Aset='$gRin',
				No_Register='$NewReGAset',
				
				Crit='".$mRG['Crit']."',
				Tanggal='".$mRG['Tanggal']."',
				Tgl_Mutasi='".$mRG['Tgl_Mutasi']."',
				Uraian='".mysql_real_escape_string($mRG['Uraian'])."',
				DK='".$mRG['DK']."',
				Debet='".$mRG['Debet']."',
				Kredit='".$mRG['Kredit']."',
				No_Pengadaan='".$mRG['No_Pengadaan']."',
				Ref_Temp='".$mRG['Ref_Temp']."',
				Keterangan='".mysql_real_escape_string($mRG['Keterangan'])."',
				Recorded=now(),
				Pencatat='".$UID.":rpair',
				Tmbh_Ms_Manfaat='".$mRG['Tmbh_Ms_Manfaat']."',
				HasilMerger='".$mRG['HasilMerger']."',
				Mrg_Ref_History='".$mRG['Mrg_Ref_History']."',
				Mrg_Crit_History='".$mRG['Mrg_Crit_History']."',
				Mrg_Tmbh_Ms_Manfaat_History='".$mRG['Mrg_Tmbh_Ms_Manfaat_History']."',
				IndexData='0'";
				$rW = mysql_query($SW);
				if ($rW){
					$succs="YA";
				}
				else{
					$succs="NO";
				}
			}
			
			if ($succs!="YA"){
				echo "repair data kib post $Tb ke kib-g post tidak berhasil..!!";
				return false;
			}
		}
		else{
			echo "repair data kib $Tb ke kib-g tidak berhasil..!!";
			return false;
		}
	}
}
function mNewRefKIB_G()
{
	$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_g","IDT","%","LIKE","","");
	$NewK = substr($NewK, 5,11);
	$NewK = ((int)$NewK) + 1;
	$NewK = "KDL.".fMakeReferensi($NewK,11);
	return $NewK;
}
function mNewRegAset_G($gRin,$gUpb)
{
	$LastReG = fGlobal("IfNull(max(No_Register),0)","ta_kib_g","Kd_Aset:Kd_Upb",$gRin.":".$gUpb,"=:=","","");
	$LastReG = ((int)$LastReG) + 1;
	$LastReG = fMakeRegister($LastReG,7);
	return $LastReG;
}

?>
<script languange="javascript">
	showEXEC_RefR('','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>');
</script>