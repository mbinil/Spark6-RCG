<!--Right said start-->           
<div class="container_left">
<h1>Difficulty Types</h1>
<h3>Create them here then apply the decal during the <a href="challenges">Challenge</a> creation.</h3>
<?php $success = explode('?',$_SERVER[ 'REQUEST_URI' ]); 
if(isset($success[1])) { 
	if($success[1] == "success") { 
		$msg = 'Your difficulty was successfully created!';
	}
	if($success[1] == "deleted") { 
		$msg = "Difficulty type successfully deleted!";
	}
        if($success[1] == "edited") { 
		$msg = "Difficulty type successfully updated!";
	}
?>
	<div class="alert alert-success">
		<button class="close fui-cross" data-dismiss="alert" type="button"></button>
		<?php echo $msg; ?>
	</div> 
<?php unset($_SESSION['difficulty_name']); } ?>
<div class="btn_allUser" style="float:left; margin:7px 0 0 550px;position: absolute;">
	<a href="difficultyaddstep1" class="btn btn-primary btn-block" style="width:200px;background-color:#3498DB;">+ New Difficulty type</a>
</div>
<div class="clear"></div>
<div class="table-responsive">
	<table class="table table-bordered" id="example">
		<thead>
		  <tr>
			<th width="5%" style="background-color:#666666; color:#FFFFFF;">Decal</th>
			<th width="25%" style="background-color:#666666; color:#FFFFFF;">Title</th>
			<th width="10%" style="background-color:#666666; color:#FFFFFF;">Points</th>
			<th width="40%" style="background-color:#666666; color:#FFFFFF;">Description</th>
			<th width="10%" style="background-color:#666666; color:#FFFFFF;">Status</th>
			<th width="10%" style="background-color:#666666; color:#FFFFFF;">Action</th>
		  </tr>
		</thead>
		<tbody>
		<?php if(isset($difficultiestypes) && !empty($difficultiestypes)){
		 foreach($difficultiestypes as $difftypes) { ?>
		  <tr>
			<td><img src="<?php echo "../img/diffuploads/".$difftypes['Difficulty']['decal']; ?>" width="60" height="60" alt="<?php echo str_replace('\"', '', $difftypes['Difficulty']['title']); ?>" style="background-color:#999999;" /></td>
			<td><?php echo str_replace('\"', '', $difftypes['Difficulty']['title']); ?></td>
			<td><?php echo $difftypes['Difficulty']['points']; ?></td>
			<td><?php echo stripslashes($difftypes['Difficulty']['description']); ?></td>
			<td><?php if($difftypes['Difficulty']['status']=="0"){ echo "Inactive"; } else { echo "Active"; } ?></td>
			<td>
				<div class="navbar" style="margin-bottom:0 !important;min-height:0 !important;">
					<ul class="nav" style="top:110px;">
						<li> 
							<span class="fui-gear" style="color:#0077C9;"></span>
							<ul style="margin-left:-94px;margin-top:-142px;">
								<li style="cursor:default;color:#FFFFFF;padding:10px 0 5px 13px;">Actions:</li>
								<li><a href="difficultyeditstep1/<?php echo $difftypes['Difficulty']['id']; ?>">Edit difficulty type</a></li>
								<li><a href="Javascript:diffdelete('<?php echo $difftypes['Difficulty']['id']; ?>');">Delete difficulty type</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</td>
		  </tr>
		<?php } 
		} else { ?> 
		  <tr>
			<td colspan="6" style="text-align:center;">No difficulty types to list!!</td>
		  </tr>
		<?php } ?> 
		</tbody>  
    </table>
</div> 
</div>    
<!--right said end-->  