<style>.ui-dialog {padding:0;}.ui-widget-header {background: linear-gradient(to bottom, #F3EEE5 0%, #EDE5D9 50%, #E5DBCA 100%) repeat scroll 0 0 rgba(0, 0, 0, 0) !important; border-bottom: 1px solid #D0C8BA !important;} #dialog_host_this #main { margin: 0 auto -1px; padding: 0 0 20px; width: 100%;}.ui-dialog-title { font-size: 28px; line-height: 1.5; text-align: center; width: 100%;}.ui-dialog .ui-dialog-title { width: 100%;}</style>
<link href="<?php echo Router::url('/app/webroot/file_upload/css/style.css',true); ?>" rel="stylesheet" />
<script type="text/javascript">
/*function checkavail(val,mode,id)
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
}*/
function checkSubmit(evt)
{
    if(evt.which == 13)
        submitLoginuser();
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
<div class="container_left" style="width:100% !important; border: 1px solid #fff; padding-right:0px;">
  <!----Error message div------------------>
  <div class="alert" id="alert_div_login" style="background-color:#FF6A6A;border-color:red;color:#FFF;display:none;">
    <button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div_login').hide();"></button>
    <span id="message_span_login"></span>	
  </div>
<!--------------------------------------->	
  <!--discrption-->
  <div class="Difficulty_step1" style="width:85%; float:left; margin-bottom: 15px;">
    <div class="discrption_label" style="width:50% !important; float:left;">Username:</div>
    <div style="width:50% !important; float:right;"><input type="text" value="" placeholder="Username" class="form-control input-sm" id="loginusername" onblur="javascript:validateFieldcheck(this.id,this.value);" onkeypress="checkSubmit(event)" style="width: 200px;"></div>
    <div class="clear"></div>
    <div class="discrption_label" style="width:50% !important; float:left;">Password:</div>
    <div style="width:50% !important; float:right;"><input type="password" value="" placeholder="Password" class="form-control input-sm" id="loginpassword" onblur="javascript:validateFieldcheck(this.id,this.value);" onkeypress="checkSubmit(event)" style="width: 200px;"></div>
  </div>
  <div class="clear"></div>
  <!--discrption end-->
  <div class="btn_next"><a href="javascript:submitLoginuser();" class="btn btn-primary btn-block">Login</a></div>
</div>
<!--right said end-->
<!-- JavaScript Includes -->
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.knob.js',true); ?>"></script>
<!-- Our main JS file -->
<script src="<?php echo Router::url('/app/webroot/file_upload/js/script.js',true); ?>"></script>