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

/* Zoom effect of Register */
$('.button.register-button').click(function register(event) {
    $('.auth .right').css('flex-basis', '100%');
    $('.auth').css({
       height: '100vh',
       width: '100vw',
       zIndex: '5000'
    });
    $('.auth .left').css('flex-basis', '0%');
    $('.auth .heading').css('color', '#fff');
    $('.button.register-button').remove();
    $('.auth .right .content').hide();
    $('.auth .right form')
        .css('display','flex')
        .hide()
        .delay(200)
        .fadeIn(200);
    $('.auth .right img').removeAttr('height')
    $('.auth .right img').attr('width', '100%;');
});

/* Login loading screen*/
$('.button.login-button').click(function login(event) {
    var spinner = '<div class="spinner">';
        spinner += '<div class="bounce1"></div>';
        spinner += '<div class="bounce2"></div>';
        spinner += '<div class="bounce3"></div>';
        spinner += '</div>';
    $('.auth .left').css('flex-basis', '100%');
    $('.auth').css({
       height: '100vh',
       width: '100vw',
       zIndex: '5000'
    });
    $('.auth .right').css('flex-basis', '0%');
    $('.auth .heading').hide();
    $('.button.register-button').remove();
    $('.auth .left form').hide();
    $('.auth .left').css({
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center'
    }).append(spinner)
});