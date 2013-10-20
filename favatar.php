<?php

require_once('upload.php');

$error_log = null;

$x1 = isset($_POST['si_x1']) ? $_POST['si_x1'] : 0;
$y1 = isset($_POST['si_y1']) ? $_POST['si_y1'] : 0;
$swidth = isset($_POST['si_width']) ? $_POST['si_width'] : 0;
$sheight = isset($_POST['si_height']) ? $_POST['si_height'] : 0;
$imagepath = isset($_POST['imagepath']) ? $_POST['imagepath'] : null;

/*
echo '$x1 = ' . $x1 . "<br/>\n";
echo '$y1 = ' . $y1 . "<br/>\n";
echo '$swidth = ' . $swidth . "<br/>\n";
echo '$sheight = ' . $sheight . "<br/>\n";
*/

$thumbpath = Generatethumb($imagepath, $x1, $y1, $swidth, $sheight, 100, 100);

if (!empty($error_log)) {
    echo $error_log;
} else {
?>

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
        <div class="help_text">
            <div class="default_text">
                <div class="photo_icon"></div>
                <span>Choose a photo</span>
            </div>
        </div>
        <input type="file" id="imagefile" name="imagefile" accept="image/*" onchange="javascript:this.form.submit();">
    </div>
</form>

<?php } ?>

