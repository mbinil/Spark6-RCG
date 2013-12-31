<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<style>
.ui-datepicker {
	box-shadow: none;
	border: 7px solid #f6f6f6;
}
.ui-datepicker .ui-datepicker-prev {
	border-right: 2px solid #f6f6f6;
}
.ui-datepicker .ui-datepicker-next {
	border-left: 2px solid #f6f6f6;
}
.ui-datepicker .ui-datepicker-header {
	background-color: #f6f6f6;
	color:#3e4850;
	font-weight:bold;
}
.ui-datepicker .ui-datepicker-prev:hover, .ui-datepicker .ui-datepicker-next:hover {
	background-color: #f6f6f6;
}
.ui-datepicker .ui-datepicker-prev:active, .ui-datepicker .ui-datepicker-next:active {
	background-color: #f6f6f6;
}
#datepicker-from .ui-datepicker .ui-state-active {
	background-color: #62b483;
	color: #FFFFFF;
}
#datepicker-to .ui-datepicker .ui-state-active {
	background-color: #e65320;
	color: #FFFFFF;
}
.ui-datepicker td span, .ui-datepicker td a {
	min-width:33px;
}
.ui-datepicker .ui-icon-circle-triangle-w {
	border-color:rgba(0, 0, 0, 0) #000000 rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);
}
.ui-datepicker .ui-icon-circle-triangle-e {
	border-color:rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) #000000;
}

.ui-corner-all, .ui-corner-bottom, .ui-corner-right, .ui-corner-br {
    border-bottom-right-radius: 10px;
}
.ui-corner-all, .ui-corner-bottom, .ui-corner-left, .ui-corner-bl {
    border-bottom-left-radius: 10px;
}
.ui-corner-all, .ui-corner-top, .ui-corner-right, .ui-corner-tr {
    border-top-right-radius: 10px;
}
.ui-corner-all, .ui-corner-top, .ui-corner-left, .ui-corner-tl {
    border-top-left-radius: 10px;
}
.ui-widget-header {
    background-color: #B2B2B2;
}
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {
    background-color: #B2B2B2;
    border: 1px solid #B2B2B2;
}
.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus {
    background-color: #B2B2B2;
    border: 1px solid #B2B2B2;
}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
    background-color: #B2B2B2;
    border: 1px solid #B2B2B2;
}
.ui-icon-circle-triangle-w {
    background-position: 25px -192px;
}
.ui-icon-circle-triangle-e {
    background-position: 0 -192px;
}
.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
	background: none;
}
.ui-datepicker td span, .ui-datepicker td a {
    padding: 0;
    text-align: center;
}
.btn-info {
    background-color: #CCC !important;
	color:#666 !important;
}
.dropdown-menu li.active > a, .dropdown-menu li.selected > a, .dropdown-menu li.active > a.highlighted, .dropdown-menu li.selected > a.highlighted {
    background: none repeat scroll 0 0 #CCC !important;
	color:#666 !important;
}
.col-md-3 {
    width: 12%;
}
.col-md-9 {
    width: 87%;
}
.container_left {
    border-right: none;
    float: left;
    padding-right: 15px;
    width: 100%;
}
</style>
<?php 
echo $this->Html->script('host_challenge.js');
?>
<div id="main">       
	<div id="host_challenge_step1" style="padding-bottom:50px; height:900px;">  
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
			  <a href="javascript:host_challenge_save('');" class="btn btn-primary btn-block" >Save<span class="fui-arrow-right pull-right"></span></a>
			</div>
			<h1>When should the challenge start?</h1>
			<h3>Start now or any point in the future.</h3>
			<div style="margin:0px; width:100%; float:left;">
				<hr/>
			</div>
			<div class="clear"></div>
			<!----Error message div------------------>
			<div class="alert" id="alert_div" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
				<button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div').hide();"></button>
				<span id="message_span"></span>	
			</div>
			<!--------------------------------------->
			<div class="host_challenge_step2">
				<div style="margin:0px; width:100%; float:left;">
                    <?php echo $user2_html; ?>
				</div>
			</div>
		</div>   
		<div class="clear"></div>
		<div style="margin:0px; width:100%; float:left;">
			<hr/>
		</div>
		<div class="clear"></div>
		<div style="margin:0 0 0 0; width:100%; float:left;">
			<h3>Start challenge on</h3>
			<div id="datepicker-from"></div>
		</div>
		<div class="clear"></div>
		<div style="margin:10px 0 0 0; width:100%; float:left;">
			<h3>At</h3>
			<?php $eBayBusinessUnit = Configure::read('HostTimeInterval'); ?>
			<select name="time_host" id="time_host">
				<option value="">Select</option>
				<?php foreach ($eBayBusinessUnit as $key => $value) { ?>
					<option value="<?php echo $key;?>"><?php echo $value;?></option>;
				<?php }?>
			</select>
		</div>
		<div style="margin:10px 0 0 0; width:100%; float:left;">
			<input type="checkbox" name="check1" id="check1" value="0" onclick="changecheck1(this)" style="margin:11px 10px 0 0;" /><h3>Allow people to invite their friends</h3>
		</div>
		<div style="margin:0 0 0 0; width:100%; float:left;">
			<input type="checkbox" name="check2" id="check2" value="0" onclick="changecheck2(this)" style="margin:11px 10px 0 0;" /><h3>Allow anyone to join(will be listed as an Open Challenge)</h3>
		</div>
	</div>
</div>
<script>
    $(function() {

        var min_date    =   0;
<?php if($challenge_information[0]['Challenge']['host_set_start_date'] == 1) { ?>
        min_date    =   getDays('<?php echo date('Y-m-d',strtotime($challenge_information[0]['Challenge']['start_date'])); ?>', '');
<?php } ?>

        $( "#datepicker-from" ).datepicker({ minDate: min_date,onSelect: function( selectedDate ) {
          }});
      $( "#datepicker-from" ).datepicker( "setDate", min_date );
<?php if($challenge_information[0]['Challenge']['host_set_start_date'] == 1) { ?>
        $( "#datepicker-from" ).datepicker( "option", "disabled", true );
<?php } ?>
    
    });
    
    function getDays(date,val)
    {

            var d = new Date(date); // format that date and get the days of that date.

            var current_day   =   new Date(); // format current date and get the days of that date.

            var days = d - current_day; // days difference between two dates
			
            var diffS = days / 1000;    

            var diffM = diffS / 60;

            var diffH = diffM / 60;

            var diffD = diffH / 24;

            days = Math.floor(diffD);

            if(days >= 0)
			{
				return '+'+parseFloat( (days) + 1)+'D';
			}
            else
			{
                    return '-'+parseFloat( (days) + 1)+'D';
			}
    }
</script>