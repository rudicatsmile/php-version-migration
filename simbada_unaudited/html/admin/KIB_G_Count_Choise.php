<?
require "Connection.php";
require "FileFunction.php";

$gUnt  = $_GET['gUnt'];
$gSub  = $_GET['gSub'];
$gUpb  = $_GET['gUpb'];
$gThn  = $_GET['gThn'];
$gThnA = $_GET['gThnA'];
require "KIB_Dokumen_Unit.php";

$gUnt  = $_GET['gUnt'];
$gSub  = $_GET['gSub'];
$gUpb  = $_GET['gUpb'];

$xUnt  = $_GET['gUnt'];
$xSub  = $_GET['gSub'];
$xUpb  = $_GET['gUpb'];

$gThA  = $_GET['gThA'];
$gThB  = $_GET['gThB'];

$gBid= $_GET['gBid'];
$gKel= $_GET['gKel'];
$gJns= $_GET['gJns'];
$gOBJ= $_GET['gOBJ'];
$gRin= $_GET['gRin'];
$gMLK= $_GET['gMLK'];

require "KIB_Dokumen_Unit_Choise.php";

$gTglA= $gThA."-01-01";
$gTglB= $gThB."-12-31";

$JmREC = 0;
$nSQL= "SELECT IDT FROM ta_kib_108 WHERE Kd_Aset_108 LIKE '".$gAss."' AND Kd_UPB LIKE '".$gUpb."' AND (Tgl_Perolehan BETWEEN '".$gTglA."' AND '".$gTglB."') AND Status='' 
AND extracom LIKE '".$gExt."' 
GROUP BY Referensi, LEFT(Kd_UPB,11), Ref_History";
$nRs = mysql_query($nSQL);
$tRo = mysql_num_rows($nRs);
$JmREC = $tRo;

if ($JmREC <= 5000)
{
	$URL="KIB_G_Dokumen_Choise.php?gUnt=".$_GET['gUnt']."&gSub=".$_GET['gSub']."&gUpb=".$_GET['gUpb']."&gThA=".$_GET['gThA']."&gThB=".$_GET['gThB']."&gBid=".$_GET['gBid']."&gKel=".$_GET['gKel']."&gJns=".$_GET['gJns']."&gOBJ=".$_GET['gOBJ']."&gRin=".$_GET['gRin']."&gMLK=".$_GET['gMLK']."&gExt=".$_GET['gExt']."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}
else
{
	?>
	<html>
	<head>
	<title>Simbada Kab. Hulu Sungai Tengah</title>
	<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
	<link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
	</head>
	<body>
<table class='table' border='0' width='526' cellspacing='1' style='font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse'>
  <tr> 
    <td width='70'>&nbsp;</td>
    <td colspan="2"><table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
        <tr> 
          <td width="109">UNIT KERJA</td>
          <td width="31">:</td>
          <td width="1250"><? echo $gNmUNT ?></td>
        </tr>
        <tr> 
          <td width="109">SUB UNIT</td>
          <td width="31">:</td>
          <td><? echo $gNmSUB ?></td>
        </tr>
        <tr> 
          <td>UPB</td>
          <td>:</td>
          <td><? echo $gNmUPB ?></td>
        </tr>
        <tr> 
          <td width="109">TAHUN</td>
          <td width="31">:</td>
          <td><? if ($gThn=="____") {echo "SEMUA";} else {echo $gThn;}?></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td width='70'>&nbsp;</td>
    <td width='30'>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?
		$HeA  = "NO";		
		$TtD  = "NO";
		$gMax = (int)($JmREC/5000);
		$gMax = $gMax * 5000;
		for ($i=0; $i<=$gMax; $i=$i+5000)
		{
			$gA = $i+1;
			$gB = $i+5000;
			if ($i==$gMax) {$gB=$JmREC;} else {$gB=$gB;}
			
			$LoadEND="NO";
			
			if ($gB==$JmREC){
				$LoadEND="YA";
			}
			
			if ($i==0) {$HeA ="YA";} else {$HeA ="NO";}			//Header Dokumer
			if ($i==$gMax) {$TtD ="YA";} else {$TtD ="NO";}		//Tanda tangan
			$ReC=$i;
			?>
  <tr> 
    <td>&nbsp;</td>
    <td><img src='css/images/prev.gif'/></td>
    <td><a href='#' onClick="P_OpenDoc('800','400','<?=$ReC?>','<?=$TtD?>','<?=$HeA?>','<?=$LoadEND?>'); return false"><?="Dokumen KIB-G &nbsp;&nbsp;&nbsp;( Record &nbsp;&nbsp; => &nbsp;&nbsp; ".fConvertToRupiahBulat($gA)." &nbsp; s/d &nbsp; ".fConvertToRupiahBulat($gB)." )"?></a></td>
  </tr>
  <?
		}
		?>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
	</body>
	</html>
<?
}
?>

<script language="javascript">
var objfrm=document.myfrm;
function P_OpenDoc(w,h,ReC,TtD,HeA,LoadEND)
{
	var win=null;
	var txtHTML = "";
	var iErrors=0;
	LeftPosition=(screen.width)?(screen.width-w)/2:100; 
	TopPosition=(screen.height)?(screen.height-h)/2:100;
	URL= "KIB_G_Dokumen_Choise.php?LmT=YA&LoadEND="+LoadEND+"&HeA="+HeA+"&TtD="+TtD+"&ReC="+ReC+"<?="&gUnt=".$_GET['gUnt']."&gSub=".$_GET['gSub']."&gUpb=".$_GET['gUpb']."&gThA=".$_GET['gThA']."&gThB=".$_GET['gThB']."&gBid=".$_GET['gBid']."&gKel=".$_GET['gKel']."&gJns=".$_GET['gJns']."&gOBJ=".$_GET['gOBJ']."&gRin=".$_GET['gRin']."&gMLK=".$_GET['gMLK']."&IdL=".$_GET['IdL']?>";
	settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
	window.open(URL,'',settings);
}
</script>

