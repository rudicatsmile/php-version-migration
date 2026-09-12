<?php
/*
if ($_GET['IdL']!="")
{
	if (!isset($_SESSION)) {session_start();}
	//if (isset($_SESSION['SesStart']))
	if (isset($_SESSION['SbdKOBAR']))
	{
		if (!isset($_SESSION)) {session_start();}
		//$TimeX = $_SESSION['SesStart'];
		$TimeX = $_SESSION['SbdKOBAR'];
		$TimeY = time();
		$TimeZ = $TimeY - $TimeX;
		$MeniT = 160;
		if ($_SESSION['UserSBKB']=="")
		{
			$MesG = "Invalid Page..!!";
			$URL  = "ErrorPage.php?MesG=".$MesG;
			?>
			<script language="JavaScript">	
				window.open("<?php echo $URL?>","_self");
			</script>
			<?php
		}
		else
		{
			if ($TimeZ > ($MeniT * 60))
			{
				$MesG = "Anda tidak melakukan aktivitas dalam waktu ".$MeniT." menit, Sistem melakukan logout otomatis ..!!";
				$URL  = "ErrorPage.php?Logout=Ya&MesG=".$MesG."&IdL=".$_GET['IdL'];
				?>
				<script language="JavaScript">	
					window.open("<?php echo $URL?>","_self");
				</script>
				<?php
			}
			else
			{
				echo ": ".$TimeZ;
				//$_SESSION['SesStart'] = time();
				$_SESSION['SbdKOBAR'] = time();
			}
		}
	}
}
*/
?>
