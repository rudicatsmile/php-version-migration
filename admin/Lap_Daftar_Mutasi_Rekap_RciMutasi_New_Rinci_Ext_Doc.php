	<?php
	require "Connection.php";
	require "FileFunction.php";
	extract($_GET);
	//Unt,Thn,ReK
	$tTb=fNmHuruf((int)substr($ReK,0,2));
	#$Col[6] = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post","Kd_Aset:Tanggal:Tgl_Mutasi:Kd_UPB:extracom",$KdAsT."%:".$mThn."-12-31:".$mThn."-12-31:".$mUpb.":".$LoadExtrac,"LIKE:<=:<=:LIKE:LIKE","","");
	
	?>
	<table border="1" align="center" width="1050" cellspacing="1" style="font-family: calibri; font-size: 9pt; border-collapse: collapse" bordercolor="#000000">
	<tr height="40" style="font-weight:bold">
	  <td colspan="9" style="padding-left:10px; font-size:12pt">SALDO AWAL KIB ( <?=$Thn?> )</td>
	</tr>
	<tr style="text-align:center; font-weight:bold">
		<td width="25">NO</td>
		<td width="90">REFERENSI</td>
		<td width="85">KD ASET</td>
		<td>NAMA ASET</td>
		<td width="70">TANGGAL<br>PEROLEHAN</td>
		<td width="100">NILAI<br>PEROLEHAN</td>
		<td width="100">NILAI<br>AKHIR</td>
		<td width="90" style="text-decoration:underline">+</td>
		<td width="100">NILAI<br>MUTASI</td>
	</tr>
	<?php
	$iG=1;
	$tRo4 = 0;
	$tRo5 = 0;
	$tRo6 = 0;
	$nSQL="SELECT P1.Referensi, P1.Kd_Aset, P2.Nm_Aset, P2.Tgl_Perolehan, P2.Harga, IfNull(sum(P1.Debet),0) as JmlD, P2.Ref_Mutasi, P2.Tgl_Mutasi 
	FROM ta_kib_post P1 
	LEFT JOIN ta_kib_$tTb P2 ON P2.Referensi=P1.Referensi AND P2.extracom=P1.extracom 
	WHERE P1.Kd_UPB LIKE '".$Unt."%' AND P1.Kd_Aset LIKE '".$ReK."%' AND P1.Tanggal <= '".($Thn-1)."-12-31' AND P1.Tgl_Mutasi <='".($Thn-1)."-12-31' AND P1.extracom ='N' GROUP BY P1.Referensi ORDER BY P2.Tgl_Perolehan";
	#echo $nSQL;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
	$mRo6 = $mRo[5]-$mRo[4];
	
	$mRo2=$mRo[2];
	$mRoM = 0;
	$xC="";
	if ($mRo[6]!=""){
		$mRo2 = $mRo[2]."<br>-->&nbsp;<font style='background:#c0c0c0; color:#000'><i>&nbsp;Mutasi Masuk ".$mRo[6].", Tgl. ".fConvertDateShort($mRo[7])."&nbsp;</i></font>";
		$mRoM = fGlobal("IfNull(sum(debet),0)", "ta_kib_post_mutasi","Kd_UPB_To:Kd_Aset_To:Referensi_To",substr($Unt,0,11)."%:".$mRo[1].":".$mRo[0],"LIKE:=:=","","");
		if ($mRoM>$mRo[5]){
			$xC="; color:#ff0000";
		}
		else if ($mRoM<$mRo[5]){
			$xC="; color:#0000ff";
		}
	}
	?>
	<tr height="19" style="vertical-align:top">
	  <td style="text-align:center"><?=$iG?>.</td>
	  <td style="text-align:center"><?=$mRo[0]?></td>
	  <td style="text-align:center"><?=$mRo[1]?></td>
	  <td style="padding-left:3px"><?=$mRo2?></td>
	  <td style="text-align:center"><?=fConvertDateShort($mRo[3])?></td>
	  <td style="text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[4])?></td>
	  <td style="text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[5])?></td>
	  <td style="text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo6)?></td>
	  <td style="text-align:right; padding-right:3px <?=$xC?>"><?=fConvertToRupiah($mRoM)?></td>
	</tr>
	<?php
	$iG++;
	$tRo4 = $tRo4+$mRo[4];
	$tRo5 = $tRo5+$mRo[5];
	$tRo6 = $tRo6+$mRo6;
	}
	$tRoM = fGlobal("IfNull(sum(saldoAkhir),0)", "ta_kib_post_saldo_mutasi","Kd_Unit:Kd_Aset:Tahun",substr($Unt,0,11).":".$ReK.":".$Thn,"=:=:=","","");
	$tRo7 = $tRo5-$tRoM;
	$rCL="";
	if ($tRo7>0){
		$rCL="; color:#FF0000";
	}
	?>
	<tr height="24">
	  <td style="text-align:left; font-weight:bold; padding-left:200px" colspan="5">SALDO AWAL KIB ==================================== ></td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px"><?=fConvertToRupiah($tRo4)?></td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px"><?=fConvertToRupiah($tRo5)?></td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px"><?=fConvertToRupiah($tRo6)?></td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px">&nbsp;</td>
	</tr>
	</table>
	<br>
	<table border="1" align="center" width="1050" cellspacing="1" style="font-family: calibri; font-size: 9pt; border-collapse: collapse" bordercolor="#000000">
	<tr height="40" style="font-weight:bold">
	  <td colspan="9" style="padding-left:10px; font-size:12pt">MUTASI KELUAR ( <?=$Thn?> )</td>
	</tr>
	<tr style="text-align:center; font-weight:bold">
		<td width="25">NO</td>
		<td width="90">REFERENSI</td>
		<td width="85">KD ASET</td>
		<td>NAMA ASET</td>
		<td width="70">TANGGAL<br>PEROLEHAN</td>
		<td width="100">NILAI<br>PEROLEHAN</td>
		<td width="100">NILAI<br>AKHIR</td>
		<td width="90" style="text-decoration:underline">+</td>
		<td width="100">NILAI<br>MUTASI</td>
	</tr>
	<?php
	$iG=1;
	$tRo4 = 0;
	$tRo5 = 0;
	$tRo6 = 0;
	#$Col[6] = $Col[6] + fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_mutasi","Kd_Aset:Tanggal:Tgl_Mutasi:Tgl_Mutasi:Kd_UPB:extracom",$KdAsT."%:".$mThn."-12-31:".$nThn."-01-01:".($nThn+1)."-12-31:".$mUpb.":".$LoadExtrac,"LIKE:<=:>=:<=:LIKE:LIKE","","");
	if ($Thn<=2016){
		$nSQL="SELECT P1.Referensi, P1.Kd_Aset, P2.Nm_Aset, P2.Tgl_Perolehan, P2.Harga, IfNull(sum(P1.Debet),0) as JmlD, P2.Referensi_To, P2.Tgl_Mutasi, P2.Kd_UPB_To, P2.Kd_Aset_To 
		FROM ta_kib_post_mutasi P1 
		LEFT JOIN ta_kib_".$tTb."_mutasi P2 ON P2.Referensi=P1.Referensi AND P2.extracom=P1.extracom AND P2.Kd_UPB=P1.Kd_UPB 
		WHERE P1.Kd_UPB LIKE '".$Unt."%' AND P1.Kd_Aset LIKE '".$ReK."%' AND P1.Tanggal <= '".$Thn."-12-31' AND P1.Tgl_Mutasi>='".$Thn."-01-01' AND P1.Tgl_Mutasi<='".($Thn+1)."-12-31' AND P1.extracom ='N' GROUP BY P1.Referensi, P1.Kd_UPB ORDER BY P2.Tgl_Perolehan";
	}
	else{
		$nSQL="SELECT P1.Referensi, P1.Kd_Aset, P2.Nm_Aset, P2.Tgl_Perolehan, P2.Harga, IfNull(sum(P1.Debet),0) as JmlD, P2.Referensi_To, P2.Tgl_Mutasi, P2.Kd_UPB_To, P2.Kd_Aset_To 
		FROM ta_kib_post_mutasi P1 
		LEFT JOIN ta_kib_".$tTb."_mutasi P2 ON P2.Referensi=P1.Referensi AND P2.extracom=P1.extracom AND P2.Kd_UPB=P1.Kd_UPB 
		WHERE P1.Kd_UPB LIKE '".$Unt."%' AND P1.Kd_Aset LIKE '".$ReK."%' AND P1.Tanggal <= '".$Thn."-12-31' AND P1.extracom ='N' GROUP BY P1.Referensi, P1.Kd_UPB ORDER BY P2.Tgl_Perolehan";
	}
	#echo $nSQL;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
	$mRo6 = $mRo[5]-$mRo[4];
	
	$mRo2=$mRo[2];
	$mRoM = 0;
	$xC="";
	$mRo2 = $mRo[2]."<br>-->&nbsp;<font style='background:#c0c0c0; color:#000'><i>&nbsp;Mutasi Keluar ".$mRo[6].", Tgl. ".fConvertDateShort($mRo[7])."&nbsp;</i></font>";
	$mRoM = fGlobal("IfNull(sum(debet),0)", "ta_kib_post_mutasi","Kd_UPB:Kd_Aset:Referensi",substr($Unt,0,11)."%:".$mRo[1].":".$mRo[0],"LIKE:=:=","","");
	if ($mRoM>$mRo[5]){
		$xC="; color:#ff0000";
	}
	else if ($mRoM<$mRo[5]){
		$xC="; color:#0000ff";
	}
	?>
	<tr height="19" style="vertical-align:top">
	  <td style="text-align:center"><?=$iG?>.</td>
	  <td style="text-align:center"><?=$mRo[0]?></td>
	  <td style="text-align:center"><?=$mRo[1]?></td>
	  <td style="padding-left:3px"><?=$mRo2?></td>
	  <td style="text-align:center"><?=fConvertDateShort($mRo[3])?></td>
	  <td style="text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[4])?></td>
	  <td style="text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[5])?></td>
	  <td style="text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo6)?></td>
	  <td style="text-align:right; padding-right:3px <?=$xC?>"><?=fConvertToRupiah($mRoM)?></td>
	</tr>
	<?php
	$iG++;
	$tRo4 = $tRo4+$mRo[4];
	$tRo5 = $tRo5+$mRo[5];
	$tRo6 = $tRo6+$mRo6;
	}
	$tRoM = fGlobal("IfNull(sum(saldoAkhir),0)", "ta_kib_post_saldo_mutasi","Kd_Unit:Kd_Aset:Tahun",substr($Unt,0,11).":".$ReK.":".$Thn,"=:=:=","","");
	$tRo7 = $tRo5-$tRoM;
	$rCL="";
	if ($tRo7>0){
		$rCL="; color:#FF0000";
	}
	?>
	<tr height="24">
	  <td style="text-align:left; font-weight:bold; padding-left:200px" colspan="5">NILAI MUTASI KELUAR  ==================================== ></td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px"><?=fConvertToRupiah($tRo4)?></td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px"><?=fConvertToRupiah($tRo5)?></td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px"><?=fConvertToRupiah($tRo6)?></td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px">&nbsp;</td>
	</tr>
	</table>
	<br>
	<table border="1" align="center" width="1050" cellspacing="1" style="font-family: calibri; font-size: 9pt; border-collapse: collapse" bordercolor="#000000">
	<tr height="40" style="font-weight:bold">
	  <td colspan="9" style="padding-left:10px; font-size:12pt">MUTASI MASUK</td>
	</tr>
	<tr style="text-align:center; font-weight:bold">
		<td width="25">NO</td>
		<td width="90">REFERENSI</td>
		<td width="85">KD ASET</td>
		<td>NAMA ASET</td>
		<td width="70">TANGGAL<br>PEROLEHAN</td>
		<td width="100">NILAI<br>PEROLEHAN</td>
		<td width="100">NILAI<br>AKHIR</td>
		<td width="90" style="text-decoration:underline">+</td>
		<td width="100">NILAI<br>MUTASI</td>
	</tr>
	<?php
	$iG=1;
	$tRo4 = 0;
	$tRo5 = 0;
	$tRo6 = 0;
	if ($Thn<=2016){
		$nSQL="SELECT P1.Referensi, P1.Kd_Aset, P2.Nm_Aset, P2.Tgl_Perolehan, P2.Harga, IfNull(sum(P1.Debet),0) as JmlD, P2.Referensi_To, P2.Tgl_Mutasi, P2.Kd_UPB_To, P2.Kd_Aset_To 
		FROM ta_kib_post_mutasi P1 
		LEFT JOIN ta_kib_".$tTb."_mutasi P2 ON P2.Referensi=P1.Referensi AND P2.extracom=P1.extracom AND P2.Kd_UPB=P1.Kd_UPB 
		WHERE P1.Kd_UPB_To LIKE '".$Unt."%' AND P1.Kd_Aset LIKE '".$ReK."%' AND P1.Tanggal <= '".$Thn."-12-31' AND P1.Tgl_Mutasi>='".$Thn."-01-01' AND P1.Tgl_Mutasi<='".($Thn+1)."-12-31' AND P1.extracom ='N' GROUP BY P1.Referensi, P1.Kd_UPB ORDER BY P2.Tgl_Perolehan";
	}
	else{
		$nSQL="SELECT P1.Referensi, P1.Kd_Aset, P2.Nm_Aset, P2.Tgl_Perolehan, P2.Harga, IfNull(sum(P1.Debet),0) as JmlD, P2.Referensi_To, P2.Tgl_Mutasi, P2.Kd_UPB_To, P2.Kd_Aset_To 
		FROM ta_kib_post_mutasi P1 
		LEFT JOIN ta_kib_".$tTb."_mutasi P2 ON P2.Referensi=P1.Referensi AND P2.extracom=P1.extracom AND P2.Kd_UPB=P1.Kd_UPB 
		WHERE P1.Kd_UPB_To LIKE '".$Unt."%' AND P1.Kd_Aset LIKE '".$ReK."%' AND P1.Tanggal <= '".$Thn."-12-31' AND P1.extracom ='N' GROUP BY P1.Referensi, P1.Kd_UPB ORDER BY P2.Tgl_Perolehan";
	}
	#echo $nSQL;
	$nRs = mysql_query($nSQL) or die(mysql_error());
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
	$mRo6 = $mRo[5]-$mRo[4];
	
	$mRo2=$mRo[2];
	$mRoM = 0;
	$xC="";
	$mRo2 = $mRo[2]."<br>-->&nbsp;<font style='background:#c0c0c0; color:#000'><i>&nbsp;Mutasi Keluar ".$mRo[6].", Tgl. ".fConvertDateShort($mRo[7])."&nbsp;</i></font>";
	$mRoM = fGlobal("IfNull(sum(debet),0)", "ta_kib_post_mutasi","Kd_UPB_To:Kd_Aset_To:Referensi_To",substr($Unt,0,11)."%:".$mRo[9].":".$mRo[6],"LIKE:=:=","","");
	if ($mRoM>$mRo[5]){
		$xC="; color:#ff0000";
	}
	else if ($mRoM<$mRo[5]){
		$xC="; color:#0000ff";
	}
	?>
	<tr height="19" style="vertical-align:top">
	  <td style="text-align:center"><?=$iG?>.</td>
	  <td style="text-align:center"><?=$mRo[0]?></td>
	  <td style="text-align:center"><?=$mRo[1]?></td>
	  <td style="padding-left:3px"><?=$mRo2?></td>
	  <td style="text-align:center"><?=fConvertDateShort($mRo[3])?></td>
	  <td style="text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[4])?></td>
	  <td style="text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[5])?></td>
	  <td style="text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo6)?></td>
	  <td style="text-align:right; padding-right:3px <?=$xC?>"><?=fConvertToRupiah($mRoM)?></td>
	</tr>
	<?php
	$iG++;
	$tRo4 = $tRo4+$mRo[4];
	$tRo5 = $tRo5+$mRo[5];
	$tRo6 = $tRo6+$mRo6;
	}
	$tRoM = fGlobal("IfNull(sum(saldoAkhir),0)", "ta_kib_post_saldo_mutasi","Kd_Unit:Kd_Aset:Tahun",substr($Unt,0,11).":".$ReK.":".$Thn,"=:=:=","","");
	$tRo7 = $tRo5-$tRoM;
	$rCL="";
	if ($tRo7>0){
		$rCL="; color:#FF0000";
	}
	?>
	<tr height="24">
	  <td style="text-align:left; font-weight:bold; padding-left:200px" colspan="5">NILAI MUTASI KELUAR  ==================================== ></td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px"><?=fConvertToRupiah($tRo4)?></td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px"><?=fConvertToRupiah($tRo5)?></td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px"><?=fConvertToRupiah($tRo6)?></td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px">&nbsp;</td>
	</tr>
	</table>
	<br>
	<table border="1" align="center" width="1050" cellspacing="1" style="font-family: calibri; font-size: 9pt; border-collapse: collapse" bordercolor="#000000">
	<tr height="40" style="font-weight:bold">
	  <td colspan="9" style="padding-left:10px; font-size:12pt">SALDO AKHIR KIB ( <?=$Thn?> )</td>
	</tr>
	<tr style="text-align:center; font-weight:bold">
		<td width="25">NO</td>
		<td width="90">REFERENSI</td>
		<td width="85">KD ASET</td>
		<td>NAMA ASET</td>
		<td width="70">TANGGAL<br>PEROLEHAN</td>
		<td width="100">NILAI<br>PEROLEHAN</td>
		<td width="100">NILAI<br>AKHIR</td>
		<td width="90" style="text-decoration:underline">+</td>
		<td width="100">NILAI<br>MUTASI</td>
	</tr>
	<?php
	$iG=1;
	$tRo4 = 0;
	$tRo5 = 0;
	$tRo6 = 0;
	$nSQL="SELECT P1.Referensi, P1.Kd_Aset, P2.Nm_Aset, P2.Tgl_Perolehan, P2.Harga, IfNull(sum(P1.Debet),0) as JmlD, P2.Ref_Mutasi, P2.Tgl_Mutasi 
	FROM ta_kib_post P1 
	LEFT JOIN ta_kib_$tTb P2 ON P2.Referensi=P1.Referensi AND P2.extracom=P1.extracom  AND P2.Ref_Mutasi=P1.Ref_Mutasi 
	WHERE P1.Kd_UPB LIKE '".$Unt."%' AND P1.Kd_Aset LIKE '".$ReK."%' AND P1.Tanggal <= '".$Thn."-12-31' AND P1.extracom ='N' GROUP BY P1.Referensi ORDER BY P2.Tgl_Perolehan";
	$nRs = mysql_query($nSQL) or die(mysql_error());
	while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
	{
	$mRo6 = $mRo[5]-$mRo[4];
	
	$mRo2=$mRo[2];
	$mRoM = 0;
	$xC="";
	if ($mRo[6]!=""){
		$mRo2 = $mRo[2]."<br>-->&nbsp;<font style='background:#c0c0c0; color:#000'><i>&nbsp;Mutasi Masuk ".$mRo[6].", Tgl. ".fConvertDateShort($mRo[7])."&nbsp;</i></font>";
		$mRoM = fGlobal("IfNull(sum(debet),0)", "ta_kib_post_mutasi","Kd_UPB_To:Kd_Aset_To:Referensi_To",substr($Unt,0,11)."%:".$mRo[1].":".$mRo[0],"LIKE:=:=","","");
		if ($mRoM>$mRo[5]){
			$xC="; color:#ff0000";
		}
		else if ($mRoM<$mRo[5]){
			$xC="; color:#0000ff";
		}
	}
	?>
	<tr height="19" style="vertical-align:top">
	  <td style="text-align:center"><?=$iG?>.</td>
	  <td style="text-align:center"><?=$mRo[0]?></td>
	  <td style="text-align:center"><?=$mRo[1]?></td>
	  <td style="padding-left:3px"><?=$mRo2?></td>
	  <td style="text-align:center"><?=fConvertDateShort($mRo[3])?></td>
	  <td style="text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[4])?></td>
	  <td style="text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo[5])?></td>
	  <td style="text-align:right; padding-right:3px"><?=fConvertToRupiah($mRo6)?></td>
	  <td style="text-align:right; padding-right:3px <?=$xC?>"><?=fConvertToRupiah($mRoM)?></td>
	</tr>
	<?php
	$iG++;
	$tRo4 = $tRo4+$mRo[4];
	$tRo5 = $tRo5+$mRo[5];
	$tRo6 = $tRo6+$mRo6;
	}
	$tRoM = fGlobal("IfNull(sum(saldoAkhir),0)", "ta_kib_post_saldo_mutasi","Kd_Unit:Kd_Aset:Tahun",substr($Unt,0,11).":".$ReK.":".$Thn,"=:=:=","","");
	$tRo7 = $tRo5-$tRoM;
	$rCL="";
	if ($tRo7>0){
		$rCL="; color:#FF0000";
	}
	?>
	<tr height="24">
	  <td style="text-align:left; font-weight:bold; padding-left:200px" colspan="5">SALDO AKHIR KIB ==================================== ></td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px"><?=fConvertToRupiah($tRo4)?></td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px"><?=fConvertToRupiah($tRo5)?></td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px"><?=fConvertToRupiah($tRo6)?></td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px">&nbsp;</td>
	</tr>
	<tr height="24">
	  <td style="text-align:left; font-weight:bold; padding-left:200px" colspan="5">SALDO DOK MUTASI ================================== ></td>
	  <td colspan="2" style="text-align:right; font-weight:bold; padding-right:3px"><?=fConvertToRupiah($tRoM)?></td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px <?=$rCL?>"><?=fConvertToRupiah($tRo7)?></td>
	  <td style="text-align:right; font-weight:bold; padding-right:3px <?=$rCL?>">&nbsp;</td>
	</tr>
	</table>
	<br>