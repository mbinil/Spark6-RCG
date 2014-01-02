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
		if($this->Session->read("username"))
		{
			$this->redirect('/');
		}
		$session_parent_category    =   $this->Session->read("discover_category");
		
                if(!$this->Session->read("discover_category"))
                    $this->Session->write("discover_category",0);
                
		//  getting the parent category and child category here
		$this->loadModel('Category');
		$this->set('parent_category',$this->Category->getParentCategories());
		$this->set('child_category',$this->Category->createChildCategory($session_parent_category));

		//   getting all the challenges here
		$this->loadModel('Challenge');
		$this->set('challenges',$this->Challenge->createCallenge('parent',$session_parent_category,'',$this->Session->read("session_user_id"),''));
		
		//for dialogue...
		//  getting the parent category and child category here
		$this->loadModel('User');
		$session_val = $this->Session->read("hostChallengeInfo")?$this->Session->read("hostChallengeInfo"):'';
		$this->set('user_html',$this->User->createUser($session_val, $this->Session->read("session_user_id")));
		$this->set('challenge_id','');
		$this->set('session_parent_category',$session_parent_category?$session_parent_category:0);
	}
        
	public function get_challenge()
	{
                $child_cat  =   '';
		$child  =   '';
		if($_POST['from'] == 'parent' || $_POST['from'] == 'search')
		{
			//  creating the child category here...
			$this->loadModel('Category');
			$val    =   ($_POST['from'] == 'search')?$this->Session->read("discover_category"):$_POST['val'];
			$child  =   $this->Category->createChildCategory($val);
                        
                        
                        if($_POST['from'] == 'parent')
                        {
                            $this->Session->write("discover_category",$val?$val:0);
                            $_POST['val']   =   $this->Session->read("discover_category");
                        }
                        if($_POST['from'] == 'search')
                        {
                            $this->Session->write("discover_category",$val?$val:$this->Session->read("discover_category"));
                            $_POST['parent']    =   $this->Session->read("discover_category");
                            $child_cat          =   $_POST['child'];
                            $child  =   $this->Category->createChildCategory($_POST['parent']);
                        }
		}
                else if($_POST['from'] == 'child')
                {
                    $this->Session->write("discover_category",$_POST['parent']?$_POST['parent']:0);
                    $_POST['parent']   =   $this->Session->read("discover_category");
                }
                else
                {
                    $_POST['val']       =   '';
                    $_POST['parent']    =   $this->Session->read("discover_category");
                    $child_cat          =   $_POST['child'];
                }

		//   creating the challenges here...
		$this->loadModel('Challenge');
		//print_r($_POST);exit;
		echo "1"."@#@".$this->Challenge->createCallenge($_POST['from'],$_POST['val'],$_POST['parent'],$this->Session->read("session_user_id"),$child_cat)."@#@".$child;exit();
	}

	//pick a host while click on the image in the pick a host section in challenge display in discover page
	public function ajax_pick_a_host()
	{
		
		$this->loadModel('Userchallenge');
		
		echo $this->Userchallenge->pickAHost($this->Session->read("session_user_id"));exit;
	}
	
        //show the hosts while click on pick a host in challenge details page
	public function ajax_show_a_host()
	{
		$this->loadModel('Challenge');
		
		//$host_array =   $this->Challenge->showAHost($_POST['challenge_id'],$this->Session->read("session_user_id"));

		$this->set('show_host_array',$this->Challenge->showAHost($_POST['challenge_id'],$this->Session->read("session_user_id")));
		$this->set('challenge_id',$_POST['challenge_id']);
		
		$html   =   $this->render('element_show_host');
                                
		echo "1#@#".$html;exit;
	}
        
        //show the hosts while click on pick a host in challenge details page
	public function ajax_pick_host()
	{
            $this->loadModel('Userchallenge');
            
            echo $this->Userchallenge->insertParticipants($this->Session->read("session_user_id"));exit;
	}
	
	//changing the status of challenges in userchallenge in discover page
	public function ajax_challenge_checking()
	{
		$this->loadModel('Userchallenge');
		echo $this->Userchallenge->checkUserChallenge();exit;
	}
        
	public function challenge_details($challenge_permalink=NULL) {
		$this->loadModel('Challenge');
		$challenge_info = $this->Challenge->getChallengeByPermalink(array('permalink'=>$challenge_permalink));
		$this->set('challenge_info',$challenge_info);
		
		$this->loadModel('Userchallenge');
		//echo "<pre>";print_r($this->Userchallenge->getHostArray($challenge_info[0]['Challenge']['id']));
		$available_host =   $this->Userchallenge->getHostArray($challenge_info[0]['Challenge']['id']);
		$this->set('available_host',$available_host);
		
		if(count($available_host) > 0)
			$this->set('starts_in',$this->Challenge->getHourMinutes($available_host[0]['Userchallenge']['started_date'],'','hour'));
		else
			$this->set('starts_in','');
                
                $this->set('challenge_id',$challenge_info[0]['Challenge']['id']);
                
                //fetching the comments related to this challenge and create the comment html
                $this->loadModel('Comment');
                $comment_arr    =   $this->Comment->getComment(array('Comment.status' => 1, 'Comment.challenge_id' => $challenge_info[0]['Challenge']['id']));
                $this->set('comment_html',$this->Comment->createComment($comment_arr));
                $this->set('comment_cnt',count($comment_arr));
                $this->set('session_user_id',$this->Session->read("session_user_id"));
                
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
			$insert_array   =   array();
            $insert_array['challenge_name']    =   $challenge_info[0]['Challenge']['name'];
			$insert_array['challenge_link']    =   $challenge_info[0]['Challenge']['permalink'];
			$selected_user_id   =   explode(",", rtrim($hostChallengeInfo['selected_user_id'], ","));
			array_unshift($selected_user_id, $this->Session->read("session_user_id"));
			$return_flag    =   1;
			$i=0;
			$user_challenge_array   =   array();
			$user_email_array   =   '';
			$this->loadModel("User");
			$inviteduserinfo = $this->User->GetUserById($this->Session->read("session_user_id"));
			$inviteduserFirstname=$inviteduserinfo[0]['User']['user_firstname'];  // first name
			$inviteduserLastname=$inviteduserinfo[0]['User']['user_lastname'];    // last name
			$inviteduserEmail=$inviteduserinfo[0]['User']['user_email'];          //email
			foreach ($selected_user_id as $key => $value) 
			{
				$insert_array['user_id']    =   $value;
				$insert_array['challenge_id']    =   $challenge_info[0]['Challenge']['id'];
				if($i == 0)
					$insert_array['user_challenge_hostid']    =   '';
				else
				{
					$insert_array['user_challenge_hostid']    =   $selected_user_id[0];
		        	$Hosteduserinfo = $this->User->GetUserById($value);
					$user_email_array.=$Hosteduserinfo[0]['User']['user_email'].',';
				}
				$insert_array['user_challenge_status']                  =   0;
				$insert_array['user_challenge_point']                   =   0;
				$insert_array['user_challenge_weekly_goal_completion']  =   '';
				$insert_array['user_challenge_notification_completion'] =   '';
				$insert_array['user_challenge_added']                   =   date("Y-m-d H:i:s");
				$insert_array['started_date']                           =   date('Y-m-d H:i:s',  strtotime($_POST['chalngbegining']." 00:00:00"));
				$insert_array['started_date_iso']                       =   date('Y-m-d H:i:s',  strtotime($_POST['chalngbegining']." ".$_POST['time_host'].":00"));
				$insert_array['user_challenge_finished_date']           =   date("Y-m-d H:i:s",strtotime("+".$challenge_info[0]['Challenge']['length_of_challenge']." days", strtotime($_POST['chalngbegining']." 12:00:00")));
				if($i == 0)
					$insert_array['user_challenge_invitedby']    =   0;
				else
				{
					$insert_array['user_challenge_invitedby']    =   $selected_user_id[0];
				}
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
			else
			{
			
			//email function starts here
			//echo  rtrim($user_email_array,',');
			//echo $this->Session->read("session_user_email");
			$formcontent='<table width="699" border="0" cellspacing="0" cellpadding="5" align="left">
						  <tr>
							<td><img src="'.Router::url('/', true).'img/ebay_inc_logo.png" border="0" /></td>
						  </tr>
						  <tr>
							<td height="20"></td>
						  </tr>
						  <tr>
							<td>'.$inviteduserFirstname.' '.$inviteduserLastname.' has invited you to participate in the challenge "'.$insert_array['challenge_name'].'" at ebay inc.</td>
						  </tr>
						  <tr>
							<td height="10"></td>
						  </tr>
						  <tr>
							<td>Challenge starts on: '.$insert_array['started_date'].'</td>
						  </tr>
						  <tr>
							<td height="10"></td>
						  </tr>
						  <tr>
							<td>Click on the below link to view challenge:</td>
						  </tr>
						  <tr>
							<td>'.Router::url('/discover/', true).$insert_array['challenge_link'].'</td>
						  </tr>
						  <tr>
							<td height="40"></td>
						  </tr>
						  <tr>
							<td>Thnaking you<br/>ebay inc team</td>
						  </tr>
					</table>';
				$recipient = rtrim($user_email_array,',');
				$subject = "You have a challenge invitation from ebay inc.\n";
				$headers = "From: ".$inviteduserEmail."\n";
				$headers .= "MIME-Version: 1.0\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$headers .= "X-Mailer: PHP \n";
				mail($recipient, $subject, $formcontent, $headers);
				/// mail function ends here
			} 
			echo $return_flag;exit;
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
        
        public function ajax_set_discover_category()
        {
            $this->Session->write("discover_category",$_POST['category']);
            echo "1";exit;
        }
        
        public function ajax_inser_comment()
        {
            $this->loadModel('Comment');
            
            if($this->Comment->inserComment($this->Session->read("session_user_id")))
            {
                $comment_arr    =   $this->Comment->getComment(array('Comment.status' => 1, 'Comment.challenge_id' => $_POST['challenge_id']));
                echo "1#@#".$this->Comment->createComment($comment_arr)."#@#".count($comment_arr);exit;
            }
            else
            {
                echo "0";exit;
            }
        }
}