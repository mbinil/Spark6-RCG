<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<style>
#ui-id-1
{
	z-index: 1000;	
}
</style>
<?php
//print Configure::version(); 
$site_url = Configure::read('SiteUrl');
$challenge_img=Configure::read('ChallengeImg');
$challenge_bg_img=Configure::read('ChallengeBgImg');
$life_style = Configure::read('LifeStyle');
$difficulty = Configure::read('Difficulty');
$difficulty_style = Configure::read('DifficultyStyle');
$more_style = Configure::read('MoreStyle');
$facebook = Configure::read('Facebook');
if(isset($hostsavemessage) && $hostsavemessage!='')
{ 
	echo "<script>alert('".$hostsavemessage."');</script>";
}
if(isset($email_status) && $email_status!="")
{ 
	echo "<script>alert('".$email_status."');</script>";
}

//$data = json_decode(file_get_contents('https://api.twitter.com/1/users/lookup.json?screen_name=sjose'), true);
//echo $data[0]['followers_count'];
$sess_friends = $this->Session->read("friends");
?>
<script language="javascript">
function applyFilterAndLoadForm(lifestyle,category)
{	
	if(lifestyle!="")
		document.getElementById("lifestyle").value = lifestyle;
	if(category!="")
		document.getElementById("category").value = category;
	//alert(document.getElementById("category").value);
	document.menuform.submit();
}
function postToFeed()
{
	challengetitle="<?=$challenge['challenge_title']?>";
	challengedescription="<?=$challenge['challenge_description']?>";
	challengeimgloc="<?=$challenge['challenge_image']?>";
	challengelink="<?=$site_url?>challenges/<?=$challenge['challenge_permalink']?>";
	
	//https://developers.facebook.com/docs/reference/dialogs/
		 
	// calling the API ...
	var obj = {
	  method: 'feed',
	  //redirect_uri: challengelink,
	  link: challengelink,
	  picture: challengeimgloc,
	  name: challengetitle,
	  caption: ' ',
	  description: challengedescription
	};

   //alert('<?=$site_url?>my_challenges');
   
	function callback(response) {
	  //document.getElementById('msg').innerHTML = "Post ID: " + response['post_id'];
	  //alert(response);
	}

	FB.ui(obj, callback);
}

function postLike(permalink)
{
	var accessToken = $("#access_token").val();	
	var challengelink="<?=$site_url?>challenges/<?=$challenge['challenge_permalink']?>";
	FB.api('https://graph.facebook.com/me/og.likes?access_token='+accessToken,'post',{object: challengelink},
    function(response) {     // handle the response
		if(response.id)
		{
			$.ajax({
				dataType: "html",
				type: "GET",
				evalScripts: true,
				url: '<?php echo Router::url(array('controller'=>'Users','action'=>'increment_fblikes'));?>',
				data: ({challenge_permalink:permalink}),
				success: function (data, textStatus)
				{	
					alert("You succesfully liked this challenge in Facebook.");
				} //end of success
			}); 
			//alert("Succesfully liked - "+response.id);
		} 
		else if(response.error)
		{
			alert(response.error.message);
		}
		else
		{
			alert("Error occurred while liking this challenge.");
		}
	});
}
function updateemailstat()  
{
	$("#share").val("share_email");
	document.sharechallengeemail.submit();
}
function sendemail()
{
	var challengelink='<?=$site_url?>challenges/<?php echo $challenge['challenge_permalink']?>'; 
	var msg="I just completed 21 days of  <?php echo $challenge['challenge_title']?>! I thought this might be a great experience for you as well. Click here " +  challengelink + " and give it a try!";
	
	$("#challengemsg").val(msg);
	$("#share").val("share_email");
	$("#permalink").val("<?php echo $challenge['challenge_permalink']?>");
}
function fbcomments()
{
	var commentheight = document.body.scrollHeight-800;
	window.scrollTo(0,commentheight);
}
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
</script>
<div class="visual">
	<img alt="image description" src="<?php echo $challenge_bg_img.$challenge['challenge_image']; ?>">
</div>
<div id="main">
	<!-- two columns block -->
	<div id="two-columns">
		<!-- content -->
		<section id="content" class="main-column alignleft" style="width: 710px !important;">
			<!-- details -->
			<?php echo $this->form->create("Challenge",array('controller'=>'challenges','action'=>'index',"id"=>"menuform","name"=>"menuform")); ?>
			<?php echo $this->form->input(" ",array("id"=>"lifestyle","name"=>"lifestyle","type"=>"hidden")); ?>
			<?php echo $this->form->input(" ",array("id"=>"category","name"=>"category","type"=>"hidden")); ?>
			<?php echo $this->form->input(" ",array("id"=>"difficulty","name"=>"difficulty","type"=>"hidden")); ?>
			<?php echo $this->form->input(" ",array("name"=>"friendslist","id"=>"friendslist","type"=>"hidden", "value"=>$friends)); ?>
			<?php echo $this->form->end(); ?>
			<div class="details-block">				
				<!-- heading -->
				<header class="title">
				 	<h1><?php echo $challenge['challenge_title']; ?></h1>			
					<span class="label <?php if($challenge['challenge_lifestyle']==1) { ?> blue <?php } ?><?php if($challenge['challenge_lifestyle']==2){ ?> green <?php } ?><?php if($challenge['challenge_lifestyle']==3){ ?> orange<?php } ?>"></span>
				</header>
				<!-- visual -->
				<figure class="image-holder">
					<img src="http://21dayschallenge.s3.amazonaws.com/<?php echo $challenge['challenge_image']; ?>" width="710" height="480" alt="image description">
					<figcaption class="txt">
						<span class="note">In <a onclick="applyFilterAndLoadForm('',<?php echo $challenge['challenge_category']; ?>);" style="cursor:pointer;"><?php echo $challenge['category_name']; ?></a></span>
						<p><?php echo $challenge['challenge_description']; ?></p>
					</figcaption>
				</figure>
				<!-- description -->
				<article class="about">
					<section class="section">
						<h2>Daily Commitment</h2>
						<p><?php echo $challenge['challenge_what']; ?></p>
					</section>
					<section class="section">
						<h2>Why?</h2>
						<p><?php echo $challenge['challenge_why']; ?></p>
					</section>
					<section class="section">
						<h2>How?</h2>
						<p><?php echo $challenge['challenge_how']; ?></p>
					</section>
					<section class="section">
						<h2>Helpful Links</h2>
						<?php echo $challenge['challenge_references']; ?>
					</section>
				</article>
				<!-- gallery -->
				<div class="gallery-block">
					<h2>Related Challenges</h2>
					<div class="carousel">
						<a class="btn-prev" href="#">Previous</a>
						<div class="mask">
						  <div class="gholder">
						  	<div class="slideset columns-holder">
								<?php foreach($challenge["related_challenges"] as $relatedchallengevalues) { ?>
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
				<!-- Host This popup in related challenges -->
<div id="host_div" style="display:none;">
</div>
				<a id="FBcomments"></a>
				<!-- comments block -->
				<div class="section">
					<h2>Comments</h2>
					<div class="comments-placeholder">
					<?php /*?><!--<!--<div class="fb-comments-count" data-href="<?php echo $site_url ?>challenges/<?php echo $challenge['challenge_permalink']; ?>">0</div> Comments-->--><?php */?>
					<fb:comments-count href="<?php echo $site_url ?>challenges/<?php echo $challenge['challenge_permalink']; ?>" /></fb:comments-count> Comments		
					<div class="fb-comments" data-href="<?php echo $site_url ?>challenges/<?php echo $challenge['challenge_permalink']; ?>" data-notify="true" data-num-posts="10"></div>	
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
			$json = file_get_contents("http://api.sharedcount.com/?url=" . rawurlencode($url));
			$counts = json_decode($json, true);
			$twitter_count = $counts["Twitter"];
			/*if($counts["Facebook"]["like_count"]!='')
			{
				$facebook_count = $counts["Facebook"]["like_count"];
			}
			else
			{
				$facebook_count = '0';
			}*/
			?>
				<ul>
					<li <?php if($imagehue=="White") { ?>id="Whitefacebook"<?php } else { ?>id="Blackfacebook"<?php } ?>>
						<a href="javascript:postLike('<?php echo $challenge['challenge_permalink']; ?>');" class="facebook" id="facebookhref"><em>facebook</em></a>
						<span class="number"><?php echo $challenge['challenge_likes']; ?></span>
					</li>
					<li <?php if($imagehue=="White") { ?>id="Whitetwitter"<?php } else { ?>id="Blacktwitter"<?php } ?>>
						<a href="https://twitter.com/share?url=<?php echo $url; ?>" id="twitterhref" target="blank" class="twitter" data-lang="en" ><em>twitter</em></a>
						<span class="number"><?php echo $twitter_count; ?></span>
					</li>
					<li <?php if($imagehue=="White") { ?>id="Whitecomments"<?php } else { ?>id="Blackcomments"<?php } ?>>
						<a data-animation="fade" style="cursor:pointer;" class="comments" onclick="fbcomments()"><em>comments</em></a>
						<span class="number"><fb:comments-count href="<?php echo $site_url ?>challenges/<?php echo $challenge['challenge_permalink']; ?>" /></fb:comments-count></span>
					</li>
				</ul>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
			<!-- info -->
			<ul class="info">
				<?php if($difficulty[$challenge['challenge_difficulty']] == 'High') 
				{
					$diff = 'hard';
				}
				else if($difficulty[$challenge['challenge_difficulty']] == 'Medium')
				{
					$diff = 'medium';
				}
				else
				{
					$diff = 'easy';
				} ?>
				<li class="difficulty <?php echo $diff; ?>">
					<strong class="title"><?php echo  $difficulty[$challenge['challenge_difficulty']];?></strong>
					<p>Level of Difficulty </p>
				</li>
				<li class="people">
					<strong class="title"><?php echo $challenge['finished_count_participants']; ?></strong>
					<p>People Finished This</p>
				</li>
				<li class="points">
					<strong class="title"><?php echo $challenge['challenge_points']; ?></strong>
					<p>Points Value </p>
				</li>
			</ul>
			<div style="height:30px;"></div>
			</div>
			<div class="options">
				<ul>
				<?php 				
				if($active_user == 0) {
				$redirect_url = $site_url.'challenges/'.$challenge['challenge_permalink'];
				 ?>
					<li><a href="#" data-default="#ffffff" data-hover="#fa7000" onClick="FB.login(function(response) { });">Login Host This</a></li>
					<li><a href="#" data-default="#ffffff" data-hover="#fa7000" onClick="FB.login(function(response) { });">Login Pick Host</a></li>
				<?php
				} 
				else 
				{ 
					
					if($host_mode=="add")
					 { ?>
						<li><a onClick="getHostPopup('add','<?=$challenge['challenge_permalink']?>','challenge_details')" style="cursor:pointer;">Host This</a></li>
					<?php } else if($host_mode=="edit") { ?>
					<li><a onClick="getHostPopup('edit','<?=$challenge['challenge_permalink']?>','challenge_details')" style="cursor:pointer;">Edit</a></li>
					<?php } else if($host_mode=="invite") { ?>	
					<li><a onClick="getHostPopup('invite','<?=$challenge['challenge_permalink']?>','challenge_details')" style="cursor:pointer;">Invite Friends</a></li>
					<?php } else  { ?>	
					<li><a >Host This</a></li><?php } ?>
					<li>
					<?php if($host_mode!='none') { ?>					
					<a onclick="PickHostPopup('<?php echo $host_mode; ?>','<?php echo $challenge['challenge_permalink']; ?>','challenge_details')" data-reveal-id="pickHostModel" data-animation="fade" data-default="#ffffff" data-hover="#fa7000" style="cursor:pointer;">Pick Host</a>
					<?php } else { ?>
					<a href="" data-reveal-id="CommonWarningMSG" data-animation="fade" style="cursor:pointer;" onclick="CommonWarningMSG('Pick')">Pick Host</a>
					<?php } ?>
					</li>								
				<?php } ?>
				</ul>
				<span class="or">or</span>
			</div>
			<!-- hosts info -->
			<section class="side-block">
				<h2>Available Hosts</h2>
				<?php 
				$hosts_count = count($challenge['available_hosts']);
				if(isset($challenge['available_hosts']) && ($hosts_count > 1))
				{ ?>					
				<div class="multi-host" style="display:block;">
				<ul>
				<?php for($j=0;$j<$hosts_count;$j++) { ?>
																
					<li><div class="crop"><a href="http://www.facebook.com/<?php echo $challenge['available_hosts'][$j]['host_fbid']; ?>" target="_blank"><img src="<?php echo $challenge['available_hosts'][$j]['host_picture']; ?>?type=normal"  alt="<?php echo $challenge['available_hosts'][$j]['host_name']; ?>"  /><span class="overlay"><strong class="number">+ <?php echo $challenge['available_hosts'][$j]['host_participant_count']; ?></strong> Participants</span><span class="time"></span></a></div></li>
				<?php } ?>
				</ul>
				</div>
				  <?php } 
					else if(isset($challenge['available_hosts']) && ($hosts_count == 1)){  ?>
						<div class="single-host">
							<div class="host-block">								
								<figure class="image-holder">
									<div class="crop">
									<a href="http://www.facebook.com/<?php echo $challenge['available_hosts'][0]['host_fbid']; ?>" target="_blank"><img src="<?php echo $challenge['available_hosts'][0]['host_picture']; ?>?type=normal"  alt="<?php echo $challenge['available_hosts'][0]['host_name']; ?>"></a></div>
								</figure>
								<div class="txt">
									<strong class="name"><?php echo $challenge['available_hosts'][0]['host_name']; ?></strong>
								</div>
							</div>
							<div class="persons-list">
								<div style="float:left;">
									<ul style="width: 205px;">
									<?php										
									if(isset($challenge['available_hosts'][0]['host_participants']))
									{ 
										foreach($challenge['available_hosts'][0]['host_participants'] as $participants)
										{
									?>										
									<li><a href="http://www.facebook.com/<?php echo $participants['User']['user_fbid']; ?>" target="_blank"><img src="<?php echo $participants['User']['user_profile_picture']; ?>?type=square"  alt="<?php echo $participants['User']['user_username']; ?>"></a></li>
									<?php
									 }										
									} ?>
									</ul>
								</div>
								<div>						
									<br/><p><?php echo count($challenge['available_hosts'][0]['host_participants']); ?> participants in this challenge.</p>
								</div>
							</div>
						</div>	
					<?php } ?>
			</section>
			<!-- friends list -->
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
		</aside>
	</div>
</div>

