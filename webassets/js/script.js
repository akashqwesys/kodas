
$(document).ready(function(){
  $('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 135,
    itemMargin: 5,
    asNavFor: '#slider',
  });

  $('#slider').flexslider({
    animation: "fade",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#carousel" });

  $(".zoom").elevateZoom();
})

$(window).on('load', function(){
  controll(0);
  $(".loader").remove();
});

$("#carousel .slides li").click(function(){
  controll($(this).index())
})

function controll(myIndex){
  var i = 0
  $(".zoomContainer").each(function() {
    var myPos= (i == myIndex) ? 2 : 0;
    $(this).css({"z-index": myPos});
    i++;
  });
}