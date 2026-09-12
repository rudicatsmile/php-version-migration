<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

//echo $IdT;
$UpB = fGlobalNEW("Kd_UPB","ta_kib_kdptoaset","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
$RiN = fGlobalNEW("Kd_REK","ta_kib_kdptoaset","IDT",$IdT,"=","",DatabaseSB,$ConSB,"");
$FnD = str_replace('**',' ',$FnD);
?>

<table align="center" class="table-list" cellpadding="0" cellspacing="0" width="100%" height="100%" border="0"> 
  <?php 
    if ($FnD)  
    { 
		$SyT = "AND (P1.Referensi LIKE '%$FnD%' OR P1.Keterangan LIKE '%$FnD%' OR P1.Lokasi LIKE '%$FnD%' OR P1.No_Register LIKE '%$FnD%' OR P1.Nm_Aset LIKE '%$FnD%' OR P1.Harga LIKE '%$FnD%')"; 
        $LmT = ""; 
    } 
    else 
    { 
        $SyT = ""; 
        $LmT = ""; 
    } 
     
    $iG=1;
	
	$nSQ = "SELECT P1.IDT as A0, P1.Referensi as A1, P1.No_Register as A2, 
	P1.Tgl_Perolehan as A3,
	CONCAT('<b>',P1.Nm_Aset,'</b>', '<br><i><b>Ket. :</b> ',P1.Keterangan, '<br><b>Lokasi :</b> ', P1.Lokasi) as A4,
	P1.Harga as A5, 
	sum(P2.Debet) as A6 
	FROM ta_kib_108 P1 
	LEFT JOIN ta_kib_post_108 P2 ON P2.Referensi=P1.Referensi AND P2.Kd_UPB=P1.Kd_UPB 
	WHERE P1.Kd_UPB = '".$UpB."' AND P1.Kd_Aset_108='".$RiN."' AND P1.Referensi LIKE 'KDP%' $SyT AND P1.KdpToAset='N' GROUP BY P1.Referensi ".$LmT; 
	#echo $nSQ;
	$nRs = mysql_query($nSQ); 
	while ($mRo = mysql_fetch_array($nRs)) 
	{ 
		$IdR = $mRo[0]; 
		$ReA = $mRo[1]; 
		
		$gBG = fBackCLR($iG);
		
		$Cek = fGlobalNEW("IDT","ta_kib_kdptoaset_data","Ref_Aset:Kd_UPB",$ReA.":".$UpB,"=:=","",DatabaseSB,$ConSB,"");
		if ($Cek)
		{
		
		}
		?> 
          <tr height="90" style="cursor:pointer">  
            <td width="25" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:center" <?=$gBG?>><?=$iG?>.</td>
            <td width="95" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:center" <?=$gBG?>><?=$mRo[1]?></td> 
            <td width="55" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:center" <?=$gBG?>><?=$mRo[2]?></td> 
            <td width="65" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:center" <?=$gBG?>><?=$mRo[3]?></td> 
            <td width="425" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; padding-left:3px" <?=$gBG?>><?=$mRo[4]?></td> 
            <td width="90" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:right; padding-right:3px" <?=$gBG?>><?=fConvertToRupiah($mRo[5])?></td>
            <td width="90" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:right; padding-right:3px" <?=$gBG?>><?=fConvertToRupiah($mRo[6])?></td>
            <td style="border-bottom:1px dotted #999; text-align:center" <?=$gBG?>> 
			<?php if (!$Cek) {?>
			<a href="#" class="ico add" onclick="AddKDP('kdpt','<?=$IdR?>','<?=$IdT?>','<?=$IdL?>'); globalClose('<?=$CrDiv?>MstDiv0'); ">Add</a>
			<?php } else {?>
			<img src="css/images/okey.gif">
			<?php } ?>
			</td> 
          </tr> 
          <?php 
        $iG++; 
    } 
    ?> 
  <tr height="100%">  
    <td colspan="8" valign="top">&nbsp;&nbsp;<?php if ($iG==1){echo "Data tidak ditemukan..!";}?></td> 
  </tr> 
</table>
