<?php
class User extends AppModel
{
	var $name = 'User';
	public $session_user_id  =   '';
	public function GetUsers()
	{
            $conditions =   '';
            
            if($this->session_user_id)
                $conditions =   array('id != '.$this->session_user_id,'user_active' =>1);
            else
                $conditions =   array('user_active' =>1);
            
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
                if($i%6 == 0 && $i != 0)
                {
                    $user_html  .=   '</div><div class="row">';
                }
                
                if($user_val && in_array($value['User']['id'], $user_val))
                {
                    $style      =   'background-color:#8faf68;';
                    $user_id    =   $value['User']['id'];
                }
                
                $user_html  .=   '<div onclick="selectUser(\''.$value['User']['id'].'\')" id="select_user_div_'.$value['User']['id'].'" style="margin:5px 2px 5px 5px; width:150px; height:250px; float:left;border: 1px solid #CCCCCC;cursor:pointer;'.$style.'" class="col-xs-6 col-md-3">
        <img height="100" width="100" border="0" src="'.$fullurl.'img/useruploads/'.$value['User']['user_profile_picture'].'" alt="Image">
            <input type="hidden" name="selected_users_list[]" id="selected_users_list_'.$value['User']['id'].'" class="selected_users_list_class" value="'.$user_id.'" />
        <br/>
        '.  ucfirst(substr($value['User']['user_firstname'],0,10)).'
        <n/>
        '.  ucfirst(substr($value['User']['user_hobbies'],0,10)).'<n/>
    </div>';
                
                $i++;
            }
            
            if($i > 0)
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
                                <img height="80" width="80" border="0" src="'.$fullurl.'img/useruploads/'.$user_detail[0]['User']['user_profile_picture'].'" alt="Image">
                                </div><div class="col-xs-6 col-md-9" style="border: 1px solid #CCC;"><div class="row">';
            
            foreach ($user_val as $key => $value) 
            {
                $user_detail    =   $this->GetUserById($value);
                
                $user_html      .=  '<div class="col-xs-6 col-md-3" style="float: left; height: 65px; width: 65px; padding: 3px;" >
                                        <img height="60" width="60" border="0" alt="Image" src="'.$fullurl.'img/useruploads/'.$user_detail[0]['User']['user_profile_picture'].'">
                                        </div>';
            }
            
            $user_html  .=   '<div class="col-xs-6 col-md-3" style="float: left; text-align: center; width: 120px; padding: 7px 15px; height: 40px; border: 1px dashed #CCC; margin: 13px;">
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
		
		 public function getTags()
		{
			$user_detail = $this->find('all',array('order' => 'User.user_hobbies ASC'));
			$array=array();
			$i=0;
			foreach($user_detail as $key=>$value)
			{
				if($value['User']['user_hobbies'])
				{
				$tag_data=explode(',',$value['User']['user_hobbies']);
				
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