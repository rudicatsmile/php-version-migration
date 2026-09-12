<?
require('Connection.php');
extract($_GET);
$nSQ = "delete from ta_apbd_program_skpd where idt='$IdT'";
$nRs = mysql_query($nSQ);
?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>');
</script>
