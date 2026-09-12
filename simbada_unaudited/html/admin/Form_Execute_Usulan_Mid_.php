<?
require('Connection.php');
require('FileFunction.php');
$Smpn = $_POST['Simpan'];
$rIDT = $_REQUEST['rIDT'];
$rUID = fGlobal("User_ID","Ta_User_Log","IDT",$_REQUEST['IdL'],"=","","");

if ($Smpn=="Eksekusi")
	{
		$gSTA  = fGlobal("Status","ta_penghapusan_usulan ","IDT",$rIDT,"=","","");
		if ($gSTA=="DISETUJUI")
		{
			$nSQL= "SELECT * FROM ta_penghapusan_usulan WHERE IDT = '".$rIDT."'";
			$nRs = mysql_query($nSQL) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
				$gREF  = $mRo['Referensi'];
				$rSK   = $mRo['Nomor'];
				$rTgSK = $mRo['Tgl_SK'];
				$rThn  = substr($rTgSK,0,4);
				if ($rThn=="") {$rThn=$mRo['Tahun'];}
				$rKET  = $mRo['Keterangan'];
			}
			
			$nSQL= "SELECT * FROM ta_penghapusan_usulan_rinc WHERE Referensi LIKE '".$gREF."' ORDER BY KIB,ID";
			$nRs = mysql_query($nSQL) or die(mysql_error());
			$mRo = mysql_fetch_assoc($nRs);
			$tRo = mysql_num_rows($nRs);
			if ($tRo > 0)
			{
				do
				{
					$gIDT = $mRo['IDT'];
					$rKIB = $mRo['KIB'];
					$rReU = $gREF;
					$rReA = $mRo['Ref_Aset'];
					$rReG = $mRo['Ref_Group'];
					$rID  = $mRo['ID'];
					$rUPB = $mRo['Kd_UPB'];
					$rKdA = $mRo['Kd_Aset'];
					$rNmA = $mRo['Nm_Aset'];
					$rNiL = $mRo['Nilai'];
					$rNoR = $mRo['No_Register'];
					$rTgP = $mRo['Tgl_Perolehan'];
					$rKoN = $mRo['Kondisi'];
					$rAlA = $mRo['Alasan'];
					$rKeT = $mRo['Keterangan'];
					
					//PENGHAPUSAN
					$SQ = "INSERT INTO ta_penghapusan_rinc_new SET 
					Tahun='$rThn',
					Ref_Usulan='$rReU',
					Ref_Aset='$rReA',
					Ref_Group='$rReG',
					No_SK='$rSK',
					Tg_SK='$rTgSK',
					No_ID='$rID',
					Kd_UPB='$rUPB',
					Kd_Aset='$rKdA',
					Nm_Aset='$rNmA',
					Nilai='$rNiL',
					No_Register='$rNoR',
					Kd_Pemilik='$rKdM',
					Tgl_Perolehan='$rTgP',
					Kondisi='$rKoN',
					Alasan='$rAlA',
					Keterangan='$rKeT'";
					$Rs = mysql_query($SQ) or die(mysql_error());
					
					//STATUS EKSEKUSI
					$SQ = "UPDATE ta_penghapusan_usulan_rinc SET 
					Eksekusi='Y' WHERE IDT='".$gIDT."'";
					$rs = mysql_query($SQ) or die(mysql_error());
					
					//POSTING
					$rUrA = "Penghapusan Aset:IDT:".$gIDT;
					$SQ = "INSERT INTO ta_kib_post SET 
					Referensi='$rReA',
					Ref_Group='$rReG',
					Kd_UPB='$rUPB',
					Kd_Aset='$rKdA',
					No_Register='$rNoR',
					Crit='EXE',
					Tanggal='$rTgSK',
					Uraian='$rUrA',
					DK='K',
					Debet=0,
					Kredit='$rNiL',
					Keterangan='$rAlA',
					Recorded=now(),
					Pencatat='$rUID'";
					$Rs = mysql_query($SQ) or die(mysql_error());
					
					//STATUS DI KIB
					$SQ = "UPDATE ta_kib_".$rKIB." SET  Status='DIHAPUSKAN' WHERE IDT='".$rID."'";
					$Rs = mysql_query($SQ) or die(mysql_error());
				}
				while ($mRo = mysql_fetch_assoc($nRs));
			}
			
			//TA PENGHAPUSAN
			$SQ = "INSERT INTO ta_penghapusan_new SET 
			Referensi='$gREF',
			Tahun='$rThn',
			No_SK='$rSK',
			Tgl_SK='$rTgSK',
			Keterangan='$rKET',
			Recorded=now(),
			Pencatat='$gUid'";
			$rs = mysql_query($SQ) or die(mysql_error());
			
			//STATUS EXECUTE
			$SQ = "UPDATE ta_penghapusan_usulan SET 
			Eksekusi='Y',
			Recorded_Stat=now(),
			Pencatat_Stat='$gUid' WHERE IDT='".$rIDT."'";
			$rs = mysql_query($SQ) or die(mysql_error());
		}
		$URL="Form_Execute_Usulan_Mid.php?rIDT=".$rIDT."&gThn=".$_REQUEST['gThn']."&FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL'];
		header("Location: ".$URL);
	}
else if ($Smpn=="Batalkan")
	{
		$gREF  = fGlobal("Referensi","ta_penghapusan_usulan ","IDT",$rIDT,"=","","");
		
		$nSQL= "SELECT * FROM ta_penghapusan_usulan_rinc WHERE Referensi LIKE '".$gREF."' ORDER BY KIB,ID";
		$nRs = mysql_query($nSQL) or die(mysql_error());
		$mRo = mysql_fetch_assoc($nRs);
		$tRo = mysql_num_rows($nRs);
		if ($tRo > 0)
		{
			do
			{
				$gIDT = $mRo['IDT'];
				$rKIB = $mRo['KIB'];
				$rReU = $gREF;
				$rReA = $mRo['Ref_Aset'];
				$rReG = $mRo['Ref_Group'];
				$rID  = $mRo['ID'];
				
				//STATUS EKSEKUSI
				$SQ = "UPDATE ta_penghapusan_usulan_rinc SET 
				Eksekusi='N' WHERE IDT='".$gIDT."'";
				$rs = mysql_query($SQ) or die(mysql_error());
				
				//POSTING
				$rUrA = "Penghapusan Aset:IDT:".$gIDT;
				if ($gIDT!=""){
					$SQ = "DELETE FROM ta_kib_post WHERE Crit='EXE' AND Uraian LIKE '%:".$gIDT."'";
					$Rs = mysql_query($SQ) or die(mysql_error());
				}
				//STATUS DI KIB
				$SQ = "UPDATE ta_kib_".$rKIB." SET  Status='' WHERE IDT='".$rID."'";
				$Rs = mysql_query($SQ) or die(mysql_error());
			}
			while ($mRo = mysql_fetch_assoc($nRs));
		}
		
		//TA PENGHAPUSAN
		$SQ = "DELETE FROM ta_penghapusan_new WHERE Referensi='".$gREF."'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		//TA PENGHAPUSAN RINC
		$SQ = "DELETE FROM ta_penghapusan_rinc_new WHERE Ref_Usulan='".$gREF."'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		//STATUS EXECUTE
		$SQ = "UPDATE ta_penghapusan_usulan SET 
		Eksekusi='N',
		Recorded_Stat=now(),
		Pencatat_Stat='$gUid' WHERE IDT='".$rIDT."'";
		$rs = mysql_query($SQ) or die(mysql_error());
		
		$URL="Form_Execute_Usulan_Mid.php?rIDT=".$rIDT."&gThn=".$_REQUEST['gThn']."&FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL'];
		header("Location: ".$URL);
	}
else if ($Smpn=="Close")
	{
	$URL="Usulan_Penghapusan_Status.php?gThn=".$_REQUEST['gThn']."&FrmG=".$_REQUEST['FrmG']."&IdL=".$_REQUEST['IdL'];
	?>
	<script LANGUAGE="JavaScript">
	this.window.open ('<? echo $URL ?>','MidFrame')
	this.setTimeout("self.close()",0)
	</script>
	<?
	}

?>

<?php require('Connection_Close.php');?>
