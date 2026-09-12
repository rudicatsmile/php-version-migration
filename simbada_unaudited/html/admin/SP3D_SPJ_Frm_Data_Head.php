<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);
#echo $IdT;
$KdR = fGlobal("Kd_ReknP90","ta_sp3d_rinci","IDT",$fIdT,"=","","");
$NmR = fGlobal("Nm_ReknP90","ta_sp3d_rinci","IDT",$fIdT,"=","","");
if ($fIdT){
?>
<table border="0" cellspacing="0" cellpadding="0" height="30" style="border:0px; width:850px">
<tr>
<td width="30" class="ac"><img src="Images/e_search_results_view.gif" /></td>
<td style="font-size:10pt; font-weight:bold; text-shadow: #fff 1px 1px 1px;"><?=$KdR." : ".strtoupper($NmR)?></td>
<td width="161" class="ar">
<a href="#" onclick="showReknP108('','<?=$fIdT?>','<?=$_GET['IdL']?>'); return false;" class="ico add">Add REKENING ASET</a>
</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" height="30" style="border:0px; width:100%; background:#c5bd36">
	<tr height="20" style="text-align:center">
		<td width="102" style="border-top:1px solid #ccc; border-right:1px solid #ccc; border-bottom:1px solid #ccc">Referensi</td>
		<td width="65" style="border-top:1px solid #ccc; border-right:1px solid #ccc; border-bottom:1px solid #ccc">Tgl.BAST</td>
		<td width="95" style="border-top:1px solid #ccc; border-right:1px solid #ccc; border-bottom:1px solid #ccc">Kode</td>
		<td width="253" style="border-top:1px solid #ccc; border-right:1px solid #ccc; border-bottom:1px solid #ccc">Rekening Aset</td>
		<td width="93" style="border-top:1px solid #ccc; border-right:1px solid #ccc; border-bottom:1px solid #ccc">Nilai Aset</td>
		<td style="border-top:1px solid #ccc; border-right:0px solid #ccc; border-bottom:1px solid #ccc">Action</td>
	<tr>
</table>
<? } ?>
