<?php $diffinfo = $this->Session->read('diffinfo'); ?>
<?php $newinfo = $this->Session->read('newdiffinfo'); ?>
<!--Right said start-->     
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
<div class="sitemap_nav">
    <ul class="nav nav-pills">
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/difficultyeditstep1/<?php echo $diffinfo[0]['Difficulty']['id']; ?>">Description</a></li>
      <li><a href="<?php echo Router::url('/', true); ?>admin/difficultyeditstep2/<?php echo $diffinfo[0]['Difficulty']['id']; ?>">Award</a></li>
      <li><a href="<?php echo Router::url('/', true); ?>admin/difficultyeditstep3/<?php echo $diffinfo[0]['Difficulty']['id']; ?>">Decal</a></li>
      <li><a>Save</a></li>
    </ul>
</div>
<div class="clear"></div>
<hr/> 
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
<div class="btn_next">
  <a href="javascript:editstep2();" class="btn btn-primary btn-block">Next<span class="fui-arrow-right pull-right"></span></a>
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
<input type="hidden" value="<?php echo $diffinfo[0]['Difficulty']['id']; ?>" id="diffid">
<input type="text" value="<?php echo str_replace('\"', '', $diffinfo[0]['Difficulty']['title']); ?>" placeholder="Difficulty title" class="form-control input-sm" id="difftitle" onblur="javascript:validateFieldcheck(this.id,this.value);" disabled="disabled" style="color:#666666;">
<div class="discrption_label">Description:</div>
<div class="discrption_label_right">e.g "The user works on this for at least 2 hours every day"</div>
<div class="clear"></div>
<textarea rows="3" placeholder="Add description..." class="form-control" id="diffdesp" onblur="javascript:validateFieldcheck(this.id,this.value);" ><?php if(isset($newinfo['description'])&&$newinfo['description']!=''){ echo stripslashes($newinfo['description']); } else { echo stripslashes($diffinfo[0]['Difficulty']['description']); }  ?></textarea>
<br>
<div class="discrption_label" style="width:55px;">Status:</div>
<div class="switch-on switch-animate">
<input type="checkbox" data-toggle="switch" <?php if($diffinfo[0]['Difficulty']['status']!="0"){ ?>checked="checked" <?php } ?> id="diffstatus">
</div>
</div>
<!--discrption end--> 
</div>    
<!--right said end-->  