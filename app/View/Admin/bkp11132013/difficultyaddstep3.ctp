<!--Right said start-->           
<div class="container_right"><div class="btn_next">
  <a href="javascript:gotosave();" class="btn btn-primary btn-block">Save<span class="fui-arrow-right pull-right"></span></a>
</div>
<h1>Please upload a decal.</h1>
<h3>It will automatically by applied to any challenge's badge that it is associated with! </h3>
<br /><br />
<div class="clear"></div>
<!--discrption--> 
<div class="Difficulty_step1">
<div class="discrption_label">Decal:</div>
<div class="clear"></div>
<div id="dragandrophandler">drop decal graphic here</div>
<div id="status1" style="width:100%;"></div>
<div class="clear"></div>
<div class="discrption_label_right">note: this must be of type GIF or PNG</div>
<input type="hidden" id="fileuploaded" value="" />
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
 			$("#fileuploaded").val("1");
            $("#status1").append("File upload Done<br>");        
        }
    });
 
    status.setAbort(jqXHR);
}
</script>