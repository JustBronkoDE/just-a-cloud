
/* Init Navigation */
$(document).ready(function() {
    var screenWidth = window.innerWidth;
    if (screenWidth > 992) {
        $('.dashboard-nav .left').addClass('shown');
    } else {
        $('.dashboard-nav .left').addClass('minimized');
    }

    if ($('.dashboard-nav .left').hasClass('minimized')) {
        $('body').css('margin-left', '70px');
        $('#nav-toggle').css('margin-left', '0');
    }
});

/* Init toggle button */
$('#nav-toggle').click(function(event) {
    $('.dashboard-nav > .left').toggleClass('minimized');
    $('.dashboard-nav > .left').toggleClass('shown');

    if ($('.dashboard-nav .left').hasClass('minimized')) {
        $('body').css('margin-left', '70px');
        $('#nav-toggle').css('margin-left', '0');
    } else {
        $('body').css('margin-left', '300px');
        $('#nav-toggle').css('margin-left', '30px');
    }
});

/* Ripple Effect */
$(function(){
	var ink, d, x, y;
	$(".wave").click(function(e){
        if($(this).find(".ink").length === 0){
            $(this).prepend("<span class='ink'></span>");
        }
             
        ink = $(this).find(".ink");
        ink.removeClass("animate");
         
        if(!ink.height() && !ink.width()){
            d = Math.max($(this).outerWidth(), $(this).outerHeight());
            ink.css({height: d, width: d});
        }
         
        x = e.pageX - $(this).offset().left - ink.width()/2;
        y = e.pageY - $(this).offset().top - ink.height()/2;
         
        ink.css({top: y+'px', left: x+'px'}).addClass("animate");
    });
});

/* Toast function */
function addToast(content, duration, type) {
	switch(type) {
		case 'primary':
			var toast = '<li class="toast primary fadeIn">' + content + '<li>'
			break;
		case 'success':
			var toast = '<li class="toast success fadeIn">' + content + '<li>'
			break;
		case 'info':
			var toast = '<li class="toast info fadeIn">' + content + '<li>'
			break;
		case 'warning':
			var toast = '<li class="toast warning fadeIn">' + content + '<li>'
			break;
		case 'danger':
			var toast = '<li class="toast danger fadeIn">' + content + '<li>'
			break;
		default:
			var toast = '<li class="toast fadeIn">' + content + '<li>'
	}
	if ( !$('.toastContainer').length ) {
		var container = '<ul class="toastContainer">' + toast + '</ul>'
		$('body').append(container);
	} else {
		$('.toastContainer').append(toast);		
	}
	
	for (var i = $('.toastContainer .toast.fadeIn').length - 1; i >= 0; i--) {
		setTimeout(function() {
			$('.toastContainer').children('.toast.fadeIn').first().removeClass('fadeIn').addClass('fadeOut');
			setTimeout(function() {
				$('.toastContainer').children('.toast.fadeOut').first().remove();
			}, 500);
		}, duration);
	}
}