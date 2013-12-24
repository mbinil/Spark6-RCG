<?php
class User extends AppModel
{
	var $name = 'User';
	public $session_user_id  =   '';
	public function GetUsers()
	{
            $conditions =   '';
            
            if($this->session_user_id)
                $conditions =   array('id != '.$this->session_user_id);
            
            $usersresult = $this->find('all',array('conditions'=>$conditions,'order' => 'User.id ASC')); 
            $this->session_user_id  =   '';
            return $usersresult;
	}
	
	public function GetUserById($id)
	{
		$usersresult = $this->find('all',array('conditions'=>array('User.id'=>$id))); 
		return $usersresult;
	}
	
	public function registr($data)
	{
		if($this->save($data))
		{
			return "1";
		}
	}
	public function email_uniqueness($email)
	{
		$user = $this->find('all',array('conditions'=>array('user_email'=>$email)));
		if($user)
		{
			echo "0";
		}
		else
		{
			echo "1";
		}
	}
	
	public function loginchecking($username,$password)
	{
		$user = $this->find('all',array('conditions'=>array('user_email'=>$username,'user_password'=>md5($password),'user_active'=>'1')));
		return $user;
	}
        
        /**
         * creating the users div html
         * @param array $user_deatails all users details
         * @return html users div creation
         */
        public function getHtml($user_deatails, $session_val)
        {
            $user_html      =   '';
            $i              =   0;
            $fullurl        =   Router::url('/', true);
            $user_val       =   '';
            if($session_val)
                $user_val    =   explode(",", rtrim($session_val['selected_user_id'], ","));
            
            foreach ($user_deatails as $key => $value) 
            {
                $style      =   '';
                $user_id    =   '';
                if($i   ==  0)
                {
                    $user_html  .=   '<div class="row">';
                }
                if($i%4 == 0 && $i != 0)
                {
                    $user_html  .=   '</div><div class="row">';
                }
                
                if($user_val && in_array($value['User']['id'], $user_val))
                {
                    $style      =   'background-color:#8faf68;';
                    $user_id    =   $value['User']['id'];
                }
                
                $user_html  .=   '<div onclick="selectUser(\''.$value['User']['id'].'\')" id="select_user_div_'.$value['User']['id'].'" style="margin:2px 0 2px 15px; width:150px; height:250px; float:left;border: 2px solid #BDC3C7;'.$style.'" class="col-xs-6 col-md-3">
        <img height="100" width="100" border="0" src="'.$fullurl.'img/useruploads/'.$value['User']['user_profile_picture'].'" alt="Image">
            <input type="hidden" name="selected_users_list[]" id="selected_users_list_'.$value['User']['id'].'" class="selected_users_list_class" value="'.$user_id.'" />
        <br/>
        '.  ucfirst(substr($value['User']['user_firstname'],0,10)).'
        <n/>
        '.  ucfirst(substr($value['User']['user_hobbies'],0,10)).'<n/>
    </div>';
                
                $i++;
            }
            
            $user_html  .=   '</div>';
            
            //echo $user_html;exit;
            return $user_html;
        }
        
        /**
         * Creating the users by calling the function getHtml
         * @return string user html
         */
        public function createUser($session_val, $login_id)
        {
            $this->session_user_id  =   $login_id;
            return $this->getHtml($this->GetUsers(), $session_val);
        }
        
        /**
         * Creating the users by calling the function getHtml
         * @return string user html
         */
        public function createUserInStep2($session_val, $challenge_permlink, $session_user_id)
        {
            $user_val       =   explode(",", rtrim($session_val['selected_user_id'], ","));
            $user_html      =   '';
            $fullurl        =   Router::url('/', true);
            
            $user_detail    =   $this->GetUserById($session_user_id);
            $user_html      .=  '<div class="row">
                                <div class="col-xs-6 col-md-3" >
                                <img height="100" width="100" border="0" src="'.$fullurl.'img/useruploads/'.$user_detail[0]['User']['user_profile_picture'].'" alt="Image">
                                </div><div class="col-xs-6 col-md-9" style="border: 2px solid #BDC3C7;"><div class="row">';
            
            foreach ($user_val as $key => $value) 
            {
                $user_detail    =   $this->GetUserById($value);
                
                $user_html      .=  '<div class="col-xs-6 col-md-3" style="margin:2px 0 2px 15px; width:60px; height:60px; float:left;" >
                                        <img height="50" width="50" border="0" alt="Image" src="'.$fullurl.'img/useruploads/'.$user_detail[0]['User']['user_profile_picture'].'">
                                        </div>';
            }
            
            $user_html  .=   '<div class="col-xs-6 col-md-3" style="margin:2px 0 2px 15px; width:60px; height:60px; float:left;">
                            <a href="'.Router::url('/host_challenge_step1/'.$challenge_permlink, true).'" style="cursor:pointer;"/>Invite more</a>
                            </div></div></div></div>';
            
            return $user_html;
            
        }
        
        public function searchUser($search_keyword)
		{
			return  $this->find('all', array(
				'conditions' => array('OR'  =>  
					array(  'user_email like'  =>  "%$search_keyword%",
							'user_firstname like'  =>  "%$search_keyword%",
							'user_lastname like'  =>  "%$search_keyword%"
						)
					)
				)
			);
		}
}
?>