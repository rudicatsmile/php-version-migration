<?
	$DataPerPage = 500;
	if ($DataPerPageF!=0) {$DataPerPage=$DataPerPageF;} else {$DataPerPage=$DataPerPage;}
	if (isset($_GET['Page'])){
		if ($_GET['Page']!="")
			{$NoPage = $_GET['Page'];}
		else
			{$NoPage = 1;}
	}
	else{
		$NoPage = 1;
	}

	$Offset = ($NoPage - 1) * $DataPerPage;

	if (isset($_GET['iG'])){
		if ($_GET['iG']!=""){
			$iG = $_GET['iG'];
		}
		else{
			$iG = 1;
		}
	}
	else{
		$iG=1;
	}
?>