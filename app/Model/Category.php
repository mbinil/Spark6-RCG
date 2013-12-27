<?php
class Category extends AppModel
{
   	var $name="Category";

	public function getParentCategories()
	{
		$categories = $this->find("all",array('conditions'=>array('parent'=>'0')));
		return $categories;
	}
	
	public function getChildCategories()
	{
		$categories = $this->find("all",array('conditions'=>array('parent!=0')));
		return $categories;
	}
	
	public function getActiveParentCategories()
	{
		$categories = $this->find("all",array('conditions'=>array('parent'=>'0','status'=>'1')));
		return $categories;
	}
	
	public function getCategoryInfobyId($id)
	{
		$categoryinfo = $this->find('all',array('conditions'=>array('id'=>$id)));
		return $categoryinfo;
	}
	
	public function CheckChildCategoryAvailable($conditions)
	{
		$childcategory = $this->find('all',array('conditions'=>$conditions));
		$availablecount = count($childcategory);
		return $availablecount;
	}
	
	public function CheckParentCategoryAvailable($conditions)
	{
		$parentcategory = $this->find('all',array('conditions'=>$conditions));
		$availablecount = count($parentcategory);
		return $availablecount;
	}
        
        public function getChildFromParent($id)
        {
            if($id)
                $condition  =   array('parent != '=>'0','parent'=>$id,'status'=>'1');
            else
                $condition  =   array('parent != '=>'0','status'=>'1');
            return $this->find('all',array('conditions'=> $condition ));
        }
        
	/**
	* returning the values by serching the child category by the given id.
	* @param integer $id parent id
	* @param string $name name and id of the combo
	* @param string||null $select selected option for the combo
	* @return optional string a select box
	*/
	public function getCombo($id,$name,$select)
	{
		$array  =   $this->getChildFromParent($id);
		
		$reurn_html =   '<select class="select-block" name="info" id="'.$name.'"><option value="0">No child</option>';
		
		foreach ($array as $key => $value) {
			$reurn_html .=   '<option value="'.$value['Category']['id'].'"';
			
			if($select && $select == $value['Category']['id'])
				$reurn_html .=   'selected="selected"';
			
			$reurn_html .=   '>'.$value['Category']['title'].'</option>';
		}
		
		$reurn_html .=   '</select>';
		return $reurn_html;
	}
	
	/**
	* returning the values by serching the parent category by the given parameter.
	* @param string $search_keyword search parameter
	* @return optional array or null 
	*/
	public function searchParent($search_keyword)
	{
	   return  $this->find('all', array(
		   'conditions' => array('OR'  =>  
				   array('title like'  =>  "%$search_keyword%",
						 'decal like'  =>  "%$search_keyword%"),
				   'parent' => '0'
			   )
		   )
	   );
	}
   
	/**
	* returning the values by serching the child category by the given parameter.
	* @param string $search_keyword search parameter
	* @return optional array or null 
	*/
	public function searchChild($search_keyword)
	{
	   return  $this->find('all', array(
		   'conditions' => array('OR'  =>  
				   array('title like'  =>  "%$search_keyword%",
						 'badgecolor like'  =>  "%$search_keyword%"),
				   'parent != ' => '0'
			   )
		   )
	   );
	}
        
        /**
         * getting the parent id as null or have value. anyway need to fetch the child category and create side category nav bar for discover page
         * @param integer|null $id parent id
         * @return string $return_html side nav bar for child category
         */
        public function createChildCategory($id)
        {
            $child_category =   $this->getChildFromParent($id);

            $return_html    =   '<ul class="child_class"><li class="active"><a href="javascript:void(0);" onclick="showChallenge(this,\'child\',\'\',\'\')" >All</a></li>';

            foreach ($child_category as $key => $value) {
                        $return_html    .=   '<li class=""><a href="javascript:void(0);" onclick="showChallenge(this,\'child\',\'\',\''.$value['Category']['id'].'\')" >'.$value['Category']['title'].'</a></li>';
            }
            $return_html    .=   '</ul>';
            
            return $return_html;
        }
}
?>