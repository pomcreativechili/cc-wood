/* DEFAULT
__________________________________________________ */

$(document).ready(function()	{
	// Enlarge Picture
	$(".enlarge").fancybox({ 
		'padding':'0px',
		'overlayOpacity':'0.8',
		'overlayColor':'#000',
		'hideOnContentClick': false,
		'titlePosition':'over'
	});
	
	// Map
	$("#maparea .mapup").click(function(){
		$(this).hide();
		$("#maparea").find(".map").animate({top:"-83px", height:"136px"},300);
		$("#maparea a").animate({top:"-83px", height:"98px"},300);
		$("#maparea").find(".mapdown").show();
	});
	$("#maparea .mapdown").click(function(){
		$(this).hide();
		$("#maparea").find(".map").animate({top:"0px", height:"53px"},300);
		$("#maparea a").animate({top:"0px", height:"15px"},300);
		$("#maparea").find(".mapup").show();
	});
	
	// Contact
	$(".popupcontact").fancybox({
		'padding'			: '0px',
		'overlayOpacity'	: '0.9',
		'overlayColor'		: '#000',
		'width'				: 960,
		'height'			: 460,
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'hideOnOverlayClick': false,
		'type'				: 'iframe'
	});

	// Email Subscribe
	$(".popupsubscribe").fancybox({
		'padding'			: '0px',
		'overlayOpacity'	: '0.9',
		'overlayColor'		: '#000',
		'width'				: 320,
		'height'			: 520,
        'autoScale'     	: false,
        'transitionIn'		: 'none',
		'transitionOut'		: 'none',
		'hideOnOverlayClick': false,
		'type'				: 'iframe'
	});
});