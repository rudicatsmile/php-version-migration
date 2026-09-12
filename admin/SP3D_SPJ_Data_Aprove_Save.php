<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
#echo $eIdT."<br>".$IdTR;

$NmAPR = fGlobal("Full_Name","ta_user","User_ID",$UID,"=","","");
$SQ = "UPDATE ta_sp3d_spj_rinci SET Aprove='".$Pro."', AprovBY='".$UID."', AprovByFullName='".$NmAPR."', AprovRC=now() WHERE IDT='".$IdTR."'";
$nR = mysql_query($SQ);

if ($Pro=='none' || $Pro=='ditolak')
{
	$RefTM = fGlobal("Referensi","ta_sp3d_spj_rinci","IDT",$IdTR,"=","","");
	$KdUPB = fGlobal("Kd_UPB","ta_sp3d_spj_rinci","IDT",$IdTR,"=","","");
	
	if ($RefTM!='' && $KdUPB!='')
	{
		$nSG = "DELETE FROM ta_kib_group WHERE Ref_Temp='".$RefTM."' AND Kd_UPB='".$KdUPB."'";
		$rg = mysql_query($nSG);
	
		$nSG = "DELETE FROM ta_kib_108 WHERE Ref_Temp='".$RefTM."' AND Kd_UPB='".$KdUPB."'";
		$rg = mysql_query($nSG);
		
		$nSG = "DELETE FROM ta_kib_post_108 WHERE Ref_Temp='".$RefTM."' AND Kd_UPB='".$KdUPB."'";
		$rg = mysql_query($nSG);
	}
}

if ($Pro=='aproved')
{
	$RefTM  = fGlobal("Referensi","ta_sp3d_spj_rinci","IDT",$IdTR,"=","","");
	$KdUPB  = fGlobal("Kd_UPB",     "ta_sp3d_spj_rinci","IDT",$IdTR,"=","","");
	
	$CekDT = fGlobal("IDT","ta_kib_108","Ref_Temp:Kd_UPB",$RefTM.":".$KdUPB,"=:=","IDT LIMIT 0,1","");
	if ($CekDT=='')
	{
		$NewNOM = fGlobal("Nom_Kontrak","ta_sp3d_spj","IDT",$eIdT,"=","","");
		
		$JmlST  = fGlobal("JmlSatuan",  "ta_sp3d_spj_rinci","IDT",$IdTR,"=","","");
		$KdeRK  = fGlobal("Kd_Aset_108","ta_sp3d_spj_rinci","IDT",$IdTR,"=","","");
		$TotNL  = fGlobal("Total",      "ta_sp3d_spj_rinci","IDT",$IdTR,"=","","");
		
		$NewGRP = "";
		if ($JmlST > 1)
		{
			$NewGRP = MakeNewGRP();
			$nSG = "INSERT INTO ta_kib_group SET 
			Referensi='".$NewGRP."',
			No_Pengadaan='".$NewNOM."',
			Ref_Temp='".$RefTM."',
			Kd_UPB='".$KdUPB."',
			Kd_Aset_108='".$KdeRK."',
			Jml_Item='".$JmlST."',
			Nilai_Total='".$TotNL."',
			RegFrom='0',
			RegTo='0',
			Pencatat='".$UID."',
			Recorded=now()";
			$rg = mysql_query($nSG);
		}
		
		$NewMSA = fGlobal("Ms_Manfaat","ref_rek_aset108_7","IDT",$KdeRK,"=","","");
		if ($NewMSA==''){$NewMSA=0;}
		$NewTGD = "0000-00-00";
		$NewNOD = "";
		
		for ($i=1; $i<=$JmlST; $i++)
		{
			$nSQ = "SELECT * FROM ta_sp3d_spj_rinci WHERE IDT='".$IdTR."'";
			$nRs = mysql_query($nSQ);
			while ($mRo = mysql_fetch_array($nRs))
			{
				$KdAS = substr($mRo['Kd_Aset_108'],0,5);
				$NewREF = MakeNewRef($KdAS);
				
				$NewREG = MakeNewReg($mRo['Kd_Aset_108'],$mRo['Kd_UPB']);
				
				$nSW = "INSERT INTO ta_kib_108 SET 
				Referensi='".$NewREF."',
				Ref_Group='".$NewGRP."',
				Ref_Temp='".$mRo['Referensi']."',
				Kd_UPB='".$mRo['Kd_UPB']."',
				Kd_Aset_108='".$mRo['Kd_Aset_108']."',
				No_Register='".$NewREG."',
				No_Pengadaan='".$NewNOM."',
				Nm_Aset='".$mRo['Nm_Aset']."',
				Kd_Pemilik='".$mRo['Kd_Pemilik']."',
				Tgl_Perolehan='".$mRo['Tgl_Perolehan']."',
				Tahun='".$mRo['Tahun']."',
				Luas_M2='".$mRo['Luas_M2']."',
				Alamat='".$mRo['Alamat']."',
				Hak_Tanah='".$mRo['Hak_Tanah']."',
				Penggunaan='".$mRo['Penggunaan']."',
				Asal_Usul='".$mRo['Asal_Usul']."',
				Harga='".$mRo['Harga']."',
				Merk='".$mRo['Merk']."',
				Type='".$mRo['Type']."',
				Ukuran_CC='".$mRo['Ukuran_CC']."',
				Bahan='".$mRo['Bahan']."',
				Nomor_Pabrik='".$mRo['Nomor_Pabrik']."',
				Nomor_Rangka='".$mRo['Nomor_Rangka']."',
				Nomor_Mesin='".$mRo['Nomor_Mesin']."',
				Nomor_Polisi='".$mRo['Nomor_Polisi']."',
				Nomor_BPKB='".$mRo['Nomor_BPKB']."',
				Kondisi='".$mRo['Kondisi']."',
				Masa_Manfaat='".$NewMSA."',
				Nilai_Akhir='".$mRo['Harga']."',
				Bertingkat='".$mRo['Bertingkat']."',
				Beton='".$mRo['Beton']."',
				Luas_Lantai='".$mRo['Luas_Lantai']."',
				Lokasi='".$mRo['Lokasi']."',
				Dokumen_Tanggal='".$NewTGD."',
				Dokumen_Nomor='".$NewNOD."',
				Status_Tanah='".$mRo['Status_Tanah']."',
				Luas_Tanah='".$mRo['Luas_Tanah']."',
				Konstruksi='".$mRo['Konstruksi']."',
				Panjang='".$mRo['Panjang']."',
				Lebar='".$mRo['Lebar']."',
				Luas='".$mRo['Luas']."',
				Judul='".$mRo['Judul']."',
				Spesifikasi='".$mRo['Spesifikasi']."',
				Pencipta='".$mRo['Pencipta']."',
				Daerah_Asal='".$mRo['Daerah_Asal']."',
				Jenis='".$mRo['Jenis']."',
				Tipe_Bangunan='".$mRo['Tipe_Bangunan']."',
				Ukuran='".$mRo['Ukuran']."',
				Keterangan='".$mRo['Keterangan']."',
				Post='Y',
				Pencatat='".$UID."',
				Recorded=now()";
				$rs = mysql_query($nSW);
				
				if ($rs)
				{
					
					$nSP = "INSERT INTO ta_kib_post_108 SET 
					Referensi='".$NewREF."',
					Ref_Group='".$NewGRP."',
					Ref_Temp='".$mRo['Referensi']."',
					Kd_UPB='".$mRo['Kd_UPB']."',
					Kd_Aset_108='".$mRo['Kd_Aset_108']."',
					No_Register='".$NewREG."',
					Crit='SLD',
					Tanggal='".$mRo['Tgl_Perolehan']."',
					Uraian='Saldo awal (nilai perolehan)',
					DK='D',
					Debet='".$mRo['Harga']."',
					Kredit='0',
					Keterangan='".$mRo['Keterangan']."',
					Pencatat='".$UID."',
					Recorded=now()";
					$re = mysql_query($nSP);
				}
			}
		}
	}
}

function MakeNewRef($KdAS)
{
	if ($KdAS=='1.3.1'){
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","Referensi","TNH%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","Referensi","TNH%","LIKE","","");
		$NewC = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_merger_his","Referensi","TNH%","LIKE","","");
		
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		$NewC = (int)substr($NewC,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		if ($NewC > $NewK){$NewK = $NewC;}
		$NewK = $NewK + 1;
		$NewRefKIB = "TNH.".fMakeReferensi($NewK,11);
	}
	if ($KdAS=='1.3.2'){
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","Referensi","ALT%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","Referensi","ALT%","LIKE","","");
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		$NewK = $NewK + 1;
		
		$NewRefKIB = "ALT.".fMakeReferensi($NewK,11);
	}
	
	if ($KdAS=='1.3.3'){
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","Referensi","BNG%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","Referensi","BNG%","LIKE","","");
		$NewC = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_merger_his","Referensi","BNG%","LIKE","","");
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		$NewC = (int)substr($NewC,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		if ($NewC > $NewK){$NewK = $NewC;}
		$NewK = $NewK + 1;
		$NewRefKIB = "BNG.".fMakeReferensi($NewK,11);
	}
	
	if ($KdAS=='1.3.4'){
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","Referensi","JLN%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","Referensi","JLN%","LIKE","","");
		$NewC = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_merger_his","Referensi","JLN%","LIKE","","");
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		$NewC = (int)substr($NewC,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		if ($NewC > $NewK){$NewK = $NewC;}
		$NewK = $NewK + 1;
		$NewRefKIB = "JLN.".fMakeReferensi($NewK,11);
	}
	
	if ($KdAS=='1.3.5'){
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","referensi","ATL%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","referensi","ATL%","LIKE","","");
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		$NewK = $NewK + 1;
		$NewRefKIB = "ATL.".fMakeReferensi($NewK,11);
	}
	
	if ($KdAS=='1.3.6'){
		$NewK = fGlobal("IfNull(max(Referensi),0)","ta_kib_108","referensi","KDP%","LIKE","","");
		$NewB = fGlobal("IfNull(max(Referensi),0)","ta_kib_108_mutasi","referensi","KDP%","LIKE","","");
		$NewK = (int)substr($NewK,-11,11);
		$NewB = (int)substr($NewB,-11,11);
		if ($NewB > $NewK){$NewK = $NewB;}
		$NewK = $NewK + 1;
		$NewRefKIB = "KDP.".fMakeReferensi($NewK,11);
	}
	return $NewRefKIB;
}

function MakeNewReg($gRin,$gUpb)
{
	$nSQL = "SELECT IfNull(max(No_Register),0) AS LasReG FROM ta_kib_108 WHERE Kd_Aset_108='".$gRin."' AND Kd_Upb='".$gUpb."'";
	$nRst = mysql_query($nSQL) or die(mysql_error());
	$nRow = mysql_fetch_assoc($nRst);
	$NewG = $nRow['LasReG'];
	$LastReG = ((int)$NewG) + 1;
	return fMakeRegister($LastReG,7);
}

function MakeNewGRP()
{
	$nSQL = "SELECT IFNULL(MAX(Referensi),0) AS LasRef FROM ta_kib_group";
	$nRst = mysql_query($nSQL) or die(mysql_error());
	$nRow = mysql_fetch_assoc($nRst);
	$NewK = $nRow['LasRef'];
	$NewK = substr($NewK, 5,11);
	$NewK = ((int)$NewK) + 1;
	return "GRP.".fMakeReferensi($NewK,11);
}
?>

<script type="text/javascript">
	alert('Proses berhasil...!!');
	showAPROVE('refr','<?=$eIdT?>','<?=$IdTR?>','','<?=$IdL?>');
</script>