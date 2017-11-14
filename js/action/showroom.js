/* SHOWROOM
__________________________________________________ */

$(document).ready(function()	{
	$('.productgallery').owlCarousel({
		items:1,
	    loop:true,
	    autoplay:false,
	    margin:0,
	    nav:true,
	    dots:true,
	});

	$('.productzoom').zoomy({ border:'3px solid #fff' });
});