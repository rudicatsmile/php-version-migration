<?
require "Connection.php";
require "Connection_Simkada.php";
require "FileFunction.php";

extract($_POST);
extract($_GET);

$gTGL = $fThn."-".substr("00".$fBln,-2,2)."-".substr("00".$fHri,-2,2);

if ($fSimpan=="Save")
{
	if ($gID)
	{
		$rCEK = fGlobalNEW("IDT","ta_kontrak","Nomor:Kegiatan:Rekening:Periode:IDT",$fNoM.":".$gKG.":".$gRK.":".$fPrD.":".$gID,"=:=:=:=:<>","",DatabaseSB,$ConSB,"");
		if (!$rCEK)
		{
			$nSQ="UPDATE ta_kontrak SET 
			Nomor='$fNoM', Tanggal='$gTGL', Uraian='$fUrA' WHERE IDT='$gID'";
			$nRs = mysql_query($nSQ) or die(mysql_error());
		}
	}
	else
	{
		$rCEK = fGlobalNEW("IDT","ta_kontrak","Nomor:Kegiatan:Rekening:Periode",$fNoM.":".$gKG.":".$gRK.":".$fPrD,"=:=:=:=","",DatabaseSB,$ConSB,"");
		if (!$rCEK)
		{
			$fUrA.= fGlobalNEW("Nama_Kegiatan","kegiatan","Id_Kegiatan",$gKG,"=","",DatabaseSA,$ConSA,"");
			$fUrA.= ", ".fGlobalNEW("Nama_COA","coa_kota","No_Rekening",$gRK,"=","",DatabaseSA,$ConSA,"");
			
			CallConnection(DatabaseSB,$ConSB);
			$nSQ="INSERT INTO ta_kontrak SET 
			Nomor='$fNoM', Tanggal='$gTGL', 
			SKPD='".substr($gKG,5,7)."',
			Kegiatan='$gKG',
			Rekening='$gRK', 
			Periode='$fPrD', 
			Uraian='$fUrA'";
			$nRs = mysql_query($nSQ) or die(mysql_error());
			$gID = fGlobalNEW("max(IDT)","ta_kontrak","IDT","%","LIKE","",DatabaseSB,$ConSB,"");
		}
	}
	$URL="Penerimaan_Berkas_Mid_Kontrak_Mid_Frm.php?gID=".$gID."&gKG=".$gKG."&gRK=".$gRK."&IdL=".$IdL;
}
elseif ($fSimpan=="Reset")
{
	$URL="Penerimaan_Berkas_Mid_Kontrak_Mid_Frm.php?gKG=".$gKG."&gRK=".$gRK."&IdL=".$IdL;
}
header("Location: ".$URL);

?>