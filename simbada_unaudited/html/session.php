<?
if (!isset($_SESSION)){session_start();}
function seSession($aX)
{
	$_SESSION['NaviG'] = $aX;
}

?>