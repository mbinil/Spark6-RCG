<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
class UsersController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
 
	public $name = 'User';
 
	public $uses = array();
		
	public function registration_step1() { }
	
	public function ajax_registration_step1() 
	{
		$newreginfo = $this->Session->read("newreginfo");
		$newreginfo['user_firstname'] = stripslashes(trim($_POST['fname']));
		$newreginfo['user_lastname'] = stripslashes(trim($_POST['lname']));
		$newreginfo['user_email'] = $_POST['email'];
		$newreginfo['user_password'] = md5($_POST['pass']);
		$newreginfo['user_gender'] = $_POST['gender'];
		if(isset($_POST['ebay_buz_unit']) && $_POST['ebay_buz_unit']!='')
		{
			$newreginfo['user_business_unit'] = $_POST['ebay_buz_unit'];
		}
		if(isset($_POST['ebay_buz_loc']) && $_POST['ebay_buz_loc']!='')
		{
			$newreginfo['user_business_loc'] = $_POST['ebay_buz_loc'];
		}
		$newreginfo['user_notification'] = $_POST['email_noti'];
		$this->Session->write("newreginfo",$newreginfo);
		echo "1";
	}
	
	public function registration_step2() { }
	
	public function adminuser_uploads()
	{
		// A list of permitted file extensions
		$allowed = array('png', 'gif', 'jpg', 'JPEG');
		$output_dir = WWW_ROOT."img/useruploads/";
		if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0)
		{
			$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
			if(!in_array(strtolower($extension), $allowed)){
				echo '{"status":"error"}';
				exit;
			}
			if(move_uploaded_file($_FILES['upl']['tmp_name'], $output_dir.$_FILES['upl']['name'])){
				$newreginfo = $this->Session->read("newreginfo");
				$newreginfo['user_profile_picture'] =  $_FILES['upl']['name'];
				$this->Session->write("newreginfo",$newreginfo);
				echo '{"status":"success"}';
				exit;
			}
		}
		echo '{"status":"error"}';
		exit;
	}
	
	public function ajax_registration_step2() 
	{
		$newreginfo = $this->Session->read("newreginfo");
		$newreginfo['user_grd_year'] = $_POST['grd_year'];
		$newreginfo['user_grd_level'] = $_POST['grd_level'];
		$newreginfo['user_grd_schl'] = $_POST['grd_scl'];
		$newreginfo['user_grd_degree'] = $_POST['mult_sel'];
		$newreginfo['user_grd_cat'] = $_POST['sub_cat'];
		$this->Session->write("newreginfo",$newreginfo);
		echo "1";
	
	}
	
	public function registration_step3() { }
	
	public function ajax_registration_step3() 
	{
		$newreginfo = $this->Session->read("newreginfo");
		$newreginfo['user_hobbies'] = stripslashes($_POST['hobby']);
		$newreginfo['user_added'] = date("Y-m-d h:i:s");
		$newreginfo['user_points'] = 0;
		$newreginfo['user_level'] = 0;
		$newreginfo['user_last_login'] = date("Y-m-d h:i:s");
		$newreginfo['user_timezone'] = 0;
		$newreginfo['user_timezone_hs'] = '0';
		$newreginfo['user_total_challenges'] = 0;
		$newreginfo['user_active'] = 1;
		$this->Session->write("newreginfo",$newreginfo);
		
		//print_r($newreginfo);
		$newreginfo = $this->Session->read("newreginfo");
		if(!empty($newreginfo ))
		{
			$this->loadModel("User");
			$result = $this->User->registr($newreginfo);
			if($result==1)
			{
				$id = $this->User->getLastInsertId();
    			$this->Session->write("session_user_id",$id);
				$this->Session->delete("newreginfo");
				unset($newreginfo);
				echo "1";
			}
		}
	}
	
	public function ajax_email_unique()
	{
		$reg_email = $_POST['email'];
		$this->loadModel("User");
		$result = $this->User->email_uniqueness($reg_email);
	}
	
	public function ajax_loginchecking() {
		$this->loadModel("User");
		$result = $this->User->loginchecking($_REQUEST['loginusername'],$_REQUEST['loginpassword']);
		print_r($result);exit();
		if(count($result)>0)
		{
			echo "1";
		}
		else
		{
			echo "0";
		}
	}
	
	public function manage_account() { }
	
	public function view_profile() { }
}