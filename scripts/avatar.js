
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
    // Calculate a default selector
    var pwidth = $('#photo').width();
    var pheight = $('#photo').height();
    var sizearr = CalcDefaultThumbSize(pwidth, pheight, 100, 100);
    
    $('#photo').imgAreaSelect({ aspectRatio: '1:1', handles: true,
        fadeSpeed: 200, onSelectChange: preview,
        x1: sizearr.x1, y1: sizearr.y1, x2: (sizearr.x1+sizearr.swidth), y2: (sizearr.y1+sizearr.sheight) });
    
    var selection = {x1: sizearr.x1, y1: sizearr.y1, width: sizearr.swidth, height: sizearr.sheight };
    var img = {width: pwidth, height: pheight};
    preview(img, selection);
});

