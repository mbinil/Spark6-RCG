function showChallenge(ob,from,evt,id)
{
    var data_arr    =   new Array();
    switch(from)
    {
        case 'parent':
                        $('#parenthiddn').val(id);
                        data_arr    =   getResult('from=parent&val='+id+'&parent=').split('@#@');
                        if(data_arr[0] == 1)
                        {
                            data_arr[1] =   data_arr[1]?data_arr[1]:'<div align="center">No Challenges Found...</div>';
                            $('#challenge_total_div').html(data_arr[1]);
                            $('#child_category_side_nav').html(data_arr[2]);
                        }
                        break;
        case 'child':
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

                        if(charCode == 13 || search_keyword)
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