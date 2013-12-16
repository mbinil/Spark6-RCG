$(function(){

    var ul = $('#upload ul');

    $('#drop a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        /**
         * disable_second_file_browser used to prevent the second time generation of file browser.
         * disable_second_file_browser  =   0   enabling file browser
         * disable_second_file_browser  =   1   disabling file browser
         */
        if(disable_second_file_browser == 0)
        {
            $(this).parent().find('input').click();
            disable_second_file_browser    =   1;
        }
        else
            disable_second_file_browser    =   0;
        
    });

    // Initialize the jQuery File Upload plugin
    $('#upload').fileupload({

        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {

            var root_path = $("#root_path").val();
            
            var tpl = $('<li class="working"><img width="60" height="60" id="dropimagediv"><p style="width:auto !important;"></p><input class="dial" type="text" value="100" data-width="48" data-height="48"'+
                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" data-displayInput="1" data-displayPrevious="1" /><span></span></li>');

                 
if(!$('#fileuploaded').val()) {
            // Add the HTML to the UL element
            data.context = tpl.appendTo(ul);
}

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Append the file name and file size
            tpl.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');
            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){

                if(tpl.hasClass('working')){
                    jqXHR.abort();
                }
				var url	=	'';
				if($('#controller_action').val() == 'edit')
					url	=	'../ajax_removefilename';
				else
					url	=	'ajax_removefilename';
		disable_second_file_browser =   0;			
                $.ajax({  //Make the Ajax Request
			type: "POST",  
			url: url,
			data: "file_session_name="+$('#fileuploaded_session_name').val(),  //data
                        success: function(response) {
			} 
		});
$('#fileuploaded').val('');
                tpl.fadeOut(function(){
                    tpl.remove();
                });

            });
if(!$('#fileuploaded').val()) {
            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();

            $('#fileuploaded').val(data.files[0].name);
}
            
            
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();

            if(progress == 100){
                data.context.removeClass('working');
                callFun(data);
            }
        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
        }

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }
	
	function callFun(data)
	{
		var dotCounter = 0;
		var intId = setInterval(addDot,1000);
		function addDot()
		{
			if (dotCounter < 5) 
			{
				dotCounter++;
				var root_path 	=   $("#root_path").val();
				var rand_num    =   '';
				if($('#image_rand_num').val())
				{
						rand_num = $('#image_rand_num').val();
						document.getElementById("dropimagediv").src = root_path+'/'+rand_num+data.files[0].name;
				}
				else
				{
						document.getElementById("dropimagediv").src = root_path+'/'+data.files[0].name;
				}
			}
			else 
			{
				clearInterval(intId);  
			}
		}
	}

});