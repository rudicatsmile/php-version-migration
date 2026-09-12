<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);
if ($IdT)
{
	$Ref = fGlobal("Referensi","ta_rkbmd_new","IDT",$IdT,"=","","");
	$ThN = fGlobal("tahun","ta_rkbmd_new","IDT",$IdT,"=","","");
	$ApB = fGlobal("apbd","ta_rkbmd_new","IDT",$IdT,"=","","");
	if ($Ref)
	{

		$nSQ = "DELETE FROM ta_rkbmd_new_program WHERE referensi='$Ref' AND tahun='$ThN' AND apbd='$ApB'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_rkbmd_new_kegiatan WHERE referensi='$Ref' AND tahun='$ThN' AND apbd='$ApB'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_rkbmd_new_kegiatan_sub WHERE referensi='$Ref' AND tahun='$ThN' AND apbd='$ApB'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_rkbmd_new_rekening WHERE referensi='$Ref' AND tahun='$ThN' AND apbd='$ApB'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_rkbmd_new WHERE IDT='$IdT'";
		$nRs = mysql_query($nSQ);
	}
}
?>
<script languange="javascript">
	RefreshDATA('<?=$IdL?>');
</script>