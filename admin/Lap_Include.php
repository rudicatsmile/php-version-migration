<?php

if ($gUnt=="All" || $gUnt=="")
{
	$gUpb = $KdProp.".".$KdKabK.".__.__.__.___";
	$xUnt = "";
	$xSub = "";
	$xUpb = "";
}
else
{
	if ($gSub=="All" || $gSub=="")
	{
		$gUpb = $gUnt.".__.___";
		$xUnt = $gUnt;
		$xSub = "";
		$xUpb = "";
	}
	else
	{
		if ($gUpb=="All" || $gUpb=="")
		{
			$gUpb = $gSub.".___";
			$xUnt = $gUnt;
			$xSub = $gSub;
			$xUpb = "";
		}
		else
		{
			$gUpb = $gUpb;
			$xUnt = $gUnt;
			$xSub = $gSub;
			$xUpb = $gUpb;
		}
	}
}

?>