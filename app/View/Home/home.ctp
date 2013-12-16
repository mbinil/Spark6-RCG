<!-- slideshow -->
<div class="slideshow">
	<div class="slideset">
		<!-- slide -->
		<div class="slide green">
			<section class="description">
				<h1>Inc. It Up</h1>
				<ol class="steps">
					<li>
						<div class="holder">
							<img src="img/discover.png" width="234" alt="image description">
							<span class="caption">Discover</span>
							<span class="number one">1</span>
						</div>
					</li>
					<li>
						<div class="holder">
							<img src="img/invite_firends.png" width="234" alt="image description" style="margin: 27px 0 0;">
							<span class="caption">INVITE FRIENDS</span>
							<span class="number two">2</span>
						</div>
					</li>
					<li>
						<div class="holder">
							<img src="img/be_great.png" width="234" alt="image description">
							<span class="caption">Be Great</span>
							<span class="number three">3</span>
						</div>
					</li>
				</ol>
			</section>
		</div>
		<!-- slide -->
	</div>
</div>
<!-- main content block -->
<div id="main">
	<!-- main heading -->
	<header class="content-block main-heading">
		<a href="<?php echo Router::url('/', true); ?>" class="btn-start"><span>Get Started</span></a>
		<h1>How will you use 21 Days to change your life?</h1>
	</header>
	<!-- content section -->
	<section class="content-block white">
		<ul class="info-list">
			<li>
				<img class="alignleft" src="img/ico-01.png" width="62" height="62" alt="image description">
				<div class="txt">
					<h2><?php //echo $active_user_count; ?>XXX</h2>
					<p>active users</p>
				</div>
			</li>
			<li>
				<img class="alignleft" src="img/ico-02.png" width="62" height="62" alt="image description">
				<div class="txt">
					<h2><?php //echo $challenge_taken_count; ?>XXX</h2>
					<p>challenges taken</p>
				</div>
			</li>
			<li>
				<img class="alignleft" src="img/ico-03.png" width="62" height="62" alt="image description">
				<div class="txt">
					<h2><?php //echo $lifepoints; ?>XXX</h2>
					<p>life points awarded</p>
				</div>
			</li>
		</ul>
		<article class="description">
			<h2>21 Days is built to create change.</h2>
			<p>We all get busy and end up settling into routines. We work, see the same people, do the same things and form habits - be they good or bad. 21 Days is about the time it takes for our brains to adapt to a new routine of medium complexity.</p>
			<p>We umbrella our categories under Health, Wealth and Relationships.</p>
			<p><a href="#">Learn what&rsquo;s possible</a></p>
		</article>
	</section>
	<!-- content section -->
	<section class="content-block">
		<header class="heading">
			<a href="<?php echo Router::url('/', true); ?>" class="more">See All</a>
			<h1>Popular Challenges</h1>
		</header>
		<div class="columns-holder" style="display:none;">
		<?php foreach($challenges as $popularchallengevalues) { 
			if(strlen($popularchallengevalues['challenge_description'])>100)
			{
				$podesp = strip_tags(substr($popularchallengevalues['challenge_description'],0,90))." ...";
			}
			else
			{
				$podesp = strip_tags($popularchallengevalues['challenge_description']);
			}	
		?>
			<div class="slide">
				<div class="column">
					<figure class="image-holder">
						<img src="http://21dayschallenge.s3.amazonaws.com/<?php echo $popularchallengevalues['challenge_image']; ?>" width="230" height="155" alt="image description">
						<span class="label <?php if($popularchallengevalues['challenge_lifestyle']==1) { ?> blue <?php } ?><?php if($popularchallengevalues['challenge_lifestyle']==2) { ?> green <?php } ?><?php if($popularchallengevalues['challenge_lifestyle']==3) { ?> orange<?php } ?>"></span>
					</figure>
					<div class="about">
						<header class="title">												
							<h2><?php echo $this->Html->link($popularchallengevalues['challenge_title'], array('controller'=>'challenges','action' => $popularchallengevalues['challenge_permalink'])); ?></h2>
							<span class="note">In <a onclick="applyFilterAndLoadForm('',<?php echo $popularchallengevalues['challenge_category']; ?>);" style="cursor:pointer;"><?php echo $popularchallengevalues['category_name']; ?></a></span>
						</header>
						<p style="min-height:57px;"><?php echo $podesp; ?></p>
					</div>
					<ul class="meta">
						<li>												
							<?php if($active_user == 0) { ?>
							<?php if(isset($popularchallengevalues['main_host_photo']) && isset($popularchallengevalues['main_host_name']) && $popularchallengevalues['main_host_photo']!='' && $popularchallengevalues['main_host_name'] !='')
							{
								$hpicture = $popularchallengevalues['main_host_photo']; 
								$hname = explode(" ",$popularchallengevalues['main_host_name']); ?>
							<a onClick="FB.login(function(response){});" style="cursor:pointer;"><img src="<?php echo $hpicture; ?>" width="30" height="30" alt="<?php echo $hname[0]; ?>"><?php echo $hname[0]; ?></a>
							<?php } else { ?>
							<a onClick="FB.login(function(response){});" style="cursor:pointer;">Login to Host</a>
							<?php } ?>
							<?php } 
							else 
							{ ?>
							<?php if(isset($popularchallengevalues['main_host_photo']) && isset($popularchallengevalues['main_host_name']) && $popularchallengevalues['main_host_photo']!='' && $popularchallengevalues['main_host_name'] !='')
							{
								$hpicture = $popularchallengevalues['main_host_photo']; 
								$hname = explode(" ",$popularchallengevalues['main_host_name']);?>
								<?php if($popularchallengevalues['host_mode']!='none') { ?>
								<a onclick="PickHostPopup('<?php echo $popularchallengevalues['host_mode']; ?>','<?php echo $popularchallengevalues['challenge_permalink']; ?>','')" data-reveal-id="pickHostModel" data-animation="fade" data-default="#ffffff" data-hover="#fa7000" style="cursor:pointer;"><img src="<?php echo $hpicture; ?>" width="30" height="30" alt="<?php echo $hname[0]; ?>"><?php echo $hname[0]; ?></a>
								<?php } else { ?>
								<a href="" data-reveal-id="CommonWarningMSG" data-animation="fade" style="cursor:pointer;" onclick="CommonWarningMSG('Pick')"><img src="<?php echo $hpicture; ?>" width="30" height="30" alt="<?php echo $hname[0]; ?>"><?php echo $hname[0]; ?></a>
								<?php } ?>
							<?php } else { ?>
							<a onClick="getHostPopup('add','<?=$popularchallengevalues['challenge_permalink']?>','')" style="cursor:pointer;" >Host This!</a>
							<?php } ?>		
							<?php } ?>
						</li>	
						<li>
							<span class="points increase"><?php if(isset($popularchallengevalues['challenge_points'])) { echo $popularchallengevalues['challenge_points']; } ?> Points</span>
						</li>
					</ul>
				</div>
			</div>
		<?php } ?>
		</div>
	</section>
	<!-- content section -->
	<section class="content-block white">
		<div class="heading">
			<a href="#" class="more" style="margin:8px 10px 0 0 !important;">See All Coverage</a>
			<h2>Proudly featured in</h2>
		</div>
		<!-- partners block -->
		<ul class="partners">
			<li><a href="#"><img src="img/logo-fortune.gif" width="144" height="25" alt="image description"></a></li>
			<li><a href="#"><img src="img/logo-wired.gif" width="141" height="30" alt="image description"></a></li>
			<li><a href="#"><img src="img/logo-journal.gif" width="264" height="23" alt="image description"></a></li>
			<li><a href="#"><img src="img/logo-tc.gif" width="59" height="29" alt="image description"></a></li>
			<li><a href="#"><img src="img/logo-fast.gif" width="175" height="27" alt="image description"></a></li>
			<li><a href="#"><img src="img/logo-times.gif" width="211" height="31" alt="image description"></a></li>
			<li><a href="#"><img src="img/logo-time.gif" width="84" height="26" alt="image description"></a></li>
		</ul>
	</section>
</div>