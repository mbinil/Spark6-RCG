<!--Right said start-->
<?php echo $this->Html->script('jqfunction'); ?>

<div class="container_left">
  <h1>Alerts</h1>
  <h3>These are global messages with delevery methods set by the user.</h3>
  <div class="alert alert-success" style="display:none;" id="showalert">
    <button class="close fui-cross" data-dismiss="alert" type="button"></button>
    <div id="response"></div>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered" >
      <thead>
        <tr>
          <th  style="background-color:#666666; color:#FFFFFF;">Alert Name</th>
          <th  style="background-color:#666666; color:#FFFFFF;">Description</th>
          <th  style="background-color:#666666; color:#FFFFFF;">Frequency</th>
          <th style="background-color:#666666; color:#FFFFFF;">Copy</th>
        </tr>
      </thead>
      <tbody>
        <?php
if(count($alertslist)>0)
{	
	foreach($alertslist as $alert)
	{// printing all records in the challenge table
		
	?>
        <tr>
          <td><?php echo $alert['Alert']['title'];?></td>
          <td><div class="navbar" style="margin-bottom:0 !important;min-height:0 !important;">
              <ul class="nav" style="top:110px;">
                <li> <?php echo substr($alert['Alert']['description'],0,10);?>...<font style="color: #0077c9;">more</font>
                  <ul style="margin-left:-125px;margin-top:-142px; width:400px;">
                    <li style="cursor:default;color:#FFFFFF;padding:10px 0 5px 13px; min-height:100px;max-height:100px;"><?php echo $alert['Alert']['description'];?></li>
                  </ul>
                </li>
              </ul>
            </div></td>
          <td><div class="navbar" style="margin-bottom:0 !important;min-height:0 !important;">
              <ul class="nav" style="top:110px;">
                <li> <?php echo substr($alert['Alert']['frequency'],0,10);?>...<font style="color: #0077c9;">more</font>
                  <ul style="margin-left:-125px;margin-top:-142px; width:400px; " >
                    <li style="cursor:default;color:#FFFFFF;padding:10px 0 5px 13px;min-height:100px;max-height:100px;" id="test"><?php echo $alert['Alert']['frequency'];?></li>
                  </ul>
                </li>
              </ul>
            </div></td>
          <td><div class="navbar" style="margin-bottom:0 !important;min-height:0 !important;">
              <ul class="nav" style="top:110px;" id="nav_test">
                <li> <?php echo substr($alert['Alert']['copy'],0,10);?>...<font style="color: #0077c9;">more</font>
                  <ul style="margin-left:-125px;margin-top:-142px; width:400px;" id="test" >
                    <li style="color:#FFFFFF;padding:10px;min-height:100px;max-height:150px;" class='inlineEdit' id='<?php echo $alert['Alert']['id'];?>'><?php echo $alert['Alert']['copy'];?></li>
                  </ul>
                </li>
              </ul>
            </div></td>
        </tr>
        <?php } 
		} else { ?>
        <tr>
          <td colspan="6" style="text-align:center;">No alerts to list!!</td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
<!--right said end-->
<style>
.edit {
	background-color: #FFF;
	border: 2px solid #000;
	margin:2px;
}
.save, .btnCancel {
	margin:0px 0px 0 5px;
    float:left;
}
#nav_test  li ul li  {
	background-image:url(../img/edit.png);
	background-repeat:no-repeat;
    background-position:bottom right;
	padding:5px;
	cursor:pointer;
}
.navbar .nav ul li:last-child {
    border-radius: 6px !important;
}
.save, .btnCancel {
	margin:0px 0px 0 0px;
	width:62px;
	float:left;
}
.revert
{
	width:72px;
	float:left;
}
.navbar .nav > li > ul:before {
    left: 190px !important;
}
</style>