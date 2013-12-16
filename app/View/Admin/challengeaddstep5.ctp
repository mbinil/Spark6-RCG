<?php $newchallengeinfo = $this->Session->read("newchallengeinfo"); //print_r($newchallengeinfo); ?>
<link href="<?php echo Router::url('/app/webroot/file_upload/css/style.css',true); ?>" rel="stylesheet" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo Router::url('/app/webroot/color_pick/jscolor/jscolor.js',true); ?>"></script>
<script type="text/javascript">
    function badgecombo(img,id)
    {
        $('#badgecombo').html('<img src="../img/badgecolor/'+img+'" border="0" style="border-radius:100px; width:200px;" />');
        $('#comboimg').val(img);
        $('#badgecolor_hidden').val(id);
    }
    /*Field validation on blur of an input element*/
    function validateFieldcheck(id,val)
    {
		if(val == "" || val.length < 3)
		{
			$("#"+id).css("border-color", "red");
		}
		else
		{
			$("#"+id).css("border-color", "#BDC3C7");
		}
    }

    function getDialogue()
    {
		$( "#dialog-modal" ).dialog({
		  height: 240,
		  width:  485,
		  modal: true
		});
    }

    function getClose()
    {
		$( "#dialog-modal" ).dialog('close');
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "ajax_createimage",
			data: "val="+$('#color_code').val()+"&gradient=0",
			async: false,
			success: function(response) {
				
				var data    =   new Array();
				data        =   response.split('@#&');
				if(data[0] != 0)
				{
					var div =  '<div style="float:left;margin:5px;"><div style="position: absolute; margin-left:55px; visibility: hidden;" id="'+data[1]+'"><a href="Javascript:deletebadgecombo(\''+data[1]+'\',\''+data[2]+'\');" style="margin:0px;"><img src="../img/remove.png" border="0" /></a></div><a href="Javascript:badgecombo(\''+data[0]+'\',\''+data[1]+'\');" onmouseover="Javascript:showdeletecombo(\''+data[1]+'\');" onmouseout="Javascript:hidedeletecombo(\''+data[1]+'\');"><img src="../img/badgecolor/'+data[0]+'" border="0" style="border-radius:100px; width:75px;" /></a></div>'; 
					$( ".image_listing" ).append(div);
				}
			} 
		});
    }
    function showdeletecombo(id)
    {
        $("#"+id).css("visibility","visible");
    }
    function hidedeletecombo(id)
    {
        $("#"+id).css("visibility","visible");
    }
    function deletebadgecombo(id,val)
    {
		var checkstr =  confirm('Are you sure you want to delete this user?');
		if(checkstr == true){
			$.ajax({  //Make the Ajax Request
				type: "POST",  
				url: "badgecombo_delete",
				data: "id="+id+'&comboimg='+val+'&folder=badgecolor',  //data
				success: function(response) {
					if(response=='1')
					{
						$('#'+id).parent().remove()
					}
				} 
			});
		}
    }
</script>
<!--Right said start-->
<div class="sitemap_nav" style="width:100%;">
    <ul class="nav nav-pills">
      <li><a href="<?php echo Router::url('/', true); ?>admin/challengeaddstep1">About the challenge</a></li>
      <li><a href="<?php echo Router::url('/', true); ?>admin/challengeaddstep2">Categories & Duration</a></li>
      <li><a href="<?php echo Router::url('/', true); ?>admin/challengeaddstep3">Tags & Eligibility</a></li>
	  <li><a href="<?php echo Router::url('/', true); ?>admin/challengeaddstep4">Notifications & Difficulty</a></li>
	  <li class="active"><a href="<?php echo Router::url('/', true); ?>admin/challengeaddstep5">Image & Color</a></li>
      <li><a>SAVE</a></li>
    </ul>
</div>
<div class="clear"></div>
<hr/>  
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
  <div class="btn_next"> <a href="javascript:challemgeSave();" class="btn btn-primary btn-block">Save<span class="fui-arrow-right pull-right"></span></a> </div>
  <h1>Hero Image and Badge Color</h1>
  <h3>Choose the image for this Challenge and the color of the badge.</h3>
  <div class="clear">&nbsp;</div>
<!----Error message div------------------>
  <div class="alert" id="alert_div" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
    <button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
    <span id="message_span"></span>	
  </div>
<!--------------------------------------->
    <!--discrption-->
	<div class="Difficulty_step1" style="width:100%; float:left;">
		<div class="discrption_label"><h2>Hero Image</h2></div>
		<div class="clear">&nbsp;</div>
		<div class="discrption_label_right" style="margin:0 360px 0 0;">710 * 480 .png or .jpeg</div>
		<!--drag & drop starting here-->
			<form id="upload" method="post" action="challenge_uploads" enctype="multipart/form-data">
				<input type="hidden" name="controller_action" id="controller_action" value="add" />
				<input type="hidden" name="fileuploaded_session_name" id="fileuploaded_session_name" value="challenge_add_file_upload_name" />
				<input type="hidden" name="fileuploaded" id="fileuploaded" />
				<input type="hidden" name="root_path" id="root_path" value="<?php echo Router::url('/app/webroot/img/challengeuploads', true); ?>" />
				<input type="hidden" name="image_rand_num" id="image_rand_num" value="<?php echo $image_prepend_random_number; ?>" />
				<div id="drop" style="background-color: white;width:705px;height:160px;"> <br/>
					<img src="../img/default_banner.png" alt='IMAGE' />
					<br/>
					drop user icon<br/>
					You can also <a style="text-decoration: underline; color:#999999;">browse for a file</a>
					<input type="file" name="upl" />
				</div>
				<ul id="show_file_ul" style="width:480px;margin:0 -20px;">
				<!-- The file uploads will be shown here -->
				</ul>
			</form>
		<!--drag & drop ends here-->
		<div class="clear"></div>
		<hr/>
		<!--badge color creation starts here-->
		<div style="margin:50px 0 0 0;">Badge Color:</div>
		<div style="width:100%;" align="center">
			<div id="badgecolor" style="margin: 10px 0px; height: 235px;">
				<div id="badgecombo" style="float: left;border: 2px dashed #999999 !important;">
					<img src="../img/badgecolor/space_ship.png" border="0" style="border-radius:100px; width:200px;" />
				</div>
				<div style="float: left; position: absolute; margin: 210px 0px 0px; width: 205px; text-align: center;"><?php echo $newchallengeinfo['badge_title'];?></div>
				<div style="float:left;margin:55px 0 25px 15px;" align="left" class="image_listing">
				<?php if(count($badgecombos) > 0) { ?>
					<?php foreach($badgecombos as $badgecinfo) { ?>
						<div style="float:left;margin:5px;">
						<div style="position: absolute; margin-left:66px; visibility: visible;" id="<?php echo $badgecinfo['Badgecombo']['id']; ?>"><?php $imgname = substr($badgecinfo['Badgecombo']['comboimg'], 0, -4); ?>
						<a href="Javascript:deletebadgecombo('<?php echo $badgecinfo['Badgecombo']['id']; ?>','<?php echo $imgname; ?>');" style="margin:0px;"><img src="../img/remove.png" border="0" /></a>
						</div>
						<a href="Javascript:badgecombo('<?php echo $badgecinfo['Badgecombo']['comboimg']; ?>','<?php echo $badgecinfo['Badgecombo']['id']; ?>');" onmouseover="Javascript:showdeletecombo('<?php echo $badgecinfo['Badgecombo']['id']; ?>');" onmouseout="Javascript:hidedeletecombo('<?php echo $badgecinfo['Badgecombo']['id']; ?>');"><img src="../img/badgecolor/<?php echo $badgecinfo['Badgecombo']['comboimg']; ?>" border="0" style="border-radius:100px; width:75px;" /></a>
						</div>
				   <?php } ?>
				<?php } ?>
				</div>
				<div class="discrption_label_right" style="float:left;padding-right:670px;">Need another color? <a href="javascript:getDialogue();" >add one now</a></div>
				<input type="hidden" value="" id="comboimg">
				<input type="hidden" value="" id="badgecolor_hidden">
			</div>
		</div>
		<div class="clear"></div>	
		<!--badge color creation ends here-->
		<div class="btn_next" > 
			<a href="javascript:challemgeSave();" class="btn btn-primary btn-block">Save<span class="fui-arrow-right pull-right"></span></a> 
		</div>
	</div>
    <!---->
    <!--discrption end-->
</div>
<!--right said end-->
<div id="dialog-modal" style="display: none;" >
  <form method="post">
    Click here:
    <input class="color" name="color_code" id="color_code" style="width:230px;">
    <input type="button" name="submit" value="SELECT" onclick="getClose()" style="width:100px;"/>
  </form>
</div>
<!-- JavaScript Includes -->
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.knob.js',true); ?>"></script>
<!-- jQuery File Upload Dependencies -->
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.ui.widget.js',true); ?>"></script>
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.iframe-transport.js',true); ?>"></script>
<script src="<?php echo Router::url('/app/webroot/file_upload/js/jquery.fileupload.js',true); ?>"></script>
<!-- Our main JS file -->
<script src="<?php echo Router::url('/app/webroot/file_upload/js/script.js',true); ?>"></script>