<!--Right said start-->           
<div class="container_left">
<h1>Challenges</h1>
<h3>These are what users need to complete to earn points and badges</h3>
<?php $success = explode('?',$_SERVER[ 'REQUEST_URI' ]); 
if(isset($success[1])) { 
	if($success[1] == "success") { 
		$msg = "Your challenge was successfully created!";
	}
	if($success[1] == "deleted") { 
		$msg = "Challenge successfully deleted!";
	}
	if($success[1] == "edited") { 
		$msg = "Challenge successfully updated!";
	}
?>
	<div class="alert alert-success">
		<button class="close fui-cross" data-dismiss="alert" type="button"></button>
		<?php echo $msg; ?>
	</div> 
<?php }?>
<div class="btn_allUser" style="float:left; margin:3px 0 0 550px;position: absolute;">
	<a href="challengeaddstep1" class="btn btn-primary btn-block" style="width:200px;background-color:#3498DB;">+ New Challenge</a>
</div>
<div class="clear"></div>
<div class="table-responsive">
    <?php if(isset($Challengeinfo) && empty($Challengeinfo)){ ?>
        <div class="row-fluid"><div class="span6"></div><div class="span6"><div class="search_fieald" id="example_filter"><label><input type="text" class="form-control" id="search-query-1" placeholder="Search" aria-controls="example"></label></div></div></div>
    <?php } ?>
	<table class="table table-bordered" <?php if(isset($Challengeinfo) && !empty($Challengeinfo)){ ?> id="example" <?php } ?>>
		<thead>
		  <tr>
			<th width="40%" style="background-color:#666666; color:#FFFFFF;">Title</th>
			<th width="20%" style="background-color:#666666; color:#FFFFFF;">Child Category</th>
			<th width="15%" style="background-color:#666666; color:#FFFFFF;">Difficulty</th>
			<th width="15%" style="background-color:#666666; color:#FFFFFF;">Notifications</th>
			<th width="5%" style="background-color:#666666; color:#FFFFFF;">Status</th>
			<th width="5%" style="background-color:#666666; color:#FFFFFF;">Action</th>
		  </tr>
		</thead>
		<tbody>
		<?php if(isset($Challengeinfo) && !empty($Challengeinfo)){
		 foreach($Challengeinfo as $chalinfo) { ?>
		  <tr>
			<td><?php echo str_replace('\"', '', $chalinfo['Challenge']['name']); ?></td>
			<td><?php echo $chalinfo['Challenge']['pcat']; ?></td>
			<td><?php echo $chalinfo['Challenge']['diff']; ?></td>
			<td>Every <?php echo $chalinfo['Challenge']['notification_frequency']; ?> Days</td>
			<td><?php if($chalinfo['Challenge']['status']=="0"){ echo "Inactive"; } else { echo "Active"; } ?></td>
			<td>
				<div class="navbar" style="margin-bottom:0 !important;min-height:0 !important;">
					<ul class="nav" style="top:110px;">
						<li> 
							<span class="fui-gear" style="color:#0077C9;"></span>
							<ul style="margin-left:-94px;margin-top:-142px;">
								<li style="cursor:default;color:#FFFFFF;padding:10px 0 5px 13px;">Actions:</li>
								<li><a href="challengeeditstep1/<?php echo $chalinfo['Challenge']['id']; ?>">Edit Challenge</a></li>
								<li><a href="Javascript:challengedelete('<?php echo $chalinfo['Challenge']['id']; ?>');">Delete Challenge</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</td>
		  </tr>
		<?php } 
		} else { ?> 
		  <tr>
			<td colspan="6" style="text-align:center;">No challenges to list!!</td>
		  </tr>
		<?php } ?> 
		</tbody>  
    </table>
</div> 
</div>    
<!--right said end-->  