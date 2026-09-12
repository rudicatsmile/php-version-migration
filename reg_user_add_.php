<?php
require('connfile.php');
extract($_GET);

$gUid = str_replace('**',' ',$gUid);
$gPsA = base64_encode(base64_encode(str_replace('**',' ',$gPsA)));
$gNmA = str_replace('**',' ',$gNmA);
$gUnT = $gUnT;
$gSuB = $gSuB;
$gUpB = $gUpB;

if ($gUpB!=""){
	$rUpB = $gUpB;
}
else{
	if ($gSuB!=""){
		$rUpB = $gSuB;
	}
	else{
		$rUpB = $gUnT;
	}
}

$gKeT = str_replace('**',' ',$gKeT);

$tIDT = fGlobal("idt","ta_user","user_id",$gUid,"=","","");
if ($tIDT=="")
{
	$SQ = "INSERT INTO ta_user SET 
	User_ID='$gUid',
	Password='$gPsA',
	Full_Name='$gNmA',
	Short_Name='',
	Kode='$rUpB',
	Level='4',
	Admin='0',
	Active='N',
	Tupoksi='$gKeT'";
	$rs = mysql_query($SQ);
	?>
	<script languange="javascript">retFeddback('OK');</script>
	<?php
}
else
{
	?>
	<script languange="javascript">retFeddback('NOT');</script>
	<?php
}
?>
