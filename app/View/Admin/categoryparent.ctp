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
<div class="container_left">
<h1>Parent Categories</h1>
<h3>Children belong to these.</h3>
<?php $success = explode('?',$_SERVER[ 'REQUEST_URI' ]); 
if(isset($success[1])) { 
	if($success[1] == "success") { 
		$msg = 'Your category "'.$_SESSION['parent_category_name'].'" successfully created!';
	}
	if($success[1] == "deleted") { 
		$msg = "Parent category successfully deleted!";
	}
       if($success[1] == "edited") { 
		$msg = "Parent category successfully updated!";
	}
?>
	<div class="alert alert-success">
		<button class="close fui-cross" data-dismiss="alert" type="button"></button>
		<?php echo $msg; ?>
	</div> 
<?php unset($_SESSION['parent_category_name']); } ?>
<div class="btn_allUser" style="float:left; margin:<?php if(isset($categories) && !empty($categories)){ ?>0px<?php } else { ?>-50px<?php } ?> 0 0 550px;position: absolute;">
	<a href="categoryparentadd" class="btn btn-primary btn-block" style="width:200px;background-color:#3498DB;">+ New Parent</a>
</div>
<div class="clear"></div>
<div class="table-responsive">
	<table class="table table-bordered" id="example">
		<thead>
		  <tr>
			<th width="77%" style="background-color:#666666; color:#FFFFFF;">Title</th>
			<th width="12%" style="background-color:#666666; color:#FFFFFF;">Status</th>
			<th width="11%" style="background-color:#666666; color:#FFFFFF;">Action</th>
		  </tr>
		</thead>
		<tbody>
		<?php if(isset($categories) && !empty($categories)){
		 foreach($categories as $catinfo) { ?>
		  <tr>
			<td><img width="30" height="30" class="image_aline" alt="" src="../img/catuploads/<?php echo $catinfo['Category']['decal']; ?>" style="background-color:#999999;" /> <?php echo str_replace('\"', '', $catinfo['Category']['title']); ?></td>
			<td><?php if($catinfo['Category']['status']=="0"){ echo "Inactive"; } else { echo "Active"; } ?></td>
			<td>
				<div class="navbar" style="margin-bottom:0 !important;min-height:0 !important;">
					<ul class="nav" style="top:110px;">
						<li> 
							<span class="fui-gear" style="color:#0077C9;"></span>
							<ul style="margin-left:-94px;margin-top:-142px;">
								<li style="cursor:default;color:#FFFFFF;padding:10px 0 5px 13px;">Actions:</li>
								<li><a href="categoryparentedit/<?php echo $catinfo['Category']['id']; ?>">Edit parent category</a></li>
								<li><a href="Javascript:parentcatdelete('<?php echo $catinfo['Category']['id']; ?>');">Delete parent category</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</td>
		  </tr>
		<?php } 
		} else { ?> 
		  <tr>
			<td colspan="3" style="text-align:center;">No parent categories to list!!</td>
		  </tr>
		<?php } ?> 
		</tbody>  
    </table>
	
</div> 
</div>    
<!--right said end-->  