<?php
class Difficulty extends AppModel
{
   	var $name="Difficulty";		
		
	public function getDifficultiesTypes()
	{
		$difficultiestypes = $this->find("all");
		return $difficultiestypes;
	}
	
	public function getDifficultybyId($id)
	{
		$difficultytype = $this->find('all',array('conditions'=>array('id'=>$id)));
		return $difficultytype;
	}
	
	public function CheckDifficultyAvailable($conditions)
	{
		$difficultyinfo = $this->find('all',array('conditions'=>$conditions));
		$availablecount = count($difficultyinfo);
		return $availablecount;
	}
	
	public function getActiveDifficultiesTypes()
	{
		$difficultytype = $this->find("all",array('conditions'=>array('status'=>'1')));
		return $difficultytype;
	}
        
        /**
        * returning the values by serching the difficulty by the given parameter.
        * @param string $search_keyword search parameter
        * @return optional array or null 
        */
       public function searchUser($search_keyword)
       {
           return  $this->find('all', array(
                                               'conditions' => array('OR'  =>  
                                                                           array(  'title like'  =>  "%$search_keyword%",
                                                                                   'description like'  =>  "%$search_keyword%",
                                                                                   'decal like'  =>  "%$search_keyword%"

                                                                               )
                                                                       )
                                           )
                               );
       }
}
?>