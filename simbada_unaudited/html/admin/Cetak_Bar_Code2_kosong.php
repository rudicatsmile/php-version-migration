
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cetak dokumen</title>
    <link href="style.css" rel="stylesheet">
	<style>
			div.relative {
			  position: relative;
			  width: 420px;
			  height: 160px;
			  border: 3px solid #000;

			} 
			div.absolute-logo{
			  position: absolute;
			  top: 0px;
			  left: 0px;			 
			}

			div.absolute-title {
			  position: absolute;
			  top: 5px;
			  left: 67px;			 
			}

			div.absolute-code {
			  position: absolute;
			  top: 41px;
			  left:8px;		  
			  
			}

			div.absolute-logo2{
			  position: absolute;
			  top: 50px;
			  left: 125px;			 
			}

			div.absolute-hr{
			  position: absolute;
			  top: 25px;
			  left: 0px;
			  width: 420px;
			}

			div.absolute-register {
			  position: absolute;
			  top: 80px;
			  left: 267px;	
			  font-size:9pt;	
			  font-family: Calibri;	 
			}
	</style>
</head>
<body> 	

	<div class="relative">
	  	
  		<div class="absolute-title"><font face="Arial Narrow" size="4">&nbsp;&nbsp;&nbsp;Aset Pemerintah Kabupaten Hulu Sungai Tengah</font></div>
  		<div class="absolute-hr"><hr style="height:2px;border-width:2;color:black;background-color:black"></div>
		
  		<div class="absolute-code"><?php echo "<img src='" . $_GET['file'] ."' align='center' width='125' height='110'>"?></div>
		<div class="absolute-logo2"><img src="Images/logopemda.png" align="right" width="110" height="105" /></div>
		<div class="absolute-register">		
			<font color="#FFF">KKKKKKKKKKKKKKKKKKKKKK</font>	
			<hr>			
		</div>
  	 </div>
</body>
</html>
<!-- <script type="text/javascript">
	$("document").ready(function()
	{
       
       	window.history.back();


    });
</script> -->

