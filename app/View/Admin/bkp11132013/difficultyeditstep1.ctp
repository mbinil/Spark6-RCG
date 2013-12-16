<?php $diffinfo = $this->Session->read('diffinfo'); ?>
<!--Right said start-->           
<div class="container_right"><div class="btn_next">
  <a href="javascript:editstep2();" class="btn btn-primary btn-block">Next<span class="fui-arrow-right pull-right"></span></a>
</div>
<h1>Tell us a bit about the difficulty</h1>
<h3>Be as specific as you can! </h3>
<div class="clear"></div>
<!--discrption-->   
<div class="Difficulty_step1">
<div class="discrption_label">Title:</div>
<div class="discrption_label_right">e.g "Hard"</div>
<div class="clear"></div>
<input type="hidden" value="<?php echo $diffinfo[0]['Difficulty']['id']; ?>" id="diffid">
<input type="text" value="<?php echo $diffinfo[0]['Difficulty']['title']; ?>" placeholder="Difficulty title" class="form-control input-sm" id="difftitle">
<div class="discrption_label">Description:</div>
<div class="discrption_label_right">e.g "Adds an additional 10 points to whatever the challenge is already worth"</div>
<div class="clear"></div>
<textarea rows="3" placeholder="Add description..." class="form-control" id="diffdesp" ><?php echo $diffinfo[0]['Difficulty']['description']; ?></textarea>
<div class="discrption_label">Status:</div>
<div class="clear"></div>
<div class="switch-on switch-animate">
<input type="checkbox" data-toggle="switch" <?php if($diffinfo[0]['Difficulty']['status']!="0"){ ?>checked="checked" <?php } ?> id="diffstatus">
</div>
</div>
<!--discrption end--> 
</div>    
<!--right said end-->  