<?php
include "session.php";
seSession('BERANDA');
date_default_timezone_set('Asia/Jakarta');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Simbada Hulu Sungai Tengah</title>
<link rel="shortcut icon" HREF="css/icon/icon.ico">
<meta name="keywords" content="Sipand BMD">
<meta name="Language" content="English">
<link rel="stylesheet" type="text/css" href="css/style.css" >
<link rel="stylesheet" type="text/css" href="css/dropdown.css">
<link rel="stylesheet" type="text/css" href="css/display.css">
<script type="text/javascript" src="js/jquery-1.3.2.min"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/dropdown.js"></script>
<script type="text/javascript" src="js/slideshow.js"></script>
<script type="text/javascript" src="js/display.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<script type="text/javascript" src="js/general.js"></script>
<script type="text/javascript" src="js/autorefresh.js"></script>
</head>
<body onload="func_view_data('detail_data','home.php','')">
<div id="dat"><script type="text/javascript" src="js/tanggal.js"></script></div>
<div id="pag">
	<?php include "header.php";?>
	<?php include "menu.php";?>
	<?php include "main.php";?>
</div>
<?php include "bottom.php";?>
</body>
</html>
