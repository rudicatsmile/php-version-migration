<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);


$kode_bar = fGlobal("kode_bar","ta_kib_108_barcode","IDT",$IdT,"=","","");
$cek = fGlobal("kode_bar","ta_kib_108","kode_bar",$kode_bar,"=","","");

if(strlen($cek)>5){

    $nSQ = "UPDATE ta_kib_108 SET kode_bar='' WHERE kode_bar='".$kode_bar."'";
    $nRs = mysql_query($nSQ);

    $nSQ = "UPDATE ta_kib_108_barcode SET Kd_UPB='' WHERE kode_bar='".$kode_bar."'";
    $nRs = mysql_query($nSQ);

}else{
   
    $nSQ = "DELETE FROM ta_kib_108_barcode WHERE IDT='".$IdT."'";
    $nRs = mysql_query($nSQ);

}



?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>');
</script>

