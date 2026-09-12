<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

$FnD = str_replace('**',' ',$FnD);
?>

<table align="center" class="table-list" cellpadding="0" cellspacing="0" width="100%" height="100%" border="0" style="border:0px"> 
  <? 
    if ($FnD)  
    { 
		$SyT = "AND (Kd_Aset LIKE '%$FnD%' OR Nm_Aset LIKE '%$FnD%')"; 
        $LmT = ""; 
    } 
    else 
    { 
        $SyT = ""; 
        $LmT = "LIMIT 50"; 
    } 
     
    $iG=1;
	
	$nSQ = "SELECT Kd_Aset as A0, Nm_Aset 
	FROM ref_rek_aset108_7
	WHERE Kd_Aset LIKE '1.3.6%' $SyT ORDER BY Kd_Aset";
	#echo $nSQ;
	$nRs = mysql_query($nSQ); 
	while ($mRo = mysql_fetch_array($nRs)) 
	{ 
		$KdA = $mRo[0]; 
		$NmA = $mRo[1]; 
		
		$gBG = fBackCLR($iG);
		?> 
          <tr height="25" style="cursor:pointer" onclick="showLst_Add('<?=$KdA?>','<?=$NmA?>','<?=$CrDiv?>','<?=$IdL?>'); return false">  
            <td width="120" style="border-bottom:1px dotted #999; border-right:0px solid #ccc; text-align:center" <?=$gBG?>><?=$mRo[0]?></td> 
            <td width="425" style="border-bottom:1px dotted #999; border-right:0px solid #ccc; padding-left:3px" <?=$gBG?>><?=$mRo[1]?></td> 
          </tr> 
          <? 
        $iG++; 
    } 
    ?> 
  <tr height="100%">  
    <td colspan="2" valign="top">&nbsp;&nbsp;<? if ($iG==1){echo "Data tidak ditemukan..!";}?></td> 
  </tr> 
</table>
