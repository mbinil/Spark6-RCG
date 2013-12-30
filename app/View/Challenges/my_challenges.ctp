<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<?php if($this->Session->read("session_user_id") !=''){ ?>
<style>
.acount-block .acount-info .row .info {
    float: right;
    width: 65%;
}
.acount-block .acount-info .row dl {
    float: left;
    font-size: 14px;
    line-height: 16px;
    margin: 0;
    text-align: center;
    width: 33%;
}
dl dd:nth-child(4n+2), dl dt:nth-child(4n+1) {
    background: none repeat scroll 0 0 #FFFFFF;
    width: 100%;
}
.acount-details .image-holder {
    margin: 0 10px 0 0;
}
.acount-block .acount-info {
    font-size: 14px;
    overflow: hidden;
    padding: 0;
}
.row {
    margin-left: 20px;
    margin-right: -15px;
}
.awards-list {
    margin: 0 -5px 0 -25px;
    overflow: hidden;
    padding: 23px 0 0;
}
.tabs-inner a {
    padding: 21px 78px 20px;
}
.tab-content .column {
    min-height: inherit;
    overflow: visible;
}
.column .desctiption .days {
    width: 145px;
}
.column .desctiption .points {
    padding: 30px;
	width:55%;
}
.two-columns-section .column-section.alignleft {
    padding: 15px;
}
.column .about {
    width: 562px;
}
.persons-list {
    width: 438px;
}
</style>
<script>
function tabselection(tab)
{
	 var tab_id = "#tab"+tab;
	 $('#tab05').hide();
	 $('#tab06').hide();
	 $('#tab07').hide();
	 $('#tab08').hide();
	 $(tab_id).show();
}
</script>
	<div id="main">
		<h1>Be Great, Challenge Life.</h1>	
		<div id="status" style="color:#FF0000"></div>
		<div class="acount-block">
		<!-- person profile block -->
		<section class="acount-details">
			<figure class="image-holder">
				<div id="myprofilepic"><a href="#" target="_blank"><img src="<?php echo Router::url('/img/useruploads/', true) . $Loggeduserinfo[0]['User']['user_profile_picture']; ?>" border="0" width="160" /></a></div>
			</figure>
			<div class="acount-info">
				<div class="row">
					<div class="info">
					  <dl>
							<dt><?php echo $Loggeduserinfo[0]['User']['user_level']; ?></dt>
							<dd>Level</dd>
						</dl>
						<dl>
							<dt><?php echo $Loggeduserinfo[0]['User']['user_points']; ?></dt>
							<dd>Points Earned</dd>
						</dl>
						
						<dl>
							<dt>0%</dt>
							<dd>Finish Rate</dd>
						</dl>
					</div>
					<h2><?php echo $Loggeduserinfo[0]['User']['user_firstname']." ".$Loggeduserinfo[0]['User']['user_lastname']; ?></h2>
					<p>Member Since <?php echo  date("Y-m-d", strtotime($Loggeduserinfo[0]['User']['user_added'])); ?></p>
				</div>
				<!-- badges list -->
				<ul class="awards-list">
					<li><a href="#" class="award-01 health easy"><em class="mask"></em></a></li>
					<li><a href="#" class="award-02 wealth medium"><em class="mask"></em></a></li>
					<li><a href="#" class="award-03 wealth easy"><em class="mask"></em></a></li>
					<li><a href="#" class="award-04 health easy"><em class="mask"></em></a></li>
					<li><a href="#" class="award-05 relationships difficult"><em class="mask"></em></a></li>
					<li><a href="#" class="all"><strong class="number">14</strong>Awards</a></li>
				</ul>
			</div>
		</section>
		</div>
		<!--  navigation -->
		<nav class="tabset-holder">
			<ul id="tabs" class="tabs-inner">
				<li><a href="#tab05" id="tab_active" onclick="tabselection('05');"><span class="notification" id="activechallenges">0</span> Active</a></li>
				<li><a href="#tab06" id="tab_waiting" onclick="tabselection('06');"><span class="notification" id="waitingchallenges"><div id="waitingchallengesdiv">0</div></span> Waiting</a></li>
				<li><a href="#tab07" id="tab_ended" onclick="tabselection('07');"><span class="notification" id="endedchallenges"><div id="endedchallengesdiv">0</div></span> Ended</a></li>
				<li><a href="#tab08" id="tab_award" onclick="tabselection('08');"><span class="notification" id="awardchallenges">0</span> Awards</a></li>
			</ul>
		</nav>
		<div class="tabs-area">
			<!-- Active tab -->
			<div id="tab05" class="tab-content" style="display:none;">
				<?php echo $active_challenges;?>
			</div>
			<!-- Waiting tab -->
			<div id="tab06" class="tab-content" style="display:block;">
				<?php echo $inactive_challenges;?>
			</div>
			<!-- Ended tab -->
			<div id="tab07" class="tab-content" style="display:none;">
				<?php echo $ended_challenges;?>
			</div>
			<!-- Awards tab -->
			<div id="tab08" class="tab-content" style="display:none;">
			<section class="awards-row">
				<header class="heading">
					<a href="#" class="btn-login">Add as Tab</a>
					<h1>2,314 Total Points Earned</h1>
				</header>
				<!-- points info -->
				<div class="points-info">
					<div class="points-block health alignleft">
						<div class="holder">
							<div class="frame">
								<strong class="number">2,002</strong>
								<p>Health</p>
							</div>
						</div>
					</div>
					<div class="points-block wealth">
						<div class="holder">
							<div class="frame">
								<strong class="number">295</strong>
								<p>Wealth</p>
							</div>
						</div>
					</div>
					<div class="points-block relationships alignright">
						<div class="holder">
							<div class="frame">
								<strong class="number">17</strong>
								<p>Relationships</p>
							</div>
						</div>
					</div>
				</div>
				<span class="tip"><strong>Tip:</strong> Try some challenges in <a href="#">Wealth</a> &amp; <a href="#">Relationships</a></span>
			</section>
			<!-- badges list -->
			<section class="awards-row">
				<header class="heading">
					<h1>14 Badges Earned</h1>
				</header>
				<ul class="awards-list">
					<li><a class="award-01 health easy" href="#"></a>
						<div class="tooltip">
							<div class="holder">
								<p>Best Friend Is Your Pet</p>
							</div>
						</div>
					</li>
					<li><a class="award-02 wealth medium" href="#"></a>
						<div class="tooltip">
							<div class="holder">
								<p>Best Friend Is Your Pet</p>
							</div>
						</div>
					</li>
					<li><a class="award-03 wealth easy" href="#"></a>
						<div class="tooltip">
							<div class="holder">
								<p>Best Friend Is Your Pet</p>
							</div>
						</div>
					</li>
					<li><a class="award-04 health easy" href="#"></a>
						<div class="tooltip">
							<div class="holder">
								<p>Best Friend Is Your Pet</p>
							</div>
						</div>
					</li>
					<li><a class="award-05 relationships difficult" href="#"></a>
						<div class="tooltip">
							<div class="holder">
								<p>Best Friend Is Your Pet</p>
							</div>
						</div>
					</li>
					<li><a class="award-06 relationships difficult" href="#"></a>
						<div class="tooltip">
							<div class="holder">
								<p>Best Friend Is Your Pet</p>
							</div>
						</div>
					</li>
					<li><a class="award-07 health easy" href="#"></a>
						<div class="tooltip">
							<div class="holder">
								<p>Best Friend Is Your Pet</p>
							</div>
						</div>
					</li>
					<li><a class="award-08 wealth easy" href="#"></a>
						<div class="tooltip">
							<div class="holder">
								<p>Best Friend Is Your Pet</p>
							</div>
						</div>
					</li>
					<li><a class="award-09 wealth medium" href="#"></a>
						<div class="tooltip">
							<div class="holder">
								<p>Best Friend Is Your Pet</p>
							</div>
						</div>
					</li>
					<li><a class="award-10 wealth medium" href="#"></a>
						<div class="tooltip">
							<div class="holder">
								<p>Best Friend Is Your Pet</p>
							</div>
						</div>
					</li>
					<li><a class="award-11 relationships difficult" href="#"></a>
						<div class="tooltip">
							<div class="holder">
								<p>Best Friend Is Your Pet</p>
							</div>
						</div>
					</li>
					<li><a class="award-05 relationships difficult" href="#"></a>
						<div class="tooltip">
							<div class="holder">
								<p>Best Friend Is Your Pet</p>
							</div>
						</div>
					</li>
					<li><a class="award-04 health easy" href="#"></a>
						<div class="tooltip">
							<div class="holder">
								<p>Best Friend Is Your Pet</p>
							</div>
						</div>
					</li>
					<li><a class="award-06 relationships difficult" href="#"></a>
						<div class="tooltip">
							<div class="holder">
								<p>Best Friend Is Your Pet</p>
							</div>
						</div>
					</li>
				</ul>
			</section>
			<section class="awards-row">
				<header class="heading">
					<h1>102 Lives Touched</h1>
				</header>
				<div class="persons-list">
					<ul>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-30.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-31.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-09.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-32.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-48.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-49.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-50.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-51.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-52.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-69.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-70.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-71.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-72.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-63.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-73.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-74.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-75.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-76.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-33.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-34.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-13.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-35.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-53.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-54.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-55.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-56.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-57.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-50.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-77.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-78.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-67.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-65.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-42.jpg"><span class="overlay"></span></a></li>
						<li>
							<a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-79.jpg"><span class="overlay"></span></a>
							<div class="tooltip">
								<div class="holder">
									<img src="<?php echo Router::url('/', true); ?>images/img-60.jpg" width="100" height="101" alt="image description" class="alignleft">
									<div class="description">
										<strong class="name">Lauren</strong>
										<p>9</p>
										<dl>
											<dt>Points:</dt>
											<dd>1,300</dd>
											<dt>Finish Rate:</dt>
											<dd>97%</dd>
											<dt>Awards:</dt>
											<dd>12</dd>
										</dl>
									</div>
								</div>
							</div>
						</li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-64.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-41.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-36.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-37.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-38.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-39.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-58.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-59.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-60.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-61.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-62.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-80.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-81.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-63.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-43.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-40.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-82.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-66.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-83.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-84.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-76.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-75.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-74.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-73.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-63.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-82.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-71.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-70.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-69.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-52.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-51.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-50.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-49.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-48.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-32.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-09.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-31.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-30.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-41.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-64.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-65.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-42.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-66.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-67.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-78.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-77.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-50.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-57.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-56.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-55.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-54.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-53.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-35.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-13.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-34.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-33.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-84.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-83.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-87.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-82.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-64.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-43.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-63.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-81.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-80.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-62.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-61.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="<?php echo Router::url('/', true); ?>images/ico-60.jpg"><span class="overlay"></span></a></li>
					</ul>
				</div>
			</section>
			</div>		
		</div>
	</div>
<?php } else { ?>
<!-- no changes notification -->
<div class="main-heading-holder">
	<section class="content-block main-heading">
		<a href="javascript:Loginuser();" style="cursor:pointer; margin:25px 0 0 0 !important;">
			<div class="text">Log in</div>
			<em class="mask" style="opacity: 0;"></em>
		</a>
		<h1>You Don&rsquo;t Have Any Challenges!</h1>
	</section>
</div>
<!-- placeholder -->
<div class="page-placeholder">
	<div class="holder">
		<img src="images/placeholder-02.jpg" alt="image description">
	</div>
	<span class="overlay"></span>
</div>
<?php } ?>