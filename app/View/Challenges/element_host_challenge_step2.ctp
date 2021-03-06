<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<?php 
echo $this->Html->script('host_challenge.js');
?>
<div id="main">       
	<div id="host_challenge_step1">  
		<div class="sitemap_nav" style="margin-top:20px;width:100%; ">
                    <input type="hidden" id="step" value="2"/>
			<ul class="nav nav-pills">
                            <li><a>Pick participants</a></li>
			  <li class="active"><a href="host_challenge_step2" >Schedule</a></li>
			  <li><a>SAVE</a></li>
			</ul>
		</div>
		<div class="clear"></div>
		<hr/>            
		<div class="container_left">
			<div class="btn_next">
			  <a href="javascript:host_challenge_save('element');" class="btn btn-primary btn-block" >Save<span class="fui-arrow-right pull-right"></span></a>
			</div>
			<h1>When should the challenge start?</h1>
			<h3>Start now or any point in the future.</h3>
			<hr/>
			<div class="clear"></div>
			<!----Error message div------------------>
			<div class="alert" id="alert_div_dialogue" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
				<button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div_dialogue').hide();"></button>
				<span id="message_span_dialogue"></span>	
			</div>
			<!--------------------------------------->
			<div class="host_challenge_step2">
				<div style="margin:0px; width:92%; float:left;">
                                    <?php echo $user2_html; ?>
				</div>
			</div>
                        
		</div>   
		<div class="clear"></div>
		<br /> 
                <div style="margin:0px; width:79%; float:left;">
                    <hr/>
                </div>
                <div class="clear"></div>
                <div style="margin:0 0 0 50px; width:79%; float:left;">
                    <h3>Start challenge on</h3>
                    <div id="datepicker-from"></div>
                </div>
                <div class="clear"></div>
                <div style="margin:10px 0 0 50px; width:79%; float:left;">
                    <h3>At</h3>
                    <?php $eBayBusinessUnit = Configure::read('HostTimeInterval'); ?>
                    <select name="time_host" id="time_host">
                        <option value="">Select</option>
                        <?php foreach ($eBayBusinessUnit as $key => $value) { ?>
                            <option value="<?php echo $key;?>"><?php echo $value;?></option>;
                        <?php }?>
                    </select>
                </div>
                <div style="margin:10px 0 0 50px; width:79%; float:left;">
                    <input type="checkbox" name="check1" id="check1" value="0" onclick="changecheck1(this)" /><h3>Allow people to invite their friends</h3>
                </div>
                <div style="margin:10px 0 0 50px; width:79%; float:left;">
                    <input type="checkbox" name="check2" id="check2" value="0" onclick="changecheck2(this)" /><h3>Allow anyone to join(will be listed as an Open Challenge)</h3>
                </div>
	</div>
</div>
<script>
    $(function() {
        $( "#datepicker-from" ).datepicker({ minDate: 0,onSelect: function( selectedDate ) {
                        changeDate();
          }});
    });
</script>