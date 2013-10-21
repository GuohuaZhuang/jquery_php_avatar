/*
  I want to thanks for the tip from http://jsfiddle.net/gKVKm/36/
  The input tag with type="file" width is incompatible in chrome and firefox, 
  which make me totally freak out in a minute!
*/
$(window).load(function() {
    $("#dropzone_container").mousemove(function(e) {
        var offL, offR, inpStart;
        offL = $(this).offset().left;
        offT = $(this).offset().top;
        aaa= $(this).find("input").width();
        $(this).find("input").css({
            left:e.pageX-20,
            top:e.pageY-20
        })
    });
});
