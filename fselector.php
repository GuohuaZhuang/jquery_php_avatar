<?php

require_once('upload.php');

$error_log = null;
$imagefile = isset($_FILES['imagefile']) ? $_FILES['imagefile'] : null;
$imagepath = Upload($imagefile);
if (!empty($error_log)) {
    echo $error_log;
} else {
?>

<script type="text/javascript" src="scripts/avatar.js"></script>

<div>
  <div style="width: 400px;" class="div_avatar_container">
    <p>You can crop the image to use as your avatar</p>
    <div style="width: 300px; height: 300px;">
      <img id="photo" style="max-height: 300px; max-width: 300px;" src="<?php echo $imagepath; ?>">
    </div>
  </div>
 
  <div style="width: 400px;" class="div_avatar_container">
    <p>Crop picture preview (100px*100px)</p>
    <div id="preview" style="width: 100px; height: 100px; overflow: hidden; margin: 0px 0px 10px 10px;">
      <img src="<?php echo $imagepath; ?>" style="width: 100px; height: 100px; margin-left: 0px; margin-top: 0px;">
    </div>
    
    <form action="./index.php?favatar=1&XDEBUG_SESSION_START=1" method="POST">
    <div class="div_avatar_container" style="width: 200px; margin: 5px 0px 0px 10px;">
        <input type="hidden" id="imagepath" name="imagepath" value="<?php echo $imagepath; ?>"/>
        <label for="si_x1">X1:</label><input type="text" id="si_x1" name="si_x1" />,&nbsp;
        <label for="si_y1">Y1:</label><input type="text" id="si_y1" name="si_y1" /><br/>
        <label for="si_width">W&nbsp;:</label><input type="text" id="si_width" name="si_width" />,&nbsp;
        <label for="si_height">H<sub>&nbsp;&nbsp;</sub>:</label><input type="text" id="si_height" name="si_height" /><br/>
        <input type="submit" style="width: auto; margin-left: 0;" value="Save thumbnail avatar"/><br/>
    </div>
    </form>
    
  </div>
</div>

<?php } ?>

