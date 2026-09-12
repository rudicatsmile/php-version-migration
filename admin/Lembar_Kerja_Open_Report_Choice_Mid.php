<?php
require('Connection.php');
require('FileFunction.php');
extract($_GET);

if ($UpB=='00.00.00.00.00.000')
{
	if ($SuB=='00.00.00.00.00')
	{
		$UnT = $UnT;
	}
	else
	{
		$UnT = $SuB;
	}
}
else
{
	$UnT = $UpB;
}

$AsT = $AsT;
$Ref = AwalRef108($AsT);

$JmREC = fGlobal("count(*)","tb_lembar_kerja","Referensi:KdUPB:DataSensusFix:TglPerolehan NOT",$Ref.".%:".$UnT."%:Y:2023-%-%","LIKE:LIKE:<>:LIKE","","");
?>
<table border='0' width='526' cellspacing='1' style='font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse'>
  <tr> 
    <td width='70'>&nbsp;</td>
    <td colspan="2"></td>
  </tr>
  <tr> 
    <td width='70'>&nbsp;</td>
    <td width='30'>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php
  		$gNO  = 0;
		$HeA  = "NO";		
		$TtD  = "NO";
		$gMax = (int)($JmREC/5000);
		$gMax = $gMax * 5000;
		for ($i=0; $i<=$gMax; $i=$i+5000)
		{
			$gA = $i+1;
			$gB = $i+5000;
			if ($i==$gMax) {$gB=$JmREC;} else {$gB=$gB;}
			
			$LoadEND="NO";
			
			if ($gB==$JmREC){
				$LoadEND="YA";
			}
			
			if ($i==0) {$HeA ="YA";} else {$HeA ="NO";}			//Header Dokumer
			if ($i==$gMax) {$TtD ="YA";} else {$TtD ="NO";}		//Tanda tangan
			$ReC=$i;
			$gNO++;
			?>
			<tr height="20"> 
			<td>&nbsp;</td>
			<td style="color:#999"><?=$gNO?>.</td>
			<td>
			<a href='#' class="ico docu" onClick="P_OpenDoc('Report_LHI_III_B_14','800','400','<?=$ReC?>','<?=$TtD?>','<?=$HeA?>','<?=$LoadEND?>','<?=$_GET['fHR']?>','<?=$_GET['fBL']?>','<?=$_GET['fTH']?>','<?=$_GET['AsT']?>','<?=$_GET['UpB']?>','<?=$_GET['SuB']?>','<?=$_GET['UnT']?>','<?=$_GET['IdL']?>'); return false">&nbsp;&nbsp;&nbsp;LHI ( III.B.14 ) - <?php echo "( Record &nbsp;&nbsp; => &nbsp;&nbsp; ".fConvertToRupiahBulat($gA)." &nbsp; s/d &nbsp; ".fConvertToRupiahBulat($gB)." )"?></a>
			
			</td>
			</tr>
			<?php
		}
		?>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
