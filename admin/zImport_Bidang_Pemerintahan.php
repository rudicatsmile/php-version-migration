<?php
require "zImport_Connection.php";
require "zImport_FunctionFile.php";

//CallConnection(DatabaseSB,$ConSB);
//$nSQ = "DELETE FROM ref_s_bidang";
//$nRs = mysql_query($nSQ) or die(mysql_error());

//CallConnection(DatabaseSA,$ConSA);
//$nSQ = "SELECT * FROM ref_s_bidang ORDER BY Kd_Urusan, Kd_Bidang";
//$nRs = mysql_query($nSQ) or die(mysql_error());
//while ($mRo = mysql_fetch_assoc($nRs))
//{
//	$gVAL = "";
//	$gFLD = "";
//	
//	$gTBL = 'ref_bidang';
//	$gFLD = "Kd_Urusan,Kd_Bidang,Nm_Bidang";
//	$gVAL = "'".$mRo['Kd_Urusan']."','24.04.".fMakeReg($mRo['Kd_Bidang'],2)."','".$mRo['Nm_Bidang']."'";
//	
//	functionAddRec($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);

//}

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