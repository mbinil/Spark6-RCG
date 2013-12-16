<?php
class User extends AppModel
{
	var $name = 'User';
	
	public function GetUsers()
	{
		$usersresult = $this->find('all',array('order' => 'User.id ASC')); 
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
		$user = $this->find('all',array('conditions'=>array('user_email'=>$username,'user_ password'=>md5($password))));
		return $user;
	}
}
?>