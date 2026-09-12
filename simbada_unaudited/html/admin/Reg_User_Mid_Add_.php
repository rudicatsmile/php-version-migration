<?
require('Connection.php');
$Smpn  = $_POST['fSimpan'];

$eIdT  = $_GET['eIdT'];
$IdL   = $_GET['IdL'];

$gUid  = $_POST['fUid'];
$gPasA = $_POST['fPasA'];
$gPasB = $_POST['fPasB'];
$gNmaA = $_POST['fNmaA'];
$gNmaB = $_POST['fNmaB'];
$gText = $_POST['fText'];
$gUnt  = $_POST['fUnt'];
$gSub  = $_POST['fSub'];
$gUpb  = $_POST['fUpb'];

if ($Smpn=="Save")
	{
		if ($eIdT=="")
		{			
			$tIDT=fGlobal("IDT","Ta_User","User_ID",$gUid,"=","","");
			if ($tIDT=="")
			{
				$gPasA = base64_encode(base64_encode($gPasA));
				$SQ = "INSERT INTO ta_user SET 
				User_ID='$gUid',
				Password='$gPasA',
				Full_Name='$gNmaA',
				Short_Name='$gNmaB',
				Kode='$gUpb',
				Level='4',
				Admin='0',
				Active='N',
				Tupoksi='$gText'";
				$rs = mysql_query($SQ) or die(mysql_error());
				
				$eIdT=fGlobal("IDT","Ta_User","User_ID",$gUid,"=","IDT desc limit 0,1","");
				
				$MsG="Registrasi berhasil, silahkan hubungi Administrator Sistem untuk proses aktivasi...!!";
				$URL="Reg_User_Mid_Add.php?eIdT=".$eIdT."&IdL=".$IdL."&gMsG=".$MsG;
			}
			else
			{
				$MsG="User ID sudah dipergunakan oleh yang lain...!";
				$URL="Reg_User_Mid_Add.php?gMsG=".$MsG."&gUid=".$gUid."&gPasA=".$gPasA."&gPasB=".$gPasB."&gNmaA=".$gNmaA."&gNmaB=".$gNmaB."&gText=".$gText."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&IdL=".$IdL;
			}
		}
		else
		{
			$nSQ = "SELECT IDT FROM ta_user WHERE User_ID='".$gUid."' AND IDT<>'".$eIdT."'";
			$nRs = mysql_query($nSQ) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
				$MsG="Update data <b>DIBATALKAN</b>, User ID sudah terpakai oleh yang lain ...!!";
			}
			else
			{
				$gPasA = base64_encode(base64_encode($gPasA));
				$SQ = "UPDATE ta_user SET 
				User_ID='$gUid',
				Password='$gPasA',
				Full_Name='$gNmaA',
				Short_Name='$gNmaB',
				Tupoksi='$gText' WHERE IDT='".$eIdT."'";
				$rs = mysql_query($SQ) or die(mysql_error());
				$MsG="Update data BERHASIL...!!";
			}	
			$eIdT=$eIdT;
			
			$URL="Reg_User_Mid_Add.php?eIdT=".$eIdT."&IdL=".$IdL."&gMsG=".$MsG;
		}
	}
else if ($Smpn=="Reset")
	{
	$URL="Reg_User_Mid_Add.php?IdL=".$IdL;
	}
else
	{
	$URL="Reg_User_Mid_Add.php?gUid=".$gUid."&gPasA=".$gPasA."&gPasB=".$gPasB."&gNmaA=".$gNmaA."&gNmaB=".$gNmaB."&gText=".$gText."&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&IdL=".$IdL."&eIdT=".$eIdT;
	}
header("Location: ".$URL);

?>

<?php require('Connection_Close.php');?>
