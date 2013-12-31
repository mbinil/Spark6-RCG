<?php
class Userchallenge extends AppModel
{
    public $session_user_id  =   '';
    
    /**
     * getting the group id not existing in this table
     * @return integer new group id
     */
    public function getGroupId()
    {
        for($i=1;$i<1000;$i++)
        {
            $challengesinfo = $this->find('all',array('conditions'=>array('group_id'=>$i)));
            if(!$challengesinfo)
                return $i;
        }
    }
    
    /**
     * getting the values by condition
     * @param string|null $conditions
     * @return array|null data array or null
     */
    public function getDataByCondition($conditions)
    {
        return $this->find('all',array('conditions'=>$conditions));
    }
    
    public function pickAHost($login_user_id)
    {
        $this->session_user_id  =   $login_user_id;
        
        $condition  =   'user_challenge_status not in (2,3)';
        
        if($_POST['challenge_id'])
            $condition  .=   ' and challenge_id = '.$_POST['challenge_id'];
        if($this->session_user_id)
            $condition  .=   ' and user_id = '.$this->session_user_id;
            
        if($this->getDataByCondition($condition))
        {
            return 2;
        }
        else
        {
            if(!$_POST['user_id'])
            {
                return 3;
            }
            else
            {
                $condition  =   'user_challenge_status not in (2,3)';
        
                if($_POST['challenge_id'])
                    $condition  .=   ' and challenge_id = '.$_POST['challenge_id'];
                if($_POST['user_id'])
                    $condition  .=   ' and user_id = '.$_POST['user_id'].' and user_challenge_hostid is null';

                $host_detail    =   $this->getDataByCondition($condition);

                $insert_array['user_id']    =   $this->session_user_id;
                $insert_array['challenge_id']    =   $_POST['challenge_id'];
                $insert_array['user_challenge_hostid']    =   $_POST['user_id'];

                $insert_array['user_challenge_status']    =   0;
                $insert_array['user_challenge_point']    =   0;
                $insert_array['user_challenge_weekly_goal_completion']    =   '';
                $insert_array['user_challenge_notification_completion']    =   '';
                $insert_array['user_challenge_added']    =   date("Y-m-d h:i:s A");
                $insert_array['started_date']    =   $host_detail[0]['Userchallenge']['started_date'];
                $insert_array['started_date_iso']    =   $host_detail[0]['Userchallenge']['started_date_iso'];
                $insert_array['user_challenge_finished_date']    =   $host_detail[0]['Userchallenge']['user_challenge_finished_date'];
                $insert_array['user_challenge_invitedby']    =   0;

                $insert_array['user_challenge_private']    =   $host_detail[0]['Userchallenge']['user_challenge_private'];
                $insert_array['user_challenge_invitees_invite']    =   $host_detail[0]['Userchallenge']['user_challenge_invitees_invite'];
                $insert_array['user_challenge_daily_total']    =   0;
                $insert_array['group_id']    =   $host_detail[0]['Userchallenge']['group_id'];

                if($this->save($insert_array))
                {
                    return 1;
                }
                else
                {
                    return 0;
                }
            }
        }
    }
    
    /**
     * Inser participants under a host
     */
    public function insertParticipants($login_user_id)
    {
        $this->session_user_id  =   $login_user_id;
        $condition  =   'user_challenge_status not in (2,3)';
        
        if($_POST['challenge_id'])
            $condition  .=   ' and challenge_id = '.$_POST['challenge_id'];
        if($_POST['user_id'])
            $condition  .=   ' and user_id = '.$_POST['user_id'];
        if($_POST['host_group'])
            $condition  .=   ' and group_id = '.$_POST['host_group'];
            
        if($arr =   $this->getDataByCondition($condition))
        {
            $insert_array['user_id']                                            =   $this->session_user_id;
            $insert_array['challenge_id']                                       =   $_POST['challenge_id'];
            $insert_array['user_challenge_hostid']                              =   $_POST['user_id'];

            $insert_array['user_challenge_status']                              =   0;
            $insert_array['user_challenge_point']                               =   0;
            $insert_array['user_challenge_weekly_goal_completion']              =   '';
            $insert_array['user_challenge_notification_completion']             =   '';
            $insert_array['user_challenge_added']                               =   date("Y-m-d h:i:s A");
            $insert_array['started_date']                                       =   $arr[0]['Userchallenge']['started_date'];
            $insert_array['started_date_iso']                                   =   $arr[0]['Userchallenge']['started_date_iso'];
            $insert_array['user_challenge_finished_date']                       =   $arr[0]['Userchallenge']['user_challenge_finished_date'];
            $insert_array['user_challenge_invitedby']                           =   0;

            $insert_array['user_challenge_private']                             =   $arr[0]['Userchallenge']['user_challenge_private'];
            $insert_array['user_challenge_invitees_invite']                     =   $arr[0]['Userchallenge']['user_challenge_invitees_invite'];
            $insert_array['user_challenge_daily_total']                         =   0;
            $insert_array['group_id']                                           =   $arr[0]['Userchallenge']['group_id'];

            if($this->save($insert_array))
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 0;
        }
    }
    
    public function getHostArray($challenge_id)
    {
        return $challengesinfo = $this->find('all',array('fields'=>array('Userchallenge.*,user.user_profile_picture,user.user_firstname,user.id,user.user_hobbies'),
                                                            'joins' => array(
                                                                    array(
                                                                        'table' => 'users',
                                                                        'alias' => 'user',
                                                                        'type' => 'inner',
                                                                        'foreignKey' => false,
                                                                        'conditions'=> array('user.id = Userchallenge.user_id')
                                                                    )),
                                                            'conditions'=>
                                                                array(
                                                                    'challenge_id'=>$challenge_id,
                                                                    'user_challenge_status in (0,1,4,6)',
                                                                    'user_challenge_hostid is null'
                                                                    
                                                                    ),
                                                            'order' => array('user_challenge_added ASC')
                                                    )
                                        );
        
    }
    
    public function getChallengeHostArray($condition)
    {
        return $challengesinfo = $this->find('all',array('fields'=>array('Userchallenge.*,user.user_profile_picture,user.user_firstname,user.id,
            challenge.daily_commitment,challenge.name,challenge.learn_more,challenge.daily_commitment,challenge.hero_image,challenge.permalink,difficulty.title,difficulty.decal,category.id,category.title'),
                                                            'joins' => array(
                                                                                array(
                                                                                    'table' => 'users',
                                                                                    'alias' => 'user',
                                                                                    'type' => 'inner',
                                                                                    'foreignKey' => false,
                                                                                    'conditions'=> array('user.id = Userchallenge.user_id')
                                                                                ),
                                                                                array(
                                                                                    'table' => 'challenges',
                                                                                    'alias' => 'challenge',
                                                                                    'type' => 'inner',
                                                                                    'foreignKey' => false,
                                                                                    'conditions'=> array('challenge.id = Userchallenge.challenge_id')
                                                                                ),
                                                                                array(
                                                                                    'table' => 'difficulties',
                                                                                    'alias' => 'difficulty',
                                                                                    'type' => 'inner',
                                                                                    'foreignKey' => false,
                                                                                    'conditions'=> array('difficulty.id = challenge.difficulty')
                                                                                ),
                                                                                array(
                                                                                    'table' => 'categories',
                                                                                    'alias' => 'category',
                                                                                    'type' => 'left',
                                                                                    'foreignKey' => false,
                                                                                    'conditions'=> array('category.id = challenge.child_category')
                                                                                )
                                                                            ),
                                                            'conditions'=>$condition
                                                    )
                                        );
        
    }
    
    public function getParticipantsArray($condition)
    {
        return $challengesinfo = $this->find('all',array('fields'=>array('Userchallenge.*,user.user_profile_picture,user.user_firstname,user.id'),
                                                            'joins' => array(
                                                                    array(
                                                                        'table' => 'users',
                                                                        'alias' => 'user',
                                                                        'type' => 'inner',
                                                                        'foreignKey' => false,
                                                                        'conditions'=> array('user.id = Userchallenge.user_id')
                                                                    )),
                                                            'conditions'=>$condition
                                                    )
                                        );
        
    }
    
    /**
     * getting the current host ie, current date between start date and end date of challenge
     * @return array host array
     */
    public function getCrrentHost()
    {
        return $this->find('all',array('fields'=>array('Userchallenge.id,Userchallenge.user_id,Userchallenge.challenge_id,Userchallenge.user_challenge_status'),
                                                            'conditions'=>array(
                                                                "DATE_FORMAT( NOW() , '%Y-%m-%d %T' ) BETWEEN DATE_FORMAT(started_date, '%Y-%m-%d %T' ) AND DATE_FORMAT(user_challenge_finished_date, '%Y-%m-%d %T' )",
                                                                "user_challenge_hostid IS NULL"
                                                            ),
                                                            'order' => array('id ASC')
                                                    )
                                        );
    }
    
    public function getActiveHost($host_id,$challenge_id)
    {
        return $this->find('all',array('fields'=>array('Userchallenge.id,Userchallenge.user_id,Userchallenge.user_challenge_status'),
                                                            'conditions'=>array(
                                                                "DATE_FORMAT( NOW() , '%Y-%m-%d %T' ) BETWEEN DATE_FORMAT(started_date, '%Y-%m-%d %T' ) AND DATE_FORMAT(user_challenge_finished_date, '%Y-%m-%d %T' )",
                                                                "challenge_id" => $challenge_id,
                                                                "user_challenge_hostid" => $host_id,
                                                                "user_challenge_status" => 6
                                                            ),
                                                            'order' => array('id ASC')
                                                    )
                                        );
    }
    /**
     * changing the status of host
     * @param integer $id
     * @param integer $host_id
     * @param integer $challenge_id 
     * @return integer 1-true 0-false
     */
    public function getCurrentParticipants($id,$host_id,$challenge_id)
    {
        $active_host    =   $this->getActiveHost($host_id,$challenge_id);
        
        $current_participants = $this->find('all',array('fields'=>array('Userchallenge.id,Userchallenge.user_id,Userchallenge.user_challenge_status'),
                                                            'conditions'=>array(
                                                                "DATE_FORMAT( NOW() , '%Y-%m-%d %T' ) BETWEEN DATE_FORMAT(started_date, '%Y-%m-%d %T' ) AND DATE_FORMAT(user_challenge_finished_date, '%Y-%m-%d %T' )",
                                                                "challenge_id" => $challenge_id,
                                                                "user_challenge_hostid" => $host_id
                                                            ),
                                                            'order' => array('id ASC')
                                                    )
                                        );
        $host_status            =   8;
        $participants_status    =   8;
        
        if(count($active_host) >= 2 )
        {
            $host_status =   1;
            $participants_status    =    1;
        }
        
        foreach ($current_participants as $key => $value) 
        {
            $this->id = $value['Userchallenge']['id'];

            $this->saveField("user_challenge_status",$participants_status);
        }
            
        $this->id = $id;

        if($this->saveField("user_challenge_status",$host_status))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    /**
     * changing the status of host
     * @param integer $id
     * @param integer $host_id
     * @param integer $challenge_id 
     * @return integer 1-true 0-false
     */
    public function updateHost($id,$host_id,$challenge_id)
    {
        return $this->getCurrentParticipants($id,$host_id,$challenge_id);
    }
    
    /**
     * 
     * @return integer 1-true 0-false
     */
    public function checkUserChallenge()
    {
        $current_host   =   $this->getCrrentHost();

        foreach ($current_host as $key => $value) 
        {
            if($value['Userchallenge']['user_challenge_status'] == 0)//only playing status is checking
            {
                if(!$this->updateHost($value['Userchallenge']['id'],$value['Userchallenge']['user_id'],$value['Userchallenge']['challenge_id']))
                    return 0;
            }
        }
        
        return 1;
    }
    
    public function getNotification($login_id)
    {
        return $this->find('all',array('fields'=>array('Userchallenge.*,challenge.name'),
                                        'joins' => array(
                                                                array(
                                                                    'table' => 'challenges',
                                                                    'alias' => 'challenge',
                                                                    'type' => 'inner',
                                                                    'foreignKey' => false,
                                                                    'conditions'=> array('Userchallenge.challenge_id = challenge.id')
                                                                )),
                                        'conditions'=>array(
                                                                "DATE_FORMAT( NOW() , '%Y-%m-%d %T' ) <= DATE_FORMAT(Userchallenge.started_date, '%Y-%m-%d %T' )",
                                                                "Userchallenge.user_challenge_hostid IS NOT NULL",
                                                                "Userchallenge.user_id" => $login_id,
                                                                "Userchallenge.user_challenge_status" => 0
                                                            ),
                                        'order' => 'Userchallenge.user_challenge_added desc',
                                        'limit' => 2
                                                    )
                                        );

    }
    
    /**
     * getting the details of active challenge for notification
     * @param integer $login_id login person id
     * @return array|null data array or null
     */
    public function activeChallenge($login_id)
    {
        return $this->find('all',array('fields'=>array('Userchallenge.*,challenge.name,challenge.hero_image'),
                                        'joins' => array(
                                                                array(
                                                                    'table' => 'challenges',
                                                                    'alias' => 'challenge',
                                                                    'type' => 'inner',
                                                                    'foreignKey' => false,
                                                                    'conditions'=> array('Userchallenge.challenge_id = challenge.id')
                                                                )),
                                        'conditions'=>array("Userchallenge.user_id" => $login_id,
                                                                "Userchallenge.user_challenge_status in (1,6)"
                                                            ),
                                        'order' => 'Userchallenge.user_challenge_added desc',
                                        'limit' => 2
                                                    )
                                        );
    }
    
    public function createNotification($login_id)
    {
        $fullurl        =   Router::url('/', true);
        $notification   =   $this->getNotification($login_id);
        //creating invities ................................................................
        $html   =   '';
        if(count($notification) >= 1)
        {
            $html   =   '<section class="drop-row">
                            <h2>2 Invites to Join...</h2>
                            <ul>';
            foreach ($notification as $key => $value)
            {
                $condition  =   array('Userchallenge.challenge_id' => $value['Userchallenge']['challenge_id'],
                                        'Userchallenge.user_challenge_hostid' => $value['Userchallenge']['user_challenge_hostid'],
                                        'Userchallenge.user_challenge_status in (0,6)'
                        
                                    );
                $co_participants    =   $this->getParticipantsArray($condition);
                $count              =   count($co_participants);
                $image              =   '';
                $name               =   '';
                foreach ($co_participants as $key1 => $value1)
                {
                    if($value1['Userchallenge']['user_id'] != $login_id)
                    {
                        $image              =   $value1['user']['user_profile_picture'];
                        $name               =   $value1['user']['user_firstname'];
                        break;
                    }
                }
                $html   .=  '<li class="">
                                <div class="holder">
                                    <img height="50" width="50" class="alignleft" alt="image description" src="'.$fullurl.'img/useruploads/'.$image.'">
                                    <div class="txt">
                                        <h3>'.$value['challenge']['name'].'</h3>
                                        <p><a href="#">'.$name.'</a> + '.$count.' participants</p>
                                        <a class="agree" href="#" style="opacity: 0;" onclick="changeNotification(\'agree\',\''.$value['Userchallenge']['id'].'\')">agree</a>
                                        <a class="reject" href="#" style="opacity: 0;" onclick="changeNotification(\'reject\',\''.$value['Userchallenge']['id'].'\')">reject</a>
                                    </div>
                                </div>
                                <span class="label orange"></span>
                                <em class="mask" style="opacity: 0;"></em>
                            </li>';
            }
            $html   .=  '</ul></section>';
        }
        
        //creating invities ends here ......................................................
        
        //creating active challenges........................................................
        $active_challenges  =   $this->activeChallenge($login_id);
        
        if(count($active_challenges) >= 1)
        {
            $html   .=  '<section class="drop-row">
                        <h2>Active Challenges</h2>
                        <ul>';
            
            foreach ($active_challenges as $key => $value)
            {
                $from   =   date("Y-m-d H:i:s",strtotime($value['Userchallenge']['started_date']));
                $now    =   date("Y-m-d H:i:s");
                
                $date1  =   date_create($from);
                $date2  =   date_create($now);
                $diff1  =   date_diff($date1,$date2);
                
                $html   .=  '<li class="">
                        <div class="holder">
                                <div class="txt">
                                        <h3>'.$value['challenge']['name'].'</h3>
                                        <p>'.$diff1->d.' Days Left!</p>
                                </div>
                        </div>
                        <span class="label orange"></span>
                        <em class="mask" style="opacity: 0;"></em>
                </li>';
            }
            
            $html   .=  '</ul></section>';
        }
        
        return $html;
    }
}
?>