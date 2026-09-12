<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Cetak dokumen</title>
	<link href="style.css" rel="stylesheet">
	<style>
		div.relative {
			position: relative;
			width: 220px;
			height: 150px;
			/*			  border: 3px solid #73AD21;*/

		}

		div.absolute-logo {
			position: absolute;
			top: 0px;
			left: 0px;
		}

		div.absolute-title {
			position: absolute;
			top: 0px;
			left: 37px;
		}

		div.absolute-code {
			position: absolute;
			top: 41px;
			left: 15px;


		}
	</style>
</head>

<body onload="window.print();">

	<div class="relative">
		<div class="absolute-logo"><img src="Images/logopemda.png" align="right" width="35" height="41" /></div>

		<div class="absolute-title">
			<font face="Arial Narrow" size="4">&nbsp;&nbsp;&nbsp;Aset Pemerintah Kab.Hulu Sungai Tengah</font>
		</div>

		<div class="absolute-code"><?php echo "<img src='" . $_GET['file'] . "' 
		align='center' width='170' height='130'>" ?></div>
	</div>
</body>

</html>
<!-- <script type="text/javascript">
	$("document").ready(function()
	{
	   
		   window.history.back();


	});
</script> -->