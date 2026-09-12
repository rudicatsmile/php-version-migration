<?
require "zImport_Connection.php";
require "zImport_FunctionFile.php";

CallConnection(DatabaseSB,$ConSB);
$nSQ = "TRUNCATE TABLE ta_kib_e";
$nRs = mysql_query($nSQ) or die(mysql_error());

CallConnection(DatabaseSA,$ConSA);
$iG=1;
$nSQ = "SELECT * FROM ta_kib_e ORDER BY Kd_Prov, Kd_Kab_Kota, Kd_Bidang, Kd_Unit, Kd_Sub, Kd_UPB, Kd_Aset1, Kd_Aset2, Kd_Aset3, Kd_Aset4, Kd_Aset5, No_Register";
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_assoc($nRs))
{
	$gVAL = "";
	$gFLD = "";
	
	$gTBL = 'ta_kib_e';
	
	$gFLD .= "Referensi";
	$gVAL .= "'ATL.".fMakeReg($iG,11)."'";
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
	
	$gFLD .= ",Kd_Ruang";
	$gVAL .= ",'".$mRo['Kd_Ruang']."'";
	
	$gFLD .= ",Kd_Pemilik";
	$gVAL .= ",'".$mRo['Kd_Pemilik']."'";

	$gFLD .= ",Tgl_Perolehan";
	$gVAL .= ",'".$mRo['Tgl_Perolehan']."'";
	
	$gFLD .= ",Judul";
	$gVAL .= ",'".mysql_real_escape_string($mRo['Judul'])."'";
	
	$gFLD .= ",Spesifikasi";
	$gVAL .= ",'-'";
	
	$gFLD .= ",Pencipta";
	$gVAL .= ",'".mysql_real_escape_string($mRo['Pencipta'])."'";
	
	$gFLD .= ",Daerah_Asal";
	$gVAL .= ",'-'";
	
	$gFLD .= ",Bahan";
	$gVAL .= ",'".mysql_real_escape_string($mRo['Bahan'])."'";
	
	$gFLD .= ",Jenis";
	$gVAL .= ",''";
	
	$gFLD .= ",Ukuran";
	if ($mRo['Ukuran']=="") {$gVAL .= ",'0'";} else {$gVAL .= ",'".(int)$mRo['Ukuran']."'";}
	
	$gFLD .= ",Asal_Usul";
	$gVAL .= ",'".mysql_real_escape_string($mRo['Asal_usul'])."'";
	
	$gFLD .= ",Kondisi";
	$gVAL .= ",'".mysql_real_escape_string($mRo['Kondisi'])."'";
	
	$gFLD .= ",Harga";
	$gVAL .= ",'".$mRo['Harga']."'";
	
	$gFLD .= ",Masa_Manfaat";
	$gVAL .= ",'".$mRo['Masa_Manfaat']."'";
	
	$gFLD .= ",Nilai_Akhir";
	$gVAL .= ",'".$mRo['Nilai_Sisa']."'";
	
	$gFLD .= ",Keterangan";
	$gVAL .= ",'".mysql_real_escape_string($mRo['Keterangan'])."'";
	
	$gFLD .= ",No_SP2D";
	$gVAL .= ",'".mysql_real_escape_string($mRo['No_SP2D'])."'";
	
	$gFLD .= ",Pencatat";
	$gVAL .= ",'Import'";
	
	$iG++;
	functionAddRec($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);

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