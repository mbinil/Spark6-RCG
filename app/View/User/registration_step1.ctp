<link href="<?php echo Router::url('/app/webroot/file_upload/css/style.css',true); ?>" rel="stylesheet" />
<script type="text/javascript">
/*Field validation on blur of an input element*/
function validateFieldcheck(id,val)
{
	$('#alert_div').hide();
	if(val == "" || val.length < 3)
	{
		$("#"+id).css("border-color", "red");
	}
	else
	{
		$("#"+id).css("border-color", "#BDC3C7");
	}
}
function validateemail(id,val)
{
$.ajax({  //Make the Ajax Request
		type: "POST",  
		url: "users/ajax_email_unique",
		data: "email="+val,  //data
		success: function(response) {
		
		if(response=='0')
			{
				$("#"+id).css("border-color", "red");
				$("#email_unique").val('exist');
				$('#message_span').html('Email already registered!!');
				$('#alert_div').show();
				
			}
			else
			{
				$("#"+id).css("border-color", "#BDC3C7");
				$("#email_unique").val('');
				
			}
		}
	});
}
</script>
<style>
#userreg #upload ul li canvas {
	display:none !important;
}
#userreg #show_file_ul p {
	display:none !important;
}
</style>
<!-- main content block -->
<?php 
$reg_array = $this->Session->read("newreginfo");
$eBayBusinessUnit = Configure::read('eBayBusinessUnit');
$eBayBusinessUnitLoc = Configure::read('eBayBusinessUnitLoc');
?>
<div id="main">       
	<div id="userreg">  
		<div class="sitemap_nav" style="margin-top:20px;width:100%; ">
			<ul class="nav nav-pills">
			  <li class="active"><a href="registration_step1" >Account Info</a></li>
			  <li><a>Education</a></li>
			  <li><a>Interests</a></li>
			  <li><a>SAVE</a></li>
			</ul>
		</div>
		<div class="clear"></div>
		<hr style="border-color:#ccc;"/>            
		<div class="container_left" style="border:none;">
			<div class="btn_next">
			  <a href="javascript:reg_info_ajax();" class="btn btn-primary btn-block" >Next<span class="fui-arrow-right pull-right"></span></a>
			</div>
			<h1>Account Information</h1>
			<h3>Please provide some basic account info.</h3>
			<hr style="border-color:#ccc;"/>
			<div class="clear"></div>
			<!----Error message div------------------>
			<div class="alert" id="alert_div" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
				<button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
				<span id="message_span"></span>	
			</div>
			<!--------------------------------------->
			<div class="registration_step1">
				<div style="margin:0px; width:82%; float:left;">
					<div class="discrption_label">First Name:</div>
					<div class="discrption_label_right"></div>
					<div class="clear"></div>
					<input type="text" name="firstname"  placeholder="First Name" class="form-control input-sm" id="firstname" value="<?php if(isset($reg_array['user_firstname'])) { echo $reg_array['user_firstname']; } ?>" onblur="javascript:validateFieldcheck(this.id,this.value);" style="width: 500px;">
					<div class="clear"></div>
					<div class="discrption_label">Last Name:</div>
					<div class="clear"></div>
					<input type="text" name="lastname"  placeholder="Last Name" class="form-control input-sm" id="lastname" value="<?php if(isset($reg_array['user_lastname'])) { echo $reg_array['user_lastname']; } ?>" onblur="javascript:validateFieldcheck(this.id,this.value);" style="width: 500px;">
					<div class="clear"></div>
					<div class="discrption_label">Your Email (this will be your username):</div>
					<div class="clear"></div>
					<input type="text" name="youremail"  placeholder="Email" class="form-control input-sm" id="youremail" value="<?php if(isset($reg_array['user_email'])) { echo $reg_array['user_email']; } ?>" onblur="javascript:validateFieldcheck(this.id,this.value); javascript:validateemail(this.id,this.value); " style="width: 500px;">
					<input type="hidden" name="email_unique" id="email_unique"  />
					<div class="clear"></div>
					<div class="discrption_label">Re-enter Email:</div>
					<div class="clear"></div>
					<input type="text" name="reyouremail"  placeholder="Re-enter Email" class="form-control input-sm" id="reyouremail" value="<?php if(isset($reg_array['user_email'])) { echo $reg_array['user_email']; } ?>" onblur="javascript:validateFieldcheck(this.id,this.value);" style="width: 500px;">
					<div class="clear"></div>
					<div class="discrption_label">New Password:</div>
					<div class="clear"></div>
					<input type="password" name="new_password"  placeholder="New Password" class="form-control input-sm" id="new_password" value="<?php if(isset($reg_array['user_password'])) { echo $reg_array['user_password']; } ?>" onblur="javascript:validateFieldcheck(this.id,this.value);" style="width: 500px;">
					<div class="clear"></div>
					<div class="discrption_label">Re-enter Password:</div>
					<div class="clear"></div>
					<input type="password" name="re_password"  placeholder="Re-enter Password" class="form-control input-sm" id="re_password" value="<?php if(isset($reg_array['user_password'])) { echo $reg_array['user_password']; } ?>"  onblur="javascript:validateFieldcheck(this.id,this.value);" style="width: 500px;">
					<div class="clear"></div>
					<div class="discrption_label">Gender</div>
					<div class="clear"></div>
					<div style="float:left;">
					<?php if(isset($reg_array['user_gender'])) { ?>
						<input type="radio" id="chalngwhosets" name="chalngwhosets[]" value="0" <?php if(isset($reg_array['user_gender']) && $reg_array['user_gender']=='0') { ?>checked="checked" <?php } ?> /><span style="margin-left:10px;">Male</span><br/>
						<input type="radio" id="chalngwhosets" name="chalngwhosets[]" value="1"  <?php if(isset($reg_array['user_gender']) && $reg_array['user_gender']=='1') { ?>checked="checked" <?php } ?> /><span style="margin-left:10px;">Female</span>
						<?php } else { ?>
						<input type="radio" id="chalngwhosets" name="chalngwhosets[]" value="0" checked="checked" /><span style="margin-left:10px;">Male</span><br/>
						<input type="radio" id="chalngwhosets1" name="chalngwhosets[]" value="1" /><span style="margin-left:10px;">Female</span>
						<?php } ?>
					</div>
					<div class="clear"></div>
					<div class="discrption_label">eBay Inc. Business Unit</div>
					<div class="clear"></div>
					<div style="margin:0px; float:left;">
						<select name="unit_info" class="select-block" id="unit_info">
							<?php foreach ($eBayBusinessUnit as $key=>$value) { ?>
							<option value="<?php echo $key; ?>" <?php if(isset($reg_array['user_business_unit']) && $reg_array['user_business_unit']==$key ) { ?> selected="selected" <?php } ?>><?php echo $value; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="clear"></div>
					<div class="discrption_label">eBay Inc. Business Unit Location</div>
					<div class="clear"></div>
					<div style="margin:0px; float:left;">
						<select name="loc_info" class="select-block" id="loc_info">
							<?php foreach ($eBayBusinessUnitLoc as $key=>$value) { ?>
							<option value="<?php echo $key; ?>" <?php if(isset($reg_array['user_business_loc']) && $reg_array['user_business_loc']==$key ) { ?> selected="selected" <?php } ?>><?php echo $value; ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="clear"></div>
					<div class="discrption_label">Email Notification</div>
					<div class="clear"></div>
					<div style="float:left;">
                                            <input type="checkbox" id="emailnot" name="emailnot1" value="1" <?php if(isset($reg_array['user_notification_participate']) && $reg_array['user_notification_participate']=='1') { ?>checked="checked" <?php } ?> /><span style="margin-left:10px;">Notify me if i've been invited to participate in a challenge.</span><br/>
                                            <input type="checkbox" id="emailnot1" name="emailnot2" value="1"  <?php if(isset($reg_array['user_notification_finished']) && $reg_array['user_notification_finished']=='1') { ?>checked="checked" <?php } ?> /><span style="margin-left:10px;">Notify me when i've finished a challenge.</span>
                                        </div>
				</div>
				<div style="width:17%; float:right; margin-top:15px;">
					<!--drag & drop starting here-->
	  			<form id="upload" method="post" action="adminuser_uploads" enctype="multipart/form-data">
					<input type="hidden" name="fileuploaded" id="fileuploaded" />
					<input type="hidden" name="root_path" id="root_path" value="<?php echo Router::url('/app/webroot/img/useruploads', true); ?>" />
					<input type="hidden" name="image_rand_num" id="image_rand_num" value="" />
					<div id="drop"> 
					  Profile picture<br/>
					  <a style="text-decoration: underline; color:#999999;">browse for a file</a>
					  <input type="file" name="upl" id="upl" />
					</div>
					<ul id="show_file_ul" style="width: 135px; margin: -95px 0px 0px 20px;">
					<?php if(isset($reg_array['user_profile_picture'])) { ?>
					<li class="">
						<img id="dropimagediv" width="60" height="60" src="img/useruploads/<?php echo $reg_array['user_profile_picture']; ?> ">
					</li>
					<?php } ?>
					
					<!-- The file uploads will be shown here -->
					</ul>
				  </form>
			<!--	  
				  <form id="upload" method="post" action="category_uploads" enctype="multipart/form-data">
      <input type="hidden" name="fileuploaded" id="fileuploaded" />
      <input type="hidden" name="root_path" id="root_path" value="../img/catuploads" />
      <div id="drop" style="background-color: white;width:105%;height:120px;"> <br/>
        <br/>
        Drop decal graphic here<br/>
        You can also <a style="text-decoration: underline; color:#999999;">browse for a file</a>
        <input type="file" name="upl" id="upl" />
      </div>
      <ul id="show_file_ul" style="width:480px;margin:0 -20px;">
         The file uploads will be shown here 
      </ul>
    </form>-->
				  <!--drag & drop ends here-->
				</div>
			</div>
		</div>   
		<div class="clear"></div>
		<br /> 
	</div>
</div>
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.knob.js',true); ?>"></script>
<!-- jQuery File Upload Dependencies -->
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.ui.widget.js',true); ?>"></script>
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.iframe-transport.js',true); ?>"></script>
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.fileupload.js',true); ?>"></script>
<!-- Our main JS file -->
<script src="<?php echo Router::url('/app/webroot/file_upload/js/script.js',true); ?>"></script>