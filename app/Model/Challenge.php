<?php
class Challenge extends AppModel
{
   	var $name="Challenge";		
        public $session_user_id  =   '';
        
	public function getChallenges()
	{
		$challengesinfo = $this->find("all");
		return $challengesinfo;
	}
	
	public function getChallengebyId($id)
	{
		$challengesinfo = $this->find('all',array('conditions'=>array('id'=>$id)));
		return $challengesinfo;
	}
        
	public function getChallengebyCondition($conditions)
	{
		$challengesinfo = $this->find('all',array('conditions'=>$conditions));
		return $challengesinfo;
	}
	
	public function CheckChallengeAvailable($data)
	{
		$challengesinfo = $this->find('all',array('conditions'=>array('name'=>$data)));
		$availablecount = count($challengesinfo);
		return $availablecount;
	}
        
	/**
	 * Creating the condition for fetching the challenge.
	 * @param string $from parent,child,search
	 * @param integer|null $val may be parent id, child id, serch keyword, null 
	 * @param integer|null $parent parent id or null
	 * @return array $condition condition array
	 */
	public function getConditions($from, $val, $parent)
	{
		$condition   =   '';
		switch ($from) 
		{
			case 'parent':
				 if($val)
				 {
					 $condition   =  array('Challenge.parent_category' => $val, 'Challenge.status' => '1');
				 }
				 else
				 {
					 $condition   =  array('Challenge.status' => '1');
				 }
				 break;
			case 'child':
				 if($parent && $val)
				 {
					 $condition   =  array('Challenge.parent_category' => $parent, 'Challenge.child_category' => $val, 'Challenge.status' => '1');
				 }
				 else
				 {
					 if($parent)
						 $condition  =  array('Challenge.parent_category' => $parent, 'Challenge.status' => '1');
					 else if($val)
						 $condition  =  array('Challenge.child_category' => $val, 'Challenge.status' => '1');
					 else
						 $condition  =  array('Challenge.status' => '1');
				 }
				 break;
			case 'search':
				 $condition   =  array('OR'  =>  
					 array(  'Challenge.name like'  =>  "%$val%",
							 'Challenge.badge_title like'  =>  "%$val%",
							 'Challenge.daily_commitment like'  =>  "%$val%",
							 'Challenge.why like'  =>  "%$val%",
							 'Challenge.how like'  =>  "%$val%",
							 'Challenge.learn_more like'  =>  "%$val%"
						 ), 'Challenge.status' => '1'
					 );
				 break;
		}

		return $condition;
	}
	
	/**
	 * fetching the challenge value related to the conditions
	 * @param array $conditions
	 * @return array challenge array
	 */
	public function getValue($conditions)
	{
		return $this->find('all', array('fields'=>array('Challenge.*,badgecombo.comboimg,difficulty.decal,difficulty.title,categorie.id,categorie.title'),
				'joins' => array(
					array(
						'table' => 'badgecombos',
						'alias' => 'badgecombo',
						'type' => 'inner',
						'foreignKey' => false,
						'conditions'=> array('badgecombo.id = Challenge.badge_color')
					),
					array(
						'table' => 'difficulties',
						'alias' => 'difficulty',
						'type' => 'inner',
						'foreignKey' => false,
						'conditions'=> array(
							'difficulty.id = Challenge.difficulty'
						)
					),
					array(
						'table' => 'categories',
						'alias' => 'categorie',
						'type' => 'left',
						'foreignKey' => false,
						'conditions'=> array(
							'categorie.id = Challenge.parent_category'
						)
					)
				),
				'conditions' => $conditions
			)
		);
	}
	
	/**
	 * creating the challenge html part
	 * @param array $challenges challenge array
	 * @return string challenge html wil return
	 */
	public function getHtml($challenges)
	{
		$host_challenge_status  =   array(0,1,4,6);
		$return_html    =   '';
		foreach ($challenges as $key => $value) 
		{
			App::import('Model', 'Userchallenge');
			$Userchallenge = new Userchallenge();
			$get_host   =   $Userchallenge->getHostArray($value['Challenge']['id']);
			//echo "<pre>";print_r($get_host);exit;
			
			if(empty($this->session_user_id))
				$anchor =   '<strong class="title" style="line-height:1;"><a href="javascript:Loginuser();" style="cursor:pointer;">';
			else
				$anchor =   '<strong class="title"><a href="'.Router::url('/host_challenge_step1/'.$value['Challenge']['permalink'], true).'" style="cursor:pointer;">';
			
	$fullurl = Router::url('/', true);
			$class  =   'class="column-holder"';
			if(count($get_host) > 1)
					$class  =   'class="column-holder multi"';
			$return_html    .=   '<div '.$class.' id="challenge_individual_'.$value['Challenge']['id'].'">
									<article class="column">
									<div class="visual-block">
										<img src="'.$fullurl.'img/challengeuploads/background/'.$value['Challenge']['hero_image'].'" width="710" height="249" alt="image description" class="bg">
										<figure><a href="'.Router::url('/discover/'.$value['Challenge']['permalink'], true).'" style="cursor:pointer;"><img class="alignleft" src="'.$fullurl.'img/challengeuploads/'.$value['Challenge']['hero_image'].'" width="324" height="219" alt="image description"></a></figure>';
			$notification_time_div      =   '';
			if(count($get_host) == 0)
			{
				$date_flag  =   1;
				$date_val   =   $this->getHourMinutes($value['Challenge']['start_date'],'','');
				if($value['Challenge']['start_date'] && $date_val == '')
				{
					$date_flag  =   0;
				}
				if($date_flag  ==   1)
				{
					$return_html    .=   $anchor;
					if($this->session_user_id == '')
							$return_html    .=   'Login to ';
					$return_html    .=   'Host This.</a></strong>';
				}
			}
			else
			{
				$participant_host   =   $Userchallenge->getParticipantsArray(array('Userchallenge.user_challenge_status in (6,1)', 'Userchallenge.user_challenge_hostid' =>$get_host[0]['Userchallenge']['user_id'], 'Userchallenge.group_id' =>$get_host[0]['Userchallenge']['group_id']));
				$return_html        .=   '<div class="about">
											<div class="about-holder">
											<div class="person-info">
												<a href="#"><img height="101" width="100" alt="image description" src="'.$fullurl.'img/useruploads/'.$get_host[0]['user']['user_profile_picture'].'"></a>
												<dl>
												<dt>'.ucfirst($get_host[0]['user']['user_firstname']).'</dt>
												<dd>Host</dd>
												<dt>+'.count($participant_host).'</dt>
												<dd>Participants</dd>
												</dl>
											</div>
											<div class="persons-list"><ul>';

				if($arr =   $this->getHourMinutes($get_host[0]['Userchallenge']['started_date'],'','hour'))
				{
					if($arr['days'] == 0 && $arr['hour'] <= 3)
					{
						$notification_time_div    =   '<div class="notification" style="display:block;background: url(\''.$fullurl.'images/ico-44.png\') no-repeat scroll 0 0 #8C1400;">
							<p>Starts in '.$this->getHourMinutes($get_host[0]['Userchallenge']['started_date'],'','').'. Join The Challenge!</p>
						</div>';
					}
				}
				
				for($ps=0;$ps<count($participant_host);$ps++)
				{
					$return_html    .=   '<li><a href="#"><img height="50" width="50" alt="image description" src="'.$fullurl.'img/useruploads/'.$participant_host[$ps]['user']['user_profile_picture'].'"></a></li>';
				}
				$return_html    .=   '</ul></div></div></div>';
			}
			
			if(strlen($value['Challenge']['why']) > 340) {
				$string = substr($value['Challenge']['why'], 0, 340).'...<span style="color:#0077C9; cursor:pointer; font-size:12px;">read more.</span>';
			}
			else {
				$string = $value['Challenge']['why'];
			}
				
		   $return_html    .=   '<span class="label blue"></span>
									</div>
									<a href="'.Router::url('/discover/'.$value['Challenge']['permalink'], true).'" class="more" style="background: url(\''.$fullurl.'img/badgecolor/'.$value['badgecombo']['comboimg'].'\');cursor:pointer;">
									<div class="desctiption">
										<div class="more" style="background: url(\''.$fullurl.'img/badgecolor/'.$value['badgecombo']['comboimg'].'\');cursor:pointer;">more</div>
										<div class="txt">
												<h2>'.$value['Challenge']['name'].'</h2>
												<p>'.$string.'</p>
										</div>
									</div>
									</a>
									<ul class="meta">
										<li>In <a onclick="showChallenge(this,\'parent\',\'\',\''.$value['categorie']['id'].'\')" href="javascript:void(0);">'.$value['categorie']['title'].' Lifestyle</a></li>
										<li class="difficulty">
											<div style="margin: 0px;"><img src="'. Router::url('/', true) . 'img/diffuploads/' . $value['difficulty']['decal'] .'" border="0" width="25" style=" background-color:#CCC;" /></div>
											<span>'.$value['difficulty']['title'].' Difficulty</span></li>
										<li class="people"><span>60 Finished This</span></li>
										<li class="points increase"><span>0 Points</span></li>
									</ul>'.$notification_time_div.'</article>';

			if(count($get_host) > 1)
			{
				$return_html    .=   '<div class="open-block">
	<span class="opener">
			<a href="#" class="open">'.(count($get_host) - 1).' More Like This</a>
			<a href="#" class="close">Close</a>
	</span>
	<div class="slide" style="display: block;">
			<div class="host-block">
					<div class="host-this">
							<h2>Host This</h2>
							<a href="javascript:void(0);" onclick="pickAHost(\''.$value["Challenge"]["id"].'\',\'\',\''.$value["Challenge"]["permalink"].'\')"><img height="114" width="113" alt="image description" src="images/img-42.png"></a>
					</div>
					<span class="or">or</span>
					<div class="multi-host">
							<h2>Pick Host</h2><ul>';
				for($ld=0;$ld<count($get_host);$ld++) 
				{
					if($ld != 0)
					{
						$paricipants_arr    =   $Userchallenge->getParticipantsArray(array('Userchallenge.user_challenge_status in (6,1)', 'Userchallenge.user_challenge_hostid' =>$get_host[$ld]['Userchallenge']['user_id'], 'Userchallenge.group_id' =>$get_host[$ld]['Userchallenge']['group_id']));
						$return_html    .=   '<li><a href="javascript:void(0)" onclick="pickAHost(\''.$value["Challenge"]["id"].'\',\''.$get_host[$ld]['user']["id"].'\',\''.$value["Challenge"]["permalink"].'\')"><img height="101" width="100" alt="image description" src="'.$fullurl.'img/useruploads/'.$get_host[$ld]['user']['user_profile_picture'].'" ><span class="overlay"><strong class="number">+'.count($paricipants_arr).'</strong> Participants</span>';
						//. '<span class="time"></span></a></li>';
						if($arr = $this->getHourMinutes($get_host[$ld]['Userchallenge']['started_date'],'','hour'))
						{
							if($arr['days'] == 0 && $arr['hour'] <= 3)
							{
								$return_html    .=   '<span class="time"></span>';
							}	
						}
						$return_html    .=   '</a></li>';
					}
				}
				
			$return_html    .=   '
							</ul>
					</div>
			</div>
	</div>
</div>';
			}
			$return_html    .=   '</div>';
		}
		
		return $return_html;
	}
	
	public function getChallenge($status,$login_id)
	{
		$fullurl            =   Router::url('/', true);
		$chlnge_status      =   ($status=='active')?'(1)':'(0,6)';
		$person_list_class  =   ($status=='active')?'persons-list':'persons-list inner';
		App::import('Model', 'Userchallenge');
		$Userchallenge      =   new Userchallenge();
		$challenges_host    =   $Userchallenge->getChallengeHostArray(array('Userchallenge.user_challenge_status in '.$chlnge_status.'','Userchallenge.user_id' => $login_id));
		
		$html               =   '';
		
		foreach ($challenges_host as $key => $value) 
		{
			//getting the coming challenge host
			$challenge_host_arr =   $Userchallenge->getChallengeHostArray(array('Userchallenge.user_challenge_status in '.$chlnge_status.'','Userchallenge.challenge_id' => $value['Userchallenge']['challenge_id'],'Userchallenge.group_id' => $value['Userchallenge']['group_id'],'Userchallenge.user_challenge_hostid is null'));

			//getting the coming challenge participants
			$paricipants_arr    =   $Userchallenge->getParticipantsArray(array('Userchallenge.user_challenge_status in '.$chlnge_status.'', 'Userchallenge.user_challenge_hostid' =>$value['Userchallenge']['user_id'], 'Userchallenge.group_id' =>$value['Userchallenge']['group_id']));

			//checking the login person is the host of coming challenge
			$name   =   'Myself';
			if($login_id != $challenge_host_arr[0]['user']['id'])
				$name   =   $challenge_host_arr[0]['user']['user_firstname'];
				
			$html       .=   '<article class="column">
								<div class="visual-block">
								<img height="249" width="918" class="bg" alt="image description" src="'.$fullurl.'img/challengeuploads/background/'.$value['challenge']['hero_image'].'">
								<figure><img height="219" width="324" alt="image description" class="alignleft" src="'.$fullurl.'img/challengeuploads/'.$value['challenge']['hero_image'].'"></figure>
								<div class="about"><div class="about-holder">
								<div class="person-info">
									<a href="javascript:void(0);">
										<img height="101" width="100" alt="image description" src="'.$fullurl.'img/useruploads/'.$challenge_host_arr[0]['user']['user_profile_picture'].'">
									</a>
									<dl>
										<dt>'.$name.'</dt>
										<dd>Host</dd>
										<dt>+'.count($paricipants_arr).'</dt>
										<dd><a href="javascript:void(0);">Participants</a></dd>
									</dl>
								</div>

								<div class="'.$person_list_class.'">
								<ul>';
			
			foreach ($paricipants_arr as $key1 => $value1)
			{
				
				$html       .=   '<li><a href="javascript:void(0);"><img height="50" width="50" alt="image description" src="'.$fullurl.'img/useruploads/'.$value1['user']['user_profile_picture'].'"><span class="overlay" style="opacity: 0;"></span></a></li>';
			}

			$html       .=   '</ul></div>';
			$flag       =   0;//checking weather the noteblock need or not
			//checking the weather the challenge is active or waiting and give the join condition for login person if he is a participant of this challenge
			foreach ($paricipants_arr as $key1 => $value1)
			{
				if($status  !=  'active' && $value1['Userchallenge']['user_challenge_hostid'] && $value1['Userchallenge']['user_challenge_hostid'] != $login_id && $value1['Userchallenge']['user_id'] == $login_id)
				{
					$flag       =   1;
					$html       .=   '<div class="join-block">
									<h2>Join?</h2>
									<ul>
											<li><a class="join" href="javascript:void(0);" onclick="changeNotification(\'agree\',\''.$value1['Userchallenge']['id'].'\')">join<em class="mask" style="opacity: 0;"></em></a></li>
											<li><a class="reject" href="javascript:void(0);" onclick="changeNotification(\'reject\',\''.$value1['Userchallenge']['id'].'\')">reject<em class="mask" style="opacity: 0;"></em></a></li>
									</ul>
							</div>';
					break;
				}
			}
			
			$html       .=   '</div></div>';
			if($flag == 1)
			{
				$html       .=   '<div class="note-block">
									<div class="holder">
										<p>You have a new challenge invitation!</p>
										<a class="close" href="#">close</a>
									</div>
								</div>';
			}
			else
			{
				$end        =   date("Y-m-d H:i:s",strtotime($value['Userchallenge']['user_challenge_finished_date']));
				$now        =   date("Y-m-d H:i:s");
				
				$diff   =   strtotime($end) - strtotime($now);
				if($diff > 0)
				{
					$date1      =   date_create($end);
					$date2      =   date_create($now);
					$diff1      =   date_diff($date2,$date1);

					if($diff1->days >= 10)
						$html       .=   '<div class="note-block">
											<div class="holder">
												<p>This challenge ends soon - You can do it!</p>
												<a class="close" href="#">close</a>
											</div>
										</div>';
				}
			}

			$html       .=   '</div><div class="desctiption"><div class="days">';
			
			if($status  !=  'active')
			{
				$arr        =   $this->getHourMinutes($value['Userchallenge']['started_date'],'','hour');
				$string = "";
				
				if($arr && $arr['days']!="0")
					$string = $arr['days']." DAYS";
				else if($arr && $arr['hour']!="0")
					$string = $arr['hour']." HOURS";
				else if($arr && $arr['minutes']!="0")
					$string = $arr['minutes']." MIN";	
				$html       .=   '<div class="time-block">
									<span>STARTS IN '.$string.'</span>
								</div>';
			}
			else
			{
				$arr        =   $this->getHourMinutes($value['Userchallenge']['user_challenge_finished_date'],'','hour');
				$html       .=   '<div class="holder">
									<span>DAYS LEFT</span>
									<strong class="number">'.$arr['days'].'</strong>
								</div>';
			}
					
			
			$html       .=   '</div>
							<ul class="info">
									<li><span class="difficulty '.$value['Userchallenge']['user_challenge_finished_date'].'">'.$value['Userchallenge']['user_challenge_finished_date'].' Difficulty</span></li>
									<li><span class="points">'.$value['Userchallenge']['user_challenge_point'].' Points</span></li>
									<li>In <a href="#">'.$value['category']['title'].'</a></li>
							</ul>
							<div class="txt">
									<h2>'.$value['challenge']['name'].'</h2>
									<p>'.$value['challenge']['learn_more'].'</p>
							</div>
						</div>
						<footer class="calendar">
							<em class="date">'.date('M d',strtotime($value['Userchallenge']['started_date'])).' - '.date('M d',strtotime($value['Userchallenge']['user_challenge_finished_date'])).' </em>
						</footer>
					</article>';
		}

            return $html;
        }
        
        public function getEndedChallenge($login_id)
        {
            App::import('Model', 'Userchallenge');
            $Userchallenge      =   new Userchallenge();
            return '<div class="two-columns-section">'.$this->getFinishedChallenges($login_id,$Userchallenge).$this->getFailedChallenges($login_id,$Userchallenge).'</div>';
        }
        
        public function getFinishedChallenges($login_id,$Userchallenge)
        {
            $fullurl            =   Router::url('/', true);
            $challenges_host    =   $Userchallenge->getChallengeHostArray(array('Userchallenge.user_challenge_status' => '2','Userchallenge.user_id' => $login_id));
            $html               =   '';
            
            if(count($challenges_host) > 0)
            {
                $html               .=   '<div class="column-section alignleft ajax-holder ajax-loading same-height-left" style="min-height: 430px;">
                                        <h2>Finished Challenges</h2>';
                
                foreach ($challenges_host as $key => $value)
                {
                    $html               .=   '<article class="column">
                                                <div class="desctiption">
                                                        <div class="txt">
                                                                <h2>'.$value['challenge']['name'].'</h2>
                                                                <p>'.$value['challenge']['learn_more'].'</p>
                                                        </div>
                                                        <div class="days green">
                                                                <div class="holder">
                                                                        <span>'.date('M',strtotime($value['Userchallenge']['user_challenge_finished_date'])).'</span>
                                                                        <strong class="number">'.date('d',strtotime($value['Userchallenge']['user_challenge_finished_date'])).'</strong>
                                                                </div>
                                                        </div>
                                                        <span class="points green">Points Earned <strong class="number">'.$value['Userchallenge']['user_challenge_point'].' pts.</strong></span>
                                                        <span class="label green" style="background:url(\''.$fullurl.'img/diffuploads/'.$value['difficulty']['decal'].'\')"></span>
                                                        <span class="stamp"></span>
                                                </div>
                                                <footer class="share-block">
                                                        <a class="again" href="'.Router::url('/host_challenge_step1/'.$value['challenge']['permalink'], true).'">Go Again</a>
                                                        <span class="share">Share</span>
                                                        <ul class="share-this">
                                                                <li><a class="facebook" href="#">facebook</a></li>
                                                                <li><a class="twitter" href="#">twitter</a></li>
                                                                <li><a class="email" href="#">email</a></li>
                                                        </ul>
                                                </footer>
                                        </article>';
                }
                
                $html               .=   '</div>';
            }

            return $html;
        }
        
        public function getFailedChallenges($login_id,$Userchallenge)
        {
            $fullurl            =   Router::url('/', true);
            $challenges_host    =   $Userchallenge->getChallengeHostArray(array('Userchallenge.user_challenge_status' => '3','Userchallenge.user_id' => $login_id));
            $html               =   '';

            if(count($challenges_host) > 0)
            {
                $html               .=   '<div class="column-section alignleft ajax-holder ajax-loading same-height-left" style="min-height: 430px;">
                                        <h2>Failed Challenges</h2>';
                
                foreach ($challenges_host as $key => $value)
                {
                    $html               .=   '<article class="column failed">
                                            <div class="desctiption">
                                                    <div class="txt">
                                                            <h2>'.$value['challenge']['name'].'</h2>
                                                            <p>'.$value['challenge']['learn_more'].'</p>
                                                    </div>
                                                    <div class="days">
                                                            <div class="holder">
                                                                    <span>'.date('M',strtotime($value['Userchallenge']['user_challenge_finished_date'])).'</span>
                                                                    <strong class="number">'.date('d',strtotime($value['Userchallenge']['user_challenge_finished_date'])).'</strong>
                                                            </div>
                                                    </div>
                                                    <span class="points green">Points Earned <strong class="number">'.$value['Userchallenge']['user_challenge_point'].' pts.</strong></span>
                                                    <span class="label" style="background:url(\''.$fullurl.'img/diffuploads/'.$value['difficulty']['decal'].'\')"></span>
                                            </div>
                                            <footer class="share-block">
                                                    <a class="again" href="'.Router::url('/host_challenge_step1/'.$value['challenge']['permalink'], true).'">Retry</a>
                                            </footer>
                                        </article>';
                }
                
                $html               .=   '</div>';
            }

            return $html;
        }
        
        public function popularChallenges($login_user_id)
        {
            $this->session_user_id  =   $login_user_id;
            App::import('Model', 'Userchallenge');
            $Userchallenge          =   new Userchallenge();
            $fullurl                =   Router::url('/', true);
            $return_arr             =   $this->find('all',array('fields'=>array('Challenge.*,if( userchallenge.id, count( userchallenge.id ) , "0" ) AS cnt,categorie.*'),
                                                            'joins'             =>  array(
                                                                                        array(
                                                                                            'table'         => 'userchallenges',
                                                                                            'alias'         => 'userchallenge',
                                                                                            'type'          => 'left',
                                                                                            'foreignKey'    => false,
                                                                                            'conditions'    => array('userchallenge.challenge_id = Challenge.id and userchallenge.user_challenge_status in (0,1,4,6)')
                                                                                        ),
                                                                                        array(
                                                                                            'table' => 'categories',
                                                                                            'alias' => 'categorie',
                                                                                            'type' => 'left',
                                                                                            'foreignKey' => false,
                                                                                            'conditions'=> array(
                                                                                                    'categorie.id = Challenge.parent_category'
                                                                                            )
                                                                                        )
                                                                                    ),
                                                            'conditions'        =>  array('Challenge.status'=>1),
                                                            'group'             =>  array('Challenge.id'),    
                                                            'order'             =>  array('cnt DESC'),
                                                            'limit'             =>  '4'
                                                    )
                                        );
            $return_html    =   '';
            $i              =   0;
            foreach($return_arr as $key => $value) {
                $return_html   .=  '<div class="slide">
				<div class="column">
					<figure class="image-holder">
						<img height="155" width="230" alt="image description" src="'.$fullurl.'img/challengeuploads/'.$value['Challenge']['hero_image'].'">
						<span class="label  orange"></span>
					</figure>
					<div class="about">
						<header class="title">												
							<h2><a href="'.$fullurl.'discover/'.$value['Challenge']['permalink'].'">'.$value['Challenge']['name'].'</a></h2>
							<span class="note">In <a style="cursor:pointer;">'.$value['categorie']['title'].'</a></span>
						</header>
						<p style="min-height:57px;">'.substr($value['Challenge']['why'], 0, 80).'...</p>
					</div>
					<ul class="meta">';
                $host_array =   $Userchallenge->getHostArray($value['Challenge']['id']);
                $host_flag  =   0;
                
                if(empty($this->session_user_id))
                    $anchor =   '<li><a href="javascript:Loginuser();" style="cursor:pointer;">';
                else
                {
                    for($j=0;$j<count($host_array);$j++)
                    {
                        if($this->session_user_id == $host_array[0]['Userchallenge']['user_id'])
                            $host_flag  =   1;
                    }
                    if($host_flag == 0)
                        $anchor =   '<li><a href="'.Router::url('/host_challenge_step1/'.$value['Challenge']['permalink'], true).'" style="cursor:pointer;">';
                    else
                        $anchor =   '<li><a href="javascript:void(0);" style="cursor:pointer;">';
                }

                if(count($host_array) == 0)
                {
                    $return_html    .=   $anchor;
                    if($this->session_user_id == '')
                            $return_html    .=   'Login to Host.';
						else
							$return_html    .=   'Host this';
                    $return_html    .=   '</a></li><li>
					<span class="points increase">0 Points</span>
				</li>';
                }
                else
                {
                    $return_html    .=   $anchor;
                    if(empty($this->session_user_id))
                    {
                        if($this->session_user_id == '')
                            $return_html    .=   'Login to Host.';
						else
							$return_html    .=   'Host this';
                        $return_html    .=   '</a></li><li>
                                            <span class="points increase">0 Points</span>
                                    </li>';
                    }
                    else 
                    {
                        $return_html    .=   '<img height="30" width="30" src="'.$fullurl.'img/useruploads/'.$host_array[0]['user']['user_profile_picture'].'" alt="image description">'.$host_array[0]['user']['user_firstname'].'</a></li>';

                        $return_html    .=   '<li>
                                            <span class="points increase">'.$host_array[0]['Userchallenge']['user_challenge_point'].' Points</span>
                                    </li>';
                    }
                }
                $return_html    .=   '
					</ul>
				</div>
			</div>';
            }
            
            return $return_html;
        }
        
        /**
         * getting the host array if the user not host any challenge.
         * @param integer $challenge_id challenge id
         * @param integer $login_user_id login user id
         * @return array|null
         */
        public function showAHost($challenge_id,$login_user_id)
        {
            $this->session_user_id  =   $login_user_id;

            $condition  =   'Challenge.start_date >= curdate() and Challenge.status=1 and Challenge.id='.$challenge_id.'';

            $return_arr =   '';
            if($this->session_user_id)
            {
                $return_arr =   $this->find('all',array('fields'=>array('Challenge.id'),
                                                            'joins' => array(
                                                                                array(
                                                                                    'table' => 'userchallenges',
                                                                                    'alias' => 'userchallenge',
                                                                                    'type' => 'inner',
                                                                                    'foreignKey' => false,
                                                                                    'conditions'=> 
array('userchallenge.challenge_id = Challenge.id and userchallenge.user_id != '.$this->session_user_id.' and userchallenge.user_challenge_status in (0,1,4,6)')
                                                                                )
                                                                            ),
                                                            'conditions'=>$condition
                                                    )
                                        );
                
                if(!$return_arr)
                {
                    App::import('Model', 'Userchallenge');
                    $Userchallenge          =   new Userchallenge();
                    return $Userchallenge->getHostArray($challenge_id);
                }
                else
                {
                    return '';
                }
            }
        }

        /**
         * getting the active, upcoming, completed challenges
         * @param integer $user_id user id
         * @return string html of active, upcoming, completed challenges
         */
        public function getProfileChallenge($user_id)
        {
            App::import('Model', 'Userchallenge');
            $Userchallenge          =   new Userchallenge();
            return $this->getProfileHtml($Userchallenge->getChallengeHostArray(array('Userchallenge.user_challenge_status' => '1','Userchallenge.user_id' => $user_id)), 'Active').$this->getProfileHtml($Userchallenge->getChallengeHostArray(array('Userchallenge.user_challenge_status in (0,6)','Userchallenge.user_id' => $user_id)), 'Upcoming').$this->getProfileHtml($Userchallenge->getChallengeHostArray(array('Userchallenge.user_challenge_status' => '2','Userchallenge.user_id' => $user_id)), 'Completed');
            
        }
        
        /**
         * creating the html of active, upcoming, completed challenges
         * @param array|null $array active, upcoming, completed challenges array
         * @param string $status which challenge coming
         * @return string created html of active, upcoming, completed challenges
         */
        public function getProfileHtml($array, $status)
        {
            $fullurl    =   Router::url('/', true);
            $html       =   "";
            if(count($array) > 0)
            {
                $html   .=  '<div style="margin:25px 0;">
					<div style="font-size: 32px; margin: 5px 0px; text-align: left;">'.$status.' challenges</div>
					<div style="margin:15px 0;">';
                foreach ($array as $key => $value)
                {
                    $html   .=   '<div style="border: 1px solid #ccc; padding:10px; margin:0 10px 10px 0px; width:48%; float:left; min-height:155px; overflow:hidden;">
                                                    <div style="margin:0 0 5px 0; color:#0099FF; font-size:20px;">'.$value['challenge']['name'].'</div>
                                                    <div style="margin:0px;">
                                                            <div style="margin:5px 10px 0 0; float:left;"><img src="'.$fullurl.'img/challengeuploads/'.$value['challenge']['hero_image'].'" border="0" width="100" /></div>
                                                            <div style="margin:0px;">'.$value['challenge']['daily_commitment'].'</div>
                                                    </div>
                                            </div>';
                }
                
                $html   .=  '</div></div>';
            }
            else
            {
                $html   .=   '<div style="margin:25px 0;">
					<div style="font-size: 32px; margin: 5px 0px; text-align: left;">'.$status.' challenges</div>
					<div style="margin:15px 0;">
						No challenges to list!!
					</div>
				</div>';
            }
            
            $html   .=   '<div class="clear"></div>';
            
            return $html;
        }
            
        /**
         * 
         * @param string $from parent,child,search
         * @param integer|null $val may be parent id, child id, serch keyword, null 
         * @param integer|null $parent parent id or null
         * @param integer|null $login_user_id login user id stored in the session
         * @return string challenge html creation and return back
         */
        public function createCallenge($from, $val, $parent, $login_user_id)
        {
            $this->session_user_id    =   $login_user_id;
            return $this->getHtml($this->getValue($this->getConditions($from,$val,$parent)));
        }
        
	/**
	* returning the values by serching the challenge by the given parameter.
	* @param string $search_keyword search parameter
	* @return optional array or null 
	*/
	public function searchUser($search_keyword)
	{
	    return  $this->find('all', array(
			'conditions' => array('OR'  =>  
			   array(  'name like'  =>  "%$search_keyword%",
					   'badge_title like'  =>  "%$search_keyword%",
					   'daily_commitment like'  =>  "%$search_keyword%",
					   'why like'  =>  "%$search_keyword%",
					   'how like'  =>  "%$search_keyword%",
					   'learn_more like'  =>  "%$search_keyword%",
					   'tags like'  =>  "%$search_keyword%",
					   'checkin_notification like'  =>  "%$search_keyword%",
					   'hero_image like'  =>  "%$search_keyword%"
					)
				)
			)
		);
	}
	
	function getCategoryList($lifestyle='')
	{		
		//$this->Category->recursive = -1;
		//SJ modified to exclude categorys that are not in challenge tbl
		$cat_id = array();
		
		if($lifestyle==0 || $lifestyle=='')
			$cat_id = $this->find('all', array('fields'=> array('DISTINCT Challenge.category_id')));
		else
		{			
			$cond = 'Challenge.challenge_lifestyle="'.$lifestyle.'"';
			$cat_id = $this->find('all', array('fields'=> array('DISTINCT Challenge.category_id'), 'conditions'=>$cond));
		}
		$i = 0;
		
		foreach($cat_id as $chdet)
		{
			$arrCategory[$i] = $chdet['Challenge']['category_id'];
			$i++;
		}
		
		//$arrCategory = array_unique($arrCategory, SORT_REGULAR);		
		$ids = implode(",",$arrCategory);
		
		$cond = "Category.category_active=1 AND Category.id IN (".$ids.")";
	    //$category = $this->Category->find('all', array('conditions' => $cond,'order' => 'Category.id ASC'));
		$category = $this->Category->find('all', array('conditions' => $cond,'order' => 'Category.id ASC'));
	    return $category; 
	}
	
	function getHourMinutes($from,$to,$need='')
	{
		$from   =   date("Y-m-d H:i:s",strtotime($from));
		$now    =   date("Y-m-d H:i:s");
		$diff   =   strtotime($from) - strtotime($now);

		if ( $diff >= 0 ) 
		{
			$date1  =   date_create($from);
			$date2  =   date_create($now);
			$diff1  =   date_diff($date2,$date1);

			if($need)
			{
				switch ($need) {
					case 'hour':
						$return_arr =   array('days' => $diff1->days, 'hour' => $diff1->h, 'minutes' => $diff1->i);
						break;
				}
				return  $return_arr;
			}
			else
			{
				if($diff1->h != 0)
					return $diff1->h." hour ".$diff1->i." minutes";
				else
					return $diff1->i." minutes";
			}
		}
		else
		{
			return '';
		}
	}
	
	function getChallengeByPermalink($condition)
	{
		return $this->find('all',array('fields'=>array('Challenge.*,difficulty.title,difficulty.decal,category.id,category.title'),
                                                            'joins' => array(
                                                                                array(
                                                                                    'table' => 'difficulties',
                                                                                    'alias' => 'difficulty',
                                                                                    'type' => 'inner',
                                                                                    'foreignKey' => false,
                                                                                    'conditions'=> array('difficulty.id = Challenge.difficulty')
                                                                                ),
                                                                                array(
                                                                                    'table' => 'categories',
                                                                                    'alias' => 'category',
                                                                                    'type' => 'left',
                                                                                    'foreignKey' => false,
                                                                                    'conditions'=> array('category.id = Challenge.child_category')
                                                                                )
                                                                            ),
                                                            'conditions'=>$condition
                                                    )
                                        );
	}
	
	public function getTags()
	{
		$challenge_detail = $this->find('all',array('order' => 'Challenge.tags ASC'));
		$array=array();
		$i=0;
		foreach($challenge_detail as $key=>$value)
		{
			if($value['Challenge']['tags'])
			{
			$tag_data=explode(',',$value['Challenge']['tags']);
				
			foreach($tag_data as $key1=>$value1)
		{
		if(!in_array($value1,$array))
				{
				$array[$i]=$value1;$i++;
				}
		}
					
			}
		}
		return json_encode($array);
	}
}
?>
