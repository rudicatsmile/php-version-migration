<?php
function InsertGLOBAL($gTBL,$gFLD,$gVAL,$gDataBase,$gCon)
{
	CallConnection($gDataBase,$gCon);
	$SQG="INSERT INTO $gTBL (".$gFLD.") values(".$gVAL.")";
	$rsG= mysql_query($SQG) or die(mysql_error());
}

function UpdateGLOBAL($gTBL,$gDTA,$gIdX,$gSyR,$gOpR,$gDataBase,$gCon)
{
	$JmL=fHiSplitT2K($gIdx,":");
	if ($JmL > 0)
	{
		$gID = explode(':', $gIdX);
		$gSY = explode(':', $gSyR);
		$gOP = explode(':', $gOpR);
		
		$gUpD= "";
		for ($iG=0; $iG<=$JmL; $iG++)
		{
			if ($iG > 0) {$gAd=" AND ";} else {$gAd="";}
			$gUpD.= $gAd.$gID[$iG]." ".$gOP[$iG]." ".$gOP[$iG];
		}
	} else {$gUpD=$gIdX.$gOpR.$gSyR;}
	
	CallConnection($gDataBase,$gCon);
	$SQG="UPDATE $gTBL SET ".$gDTA." WHERE ".$gUpD;
	$rsG= mysql_query($SQG) or die(mysql_error());
}
?>