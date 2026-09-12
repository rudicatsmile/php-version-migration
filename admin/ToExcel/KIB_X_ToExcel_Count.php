<?php require "../Connection.php";?>
<?php require "../FileFunction.php";?>
<?php
$gUnt  = $_GET['gUnt'];
$gSub  = $_GET['gSub'];
$gUpb  = $_GET['gUpb'];
$gThn  = $_GET['gThn'];

if (isset($_GET['gDoc'])) {$gDoc = $_GET['gDoc'];}
if (isset($_GET['gUnt'])) {$gUnt = $_GET['gUnt'];}
if (isset($_GET['gSub'])) {$gSub = $_GET['gSub'];}
if (isset($_GET['gUpb'])) {$gUpb = $_GET['gUpb'];}
if (isset($_GET['gThA'])) {$gThA = $_GET['gThA'];}
if (isset($_GET['gThB'])) {$gThB = $_GET['gThB'];}
if (isset($_GET['gMLK'])) {$gMLK = $_GET['gMLK'];}
if (isset($_GET['gBid'])) {$gBid = $_GET['gBid'];}
if (isset($_GET['gKel'])) {$gKel = $_GET['gKel'];}
if (isset($_GET['gJns'])) {$gJns = $_GET['gJns'];}
if (isset($_GET['gOBJ'])) {$gOBJ = $_GET['gOBJ'];}
if (isset($_GET['gRin'])) {$gRin = $_GET['gRin'];}

if ((int)$gBid==1) {$x="a";}
if ((int)$gBid==2) {$x="b";}
if ((int)$gBid==3) {$x="c";}
if ((int)$gBid==4) {$x="d";}
if ((int)$gBid==5) {$x="e";}
if ((int)$gBid==6) {$x="f";}
if ((int)$gBid==7) {$x="g";}
/*
echo $gDoc."<br>";
echo $gBid."<br>";
echo $gUnt."<br>";
echo $gSub."<br>";
echo $gUpb."<br>";
echo $gThA."<br>";
echo $gThB."<br>";
echo $gMLK."<br>";

echo $gKel."<br>";
echo $gJns."<br>";
echo $gOBJ."<br>";
echo $gRin."<br>";
*/
require "../KIB_Dokumen_Unit_Choise.php";
$gTgA = $gThA."-01-01";
$gTgB = $gThB."-12-31";

$JmREC = 0;
$nSQL= "SELECT IFNULL(COUNT(*),0) AS JmREC FROM ta_kib_".$x." WHERE Kd_UPB LIKE '".$gUpb."' AND Kd_Aset LIKE '".$gAss."' AND (Tgl_Perolehan BETWEEN '".$gTgA."' AND '".$gTgB."') AND Status=''";
$nRs = mysql_query($nSQL) or die(mysql_error());
$mRo = mysql_fetch_assoc($nRs);
$tRo = mysql_num_rows($nRs);
if ($tRo > 0)
{
	$JmREC = $mRo['JmREC'];
}
//echo $JmREC;

if ($JmREC <= 10000)
{
	$URL=$gDoc.".php?gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThA=".$gThA."&gThB=".$gThB."&gMLK=".$gMLK."&gBid=".$gBid."&gKel=".$gKel."&gJns=".$gJns."&gOBJ=".$gOBJ."&gRin=".$gRin."&IdL=".$_GET['IdL'];
	header("Location: ".$URL);
}
else
{
	?>
	<html>
	<head>
	<title>Simbada</title>
	<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>
	<link rel='stylesheet' href='../css/style.css' type='text/css' media='all' />
	</head>
	<body>
<table border='0' width='526' cellspacing='1' style='font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse'>
  <tr> 
    <td width='70'>&nbsp;</td>
    <td colspan="2">
	<table border="0" width="100%" cellspacing="1" style="font-family: Calibri; font-size: 10pt; font-weight: bold; border-collapse: collapse" id="table3">
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
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td>BIDANG</td>
          <td>&nbsp;</td>
          <td><?=$nAs1?></td>
        </tr>
        <tr> 
          <td>KELOMPOK</td>
          <td>&nbsp;</td>
          <td><?=$nAs2?></td>
        </tr>
        <tr> 
          <td>JENIS</td>
          <td>&nbsp;</td>
          <td><?=$nAs3?></td>
        </tr>
        <tr>
          <td>OBJEK</td>
          <td>&nbsp;</td>
          <td><?=$nAs4?></td>
        </tr>
        <tr> 
          <td>RINCIAN </td>
          <td>&nbsp;</td>
          <td><?=$nAs5?></td>
        </tr>
        <tr> 
          <td width="109">TAHUN</td>
          <td width="31">:</td>
          <td> 
            <?php echo $gThA." s.d ".$gThB;?>
          </td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td width='70'>&nbsp;</td>
    <td width='30'>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php
		$HeA  = "NO";		
		$gMax = (int)($JmREC/10000);
		$gMax = $gMax * 10000;
		for ($i=0; $i<=$gMax; $i=$i+10000)
		{
			$gA = $i+1;
			$gB = $i+10000;
			if ($i==$gMax) {$gB=$JmREC;} else {$gB=$gB;}
			
			if ($i==0) {$HeA ="YA";} else {$HeA ="NO";}			//Header Dokumer
			if ($i==$gMax) {$TtD ="YA";} else {$TtD ="NO";}		//Tanda tangan
			$ReC=$i;
			?>
  <tr> 
    <td>&nbsp;</td>
    <td><img src='../css/images/prev.gif'/></td>
    <td><a href='#' onclick="P_OpenDoc('800','400','<?php echo $ReC?>','<?php echo $HeA?>','<?php echo $gDoc?>'); return false"><?php echo "Export Data (*.xls) KIB-".strtoupper($x)." &nbsp;&nbsp;&nbsp;( Record &nbsp;&nbsp; => &nbsp;&nbsp; ".fConvertToRupiahBulat($gA)." &nbsp; s/d &nbsp; ".fConvertToRupiahBulat($gB)." )"?></a></td>
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
	function P_OpenDoc(w,h,ReC,HeA,gDoc)
	{
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL= gDoc+".php?LmT=YA&HeA="+HeA+"&ReC="+ReC+"<?php echo "&gUnt=".$gUnt."&gSub=".$gSub."&gUpb=".$gUpb."&gThA=".$gThA."&gThB=".$gThB."&gMLK=".$gMLK."&gBid=".$gBid."&gKel=".$gKel."&gJns=".$gJns."&gOBJ=".$gOBJ."&gRin=".$gRin."&IdL=".$_GET['IdL']?>";
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=yes,toolbar=yes,resizable=ya,maximize=yes,scrollbars=yes,navigation=no';
		window.open(URL,'',settings);
	}
</script>

