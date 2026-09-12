//$(document).ready(function()
//{
//		$("#responsecontainer").load("instansi.php");
//		var refreshId = setInterval(function() 
//		{
//			$("#responsecontainer").load('instansi.php?randval='+ Math.random());
//		}, 1000);
//});

$(document).ready(function()
{
	//$("#responsecontainer").load("instansi.php");
	//var refreshId = setInterval(function() 
	//{
	//	$("#responsecontainer").load('instansi.php');
	//}, 1200);

	$("#naviagation_div").load("navigation_load.php");
	var refreshId = setInterval(function() 
	{
		$("#naviagation_div").load('navigation_load.php');
	}, 1000);
	
	$("#kritiksaran_div").load("kritiksaran_load.php");
	var refreshId = setInterval(function() 
	{
		$("#kritiksaran_div").load('kritiksaran_load.php');
	}, 5000);

	$("#informasi_div").load("informasi_load.php");
	var refreshId = setInterval(function() 
	{
		$("#informasi_div").load('informasi_load.php');
	}, 1200);

	$("#rekapaset_div").load("rekapaset_load.php");
	var refreshId = setInterval(function() 
	{
		$("#rekapaset_div").load('rekapaset_load.php');
	}, 5000);

});
