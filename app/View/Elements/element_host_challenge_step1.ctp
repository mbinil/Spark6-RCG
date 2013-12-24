<?php 
echo $this->Html->script('host_challenge.js');
?>
<div id="main">       
	<div id="host_challenge_step1">  
		<div class="sitemap_nav" style="margin-top:20px;width:100%; ">
                    <input type="hidden" id="challenge_id" value="<?php echo $challenge_id;?>"/>
                    <input type="hidden" id="step" value="2"/>
			<ul class="nav nav-pills">
			  <li class="active"><a href="host_challenge_step1" >Pick participants</a></li>
			  <li><a>Schedule</a></li>
			  <li><a>SAVE</a></li>
			</ul>
		</div>
		<div class="clear"></div>
		<hr/>            
		<div class="container_left">
			<div class="btn_next">
			  <a href="javascript:host_challenge_step1('element_');" class="btn btn-primary btn-block" >Next<span class="fui-arrow-right pull-right"></span></a>
			</div>
			<h1>Who would you like to invite?</h1>
			<h3>Please select from the list below.</h3>
			<hr/>
			<div class="clear"></div>
			<!----Error message div------------------>
			<div class="alert" id="alert_div" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
				<button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
				<span id="message_span"></span>	
			</div>
			<!--------------------------------------->
			<div class="host_challenge_step1">
				<div style="margin:0px; width:92%; float:left; border: 2px solid #BDC3C7;">
                                    <?php echo $user_html;?>
				</div>
			</div>
		</div>   
		<div class="clear"></div>
		<br /> 
	</div>
</div>