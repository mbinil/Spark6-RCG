<?php $diffinfo = $this->Session->read('newdiffinfo'); ?>
<?php $stepinfo = $this->Session->read('stepinfo'); ?>
<link href="<?php echo Router::url('/app/webroot/file_upload/css/style.css',true); ?>" rel="stylesheet" />
<!--Right said start--> 
<script type="text/javascript">
/*Field validation on blur of an input element*/
function validateFieldcheck(id,val)
{
	if(val == "" || val.length < 3)
	{
		$("#"+id).css("border-color", "red");
	}
	else
	{
		$("#"+id).css("border-color", "#BDC3C7");
	}
}
</script>  
<!--Right said start-->   
<div class="sitemap_nav">
    <ul class="nav nav-pills">
      <li><a href="<?php echo Router::url('/', true); ?>admin/difficultyaddstep1">Description</a></li>
      <li><a href="<?php echo Router::url('/', true); ?>admin/difficultyaddstep2" <?php if($stepinfo<2) { ?>onclick="this.removeAttribute('href');" <?php } ?> >Award</a></li>
      <li class="active" ><a href="<?php echo Router::url('/', true); ?>admin/difficultyaddstep3" <?php if($stepinfo<3) { ?>onclick="this.removeAttribute('href');" <?php } ?>>Decal</a></li>
      <li><a>Save</a></li>
    </ul>
</div>
<div class="clear"></div>
<hr/>      
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
<div class="btn_next">
  <a href="javascript:gotosave();" class="btn btn-primary btn-block">Save<span class="fui-arrow-right pull-right"></span></a>
</div>
<h1>Please upload a decal.</h1>
<h3>It will automatically be applied to any Challenge's badge that it is associated with!</h3>
<br /><br />
<div class="clear"></div>
<?php if(isset($diffinfo['decal']) && $diffinfo['decal']!=''){ ?>
<div style="position: absolute; margin: 39px 0px 0px 0px;">
<img src="<?php echo Router::url('/', true)."img/diffuploads/".$diffinfo['decal']; ?>" width="120" height="120" />
</div>
<?php } ?>
  <!----Error message div------------------>
  <div class="alert" id="alert_div" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
    <button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
    <span id="message_span"></span>	
  </div>
<!--------------------------------------->
<!--discrption--> 
<div class="Difficulty_step1" style="width:65%; float:left;">
<div class="discrption_label">Decal:</div>
<div class="clear"></div>


<!--drag & drop starting here-->
    <form id="upload" method="post" action="difficulties_uploads" enctype="multipart/form-data">
        <input type="hidden" name="fileuploaded" id="fileuploaded" />
		<input type="hidden" name="draganddropfrom" id="draganddropfrom" value="difficulty_add" />
        <input type="hidden" name="root_path" id="root_path" value="<?php echo Router::url('/app/webroot/img/diffuploads', true); ?>" />
		<input type="hidden" name="image_rand_num" id="image_rand_num" value="" />
        <div id="drop" style="background-color: white;width:105%;height:120px;"> <br/>
            <br/>
            Drop decal graphic here<br/>
            You can also <a style="text-decoration: underline; color:#999999;">browse for a file</a>
            <input type="file" name="upl" />
        </div>
        <div class="discrption_label_right" style="margin-bottom:1px;margin-top:-20px;">note: this must be of type GIF or PNG</div>
        <ul id="show_file_ul" style="width:480px;margin:0 -20px;">
        <!-- The file uploads will be shown here -->
        </ul>
    </form>
<!--drag & drop ends here-->

</div>
<!--discrption end--> 
</div>    
<!--right said end--> 
<!-- JavaScript Includes -->
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.knob.js',true); ?>"></script>
<!-- jQuery File Upload Dependencies -->
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.ui.widget.js',true); ?>"></script>
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.iframe-transport.js',true); ?>"></script>
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.fileupload.js',true); ?>"></script>
<!-- Our main JS file -->
<script src="<?php echo Router::url('/app/webroot/file_upload/js/script.js',true); ?>"></script>