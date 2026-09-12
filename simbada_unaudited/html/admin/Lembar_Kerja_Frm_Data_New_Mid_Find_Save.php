<?
require('Connection.php');
require('FileFunction.php');
extract($_GET);

$fNmA = ReplaceTextPHP($fNmA);
$fNmS = ReplaceTextPHP($fNmS);
$fReG = ReplaceTextPHP($fReG);
$fMeR = ReplaceTextPHP($fMeR);
$fTyP = ReplaceTextPHP($fTyP);

$fPoL = ReplaceTextPHP($fPoL);
$fRaN = ReplaceTextPHP($fRaN);
$fMeS = ReplaceTextPHP($fMeS);

$fSaT = ReplaceTextPHP($fSaT);
$fHaR = fConvertToNumeric($fHaR);
$fNiL = fConvertToNumeric($fNiL);

$fTgL = $fThN."-".substr('00'.$fBlN,-2,2)."-".substr('00'.$fHrI,-2,2);

$fAlM = ReplaceTextPHP($fAlM);
$fDaS = ReplaceTextPHP($fDaS);

$fLaI = ReplaceTextPHP($fLaI);
$fKeT = ReplaceTextPHP($fKeT);

if ($IdT=='')
{
	$NoM = 1;
	$MaX = fGlobal("max(Referensi)","tb_lembar_kerja_belum_tercatat","IDT","%","LIKE","","");
	if ($MaX)
	{
		$NoM = ((int)substr($MaX,-11,11))+1;
	}
	
	$NewR = 'BMD.'.substr('00000000000'.$NoM,-11,11);
	
	$SQ = "INSERT INTO tb_lembar_kerja_belum_tercatat SET 
	Referensi='".$NewR."', 
	KdUPB='".$fUPB."', 
	KdBarang='".$fKdE."',
	NmBarang='".$fNmA."',
	NmBarang_Spec='".$fNmS."',
	KdRegister='".$fReG."',
	Merk='".$fMeR."',
	Type='".$fTyP."',
	JmlBarang='".$fJmL."',
	SatuanBarang='".$fSaT."',
	HargaSatuan='".$fHaR."',
	NilaiPerolehan='".$fNiL."',
	TglPerolehan='".$fTgL."',
	Alamat='".$fAlM."',
	DasarPencatatan='".$fDaS."',
	KondisiBarang='".$fKoN."',
	Lainnya='".$fLaI."',
	Keterangan='".$fKeT."'";
	#echo $SQ;
	mysql_query($SQ);
	
	$IdT = fGlobal("max(IDT)","tb_lembar_kerja_belum_tercatat","KdUPB",$fUPB,"=","","");
}
else
{
	$SQ = "UPDATE tb_lembar_kerja_belum_tercatat SET 
	KdBarang='".$fKdE."',
	NmBarang='".$fNmA."',
	NmBarang_Spec='".$fNmS."',
	KdRegister='".$fReG."',
	Merk='".$fMeR."',
	Type='".$fTyP."',
	NoPolisi='".$fPoL."',
	NoRangka='".$fRaN."',
	NoMesin='".$fMeS."',
	JmlBarang='".$fJmL."',
	SatuanBarang='".$fSaT."',
	HargaSatuan='".$fHaR."',
	NilaiPerolehan='".$fNiL."',
	TglPerolehan='".$fTgL."',
	Alamat='".$fAlM."',
	DasarPencatatan='".$fDaS."',
	KondisiBarang='".$fKoN."',
	Lainnya='".$fLaI."',
	Keterangan='".$fKeT."' 
	WHERE IDT='".$IdT."'";
	mysql_query($SQ);

}
?>
<script languange="javascript">
NewAset('refr','<?=$ReO?>','<?=$IdT?>','<?=$IdL?>');
</script>
