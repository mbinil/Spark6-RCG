<?php $newchallengeinfo = $this->Session->read("newchallengeinfo"); //print_r($newchallengeinfo); ?>
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
function badgenamechange(val)
{
	$("#badgename").html(val);
}
</script>
<!--Right said start-->
<div class="sitemap_nav" style="width:100%;">
    <ul class="nav nav-pills">
      	<li class="active"><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep1/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">About the challenge</a></li>
		<li><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep2/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">Categories & Duration</a></li>
		<li><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep3/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">Tags & Eligibility</a></li>
		<li><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep4/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">Notifications & Difficulty</a></li>
		<li><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep5/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">Image & Color</a></li>
		<li><a>SAVE</a></li>
    </ul>
</div>
<div class="clear"></div>
<hr/>  
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
  <div class="btn_next"> <a href="javascript:challengeeditstep2();" class="btn btn-primary btn-block">Next<span class="fui-arrow-right pull-right"></span></a> </div>
  <h1>About the challenge</h1>
  <h3>This is where you enter info about the challenge such as name, description, etc.</h3>
  <div class="clear"></div>
  <!----Error message div------------------>
  <div class="alert" id="alert_div" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
    <button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
    <span id="message_span"></span>	
  </div>
<!--------------------------------------->
  <!--discrption-->
  <input type="hidden" id="challengeid" value="<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>" />
  <div class="Difficulty_step1" style="width:65%; float:left;">
    <div class="discrption_label" style="width:50%;font-weight:bold;">Name of challenge:</div>
    <div class="clear"></div>
    <input type="text" value="<?php if(isset($newchallengeinfo[0]['Challenge']['name']) && $newchallengeinfo[0]['Challenge']['name']!="") { echo $newchallengeinfo[0]['Challenge']['name']; } ?>" placeholder="Challenge name" class="form-control input-sm" id="challengename" disabled="disabled" style="color:#666666;">
    <div class="discrption_label">Badge Title:</div>
    <div class="discrption_label_right"></div>
    <div class="clear"></div>
    <input type="text" value="<?php if(isset($newchallengeinfo[0]['Challenge']['badge_title']) && $newchallengeinfo[0]['Challenge']['badge_title']!="") { echo $newchallengeinfo[0]['Challenge']['badge_title']; } ?>" placeholder="Badge title" class="form-control input-sm" id="badgetitle" onchange="javascript:badgenamechange(this.value);" onblur="javascript:validateFieldcheck(this.id,this.value);">
    <div class="discrption_label">Daily Commitment:</div>
    <div class="discrption_label_right"></div>
    <div class="clear"></div>
    <textarea rows="3" class="form-control" id="dailycommit" onblur="javascript:validateFieldcheck(this.id,this.value);"><?php if(isset($newchallengeinfo[0]['Challenge']['daily_commitment']) && $newchallengeinfo[0]['Challenge']['daily_commitment']!="") { echo $newchallengeinfo[0]['Challenge']['daily_commitment']; } ?></textarea>
    <div class="discrption_label">Why:</div>
    <div class="discrption_label_right"></div>
    <div class="clear"></div>
    <textarea rows="3" class="form-control" id="why" onblur="javascript:validateFieldcheck(this.id,this.value);"><?php if(isset($newchallengeinfo[0]['Challenge']['why']) && $newchallengeinfo[0]['Challenge']['why']!="") { echo $newchallengeinfo[0]['Challenge']['why']; } ?></textarea>
    <div class="discrption_label">How:</div>
    <div class="discrption_label_right"></div>
    <div class="clear"></div>
    <textarea rows="5" class="form-control" id="how" onblur="javascript:validateFieldcheck(this.id,this.value);"><?php if(isset($newchallengeinfo[0]['Challenge']['how']) && $newchallengeinfo[0]['Challenge']['how']!="") { echo $newchallengeinfo[0]['Challenge']['how']; } ?></textarea>
    <div class="discrption_label">Learn More:</div>
    <div class="discrption_label_right"></div>
    <div class="clear"></div>
    <textarea rows="5" class="form-control" id="learnmore" style="margin-bottom:15px;" onblur="javascript:validateFieldcheck(this.id,this.value);"><?php if(isset($newchallengeinfo[0]['Challenge']['learn_more']) && $newchallengeinfo[0]['Challenge']['learn_more']!="") { echo $newchallengeinfo[0]['Challenge']['learn_more']; } ?></textarea>
    <div style="width:100%;">
      <div style="width:30%;float:left;">
        <div class="discrption_label" style="width:90px;">Repeatable:</div>
        <div class="switch-on switch-animate">
          <input type="checkbox" data-toggle="switch" <?php if(isset($newchallengeinfo[0]['Challenge']['repeatable']) && $newchallengeinfo[0]['Challenge']['repeatable']!="0"){ ?>checked="checked" <?php } ?> id="repeatable">
        </div>
      </div>
      <div style="width:65%;float:right;">
        <div class="discrption_label" style="width:55px;">Status:</div>
        <div class="switch-on switch-animate">
          <input type="checkbox" data-toggle="switch" <?php if(isset($newchallengeinfo[0]['Challenge']['status']) && $newchallengeinfo[0]['Challenge']['status']!="0"){ ?>checked="checked" <?php } ?> id="status">
        </div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="btn_next" style="margin:25px 0; float:left;"> <a href="javascript:challengeeditstep2();" class="btn btn-primary btn-block">Next<span class="fui-arrow-right pull-right"></span></a> </div>
  </div>
<!--  <div style="float:right; width:30%; margin-left:20px;">
  	<div style="background-color:#EEEEEE; border-radius: 100px; height: 200px; margin: 20px 60px 10px;"></div>
	<div style="color:#666666; text-align:center;" id="badgename"><?php if(isset($newchallengeinfo[0]['Challenge']['badge_title']) && $newchallengeinfo[0]['Challenge']['badge_title']!="") { echo $newchallengeinfo[0]['Challenge']['badge_title']; } else { ?>Badge title<?php  } ?></div>
  </div>-->
  
  
  
  <div style="float:right; width:30%; margin-left:20px;">
    <div style="background-color:#EEEEEE;border-radius:100px;height:200px;margin:20px 60px 10px; <?php if(isset($newchallengeinfo[0]['Challenge']['chalngparentchildimagename']) && $newchallengeinfo[0]['Challenge']['chalngparentchildimagename']) { ?>background:url('<?php echo Router::url('/', true); ?>img/badgedesign/<?php echo $newchallengeinfo[0]['Challenge']['chalngparentchildimagename']; ?>')<?php } ?>;" id="child_image_div"></div>;
    <div id="badge_color_image_div" style="position: absolute; <?php if(isset($newchallengeinfo[0]['Challenge']['chalngbadgecolorimagename'])) { ?>background:url('<?php echo Router::url('/', true); ?>img/badgecolor/<?php echo $newchallengeinfo[0]['Challenge']['chalngbadgecolorimagename']; ?>');<?php } else { ?>background-color:#AAAAAA; <?php } ?>border-radius: 100px; width: 150px; height: 150px; margin: -206px 0 0 86px">
    </div>
    <div id="parent_image_div" style="position: absolute; margin: -181px 0 0 109px;">
        <img width="100" src="<?php echo Router::url('/', true); ?>img/catuploads/<?php if(isset($newchallengeinfo[0]['Challenge']['chalngparentimagename'])) echo $newchallengeinfo[0]['Challenge']['chalngparentimagename']; ?>">
    </div>
    <div id="difficulty_image_div" style="position: absolute; margin: -107px 0 0 175px">
        <img width="33" src="<?php echo Router::url('/', true); ?>img/diffuploads/<?php if(isset($newchallengeinfo[0]['Challenge']['chalngdifficultyimagename'])) echo $newchallengeinfo[0]['Challenge']['chalngdifficultyimagename']; ?>">
    </div>
    <div style="color:#666666; text-align:center;" id="badgename"><?php if(isset($newchallengeinfo[0]['Challenge']['badge_title']) && $newchallengeinfo[0]['Challenge']['badge_title']!="") { echo $newchallengeinfo[0]['Challenge']['badge_title']; } else { ?>Badge title<?php  } ?></div>
  </div>
  <!--discrption end-->
</div>
<!--right said end-->
