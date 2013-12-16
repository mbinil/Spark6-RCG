<?php $adminuser_error = $this->Session->flash(); ?>
<div id="main">
<h1>Edit Admin Users</h1>
<div class="acount-block">
<?php
if(isset($adminuservalidationarray))   // checking validation array contains values
{
 ?>
    <div>
    <ul>
	<li style="color:#FF0000">Following error(s) has occured. Please try again!!</li>
    <?php foreach($adminuservalidationarray as $val )   // printing all validation errors (rules that we given in the model form)
	{ ?>
        <li style="color:#FF0000"><?php echo $val[0]; ?></li>
    <?php } ?>
    </ul>
    </div>
<?php
}
?>
<?php 
if(isset($adminuser['AdminUser']['id']))
{
   $adminuserid=$adminuser['AdminUser']['id'];
}
if(isset($adminuser['AdminUser']['admin_user_name']))
{
   $adminusername=$adminuser['AdminUser']['admin_user_name'];
}
if(isset($adminuser['AdminUser']['admin_user_password']))
{
   $adminpassword=$adminuser['AdminUser']['admin_user_password'];
   $adminpassword=base64_decode($adminpassword);
}
if(isset($adminuser['AdminUser']['admin_user_email']))
{
   $adminuseremail=$adminuser['AdminUser']['admin_user_email'];
}
if(isset($adminuser['AdminUser']['admin_user_active']))
{
   $adminuseractive=$adminuser['AdminUser']['admin_user_active'];
}
if(isset($adminuser['AdminUser']['admin_user_type']))
{
   $adminusertype=$adminuser['AdminUser']['admin_user_type'];
}
echo $this->form->create("adminuser",array("action"=>"../admin/adminuser_edit/$adminuserid", "class"=>"submit-form", "style" => "padding: 0 4px 0 10px;")); ?>
<table cellpadding="0" cellspacing="0" width="100%">
	<?php if(isset($newsletter_error)) { ?>
	<tr><td colspan="2" height="20" width="100%" align="left" style="font-size:16px; font-weight:bold; color:#FF0000;"><?php echo $newsletter_error; ?></td></tr>
	<tr><td colspan="2" height="10"></td></tr>
	<?php } ?>
  <tr>
    <td width="12%" style="vertical-align:middle;"><span style="color:#FF0000;">*</span> User Name </td>
    <td width="88%"><?php echo $this->form->input(" ",array("id"=>"id","name"=>"id","type"=>"hidden","value"=>"$adminuserid")); ?><label><?php echo $this->form->input("",array("id"=>"admin_user_name","name"=>"admin_user_name","type"=>"text","value"=>"$adminusername", 'style' => 'width:225px;')); ?></label></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;"><span style="color:#FF0000;">*</span> Password</td>
    <td><?php echo $this->form->input(" ",array("id"=>"admin_user_password","name"=>"admin_user_password","type"=>"password","value"=>"$adminpassword", 'style' => 'width:225px;')); ?></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;"><span style="color:#FF0000;">*</span> Email</td>
    <td><label><?php echo $this->form->input(" ",array("id"=>"admin_user_email","name"=>"admin_user_email","type"=>"text","value"=>"$adminuseremail", 'style' => 'width:225px;')); ?></label></td>
  </tr>
    <tr>
    <td style="vertical-align:middle;"><span style="color:#FF0000;">*</span> Status</td>
    <td><label>
        <?php echo $this->form->input(" ",array("name"=>"admin_user_active","id"=>"admin_user_active","type"=>"select","options"=>$adminuser_statuses,"selected"=>$adminuseractive, 'style' => 'width:240px;')); ?>
    </label></td>
  </tr>
  <tr>
    <td style="vertical-align:middle;"><span style="color:#FF0000;">*</span> User Type</td>
    <td><label>
        <?php echo $this->form->input(" ",array("name"=>"admin_user_type","id"=>"admin_user_type","type"=>"select","options"=>$adminusertypes,"selected"=>$adminusertype, 'style' => 'width:240px;')); ?>
    </label></td>
  </tr>
  <tr><td colspan="2" height="30"></td></tr>
  <tr>
	<td></td>
	<td align="left">
	<div>
		<div style="float:left; margin-right:15px;">
		<?php echo $this->form->button('Submit', array('type' => 'submit','name'=>'Submit','id'=>'Submit',"class"=>"btn")); ?>
		<?php echo $this->form->end(); ?>
		</div>
		<div style="float:left;">
		<?php echo $this->form->create("cancel",array("action"=>"../admin/adminuser_list")); 
			echo $this->form->button("Cancel",array("type"=>"Submit","class"=>"btn")); 
			echo $this->form->end();
		?>
		</div>
	</div>
	</td>
</tr>
	</table>
</div>
<div style="height:100px;"></div>
</div>