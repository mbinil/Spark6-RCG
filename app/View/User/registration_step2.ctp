<?php
	//print_r($this->Session->read("newreginfo"));
?>
<link href="<?php echo Router::url('/app/webroot/css/multiple-select.css',true); ?>" rel="stylesheet" />
<script src="<?php echo Router::url('/app/webroot/js/jquery.multiple.select.js',true); ?>"></script>
<script src="<?php echo Router::url('/app/webroot/js/multiple-select.jquery.json',true); ?>"></script>
<script>
$('select').multipleSelect();

function ajax_reg_step2 ()
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
		url: "users/ajax_registration_step2",
		data: "grd_year="+grd_year+"&grd_level="+grd_level+"&grd_scl="+grd_scl+"&mult_sel="+mult_sel+"&sub_cat="+sub_cat,  //data
		success: function(response) {
		
		if(response=='1')
			{
				window.location = "registration_step3";
				
			}
		}
	});
	}
	
}

function degree_fn(val) 
{
if(val=="Agriculture")
{
document.getElementById("mult_Agriculture").style.display="block";
document.getElementById("mult_Architecture").style.display="none";
document.getElementById("mult_Arts").style.display="none";

}
if(val=="Architecture")
{
document.getElementById("mult_Agriculture").style.display="none";
document.getElementById("mult_Architecture").style.display="block";
document.getElementById("mult_Arts").style.display="none";

}
if(val=="Arts")
{
document.getElementById("mult_Agriculture").style.display="none";
document.getElementById("mult_Arts").style.display="block";
document.getElementById("mult_Architecture").style.display="none";
}
}

</script>
<!-- jQuery File Upload Dependencies -->
<?php 
$reg_array = $this->Session->read("newreginfo");
?>
<div id="main">       
	<div id="userreg">  
		<div class="sitemap_nav" style="margin-top:20px;width:100%; ">
			<ul class="nav nav-pills">
			  <li ><a href="registration_step1">Account Info</a></li>
			  <li class="active"><a href="registration_step2">Education</a></li>
			  <li><a>Interests</a></li>
			  <li><a>SAVE</a></li>
			</ul>
		</div>
		<div class="clear"></div>
		<hr style="border-color:#ccc;"/>            
		<div class="container_left" style="border:none;">
			<div class="btn_next">
			  <a href="javascript:ajax_reg_step2();" class="btn btn-primary btn-block" >Next<span class="fui-arrow-right pull-right"></span></a>
			</div>
			<h1>Education Information</h1>
			<h3>Tell us a bit about your background.</h3>
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
					
					
					<div class="discrption_label">Graduation Year</div>
					<div class="clear"></div>
					<div style="margin:0px; float:left;">
						<select name="grd_year" class="select-block" id="grd_year">
							<option value="" >Select a year</option>
							<option value="2013" <?php if(isset($reg_array['user_grd_year']) && $reg_array['user_grd_year']=='2013' ) { ?> selected="selected" <?php } ?>>2013</option>
							<option value="2012" <?php if(isset($reg_array['user_grd_year']) && $reg_array['user_grd_year']=='2012' ) { ?> selected="selected" <?php } ?>>2012</option>
							<option value="2011" <?php if(isset($reg_array['user_grd_year']) && $reg_array['user_grd_year']=='2011' ) { ?> selected="selected" <?php } ?>>2011</option>
							<option value="2010" <?php if(isset($reg_array['user_grd_year']) && $reg_array['user_grd_year']=='2010' ) { ?> selected="selected" <?php } ?>>2010</option>
						</select>
					</div>
					<div class="clear"></div>
					<div class="discrption_label">Graduation Level</div>
					<div class="clear"></div>
					<div style="margin:0px; float:left;">
						<select name="grd_level" class="select-block" id="grd_level">
							<option value="">Select a level</option>
							<option value="masters" <?php if(isset($reg_array['user_grd_level']) && $reg_array['user_grd_level']=='masters' ) { ?> selected="selected" <?php } ?>>Masters</option>
						</select>
					</div>
					<div class="clear"></div>
					<div class="discrption_label">School Name</div>
					<div class="clear"></div>
					<div style="margin:0px; float:left;">
						<select name="grd_scl" class="select-block" id="grd_scl">
							<option value="">Select a School</option>
							<option value="california state university- chico" <?php if(isset($reg_array['user_grd_schl']) && $reg_array['user_grd_schl']=='california state university- chico' ) { ?> selected="selected" <?php } ?>>California State University- Chico</option>
						</select>
					</div>
					<div class="clear"></div>
					<div class="discrption_label">Degree</div>

					<div align="left" style="width:385px; float:left;">
					<select name="mult_sel" id="mult_sel" multiple="multiple" style="font-size:14px; width:100%;" onclick="degree_fn(this.value);">
					<option value="" <?php if(!isset($reg_array['user_grd_degree'])) { ?>selected="selected" <?php } ?>>Select an option</option>
					<option value="Agriculture" <?php if(isset($reg_array['user_grd_degree']) && $reg_array['user_grd_degree']=='Agriculture' ) { ?> selected="selected" <?php } ?>>Agriculture</option>
					<option value="Architecture" <?php if(isset($reg_array['user_grd_degree']) && $reg_array['user_grd_degree']=='Architecture' ) { ?> selected="selected" <?php } ?>>Architecture and Planning</option>
					<option value="Arts" <?php if(isset($reg_array['user_grd_degree']) && $reg_array['user_grd_degree']=='Arts' ) { ?> selected="selected" <?php } ?>>Arts</option>
					</select>
					</div>
					<div align="right" style="width:385px; float:right;">
					<?php if(isset($reg_array['user_grd_degree']) && $reg_array['user_grd_degree']=='Agriculture' ) { ?>
					<select name="mult_Agriculture" id="mult_Agriculture" multiple="multiple" style="font-size:14px; width:100%;">
					<?php } else { ?>
					<select name="mult_Agriculture" id="mult_Agriculture" multiple="multiple" style="font-size:14px; width:100%; display:none;">
					<?php } ?>
					<optgroup label="Agriculture">
					<option value="Agricultural Business" <?php if(isset($reg_array['user_grd_cat']) && in_array("Agricultural Business",explode(',',$reg_array['user_grd_cat']))) { ?> selected="selected" <?php } ?>>Agricultural Business</option>
					<option value="Agricultural  Technology" <?php if(isset($reg_array['user_grd_cat']) && in_array("Agricultural  Technology",explode(',',$reg_array['user_grd_cat']))) { ?> selected="selected" <?php } ?>>Agricultural Business &amp; Technology</option>
					<option value="Agricultural Economics" <?php if(isset($reg_array['user_grd_cat']) && in_array("Agricultural Economics",explode(',',$reg_array['user_grd_cat']))) { ?> selected="selected" <?php } ?>>Agricultural Economics</option>
					 </optgroup>
					</select>
					<?php if(isset($reg_array['user_grd_degree']) && $reg_array['user_grd_degree']=='Architecture' ) { ?>
					<select name="mult_Architecture" id="mult_Architecture" multiple="multiple" style="font-size:14px; width:100%;">
					<?php } else { ?>
					<select name="mult_Architecture" id="mult_Architecture" multiple="multiple" style="font-size:14px; width:100%; display:none;">
					<?php } ?>
					
					<optgroup label="Architecture and Planning">
					<option value="Architecture 1" <?php if(isset($reg_array['user_grd_cat']) && in_array("Architecture 1",explode(',',$reg_array['user_grd_cat']))) { ?> selected="selected" <?php } ?>>Architecture 1</option>
					<option value="Architecture 2" <?php if(isset($reg_array['user_grd_cat']) && in_array("Architecture 2",explode(',',$reg_array['user_grd_cat']))) { ?> selected="selected" <?php } ?>>Architecture 2</option>
					<option value="Architecture 3" <?php if(isset($reg_array['user_grd_cat']) && in_array("Architecture 3",explode(',',$reg_array['user_grd_cat'])))  { ?> selected="selected" <?php } ?>>Architecture 3</option>
					 </optgroup>
					</select>
					
					<?php if(isset($reg_array['user_grd_degree']) && $reg_array['user_grd_degree']=='Arts' ) { ?>
					<select name="mult_Arts" id="mult_Arts" multiple="multiple" style="font-size:14px; width:100%;">
					<?php } else { ?>
					<select name="mult_Arts" id="mult_Arts" multiple="multiple" style="font-size:14px; width:100%; display:none;">
					<?php } ?>
					<optgroup label="Arts">
					<option value="Arts 1" <?php if(isset($reg_array['user_grd_cat']) && in_array("Arts 1",explode(',',$reg_array['user_grd_cat'])))  { ?> selected="selected" <?php } ?>>Arts 1</option>
					<option value="Arts 2" <?php if(isset($reg_array['user_grd_cat']) &&  in_array("Arts 1",explode(',',$reg_array['user_grd_cat']))) { ?> selected="selected" <?php } ?>>Arts 2</option>
					<option value="Arts 3" <?php if(isset($reg_array['user_grd_cat']) &&  in_array("Arts 1",explode(',',$reg_array['user_grd_cat']))) { ?> selected="selected" <?php } ?>>Arts 3</option>
					 </optgroup>
					</select>
					</div>
	</div>
				
			</div>
		</div>   
		<div class="clear"></div>
		<br /> 
	</div>
</div>