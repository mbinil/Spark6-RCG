<!--Right said start-->           
<div class="container_right">
<div class="alert alert-success" style="display:none;" id="levelalert">
	<button class="close fui-cross" data-dismiss="alert" type="button"></button>
	Level threshold successfully set.
</div>
<h1>Levels</h1>
<h3>This threshold is what users much reach to advance to the next level.</h3>
<br />
<div class="threshold_container">Threshold
<input type="hidden" id="threshold" name="threshold" value="<?php echo $levelthreshold; ?>" />
<div class="threshold">
    <input type="text" id="custom-level" placeholder="" value="" class="form-control spinner">
</div>
          The user will advance the next level every 10,000 points.
</div>
<script type="text/javascript">
$(document).ready(function() { 
	var trd = $("#threshold").val(); 
	$('#custom-level').val(trd);
});
$("#custom-level").on("spin", function(event, ui) { 
	//alert(ui.value); 
	$('#levelalert').css("display","none");
	$.ajax({  //Make the Ajax Request
		type: "POST",  
		url: "updatelevelthreshold",
		data: "LevelThreshold="+ui.value,  //data
		success: function(response) {
			if(response=='1')
			{
				$('#levelalert').css("display","block");
			}
		} 
	}); 
});
</script>
</div>    
<!--right said end-->  