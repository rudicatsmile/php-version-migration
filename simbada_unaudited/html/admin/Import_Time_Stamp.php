<?
	define("MIN_DATES_DIFF", 25569);	// Numbers of second in a day:
	define("SEC_IN_DAY", 86400);
	
	function excel2timestamp($excelDate)
	{
		if ($excelDate <= MIN_DATES_DIFF) {return 0;}
		return  ($excelDate - MIN_DATES_DIFF) * SEC_IN_DAY;
	}  

?>