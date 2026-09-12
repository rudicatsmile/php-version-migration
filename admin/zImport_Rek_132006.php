<?php
require "zImport_Connection.php";
require "zImport_FunctionFile.php";

//Rek Lev. 1
CallConnection(DatabaseSB,$ConSB);
$nSQ = "DELETE FROM ref_rek_1";
$nRs = mysql_query($nSQ) or die(mysql_error());

CallConnection(DatabaseSA,$ConSA);
$nSQ = "SELECT * FROM ref_rek_1 ORDER BY Kd_Rek_1";
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_assoc($nRs))
{
	$gVAL = "";
	$gFLD = "";
	
	$gTBL = 'ref_rek_1';
	$gFLD = "Kd_Rek,Nm_Rek";
	$gVAL = "'".$mRo['Kd_Rek_1']."','".$mRo['Nm_Rek_1']."'";
	
	functionAddRec($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);

}

//Rek Lev. 2
CallConnection(DatabaseSB,$ConSB);
$nSQ = "DELETE FROM ref_rek_2";
$nRs = mysql_query($nSQ) or die(mysql_error());

CallConnection(DatabaseSA,$ConSA);
$nSQ = "SELECT * FROM ref_rek_2 ORDER BY Kd_Rek_1, Kd_Rek_2";
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_assoc($nRs))
{
	$gVAL = "";
	$gFLD = "";
	
	$gTBL = 'ref_rek_2';
	$gFLD = "Kd_Rek,Nm_Rek";
	$gREK = $mRo['Kd_Rek_1'].".".$mRo['Kd_Rek_2'];
	$gVAL = "'".$gREK."','".$mRo['Nm_Rek_2']."'";
	
	functionAddRec($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);

}

//Rek Lev. 3
CallConnection(DatabaseSB,$ConSB);
$nSQ = "DELETE FROM ref_rek_3";
$nRs = mysql_query($nSQ) or die(mysql_error());

CallConnection(DatabaseSA,$ConSA);
$nSQ = "SELECT * FROM ref_rek_3 ORDER BY Kd_Rek_1, Kd_Rek_2, Kd_Rek_3";
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_assoc($nRs))
{
	$gVAL = "";
	$gFLD = "";
	
	$gTBL = 'ref_rek_3';
	$gFLD = "Kd_Rek,Nm_Rek,SaldoNorm";
	$gREK = $mRo['Kd_Rek_1'].".".$mRo['Kd_Rek_2'].".".$mRo['Kd_Rek_3'];
	$gVAL = "'".$gREK."','".mysql_real_escape_string($mRo['Nm_Rek_3'])."','".$mRo['SaldoNorm']."'";
	
	functionAddRec($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);

}

//Rek Lev. 4
CallConnection(DatabaseSB,$ConSB);
$nSQ = "DELETE FROM ref_rek_4";
$nRs = mysql_query($nSQ) or die(mysql_error());

CallConnection(DatabaseSA,$ConSA);
$nSQ = "SELECT * FROM ref_rek_4 ORDER BY Kd_Rek_1, Kd_Rek_2, Kd_Rek_3, Kd_Rek_4";
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_assoc($nRs))
{
	$gVAL = "";
	$gFLD = "";
	
	$gTBL = 'ref_rek_4';
	$gFLD = "Kd_Rek,Nm_Rek";
	$gREK = $mRo['Kd_Rek_1'].".".$mRo['Kd_Rek_2'].".".$mRo['Kd_Rek_3'].".".fMakeReg($mRo['Kd_Rek_4'],2);
	$gVAL = "'".$gREK."','".mysql_real_escape_string($mRo['Nm_Rek_4'])."'";
	
	functionAddRec($gTBL,$gFLD,$gVAL,DatabaseSB,$ConSB);

}

//Rek Lev. 5
CallConnection(DatabaseSB,$ConSB);
$nSQ = "DELETE FROM ref_rek_5";
$nRs = mysql_query($nSQ) or die(mysql_error());

CallConnection(DatabaseSA,$ConSA);
$nSQ = "SELECT * FROM ref_rek_5 ORDER BY Kd_Rek_1, Kd_Rek_2, Kd_Rek_3, Kd_Rek_4, Kd_Rek_5";
$nRs = mysql_query($nSQ) or die(mysql_error());
while ($mRo = mysql_fetch_assoc($nRs))
{
	$gVAL = "";
	$gFLD = "";
	
	$gTBL = 'ref_rek_5';
	$gFLD = "Kd_Rek,Nm_Rek";
	$gREK = $mRo['Kd_Rek_1'].".".$mRo['Kd_Rek_2'].".".$mRo['Kd_Rek_3'].".".fMakeReg($mRo['Kd_Rek_4'],2).".".fMakeReg($mRo['Kd_Rek_5'],2);
	$gVAL = "'".$gREK."','".mysql_real_escape_string($mRo['Nm_Rek_5'])."'";
	
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