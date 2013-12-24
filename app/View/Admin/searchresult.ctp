<!--Right said start-->   
<script>
$('#search-query-1').val('<?php echo $search_keyword; ?>');
</script>
<?php //print_r($admin_user_details); ?>
<div class="container_left">
    <i style="font-size: 3em; font-weight: bold;">Search Results</i>
    <h3>for keyword "<?php echo $search_keyword; ?>"</h3>

    <div class="clear"></div>

<!-------------Admin user details manipulation is starting here ----------------------->
    
    <?php if( count($admin_user_details) > 0 ) { ?>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12" style="font-weight: bold; font-size: 1.8em;margin:1em 0 2em 0">Matching Admin Users</div>
        </div>
        <div class="clear"></div>
    
    <?php for($i=0;$i<count($admin_user_details);$i++) {        
            if($i == 0 || $i%2 == 0 ) {
    ?> 
        <div class="row" style="margin-top: 10px;">
    <?php } ?>
            <div class="col-md-6">
                <div class="row">
                    <div align="center" class="col-md-5" style="font-weight: bold;">
                        <?php $file_name= $admin_user_details[$i]['Admin']['icon']; 
                            if($file_name && file_exists("img/adminuseruploads/".$file_name)) { ?>
                                <img width="100" height="100" border="0" style="border-radius: 50px; background-color:#999999;" src="<?php echo Router::url('/', true); ?>img/adminuseruploads/<?php echo $file_name; ?>" >
                        <?php } else { ?>
                                <img width="100" height="100" border="0" style="border-radius: 50px;" src="<?php echo Router::url('/', true); ?>img/adminuseruploads/no_user_img.png">
                        <?php } ?>
                        <br/> 
                        <font color="#64a0c8"><?php echo $admin_user_details[$i]['Admin']['admin_firstname']." ".$admin_user_details[$i]['Admin']['admin_lastname']; ?></font>
                    </div>
                    <div class="col-md-7" style="margin-top: 20px; font-weight: bold;">
                        Level 10|10235 points <br/>
                        Recently completed:
                    </div>
                </div>
            </div>
           
            
   <?php if($i%2 != 0 ) { ?>
                </div>
        
   <?php } if( $i%2 == 0 && ( $i == ( count($admin_user_details) - 1 ) ) ) { ?>
        </div>
    <?php } } }?>


<!-------------Admin user details manipulation is ending here ----------------------->


<!-------------User details manipulation is starting here ---------------------------->

    <?php if( count($user_details) > 0 ) { ?>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12" style="font-weight: bold; font-size: 1.8em;margin:3em 0 2em 0;">Matching Users</div>
        </div>
        <div class="clear"></div>

    <?php for($i=0;$i<count($user_details);$i++) {        
            if($i == 0 || $i%2 == 0 ) {
    ?> 
        <div class="row" style="margin-top: 10px;">
    <?php } ?>
            <div class="col-md-6">
                <div class="row">
                    <div align="center" class="col-md-5" style="font-weight: bold;">
                        <?php $file_name= $user_details[$i]['User']['user_profile_picture']; 
                            if($file_name) { ?>
                                <img width="100" height="100" border="0" style="border-radius: 50px; background-color:#999999;" src="<?php echo Router::url('/img/useruploads/', true); ?><?php echo $file_name; ?>?type=large" >
                        <?php } else { ?>
                                <img width="100" height="100" border="0" style="border-radius: 50px;" src="<?php echo Router::url('/', true); ?>img/adminuseruploads/no_user_img.png">
                        <?php } ?>
                        <br/> 
                        <font color="#64a0c8"><?php echo $user_details[$i]['User']['user_firstname']." ".$user_details[$i]['User']['user_lastname']; ?></font>
                    </div>
                    <div class="col-md-7" style="margin-top: 20px; font-weight: bold;">
                        Level <?php echo $user_details[$i]['User']['user_level']; ?>|<?php echo $user_details[$i]['User']['user_points']; ?> points <br/>
                        Recently completed:
                    </div>
                </div>
            </div>


    <?php if($i%2 != 0 ) { ?>
                </div>

    <?php } if( $i%2 == 0 && ( $i == ( count($user_details) - 1 ) ) ) { ?>
        </div>
    <?php } } }?>

<!-------------User details manipulation is ending here ------------------------------>



<!-------------Challenge details manipulation is starting here ---------------------------->

    <?php if( count($challenge_details) > 0 ) { ?>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12" style="font-weight: bold; font-size: 1.8em;margin:3em 0 2em 0;">Matching Challenges</div>
        </div>
        <div class="clear"></div>

    <?php for($i=0;$i<count($challenge_details);$i++) {        
            if($i == 0 || $i%2 == 0 ) {
    ?> 
        <div class="row" style="margin-top: 10px;">
    <?php } ?>
            <div class="col-md-6">
                <div class="row">
                    <div align="center" class="col-md-5" style="font-weight: bold;">
                        <?php $file_name= $challenge_details[$i]['Challenge']['hero_image']; 
                            if($file_name && file_exists("img/challengeuploads/".$file_name)) { ?>
                                <img width="100" height="100" border="0" style="border-radius: 50px; background-color:#999999;" src="<?php echo Router::url('/', true); ?>img/challengeuploads/<?php echo $file_name; ?>" >
                        <?php } else { ?>
                                <img width="100" height="100" border="0" style="border-radius: 50px;" src="<?php echo Router::url('/', true); ?>img/adminuseruploads/no_user_img.png">
                        <?php } ?>
                    </div>
                    <div class="col-md-7" style="margin-top: 20px; font-weight: bold;">
                        <font color="#64a0c8"><?php echo $challenge_details[$i]['Challenge']['name']; ?></font><br/>
                        <?php echo $challenge_details[$i]['Challenge']['learn_more']; ?> <br/>
                    </div>
                </div>
            </div>


    <?php if($i%2 != 0 ) { ?>
                </div>

    <?php } if( $i%2 == 0 && ( $i == ( count($challenge_details) - 1 ) ) ) { ?>
        </div>
    <?php } } }?>

<!-------------Challenge details manipulation is ending here ------------------------------>



<!-------------Difficulty details manipulation is starting here ---------------------------->

    <?php if( count($difficulty_details) > 0 ) { ?>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12" style="font-weight: bold; font-size: 1.8em;margin:3em 0 2em 0;">Matching Difficulties</div>
        </div>
        <div class="clear"></div>

    <?php for($i=0;$i<count($difficulty_details);$i++) {        
            if($i == 0 || $i%2 == 0 ) {
    ?> 
        <div class="row" style="margin-top: 10px;">
    <?php } ?>
            <div class="col-md-6">
                <div class="row">
                    <div align="center" class="col-md-5" style="font-weight: bold;">
                        <?php $file_name= $difficulty_details[$i]['Difficulty']['decal']; 
                            if($file_name && file_exists("img/diffuploads/".$file_name)) { ?>
                                <img width="100" height="100" border="0" style="border-radius: 50px; background-color:#999999;" src="<?php echo Router::url('/', true); ?>img/diffuploads/<?php echo $file_name; ?>" >
                        <?php } else { ?>
                                <img width="100" height="100" border="0" style="border-radius: 50px;" src="<?php echo Router::url('/', true); ?>img/adminuseruploads/no_user_img.png">
                        <?php } ?>
                    </div>
                    <div class="col-md-7" style="margin-top: 20px; font-weight: bold;">
                        <font color="#64a0c8"><?php echo $difficulty_details[$i]['Difficulty']['title']; ?></font><br/>
                        <?php echo $difficulty_details[$i]['Difficulty']['description']; ?> <br/>
                    </div>
                </div>
            </div>


    <?php if($i%2 != 0 ) { ?>
                </div>

    <?php } if( $i%2 == 0 && ( $i == ( count($difficulty_details) - 1 ) ) ) { ?>
        </div>
    <?php } } }?>

<!-------------Difficulty details manipulation is ending here ------------------------------>



<!-------------Parent category details manipulation is starting here ---------------------------->

    <?php if( count($parent_cat_details) > 0 ) { ?>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12" style="font-weight: bold; font-size: 1.8em;margin:3em 0 2em 0;">Matching Parent category</div>
        </div>
        <div class="clear"></div>

    <?php for($i=0;$i<count($parent_cat_details);$i++) {        
            if($i == 0 || $i%2 == 0 ) {
    ?> 
        <div class="row" style="margin-top: 10px;">
    <?php } ?>
            <div class="col-md-6">
                <div class="row">
                    <div align="center" class="col-md-5" style="font-weight: bold;">
                        <?php $file_name= $parent_cat_details[$i]['Category']['decal']; 
                            if($file_name && file_exists("img/catuploads/".$file_name)) { ?>
                                <img width="100" height="100" border="0" style="border-radius: 50px; background-color:#999999;" src="<?php echo Router::url('/', true); ?>img/catuploads/<?php echo $file_name; ?>" >
                        <?php } else { ?>
                                <img width="100" height="100" border="0" style="border-radius: 50px;" src="<?php echo Router::url('/', true); ?>img/adminuseruploads/no_user_img.png">
                        <?php } ?>
                    </div>
                    <div class="col-md-7" style="margin-top: 20px; font-weight: bold;">
                        <font color="#64a0c8"><?php echo $parent_cat_details[$i]['Category']['title']; ?></font><br/>
                    </div>
                </div>
            </div>


    <?php if($i%2 != 0 ) { ?>
                </div>

    <?php } if( $i%2 == 0 && ( $i == ( count($parent_cat_details) - 1 ) ) ) { ?>
        </div>
    <?php } } }?>

<!-------------Parent category details manipulation is ending here ------------------------------>



<!-------------Child category details manipulation is starting here ---------------------------->

    <?php if( count($child_cat_details) > 0 ) { ?>
        <div class="row" style="margin-top: 20px;">
            <div class="col-md-12" style="font-weight: bold; font-size: 1.8em;margin:3em 0 2em 0;">Matching Child category</div>
        </div>
        <div class="clear"></div>

    <?php for($i=0;$i<count($child_cat_details);$i++) {        
            if($i == 0 || $i%2 == 0 ) {
    ?> 
        <div class="row" style="margin-top: 10px;">
    <?php } ?>
            <div class="col-md-6">
                <div class="row">
                    <div align="center" class="col-md-5" style="font-weight: bold;">
                        <?php $file_name= $child_cat_details[$i]['Category']['badgecolor']; 
                            if($file_name && file_exists("img/badgedesign/".$file_name)) { ?>
                                <img width="100" height="100" border="0" style="border-radius: 50px; background-color:#999999;" src="<?php echo Router::url('/', true); ?>img/badgedesign/<?php echo $file_name; ?>" >
                        <?php } else { ?>
                                <img width="100" height="100" border="0" style="border-radius: 50px;" src="<?php echo Router::url('/', true); ?>img/adminuseruploads/no_user_img.png">
                        <?php } ?>
                    </div>
                    <div class="col-md-7" style="margin-top: 20px; font-weight: bold;">
                        <font color="#64a0c8"><?php echo $child_cat_details[$i]['Category']['title']; ?></font><br/>
                    </div>
                </div>
            </div>


    <?php if($i%2 != 0 ) { ?>
                </div>

    <?php } if( $i%2 == 0 && ( $i == ( count($child_cat_details) - 1 ) ) ) { ?>
        </div>
    <?php } } }?>

<!-------------Child category details manipulation is ending here ------------------------------>

<?php if($total_count == 0) { ?>
<div class="row">
    <div align="center" class="col-md-12" style="font-weight: bold;">No Matching Records...</div>
</div>
<?php } ?>
</div>    
<!--right said end-->