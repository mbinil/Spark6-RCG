<style>
.column .meta li {
    width: 112px;
}
.points {
    width: 83%;
}
.container h2 {
    margin: 0 0 5px;
	line-height: 1.25;
}
#content .cycle-gallery .columns-holder .column, .columns-holder .column {
    min-height: 432px;
}
.columns-holder .column .about {
    padding: 0 10px 5px 13px;
}
.arrow-up {
    height: 65px;
    position: absolute;
    width: 65px;
    z-index: 3;
	transform: rotate(45deg);
	-ms-transform: rotate(45deg); /* IE 9 */
	-webkit-transform: rotate(45deg); /* Safari and Chrome */
	margin: -33px 0px 0px -33px;
}
</style>
</style>
<!-- slideshow -->
<div class="slideshow"><input type="hidden" id="baseurl" value="<?php echo Router::url('/', true); ?>" />
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
		<a href="<?php echo Router::url('/discover', true); ?>" class="btn-start"><span>Get Started</span></a>
		<h1>How will you use 21 Days to change your life?</h1>
	</header>
	<!-- content section -->
	<section class="content-block white">
		<ul class="info-list">
			<li>
				<img class="alignleft" src="img/ico-01.png" width="62" height="62" alt="image description">
				<div class="txt">
					<h2><?php echo $active_user_count?count($active_user_count):0; ?></h2>
					<p>active users</p>
				</div>
			</li>
			<li>
				<img class="alignleft" src="img/ico-02.png" width="62" height="62" alt="image description">
				<div class="txt">
					<h2><?php echo $challenge_taken_count?count($challenge_taken_count):0; ?></h2>
					<p>challenges taken</p>
				</div>
			</li>
			<li>
				<img class="alignleft" src="img/ico-03.png" width="62" height="62" alt="image description">
				<div class="txt">
					<h2><?php //echo $lifepoints; ?>0</h2>
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
			<a href="<?php echo Router::url('/discover', true); ?>" class="more">See All</a>
			<h1>Popular Challenges</h1>
		</header>
		<div class="columns-holder" >
             <?php echo $popular_challenge; ?>
		</div>
	</section>
	<!-- content section -->
	<section class="content-block white" style="display:none;">
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