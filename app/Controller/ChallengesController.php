<?php
App::uses('AppController', 'Controller');
/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */ 

class ChallengesController extends AppController
{
	public $name = 'Challenges';

	public function discover() 
	{
		//  getting the parent category and child category here
		$this->loadModel('Category');
		$this->set('parent_category',$this->Category->getParentCategories());
		$this->set('child_category',$this->Category->createChildCategory(''));

		//   getting all the challenges here
		$this->loadModel('Challenge');
		$this->set('challenges',$this->Challenge->createCallenge('parent','','',$this->Session->read("session_user_id")));
		
		//for dialogue...
		//  getting the parent category and child category here
		$this->loadModel('User');
		$session_val = $this->Session->read("hostChallengeInfo")?$this->Session->read("hostChallengeInfo"):'';
		$this->set('user_html',$this->User->createUser($session_val, $this->Session->read("session_user_id")));
		$this->set('challenge_id','');
	}
        
	public function get_challenge()
	{
		$child  =   '';
		if($_POST['from'] == 'parent' || $_POST['from'] == 'search')
		{
			//  creating the child category here...
			$this->loadModel('Category');
			$val    =   ($_POST['from'] == 'search')?'':$_POST['val'];
			$child  =   $this->Category->createChildCategory($val);
		}

		//   creating the challenges here...
		$this->loadModel('Challenge');
		
		echo "1"."@#@".$this->Challenge->createCallenge($_POST['from'],$_POST['val'],$_POST['parent'],$this->Session->read("session_user_id"))."@#@".$child;exit();
	}

	//pick a host while click on the image in the pick a host section in challenge display in discover page
	public function ajax_pick_a_host()
	{
		
		$this->loadModel('Userchallenge');
		
		echo $this->Userchallenge->pickAHost($this->Session->read("session_user_id"));exit;
	}
	
	//changing the status of challenges in userchallenge in discover page
	public function ajax_challenge_checking()
	{
		$this->loadModel('Userchallenge');
		echo $this->Userchallenge->checkUserChallenge();exit;
	}
        
	public function challenge_details($challenge_permalink=NULL) {
		$this->loadModel('Challenge');
		$challenge_info = $this->Challenge->getChallengeByPermalink($challenge_permalink);
		$this->set('challenge_info',$challenge_info);
	}
	
	public function my_challenges() 
	{
		$this->loadModel("Challenge");
		$this->set('active_challenges',$this->Challenge->getChallenge('active',$this->Session->read("session_user_id")));
		$this->set('inactive_challenges',$this->Challenge->getChallenge('inactive',$this->Session->read("session_user_id")));
		$this->set('ended_challenges',$this->Challenge->getEndedChallenge($this->Session->read("session_user_id")));

                $this->loadModel("User");
		$Loggeduserinfo = $this->User->GetUserById($this->Session->read("session_user_id"));
		$this->set('Loggeduserinfo', $Loggeduserinfo);
	}
        
	public function host_challenge_step1($challenge_permalink=NULL)
	{
		//  getting the parent category and child category here
		$this->loadModel('User');
		$session_val = $this->Session->read("hostChallengeInfo")?$this->Session->read("hostChallengeInfo"):'';
		$this->set('user_html',$this->User->createUser($session_val, $this->Session->read("session_user_id")));
		$this->set('challenge_id',$challenge_permalink);
	}
        
	public function ajax_host_challenge_step1()
	{
		if($this->Session->read("session_user_id") != "")
		{
			$hostChallengeInfo['selected_user_id']      =   $_POST['host_val'];
			$hostChallengeInfo['challenge_permlink']    =   $_POST['challenge_id'];
			
			$this->Session->write("hostChallengeInfo",$hostChallengeInfo);
			
			$this->Session->write("stepinfo",$_POST['step']);
			if($_POST['from'])
			{
				$this->loadModel('User');
				$session_val    =   $this->Session->read("hostChallengeInfo")?$this->Session->read("hostChallengeInfo"):'';

				$this->set('user2_html',$this->User->createUserInStep2($session_val, $session_val['challenge_permlink'], $this->Session->read("session_user_id")));

				$this->set('challenge_permlink',$session_val['challenge_permlink']);
	
				$html   =   $this->render('element_host_challenge_step2');
				echo $html;exit;
			}
			else
			{
				echo "1";exit;
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function host_challenge_step2()
	{
		//  getting the parent category and child category here
		$this->loadModel('User');
		$session_val = $this->Session->read("hostChallengeInfo")?$this->Session->read("hostChallengeInfo"):'';
		$this->set('user2_html',$this->User->createUserInStep2($session_val, $session_val['challenge_permlink'], $this->Session->read("session_user_id")));
		$this->set('challenge_permlink',$session_val['challenge_permlink']);
		$this->loadModel("Challenge");
		$challenge_info =   $this->Challenge->getChallengebyCondition(array('permalink' => $session_val['challenge_permlink']));
		$this->set('challenge_information',$challenge_info);
	}
        
	public function ajax_host_challenge_add()
	{
		if($this->Session->read("session_user_id") != "")
		{
			$hostChallengeInfo                      =   $this->Session->read("hostChallengeInfo");
			$hostChallengeInfo['chalngbegining']    =   $_POST['chalngbegining'];
			$hostChallengeInfo['time_host']         =   $_POST['time_host'];
			$hostChallengeInfo['check1']            =   $_POST['check1'];
			$hostChallengeInfo['check2']            =   $_POST['check2'];

			$this->loadModel('Userchallenge');
			$this->Session->delete("hostChallengeInfo");
			$get_group_id   =   $this->Userchallenge->getGroupId();
			
			$this->loadModel("Challenge");
			$challenge_info =   $this->Challenge->getChallengebyCondition(array('permalink' => $hostChallengeInfo['challenge_permlink']));

			$selected_user_id   =   explode(",", rtrim($hostChallengeInfo['selected_user_id'], ","));
			array_unshift($selected_user_id, $this->Session->read("session_user_id"));
			$return_flag    =   1;
			$i=0;
			$user_challenge_array   =   array();
			foreach ($selected_user_id as $key => $value) 
			{
				$insert_array   =   array();
				$insert_array['user_id']    =   $value;
				$insert_array['challenge_id']    =   $challenge_info[0]['Challenge']['id'];
				if($i == 0)
					$insert_array['user_challenge_hostid']    =   '';
				else
					$insert_array['user_challenge_hostid']    =   $selected_user_id[0];
				
				$insert_array['user_challenge_status']                  =   0;
				$insert_array['user_challenge_point']                   =   0;
				$insert_array['user_challenge_weekly_goal_completion']  =   '';
				$insert_array['user_challenge_notification_completion'] =   '';
				$insert_array['user_challenge_added']                   =   date("Y-m-d H:i:s");
				$insert_array['started_date']                           =   date('Y-m-d H:i:s',  strtotime($_POST['chalngbegining']." ".$_POST['time_host'].":00"));
				$insert_array['started_date_iso']                       =   date('Y-m-d H:i:s',  strtotime($_POST['chalngbegining']." ".$_POST['time_host'].":00"));
				$insert_array['user_challenge_finished_date']           =   date("Y-m-d H:i:s",strtotime("+".$challenge_info[0]['Challenge']['length_of_challenge']." days", strtotime($_POST['chalngbegining']." ".$_POST['time_host'].":00")));
				if($i == 0)
					$insert_array['user_challenge_invitedby']    =   0;
				else
					$insert_array['user_challenge_invitedby']    =   $selected_user_id[0];
				
				$insert_array['user_challenge_private']    =   $hostChallengeInfo['check2'];
				$insert_array['user_challenge_invitees_invite']    =   $hostChallengeInfo['check1'];
				$insert_array['user_challenge_daily_total']    =   0;
				$insert_array['group_id']    =   $get_group_id;
				$user_challenge_array[$i]['Userchallenge']   =   $insert_array;
				$i++;
			}
			
			if(!$this->Userchallenge->saveMany($user_challenge_array))
			{
				$return_flag =  0;
			}  
			echo $return_flag;exit;
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
}