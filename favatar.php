<?php

require_once('upload.php');

$error_log = null;

$x1 = isset($_POST['si_x1']) ? $_POST['si_x1'] : 0;
$y1 = isset($_POST['si_y1']) ? $_POST['si_y1'] : 0;
$swidth = isset($_POST['si_width']) ? $_POST['si_width'] : 0;
$sheight = isset($_POST['si_height']) ? $_POST['si_height'] : 0;
$imagepath = isset($_POST['imagepath']) ? $_POST['imagepath'] : null;

$thumbpath = Generatethumb($imagepath, $x1, $y1, $swidth, $sheight, 100, 100);

if (!empty($error_log)) {
    echo $error_log;
} else {
?>

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

<input type="hidden" id="thumbpath" name="thumbpath" value="<?php echo $thumbpath; ?>"/>

<form action="./index.php?fselector=1&XDEBUG_SESSION_START=1" method="POST" enctype="multipart/form-data">
    <div id="dropzone_container">
        <div class="div_change_avatar">
            <div class="default_text">
                <div class="photo_icon"></div>
                <b>Change avatar</b>
            </div>
        </div>
        <div class="change_btn" title="Reset">
            <img id="photo" style="max-height: 100px; max-width: 100px;" src="<?php echo $thumbpath; ?>">
        </div>
        <div>
        <input type="file" id="imagefile" name="imagefile" accept="image/*" size="1"
            onchange="javascript:this.form.submit();" title="Click on it to upload an avatar">
        </div>
    </div>
</form>

<?php } ?>

