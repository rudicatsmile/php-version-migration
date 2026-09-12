<?php
require('Connection.php');
$gUsr = addslashes($_POST['fUsr']);
$gPas = addslashes($_POST['fPas']);
$MesG="";
$tIDT=fGlobal("IDT","ta_user","User_ID",$gUsr,"=","","");
if ($tIDT!="")
{
	$nSQL= "SELECT * FROM ta_user WHERE IDT = '".$tIDT."'";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	$mRo = mysql_fetch_assoc($nRs);
	$tPas= $mRo['Password'];
	if ($tPas==base64_encode(base64_encode($gPas)))
	{
		if ($mRo['Active']=="Y")
		{
			$mSQL = "INSERT INTO ta_user_log SET 
			User_ID='$gUsr',
			Online='Y',
			Login_Time=now()";
			$rst = mysql_query($mSQL) or die(mysql_error());
			
			if (!isset($_SESSION)) {session_start();}
			//$_SESSION['SesStart'] = time();
			$_SESSION['SbdKOBAR'] = time();
			$_SESSION['UserSBKB'] = $gUsr;
			
			$IdL=base64_encode(base64_encode(base64_encode(fGlobal("IDT","ta_user_log","User_ID",$gUsr,"=","IDT desc limit 0,1",""))));
			$URLA="Main.php?IdL=".base64_encode(base64_encode(base64_encode($IdL)));
			$URL ="Main.php";
			
			setcookie("fIdL", $IdL);
			?>
			<script language="JavaScript">	
				window.open('<?=$URL?>','_self');
			</script>
			<?php
		}
		else
		{
			$MesG="User belum aktif..!!";
			$URL="index.php?MesG=".$MesG;
			header("Location: ".$URL);
		}
	}
	else
	{
		$MesG="Password tidak sesuai..!!";
		$URL="index.php?MesG=".$MesG;
		header("Location: ".$URL);
	}
}
else
{
	$MesG="User tidak ditemukan..!!";
	$URL="index.php?MesG=".$MesG;
	header("Location: ".$URL);
}
?>
<?php require('Connection_Close.php');?>
