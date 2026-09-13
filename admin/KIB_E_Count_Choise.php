<?php require "Connection.php";?>
<?php require "FileFunction.php";?>
<?php
$gUnt  = $_GET['gUnt'];
$gSub  = $_GET['gSub'];
$gUpb  = $_GET['gUpb'];

$gThA  = $_GET['gThA'];
$gThB  = $_GET['gThB'];

$gBid= $_GET['gBid'];
$gKel= $_GET['gKel'];
$gJns= $_GET['gJns'];
$gOBJ= $_GET['gOBJ'];
$gRin= $_GET['gRin'];
$gMLK= $_GET['gMLK'];
$gExt= $_GET['gExt'];
$page= $_GET['page'];

require "KIB_Dokumen_Unit_Choise.php";

$gTglA= $gThA."-01-01";
$gTglB= $gThB."-12-31";

/*if ($gRin!='All')
{
	$gRek = $gRin;
}
else
{
	if ($gOBJ!='All')
	{
		$gRek = $gOBJ;
	}
	else
	{
		if ($gJns!='All')
		{
			$gRek = $gJns;
		}
		else
		{
			if ($gKel!='All')
			{
				$gRek = $gKel;
			}
			else
			{
				$gRek = $gBid;
			}
		}
	}
}
*/
$JmREC = 0;
$nSQL= "SELECT IDT FROM ta_kib_108 WHERE kd_aset_108 LIKE '1.5.3%' AND extracom LIKE '".$gExt."' AND Kd_UPB LIKE '".$gUpb."' AND (Tgl_Perolehan BETWEEN '".$gTglA."' AND '".$gTglB."') AND Kd_Pemilik LIKE '".$gMLK."' 
GROUP BY Referensi, Ref_Group, Kd_UPB 
ORDER BY Tgl_Perolehan, Kd_Aset_108, No_Register";
#echo $nSQL."<br>";
$nRs = mysql_query($nSQL);
$tRo = mysql_num_rows($nRs);
$JmREC = $tRo;
#echo $JmREC."<br>";
#return false;

if ($JmREC <= 50000)
{
	$URL="KIB_E_Dokumen_Choise.php?gUnt=".$_GET['gUnt']."&gSub=".$_GET['gSub']."&gUpb=".$_GET['gUpb']."&gThA=".$_GET['gThA']."&gThB=".$_GET['gThB']."&gBid=".$_GET['gBid']."&gKel=".$_GET['gKel']."&gJns=".$_GET['gJns']."&gOBJ=".$_GET['gOBJ']."&gRin=".$_GET['gRin']."&gExt=".$_GET['gExt']."&gMLK=".$_GET['gMLK']."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}
else
{
	?>
	<html>
	<head>
	<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>
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
          <td width="1250"><?php echo $gNmUNT ?></td>
        </tr>
        <tr> 
          <td width="109">SUB UNIT</td>
          <td width="31">:</td>
          <td><?php echo $gNmSUB ?></td>
        </tr>
        <tr> 
          <td>UPB</td>
          <td>:</td>
          <td><?php echo $gNmUPB ?></td>
        </tr>
        <tr> 
          <td width="109">TAHUN</td>
          <td width="31">:</td>
          <td><?php if ($gThn=="____") {echo "SEMUA";} else {echo $gThn;}?></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td width='70'>&nbsp;</td>
    <td width='30'>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php
  		$gNO  = 0;
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
			$gNO++;
			?>
			<tr> 
			<td>&nbsp;</td>
			<td><?=$gNO?>.</td>
			<td><a href='#' onClick="P_OpenDoc('800','400','<?=$ReC?>','<?=$TtD?>','<?=$HeA?>','<?=$LoadEND?>'); return false"><?php echo "Dokumen KIB-E &nbsp;&nbsp;&nbsp;( Record &nbsp;&nbsp; => &nbsp;&nbsp; ".fConvertToRupiahBulat($gA)." &nbsp; s/d &nbsp; ".fConvertToRupiahBulat($gB)." )"?></a></td>
			</tr>
			<?php
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
<?php
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
	URL= "KIB_E_Dokumen_Choise.php?LmT=YA&LoadEND="+LoadEND+"&HeA="+HeA+"&TtD="+TtD+"&ReC="+ReC+"<?="&gUnt=".$_GET['gUnt']."&gSub=".$_GET['gSub']."&gUpb=".$_GET['gUpb']."&gThA=".$_GET['gThA']."&gThB=".$_GET['gThB']."&gBid=".$_GET['gBid']."&gKel=".$_GET['gKel']."&gJns=".$_GET['gJns']."&gOBJ=".$_GET['gOBJ']."&gRin=".$_GET['gRin']."&gExt=".$_GET['gExt']."&gMLK=".$_GET['gMLK']."&IdL=".$_GET['IdL']?>";
	settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
	window.open(URL,'',settings);
}
</script>

