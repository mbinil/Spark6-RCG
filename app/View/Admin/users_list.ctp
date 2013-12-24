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
<h1>Users</h1>
<h3>These are all the folks using the site.</h3>
<?php $success = explode('?',$_SERVER[ 'REQUEST_URI' ]); 
if(isset($success[1])) { 
	
	if($success[1] == "deleted") { 
		$msg = "User successfully deleted!";
	}
	if($success[1] == "edited") { 
		$msg = "User successfully updated!";
	}
?>
	<div class="alert alert-success">
		<button class="close fui-cross" data-dismiss="alert" type="button"></button>
		<?php echo $msg; ?>
	</div> 
<?php }?>
<div class="clear"></div>
<div class="table-responsive">
<?php if(isset($users) && empty($users)){ ?>
<div class="row-fluid"><div class="span6"></div><div class="span6"><div class="search_fieald" id="example_filter"><label><input type="text" class="form-control" id="search-query-1" placeholder="Search" aria-controls="example"></label></div></div></div>
<?php } ?>
	<table class="table table-bordered" id="example">
		<thead>
		  <tr>
			<th width="42%" style="background-color:#666666; color:#FFFFFF;">Username</th>
			<th width="20%" style="background-color:#666666; color:#FFFFFF;">Total Points</th>
			<th width="20%" style="background-color:#666666; color:#FFFFFF;">Last Visit</th>
			<th width="9%" style="background-color:#666666; color:#FFFFFF;">Status</th>
			<th width="9%" style="background-color:#666666; color:#FFFFFF;">Action</th>
		  </tr>
		</thead>
		<tbody>
		<?php
		$i=0;
		 if(isset($users) && !empty($users)){
		 foreach($users as $user) { 
		 if($user['User']['user_active']==1)
		 {
		 $status="Active";
		 }
		 else
		 {
		 $status="Inactive";
		 }

		 $today = time();    
		 $createdday= strtotime($user['User']['user_last_login']); //mysql timestamp of when post was created  
		 $datediff = abs($today - $createdday);  
		 $difftext="";  
		 $years = floor($datediff / (365*60*60*24));  
		 $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));  
		 $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));  
		 $hours= floor($datediff/3600);  
		 $minutes= floor($datediff/60);  
		 $seconds= floor($datediff);  
		 //year checker  
		 if($difftext=="")  
		 {  
		   if($years>1)  
			$difftext=$years." years ago";  
		   elseif($years==1)  
			$difftext=$years." year ago";  
		 }  
		 //month checker  
		 if($difftext=="")  
		 {  
			if($months>1)  
			$difftext=$months." months ago";  
			elseif($months==1)  
			$difftext=$months." month ago";  
		 }  
		 //month checker  
		 if($difftext=="")  
		 {  
			if($days>1)  
			$difftext=$days." days ago";  
			elseif($days==1)  
			$difftext=$days." day ago";  
		 }  
		 //hour checker  
		 if($difftext=="")  
		 {  
			if($hours>1)  
			$difftext=$hours." hours ago";  
			elseif($hours==1)  
			$difftext=$hours." hour ago";  
		 }  
		 //minutes checker  
		 if($difftext=="")  
		 {  
			if($minutes>1)  
			$difftext=$minutes." minutes ago";  
			elseif($minutes==1)  
			$difftext=$minutes." minute ago";  
		 }  
		 //seconds checker  
		 if($difftext=="")  
		 {  
			if($seconds>1)  
			$difftext=$seconds." seconds ago";  
			elseif($seconds==1)  
			$difftext=$seconds." second ago";  
		 }  
		 // echo " | ".$difftext;  
		 $i++;?>
		  <tr>
			<td><?php echo $user['User']['user_email']; ?></td>
			<td><?php echo $user['User']['user_points']; ?></td>
			<td><?php echo $difftext; ?></td>
			<td><?php echo $status; ?></td>
			<td>
				<div class="navbar" style="margin-bottom:0 !important;min-height:0 !important;">
					<ul class="nav" style="top:110px;">
						<li> 
							<span class="fui-gear" style="color:#0077C9;"></span>
							<ul style="margin-left:-94px;margin-top:-142px;">
								<li style="cursor:default;color:#FFFFFF;padding:10px 0 5px 13px;">Actions:</li>
								<li><a href="user_edit/<?php echo $user['User']['id']; ?>">Edit User</a></li>
								<li><a href="Javascript:user_delete('<?php echo $user['User']['id']; ?>');">Delete User</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</td>
		  </tr>
		<?php } 
		} else { ?> 
		  <tr>
			<td colspan="5" style="text-align:center;">No User's to list!!</td>
		  </tr>
		<?php } ?> 
		</tbody>  
    </table>
	</div> 
</div>    
<!--right said end-->  