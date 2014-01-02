<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	var $helpers = array('Form', 'Html','Js','Session','Time');
	var $components = array('RequestHandler','Email','Session');
        
	function beforeRender() {
		App::import('Model', array('Difficulty','User','Category','Admin','Challenge','Alert','Userchallenge'));
		
		//Current front end logged in user info
		$active_userid = $this->Session->read("session_user_id");
		$user = new User();
		$activeuserinfo = $user->GetUserById($active_userid);
		$this->set('activeuserinfo', $activeuserinfo);
		
		//Diifficulty count
		$difficulty = new Difficulty();
		$difficultyCount = $difficulty->find('count',array('conditions' => array('status' => true)));
		$this->set('difficultyCount', $difficultyCount);
		
		//users count
		$user = new User();
		$userCount = $user->find('count',array('conditions' => array('user_active' => true)));
		$this->set('userCount', $userCount);
		
		//ParentCategory count
		$parentCategory = new Category();
		$parentCategoryCount = $parentCategory->find('count',array('conditions' => array('status' => true,'parent' => 0)));
		$this->set('parentCategoryCount', $parentCategoryCount);
		
		//ChildCategory count
		$childCategory = new Category();
		$childCategoryCount = $childCategory->find('count',array('conditions' => array('status' => true,'parent!=0')));
		$this->set('childCategoryCount', $childCategoryCount);
		
		//admin users count
		$Admin = new Admin();
		$AdminCount = $Admin->find('count',array('conditions' => array('admin_user_active' => true)));
		$this->set('AdminCount', $AdminCount);
                
                //Challenges  count
		$Challenge = new Challenge();
		$ChallengeCount = $Challenge->find('count',array('conditions' => array('status' => true)));
		$this->set('ChallengeCount', $ChallengeCount);
                //Alert  count
		$Alert = new Alert();
		$AlertCount = $Alert->find('count',array('conditions' => array('status' => true)));
		$this->set('AlertCount', $AlertCount);
                
                
		//notification for challenge invitation
		if($this->Session->read("session_user_id"))
		{
			$Userchallenge  =   new Userchallenge();
			$this->set('Notification_invities', $Userchallenge->createNotification($this->Session->read("session_user_id")));
		}

   	}
} 