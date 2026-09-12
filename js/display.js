 var timer = null; 
 function openContent(trigger,divID){ 
	$('#divTrigger a').each( 
		function(){
			$(this).css({'background-color':'#FFF','color':'#000'});			 	
		}
	);
	$('#divContent div').hide();
	$('#'+divID).fadeIn('slow');
	$(trigger).css({'background-color':'#00A','color':'#FFF'});	 	
	if(timer != null) clearTimeout(timer);
	timer = setTimeout( 
	  function(){		
		var nextAnchor = ($(trigger).next('a').text() == '') ? $('#divTrigger a:first') : $(trigger).next('a');
		nextAnchor.click();
	  }, 5000
	);
 }	 

$(document).ready(
	function(){
	openContent($('#firstSlide'),'div00');			
	}
)
