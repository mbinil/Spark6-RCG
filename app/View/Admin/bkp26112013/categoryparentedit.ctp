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
<div class="sitemap_nav">
    <ul class="nav nav-pills">
      <li class="active"><a >Info</a></li>
      <li ><a >Save</a></li>
    </ul>
</div>
<div class="clear"></div>
<hr/>       
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
<div class="btn_next">
  <a href="javascript:saveparentcatedit();" class="btn btn-primary btn-block">Save<span class="fui-arrow-right pull-right"></span></a>
</div>
<h1>Edit this parent category</h1>
<h3>Be as specific as you can! </h3>
<div class="clear"></div>
<!--discrption-->   
<div class="Difficulty_step1" style="width:65%; float:left;">
<div class="discrption_label" style="width:25% !important;">Parent Category Name:</div>
<div class="clear"></div>
<input type="hidden" value="<?php echo $pcatinfo[0]['Category']['id']; ?>" id="pcatid">
<input type="text" value="<?php echo str_replace('\"', '', $pcatinfo[0]['Category']['title']); ?>" placeholder="Parent category name" class="form-control input-sm" id="pcattitle" onblur="javascript:validateFieldcheck(this.id,this.value);" disabled="disabled"  style="width: 500px;color:#666666;">
<div class="clear"></div>
<?php if($pcatinfo[0]['Category']['decal']!=''){ ?>
<div style="position: absolute; margin: 39px 0 0 0;">
<img src="<?php echo "../../img/catuploads/".$pcatinfo[0]['Category']['decal']; ?>" width="100" height="100" alt="<?php echo $pcatinfo[0]['Category']['title']; ?>" />
</div>
<?php } ?>
<div class="discrption_label">Decal:</div>
<div class="clear"></div>
<div id="dragandrophandler">Drop decal graphic here</div>
<div id="status1" style="width:100%;"></div>
<div class="clear"></div>
<div class="discrption_label_right">note: this must be of type GIF or PNG</div>
<input type="hidden" id="temp_fileuploaded" name="temp_fileuploaded" value="<?php echo $pcatinfo[0]['Category']['decal']?$pcatinfo[0]['Category']['decal']:''; ?>"/>
<input type="hidden" id="fileuploaded" value="<?php if($pcatinfo[0]['Category']['decal']!=''){ echo $pcatinfo[0]['Category']['decal']; } ?>" onblur="javascript:validateFieldcheck(this.id,this.value);" />
<div class="clear"></div>
<div class="discrption_label" style="width:55px;">Status:</div>
<div class="switch-on switch-animate">
<input type="checkbox" data-toggle="switch" <?php if($pcatinfo[0]['Category']['status']!="0"){ ?>checked="checked" <?php } ?> id="pcatstatus">
</div>
</div>
<!--discrption end--> 
</div>    
<!--right said end-->  
<script type="text/javascript">
function sendFileToServer(formData,status)
{
    var uploadURL ="../category_uploads"; //Upload URL
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