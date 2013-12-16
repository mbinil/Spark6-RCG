<?php $site_url = Configure::read('SiteUrl'); ?>
<script>
function update_waiting_tab()
{	
	//update mychallenges 
	$.ajax({
		dataType: "html",
		type: "GET",
		evalScripts: true,
		url: '<?php echo Router::url(array('controller'=>'Challenges','action'=>'update_waitingtab'));?>',
		data: ({mode:'update'}),
		success: function (data, textStatus)
		{	
			$("#tab06").html(data);
			//alert(data);
		} //end of success
	});
}
function postNotify(permalink)
{
	var accessToken = $("#access_token").val();	
	var challengelink="<?=$site_url?>challenges/"+permalink;
	FB.api(
	  'https://graph.facebook.com/me/twentyonedaysapp:invite?access_token='+accessToken,
	  'post',
	  {
		challenge: challengelink
	  },
	  function(response) {
		// handle the response
		if(response.id)
		{
			alert("Succesfully Invited - "+response.id);
		} 
		else if(response.error)
		{
			alert(response.error.message);
		}
		else
		{
			alert("Error occurred while liking this challenge.");
		}
	  }
	);
}

</script>
<?php 
if(strstr($this->here,"my_challenges")=="my_challenges")
	$page = "my_challenges";
else
	$page = "other";	
				//echo "page-".$page;
if(isset($menu_list_waiting['count_waiting_challenges']) && $menu_list_waiting['count_waiting_challenges'] > 0) { ?>
<section <?php if($menu_list_waiting['count_waiting_challenges'] > 2) { ?>class="drop-row2" <?php } else { ?>class="drop-row" <?php } ?> id="inviteelist" >
	<h2><?php echo $menu_list_waiting['count_waiting_challenges']; ?> Invites to Join...</h2>
	<?php foreach($menu_list_waiting['user_waiting_challenges'] as $waiting) { ?>
	<ul id="Challenges<?php echo $waiting['user_challenge_id']; ?>">
		<li>
			<div class="holder">
				<img src="<?php echo $waiting['main_host_photo']; ?>?type=square" alt="image description" class="alignleft">
				<div class="txt">
					<h3><?php echo $waiting['challenge_name']; ?></h3>
					<p><!--<a href="#">--><span style="color: #0077C9;"><?php echo $waiting['main_host_name']; ?></span><!--</a>--> + <?php echo $waiting['main_host_participant_count']; ?> participants</p>
					<?php echo $this->Js->link(" ",array("controller"=>"Challenges","action"=> "join_challenge_menu/join/".$waiting['user_challenge_id']."/".$page),array("update" => "#inviteelist","htmlAttributes" => array("onclick"=>"postNotify('".$waiting['challenge_permalink']."')","class"=>"agree","evalScripts" => true)));   echo $this->Js->writeBuffer();  ?>
					<?php echo $this->Js->link(' ',array('controller'=>'Challenges','action'=> 'join_challenge_menu/unjoin/'.$waiting['user_challenge_id'].'/'.$page), array('update' => '#inviteelist','htmlAttributes' => array('class'=>'reject','evalScripts' => true)));   echo $this->Js->writeBuffer();  ?>
				</div>
			</div>
			<span class="label <?php if($waiting['challenge_lifestyle']==1 ) { ?> blue <?php } ?><?php if($waiting['challenge_lifestyle']==2) { ?> green <?php  }?><?php if($waiting['challenge_lifestyle']==3) { ?> orange<?php  } ?>"></span>
		</li>
	</ul>
	<div style="height:5px;"></div>
	<?php } ?>
</section>
<?php } ?>
<?php if(isset($menu_list_user['count_active_challenges']) && $menu_list_user['count_active_challenges']>0) { ?>
<section <?php if($menu_list_user['count_active_challenges'] > 2) { ?>class="drop-row2" <?php } else { ?>class="drop-row" <?php } ?>>
	<h2>Active Challenges</h2>
	<?php foreach($menu_list_user['user_active_challenges'] as $activechallenges) { ?>
	<ul>
		<li>
			<div class="holder">
				<div class="txt">
					<h3><?php echo $activechallenges['challenge_name']; ?></h3>
					<p><?php echo $activechallenges['ends_in']; ?> Days Left!</p>
				</div>
			</div>
			<span class="label <?php if($activechallenges['challenge_lifestyle']==1 ) { ?> blue <?php } ?><?php if($activechallenges['challenge_lifestyle']==2) { ?> green <?php  }?><?php if($activechallenges['challenge_lifestyle']==3) { ?> orange<?php  } ?>"></span>									
		</li>
	</ul>
	<div style="height:5px;"></div>
	<?php } ?>
</section>
<?php } ?>
<?php if(isset($menu_challenge_notify['count_notify_challenges']) && $menu_challenge_notify['count_notify_challenges'] > 0) { ?>
<section <?php if($menu_challenge_notify['count_notify_challenges'] > 1) { ?>class="drop-row2" <?php } else { ?>class="drop-row" <?php } ?>>
	<h2><?php echo $menu_challenge_notify['count_notify_challenges']; ?> Challenges Notification</h2>
	<?php foreach($menu_challenge_notify['user_notify_challenges'] as $notifychallenges) { ?>
	<ul>
		<li>
			<div class="holder">
				<div class="txt">
					<h3><?php echo $notifychallenges['challenge_name']; ?></h3>
					<p><?php echo $notifychallenges['challenge_acceptedby']; ?> <?php if($notifychallenges['challenge_status']==6) { ?> accepted <?php } if($notifychallenges['challenge_status']==7) { ?> rejected <?php } ?> your invitation.</p>
				</div>
			</div>
			<span class="label <?php if($notifychallenges['challenge_lifestyle']==1) { ?> blue<?php } ?><?php if($notifychallenges['challenge_lifestyle']==2) { ?> green<?php } ?><?php if($notifychallenges['challenge_lifestyle']==3) { ?> orange<?php } ?>"></span>						
		</li>
	</ul>
	<div style="height:5px;"></div>
	<?php } ?>
</section>
<?php } ?>