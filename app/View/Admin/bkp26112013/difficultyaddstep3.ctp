<?php $diffinfo = $this->Session->read('newdiffinfo'); ?>
<?php $stepinfo = $this->Session->read('stepinfo'); ?>
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
<div style="position: absolute; margin: 39px 0px 0px 34px;">
<img src="<?php echo "../img/diffuploads/".$diffinfo['decal']; ?>" width="100" height="100" />
</div>
<?php } ?>
<!--discrption--> 
<div class="Difficulty_step1" style="width:65%; float:left;">
<div class="discrption_label">Decal:</div>
<div class="clear"></div>
<div id="dragandrophandler">Drop decal graphic here</div>
<div id="status1" style="width:100%;"></div>
<div class="clear"></div>
<div class="discrption_label_right">note: this must be of type GIF or PNG</div>
<input type="hidden" id="fileuploaded" value="" onblur="javascript:validateFieldcheck(this.id,this.value);" />
</div>
<!--discrption end--> 
</div>    
<!--right said end-->  
<script type="text/javascript">
function sendFileToServer(formData,status)
{
    var uploadURL ="difficulties_uploads"; //Upload URL
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