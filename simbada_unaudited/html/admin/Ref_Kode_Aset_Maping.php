<?
require "CheckSession.php";
require "Connection.php";
require "Connection_Simkada.php";
require "FileFunction.php";
require "CheckLogin.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>Simbada Kab. Hulu Sungai Tengah</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<style>
a:visited 
{
	color: rgb(0,0,0);
	Text-Decoration: none
}
a:link
{
	color: rgb(0,0,0);
	Text-Decoration: none 
}
a:Hover
{
	color: red;
} 
a:active 
{
	color: rgb(255,153,0);
}
</style>
</head>
<body>
<?php require "FileMenu.php";?>
<form name="myfrm" method="post" action="<?php echo "Ref_Kode_Aset_1_.php?FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."&Page=".$_GET['Page']."&iG=".$_GET['iG']?>">
  <input type="hidden" name="Simpan">
    <table border="0" cellspacing="0" cellpadding="0" style="width:1340px; background:#fff; border-collapse:collapse">
      <tr> 
        <th width="46" align="left">&nbsp;</th>
        <th width="100" align="left">Kode</th>
        <th width="350" align="left" style="padding-left:5px">Rekening 17</th>
        <th width="450" align="left" style="padding-left:5px">Rekening 13</th>
        <th width="450" align="left" style="padding-left:5px">Rekening 64</th>
        <th></th>
      </tr>
      <?
	  	$iGa=1;
		//$rKdA = $_GET['rKdA'];
		//if (!$rKdA) {$rKdA="01";}
		//echo $rKdA."<br>";

		//$rKdB = $_GET['rKdB'];
		//if (!$rKdB) {$rKdB="01.01";}
		//echo $rKdB."<br>";
		$rKdB = $_GET['rKdB'];
		$rKdC = $_GET['rKdC'];
		echo $rKdB." : ".$rKdC;
		CallConnection(DatabaseSB,$ConSB);
		$nSQ = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset1 ORDER BY Kd_Aset";
		$nRs = mysql_query($nSQ) or die(mysql_error());
		while ($mRo = mysql_fetch_array($nRs, MYSQL_BOTH))
		{
			$xB = "<b>";
			$gKd= $mRo[0];
			$gA1= "";
			$gA2= $mRo[0];
			$gA3= strtoupper($mRo[1]);
			$gA4= "";
			ViewRows1($gA1,$gA2,$gA3,$gA4,$xB);
			if ($gKd==$_GET['rKdA']) {Level2($gKd,$rKdB,$rKdC,DatabaseSA,$ConSA,DatabaseSB,$ConSB,$fSH);}
			$iGa++;
		}
		
		function Level2($gKd,$rKdB,$rKdC,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB,$fSH)
		{
			$iGb=1;
			CallConnection(DatabaseSB,$ConSB);
			$nSB = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset2 WHERE Kd_Aset LIKE '$gKd%' ORDER BY Kd_Aset";
			$nRB = mysql_query($nSB) or die(mysql_error());
			while ($mRB = mysql_fetch_array($nRB, MYSQL_BOTH))
			{
				$xB = "";
				if ($mRB[0]==$rKdB){
					$xB = "<b>";
				}
				
				$gKd= $mRB[0];
				$gA1= "";
				$gA2= $mRB[0];
				$gA3= strtoupper($mRB[1]);
				$gA4= "";
				ViewRows2($gA1,$gA2,$gA3,$gA4,$xB);
				if ($gKd==$rKdB) {Level3($gKd,$rKdC,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB,$fSH);}
				$iGb++;
			}
		}
		
		function Level3($gKd,$rKdC,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB,$fSH)
		{
			$iGc=1;
			CallConnection(DatabaseSB,$ConSB);
			$nSC = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset3 WHERE Kd_Aset LIKE '$gKd%' ORDER BY Kd_Aset";
			$nRC = mysql_query($nSC) or die(mysql_error());
			while ($mRC = mysql_fetch_array($nRC, MYSQL_BOTH))
			{
				$xB = "";
				if ($mRC[0]==$rKdC){
					$xB = "<b>";
				}
				$gKd= $mRC[0];
				$gA1= "";
				$gA2= $mRC[0];
				$gA3= strtoupper($mRC[1]);
				$gA4= "";
				ViewRows3($gA1,$gA2,$gA3,$gA4,$xB);
				if ($gKd==$rKdC) {Level4($gKd,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB,$fSH);}
				$iGc++;
			}
		}
		
		function Level4($gKd,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB,$fSH)
		{
			$iGd=1;
			CallConnection(DatabaseSB,$ConSB);
			$nSD = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset4 WHERE Kd_Aset LIKE '$gKd%' ORDER BY Kd_Aset";
			$nRD = mysql_query($nSD) or die(mysql_error());
			while ($mRD = mysql_fetch_array($nRD, MYSQL_BOTH))
			{
				$xB = "<b>";
				$gKd= $mRD[0];
				$gA1= "";
				$gA2= $mRD[0];
				$gA3= "<u>".$mRD[1]."</u>";
				$gA4= "";
				ViewRows4($gA1,$gA2,$gA3,$gA4,$xB);
				Level5($gKd,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB,$fSH);
				$iGd++;
			}
		}
		
		function Level5($gKd,$DatabaseSA,$ConSA,$DatabaseSB,$ConSB,$fSH)
		{
			$iGe=1;
			CallConnection(DatabaseSB,$ConSB);
			$nSE = "SELECT Kd_Aset, Nm_Aset FROM ref_rek_aset5 WHERE Kd_Aset LIKE '$gKd%' ORDER BY Kd_Aset";
			$nRE = mysql_query($nSE) or die(mysql_error());
			while ($mRE = mysql_fetch_array($nRE, MYSQL_BOTH))
			{
				$xB = "";
				$gKd= $mRE[0];
				$gA1= "";
				$gA2= $mRE[0];
				$gA3= $mRE[1];
				$gA4= fGlobalNEW("Kd_Aset13","ref_rek_aset5_maping","Kd_Aset17",$gKd,"=","",$DatabaseSB,$ConSB,"");
				$gA5= fGlobalNEW("Kd_Aset64","ref_rek_aset5_maping","Kd_Aset17",$gKd,"=","",$DatabaseSB,$ConSB,"");
				
				if ($gA4) {$gA4=$gA4." : ".fGlobalNEW("Nm_Rek","ref_rek_13_5","Kd_Rek",$gA4,"=","",$DatabaseSB,$ConSB,"");}
				else {$gA4="...... ???";}
				if ($gA5) {$gA5=$gA5." : ".fGlobalNEW("Nm_Rek","ref_rek_64_5","Kd_Rek",$gA5,"=","",$DatabaseSB,$ConSB,"");}
				else {$gA5="...... ???";}
				ViewRows5($gA1,$gA2,$gA3,$gA4,$gA5,$xB);
				$iGe++;
			}
		}
		
		function ViewRows1($A1,$A2,$A3,$A4,$xB)
		{
			echo "<tr height='20'>";
				echo "<td></td>";
				echo "<td><a href='".$_SERVER['PHP_SELF']."?rKdA=".$A2."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."'>".$xB.$A2."</a></td>";
				echo "<td style='border-left:1px dotted #ccc; padding-left:5px'><a href='".$_SERVER['PHP_SELF']."?rKdA=".$A2."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."'>".$xB.$A3."</a></td>";
				echo "<td style='border-left:1px dotted #ccc'></td>";
				echo "<td style='border-left:1px dotted #ccc'></td>";
				echo "<td style='border-left:1px dotted #ccc'></td>";
				echo "<td style='border-left:1px dotted #ccc'></td>";
			echo "</tr>";
		}
		
		function ViewRows2($A1,$A2,$A3,$A4,$xB)
		{
			echo "<tr height='20'>";
				echo "<td></td>";
				echo "<td><a href='".$_SERVER['PHP_SELF']."?rKdA=".substr($A2,0,2)."&rKdB=".$A2."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."'>".$xB.$A2."</a></td>";
				echo "<td style='border-left:1px dotted #ccc; padding-left:5px'><a href='".$_SERVER['PHP_SELF']."?rKdA=".substr($A2,0,2)."&rKdB=".$A2."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."'>".$xB.$A3."</a></td>";
				echo "<td style='border-left:1px dotted #ccc'></td>";
				echo "<td style='border-left:1px dotted #ccc'></td>";
				echo "<td style='border-left:1px dotted #ccc'></td>";
				echo "<td style='border-left:1px dotted #ccc'></td>";
			echo "</tr>";
		}
		
		function ViewRows3($A1,$A2,$A3,$A4,$xB)
		{
			echo "<tr height='20'>";
				echo "<td></td>";
				echo "<td><a href='".$_SERVER['PHP_SELF']."?rKdA=".substr($A2,0,2)."&rKdB=".substr($A2,0,5)."&rKdC=".$A2."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."'>".$xB.$A2."</a></td>";
				echo "<td style='border-left:1px dotted #ccc; padding-left:5px'><a href='".$_SERVER['PHP_SELF']."?rKdA=".substr($A2,0,2)."&rKdB=".substr($A2,0,5)."&rKdC=".$A2."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']."'>".$xB.$A3."</a></td>";
				echo "<td style='border-left:1px dotted #ccc'></td>";
				echo "<td style='border-left:1px dotted #ccc'></td>";
				echo "<td style='border-left:1px dotted #ccc'></td>";
				echo "<td style='border-left:1px dotted #ccc'></td>";
			echo "</tr>";
		}
		
		function ViewRows4($A1,$A2,$A3,$A4,$xB)
		{
			echo "<tr height='20'>";
				echo "<td></td>";
				echo "<td>".$xB.$A2."</td>";
				echo "<td style='border-left:1px dotted #ccc; padding-left:5px'>".$xB.$A3."</td>";
				echo "<td style='border-left:1px dotted #ccc'></td>";
				echo "<td style='border-left:1px dotted #ccc'></td>";
				echo "<td style='border-left:1px dotted #ccc'></td>";
				echo "<td style='border-left:1px dotted #ccc'></td>";
			echo "</tr>";
		}
		
		function ViewRows5($A1,$A2,$A3,$A4,$A5,$xB)
		{
			echo "<tr height='20'>";
				echo "<td></td>";
				
				echo "<td style='border-top: 1px dotted #ccc; border-bottom: 1px dotted #ccc'>";
				?>
				<a href="#" onclick="P_Form('<?=$A2?>'); return false"><?=$xB.$A2?></a>
				<?
				echo "</td>";
				
				echo "<td style='border-left:1px dotted #ccc; border-top: 1px dotted #ccc; border-bottom: 1px dotted #ccc; padding-left:5px'>";
				?>
				<a href="#" onclick="P_Form('<?=$A2?>'); return false"><?=$xB.$A3?></a>
				<?
				echo "</td>";
				
				echo "<td style='padding-left: 5px; border-top: 1px dotted #ccc; border-bottom: 1px dotted #ccc; border-left: 1px dotted #ccc'>";
				?>
				<a href="#" onclick="P_Form('<?=$A2?>'); return false"><?=$xB.$A4?></a>
				<?
				echo "</td>";
				
				echo "<td style='padding-left: 5px; border-top: 1px dotted #ccc; border-bottom: 1px dotted #ccc; border-left: 1px dotted #ccc'>";
				?>
				<a href="#" onclick="P_Form('<?=$A2?>'); return false"><?=$xB.$A5?></a>
				<?
				echo "</td>";
				
				echo "<td></td>";
				echo "<td></td>";
			echo "</tr>";
		}
		?>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan="3">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
		<a href="<? echo $_SERVER['PHP_SELF']."?rKdA=".$_GET['rKdA']."&rKdB=".$_GET['rKdB']."&rKdC=".$_GET['rKdC']."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>" class="ico reff">&nbsp;REFRESH</a>		</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
</form>
</body>
</html>
<script language="javascript">
	var objfrm=document.myfrm;
	function P_Form(nRK)
	{
		var w=650;
		var h=550;
		var win=null;
		var txtHTML = "";
		var iErrors=0;
		
		LeftPosition=(screen.width)?(screen.width-w)/2:100; 
		TopPosition=(screen.height)?(screen.height-h)/2:100;
		URL = "Ref_Kode_Aset_Maping_Form.php?nRK="+nRK+"<?="&IdL=".$_GET['IdL']?>";
		settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=yes';
		win=window.open('','',settings);
		if (win!=null)
		{
			win.window.document.open()       			
			URL_Top = "Ref_Kode_Aset_Maping_Top.php?"+"<?="FrmG=".$_GET['FrmG']?>";
			URL_Mid = "Ref_Kode_Aset_Maping_Mid.php?nRK="+nRK+"<?="&rKdA=".$_GET['rKdA']."&rKdB=".$_GET['rKdB']."&rKdC=".$_GET['rKdC']."&FrmG=".$_GET['FrmG']."&IdL=".$_GET['IdL']?>";
			URL_Bot = "Ref_Kode_Aset_Maping_Bot.php";
			txtHTML="<html><head><title>Simbada Kab. Hulu Sungai Tengah</title></head><frameset framespacing='0' border='0' rows='45,*,30' frameborder='0'><frame name='WinFormWIN_Top' noresize src='"+URL_Top+"' scrolling='no'><frame name='WinFormWIN_Mid' src='"+URL_Mid+" scrolling='auto'><frame name='WinFormWIN_Bot' src= '"+URL_Bot+"' scrolling='no'><noframes><body><p>=>.............??!</p></body></noframes></frameset></html>" 
			win.focus()
			win.window.document.clear()
			win.window.document.write(txtHTML)
			win.window.document.close() 
			win.setTimeout("self.close()",200000000)
		}
	}
</script>
