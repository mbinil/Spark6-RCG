<?php
class Challenge extends AppModel
{
   	var $name="Challenge";		
		
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
                                     $condition   =  array('parent_category' => $val);
                                 }
                                 break;
                case 'child':
                                 if($parent && $val)
                                 {
                                     $condition   =  array('parent_category' => $parent, 'child_category' => $val);
                                 }
                                 else
                                 {
                                     if($parent)
                                         $condition   =  array('parent_category' => $parent);
                                     else
                                         $condition   =  array('child_category' => $val);
                                 }
                                 break;
                case 'search':
                                 $condition   =  array('OR'  =>  
                                                     array(  'name like'  =>  "%$val%",
                                                             'badge_title like'  =>  "%$val%",
                                                             'daily_commitment like'  =>  "%$val%",
                                                             'why like'  =>  "%$val%",
                                                             'how like'  =>  "%$val%",
                                                             'learn_more like'  =>  "%$val%"
                                                         )
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
            return $this->find('all', array('fields'=>array('Challenge.*,badgecombo.comboimg,difficulty.decal,difficulty.title,categorie.title'),
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
                                                                        'type' => 'inner',
                                                                        'foreignKey' => false,
                                                                        'conditions'=> array(
                                                                            'categorie.id = Challenge.child_category'
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
            $return_html    =   '';
            foreach ($challenges as $key => $value) 
            {
				$fullurl = Router::url('/', true);
                $return_html    .=   '<div class="column-holder" id="challenge_individual_'.$value['Challenge']['id'].'">
                                        <article class="column">
                                        <div class="visual-block">
                                            <img src="'.$fullurl.'img/challengeuploads/cropped/cropped'.$value['Challenge']['hero_image'].'" width="710" height="249" alt="image description" class="bg">
                                            <figure><img class="alignleft" src="'.$fullurl.'img/challengeuploads/'.$value['Challenge']['hero_image'].'" width="324" height="219" alt="image description"></figure>
                                            <strong class="title">Host This.</strong>
                                            <span class="label blue"></span>
                                        </div>
                                        <div class="desctiption">
                                            <a href="#" class="more" style="background: url(\''.$fullurl.'img/badgecolor/'.$value['badgecombo']['comboimg'].'\')">more</a>
                                            <div class="txt">
                                                    <h2>'.$value['Challenge']['name'].'</h2>
                                                    <p>'.$value['Challenge']['learn_more'].'</p>
                                            </div>
                                        </div>
                                        <ul class="meta">
                                            <li>In <a href="#">'.$value['categorie']['title'].'</a></li>
                                            <li class="difficulty easy"><span>'.$value['difficulty']['title'].' Difficulty</span></li>
                                            <li class="people"><span>60 Finished This</span></li>
                                            <li class="points increase"><span>0 Points</span></li>
                                        </ul>';

                if($this->getHourMinutes($value['Challenge']['start_date'],$value['Challenge']['end_date']))
                {
                    $return_html    .=   '<div class="notification">
                        <p>Starts in '.$this->getHourMinutes($value['Challenge']['start_date'],$value['Challenge']['end_date']).'. Join The Challenge!</p>
                    </div>';
                }

                $return_html    .=   '</article></div>';
            }
            
            return $return_html;
        }
        
        /**
         * 
         * @param string $from parent,child,search
         * @param integer|null $val may be parent id, child id, serch keyword, null 
         * @param integer|null $parent parent id or null
         * @return string challenge html creation and return back
         */
        public function createCallenge($from, $val, $parent)
        {
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
	
	function getChallengeDiscover($lifestyle,$category,$searchkey,$limit,$active_user="",$difficulty,$start=0)
	{		
		$cond = "Challenge.challenge_active=1 ";
		
		if($lifestyle>0)
			$cond .= "AND Challenge.challenge_lifestyle = '".$lifestyle."'";	
			
		if($category>0)
			$cond .= " AND Challenge.category_id = '".$category."'";
		
		if($difficulty!="")
			$cond .= " AND Challenge.challenge_difficulty = '".$difficulty."'";
			
		if($searchkey!="")
		{
			$filter_val = "\"%".$searchkey."%\"";
			$cond .= " AND (challenge_title LIKE ".$filter_val." OR challenge_description LIKE ".$filter_val." OR challenge_what LIKE ".$filter_val." OR challenge_why LIKE ".$filter_val." OR challenge_how LIKE ".$filter_val." OR challenge_tags LIKE ".$filter_val.")";
		}	
	
		$options = array(
					'conditions' => array($cond),
					/*'fields'=>array('Challenge.*, Challenge.challenge_likes+Challenge.challenge_points as displayorder'),*/
					'fields'=>array('Challenge.*'),
					'order'=> array('Challenge.challenge_likes DESC'),
					'limit' => $start.','.$limit
					);
		$this->recursive = -1;
		$challenges_base = $this->find('all', $options);
		//print_r($challenges_base);
		$challenge = array();
		
		$i=0;
		
		foreach($challenges_base as $ch_record)
		{
			//echo "id-".$ch_record['Challenge']['id']."<br/>"; 
			//base details
			$challenge[$i]['challenge_id'] = $ch_record['Challenge']['id']; 
			$challenge[$i]['challenge_title'] = $ch_record['Challenge']['challenge_title']; 
			$challenge[$i]['challenge_description'] = $ch_record['Challenge']['challenge_description']; 
			$challenge[$i]['challenge_permalink'] = $ch_record['Challenge']['challenge_permalink']; 
			$challenge[$i]['challenge_difficulty'] = $ch_record['Challenge']['challenge_difficulty'];			
			$challenge[$i]['challenge_image'] = $ch_record['Challenge']['challenge_image']; 
			$challenge[$i]['challenge_points'] = $ch_record['Challenge']['challenge_points']; 
			$challenge[$i]['challenge_likes'] = $ch_record['Challenge']['challenge_likes']; 
			$challenge[$i]['challenge_what'] = $ch_record['Challenge']['challenge_what']; 
			$challenge[$i]['challenge_lifestyle'] = $ch_record['Challenge']['challenge_lifestyle']; 
			$challenge[$i]['challenge_category'] = $ch_record['Challenge']['category_id']; 
			
			//$challenge[$i] = $ch_record['Challenge'];
			$challenge[$i]['category_name'] = $this -> getCategoryName($ch_record['Challenge']['category_id']);
			$challenge[$i]['finished_count_participants'] = $this->Userchallenge->getFinishedCount($ch_record['Challenge']['id']);
			$hostArr = $this->Userchallenge->getMainHost($ch_record['Challenge']['id']);
			$challenge[$i]['main_host_starts_in'] = "0";
			//sj modified on 26June2013 to display hosts that are in waiting status. prev was in active status
			if(!empty($hostArr))
			{
				$challenge[$i]['main_host_fbid'] = $hostArr[0]['User']['user_fbid'];
				$challenge[$i]['main_host_id'] = $hostArr[0]['Userchallenge']['user_id'];
				$challenge[$i]['main_host_name'] = $hostArr[0]['User']['user_username'];
				$challenge[$i]['main_host_photo'] = $hostArr[0]['User']['user_profile_picture'];				
				$challenge[$i]['group_id'] = $hostArr[0]['Userchallenge']['group_id'];				
				$challenge[$i]['main_host_participants'] = $this->Userchallenge->getMainHostParticipants($ch_record['Challenge']['id'],$challenge[$i]['main_host_id'],$challenge[$i]['group_id']);
				$challenge[$i]['main_host_participants_count'] = $this->Userchallenge->getParticipantsCount($ch_record['Challenge']['id'],$challenge[$i]['main_host_id'],$challenge[$i]['group_id']);
				$challenge[$i]['main_host_started_date'] = $hostArr[0]['Userchallenge']['started_date'];
				//$challenge[$i]['main_host_started_date_iso'] = $hostArr[0]['Userchallenge']['started_date_iso'];
				$challenge[$i]['main_host_starts_in'] = "0"; 
				if($hostArr[0]['Userchallenge']['started_date'] != '0000-00-00')
				{ 
								 $userchallengstartdate=$hostArr[0]['Userchallenge']['started_date_iso'];
								 $diff = $this -> getDateDifferenceToStartChallenge($userchallengstartdate);
								 
							$challenge[$i]['main_host_starts_in'] = $diff; 
							
				}
			}
			else
			{
				$challenge[$i]['main_host_id'] = "";
				$challenge[$i]['main_host_name'] = "";
				$challenge[$i]['main_host_photo'] = "";				
				$challenge[$i]['main_host_participants'] = "";
				$challenge[$i]['main_host_participants_count'] = 0;
				$challenge[$i]['main_host_started_date'] = "0000-00-00";
				$challenge[$i]['main_host_starts_in'] = "0"; 
			}
			
			$challenge[$i]['available_hosts'] = $this->Userchallenge->getAvailableHosts($ch_record['Challenge']['id'],$active_user,1);
			
			//echo "user:".$active_user;
			//check user is already playing this challenge. If not set 'host this' provision
			if(isset($active_user))
			{
				$challenge[$i]['host_mode'] = $this->getHostMode($challenge[$i]['challenge_permalink'], $active_user);
				//set datas for hostthis popup module
				$challenge[$i]['host_challenge_result_values'] = $this->getHostDetails($challenge[$i]['challenge_permalink'], $active_user);
			}
			else
				$challenge[$i]['host_mode'] = "";
		
			$i++;
			
		}
		return $challenge;
	}
        
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
}
?>
