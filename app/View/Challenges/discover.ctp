<?php $session_user_id = $this->Session->read("session_user_id"); 
echo $this->Html->script('discover.js');?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<style>
#ui-id-1 {
	z-index: 1000;	
}
.tab-content {
    border: none;
    margin-bottom: 0px;
    padding: 0px;
    position: relative;
    z-index: 1;
}
.tabset .Health .ico {
    background-position: -3px -1494px;
}
</style>
<!-- main content block -->
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
    <div id="main">
        <h1>
            Discover Fun Challenges.
            <input type='hidden' name='parenthiddn' id='parenthiddn' />
        </h1>
        <div class="clear"></div>
        <!----Error message div------------------>
          <div class="alert" id="alert_div_discover" style="background-color: #FF6A6A;border-color: red;color:#FFFFFF;width:700px;display:none;">
            <button type="button" data-dismiss="alert1" class="close fui-cross" onclick="javascript:$('#alert_div_discover').hide();"></button>
            <span id="message_span_discover"></span>	
          </div>
        <!--------------------------------------->
        <!-- two columns section -->
        <div id="two-columns">
            <!-- challenges -->
            <section id="content" class="main-column alignright" style="width: 74% !important;">
                <div class="tabs-area">
                    <div id="challenge_total_div" class="tab-content ajax-holder">
                        <!-- article -->
                        <?php echo $challenges;?>
                    </div>
                </div>
            </section>

            <!-- sidebar -->
            <aside id="sidebar" class="main-column alignleft">
                <h1>Life Balance</h1>
                <!-- tabs navigation -->
                <nav>
                    <ul class="tabset">
                        <li class="parent_class" id="all_li_id">
							<a href="javascript:void(0);" onclick="showChallenge(this,'parent','','')" class="active" data-default="#0077c9" data-hover="#ffffff" >
								<span>All</span>
								<em class="mask"><strong class="mask-frame"></strong></em>
							</a>
						</li>
                        <?php foreach ($parent_category as $key => $value) { ?>
						<li class="parent_class">
							<a href="javascript:void(0);" onclick="showChallenge(this,'parent','','<?php echo $value['Category']['id'];?>')" class="<?php echo $value['Category']['title'];?>" data-default="#0077c9" data-hover="#ffffff">
								<em class="ico"></em>
								<em class="ico-hover"></em>
								<span><?php echo $value['Category']['title'];?></span>
								<em class="mask"><strong class="mask-frame"></strong></em>
							</a>
						</li>
                        <?php } ?>
                    </ul>
                </nav>
                <h1>Categories</h1>
                <!-- side navigation -->
                <nav class="side-nav" id="child_category_side_nav">
                    <?php echo $child_category; ?>
                </nav>
            </aside>
        </div>
    </div>
</div>
<?php 
function getHourMinutes($from,$to)
{
    $now    =   date("Y-m-d h:i:s A");
    
    $to      =   date('Y-m-d', strtotime($to));

    
    
    $dtA = new DateTime($from);
    $dtB = new DateTime(date('Y-m-d').' 00:00:00');

    if ( $dtA >= $dtB ) 
    {
      $start_date = new DateTime($now);
        $since_start = $start_date->diff(new DateTime($to.' 11:59:59 PM'));
        $since_start->days;
        $since_start->y;
        $since_start->m;
        $since_start->d;
        $since_start->h;
        $since_start->i;
        $since_start->s;

        if($since_start->h != 0)
            return $since_start->h." hour ".$since_start->i." minutes";
        else
            return $since_start->i." minutes";
    }
    else
        return '';
}
?>

<div id="dialog_host_this" style="display: none;" >
    <?php echo $this->element('element_host_challenge_step1'); ?>
</div>
<script>
    setInterval(function(){get_fb();}, 120000);
    
    function get_fb()
    {
        $.ajax({
            type: "POST",  
            url: 'ajax_challenge_checking',
            data: "",
            success: function(response) {
                if(response == 1)
                    showChallenge(this,'parent','','');
            } 
        });
    }
</script>