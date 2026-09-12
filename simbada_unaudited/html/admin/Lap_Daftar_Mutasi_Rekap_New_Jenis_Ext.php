<?
	function ViewJenis($KdJNS,$mUpb,$mThn,$nThn,$mG,$LoadMutasi,$LoadExtrac,$rPil)  #***#
	{
		$iGC  = 1;
		$nSQC = "SELECT left(P1.Kd_Aset,8) as Kd_Aset, P2.Nm_Aset 
		FROM ref_rek_aset5_temp P1 
		JOIN ref_rek_aset3 P2 ON P2.Kd_Aset=left(P1.Kd_Aset,8) 
		WHERE P1.Kd_Aset LIKE '".$KdJNS.".%' AND P1.Kd_Unit = '".substr($mUpb,0,11)."' GROUP BY left(P1.Kd_Aset,8)";
		$nRsC = mysql_query($nSQC);
		while ($mRoC = mysql_fetch_array($nRsC, MYSQL_BOTH))
		{
			if ($rPil==2){
				$xB = "";
			}
			else{
				$xB = "<b>";
			}
			
			ClrVr();
			$KdAsT  = $mRoC['Kd_Aset'];
			$Col[1] = "";
			$Col[2] = "";
			$Col[3] = $mRoC['Kd_Aset'];
			$Col[4] = $mRoC['Nm_Aset'];
			
			//AWAL
			if (fNmHuruf($mG)=="f"){
				if ($nThn<=2016) {
					$Col[5] = fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($mG),"Kd_Aset:Kd_Upb:KdpToAset:Tgl_Perolehan",$KdAsT."%:".$mUpb."%:N:".$mThn."-12-31","LIKE:LIKE:=:<=","","");
					$Col[6] = round(fGlobal("IfNull(sum(Debet),0)", "ta_kib_post","Kd_Aset:Kd_UPB:KdpToAset:Tanggal",$KdAsT."%:".$mUpb."%:N:".$mThn."-12-31","LIKE:LIKE:=:<=","",""),2);
				}
				else{
					$Col[5] = fGlobal("IfNull(sum(unitAkhir),0)", "ta_kib_post_saldo_mutasi","Kd_Unit:Kd_Aset:Tahun",$mUpb.":".$KdAsT.":".$mThn,"=:=:=","","");
					$Col[6]  = fGlobal("IfNull(sum(saldoAkhir),0)", "ta_kib_post_saldo_mutasi","Kd_Unit:Kd_Aset:Tahun",$mUpb.":".$KdAsT.":".$mThn,"=:=:=","","");
				}
			}
			else{
				if ($nThn<=2016) {
					$Col[5] = fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($mG),"Kd_Aset:Tgl_Perolehan:Tgl_Mutasi:Kd_UPB:extracom",$KdAsT."%:".$mThn."-12-31:".$mThn."-12-31:".$mUpb."%:".$LoadExtrac,"LIKE:<=:<=:LIKE:LIKE","","");
					$Col[5] = $Col[5] + fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($mG)."_mutasi","Kd_Aset:Tgl_Perolehan:Tgl_Mutasi:Tgl_Mutasi:Kd_UPB:extracom",$KdAsT."%:".$mThn."-12-31:".$nThn."-01-01:".($nThn+1)."-12-31:".$mUpb."%:".$LoadExtrac,"LIKE:<=:>=:<=:LIKE:LIKE","","");
					$Col[6] = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post","Kd_Aset:Tanggal:Tgl_Mutasi:Kd_UPB:extracom",$KdAsT."%:".$mThn."-12-31:".$mThn."-12-31:".$mUpb."%:".$LoadExtrac,"LIKE:<=:<=:LIKE:LIKE","","");
					$Col[6] = $Col[6] + fGlobal("IfNull(sum(Debet),0)", "ta_kib_post_mutasi","Kd_Aset:Tanggal:Tgl_Mutasi:Tgl_Mutasi:Kd_UPB:extracom",$KdAsT."%:".$mThn."-12-31:".$nThn."-01-01:".($nThn+1)."-12-31:".$mUpb."%:".$LoadExtrac,"LIKE:<=:>=:<=:LIKE:LIKE","","");
				}
				else{
					$Col[5] = fGlobal("IfNull(sum(unitAkhir),0)","ta_kib_post_saldo_mutasi","Kd_Unit:Kd_Aset:Tahun",$mUpb.":".$KdAsT."%:".$mThn,"=:LIKE:=","","");
					$Col[6] = fGlobal("IfNull(sum(saldoAkhir),0)","ta_kib_post_saldo_mutasi","Kd_Unit:Kd_Aset:Tahun",$mUpb.":".$KdAsT."%:".$mThn,"=:LIKE:=","","");
				}
			}
			
			#TAHUN BERSANGKUTAN
			if (fNmHuruf($mG)=="f"){
				# - 
				$Col[47] = ItemKurangKibF($mG,$KdAsT,$nThn,$mUpb,$LoadExtrac,"");
				$Col[48] = HargKurangKibF($KdAsT,$nThn,$mUpb,$LoadExtrac,"");
				# +
				$Col[49] = ItemTambahKibF($mG,$KdAsT,$nThn,$mUpb,$LoadExtrac,"");
				$Col[50] = HargTambahKibF($KdAsT,$nThn,$mUpb,$LoadExtrac,"");
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
					$Col[47] = 0;
					$Col[48] = 0;
					# +
					$Col[49] = ItemTambahThnN($mG,$KdAsT,$nThn,$mUpb,$LoadExtrac,"");
					$Col[50] = HargTambahThnN($KdAsT,$nThn,$mUpb,$LoadExtrac,"");
				}
			}
		
			//BERKURANG
			if (fNmHuruf($mG)=="f"){
				$Col[51] = fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($mG),"Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb:KdpToAset",$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb."%:Y","LIKE:>=:<=:LIKE:=","","");
				$Col[52]  = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post","Kd_Aset:Tanggal:Tanggal:Kd_Upb:KdpToAset",$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb."%:Y","LIKE:>=:<=:LIKE:=","","");
			}
			else{
				$Col[51] = $Col[7] + $Col[11] + $Col[15] + $Col[19] + $Col[23] + $Col[27] + $Col[31] + $Col[35] + $Col[39] + $Col[43] + $Col[47];
				$Col[52] = $Col[8] + $Col[12] + $Col[16] + $Col[20] + $Col[24] + $Col[28] + $Col[32] + $Col[36] + $Col[40] + $Col[44] + $Col[48];
			}
			
			//BERTAMBAH
			if (fNmHuruf($mG)=="f"){
				$Col[53] = fGlobal("IfNull(count(*),0)", "ta_kib_".fNmHuruf($mG),"Kd_Aset:Tgl_Perolehan:Tgl_Perolehan:Kd_Upb",$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb."%","LIKE:>=:<=:LIKE","","");
				$Col[54] = fGlobal("IfNull(sum(Debet),0)", "ta_kib_post","Kd_Aset:Tanggal:Tanggal:Kd_Upb",$KdAsT."%:".$nThn."-01-01".":".$nThn."-12-31:".$mUpb."%","LIKE:>=:<=:LIKE","","");
			}
			else{
				$Col[53] = $Col[9] + $Col[13] + $Col[17] + $Col[21] + $Col[25] + $Col[29] + $Col[33] + $Col[37] + $Col[41] + $Col[45] + $Col[49];
				$Col[54] = $Col[10] + $Col[14] + $Col[18] + $Col[22] + $Col[26] + $Col[30] + $Col[34] + $Col[38] + $Col[42] + $Col[46] + $Col[50];
				
			}
			
			$Col[55] = $Col[5] - $Col[51] + $Col[53];
			$Col[56] = $Col[6] - $Col[52] + $Col[54];
			$Col[57] = "";
			
			$tView=0;
			for ($iR=5; $iR<=56; $iR++)
			{
				$tView = $tView + $Col[$iR];
			}
			
			if ($tView!=0) {
				ViewRincian($Col[1],$Col[2],$Col[3],$Col[4],$Col[5],$Col[6],$Col[7],$Col[8],$Col[9],$Col[10],$Col[11],$Col[12],$Col[13],$Col[14],$Col[15],$Col[16],$Col[17],$Col[18],$Col[19],$Col[20],$Col[21],$Col[22],$Col[23],$Col[24],$Col[25],$Col[26],$Col[27],$Col[28],$Col[29],$Col[30],$Col[31],$Col[32],$Col[33],$Col[34],$Col[35],$Col[36],$Col[37],$Col[38],$Col[39],$Col[40],$Col[41],$Col[42],$Col[43],$Col[44],$Col[45],$Col[46],$Col[47],$Col[48],$Col[49],$Col[50],$Col[51],$Col[52],$Col[53],$Col[54],$Col[55],$Col[56],$Col[57],"",$mUpb,$nThn,$xB);
				if ($rPil==3 || $rPil==4) {ViewObjek($KdAsT,$mUpb,$mThn,$nThn,$mG,$LoadMutasi,$LoadExtrac,$rPil);}
			}
			$iGC++;
		}
	}	

?>