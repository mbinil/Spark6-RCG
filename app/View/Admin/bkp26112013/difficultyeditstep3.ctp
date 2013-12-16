<?php $diffinfo = $this->Session->read('diffinfo'); ?>
<?php $newinfo = $this->Session->read('newdiffinfo'); ?>
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
<div style="position: absolute; margin: 39px 0px 0px 34px;">
<img src="<?php echo "../../img/diffuploads/".$diffinfo[0]['Difficulty']['decal']; ?>" width="100" height="100" alt="<?php echo $diffinfo[0]['Difficulty']['title']; ?>" />
</div>
<?php } ?>
<div class="Difficulty_step1" style="width:65%; float:left;">
<div class="discrption_label">Decal:</div>
<div class="clear"></div>
<div id="dragandrophandler">drop decal graphic here</div>
<div id="status1" style="width:100%;"></div>
<div class="clear"></div>
<div class="discrption_label_right">note: this must be of type GIF or PNG</div>
<input type="hidden" id="temp_fileuploaded" name="temp_fileuploaded" value="<?php echo $diffinfo[0]['Difficulty']['decal']?$diffinfo[0]['Difficulty']['decal']:''; ?>"/>
<input type="hidden" id="fileuploaded" value="<?php if(isset($newinfo['decal'])!=''&& $newinfo['decal']!=''){ echo $newinfo['decal']; } if($diffinfo[0]['Difficulty']['decal']!=''){ echo $diffinfo[0]['Difficulty']['decal']; } ?>"/>
</div>
<!--discrption end--> 
</div>    
<!--right said end--> 
<script type="text/javascript">
function sendFileToServer(formData,status)
{
    var uploadURL ="../difficulties_uploads"; //Upload URL
    var extraData ={}; //Extra Data.
    var jqXHR=$.ajax({
            xhr: function() {
            var xhrobj = $.ajaxSettings.xhr();
            if (xhrobj.upload) {
                    xhrobj.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }
                        //Set progress
                        status.setProgress(percent);
                    }, false);
                }
            return xhrobj;
        },
    url: uploadURL,
    type: "POST",
    contentType:false,
    processData: false,
        cache: false,
        data: formData,
        success: function(data){
            status.setProgress(100);
 			$("#fileuploaded").val(data);
            $("#status1").append("File upload Done<br>");        
        }
    });
 
    status.setAbort(jqXHR);
}
</script> 