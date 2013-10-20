<form action="./index.php?fselector=1&XDEBUG_SESSION_START=1" method="POST" enctype="multipart/form-data">
    <div id="dropzone_container">
        <div class="reset_btn" title="Reset"><b class="icon"></b></div>
        <div class="help_text">
            <div class="default_text">
                <div class="photo_icon"></div>
                <span>Choose a photo</span>
            </div>
        </div>
        <input type="file" id="imagefile" name="imagefile" accept="image/*" onchange="javascript:this.form.submit();">
    </div>
</form>
