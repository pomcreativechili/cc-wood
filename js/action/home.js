/* HOME
__________________________________________________ */

$(document).ready(function()	{
	// $("#highlight").slides({
	// 	slideSpeed: 600,
	// 	generatePagination: false,
	// 	generateNextPrev: true,
	// 	autoHeight: true
	// });

	$('#highlightboxarea').owlCarousel({
		items:1,
	    loop:true,
	    autoplay:false,
	    margin:0,
	    nav:true,
	    dots:false,
	});

	$("#video").slides({
		slideSpeed: 600,
		generatePagination: false,
		generateNextPrev: true,
		autoHeight: true
	});

	$(".vdopopup").fancybox({
		'padding':'0px',
		'overlayOpacity':'0.8',
		'overlayColor':'#000',
		'transitionIn'	: 'none',
		'transitionOut'	: 'none',
		'hideOnContentClick': false,
		'hideOnOverlayClick': false,
		'centerOnScroll': true,
		'autoDimensions': true
	});
});

$(function() {
	$('#da-slider').cslider({
		autoplay	: true,
		bgincrement : 50,
		interval    : 7000
	});
});