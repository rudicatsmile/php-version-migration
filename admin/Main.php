<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title><?php require_once 'AppTitle.php'; echo APP_TITLE; ?></title>

<LINK REL="SHORTCUT ICON" HREF="../css/icon/icon.ico">
</head>
<?php
$IdL = $_COOKIE['fIdL'];
?>
<frameset rows="45,*" border=0>
	<frame frameborder="0" name="TopFrame" scrolling="no"   noresize src="<?php echo "FileHeader.php?IdL=".base64_decode(base64_decode(base64_decode($IdL))) ?>" style="background: #044f8e; word-spacing: 0; margin-bottom: 0; padding:0">
	<frame frameborder="0" name="MidFrame" scrolling="auto" noresize src="<?php echo "Home.php?IdL=".base64_decode(base64_decode(base64_decode($IdL))) ?>" style="padding: 0">
</frameset><noframes></noframes>
<body>
</body>
</html>
