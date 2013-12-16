<!--Right said start-->           
<div class="container_left">
<h1>You are logged in as <?php echo $this->Session->read("username"); ?></h1>
<br/>
<?php echo $this->html->link("Logout",array("action"=>"../admin/logout")); ?> 
</div>    
<!--right said end-->  