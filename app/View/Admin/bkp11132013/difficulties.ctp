<script type="text/javascript">
function showtooltip(id)
{
	$('#'+id).show();
}
function hidetooltip(id)
{
	$('#'+id).delay("slow").fadeOut(4000);
}
</script>
<!--Right said start-->           
<div class="container_right">
<?php $success = explode('?',$_SERVER[ 'REQUEST_URI' ]); 
if(isset($success[1])) { 
	if($success[1] == "success") { 
		$msg = "Your difficulty type was successfully created!";
	}
	if($success[1] == "deleted") { 
		$msg = "Difficulty type successfully deleted!";
	}
?>
	<div class="alert alert-success">
		<button class="close fui-cross" data-dismiss="alert" type="button"></button>
		<?php echo $msg; ?>
	</div> 
<?php }?>
<h1>Difficulty Types</h1>
<h3>Create them here then apply the decal during Challenge creation.</h3>
<div class="search_fieald" style="float:left; margin: 10px 280px 0 0;">
	<div class="form-group">
		<div class="input-group input-group-sm">
			<input id="appendedInputButton-04" class="form-control" type="search" placeholder="Search for a decal" style="width:200px;">
			<span class="input-group-btn">
				<button class="btn" type="button">
					<span class="fui-search"></span>
				</button>
			</span>
		</div>
	</div>
</div>
<div class="btn_allUser" style="float:left; margin: 10px 0px;">
	<a href="difficultyaddstep1" class="btn btn-primary btn-block" style="width:200px;background-color:#3498DB;">new difficulty <span class="fui-arrow-right pull-right"></span></a>
</div>
<div class="clear"></div>
<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
		  <tr>
			<th width="10%">Decal</th>
			<th width="15%">Titile</th>
			<th width="5%">Points</th>
			<th width="60%">Description</th>
			<th width="5%">Status</th>
			<th width="5%">Action</th>
		  </tr>
		</thead>
		<tbody>
		<?php if(isset($difficultiestypes) && !empty($difficultiestypes)){
		 foreach($difficultiestypes as $difftypes) { ?>
		  <tr>
			<td><img src="<?php echo "../img/diffuploads/".$difftypes['Difficulty']['decal']; ?>" width="60" height="60" alt="<?php echo $difftypes['Difficulty']['title']; ?>" /></td>
			<td><?php echo $difftypes['Difficulty']['title']; ?></td>
			<td><?php echo $difftypes['Difficulty']['points']; ?></td>
			<td><?php echo $difftypes['Difficulty']['description']; ?></td>
			<td><?php if($difftypes['Difficulty']['status']=="0"){ echo "Inactive"; } else { echo "Active"; } ?></td>
			<td><a onmouseover="Javascript:showtooltip('tooltip<?php echo $difftypes['Difficulty']['id']; ?>');" onmouseout="javascript:hidetooltip('tooltip<?php echo $difftypes['Difficulty']['id']; ?>');"><span class="fui-gear"></span></a>
			<div class="tooltip fade top in" style="margin:-110px 0 0 -81px; display: none;" id="tooltip<?php echo $difftypes['Difficulty']['id']; ?>">
				<div class="tooltip-arrow"></div>
				<div class="tooltip-inner" style="text-align:left;">Actions:<br/><a href="difficultyeditstep1/<?php echo $difftypes['Difficulty']['id']; ?>">Edit difficulty type</a><br/><!--<a href="difficultydelete/<?php echo $difftypes['Difficulty']['id']; ?>">Delete difficulty type</a>--><a href="Javascript:diffdelete('<?php echo $difftypes['Difficulty']['id']; ?>');">Delete difficulty type</a></div>
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
	<div  style="text-align:center;">
	  <ul class="pager">
		<li class="previous">
		  <a href="#">
			<span class="fui-arrow-left"></span>
			<span>1</span>
		  </a>
		</li>
		<li class="next">
		  <a href="#">
			<span class="fui-arrow-right"></span>
		  </a>
		</li>
	  </ul>
	</div>
</div> 
</div>    
<!--right said end-->  