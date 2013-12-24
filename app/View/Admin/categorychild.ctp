<style>
    .tooltip-inner {
        padding: 29.5px 0 0;
    }
</style>
<script type="text/javascript">
function showtooltip(id)
{
	$('#'+id).show();
}
function hidetooltip(id)
{
	$('#'+id).delay("slow").fadeOut(4000);
}
function showcolorring(id)
{
	$('#'+id).show();
}
function hidecolorring(id)
{
	$('#'+id).hide();
}
</script>
<!--Right said start-->           
<div class="container_left">
<h1>Child Categories</h1>
<h3>These belongs to parent categories.</h3>
<?php $success = explode('?',$_SERVER[ 'REQUEST_URI' ]); 
if(isset($success[1])) { 
	if($success[1] == "success") { 
		$msg = 'Your category "'.$_SESSION['child_category_name'].'" was created!';
	}
	if($success[1] == "deleted") { 
		$msg = "Child category successfully deleted!";
	}
       if($success[1] == "edited") { 
		$msg = "Child category successfully updated!";
	}
?>
	<div class="alert alert-success">
		<button class="close fui-cross" data-dismiss="alert" type="button"></button>
		<?php echo $msg; ?>
	</div> 
<?php unset($_SESSION['child_category_name']); } ?>
<div class="btn_allUser" style="float:left;margin: 3px 0 0 550px;position: absolute;">
	<a href="categorychildadd" class="btn btn-primary btn-block" style="width:200px;background-color:#3498DB;">+ New Child</a>
</div>
<div class="clear"></div>
<div class="table-responsive">
<?php if(isset($categories) && empty($categories)){ ?>
<div class="row-fluid"><div class="span6"></div><div class="span6"><div class="search_fieald" id="example_filter"><label><input type="text" class="form-control" id="search-query-1" placeholder="Search" aria-controls="example"></label></div></div></div>
<?php } ?>
	<table class="table table-bordered" id="example">
		<thead>
		  <tr>
			<th width="70%" style="background-color:#666666; color:#FFFFFF;">Title</th>
			<th width="8%" style="background-color:#666666; color:#FFFFFF;">Ring Design</th>
			<th width="11%" style="background-color:#666666; color:#FFFFFF;">Status</th>
			<th width="11%" style="background-color:#666666; color:#FFFFFF;">Action</th>
		  </tr>
		</thead>
		<tbody>
		<?php if(isset($categories) && !empty($categories)){
		 foreach($categories as $catinfo) { ?>
		  <tr>
			<td><?php echo str_replace('\"', '', $catinfo['Category']['title']); ?></td>
			<td style="padding:10px 28px !important;"><a onmouseover="Javascript:showcolorring('colorring<?php echo $catinfo['Category']['id']; ?>');" onmouseout="javascript:hidecolorring('colorring<?php echo $catinfo['Category']['id']; ?>');"><img src="<?php echo Router::url('/', true); ?>img/colorring.png" border="0" width="50" /></a>
			<div class="tooltip fade top in" style="margin:-156px 0 0 -14.5px; display: none;width:75px;" id="colorring<?php echo $catinfo['Category']['id']; ?>">
				<span style="position:absolute;margin:6px 0 0 8px;"><font color="white">Ring Color</font></span>
<div class="tooltip-arrow" style="left:55.3%;"></div>
<div class="tooltip-inner" style="text-align:left;width:83px; height:86px;">
<img src="<?php echo Router::url('/', true); ?>img/badgedesign/<?php echo $catinfo['Category']['badgecolor']; ?>" border="0" width="83" height="57" style="border-radius:0 0 6px 6px;" />
</div>
			</div></td>
			<td><?php if($catinfo['Category']['status']=="0"){ echo "Inactive"; } else { echo "Active"; } ?></td>
			<td>
				<div class="navbar" style="margin-bottom:0 !important;min-height:0 !important;">
					<ul class="nav" style="top:110px;">
						<li> 
							<span class="fui-gear" style="color:#0077C9;"></span>
							<ul style="margin-left:-94px;margin-top:-142px;">
								<li style="cursor:default;color:#FFFFFF;padding:10px 0 5px 15px;">Actions:</li>
								<li><a href="categorychildedit/<?php echo $catinfo['Category']['id']; ?>">Edit child category</a></li>
								<li><a href="Javascript:childcatdelete('<?php echo $catinfo['Category']['id']; ?>');">Delete child category</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</td>
		  </tr>
		<?php } 
		} else { ?> 
		  <tr>
			<td colspan="4" style="text-align:center;">No child categories to list!!</td>
		  </tr>
		<?php } ?> 
		</tbody>  
    </table>
	
</div> 
</div>    
<!--right said end-->  