<?
require('Connection.php');
require('FileFunction.php');
require('CheckLogin.php');
extract($_GET);

if ($IdT!=='')
{

	if ($eFL=='NonALL'){
		$nSQ = "UPDATE ta_sp3d_lock SET Reguler='N', Afirmasi='N', Kinerja='N', Recorded=now(), Pencatat='".$UID."' WHERE Kd_UPB='".$UpB."' AND Tahun='".$gTH."'";
	}
	else if ($eFL=='ALL'){
		$nSQ = "UPDATE ta_sp3d_lock SET Reguler='Y', Afirmasi='Y', Kinerja='Y', Recorded=now(), Pencatat='".$UID."' WHERE Kd_UPB='".$UpB."' AND Tahun='".$gTH."'";
	}
	else{
		$nSQ = "UPDATE ta_sp3d_lock SET $eFL='".$CrT."', Recorded=now(), Pencatat='".$UID."' WHERE Kd_UPB='".$UpB."' AND Tahun='".$gTH."'";
	}
	echo $nSQ;
	$nRs = mysql_query($nSQ);
}
?>
<script type="text/javascript">
	RefreshDATA('<?=$IdL?>');
</script>

