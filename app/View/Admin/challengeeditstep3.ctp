<?php $newchallengeinfo = $this->Session->read("newchallengeinfo"); //print_r($newchallengeinfo); ?>
<?php /*?><link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/select2/3.3.2/select2.css">
<link rel="stylesheet" type="text/css" href="<?php echo Router::url('../css/autostyle.css',true); ?>">
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/3.3.2/select2.js"></script>
<script type="text/javascript" src="<?php echo Router::url('../js/autoapp.js',true); ?>"></script><?php */?>
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
        <li><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep1/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">About the challenge</a></li>
		<li><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep2/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">Categories & Duration</a></li>
		<li class="active"><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep3/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">Tags & Eligibility</a></li>
		<li><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep4/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">Notifications & Difficulty</a></li>
		<li><a href="<?php echo Router::url('/', true); ?>admin/challengeeditstep5/<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>">Image & Color</a></li>
		<li><a>SAVE</a></li>
    </ul>
</div>
<div class="clear"></div>
<hr/>  
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
  <div class="btn_next"> <a onclick="javascript:just();" href="javascript:challengeeditstep4();" class="btn btn-primary btn-block">Next<span class="fui-arrow-right pull-right"></span></a> </div>
  <h1>Tags & Eligibility</h1>
  <h3>How should we classify your Challenge? Who is eligible for it? Let us know!</h3>
  <div class="clear"></div>
    <!----Error message div------------------>
  <div class="alert" id="alert_div" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
    <button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
    <span id="message_span"></span>	
  </div>
<!--------------------------------------->
  <!--discrption-->
  <input type="hidden" id="challengeid" value="<?php echo $newchallengeinfo[0]['Challenge']['id']; ?>" />
  <div class="Difficulty_step1" style="width:100%; float:left;">
	<div style="width:100%;">
      <div style="width:65%; float:left;">
	  	<div style="margin:10px 0; font-weight:bold; font-size: 18px;">Related Challenge Tags:</div>
        <div id="tagsinput"><input name="tagsinput" class="tagsinput" value="<?php if($newchallengeinfo[0]['Challenge']['tags']!=''){ echo $newchallengeinfo[0]['Challenge']['tags']; } ?>" /><input type="hidden" id="challengetagWord" name="challengetagWord" value="<?php if($newchallengeinfo[0]['Challenge']['tags']!=''){ echo $newchallengeinfo[0]['Challenge']['tags']; } ?>" /></div>
		<!--<div class="multisel editors">
		  <div class="xfvvx"></div>
		</div>-->
      </div>         
<div style="float:right; width:30%; margin-left:20px;">
    <div style="background-color:#EEEEEE;border-radius:100px;height:200px;margin:20px 60px 10px; background:url('../../img/badgedesign/<?php if(isset($newchallengeinfo[0]['Challenge']['chalngparentchildimagename'])) echo $newchallengeinfo[0]['Challenge']['chalngparentchildimagename']; ?>');" id="child_image_div"></div>;
    <div id="badge_color_image_div" style="position: absolute; <?php if(isset($newchallengeinfo[0]['Challenge']['chalngbadgecolorimagename'])) { ?>background:url('../../img/badgecolor/<?php echo $newchallengeinfo[0]['Challenge']['chalngbadgecolorimagename']; ?>');<?php } else { ?>background-color:#AAAAAA; <?php } ?>border-radius: 100px; width: 150px; height: 150px; margin: -206px 0 0 86px;">
    </div>
    <div id="parent_image_div" style="position: absolute; margin: -181px 0 0 109px;">
        <img width="100" src="../../img/catuploads/<?php if(isset($newchallengeinfo[0]['Challenge']['chalngparentimagename'])) echo $newchallengeinfo[0]['Challenge']['chalngparentimagename']; ?>">
    </div>
    <div id="difficulty_image_div" style="position: absolute; margin: -107px 0 0 175px">
        <img width="33" src="../../img/diffuploads/<?php if(isset($newchallengeinfo[0]['Challenge']['chalngdifficultyimagename'])) echo $newchallengeinfo[0]['Challenge']['chalngdifficultyimagename']; ?>">
    </div>
    <div style="color:#666666; text-align:center;" id="badgename"><?php if(isset($newchallengeinfo[0]['Challenge']['badge_title']) && $newchallengeinfo[0]['Challenge']['badge_title']!="") { echo $newchallengeinfo[0]['Challenge']['badge_title']; } else { ?>Badge title<?php  } ?></div>
</div>
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
		<a onclick="javascript:just();" href="javascript:challengeeditstep4();" class="btn btn-primary btn-block">Next<span class="fui-arrow-right pull-right"></span></a> 
	</div>
  </div>
  
  <!---->
  <!--discrption end-->
</div>
<!--right said end-->