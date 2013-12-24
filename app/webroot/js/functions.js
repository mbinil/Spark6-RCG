var disable_second_file_browser =   0;//Flag to disable the second popuping of file browser.
/*===============*/
/*Difficulty type*/
/*===============*/

function uniformSearch(evt,ob)
{
    var charCode        =   (evt.which) ? evt.which : event.keyCode
    var search_keyword  =   $(ob).val();
    
    if(charCode == 13 && search_keyword)
    {
        var url =   $('#common_base_path').val();
        window.location = url+"searchresult/"+search_keyword;
    }
}

function changeNotification(need,id)
{
    $.ajax({  //Make the Ajax Request
            type: "POST",  
            url: "ajax_change_invitation",
            data: "need="+need+"&id="+id,  //data
            async:false,
            success: function(response) {
                alert(response);
            } 
    });
}
/*Fetching values from step1 form. Storing to session array and sending to step2*/
function gottostep2()
{
        var baseurl =   $('#baseurl').val();
	var difftitle = $.trim($("#difftitle").val());
	var diffdesp = $.trim($("#diffdesp").val());
        var step = $("#step").val();
	var diffstatus = $('#diffstatus').is(':checked');
	var return_flag =   0;
	if(diffdesp=="" || diffdesp.length < 3)
	{
		if(!diffdesp)
			$('#message_span').html('Please enter a difficulty description!!');
		else if(diffdesp.length < 3)
			$('#message_span').html('Difficulty description must be more than 3 characters!!');
		$('#alert_div').show();
		return_flag    =   1;			
		$("#diffdesp").css("border-color", "red");
	}
	else
	{
		$("#diffdesp").css("border-color", "#BDC3C7");
	}
	if(difftitle=="" || difftitle.length < 3)
	{
		if(!difftitle)
			$('#message_span').html('Please enter a difficulty title!!');
		else if(difftitle.length < 3)
			$('#message_span').html('Difficulty title must be more than 3 characters!!');
		$('#alert_div').show();
		return_flag    =   1;			
		$("#difftitle").css("border-color", "red");
	}
	else
	{
                $.ajax({  //Make the Ajax Request
                            type: "POST",  
                            url: baseurl+"admin/ajax_checkavail",
                            data: "checkavail="+difftitle+"&mode=Difficulty&flag=add",  //data
                            async:false,
                            success: function(response) {
                                    if(response=='1')
                                    {
                                            $('#message_span').html('Difficulty title already exist!!');
                                            $('#alert_div').show();
                                            $("#difftitle").css("border-color", "red");
                                            return_flag    =   2;
                                    }
                            } 
                });
		$("#difftitle").css("border-color", "#BDC3C7");
	}
	if(difftitle.length > 2 && diffdesp.length > 2 && return_flag ==   0)
	{
		$("#difftitle").css("border-color", "#BDC3C7");
		$("#diffdesp").css("border-color", "#BDC3C7");
		if(return_flag == 0)
		{
			$.ajax({  //Make the Ajax Request
				type: "POST",  
				url: "ajax_diffaddstep1",
				data: "difftitle="+difftitle+"&diffdesp="+diffdesp+"&diffstatus="+diffstatus+"&step="+step,  //data
				success: function(response) {
					if(response=='1')
					{
						window.location = "difficultyaddstep2";
					}
				} 
			});
		}
	}
}

/*Editing step 1 and sending the session array to step2*/
function editstep2()
{
        var baseurl =   $('#baseurl').val();
	var diffid = $('#diffid').val();
	var difftitle = $.trim($("#difftitle").val());
	var diffdesp = $.trim($("#diffdesp").val());
	var diffstatus = $('#diffstatus').is(':checked');
	var return_flag =   0;
	if(diffdesp=="" || diffdesp.length < 3)
	{
		if(!diffdesp)
			$('#message_span').html('Please enter a difficulty description!!');
		else if(diffdesp.length < 3)
			$('#message_span').html('Difficulty description must be more than 3 characters!!');
		$('#alert_div').show();
		return_flag    =   1;			
		$("#diffdesp").css("border-color", "red");
	}
        else
	{
		$("#diffdesp").css("border-color", "#BDC3C7");
	}
        if(difftitle=="" || difftitle.length < 3)
	{
		if(!difftitle)
			$('#message_span').html('Please enter a difficulty title!!');
		else if(difftitle.length < 3)
			$('#message_span').html('Difficulty title must be more than 3 characters!!');
		$('#alert_div').show();
		return_flag    =   1;			
		$("#difftitle").css("border-color", "red");
	}
        else
	{
                $.ajax({  //Make the Ajax Request
                            type: "POST",  
                            url: baseurl+"admin/ajax_checkavail",
                            data: "checkavail="+difftitle+"&mode=Difficulty&flag=edit&edit_id="+diffid,  //data
                            async:false,
                            success: function(response) {
                                    if(response=='1')
                                    {
                                            $('#message_span').html('Difficulty title already exist!!');
                                            $('#alert_div').show();
                                            $("#difftitle").css("border-color", "red");
                                            return_flag    =   2;
                                    }
                            } 
                });
		$("#difftitle").css("border-color", "#BDC3C7");
	}
	if(diffdesp.length > 2 && return_flag ==   0)
	{
		$("#diffdesp").css("border-color", "#BDC3C7");
		if(return_flag == 0)
		{
			$.ajax({  //Make the Ajax Request
				type: "POST",  
				url: "../ajax_diffeditstep1",
				data: "difftitle="+difftitle+"&diffdesp="+diffdesp+"&diffstatus="+diffstatus,  //data
				success: function(response) {
					if(response=='1')
					{
						window.location = "../difficultyeditstep2/"+diffid;
					}
				} 
			});
		}
	}
}

/*Fetching values from step2 form. Appending to the session array and sending to step3*/
function gottostep3()
{
	var diffmode = $("#diffmode").val();
    var step = $("#step").val();
	$.ajax({  //Make the Ajax Request
		type: "POST",  
		url: "ajax_diffaddstep2",
		data: "diffmode="+diffmode+"&step="+step,  //data
		success: function(response) {
			if(response=='1')
			{
				window.location = "difficultyaddstep3";
			}
		} 
	});
}

/*Editing step 2 and sending the session array to step3*/
function editstep3()
{
	var diffid = $('#diffid').val();
	var diffmode = $("#diffmode").val();
	$.ajax({  //Make the Ajax Request
		type: "POST",  
		url: "../ajax_diffeditstep2",
		data: "diffmode="+diffmode,  //data
		success: function(response) {
			if(response=='1')
			{
				window.location = "../difficultyeditstep3/"+diffid;
			}
		} 
	});
}

/*Fetching values from step3 form. Appending to the session array and saving it.*/
function gotosave()
{	
	var fileuploaded = $("#fileuploaded").val();
	if(fileuploaded=="")
	{
		$("#drop").attr('style',"width:105%;height:150px; border: 2px dashed #FF0000 !important;");
                $('#message_span').html('Decal can\'t be null!!');
		$('#alert_div').show();
	}
	else
	{
		var imgArray = ["gif","png"];
		var img_type = fileuploaded.slice(-3);
		var availableimgExt = $.inArray(img_type, imgArray);
		if(availableimgExt < 0)
		{
			$("#drop").attr('style',"width:105%;height:150px; border: 2px dashed #FF0000 !important;");
                        $('#message_span').html('Decal must be of type GIF or PNG!!');
                        $('#alert_div').show();
		}
		else
		{
			$("#drop").attr('style',"width:105%;height:150px; border: 2px dashed #999999 !important;");
			$.ajax({  //Make the Ajax Request
				type: "POST",  
				url: "ajax_diffaddstep3",
				data: "decal="+fileuploaded,
				success: function(response) {
					if(response=='1')
					{
						window.location = "difficulties?success";
					}
				} 
			});
		}
	}
}

/*Editing step 3 and saving it*/
function editsave()
{
	var diffid = $('#diffid').val();
	var fileuploaded = $("#fileuploaded").val()?$("#fileuploaded").val():$("#temp_fileuploaded").val();
	if(fileuploaded=="")
	{
		$("#drop").attr('style',"width:105%;height:150px; border: 2px dashed #FF0000 !important;");
	}
	else
	{
		var imgArray = ["gif","png"];
		var img_type = fileuploaded.slice(-3);
		var availableimgExt = $.inArray(img_type, imgArray);
		if(availableimgExt < 0)
		{
			$("#drop").attr('style',"width:105%;height:150px; border: 2px dashed #FF0000 !important;");
		}
		else
		{
			$("#drop").attr('style',"width:105%;height:150px; border: 2px dashed #999999 !important;");
			$.ajax({  //Make the Ajax Request
				type: "POST",  
				url: "../ajax_diffeditstep3",
				data: "diffid="+diffid+"&decal="+fileuploaded,
				success: function(response) {
					if(response=='1')
					{
						window.location = "../difficulties?edited";
					}
				} 
			});
		}
	}
}

/*Deleting the difficulty type*/
function diffdelete(id)
{
	var checkstr =  confirm('Are you sure you want to delete this difficulty type?');
    if(checkstr == true){
    	$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "difficultydelete",
			data: "diffid="+id,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "difficulties?deleted";
				}
			} 
		});
    }
}

/*===============*/
/*Parent Category*/
/*===============*/

/*Fetching values from step3 form. Appending to the session array and saving it.*/
function saveparentcat(flag)
{
	var pcattitle           =   $.trim($("#pcattitle").val());
	var pcatfileuploaded    =   $("#fileuploaded").val();
	var pcatstatus          =   $('#pcatstatus').is(':checked');
        var return_flag         =   0;
        
	if(pcattitle=="" || pcattitle.length < 3)
	{
		if(!pcattitle)
			$('#message_span').html('Please enter a parent category name!!');
		else if(pcattitle.length < 3)
			$('#message_span').html('Parent category name must be more than 3 characters!!');
		$('#alert_div').show();
		$("#pcattitle").css("border-color", "red");
		return_flag    =   1;
	}
	else
	{
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "ajax_checkavail",
			data: "checkavail="+pcattitle+"&mode=Parent&flag=add",  //data
			async:false,
			success: function(response) {
				if(response=='1')
				{
					$("#pcattitle").css("border-color", "red");
					$('#message_span').html('Parent category name already exist!!');
					$('#alert_div').show();
					return_flag    =   2;
				}
			} 
		});
	}
	if(pcatfileuploaded=="")
	{
		$('#message_span').html('Please select a decal image!!');
		$('#alert_div').show();
		$("#drop").attr('style',"width:105%;height:150px; border: 2px dashed #FF0000 !important;");
		return_flag    =   3;
	}
	else
	{
		var imgArray = ["gif","png"];
		var img_type = pcatfileuploaded.slice(-3);
		var availableimgExt = $.inArray(img_type, imgArray);
		if(availableimgExt < 0)
		{
			$('#message_span').html('Decal must be of type GIF or PNG');
			$('#alert_div').show();
			$("#drop").attr('style',"width:105%;height:150px; border: 2px dashed #FF0000 !important;");
			return_flag    =   4;
		}
		else
		{
			if(return_flag == 0)
			{
				var url	= '';
				if($('#controller_action').val() == 'edit')
					url	= '../ajax_parentadd';
				else
					url	= 'ajax_parentadd';
				$.ajax({  //Make the Ajax Request
					type: "POST",  
					url: url,
					data: "pcattitle="+pcattitle+"&pcatfileuploaded="+pcatfileuploaded+"&pcatstatus="+pcatstatus+"&"+flag+"="+flag, //data
					async:false,
					success: function(response) {
						if(response=='1')
						{
							window.location = "categoryparent?success";
						}
						else
						{
							var imgurl = '';
							if($('#controller_action').val() == 'edit')
									imgurl	=	'../../';
							else
									imgurl	=	'../';
							$( "#dialog-parent_category" ).dialog('close');
							var data    =   new Array();
							data    =   response.split('@#@');
							var html    =   '<div style="width:550px;margin-top:30px;height:102px;" id="'+data[0]+'" class="pcatindividual"><a href="Javascript:selectedpcat(\''+data[0]+'\',\''+data[1]+'\');" style="width:100%;"> <span style="width:250px;"><img width="100" border="0" src="'+imgurl+'img/catuploads/'+pcatfileuploaded+'"></span> </a><div style="width: 350px; padding-left: 130px; margin-top: -62px;" class="pcatindividual">'+pcattitle+'</div></div><hr/>';
							$('#parentcat').append(html);
						}
					} 
				});
			}
		}
	}
}

/*Editing step3 and saving it.*/
function saveparentcatedit()
{	
	var pcatid              =   $("#pcatid").val();
	var pcattitle           =   $.trim($("#pcattitle").val());
	var pcatfileuploaded    =   $("#fileuploaded").val()?$("#fileuploaded").val():$("#temp_fileuploaded").val();
	var pcatstatus          =   $('#pcatstatus').is(':checked');
        var return_flag         =   0;
        
        if(pcattitle=="" || pcattitle.length < 3)
	{
		if(!pcattitle)
			$('#message_span').html('Please enter a parent category name!!');
		else if(pcattitle.length < 3)
			$('#message_span').html('Parent category name must be more than 3 characters!!');
		$('#alert_div').show();
		$("#pcattitle").css("border-color", "red");
		return_flag    =   1;
	}
	else
	{
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "../ajax_checkavail",
			data: "checkavail="+pcattitle+"&mode=Parent&flag=edit&edit_id="+pcatid,  //data
			async:false,
			success: function(response) {
				if(response=='1')
				{
					$("#pcattitle").css("border-color", "red");
					$('#message_span').html('Parent category name already exist!!');
					$('#alert_div').show();
					return_flag    =   2;
				}
			} 
		});
	}
	if(pcatfileuploaded=="")
	{
		$('#message_span').html('Please select a decal image!!');
		$('#alert_div').show();
		$("#drop").attr('style',"width:105%;height:150px; border: 2px dashed #FF0000 !important;");
		return_flag    =   3;
	}
	else
	{
		var imgArray = ["gif","png"];
		var img_type = pcatfileuploaded.slice(-3);
		var availableimgExt = $.inArray(img_type, imgArray);
		if(availableimgExt < 0)
		{
			$("#drop").attr('style',"width:105%;height:150px; border: 2px dashed #FF0000 !important;");
			$('#message_span').html('Decal must be of type GIF or PNG!!');
			$('#alert_div').show();
			return_flag    =   4;
		}
		else
		{
                    if(return_flag == 0)
                    {
			$("#drop").attr('style',"width:105%;height:150px; border: 2px dashed #BDC3C7 !important;");
			$.ajax({  //Make the Ajax Request
				type: "POST",  
				url: "../ajax_parentedit",
				data: "pcatid="+pcatid+"&pcattitle="+pcattitle+"&pcatfileuploaded="+pcatfileuploaded+"&pcatstatus="+pcatstatus, //data
				success: function(response) {
					if(response=='1')
					{
						window.location = "../categoryparent?edited";
					}
				} 
			});
                    }
		}
	}
}

/*Deleting the parent category*/
function parentcatdelete(id)
{
	var checkstr =  confirm('Are you sure you want to delete this parent category?');
    if(checkstr == true){
    	$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "categoryparentdelete",
			data: "pcatid="+id,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "categoryparent?deleted";
				}
			} 
		});
    }
}

/*===============*/
/*Child Category*/
/*===============*/

/*Fetching values from step3 form. Appending to the session array and saving it.*/
function savechildcat()
{	
	var ccattitle = $.trim($("#ccattitle").val());
	var ccatparent = $("#ccatparent").val();
	var comboimg = $("#comboimg").val();
	var ccatstatus = $('#ccatstatus').is(':checked');
        var return_flag =   0;
       	if(comboimg=="")
	{
		$('#message_span').html('Select a badge ring combo!!');
		$('#alert_div').show();
		return_flag    =   4;
		$("#badgecombo").css("border-color", "red");
	}
	else
	{
		$("#badgecombo").css("border-color", "#999999");
	}
	if(ccatparent=="")
	{
		$('#message_span').html('Select a parent category!!');
		$('#alert_div').show();
		return_flag    =   3;
	}
	if(ccattitle=="" || ccattitle.length < 3)
	{
		if(!ccattitle)
			$('#message_span').html('Enter a child category name!!');
		else if(ccattitle.length < 3)
			$('#message_span').html('Child category name must be more than 3 characters!!');
		$('#alert_div').show();
		$("#ccattitle").css("border-color", "red");
		return_flag    =   1;
	}
	else
	{
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "ajax_checkavail",
			data: "checkavail="+ccattitle+"&mode=Child&flag=add",  //data
			async:false,
			success: function(response) {
				if(response=='1')
				{
					$("#ccattitle").css("border-color", "red");
					$('#message_span').html('Child category name already exist!!');
					$('#alert_div').show();
					return_flag    =   2;
				}
			} 
		});
	}
	if(ccattitle.length > 3 && ccatparent!="" && comboimg!="")
	{
		if(return_flag == 0)
		{
			$.ajax({  //Make the Ajax Request
				type: "POST",  
				url: "ajax_childadd",
				data: "ccattitle="+ccattitle+"&ccatparent="+ccatparent+"&comboimg="+comboimg+"&ccatstatus="+ccatstatus, //data
				success: function(response) {
					if(response=='1')
					{
						window.location = "categorychild?success";
					}
				} 
			});
		}
	}
}

/*Editing step3 and saving it.*/
function savechildcatedit()
{	
	var ccatid = $("#ccatid").val();
	var ccattitle = $.trim($("#ccattitle").val());
	var ccatparent = $("#ccatparent").val();
	var comboimg = $("#comboimg").val();
	var ccatstatus = $('#ccatstatus').is(':checked');
        var return_flag =   0;
        
	if(comboimg=="")
	{
		$('#message_span').html('Select a badge ring combo!!');
		$('#alert_div').show();
		return_flag    =   4;
		$("#badgecombo").css("border-color", "red");
	}
	else
	{
		$("#badgecombo").css("border-color", "#999999");
	}
	if(ccatparent=="")
	{
		$('#message_span').html('Select a parent category!!');
		$('#alert_div').show();
		return_flag    =   3;
	}
	if(ccattitle=="" || ccattitle.length < 3)
	{
		if(!ccattitle)
			$('#message_span').html('Enter a child category name!!');
		else if(ccattitle.length < 3)
			$('#message_span').html('Child category name must be more than 3 characters!!');
		$('#alert_div').show();
		$("#ccattitle").css("border-color", "red");
		return_flag    =   1;
	}
	else
	{
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "../ajax_checkavail",
			data: "checkavail="+ccattitle+"&mode=Child&flag=edit&edit_id="+ccatid,  //data
			async:false,
			success: function(response) {
				if(response=='1')
				{
					$("#ccattitle").css("border-color", "red");
					$('#message_span').html('Child category name already exist!!');
					$('#alert_div').show();
					return_flag    =   2;
				}
			} 
		});
	}
	if(ccattitle.length > 3 && ccatparent!="" && comboimg!="")
	{
            if(return_flag == 0)
            {
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "../ajax_childedit",
			data: "ccatid="+ccatid+"&ccattitle="+ccattitle+"&ccatparent="+ccatparent+"&comboimg="+comboimg+"&ccatstatus="+ccatstatus, //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "../categorychild?edited";
				}
			} 
		});
            }
	}
}

/*Deleting the child category*/
function childcatdelete(id)
{
	var checkstr =  confirm('Are you sure you want to delete this child category?');
    if(checkstr == true){
    	$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "categorychilddelete",
			data: "ccatid="+id,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "categorychild?deleted";
				}
			} 
		});
    }
}

/*=========================================*/
/*Common function for decal image uploading*/
/*=========================================*/

var rowCount=0;
function createStatusbar(obj)
{

    if(rowCount == 0)
    {
        rowCount++;
		var row="odd";
		if(rowCount %2 ==0) row ="even";
		this.statusbar = $("<div class='statusbar "+row+"'></div>");
		this.filename = $("<div class='filename'></div>").appendTo(this.statusbar);
		this.size = $("<div class='filesize'></div>").appendTo(this.statusbar);
		this.progressBar = $("<div class='progressBar'><div></div></div>").appendTo(this.statusbar);
		this.abort = $("<div class='abort'>Abort</div>").appendTo(this.statusbar);
		obj.after(this.statusbar);
 
		this.setFileNameSize = function(name,size)
		{
			var sizeStr="";
			var sizeKB = size/1024;
			if(parseInt(sizeKB) > 1024)
			{
				var sizeMB = sizeKB/1024;
				sizeStr = sizeMB.toFixed(2)+" MB";
			}
			else
			{
				sizeStr = sizeKB.toFixed(2)+" KB";
			}
			this.filename.html(name);
			this.size.html(sizeStr);
		}
		this.setProgress = function(progress)
		{      
			var progressBarWidth =progress*this.progressBar.width()/ 100; 
			this.progressBar.find('div').animate({ width: progressBarWidth }, 10).html(progress + "% ");
			if(parseInt(progress) >= 100)
			{
                //this.abort.hide();
            }
        }
    }
    this.setAbort = function(jqxhr)
    {
        var sb = this.statusbar;
        this.abort.click(function()
        {
            rowCount--;
            $('#status1').html('');
            $('#fileuploaded').val('');
            if( $.trim( $('#temp_fileuploaded').val() ) )
            {
                $('#fileuploaded').val($('#temp_fileuploaded').val());
            }
            jqxhr.abort();
            sb.hide();
        });
    }
}

function handleFileUpload(files,obj)
{
	for (var i = 0; i < files.length; i++)
	{
		var fd = new FormData();
		fd.append('file', files[i]);
		var status = new createStatusbar(obj); //Using this we can set progress.
		status.setFileNameSize(files[i].name,files[i].size);
		sendFileToServer(fd,status);
	}
}

$(document).ready(function()
{
	var obj = $("#dragandrophandler");
	obj.on('dragenter', function (e)
	{
		e.stopPropagation();
		e.preventDefault();
		$(this).css('border', '2px solid #0B85A1');
	});
	obj.on('dragover', function (e)
	{
		 e.stopPropagation();
		 e.preventDefault();
	});
	obj.on('drop', function (e)
	{
		 $(this).css('border', '2px dotted #0B85A1');
		 e.preventDefault();
		 var files = e.originalEvent.dataTransfer.files;
	 
		 //We need to send dropped files to Server
		 handleFileUpload(files,obj);
	});
	$(document).on('dragenter', function (e)
	{
		e.stopPropagation();
		e.preventDefault();
	});
	$(document).on('dragover', function (e)
	{
	  e.stopPropagation();
	  e.preventDefault();
	  obj.css('border', '2px dotted #0B85A1');
	});
	$(document).on('drop', function (e)
	{
		e.stopPropagation();
		e.preventDefault();
	});
});


/// admin user save function
function saveadminuser()
{	
	var ck_name                 =   /^[a-zA-Z]{1}/;
	var first_name              =   $("#first_name").val();
	var last_name               =   $("#last_name").val();
	var user_name               =   $("#user_name").val();
	var email                   =   $("#email").val();
	var password                =   $("#password").val();
	var role                    =   $("#role").val();
	var adminuserfileuploaded   =   $("#fileuploaded").val();
	var adminuserstatus         =   $('#adminuserstatus').is(':checked');
    var return_flag             =   0;
	if(adminuserfileuploaded=="")
	{
		return_flag    =   1;
		$('#message_span').html('Please enter an icon!!');
		$('#alert_div').show();
		$("#drop").attr('style',"width:105%;height:150px; border: 2px dashed #FF0000 !important;");
	}
	else
	{
		$("#drop").attr('style',"width:105%;height:150px; border: 2px dashed #BDC3C7 !important;");
	}
	if($.trim(role)=="")
	{
		$(".btn-group #role").attr("style", "background-color:#FF0000 !important");
		return_flag    =   1;
		$('#message_span').html('Select any one of the role!!');
		$('#alert_div').show();
	}
	else
	{
		$(".btn-group #role").attr("style", "background-color:#3498DB !important");
	}
	if($.trim(password)=="")
	{
		return_flag    =   1;
		$('#message_span').html('Please enter a password!!');
		$('#alert_div').show();
		$("#password").css("border-color", "red");
	}
	if($.trim(user_name)==""||$.trim(user_name).length<3)
	{
		return_flag    =   1;
		$('#message_span').html('Please enter the username!!');
		$('#alert_div').show();
		$("#user_name").css("border-color", "red");
	}
	else
	{
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "ajax_checkavail",
			data: "checkavail="+user_name+"&mode=Admin&field_name=admin_user_name&flag=add",  //data
			success: function(response) {
				if(response=='1')
				{
					return_flag    =   1;
					$('#message_span').html('Username already exist!!');
					$('#alert_div').show();
					$("#user_name").css("border-color", "red");
				}
			} 
		});
	}
	if($.trim(email)=="" ||$.trim(email).length<3)
	{
		return_flag    =   1;
		$('#message_span').html('Please enter an email id!!');
		$('#alert_div').show();
		$("#email").css("border-color", "red");
	}
	else
	{
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "ajax_checkavail",
			data: "checkavail="+email+"&mode=Admin&field_name=admin_user_email&flag=add",  //data
			success: function(response) {
				if(response=='1')
				{
					return_flag    =   1;
					$('#message_span').html('Email id already exist!!');
					$('#alert_div').show();
					$("#email").css("border-color", "red");
				}
			} 
		});
	}
	if (!validateEmail(email)) {
		return_flag    =   1;
		$('#message_span').html('Enter a valid email id!!');
		$('#alert_div').show();
		$("#email").css("border-color", "red");
	}
	if($.trim(last_name)=="")
	{
		return_flag    =   1;
		$('#message_span').html('Please enter a last name!!');
		$('#alert_div').show();
		$("#last_name").css("border-color", "red");
	}
	if($.trim(first_name) ==""||$.trim(first_name).length<3)
	{
		return_flag    =   1;
		if($.trim(first_name) =="")
			$('#message_span').html('Please enter a first name!!');
		else if($.trim(first_name).length<3)
			$('#message_span').html('First name must be atleast 3 characters!!');
		
		$('#alert_div').show();
		$("#first_name").css("border-color", "red");
	}
	if (!ck_name.test($.trim(first_name))) 
	{
		return_flag    =   1;
		$('#message_span').html('Enter a valid first name!!');
		$('#alert_div').show();
		$("#first_name").css("border-color", "red");
	}	
	if($.trim(first_name) !=""&&$.trim(first_name).length>=3 &&ck_name.test($.trim(first_name))&&$.trim(last_name)!=""&&$.trim(user_name)!=""&&$.trim(user_name).length>=3&&validateEmail(email)&&$.trim(password)!="")
	{
		var imgArray = ["gif","png"];
		var img_type = adminuserfileuploaded.slice(-3);
		var availableimgExt = $.inArray(img_type, imgArray);
		if(availableimgExt < 0)
		{
			return_flag    =   1;
			$('#message_span').html('Icon must be of type GIF or PNG!!');
			$('#alert_div').show();
			$("#drop").attr('style',"width:105%;height:150px; border: 2px dashed #FF0000 !important;");
		}
		else     
		{
			if(return_flag == 0)
			{
				$.ajax({  //Make the Ajax Request
					type: "POST",  
					url: "ajax_adminuseradd",
					data: "first_name="+first_name+"&last_name="+last_name+"&email="+email+"&user_name="+user_name+"&password="+password+"&role="+role+"&adminuserfileuploaded="+adminuserfileuploaded+"&adminuserstatus="+adminuserstatus, //data
					success: function(response) {
						if(response=='1')
						{
							window.location = "adminuser_list?success";
						}
					} 
				});
            }
		}
	}
}

/*Editing admin user saving it.*/
function saveadminuseredit()
{
    if(!$("#fileuploaded").val())
    {
        $("#fileuploaded").val($("#temp_fileuploaded").val());
    }
    var ck_name                 =   /^[a-zA-Z]{1}/;
    var adminid                 =   $("#adminid").val();
    var first_name              =   $("#first_name").val();
    var last_name               =   $("#last_name").val();
    var user_name               =   $("#user_name").val();
    var email                   =   $("#email").val();
    var password                =   $("#password").val();
    var role                    =   $("#role").val();
    var adminuserfileuploaded   =   $("#fileuploaded").val();
    var adminuserstatus         =   $('#adminuserstatus').is(':checked');
    var return_flag             =   0;
    if(adminuserfileuploaded=="")
    {
        return_flag    =   1;
        $('#message_span').html('Please enter an icon!!');
        $('#alert_div').show();
        $("#drop").attr('style',"width:105%;height:150px; border: 2px dashed #FF0000 !important;");
    }
	if($.trim(role)=="")
    {
        return_flag    =   1;
        $('#message_span').html('Select any one of the role!!');
        $('#alert_div').show();
    }
	if($.trim(password)=="")
    {
        return_flag    =   1;
        $('#message_span').html('Please enter a password!!');
        $('#alert_div').show();
        $("#password").css("border-color", "red");
    }
	if($.trim(email)=="" ||$.trim(email).length<3)
    {
        return_flag    =   1;
        $('#message_span').html('Please enter an email id!!');
        $('#alert_div').show();
        $("#email").css("border-color", "red");
    }
    else
    {
        $.ajax({  //Make the Ajax Request
            type: "POST",  
            url: "../ajax_checkavail",
            data: "checkavail="+email+"&mode=Admin&field_name=admin_user_email&flag=edit&edit_id="+adminid,  //data
            success: function(response) {
                    if(response=='1')
                    {
                        return_flag    =   1;
                        $('#message_span').html('Email already exist!!');
                        $('#alert_div').show();
                        $("#email").css("border-color", "red");
                    }
            } 
        });
    }
    if (!validateEmail(email)) 
	{
        // alert('Email is not valid');
        return_flag    =   1;
        $('#message_span').html('Enter a valid email id!!');
        $('#alert_div').show();
        $("#email").css("border-color", "red");
    }
    if($.trim(user_name)==""||$.trim(user_name).length<3)
    {
            $("#user_name").css("border-color", "red");
    }
    if($.trim(last_name)=="")
    {
        return_flag    =   1;
        $('#message_span').html('Please enter a last name!!');
        $('#alert_div').show();
        $("#last_name").css("border-color", "red");
    }
	if($.trim(first_name) ==""||$.trim(first_name).length<3)
    {
        return_flag    =   1;
        if($.trim(first_name) =="")
            $('#message_span').html('Please enter a first name!!');
        else if($.trim(first_name).length<3)
            $('#message_span').html('First name must be atleast 3 characters!!');

        $('#alert_div').show();
        $("#first_name").css("border-color", "red");
    }
    if (!ck_name.test($.trim(first_name))) 
    {
        return_flag    =   1;
        $('#message_span').html('Please enter a valid first name!!');
        $('#alert_div').show();
        $("#first_name").css("border-color", "red");
    }
    if($.trim(first_name) !=""&&$.trim(first_name).length>=3 &&ck_name.test($.trim(first_name))&&$.trim(last_name)!=""&&$.trim(user_name)!=""&&$.trim(user_name).length>=3&&validateEmail(email)&&$.trim(password)!="")
    {
            var imgArray = ["gif","png"];
            var img_type = adminuserfileuploaded.slice(-3);
            var availableimgExt = $.inArray(img_type, imgArray);
            if(availableimgExt < 0)
            {
                return_flag    =   1;
                $('#message_span').html('Icon must be of type GIF or PNG!!');
                $('#alert_div').show();
                $("#drop").attr('style',"width:105%;height:150px; border: 2px dashed #FF0000 !important;");
            }
            else
            {
                if(return_flag == 0)
                {
                    $.ajax({  //Make the Ajax Request
                            type: "POST",  
                            url: "../ajax_adminuseredit",
                            data: "adminid="+adminid+"&first_name="+first_name+"&last_name="+last_name+"&email="+email+"&user_name="+user_name+"&password="+password+"&role="+role+"&adminuserfileuploaded="+adminuserfileuploaded+"&adminuserstatus="+adminuserstatus, //data
                            success: function(response) {
                                    if(response=='1')
                                    {
                                            window.location = "../adminuser_list?edited";
                                    }
                            } 
                    });
                }
            }
    }
}

/*Deleting the Admin user*/
function adminuser_delete(id)
{
	var checkstr =  confirm('Are you sure you want to delete this Admin user?');
    if(checkstr == true){
    	$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "adminuser_delete",
			data: "adminid="+id,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "adminuser_list?deleted";
				}
			} 
		});
    }
}

/*Editing user saving it.*/
function saveuseredit()
{
	var userid = $("#userid").val();
	var notification_email= $("#notification_email").val();
	var userstatus = $('#userstatus').is(':checked');
	var return_flag  =   0;
	if (!validateEmail(notification_email)) 
	{
		return_flag    =   1;
        $('#message_span').html('Enter a valid notification email id!!');
        $('#alert_div').show();
	    $("#notification_email").css("border-color", "red");
	}
	if($.trim(notification_email)=="")
	{
		return_flag    =   1;
        $('#message_span').html('Please enter a notification email id!!');
        $('#alert_div').show();
		$("#notification_email").css("border-color", "red");
	}
	if (validateEmail(notification_email)&&$.trim(notification_email)!="")
	{
		if(return_flag == 0)
        {
			$.ajax({  //Make the Ajax Request
				type: "POST",  
				url: "../ajax_useredit",
				data: "userid="+userid+"&notification_email="+notification_email+"&userstatus="+userstatus, //data
				success: function(response) {
					if(response=='1')
					{
						window.location = "../users_list?edited";
					}
				} 
			});
		}
	}
}

/*Deleting a user*/
function user_delete(id)
{
	var checkstr =  confirm('Are you sure you want to delete this user?');
    if(checkstr == true){
    	$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "user_delete",
			data: "userid="+id,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "users_list?deleted";
				}
			} 
		});
    }
}

/*==========*/
/*Challenges*/
/*==========*/

/*Fetching values from step1 form. Storing to session array and sending to step2*/
function gottochallengestep2()
{	
	var challengename   =   $.trim($("#challengename").val());
	var badgetitle      =   $.trim($("#badgetitle").val());
	var dailycommit     =   $.trim($("#dailycommit").val());
	var why             =   $.trim($("#why").val());
	var how             =   $.trim($("#how").val());
	var learnmore       =   $.trim($("#learnmore").val());
	var repeatable      =   $('#repeatable').is(':checked');
	var status          =   $('#status').is(':checked');
        var step            =   $('#step').val();
        var return_flag     =   0;
	if(learnmore=="" || learnmore.length < 3)
	{
                return_flag     =   1;
		$("#learnmore").css("border-color", "red");
                if(learnmore=="")
                    $('#message_span').html('Learn More is required!!');
                else if(learnmore.length < 3)
                    $('#message_span').html('Learn More must be minimum 3 characters!!');
                
                $('#alert_div').show();
	}
        if(how=="" || how.length < 3)
	{
                return_flag     =   1;
		$("#how").css("border-color", "red");
                
                if(how=="")
                    $('#message_span').html('How is required!!');
                else if(how.length < 3)
                    $('#message_span').html('How must be minimum 3 characters!!');
                
                $('#alert_div').show();
	}
        if(why=="" || why.length < 3)
	{
                return_flag     =   1;
		$("#why").css("border-color", "red");
                
                if(why=="")
                    $('#message_span').html('Why is required!!');
                else if(why.length < 3)
                    $('#message_span').html('Why must be minimum 3 characters!!');
                
                $('#alert_div').show();
	}
        if(dailycommit=="" || dailycommit.length < 3)
	{
                return_flag     =   1;
		$("#dailycommit").css("border-color", "red");
                $('#message_span').html('Daily Commitment is required!!');
                $('#alert_div').show();
	}
        if(badgetitle=="" || badgetitle.length < 3)
	{
                return_flag     =   1;
		$("#badgetitle").css("border-color", "red");
                $('#message_span').html('Badge title is required!!');
                $('#alert_div').show();
	}
        if(challengename=="" || challengename.length < 3)
	{
		$("#challengename").css("border-color", "red");
                
                if(challengename=="")
                    $('#message_span').html('Challenge name is required!!');
                else if(challengename.length < 3)
                    $('#message_span').html('Challenge name must be minimum 3 characters!!');
                
                $('#alert_div').show();
                return_flag     =   1;
	}
        else
        {
            $.ajax({  //Make the Ajax Request
		type: "POST",  
		url: "ajax_checkavail",
		data: "checkavail="+challengename+"&mode=Challenge",  //data
                async:false,
		success: function(response) {
			if(response=='1')
			{
                            return_flag     =   1;
                            $('#message_span').html('Challenge name already exist!!');
                            $('#alert_div').show();
                            $("#challengename").css("border-color", "red");
			}
                        else
                        {
                            $("#challengename").attr("style", "");
                        }
		} 
            });
        }
	if(challengename.length > 2 && badgetitle.length > 2 && dailycommit.length > 2 && why.length > 2 && how.length > 2 && learnmore.length > 2)
	{
            if(return_flag     ==   0)
            {
                $("#challengename").css("border-color", "#BDC3C7");
		$("#badgetitle").css("border-color", "#BDC3C7");
		$("#dailycommit").css("border-color", "#BDC3C7");
		$("#why").css("border-color", "#BDC3C7");
		$("#how").css("border-color", "#BDC3C7");
		$("#learnmore").css("border-color", "#BDC3C7");
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "ajax_challengeaddstep1",
			data: "challengename="+challengename+"&badgetitle="+badgetitle+"&dailycommit="+dailycommit+"&why="+why+"&how="+how+"&learnmore="+learnmore+"&repeatable="+repeatable+"&status="+status+"&step="+step,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "challengeaddstep2";
				}
			} 
		});
            }
	}
}

function challengeeditstep2()
{	
	var challengeid     =   $("#challengeid").val();
	var challengename   =   $.trim($("#challengename").val());
	var badgetitle      =   $.trim($("#badgetitle").val());
	var dailycommit     =   $.trim($("#dailycommit").val());
	var why             =   $.trim($("#why").val());
	var how             =   $.trim($("#how").val());
	var learnmore       =   $.trim($("#learnmore").val());
	var repeatable      =   $('#repeatable').is(':checked');
	var status          =   $('#status').is(':checked');
        var return_flag     =   0;
        if(learnmore=="" || learnmore.length < 3)
	{
                return_flag     =   1;
		$("#learnmore").css("border-color", "red");
                if(learnmore=="")
                    $('#message_span').html('Learn More is required!!');
                else if(learnmore.length < 3)
                    $('#message_span').html('Learn More must be minimum 3 characters!!');
                
                $('#alert_div').show();
	}
        if(how=="" || how.length < 3)
	{
                return_flag     =   1;
		$("#how").css("border-color", "red");
                
                if(how=="")
                    $('#message_span').html('How is required!!');
                else if(how.length < 3)
                    $('#message_span').html('How must be minimum 3 characters!!');
                
                $('#alert_div').show();
	}
        if(why=="" || why.length < 3)
	{
                return_flag     =   1;
		$("#why").css("border-color", "red");
                
                if(why=="")
                    $('#message_span').html('Why is required!!');
                else if(why.length < 3)
                    $('#message_span').html('Why must be minimum 3 characters!!');
                
                $('#alert_div').show();
	}
        if(dailycommit=="" || dailycommit.length < 3)
	{
                return_flag     =   1;
		$("#dailycommit").css("border-color", "red");
                $('#message_span').html('Daily Commitment is required!!');
                $('#alert_div').show();
	}
        if(badgetitle=="" || badgetitle.length < 3)
	{
                return_flag     =   1;
		$("#badgetitle").css("border-color", "red");
                $('#message_span').html('Badge title is required!!');
                $('#alert_div').show();
	}
        if(challengename=="" || challengename.length < 3)
	{
		$("#challengename").css("border-color", "red");
                
                if(challengename=="")
                    $('#message_span').html('Challenge name is required!!');
                else if(challengename.length < 3)
                    $('#message_span').html('Challenge name must be minimum 3 characters!!');
                
                $('#alert_div').show();
                return_flag     =   1;
	}
	if(challengename.length > 2 && badgetitle.length > 2 && dailycommit.length > 2 && why.length > 2 && how.length > 2 && learnmore.length > 2)
	{
            if(return_flag  ==   0)
            {
                $("#challengename").css("border-color", "#BDC3C7");
		$("#badgetitle").css("border-color", "#BDC3C7");
		$("#dailycommit").css("border-color", "#BDC3C7");
		$("#why").css("border-color", "#BDC3C7");
		$("#how").css("border-color", "#BDC3C7");
		$("#learnmore").css("border-color", "#BDC3C7");
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "../ajax_challengeeditstep1",
			data: "challengeid="+challengeid+"&challengename="+challengename+"&badgetitle="+badgetitle+"&dailycommit="+dailycommit+"&why="+why+"&how="+how+"&learnmore="+learnmore+"&repeatable="+repeatable+"&status="+status,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "../challengeeditstep2/"+challengeid;
				}
			} 
		});
            }
	}
}

function getDateFormat(date)
{
    var d       = new Date(date);
    
    var day     =   d.getDate();
    var month   =   d.getMonth() + 1;
    var year    =   d.getFullYear();

    return year+"-"+month+"-"+day;
}

/*Fetching values from step2 form. Storing to session array and sending to step3*/
function gottochallengestep3()
{	
	var chalngparent                =   $("#chalngparent").val();
	var chalngparentchild           =   $("#child_category_val").val();
	var chalngparentimagename       =   $("#parent_image_name").val();      //parent image name
	var chalngparentchildimagename  =   $("#child_image_name").val();       //child image name
	var chalnglen                   =   $("#chalnglen").val();
	var chalngwhosets               =   $('input:radio[name="chalngwhosets"]:checked').val();
	var chalngbegining              =   getDateFormat($('#datepicker-from').datepicker('getDate'));
	var chalngending                =   getDateFormat($('#datepicker-to').datepicker('getDate'));
        var step                        =   $('#step').val();
        var return_flag                 =   0;
	
        if(chalngparentchild == '')
        {
            $('#message_span').html('Select a child category!!');
            $('#alert_div').show();
            return_flag                 =   1;
        }
        if(chalngparent=="")
	{
            $('#message_span').html('Select a parent category!!');
            $('#alert_div').show();
            return_flag                 =   1;
	}
	else
	{
            if(return_flag  ==   0) 
            {
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "ajax_challengeaddstep2",
			data: "chalngparent="+chalngparent+"&chalngparentchild="+chalngparentchild+"&chalngparentimagename="+chalngparentimagename+"&chalngparentchildimagename="+chalngparentchildimagename+"&chalnglen="+chalnglen+"&chalngwhosets="+chalngwhosets+"&chalngbegining="+chalngbegining+"&chalngending="+chalngending+"&step="+step,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "challengeaddstep3";
				}
			} 
		});
            }
	}
}

/*Fetching values from step2 form. Storing to session array and sending to step3*/
function challengeeditstep3()
{	
	var challengeid                 =   $("#challengeid").val();
	var chalngparent                =   $("#chalngparent").val();
	var chalngparentimagename       =   $("#parent_image_name").val();      //parent image name
	var chalngparentchildimagename  =   $("#child_image_name").val();       //child image name
        var chalngparentchild           =   $("#child_category_val").val();
	var chalnglen                   =   $("#chalnglen").val();
	var chalngwhosets               =   $('input:radio[name="chalngwhosets"]:checked').val();
	var chalngbegining              =   getDateFormat($('#datepicker-from').datepicker('getDate'));
	var chalngending                =   getDateFormat($('#datepicker-to').datepicker('getDate'));
        var return_flag                 =   0;
        
        if(chalngparentchild == '')
        {
            $('#message_span').html('Select a child category!!');
            $('#alert_div').show();
            return_flag =   1;
        }
	if(chalngparent=="")
	{
            $('#message_span').html('Select a parent category!!');
            $('#alert_div').show();
            return_flag =   1;
	}
        
	else
	{
            if(return_flag  ==   0) 
            {
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "../ajax_challengeeditstep2",
			data: "challengeid="+challengeid+"&chalngparent="+chalngparent+"&chalngparentchild="+chalngparentchild+"&chalngparentimagename="+chalngparentimagename+"&chalngparentchildimagename="+chalngparentchildimagename+"&chalnglen="+chalnglen+"&chalngwhosets="+chalngwhosets+"&chalngbegining="+chalngbegining+"&chalngending="+chalngending,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "../challengeeditstep3/"+challengeid;
				}
			} 
		});
            }
	}
}

/*Fetching values from step3 form. Storing to session array and sending to step4*/
function gottochallengestep4()
{	
	var challengetagWord = $("#challengetagWord").val();
        var step    =   $('#step').val();
	if(challengetagWord=="")
	{
		$("#challengetagWord").css("border-color", "red");
                $('#message_span').html('Challenge tag is required!!');
                $('#alert_div').show();
	}
	else
	{
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "ajax_challengeaddstep3",
			data: "challengetagWord="+challengetagWord+"&step="+step,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "challengeaddstep4";
				}
			} 
		});
	}
}

/*Fetching values from step3 form. Storing to session array and sending to step4*/
function challengeeditstep4()
{	
	var challengeid = $("#challengeid").val();
	var challengetagWord = $("#challengetagWord").val();
	if(challengetagWord=="")
	{
                $('#message_span').html('Challenge tag is required!!');
                $('#alert_div').show();
		$("#tagsinput div").css("border-color", "red");
	}
	else
	{
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "../ajax_challengeeditstep3",
			data: "challengeid="+challengeid+"&challengetagWord="+challengetagWord,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "../challengeeditstep4/"+challengeid;
				}
			} 
		});
	}
}

/*Fetching values from step4 form. Storing to session array and sending to step5*/
function gottochallengestep5()
{	
	var chaldiff                    =   $("#chaldiff").val();
	var prenot                      =   $("#prenot").val();
	var custnot                     =   $("#custnot").val();
	var notification_frequency      =   $("#notification_frequency").val();
	var chalngdifficultyimagename   =   $("#difficultyimagename").val();      //difficulty image name
    var step                        =   $('#step').val();
	
	if(prenot=="" && custnot=="")
	{
		$('#message_span').html('Select pre-written check-in notification or enter custom check-in notification!!');
                $('#alert_div').show();
		$("#custnot").css("border-color", "red");
	}
        if(chaldiff=="")
	{
                $('#message_span').html('Select one of the difficulty!!');
                $('#alert_div').show();
	}
	if(chaldiff!="" && (prenot!="" || custnot!="") )
	{
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "ajax_challengeaddstep4",
			data: "chaldiff="+chaldiff+"&pre_notification="+prenot+"&chalngdifficultyimagename="+chalngdifficultyimagename+"&custom_notification="+custnot+"&notification_frequency="+notification_frequency+"&step="+step,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "challengeaddstep5";
				}
			} 
		});
	}
}

/*Fetching values from step4 form. Storing to session array and sending to step5*/
function challengeeditstep5()
{	
	var challengeid                 =   $("#challengeid").val();
	var chaldiff                    =   $("#chaldiff").val();
	var prenot                      =   $("#prenot").val();
	var custnot                     =   $("#custnot").val();
	var notification_frequency      =   $("#notification_frequency").val();
        var chalngdifficultyimagename   =   $("#difficultyimagename").val();      //difficulty image name
	if(prenot=="" && custnot=="")
	{
		$('#message_span').html('Select pre-written check-in notification or enter custom check-in notification!!');
                $('#alert_div').show();
		$("#custnot").css("border-color", "red");
	}
        if(chaldiff=="")
	{
                $('#message_span').html('Select one of the difficulty!!');
                $('#alert_div').show();
	}
	if(chaldiff!="" && (prenot!="" || custnot!="") )
	{
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "../ajax_challengeeditstep4",
			data: "challengeid="+challengeid+"&chaldiff="+chaldiff+"&chalngdifficultyimagename="+chalngdifficultyimagename+"&pre_notification="+prenot+"&custom_notification="+custnot+"&notification_frequency="+notification_frequency,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "../challengeeditstep5/"+challengeid;
				}
			} 
		});
	}
}

/**
 * validation for the last tab Image & Color in challenge  section
 */
function challengeSave()
{
    var fileuploaded    =   $("#fileuploaded").val();
    var badgecolor      =   $("#comboimg").val();
    var badgecolor_id   =   $("#badgecolor_hidden").val();
    if(fileuploaded=="")
    {
            $("#drop").attr('style',"width:705px;height:150px; border: 2px dashed #FF0000 !important;");
            $('#message_span').html('Hero image is required!!');
            $('#alert_div').show();
    }
    else
    {
        var imgArray = ["png", "jpg", "jpeg"];
        var img_type = fileuploaded.slice(-3);
        var availableimgExt = $.inArray(img_type, imgArray);
        if(availableimgExt < 0)
        {
                $("#drop").attr('style',"width:105%;height:160px; border: 2px dashed #FF0000 !important;");
                $('#message_span').html('Hero image must be of type .png or .jpeg!!');
                $('#alert_div').show();
        }
        else
        {
            if(!$("#comboimg").val())
            {
                $("#badgecombo").attr('style',"float:left;border: 2px dashed #FF0000 !important;");
                $('#message_span').html('Badge color is required!!');
                $('#alert_div').show();
            }
            else
            {
                $.ajax({  //Make the Ajax Request
					type: "POST",  
					url: "ajax_challengeadd",
					data: "hero_image="+fileuploaded+"&badge_color="+badgecolor_id,  //data
					success: function(response) {
						if(response=='1')
						{
							window.location = "challenges?success";
						}
					} 
				});
            }
        }
    }
}

/**
 * validation for the last tab Image & Color in challenge  section
 */
function SaveEditedchallemge()
{

    var challengeid         =   $("#challengeid").val();
    var fileuploaded        =   $("#fileuploaded").val();
    var temp_file			=   $("#fileuploaded").val();
    var badgecolor          =   $("#comboimg").val();
    var badgecolor_id       =   $("#badgecolor_hidden").val();
    fileuploaded            =   fileuploaded?fileuploaded:$("#temp_fileuploaded").val();

    if(fileuploaded != "")
    {
        var imgArray = ["png", "jpg", "jpeg"];
        var img_type = fileuploaded.slice(-3);
        var availableimgExt = $.inArray(img_type, imgArray);
        if(availableimgExt < 0)
        {
                $("#drop").attr('style',"width:105%;height:150px; border: 2px dashed #FF0000 !important;");
                $('#message_span').html('Hero image must be of type .png or .jpeg!!');
                $('#alert_div').show();
        }
        else
        {
            if(!$("#comboimg").val())
            {
                $("#badgecombo").attr('style',"float:left;border: 2px dashed #FF0000 !important;");
                $('#message_span').html('Badge color is required!!');
                $('#alert_div').show();
            }
            else
            {
                $.ajax({  //Make the Ajax Request
					type: "POST",  
					url: "../ajax_challengeedit",
					data: "challengeid="+challengeid+"&hero_image="+fileuploaded+"&badge_color="+badgecolor_id+"&temp_fileuploaded="+temp_file,  //data
					success: function(response) {
						if(response=='1')
						{
							window.location = "../challenges?success";
						}
					} 
				});
            }
        }
    }
}

/*Deleting a challenge*/
function challengedelete(id)
{
	var checkstr =  confirm('Are you sure you want to delete this challenge?');
    if(checkstr == true){
    	$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "challengedelete",
			data: "id="+id,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "challenges?deleted";
				}
			} 
		});
    }
}


/// email validation
function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}

/*-----------------*/
/*USER REGISTRATION*/
/*-----------------*/

function reg_info_ajax()
{
	var reslt=regFieldcheck();
	//alert(reslt);
	if(reslt!=false)
	{
		var fname= $("#firstname").val();
		var lname= $("#lastname").val();
		var email= $("#youremail").val();
		var pass= $("#new_password").val();
		var objk	=	document.getElementsByName('chalngwhosets[]');
		if(objk[0].checked==true)
		{
		//	alert(1);
			var gender= document.getElementsByName('chalngwhosets[]')[0].value;
		}
		else
		{
			var gender= document.getElementsByName('chalngwhosets[]')[1].value;
		}
		//var gender= $("#chalngwhosets").val();
		var ebay_buz_unit= $("#unit_info").val();
		var ebay_buz_loc= $("#loc_info").val();
                    
		var email_noti1= 0;
		var email_noti2= 0;
                
                if($("#emailnot").is(':checked'))
                    email_noti1= $("#emailnot").val();
                if($("#emailnot1").is(':checked'))
                    email_noti2= $("#emailnot1").val();
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "users/ajax_registration_step1",
			data: "fname="+fname+"&lname="+lname+"&email="+email+"&pass="+pass+"&gender="+gender+"&ebay_buz_unit="+ebay_buz_unit+"&ebay_buz_loc="+ebay_buz_loc+"&email_noti1="+email_noti1+"&email_noti2="+email_noti2,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "registration_step2";
				}
			}
		});
	} 
}

function regFieldcheck()
{
	var email =  $("#youremail").val();
	var cemail= $("#reyouremail").val();
	var return_flag   =   0;
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if ($.trim($("#firstname").val())=='' || $.trim($("#firstname").val()).length < 3 )
	{
		$("#firstname").css("border-color", "red");
		if ($.trim($("#firstname").val())=='')
		{
			$('#message_span').html('Enter First name!!');
		}
		else
		{
			$('#message_span').html('First name should contain atleast 3 character!!');
		}
		$('#alert_div').show();
		return false;
	}
	else if ($.trim($("#lastname").val())=='' || $.trim($("#lastname").val()).length < 3 )
	{
		$("#firstname").css("border-color", "#BDC3C7");
		$("#lastname").css("border-color", "red");
		if ($("#lastname").val()=='')
		{
			$('#message_span').html('Enter last name!!');
		}
		else
		{
			$('#message_span').html('Last name should contain atleast 3 character!!');
		}
		$('#alert_div').show();
		return false;
	}
	else if ($("#youremail").val()=='')
	{
		$("#firstname").css("border-color", "#BDC3C7");
		$("#lastname").css("border-color", "#BDC3C7");
		$("#youremail").css("border-color", "red");
		$('#message_span').html('Enter email!!');
		$('#alert_div').show();
		return false;
	}
	else if($("#youremail").val()!='' && !filter.test(email))
	{
		$("#firstname").css("border-color", "#BDC3C7");
		$("#lastname").css("border-color", "#BDC3C7");
		$("#youremail").css("border-color", "red");
		$('#message_span').html('Enter a valid email!!');
		$('#alert_div').show();
		return false;
	}
	else if($('#email_unique').val()=="exists")
	{	
		$("#firstname").css("border-color", "#BDC3C7");
		$("#lastname").css("border-color", "#BDC3C7");
		$("#youremail").css("border-color", "red");
		$('#message_span').html('Email already registered!!');
		$('#alert_div').show();
		return false;
	}
	else if ($("#reyouremail").val()=='')
	{
		$("#firstname").css("border-color", "#BDC3C7");
		$("#lastname").css("border-color", "#BDC3C7");
		$("#youremail").css("border-color", "#BDC3C7");
		$("#reyouremail").css("border-color", "red");
		$('#message_span').html('Reenter email!!');
		$('#alert_div').show();
		return false;
	}
	else if (($("#reyouremail").val()!='') && (email != cemail))
	{	
		$("#firstname").css("border-color", "#BDC3C7");
		$("#lastname").css("border-color", "#BDC3C7");
		$("#youremail").css("border-color", "#BDC3C7");
		$("#reyouremail").css("border-color", "red");
		$('#message_span').html('Email miss match!!');
		$('#alert_div').show();
		return false;
	}
	else if ($("#new_password").val()=='' || $("#new_password").val().length < 6)
	{
		$("#firstname").css("border-color", "#BDC3C7");
		$("#lastname").css("border-color", "#BDC3C7");
		$("#youremail").css("border-color", "#BDC3C7");
		$("#reyouremail").css("border-color", "#BDC3C7");
		$("#new_password").css("border-color", "red");
		if ($("#new_password").val()=='')
		{
			$('#message_span').html('Enter password!!');
		}
		else
		{
			$('#message_span').html('Password must contain atleast 6 character!!');
		}
		$('#alert_div').show();
		return false;
	}
	else if ($("#re_password").val()=='')
	{
		$("#firstname").css("border-color", "#BDC3C7");
		$("#lastname").css("border-color", "#BDC3C7");
		$("#youremail").css("border-color", "#BDC3C7");
		$("#reyouremail").css("border-color", "#BDC3C7");
		$("#new_password").css("border-color", "#BDC3C7");
		$("#re_password").css("border-color", "red");
		$('#message_span').html('Reenter password!!');
		$('#alert_div').show();
		return false;
	}
	else if ($("#new_password").val()!=$("#re_password").val())
	{
		$("#firstname").css("border-color", "#BDC3C7");
		$("#lastname").css("border-color", "#BDC3C7");
		$("#youremail").css("border-color", "#BDC3C7");
		$("#reyouremail").css("border-color", "#BDC3C7");
		$("#new_password").css("border-color", "#BDC3C7");
		$("#re_password").css("border-color", "red");
		$('#message_span').html('Password missmatch!!');
		$('#alert_div').show();
		return false;
	}
	else if ($("#unit_info").val()=='0')
	{
		$("#firstname").css("border-color", "#BDC3C7");
		$("#lastname").css("border-color", "#BDC3C7");
		$("#youremail").css("border-color", "#BDC3C7");
		$("#reyouremail").css("border-color", "#BDC3C7");
		$("#new_password").css("border-color", "#BDC3C7");
		$("#re_password").css("border-color", "#BDC3C7");
		$("#unit_info").css("border-color", "red");
		$('#message_span').html('Select a business unit!!');
		$('#alert_div').show();
		return false;
	}
	else if ($("#loc_info").val()=='0')
	{
		$("#firstname").css("border-color", "#BDC3C7");
		$("#lastname").css("border-color", "#BDC3C7");
		$("#youremail").css("border-color", "#BDC3C7");
		$("#reyouremail").css("border-color", "#BDC3C7");
		$("#new_password").css("border-color", "#BDC3C7");
		$("#re_password").css("border-color", "#BDC3C7");
		$("#unit_info").css("border-color", "#BDC3C7");
		$("#loc_info").css("border-color", "red");
		$('#message_span').html('Select a business unit location!!');
		$('#alert_div').show();
		return false;
	}
	else
	{
		return true;
	}
}

function regstep2Fieldcheck()
{
	if ($("#grd_year").val()=='')
	{
		$("#grd_year").css("border-color", "red");
		$('#message_span').html('Select Graduation year!!');
		$('#alert_div').show();
		return false;
	}
	else if($("#grd_level").val()=='')
	{
		$("#grd_year").css("border-color", "#BDC3C7");
		$("#grd_level").css("border-color", "red");
		$('#message_span').html('Select Graduation level!!');
		$('#alert_div').show();
		return false;
	}
	else if($("#grd_scl").val()=='')
	{
		$("#grd_year").css("border-color", "#BDC3C7");
		$("#grd_level").css("border-color", "#BDC3C7");
		$("#grd_scl").css("border-color", "red");
		$('#message_span').html('Select Graduation School!!');
		$('#alert_div').show();
		return false;
	}
	else if($("#mult_sel").val()=='')
	{
		$("#grd_year").css("border-color", "#BDC3C7");
		$("#grd_level").css("border-color", "#BDC3C7");
		$("#grd_scl").css("border-color", "#BDC3C7");
		$("#mult_sel").css("border-color", "red");
		$('#message_span').html('Select Degree!!');
		$('#alert_div').show();
		return false;
	}
}

/*----------*/
/*USER Login*/
/*----------*/

function submitLoginuser()
{
	var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	var loginusername   = $.trim($("#loginusername").val());
	var loginpassword   = $.trim($("#loginpassword").val());
    var return_flag = 0;
        
	if(loginpassword=="" || loginpassword.length < 6)
	{
		if(!loginpassword)
			$('#message_span').html('Please enter your password!!');
		else if(loginpassword.length < 6)
			$('#message_span').html('Enter a valid password!!');
		$('#alert_div').show();
		$("#loginpassword").css("border-color", "red");
		return_flag    =   1;
	}
	if(loginusername=="" || !filter.test(loginusername))
	{
		if(!loginusername)
			$('#message_span').html('Please enter your username!!');
		else if(!filter.test(loginusername))
			$('#message_span').html('Enter a valid username(email)!!');
		$('#alert_div').show();
		$("#loginusername").css("border-color", "red");
		return_flag    =   1;
	}
	if(return_flag == 0)
	{
		$('#alert_div').hide();
		$("#loginusername").css("border-color", "#BDC3C7");
		$("#loginpassword").css("border-color", "#BDC3C7");
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "ajax_loginchecking",
			data: "loginusername="+loginusername+"&loginpassword="+loginpassword, //data
			async:false,
			success: function(response) {
				if(response=='1')
				{
					window.location = "discover";
				}
				else
				{
					$('#message_span').html('Invalid login info!!');
					$('#alert_div').show();
					$("#loginusername").css("border-color", "red");
					$("#loginpassword").css("border-color", "red");
				}
			} 
		});
	}
}

/*--------------*/
/*Manage Account*/
/*--------------*/

function ajax_manage_account_step1()
{
	var reslt=regFieldcheck();
	if(reslt!=false)
	{
		var fname= $("#firstname").val();
		var lname= $("#lastname").val();
		var email= $("#youremail").val();
		var pass= $("#new_password").val();
		var objk	=	document.getElementsByName('chalngwhosets[]');
		if(objk[0].checked==true)
		{
			var gender= document.getElementsByName('chalngwhosets[]')[0].value;
		}
		else
		{
			var gender= document.getElementsByName('chalngwhosets[]')[1].value;
		}
		var ebay_buz_unit= $("#unit_info").val();
		var ebay_buz_loc= $("#loc_info").val();
		
                var email_noti1= 0;
		var email_noti2= 0;
                
                if($("#emailnot").is(':checked'))
                    email_noti1= $("#emailnot").val();
                if($("#emailnot1").is(':checked'))
                    email_noti2= $("#emailnot1").val();
                
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "users/ajax_manage_account_step1",
			data: "fname="+fname+"&lname="+lname+"&email="+email+"&pass="+pass+"&gender="+gender+"&ebay_buz_unit="+ebay_buz_unit+"&ebay_buz_loc="+ebay_buz_loc+"&email_noti1="+email_noti1+"&email_noti2="+email_noti2,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "manage_account_step2";
				}
			}
		});
	} 
}

function ajax_manage_account_step2 ()
{
	var reslt=regstep2Fieldcheck();
	if(reslt!=false)
	{
		var grd_year= $("#grd_year").val();
		var grd_level= $("#grd_level").val();
		var grd_scl= $("#grd_scl").val();
		var mult_sel= $("#mult_sel").val();
		var sub_cat=  $("#mult_"+mult_sel).val();
		
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "users/ajax_manage_account_step2",
			data: "grd_year="+grd_year+"&grd_level="+grd_level+"&grd_scl="+grd_scl+"&mult_sel="+mult_sel+"&sub_cat="+sub_cat,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "manage_account_step3";
				}
			}
		});
	}
}

function ajax_manage_account_step3()
{
	var hobby= document.getElementsByClassName("tagsinput")[0].value;
	var reslt=regstep3Fieldcheck();
	if(reslt!=false)
	{
		$.ajax({  //Make the Ajax Request
			type: "POST",  
			url: "users/ajax_manage_account_step3",
			data: "hobby="+hobby,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "view_profile";
				}
			}
		});
	}	
}