<?
extract($_POST);
if ($fWinNm!="MidFrame")
{
	?>
	<script language="JavaScript">	
		window.open("FileHeader.php","TopFrame");
		this.setTimeout("self.close()",1)
	</script>
	<?
}
else
{
	$URL="../index.php";
	header("Location: ".$URL);
}
?>