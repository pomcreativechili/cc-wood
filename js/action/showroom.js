/* SHOWROOM
__________________________________________________ */

$(document).ready(function()	{
	$("#productgallery, .srcbox").slides({
		slideSpeed: 600,
		generatePagination: false,
		generateNextPrev: true
	});

	$('.productzoom').zoomy({ border:'3px solid #fff' });
});