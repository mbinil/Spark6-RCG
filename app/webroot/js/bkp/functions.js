/*===============*/
/*Difficulty type*/
/*===============*/

/*Fetching values from step1 form. Storing to session array and sending to step2*/
function gottostep2()
{
	var difftitle = $.trim($("#difftitle").val());
	var diffdesp = $.trim($("#diffdesp").val());
        var step = $("#step").val();
	var diffstatus = $('#diffstatus').is(':checked');
	if(difftitle=="" || difftitle.length < 3)
	{
		$("#difftitle").css("border-color", "red");
	}
	else
	{
		$("#difftitle").css("border-color", "#BDC3C7");
	}
	if(diffdesp=="" || diffdesp.length < 3)
	{
		$("#diffdesp").css("border-color", "red");
	}
	else
	{
		$("#diffdesp").css("border-color", "#BDC3C7");
	}
	if(difftitle.length > 2 && diffdesp.length > 2)
	{
		$("#difftitle").css("border-color", "#BDC3C7");
		$("#diffdesp").css("border-color", "#BDC3C7");
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

/*Editing step 1 and sending the session array to step2*/
function editstep2()
{
	var diffid = $('#diffid').val();
	var difftitle = $.trim($("#difftitle").val());
	var diffdesp = $.trim($("#diffdesp").val());
	var diffstatus = $('#diffstatus').is(':checked');
	if(difftitle=="" || difftitle.length < 3)
	{
		$("#difftitle").css("border-color", "red");
	}
	if(diffdesp=="" || diffdesp.length < 3)
	{
		$("#diffdesp").css("border-color", "red");
	}
	if(difftitle.length > 2 && diffdesp.length > 2)
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
		$("#dragandrophandler").attr("id","dragandrophandlererror");
	}
	else
	{
		var imgArray = ["gif","png"];
		var img_type = fileuploaded.slice(-3);
		var availableimgExt = $.inArray(img_type, imgArray);
		if(availableimgExt < 0)
		{
			$("#dragandrophandler").attr("id","dragandrophandlererror");
		}
		else
		{
			$.ajax({  //Make the Ajax Request
				type: "POST",  
				url: "ajax_diffaddstep3",
				data: "",  //data
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
	var fileuploaded = $("#fileuploaded").val();
	if(fileuploaded=="")
	{
		$("#dragandrophandler").attr("id","dragandrophandlererror");
	}
	else
	{
		var imgArray = ["gif","png"];
		var img_type = fileuploaded.slice(-3);
		var availableimgExt = $.inArray(img_type, imgArray);
		if(availableimgExt < 0)
		{
			$("#dragandrophandler").attr("id","dragandrophandlererror");
		}
		else
		{
			$.ajax({  //Make the Ajax Request
				type: "POST",  
				url: "../ajax_diffeditstep3",
				data: "diffid="+diffid,  //data
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
function saveparentcat()
{	
	var pcattitle = $.trim($("#pcattitle").val());
	var pcatfileuploaded = $("#fileuploaded").val();
	var pcatstatus = $('#pcatstatus').is(':checked');
	if(pcattitle=="" || pcattitle.length < 3)
	{
		$("#pcattitle").css("border-color", "red");
	}
	if(pcatfileuploaded=="")
	{
		$("#dragandrophandler").attr("id","dragandrophandlererror");
	}
	else
	{
		var imgArray = ["gif","png"];
		var img_type = pcatfileuploaded.slice(-3);
		var availableimgExt = $.inArray(img_type, imgArray);
		if(availableimgExt < 0)
		{
			$("#dragandrophandler").attr("id","dragandrophandlererror");
		}
		else
		{
			$.ajax({  //Make the Ajax Request
				type: "POST",  
				url: "ajax_parentadd",
				data: "pcattitle="+pcattitle+"&pcatfileuploaded="+pcatfileuploaded+"&pcatstatus="+pcatstatus, //data
				success: function(response) {
					if(response=='1')
					{
						window.location = "categoryparent?success";
					}
				} 
			});
		}
	}
}

/*Editing step3 and saving it.*/
function saveparentcatedit()
{	
	var pcatid = $("#pcatid").val();
	var pcattitle = $.trim($("#pcattitle").val());
	var pcatfileuploaded = $("#fileuploaded").val();
	var pcatstatus = $('#pcatstatus').is(':checked');
	if(pcattitle=="" || pcattitle.length < 3)
	{
		$("#pcattitle").css("border-color", "red");
	}
	if(pcatfileuploaded=="")
	{
		$("#dragandrophandler").attr("id","dragandrophandlererror");
	}
	else
	{
		var imgArray = ["gif","png"];
		var img_type = pcatfileuploaded.slice(-3);
		var availableimgExt = $.inArray(img_type, imgArray);
		if(availableimgExt < 0)
		{
			$("#dragandrophandler").attr("id","dragandrophandlererror");
		}
		else
		{
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
	if(ccattitle=="" || ccattitle.length < 3)
	{
		$("#ccattitle").css("border-color", "red");
	}
	if(ccatparent=="")
	{
		alert("Select a parent category!!");
	}
	if(comboimg=="")
	{
		alert("Select a badge ring combo!!");	
	}
	if(ccattitle.length > 3 && ccatparent!="" && comboimg!="")
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

/*Editing step3 and saving it.*/
function savechildcatedit()
{	
	var ccatid = $("#ccatid").val();
	var ccattitle = $.trim($("#ccattitle").val());
	var ccatparent = $("#ccatparent").val();
	var comboimg = $("#comboimg").val();
	var ccatstatus = $('#ccatstatus').is(':checked');
	if(ccattitle=="" || ccattitle.length < 3)
	{
		$("#ccattitle").css("border-color", "red");
	}
	if(ccatparent=="")
	{
		alert("Select a parent category!!");
	}
	if(comboimg=="")
	{
		alert("Select a badge ring combo!!");	
	}
	if(ccattitle.length > 3 && ccatparent!="" && comboimg!="")
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
{	var ck_name = /^[a-zA-Z]{1}/;
	var first_name = $("#first_name").val();
	var last_name = $("#last_name").val();
	var user_name = $("#user_name").val();
	var email = $("#email").val();
	var password = $("#password").val();
	var role = $("#role").val();
	var adminuserfileuploaded = $("#fileuploaded").val();
	var adminuserstatus = $('#adminuserstatus').is(':checked');
	if($.trim(first_name) ==""||$.trim(first_name).length<3)
	{
		$("#first_name").css("border-color", "red");
	}
	if (!ck_name.test($.trim(first_name))) 
	{
		$("#first_name").css("border-color", "red");
	}
	if($.trim(last_name)=="")
	{
		$("#last_name").css("border-color", "red");
	}
        
	if($.trim(user_name)==""||$.trim(user_name).length<3)
	{
		$("#user_name").css("border-color", "red");
	}
	if($.trim(email)=="" ||$.trim(email).length<3)
	{
		$("#email").css("border-color", "red");
	}
	if (!validateEmail(email)) {
	   // alert('Email is not valid');
	   $("#email").css("border-color", "red");
	}
	if($.trim(password)=="")
	{
		$("#password").css("border-color", "red");
	}
	if(adminuserfileuploaded=="")
	{
		$("#dragandrophandler").attr("id","dragandrophandlererror");
	}
	if($.trim(role)=="")
	{
		//$("#role").css("border", "1px solid red !important");
		alert("Please select one role!");
	}
	if($.trim(first_name) !=""&&$.trim(first_name).length>=3 &&ck_name.test($.trim(first_name))&&$.trim(last_name)!=""&&$.trim(user_name)!=""&&$.trim(user_name).length>=3&&validateEmail(email)&&$.trim(password)!="")
	{
		var imgArray = ["gif","png"];
		var img_type = adminuserfileuploaded.slice(-3);
		var availableimgExt = $.inArray(img_type, imgArray);
		if(availableimgExt < 0)
		{
			$("#dragandrophandler").attr("id","dragandrophandlererror");
		}
		else     
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


/*Editing admin user saving it.*/
function saveadminuseredit()
{	
    var ck_name = /^[a-zA-Z]{1}/;
	var adminid = $("#adminid").val();
	var first_name = $("#first_name").val();
	var last_name = $("#last_name").val();
	var user_name = $("#user_name").val();
	var email = $("#email").val();
	var password = $("#password").val();
	var role = $("#role").val();
	var adminuserfileuploaded = $("#fileuploaded").val();
	var adminuserstatus = $('#adminuserstatus').is(':checked');
	if($.trim(first_name) ==""||$.trim(first_name).length<3)
	{
		$("#first_name").css("border-color", "red");
	}
	if (!ck_name.test($.trim(first_name))) 
	{
		$("#first_name").css("border-color", "red");
	}
	if($.trim(last_name)=="")
	{
		$("#last_name").css("border-color", "red");
	}
	if($.trim(user_name)==""||$.trim(user_name).length<3)
	{
		$("#user_name").css("border-color", "red");
	}
	if($.trim(email)=="" ||$.trim(email).length<3)
	{
		$("#email").css("border-color", "red");
	}
	if (!validateEmail(email)) {
		// alert('Email is not valid');
	   	$("#email").css("border-color", "red");
	}
	if($.trim(password)=="")
	{
		$("#password").css("border-color", "red");
	}
	if(adminuserfileuploaded=="")
	{
		$("#dragandrophandler").attr("id","dragandrophandlererror");
	}
	if($.trim(role)=="")
	{
		//$("#role").css("border-color", "red");
		alert("Please select one role!");
	}
	if($.trim(first_name) !=""&&$.trim(first_name).length>=3 &&ck_name.test($.trim(first_name))&&$.trim(last_name)!=""&&$.trim(user_name)!=""&&$.trim(user_name).length>=3&&validateEmail(email)&&$.trim(password)!="")
	{
		var imgArray = ["gif","png"];
		var img_type = adminuserfileuploaded.slice(-3);
		var availableimgExt = $.inArray(img_type, imgArray);
		if(availableimgExt < 0)
		{
			$("#dragandrophandler").attr("id","dragandrophandlererror");
		}
		else
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
	if($.trim(notification_email)=="")
	{
		$("#notification_email").css("border-color", "red");
	}
        if (!validateEmail(notification_email)) {
           // alert('Email is not valid');
           $("#notification_email").css("border-color", "red");
        }
	if (validateEmail(notification_email)&&$.trim(notification_email)!="")
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
	var challengename = $.trim($("#challengename").val());
	var badgetitle = $.trim($("#badgetitle").val());
	var dailycommit = $.trim($("#dailycommit").val());
	var why = $.trim($("#why").val());
	var how = $.trim($("#how").val());
	var learnmore = $.trim($("#learnmore").val());
	var repeatable = $('#repeatable').is(':checked');
	var status = $('#status').is(':checked');
	if(challengename=="" || challengename.length < 3)
	{
		$("#challengename").css("border-color", "red");
	}
	if(badgetitle=="" || badgetitle.length < 3)
	{
		$("#badgetitle").css("border-color", "red");
	}
	if(dailycommit=="" || dailycommit.length < 3)
	{
		$("#dailycommit").css("border-color", "red");
	}
	if(why=="" || why.length < 3)
	{
		$("#why").css("border-color", "red");
	}
	if(how=="" || how.length < 3)
	{
		$("#how").css("border-color", "red");
	}
	if(learnmore=="" || learnmore.length < 3)
	{
		$("#learnmore").css("border-color", "red");
	}
	if(challengename.length > 2 && badgetitle.length > 2 && dailycommit.length > 2 && why.length > 2 && how.length > 2 && learnmore.length > 2)
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
			data: "challengename="+challengename+"&badgetitle="+badgetitle+"&dailycommit="+dailycommit+"&why="+why+"&how="+how+"&learnmore="+learnmore+"&repeatable="+repeatable+"&status="+status,  //data
			success: function(response) {
				if(response=='1')
				{
					window.location = "challengeaddstep2";
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