<?php $newchallengeinfo = $this->Session->read("newchallengeinfo"); //print_r($newchallengeinfo); ?>
<?php /*?><link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/select2/3.3.2/select2.css">
<link rel="stylesheet" type="text/css" href="<?php echo Router::url('../css/autostyle.css',true); ?>">
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/3.3.2/select2.js"></script>
<script type="text/javascript" src="<?php echo Router::url('../js/autoapp.js',true); ?>"></script><?php */?>
<?php
//echo $this->Html->css('jquery_ui');
//echo $this->Html->script('jquery_ui');
?>
<script type="text/javascript">
function just() {
	document.getElementById("challengetagWord").value = $("#tagsinput .tagsinput").val();
}
</script>
<style>
.select.select-block {
    width: 245px !important;
}
.select.select-block .btn {
    width: 245px !important;
}
.open > .dropdown-menu {
    width: 245px !important;
}
.tagsinput input {
	width:auto !important;
}
.tagsinput .tag:hover {
	background-color: #EBEDEF !important;
	color:#7B8996;
}
.tagsinput-add:hover {
	background-color: #EBEDEF !important;
	color:#7B8996;
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
<!--Right said start-->
<div class="sitemap_nav" style="width:100%;">
    <ul class="nav nav-pills">
      <li><a href="<?php echo Router::url('/', true); ?>admin/challengeaddstep1">About the challenge</a></li>
      <li><a href="<?php echo Router::url('/', true); ?>admin/challengeaddstep2">Categories & Duration</a></li>
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/challengeaddstep3">Tags & Eligibility</a></li>
	  <li><a>Notifications & Difficulty</a></li>
	  <li><a>Image & Color</a></li>
      <li><a>SAVE</a></li>
    </ul>
</div>
<div class="clear"></div>
<hr/>  
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
  <div class="btn_next"> <a onclick="javascript:just();" href="javascript:gottochallengestep4();" class="btn btn-primary btn-block">Next<span class="fui-arrow-right pull-right"></span></a> </div>
  <h1>Tags & Eligibility</h1>
  <h3>How should we classify your Challenge? Who is eligible for it? Let us know!</h3>
  <div class="clear"></div>
  <input type="hidden" name="step" value="4" id="step">
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
	  	<div style="margin:10px 0; font-weight:bold; font-size: 18px;">Related Challenge Tags:</div>
        <div id="tagsinput">
            <input name="tagsinput" class="tagsinput" value="<?php if(isset($newchallengeinfo['tags'])) { echo $newchallengeinfo['tags'];} else {?>School,Teacher,Colleague<?php } ?>" />
            <input type="hidden" id="challengetagWord" name="challengetagWord" value="" />
        </div>
      </div>

      <div style="float:right; width:30%; margin-left:20px;">
		<div style="border-radius:100px;height:200px;margin:20px 60px 10px; <?php if(isset($newchallengeinfo['chalngparentchildimagename'])) { ?>background:url('../img/badgedesign/<?php echo $newchallengeinfo['chalngparentchildimagename']; ?>'); <?php } else { ?>background-color:#EEEEEE;<?php } ?>" id="child_image_div"></div>
		
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
    <div style="background-color:#EEEEEE;border-radius:100px;height:200px;margin:20px 60px 10px; background:url('../img/badgedesign/<?php if(isset($newchallengeinfo['chalngparentchildimagename'])) echo $newchallengeinfo['chalngparentchildimagename']; ?>');" id="child_image_div"></div>;
            <div style="position: absolute; background-color:#AAAAAA; border-radius: 100px; width: 150px; height: 150px; margin: -206px 0 0 84px;"></div>
    <div id="parent_image_div" style="position: absolute; margin: -181px 0 0 109px;">
        <img width="100" src="../img/catuploads/<?php if(isset($newchallengeinfo['chalngparentimagename'])) echo $newchallengeinfo['chalngparentimagename']; ?>">         </div>
    <div id="difficulty_image_div" style="position: absolute; margin: -107px 0 0 175px">
        <img width="33" src="../img/diffuploads/<?php if(isset($newchallengeinfo['chalngdifficultyimagename'])) echo $newchallengeinfo['chalngdifficultyimagename']; ?>">         </div>
    <div style="color:#666666; text-align:center;" id="badgename"><?php if(isset($newchallengeinfo['badge_title']) && $newchallengeinfo['badge_title']!="") { echo $newchallengeinfo['badge_title']; } else { ?>Badge title<?php  } ?></div>
  </div><?php */?>
            
            
    </div>
	<div class="clear"></div>
	<hr/>
	<div class="clear"></div>
	<div style="margin:10px 0; font-weight:bold; font-size: 18px;">Change Eligibility:</div>
	<div style="width:100%;">
        <div style="margin: 0px 0px 15px; float: left;">
			<div style="margin:0 0 5px 0;float:left;">
			<select name="info" class="select-block" id="role">
				<option value="">all classes</option>
				<option value="0">0</option>
				<option value="1">1</option>
			</select>
			</div>
			<div style="margin:0 0 5px 25px;float:left;">
			<select name="info" class="select-block" id="role">
				<option value="">all interns and RCGs</option>
				<option value="0">0</option>
				<option value="1">1</option>
			</select>
			</div>
			<div style="margin:0 0 5px 25px;float:left;">
			<select name="info" class="select-block" id="role">
				<option value="">all cohort tags</option>
				<option value="0">0</option>
				<option value="1">1</option>
			</select>
			</div>
			<div style="margin:0 0 5px 25px;float:left;">
			<select name="info" class="select-block" id="role">
				<option value="">all graduate years</option>
				<option value="0">0</option>
				<option value="1">1</option>
			</select>
			</div>
		</div>
		<div style="margin: 0px 0px 15px; float: left;">
			<div style="margin:0;float:left;">
			<select name="info" class="select-block" id="role">
				<option value="">all business units</option>
				<option value="0">0</option>
				<option value="1">1</option>
			</select>
			</div>
			<div style="margin:0 0 0 25px;float:left;">
			<select name="info" class="select-block" id="role">
				<option value="">all grad levels</option>
				<option value="0">0</option>
				<option value="1">1</option>
			</select>
			</div>
			<div style="margin:0 0 0 25px;float:left;">
			<select name="info" class="select-block" id="role">
				<option value="">all schools</option>
				<option value="0">0</option>
				<option value="1">1</option>
			</select>
			</div>
			<div style="margin:0 0 0 25px;float:left;">
			<select name="info" class="select-block" id="role">
				<option value="">all locations</option>
				<option value="0">0</option>
				<option value="1">1</option>
			</select>
			</div>
		</div>
    </div>
	<div class="clear"></div>
	<hr/>
	<div class="clear"></div>
    <div class="btn_next" style="margin:25px 0; float:left;"> 
		<a onclick="javascript:just();" href="javascript:gottochallengestep4();" class="btn btn-primary btn-block">Next<span class="fui-arrow-right pull-right"></span></a> 
	</div>
  </div>
  
  <!---->
  <!--discrption end-->
</div>
<!--right said end-->