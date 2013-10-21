<?php

require_once('upload.php');

$error_log = null;

if (isset($_POST['si_submit'])) {
    $x1 = isset($_POST['si_x1']) ? $_POST['si_x1'] : 0;
    $y1 = isset($_POST['si_y1']) ? $_POST['si_y1'] : 0;
    $swidth = isset($_POST['si_width']) ? $_POST['si_width'] : 0;
    $sheight = isset($_POST['si_height']) ? $_POST['si_height'] : 0;
    $imagepath = isset($_POST['imagepath']) ? $_POST['imagepath'] : null;
    $thumbpath = Generatethumb($imagepath, $x1, $y1, $swidth, $sheight, 100, 100);
}

if (!empty($error_log)) {
    echo $error_log;
} else {
?>

<script type="text/javascript" src="scripts/avatar_container.js"></script>

<input type="hidden" id="thumbpath" name="thumbpath" 
    value="<?php echo (isset($thumbpath) ? $thumbpath : ''); ?>"/>

<form action="./index.php?fselector=1&XDEBUG_SESSION_START=1" method="POST" enctype="multipart/form-data">
    <div id="dropzone_container">
        <?php if (isset($thumbpath) && !empty($thumbpath)) { ?>
        <!-- has avatar already -->
        <div class="div_change_avatar">
            <div class="default_text">
                <div class="photo_icon"></div>
                <b>Change avatar</b>
            </div>
        </div>
        <div class="change_btn" title="Reset">
            <img id="photo" style="max-height: 100px; max-width: 100px; border-radius: 10px;" 
                src="<?php echo (isset($thumbpath) ? $thumbpath : ''); ?>">
        </div>
        <?php } else { ?>
        <!-- has no avatar -->
        <div class="reset_btn" title="Reset"><b class="icon"></b></div>
        <div class="help_text">
            <div class="default_text">
                <div class="photo_icon"></div>
                <span>Choose a photo</span>
            </div>
        </div>
        <?php } ?>
        <div>
            <input type="file" id="imagefile" name="imagefile" accept="image/*" size="1"
                onchange="javascript:this.form.submit();" title="Click on it to upload an avatar">
        </div>
    </div>
</form>

<?php } ?>

