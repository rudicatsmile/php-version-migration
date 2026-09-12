<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

if ($IdT)
{
	$Ref = fGlobal("Referensi","ta_usulan_108","IDT",$IdT,"=","","");
	if ($Ref)
	{
		$eSQ="delete from ta_usulan_108 WHERE referensi ='".$Ref."'";
		$eRs= mysql_query($eSQ);
		
		$eSQ="delete from ta_usulan_rinci_108 WHERE referensi ='".$Ref."'";
		$eRs= mysql_query($eSQ);
		
		$eSQ="delete from ta_usulan_rinci_file_108 WHERE referensi ='".$Ref."'";
		$eRs= mysql_query($eSQ);
		
		$eSQ="delete from ta_usulan_verifikasi_108 WHERE ref_usulan ='".$Ref."'";
		$eRs= mysql_query($eSQ);
		
		$eSQ="delete from ta_usulan_verifikasi_rinci_108 WHERE ref_usulan ='".$Ref."'";
		$eRs= mysql_query($eSQ);
		
		$eSQ="delete from ta_usulan_verifikasi_rinci_syarat_108 WHERE ref_usulan ='".$Ref."'";
		$eRs= mysql_query($eSQ);
		
		$eSQ="delete from ta_kib_108_mutasi WHERE ref_usulan ='".$Ref."'";
		$eRs= mysql_query($eSQ);
		
		$eSQ="delete from ta_kib_post_108_mutasi WHERE ref_usulan ='".$Ref."'";
		$eRs= mysql_query($eSQ);
	}
}
?>
<script languange="javascript">
	RefreshDATA('<?=$FrmG?>','<?=$IdL?>');
</script>