<link href="<?php echo Router::url('/app/webroot/file_upload/css/style.css',true); ?>" rel="stylesheet" />
<script type="text/javascript">
function checkavail(val,field_name)
{
	$.ajax({  //Make the Ajax Request
		type: "POST",  
		url: "ajax_checkavail",
		data: "checkavail="+val+"&mode=Admin&field_name="+field_name+"&flag=add",  //data
		success: function(response) {
			if(response=='1')
			{
				if(field_name == 'admin_user_name')
				{
					$('#message_span').html('Username is already exist!!');
                                        $('#alert_div').show();
					$("#user_name").css("border-color", "red");
				}
				else
				{
					$('#message_span').html('Email is already exist!!');
                                        $('#alert_div').show();
					$("#email").css("border-color", "red");
					
				}
			}
			else
			{
				$("#email").css("border-color", "#BDC3C7");
				$("#user_name").css("border-color", "#BDC3C7");
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
<!--Right said start-->
<div class="sitemap_nav">
  <ul class="nav nav-pills">
    <li class="active"><a >User Info</a></li>
    <li ><a >Save</a></li>
  </ul>
</div>
<div class="clear"></div>
<hr/>
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
  <div class="btn_next"> <a href="javascript:saveadminuser();" class="btn btn-primary btn-block">Save<span class="fui-arrow-right pull-right"></span></a> </div>
  <h1>Create a new site Admin</h1>
  <h3>This is where you add new folk who can manage your application.</h3>
  <br />
  <div class="clear"></div>
  <!----Error message div------------------>
  <div class="alert" id="alert_div" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
    <button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
    <span id="message_span"></span>	
  </div>
<!--------------------------------------->
  <!--discrption-->
  <div class="Difficulty_step1" style="width:65%; float:left;">
    <div>
      <div class="discrption_label">First Name:</div>
      <div class="discrption_label_right"></div>
      <div class="clear"></div>
      <input type="text" name="first_name"  placeholder="First Name" class="form-control input-sm" id="first_name" value="" onblur="javascript:validateFieldcheck(this.id,this.value);" style="width: 500px;">
      <div class="discrption_label">Last Name:</div>
      <div class="discrption_label_right"></div>
      <div class="clear"></div>
      <input type="text" name="last_name"  placeholder="Last Name" class="form-control input-sm" id="last_name" value="" onblur="javascript:validateFieldcheck(this.id,this.value);" style="width: 500px;">
      <div class="discrption_label">Email:</div>
      <div class="discrption_label_right"></div>
      <div class="clear"></div>
      <input type="text" name="email"  placeholder="Email" class="form-control input-sm" id="email" onblur="validateFieldcheck(this.id,this.value);  checkavail(this.value,'admin_user_email');" style="width: 500px;">
      <div class="discrption_label">Username:</div>
      <div class="discrption_label_right"></div>
      <div class="clear"></div>
      <input type="text" name="user_name"  placeholder="Username" class="form-control input-sm" id="user_name" onblur="validateFieldcheck(this.id,this.value); checkavail(this.value,'admin_user_name');" style="width: 500px;">
      <div class="discrption_label">Password:</div>
      <div class="discrption_label_right"></div>
      <div class="clear"></div>
      <input type="password" name="password"  placeholder="Password" class="form-control input-sm" id="password" onblur="javascript:validateFieldcheck(this.id,this.value);" style="width: 500px;">
      <div class="discrption_label">Role:</div>
      <div class="discrption_label_right"></div>
      <div class="clear"></div>
      <select name="info"  class="select-block" id="role">
        <option value="">Select a role</option>
        <option value="0">Admin</option>
        <option value="1">Author</option>
        <option value="2">Approver</option>
        <option value="3">Brand Manager</option>
      </select>
      <div class="discrption_label">Icon:</div>
      <div class="clear"></div>
      <!--drag & drop starting here-->
      <form id="upload" method="post" action="adminuser_uploads" enctype="multipart/form-data">
        <input type="hidden" name="fileuploaded" id="fileuploaded" />
		<input type="hidden" name="draganddropfrom" id="draganddropfrom" value="adminuser_add" />
        <input type="hidden" name="root_path" id="root_path" value="<?php echo Router::url('/app/webroot/img/adminuseruploads', true); ?>" />
		<input type="hidden" name="image_rand_num" id="image_rand_num" value="" />
        <div id="drop" style="background-color: white;width:105%;height:120px;"> <br/>
          <br/>
          drop user icon<br/>
          You can also <a style="text-decoration: underline; color:#999999;">browse for a file</a>
          <input type="file" name="upl" />
        </div>
        <div class="discrption_label_right" style="margin-bottom:1px;margin-top:-20px;">note: this must be of type GIF or PNG</div>
        <ul id="show_file_ul" style="width:480px;margin:0 -20px;">
          <!-- The file uploads will be shown here -->
        </ul>
      </form>
      <!--drag & drop ends here-->
      <div class="clear" style="margin:50px 0 0 0;"></div>
      <div class="discrption_label" style="width:55px;">Status:</div>
      <div class="switch-on switch-animate">
        <input type="checkbox" checked data-toggle="switch" id="adminuserstatus"/>
      </div>
    </div>
  </div>
  <!--discrption end-->
</div>
<!-- JavaScript Includes -->
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.knob.js',true); ?>"></script>
<!-- jQuery File Upload Dependencies -->
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.ui.widget.js',true); ?>"></script>
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.iframe-transport.js',true); ?>"></script>
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.fileupload.js',true); ?>"></script>
<!-- Our main JS file -->
<script src="<?php echo Router::url('/app/webroot/file_upload/js/script.js',true); ?>"></script>