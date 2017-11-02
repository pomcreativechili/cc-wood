/* ACCORDIAN
__________________________________________________ */

$(document).ready(function(){
	$("#listacc .listbox").not(':first').fadeOut(1);
	$("#listacc .listtopic").click(function(){
		if ($(this).hasClass("mnlsclose")) {
			$(this).removeClass("mnlsclose");
			$(this).removeClass("mnlsselect");
			$(this).next().slideUp(400);
		}	else	{
			$(".listbox").slideUp(400);
			$("#listacc .listtopic").removeClass("mnlsselect");
			$("#listacc .listtopic").removeClass("mnlsclose");
			$(this).addClass("mnlsselect");
			$(this).addClass("mnlsclose");
			$(this).next().slideToggle(400);
		}
	});

	$('ul.listacc li a').on('click', function() {
		var elm = '#' + $(this).attr('name');
		$(elm).trigger('click');
	});

	$('.listbox .owl-carousel').owlCarousel({
		items:1,
	    loop:true,
	    autoplay:true,
	    margin:0,
	    nav:true,
	    dots:true,
	});
});