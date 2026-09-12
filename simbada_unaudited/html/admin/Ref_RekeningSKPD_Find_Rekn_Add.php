<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$gAPB = 1;
#echo $gTHN."<br>";
#echo $gUNT."<br>";
#echo $gPRG."<br>";
#echo $gKEG."<br>";
#echo $gSUB."<br>";
#echo $gPER."<br>";
#echo $kde."<br>";

$nma  = fGlobal("nmRekening","ta_apbd_rekening_skpd","kdRekening:nmRekening",$kde.":","=:<>","IDT LIMIT 0,1",DatabaseSA,$ConSA,""); 
$nPER = fGlobal("nmSubUnit","ta_apbd_rekening_skpd","idSubUnit:nmSubUnit",$gPER.":","=:<>","IDT LIMIT 0,1",DatabaseSA,$ConSA,""); 

$gOPD = fGlobal("idOPD","ta_apbd_rekening_skpd","idSubUnit:nmSubUnit",$gPER.":","=:<>","IDT LIMIT 0,1",DatabaseSA,$ConSA,""); 
$nOPD = fGlobal("OPD","ta_apbd_rekening_skpd","idSubUnit:nmSubUnit",$gPER.":","=:<>","IDT LIMIT 0,1",DatabaseSA,$ConSA,""); 

$nPRG = fGlobal("nmProgram","ta_apbd_rekening_skpd","idProgram:nmProgram",$gPRG.":","=:<>","IDT LIMIT 0,1",DatabaseSA,$ConSA,""); 
$nKEG = fGlobal("nmKegiatan","ta_apbd_rekening_skpd","idKegiatan:nmKegiatan",$gKEG.":","=:<>","IDT LIMIT 0,1",DatabaseSA,$ConSA,""); 
$nSUB = fGlobal("nmSubKegiatan","ta_apbd_rekening_skpd","idSubKegiatan:nmSubKegiatan",$gSUB.":","=:<>","IDT LIMIT 0,1",DatabaseSA,$ConSA,""); 

$nCKE = fGlobal("IDT","ta_apbd_rekening_skpd","kdUnit:idProgram:idKegiatan:idSubKegiatan:idSubUnit:kdRekening",$gUNT.":".$gPRG.":".$gKEG.":".$gSUB.":".$gPER.":".$kde,"=:=:=:=:=:=","",DatabaseSA,$ConSA,""); 
if ($nCKE=='')
{
	$SQ = "INSERT INTO ta_apbd_rekening_skpd SET 
	kdUnit='".$gUNT."',
	idOPD='".$gOPD."',
	OPD='".$nOPD."',
	idSubUnit='".$gPER."',
	nmSubUnit='".$nPER."',
	idProgram='".$gPRG."',
	nmProgram='".$nPRG."',
	idKegiatan='".$gKEG."',
	nmKegiatan='".$nKEG."',
	idSubKegiatan='".$gSUB."',
	nmSubKegiatan='".$nSUB."',
	kdRekening='".$kde."',
	nmRekening='".$nma."',
	fnJumlah='0',
	periode='".$gTHN."',
	apbd='".$gAPB."',
	UseList='Y'";
	mysql_query($SQ);
	#echo $SQ."<br>";
}
?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>');
</script>
