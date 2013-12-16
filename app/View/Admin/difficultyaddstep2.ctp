<?php
 $diffinfo = $this->Session->read('newdiffinfo');
 $stepinfo = $this->Session->read('stepinfo');
?>
<!--Right said start-->   
<div class="sitemap_nav">
    <ul class="nav nav-pills">
      <li><a href="<?php echo Router::url('/', true); ?>admin/difficultyaddstep1">Description</a></li>
      <li class="active" ><a href="<?php echo Router::url('/', true); ?>admin/difficultyaddstep2" <?php if($stepinfo<2) { ?>onclick="this.removeAttribute('href');" <?php } ?> >Award</a></li>
      <li><a>Decal</a></li>
      <li><a>Save</a></li>
    </ul>
</div>
<div class="clear"></div>
<hr/>
<input type="hidden" name="step" value="3" id="step">  
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
<div class="btn_next">
  <a href="javascript:gottostep3();" class="btn btn-primary btn-block">Next<span class="fui-arrow-right pull-right"></span></a>
</div>
<h1>How hard is it?</h1>
<h3>Move the slider to choose how many points are awarded for this difficulty category.</h3>
<br/>Points:<br/><br />
<div class="clear"></div>
<!--discrption-->  
<div class="Difficulty_step1" style="width:65%; float:left;">
<div id="difficultypoints" class="ui-slider">
	<input type="hidden" id="diffmode" value="<?php if(isset($diffinfo['points']) && $diffinfo['points']!=''){ echo $diffinfo['points']; } else { echo '1'; } ?>" />
	<span class="ui-slider-value first"></span>
	<span class="ui-slider-value last">+<?php if(isset($diffinfo['points']) && $diffinfo['points']!=''){ echo $diffinfo['points'];} else { echo '0';} ?></span>
</div>
</div>
<!--discrption end--> 
</div>    
<!--right said end-->  