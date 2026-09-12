<?php
	function ViewRciObjek($KdRCI,$mUpb,$mThn,$nThn,$mG,$LoadMutasi,$UID,$LoadExtrac)
	{
		$nSQE = "SELECT P1.Kd_Aset, P2.Nm_Aset 
		FROM ref_rek_aset108_7_temp P1 
		JOIN ref_rek_aset108_7 P2 ON P2.Kd_Aset=P1.Kd_Aset 
		WHERE P1.Kd_Aset LIKE '".$KdRCI.".%' AND P1.Kd_Unit = '".substr($mUpb,0,11)."' GROUP BY P1.Kd_Aset";
		$nRsE = mysql_query($nSQE);
		while ($mRoE = mysql_fetch_array($nRsE, MYSQL_BOTH))
		{
			$xB = "";
			ClrVr();
			$KdAsT  = $mRoE['Kd_Aset'];
			$Col[1] = "";
			$Col[2] = "";
			$Col[3] = $mRoE['Kd_Aset'];
			$Col[4] = $mRoE['Nm_Aset'];
			
			#AWAL
			if ($nThn<=2026) {
				$Col[5] = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset_108:Tgl_Perolehan:Tgl_Mutasi:Kd_UPB:extracom",$KdAsT."%:".$mThn."-12-31:".$mThn."-12-31:".$mUpb."%:".$LoadExtrac,"LIKE:<=:<=:LIKE:LIKE","","");
				$Col[5] = $Col[5] + fGlobal("IfNull(count(*),0)", "ta_kib_108_mutasi","Kd_Aset_108:Tgl_Perolehan:Tgl_Mutasi:Tgl_Mutasi:Tgl_Mutasi_Masuk:Kd_UPB:extracom",$KdAsT."%:".$mThn."-12-31:".$nThn."-01-01:".($nThn+1)."-12-31:".$mThn."-12-31:".$mUpb."%:".$LoadExtrac,"LIKE:<=:>=:<=:<=:LIKE:LIKE","","");
				
				$Col[6] = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset_108:Tanggal:Tgl_Mutasi:Kd_UPB:extracom",$KdAsT."%:".$mThn."-12-31:".$mThn."-12-31:".$mUpb."%:".$LoadExtrac,"LIKE:<=:<=:LIKE:LIKE","","");
				$Col[6] = $Col[6] + fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_mutasi","Kd_Aset_108:Tanggal:Tgl_Mutasi:Tgl_Mutasi:Tgl_Mutasi_Masuk:Kd_UPB:extracom",$KdAsT."%:".$mThn."-12-31:".$nThn."-01-01:".($nThn+1)."-12-31:".$mThn."-12-31:".$mUpb."%:".$LoadExtrac,"LIKE:<=:>=:<=:<=:LIKE:LIKE","","");
			}
			else{
				$Col[5] = fGlobal("unitAkhir", "ta_kib_post_saldo_mutasi","Kd_Unit:Kd_Aset:Tahun",$mUpb.":".$KdAsT.":".$mThn,"=:=:=","","");
				$Col[6] = fGlobal("saldoAkhir", "ta_kib_post_saldo_mutasi","Kd_Unit:Kd_Aset:Tahun",$mUpb.":".$KdAsT.":".$mThn,"=:=:=","","");
			}
			
			#TAHUN BERSANGKUTAN
			if (fNmHuruf($mG)=="f"){
				# - 
				$Col[47] = ItemKurangKibF($mG,$KdAsT,$nThn,$mUpb,$LoadExtrac,"");
				$Col[48] = round(HargKurangKibF($KdAsT,$nThn,$mUpb,$LoadExtrac,""),2);
				# +
				$Col[49] = ItemTambahKibF($mG,$KdAsT,$nThn,$mUpb,$LoadExtrac,"");
				$Col[50] = round(HargTambahKibF($KdAsT,$nThn,$mUpb,$LoadExtrac,""),2);
			}
			else{
				if ($LoadMutasi=="Y"){
					#RUSAK BERAT
					$mMS="RB";
					# -
					$Col[7]  = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[8]  = round(HargKurang($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
					# +
					$Col[9]  = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[10] = round(HargTambah($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
				
					#MUTASI SKPD
					$mMS="MS";
					# -
					$Col[11] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[12] = round(HargKurang($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
					# +
					$Col[13] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[14] = round(HargTambah($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
				
					#MUJTASI KIB
					$mMS="MK";
					# - 
					$Col[15] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[16] = round(HargKurang($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
					# +
					$Col[17] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[18] = round(HargTambah($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
					
					#LELANG
					$mMS="LE";
					# - 
					$Col[19] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[20] = round(HargKurang($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
					# +
					$Col[21] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[22] = round(HargTambah($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
					
					#HIBAH
					$mMS="HB";
					# - 
					$Col[23] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[24] = round(HargKurang($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
					# +
					$Col[25] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[26] = round(HargTambah($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
					
					#RENOVASI
					$mMS="AR";
					# - 
					$Col[27] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[28] = round(HargKurang($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
					# +
					$Col[29] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[30] = round(HargTambah($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
					
					#DOBEL CATAT / KOREKSI
					$mMS="KR";
					# - 
					$Col[31] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[32] = round(HargKurang($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
					# +
					$Col[33] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[34] = round(HargTambah($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
					
					#DALAM PENELUSURAN
					$mMS="PL";
					# - 
					$Col[35] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[36] = round(HargKurang($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
					# +
					$Col[37] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[38] = round(HargTambah($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
					
					#HILANG
					$mMS="HL";
					# - 
					$Col[39] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[40] = round(HargKurang($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
					# +
					$Col[41] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[42] = round(HargTambah($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
					
					#PENGHAPUSAN
					$mMS="PH";
					# - 
					$Col[43] = ItemKurang($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[44] = round(HargKurang($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
					# +
					$Col[45] = ItemTambah($mG,$KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,"");
					$Col[46] = round(HargTambah($KdAsT,$nThn,$mUpb,$mMS,$LoadExtrac,""),2);
					
					#TAHUN BERSANGKUTAN
					# - 
					$Col[47] = 0;//ItemKurangThnN($mG,$KdAsT,$nThn,$mUpb,$LoadExtrac,"");
					$Col[48] = 0;//round(HargKurangThnN($KdAsT,$nThn,$mUpb,$LoadExtrac,""),2);
					# +
					$Col[49] = ItemTambahThnN($mG,$KdAsT,$nThn,$mUpb,$LoadExtrac,"");
					$Col[50] = round(HargTambahThnN($KdAsT,$nThn,$mUpb,$LoadExtrac,""),2);
				}
			}
		
			#BERKURANG
			if (fNmHuruf($mG)=="f"){
				$Col[51] = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb:KdpToAset",$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb."%:Y","LIKE:>=:<=:LIKE:=","","");
				$Col[52] = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset_108:Tanggal:Tanggal:Kd_UPB:KdpToAset",$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb."%:Y","LIKE:>=:<=:LIKE:=","","");
			}
			else{
				$Col[51] = round($Col[7] + $Col[11] + $Col[15] + $Col[19] + $Col[23] + $Col[27] + $Col[31] + $Col[35] + $Col[39] + $Col[43] + $Col[47],2);
				$Col[52] = round($Col[8] + $Col[12] + $Col[16] + $Col[20] + $Col[24] + $Col[28] + $Col[32] + $Col[36] + $Col[40] + $Col[44] + $Col[48],2);
			}
			
			#BERTAMBAH
			if (fNmHuruf($mG)=="f"){
				$Col[53]   = fGlobal("IfNull(count(*),0)", "ta_kib_108","Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb",$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb."%","LIKE:>=:<=:LIKE","","");
				$Col[54]   = round(fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_108","Kd_Aset_108:Tanggal:Tanggal:Kd_UPB",$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb."%","LIKE:>=:<=:LIKE","",""),2);
			}
			else{
				$Col[53] = round($Col[9] + $Col[13] + $Col[17] + $Col[21] + $Col[25] + $Col[29] + $Col[33] + $Col[37] + $Col[41] + $Col[45] + $Col[49],2);
				$Col[54] = round($Col[10] + $Col[14] + $Col[18] + $Col[22] + $Col[26] + $Col[30] + $Col[34] + $Col[38] + $Col[42] + $Col[46] + $Col[50],2);
			}
			
			$Col[55] = round($Col[5] - $Col[51] + $Col[53],2);
			$Col[56] = round($Col[6] - $Col[52] + $Col[54],2);
			$Col[57] = "";
			
			$tView=0;
			for ($iR=5; $iR<=56; $iR++)
			{
				$tView = $tView + $Col[$iR];
			}
			
			if ($tView!=0) {
				$Wrn="";
				$Slh="";
				$sldKiB = sumsaldokib($KdAsT,substr($mUpb,0,11),$nThn,"");
				if (substr($KdAsT,0,2)<>"07" && substr($KdAsT,0,2)<>"06" && $nThn==2017 && $UID=="creator"){
					if (round($Col[56],2) > round($sldKiB,2)){
						$Wrn= "; color:#ff0000";
					}
					if (round($Col[56],2) < round($sldKiB,2)){
						$Wrn= "; color:#0000ff";
					}
					$Slh = fConvertToRupiah(round(abs($sldKiB - $Col[56]),2));
				}
				#$Wrn="";
				InsertSaldoAkhirMutasi($KdAsT,substr($mUpb,0,11),$nThn,$Col[55],$Col[56]);
				ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],$Col[19],$Col[20],$Col[21],$Col[22],$Col[23],$Col[24],$Col[25],$Col[26],$Col[27],$Col[28],$Col[29],$Col[30],$Col[31],$Col[32],$Col[33],$Col[34],$Col[35],$Col[36],$Col[37],$Col[38],$Col[39],$Col[40],$Col[41],$Col[42],$Col[43],$Col[44],$Col[45],$Col[46],$Col[47],$Col[48],$Col[49],$Col[50],$Col[51],$Col[52],$Col[53],$Col[54],$Col[55],$Col[56],$Col[57],"",$mUpb,$nThn,$Slh,$Wrn,$UID,$xB);
				$iGE++;
			}
		}
	}

	function sumsaldokib($KdAsT,$mUpb,$nThn,$LoD)
	{
		$sldKB = fGlobal("IfNull(sum(debet),0)", "ta_kib_post_108","Kd_Aset_108:Kd_Upb:Tanggal:extracom",$KdAsT."%:".$mUpb."%:".$nThn."-12-31:N","LIKE:LIKE:<=:=","",$LoD);
		return $sldKB;
	}
?>