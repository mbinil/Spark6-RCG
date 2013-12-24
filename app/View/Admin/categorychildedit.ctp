<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo Router::url('/app/webroot/color_pick/jscolor/jscolor.js',true); ?>"></script>
<script type="text/javascript">
function selectedpcat(id, count)
{
	removeallselection()
	$('#parentcat #'+id).removeClass("pcatindividual");
	$('#parentcat #'+id).addClass("pcatindividualselected");
	$('#parentcat #ccatparent').val(id);
}
function removeallselection()
{
	$('#parentcat div').removeClass("pcatindividualselected");
	$('#parentcat div').addClass("pcatindividual");
}
function badgecombo(img)
{
	var baseurl = $('#baseurl').val();
	$('#badgecombo').html('<img src="'+baseurl+'img/badgedesign/'+img+'" border="0" style="border-radius:100px; width:200px;" />');
	$('#comboimg').val(img);
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
/**
 * Calling the parent category dialogue...
 */
function getParentCategory()
{
    $('#pcattitle').val('');
    $('#fileuploaded').val('');
    $('#show_file_ul').html('');
        $( "#dialog-parent_category" ).dialog({
            height: 500,
            width:  885,
			title: "Create new parent category",
            modal: true
        });
}

/**
 * calling the color picker dialogue here
 */
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
	var baseurl = $('#baseurl').val();
	$( "#dialog-modal" ).dialog('close');
	$.ajax({  //Make the Ajax Request
	    type: "POST",  
	    url: baseurl+"ajax_createimage",
	    data: "val="+$('#color_code').val()+"&gradient=1",
	    async: false,
	    success: function(response) {//alert(response);
			var data    =   new Array();
			data        =   response.split('@#&');
	        if(data[0] != 0)
	        {
	            var div =  '<div style="float:left;padding:0px;margin:5px;"><div style="position: absolute; margin-left:66px; visibility: visible;" id="pbadgering'+data[1]+'"><a href="Javascript:deletebadgecombo(\''+data[1]+'\',\''+data[2]+'\');" style="margin:0px;"><img src="'+baseurl+'img/remove.png" border="0" /></a></div><a href="Javascript:badgecombo(\''+data[0]+'\',\''+data[1]+'\');" onmouseover="Javascript:showdeletecombo(\''+data[1]+'\');" onmouseout="Javascript:hidedeletecombo(\''+data[1]+'\');"><img src="'+baseurl+'img/badgedesign/'+data[0]+'" border="0" style="border-radius:100px; width:75px;" /></a></div>';					
	            $( ".image_listing" ).append(div);
	        }
	    } 
	});
}
function showdeletecombo(id)
{
	$("#pbadgering"+id).css("display","block");
}
function hidedeletecombo(id)
{
	$("#pbadgering"+id).css("display","block");
}
function deletebadgecombo(id,val,cat)
{
	var baseurl = $('#baseurl').val();
	var checkstr =  confirm('Are you sure you want to delete this user?');
    if(checkstr == true){
    	$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: baseurl+"badgecombo_delete",
			data: "id="+id+'&comboimg='+val+'&folder=badgedesign',  //data
			success: function(response) {
				if(response=='1')
				{
					//window.location = "../categorychildedit/"+cat;
					$('#pbadgering'+id).parent().remove()
				}
			} 
		});
    }
}
</script>
<!--Right said start-->  
<div class="sitemap_nav">
    <ul class="nav nav-pills">
      <li class="active"><a >Info</a></li>
      <li ><a >Save</a></li>
    </ul>
</div>
<div class="clear"></div>
<hr/>            
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
<div class="btn_next">
  <a href="javascript:savechildcatedit();" class="btn btn-primary btn-block">Save<span class="fui-arrow-right pull-right"></span></a>
</div>
<h1>Edit this child category</h1>
<h3>Be as specific as you can! </h3>
<div class="clear"></div>
<!----Error message div------------------>
  <div class="alert" id="alert_div" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
    <button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
    <span id="message_span"></span>	
  </div>
<!--------------------------------------->
<input type="hidden" id="baseurl" value="<?php echo Router::url('/', true); ?>" />
<!--discrption-->  
<div class="Difficulty_step1" style="width:100%; float:left;">
<div class="discrption_label" style="width:25% !important;">Child Category Name:</div>
<div class="clear"></div>
<input type="hidden" name="controller_action" id="controller_action" value="edit" />
<input type="hidden" value="<?php echo $ccatinfo[0]['Category']['id']; ?>" id="ccatid">
<input type="text" value="<?php echo str_replace('\"', '', $ccatinfo[0]['Category']['title']); ?>" placeholder="Child category name" class="form-control input-sm" id="ccattitle" onchange="javascript:checkavail(this.value,'Child','ccattitle');" onblur="javascript:validateFieldcheck(this.id,this.value);" style="width: 500px;">
<div class="clear"></div>
<div style="margin:10px 0 0 0;font-weight:bold;"><font size="3">Parent Category:</font></div>
<div id="parentcat" style="margin:10px 0; width:65%;">
	<?php $pccount = count($pcategories);  $i=0;foreach($pcategories as $pcat) { 
if($i==0) { ?>
    <div <?php if($ccatinfo[0]['Category']['parent']==$pcat['Category']['id']){ ?> class="pcatindividualselected"<?php } else { ?> class="pcatindividual" <?php } ?>id="<?php echo $pcat['Category']['id']; ?>" style="width:550px;margin-top:20px;height:102px;">
<?php } else { ?>
    <div <?php if($ccatinfo[0]['Category']['parent']==$pcat['Category']['id']){ ?> class="pcatindividualselected"<?php } else { ?> class="pcatindividual" <?php } ?>id="<?php echo $pcat['Category']['id']; ?>" style="width:550px;margin-top:30px;height:102px;">
<?php } ?>
		<a style="width:100%;" href="Javascript:selectedpcat('<?php echo $pcat['Category']['id']; ?>','<?php echo $pccount; ?>');">
<span style="width:250px;"><img width="100" border="0" src="<?php echo Router::url('/', true); ?>img/catuploads/<?php echo $pcat['Category']['decal']; ?>" style="background-color:#999999;"></span>

</a><div class="pcatindividual" style="width: 350px; padding-left: 130px; margin-top: -62px;"><?php echo str_replace('\"', '', $pcat['Category']['title']); ?></div>
	</div>
	<hr/>
	<?php $i++; } ?>
	<input type="hidden" value="<?php echo str_replace('\"', '', $ccatinfo[0]['Category']['parent']); ?>" id="ccatparent">
</div>
	<br/>
	<div class="discrption_label_right" style="float:left;margin-top: -20px; width:65%;">Need another parent category?<a href="javascript:getParentCategory();" >create one now</a></div>
	<hr/>
<div style="margin:10px 0 0 0; font-weight:bold;">Badge Design:</div>
<div style="width:100%;" align="center">
<div id="badgecolor" style="margin:10px 0;">
	
    <div id="badgecombo" style="float: left;border: 2px dashed #999999 !important;">
            <img src="<?php echo Router::url('/', true); ?>img/badgedesign/<?php echo $ccatinfo[0]['Category']['badgecolor']; ?>" border="0" style="border-radius:100px; width:200px;" />
        </div>
	<div style="margin:25px 0 0 220px;" align="left">Badge Ring Combo:</div>
	<div style="margin: 10px 0px 0px 215px; height: 173px;" align="left" class="image_listing">
	  <?php foreach($badgecombos as $badgecinfo) { ?>
	  <div style="float:left;<?php if($badgecinfo['Badgecombo']['comboimg']==$ccatinfo[0]['Category']['badgecolor']){ ?>border:1px solid #D8DCE0;border-radius:100px;padding:4px;margin:0px;<?php } else { ?>padding:0px;margin:5px;<?php } ?>">
		<div style="position: absolute; margin-left:66px; display: block;" id="pbadgering<?php echo $badgecinfo['Badgecombo']['id']; ?>"><?php $imgname = substr($badgecinfo['Badgecombo']['comboimg'], 0, -4); ?>
			<a href="Javascript:deletebadgecombo('<?php echo $badgecinfo['Badgecombo']['id']; ?>','<?php echo $imgname; ?>','<?php echo $ccatinfo[0]['Category']['id']; ?>');" style="margin:0px;"><img src="<?php echo Router::url('/', true); ?>img/remove.png" border="0" /></a>
		</div>
		<a href="Javascript:badgecombo('<?php echo $badgecinfo['Badgecombo']['comboimg']; ?>');"><img src="<?php echo Router::url('/', true); ?>img/badgedesign/<?php echo $badgecinfo['Badgecombo']['comboimg']; ?>" border="0" style="border-radius:100px; width:75px;" onmouseover="Javascript:showdeletecombo('<?php echo $badgecinfo['Badgecombo']['id']; ?>');" onmouseout="Javascript:hidedeletecombo('<?php echo $badgecinfo['Badgecombo']['id']; ?>');" /></a>
	  </div>
	  <?php } ?>
	</div>
	<div class="discrption_label_right" style="float: left; width: 100%;">Need another color? <a href="javascript:getDialogue();" >add one now</a></div>
	<input type="hidden" value="<?php echo $ccatinfo[0]['Category']['badgecolor']; ?>" id="comboimg">
</div>
</div>
<div class="clear"></div>
<div class="discrption_label" style="width:55px;">Status:</div>
<div class="switch-on switch-animate">
<input type="checkbox" data-toggle="switch" <?php if($ccatinfo[0]['Category']['status']!="0"){ ?>checked="checked" <?php } ?>  id="ccatstatus">
</div>
</div>
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
<div id="dialog-parent_category" style="display: none;" >
    <?php echo $this->element('categoryparentadd',array('mode'=>'Parent','rootpath'=> Router::url('/', true).'img/catuploads')); ?>
</div>