<div id="main">
<input type="hidden" id="challenge_id" value="<?php echo $challenge_id;?>"/>
	<div id="show_host_div"> 
			<!----Error message div------------------>
			<div class="alert" id="alert_div1" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
				<button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
				<span id="message_span1"></span>	
			</div>
			<!--------------------------------------->           
			<div class="host_challenge_step1">
				<div style="margin:0px; width:100%; float:left;">
<?php if($show_host_array && count($show_host_array) > 0) {
$i          =   0;
$fullurl    =   Router::url('/', true);
foreach ($show_host_array as $key => $value) 
{
    $user_html      =   '';
    if($i   ==  0)
    { ?>
        <div class="row">
<?php }
    if($i%4 == 0 && $i != 0)
    {?>
        </div><div class="row">
<?php    } ?>

<div onclick="selectUser('<?php echo $value['user']['id'];?>','<?php echo $value['Userchallenge']['group_id']; ?>')" id="select_user_div_<?php echo $value['user']['id'];?>" style="margin:2px 0 2px 15px; width:150px; height:250px; float:left;border: 2px solid #BDC3C7;" class="col-xs-6 col-md-3">
<img height="100" width="100" border="0" src="<?php echo $fullurl;?>img/useruploads/<?php echo $value['user']['user_profile_picture'];?>" alt="Image">
<input type="hidden" name="selected_users_list[]" id="selected_users_list_<?php echo $value['user']['id']; ?>" class="selected_users_list_class" value="" />
<input type="hidden" name="selected_users_group[]" id="selected_users_group_<?php echo $value['user']['id']; ?>" class="selected_users_group_class" value="" />
<br/>
<?php echo ucfirst(substr($value['user']['user_firstname'],0,10));?>
<n/>
<?php echo ucfirst(substr($value['user']['user_hobbies'],0,10));?><n/>
</div>

<?php    $i++;
}
if($i > 0)
    ?>
</div>
<?php } else { ?>
    <div class="lightbox-holder">
        <div align="center" class="add_partcipants">No open groups to list</div>
    </div>
<?php } ?>
				</div>
			</div>
		</div>   
		<div class="clear"></div>
<?php if($show_host_array && count($show_host_array) > 0) { ?>
<div class="btn_next">
    <a class="btn btn-primary btn-block" href="javascript:void(0);" onclick="pick_host()" >Save<span class="fui-arrow-right pull-right"></span></a>
</div>
<?php } ?>
		<br /> 
</div>
<script>

function selectUser(user_id,group_id)
{
    if(!$.trim($('#selected_users_list_'+user_id).val()))
    {
        $('#selected_users_list_'+user_id).val(user_id);
        $('#selected_users_group_'+user_id).val(group_id);
        $('#select_user_div_'+user_id).attr('style', 'margin:2px 0 2px 15px; width:150px; height:250px; float:left;border: 2px solid #BDC3C7;background-color:#8faf68;');
    }
    else
    {
        $('#selected_users_list_'+user_id).val('');
        $('#selected_users_group_'+user_id).val('');
        $('#select_user_div_'+user_id).attr('style', 'margin:2px 0 2px 15px; width:150px; height:250px; float:left;border: 2px solid #BDC3C7;');
    }
}

function pick_host()
{
    var url         =   $('#baseurl').val();alert(url);
    var host_group  =   '';
    var host_val    =   '';
    var i           =   0;
    $('.selected_users_list_class').each(function(){
        if($(this).val())
        {
            i++;
        }
    });
    if(i == 0)
    {
        $('#message_span1').html('Please select a host!!');
        $('#alert_div1').show();
    }
    else if(i > 1)
    {
        $('#message_span1').html('Please select only one host!!');
        $('#alert_div1').show();
    }
    else
    {
        $('.selected_users_list_class').each(function(){
            if($(this).val())
            {
                if(!host_val)
                    host_val    =   $(this).val();
            }
        });
        $('.selected_users_group_class').each(function(){
            if($(this).val())
            {
                if(!host_group)
                    host_group    =   $(this).val();
            }
        });

        $('#alert_div1').hide();
        var challenge_id    =   $('#challenge_id').val();
        $.ajax({  //Make the Ajax Request
                type: "POST",  
                url: url+"challenges/ajax_pick_host",
                data: "user_id="+host_val+"&challenge_id="+challenge_id+"&host_group="+host_group,
                async:false,
                success: function(response) {alert(response);
                        if(response=='1')
                        {
                            window.location = url+"challenges/discover";
                        }
                        else
                        {
                            $('#message_span1').html('Some error occured while inserting the host!!');
                            $('#alert_div1').show();
                        }
                } 
        });
    }
}

</script>