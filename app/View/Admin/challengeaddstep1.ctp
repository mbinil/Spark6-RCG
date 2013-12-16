<?php $newchallengeinfo = $this->Session->read("newchallengeinfo"); //print_r($newchallengeinfo); ?>
<script type="text/javascript">
function checkavail(val)
{
	$.ajax({  //Make the Ajax Request
		type: "POST",  
		url: "ajax_checkavail",
		data: "checkavail="+val+"&mode=Challenge",  //data
		success: function(response) {
			if(response=='1')
			{
				$('#message_span').html('Challenge name already exist!!');
                                $('#alert_div').show();
				$("#challengename").css("border-color", "red");
			}
                        else
                        {
                            $("#challengename").attr("style", "");
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
function badgenamechange(val)
{
	$("#badgename").html(val);
}
</script>
<!--Right said start-->
<div class="sitemap_nav" style="width:100%;">
    <ul class="nav nav-pills">
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/challengeaddstep1">About the challenge</a></li>
      <li><a>Categories & Duration</a></li>
      <li><a>Tags & Eligibility</a></li>
	  <li><a>Notifications & Difficulty</a></li>
	  <li><a>Image & Color</a></li>
      <li><a>SAVE</a></li>
    </ul>
</div>
<div class="clear"></div>
<hr/>  
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
  <div class="btn_next"><a href="javascript:gottochallengestep2();" class="btn btn-primary btn-block">Next</a></div>
  <h1>About the challenge</h1>
  <h3>This is where you enter info about the challenge such as name, description, etc.</h3>
  <div class="clear"></div>
<input type="hidden" name="step" value="2" id="step">
<!----Error message div------------------>
  <div class="alert" id="alert_div" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
    <button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
    <span id="message_span"></span>	
  </div>
<!--------------------------------------->
  <!--discrption-->
  <div class="Difficulty_step1" style="width:65%; float:left;">
    <div class="discrption_label" style="width:50%;font-weight:bold;">Name of challenge:</div>
    <div class="clear"></div>
    <input type="text" value="<?php if(isset($newchallengeinfo['name']) && $newchallengeinfo['name']!="") { echo $newchallengeinfo['name']; } ?>" placeholder="Challenge name" class="form-control input-sm" id="challengename" onblur="javascript:checkavail(this.value);" onblur="javascript:validateFieldcheck(this.id,this.value);">
    <div class="discrption_label" style="width:50%;font-weight:bold;">Badge Title:</div>
    <div class="clear"></div>
    <input type="text" value="<?php if(isset($newchallengeinfo['badge_title']) && $newchallengeinfo['badge_title']!="") { echo $newchallengeinfo['badge_title']; } ?>" placeholder="Badge title" class="form-control input-sm" id="badgetitle" onchange="javascript:badgenamechange(this.value);" onblur="javascript:validateFieldcheck(this.id,this.value);">
    <div class="discrption_label" style="width:50%;font-weight:bold;">Daily Commitment:</div>
    <div class="clear"></div>
    <textarea rows="3" class="form-control" id="dailycommit" onblur="javascript:validateFieldcheck(this.id,this.value);"><?php if(isset($newchallengeinfo['daily_commitment']) && $newchallengeinfo['daily_commitment']!="") { echo $newchallengeinfo['daily_commitment']; } ?></textarea>
    <div class="discrption_label" style="width:50%;font-weight:bold;">Why:</div>
    <div class="clear"></div>
    <textarea rows="3" class="form-control" id="why" onblur="javascript:validateFieldcheck(this.id,this.value);"><?php if(isset($newchallengeinfo['why']) && $newchallengeinfo['why']!="") { echo $newchallengeinfo['why']; } ?></textarea>
    <div class="discrption_label" style="width:50%;font-weight:bold;">How:</div>
    <div class="clear"></div>
    <textarea rows="5" class="form-control" id="how" onblur="javascript:validateFieldcheck(this.id,this.value);"><?php if(isset($newchallengeinfo['how']) && $newchallengeinfo['how']!="") { echo $newchallengeinfo['how']; } ?></textarea>
    <div class="discrption_label" style="width:50%;font-weight:bold;">Learn More:</div>
    <div class="clear"></div>
    <textarea rows="5" class="form-control" id="learnmore" style="margin-bottom:15px;" onblur="javascript:validateFieldcheck(this.id,this.value);"><?php if(isset($newchallengeinfo['learn_more']) && $newchallengeinfo['learn_more']!="") { echo $newchallengeinfo['learn_more']; } ?></textarea>
    <div style="width:100%;">
      <div style="width:30%;float:left;">
        <div class="discrption_label" style="width:90px;font-weight:bold;">Repeatable:</div>
        <div class="switch-on switch-animate">
          <input type="checkbox" data-toggle="switch" <?php if(isset($newchallengeinfo['repeatable']) && $newchallengeinfo['repeatable']!="0"){ ?>checked="checked" <?php } ?> id="repeatable">
        </div>
      </div>
      <div style="width:65%;float:right;">
        <div class="discrption_label" style="width:55px;font-weight:bold;">Status:</div>
        <div class="switch-on switch-animate">
          <input type="checkbox" data-toggle="switch" <?php if(isset($newchallengeinfo['status']) && $newchallengeinfo['status']!="0"){ ?>checked="checked" <?php } ?> id="status">
        </div>
      </div>
    </div>
    <div class="clear"></div>
    <div class="btn_next" style="margin:25px 0; float:left;"><a href="javascript:gottochallengestep2();" class="btn btn-primary btn-block">Next</a></div>
  </div>
  <div style="float:right; width:30%; margin-left:20px;">
    <div style="border-radius:100px;height:200px;margin:20px 60px 10px; <?php if(isset($newchallengeinfo['chalngparentchildimagename'])) { ?>background:url('../img/badgedesign/<?php echo $newchallengeinfo['chalngparentchildimagename']; ?>'); <?php } else { ?>background-color:#EEEEEE;<?php } ?>" id="child_image_div"></div>
	<?php if(isset($newchallengeinfo['chalngparentimagename'])) { ?>
	<div style="position: absolute; background-color:#AAAAAA; border-radius: 100px; width: 150px; height: 150px; margin: -184px 0 0 86px;"></div>
    <div id="parent_image_div" style="position: absolute; margin: -157px 0 0 109px;">
        <img width="100" src="../img/catuploads/<?php echo $newchallengeinfo['chalngparentimagename']; ?>">    </div>
	<?php } ?>
	<?php if(isset($newchallengeinfo['chalngdifficultyimagename'])) { ?>
    <div id="difficulty_image_div" style="position: absolute; margin: -83px 0 0 175px">
        <img width="33" src="../img/diffuploads/<?php echo $newchallengeinfo['chalngdifficultyimagename']; ?>">    </div>
	<?php } ?>
    <div style="color:#666666; text-align:center;" id="badgename"><?php if(isset($newchallengeinfo['badge_title']) && $newchallengeinfo['badge_title']!="") { echo $newchallengeinfo['badge_title']; } else { ?>Badge title<?php  } ?></div>
  </div>
  <!--discrption end-->
</div>
<!--right said end-->
