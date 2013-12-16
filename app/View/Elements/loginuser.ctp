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
  <div class="alert" id="alert_div" style="background-color:#FF6A6A;border-color:red;color:#FFF;display:none;">
    <button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
    <span id="message_span"></span>	
  </div>
<!--------------------------------------->	
  <!--discrption-->
  <div class="Difficulty_step1" style="width:85%; float:left; margin-bottom: 15px;">
    <div class="discrption_label" style="width:50% !important; float:left;">Username:</div>
	<div style="width:50% !important; float:right;"><input type="text" value="" placeholder="Username" class="form-control input-sm" id="loginusername" onblur="javascript:validateFieldcheck(this.id,this.value);" style="width: 200px;"></div>
    <div class="clear"></div>
    <div class="discrption_label" style="width:50% !important; float:left;">Password:</div>
    <div style="width:50% !important; float:right;"><input type="password" value="" placeholder="Password" class="form-control input-sm" id="loginpassword" onblur="javascript:validateFieldcheck(this.id,this.value);" style="width: 200px;"></div>
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