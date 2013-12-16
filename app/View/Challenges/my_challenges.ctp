<?php echo $session_user_id = $this->Session->read("session_user_id"); ?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<?php if(isset($active_user) && $active_user!=''){ ?>
	<?php $challengesofuser = $user['count_active_challenges']+$waiting['count_waiting_challenges']+$user['count_finished_challenges']+$user['count_failed_challenges']; ?>
	<?php if(isset($challengesofuser) && $challengesofuser!=''){ ?>
	<div id="main">
		<h1>Be Great, Challenge Life.</h1>	
		<div id="status" style="color:#FF0000"></div>
		<div class="acount-block">
		<!-- person profile block -->
		<section class="acount-details">
			<figure class="image-holder">
				<div id="myprofilepic"><a href="http://www.facebook.com/<?php echo $active_user; ?>" target="_blank"><img src='<?php echo $user["user_photo"]; ?>?width=160&height=160'/></a></div>
			</figure>
			<div class="acount-info">
				<div class="row">
					<div class="info">
					  <dl>
							<dt><?php echo $user["user_level"]; ?></dt>
							<dd>Level</dd>
						</dl>
						<dl>
							<dt><?php echo $user["user_points"]; ?></dt>
							<dd>Points Earned</dd>
						</dl>
						<?php 
							if(isset($user))
							{
							$active_challenges_count = count($user["user_active_challenges"]);			
							$finished_challenges_count = count($user["user_finished_challenges"]);
							$failed_challenges_count = count($user["user_failed_challenges"]);			
							$ended_challenges_count = count($user["user_finished_challenges"])+count($user["user_failed_challenges"]);
							$totalchallenges = count($user["user_active_challenges"])+count($user["user_finished_challenges"])+count($user["user_failed_challenges"]);
							if($totalchallenges > 0)
								$finishedrating = (count($user["user_finished_challenges"])/$totalchallenges)*100;  
							else
								$finishedrating = 0;
							}
							if(!empty($waiting))
								$waiting_challenges_count = count($waiting["user_waiting_challenges"]);
							else
								$waiting_challenges_count = 0;
						?>
						<dl>
							<dt><?php echo round($finishedrating,2); ?>%</dt>
							<dd>Finish Rate</dd>
						</dl>
					</div>
					<h2><?php echo $user["user_name"]; ?></h2>
					<p>Member Since <?php echo $user["user_added"]; ?></p>
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
				<li><a href="#tab05" id="tab_active" onclick="tabselection('active');"><span class="notification" id="activechallenges"><?php echo $user['count_active_challenges']; ?></span> Active</a></li>
				<li><a href="#tab06" id="tab_waiting" onclick="tabselection('waiting');"><span class="notification" id="waitingchallenges"><div id="waitingchallengesdiv"><?php echo $waiting['count_waiting_challenges']; ?></div></span> Waiting</a></li>
				<li><a href="#tab07" id="tab_ended" onclick="tabselection('ended');"><span class="notification" id="endedchallenges"><div id="endedchallengesdiv"><?php echo $user['count_finished_challenges']+$user['count_failed_challenges']; ?></div></span> Ended</a></li>
				<li><a href="#tab08" id="tab_award" onclick="tabselection('award');"><span class="notification" id="awardchallenges">0</span> Awards</a></li>
			</ul>
		</nav>
		<div class="tabs-area">
			<!-- Active tab -->
			<div id="tab05" class="tab-content">
			<?php
							
				if($user['count_active_challenges'] == 0)
				{
				?>
					<article class="column">
					<!-- visual -->
						<div class="visual-block">
							No active challenges to list.
						</div>
					</article>
				<?php
				} else {
			 ?>
			 <?php
			for($j=0; $j<$active_challenges_count; $j++)
			{
			?>
			
			<!-- article -->
			<article class="column">
			<!-- visual -->
			<div class="visual-block">
				<img src='https://21dayschallenge.s3.amazonaws.com/background/<?php echo $user["user_active_challenges"][$j]["challenge_image"]; ?>' width="960" height="249" alt="image description" class="bg">
				<figure><img class="alignleft" src='http://21dayschallenge.s3.amazonaws.com/<?php echo $user["user_active_challenges"][$j]["challenge_image"]; ?>' width="324" height="219" alt="image description"></figure>	
						<div class="about">
											<div class="about-holder">
													<div class="person-info">
													   <div class="crop"><a href="http://www.facebook.com/<?php echo $user["user_active_challenges"][$j]["main_host_fbid"]; ?>" target="_blank"><img  src='<?php echo $user["user_active_challenges"][$j]["main_host_photo"].'?type=normal'; ?>' alt="image description"></a></div>					
													<dl>
														<dt><?php echo $user["user_active_challenges"][$j]['main_host_name'] ?></dt>
														<dd>Host</dd>
														<dt>+<?php echo $user["user_active_challenges"][$j]['main_host_participant_count'] ?></dt>
														<dd><a href="#">Participants</a></dd>
													</dl>
											</div>
											<div class="persons-list">
											<ul>
													<?php										
													if(isset($user["user_active_challenges"][$j]['main_host_participants']))
													{ 
														foreach($user["user_active_challenges"][$j]['main_host_participants'] as $participants)
														{
														
													?>										
														<li><a href="http://www.facebook.com/<?php echo $participants['User']['user_fbid'] ?>" target="_blank"><img src="<?php echo $participants['User']['user_profile_picture'].'?type=square'; ?>" alt="image description"></a></li>
												<?php
													 }
												}?>
											</ul>
											</div>										
												</div>
											</div>
											<span class="label <?php echo $life_style_color[$user['user_active_challenges'][$j]['challenge_lifestyle']]; ?> "></span>
											<div class="note-block">
											<?php
											if($user['user_active_challenges'][$j]['ends_in']<= 7)
											{
											?>
												<div class="holder">
													<p>This challenge ends soon - You can do it!</p>
													<a href="#" class="close">close</a>
												</div>
											<?php
											}
											?>
											</div>
										</div>
										<div class="desctiption">
											<div class="days <?=$life_style_color[$user['user_active_challenges'][$j]['challenge_lifestyle']];?>"> <!-- give lifestyle color -->
												<div class="holder">
													<span>DAYS LEFT</span>
													<strong class="number"><?php echo $user["user_active_challenges"][$j]['ends_in']; ?></strong>
												</div>
											</div>
											<ul class="info">
												<li><span class="difficulty <?php echo $difficulty_style[$user["user_active_challenges"][$j]['challenge_difficulty']]; ?>"><?php echo $difficulty[$user["user_active_challenges"][$j]['challenge_difficulty']]; ?> Difficulty</span></li>										   
												<li><span class="points"><?php echo $user["user_active_challenges"][$j]['challenge_points']; ?> Points</span></li>
												<li>In <a onclick="applyFilterAndLoadForm('',<?php echo $user["user_active_challenges"][$j]['category_id']; ?>);" style="cursor:pointer;"><?php echo $user["user_active_challenges"][$j]['challenge_category']; ?></a></li>
											</ul>
											<div class="txt">
												<h2><?php echo $user["user_active_challenges"][$j]['challenge_name']; ?></h2>
												<p><?php echo $user["user_active_challenges"][$j]['challenge_description']; ?></p>
											</div>
										</div>
										<?php 
										$startDate = new DateTime($user["user_active_challenges"][$j]['main_host_started_date']);
										$endDate = new DateTime($user["user_active_challenges"][$j]['main_host_finished_date']);
										?>
										<footer class="calendar">
											<em class="date"><?php  echo  $startDate->format('M'). ' ' .$startDate->format('d') . ' - ' . $endDate->format('M') . ' ' . $endDate->format('d') ?></em>
											<ul>
											<?php
												$currentdate = new DateTime(date('Y-m-d'));
											   for($i=0;$i<21;$i++)
											   {
														 $calDay = date('Y-m-d', strtotime($user["user_active_challenges"][$j]['main_host_started_date'] .' +'.$i.' day'));
														 $calDay = new DateTime($calDay);
														 $class = ($calDay == $currentdate) ? "current" : (($calDay < $currentdate) ? "past" : "");
											?>
											 <li><span class="<?=$class?>"><?php echo $calDay->format('d'); ?></span></li>
											 <?php	   }  ?>
											</ul>
										</footer>
									</article>
									<?php }} ?>
									
			<?php
			//if($active_limit <  $user['count_active_challenges'] )
			$active_remain_count = $user['count_active_challenges'] - $active_challenges_count;
			$active_remain_count = $active_remain_count < $limit_inc  ? $active_remain_count : $limit_inc;
			if($active_remain_count>0) 
			{		  
			?>
				<a class="load-more" onclick="loadmore('active');" style="cursor:pointer;">Load <?php echo $active_remain_count; ?> More</a>
			<?php
			}
			?>
			</div>
			<!-- Waiting tab -->
			<div id="tab06" class="tab-content">
			<!-- article -->
			<?php
				if($waiting_challenges_count == 0)
				{
				?>
					<article class="column">
					<!-- visual -->
						<div class="visual-block">
							No waiting challenges to list.
						</div>
					</article>
				<?php
				} else {
			 ?>
			 <?php
			 
			for($j=0; $j<$waiting_challenges_count; $j++)
			{
				//print_r($waiting["user_waiting_challenges"][$j] );
			?>
			
			<!-- article -->
			<article class="column">
			<!-- visual -->
			<div class="visual-block">
			  <img src="https://21dayschallenge.s3.amazonaws.com/background/<?php echo $waiting["user_waiting_challenges"][$j]["challenge_image"]; ?>" width="960" height="249" alt="image description" class="bg">
			  <figure><img class="alignleft" src="http://21dayschallenge.s3.amazonaws.com/<?php echo $waiting["user_waiting_challenges"][$j]["challenge_image"]; ?>" width="324" height="219" alt="image description"></figure>	
						<div class="about">
											<div class="about-holder">
													<div class="person-info">
													   <div class="crop"><a href="http://www.facebook.com/<?php echo $waiting['user_waiting_challenges'][$j]['main_host_fbid']; ?>" target="_blank"><img src='<?php echo $waiting["user_waiting_challenges"][$j]["main_host_photo"].'?type=normal'; ?>' alt="<?php echo $waiting["user_waiting_challenges"][$j]['main_host_name'] ?>"></a></div>											
													<dl>
														<dt><?php echo $waiting["user_waiting_challenges"][$j]['main_host_name'] ?></dt>
														<dd>Host</dd>
														<dt>+<?php echo $waiting["user_waiting_challenges"][$j]['main_host_participant_count'] ?></dt>
														<dd><a href="#">Participants</a></dd>
													</dl>
											</div>
											<div class="persons-list inner">	
											<ul>
											<?php										
													if(isset($waiting["user_waiting_challenges"][$j]['main_host_participants']))
													{ 
														foreach($waiting["user_waiting_challenges"][$j]['main_host_participants'] as $participants)
														{
														
													?>										
														<li><a href="http://www.facebook.com/<?php echo $participants['User']['user_fbid']; ?>" target="_blank"><img src="<?php echo $participants['User']['user_profile_picture'].'?type=square'; ?>" alt="image description"></a></li>
												<?php
													 }
												}?>
											</ul>
											</div>															
											<div class="join-block">
											  <?php
												if($waiting["user_waiting_challenges"][$j]['user_challenge_status'] == 5)  // request open
												{
												 ?>  
													<h2>Join?</h2>
													<ul>										
													<li><?php echo $this->Js->link('join',array('controller'=>'Challenges','action'=> 'join_challenge/join/'.$waiting["user_waiting_challenges"][$j]['user_challenge_id'].'/'.$waiting_limit), array('update' => '#tab06','htmlAttributes' => array('class'=>'join','em class'=>'mask','evalScripts' => true)));   echo $this->Js->writeBuffer();  ?></li>	
													<li><?php echo $this->Js->link('reject',array('controller'=>'Challenges','action'=> 'join_challenge/unjoin/'.$waiting["user_waiting_challenges"][$j]['user_challenge_id'].'/'.$waiting_limit), array('update' => '#tab06','htmlAttributes' => array('class'=>'reject','em class'=>'mask','evalScripts' => true)));   echo $this->Js->writeBuffer();  ?></li>				
													</ul>
											   <?php												
												 }
												 else if($waiting["user_waiting_challenges"][$j]['user_challenge_hostid'] == 0 || $waiting["user_waiting_challenges"][$j]['main_host_id'] == $waiting['user_id'])
												 {
												 ?>
													<h2>Edit?</h2>
													<ul>										
													<li>
													<a class="edit" onClick="getHostPopup('edit','<?=$waiting["user_waiting_challenges"][$j]['challenge_permalink']?>','my_challenges')" style="cursor:pointer;">edit<em class="mask"></em></a>
													</li>
													</ul>
												 <?php
												 }
												 else if(($waiting["user_waiting_challenges"][$j]['user_challenge_status'] == 6 || $waiting["user_waiting_challenges"][$j]['user_challenge_status'] == 0) && ($waiting["user_waiting_challenges"][$j]['invitees_invite'] == 1) && ($waiting["user_waiting_challenges"][$j]['main_host_id'] != $waiting['user_id'] )) //3conditions to be satisfied. (1.) User in Joined status (2.) Challenge allows friends to invite (3.) Should not be a host.
												 {
											   ?>
													<h2>Invite?</h2>
													<ul>										
													<li>
													<a class="edit" onClick="getHostPopup('invite','<?=$waiting["user_waiting_challenges"][$j]['challenge_permalink']?>','my_challenges')" style="cursor:pointer;">Invite<em class="mask"></em></a>
													</li>
													</ul>
												 
											   <?php } //else { ?>
											   
											  <!-- <h2></h2>
													<ul>										
													<li>
													<a class="edit">Edit<em class="mask"></em></a>
													</li>
													</ul>-->
												 
											   <?php //} ?>										
									</div>
									
									</div>
								</div>
								
								<span class="label <?php echo $life_style_color[$waiting['user_waiting_challenges'][$j]['challenge_lifestyle']]; ?> "></span>
								
								<?php
								//print_r($waiting);
								  if($waiting['user_waiting_challenges'][$j]['user_challenge_status'] == 5 && $waiting['user_waiting_challenges'][$j]['main_host_id'] != $waiting['user_id']  )
								  {
								?>
									<div class="note-block">
										<div class="holder">
											<p>You have a new challenge invitation!</p>
											<a href="#" class="close">close</a>
										</div>
									</div>
							   <?php
								  }
							   ?>
							</div>
							
							
						<div class="desctiption">
							  <div class="days <?=$life_style_color[$waiting['user_waiting_challenges'][$j]['challenge_lifestyle']];?>"> <!-- add lifestyle color -->
										<div class="time-block">
										<span><?php echo $waiting["user_waiting_challenges"][$j]['main_host_starts_in']; ?></span>
										</div>
									</div>
									
									<ul class="info">
												<li><span class="difficulty <?php echo $difficulty_style[$waiting["user_waiting_challenges"][$j]['challenge_difficulty']]; ?>"><?php echo $difficulty[$waiting["user_waiting_challenges"][$j]['challenge_difficulty']]; ?> Difficulty</span></li>										   
												<li><span class="points"><?php echo $waiting["user_waiting_challenges"][$j]['challenge_points']; ?> Points</span></li>
												<li>In <a onclick="applyFilterAndLoadForm('',<?php echo $waiting["user_waiting_challenges"][$j]['category_id']; ?>);" style="cursor:pointer;"><?php echo $waiting["user_waiting_challenges"][$j]['challenge_category']; ?></a></li>
											</ul>
											<div class="txt">
												<h2><?php echo $waiting["user_waiting_challenges"][$j]['challenge_name']; ?></h2>
												<p><?php echo $waiting["user_waiting_challenges"][$j]['challenge_description']; ?></p>
											</div>
										</div>
										<?php  //echo $waiting["user_waiting_challenges"][$j]['main_host_finished_date'];
										$startDate = new DateTime($waiting["user_waiting_challenges"][$j]['main_host_started_date']);
										$endDate = new DateTime($waiting["user_waiting_challenges"][$j]['main_host_finished_date']);
										?>
										<footer class="calendar">
											<em class="date"><?php  echo  $startDate->format('M'). ' ' .$startDate->format('d') . ' - ' . $endDate->format('M') . ' ' . $endDate->format('d') ?></em>
											<ul>
											<?php
												$currentdate = new DateTime(date('Y-m-d'));
											   for($i=0;$i<21;$i++)
											   {
														 $calDay = date('Y-m-d', strtotime($waiting["user_waiting_challenges"][$j]['main_host_started_date'] .' +'.$i.' day'));
														 $calDay = new DateTime($calDay);
														 $class = ($calDay == $currentdate) ? "current" : (($calDay < $currentdate) ? "past" : "");
											?>
											 <li><span class="<?=$class?>"><?php echo $calDay->format('d'); ?></span></li>
											 <?php	   }  ?>
											</ul>
										</footer>
									</article>
									<?php }} ?>
									
			<?php
			$waiting_remain_count = $waiting['count_waiting_challenges'] - $waiting_challenges_count;
			$waiting_remain_count = $waiting_remain_count < $limit_inc  ? $waiting_remain_count : $limit_inc;
			if($waiting_remain_count>0)
			{		  
			?>
				<a class="load-more" onclick="loadmore('waiting');" style="cursor:pointer;">Load <?php echo $waiting_remain_count; ?> More</a>
			<?php
			}
			?>
			</div>
			<!-- Ended tab -->
			<div id="tab07" class="tab-content">
			<div class="two-columns-section">
				<!-- columns -->
				<form name="finishedchallenges" id="finishedchallenges">
				<div class="column-section alignleft ajax-holder">
				<h2>Finished Challenges</h2>
			
			<?php
							
				if($user['count_finished_challenges'] == 0)
				{
				?>
					<article class="column">
					<!-- visual -->
						<div class="visual-block">
							No finished challenges to list.
						</div>
					</article>
				<?php
				} else {
			 ?>
			 <?php
			for($j=0; $j<$finished_challenges_count; $j++)
			{
			?>
			
			<!-- article -->
			<article class="column">
				<div class="desctiption">
					<div class="txt">
					<input type="hidden" name="title<?=$j?>" id="title<?=$j?>" value="<?php echo $user["user_finished_challenges"][$j]['challenge_title']; ?>"  />
					<input type="hidden" name="slug<?=$j?>" id="slug<?=$j?>" value="<?php echo $user["user_finished_challenges"][$j]['challenge_permalink']; ?>"  />
					<input type="hidden" name="image<?=$j?>" id="image<?=$j?>" value="<?php echo $user["user_finished_challenges"][$j]['challenge_image']; ?>"  />
					<input type="hidden" name="desc<?=$j?>" id="desc<?=$j?>" value="<?php echo $user["user_finished_challenges"][$j]['challenge_description']; ?>"  />
						<h2><?php echo $user["user_finished_challenges"][$j]['challenge_title']; ?></h2>
						<p><?php echo $user["user_finished_challenges"][$j]['challenge_description']; ?></p>
					</div>
					<div class="days <?=$life_style_color[$user['user_finished_challenges'][$j]['challenge_lifestyle']];?> borderstyle">						
						<div class="holder">
							<span><?php echo $user["user_finished_challenges"][$j]['challenge_finished_month']; ?></span>
							<strong class="number"><?php echo $user["user_finished_challenges"][$j]['challenge_finished_day']; ?></strong>
						</div>
					</div>
					<span class="points <?=$life_style_color[$user['user_finished_challenges'][$j]['challenge_lifestyle']];?>">Points Earned <strong class="number"><?php echo $user["user_finished_challenges"][$j]['challenge_points']; ?> pts.</strong></span>
					<span class="label <?=$life_style_color[$user['user_finished_challenges'][$j]['challenge_lifestyle']];?>"></span>
					<span class="stamp"></span>
				</div>
				<footer class="share-block">
					<a onClick="getHostPopup('add','<?=$user['user_finished_challenges'][$j]['challenge_permalink']?>','my_challenges')" style="cursor:pointer;" class="again">Go Again</a>
					<span class="share">Share</span>
					<ul class="share-this">
						<li><a href="#" id="facebookhref" onclick="postToFeed('<?php echo $j; ?>'); return false;" class="facebook">facebook</a></li>
						<?php $twittersharelink=$site_url.$user["user_finished_challenges"][$j]['challenge_permalink'];	?>
						<li><a href="https://twitter.com/share?url=<?php echo $twittersharelink; ?>" id="twitterhref" target="blank" class="twitter" data-lang="en">twitter</a></li>
						<li>
						<a data-reveal-id="myModal2" data-animation="fade" style="cursor:pointer;" class="email" onclick="challengedetails('<?=$j?>','<?php echo $user["user_finished_challenges"][$j]['user_notification_email']; ?>')">email</a>
						</li>
					</ul>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
				</footer>
			</article>
			<?php }
			} ?>								
			<?php
			$finished_remain_count = $user['count_finished_challenges'] - $finished_challenges_count;
			$finished_remain_count = $finished_remain_count < $limit_inc  ? $finished_remain_count : $limit_inc;
			if($finished_remain_count>0) {		  
			?>
				<a class="load-more" onclick="loadmoreactivechallenges();" style="cursor:pointer;">Load <?php echo $finished_remain_count; ?> More</a>
			<?php
			}
			?>
				</div>
				</form>
				<div class="column-section">
					<h2>Failed Challenges</h2>
				<?php						
				if($user['count_failed_challenges'] == 0)
				{
				?>
					<article class="column">
					<!-- visual -->
						<div class="visual-block">
							No failed challenges to list.
						</div>
					</article>
				<?php
				} else {
			 ?>
			 <?php
			for($j=0; $j<$failed_challenges_count; $j++)
			{
			?>
			<article class="column failed">
				<div class="desctiption">
					<div class="txt">
						<h2><?php echo $user["user_failed_challenges"][$j]['challenge_title']; ?></h2>
						<p><?php echo $user["user_failed_challenges"][$j]['challenge_description']; ?></p>
					</div>
					<div class="days borderstyle">
						<div class="holder">
							<span><?php  echo $user["user_failed_challenges"][$j]['challenge_cancelled_month']; ?></span>
							<strong class="number"><?php  echo $user["user_failed_challenges"][$j]['challenge_cancelled_day']; ?></strong>
						</div>
					</div>
					<span class="points green">Points Earned <strong class="number"><?php echo $user["user_failed_challenges"][$j]['challenge_points']; ?> pts.</strong></span>
					<span class="label"></span>
				</div>
				<footer class="share-block">
					<a onClick="getHostPopup('add','<?=$user['user_failed_challenges'][$j]['challenge_permalink']?>','my_challenges')" style="cursor:pointer;" class="again">Retry</a>
				</footer>
			</article>
			<?php }} ?>
									
			<?php
			$failed_remain_count = $user['count_failed_challenges'] - $failed_challenges_count;
			$failed_remain_count = $failed_remain_count < $limit_inc  ? $failed_remain_count : $limit_inc;
			if($failed_remain_count>0) 
			{		  
			?>
				<a class="load-more" onclick="loadmoreactivechallenges();" style="cursor:pointer;">Load <?php echo $failed_remain_count; ?> More</a>
			<?php
			}
			?>
			</div>
			  </div>
			  
			</div>
			<!-- Awards tab -->
			<div id="tab08" class="tab-content">
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
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-30.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-31.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-09.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-32.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-48.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-49.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-50.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-51.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-52.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-69.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-70.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-71.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-72.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-63.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-73.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-74.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-75.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-76.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-33.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-34.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-13.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-35.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-53.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-54.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-55.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-56.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-57.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-50.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-77.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-78.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-67.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-65.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-42.jpg"><span class="overlay"></span></a></li>
						<li>
							<a href="#"><img width="50" height="50" alt="image description" src="../img/ico-79.jpg"><span class="overlay"></span></a>
							<div class="tooltip">
								<div class="holder">
									<img src="../img/img-60.jpg" width="100" height="101" alt="image description" class="alignleft">
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
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-64.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-41.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-36.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-37.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-38.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-39.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-58.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-59.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-60.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-61.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-62.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-80.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-81.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-63.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-43.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-40.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-82.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-66.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-83.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-84.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-76.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-75.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-74.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-73.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-63.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-82.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-71.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-70.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-69.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-52.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-51.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-50.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-49.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-48.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-32.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-09.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-31.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-30.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-41.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-64.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-65.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-42.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-66.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-67.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-78.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-77.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-50.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-57.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-56.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-55.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-54.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-53.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-35.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-13.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-34.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-33.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-84.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-83.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-87.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-82.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-64.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-43.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-63.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-81.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-80.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-62.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-61.jpg"><span class="overlay"></span></a></li>
						<li><a href="#"><img width="50" height="50" alt="image description" src="../img/ico-60.jpg"><span class="overlay"></span></a></li>
					</ul>
				</div>
			</section>
			<!-- blocks -->
			<section class="awards-row">
				<header class="heading">
					<h1><img src="../img/ico-88.png" width="32" height="32" alt="image description">Kiip Rewards Unlocked</h1>
				</header>
				<div class="blocks-holder">
					<div class="block">
						<figure class="image-holder">
							<a href="#"><img src="../img/img-56.jpg" width="310" height="170" alt="image description"></a>
							<figcaption>
								<strong class="name">$10 Gift Card to American Apparel</strong>
								<span class="expires">Expires 10/15/2012</span>
							</figcaption>
						</figure>
					</div>
					<div class="block">
						<figure class="image-holder">
							<a href="#"><img src="../img/img-57.jpg" width="310" height="170" alt="image description"></a>
							<figcaption>
								<strong class="name">$10 Gift Card to American Apparel</strong>
								<span class="expires">Expires 10/15/2012</span>
							</figcaption>
						</figure>
					</div>
					<div class="block">
						<figure class="image-holder">
							<a href="#"><img src="../img/img-58.jpg" width="310" height="170" alt="image description"></a>
							<figcaption>
								<strong class="name">$10 Gift Card to American Apparel</strong>
								<span class="expires">Expires 10/15/2012</span>
							</figcaption>
						</figure>
					</div>
					<div class="block">
						<figure class="image-holder">
							<a href="#"><img src="../img/img-59.jpg" width="310" height="170" alt="image description"></a>
							<figcaption>
								<strong class="name">$10 Gift Card to American Apparel</strong>
								<span class="expires">Expires 10/15/2012</span>
							</figcaption>
						</figure>
					</div>
				</div>
			</section>
		</div>		
		</div>
	</div>
	<?php } else { ?>
	<!-- no changes notification -->
	<div class="main-heading-holder">
		<section class="content-block main-heading">
			<a class="btn-start" href="<?php echo Router::url('/challenges', true); ?>"><span>Get Started</span></a>
		<h1><?php echo $empty_my_challenges; ?></h1>
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
<?php } else { ?>
<!-- no changes notification -->
<div class="main-heading-holder">
	<section class="content-block main-heading">
		<a onClick="#" style="cursor:pointer; margin:25px 0 0 0 !important;">
			<div class="text">Log in</div>
			<em class="mask" style="opacity: 0;"></em>
		</a>
		<h1><?php echo $not_logged_in; ?></h1>
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