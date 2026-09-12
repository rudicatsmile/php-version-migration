<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$TgKON = fMakeDateToDB($fHRKon,$fBLKon,$fTHKon);
$TgBAS = fMakeDateToDB($fHRBas,$fBLBas,$fTHBas);
$TgFAK = fMakeDateToDB($fHRFak,$fBLFak,$fTHFak);
$fNomKon = ReplaceTextPHP($fNomKon);
$fNomBas = ReplaceTextPHP($fNomBas);
$fNomFak = ReplaceTextPHP($fNomFak);
$fUrai   = ReplaceTextPHP($fUrai);

$nSQ = "UPDATE ta_sp3d_spj SET Tgl_Kontrak='".$TgKON."', Tgl_BAST='".$TgBAS."', Tgl_Faktur='".$TgFAK."', 
Nom_Kontrak = '".$fNomKon."', Nom_BAST = '".$fNomBas."', Nom_Faktur = '".$fNomFak."', Uraian='".$fUrai."' 
WHERE IDT='".$eIdT."'";
$nRs = mysql_query($nSQ);

?>
<script type="text/javascript">
	showSPJ('refr','<?=$eIdT?>','','<?=$IdL?>');
</script>

