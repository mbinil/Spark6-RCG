
function selectUser(user_id)
{
    if(!$.trim($('#selected_users_list_'+user_id).val()))
    {
        $('#selected_users_list_'+user_id).val(user_id);
        $('#select_user_div_'+user_id).attr('style', 'margin:5px 2px 5px 5px; width:150px; height:250px; float:left;border: 1px solid #EEE;background-color:#8faf68;');
    }
    else
    {
        $('#selected_users_list_'+user_id).val('');
        $('#select_user_div_'+user_id).attr('style', 'margin:5px 2px 5px 5px; width:150px; height:250px; float:left;border: 1px solid #EEE;');
    }
}

function host_challenge_step1(from)
{
    var url         =   from?'':'../';
    var val_flag    =   0;
    var host_val    =   '';
    $('.selected_users_list_class').each(function(){
        if($(this).val())
        {
            val_flag    =   1;
            host_val    =   host_val +   $(this).val() + ",";
        }
    });
    
    if(val_flag == 0)
    {
        $('#message_span').html('Please select a host!!');
        $('#alert_div').show();
    }
    else
    {
        $('#alert_div').hide();
        var challenge_id    =   $('#challenge_id').val();
        $.ajax({  //Make the Ajax Request
                type: "POST",  
                url: url+"ajax_host_challenge_step1",
                data: "host_val="+host_val+"&challenge_id="+challenge_id+"&step="+$('#step').val()+"&from="+from,
                async:false,
                success: function(response) {
                        if(response=='1')
                        {
                            window.location = url+from+"host_challenge_step2";
                        }
                        else
                        {
                            if(from)
                            {
                                $( "#dialog_host_this" ).html(response);
                                $( "#datepicker-from" ).datepicker({ minDate: 0}).datepicker('show');
                            }
                        }
                } 
        });
    }
}

function changecheck1(ob)
{
    if($(ob).val() == 1)
    {
        $(ob).val(0);
    }
    else
    {
        $(ob).val(1);
    }
        
}
function changecheck2(ob)
{
    if($(ob).val() == 1)
    {
        $(ob).val(0);
    }
    else
    {
        $(ob).val(1);
    }
        
}

function host_challenge_save(from)
{
    var chalngbegining      =   getDateFormat($('#datepicker-from').datepicker('getDate'));
    var time_host           =   $('#time_host').val();
    var check1              =   $('#check1').val();
    var check2              =   $('#check2').val();
    
    var message_id          =   'message_span';
    var alert_id            =   'alert_div';
    var url                 =   '';
    if(from)
    {
        message_id  =   'message_span_dialogue';
        alert_id    =   'alert_div_dialogue';
        url         =   '../';
    }
    
    if(!chalngbegining)
    {
        $('#'+message_id).html('Please select a date!!');
        $('#'+alert_id).show();
    }
    if(!time_host)
    {
        $('#'+message_id).html('Please select a time!!');
        $('#'+alert_id).show();
    }
    
    if( chalngbegining && time_host )
    {
        $.ajax({  //Make the Ajax Request
                type: "POST",  
                url: "ajax_host_challenge_add",
                data: "chalngbegining="+chalngbegining+"&time_host="+time_host+"&check1="+check1+"&check2="+check2,
                async:false,
                success: function(response) {
                        if(response=='1')
                        {
                            window.location = url+"discover";
                        }
                } 
        });
    }
    
    
}