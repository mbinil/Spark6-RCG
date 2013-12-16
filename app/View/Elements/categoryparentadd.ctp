<link href="<?php echo Router::url('/app/webroot/file_upload/css/style.css',true); ?>" rel="stylesheet" />
<script type="text/javascript">
function checkavail(val,mode,id)
{
	var ajaxurl	=   ($('#controller_action').val() == 'edit')? '../' : '';
        var edit_id     =   ''
        if($("#ccatid").val())
            edit_id =   $("#ccatid").val();
        
	mode = mode?mode:$('#catmode').val();
	id = id?id:'pcattitle';
	$.ajax({  //Make the Ajax Request
		type: "POST",  
		url: ajaxurl+"ajax_checkavail",
		data: "checkavail="+val+"&mode="+mode+"&flag="+$('#controller_action').val()+"&edit_id="+edit_id,  //data
		success: function(response) {
			if(response=='1')
			{
				//alert(mode+" category name not available!!");
                                $('#message_span').html(mode+" category name already exist!!");
                                $('#alert_div').show();
				$("#"+id).css("border-color", "red");
			}
		} 
	});
}
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
<div class="clear"></div>
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
  <div class="btn_next"> <a href="javascript:saveparentcat('dialogue');" class="btn btn-primary btn-block">Save</a> </div>
  <!--discrption-->
  <div class="Difficulty_step1" style="width:65%; float:left;">
    <div class="discrption_label" style="width:50% !important;">Parent Category Name:</div>
    <div class="clear"></div>
    <input type="text" value="" placeholder="Parent category name" class="form-control input-sm" id="pcattitle" onchange="javascript:checkavail(this.value);" onblur="javascript:validateFieldcheck(this.id,this.value);" style="width: 500px;">
    <div class="clear"></div>
    <div class="discrption_label">Decal:</div>
    <div class="clear"></div>
    <!--drag & drop starting here-->
	<input type="hidden" name="catmode" id="catmode" value="<?php echo $mode; ?>" />
    <form id="upload" method="post" action="category_uploads" enctype="multipart/form-data">
      <input type="hidden" name="fileuploaded" id="fileuploaded" />
      <input type="hidden" name="root_path" id="root_path" value="<?php echo $rootpath; ?>" />
      <div id="drop" style="background-color: white;width:105%;height:120px;font-weight:normal;"> <br/>
        <br/>
        Drop decal graphic here<br/>
        You can also <a style="text-decoration: underline; color:#999999; font-weight:bold;">browse for a file</a>
        <input type="file" name="upl" id="upl" />
      </div>
      <div class="discrption_label_right" style="margin-bottom:1px;margin-top:-20px;">note: this must be of type GIF or PNG</div>
      <ul id="show_file_ul" style="width:480px;margin:0 -20px;">
        <!-- The file uploads will be shown here -->
      </ul>
    </form>
    <!--drag & drop ends here-->
    <div class="clear" style="margin:50px 0 0 0;"></div>
    <div class="discrption_label" style="width:55px;margin: 0 10px 0 0;">Status:</div>
    <div class="switch-on switch-animate">
      <input type="checkbox" data-toggle="switch" checked="checked" id="pcatstatus">
    </div>
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