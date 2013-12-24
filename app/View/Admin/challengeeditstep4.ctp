<?php $newchallengeinfo = $this->Session->read("newchallengeinfo"); //print_r($newchallengeinfo); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
function badgenamechange(val)
{
	$("#badgename").html(val);
}
function selectedpcat(id,cnt,image)
{
	deselectedpcat();
	var baseurl = $('#baseurl').val();
	$('#difficulty_image_div').html('<img src="'+baseurl+'img/diffuploads/'+image+'" width="33" />');
	$('#difficultyimagename').val(image);
	$('#difficultylist #chaldiff').val(id);
	$('#difficultylist #diffpoints'+id).css('color','#e65320');
	$('#difficultylist #difftitle'+id).css('color','#333333');
}
function deselectedpcat()
{
	$('#difficultylist div').css('color','#999999');
}
/*Field validation on blur of an input element*/
function validateFieldcheck(val)
{
	if(val == "" || val.length < 3)
	{
		$("#custnot").css("border-color", "red");
	}
	else
	{
		$("#custnot").css("border-color", "#BDC3C7");
	}
}

/**
 * open the dialogue box for creating new pre-written check-in notification
 */
function getMessageDialogue()
{
        $('#message_name').val('');
        $( "#dialog-modal" ).dialog({
          height: 140,
          width:  505,
          title: "Create New Message",
          modal: true
        });
}

/**
 * Inserting the message into the db and close the dialogue
 */
function getMessageClose()
{
    if($.trim($('#message_name').val()))
    {
		var baseurl = $('#baseurl').val();
        $( "#dialog-modal" ).dialog('close');
        $.ajax({  //Make the Ajax Request
            type: "POST",  
            url: baseurl+"ajax_createmessage",
            data: "message="+$('#message_name').val(),
            async: false,
            success: function(response) {
                var data    =   new Array();
                data        =   response.split('@#@');
                if(data[0] != 0)
                {
                    $('#prenot')
                        .append($("<option></option>")
                        .attr("value",data[1])
                        .text($('#message_name').val())); 
                    
                }
            } 
        });
    }
    else
    {
        $('#message_name').attr('style','width:230px;border: 1px solid RED;');
    }
}

// Some general UI pack related JS
// Extend JS String with repeat method
String.prototype.repeat = function(num) {
  return new Array(num + 1).join(this);
};

(function($) {

  // Add segments to a slider
  $.fn.addSliderSegments = function (amount) {
    return this.each(function () {
      var segmentGap = 100 / (amount - 1) + "%"
        , segment = "<div class='ui-slider-segment' style='margin-left: " + segmentGap + ";'></div>";
      $(this).prepend(segment.repeat(amount - 2));
    });
  };

  $(function() {

	// jQuery UI Sliders
	var $slider3 = $("#notification_frequency_length")
	  , slider3ValueMultiplier = 1
	  , slider3Options;
	
	if ($slider3.length > 0) {
	  $slider3.slider({
		min: 1,
		max: 10,
		value: <?php if(isset($newchallengeinfo[0]['Challenge']['notification_frequency'])&&$newchallengeinfo[0]['Challenge']['notification_frequency']!="") { echo $newchallengeinfo[0]['Challenge']['notification_frequency']; } else { ?>$('#notification_frequency_length #notification_frequency').val()/10<?php } ?>,
		orientation: "horizontal",
		range: "min",
		slide: function(event, ui) {
		  $( "#notification_frequency_length #notification_frequency" ).val( ui.value * slider3ValueMultiplier );	
		  $slider3.find(".ui-slider-value:last").html("Every "+ui.value * slider3ValueMultiplier + " day(s)");
                  //changeDate();
		},
		stop:function( event, ui ) {
			//changeDate();
		}
	  }).addSliderSegments($slider3.slider("option").max);
	}
    
  });
})(jQuery);
</script>
<!--Right said start-->
<style>
.select.select-block {
    width: 500px !important;
}
.select.select-block .btn {
    width: 500px !important;
}
.open > .dropdown-menu {
    width: 500px !important;
}
.btn-info {
    background-color: #CCC !important;
	color:#666 !important;
}
.dropdown-menu li.active > a, .dropdown-menu li.selected > a, .dropdown-menu li.active > a.highlighted, .dropdown-menu li.selected > a.highlighted {
    background: none repeat scroll 0 0 #CCC !important;
	color:#666 !important;
}
.ui-corner-all, .ui-corner-bottom, .ui-corner-right, .ui-corner-br {
    border-bottom-right-radius: 10px;
}
.ui-corner-all, .ui-corner-bottom, .ui-corner-left, .ui-corner-bl {
    border-bottom-left-radius: 10px;
}
.ui-corner-all, .ui-corner-top, .ui-corner-right, .ui-corner-tr {
    border-top-right-radius: 10px;
}
.ui-corner-all, .ui-corner-top, .ui-corner-left, .ui-corner-tl {
    border-top-left-radius: 10px;
}
</style>
<div class="sitemap_nav" style="width:100%;">
  <ul class="nav nav-pills">
    <li><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep1/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">About the challenge</a></li>
	<li><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep2/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">Categories & Duration</a></li>
	<li><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep3/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">Tags & Eligibility</a></li>
	<li class="active"><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep4/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">Notifications & Difficulty</a></li>
	<li><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep5/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">Image & Color</a></li>
    <li><a>SAVE</a></li>
  </ul>
</div>
<div class="clear"></div>
<hr/>
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
<div class="btn_next"> <a href="javascript:challengeeditstep5();" class="btn btn-primary btn-block">Next<span class="fui-arrow-right pull-right"></span></a> </div>
<h1>Notifications and Difficulty</h1>
<h3>How hard is this Challenge and how often must they check in for it?</h3>
<div class="clear"></div>
<!----Error message div------------------>
  <div class="alert" id="alert_div" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
    <button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
    <span id="message_span"></span>	
  </div>
<!--------------------------------------->
<!--discrption-->
<input type="hidden" id="baseurl" value="<?php echo Router::url('/', true); ?>" />
<input type="hidden" id="challengeid" value="<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>" />
<div class="Difficulty_step1" style="width:100%; float:left;">
  <div style="margin:10px 0; font-weight:bold; font-size: 18px;">Difficulty:</div>
  <div id="difficultylist" style="margin:10px 0;width:65%; float:left;">
  	<hr/>
    <?php $dcount = count($difficulties);  $i=0;foreach($difficulties as $diff) { 
if($i==0) { ?>
    <div id="<?php echo $diff['Difficulty']['id'];?>" style="margin-top:20px;height:135px;">
      <?php } else { ?>
      <div id="<?php echo $diff['Difficulty']['id'];?>" style="margin-top:30px;height:135px;">
        <?php } ?>
        <a style="width:100%;" href="Javascript:selectedpcat('<?php echo $diff['Difficulty']['id']; ?>','<?php echo $dcount; ?>','<?php echo $diff['Difficulty']['decal']; ?>');"> <span style="width:250px;"><img width="100" border="0" src="<?php echo Router::url('/', true); ?>img/diffuploads/<?php echo $diff['Difficulty']['decal']; ?>" style="background-color:#999999;"></span> </a>
		<a style="width:100%;" href="Javascript:selectedpcat('<?php echo $diff['Difficulty']['id']; ?>','<?php echo $dcount; ?>','<?php echo $diff['Difficulty']['decal']; ?>');"><div style="<?php if($newchallengeinfo[0]['Challenge']['difficulty'] == $diff['Difficulty']['id']) { ?>color:#E67E22;<?php } else { ?>color:#999999; <?php } ?>font-size: 48px;font-weight: normal;margin-top: -62px;padding-left: 130px;width: 350px;" id="diffpoints<?php echo $diff['Difficulty']['id']; ?>"><?php echo $diff['Difficulty']['points']; ?></div> </a>
        <a style="width:100%;" href="Javascript:selectedpcat('<?php echo $diff['Difficulty']['id']; ?>','<?php echo $dcount; ?>','<?php echo $diff['Difficulty']['decal']; ?>');"><div style="<?php if($newchallengeinfo[0]['Challenge']['difficulty'] == $diff['Difficulty']['id']) { ?>color:#333333;<?php } else { ?>color:#999999; <?php } ?>margin-top: 45px; padding-left: 0px; width: 100px; text-align: center;" id="difftitle<?php echo $diff['Difficulty']['id']; ?>"><?php echo str_replace('\"', '', $diff['Difficulty']['title']); ?></div> </a>
      </div>
	  <hr/>
          <?php if( $diff['Difficulty']['id'] == $newchallengeinfo[0]['Challenge']['difficulty']) { ?>
            <input type="hidden" value="<?php echo $newchallengeinfo[0]['Challenge']['difficulty']; ?>" id="chaldiff">
            
      <?php $i++; $newchallengeinfo[0]['Challenge']['chalngdifficultyimagename'] = $diff['Difficulty']['decal']; } } ?>
      
    </div>
    <div style="float:right; width:30%; margin-left:20px;">
        <div id="child_image_div" style="background-color:#EEEEEE;border-radius:100px;height:200px;margin:20px 60px 10px;<?php if(isset($newchallengeinfo[0]['Challenge']['chalngparentchildimagename']) && $newchallengeinfo) { ?> background:url('<?php echo Router::url('/', true); ?>img/badgedesign/<?php echo $newchallengeinfo[0]['Challenge']['chalngparentchildimagename']; ?>');<?php }?>"></div>
        <div style="position: absolute; <?php if(isset($newchallengeinfo[0]['Challenge']['chalngbadgecolorimagename'])) { ?>background:url('<?php echo Router::url('/', true); ?>img/badgecolor/<?php echo $newchallengeinfo[0]['Challenge']['chalngbadgecolorimagename']; ?>');<?php } else { ?>background-color:#AAAAAA; <?php } ?> border-radius: 100px; width: 150px; height: 150px; margin: -184px 0px 0px 86px;"></div>
        <div style="position: absolute; margin: -158px 0 0 110px;" id="parent_image_div" >
            <?php if(isset($newchallengeinfo[0]['Challenge']['chalngparentimagename']) && $newchallengeinfo) { ?><img src="<?php echo Router::url('/', true); ?>img/catuploads/<?php echo $newchallengeinfo[0]['Challenge']['chalngparentimagename']; ?>" width="100" /> <?php }?>
        </div>
        <div style="position: absolute; margin: -84px 0 0 175px;" id="difficulty_image_div" >
            <?php if(isset($newchallengeinfo[0]['Challenge']['chalngdifficultyimagename']) && $newchallengeinfo) { ?><img src="<?php echo Router::url('/', true); ?>img/diffuploads/<?php echo $newchallengeinfo[0]['Challenge']['chalngdifficultyimagename']; ?>" width="33" /> <?php }?>
        </div>
        <div style="color:#666666;text-align:center;" id="badgename"><?php echo $newchallengeinfo[0]['Challenge']['badge_title']; ?></div>
        <input type="hidden" id="difficultyimagename" value="<?php if(isset($newchallengeinfo[0]['Challenge']['chalngdifficultyimagename']) && $newchallengeinfo) { echo $newchallengeinfo[0]['Challenge']['chalngdifficultyimagename']; } ?>" />
      </div>
        
        
    <div class="clear"></div>
	<div style="margin:10px 0; font-weight:bold;">Pre-Written Check-in Notification</div>
	<div class="discrption_label_right" style="float:right;margin:-31px 565px 0 0;font-size:0.85em;font-weight:bold;">Need another message? <a href="javascript:getMessageDialogue();">create one now</a></div>
	<div style="margin:0px; float:left;">
            <select name="info" class="select-block" id="prenot">
                <option value="">Select a message</option>
        <?php foreach ($pre_notification_message as $key => $value) { ?>
                <option value="<?php echo $value['Notificationmessage']['id']; ?>" <?php if($newchallengeinfo[0]['Challenge']['pre_checkin_notification']== $value['Notificationmessage']['id'] ) { ?> selected="selected" <?php } ?> ><?php echo $value['Notificationmessage']['message']; ?></option>
        <?php } ?>
            </select>
	</div>
	<div class="clear"></div>
	<div style="border: 1px solid #AAAAAA;border-radius: 50px;color: #666666;float: left;font-weight: bold;height: 40px;margin: 15px 230px;padding: 8px 9px 10px 12px;width: 40px;">or</div>
	<div class="clear"></div>
	<div style="margin:10px 0; font-weight:bold;">Custom Check-in Notification</div>
	<div style="margin:0px; float:left;">
		<input type="text" id="custnot" placeholder="Type a Message" class="form-control input-sm" value="<?php if($newchallengeinfo[0]['Challenge']['checkin_notification']) { echo $newchallengeinfo[0]['Challenge']['checkin_notification']; } ?>" style="width:500px;" onblur="javascript:validateFieldcheck(this.value);">
	</div>
	<div class="clear"></div>
	<hr/>
	<div class="clear"></div>
	<br/>
	<div style="width:80%;float:left;">
		<div id="notification_frequency_length" class="ui-slider">
			<?php if($newchallengeinfo[0]['Challenge']['notification_frequency']!=''){
				$notfre = $newchallengeinfo[0]['Challenge']['notification_frequency']; 
			} else {
				$notfre = "1";
			} ?>
			<input type="hidden" id="notification_frequency" value="<?php echo $notfre; ?>" />
			<span class="ui-slider-value first"></span>
			<span style="float: left; margin-top: 12px; font-weight:bold;">Notification Frequency</span>
			<span class="ui-slider-value last">Every <?php echo $notfre; ?> day</span>
		</div>
	</div>
	<div class="clear"></div>
    <div class="btn_next" style="margin:25px 0; float:left;"> <a href="javascript:challengeeditstep5();" class="btn btn-primary btn-block">Next<span class="fui-arrow-right pull-right"></span></a> </div>
  </div>
  <!---->
  <!--discrption end-->
</div>
<!--right said end-->
<div id="dialog-modal" style="display: none;" >
  <form method="post">
    Message:
    <input name="message_name" id="message_name" style="width:230px;" maxlength="200" />
    <input type="button" name="submit" value="SELECT" onclick="getMessageClose()" style="width:100px;" />
    <div style="margin:-10px 0 0 150px;font-size:0.71em;">maximum 200 characters</div>
  </form>
</div>