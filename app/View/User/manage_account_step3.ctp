<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/select2/3.3.2/select2.css">
<link rel="stylesheet" type="text/css" href="<?php echo Router::url('../css/autostyle.css',true); ?>">
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/3.3.2/select2.js"></script>
<?php /*?><script type="text/javascript" src="<?php echo Router::url('../js/autoapp.js',true); ?>"></script>
<?php */?>
<link rel="stylesheet" type="text/css" href="<?php echo Router::url('../css/bootstrap-tokenfield.css',true); ?>">


<script type="text/javascript" src="<?php echo Router::url('../js/bootstrap-tokenfield.js',true); ?>"></script>
<script type="text/javascript">
function regstep3Fieldcheck()
{
	if(document.getElementById("demo-input-free-tagging").value=="")
	{
		$(".tagsinput").css("border-color", "red");
		$('#message_span').html('Enter your hobbies!!');
		$('#alert_div').show();
		return false;
	}
}
function hoby_fn()
{
	if(document.getElementById("demo-input-free-tagging").value!="")
	{
		$(".tagsinput").css("border-color", "#BDC3C7");
		$('#alert_div').hide();
	}
}
</script>
<?php //$Loggeduserinfo[0]['User'] = $this->Session->read("newreginfo"); ?>
<?php //print_r($Loggeduserinfo); ?>
<div id="main">       
	<div id="userreg">  
		<div class="sitemap_nav" style="margin-top:20px;width:100%; ">
			<ul class="nav nav-pills">
			  <li><a href="manage_account_step1">Account Info</a></li>
			  <li><a href="manage_account_step2">Education</a></li>
			  <li class="active"><a href="manage_account_step3">Interests</a></li>
			  <li><a>SAVE</a></li>
			</ul>
		</div>
		<div class="clear"></div>
		<hr style="border-color:#ccc;"/>            
		<div class="container_left" style="border:none;">
			<div class="btn_next">
			  <a href="javascript:ajax_manage_account_step3();" class="btn btn-primary btn-block" >SAVE</a>
			</div>
			<h1>What are your hobbies and interests?</h1>
			<h3>This info will help us match you withn collegues that have similar interests and passions.</h3>
			<hr style="border-color:#ccc;"/>
			<div class="clear"></div>
			<!----Error message div------------------>
			<div class="alert" id="alert_div" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
				<button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
				<span id="message_span"></span>	
			</div>
			<!--------------------------------------->
			<div class="registration_step1">
				<div style="margin:0px; width:82%; float:left;">
					
				<div style="width:100%;">
      <div style="width:65%; float:left;">
	  	<div style="margin:10px 0; font-weight:bold; font-size: 18px;">Related Challenge Tags:</div>
        <div id="tagsinput">
            <input name="tagsinput" value="<?php if(isset($Loggeduserinfo[0]['User']['user_hobbies'])) { echo $Loggeduserinfo[0]['User']['user_hobbies'];} ?>" onblur="hoby_fn()"  id="demo-input-free-tagging"/>
            <input type="hidden" id="challengetagWord" name="challengetagWord" value="" />
        </div>
		<!--<div class="multisel editors">
		  <div class="xfvvx"></div>
		</div>-->
      </div>
     
    </div>	
					
	</div>
				
			</div>
		</div>   
		<div class="clear"></div>
		<br /> 
	</div>
</div>
<script type="text/javascript">
        $(document).ready(function() {
		$('#demo-input-free-tagging').tokenfield({
  autocomplete: {
    source: <?php echo $usertags; ?>,
    delay: 100
  },
  showAutocompleteOnFocus: true
})
           
        });
        </script>