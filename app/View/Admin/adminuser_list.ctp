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
  <h1>Admins</h1>
  <h3>These are floks who can administrate the site.</h3>
  <?php $success = explode('?',$_SERVER[ 'REQUEST_URI' ]); 
if(isset($success[1])) { 
	if($success[1] == "success") { 
		$msg = "New admin user was successfully created!";
	}
	if($success[1] == "deleted") { 
		$msg = "Admin user successfully deleted!";
	}
	if($success[1] == "edited") { 
		$msg = "Admin user successfully updated!";
	}
?>
  <div class="alert alert-success">
    <button class="close fui-cross" data-dismiss="alert" type="button"></button>
    <?php echo $msg; ?> </div>
  <?php }?>
  <div class="btn_allUser" style="float:left; margin:3px 0 0 550px;position: absolute;"> <a href="adminuser_add" class="btn btn-primary btn-block" style="width:200px;background-color:#3498DB;">+ New Admin</a> </div>
  <div class="clear"></div>
  <div class="table-responsive">
<?php if(isset($adminusers) && empty($adminusers)){ ?>
<div class="row-fluid"><div class="span6"></div><div class="span6"><div class="search_fieald" id="example_filter"><label><input type="text" class="form-control" id="search-query-1" placeholder="Search" aria-controls="example"></label></div></div></div>
<?php } ?>
    <table class="table table-bordered" id="example">
      <thead>
        <tr>
          <th width="50%" style="background-color:#666666; color:#FFFFFF;">Username</th>
          <th width="20%" style="background-color:#666666; color:#FFFFFF;">Role</th>
          <th width="20%" style="background-color:#666666; color:#FFFFFF;">Last Visit</th>
          <th width="5%" style="background-color:#666666; color:#FFFFFF;">Status</th>
          <th width="5%" style="background-color:#666666; color:#FFFFFF;">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
if(count($adminusers)>0)
{	
	foreach($adminusers as $adminuser)
	{// printing all records in the challenge table
		if($adminuser['Admin']['admin_user_active'] == 1)
		{
		   $status="Active";
		}
		else
		{
		   $status="Inactive";
		} 
		$adminusertypevalue=$adminuser['Admin']['admin_user_type'];
		if($adminusertypevalue==0)
		{
			$adminusertype='Admin';
		}
		else if($adminusertypevalue==1)
		{
			$adminusertype='Author';
		}
		else if($adminusertypevalue==2)
		{
			$adminusertype='Approver';
		}
		else if($adminusertypevalue==3)
		{
			$adminusertype='Brand Manager';
		}
	?>
        <tr>
          <td><?php echo $adminuser['Admin']['admin_user_name'];?></td>
          <td><?php echo $adminusertype; ?></td>
          <td><?php echo $adminuser['Admin']['admin_last_visit']; ?></td>
          <td><?php echo $status;?></td>
          <td>
				<div class="navbar" style="margin-bottom:0 !important;min-height:0 !important;">
					<ul class="nav" style="top:110px;">
						<li> 
							<span class="fui-gear" style="color:#0077C9;"></span>
							<ul style="margin-left:-94px;margin-top:-142px;">
								<li style="cursor:default;color:#FFFFFF;padding:10px 0 5px 13px;">Actions:</li>
								<li><a href="adminuser_edit/<?php echo $adminuser['Admin']['id']; ?>">Edit Admin</a></li>
								<li><a href="Javascript:adminuser_delete('<?php echo $adminuser['Admin']['id']; ?>');">Delete Admin</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</td>
        </tr>
        <?php } 
		} else { ?>
        <tr>
          <td colspan="6" style="text-align:center;">No Admin's to list!!</td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<!--right said end-->
