/* MENU
__________________________________________________ */

$(document).ready(function()	{
	var hash = window.location.hash.substr(1);
	var href = $('#infomenu ul li a').each(function(){
		var href = $(this).attr('href');
		var toRel = $(this).attr('rel');
		if (toRel != "listacc")	{
			if(hash == href.substr(0,href.length)){
				if ($(this).hasClass('listtopic')) {
					$("#infomenu a.listtopic").removeClass("mnspselect");
				} else {
					$("#infomenu a").removeClass("mnspselect");
				}
				$(this).addClass("mnspselect");
				var toLoad = hash+' #infoload';
				$('#infoload').load(toLoad,'',
				function showContent() {
					// Enlarge picture
					$(".enlarge").fancybox({ 
						'padding':'0px',
						'overlayOpacity':'0.8',
						'overlayColor':'#000',
						'hideOnContentClick': false,
						'titlePosition'  : 'over'
					});
		
					// Showroom
					$("#listshowroom .srtopic:nth-child(1)").addClass("mnsrselect mnsrclose");
					$("#listshowroom .srtopic:nth-child(1)").next().show();
					$("#listshowroom .srtopic").click(function(){
						if ($(this).hasClass("mnsrclose")) {
							$(this).removeClass("mnsrselect mnsrclose");
							$(this).next().slideUp(400);
						}	else	{
							$(".srcbox").slideUp(400);
							$("#listshowroom .srtopic").removeClass("mnsrselect mnsrclose");
							$("#listshowroom .srtopic").next().removeClass("srselect");
							$(this).addClass("mnsrselect mnsrclose");
							$(this).next().slideToggle(400);
						}
					});
					$(".srcbox").slides({
						slideSpeed: 600,
						generatePagination: false,
						generateNextPrev: true
					});
				});
			}
		}
	});

	$('#infomenu ul li .mnnormal').click(function(){
		var toLoad = $(this).attr('href')+' #infoload';
		$('#infoload').fadeIn(300,loadContent);
		$('#wrapper').show();
		window.location.hash = $(this).attr('href').substr(0,$(this).attr('href').length);
		function loadContent() { $('#infoload').load(toLoad,'',showNewContent); }
		function showNewContent() { 
			$('#infoload').show(hideLoader);
			
			// Enlarge picture
			$(".enlarge").fancybox({ 
				'padding':'0px',
				'overlayOpacity':'0.8',
				'overlayColor':'#000',
				'hideOnContentClick': false,
				'titlePosition' : 'over'
			});

			// Showroom
			$("#listshowroom .srtopic:nth-child(1)").addClass("mnsrselect mnsrclose");
			$("#listshowroom .srtopic:nth-child(1)").next().show();
			$("#listshowroom .srtopic").click(function(){
				if ($(this).hasClass("mnsrclose")) {
					$(this).removeClass("mnsrselect mnsrclose");
					$(this).next().slideUp(400);
				}	else	{
					$(".srcbox").slideUp(400);
					$("#listshowroom .srtopic").removeClass("mnsrselect mnsrclose");
					$("#listshowroom .srtopic").next().removeClass("srselect");
					$(this).addClass("mnsrselect mnsrclose");
					$(this).next().slideToggle(400);
				}
			});
			$(".srcbox").slides({
				slideSpeed: 600,
				generatePagination: false,
				generateNextPrev: true
			});
		}
		function hideLoader() { $('#wrapper').fadeOut(300); }
		return false;
	});
	
	// Selected menu for sub pages
	$("#infomenu a").click(function(){
		if ($(this).hasClass('listtopic')) {
			$("#infomenu a.listtopic").removeClass("mnspselect");
		} else {
			$("#infomenu a").removeClass("mnspselect");
		}
		$(this).addClass("mnspselect");
	});
});