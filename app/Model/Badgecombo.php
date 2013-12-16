<?php
class Badgecombo extends AppModel
{
   	var $name="Badgecombo";		
        
        /**
         * getting the badgecombo values for different conditions
         * @param array $condition for query where condition
         * @return array selected rows array
         */
	public function getBadgecombos($condition)
	{
		return $this->find( "all",array( 'conditions' => $condition ) );
	}
	
	public function selectedBadgecombo($id)
	{
		return $this->find( "all",array( 'conditions' => array('gradient'=>'0', 'id'=>$id ) ) );
	}
}
?>