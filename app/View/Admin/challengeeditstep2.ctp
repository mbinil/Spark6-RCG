<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<style>
.ui-datepicker {
	box-shadow: none;
	border: 7px solid #f6f6f6;
}
.ui-datepicker .ui-datepicker-prev {
	border-right: 2px solid #f6f6f6;
}
.ui-datepicker .ui-datepicker-next {
	border-left: 2px solid #f6f6f6;
}
.ui-datepicker .ui-datepicker-header {
	background-color: #f6f6f6;
	color:#3e4850;
	font-weight:bold;
}
.ui-datepicker .ui-datepicker-prev:hover, .ui-datepicker .ui-datepicker-next:hover {
	background-color: #f6f6f6;
}
.ui-datepicker .ui-datepicker-prev:active, .ui-datepicker .ui-datepicker-next:active {
	background-color: #f6f6f6;
}
#datepicker-from .ui-datepicker .ui-state-active {
	background-color: #62b483;
	color: #FFFFFF;
}
#datepicker-to .ui-datepicker .ui-state-active {
	background-color: #e65320;
	color: #FFFFFF;
}
.ui-datepicker td span, .ui-datepicker td a {
	min-width:33px;
}
.ui-datepicker .ui-icon-circle-triangle-w {
	border-color:rgba(0, 0, 0, 0) #000000 rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);
}
.ui-datepicker .ui-icon-circle-triangle-e {
	border-color:rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) #000000;
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
.ui-widget-header {
    background-color: #B2B2B2;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    background-color: #B2B2B2;
    border: 1px solid #B2B2B2;
}
.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus {
    background-color: #B2B2B2;
    border: 1px solid #B2B2B2;
}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
    background-color: #B2B2B2;
    border: 1px solid #B2B2B2;
}
.ui-icon-circle-triangle-w {
    background-position: 25px -192px;
}
.ui-icon-circle-triangle-e {
    background-position: 0 -192px;
}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
	background: none;
}
.ui-datepicker td span, .ui-datepicker td a {
    padding: 0;
    text-align: center;
}
.btn-info {
    background-color: #CCC !important;
	color:#666 !important;
}
.dropdown-menu li.active > a, .dropdown-menu li.selected > a, .dropdown-menu li.active > a.highlighted, .dropdown-menu li.selected > a.highlighted {
    background: none repeat scroll 0 0 #CCC !important;
	color:#666 !important;
}
</style>
<?php $newchallengeinfo = $this->Session->read("newchallengeinfo"); //print_r($newchallengeinfo); ?>
<script type="text/javascript">
$('#child_val').live('change',function(){
	var baseurl = $('#baseurl').val();
        var val =   $(this).val();
        $('#child_category_val').val($(this).val());
        if( val != 0)
        {
            $.ajax({  //Make the Ajax Request
                    type: "POST",  
                    url: baseurl+"admin/ajax_getchildcombo",
                    data: "id="+$(this).val(),  //data
                    async:false,
                    success: function(response) {
                        var data    =   new Array();
                        data        =   response.split('@#@');
                        if(val != 0)
                        {
                            $('#child_image_div').css('background','url("'+baseurl+'img/badgedesign/'+data[2]+'")');
                            $('#child_image_name').val(data[2]);
                        }
                    }
                });
        }
        else
        {
            $('#child_image_div').css('background','url("")');
            $('#child_image_div').css('background-color','#EEEEEE');
            $('#child_image_name').val('');
        }
});

function badgenamechange(val)
{
	$("#badgename").html(val);
}
function selectedpcat(id, count)
{
	var baseurl = $('#baseurl').val();
	$('#child_category_val').val(0);
	$('.childclass').each(function(){
		$(this).html('');
	});

	$('#childdiv_'+id).html('<img alt="Image" src="'+baseurl+'img/loading.gif" width="50" height="50">');

	$.ajax({  //Make the Ajax Request
		type: "POST",  
		url: baseurl+"admin/ajax_getchildcombo",
		data: "id="+id,  //data
		async:false,
		success: function(response) {
			
			var data    =   new Array();
			data        =   response.split('@#@');
			$('#childdiv_'+id).html(data[0]+'<br/>Need another child category?<a href="javascript:getChildCategory();">create one now</a>');
			$('#parent_image_div').html('<img src="'+baseurl+'img/catuploads/'+data[1]+'" width="100" />');
			$('#child_image_div').html('');
			$('#parent_image_name').val(data[1]);
			$('#child_image_name').val('');
		}
	});

	removeallselection()
	$('#parentcat #'+id).removeClass("pcatindividual");
	$('#parentcat #'+id).addClass("pcatindividualselected");
	$('#parentcat #chalngparent').val(id);
}
function removeallselection()
{
	$('#parentcat div').removeClass("pcatindividualselected");
	$('#parentcat div').addClass("pcatindividual");
}

/**
 * calling the child category add dialogue here
 */
function getChildCategory()
{
    $( "#dialog-child_category" ).dialog({
        height: 440,
        width:  785,
        title:'Create a New Child Category',
        modal: true
    });
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
	var $slider3 = $("#challengelength")
	  , slider3ValueMultiplier = 1
	  , slider3Options;
	
	if ($slider3.length > 0) {
	  $slider3.slider({
		min: 1,
		max: 90,
		value: <?php if(isset($newchallengeinfo[0]['Challenge']['length_of_challenge'])&&$newchallengeinfo[0]['Challenge']['length_of_challenge']!="") { echo $newchallengeinfo[0]['Challenge']['length_of_challenge']; } else { ?>$('#challengelength #chalnglen').val()/90 <?php } ?>,
		orientation: "horizontal",
		range: "min",
		slide: function(event, ui) {
			$( "#challengelength #chalnglen" ).val( ui.value * slider3ValueMultiplier );	
			$slider3.find(".ui-slider-value:last").html(ui.value * slider3ValueMultiplier + " days");
		},
		stop:function( event, ui ) {
			changeDate();
		}
	  }).addSliderSegments($slider3.slider("option").max);
	}
    
  });
})(jQuery);

$(function() {

var min_date    =   getDays('<?php echo date('Y-m-d',strtotime($newchallengeinfo[0]['Challenge']['start_date'])); ?>', '');


	$( "#datepicker-from" ).datepicker({ minDate: min_date,onSelect: function( selectedDate ) {
		changeDate();
	}});
	$( "#datepicker-from" ).datepicker("setDate", min_date);
	$( "#datepicker-to" ).datepicker({ minDate: 0, maxDate: "+4D" });

	changeDate();
	$( "#datepicker-to" ).datepicker( "option", "disabled", true );
});

function changeDate()
{
var min_date    =   0;
        min_date    =   getDays($("#datepicker-from").datepicker('getDate'));


	var date    =   $("#datepicker-from").datepicker('getDate'); //getting from date picker selected date.
	var days    =   getDays(date,$('#chalnglen').val())

	$( "#datepicker-to" ).datepicker( "destroy" );
	$( "#datepicker-to" ).datepicker({ minDate: min_date, maxDate: days });
	$( "#datepicker-to" ).datepicker( "setDate", days );
	$( "#datepicker-to" ).datepicker('show');
	$( "#datepicker-to" ).datepicker( "option", "disabled", true );
	return true;
}

function getDays(date,val)
{
	val   =   val?$('#chalnglen').val():'';
  
	var d = new Date(date); // format that date and get the days of that date.

	var current_day   =   new Date(); // format current date and get the days of that date.

	var days = d - current_day; // days difference between two dates

	var diffS = days / 1000;    

	var diffM = diffS / 60;

	var diffH = diffM / 60;

	var diffD = diffH / 24;

	days = Math.floor(diffD);

	if(val)
		days    =   days +  parseFloat(val) - 1;



	if(days >= 0)
	{
		return '+'+parseFloat( (days) + 1)+'D';
	}
	else
	{
		return '-'+parseFloat( parseFloat( (days) + 1) * -1)+'D';
	}
}

/**
 * Calling the parent category dialogue...
 */
function getParentCategory()
{
	$('#pcattitle').val('');
	$('#fileuploaded').val('');
	$('#show_file_ul').html('');
	$( "#dialog-parent_category" ).dialog({
		height: 540,
		width:  885,
		modal: true
	});
}
</script>
<!--Right said start-->
<div class="sitemap_nav" style="width:100%;">
    <ul class="nav nav-pills">
        <li><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep1/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">About the challenge</a></li>
		<li class="active"><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep2/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">Categories & Duration</a></li>
		<li><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep3/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">Tags & Eligibility</a></li>
		<li><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep4/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">Notifications & Difficulty</a></li>
		<li><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep5/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">Image & Color</a></li>
		<li><a>SAVE</a></li>
    </ul>
</div>
<div class="clear"></div>
<hr/>  
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
  <div class="btn_next"><a href="javascript:challengeeditstep3();" class="btn btn-primary btn-block">Next</a></div>
  <h1>Categories and Lengths of Challenge</h1>
  <h3>How should we classify your Challenge? Who is eligible for it? Let us know!</h3>
  <div class="clear"></div>
  <!----Error message div------------------>
  <div class="alert" id="alert_div" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
    <button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
    <span id="message_span"></span>	
  </div>
<!--------------------------------------->
<input type="hidden" id="baseurl" value="<?php echo Router::url('/', true); ?>" />
  <!--discrption-->
<input type="hidden" id="child_category_val" name="child_category_val" value="<?php echo $newchallengeinfo[0]['Challenge']['child_category']; ?>" >
<input type="hidden" id="child_image_name" value="<?php if(isset($newchallengeinfo[0]['Challenge']['chalngparentchildimagename']) && $newchallengeinfo) { echo $newchallengeinfo[0]['Challenge']['chalngparentchildimagename']; } ?>" >
<input type="hidden" id="parent_image_name" value="<?php if(isset($newchallengeinfo[0]['Challenge']['chalngparentimagename']) && $newchallengeinfo) { echo $newchallengeinfo[0]['Challenge']['chalngparentimagename']; } ?>" >
<input type="hidden" id="challengeid" value="<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>" />
  <input type="hidden" name="controller_action" id="controller_action" value="edit" />
  <div class="Difficulty_step1" style="width:100%; float:left;">
    <div style="width:100%;">
      <div style="width:65%; float:left;">
        <div style="margin:10px 0 0 0; font-weight:bold; font-size: 18px;">Parent Category:</div>
		<div id="parentcat" style="margin:10px 0;">
		<?php $pccount = count($pcategories);  $i=0;foreach($pcategories as $pcat) { 
		if($i==0) { ?>
			<div <?php if($newchallengeinfo[0]['Challenge']['parent_category']==$pcat['Category']['id']){ ?> class="pcatindividualselected"<?php } else { ?> class="pcatindividual" <?php } ?>id="<?php echo $pcat['Category']['id']; ?>" style="width:650px;margin-top:20px;height:102px;">
		<?php } else { ?>
			<div <?php if($newchallengeinfo[0]['Challenge']['parent_category']==$pcat['Category']['id']){ ?> class="pcatindividualselected"<?php } else { ?> class="pcatindividual" <?php } ?>id="<?php echo $pcat['Category']['id']; ?>" style="width:650px;margin-top:30px;height:102px;">
		<?php } ?>
		<a style="width:100%;" href="Javascript:selectedpcat('<?php echo $pcat['Category']['id']; ?>','<?php echo $pccount; ?>');">
		<span style="width:250px;"><img width="100" border="0" src="<?php echo Router::url('/', true); ?>img/catuploads/<?php echo $pcat['Category']['decal']; ?>" style="background-color:#999999;"></span>
		<div class="pcatindividual" style="width: 350px; padding-left: 130px; margin-top: -62px; color:#999999;"><?php echo str_replace('\"', '', $pcat['Category']['title']); ?></div>
		</a>
		</div>
<div class="childclass" id="childdiv_<?php echo $pcat['Category']['id']; ?>" style="float: left; text-align: left; margin: -80px 0 0 330px; height: 25px; width: 300px; color:#999999;" >
<?php if(isset($newchallengeinfo[0]['Challenge']['parent_category']) && $newchallengeinfo && ($pcat['Category']['id'] == $newchallengeinfo[0]['Challenge']['parent_category']) ) { 
    echo $child_combo;
?>
Need another child category?<a href="javascript:getChildCategory();">create one now</a>
<?php } ?>
</div>
		<hr/>
		<?php $i++; } ?>
		<input type="hidden" value="<?php echo $newchallengeinfo[0]['Challenge']['parent_category']; ?>" id="chalngparent">
		</div>
		<br/>
        <div class="discrption_label_right" style="margin-top: -20px;">Need another parent category?<a href="javascript:getParentCategory();" >create one now</a></div>
      </div>
<div style="float:right; width:30%; margin-left:20px;">
    <div style="background-color:#EEEEEE;border-radius:100px;height:200px;margin:20px 60px 10px; <?php if(isset($newchallengeinfo[0]['Challenge']['chalngparentchildimagename']) && $newchallengeinfo[0]['Challenge']['chalngparentchildimagename']) { ?>background:url('<?php echo Router::url('/', true); ?>img/badgedesign/<?php echo $newchallengeinfo[0]['Challenge']['chalngparentchildimagename']; ?>')<?php } ?>;" id="child_image_div"></div>;
    <div id="badge_color_image_div" style="position: absolute; <?php if(isset($newchallengeinfo[0]['Challenge']['chalngbadgecolorimagename'])) { ?>background:url('<?php echo Router::url('/', true); ?>img/badgecolor/<?php echo $newchallengeinfo[0]['Challenge']['chalngbadgecolorimagename']; ?>');<?php } else { ?>background-color:#AAAAAA; <?php } ?>border-radius: 100px; width: 150px; height: 150px; margin: -206px 0 0 86px;">
    </div>
    <div id="parent_image_div" style="position: absolute; margin: -181px 0 0 109px;">
        <img width="100" src="<?php echo Router::url('/', true); ?>img/catuploads/<?php if(isset($newchallengeinfo[0]['Challenge']['chalngparentimagename'])) echo $newchallengeinfo[0]['Challenge']['chalngparentimagename']; ?>">
    </div>
    <div id="difficulty_image_div" style="position: absolute; margin: -107px 0 0 175px">
        <img width="33" src="<?php echo Router::url('/', true); ?>img/diffuploads/<?php if(isset($newchallengeinfo[0]['Challenge']['chalngdifficultyimagename'])) echo $newchallengeinfo[0]['Challenge']['chalngdifficultyimagename']; ?>">
    </div>
    <div style="color:#666666; text-align:center;" id="badgename"><?php if(isset($newchallengeinfo[0]['Challenge']['badge_title']) && $newchallengeinfo[0]['Challenge']['badge_title']!="") { echo $newchallengeinfo[0]['Challenge']['badge_title']; } else { ?>Badge title<?php  } ?></div>
</div>
    </div>
    <div class="clear"></div>
	<hr/>
	<div class="clear"></div>
	<div style="margin:10px 0 0 0;font-weight:bold; font-size: 18px;">Length of Challenge:</div>
	<br/>
	<div style="width:80%;float:left;">
		<div id="challengelength" class="ui-slider">
			<?php if($newchallengeinfo[0]['Challenge']['length_of_challenge']!=''){
				$chalnglen = $newchallengeinfo[0]['Challenge']['length_of_challenge']; 
			} else {
				$chalnglen = "1";
			} ?>
			<input type="hidden" id="chalnglen" value="<?php echo $chalnglen; ?>" />
			<span class="ui-slider-value first"></span>
			<span class="ui-slider-value last"><?php echo $chalnglen; ?> days</span>
		</div>
	</div>
	<div class="clear"></div>
	<hr/>
	<div class="clear"></div>
	<div style="margin:10px 0 0 0;font-weight:bold; font-size: 18px;">Select Begining and End Dates</div>
	<div style="width:80%;float:left;margin:15px 0 30px;">
		<input type="radio" id="chalngwhosets" name="chalngwhosets" value="0" onclick="$('#datepicker_div').hide();" <?php if($newchallengeinfo[0]['Challenge']['host_set_start_date']==0){ ?> checked="checked" <?php } ?> /><span style="margin-left:10px;">User shall set the start-date for this challenge</span><br/>
		<input type="radio" id="chalngwhosets" name="chalngwhosets" value="1" onclick="$('#datepicker_div').show();" <?php if($newchallengeinfo[0]['Challenge']['host_set_start_date']==1){ ?> checked="checked" <?php } ?> /><span style="margin-left:10px;">Admin shall set the start-date for this challenge</span>
	</div>
	<div style="width:80%;float:left;margin-bottom:25px;<?php if(isset($newchallengeinfo[0]['Challenge']['host_set_start_date']) && ( $newchallengeinfo[0]['Challenge']['host_set_start_date'] == 0) ) { ?>display:none;<?php } ?>" id="datepicker_div"> 
		<div style="float:left; margin:0 30px 0 0;">
			<div style="text-align:center;font-weight:bold;">BEGIN</div>
			<div id="datepicker-from"></div>
		</div>
		<div style="float:left;">
			<div style="text-align:center;font-weight:bold;">END</div>
			<div id="datepicker-to"></div>
		</div>
	</div>
	<div class="clear"></div>
    <div class="btn_next" style="margin:25px 0;float:left;"> 
		<a href="javascript:challengeeditstep3();" class="btn btn-primary btn-block">Next</a> 
	</div>
  </div>
  <!---->
  <!--discrption end-->
</div>
<!--right said end-->
<div id="dialog-parent_category" style="display: none;" >
    <?php echo $this->element('categoryparentadd',array('mode'=>'Parent','rootpath'=>'../../img/catuploads')); ?>
</div>
<div id="dialog-child_category" style="display: none;" >
    <?php echo $this->element('element_categorychildadd'); ?>
</div>