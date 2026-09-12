<?
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

#echo $IdT;
$ReT = fGlobalNEW("Referensi","ta_kib_kdptoaset","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
$ExT = fGlobalNEW("Execute","ta_kib_kdptoaset","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");

?>
<table align="center" class="table-list" cellpadding="0" cellspacing="0" width="100%" height="100%" border="0" style="border:0px"> 
  <? 
    if ($FnD)  
    { 
		$SyT = ""; 
        $LmT = ""; 
    } 
    else 
    { 
        $SyT = ""; 
        $LmT = "LIMIT 50"; 
    } 
     
    $iG=1;
	
	$nSQ = "SELECT P1.IDT as A0, P1.Ref_Aset as A1, P1.No_Register as A2, 
	P1.Tgl_Perolehan as A3,
	CONCAT('<b>',P1.Nm_Aset,'</b>', '<br><i><b>Ket. :</b> ', P3.Keterangan, '<br><b>Lokasi :</b> ', P1.Lokasi) as A4,
	P1.Nilai as A5, 
	sum(P2.Nilai) as A6,
	P1.Induk as A7 
	FROM ta_kib_kdptoaset_data P1 
	LEFT JOIN ta_kib_kdptoaset_data_post P2 ON P2.Referensi=P1.Referensi AND P2.Ref_Aset=P1.Ref_Aset 
	LEFT JOIN ta_kib_108 P3 ON P3.Referensi=P1.Ref_Aset 
	WHERE P1.Referensi = '".$ReT."' $SyT GROUP BY P1.Ref_Aset ORDER BY P1.Tgl_Perolehan ".$LmT; 
	#echo $nSQ;
	$nRs = mysql_query($nSQ); 
	while ($mRo = mysql_fetch_array($nRs)) 
	{ 
		$IdR = $mRo[0]; 
		$gBG = fBackCLR($iG);
		
		$YeS = "";
		$CoL = "";
		if ($mRo[7]=='Y')
		{
			$YeS = "checked";
			$CoL = "; font-weight:bold";
		}
		$ico = 'del';
		if ($ExT=='Y')
		{
			$ico = 'delt';
		}
		
		$Wrn = "";
		$mRo5 = $mRo[5];
		$mRo6 = $mRo[6];
		if ($mRo[4]=='')
		{
			$Wrn = "; color:#ff0000";
			$mRo5 = 0;
			$mRo6 = 0;
			
			if ($mRo[5] > 0 || $mRo[6] > 0)
			{
				$SQ = "update ta_kib_kdptoaset_data SET nilai='0' WHERE IDT='".$mRo[0]."'";
				echo $SQ."<br>";
				mysql_query($SQ); 
				
				$SQ = "update ta_kib_kdptoaset_data_post SET nilai='0' WHERE referensi='".$ReT."' AND ref_aset='".$mRo[1]."'";
				echo $SQ."<br>";
				mysql_query($SQ); 
			}
		}
		?> 
          <tr height="90" style="cursor:pointer  <?=$CoL?>">  
            <td width="26" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:center <?=$Wrn?>" <?=$gBG?>><?=$iG?>.</td>
            <td width="95" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:center <?=$Wrn?>" <?=$gBG?>><?=$mRo[1]?></td> 
            <td width="55" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:center <?=$Wrn?>" <?=$gBG?>><?=$mRo[2]?></td> 
            <td width="65" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:center <?=$Wrn?>" <?=$gBG?>><?=$mRo[3]?></td> 
            <td width="570" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; padding-left:3px <?=$Wrn?>" <?=$gBG?>><?=$mRo[4]?></td> 
            <td width="90" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:right; padding-right:3px <?=$Wrn?>" <?=$gBG?>><?=fConvertToRupiah($mRo[5])?></td>
            <td width="90" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:right; padding-right:3px <?=$Wrn?>" <?=$gBG?>><?=fConvertToRupiah($mRo[6])?></td>
            <td width="60" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:center" <?=$gBG?>>
			<input name="fInduk<?=$IdR?>" id="fInduk<?=$IdR?>" type="radio" value="Y" <?=$YeS?> <? if ($ExT=='Y'){echo 'disabled';}?> onclick="IndKDP('kdpt','<?=$IdR?>','<?=$IdT?>','<?=$IdL?>'); return false;" />
            </td>
            <td style="border-bottom:1px dotted #999; text-align:center" <?=$gBG?>> 
			<a href="#" class="ico <?=$ico?>" onclick="RemKDP('kdpt','<?=$IdR?>','<?=$IdT?>','<?=$ExT?>','<?=$IdL?>'); ">&nbsp;del</a></td> 
          </tr> 
          <? 
        $iG++; 
		$tRo5 = $tRo5+$mRo5;
		$tRo6 = $tRo6+$mRo6;
    }
	#echo $tRo6;
	if ($ExT=='Y')
	{
		
		$UpbPost = substr(fGlobalNEW("Kd_UPB","ta_kib_kdptoaset","IDT",$IdT,"=","",DatabaseSB,$ConSB,""),0,11);
		$RefPost = fGlobalNEW("KeReferensi","ta_kib_kdptoaset","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
		#echo $UpbPost.":".$RefPost;
		$SW = "UPDATE ta_kib_108 SET Harga='".$tRo6."', Nilai_Akhir='".$tRo6."' WHERE Referensi='".$RefPost."' AND Kd_UPB LIKE '".$UpbPost."%'";
		mysql_query($SW); 
		#echo $SW."<br>";
		
		$SW = "UPDATE ta_kib_post_108 SET Debet='".$tRo6."' WHERE Referensi='".$RefPost."' AND Kd_UPB LIKE '".$UpbPost."%'";
		mysql_query($SW); 
		#echo $SW."<br>";
	}
    ?> 
  <tr height="100%">  
    <td colspan="9" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:center">&nbsp;&nbsp;<? if ($iG==1){echo "Data tidak ditemukan..!";}?></td> 
  </tr> 
</table>
