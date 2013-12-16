<?php
 $diffinfo = $this->Session->read('newdiffinfo');
 $stepinfo = $this->Session->read('stepinfo');
 ?>
<script type="text/javascript">
function checkavail(val)
{
	$.ajax({  //Make the Ajax Request
		type: "POST",  
		url: "ajax_checkavail",
		data: "checkavail="+val+"&mode=Difficulty",  //data
		success: function(response) {
			if(response=='1')
			{
                                $('#message_span').html('Difficulty title already exist!!');
                                $('#alert_div').show();
				$("#difftitle").css("border-color", "red");
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
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/difficultyaddstep1">Description</a></li>
      <li><a>Award</a></li>
      <li><a>Decal</a></li>
      <li><a>Save</a></li>
    </ul>
</div>
<div class="clear"></div>
<hr/>        
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
<div class="btn_next">
  <a href="javascript:gottostep2();" class="btn btn-primary btn-block">Next<span class="fui-arrow-right pull-right"></span></a>
</div>
<h1>Tell us a bit about the difficulty</h1>
<h3>Be as specific as you can! </h3>
<div class="clear"></div>
  <!----Error message div------------------>
  <div class="alert" id="alert_div" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
    <button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
    <span id="message_span"></span>	
  </div>
<!--------------------------------------->
<!--discrption-->   
<div class="Difficulty_step1" style="width:65%; float:left;">
<div class="discrption_label">Title:</div>
<div class="discrption_label_right">e.g "Hard"</div>
<div class="clear"></div>
<input type="hidden" name="step" value="2" id="step">
<input type="text"  placeholder="Difficulty title" class="form-control input-sm" id="difftitle"  <?php if(isset($diffinfo['title'])&&$diffinfo['title']!=''){ ?>value="<?php echo $diffinfo['title']; ?>" <?php } ?> onblur="javascript:checkavail(this.value);" onblur="javascript:validateFieldcheck(this.id,this.value);">
<div class="discrption_label">Description:</div>
<div class="discrption_label_right">e.g "The user works on this for at least 2 hours every day"</div>
<div class="clear"></div>
<textarea rows="3" placeholder="Add description..." class="form-control" id="diffdesp" onblur="javascript:validateFieldcheck(this.id,this.value);"><?php if(isset($diffinfo['description'])&&$diffinfo['description']!=''){  echo stripslashes($diffinfo['description']); } ?></textarea>
<br>
<div class="discrption_label" style="width:55px;">Status:</div>
<div class="switch-on switch-animate">
<input type="checkbox" data-toggle="switch" <?php if($diffinfo['status']!="0"){ ?>checked="checked" <?php } ?> id="diffstatus">
</div>
</div>
<!--discrption end--> 
</div>    
<!--right said end-->  