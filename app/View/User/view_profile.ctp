<style>
#sidebar {
    border-right: 0;
	padding:0;
}
</style>
<?php $reg_array = $this->Session->read("newreginfo");
$eBayBusinessUnit = Configure::read('eBayBusinessUnit');
$eBayBusinessUnitLoc = Configure::read('eBayBusinessUnitLoc');
?>
<!-- main content block -->
<div id="main">
	<!-- two columns section -->
	<div id="two-columns" style="margin-top:35px;">
		<!-- content -->
		<section id="content" class="main-column alignright" style="width: 76% !important; padding-left: 10px !important;">
			<div class="tabs-area">
				<div style="margin:0px;">
					<div style="font-size: 40px; margin: 5px 0px; width: 300px; float:left; text-align: left;"><?php echo $Loggeduserinfo[0]['User']['user_firstname']." ".$Loggeduserinfo[0]['User']['user_lastname']; ?></div>
					<div style="font-size: 40px; margin: 5px 0px; width: 130px; float:left; text-align: center;"><?php echo $Loggeduserinfo[0]['User']['user_level']; ?></div>
					<div style="font-size: 40px; margin: 5px 0px; width: 130px; float:left; text-align: center;"><?php echo $Loggeduserinfo[0]['User']['user_points']; ?></div>
					<div style="font-size: 40px; margin: 5px 0px; width: 150px; float:left; text-align: center;">0%</div>
				</div>
				<div style="margin:0px;">
					<div style="font-size: 16px; margin: 5px 0px; width: 300px; float:left; text-align: left;">member since <?php echo  date("Y-m-d", strtotime($Loggeduserinfo[0]['User']['user_added'])); ?></div>
					<div style="font-size: 16px; margin: 5px 0px; width: 130px; float:left; text-align: center;">level</div>
					<div style="font-size: 16px; margin: 5px 0px; width: 130px; float:left; text-align: center;">points earned</div>
					<div style="font-size: 16px; margin: 5px 0px; width: 150px; float:left; text-align: center;">finish rate</div>
				</div>
				<div class="clear"></div>
				<hr/>
				<div class="clear"></div>
				<div style="margin:25px 0;">
					<div style="font-size: 32px; margin: 5px 0px; text-align: left;">Active challenges</div>
					<div style="margin:15px 0;">
					<?php if($activechallenge==""){ ?>
						No challenges to list!!
					<?php } else { ?>
						<?php foreach($activechallenge as $chalinfo) { ?>
							<div style="border: 1px solid #ccc; padding:10px; margin:0 10px 10px 0px; width:48%; float:left; min-height:155px; overflow:hidden;">
								<div style="margin:0 0 5px 0; color:#0099FF; font-size:20px;"><?php echo $chalinfo['Challenge']['name']; ?></div>
								<div style="margin:0px;">
									<div style="margin:5px 10px 0 0; float:left;"><img src="<?php echo Router::url('/img/challengeuploads/', true) . $chalinfo['Challenge']['hero_image']; ?>" border="0" width="100" /></div>
									<div style="margin:0px;"><?php echo $chalinfo['Challenge']['daily_commitment']; ?></div>
								</div>
							</div>
						<?php } ?>	
					<?php } ?>
					</div>
				</div>
				<div class="clear"></div>
				<div style="margin:35px 0;">
					<div style="font-size: 32px; margin: 5px 0px; text-align: left;">Upcoming challenges</div>
					<div style="margin:15px 0;">
					<?php if($upcomingchallenge==""){ ?>
						No challenges to list!!
					<?php } else { ?>
						<?php foreach($activechallenge as $chalinfo) { ?>
							<div style="border: 1px solid #ccc; padding:10px; margin:0 10px 10px 0px; width:48%; float:left; min-height:155px; overflow:hidden;">
								<div style="margin:0 0 5px 0; color:#0099FF; font-size:20px;"><?php echo $chalinfo['Challenge']['name']; ?></div>
								<div style="margin:0px;">
									<div style="margin:5px 10px 0 0; float:left;"><img src="<?php echo Router::url('/img/challengeuploads/', true) . $chalinfo['Challenge']['hero_image']; ?>" border="0" width="100" /></div>
									<div style="margin:0px;"><?php echo $chalinfo['Challenge']['daily_commitment']; ?></div>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
					</div>
				</div>
				<div class="clear"></div>
				<div style="margin:35px 0;">
					<div style="font-size: 32px; margin: 5px 0px; text-align: left;">Completed challenges</div>
					<div style="margin:15px 0;">
					<?php if($completedchallenge==""){ ?>
						No challenges to list!!
					<?php } else { ?>
						<?php foreach($activechallenge as $chalinfo) { ?>
							<div style="border: 1px solid #ccc; padding:10px; margin:0 10px 10px 0px; width:48%; float:left; min-height:155px; overflow:hidden;">
								<div style="margin:0 0 5px 0; color:#0099FF; font-size:20px;"><?php echo $chalinfo['Challenge']['name']; ?></div>
								<div style="margin:0px;">
									<div style="margin:5px 10px 0 0; float:left;"><img src="<?php echo Router::url('/img/challengeuploads/', true) . $chalinfo['Challenge']['hero_image']; ?>" border="0" width="100" /></div>
									<div style="margin:0px;"><?php echo $chalinfo['Challenge']['daily_commitment']; ?></div>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
		</section>
		<!-- sidebar -->
		<aside id="sidebar" class="main-column alignleft">
			<div style="margin:0;"><img src="<?php echo Router::url('/img/useruploads/', true) . $Loggeduserinfo[0]['User']['user_profile_picture']; ?>" border="0" width="200" style="border:1px solid #ccc; padding:5px;" /></div>
			<div class="clear"></div>
			<div style="margin:15px 0; width: 219px;">
				<div>Business Unit:</div>
				<div><?php echo $eBayBusinessUnit[$Loggeduserinfo[0]['User']['user_business_unit']]; ?></div>
			</div>
			<div class="clear"></div>
			<div style="margin:15px 0; width: 219px;">
				<div>Business Unit Location:</div>
				<div><?php echo $eBayBusinessUnitLoc[$Loggeduserinfo[0]['User']['user_business_loc']]; ?></div>
			</div>
			<div class="clear"></div>
			<div style="margin:15px 0; width: 219px;">
				<div>Degree:</div>
				<div><?php echo $Loggeduserinfo[0]['User']['user_grd_degree']; ?></div>
			</div>
			<div class="clear"></div>
			<div style="margin:15px 0; width: 219px;">
				<div>School Name:</div>
				<div><?php echo $Loggeduserinfo[0]['User']['user_grd_schl']; ?></div>
			</div>
			<div class="clear"></div>
			<div style="margin:15px 0; width: 219px;">
				<div>Graduation Year:</div>
				<div><?php echo $Loggeduserinfo[0]['User']['user_grd_year']; ?></div>
			</div>
			<div class="clear"></div>
			<div style="margin:15px 0; width: 219px;">
				<div>Degree:</div>
				<div><?php echo $Loggeduserinfo[0]['User']['user_grd_level']." ".$Loggeduserinfo[0]['User']['user_grd_cat']; ?></div>
			</div>
			<div class="clear"></div>
			<div style="margin:15px 0; width: 219px;">
				<div>Hobbies:</div>
				<div><?php echo $Loggeduserinfo[0]['User']['user_hobbies']; ?></div>
			</div>
			<?php if($this->Session->read("session_user_id")){ ?>
			<div class="clear"></div>
			<div style="margin:15px 0; width: 219px;">
				<div><a href="<?php echo Router::url('/manage_account_step1', true); ?>" style="cursor:pointer; font-size:14px;">Edit this info</a></div>
			</div>
			<?php } ?>
		</aside>
	</div>
</div>