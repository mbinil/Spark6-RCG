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
</style>
<!-- main content block -->
<div class="container_left" style="width:100% !important; border: 1px solid #fff;">
    <div id="main">
        <h1>
            Discover Fun Challenges.
            <input type='hidden' name='parenthiddn' id='parenthiddn' />
        </h1>
        <!-- two columns section -->
        <div id="two-columns">
            <!-- challenges -->
            <section id="content" class="main-column alignright" style="width: 74% !important;">
                <div class="tabs-area">
                    <div id="challenge_total_div" class="tab-content ajax-holder">
                        <!-- article -->

                        <?php foreach ($challenges as $key => $value) { ?>
                            <div class="column-holder" id='challenge_individual_<?php echo $value['Challenge']['id']; ?>'>
                                <article class="column">
                                    <div class="visual-block">
                                        <img src="<?php echo Router::url('/', true); ?>img/challengeuploads/cropped/cropped<?php echo $value['Challenge']['hero_image']; ?>" width="710" height="249" alt="image description" class="bg">
                                        <figure><img class="alignleft" src="<?php echo Router::url('/', true); ?>img/challengeuploads/<?php echo $value['Challenge']['hero_image']; ?>" width="324" height="219" alt="image description"></figure>
                                        <strong class="title">Host This.</strong>
                                        <span class="label blue"></span>
                                    </div>
                                    <div class="desctiption">
                                        <a href="#" class="more" style="background: url('<?php echo Router::url('/', true); ?>img/badgecolor/<?php echo $value['badgecombo']['comboimg']; ?>')">more</a>
                                        <div class="txt">
                                                <h2><?php echo $value['Challenge']['name']; ?></h2>
                                                <p><?php echo $value['Challenge']['learn_more']; ?></p>
                                        </div>
                                    </div>
                                    <ul class="meta">
                                        <li>In <a href="#"><?php echo $value['categorie']['title']; ?></a></li>
                                        <li class="difficulty easy"><span><?php echo $value['difficulty']['title']; ?> Difficulty</span></li>
                                        <li class="people"><span>60 Finished This</span></li>
                                        <li class="points increase"><span>0 Points</span></li>
                                    </ul>
                                    <?php if(getHourMinutes($value['Challenge']['start_date'],$value['Challenge']['end_date'])) { ?>
                                        <div class="notification">
                                            <p>Starts in <?php echo getHourMinutes($value['Challenge']['start_date'],$value['Challenge']['end_date']); ?>. Join The Challenge!</p>
                                        </div>
                                    <?php } ?>
                                </article>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>

            <!-- sidebar -->
            <aside id="sidebar" class="main-column alignleft">
                <h1>Life Balance</h1>
                <!-- tabs navigation -->
                <nav>
                    <ul class="tabset">
                        <li><a href="javascript:void(0);" onclick="showChallenge(this,'parent','','')" class="active all" data-default="#0077c9" data-hover="#ffffff" ><span>All</span><em class="mask"><strong class="mask-frame"></strong></em></a></li>
                        <?php foreach ($parent_category as $key => $value) { ?>
                            <li>
                                <a href="javascript:void(0);" onclick="showChallenge(this,'parent','','<?php echo $value['Category']['id'];?>')" class="health" data-default="#0077c9" data-hover="#ffffff">
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
                    <ul>
                        <li><a href="javascript:void(0);" onclick="showChallenge(this,'child','','')" >All</a></li>
                        <?php foreach ($child_category as $key => $value) { ?>
                            <li><a href="javascript:void(0);" onclick="showChallenge(this,'child','','<?php echo $value['Category']['id'];?>')" ><?php echo $value['Category']['title'];?></a></li>
                        <?php } ?>
                    </ul>
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