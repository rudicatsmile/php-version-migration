<?php
require "zImport_Connection.php";
require "zImport_FunctionFile.php";

CallConnection(DatabaseSB,$ConSB);
$nSQ = "TRUNCATE TABLE ta_kib_a";
$nRs = mysql_query($nSQ) or die(mysql_error());

CallConnection(DatabaseSA,$ConSA);
$iG=1;
$nSQ = "SELECT * FROM ta_kib_a ORDER BY Kd_Prov, Kd_Kab_Kota, Kd_Bidang, Kd_Unit, Kd_Sub, Kd_UPB, Kd_Aset1, Kd_Aset2, Kd_Aset3, Kd_Aset4, Kd_Aset5, No_Register";
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_assoc($nRs))
{
	$gVAL = "";
	$gFLD = "";
	
	$gTBL = 'ta_kib_a';
	
	$gFLD .= "Referensi";
	$gVAL .= "'TNH.".fMakeReg($iG,11)."'";
	$gFLD .= ",Ref_Group";
	$gVAL .= ",''";
	
	$gFLD .= ",Kd_UPB";
	$gVAL .= ",'".fMakeReg($mRo['Kd_Prov'],2);
	$gVAL .= ".".fMakeReg($mRo['Kd_Kab_Kota'],2);
	$gVAL .= ".".fMakeReg($mRo['Kd_Bidang'],2);
	$gVAL .= ".".fMakeReg($mRo['Kd_Unit'],2);
	$gVAL .= ".".fMakeReg($mRo['Kd_Sub'],2);
	$gVAL .= ".".fMakeReg($mRo['Kd_UPB'],3)."'";
	
	$gFLD .= ",Kd_Aset";
	$gVAL .= ",'".fMakeReg($mRo['Kd_Aset1'],2);
	$gVAL .= ".".fMakeReg($mRo['Kd_Aset2'],2);
	$gVAL .= ".".fMakeReg($mRo['Kd_Aset3'],2);
	$gVAL .= ".".fMakeReg($mRo['Kd_Aset4'],2);
	$gVAL .= ".".fMakeReg($mRo['Kd_Aset5'],3)."'";
	
	$gFLD .= ",No_Register";
	$gVAL .= ",'".fMakeReg($mRo['No_Register'],7)."'";

	$gFLD .= ",Kd_Pemilik";
	$gVAL .= ",'".$mRo['Kd_Pemilik']."'";
	
	$gFLD .= ",Tgl_Perolehan";
	$gVAL .= ",'".$mRo['Tgl_Perolehan']."'";
	
	$gFLD .= ",Luas_M2";
	$gVAL .= ",'".$mRo['Luas_M2']."'";
	
	$gFLD .= ",Alamat";
	$gVAL .= ",'".mysql_real_escape_string($mRo['Alamat'])."'";
	
	$gFLD .= ",Hak_Tanah";
	$gVAL .= ",'".mysql_real_escape_string($mRo['Hak_Tanah'])."'";
	
	$gFLD .= ",Sertifikat_Tanggal";
	$gVAL .= ",'".$mRo['Sertifikat_Tanggal']."'";
	
	$gFLD .= ",Sertifikat_Nomor";
	$gVAL .= ",'".$mRo['Sertifikat_Nomor']."'";
	
	$gFLD .= ",Penggunaan";
	$gVAL .= ",'".mysql_real_escape_string($mRo['Penggunaan'])."'";
	
	$gFLD .= ",Asal_Usul";
	$gVAL .= ",'".$mRo['Asal_usul']."'";
	
	$gFLD .= ",Harga";
	$gVAL .= ",'".$mRo['Harga']."'";
	
	$gFLD .= ",Keterangan";
	$gVAL .= ",'".mysql_real_escape_string($mRo['Keterangan'])."'";
	
	$gFLD .= ",No_SP2D";
	$gVAL .= ",'".$mRo['No_SP2D']."'";
	
	$gFLD .= ",Pencatat";
	$gVAL .= ",'Import'";
	
	$iG++;
	functionAddRec($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);
	//functionPostRC($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);

}
	
function functionAddRec($gTBL,$gFL,$gVA,$gDTBase,$gCon)
{
	$SelDB =  mysql_select_db($gDTBase, $gCon);
	if ($SelDB==false)
	{
		echo "Error: Database <font color='#FF0000'><b>".$gDTBase."</b></font> tidak ditemukan...!!";
		exit;
	}
	$nSqLADD = "INSERT INTO ".$gTBL." (".$gFL.") values (".$gVA.")";
	mysql_query($nSqLADD) or die(mysql_error());
}

//CLOSE CONN MYSQL
mysql_close($ConSA);
echo "Done..!!";
?>