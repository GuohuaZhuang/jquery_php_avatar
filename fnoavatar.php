<script type="text/javascript">
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
</script>

<form action="./index.php?fselector=1&XDEBUG_SESSION_START=1" method="POST" enctype="multipart/form-data">
    <div id="dropzone_container">
        <div class="reset_btn" title="Reset"><b class="icon"></b></div>
        <div class="help_text">
            <div class="default_text">
                <div class="photo_icon"></div>
                <span>Choose a photo</span>
            </div>
        </div>
        <div>
        <input type="file" id="imagefile" name="imagefile" accept="image/*" size="1"
            onchange="javascript:this.form.submit();" title="Click on it to upload an avatar">
        </div>
    </div>
</form>

