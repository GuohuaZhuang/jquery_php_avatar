<?php

require_once('upload.php');

$error_log = null;
$imagefile = isset($_FILES['imagefile']) ? $_FILES['imagefile'] : null;
$imagepath = Upload($imagefile);
if (!empty($error_log)) {
    echo $error_log;
} else {
?>

<script type="text/javascript">


function CalcDefaultThumbSize(swidth, sheight, twidth, theight) {
	var wscale = swidth / twidth;
	var hscale = sheight / theight;
	var minw = 0.0;
	var minh = 0.0;
	
	if (wscale > hscale) {
		minh = sheight;
		minw = twidth * hscale;
	} else {
		minh = theight * wscale;
		minw = swidth;
	}
	var x1 = (swidth - minw) / 2;
	var y1 = (sheight - minh) / 2;
	
	return {'x1': x1, 'y1': y1, 'swidth': minw, 'sheight': minh };
}


    function preview(img, selection) {
        if (!selection.width || !selection.height)
            return;
        
        var scaleX = 100 / selection.width;
        var scaleY = 100 / selection.height;
        
        $('#preview img').css({
            width: Math.round(scaleX * img.width),
            height: Math.round(scaleY * img.height),
            marginLeft: -Math.round(scaleX * selection.x1),
            marginTop: -Math.round(scaleY * selection.y1)
        });

        $('#si_x1').val(selection.x1);
        $('#si_y1').val(selection.y1);
        $('#si_width').val(selection.width);
        $('#si_height').val(selection.height);
    }

    $(window).load(function() {
        console.log("photo width = " + $('#photo').width());
        console.log("photo height = " + $('#photo').height());
        // Calculate a default selector
        var pwidth = $('#photo').width();
        var pheight = $('#photo').height();
        var sizearr = CalcDefaultThumbSize(pwidth, pheight, 100, 100);
        console.log("x1 = " + sizearr.x1 + ", y1 = " + sizearr.y1 + "\n");
        console.log("swidth = " + sizearr.swidth + ", sheight = " + sizearr.sheight + "\n");
        
        $('#photo').imgAreaSelect({ aspectRatio: '1:1', handles: true,
            fadeSpeed: 200, onSelectChange: preview,
            x1: sizearr.x1, y1: sizearr.y1, x2: (sizearr.x1+sizearr.swidth), y2: (sizearr.y1+sizearr.sheight) });
        
        var selection = {x1: sizearr.x1, y1: sizearr.y1, width: sizearr.swidth, height: sizearr.sheight };
        var img = {width: pwidth, height: pheight};
        preview(img, selection);
    });
</script>

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

