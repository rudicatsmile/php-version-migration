<?php
require('Connection.php');
require('FileFunction.php');
require("CheckLogin.php");
extract($_GET);

$SY = "";
$LmT = "LIMIT 0,500";
if ($ThN!='')
{
	$SY="AND P1.Tanggal LIKE '".$ThN."-%-%'";
	$LmT = "";
}

$FnD = str_replace('**',' ',$FnD);
?>

<table align="center" class="table-list" cellpadding="0" cellspacing="0" width="100%" height="100%" border="0" style="border:0px"> 
  <?php 
    if ($FnD)  
    { 
		$SyT = "AND (P1.Referensi LIKE '%$FnD%' OR P1.Nomor LIKE '%$FnD%' OR P1.Uraian LIKE '%$FnD%' OR P1.KeReferensi LIKE '%$FnD%')";
    } 
    else 
    { 
        $SyT = ""; 
        
    } 
     
    $iG=1;
	$tBNG = 0;
	$tJLN = 0;
	$tALT = 0;
	
	$nSQ = "SELECT P1.IDT as A0, 
	P2.Nm_UPB as A1,
	P3.Nm_Aset as A2,	
	P1.Referensi as A3,
	P1.Nomor as A4,
	P1.Tanggal as A5,
	P1.Uraian as A6,
	P1.Execute as A7,
	P1.KeReferensi as A8,
	P1.Kd_REK as A9 
	FROM ta_kib_kdptoaset P1 
	LEFT JOIN ref_upb P2 ON P2.Kd_UPB=P1.Kd_UPB 
	LEFT JOIN ref_rek_aset108_7 P3 ON P3.Kd_Aset=P1.Kd_REK 
	WHERE P1.Kd_UPB LIKE '".$SkP."%' $SyT $SY GROUP BY P1.Referensi ORDER BY P1.Referensi DESC, P1.Execute $LmT";
	#echo $nSQ;
	$nRs = mysql_query($nSQ); 
	while ($mRo = mysql_fetch_array($nRs)) 
	{ 
		$IdT = $mRo[0]; 
		$gBG = fBackCLR($iG);
		
		$ExT = $mRo[7]; 
		$LRe = substr($mRo[8],0,3); 
		$RKK = $mRo[9]; 
		
		$xL = "0000ff";
		$bn = "";
		if ($LRe!='')
		{
			if ($RKK=='1.3.6.01.01.01.001' && $LRe!='TNH'){$xL="ff0000"; $bn="<font style='color:#ff0000'>#</font>";}
			if ($RKK=='1.3.6.01.01.01.002' && $LRe!='ALT'){$xL="ff0000"; $bn="<font style='color:#ff0000'>#</font>";}
			if ($RKK=='1.3.6.01.01.01.003' && $LRe!='BNG'){$xL="ff0000"; $bn="<font style='color:#ff0000'>#</font>";}
			if ($RKK=='1.3.6.01.01.01.004' && $LRe!='JLN'){$xL="ff0000"; $bn="<font style='color:#ff0000'>#</font>";}
		}
		
		$del = "del";
		if ($ExT=='Y')
		{
			$del = "delt";
		}
		$mRo7 = fGlobalNEW("ifNull(sum(Nilai),0)","ta_kib_kdptoaset_data","Referensi",$mRo[3],"=","",DatabaseSB,$ConSB,"");
		$mRo8 = fGlobalNEW("ifNull(sum(Nilai),0)","ta_kib_kdptoaset_data_post","Referensi",$mRo[3],"=","",DatabaseSB,$ConSB,"");
		$PosT = fGlobalNEW("ifNull(sum(Debet),0)","ta_kib_post_108","Ref_KdpToAset:Kd_UPB",$mRo[3].":".$SkP."%","=:LIKE","",DatabaseSB,$ConSB,"");
		
		if ($PosT!=$mRo8){$xL="ff0000"; $bn="<font style='color:#0000ff'>**</font>";}
		
		$Sto = "";
		$ReG = fGlobalNEW("Referensi:No_Register:Tgl_Perolehan:Kd_Aset_108","ta_kib_108","Ref_KdpToAset",$mRo[3],"=","",DatabaseSB,$ConSB,"");
		if ($ReG)
		{
			$ReG = explode(':',$ReG);
			$Ref = $ReG[0];
			$Nor = $ReG[1];
			$Tgl = $ReG[2];
			$Kda = $ReG[3];
			$Sto = "<br><font style='color:#".$xL."'>Referensi -> ".$Ref;
			$Sto.= "<br>No. Register -> ".$Nor;
			$Sto.= "<br>Tgl. Perolehan -> ".$Tgl;
			$Sto.= "<br>Rek. Aset 108 -> ".$Kda;
			$Sto.= "<br>Nilai -> ".fConvertToRupiah($PosT);
		}
		if ($LRe=='BNG')
		{
			$tBNG = $tBNG + $mRo8;
		}
		if ($LRe=='JLN')
		{
			$tJLN = $tJLN + $mRo8;
		}
		if ($LRe=='ALT')
		{
			$tALT = $tALT + $mRo8;
		}
		?> 
          <tr height="40" style="cursor:pointer">  
            <td width="27" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:center" <?=$gBG?>><?=$iG?>.</td>
            <td width="65" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:center" <?=$gBG?>><?=$mRo[5]?></td> 
            <td width="98" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:center" <?=$gBG?>><?=$mRo[3].$bn?></td> 
            <td width="140" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:center" <?=$gBG?>><?=$mRo[4]?></td> 
            <td width="280" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; padding-left:3px" <?=$gBG?>><?="UPB : ".$mRo[1]."<br>KDP : <i><b>".$mRo[2]."</b></i>".$Sto?></td> 
            <td width="110" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:right; padding-right:3px" <?=$gBG?>><?=fConvertToRupiah($mRo7)?></td>
            <td width="110" style="border-bottom:1px dotted #999; border-right:1px solid #ccc; text-align:right; padding-right:3px" <?=$gBG?>><?=fConvertToRupiah($mRo8)?></td>
            <td style="border-bottom:1px dotted #999; text-align:center" <?=$gBG?>> 
			<a href="#" class="ico edit" onclick="showKDPTA('refr','<?=$IdT?>','kdpt','<?=$IdL?>'); globalClose('<?=$CrDiv?>MstDiv0');">edit</a>&nbsp;&nbsp;
			<a href="#" class="ico <?=$del?>" onclick="deleDATA('find','<?=$IdT?>','<?=$ExT?>','<?=$IdL?>');">del</a>			</td> 
          </tr> 
          <?php 
		  $tRo8 = $tRo8+$mRo8;
        $iG++; 
    } 
    ?> 
  <?php if ($iG>1){?>
  <tr height="30">  
    <td>&nbsp;</td> 
    <td></td> 
    <td>
	Total Ke Kib B : <br>
	Total Ke Kib C : <br>
	Total Ke Kib D :
	</td>
    <td style="text-align:right; padding-right:3px">
	<?=fConvertToRupiah($tALT)?><br>
    <?=fConvertToRupiah($tBNG)?><br>
    <?=fConvertToRupiah($tJLN)?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td> 
    <td style="text-align:right; font-weight:bold; padding-right:3px"><?=fConvertToRupiah($tRo8)?></td> 
    <td>&nbsp;</td> 
  </tr> 
  <?php } ?>
  <tr height="100%">  
    <td colspan="8" valign="top">&nbsp;&nbsp;<?php if ($iG==1){echo "Data tidak ditemukan..!";}?></td> 
  </tr> 
</table>
