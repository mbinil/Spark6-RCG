<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $this->Html->charset(); ?>
<title><?php echo $title_for_layout; ?></title>
<?php
	echo $this->Html->meta('icon');
	echo $this->Html->script('ckeditor/ckeditor');
	echo $this->Html->script('jquery-1.8.3.min.js');
	echo $this->Html->script('jquery-ui-1.10.3.custom.min.js');
	echo $this->Html->script('bootstrap.min.js');
	echo $this->Html->script('bootstrap-select.js');
	echo $this->Html->script('bootstrap-switch.js');
	echo $this->Html->script('jquery.tagsinput.js');
	echo $this->Html->script('jquery.placeholder.js');
	echo $this->Html->script('application.js');
	echo $this->Html->script('holder.js');
	echo $this->Html->script('google-code-prettify/prettify.js');
	echo $this->Html->script('functions.js');
	echo $this->Html->css('cake.generic');
	echo $this->Html->css('bootstrap');
	echo $this->Html->css('bootstrap-docs');
	echo $this->Html->css('prettify');
	echo $this->Html->css('flat-ui');
	echo $this->Html->css('all');
	if($this->Session->read("username")=='' && $this->action != "index") {
		echo $this->Html->css('reference');
	}
	echo $this->Html->css('newstyles');
			
	/*Data table & pagination*/
	echo $this->Html->css('DT_bootstrap');
	echo $this->Html->script('jquery.dataTables.js');
	echo $this->Html->script('DT_bootstrap.js');
	echo $this->Html->script('pagination.js');
	/*End*/
	
	echo $this->fetch('meta');
	echo $this->fetch('css');
	echo $this->fetch('script');
?>
<script type="text/javascript" src="//use.typekit.net/jgg4bxu.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</head>
<body>
<!--<div id="container">-->
<?php if($this->Session->read("username")!='' || $this->action == "index") { ?>
<header id="header">
  <div class="header-holder">
    <div class="navbar navbar-inverse">
      <div class="navbar-header"><a href="<?php echo Router::url('/admin/', true); ?>" class="navbar-brand"></a></div>
      <div class="navbar-collapse collapse navbar-collapse-03">
        <ul class="nav navbar-nav">
          <li><a href="<?php echo Router::url('/admin/home', true); ?>">Dashboard</a> </li>
          <li><a href="<?php echo Router::url('/', true); ?>" target="_blank">Main Site</a>
            <!--<ul style="padding-left:10px !important;padding-top:22px !important;">
              <li><a href="#">Element One</a></li>
              <li> <a href="#">Sub menu</a>
                <ul>
                  <li><a href="#">Element One</a></li>
                  <li><a href="#">Element Two</a></li>
                  <li><a href="#">Element Three</a></li>
                </ul>
              </li>
              <li><a href="#">Element Three</a></li>
            </ul>-->
          </li>
        </ul>
		<?php if($this->action != "index") { ?>
		<div style="float:right;"> 
			<ul class="nav navbar-nav" style="padding:0px !important;">
			  <li> <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<div style="margin: 0 0 0 5px;float:left;"><?php if($this->Session->read("usericon")!='') { ?><img src="<?php echo Router::url('/', true); ?>img/adminuseruploads/<?php echo $this->Session->read("usericon"); ?>" alt="" class="image_aline" width="44" height="44"/> <?php } ?></div>
				<div style="margin: 9px 0 0 10px;float:left;"><?php echo $this->Session->read("useremail"); ?></div>
				<div style="margin: 16px 0 0 5px;float:left;"><b class="caret"></b></div>
				</a>
				<ul style="margin-left:20px;margin-top:-21px;padding-left:10px !important;padding-top:22px !important;">
				  <li><a href="#">Action</a></li>
				  <li><a href="#">Settings</a></li>
				  <li class="divider"></li>
				  <li><?php echo $this->html->link("Logout",array("action"=>"../admin/logout")); ?></li>
				</ul>
			  </li>
			</ul>
		</div>
		<?php } ?>
	  </div>
    </div>
  </div>
</header>	
<?php } else { ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
/**
 * Calling the parent category dialogue...
 */
function Loginuser()
{
	$( "#dialog-loginuser" ).dialog({
		height: 250,
		width:  390,
		title: "Returning? Sign in!!",
		modal: true
	});
}
</script>
<header id="header">
  <div class="header-holder">
    <div class="navbar navbar-inverse">
      <div class="navbar-header"><a href="<?php echo Router::url('/', true); ?>" class="navbar-brand2"></a></div>
      <div class="navbar-collapse collapse navbar-collapse-03">		
		<ul class="nav navbar-nav">
          	<li><a href="<?php echo Router::url('/discover', true); ?>">Discover</a></li>
			<li><a href="<?php echo Router::url('/', true); ?>">My Challenges</a></li>
		</ul>		
		<!-- search-form -->
		<?php //echo $this->Form->create("Challenge",array('controller'=>'challenges','action'=>'index',"id"=>"searchform","name"=>"searchform",'class'=>'search-form')); ?>
		<span class='search-form'>
                <fieldset>
			<?php if(!isset($searchkey)) { $searchkey = ''; }
			echo $this->Form->input(" ",array("type"=>"text","value"=>$searchkey,"placeholder"=>"Search challenges","id"=>"txtSearch", "name"=>"txtSearch", "onkeyup" => "showChallenge(this,'search',event,'')")); ?>
			<div class="submit"><input type="submit" value="Search"></div>
		</fieldset>
                </span>
		<?php //echo $this->Form->end(); ?>
		<?php if($this->Session->read("session_user_id")=="") { ?>
		<div id="logindiv">
			<div style="float: left; margin: 0px 10px 0px 0px;">
			<a href="<?php echo Router::url('/registration_step1', true); ?>">
			<div class="btn_next" style="width:135px;">
			  <div class="btn btn-primary btn-block">Create Account</div>
			</div>
			</a>
			</div>
			<div style="margin: 0px; font-size: 13px; line-height: normal;">returning?<br /><a style="text-decoration:none;cursor:pointer;" href="javascript:Loginuser();">Sign in</a></div>
		</div>
		<?php } else { ?>
		<!-- login block -->
		<div class="login-block" id="loginblock" style="display:block;">
			<!-- user info -->
			<div class="info">
				<div class="notification">0</div>	
				<div id="profile_pic" class="alignright"><img src="<?php echo Router::url('/img/useruploads/', true); ?><?php echo $activeuserinfo[0]['User']['user_profile_picture']; ?>" border="0" width="50" /></div>					
			</div>
			<!-- dropdown -->
			<div class="dropdown">
				<ul id="drop-menu" class="drop-nav">
					<li><?php echo $this->Html->link('Manage Account',array('controller'=>'users','action'=>'manage_account_step1')); ?></li>
					<li><?php echo $this->Html->link('View Profile',array('controller'=>'users','action'=>'view_profile')); ?></li>
					<li><?php echo $this->Html->link('Logout',array('controller'=>'users','action'=>'logout')); ?></li>
				</ul>
				<?php echo $this->element('slidedown_challenge_list'); ?>
			</div>
		</div>
		<?php } ?>
      </div>
      <!--/.navbar-collapse -->
    </div>
  </div>
</header>
<?php } ?>  
<!--Container start-->
<div class="container" <?php if($this->Session->read("username")!='' && $this->action != "index") { ?>style="width:1080px;padding: 15px 0 0;"<?php } else { ?>style="width:100%;" <?php } ?>>
<?php if($this->Session->read("username")!='' && $this->action != "challengeaddstep1" &&$this->action != "challengeeditstep1" && $this->action != "challengeaddstep2" &&$this->action != "challengeeditstep2" && $this->action != "challengeaddstep3" &&$this->action != "challengeeditstep3" && $this->action != "challengeaddstep4" &&$this->action != "challengeeditstep4" && $this->action != "challengeaddstep5" &&$this->action != "challengeeditstep5" && $this->action !="difficultyaddstep1"&& $this->action !="difficultyaddstep2" && $this->action !="difficultyaddstep3" && $this->action !="difficultyeditstep1"&& $this->action !="difficultyeditstep2"&& $this->action !="difficultyeditstep3"&&$this->action!="categoryparentadd"&&$this->action!="categoryparentedit"&&$this->action!="categorychildadd"&&$this->action!="categorychildedit"&&$this->action!="user_edit"&&$this->action!="adminuser_add"&&$this->action!="adminuser_edit") { ?>
  <div class="sitemap_nav">
    <ul class="breadcrumb">
      <li><a href="<?php echo Router::url('/', true); ?>admin/">Home</a></li>
	  <?php if($this->action == "challenges") { ?>
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/challenges">Challenges</a></li>
      <?php } ?>
      <?php if($this->action == "difficulties") { ?>
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/difficulties">difficulties</a></li>
      <?php } ?>
      <?php if($this->action == "difficultyaddstep1") { ?>
      <li><a href="<?php echo Router::url('/', true); ?>admin/difficulties">Difficulties</a></li>
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/difficultyaddstep1">Add difficulty type - step1</a></li>
      <?php } ?>
      <?php if($this->action == "difficultyaddstep2") { ?>
      <li><a href="<?php echo Router::url('/', true); ?>admin/difficulties">Difficulties</a></li>
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/difficultyaddstep2">Add difficulty type - step2</a></li>
      <?php } ?>
      <?php if($this->action == "difficultyaddstep3") { ?>
      <li><a href="<?php echo Router::url('/', true); ?>admin/difficulties">Difficulties</a></li>
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/difficultyaddstep3">Add difficulty type - step3</a></li>
      <?php } ?>
      <?php if($this->action == "levels") { ?>
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/levels">levels</a></li>
      <?php } ?>
      <?php if($this->action == "categoryparent") { ?>
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/categoryparent">Parent</a></li>
      <?php } ?>
      <?php if($this->action == "categoryparentadd") { ?>
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/categoryparentadd">Create a parent category</a></li>
      <?php } ?>
      <?php if($this->action == "categorychild") { ?>
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/categorychild">Children</a></li>
      <?php } ?>
      <?php if($this->action == "categorychildadd") { ?>
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/categorychildadd">Create a child category</a></li>
      <?php } ?>
	  <?php if($this->action == "users_list") { ?>
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/users_list">Users</a></li>
      <?php } ?>
	  <?php if($this->action == "adminuser_list") { ?>
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/adminuser_list">Admins</a></li>
      <?php } ?>
	  <?php if($this->action == "adminuser_add") { ?>
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/adminuser_add">Create New Site Admin</a></li>
      <?php } ?>
	  <?php if($this->action == "alertlist") { ?>
      <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/alertlist">Alerts</a></li>
      <?php } ?>
    </ul>
  </div>
  <div class="search_fieald_commen">
      <input type="text" class="form-control" placeholder="Search" id="search-query-1" onkeyup="uniformSearch(event,this)"/>
      <input type="hidden" name="common_base_path" id="common_base_path" value="<?php echo Router::url('/admin/', true); ?>"/>
  </div>
  <div class="clear"></div>
  <hr/>
  <?php } ?>
  <!--Left said start-->
  <?php echo $this->fetch('content'); ?>
  <!--Left said end-->
  <!--Right said start-->
  <?php if($this->Session->read("username")!='' && ( $this->action != "challengeaddstep1" &&$this->action != "challengeeditstep1" && $this->action != "challengeaddstep2" &&$this->action != "challengeeditstep2" && $this->action != "challengeaddstep3" &&$this->action != "challengeeditstep3" && $this->action != "challengeaddstep4" &&$this->action != "challengeeditstep4" && $this->action != "challengeaddstep5" &&$this->action != "challengeeditstep5" && $this->action !="difficultyaddstep1"&& $this->action !="difficultyaddstep2" && $this->action !="difficultyaddstep3" && $this->action !="difficultyeditstep1"&& $this->action !="difficultyeditstep2"&& $this->action !="difficultyeditstep3" &&$this->action!="categoryparentadd"&&$this->action!=="categoryparentedit"&&$this->action!="categorychildadd"&&$this->action!="categorychildedit"&& $this->action!="user_edit"&&$this->action!="adminuser_add"&&$this->action!="adminuser_edit") ) { ?>
  <div class="container_right">
    <ul class="nav nav-list">
      <li class="nav-header">GAME MECHANICS</li>
      <li <?php if($this->action == "challenges" || $this->action == "challengeaddstep1" || $this->action == "challengeaddstep2" || $this->action == "challengeaddstep3" || $this->action == "challengeaddstep4" || $this->action == "challengeaddstep5") { ?> class="active" <?php } ?>><a href="<?php echo Router::url('/', true); ?>admin/challenges">Challenges<span class="badge pull-right"><?php echo $ChallengeCount; ?></span></a></li>
      <li <?php if($this->action == "difficulties" || $this->action == "difficultyaddstep1" || $this->action == "difficultyaddstep2" || $this->action == "difficultyaddstep3") { ?> class="active" <?php } ?>><a href="<?php echo Router::url('/', true); ?>admin/difficulties">Difficulties<span class="badge pull-right"><?php echo $difficultyCount; ?></span></a></li>
      <li <?php if($this->action == "levels") { ?> class="active" <?php } ?>><a href="<?php echo Router::url('/', true); ?>admin/levels">Levels<span class="badge pull-right">1</span></a></li>
      <li class="divider"></li>
      <li class="nav-header">CATEGORIES</li>
      <li <?php if($this->action == "categoryparent" || $this->action == "categoryparentadd") { ?> class="active" <?php } ?>><a href="<?php echo Router::url('/', true); ?>admin/categoryparent">Parents<span class="badge pull-right"><?php echo $parentCategoryCount; ?></span></a></li>
      <li <?php if($this->action == "categorychild" || $this->action == "categorychildadd") { ?> class="active" <?php } ?>><a href="<?php echo Router::url('/', true); ?>admin/categorychild">Children<span class="badge pull-right"><?php echo $childCategoryCount; ?></span></a></li>
      <li class="divider"></li>
      <li class="nav-header">PEOPLE</li>
      <li <?php if($this->action == "users_list") { ?> class="active" <?php } ?>><a href="<?php echo Router::url('/', true); ?>admin/users_list">Users<span class="badge pull-right"><?php echo $userCount; ?></span> </a> </li>
      <li <?php if($this->action == "adminuser_list" || $this->action == "adminuser_add") { ?> class="active" <?php } ?>><a href="<?php echo Router::url('/', true); ?>admin/adminuser_list">Admins<span class="badge pull-right"><?php echo $AdminCount; ?></span></a></li>
      <li class="divider"></li>
      <li class="nav-header">GLOBEL SETTINGS</li>
      <li><a href="<?php echo Router::url('/', true); ?>admin/alertlist">Alerts<span class="badge pull-right"><?php echo $AlertCount; ?></span></a></li>
    </ul>
  </div>
  <?php } ?>
  <!--right said end-->
</div>
<!--Container end-->
<?php if($this->Session->read("username")!='') { ?>
<div id="footer">All rights reserved. &copy; 2013</div>
<?php } ?>
<div id="dialog-loginuser" style="display: none;" >
    <?php echo $this->element('loginuser'); ?>
</div>
</body>
</html>
