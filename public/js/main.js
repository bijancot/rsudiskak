

$('#menu-btn').on('click', function(){
    $('.side-navbar').toggleClass('active');
    $('.nav').animate({left:0});
});

$('#blocker').on('click', function(){
    $('.nav').animate({left:-250});
    $('.side-navbar').toggleClass('active');
});

$('.collapsible-head').on('click', function(){
    $(this).toggleClass('inactive');
});