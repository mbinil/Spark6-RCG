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
            $this->set('child_category',$this->Category->getChildCategories());

            //   getting all the challenges here
            $this->loadModel('Challenge');
            $this->set('challenges',$this->Challenge->getValue(array('`Challenge`.status'=>'1')));
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
            
            echo "1"."@#@".$this->Challenge->createCallenge($_POST['from'],$_POST['val'],$_POST['parent'])."@#@".$child;exit();
        }
	
	public function challenge_details() {

	}
	
	public function my_challenges() {

	}
}