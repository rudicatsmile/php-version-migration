<?php
require "zImport_Connection.php";
require "zImport_FunctionFile.php";


CallConnection(DatabaseSB,$ConSB);
$nSQ = "DELETE FROM ref_upb";
$nRs = mysql_query($nSQ) or die(mysql_error());

CallConnection(DatabaseSA,$ConSA);
$nSQ = "SELECT * FROM ref_upb ORDER BY Kd_Prov, Kd_Kab_Kota, Kd_Bidang, Kd_Unit, Kd_Sub, Kd_UPB";
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_assoc($nRs))
{
	$gVAL = "";
	$gFLD = "";
	
	$gTBL = 'ref_upb';
	$gFLD = "Kd_UPB,Nm_UPB";
	$gVAL .= "'".fMakeReg($mRo['Kd_Prov'],2);
	$gVAL .= ".".fMakeReg($mRo['Kd_Kab_Kota'],2);
	$gVAL .= ".".fMakeReg($mRo['Kd_Bidang'],2);
	$gVAL .= ".".fMakeReg($mRo['Kd_Unit'],2);
	$gVAL .= ".".fMakeReg($mRo['Kd_Sub'],2);
	$gVAL .= ".".fMakeReg($mRo['Kd_UPB'],3)."'";
	$gVAL .= ",'".$mRo['Nm_UPB']."'";
	
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