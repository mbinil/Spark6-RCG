<?php $diffinfo = $this->Session->read('diffinfo'); ?>
<?php $newinfo = $this->Session->read('newdiffinfo'); ?>
<!--Right said start--> 
<div class="sitemap_nav">
    <ul class="nav nav-pills">
      <li ><a href="<?php echo Router::url('/', true); ?>admin/difficultyeditstep1/<?php echo $diffinfo[0]['Difficulty']['id']; ?>">Description</a></li>
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/difficultyeditstep2/<?php echo $diffinfo[0]['Difficulty']['id']; ?>">Award</a></li>
      <li><a href="<?php echo Router::url('/', true); ?>admin/difficultyeditstep3/<?php echo $diffinfo[0]['Difficulty']['id']; ?>">Decal</a></li>
      <li><a>Save</a></li>
    </ul>
</div>
<div class="clear"></div>
<hr/> 
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
<div class="btn_next">
  <a href="javascript:editstep3();" class="btn btn-primary btn-block">Next<span class="fui-arrow-right pull-right"></span></a>
</div>
<h1>How hard is it?</h1>
<h3>Move the slider to choose how many points are awarded for this difficulty category.</h3>
<br/>Points:<br/><br />
<div class="clear"></div>
<!--discrption-->  
<div class="Difficulty_step1" style="width:65%; float:left;">
<div id="difficultypoints" class="ui-slider">
	<input type="hidden" value="<?php echo $diffinfo[0]['Difficulty']['id']; ?>" id="diffid">
	<?php if($diffinfo[0]['Difficulty']['points']!=''){
		$diffmode = $diffinfo[0]['Difficulty']['points']; 
	} else {
		$diffmode = "0";
	} ?>
	<input type="hidden" id="diffmode" value="<?php if(isset($newinfo['points'])&& $newinfo['points']!='') { echo $newinfo['points']; } else { echo $diffmode;} ?>" />
	<span class="ui-slider-value last">+<?php echo $diffmode; ?></span>
</div>
</div>
<!--discrption end--> 
</div>    
<!--right said end-->  