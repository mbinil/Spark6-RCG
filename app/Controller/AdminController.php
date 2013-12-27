<?php
/**
 * Static content controller.
 *
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');
/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class AdminController extends AppController
{
	public $name = 'Admin';
	var $helpers = array ('Html','Form','Session');  // add helpers
	var $uses = array('Admin', 'User'); 
	var $components = array('PImage'); 
	/* Admin login page */
	public function index(){}
	
	/* validating username and password at the time of login */
	public function verifylogin()
	{
		$this->loadModel("Admin");
		if(isset($this->request->data["admin_user_name"]))
		{
		  	$username=$this->request->data["admin_user_name"];
		}
		else
		{
		   	$username="";
		}
		if(isset($this->request->data["admin_user_password"]))
		{
		  	$password = base64_encode($this->request->data["admin_user_password"]);
		}
		else
		{
		   	$password="";
		}
		$userloginresult=$this->Admin->find('all', array('conditions' => array(
											'admin_user_name =' => $username,
											'admin_user_password =' => $password))); 
		//	print_r($userloginresult);
		$count=count($userloginresult);
		if($count > 0)
		{
			$this->Session->delete("session_user_id");
            $this->Session->delete('username');
            $this->Session->delete('userid');
            $this->Session->delete('locateid');
            $this->Session->delete('loginerror');
            $this->Session->delete('dispstatus');
            $this->Session->delete('newdiffinfo');
            $this->Session->delete('newchallengeinfo');
            $this->Session->delete('stepinfo');
			
			$userrowarray=$userloginresult[0]['Admin'];
			$this->Session->write("username",$username);
			$this->Session->write("userid",$userrowarray["id"]);
			$this->Session->write("usericon",$userrowarray["icon"]);
                        $this->Session->write("useremail",$userrowarray["admin_user_email"]);
            $this->Admin->updateAll(array("admin_last_visit"=>"'".date("Y-m-d H:i:s")."'"),array("id"=>$userloginresult[0]['Admin']['id']));
			$this->redirect(array("action"=>"home"));
		}
		else
		{
			$this->Session->setflash("Invalid username or password");
			$this->redirect(array("action" => "index"));
		}
	}
	
	/* Session checking in all pages. User logined or not. If not logined redirect to login. */
	public function validatelogin()   
	{
	   $username=$this->Session->read("username");
	   if(isset($username) == "")
	   {
		 $this->Session->setflash("Invalid Login");
		 $this->redirect(array("action"=>"index"));
	   }
	   else
	   {
		  $id="";
		  $this->Session->write("validatelogin","true");
		  $controllername=$this->Session->read("controllername");
		  $id=$this->Session->read("locateid");
		  if($id != "")
		  {
			 $this->redirect(array("action"=>$controllername,$id));
			 $this->Session->delete('locateid');
		  }
		  else
		  {
			 $this->redirect(array("action"=>$controllername));
		  }
	   }
	}
	
	/* Admin home page */
	public function home()
	{
		$this->Session->write("controllername","home");
		$validatelogin=$this->Session->read("validatelogin");
		if($validatelogin != "true")
		{
			$this->redirect(array("action"=>"validatelogin"));  
		}
		$this->Session->write("validatelogin","false");
		$this->Session->delete('newchallengeinfo');
		unset($_SESSION['newchallengeinfo']);
    }
	
	/* Admin logout */
	public function logout()
	{
	   // $this->Session->destroy();
	   $this->Session->delete('username');
	   $this->Session->delete('userid');
	   $this->Session->delete('locateid');
	   $this->Session->delete('loginerror');
	   $this->Session->delete('dispstatus');
	   $this->Session->delete('newdiffinfo');
	   $this->Session->delete('newchallengeinfo');
	   $this->Session->delete('stepinfo');
	   $this->Session->destroy();
	   $this->redirect(array("action" => "index"));
	}
	
	public function searchresult($search_keyword)
	{
		if($this->Session->read("username") != "")
		{ 
			if(isset($search_keyword))
			{
				$this->set('search_keyword',$search_keyword);
				
				// checking in admin side.......................................
				$this->loadModel('Admin');
				$admin_user_result  =   $this->Admin->searchUser($search_keyword);
				$this->set('admin_user_details',$admin_user_result);
				
				// checking in user side.......................................
				$this->loadModel('User');
				$user_result  =  $this->User->searchUser($search_keyword);
				$this->set('user_details',$user_result);
				
				// checking in challenge side.......................................
				$this->loadModel('Challenge');
				$challenge_result  =   $this->Challenge->searchUser($search_keyword);
				$this->set('challenge_details',$challenge_result);
				
				// checking in difficulty side.......................................
				$this->loadModel('Difficulty');
				$difficulty_result  =   $this->Difficulty->searchUser($search_keyword);
				$this->set('difficulty_details',$difficulty_result);
				
				// checking in parent and child category side.......................................
				$this->loadModel('Category');
				$parent_cat_result  =   $this->Category->searchParent($search_keyword);
				$this->set('parent_cat_details',$parent_cat_result);
				$child_cat_result  =   $this->Category->searchChild($search_keyword);
				$this->set('child_cat_details',$child_cat_result);
				
				$count  =   1;
				if( count($admin_user_result) == 0 && count($user_result) == 0 && count($challenge_result) == 0 && count($difficulty_result) == 0 && count($parent_cat_result) == 0 &&  count($child_cat_result) == 0 )
					$count  =   0;
				$this->set('total_count',$count);
				
				//echo "<pre>";print_r($parent_cat_result);
				//print_r($child_cat_result);exit;
			}
			else
			{
				header('Location:'.urldecode(Router::url('/admin/home', true)));exit();
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin/home', true)));exit();
		}
    }
	/*LEVEL*/
	
	//Get current level threshold.
	public function levels()
	{
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Level");
			$this->set('levelthreshold',$this->Level->getLevelThreshold());
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
    }
	
	//Update current level threshold.
	public function updatelevelthreshold()
	{
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Level");
			$this->Level->id = 1;
			if($this->Level->saveField("LevelThreshold",$this->data['LevelThreshold']))
			{
			   echo "1";
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	/*End of level*/
	
	/*DIFFICULTIES*/
	
	//Get difficulties list.
	public function difficulties()
	{
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Difficulty");
			$this->set('difficultiestypes',$this->Difficulty->getDifficultiesTypes());
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
    }
	
	// Adding / editing difficulty type - step 1.
	public function difficultyaddstep1()
	{
		if($this->Session->read("username") != "")
		{
			$newdiffinfo = $this->Session->read("newdiffinfo");
            $this->Session->read('newdiffinfo');
			//$this->Session->delete('newdiffinfo'); 
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}	
	}
	
	public function ajax_diffaddstep1()
	{
		$newdiffinfo = $this->Session->read("newdiffinfo");
		if($_POST['diffstatus']=='true')
		{
			$diffstatus = 1;
		}
		else
		{
			$diffstatus = 0;
		}
		
		if(isset($newdiffinfo))
		{
			$_SESSION['newdiffinfo']['title']   =   addslashes($_POST['difftitle']);
			$_SESSION['newdiffinfo']['description']   =   addslashes($_POST['diffdesp']);
			$_SESSION['newdiffinfo']['status']   =   $diffstatus;
		}
		else
		{
			$newdiffinfo = array("title"=>addslashes($_POST['difftitle']),"description"=>addslashes($_POST['diffdesp']),"status"=>$diffstatus);
			$this->Session->write("newdiffinfo",$newdiffinfo); 
		}
		
		$this->Session->write("stepinfo",$_POST['step']);
		echo "1";
	}
	
	public function difficultyeditstep1($id = NULL)
	{
		if($this->Session->read("username") != "")
		{
			if(isset($id))
			{
				$this->loadModel("Difficulty");
				$DifficultybyId = $this->Difficulty->getDifficultybyId($id);
				$this->Session->write('diffinfo',$DifficultybyId);
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function ajax_diffeditstep1()
	{
		if($_POST['diffstatus']=='true')
		{
			$diffstatus = 1;
		}
		else
		{
			$diffstatus = 0;
		}
		$newdiffinfo = array("title"=>addslashes($_POST['difftitle']),"description"=>addslashes($_POST['diffdesp']),"status"=>$diffstatus);
		$this->Session->write("newdiffinfo",$newdiffinfo);
		echo "1";
	}
	
	// Adding / editing difficulty type - step 2.
	public function difficultyaddstep2()
	{
		$last_value_of_web_url    =   substr($_SERVER['REQUEST_URI'], -1);
		$newdiffinfo = $this->Session->read("newdiffinfo");
		
		if(!$newdiffinfo)
		{
			header('Location:'.urldecode(Router::url('/admin/difficultyaddstep1', true)));exit();
		}
		else
		{
			$step   =   $this->Session->read("stepinfo");
			if($last_value_of_web_url > $step)
			{
				header('Location:'.urldecode(Router::url('/admin/difficultyaddstep'.$step, true)));exit();
			}
		}
                
		if($this->Session->read("username") == "")
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function ajax_diffaddstep2()
	{
		$newdiffinfo = $this->Session->read("newdiffinfo");
        $stepinfo = $this->Session->read("stepinfo");
		$newdiffinfo['points'] = $_POST['diffmode'];
		$this->Session->write("newdiffinfo",$newdiffinfo);
		$this->Session->write("stepinfo",$_POST['step']);
		echo "1";
	}
	
	public function difficultyeditstep2($id = NULL)
	{
		if($this->Session->read("username") != "")
		{
			if(isset($id))
			{
				$this->loadModel("Difficulty");
				$DifficultybyId = $this->Difficulty->getDifficultybyId($id);
				$this->Session->write('diffinfo',$DifficultybyId);
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function ajax_diffeditstep2()
	{
		$newdiffinfo = $this->Session->read("newdiffinfo");
		$newdiffinfo['points'] = $_POST['diffmode'];
		$this->Session->write("newdiffinfo",$newdiffinfo);
		echo "1";
	}
	
	// Adding difficulty type - step 3.
	public function difficultyaddstep3()
	{
		$last_value_of_web_url    =   substr($_SERVER['REQUEST_URI'], -1);
		$newdiffinfo = $this->Session->read("newdiffinfo");

		if(!$newdiffinfo)
		{
			header('Location:'.urldecode(Router::url('/admin/difficultyaddstep1', true)));exit();
		}
		else
		{
			$step   =   $this->Session->read("stepinfo");
			if($last_value_of_web_url > $step)
			{
				header('Location:'.urldecode(Router::url('/admin/difficultyaddstep'.$step, true)));exit();
			}
		}
		
		if($this->Session->read("username") != "")
		{ 
			//$this->Session->delete('newdiffinfo'); 
			$this->Session->read('newdiffinfo');
			$this->Session->read('stepinfo');
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function ajax_diffaddstep3()
	{
		$newdiffinfo = $this->Session->read("newdiffinfo");
		$newdiffinfo['decal']   =   $_POST['decal'];
		$stepinfo=$this->Session->read("stepinfo");
		if(!empty($newdiffinfo))
		{
			$this->loadModel("Difficulty");
			if($this->Difficulty->save($newdiffinfo))
			{
				$this->Session->write('difficulty_name',$newdiffinfo['title']);
				$this->Session->delete('newdiffinfo');
				$this->Session->delete('stepinfo');
				echo "1";
			}
		}
	}
	
	// Editing difficulty type - step 3.
	public function difficultyeditstep3($id = NULL)
	{
		if($this->Session->read("username") != "")
		{
			if(isset($id))
			{
				$this->loadModel("Difficulty");
				$DifficultybyId = $this->Difficulty->getDifficultybyId($id);
				$this->Session->write('diffinfo',$DifficultybyId);
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function ajax_diffeditstep3()
	{
		$newdiffinfo = $this->Session->read("newdiffinfo");
        $newdiffinfo['decal']   =   $_POST['decal'];
		$this->loadModel("Difficulty");
		$this->Difficulty->id = $_POST['diffid'];
		if(!empty($newdiffinfo))
		{
			if($this->Difficulty->save($newdiffinfo))
			{
				echo "1";
			}
		}
	}
	
	// Image uploading funtion for difficulty types.
	public function difficulties_uploads()
	{
		// A list of permitted file extensions
		$allowed = array('png', 'gif');
		$output_dir = WWW_ROOT."img/diffuploads/";
		if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0)
		{
			$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
			if(!in_array(strtolower($extension), $allowed)){
				echo '{"status":"error"}';
				exit;
			}
			if(move_uploaded_file($_FILES['upl']['tmp_name'], $output_dir.$_FILES['upl']['name'])){
				echo '{"status":"success"}';
				exit;
			}
		}
		echo '{"status":"error"}';
		exit;
	}
	
	// Deleting a difficulty type.
	public function difficultydelete()
	{
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Difficulty");
			if($this->Difficulty ->delete($_POST['diffid']))
			{
				echo "1";
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	/*End of difficulties*/
	
	/*PARENT CATEGORY*/
	
	// Fetching parent categories.
	public function categoryparent()
	{
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Category");
			$this->set('categories',$this->Category->getParentCategories());
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	// Adding new parent category.
	public function categoryparentadd()
	{
		if($this->Session->read("username") == "")
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function ajax_parentadd()
	{
		$this->loadModel("Category");
		if($_POST['pcatstatus']=='true')
		{
			$pcatstatus = 1;
		}
		else
		{
			$pcatstatus = 0;
		}
		$newparentcatinfo = array("title"=>addslashes($_POST['pcattitle']),"decal"=>$_POST['pcatfileuploaded'],"status"=>$pcatstatus,"parent"=>"0");
		if(!empty($newparentcatinfo))
		{
			if($this->Category->save($newparentcatinfo))
			{
				$this->Session->write("parent_category_name",$_POST['pcattitle']);
				if(isset($_POST['dialogue']) && $_POST['dialogue'] == 'dialogue')
				{
					$this->loadModel("Category");
					echo $this->Category->getLastInsertID()."@#@".count($this->Category->getActiveParentCategories());
				}
				else
				{
					echo "1";
				}
				exit;
			}
		}
	}
	
	// Editing a parent category.
	public function categoryparentedit($id = NULL)
	{
		if($this->Session->read("username") != "")
		{
			if(isset($id))
			{
				$this->loadModel("Category");
				$CategoryinfobyId = $this->Category->getCategoryInfobyId($id);
				$this->set('pcatinfo',$CategoryinfobyId);
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function ajax_parentedit()
	{
		$this->loadModel("Category");
		if($_POST['pcatstatus']=='true')
		{
			$pcatstatus = 1;
		}
		else
		{
			$pcatstatus = 0;
		}
		$newparentcatinfo = array("title"=>addslashes($_POST['pcattitle']),"decal"=>$_POST['pcatfileuploaded'],"status"=>$pcatstatus,"parent"=>"0");
		$this->Category->id = $_POST['pcatid'];
		if(!empty($newparentcatinfo))
		{
			if($this->Category->save($newparentcatinfo))
			{
				echo "1";
			}
		}
	}
	
	// Deleting a parent category.
	public function categoryparentdelete()
	{
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Category");
			if($this->Category->delete($_POST['pcatid']))
			{
				echo "1";
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	/*End of parent category*/
	
	/*CHILDREN CATEGORY*/
	
	// Fetching child categories.
	public function categorychild()
	{
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Category");
			$this->set('categories',$this->Category->getChildCategories());
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	// Adding new child category.
	public function categorychildadd()
	{
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Category");
			$this->loadModel("Badgecombo");
			$this->set('pcategories',$this->Category->getActiveParentCategories());
			$this->set( 'badgecombos',$this->Badgecombo->getBadgecombos( array('gradient'=>'1') ) );
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function ajax_childadd()
	{
		$this->loadModel("Category");
		if($_POST['ccatstatus']=='true')
		{
			$ccatstatus = 1;
		}
		else
		{
			$ccatstatus = 0;
		}
		$newchildcatinfo = array("title"=>addslashes($_POST['ccattitle']),"status"=>$ccatstatus,"parent"=>$_POST['ccatparent'],"badgecolor"=>$_POST['comboimg']);
		if(!empty($newchildcatinfo))
		{
			if($this->Category->save($newchildcatinfo))
			{
                $this->Session->write('child_category_name',$_POST['ccattitle']);
				echo "1";
			}
		}
	}
        
	public function ajax_elementchildadd()
	{
		$this->loadModel("Category");
		if($_POST['ccatstatus']=='true')
		{
			$ccatstatus = 1;
		}
		else
		{
			$ccatstatus = 0;
		}
		$newchildcatinfo = array("title"=>addslashes($_POST['ccattitle']),"status"=>$ccatstatus,"parent"=>$_POST['ccatparent'],"badgecolor"=>$_POST['comboimg']);
		if(!empty($newchildcatinfo))
		{
			if($this->Category->save($newchildcatinfo))
			{
                 $this->Session->write('child_category_name',$_POST['ccattitle']);
				 echo "1"."@#@".$this->Category->getLastInsertId();exit();
			}
			else
			{
				echo "0";exit();
			}
		}
		else
		{
			echo "0";exit();
		}
	}
	
	// Editing a child category.
	public function categorychildedit($id = NULL)
	{
		if($this->Session->read("username") != "")
		{
			if(isset($id))
			{
				$this->loadModel("Category");
				$this->loadModel("Badgecombo");
				$CategoryinfobyId = $this->Category->getCategoryInfobyId($id);
				$this->set( 'ccatinfo',$CategoryinfobyId );
				$this->set( 'pcategories',$this->Category->getActiveParentCategories() );
				$this->set( 'badgecombos',$this->Badgecombo->getBadgecombos( array('gradient'=>'1') ) );
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}	
	}
	
	public function ajax_childedit()
	{
		$this->loadModel("Category");
		if($_POST['ccatstatus']=='true')
		{
			$ccatstatus = 1;
		}
		else
		{
			$ccatstatus = 0;
		}
		$newchildcatinfo = array("title"=>addslashes($_POST['ccattitle']),"status"=>$ccatstatus,"parent"=>$_POST['ccatparent'],"badgecolor"=>$_POST['comboimg']);
		$this->Category->id = $_POST['ccatid'];
		if(!empty($newchildcatinfo))
		{
			if($this->Category->save($newchildcatinfo))
			{
				echo "1";
			}
		}
	}
	
	// Deleting a child category.
	public function categorychilddelete()
	{
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Category");
			if($this->Category->delete($_POST['ccatid']))
			{
				echo "1";
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function badgecombo_delete()
	{
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Badgecombo");
			if($this->Badgecombo->delete($_POST['id']))
			{
				unlink(WWW_ROOT."img/".$_POST['folder']."/".$_POST['comboimg'].".png");
				echo "1";
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	/*End of children category*/
	
	/* Image uploading funtion for category. */
	public function category_uploads()
	{
		// A list of permitted file extensions
		$allowed = array('png', 'gif');
		$output_dir = WWW_ROOT."img/catuploads/";
		if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0)
		{
			$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
			if(!in_array(strtolower($extension), $allowed)){
				echo '{"status":"error"}';
				exit;
			}

			if(move_uploaded_file($_FILES['upl']['tmp_name'], $output_dir.$_FILES['upl']['name'])){
				echo '{"status":"success"}';
				exit;
			}
		}
		echo '{"status":"error"}';
		exit;
	}
	/*End of category decal image uploading function*/
	
	/*ADMIN USERS*/
		
   	/* List all the admin users */
	public function adminuser_list()
	{
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Admin");
			$usersresult = $this->Admin->ChangeList($this->Admin->AdminusersList());
			$this->set("adminusers",$usersresult);
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	/* Admin user file uploading */
	public function adminuser_uploads()
	{
		// A list of permitted file extensions
		$allowed = array('png', 'gif');
		$output_dir = WWW_ROOT."img/adminuseruploads/";
		if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0)
		{
			$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
			if(!in_array(strtolower($extension), $allowed)){
				echo '{"status":"error"}';
				exit;
			}
			if(move_uploaded_file($_FILES['upl']['tmp_name'], $output_dir.$_FILES['upl']['name'])){
				echo '{"status":"success"}';
				exit;
			}
		}
		echo '{"status":"error"}';
		exit;
	}
	
    /* Challenge file uploading */
	public function challenge_uploads()
	{
		// A list of permitted file extensions
		$allowed = array('png', 'jpeg', 'jpg');
		//$output_dir = WWW_ROOT."img/challengeuploads/";
		$newloc = WWW_ROOT."img/challengeuploads/";
		$random_num =   $_POST['image_rand_num'];
		if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0)
		{
			$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
			if(!in_array(strtolower($extension), $allowed))
			{
				$this->Session->write("file_upload_error_message","Upload only .png or .jpeg files");exit;
			}
			else
			{
				$file           =   $_FILES["upl"]["tmp_name"];
				$oldfilename    =   $_FILES["upl"]["name"];
				$newfilename    =   $random_num . $_FILES["upl"]["name"];

				//move_uploaded_file($file,$output_dir.$newfilename);
				if(!move_uploaded_file($file,$newloc.$newfilename)){
					$this->Session->write("file_upload_error_message","Error occured while resizing the image");exit;
				}
				else
				{
				
					$file_name_challenge    =   $this->Session->read("challenge_add_file_upload_name");
					if(!$file_name_challenge)
						$this->Session->write("challenge_add_file_upload_name",$newfilename);
					// creating background image
					$width                  =   710;
					$height                 =   480;
					$newcroppedfilename     =   'cropped'.$newfilename;
					$backgroundimagename    =   "cropped/" . $newcroppedfilename;
					$blurgroundimagename    =   "blur/" . $newcroppedfilename;

                                        
                                        
//                                        $file=$_FILES["challenge_image"]["tmp_name"]; 
//                                        $randomno=rand();
//                                        $oldfilename=$_FILES["challenge_image"]["name"];
//                                        //$newfilename=$randomno . $_FILES["challenge_image"]["name"];
//                                        //$newloc=WWW_ROOT . 'uploads/';$output_dir
//                                        $newlocfilename=WWW_ROOT . 'uploads/' .  $newfilename;
//                                        move_uploaded_file($file,$newlocfilename);
//                                        $newcroppedfilename="cropped" . $randomno . $_FILES["challenge_image"]["name"];
//                                        $newcroppedlocfilename=WWW_ROOT . 'uploads/' . 'cropped/' .  $newfilename;
//                                        $newsmallfilename="small" . $randomno . $_FILES["challenge_image"]["name"]; 
//                                        $newsmalllocfilename=WWW_ROOT . 'uploads/' . 'small/' .  $newfilename;
//                                        $backgroundbluredimagetakenloc=WWW_ROOT . 'uploads/small/';
//                                        $backgroundimagename="background" . $randomno . $_FILES["challenge_image"]["name"]; 
//                                        $backgroundimagelocfilename=WWW_ROOT . 'uploads/' . 'background/' .  $newfilename;
                                        
                                        
                                        // creating cropped image
                                        $width=710;
                                            $height=249;
                                            $croppedimagename="cropped/cropped" . $newfilename;
                                        if($this->PImage->resizeImage('resize', $newfilename,  $newloc, $croppedimagename, $width))
                                            {
                                              // e('Image resized!);
                                            }



                                            // creating very small image
                                            $width=350;
                                            $height=350;
                                            $verysmallimagename="verysmall" . $newfilename;
                                        if($this->PImage->resizeImage('resizeCrop', $newfilename,  $newloc, $verysmallimagename, $width,$height))
                                            {
                                              // e('Image resized!);
                                            }



                                            // creating background image
                                        $width=710;
                                            $height=249;
                                            $backgroundimagename="background/" . $newfilename;
                                            $backgroungimgloc=$newloc;
                                     //   if($this->PImage->resizeImage('resize', $newfilename, $backgroundbluredimagetakenloc, $backgroundimagename, $width))
                                        if($this->PImage->resizeImage('resizeCrop', $verysmallimagename, $newloc, $backgroundimagename, $width,$height,true))
                                            {
                                              // e('Image resized!);
                                            }
                                        
                                            unlink($newloc.$verysmallimagename);
                                        echo '{"status":"success"}';exit;
//					if(!$this->PImage->resizeImage('resizeCrop', $newfilename, $output_dir, $backgroundimagename, $width,$height,true, 100, false, false))
//					{
//                                            if(!$this->PImage->resizeImage('resizeCrop', $newfilename, $output_dir, $blurgroundimagename, $width,$height,true, 100, false, true))
//                                            {
//						$this->Session->write("file_upload_error_message","Error occured while resizing the image");exit;
//                                            }
//					}
//					else
//					{
//						echo '{"status":"success"}';exit;
//					}
				}
			}
		}
		else
		{
			$this->Session->write("file_upload_error_message","Some error in file uploading");
		}
		echo '{"status":"error"}';
		exit;
	}
        
        
	/* Add new Admin user */
	public function adminuser_add()
	{
	 	if($this->Session->read("username") == "")
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function ajax_adminuseradd()
	{
		$this->loadModel("Admin");
		if($_POST['adminuserstatus']=='true')
		{
			$adminuserstatusstatus = 1;
		}
		else
		{
			$adminuserstatusstatus = 0;
		}
		$base64adminuserpassword=base64_encode($_POST['password']);
		$newadminuserstatusinfo = array("admin_firstname"=>$_POST['first_name'],"admin_lastname"=>$_POST['last_name'],"admin_user_name"=>$_POST['user_name'],"admin_user_password"=>$base64adminuserpassword,"admin_user_email"=>$_POST['email'],"icon"=>$_POST['adminuserfileuploaded'],"admin_user_active"=>$adminuserstatusstatus,"admin_user_type"=>$_POST['role']);
		if(!empty($newadminuserstatusinfo))
		{
			if($this->Admin->save($newadminuserstatusinfo))
			{
				echo "1";
			}
			
		}
	}
	
	/* Edit new Admin user */
	public function adminuser_edit($id = NULL)
	{
		if($this->Session->read("username") != "")
		{
			if(isset($id))
			{
				$this->loadModel("Admin");
				$admininfobyId = $this->Admin->GetAdminUser($id);
				$this->set('admininfo',$admininfobyId);
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function ajax_adminuseredit()
	{
		$this->loadModel("Admin");
		if($_POST['adminuserstatus']=='true')
		{
			$adminuserstatusstatus = 1;
		}
		else
		{
			$adminuserstatusstatus = 0;
		}
		if($_POST['password']!='')
		{
			$base64adminuserpassword=base64_encode($_POST['password']);
		}
		$newadminuserstatusinfo = array("admin_firstname"=>$_POST['first_name'],"admin_lastname"=>$_POST['last_name'],"admin_user_name"=>$_POST['user_name'],"admin_user_password"=>$base64adminuserpassword,"admin_user_email"=>$_POST['email'],"icon"=>$_POST['adminuserfileuploaded'],"admin_user_active"=>$adminuserstatusstatus,"admin_user_type"=>$_POST['role']);
		$this->Admin->id = $_POST['adminid'];
		if(!empty($newadminuserstatusinfo))
		{
			if($this->Admin->save($newadminuserstatusinfo))
			{
				echo "1";
			}
		}
	}
	
	/* Delete Admin user */
	public function adminuser_delete($id = NULL)
	{
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Admin");
			if($this->Admin->delete($_POST['adminid']))
			{
				echo "1";
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	} 
	
	/* End of Admin users*/
	
	/*USERS*/
		
    /* List all the users */
	public function users_list()
	{
		if($this->Session->read("username") != "")
		{
			$this->loadModel("User");
			$usersresult = $this->User->GetUsers();
			$this->set("users",$usersresult);
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	/* Edit a user */
	public function user_edit($id = NULL)
	{
		if($this->Session->read("username") != "")
		{
			if(isset($id))
			{
				$this->loadModel("User");
				$userinfobyId = $this->User->GetUserById($id);
				$this->set('userinfo',$userinfobyId);
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function ajax_useredit()
	{		
		$this->loadModel("User");
		if($_POST['userstatus']=='true')
		{
			$userstatusstatus = 1;
		}
		else
		{
			$userstatusstatus = 0;
		}
		$newuserstatusinfo = array("user_notification_email"=>$_POST['notification_email'],"user_active"=>$userstatusstatus);
		$this->User->id = $_POST['userid'];
		if(!empty($newuserstatusinfo))
		{
			if($this->User->save($newuserstatusinfo))
			{
				echo "1";
			}
		}
	}
	
	/* Delete a user */
	public function user_delete()
	{
		if($this->Session->read("username") != "")
		{
			$this->loadModel("User");
			if($this->User->delete($_POST['userid']))
			{
				echo "1";
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	} 
	
	/* Checking availability of the username/title name */
	public function ajax_checkavail()
	{
		if($_POST['mode']=="Admin")
		{
			$this->loadModel("Admin");
			if($_POST['flag']   ==  'add')
				$conditions =   array($_POST['field_name'] => $_POST['checkavail']);
			else
			{
				$conditions =   array(
					$_POST['field_name'] => $_POST['checkavail'],
					'id !=' =>  $_POST['edit_id']
				);
			}
			echo $adminnameavail = $this->Admin->CheckAdminUserAvailable($conditions);exit;
		}
		if($_POST['mode']=="Child")
		{
			$this->loadModel("Category");
                        if($_POST['flag']   ==  'add')
				$conditions =   array('parent!=0','title' => $_POST['checkavail']);
			else
			{
				$conditions =   array(
                                        'parent!=0',
					'title' => $_POST['checkavail'],
					'id !='.$_POST['edit_id'].''
				);
			}
			echo $childnameavail = $this->Category->CheckChildCategoryAvailable($conditions);exit();
		}
		if($_POST['mode']=="Parent")
		{
			$this->loadModel("Category");
                        if($_POST['flag']   ==  'add')
				$conditions =   array('parent' => '0','title' => $_POST['checkavail']);
			else
			{
				$conditions =   array(
                                        'parent' => '0',
					'title' => $_POST['checkavail'],
					'id != '.$_POST['edit_id'].''
				);
			}
			echo $parentnameavail = $this->Category->CheckParentCategoryAvailable($conditions);exit();
		}
		if($_POST['mode']=="Difficulty")
		{
                        if($_POST['flag']   ==  'add')
                                $conditions =   array('title' => $_POST['checkavail']);
                        else
                        {
                                $conditions =   array(
                                        'title' => $_POST['checkavail'],
                                        'id !=' => $_POST['edit_id']
                                );
                        }
			$this->loadModel("Difficulty");
			echo $difficultyavail = $this->Difficulty->CheckDifficultyAvailable($conditions);exit;
		}
		if($_POST['mode']=="Challenge")
		{
			$this->loadModel("Challenge");
			echo $challengenameavail = $this->Challenge->CheckChallengeAvailable($_POST['checkavail']);
		}
	}
	
        public function ajax_change_invitation()
        {
            $status =   7;
            if($_POST['need'] == 'agree')
                $status =   6;
            
            $this->loadModel('Userchallenge');
            $this->Userchallenge->id  =   $_POST['id'];
            if($this->Userchallenge->SaveField('user_challenge_status',$status))
                echo "1";
            else
                echo "0";
            exit;
        }
        
	/**
	 * Creating the image for badge while selecting the color from color picker
	 */
	public function ajax_createimage()
	{

		$color_val1                      =   $this->_hex2rgb($_POST['color1']);
		$color_val2                      =   $this->_hex2rgb($_POST['color2']);
		$color_val3                      =   $this->_hex2rgb($_POST['color3']);
		$color_val4                      =   $this->_hex2rgb($_POST['color4']);
		$newchildcatinfo['gradient']    =   $_POST['gradient'];
		$destination                    =   ($_POST['gradient'] == '1')?'badgedesign':'badgecolor';
		
		// Create a 55x30 image
		$im = imagecreate(200, 200);
		$red = imagecolorallocate($im, $color_val1[0], $color_val1[1], $color_val1[2]);
		$red1 = imagecolorallocate($im, $color_val2[0], $color_val2[1], $color_val2[2]);
		$red2 = imagecolorallocate($im, $color_val3[0], $color_val3[1], $color_val3[2]);     //SELECTED COLOUR
		$red3 = imagecolorallocate($im, $color_val4[0], $color_val4[1], $color_val4[2]);
		//$red4 = imagecolorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255));
		$black = imagecolorallocate($im, 0, 0, 0);

		// Make the background transparent
		imagecolortransparent($im, $black);
		if($newchildcatinfo['gradient'] == 1)
		{
			// Draw a red rectangle with nearest colours
			imagefilledrectangle($im, 0, 0, 50, 200, $red);
			imagefilledrectangle($im, 50, 0, 100, 200, $red1);
			imagefilledrectangle($im, 100, 0, 150, 200, $red2);
			imagefilledrectangle($im, 150, 0, 200, 200, $red3);
			
			/* Five gradiant colors
			imagefilledrectangle($im, 0, 0, 40, 200, $red);
			imagefilledrectangle($im, 40, 0, 80, 200, $red1);
			imagefilledrectangle($im, 80, 0, 120, 200, $red2);
			imagefilledrectangle($im, 120, 0, 160, 200, $red3);
			imagefilledrectangle($im, 160, 0, 200, 200, $red4);*/
		}
		else
		{
			// Draw a red rectangle with selected one colour
			imagefilledrectangle($im, 0, 0, 200, 200, $red2);
		}
		
		$image_name =   'color'.rand(0, 999).time().'.png';
		$file_name  =   'img/'.$destination.'/'.$image_name.'';
		
		while (file_exists($file_name)) {
			$image_name =   'color'.rand(0, 999).time().'.png';
			$file_name  =   'img/'.$destination.'/'.$image_name.'';
		}
		
		// Save the image
		imagepng($im, 'img/'.$destination.'/'.$image_name.'');
		$newchildcatinfo['comboimg']    =   $image_name;

		$this->loadModel("Badgecombo");
		if($this->Badgecombo->save($newchildcatinfo))
		{
			imagedestroy($im);
			echo $image_name."@#&".$this->Badgecombo->getLastInsertId()."@#&".substr($image_name, 0, -4);exit();
		}
		else
		{
			imagedestroy($im);
			unlink('img/'.$destination.'/'.$image_name.'');
			echo "0";exit();
		}		
	}
	
	// getting the RGB value in an an array..
	function _hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);

	   if(strlen($hex) == 3) {
		  $r = hexdec(substr($hex,0,1).substr($hex,0,1));
		  $g = hexdec(substr($hex,1,1).substr($hex,1,1));
		  $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
		  $r = hexdec(substr($hex,0,2));
		  $g = hexdec(substr($hex,2,2));
		  $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
        
	/* End of users*/
	
	/* CHALLENGES */
	
	/* Add new challenge */
	public function challenges()
	{
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Challenge");
			$this->loadModel("Category");
			$this->loadModel("Difficulty");
			$Challengeinfo = $this->Challenge->getChallenges();
			foreach($Challengeinfo as $k=>$Challenge)
			{
				$parentcatname = $this->Category->getCategoryInfobyId($Challenge['Challenge']['parent_category']);
				$Challengeinfo[$k]['Challenge']['pcat'] = $parentcatname?$parentcatname[0]['Category']['title']:'';
				$difficultyname = $this->Difficulty->getDifficultybyId($Challenge['Challenge']['difficulty']);
                                $Challengeinfo[$k]['Challenge']['diff'] = $difficultyname?$difficultyname[0]['Difficulty']['title']:'';
			}
			$this->set('Challengeinfo',$Challengeinfo);
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function challengeaddstep1()
	{
		if($this->Session->read("username") == "")
		{
             header('Location:'.urldecode(Router::url('/admin', true)));exit();
		}
	}
	
	public function ajax_challengeaddstep1()
	{
		if($_POST['repeatable']=='true')
		{
			$repeatable = 1;
		}
		else
		{
			$repeatable = 0;
		}
		if($_POST['status']=='true')
		{
			$status = 1;
		}
		else
		{
			$status = 0;
		}
		$newchallengeinfo = $this->Session->read('newchallengeinfo');
		if(isset($newchallengeinfo))
		{
			$_SESSION['newchallengeinfo']['name'] = addslashes($_POST['challengename']);
			$_SESSION['newchallengeinfo']['badge_title'] = addslashes($_POST['badgetitle']);
			$_SESSION['newchallengeinfo']['daily_commitment'] = addslashes($_POST['dailycommit']);
			$_SESSION['newchallengeinfo']['why'] = addslashes($_POST['why']);
			$_SESSION['newchallengeinfo']['how'] = addslashes($_POST['how']);
			$_SESSION['newchallengeinfo']['learn_more'] = addslashes($_POST['learnmore']);
			$_SESSION['newchallengeinfo']['repeatable'] = $repeatable;
			$_SESSION['newchallengeinfo']['status'] = $status;
		}
		else
		{
			$newchallengeinfo = array("name"=>addslashes($_POST['challengename']),"badge_title"=>addslashes($_POST['badgetitle']),"daily_commitment"=>addslashes($_POST['dailycommit']),"why"=>addslashes($_POST['why']),"how"=>addslashes($_POST['how']),"learn_more"=>addslashes($_POST['learnmore']),"repeatable"=>$repeatable,"status"=>$status);
			$this->Session->write("newchallengeinfo",$newchallengeinfo);
		}
        $this->Session->write("stepinfo",$_POST['step']);
		echo "1";
	}
	
	public function challengeeditstep1($id = NULL)
	{
		if($this->Session->read("username") != "")
		{ 
			if(isset($id))
			{
				$newchallengeinfo = $this->Session->read('newchallengeinfo');
				if($id != $newchallengeinfo[0]['Challenge']['id'])
				{
					$this->Session->delete('newchallengeinfo');
					unset($_SESSION['newchallengeinfo']);
				}
				$newchallengeinfo = $this->Session->read('newchallengeinfo');
				if(!isset($newchallengeinfo))
				{
					$this->loadModel("Challenge");
					$this->Session->write("newchallengeinfo",$this->Challenge->getChallengebyId($id)); 
				}
                $newchallengeinfo = $this->Session->read('newchallengeinfo');

				$this->loadModel('Category');
				$parent_img_name    =   $this->Category->getCategoryInfobyId($newchallengeinfo[0]['Challenge']['parent_category']);
				$newchallengeinfo[0]['Challenge']['chalngparentimagename']  =   $parent_img_name[0]['Category']['decal'];
                $child_img_name    =   $this->Category->getCategoryInfobyId($newchallengeinfo[0]['Challenge']['child_category']);
                $newchallengeinfo[0]['Challenge']['chalngparentchildimagename']  =   $child_img_name?$child_img_name[0]['Category']['badgecolor']:'';
                                
                $this->loadModel('Difficulty');
				$parent_img_name    =   $this->Difficulty->getDifficultybyId($newchallengeinfo[0]['Challenge']['difficulty']);
				$newchallengeinfo[0]['Challenge']['chalngdifficultyimagename']  =   $parent_img_name[0]['Difficulty']['decal'];
                                
                $this->loadModel('Badgecombo');
				$parent_img_name    =   $this->Badgecombo->selectedBadgecombo($newchallengeinfo[0]['Challenge']['badge_color']);
				$newchallengeinfo[0]['Challenge']['chalngbadgecolorimagename']  =   $parent_img_name[0]['Badgecombo']['comboimg'];

				$this->Session->delete("newchallengeinfo");
				$this->Session->write("newchallengeinfo",$newchallengeinfo);
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function ajax_challengeeditstep1()
	{
		if($_POST['repeatable']=='true')
		{
			$repeatable = 1;
		}
		else
		{
			$repeatable = 0;
		}
		if($_POST['status']=='true')
		{
			$status = 1;
		}
		else
		{
			$status = 0;
		}
		$newchallengeinfo = $this->Session->read('newchallengeinfo');
		if(isset($newchallengeinfo))
		{
			$_SESSION['newchallengeinfo'][0]['Challenge']['name'] = addslashes($_POST['challengename']);
			$_SESSION['newchallengeinfo'][0]['Challenge']['badge_title'] = addslashes($_POST['badgetitle']);
			$_SESSION['newchallengeinfo'][0]['Challenge']['daily_commitment'] = addslashes($_POST['dailycommit']);
			$_SESSION['newchallengeinfo'][0]['Challenge']['why'] = addslashes($_POST['why']);
			$_SESSION['newchallengeinfo'][0]['Challenge']['how'] = addslashes($_POST['how']);
			$_SESSION['newchallengeinfo'][0]['Challenge']['learn_more'] = addslashes($_POST['learnmore']);
			$_SESSION['newchallengeinfo'][0]['Challenge']['repeatable'] = $repeatable;
			$_SESSION['newchallengeinfo'][0]['Challenge']['status'] = $status;
		}
		else
		{
			$newchallengeinfo = array("id"=>$_POST['challengeid'],"name"=>addslashes($_POST['challengename']),"badge_title"=>addslashes($_POST['badgetitle']),"daily_commitment"=>addslashes($_POST['dailycommit']),"why"=>addslashes($_POST['why']),"how"=>addslashes($_POST['how']),"learn_more"=>addslashes($_POST['learnmore']),"repeatable"=>$repeatable,"status"=>$status);
			$this->Session->write("newchallengeinfo",$newchallengeinfo);
		}
		echo "1";
	}
	
	public function challengeaddstep2()
	{
		$last_value_of_web_url    =   substr($_SERVER['REQUEST_URI'], -1);
		$newchallengeinfo = $this->Session->read("newchallengeinfo");
		
		if(!$newchallengeinfo)
		{
			header('Location:'.urldecode(Router::url('/admin/challengeaddstep1', true)));exit();
		}
		else
		{
			$step   =   $this->Session->read("stepinfo")?$this->Session->read("stepinfo"):1;
			if($last_value_of_web_url > $step)
			{
				header('Location:'.urldecode(Router::url('/admin/challengeaddstep'.$step, true)));exit();
			}
		}
                
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Category");
			$this->set('pcategories',$this->Category->getActiveParentCategories());
			$this->loadModel("Badgecombo");
			$this->set( 'badgecombos',$this->Badgecombo->getBadgecombos( array('gradient'=>'1') ) );
                        
			$newchallengeinfo = $this->Session->read("newchallengeinfo");

			if( isset( $newchallengeinfo['parent_category'] ) )
			{
				$this->set( 'child_combo',$this->Category->getCombo($newchallengeinfo['parent_category'],'child_val',$newchallengeinfo['child_category']));
			}
			else
			{
				$this->set('child_combo','');
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}

	/**
	 * getting the child combo for the corresponding parent
	 */
	public function ajax_getchildcombo()
	{
		$id =   $_POST['id'];
		$this->loadModel("Category");
		$category   =   $this->Category->getCategoryInfobyId($id);
		echo  $this->Category->getCombo($id,'child_val','')."@#@".$category[0]['Category']['decal']."@#@".$category[0]['Category']['badgecolor'];exit;
	}
        
	public function ajax_challengeaddstep2()
	{
		$newchallengeinfo = $this->Session->read("newchallengeinfo");
		$newchallengeinfo['parent_category'] = $_POST['chalngparent'];
		$newchallengeinfo['child_category'] = $_POST['chalngparentchild'];
		$newchallengeinfo['chalngparentimagename'] = $_POST['chalngparentimagename'];
		$newchallengeinfo['chalngparentchildimagename'] = $_POST['chalngparentchildimagename'];
		$newchallengeinfo['length_of_challenge'] = $_POST['chalnglen'];
		$newchallengeinfo['host_set_start_date'] = $_POST['chalngwhosets'];
		$newchallengeinfo['start_date'] = $_POST['chalngbegining'];
		$newchallengeinfo['end_date'] = $_POST['chalngending'];
		$newchallengeinfo['added_date'] = date('Y-m-d h:i:s');
		$this->Session->write("newchallengeinfo",$newchallengeinfo);
		$this->Session->write("stepinfo",$_POST['step']);
		echo "1";
	}
	
	public function challengeeditstep2($id = NULL)
	{
		if($this->Session->read("username") != "")
		{ 
			if(isset($id))
			{
				$this->loadModel("Category");
				$this->set('pcategories',$this->Category->getActiveParentCategories());
				//$this->loadModel("Challenge");
				
				$this->loadModel("Badgecombo");
				$this->set( 'badgecombos',$this->Badgecombo->getBadgecombos( array('gradient'=>'1') ) );
				
				$this->Session->write("newchallengeinfo",$this->Session->read("newchallengeinfo"));
				$newchallengeinfo = $this->Session->read("newchallengeinfo");
				
				$parent_img_name    =   $this->Category->getCategoryInfobyId($newchallengeinfo[0]['Challenge']['parent_category']);
				$newchallengeinfo[0]['Challenge']['chalngparentimagename']  =   $parent_img_name[0]['Category']['decal'];
				$child_img_name    =   $this->Category->getCategoryInfobyId($newchallengeinfo[0]['Challenge']['child_category']);
				$newchallengeinfo[0]['Challenge']['chalngparentchildimagename']  =   $child_img_name?$child_img_name[0]['Category']['badgecolor']:'';

				$this->Session->delete("newchallengeinfo");
				$this->Session->write("newchallengeinfo",$newchallengeinfo);
				
				
				if( isset( $newchallengeinfo[0]['Challenge']['parent_category'] ) )
				{
					$this->set( 'child_combo',$this->Category->getCombo($newchallengeinfo[0]['Challenge']['parent_category'],'child_val',$newchallengeinfo[0]['Challenge']['child_category']));
				}
				else
				$this->set('child_combo','');
				$this->set('url_path','../');
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function ajax_challengeeditstep2()
	{
		$newchallengeinfo = $this->Session->read("newchallengeinfo");
		if(isset($newchallengeinfo))
		{
			$_SESSION['newchallengeinfo'][0]['Challenge']['parent_category'] = $_POST['chalngparent'];
			$_SESSION['newchallengeinfo'][0]['Challenge']['child_category'] = $_POST['chalngparentchild'];
                        $_SESSION['newchallengeinfo'][0]['Challenge']['chalngparentimagename'] = $_POST['chalngparentimagename'];
			$_SESSION['newchallengeinfo'][0]['Challenge']['chalngparentchildimagename'] = $_POST['chalngparentchildimagename'];               
			$_SESSION['newchallengeinfo'][0]['Challenge']['length_of_challenge'] = $_POST['chalnglen'];
			$_SESSION['newchallengeinfo'][0]['Challenge']['host_set_start_date'] = $_POST['chalngwhosets'];
			$_SESSION['newchallengeinfo'][0]['Challenge']['start_date'] = $_POST['chalngbegining'];
			$_SESSION['newchallengeinfo'][0]['Challenge']['end_date'] = $_POST['chalngending'];
			$_SESSION['newchallengeinfo'][0]['Challenge']['added_date'] = date('Y-m-d h:i:s');
		}
		else
		{
			$newchallengeinfo['parent_category'] = $_POST['chalngparent'];
			$newchallengeinfo['child_category'] = $_POST['chalngparentchild'];
			$newchallengeinfo['chalngparentimagename'] = $_POST['chalngparentimagename'];
			$newchallengeinfo['chalngparentchildimagename'] = $_POST['chalngparentchildimagename'];
			$newchallengeinfo['length_of_challenge'] = $_POST['chalnglen'];
			$newchallengeinfo['host_set_start_date'] = $_POST['chalngwhosets'];
			$newchallengeinfo['start_date'] = $_POST['chalngbegining'];
			$newchallengeinfo['end_date'] = $_POST['chalngending'];
			$newchallengeinfo['added_date'] = date('Y-m-d h:i:s');
			$this->Session->write("newchallengeinfo",$newchallengeinfo);
		}
		echo "1";
	}
	
	public function challengeaddstep3()
	{
		$last_value_of_web_url    =   substr($_SERVER['REQUEST_URI'], -1);
		$newchallengeinfo = $this->Session->read("newchallengeinfo");
		
		if(!$newchallengeinfo)
		{
			header('Location:'.urldecode(Router::url('/admin/challengeaddstep1', true)));exit();
		}
		else
		{
			$step   =   $this->Session->read("stepinfo")?$this->Session->read("stepinfo"):1;
			if($last_value_of_web_url > $step)
			{
				header('Location:'.urldecode(Router::url('/admin/challengeaddstep'.$step, true)));exit();
			}
		}
                
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Category");
			$this->loadModel("Challenge");
			$Challengetag_detail	=	$this->Challenge->getTags();
		
			$this->set('challengetags', $Challengetag_detail);
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function ajax_challengeaddstep3()
	{
		$newchallengeinfo = $this->Session->read("newchallengeinfo");
		$newchallengeinfo['tags'] = addslashes($_POST['challengetagWord']);
		$newchallengeinfo['eligibility'] = '';
		$this->Session->write("newchallengeinfo",$newchallengeinfo);
		$this->Session->write("stepinfo",$_POST['step']);
		echo "1";
	}
	
	public function challengeeditstep3($id = NULL)
	{
		if($this->Session->read("username") != "")
		{
			if(isset($id))
			{
				$this->loadModel("Challenge");
				$this->Session->write("newchallengeinfo",$this->Session->read("newchallengeinfo")); 
				$Challengetag_detail	=	$this->Challenge->getTags();
				$this->set('challengetags', $Challengetag_detail);
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function ajax_challengeeditstep3()
	{
		$newchallengeinfo = $this->Session->read("newchallengeinfo");
		if(isset($newchallengeinfo))
		{
			$_SESSION['newchallengeinfo'][0]['Challenge']['tags'] = addslashes($_POST['challengetagWord']);
			$_SESSION['newchallengeinfo'][0]['Challenge']['eligibility'] = '';
		}
		else
		{
			$newchallengeinfo['tags'] = $_POST['challengetagWord'];
			$newchallengeinfo['eligibility'] = '';
			$this->Session->write("newchallengeinfo",$newchallengeinfo);
		}
		echo "1";
	}
	
	public function challengeaddstep4()
	{
		$last_value_of_web_url    =   substr($_SERVER['REQUEST_URI'], -1);
		$newchallengeinfo = $this->Session->read("newchallengeinfo");

		if(!$newchallengeinfo)
		{
			header('Location:'.urldecode(Router::url('/admin/challengeaddstep1', true)));exit();
		}
		else
		{
			$step   =   $this->Session->read("stepinfo")?$this->Session->read("stepinfo"):1;
			if($last_value_of_web_url > $step)
			{
				header('Location:'.urldecode(Router::url('/admin/challengeaddstep'.$step, true)));exit();
			}
		}
                
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Difficulty");
			$this->set('difficulties',$this->Difficulty->getActiveDifficultiesTypes());
                        $this->loadModel("Notificationmessage");
			$this->set('pre_notification_message',$this->Notificationmessage->find( "all"));
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	/**
	 * Inserting message at here...
	 */
	public function ajax_createmessage()
	{
		$this->loadModel("Notificationmessage");
		
		if($this->Notificationmessage->save($_POST))
		{
			echo "1"."@#@".$this->Notificationmessage->getLastInsertId();exit();
		}
		else
		{
			echo "0";exit();
		}
	}

    public function ajax_challengeaddstep4()
	{
		$newchallengeinfo = $this->Session->read("newchallengeinfo");
		$newchallengeinfo['difficulty'] =   $_POST['chaldiff'];
		$newchallengeinfo['pre_notification'] =   addslashes($_POST['pre_notification']);
		$newchallengeinfo['custom_notification'] =   addslashes($_POST['custom_notification']);
		$newchallengeinfo['notification_frequency'] =   $_POST['notification_frequency'];
		$newchallengeinfo['chalngdifficultyimagename'] =   $_POST['chalngdifficultyimagename'];
		$this->Session->write("newchallengeinfo",$newchallengeinfo);
		$this->Session->write("stepinfo",$_POST['step']);
		echo "1";
	}
	
	public function challengeeditstep4($id = NULL)
	{
		if($this->Session->read("username") != "")
		{
			if(isset($id))
			{
				$this->loadModel("Difficulty");
				$this->set('difficulties',$this->Difficulty->getActiveDifficultiesTypes());
				$this->loadModel("Challenge");
                                
				$newchallengeinfo   =   $this->Session->read("newchallengeinfo");
				
				$this->loadModel("Category");
				$parent_img_name    =   $this->Category->getCategoryInfobyId($newchallengeinfo[0]['Challenge']['parent_category']);
				$newchallengeinfo[0]['Challenge']['chalngparentimagename']  =   $parent_img_name[0]['Category']['decal'];
				
				$child_img_name    =   $this->Category->getCategoryInfobyId($newchallengeinfo[0]['Challenge']['child_category']);
				$newchallengeinfo[0]['Challenge']['chalngparentchildimagename']  =   $child_img_name?$child_img_name[0]['Category']['badgecolor']:'';

				$this->Session->delete("newchallengeinfo");
				$this->Session->write("newchallengeinfo",$newchallengeinfo);
                                
				$this->loadModel("Notificationmessage");
				$this->set('pre_notification_message',$this->Notificationmessage->find( "all"));
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function ajax_challengeeditstep4()
	{
		$newchallengeinfo = $this->Session->read("newchallengeinfo");
		if(isset($newchallengeinfo))
		{
			$_SESSION['newchallengeinfo'][0]['Challenge']['difficulty'] = $_POST['chaldiff'];
			$_SESSION['newchallengeinfo'][0]['Challenge']['pre_checkin_notification'] = $_POST['pre_notification'];
			$_SESSION['newchallengeinfo'][0]['Challenge']['checkin_notification'] = addslashes($_POST['custom_notification']);
			$_SESSION['newchallengeinfo'][0]['Challenge']['chalngdifficultyimagename'] = addslashes($_POST['chalngdifficultyimagename']);
			$_SESSION['newchallengeinfo'][0]['Challenge']['notification_frequency'] = $_POST['notification_frequency'];
		}
		else
		{
			$newchallengeinfo['difficulty'] = $_POST['chaldiff'];
			$newchallengeinfo['pre_checkin_notification'] = $_POST['pre_notification'];
			$newchallengeinfo['checkin_notification'] = $_POST['custom_notification'];
			$newchallengeinfo['notification_frequency'] = $_POST['notification_frequency'];
			$newchallengeinfo['chalngdifficultyimagename'] = $_POST['chalngdifficultyimagename'];
			$this->Session->write("newchallengeinfo",$newchallengeinfo);
		}
		echo "1";
	}
	
	
	public function challengeaddstep5()
	{
		$last_value_of_web_url    =   substr($_SERVER['REQUEST_URI'], -1);
		$newchallengeinfo = $this->Session->read("newchallengeinfo");
		
		if(!$newchallengeinfo)
		{
			header('Location:'.urldecode(Router::url('/admin/challengeaddstep1', true)));exit();
		}
		else
		{
			$step   =   $this->Session->read("stepinfo")?$this->Session->read("stepinfo"):1;
			if($last_value_of_web_url > $step)
			{
				header('Location:'.urldecode(Router::url('/admin/challengeaddstep'.$step, true)));exit();
			}
		}
                
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Badgecombo");
			$this->set( 'badgecombos',$this->Badgecombo->getBadgecombos( array('gradient'=>'0') ) );
			$this->set( 'image_prepend_random_number',uniqid() );
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function challengeeditstep5($id = NULL)
	{
		if($this->Session->read("username") != "")
		{
			if(isset($id))
			{
				$this->loadModel("Challenge");
				$newchallengeinfo = $this->Session->read("newchallengeinfo");
				$this->loadModel("Badgecombo");
				$this->set('badgecombos',$this->Badgecombo->getBadgecombos(array('gradient'=>'0')));
				if($newchallengeinfo[0]['Challenge']['badge_color']!='')
				{
					$selectedbandgecombo = $this->Badgecombo->selectedBadgecombo($newchallengeinfo[0]['Challenge']['badge_color']);
					$selectedbc = $selectedbandgecombo[0]['Badgecombo']['comboimg'];
				}
				else
				{
					$selectedbc = '';
				}
				$this->set( 'image_prepend_random_number',uniqid() );
				$this->set('selectedbadgecombo',$selectedbc);
				$this->Session->write("newchallengeinfo",$newchallengeinfo);
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}
	
	public function ajax_removefilename()
	{
		$session_name   =   $_POST['file_session_name'];
		//$_SESSION[$session_name]    =   '';
		$this->Session->write($session_name,'');
	}
	/**
	 * challenge saving doing here. getting the last step value at here 
	 * and save the challenge by getting the value from the session
	 */
	public function ajax_challengeadd()
	{
		$newchallengeinfo                               =   $this->Session->read("newchallengeinfo");
		$newchallengeinfo['hero_image']                 =   $this->Session->read("challenge_add_file_upload_name");//$_POST['hero_image'];
		$newchallengeinfo['badge_color']                =   $_POST['badge_color'];
		$newchallengeinfo['checkin_notification']       =   $newchallengeinfo['custom_notification']?$newchallengeinfo['custom_notification']:'';
		$newchallengeinfo['pre_checkin_notification']   =   $newchallengeinfo['pre_notification']?$newchallengeinfo['pre_notification']:'';
		$newchallengeinfo['permalink']                  =   implode("-", explode(" ", $newchallengeinfo['name']));
		unset($newchallengeinfo['custom_notification']);
		unset($newchallengeinfo['pre_notification']);
		unset($newchallengeinfo['chalngparentimagename']);
		unset($newchallengeinfo['chalngparentchildimagename']);
                if($newchallengeinfo['host_set_start_date'] == 0)
                {
                    unset($newchallengeinfo['start_date']);
                    unset($newchallengeinfo['end_date']);
                }

		if(!empty($newchallengeinfo))
		{
			$this->loadModel("Challenge");
			if($this->Challenge->save($newchallengeinfo))
			{
				$this->Session->delete('newchallengeinfo');
				$this->Session->delete('stepinfo');
				$this->Session->delete('file_upload_error_message');
				$this->Session->delete('challenge_add_file_upload_name');
				echo "1";
			}
		}
	}

	public function ajax_challengeedit()
	{
		$newchallengeinfo = $this->Session->read("newchallengeinfo");
		$id	=	$_POST['challengeid'];
		if(!empty($newchallengeinfo))
		{
		if($newchallengeinfo[0]['Challenge']['host_set_start_date'] == 0)
                {
                    $newchallengeinfo[0]['Challenge']['start_date'] =   '';
                    $newchallengeinfo[0]['Challenge']['end_date']   =   '';
                }
		$newchallengeinfo	=	array("id"	=>	$id,
			"name" => $newchallengeinfo[0]['Challenge']['name'],
			"badge_title" => $newchallengeinfo[0]['Challenge']['badge_title'],
			"daily_commitment" => $newchallengeinfo[0]['Challenge']['daily_commitment'],
			"why" => $newchallengeinfo[0]['Challenge']['why'],
			"how" => $newchallengeinfo[0]['Challenge']['how'],
			"learn_more" => $newchallengeinfo[0]['Challenge']['learn_more'],
			"repeatable" => $newchallengeinfo[0]['Challenge']['repeatable'],
			"status" => $newchallengeinfo[0]['Challenge']['status'],
			"parent_category" => $newchallengeinfo[0]['Challenge']['parent_category'],
			"child_category" => $newchallengeinfo[0]['Challenge']['child_category'],
			"length_of_challenge" => $newchallengeinfo[0]['Challenge']['length_of_challenge'],
			"host_set_start_date" => $newchallengeinfo[0]['Challenge']['host_set_start_date'],
			"start_date" => $newchallengeinfo[0]['Challenge']['start_date'],
			"end_date" => $newchallengeinfo[0]['Challenge']['end_date'],
			"added_date" => $newchallengeinfo[0]['Challenge']['added_date'],
			"tags" => $newchallengeinfo[0]['Challenge']['tags'],
			"eligibility" => '',
			"difficulty" => $newchallengeinfo[0]['Challenge']['difficulty'],
			"pre_checkin_notification" =>$newchallengeinfo[0]['Challenge']['pre_checkin_notification'], 
			"checkin_notification" => $newchallengeinfo[0]['Challenge']['checkin_notification'],
			"notification_frequency" => $newchallengeinfo[0]['Challenge']['notification_frequency'],
			"hero_image" => $_POST['temp_fileuploaded']?$this->Session->read("challenge_add_file_upload_name"):$_POST['hero_image'],
			"badge_color" => $_POST['badge_color']
			);

			$this->loadModel("Challenge");
			$this->Challenge->id = $id;
			if($this->Challenge->save($newchallengeinfo))
			{
				$this->Session->delete('newchallengeinfo');
				unset($_SESSION['newchallengeinfo']);
				$this->Session->delete('stepinfo');
				$this->Session->delete('file_upload_error_message');
                $this->Session->delete('challenge_add_file_upload_name');
				echo "1";exit();
			}
		}
	}
	
	/* Delete a user */
	public function challengedelete()
	{
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Challenge");
			if($this->Challenge->delete($_POST['id']))
			{
				echo "1";
			}
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	} 
	
	
	/* Alert List  */
        
    public function alertlist()
	{
		if($this->Session->read("username") != "")
		{
			$this->loadModel("Alert");
			$alertresult = $this->Alert->GetAlerts();
			$this->set("alertslist",$alertresult);
		}
		else
		{
			header('Location:'.urldecode(Router::url('/admin', true)));
			exit();
		}
	}   
        
	// alert edit
	public function ajax_alertedit()
	{
		$this->loadModel("Alert");
		$this->Alert->id = $_POST['id'];
		$alertinfo=stripslashes(trim($_POST['text']));
		if(!empty($alertinfo))
		{
			if($this->Alert->saveField('copy',$alertinfo))
			{
				echo "Alert copy text successfully updated!";
			}
		}
	}  
}
?>
