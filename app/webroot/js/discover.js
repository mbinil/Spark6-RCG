function showChallenge(ob,from,evt,id)
{
    var data_arr    =   new Array();
    switch(from)
    {
        case 'parent':
			$('#parenthiddn').val(id);
			
			$('li.parent_class').each(function(){
				$(this).find('a').attr('class','');
			});
			if(!id)
				$('#all_li_id a').attr('class','active');
			else
				$(ob).attr('class','active');
			
			data_arr    =   getResult('from=parent&val='+id+'&parent=').split('@#@');
			if(data_arr[0] == 1)
			{
				data_arr[1] =   data_arr[1]?data_arr[1]:'<div align="center">No Challenges Found...</div>';
				$('#challenge_total_div').html(data_arr[1]);
				$('#child_category_side_nav').html(data_arr[2]);
			}
			break;
        case 'child':
			$('.child_class li').each(function(){
				$(this).attr('class','');
			});
			$(ob).parent().attr('class','active');
			
			data_arr    =   getResult('from=child&val='+id+'&parent='+$('#parenthiddn').val()).split('@#@');
			if(data_arr[0] == 1)
			{
				data_arr[1] =   data_arr[1]?data_arr[1]:'<div align="center">No Challenges Found...</div>';
				$('#challenge_total_div').html(data_arr[1]);
			}
			break;
        case 'search':
			var charCode        =   (evt.which) ? evt.which : event.keyCode
			var search_keyword  =   $(ob).val();

			if(charCode == 13 || search_keyword.length > 2)
			{
				data_arr    =   getResult('from=search&val='+search_keyword+'&parent=').split('@#@');
				if(data_arr[0] == 1)
				{
					data_arr[1] =   data_arr[1]?data_arr[1]:'<div align="center">No Challenges Found...</div>';
					$('#challenge_total_div').html(data_arr[1]);
					$('#child_category_side_nav').html(data_arr[2]);
				}
			}
			break;
    }
}

function getResult(data)
{
    var return_data =   '';
    $.ajax({
            type: "POST",  
            url: 'get_challenge',
            data: data,
            async:false,
            success: function(response) {//alert(response);
                return_data    =   response;
            } 
    });
    
    return return_data;
}

function pickAHost(challenge_id,user_id,permalink)
{
    $.ajax({
            type: "POST",  
            url: 'ajax_pick_a_host',
            data: "challenge_id="+challenge_id+"&user_id="+user_id,
            async:false,
            success: function(response) {
                if(response == 2)
                {
                    $('#message_span_discover').html('Already you are active in this challenge!!');
                    $('#alert_div_discover').show();
                }
                else if(response == 0)
                {
                    $('#message_span_discover').html('Some error occured while inserting the values!!');
                    $('#alert_div_discover').show();                    
                }
                else if(response == 3)
                {
                    $( "#dialog_host_this" ).dialog({
                        height: 840,
                        width:  1025,
                        title:'Host This',
                        modal: true
                    });
                    
                    $('#challenge_id').val(permalink);
                }
                else
                {
                    window.location = "discover";
                }
            } 
    });
}