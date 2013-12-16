<?php $diffinfo = $this->Session->read('diffinfo'); ?>
<!--Right said start-->           
<div class="container_right">
<div class="btn_next">
  <a href="javascript:editstep3();" class="btn btn-primary btn-block">Next<span class="fui-arrow-right pull-right"></span></a>
</div>
<h1>How hard is it?</h1>
<h3>Move the slider to choose between easy, medium or hard!</h3>
<br /><br />
<div class="clear"></div>
<!--discrption-->  
<div class="Difficulty_step1">
<div id="difficultypoints" class="ui-slider">
	<input type="hidden" value="<?php echo $diffinfo[0]['Difficulty']['id']; ?>" id="diffid">
	<?php if($diffinfo[0]['Difficulty']['points']!=''){
		$diffmode = $diffinfo[0]['Difficulty']['points']; 
	} else {
		$diffmode = "0";
	} ?>
	<input type="hidden" id="diffmode" value="<?php echo $diffmode; ?>" />
	<span class="ui-slider-value last">+<?php echo $diffmode; ?></span>
</div>
</div>
<!--discrption end--> 
</div>    
<!--right said end-->  