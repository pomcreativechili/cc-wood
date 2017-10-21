/* HIGHLIGHT
__________________________________________________ */

$(document).ready(function()	{
	$('.hlprev').hide();
	$('#highlightboxarea').css({"margin-left":"-34px"});
	$('.hlb1 .highlightboxpic .hlcover').hide();
	$('.hlth1').addClass("hlbselect");
	
	// Previous
	$(".hlprev").click(function(){
		prevAction();
		chkCurrent();

		function chkCurrent()	{
			var prev = $(".hlprev").attr("class");
			var prevnum = parseInt(prev.substr(9,prev.length));
			if (prevnum == 0) $(".hlprev").hide();
			else $(".hlprev").show();

			var amount = $(".hlamount").attr("class");
			var amountnum = parseInt(amount.substr(12,amount.length));

			var next = $(".hlnext").attr("class");
			var nextnum = parseInt(next.substr(9,next.length)) - 1;
			if (nextnum == amountnum) $(".hlnext").hide();
			else $(".hlnext").show();
		}

		function prevAction()	{
			var current = $(".hlprev").attr("class");
			var currentnum = parseInt(current.substr(9,current.length))-1;
			var hlselect = current.substr(9,current.length);
			var hlselect1 = parseInt(hlselect)+1;
			var hlselect2 = parseInt(hlselect)+2;
			var hlselect3 = parseInt(hlselect)+3;
			
			$("#highlightbullet span").removeClass("hlbselect");
			$("#highlightbullet .hlth"+hlselect).addClass("hlbselect");
			
			if (currentnum == 0) $('#highlightboxarea').animate({marginLeft:"-162px"},400);
			
			// Action
			$('.highlightbox .highlightboxpic .hlcover').fadeIn(400);
			$('.hlb'+hlselect+' .highlightboxpic .hlcover').fadeOut(400);

			$('.highlightbox').animate({width:"124px",marginLeft:"19px"},400);
			$('.hlb'+hlselect).delay(400).animate({width:"366px"},400);
			$('.hlb'+hlselect+' .highlightboxinfo').delay(1300).fadeIn(300);
				
			$('#highlightboxarea').delay(400).animate({marginLeft:"+=143px"},400);
			$('.hlb'+hlselect1+', .hlb'+hlselect2+', .hlb'+hlselect3+', .hlcbox').delay(600).animate({marginLeft:"34px"},300);

			// Assign number
			var prev = $(".hlprev").attr("class");
			var prevclass = prev.substr(7,prev.length);
			var prevnum = parseInt(prevclass.substr(2,prevclass.length)) - 1;
			$(".hlprev").removeClass(prevclass);
			$(".hlprev").addClass("hl"+prevnum);
	
			var next = $(".hlnext").attr("class");
			var nextclass = next.substr(7,next.length);
			var nextnum = parseInt(nextclass.substr(2,nextclass.length)) - 1;
			$(".hlnext").removeClass(nextclass);
			$(".hlnext").addClass("hl"+nextnum);
		}
	});

	// Next
	$(".hlnext").click(function(){
		nextAction();
		chkCurrent();

		function nextAction()	{
			var current = $(".hlnext").attr("class");
			var currentnum = parseInt(current.substr(9,current.length))-1;
			var hlselect = current.substr(9,current.length);
			var hlselect1 = parseInt(hlselect)+1;
			var hlselect2 = parseInt(hlselect)+2;
			var hlselect3 = parseInt(hlselect)+3;

			$("#highlightbullet span").removeClass("hlbselect");
			$("#highlightbullet .hlth"+hlselect).addClass("hlbselect");
			
			if (currentnum == 1) $('#highlightboxarea').animate({marginLeft:"-19px"},400);
			
			// Action
			$('.highlightbox .highlightboxpic .hlcover').fadeIn(400);
			$('.hlb'+hlselect+' .highlightboxpic .hlcover').fadeOut(400);

			$('.highlightbox').animate({width:"124px",marginLeft:"19px"},400);
			$('.hlb'+hlselect).delay(400).animate({width:"366px"},400);
			$('.hlb'+hlselect+' .highlightboxinfo').delay(1300).fadeIn(300);
				
			$('#highlightboxarea').delay(400).animate({marginLeft:"-=143px"},400);
			$('.hlb'+hlselect1+', .hlb'+hlselect2+', .hlb'+hlselect3+', .hlcbox').delay(600).animate({marginLeft:"34px"},300);

			// Assign number
			var prev = $(".hlprev").attr("class");
			var prevclass = prev.substr(7,prev.length);
			var prevnum = currentnum;
			$(".hlprev").removeClass(prevclass);
			$(".hlprev").addClass("hl"+prevnum);
	
			var next = $(".hlnext").attr("class");
			var nextclass = next.substr(7,next.length);
			var nextnum = parseInt(nextclass.substr(2,nextclass.length)) + 1;
			$(".hlnext").removeClass(nextclass);
			$(".hlnext").addClass("hl"+nextnum);
		}

		function chkCurrent()	{
			var cprev = $(".hlprev").attr("class");
			var cprevnum = parseInt(cprev.substr(9,cprev.length));
			if (cprevnum == 0) $(".hlprev").hide();
			else $(".hlprev").show();

			var amount = $(".hlamount").attr("class");
			var amountnum = parseInt(amount.substr(12,amount.length));
	
			var cnext = $(".hlnext").attr("class");
			var cnextnum = parseInt(cnext.substr(9,cnext.length)) - 1;
			if (cnextnum == amountnum) $(".hlnext").hide();
			else $(".hlnext").show();
		}
	});

	// Each thumbnail
	$(".hlcover").click(function(){
		var thumb = $(this).attr("class");
		var thumbnum = parseInt(thumb.substr(12,thumb.length));
		var thumbmove = (thumbnum * 143) - 124;
		var hlselect1 = thumbnum+1;
		var hlselect2 = thumbnum+2;
		var hlselect3 = thumbnum+3;

		$("#highlightbullet span").removeClass("hlbselect");
		$("#highlightbullet .hlth"+thumbnum).addClass("hlbselect");

		$('.highlightbox .highlightboxpic .hlcover').fadeIn(400);
		$('.hlb'+thumbnum+' .highlightboxpic .hlcover').fadeOut(400);

		$('.highlightbox').animate({width:"124px",marginLeft:"19px"},400);
		$('.hlb'+thumbnum).delay(400).animate({width:"366px"},400);
		$('.hlb'+thumbnum+' .highlightboxinfo').delay(1300).fadeIn(300);

		$('#highlightboxarea').delay(400).animate({marginLeft:"-"+thumbmove+"px"},400);
		$('.hlb'+hlselect1+', .hlb'+hlselect2+', .hlb'+hlselect3+', .hlcbox').delay(600).animate({marginLeft:"34px"},300);

		// Assign number
		var prev = $(".hlprev").attr("class");
		var prevclass = prev.substr(7,prev.length);
		var prevnum = thumbnum - 1;
		$(".hlprev").removeClass(prevclass);
		$(".hlprev").addClass("hl"+prevnum);

		var next = $(".hlnext").attr("class");
		var nextclass = next.substr(7,next.length);
		var nextnum = thumbnum + 1;
		$(".hlnext").removeClass(nextclass);
		$(".hlnext").addClass("hl"+nextnum);
		
		chkCurrent();

		function chkCurrent()	{
			var prev = $(".hlprev").attr("class");
			var prevnum = parseInt(prev.substr(9,prev.length));
			if (prevnum == 0) $(".hlprev").hide();
			else $(".hlprev").show();

			var amount = $(".hlamount").attr("class");
			var amountnum = parseInt(amount.substr(12,amount.length));

			var next = $(".hlnext").attr("class");
			var nextnum = parseInt(next.substr(9,next.length)) - 1;
			if (nextnum == amountnum) $(".hlnext").hide();
			else $(".hlnext").show();
		}
	});
});