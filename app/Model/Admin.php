<?php
class Admin extends AppModel {
    var $name = 'Admin';
	
	// validation area - specifies validation rules in the form
	public $validate = array(
		'admin_user_name' => array(
            'admin_user_name' => array(
                'rule' => 'notEmpty',
                'message' => 'Enter a user name.'
            )
		),
		'admin_user_password' => array(
            'admin_user_password' => array(
                'rule' => 'notEmpty',
                'message' => 'Enter password.'
            ),
            'minLength' => array(
                'rule' => array('minLength',6),
                'message' => 'Password must be at least 6 characters.'
            )
		) ,
		'admin_user_email' => array(
            'admin_user_email' => array(
                'rule' => 'email',
                'message' => 'Enter a valid email address.'
            ),
            'isUnique' => array(
                'rule' => 'isUnique',
                'message' => 'Email already taken by another user.'
            )
		) ,
		'admin_user_type' => array(
             'rule' => 'notEmpty',
			 'message' => 'Select a user type.'
        )
	);
	
	public function checkEmail($email) 
	{
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
    		$value = "true";
		}
		else
		{
			$value = "false";
		}	
		return $value;
	}
	
	public function CheckAdminUserAvailable($conditions)
	{
		$adminuser = $this->find('all',array('conditions'=>$conditions));
		$availablecount = count($adminuser);
		return $availablecount;
	}
	
	public function CheckAdminLogin($user,$pass)
	{
		if(isset($user) && isset($pass))
		{
			
			$adminloginresult = $this->find('all', array('conditions' => array('admin_user_name'=>$user,'admin_user_password' => base64_encode($pass)))); 
		}
		return $adminloginresult;
	}
	
	public function AdminusersList()
    {
		$adminusers = $this->find('all',array('order' => 'id ASC'));
		return $adminusers;
    }
	
	public function GetAdminUser($id)
    {
		$adminuser = $this->find('all',array('conditions'=>array('Admin.id'=>$id)));;
		return $adminuser;
    }
    
    public function ChangeList($array)
    {
        foreach ($array as $key => $value) {
            $array[$key]['Admin']['admin_last_visit']  =   $this->GetLastVisitDay($value['Admin']['admin_last_visit']);
        }
        
        return $array;
    }
    
    /**
     * returning the values by serching the admin by the given parameter.
     * @param string $search_keyword search parameter
     * @return optional array or null 
     */
    public function searchUser($search_keyword)
    {
        return  $this->find('all', array(
                                            'conditions' => array('OR'  =>  
                                                                        array(  'admin_firstname like'  =>  "%$search_keyword%",
                                                                                'admin_lastname like'  =>  "%$search_keyword%",
                                                                                'admin_user_name like'  =>  "%$search_keyword%",
                                                                                'admin_user_email like'  =>  "%$search_keyword%",
                                                                                'icon like'  =>  "%$search_keyword%"

                                                                            )
                                                                    )
                                        )
                            );
    }
}	
?>
