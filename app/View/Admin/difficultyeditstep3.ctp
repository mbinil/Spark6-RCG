<?php $diffinfo = $this->Session->read('diffinfo'); ?>
<?php $newinfo = $this->Session->read('newdiffinfo'); ?>
<link href="<?php echo Router::url('/app/webroot/file_upload/css/style.css',true); ?>" rel="stylesheet" />
<!--Right said start--> 
<div class="sitemap_nav">
    <ul class="nav nav-pills">
      <li ><a href="<?php echo Router::url('/', true); ?>admin/difficultyeditstep1/<?php echo $diffinfo[0]['Difficulty']['id']; ?>">Description</a></li>
      <li ><a href="<?php echo Router::url('/', true); ?>admin/difficultyeditstep2/<?php echo $diffinfo[0]['Difficulty']['id']; ?>">Award</a></li>
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/difficultyeditstep3/<?php echo $diffinfo[0]['Difficulty']['id']; ?>">Decal</a></li>
      <li><a>Save</a></li>
    </ul>
</div>
<div class="clear"></div>
<hr/> 
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
<div class="btn_next">
  <a href="javascript:editsave();" class="btn btn-primary btn-block">Save<span class="fui-arrow-right pull-right"></span></a>
</div>
<h1>Please upload a decal.</h1>
<h3>It will automatically by applied to any challenge's badge that it is associated with! </h3>
<br /><br />
<div class="clear"></div>
<!--discrption--> 
<input type="hidden" value="<?php echo $diffinfo[0]['Difficulty']['id']; ?>" id="diffid">
<?php if($diffinfo[0]['Difficulty']['decal']!=''){ ?>
<div style="position: absolute; margin: 39px 0px 0px 0px;">
<img src="<?php echo "../../img/diffuploads/".$diffinfo[0]['Difficulty']['decal']; ?>" width="120" height="120" alt="<?php echo $diffinfo[0]['Difficulty']['title']; ?>" style="background-color:#999999;" />
</div>
<?php } ?>
<div class="Difficulty_step1" style="width:65%; float:left;">
<div class="discrption_label">Decal:</div>

<!--drag & drop starting here-->
      <form id="upload" method="post" action="<?php echo Router::url('/admin/difficulties_uploads',true); ?>" enctype="multipart/form-data">
        <input type="hidden" id="temp_fileuploaded" name="temp_fileuploaded" value="<?php echo $diffinfo[0]['Difficulty']['decal']?$diffinfo[0]['Difficulty']['decal']:''; ?>"/>
        <input type="hidden" name="root_path" id="root_path" value="<?php echo Router::url('/app/webroot/img/diffuploads', true); ?>" />
        <input type="hidden" id="fileuploaded" value="" name="fileuploaded"/>
		<input type="hidden" name="image_rand_num" id="image_rand_num" value="" />
        <div id="drop" style="background-color: white;width:105%;height:120px;"> <br/>
          <br/>
          drop decal graphic here<br/>
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

<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.knob.js',true); ?>"></script>
<!-- jQuery File Upload Dependencies -->
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.ui.widget.js',true); ?>"></script>
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.iframe-transport.js',true); ?>"></script>
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.fileupload.js',true); ?>"></script>
<!-- Our main JS file -->
<script src="<?php echo Router::url('/app/webroot/file_upload/js/script.js',true); ?>"></script>