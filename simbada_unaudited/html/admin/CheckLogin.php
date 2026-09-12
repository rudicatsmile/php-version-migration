<?
if (isset($_POST['IdL']))
{
	$eIdL = $_POST['IdL'];
}
else
{
	$eIdL = $_GET['IdL'];
}

$UID = fGlobal("User_ID","ta_user_log","IDT",$eIdL,"=","","");
$Lev = fFindData("Level",$UID,"");
$Adm = fFindData("Admin",$UID,"");
$SkP = fFindData("Kode",$UID,"");
$ReO = fFindData("Readonly",$UID,"");
$SEN = fFindData("User_Sekolah",$UID,"");
$CetakBC = fFindData("Cetak_Barcode",$UID,"");


#echo base64_decode(base64_decode("TVRJek5EVTI="));
#return false;

$OnL = fGlobal("Online","ta_user_log","IDT",$_GET['IdL'],"=","","");

if ($OnL=="N")
{
	$MesG="User anda tidak sedang online...!!!";
	$gURL="FilePageError.php?MesG=".$MesG;
	?>
		<script language="JavaScript">
		window.open("<? echo $gURL ?>","_self");
		</script>
	<?
}

if ($Lev=="" || $Adm=="")
{
	$MesG="User ID anda tidak ditemukan, silahkan Login ulang...!!!";
	$gURL="FilePageError.php?MesG=".$MesG;
	?>
		<script language="JavaScript">
		window.open("<? echo $gURL ?>","_self");
		</script>
	<?
}
?>