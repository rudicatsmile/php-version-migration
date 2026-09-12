<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$NiL = fConvertToNumeric($NiL);

$nSQ = "update ta_apbd_rekening_skpd set fnJumlah='$NiL' where idt='$IdT'";
$nRs = mysql_query($nSQ);
?>
<script type="text/javascript">
	alert('Update berhasil...!!')
	RefreshDATA('<?=$IdL?>');
</script>
