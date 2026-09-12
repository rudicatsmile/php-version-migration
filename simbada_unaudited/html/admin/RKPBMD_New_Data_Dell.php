<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

if ($IdT)
{
	$Ref = fGlobal("Referensi","ta_rkpbmd_new","IDT",$IdT,"=","","");
	$ThN = fGlobal("tahun","ta_rkpbmd_new","IDT",$IdT,"=","","");
	$ApB = fGlobal("apbd","ta_rkpbmd_new","IDT",$IdT,"=","","");
	if ($Ref)
	{
		$nSQ = "DELETE FROM ta_rkpbmd_new_program WHERE Referensi='$Ref' AND tahun='$ThN' AND apbd='$ApB'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_rkpbmd_new_kegiatan WHERE Referensi='$Ref' AND tahun='$ThN' AND apbd='$ApB'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_rkpbmd_new_kegiatan_sub WHERE Referensi='$Ref' AND tahun='$ThN' AND apbd='$ApB'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_rkpbmd_new_rekening WHERE Referensi='$Ref' AND tahun='$ThN' AND apbd='$ApB'";
		$nRs = mysql_query($nSQ);
		
		$nSQ = "DELETE FROM ta_rkpbmd_new WHERE IDT='$IdT'";
		$nRs = mysql_query($nSQ);
	}
}
?>
<script languange="javascript">
	RefreshDATA('<?=$IdL?>');
</script>