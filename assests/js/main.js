$(document).ready(function(){		
	$("td.left a.menuitem").each(function(i){
		i += 1;
		$(this).css('-webkit-transition-delay', (i * 0.2)+'s' )
		       .css('-moz-transition-delay', (i * 0.2)+'s')
		       .css('-ms-transition-delay', (i * 0.2)+'s')
		       .css('-o-transition-delay', (i * 0.2)+'s')
		       .css('transition-delay', (i * 0.2)+'s');
    });
    $('#menuarrow').appendTo('.selected');

});
