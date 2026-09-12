<?
require "zImport_Connection.php";
require "zImport_FunctionFile.php";

//Rek Lev. 1
CallConnection(DatabaseSB,$ConSB);
$nSQ = "DELETE FROM ref_rek_aset1";
$nRs = mysql_query($nSQ) or die(mysql_error());

CallConnection(DatabaseSA,$ConSA);
$nSQ = "SELECT * FROM ref_rek_aset1 ORDER BY Kd_Aset1";
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_assoc($nRs))
{
	$gVAL = "";
	$gFLD = "";
	
	$gTBL = 'ref_rek_aset1';
	$gFLD = "Kd_Aset,Nm_Aset";
	$gVAL = "'".fMakeReg($mRo['Kd_Aset1'],2)."','".$mRo['Nm_Aset1']."'";
	
	functionAddRec($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);

}

//Rek Lev. 2
CallConnection(DatabaseSB,$ConSB);
$nSQ = "DELETE FROM ref_rek_aset2";
$nRs = mysql_query($nSQ) or die(mysql_error());

CallConnection(DatabaseSA,$ConSA);
$nSQ = "SELECT * FROM ref_rek_aset2 ORDER BY Kd_Aset1, Kd_Aset2";
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_assoc($nRs))
{
	$gVAL = "";
	$gFLD = "";
	
	$gTBL = 'ref_rek_aset2';
	$gFLD = "Kd_Aset,Nm_Aset";
	$gREK = fMakeReg($mRo['Kd_Aset1'],2).".".fMakeReg($mRo['Kd_Aset2'],2);
	$gVAL = "'".$gREK."','".$mRo['Nm_Aset2']."'";
	
	functionAddRec($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);

}

//Rek Lev. 3
CallConnection(DatabaseSB,$ConSB);
$nSQ = "DELETE FROM ref_rek_aset3";
$nRs = mysql_query($nSQ) or die(mysql_error());

CallConnection(DatabaseSA,$ConSA);
$nSQ = "SELECT * FROM ref_rek_aset3 ORDER BY Kd_Aset1, Kd_Aset2, Kd_Aset3";
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_assoc($nRs))
{
	$gVAL = "";
	$gFLD = "";
	
	$gTBL = 'ref_rek_aset3';
	$gFLD = "Kd_Aset,Nm_Aset";
	$gREK = fMakeReg($mRo['Kd_Aset1'],2).".".fMakeReg($mRo['Kd_Aset2'],2).".".fMakeReg($mRo['Kd_Aset3'],2);
	$gVAL = "'".$gREK."','".mysql_real_escape_string($mRo['Nm_Aset3'])."'";
	
	functionAddRec($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);

}

//Rek Lev. 4
CallConnection(DatabaseSB,$ConSB);
$nSQ = "DELETE FROM ref_rek_aset4";
$nRs = mysql_query($nSQ) or die(mysql_error());

CallConnection(DatabaseSA,$ConSA);
$nSQ = "SELECT * FROM ref_rek_aset4 ORDER BY Kd_Aset1, Kd_Aset2, Kd_Aset3, Kd_Aset4";
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_assoc($nRs))
{
	$gVAL = "";
	$gFLD = "";
	
	$gTBL = 'ref_rek_aset4';
	$gFLD = "Kd_Aset,Nm_Aset";
	$gREK = fMakeReg($mRo['Kd_Aset1'],2).".".fMakeReg($mRo['Kd_Aset2'],2).".".fMakeReg($mRo['Kd_Aset3'],2).".".fMakeReg($mRo['Kd_Aset4'],2);
	$gVAL = "'".$gREK."','".mysql_real_escape_string($mRo['Nm_Aset4'])."'";
	
	functionAddRec($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);

}

//Rek Lev. 5
CallConnection(DatabaseSB,$ConSB);
$nSQ = "DELETE FROM ref_rek_aset5";
$nRs = mysql_query($nSQ) or die(mysql_error());

CallConnection(DatabaseSA,$ConSA);
$nSQ = "SELECT * FROM ref_rek_aset5 ORDER BY Kd_Aset1, Kd_Aset2, Kd_Aset3, Kd_Aset4, Kd_Aset5";
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_assoc($nRs))
{
	$gVAL = "";
	$gFLD = "";
	
	$gTBL = 'ref_rek_aset5';
	$gFLD = "Kd_Aset,Nm_Aset";
	$gREK = fMakeReg($mRo['Kd_Aset1'],2).".".fMakeReg($mRo['Kd_Aset2'],2).".".fMakeReg($mRo['Kd_Aset3'],2).".".fMakeReg($mRo['Kd_Aset4'],2).".".fMakeReg($mRo['Kd_Aset5'],3);
	$gVAL = "'".$gREK."','".mysql_real_escape_string($mRo['Nm_Aset5'])."'";
	
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
//mysql_close($ConSA);
echo "Done..!!";
?>