/* TOP MENU
__________________________________________________ */

var timeout         = 200;
var closetimer		= 0;
var ddmenuitem      = 0;
	
function jsddm_open()	{
	jsddm_canceltimer();
	jsddm_close();
	ddmenuitem = $(this).find('.submenu').eq(0).css('visibility', 'visible');
}
	
function jsddm_close()	{
	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');
}

function jsddm_timer()	{
	closetimer = window.setTimeout(jsddm_close, timeout);
}

function jsddm_canceltimer()	{
	if(closetimer) { 
		window.clearTimeout(closetimer);
		closetimer = null; 
	}
}
	
$(document).ready(function()	{
	$('#topmenu > li').bind('mouseover', jsddm_open);
	$('#topmenu > li').bind('mouseout',  jsddm_timer);
});

document.onclick = jsddm_close;