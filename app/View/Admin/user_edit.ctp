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
<div class="btn_next">
  <a href="javascript:saveuseredit();" class="btn btn-primary btn-block">Save<span class="fui-arrow-right pull-right"></span></a>
</div>
<h1>Edit  Users</h1>
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
<input type="hidden" value="<?php echo $userinfo[0]['User']['id']; ?>" id="userid">
<div class="Difficulty_step1" style="width:65%; float:left;">
<div>
<div class="discrption_label">Notification email:</div>
<div class="discrption_label_right"></div>
<div class="clear"></div>

<input type="text" name="notification_email"  placeholder="Notification email" class="form-control input-sm" id="notification_email" value="<?php echo $userinfo[0]['User']['user_email']; ?>" onblur="javascript:validateFieldcheck(this.id,this.value);" style="width: 500px; color:#333;" disabled="disabled">
<div class="clear"></div>
<br>
<div class="discrption_label" style="width:55px;">Status:</div>
<div class="switch-on switch-animate">
<input type="checkbox" data-toggle="switch"  <?php if($userinfo[0]['User']['user_active']==1){ ?>checked="checked" <?php } ?> id="userstatus"/>
</div>
</div>
</div>
<!--discrption end--> 
</div>    
<!--right said end--> 














