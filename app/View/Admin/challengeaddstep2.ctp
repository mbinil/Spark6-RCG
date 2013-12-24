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
var session_start_date = '<?php echo (isset($newchallengeinfo['start_date']))?$newchallengeinfo['start_date']:'';?>';

$('#child_val').live('change',function(){
	var baseurl = $('#baseurl').val();
        var val =   $(this).val();
        $('#child_category_val').val($(this).val());
        if( val != 0)
        {
            $.ajax({  //Make the Ajax Request
                    type: "POST",  
                    url: "ajax_getchildcombo",
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
        url: "ajax_getchildcombo",
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
	
    removeallselection();
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
                value: <?php if(isset($newchallengeinfo['length_of_challenge'])) { echo $newchallengeinfo['length_of_challenge']; } else { ?>$('#challengelength #chalnglen').val()/90<?php } ?>,
		orientation: "horizontal",
		range: "min",
		slide: function(event, ui) {
		  $( "#challengelength #chalnglen" ).val( ui.value * slider3ValueMultiplier );	
		  $slider3.find(".ui-slider-value:last").html(ui.value * slider3ValueMultiplier + " days");
                  //changeDate();
		},
		stop:function( event, ui ) {
			changeDate();
		}
	  }).addSliderSegments($slider3.slider("option").max);
	}
    
  });
})(jQuery);

$(function() {
	$( "#datepicker-from" ).datepicker({ minDate: 0,onSelect: function( selectedDate ) {
			changeDate();
	  }});
	$( "#datepicker-to" ).datepicker({ minDate: 0, maxDate: "+4D" });
	
	<?php if($newchallengeinfo) { ?>
		$( "#datepicker-from" ).datepicker( "setDate" , new Date(session_start_date) );
		changeDate();
	<?php } ?>
	
	$( "#datepicker-to" ).datepicker( "option", "disabled", true );
});

function changeDate()
{
	var date    =   $("#datepicker-from").datepicker('getDate'); //getting from date picker selected date.
	var days    =   getDays(date)
	$( "#datepicker-to" ).datepicker( "destroy" );
	$( "#datepicker-to" ).datepicker({ minDate: 0, maxDate: days });
	$( "#datepicker-to" ).datepicker( "setDate", days );
	$( "#datepicker-to" ).datepicker('show');
	$( "#datepicker-to" ).datepicker( "option", "disabled", true );
	
	return true;
}

function getDays(date,val)
{
	var val   =   $('#chalnglen').val();
  
	var d = new Date(date);                                 // format that date and get the days of that date.

	var current_day   =   new Date();                       // format current date and get the days of that date.

	var days = d - current_day;                           // days difference between two dates

	var diffS = days / 1000;    

	var diffM = diffS / 60;

	var diffH = diffM / 60;

	var diffD = diffH / 24;

	days = Math.floor(diffD);

	if(days >= 0)
		days    =   (days) + 1;
	else
		days    =   (days * -1) - 1;

	if(val)
		days    =   days +  parseFloat(val) - 1;

	days    =   '+'+days+'D';

	return days;
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
      <li><a href="<?php echo Router::url('/', true); ?>admin/challengeaddstep1">About the challenge</a></li>
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/challengeaddstep2">Categories & Duration</a></li>
      <li><a>Tags & Eligibility</a></li>
	  <li><a>Notifications & Difficulty</a></li>
	  <li><a>Image & Color</a></li>
      <li><a>SAVE</a></li>
    </ul>
</div>
<div class="clear"></div>
<hr/>  
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
  <div class="btn_next"> <a href="javascript:gottochallengestep3();" class="btn btn-primary btn-block">Next<span class="fui-arrow-right pull-right"></span></a> </div>
  <h1>Categories and Lengths of Challenge</h1>
  <h3>How should we classify your Challenge? Who is eligible for it? Let us know!</h3>
  <div class="clear"></div>
  <br/>
  	<input type="hidden" id="baseurl" value="<?php echo Router::url('/', true); ?>" />
    <input type="hidden" id="child_image_name" value="<?php if(isset($newchallengeinfo['chalngparentchildimagename']) && $newchallengeinfo) { echo $newchallengeinfo['chalngparentchildimagename']; } ?>" >
    <input type="hidden" id="parent_image_name" value="<?php if(isset($newchallengeinfo['chalngparentimagename']) && $newchallengeinfo) { echo $newchallengeinfo['chalngparentimagename']; } ?>" >
    <input type="hidden" id="child_category_val" name="child_category_val" value="<?php if(isset($newchallengeinfo['child_category']) && $newchallengeinfo) { echo $newchallengeinfo['child_category']; } else {?>0<?php } ?>" >
    <input type="hidden" name="step" value="3" id="step">
    <input type="hidden" name="controller_action" id="controller_action" value="add" />
<!----Error message div------------------>
  <div class="alert" id="alert_div" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
    <button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
    <span id="message_span"></span>	
  </div>
<!--------------------------------------->
  <!--discrption-->
  <div class="Difficulty_step1" style="width:100%; float:left;">
    <div style="width:100%;">
      <div style="width:65%; float:left;">
        <div style="margin:10px 0 0 0; font-weight:bold; font-size: 18px;">Parent Category:</div>
        <div id="parentcat" style="margin:10px 0;">
          <?php $pccount = count($pcategories);  foreach($pcategories as $pcat) { ?>
          <div style="margin: 5px 0px; padding: 5px; height: 115px;" id="<?php echo $pcat['Category']['id']; ?>" class="<?php if(isset($newchallengeinfo['parent_category']) && $newchallengeinfo && ($pcat['Category']['id'] == $newchallengeinfo['parent_category']) ) { ?>pcatindividualselected <?php } else { ?>pcatindividual<?php } ?>"><a href="Javascript:selectedpcat('<?php echo $pcat['Category']['id']; ?>','<?php echo $pccount; ?>');" style="width:100%;">
		  	<div style="float:left;"><img src="<?php echo Router::url('/', true); ?>img/catuploads/<?php echo $pcat['Category']['decal']; ?>" border="0" width="100" style="background-color:#999999;" /></div>
            <div style="float: left; text-align: left; margin: 38px 0px 0px 10px; height: 25px; width: 300px; color:#999999;"><?php echo str_replace('\"', '', $pcat['Category']['title']); ?></div>
            </a> </div>
<div class="childclass" id="childdiv_<?php echo $pcat['Category']['id']; ?>" style="float: left; text-align: left; margin: -93px 0 0 350px; height: 25px; width: 300px; color:#999999;" >
<?php if(isset($newchallengeinfo['parent_category']) && $newchallengeinfo && ($pcat['Category']['id'] == $newchallengeinfo['parent_category']) ) { 
    echo $child_combo;
?>
Need another child category?<a href="javascript:getChildCategory();">create one now</a>
<?php } ?>
</div>
			<div class="clear"></div>
			<hr/>
			<div class="clear"></div>
          <?php } ?>
          <input type="hidden" value="<?php if(isset($newchallengeinfo['parent_category']) && $newchallengeinfo) { echo $newchallengeinfo['parent_category'];}?>" id="chalngparent">
        </div>
		<br/>
        <div class="discrption_label_right" style="margin-top: -20px;">Need another parent category?<a href="javascript:getParentCategory();" >create one now</a></div>
      
      </div>
	  
	  <div style="float:right; width:30%; margin-left:20px;">
		<div style="border-radius:100px;height:200px;margin:20px 60px 10px; <?php if(isset($newchallengeinfo['chalngparentchildimagename']) && $newchallengeinfo['chalngparentchildimagename']) { ?>background:url('../img/badgedesign/<?php echo $newchallengeinfo['chalngparentchildimagename']; ?>'); <?php } else { ?>background-color:#EEEEEE;<?php } ?>" id="child_image_div"></div>
		
		<div style="position: absolute; background-color:#AAAAAA; border-radius: 100px; width: 150px; height: 150px; margin: -184px 0 0 86px;"></div>
		<div id="parent_image_div" style="position: absolute; margin: -157px 0 0 109px;">
		<?php if(isset($newchallengeinfo['chalngparentimagename'])) { ?>
			<img width="100" src="../img/catuploads/<?php echo $newchallengeinfo['chalngparentimagename']; ?>">
		<?php } ?>
		</div>
		
		<?php if(isset($newchallengeinfo['chalngdifficultyimagename'])) { ?>
		<div id="difficulty_image_div" style="position: absolute; margin: -83px 0 0 175px">
			<img width="33" src="../img/diffuploads/<?php echo $newchallengeinfo['chalngdifficultyimagename']; ?>">    </div>
		<?php } ?>
		<div style="color:#666666; text-align:center;" id="badgename"><?php echo $newchallengeinfo['badge_title']; ?></div>
  </div>
	  
	  
      <?php /*?><div style="float:right; width:30%; margin-left:20px;">
        <div id="child_image_div" style="background-color:#EEEEEE;border-radius:100px;height:200px;margin:20px 60px 10px;<?php if(isset($newchallengeinfo['chalngparentchildimagename']) && $newchallengeinfo) { ?> background:url('../img/badgedesign/<?php echo $newchallengeinfo['chalngparentchildimagename']; ?>');<?php }?>"></div>
		<div style="position: absolute; background-color:#AAAAAA; border-radius: 100px; width: 150px; height: 150px; margin: -184px 0px 0px 85px;"></div>
        <div style="position: absolute; margin: -158px 0 0 110px;" id="parent_image_div" >
            <?php if(isset($newchallengeinfo['chalngparentimagename']) && $newchallengeinfo) { ?><img src="../img/catuploads/<?php echo $newchallengeinfo['chalngparentimagename']; ?>" width="100" /> <?php }?>
        </div>
        <div id="difficulty_image_div" style="position: absolute; margin: -85px 0 0 175px">
            <img width="33" src="../img/diffuploads/<?php if(isset($newchallengeinfo['chalngdifficultyimagename'])) echo $newchallengeinfo['chalngdifficultyimagename']; ?>">
        </div>
        <div style="color:#666666;text-align:center;" id="badgename"><?php echo $newchallengeinfo['badge_title']; ?></div>
      </div><?php */?>
    </div>
    <div class="clear"></div>
	<hr/>
	<div class="clear"></div>
	<div style="margin:10px 0 0 0;font-weight:bold; font-size: 18px;">Length of Challenge:</div>
	<br/>
	<div style="width:80%;float:left;">
		<div id="challengelength" class="ui-slider">
			<input type="hidden" id="chalnglen" value="<?php echo (isset($newchallengeinfo['length_of_challenge']))?$newchallengeinfo['length_of_challenge']:1; ?>" />
			<span class="ui-slider-value first"></span>
			<span class="ui-slider-value last"><?php if(isset($newchallengeinfo['length_of_challenge'])) { echo $newchallengeinfo['length_of_challenge'];?> days<?php } else { ?>1 days<?php } ?></span>
		</div>
	</div>
	<div class="clear"></div>
	<hr/>
	<div class="clear"></div>
	<div style="margin:10px 0 0 0;font-weight:bold; font-size: 18px;">Select Begining and End Dates</div>
	<div style="width:80%;float:left;margin:15px 0;">
                <input type="radio" id="chalngwhosets" name="chalngwhosets" value="0" onclick="$('#datepicker_div').hide();" <?php if(isset($newchallengeinfo['host_set_start_date']) && ( $newchallengeinfo['host_set_start_date'] == 0) ) { ?>checked="checked"<?php }?>/><span style="margin-left:10px;">User shall set the start-date for this challenge</span><br/>
                <input type="radio" id="chalngwhosets" name="chalngwhosets" value="1" onclick="$('#datepicker_div').show();" <?php if(isset($newchallengeinfo['host_set_start_date'])) { if( $newchallengeinfo['host_set_start_date'] == 1) { ?>checked="checked"<?php } } else { ?>checked="checked" <?php } ?> /><span style="margin-left:10px;">Admin shall set the start-date for this challenge</span>
	</div>
	<div style="width:80%;float:left;margin-bottom:25px;<?php if(isset($newchallengeinfo['host_set_start_date']) && ( $newchallengeinfo['host_set_start_date'] == 0) ) { ?>display:none;<?php } ?>" id="datepicker_div"> 
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
		<a href="javascript:gottochallengestep3();" class="btn btn-primary btn-block">Next<span class="fui-arrow-right pull-right"></span></a> 
	</div>
  </div>
  <!---->
  <!--discrption end-->
</div>
<!--right said end-->
<div id="dialog-parent_category" style="display: none;" >
    <?php echo $this->element('categoryparentadd',array('mode'=>'Parent','rootpath'=>'../img/catuploads')); ?>
</div>
<div id="dialog-child_category" style="display: none;" >
    <?php echo $this->element('element_categorychildadd'); ?>
</div>