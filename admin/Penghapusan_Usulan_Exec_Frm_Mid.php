<?php
require('Connection.php');
require('FileFunction.php');
require('CheckLogin.php');
extract($_GET);

$FnD = str_replace('**',' ',$gFnD);
$CrT = "";
if ($FnD)
{
	$CrT ="AND (P1.Ref_Aset LIKE '%$FnD%' OR P1.Nm_Aset LIKE '%$FnD%' OR P1.Kd_Aset LIKE '%$FnD%' OR P1.No_Register LIKE '%$FnD%')";
}

$RefU = "";
$JenS = "";
$rGD = fGlobal("Referensi:Jenis","ta_usulan_108","IDT",$IdT,"=","","");
if ($rGD){
	$rGD = explode(":",$rGD);
	$RefU = $rGD[0];
	$JenS = $rGD[1];
}
?>
<body>
<table border="0" class="table-link" cellspacing="0" cellpadding="0" align="center" style="width:1080px; height:380px">
  <tr>
    <td>
	<table align="center" border="0" width="100%" class="table-list" cellspacing="0" cellpadding="0" height="100%" style="border:0px">
	<tr height="25" style="font-size:8pt; font-weight:bold; text-align:center; background-color: #ABD6CD">
	  <td style="border-right: 1px solid #ccc; border-bottom: 1px solid #ccc">NO</td>
	  <td style="border-right: 1px solid #ccc; border-bottom: 1px solid #ccc">REFERENSI</td>
	  <td style="border-right: 1px solid #ccc; border-bottom: 1px solid #ccc">REF. ASET</td>
	  <td style="border-right: 1px solid #ccc; border-bottom: 1px solid #ccc">KODE ASET</td>
	  <td style="border-right: 1px solid #ccc; border-bottom: 1px solid #ccc">REGISTER</td>
	  <td style="border-right: 1px solid #ccc; border-bottom: 1px solid #ccc">DESKRIPSI<!--div id="loadingImg" style="width:40px; height:10px; display:none; text-align:center"><img src="images/loading3.gif" alt="" width="30" height="30"></div--></td>
	  <td style="border-right: 1px solid #ccc; border-bottom: 1px solid #ccc">NILAI</td>
	  <td style="border-right: 1px solid #ccc; border-bottom: 1px solid #ccc">VERIFIKASI</td>
	  <td style="border-right: 1px solid #ccc; border-bottom: 1px solid #ccc">TGL. MUTASI </td>
	  <td style="border-right: 0px solid #ccc; border-bottom: 1px solid #ccc">ACTION</td>
	</tr>
	<?php
	$iG=$PgE+1;
	$SQ = "SELECT P1.IDT as A0, 
	P1.Ref_Usulan as A1, 
	P1.Ref_Aset as A2, 
	P1.Kd_Aset as A3, 
	P1.No_Register as A4, 
	P1.Nm_Aset as A5, 
	P1.Tgl_Perolehan as A6, 
	P1.Kd_Rinci as A7, 
	P1.Harga as A8, 
	P1.Verifikasi as A9, 
	P1.Eksekusi as A10, 
	P2.Jenis as A11, 
	P1.To_Kd_Aset as A12, 
	P1.Kd_UPB as A13, 
	P1.To_UPB as A14, 
	P1.Mutasi_Tanggal as A15, 
	P1.Recorded as A16, 
	P1.Pencatat as A17, 
	P1.Kib_From as A18, 
	P1.Kib_To as A19 
	FROM ta_usulan_verifikasi_rinci_108 P1 
	LEFT JOIN ta_usulan_verifikasi_108 P2 ON P2.Referensi=P1.Referensi 
	WHERE P1.Ref_Usulan='$RefU' $CrT ORDER BY P1.IDT LIMIT $PgE,500";
	#echo $SQ;
	$Rs = mysql_query($SQ);
	while ($nRo = mysql_fetch_array($Rs, MYSQL_BOTH))
	{
		$tID = $nRo[0];
		$tRA = $nRo[2];
		$tJN = $nRo[11];
		$tRE = $nRo[16];
		$tPC = $nRo[17];
		if ($tPC){
			$tPC=explode(":",$tPC);
			$tPC=$tPC[0];
		}
		
		$KdAsA = (int)substr($nRo[3],0,2);
		$KdAsB = (int)substr($nRo[12],0,2);
		if ($KdAsA==""){
			$KdAsA = (int)substr($nRo[18],0,2);
		}
		if ($KdAsB==""){
			$KdAsB = (int)substr($nRo[19],0,2);
		}
		
		$tUP = substr($nRo[13],0,11);
		$tUT = substr($nRo[14],0,11);
		$tUTa= $nRo[14];
		$CnR = "";
		$ReM = "NO";
		$CnT = "";
		$DeN = "NO";
		$DeM = "NO";
		$Txt = "";
		$CeKA= "CeK";
		$CeKB= "CeK";
		$CeKC= "CeK";
		$CeKD= "CeK";
		
		$mUT="";
		if ($tUT!=""){
			$mUT = fGlobal("Nm_Unit","ref_unit","Kd_Unit",$tUT,"=","","");
			$mUT.= "<br>".$tUTa." ".fGlobal("Nm_UPB","ref_upb","Kd_UPB",$tUTa,"=","","");
		}
		if ($mUT){
			$mUT="<br><i>Mutasi ke :<br>".$tUT." ".$mUT."</i>";
		}
		
		$tTB = fNmHuruf((int)substr($nRo[3],0,2));
		$TxtA = "";
		$TxtB = "";
		$TxtC = "";
		$TxtD = "";
		$gBG  = fBackCLR($iG);
		$WrM="";
		if ($nRo[10]=='Belum')
		{
			$eRnP = fGlobal("count(*)","ta_kib_post_108","Referensi:Kd_UPB:No_Register",$tRA.":".$tUP."%:".$nRo[4],"=:LIKE:=","","");
			if ($eRnP==0)
			{
				$CnR="; color:#ff0000";
				$ReM="YA";
				$DeN="YA";
			}
		}
		
		$LeNon = "";
		$ExecAll="";
		
		$tUnExe = "UnExecute";
		$Ico    = "mess";
		
		$IC="edit";
		$TL="Execute";
		$Model = "";
		
		$Err = "";
		?>
		
		<tr height="25">
		  <td <?=$gBG?> width="30" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc"><?=$iG?>.</td>
		  <td <?=$gBG?> width="110" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc <?=$CnR?>"><?=$nRo[1]?></td>
		  <td <?=$gBG?> width="100" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc"><?=$nRo[2]?></td>
		  <td <?=$gBG?> width="100" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc <?=$Err?>"><?=$nRo[3]?><?php if ($tJN=="MK") {if ($nRo[12]) {echo "<br>".$nRo[12];} else {echo "<br><font style='color:#ff0000'>Rek tujuan...??</font>";}}?></td>
		  <td <?=$gBG?> width="50" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc"><?=$nRo[4]?></td>
		  <td <?=$gBG?> style="border-bottom: 1px dotted #999; border-right: 1px solid #ccc; padding-left:2px"><?=$nRo[5].$mUT.$CnT?></td>
		  <td <?=$gBG?> width="90" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc; text-align:right"><?=fConvertToRupiahBulat($nRo[8])?></td>
		  <td width="80" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc; font-size:8pt; color:#FF0000" <?=$gBG?>><?=strtoupper($nRo[9])?></td>
		  <td width="60" style="text-align:center; border-bottom: 1px dotted #999; border-right: 1px solid #ccc; font-size:8pt" <?=$gBG?>><?php if ($nRo[15]!="0000-00-00"){echo fConvertDateShort($nRo[15]);}?></td>
		  <td <?=$gBG?> width="160" style="border-bottom: 1px dotted #999; text-align:center">
		  <?php
		  if ($JenS=='PH'){
		  if ($nRo[10]=='Sudah'){?>
			  <a href="#" onClick="unexecFORM('<?=$DeM?>','<?=$WrM?>','<?=$Model?>','<?=$PgE?>','<?=$tID?>','<?=$IdT?>','<?=$IdL?>'); return false;" class="ico <?=$Ico?>">&nbsp;<?=$tUnExe?></a>
		  <?php } else {?>
			  <a href="#" onClick="execFORM('<?=$LeNon?>','<?=$DeN?>','<?=$PgE?>','<?=$nRo[3]?>','<?=$JenS?>','<?=$tTB?>','<?=$TL?>','<?=$nRo[9]?>','<?=$tID?>','<?=$IdT?>','<?=$IdL?>'); return false;" class="ico <?=$IC?>">&nbsp;<?=$TL?></a>
		  <?php } }?>
		  </td>
		</tr>
		<?php
		$iG++;
	}
	?>
	<tr height="100%">
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td style="border-right: 1px solid #ccc">&nbsp;</td>
	  <td align="center">
	  <?php if ($UID=='creator'){?>
	  <a href="#" onClick="execFORM_All('Execute','<?=$ExecAll?>','<?=$RefU?>','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>'); return false" class="ico mess">
	  <!--a href="#" onClick="alert('Fasilitas ini sementara ditutup..!');return false" class="ico mess"-->
	  &nbsp;Execute All (page : <?php if ($PgE==0){echo $PgE+1;} else {echo ($PgE/500)+1;} ?>)</a>
	  <br>
	  <a href="#" onClick="execFORM_All('UnExecute','<?=$ExecAll?>','<?=$RefU?>','<?=$PgE?>','<?=$IdT?>','<?=$IdL?>'); return false" class="ico mess">
	  <!--a href="#" onClick="alert('Fasilitas ini sementara ditutup..!');return false" class="ico mess"-->
	  &nbsp;UnExecute All (page : <?php if ($PgE==0){echo $PgE+1;} else {echo ($PgE/500)+1;} ?>)</a>
	  <?php } ?>
	  </td>
	</tr>
	</table>
	</td>
  </tr>
</table>
</body>	