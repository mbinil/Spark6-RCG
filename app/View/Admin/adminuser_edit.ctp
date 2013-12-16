<!--Right said start-->
<link href="<?php echo Router::url('/app/webroot/file_upload/css/style.css',true); ?>" rel="stylesheet" />
<script type="text/javascript">

function checkavail(val,field_name)
{
	$.ajax({  //Make the Ajax Request
		type: "POST",  
		url: "../ajax_checkavail",
		data: "checkavail="+val+"&mode=Admin&field_name="+field_name+"&flag=edit&edit_id="+$('#adminid').val(),  //data
		success: function(response) {
			if(response=='1')
			{
				if(field_name == 'admin_user_name')
				{
					alert("Username not available!!");
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
<div class="sitemap_nav">
  <ul class="nav nav-pills">
    <li class="active"><a >User Info</a></li>
    <li ><a >Save</a></li>
  </ul>
</div>
<div class="clear"></div>
<hr/>
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
  <div class="btn_next"> <a href="javascript:saveadminuseredit();" class="btn btn-primary btn-block">Save<span class="fui-arrow-right pull-right"></span></a> </div>
  <h1>Edit  Site Admin</h1>
  <h3>This is where you add new folk who can manage your application </h3>
  <br />
  <div class="clear"></div>
  <!----Error message div------------------>
  <div class="alert" id="alert_div" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
    <button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
    <span id="message_span"></span>	
  </div>
<!--------------------------------------->
  <!--discrption-->
  <input type="hidden" value="<?php echo $admininfo[0]['Admin']['id']; ?>" id="adminid">
  <div class="Difficulty_step1" style="width:65%; float:left;">
    <div>
      <div class="discrption_label">First Name</div>
      <div class="discrption_label_right"></div>
      <div class="clear"></div>
      <input type="text" name="first_name"  placeholder="First Name" class="form-control input-sm" id="first_name" value="<?php echo $admininfo[0]['Admin']['admin_firstname']; ?>" onblur="javascript:validateFieldcheck(this.id,this.value);" style="width: 500px;">
      <div class="discrption_label">Last Name</div>
      <div class="discrption_label_right"></div>
      <div class="clear"></div>
      <input type="text" name="last_name"  placeholder="Last Name" class="form-control input-sm" id="last_name" value="<?php echo $admininfo[0]['Admin']['admin_lastname']; ?>" onblur="javascript:validateFieldcheck(this.id,this.value);" style="width: 500px;">
      <div class="discrption_label">Email</div>
      <div class="discrption_label_right"></div>
      <div class="clear"></div>
      <input type="text" name="email"  placeholder="Email" class="form-control span3" id="email" value="<?php echo $admininfo[0]['Admin']['admin_user_email']; ?>" onblur="validateFieldcheck(this.id,this.value); checkavail(this.value,'admin_user_email');" style="width: 500px;" >
      <div class="discrption_label">User Name</div>
      <div class="discrption_label_right"></div>
      <div class="clear"></div>
      <input type="text" name="user_name"  placeholder="Username" class="form-control input-sm" id="user_name" value="<?php echo $admininfo[0]['Admin']['admin_user_name']; ?>" onblur="javascript:validateFieldcheck(this.id,this.value);"  disabled="disabled" style="color:#666666; width: 500px;">
      <div class="discrption_label">Password</div>
      <div class="discrption_label_right"></div>
      <div class="clear"></div>
      <input type="password" name="password"  placeholder="Password" class="form-control input-sm" id="password" value="<?php echo base64_decode($admininfo[0]['Admin']['admin_user_password']); ?>" onblur="javascript:validateFieldcheck(this.id,this.value);" style="width: 500px;">
      <div class="discrption_label">Role</div>
      <div class="discrption_label_right"></div>
      <div class="clear"></div>
      <select name="info" class="select-block" id="role">
	  	<option value="">Select a role</option>
        <option <?php if($admininfo[0]['Admin']['admin_user_type']==0) { ?>selected="selected" <?php } ?> value="0">Admin</option>
        <option <?php if($admininfo[0]['Admin']['admin_user_type']==1) { ?>selected="selected" <?php } ?> value="1">Author</option>
        <option <?php if($admininfo[0]['Admin']['admin_user_type']==2) { ?>selected="selected" <?php } ?> value="2">Approver</option>
        <option <?php if($admininfo[0]['Admin']['admin_user_type']==3) { ?>selected="selected" <?php } ?> value="3">Brand Manager</option>
      </select>
      <?php if($admininfo[0]['Admin']['icon']!=''){ ?>
      <div style="position: absolute; margin: 39px 0 0 0;"> <img src="<?php echo Router::url('/app/webroot/img/adminuseruploads/', true).$admininfo[0]['Admin']['icon']; ?>" width="120" height="120"  /> </div>
      <?php } ?>
      <div class="discrption_label">Icon:</div>
      <div class="clear"></div>
      <!--drag & drop starting here-->
      <form id="upload" method="post" action="<?php echo Router::url('/admin/adminuser_uploads', true); ?>" enctype="multipart/form-data">
        <input type="hidden" id="temp_fileuploaded" name="temp_fileuploaded" value="<?php if($admininfo[0]['Admin']['icon']!=''){ echo $admininfo[0]['Admin']['icon']; } ?>"/>
        <input type="hidden" name="root_path" id="root_path" value="<?php echo Router::url('/app/webroot/img/adminuseruploads', true); ?>" />
        <input type="hidden" id="fileuploaded" value="" name="fileuploaded"/>
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
        <input type="checkbox" data-toggle="switch" id="adminuserstatus" <?php if($admininfo[0]['Admin']['admin_user_active']!="0"){ ?>checked="checked" <?php } ?>/>
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
