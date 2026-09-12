<?php
extract($_POST);
if ($fWinNm!="MidFrame")
{
	?>
	<script language="JavaScript">	
		window.open("FileHeader.php","TopFrame");
		this.setTimeout("self.close()",1)
	</script>
	<?php
}
else
{
	$URL="../index.php";
	header("Location: ".$URL);
}
?>