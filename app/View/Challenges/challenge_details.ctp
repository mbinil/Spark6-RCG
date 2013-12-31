<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<style>
#ui-id-1
{
	z-index: 1000;	
}
</style>
<?php
$fullurl = Router::url('/', true);
//echo "<pre>";print_r($challenge_info);echo "</pre>";
if(isset($hostsavemessage) && $hostsavemessage!='')
{ 
	echo "<script>alert('".$hostsavemessage."');</script>";
}
if(isset($email_status) && $email_status!="")
{ 
	echo "<script>alert('".$email_status."');</script>";
}

?>
<script>
$(document).ready(function(){
    $(".social-networks ul li").mouseover(
            function() {
                    $(this).addClass("active");
            }
    );
    $(".social-networks ul li").mouseout(
            function() {
                    $(this).removeClass("active");
            }
    );
});
function applyFilterAndLoadForm(lifestyle,category)
{	
	if(lifestyle!="")
		document.getElementById("lifestyle").value = lifestyle;
	if(category!="")
		document.getElementById("category").value = category;
	//alert(document.getElementById("category").value);
	document.menuform.submit();
}
function updateemailstat()  
{
	$("#share").val("share_email");
	document.sharechallengeemail.submit();
}

function showAHost(challenge_id)
{
    var baseurl = $('#baseurl').val();
    $.ajax({
            type: "POST",  
            url: baseurl+'challenges/ajax_show_a_host',
            data: "challenge_id="+challenge_id,
            async:false,
            success: function(response) {
                var data    =   new Array();
                data        =   response.split('#@#');
                if(data[0] == 1)
                {
                    $( "#dialog_host_this" ).html(data[1]);
                    $( "#dialog_host_this" ).dialog({
                        height: 840,
                        width:  1025,
                        title:'Pick Host',
                        modal: true
                    });
                }
            } 
    });
}
</script>
<div class="visual">
	<img alt="image description" src="<?php echo Router::url('/img/challengeuploads/background/', true) . $challenge_info[0]['Challenge']['hero_image']; ?>">
</div>
<div id="main"><input type="hidden" id="baseurl" value="<?php echo Router::url('/', true); ?>" />
	<!-- two columns block -->
	<div id="two-columns">
		<!-- content -->
		<section id="content" class="main-column alignleft" style="width: 710px !important;">
			<!-- details -->
			<div class="details-block">				
				<!-- heading -->
				<header class="title">
				 	<h1><?php echo $challenge_info[0]['Challenge']['name']; ?></h1>			
					<span class="label <?php if($challenge_info[0]['Challenge']['parent_category']=="1") { ?> blue <?php } ?><?php if($challenge_info[0]['Challenge']['parent_category']=="2"){ ?> green <?php } ?><?php if($challenge_info[0]['Challenge']['parent_category']=="3"){ ?> orange<?php } else { ?> blue <?php } ?>"></span>
				</header>
				<!-- visual -->
				<figure class="image-holder">
					<img src="<?php echo Router::url('/img/challengeuploads/', true) . $challenge_info[0]['Challenge']['hero_image']; ?>" width="710" height="480" alt="image description">
					<figcaption class="txt">
						<span class="note">In <a onclick="#" style="cursor:pointer;"><?php echo $challenge_info[0]['category']['title']; ?> Lifestyle</a></span>
						<p><?php echo $challenge_info[0]['Challenge']['daily_commitment']; ?></p>
					</figcaption>
				</figure>
				<!-- description -->
				<article class="about">
					<section class="section">
						<h2>Daily Commitment</h2>
						<p><?php echo $challenge_info[0]['Challenge']['daily_commitment']; ?></p>
					</section>
					<section class="section">
						<h2>Why?</h2>
						<p><?php echo $challenge_info[0]['Challenge']['why']; ?></p>
					</section>
					<section class="section">
						<h2>How?</h2>
						<p><?php echo $challenge_info[0]['Challenge']['how']; ?></p>
					</section>
					<section class="section">
						<h2>Helpful Links</h2>
						<?php echo $challenge_info[0]['Challenge']['learn_more']; ?>
					</section>
				</article>
				<!-- gallery -->
				<div class="gallery-block">
					<h2>Related Challenges</h2>
					<div class="carousel">
						<a class="btn-prev" href="#">Previous</a>
						<div class="mask">
						  <div class="gholder">
						  	<div class="slideset columns-holder" style="display:none;">
								<?php foreach($challenge_info[0]['Challenge']["related_challenges"] as $relatedchallengevalues) { ?>
									<div class="slide">
										<div class="column">
											<figure class="image-holder">
												<img src="http://21dayschallenge.s3.amazonaws.com/<?php echo $relatedchallengevalues['Challenge']['challenge_image']; ?>" width="230" height="155" alt="image description">
												<span class="label <?php if($relatedchallengevalues['Challenge']['challenge_lifestyle']==1) { ?> blue <?php } ?><?php if($relatedchallengevalues['Challenge']['challenge_lifestyle']==2) { ?> green <?php } ?><?php if($relatedchallengevalues['Challenge']['challenge_lifestyle']==3) { ?> orange<?php } ?>"></span>
											</figure>
											<div class="about">
												<header class="title">												
													<h2><?php 	echo $this->Html->link($relatedchallengevalues['Challenge']['challenge_title'], array('action' => $relatedchallengevalues['Challenge']['challenge_permalink'])); ?></h2>
												</header>
											</div>
											<ul class="meta">
											<?php
											$i=0;
											if(!empty($relatedchallengevalues['User_challenge']))
											{ 
												foreach($relatedchallengevalues['User_challenge'] as $relateduserchallengevalues) 
												{ 
													if($i==0)
													{ 
														$i=1; ?>
												<li>
												<?php if(isset($relateduserchallengevalues['User']['0']['id'])&&$relateduserchallengevalues['User']['0']['id'] != '') { ?>
													<a href="#"><img src="<?php if(isset($relateduserchallengevalues['User']['0']['user_profile_picture'])) { echo $relateduserchallengevalues['User']['0']['user_profile_picture']; } ?>" width="30" height="30" alt="image description"><?php if(isset($relateduserchallengevalues['User']['0']['user_username'])) { echo $relateduserchallengevalues['User']['0']['user_username']; } ?></a><?php } else { ?><?php } ?>
												</li>
												 <?php } } 
												}
												else
												{  ?>
												<li>												
													<?php if($active_user == 0) { ?>
													<?php if(isset($relatedchallengevalues['main_host']['0']['User']['user_profile_picture']) && isset($relatedchallengevalues['main_host']['0']['User']['user_username']))
													{
														$hpicture = $relatedchallengevalues['main_host']['0']['User']['user_profile_picture']; 
														$hname = explode(" ",$relatedchallengevalues['main_host']['0']['User']['user_username']); ?>
													<a onClick="FB.login(function(response){});" style="cursor:pointer;"><img src="<?php echo $hpicture; ?>" width="30" height="30" alt="<?php echo $hname[0]; ?>"><?php echo $hname[0]; ?></a>
													<?php } else { ?>
													<a onClick="FB.login(function(response){});" style="cursor:pointer;">Login to Host</a>
													<?php } ?>
													<?php } 
													else 
													{ ?>
													<?php if(isset($relatedchallengevalues['main_host']['0']['User']['user_profile_picture']) && isset($relatedchallengevalues['main_host']['0']['User']['user_username']))
													{
														$hpicture = $relatedchallengevalues['main_host']['0']['User']['user_profile_picture']; 
														$hname = explode(" ",$relatedchallengevalues['main_host']['0']['User']['user_username']);
														 ?>
													<a onClick="PickHostPopup('<?php echo $relatedchallengevalues['hostmode']; ?>','<?=$relatedchallengevalues['Challenge']['challenge_permalink']?>','challenge_details')" data-reveal-id="pickHostModel" data-animation="fade" data-default="#ffffff" data-hover="#fa7000" style="cursor:pointer;"><img src="<?php echo $hpicture; ?>" width="30" height="30" alt="<?php echo $hname[0]; ?>"><?php echo $hname[0]; ?></a>
													<?php } else { ?>
													<a onClick="getHostPopup('add','<?=$relatedchallengevalues['Challenge']['challenge_permalink']?>','challenge_details')" style="cursor:pointer;" >Host This!</a>
													<?php } ?>		
													<?php } ?>
												</li>	
												<?php } ?>
												<li>
													<span class="points increase"><?php if(isset($relatedchallengevalues['Challenge']['challenge_points'])) { echo $relatedchallengevalues['Challenge']['challenge_points']; } ?> Points</span>
												</li>
											</ul>
										</div>
									</div>
									<?php } ?>
									</div>
								</div>
							</div>
						<a class="btn-next" href="#">Next</a>
					</div>
				</div>
				<a id="FBcomments"></a>
				<!-- comments block -->
				<div class="section">
					<h2>Comments</h2>
					<div class="comments-placeholder">
					<fb:comments-count href="<?php echo Router::url('/', true) ."discover/". $challenge_info[0]['Challenge']['permalink']; ?>" /></fb:comments-count> Comments		
					<div class="fb-comments" data-href="<?php echo Router::url('/', true) ."discover/". $challenge_info[0]['Challenge']['permalink']; ?>" data-notify="true" data-num-posts="10"></div>	
					</div>
				</div>
			</div>
		</section>
		<!-- sidebar -->
		<aside id="sidebar" class="main-column alignright">
			<div class="right-background">
			<!-- social networks -->
			<div class="social-networks">
			<?php $url = ((!empty($_SERVER['HTTPS'])) ? "https://": "http://" ) . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			$json           =   file_get_contents("http://api.sharedcount.com/?url=" . rawurlencode($url));
			$counts         =   json_decode($json, true);
			$twitter_count  =   $counts["Twitter"];
                        $imagehue       =   "White";
			?>
				<ul>
					<li id="Whitefacebook">
						<a href="javascript:postLike('<?php echo $challenge_info[0]['Challenge']['permalink']; ?>');" class="facebook" id="facebookhref"><em>facebook</em></a>
						<span class="number">0</span>
					</li>
					<li id="Whitetwitter">
						<a href="https://twitter.com/share?url=<?php echo $url; ?>" id="twitterhref" target="blank" class="twitter" data-lang="en" ><em>twitter</em></a>
						<span class="number"><?php echo $twitter_count; ?></span>
					</li>
					<li id="Whitecomments">
						<a data-animation="fade" style="cursor:pointer;" class="comments" href="#FBcomments"><em>comments</em></a>
						<span class="number">0</span>
					</li>
				</ul>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
			<!-- info -->
			<ul class="info">
				<li class="difficulty" style="background:none;">
					<div style="position: absolute; margin: 4px 0px 0px -55px;"><img src="<?php echo Router::url('/', true) . "img/diffuploads/" . $challenge_info[0]['difficulty']['decal']; ?>" border="0" width="40" /></div>
					<strong class="title"><?php echo  $challenge_info[0]['difficulty']['title'];?></strong>
					<p>Level of Difficulty </p>
				</li>
				<li class="people">
					<strong class="title">0<?php //echo $challenge_info[0]['Challenge']['finished_count_participants']; ?></strong>
					<p>People Finished This</p>
				</li>
				<li class="points">
					<strong class="title">0<?php //echo $challenge_info[0]['Challenge']['challenge_points']; ?></strong>
					<p>Points Value </p>
				</li>
			</ul>
			<div style="height:30px;"></div>
			</div>
			<div class="options" style="margin: -153px 0 64px -9px;">
				<ul>
					<?php if($this->Session->read("session_user_id") == 0) { ?>
					<li><a href="javascript:Loginuser();" data-default="#ffffff" data-hover="#fa7000">Login Host This</a></li>
					<li><a href="javascript:Loginuser();" data-default="#ffffff" data-hover="#fa7000">Login Pick Host</a></li>
					<?php } else { ?>
					<li><a href="<?php echo Router::url('/host_challenge_step1/'.$challenge_info[0]['Challenge']['permalink'], true); ?>" data-default="#ffffff" data-hover="#fa7000">Host This</a></li>
					<li><a href="javascript:showAHost('<?php echo $challenge_info[0]['Challenge']['id'];?>');" data-default="#ffffff" data-hover="#fa7000">Pick Host</a></li>
					<?php }?>
				</ul>
				<span class="or">or</span>
			</div>
			<!-- hosts info -->
			<section class="side-block">
				<h2>Available Hosts</h2>
<?php 
$hosts_count = count($available_host);
if($hosts_count > 0) { ?>
                                <div class="single-host">
                                    <div class="host-block">
                                            <figure class="image-holder">
                                                    <a href="#"><img height="101" width="100" alt="image description" src="<?php echo $fullurl;?>img/useruploads/<?php echo $available_host[0]['user']['user_profile_picture'];?>"></a>
                                            </figure>
                                            <div class="txt">
                                                    <strong class="name"><?php echo $available_host[0]['user']['user_firstname'];?></strong>
                                            </div>
                                    </div>
<?php if($starts_in) { ?>
                                    <div class="note">
                                            <p>Starts in :<?php echo $starts_in['minutes'];?> minutes</p>
                                    </div>
<?php } if($hosts_count > 1) {?>
                                    <div class="persons-list">
                                        <ul>
<?php for($j=1;$j<$hosts_count;$j++) { ?>
                                <li><a href="#"><img height="50" width="50" alt="image description" src="<?php echo $fullurl;?>img/useruploads/<?php echo $available_host[$j]['user']['user_profile_picture'];?>"></a></li>

    
<?php } ?>
                    
                                        </ul>
                                        <p><?php echo $hosts_count;?> participants in this challenge</p>
                                </div>
<?php } ?>
                            </div>
<?php } ?>
			</section>
			<!-- friends list -->
      <!--
			<section class="side-block">
				<h2>My Friends</h2>
				<div class="persons-list">
					<div style="float:left;">
					<ul style="width: 205px;">
					<?php $friends_count = 0 ;
					//echo "list".$friends."--"; 
					//print_r($completed_participants);
					if($friends!="")
					{ 
						$arrfriends = explode(",",$friends);
						
					for ($i=1; $i<count($arrfriends);$i++)
					 {
						
						if(!empty($completed_participants))
						{
						if(in_array($arrfriends[$i],$completed_participants))
						{						
							$friends_count = $friends_count + 1;
					?>						
							<li><a href="http://www.facebook.com/<?php echo $arrfriends[$i]; ?>" target="_blank"><img src="https://graph.facebook.com/<?php echo $arrfriends[$i]; ?>/picture?type=square" alt="Photo"></a></li>
					<?php
						}}
						
						 }					
					 } ?>
					</ul>
					</div>
					<div>
						<p><?php echo $friends_count; ?> of your friends have participated in this challenge.</p>
					</div>
				</div>
			</section>
      -->
		</aside>
	</div>
</div>

<div id='dialog_host_this' style='display: none;'>
    
</div>

