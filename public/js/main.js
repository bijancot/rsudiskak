

$('#menu-btn').click(function(){
    $('.side-navbar').toggleClass('active');
    $('.nav').animate({left:0});
});

$('#blocker').click(function(){
    $('.nav').animate({left:-250});
    $('.side-navbar').toggleClass('active');
});