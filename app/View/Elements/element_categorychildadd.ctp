<script type="text/javascript" src="<?php echo Router::url('/app/webroot/color_pick/jscolor/jscolor.js',true); ?>"></script>
<script type="text/javascript">
    var parent_val   =   $('#chalngparent').val();
    var controller_action   =   $('#controller_action').val();
    var url_path    =   '';
    if(controller_action == 'edit')
        url_path    =   '../';
    

    $('#element_'+parent_val).attr('class','pcatindividualselected');
    $('#ccatparent').val(parent_val);

function elementselectedpcat(id, count)
{
    elementremoveallselection()
    $('#element_parentcat #element_'+id).removeClass("pcatindividual");
    $('#element_parentcat #element_'+id).addClass("pcatindividualselected");
    $('#element_parentcat #ccatparent').val(id);
}
function elementremoveallselection()
{
    $('#element_parentcat div').removeClass("pcatindividualselected");
    $('#element_parentcat div').addClass("pcatindividual");
}
function elementbadgecombo(img)
{
    $('#badgecombo').html('<img src="'+url_path+'../img/badgedesign/'+img+'" border="0" style="border-radius:100px; width:200px;" />');
    $('#comboimg').val(img);
}

/*Field validation on blur of an input element*/
function elementvalidateFieldcheck(id,val)
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
function elementgetParentCategory()
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
function elementgetDialogue()
{
	$( "#dialog-modal" ).dialog({
	  height: 250,
	  width:  1285,
          title: "Create badge design",
	  modal: true
	});
}
/**
 * while click on the submit button inside the dialogue box.
 */
function elementgetClose()
{
	$( "#dialog-modal" ).dialog('close');
	$.ajax({  //Make the Ajax Request
	    type: "POST",  
	    url: url_path+"ajax_createimage",
	    data: "color1="+$('#color_code1').val()+"&color2="+$('#color_code2').val()+"&color3="+$('#color_code3').val()+"&color4="+$('#color_code4').val()+"&gradient=1",
	    async: false,
	    success: function(response) {
                var data    =   new Array();
                data        =   response.split('@#&');
	        if(data[0] != 0)
	        {
				var div =  '<div style="float:left;padding:0px;margin:5px;"><div style="position: absolute; margin-left:66px; visibility: visible;" id="'+data[1]+'"><a href="Javascript:elementdeletebadgecombo(\''+data[1]+'\',\''+data[2]+'\');" style="margin:0px;"><img src="'+url_path+'../img/remove.png" border="0" /></a></div><a href="Javascript:elementbadgecombo(\''+data[0]+'\',\''+data[1]+'\');" onmouseover="Javascript:elementshowdeletecombo(\''+data[1]+'\');" onmouseout="Javascript:elementhidedeletecombo(\''+data[1]+'\');"><img src="'+url_path+'../img/badgedesign/'+data[0]+'" border="0" style="border-radius:100px; width:75px;" /></a></div>';
				
	            //var div =   '<div style="float:left;margin:5px;"><a href="Javascript:badgecombo(\''+data[0]+'\');"><img border="0" style="border-radius:100px; width:75px;" src="../img/badgedesign/'+data[0]+'"></a></div>';
	            $( ".image_listing" ).append(div);
	        }
	    } 
	});
}

function elementshowdeletecombo(id)
{
	$("#"+id).css("visibility","visible");
}
function elementhidedeletecombo(id)
{
	$("#"+id).css("visibility","visible");
}
function elementdeletebadgecombo(id,val)
{
	var checkstr =  confirm('Are you sure you want to delete this user?');
    if(checkstr == true){
    	$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: url_path+"badgecombo_delete",
			data: "id="+id+'&comboimg='+val+'&folder=badgedesign',  //data
			success: function(response) {
				if(response=='1')
				{
					//window.location = "categorychildadd";
					$('#'+id).parent().remove()
				}
			} 
		});
    }
}
/*Fetching values from step3 form. Appending to the session array and saving it.*/
function elementsavechildcat()
{	
	var ccattitle = $.trim($("#ccattitle").val());
	var ccatparent = $("#ccatparent").val();
	var comboimg = $("#comboimg").val();
	var ccatstatus = $('#ccatstatus').is(':checked');
        var return_flag =   0;
	if(ccattitle=="" || ccattitle.length < 3)
	{
            if(!ccattitle)
                $('#message_span').html('Child category name is required');
            else if(ccattitle.length < 3)
                $('#message_span').html('Child category name must be more than 3 characters');
            
            $('#alert_div').show();

            $("#ccattitle").css("border-color", "red");
            return_flag    =   1;
                
	}
        else
        {
            $.ajax({  //Make the Ajax Request
                type: "POST",  
                url: url_path+"ajax_checkavail",
                data: "checkavail="+ccattitle+"&mode=Child",  //data
                async:false,
                success: function(response) {
                        if(response=='1')
                        {
                            $("#ccattitle").css("border-color", "red");
                            $('#message_span').html('Child category name exist!!');
                            $('#alert_div').show();
                            return_flag    =   2;
                        }
                } 
            });
        }
	if(ccatparent=="")
	{
            $('#message_span').html('Select a parent category!!');
            $('#alert_div').show();
            return_flag    =   3;
	}
	if(comboimg=="")
	{
            $('#message_span').html('Select a badge ring combo!!');
            $('#alert_div').show();
            return_flag    =   4;	
	}
	if(ccattitle.length > 3 && ccatparent!="" && comboimg!="")
	{
            if(return_flag == 0)
            {
                $.ajax({  //Make the Ajax Request
			type: "POST",  
			url: url_path+"ajax_elementchildadd",
			data: "ccattitle="+ccattitle+"&ccatparent="+ccatparent+"&comboimg="+comboimg+"&ccatstatus="+ccatstatus, //data
			success: function(response) {
				var data    =   new Array();
                                data        =   response.split('@#@');
                                if(data[0] == '1')
                                {
                                    $( "#dialog-child_category" ).dialog('close');
                                    if(ccatparent == parent_val)//parent category id same as the selected in the dialogue and the coming id
                                    {
                                        $('#child_val')
                                            .append($("<option></option>")
                                            .attr("value",data[1])
                                            .text(ccattitle));
                                    }
                                }
                                else
                                {
                                    $('#message_span').html('Some error occured while inserting the child category!!');
                                    $('#alert_div').show();
                                }
			} 
		});
            }
	}
}
</script>
<!--Right said start-->
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
    <div class="btn_next"> <a href="javascript:elementsavechildcat();" class="btn btn-primary btn-block">Save<span class="fui-arrow-right pull-right"></span></a> </div>
<div class="clear"></div>
<!----Error message div------------------>
  <div class="alert" id="alert_div" style="background-color: red;border-color: red;color:#FFFFFF;width:700px;display:none;">
    <button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
    <span id="message_span"></span>	
  </div>
<!--------------------------------------->
<!--discrption-->
<div class="Difficulty_step1" style="width:100%; float:left;">
  <div class="discrption_label" style="width:25% !important;">Child Category Name:</div>
  <div class="clear"></div>
  <input type="hidden" name="controller_action" id="controller_action" value="add" />
  <input type="text" value="" placeholder="Child category name" class="form-control input-sm" id="ccattitle" onchange="javascript:checkavail(this.value,'Child','ccattitle');" onblur="javascript:elementvalidateFieldcheck(this.id,this.value);" style="width: 500px;">
  <div class="clear"></div>
  <div style="margin:10px 0 0 0;font-weight:bold; font-size:3;"><font size="3">Parent Category:</font></div>
  <div id="element_parentcat" style="margin:10px 0; width:65%;">
    <?php $pccount = count($pcategories);  $i=0;foreach($pcategories as $pcat) { 

if($i==0) { ?>
    <div class="pcatindividual" id="element_<?php echo $pcat['Category']['id']; ?>" style="width:550px;margin-top:20px;height:102px;">
      <?php } else { ?>
      <div class="pcatindividual" id="element_<?php echo $pcat['Category']['id']; ?>" style="width:550px;margin-top:30px;height:102px;">
        <?php } ?>
        <a style="width:100%;" href="Javascript:elementselectedpcat('<?php echo $pcat['Category']['id']; ?>','<?php echo $pccount; ?>');"> <span style="width:250px;"><img width="100" border="0" src="<?php echo $url_path;?>../img/catuploads/<?php echo $pcat['Category']['decal']; ?>"></span> </a>
        <div class="pcatindividual" style="width: 350px; padding-left: 130px; margin-top: -62px;"><?php echo str_replace('\"', '', $pcat['Category']['title']); ?></div>
      </div>
      <hr/>
      <?php $i++; } ?>
      <input type="hidden" value="" id="ccatparent">
    </div>
	<br/>
	<div class="discrption_label_right" style="float:left;margin-top: -20px; width:65%;">Need another parent category?<a href="javascript:elementgetParentCategory();" >create one now</a></div>
	<hr/>
    <div style="margin:50px 0 0 0; font-weight:bold;">Badge Design:</div>
    <div style="width:100%;" align="center">
      <div id="badgecolor" style="margin:10px 0;">
        <div id="badgecombo" style="float: left;border: 2px dashed #999999 !important;">
            <img src="../img/badgedesign/space_ship.png" border="0" style="border-radius:100px; width:200px;" />
        </div>
        <div style="margin:25px 0 0 220px;" align="left">Badge Ring Combo:</div>
        <div style="margin: 10px 0px 0px 215px; height: 173px;" align="left" class="image_listing">
          <?php foreach($badgecombos as $badgecinfo) { ?>
          <div style="float:left;padding:0px;margin:5px;">
		  	<div style="position: absolute; margin-left:66px; visibility: visible;" id="<?php echo $badgecinfo['Badgecombo']['id']; ?>"><?php $imgname = substr($badgecinfo['Badgecombo']['comboimg'], 0, -4); ?>
				<a href="Javascript:elementdeletebadgecombo('<?php echo $badgecinfo['Badgecombo']['id']; ?>','<?php echo $imgname; ?>');" style="margin:0px;"><img src="<?php echo $url_path;?>../img/remove.png" border="0" /></a>
			</div>
		  	<a href="Javascript:elementbadgecombo('<?php echo $badgecinfo['Badgecombo']['comboimg']; ?>');" onmouseover="Javascript:elementshowdeletecombo('<?php echo $badgecinfo['Badgecombo']['id']; ?>');" onmouseout="Javascript:elementhidedeletecombo('<?php echo $badgecinfo['Badgecombo']['id']; ?>');"><img src="<?php echo $url_path;?>../img/badgedesign/<?php echo $badgecinfo['Badgecombo']['comboimg']; ?>" border="0" style="border-radius:100px; width:75px;" /></a>
		  </div>
          <?php } ?>
        </div>
        <div class="discrption_label_right" style="float: left; width: 100%;">Need another color? <a href="javascript:elementgetDialogue();" >add one now</a></div>
        <input type="hidden" value="" id="comboimg">
      </div>
    </div>
    <div class="clear"></div>
    <div class="discrption_label" style="width:55px;">Status:</div>
    <div class="switch-on switch-animate">
      <input type="checkbox" data-toggle="switch" checked="checked" id="ccatstatus">
    </div>
  </div>
  <!--discrption end-->
</div>
<!--right said end-->
<div id="dialog-modal" style="display: none;" >
  <form method="post">
    Click here:
    <input class="color" name="color_code1" id="color_code1" style="width:230px;" value="">
    <input class="color" name="color_code2" id="color_code2" style="width:230px;" value="">
    <input class="color" name="color_code3" id="color_code3" style="width:230px;" value="">
    <input class="color" name="color_code4" id="color_code4" style="width:230px;" value="">
    
    <input type="button" name="submit" value="SELECT" onclick="elementgetClose()" style="width:100px;"/>
  </form>
</div>
<div id="dialog-parent_category" style="display: none;" >
    <?php echo $this->element('categoryparentadd',array('mode'=>'Parent','rootpath'=>'../../img/catuploads')); ?>
</div>