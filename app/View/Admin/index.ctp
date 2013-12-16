<?php if($this->Session->read("username")!='') {
	echo '<script>window.location ="home";</script>';
} ?>
<?php $login_error = $this->Session->flash(); ?>
<br/><br/><br/>
<div class="login-form">
  <!-- login form -->
 <?php if($login_error!=NULL) { ?>
  <div class="alert alert-error" id="alert_div" <?php if($login_error!=NULL) { ?> style="display:block !important; background-color: #FF6A6A;border-color: red;color:#FFFFFF;"<?php } else { ?> style="display:none;" <?php } ?>>
    <button type="button" class="close fui-cross" data-dismiss="alert" onclick="javascript:$('#alert_div').hide();"></button>
<?php echo $login_error; ?>
  </div>
  <?php } ?>
  <h1 class="logo"><a href="#"></a></h1>
  <?php echo $this->form->create("index",array("action"=>"../admin/verifylogin","type"=>"file")); ?>
    <?php echo $this->form->input(" ",array("name"=>"admin_user_name","id"=>"admin_user_name","type"=>"text","value"=>"","class"=>"form-control login-field","placeholder"=>"Username" )); ?>
  
	 <?php	echo $this->form->input(" ",array("name"=>"admin_user_password","id"=>"admin_user_password","type"=>"password","value"=>"","class"=>"form-control password required","placeholder"=>"Password")); ?> 
	 <?php	echo $this->form->end("Login"); ?> 
</div>
